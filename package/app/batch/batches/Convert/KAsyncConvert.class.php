<?php
require_once("bootstrap.php");
/**
 * Will convert a single flavor and store it in the file system.
 * The state machine of the job is as follows:
 * 	 	get the flavor 
 * 		convert using the right method
 * 		save recovery file in case of crash
 * 		move the file to the archive
 * 		set the entry's new status and file details 
 *
 * @package Scheduler
 * @subpackage Conversion
 */
class KAsyncConvert extends KBatchBase
{
	/**
	 * @var string
	 */
	protected $localTempPath;
	
	/**
	 * @var string
	 */
	protected $sharedTempPath;
	
	/**
	 * @var KDistributedFileManager
	 */
	protected $distributedFileManager = null;
	
	/**
	 * @var KConversionEngine
	 */
	protected $converter = null;
	
	/**
	 * @return number
	 */
	public static function getType()
	{
		return KalturaBatchJobType::CONVERT;
	}
	
	protected function init()
	{
		$this->saveQueueFilter(self::getType());
	}
	
	protected function getFilter()
	{
		$filter = parent::getFilter();
		$filter->jobSubTypeIn = $this->getSupportedEngines();
		
		if($this->taskConfig->params->minFileSize && is_numeric($this->taskConfig->params->minFileSize))
			$filter->fileSizeGreaterThan = $this->taskConfig->params->minFileSize;
		
		if($this->taskConfig->params->maxFileSize && is_numeric($this->taskConfig->params->maxFileSize))
			$filter->fileSizeLessThan = $this->taskConfig->params->maxFileSize;
			
		return $filter;
	}
	
	protected function getMaxJobsEachRun()
	{
		return 1;
	}
	
	public function run($jobs = null)
	{
		KalturaLog::notice ( "Convert batch is running");
		KalturaLog::notice ( "Supporting engines: " . $this->getSupportedEnginesDescription() );
		 
		if($this->taskConfig->isInitOnly())
			return $this->init();
		
		// creates a temp file path
		$this->localTempPath = $this->taskConfig->params->localTempPath;
		$this->sharedTempPath = $this->taskConfig->params->sharedTempPath;
	
		$res = self::createDir( $this->localTempPath );
		if ( !$res ) 
		{
			KalturaLog::err( "Cannot continue conversion without temp local directory");
			return null;
		}
		$res = self::createDir( $this->sharedTempPath );
		if ( !$res ) 
		{
			KalturaLog::err( "Cannot continue conversion without temp shared directory");
			return null;
		}
		
		$this->distributedFileManager = new KDistributedFileManager($this->taskConfig->params->localFileRoot, $this->taskConfig->params->remoteFileRoot, $this->taskConfig->params->fileCacheExpire);
		
		if(is_null($jobs))
			$jobs = $this->getJobs();
			
		if(!count($jobs))
		{
			KalturaLog::notice ( "Queue size: 0 sent to scheduler");
			$this->saveSchedulerQueue(self::getType());
			return null;
		}
		
		foreach($jobs as &$job)
		{
			try
			{
				$job = $this->convert($job, $job->data);
			}
			catch(KalturaException $kex)
			{
				return $this->closeJob($job, KalturaBatchJobErrorTypes::KALTURA_API, $kex->getCode(), "Error: " . $kex->getMessage(), KalturaBatchJobStatus::FAILED);
			}
			catch(KalturaClientException $kcex)
			{
				return $this->closeJob($job, KalturaBatchJobErrorTypes::KALTURA_CLIENT, $kcex->getCode(), "Error: " . $kcex->getMessage(), KalturaBatchJobStatus::RETRY);
			}
			catch(Exception $ex)
			{
				return $this->closeJob($job, KalturaBatchJobErrorTypes::RUNTIME, $ex->getCode(), "Error: " . $ex->getMessage(), KalturaBatchJobStatus::FAILED);
			}
		}
			
		return $jobs;
	}
	
	protected function getJobs()
	{
		return $this->kClient->batch->getExclusiveConvertJobs( 
					$this->getExclusiveLockKey() , 
					$this->taskConfig->maximumExecutionTime , 
					$this->getMaxJobsEachRun() , 
					$this->getFilter());
	}
	
	protected function convert(KalturaBatchJob $job, KalturaSourceJobData $data)
	{
		if($this->taskConfig->params->isRemote)
			$job->lastWorkerRemote = true;
			
		$data->actualSrcFileSyncLocalPath = $this->translateSharedPath2Local($data->srcFileSyncLocalPath);
		$updateData = new KalturaSourceJobData();
		$updateData->actualSrcFileSyncLocalPath = $data->actualSrcFileSyncLocalPath;
		$job = $this->updateJob($job, null, KalturaBatchJobStatus::QUEUED, 1, $updateData, $job->lastWorkerRemote);
	
		$this->converter = KConversionEngine::getInstance ( $job->jobSubType , $this->taskConfig, $job->entryId );
		
		if ( $this->converter == null )
		{
			$err = "Cannot find converter [{$job->jobSubType}] for job id [{$job->id}]";
			return $this->closeJob($job, KalturaBatchJobErrorTypes::APP, KalturaBatchJobAppErrors::ENGINE_NOT_FOUND, $err, KalturaBatchJobStatus::FAILED, KalturaEntryStatus::ERROR_CONVERTING);
		}
		
		KalturaLog::info( "Using engine: " . $this->converter->getName() );
		
		return $this->convertImpl($job, $data);
	}
	
	protected function convertImpl(KalturaBatchJob $job, KalturaSourceJobData $data)
	{
		return $this->convertJob($job, $data);
	}
	
	protected function convertJob(KalturaBatchJob $job, KalturaConvertJobData $data)
	{
		KalturaLog::notice ( "Converting flavor job");
		
		// ASSUME:
		// 1. full input file path ($data->actualSrcFileSyncLocalPath)
		// 2. flavorParams ($data->flavorParams)
		// PROMISE
		// 1. full output file path ($data->destFileSyncLocalPath)
		// 2. full output log path
		// 3. in case of remote engine (almost done) - id/url to query result
 
	
		if($job->executionAttempts > 1) // is a retry
		{
			if(strlen($data->destFileSyncLocalPath) && file_exists($data->destFileSyncLocalPath))
			{
				return $this->moveFile($job, $data);
			}
		}
		
		if($this->taskConfig->params->isRemote || !strlen(trim($data->actualSrcFileSyncLocalPath))) // for distributed conversion
		{
			if(!strlen(trim($data->actualSrcFileSyncLocalPath)))
				$data->actualSrcFileSyncLocalPath = $this->taskConfig->params->localFileRoot . DIRECTORY_SEPARATOR . basename($data->srcFileSyncRemoteUrl);
				
			$err = null;
			if(!$this->distributedFileManager->getLocalPath($data->actualSrcFileSyncLocalPath, $data->srcFileSyncRemoteUrl, $err))
			{
				return $this->closeJob($job, KalturaBatchJobErrorTypes::APP, KalturaBatchJobAppErrors::REMOTE_FILE_NOT_FOUND, $err, KalturaBatchJobStatus::RETRY);
			}
		}
		
		
		// creates a temp file path
		$uniqid = uniqid("convert_{$job->entryId}_");
		$data->destFileSyncLocalPath = "{$this->localTempPath}/$uniqid";
		
		list($ok ,$errorMessage) = $this->converter->convert($data);

		if(!$ok || $job->jobSubType == KalturaConversionEngineType::ENCODING_COM || $job->jobSubType == KalturaConversionEngineType::KALTURA_COM)
		{
			$log = $this->converter->getLogData();
			if($log && strlen($log))
				$this->kClient->batch->logConversion($data->flavorAssetId, $log);
		}
		
		if ( $ok )
		{
			if($job->jobSubType == KalturaConversionEngineType::ENCODING_COM || $job->jobSubType == KalturaConversionEngineType::KALTURA_COM)
			{
				$msg = "engine [" . $this->converter->getName() . "] converted successfully: $errorMessage";
				return $this->closeJob($job, null, null, $msg, KalturaBatchJobStatus::ALMOST_DONE, null, $data);
			}
			else
			{
				$job = $this->updateJob($job, "engine [" . $this->converter->getName() . "] converted successfully", KalturaBatchJobStatus::MOVEFILE, 90, $data);
				return $this->moveFile($job, $data);
			}
		}	
		else
		{
			$err = "engine [" . $this->converter->getName() . "] converted failed: $errorMessage";
			return $this->closeJob($job, KalturaBatchJobErrorTypes::APP, KalturaBatchJobAppErrors::CONVERSION_FAILED, $err, KalturaBatchJobStatus::FAILED);
		}
	}
	
	private function moveFile(KalturaBatchJob $job, KalturaConvertJobData $data)
	{
		KalturaLog::debug("moveFile($job->id, $data->destFileSyncLocalPath)");
		
		$uniqid = uniqid("convert_{$job->entryId}_");
		$sharedFile = "{$this->sharedTempPath}/$uniqid";
		
		clearstatcache();
		$fileSize = filesize($data->destFileSyncLocalPath);
		@rename($data->destFileSyncLocalPath . '.log', "$sharedFile.log");
		rename($data->destFileSyncLocalPath, $sharedFile); 
		
		if(!file_exists($sharedFile) || filesize($sharedFile) != $fileSize)
		{
			KalturaLog::err("Error: moving file failed");
			die();
		}
		
		@chmod($sharedFile, 0777);
		$data->destFileSyncLocalPath = $this->translateLocalPath2Shared($sharedFile);
	
		if($this->taskConfig->params->isRemote) // for remote conversion
		{			
			$data->destFileSyncRemoteUrl = $this->distributedFileManager->getRemoteUrl($data->destFileSyncLocalPath);
			$job->status = KalturaBatchJobStatus::ALMOST_DONE;
			$job->message = "File ready for download";
		}
		elseif($this->checkFileExists($data->destFileSyncLocalPath, $fileSize))
		{
			$job->status = KalturaBatchJobStatus::FINISHED;
			$job->message = "File moved to shared";
		}
		else
		{
			$job->status = KalturaBatchJobStatus::RETRY;
			$job->message = "File not moved correctly";
		}
		return $this->closeJob($job, null, null, $job->message, $job->status, null, $data);
	}
	
	protected function updateExclusiveJob($jobId, KalturaBatchJob $job, $entryStatus = null)
	{
		return $this->kClient->batch->updateExclusiveConvertJob($jobId, $this->getExclusiveLockKey(), $job, $entryStatus);
	}
	
	protected function freeExclusiveJob(KalturaBatchJob $job)
	{
		$resetExecutionAttempts = false;
		if($job->status == KalturaBatchJobStatus::ALMOST_DONE)
			$resetExecutionAttempts = true;
			
		$response = $this->kClient->batch->freeExclusiveConvertJob($job->id, $this->getExclusiveLockKey(), $resetExecutionAttempts);
		
		KalturaLog::info("Queue size: $response->queueSize sent to scheduler");
		$this->saveSchedulerQueue(self::getType(), $response->queueSize);
		
		return $response->job;
	}	

	
	/*
	 * @return string
	 */
	protected function getSupportedEnginesDescription()
	{
		$supported_engines_arr = array();
		if  ( $this->taskConfig->params->useOn2 ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::ON2 . "] On2";
		if  ( $this->taskConfig->params->useFFMpeg ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::FFMPEG . "] ffmpeg";
		if  ( $this->taskConfig->params->MEncoder ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::MENCODER . "] mencoder";
		if  ( $this->taskConfig->params->EncodingCom ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::ENCODING_COM . "] encoding.com";
		if  ( $this->taskConfig->params->KalturaCom ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::KALTURA_COM . "] kaltura";
		if  ( $this->taskConfig->params->useFFMpegAux ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::FFMPEG_AUX . "] ffmpeg_aux";
		if  ( $this->taskConfig->params->useFFMpegVp8 ) $supported_engines_arr[] = "[" . KalturaConversionEngineType::FFMPEG_VP8 . "] ffmpeg_vp8";
		
		return implode ( ", " , $supported_engines_arr );
	}
	

	/*
	 * @return string
	 */
	protected function getSupportedEngines()
	{
/*
 * 	params->useOn2			= true
	params->useFFMpeg		= true
	params->MEncoder			= true
	params->EncodingCom		= true
	params->KalturaCom		= true
 */		 
		$supported_engines_arr = array();
		if  ( $this->taskConfig->params->useOn2 ) $supported_engines_arr[] = KalturaConversionEngineType::ON2;
		if  ( $this->taskConfig->params->useFFMpeg ) $supported_engines_arr[] = KalturaConversionEngineType::FFMPEG;
		if  ( $this->taskConfig->params->MEncoder ) $supported_engines_arr[] = KalturaConversionEngineType::MENCODER;
		if  ( $this->taskConfig->params->EncodingCom ) $supported_engines_arr[] = KalturaConversionEngineType::ENCODING_COM;
		if  ( $this->taskConfig->params->KalturaCom ) $supported_engines_arr[] = KalturaConversionEngineType::KALTURA_COM;
		if  ( $this->taskConfig->params->useFFMpegAux ) $supported_engines_arr[] = KalturaConversionEngineType::FFMPEG_AUX;
		if  ( $this->taskConfig->params->useFFMpegVp8 ) $supported_engines_arr[] = KalturaConversionEngineType::FFMPEG_VP8;
		
		return join(',', $supported_engines_arr);
	}
}
?>