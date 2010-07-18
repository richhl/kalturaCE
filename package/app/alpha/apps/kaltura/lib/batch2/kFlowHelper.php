<?php

/**
 *  
 * @package Core
 * @subpackage Batch
 *
 */
class kFlowHelper
{
	protected static $thumbSupportVideoCodecs = array(
		flavorParams::VIDEO_CODEC_VP6,
		flavorParams::VIDEO_CODEC_H263,
		flavorParams::VIDEO_CODEC_H264,
		flavorParams::VIDEO_CODEC_FLV,
		flavorParams::VIDEO_CODEC_MPEG4,
		flavorParams::VIDEO_CODEC_THEORA,
		flavorParams::VIDEO_CODEC_WMV2,
		flavorParams::VIDEO_CODEC_WMV3,
		flavorParams::VIDEO_CODEC_WVC1A,
	);
	
	/**
	 * @param int $partnerId
	 * @param string $entryId
	 * @param string $msg
	 * @return flavorAsset
	 */
	public static function createOriginalFlavorAsset($partnerId, $entryId, &$msg = null)
	{
		$flavorAsset = flavorAssetPeer::retrieveOriginalByEntryId($entryId);
		if($flavorAsset)
		{
			$flavorAsset->incrementVersion();
			$flavorAsset->save();
			
			return $flavorAsset;
		}
		
		$status = flavorAsset::FLAVOR_ASSET_STATUS_READY;
		
		try{
			$profile = myPartnerUtils::getConversionProfile2ForEntry($entryId);
		
			if(!$profile)
			{
				kLog::log("Conversion profile not found for entry [$entryId] and partner [$partnerId]");
				$msg = 'Conversion profile not found';
				return null;
			}
		}
		catch(Exception $e)
		{
			kLog::log('getConversionProfile2ForEntry Error: ' . $e->getMessage());
			return null;
		}
	
		$c = new Criteria();
		$c->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $profile->getId());
		$c->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParams::SOURCE_PARAMS_ID );
		$hasSourceFlavor = flavorParamsConversionProfilePeer::doCount($c);
		if(!$hasSourceFlavor)
			$status = flavorAsset::FLAVOR_ASSET_STATUS_DELETED;
		
		// creates the flavor asset
		$flavorAsset = new flavorAsset();
		$flavorAsset->setStatus($status);
		$flavorAsset->incrementVersion();
		$flavorAsset->setIsOriginal(true);
		$flavorAsset->setPartnerId($partnerId);
		$flavorAsset->setEntryId($entryId);
		$flavorAsset->setFlavorParamsId(flavorParams::SOURCE_PARAMS_ID);
		$flavorAsset->save();
		
		if($status == flavorAsset::FLAVOR_ASSET_STATUS_READY)
		{
			$entry = entryPeer::retrieveByPK($entryId);
			if($entry)
			{
				$entry->addFlavorParamsId(flavorParams::SOURCE_FLAVOR_ID);
				$entry->save();
			}
		}
		
		return $flavorAsset;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 */
	public static function createEntryUpdateNotification(BatchJob $dbBatchJob)
	{
		myNotificationMgr::createNotification(kNotificationJobData::NOTIFICATION_TYPE_ENTRY_UPDATE, $dbBatchJob->getEntry(true, false), null, null, null, null, $dbBatchJob->getEntryId());
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kImportJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleImportFinished(BatchJob $dbBatchJob, kImportJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Import finished, with file: " . $data->getDestFileLocalPath());
		
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
			
		if(!$twinJob)
		{
			if(!file_exists($data->getDestFileLocalPath()))
				throw new APIException(APIErrors::INVALID_FILE_NAME, $data->getDestFileLocalPath());
		}
		
		$msg = null;
		$flavorAsset = kFlowHelper::createOriginalFlavorAsset($dbBatchJob->getPartnerId(), $dbBatchJob->getEntryId(), $msg);
		if(!$flavorAsset)
		{
			kLog::log("Flavor asset not created for entry [" . $dbBatchJob->getEntryId() . "]");
			kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_ERROR_CONVERTING);
			$dbBatchJob->setMessage($msg);
			$dbBatchJob->setDescription($dbBatchJob->getDescription() . "\n" . $msg);
			return $dbBatchJob;
		}
		
		$syncKey = null;
		
		if($twinJob)
		{
			$syncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
			// copy file sync
			$twinData = $twinJob->getData();
			if($twinData instanceof kImportJobData)
			{
				$twinFlavorAsset = flavorAssetPeer::retrieveById($twinData->getFlavorAssetId());
				if($twinFlavorAsset)
				{
					$twinSyncKey = $twinFlavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
					if($twinSyncKey && kFileSyncUtils::file_exists($twinSyncKey))
					{
						kFileSyncUtils::softCopy($twinSyncKey, $syncKey);
					}
				}
			}
		}
		else
		{
			$ext = pathinfo($data->getDestFileLocalPath(), PATHINFO_EXTENSION);	
			kLog::log("Imported file extension: $ext");
			$flavorAsset->setFileExt($ext);
			$flavorAsset->save();
			$syncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
			kFileSyncUtils::moveFromFile($data->getDestFileLocalPath(), $syncKey);
		}
		
		// set the path in the job data
		$data->setDestFileLocalPath(kFileSyncUtils::getLocalFilePathForKey($syncKey));
		$data->setFlavorAssetId($flavorAsset->getId());
		$dbBatchJob->setData($data);
		$dbBatchJob->save();
		
		// creates a convert profile job
		$convertProfileData = new kConvertProfileJobData();
		$convertProfileData->setFlavorAssetId($flavorAsset->getId());
		$convertProfileData->setInputFileSyncLocalPath($data->getDestFileLocalPath());
		kJobsManager::addJob($dbBatchJob->createChild(), $convertProfileData, BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE);
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kExtractMediaJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleExtractMediaClosed(BatchJob $dbBatchJob, kExtractMediaJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Extract media closed");
		
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
		
		$rootBatchJob = $dbBatchJob->getRootJob();
		if(!$rootBatchJob)
			return $dbBatchJob;
	
		if($twinJob)
		{
			// copy media info
			$twinData = $twinJob->getData();
			if($twinData->getMediaInfoId())
			{
				$twinMediaInfo = mediaInfoPeer::retrieveByPK($twinData->getMediaInfoId());
				if($twinMediaInfo)
				{
					$mediaInfo = $twinMediaInfo->copy();
					$mediaInfo->setFlavorAssetId($data->getFlavorAssetId());
					$mediaInfo = kBatchManager::addMediaInfo($mediaInfo);
					
					$data->setMediaInfoId($mediaInfo->getId());
					$dbBatchJob->setData($data);
					$dbBatchJob->save();
				}
			}
		}
		
		if($dbBatchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED)
		{
			$entry = $dbBatchJob->getEntry();
			if($entry->getStatus() < entry::ENTRY_STATUS_READY)
				kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_PRECONVERT);
		}
				
		switch($dbBatchJob->getJobSubType())
		{
			case mediaInfo::ASSET_TYPE_ENTRY_INPUT:
				
				if($rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE)
				{
					$conversionsCreated = kBusinessPreConvertDL::decideProfileConvert($dbBatchJob, $rootBatchJob, $data->getMediaInfoId());
					
					if($conversionsCreated)
					{
						// handle the source flavor as if it was converted, makes the entry ready according to ready behavior rules
						$currentFlavorAsset = flavorAssetPeer::retrieveById($data->getFlavorAssetId());
						$dbBatchJob = kBusinessPostConvertDL::handleConvertFinished($dbBatchJob, $currentFlavorAsset);
					}
				}
				break;
				
			case mediaInfo::ASSET_TYPE_FLAVOR_INPUT:
				if($rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_REMOTE_CONVERT)
				{
					$remoteConvertData = $rootBatchJob->getData();
					$errDescription = null;
					
					$syncKey = null; // TODO - how to get or create the sync key?
					$newConvertJob = kBusinessPreConvertDL::decideFlavorConvert($syncKey, $remoteConvertData->getFlavorParamsOutputId(), $errDescription, $remoteConvertData->getMediaInfoId(), $dbBatchJob);
					if(!$newConvertJob)
						kJobsManager::failBatchJob($rootBatchJob);
				}
				break;
				
			default:
				// currently do nothing
				break;
		}
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertPending(BatchJob $dbBatchJob, kConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Convert created with source file: " . $data->getSrcFileSyncLocalPath());
		
		// save the data to the db
		$dbBatchJob->setData($data);
		$dbBatchJob->save();
		
		
		$flavorAsset = flavorAssetPeer::retrieveById($data->getFlavorAssetId());
		// verifies that flavor asset exists
		if(!$flavorAsset)
		{
			kLog::log("Error: Flavor asset not found [" . $data->getFlavorAssetId() . "]");
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $data->getFlavorAssetId());
		}
		
		$flavorAsset->setStatus(flavorAsset::FLAVOR_ASSET_STATUS_CONVERTING);
		$flavorAsset->save();
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertFinished(BatchJob $dbBatchJob, kConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Convert finished with destination file: " . $data->getDestFileSyncLocalPath());
		
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
		
		// verifies that flavor asset created
		if(!$data->getFlavorAssetId())
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $data->getFlavorAssetId());
		
		$flavorAsset = flavorAssetPeer::retrieveById($data->getFlavorAssetId());
		// verifies that flavor asset exists
		if(!$flavorAsset)
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $data->getFlavorAssetId());

		$flavorAsset->incrementVersion();
		$flavorAsset->save();
		
		$syncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
		kFileSyncUtils::moveFromFile($data->getDestFileSyncLocalPath(), $syncKey);
		
		// creats the file sync
		$logSyncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_CONVERT_LOG);
		try{
			kFileSyncUtils::moveFromFile($data->getDestFileSyncLocalPath() . '.log', $logSyncKey);
		}
		catch(Exception $e){
			$err = 'Saving conversion log: ' . $e->getMessage();
			kLog::log($err);
			
			$desc = $dbBatchJob->getDescription() . "\n" . $err;
			$dbBatchJob->getDescription($desc);
		}
		
		$data->setDestFileSyncLocalPath(kFileSyncUtils::getLocalFilePathForKey($syncKey));
		kLog::log("Convert archived file to: " . $data->getDestFileSyncLocalPath());

		// save the data changes to the db
		$dbBatchJob->setData($data);
		$dbBatchJob->save();
		
		$entry = $dbBatchJob->getEntry();
		if(!$entry)
			throw new APIException(APIErrors::INVALID_ENTRY, $dbBatchJob, $dbBatchJob->getEntryId());
			
		$entry->addFlavorParamsId($data->getFlavorParamsOutput()->getFlavorParamsId());
		$entry->save();
		
		$partner = $entry->getPartner();
		$offset = $entry->getThumbOffset($partner->getDefThumbOffset());
		$flavorParamsOutput = $data->getFlavorParamsOutput();
		
		$createThumb = true;
		$rootBatchJob = $dbBatchJob->getRootJob();
		
		if(!$rootBatchJob)
		{
			$createThumb = false;
		}
		else
		{
			if($rootBatchJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE)
			{
				$createThumb = false;
			}
			else
			{
				$rootBatchJobData = $rootBatchJob->getData();
				if($rootBatchJobData instanceof kConvertProfileJobData && !$rootBatchJobData->getCreateThumb())
					$createThumb = false;
			}
		}
		
		if($createThumb)
		{
			$videoCodec = $flavorParamsOutput->getVideoCodec();
			if(!in_array($videoCodec, self::$thumbSupportVideoCodecs))
				$createThumb = false;
		}
		
		kJobsManager::addPostConvertJob($dbBatchJob, $data->getDestFileSyncLocalPath(), $data->getFlavorAssetId(), $flavorParamsOutput->getId(), $createThumb, $offset);
		
		// this logic decide when a thumbnail should be created
		if($rootBatchJob && $rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_BULKDOWNLOAD)
		{
			$localPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
			$downloadUrl = $flavorAsset->getDownloadUrl();
			
			$notificationData = array(
				"puserId" => $entry->getPuserId(),
				"entryId" => $entry->getId(),
				"entryIntId" => $entry->getIntId(),
				"entryVersion" => $entry->getVersion(),
				"fileFormat" => $flavorAsset->getFileExt(),
//				"email" => '',
				"archivedFile" => $localPath,
				"downoladPath" => $localPath,
				"conversionQuality" => $entry->getConversionQuality(),
				"downloadUrl" => $downloadUrl,
			);
			
			$extraData = array(
				"data" => json_encode($notificationData),
				"partner_id" => $entry->getPartnerId(),
				"puser_id" => $entry->getPuserId(),
				"entry_id" => $entry->getId(),
				"entry_int_id" => $entry->getIntId(),
				"entry_version" => $entry->getVersion(),
				"file_format" => $flavorAsset->getFileExt(),
//				"email" => '',
				"archived_file" => $localPath,
				"downolad_path" => $localPath,
				"target" => $localPath,
				"conversion_quality" => $entry->getConversionQuality(),
				"download_url" => $downloadUrl,
				"status" => $entry->getStatus(),
				"abort" => $dbBatchJob->getAbort(),
				"progress" => $dbBatchJob->getProgress(),
				"message" => $dbBatchJob->getMessage(),
				"description" => $dbBatchJob->getDescription(),
				"updates_count" => $dbBatchJob->getUpdatesCount(),
				"job_type" => BatchJob::BATCHJOB_TYPE_DOWNLOAD,
				"status" => BatchJob::BATCHJOB_STATUS_FINISHED,
				"progress" => 100,
				"debug" => __LINE__,
			);
			
			myNotificationMgr::createNotification(kNotificationJobData::NOTIFICATION_TYPE_BATCH_JOB_SUCCEEDED, $dbBatchJob , $dbBatchJob->getPartnerId() , null , null , 
					$extraData, $dbBatchJob->getEntryId() );
		}
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertQueued(BatchJob $dbBatchJob, kConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		$rootBatchJob = $dbBatchJob->getRootJob();
		if($rootBatchJob && $rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_BULKDOWNLOAD)
		{
			$entry = $dbBatchJob->getEntry();
			
			$notificationData = array(
				"puserId" => $entry->getPuserId(),
				"entryId" => $entry->getId(),
				"entryIntId" => $entry->getIntId(),
				"entryVersion" => $entry->getVersion(),
//				"email" => '',
				"conversionQuality" => $entry->getConversionQuality(),
			);
			
			$extraData = array(
				"data" => json_encode($notificationData),
				"partner_id" => $entry->getPartnerId(),
				"puser_id" => $entry->getPuserId(),
				"entry_id" => $entry->getId(),
				"entry_int_id" => $entry->getIntId(),
				"entry_version" => $entry->getVersion(),
//				"email" => '',
				"conversion_quality" => $entry->getConversionQuality(),
				"status" => $entry->getStatus(),
				"abort" => $dbBatchJob->getAbort(),
				"progress" => $dbBatchJob->getProgress(),
				"message" => $dbBatchJob->getMessage(),
				"description" => $dbBatchJob->getDescription(),
				"updates_count" => $dbBatchJob->getUpdatesCount(),
				"job_type" => BatchJob::BATCHJOB_TYPE_DOWNLOAD,
				"status" => BatchJob::BATCHJOB_STATUS_QUEUED,
				"progress" => 0,
				"debug" => __LINE__,
			);
			
			myNotificationMgr::createNotification(kNotificationJobData::NOTIFICATION_TYPE_BATCH_JOB_STARTED, $dbBatchJob , $dbBatchJob->getPartnerId() , null , null , 
					$extraData, $dbBatchJob->getEntryId() );
		}
		
		return $dbBatchJob;		
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertFailed(BatchJob $dbBatchJob, kConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{		
		kLog::log("Convert failed with destination file: " . $data->getDestFileSyncLocalPath());
		
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
		
		// verifies that flavor asset created
		if(!$data->getFlavorAssetId())
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $data->getFlavorAssetId());
		
		$flavorAsset = flavorAssetPeer::retrieveById($data->getFlavorAssetId());
		// verifies that flavor asset exists
		if(!$flavorAsset)
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $data->getFlavorAssetId());

		$flavorAsset->incrementVersion();
		$flavorAsset->save();
		
		$fallbackCreated = kBusinessPostConvertDL::handleConvertFailed($dbBatchJob, $dbBatchJob->getJobSubType(), $data->getFlavorAssetId(), $data->getFlavorParamsOutputId(), $data->getMediaInfoId());
		
		if(!$fallbackCreated)
		{
			$rootBatchJob = $dbBatchJob->getRootJob();
			if($rootBatchJob && $rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_BULKDOWNLOAD)
			{
				$entryId = $dbBatchJob->getEntryId();
				$fileFormat = $data->getFlavorParamsOutput()->getFileExt();
				
				$entry = $dbBatchJob->getEntry();
			
				$notificationData = array(
					"puserId" => $entry->getPuserId(),
					"entryId" => $entry->getId(),
					"entryIntId" => $entry->getIntId(),
					"entryVersion" => $entry->getVersion(),
					"fileFormat" => $flavorAsset->getFileExt(),
	//				"email" => '',
					"conversionQuality" => $entry->getConversionQuality(),
				);
				
				$extraData = array(
					"data" => json_encode($notificationData),
					"partner_id" => $entry->getPartnerId(),
					"puser_id" => $entry->getPuserId(),
					"entry_id" => $entry->getId(),
					"entry_int_id" => $entry->getIntId(),
					"entry_version" => $entry->getVersion(),
	//				"email" => '',
					"conversion_quality" => $entry->getConversionQuality(),
					"status" => $entry->getStatus(),
					"abort" => $dbBatchJob->getAbort(),
					"progress" => $dbBatchJob->getProgress(),
					"message" => $dbBatchJob->getMessage(),
					"description" => $dbBatchJob->getDescription(),
					"updates_count" => $dbBatchJob->getUpdatesCount(),
					"job_type" => BatchJob::BATCHJOB_TYPE_DOWNLOAD,
					"conversion_error" => "Error while converting [$entryId] [$fileFormat]",
					"status" => BatchJob::BATCHJOB_STATUS_FAILED,
					"progress" => 0,
					"debug" => __LINE__,
				);
				
				myNotificationMgr::createNotification(kNotificationJobData::NOTIFICATION_TYPE_BATCH_JOB_FAILED, $dbBatchJob , $dbBatchJob->getPartnerId() , null , null , 
						$extraData, $entryId );
			}
		}
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kPostConvertJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handlePostConvertFailed(BatchJob $dbBatchJob, kPostConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{		
		kLog::log("Post Convert failed for flavor params output: " . $data->getFlavorParamsOutputId());
		
		// get additional info from the parent job
		$engineType = null;
		$mediaInfoId = null;
		$parentJob = $dbBatchJob->getParentJob();
		if($parentJob)
		{
			$engineType = $parentJob->getJobSubType();
			$convertJobData = $parentJob->getData();
			if($convertJobData instanceof kConvertJobData)
				$mediaInfoId = $convertJobData->getMediaInfoId();
		}
		
		kBusinessPostConvertDL::handleConvertFailed($dbBatchJob, $engineType, $data->getFlavorAssetId(), $data->getFlavorParamsOutputId(), $mediaInfoId);
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertCollectionJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertCollectionFinished(BatchJob $dbBatchJob, kConvertCollectionJobData $data, $entryStatus, BatchJob $twinJob = null)
	{	
		kLog::log("Convert Collection finished for entry id: " . $dbBatchJob->getEntryId());
		
		if($dbBatchJob->getAbort())
			return $dbBatchJob;

		
		$entry = $dbBatchJob->getEntry();
		if(!$entry)
			throw new APIException(APIErrors::INVALID_ENTRY, $dbBatchJob, $dbBatchJob->getEntryId());
		
		$ismPath = $data->getDestDirLocalPath() . DIRECTORY_SEPARATOR . $data->getDestFileName() . '.ism';
		$ismcPath = $data->getDestDirLocalPath() . DIRECTORY_SEPARATOR . $data->getDestFileName() . '.ismc';
		$logPath = $data->getDestDirLocalPath() . DIRECTORY_SEPARATOR . $data->getDestFileName() . '.log';
		$thumbPath = $data->getDestDirLocalPath() . DIRECTORY_SEPARATOR . $data->getDestFileName() . '_Thumb.jpg';
		$ismContent = file_get_contents($ismPath);
		
		$partner = $entry->getPartner();
		$offset = $entry->getThumbOffset($partner->getDefThumbOffset());
		
		$finalFlavors = array();
		$addedFlavorParamsOutputsIds = array();
		foreach($data->getFlavors() as $flavor)
		{
			// verifies that flavor asset created
			if(!$flavor->getFlavorAssetId())
				throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $data->getFlavorAssetId());
			
			$flavorAsset = flavorAssetPeer::retrieveById($flavor->getFlavorAssetId());
			// verifies that flavor asset exists
			if(!$flavorAsset)
				throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $flavor->getFlavorAssetId());
	
			// increment flavor asset version (for file sync)
			$flavorAsset->incrementVersion();
			$flavorAsset->save();
			
			// syncing the media file
			$syncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
			kFileSyncUtils::moveFromFile($flavor->getDestFileSyncLocalPath(), $syncKey);
			
			// replacing the file name in the ism file
			$oldName = basename($flavor->getDestFileSyncLocalPath());
			$flavor->setDestFileSyncLocalPath(kFileSyncUtils::getLocalFilePathForKey($syncKey));
			kLog::log("Convert archived file to: " . $flavor->getDestFileSyncLocalPath());
			$newName = basename($flavor->getDestFileSyncLocalPath());
			kLog::log("Editing ISM [$oldName] to [$newName]");
			$ismContent = str_replace("src=\"$oldName\"", "src=\"$newName\"", $ismContent);
		
			// creating post convert job (without thumb)
			kJobsManager::addPostConvertJob($dbBatchJob, $flavor->getDestFileSyncLocalPath(), $flavor->getFlavorAssetId(), $flavor->getFlavorParamsOutputId());
			
			$finalFlavors[] = $flavor;
			$addedFlavorParamsOutputsIds[] = $flavor->getFlavorParamsOutputId();
		}

		// adding flavor params ids to the entry
		$addedFlavorParamsOutputs = flavorParamsOutputPeer::retrieveByPKs($addedFlavorParamsOutputsIds);
		foreach($addedFlavorParamsOutputs as $addedFlavorParamsOutput)
			$entry->addFlavorParamsId($addedFlavorParamsOutput->getFlavorParamsId());
		
		$ismVersion = $entry->getIsmVersion();
		
		// syncing the ismc file
		$syncKey = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_ISMC, $ismVersion);
		kFileSyncUtils::moveFromFile($ismcPath,	$syncKey);
		
		// replacing the ismc file name in the ism file
		$oldName = basename($ismcPath);
		$newName = basename(kFileSyncUtils::getLocalFilePathForKey($syncKey));
		kLog::log("Editing ISM [$oldName] to [$newName]");
		$ismContent = str_replace("content=\"$oldName\"", "content=\"$newName\"", $ismContent);
		
		$ismPath .= '.tmp';
		$bytesWritten = file_put_contents($ismPath, $ismContent);
		if(!$bytesWritten)
			kLog::log("Failed to update file [$ismPath]");
		
		// syncing ism and lig files
		kFileSyncUtils::moveFromFile($ismPath, $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_ISM, $ismVersion));
		kFileSyncUtils::moveFromFile($logPath, $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_CONVERSION_LOG, $ismVersion));
		
		if(file_exists($thumbPath))
		{
			$entry->setThumbnail(".jpg");
			$entry->save();
			kFileSyncUtils::moveFromFile($thumbPath, $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_THUMB));
		}
		else 
		{
			// saving entry changes
			$entry->save();
		}
		
		// save the data changes to the db
		$data->setFlavors($finalFlavors);
		$dbBatchJob->setData($data);
		$dbBatchJob->save();
		
		// send notification if needed
		$rootBatchJob = $dbBatchJob->getRootJob();
		if($rootBatchJob && $rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_BULKDOWNLOAD)
		{
			$localPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
			$downloadUrl = $flavorAsset->getDownloadUrl();
			
			$notificationData = array(
				"puserId" => $entry->getPuserId(),
				"entryId" => $entry->getId(),
				"entryIntId" => $entry->getIntId(),
				"entryVersion" => $entry->getVersion(),
//				"fileFormat" => '',
//				"email" => '',
				"archivedFile" => $localPath,
				"downoladPath" => $localPath,
				"conversionQuality" => $entry->getConversionQuality(),
				"downloadUrl" => $downloadUrl,
			);
			
			$extraData = array(
				"data" => json_encode($notificationData),
				"partner_id" => $entry->getPartnerId(),
				"puser_id" => $entry->getPuserId(),
				"entry_id" => $entry->getId(),
				"entry_int_id" => $entry->getIntId(),
				"entry_version" => $entry->getVersion(),
				"file_format" => $flavorAsset->getFileExt(),
//				"email" => '',
				"archived_file" => $localPath,
				"downolad_path" => $localPath,
				"target" => $localPath,
				"conversion_quality" => $entry->getConversionQuality(),
				"download_url" => $downloadUrl,
				"status" => $entry->getStatus(),
				"abort" => $dbBatchJob->getAbort(),
				"progress" => $dbBatchJob->getProgress(),
				"message" => $dbBatchJob->getMessage(),
				"description" => $dbBatchJob->getDescription(),
				"updates_count" => $dbBatchJob->getUpdatesCount(),
				"job_type" => BatchJob::BATCHJOB_TYPE_DOWNLOAD,
				"status" => BatchJob::BATCHJOB_STATUS_FINISHED,
				"progress" => 100,
				"debug" => __LINE__,
			);
			
			myNotificationMgr::createNotification(kNotificationJobData::NOTIFICATION_TYPE_BATCH_JOB_SUCCEEDED, $dbBatchJob , $dbBatchJob->getPartnerId() , null , null , 
					$extraData, $dbBatchJob->getEntryId() );
		}
		
		// TODO - remove after event manager is implemented
		$externalStorages = StorageProfilePeer::retrieveAutomaticByPartnerId($dbBatchJob->getPartnerId());
		foreach($externalStorages as $externalStorage)
		{
			kLog::log("Checking storage [" . $externalStorage->getId() . "]");
			kLog::log("Storage trigger [" . $externalStorage->getTrigger() . "]");
		
			if(
				$externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_FLAVOR_READY
				||
					(
						$externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_MODERATION_APPROVED
						&&
						$entry->getModerationStatus() == entry::ENTRY_MODERATION_STATUS_APPROVED
					)
				)
			{
				$ismKey = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_ISM);
				if(kFileSyncUtils::fileSync_exists($ismKey))
				{
					$ismSyncFile = kFileSyncUtils::getLocalFileSyncForKey($ismKey);
					kLog::log("Init kStorageExportAction");
					$action = new kStorageExportOperation($ismSyncFile);
					$action->setStorageProfile($externalStorage);
					$action->execute();
				}
				
				$ismcKey = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_ISMC);
				if(kFileSyncUtils::fileSync_exists($ismcKey))
				{
					$ismcSyncFile = kFileSyncUtils::getLocalFileSyncForKey($ismcKey);
					kLog::log("Init kStorageExportAction");
					$action = new kStorageExportOperation($ismcSyncFile);
					$action->setStorageProfile($externalStorage);
					$action->execute();
				}
			}
		}
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertCollectionJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertCollectionFailed(BatchJob $dbBatchJob, kConvertCollectionJobData $data, $entryStatus, BatchJob $twinJob = null)
	{		
		kLog::log("Convert Collection failed for entry id: " . $dbBatchJob->getEntryId());
		
		kBusinessPostConvertDL::handleConvertCollectionFailed($dbBatchJob, $data, $dbBatchJob->getJobSubType());
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kPostConvertJobData $data
	 */
	protected static function createThumbnail(BatchJob $dbBatchJob, kPostConvertJobData $data)
	{
		kLog::log("Post Convert finished with thumnail: " . $data->getThumbPath());
	
		$ignoreThumbnail = false;
		
		// this logic decide when this thumbnail should be used
		$rootBatchJob = $dbBatchJob->getRootJob();
		if($rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE)
		{ 
			$thisFlavorHeight = $data->getThumbHeight();
			$thisFlavorBitrate = $data->getThumbBitrate();
			
			$rootBatchJobData = $rootBatchJob->getData();
			if(!$rootBatchJobData->getCreateThumb() || $rootBatchJobData->getThumbBitrate() > $thisFlavorBitrate)
			{
				$ignoreThumbnail = true;
			}
			elseif($rootBatchJobData->getThumbBitrate() == $thisFlavorBitrate && $rootBatchJobData->getThumbHeight() > $thisFlavorHeight)
			{
				$ignoreThumbnail = true;
			}
			else
			{
				$rootBatchJobData->setThumbHeight($thisFlavorHeight);
				$rootBatchJobData->setThumbBitrate($thisFlavorBitrate);
				$rootBatchJob->setData($rootBatchJobData);
				$rootBatchJob->save();
			}
		}
		
		if(!$ignoreThumbnail)
		{
			kLog::log("Saving thumbnail from: " . $data->getThumbPath());
			// creats thumbnail the file sync
			$entry = $dbBatchJob->getEntry();
			kLog::log("Entry duration: " . $entry->getLengthInMsecs());
			if(!$entry->getLengthInMsecs())
			{
				kLog::log("Copy duration from flvor asset: " . $data->getFlavorAssetId());
				$mediaInfo = mediaInfoPeer::retrieveByFlavorAssetId($data->getFlavorAssetId());
				if($mediaInfo)
				{
					kLog::log("Set duration to: " . $mediaInfo->getContainerDuration());
					$entry->setDimensions($mediaInfo->getVideoWidth(), $mediaInfo->getVideoHeight());
					$entry->setLengthInMsecs($mediaInfo->getContainerDuration());
				}
			}
			
			$entry->setThumbnail(".jpg");
			$entry->save();
			$syncKey = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_THUMB);
			kFileSyncUtils::moveFromFile($data->getThumbPath(), $syncKey);
		}
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kPostConvertJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob|BatchJob
	 */
	public static function handlePostConvertFinished(BatchJob $dbBatchJob, kPostConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
		
		if($data->getCreateThumb())
			self::createThumbnail($dbBatchJob, $data);
		
		$currentFlavorAsset = kBusinessPostConvertDL::handleFlavorReady($dbBatchJob, $data->getFlavorAssetId());
		kBusinessPostConvertDL::handleConvertFinished($dbBatchJob, $currentFlavorAsset);	
		
		// TODO - remove after event manager is implemented
		$externalStorages = StorageProfilePeer::retrieveAutomaticByPartnerId($dbBatchJob->getPartnerId());
		foreach($externalStorages as $externalStorage)
		{
			kLog::log("Checking storage [" . $externalStorage->getId() . "]");
			kLog::log("Storage trigger [" . $externalStorage->getTrigger() . "]");
			if(
				$externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_FLAVOR_READY
				||
					(
						$externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_MODERATION_APPROVED
						&&
						$dbBatchJob->getEntry()->getModerationStatus() == entry::ENTRY_MODERATION_STATUS_APPROVED
					)
				)
			{
				if($currentFlavorAsset)
				{
					kLog::log("Init kStorageExportAction");
					$action = new kStorageExportOperation($currentFlavorAsset);
					$action->setStorageProfile($externalStorage);
					$action->setForce(true);
					$action->execute();
				}
			}
		}
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kPullJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handlePullFailed(BatchJob $dbBatchJob, kPullJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		$rootBatchJob = $dbBatchJob->getRootJob();
		if($rootBatchJob)
			$rootBatchJob = kJobsManager::failBatchJob($rootBatchJob, "Pull job " . $dbBatchJob->getId() . " failed");
			
		return $dbBatchJob; 	
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kPullJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob|BatchJob
	 */
	public static function handlePullFinished(BatchJob $dbBatchJob, kPullJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
		
		// creates a child extract meida job
		$extractMediaData = new kExtractMediaJobData();
		$extractMediaData->setSrcFileSyncLocalPath($data->getDestFileLocalPath());
		kJobsManager::addJob($dbBatchJob->createChild(), $extractMediaData, BatchJob::BATCHJOB_TYPE_EXTRACT_MEDIA, mediaInfo::ASSET_TYPE_FLAVOR_INPUT);		
		
		return $dbBatchJob; 	
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kBulkUploadJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleBulkUploadPending(BatchJob $dbBatchJob, kBulkUploadJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		// create file sunc
		$syncKey = $dbBatchJob->getSyncKey(BatchJob::FILE_SYNC_BATCHJOB_SUB_TYPE_BULKUPLOADCSV);
		kFileSyncUtils::file_put_contents($syncKey, file_get_contents($data->getCsvFilePath()));

		// sets the pointer to the csv file
		$data->setCsvFilePath(kFileSyncUtils::getLocalFilePathForKey($syncKey));
		
		// save the data to the db
		$dbBatchJob->setData($data);
		$dbBatchJob->save();
		
		return $dbBatchJob; 	
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kStorageExportJobData $data
	 * @return BatchJob
	 */
	public static function handleStorageExportFinished(BatchJob $dbBatchJob, kStorageExportJobData $data)
	{
		kLog::log("Export to storage finished for sync file[" . $data->getSrcFileSyncId() . "]");
		
		$fileSync = FileSyncPeer::retrieveByPK($data->getSrcFileSyncId());
		$fileSync->setStatus(FileSync::FILE_SYNC_STATUS_READY);
		$fileSync->save();
		
		if($dbBatchJob->getJobSubType() != StorageProfile::STORAGE_KALTURA_DC)
		{
			$partner = $dbBatchJob->getPartner();
			if($partner && $partner->getStorageDeleteFromKaltura())
			{
				$syncKey = kFileSyncUtils::getKeyForFileSync($fileSync);
				kFileSyncUtils::deleteSyncFileForKey($syncKey, false, true);
			}
		}
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kStorageExportJobData $data
	 * @return BatchJob
	 */
	public static function handleStorageExportFailed(BatchJob $dbBatchJob, kStorageExportJobData $data)
	{
		kLog::log("Export to storage failed for sync file[" . $data->getSrcFileSyncId() . "]");
		
		$fileSync = FileSyncPeer::retrieveByPK($data->getSrcFileSyncId());
		$fileSync->setStatus(FileSync::FILE_SYNC_STATUS_ERROR);
		$fileSync->save();
		
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertProfileJobData $data
	 * @param int $entryStatus
	 * @param BatchJob $twinJob
	 * @return BatchJob
	 */
	public static function handleConvertProfilePending(BatchJob $dbBatchJob, kConvertProfileJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Convert Profile created, with input file: " . $data->getInputFileSyncLocalPath());
		
		// creates extract media job
		kJobsManager::addExtractMediaJob($dbBatchJob, $data->getInputFileSyncLocalPath(), $data->getFlavorAssetId(), mediaInfo::ASSET_TYPE_ENTRY_INPUT);
		
		// mark the job as almost done
		$dbBatchJob = kJobsManager::updateBatchJob($dbBatchJob, BatchJob::BATCHJOB_STATUS_ALMOST_DONE);
			
		return $dbBatchJob; 	
	}
	
	public static function handleConvertProfileFailed(BatchJob $dbBatchJob, kConvertProfileJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Convert Profile failed");
		
		kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_ERROR_CONVERTING);
		
		$originalflavorAsset = flavorAssetPeer::retrieveOriginalByEntryId($dbBatchJob->getEntryId());
		if($originalflavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_DELETED)
			$originalflavorAsset->setDeletedAt(time());
		
		return $dbBatchJob; 	
	}
	
	public static function handleConvertProfileFinished(BatchJob $dbBatchJob, kConvertProfileJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kLog::log("Convert Profile finished");
		
		$originalflavorAsset = flavorAssetPeer::retrieveOriginalByEntryId($dbBatchJob->getEntryId());
		if($originalflavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_DELETED)
			$originalflavorAsset->setDeletedAt(time());
		
		kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_READY);
		
		// TODO - remove after event manager is implemented
		$externalStorages = StorageProfilePeer::retrieveAutomaticByPartnerId($dbBatchJob->getPartnerId());
		foreach($externalStorages as $externalStorage)
		{
			kLog::log("Checking storage [" . $externalStorage->getId() . "]");
			kLog::log("Storage trigger [" . $externalStorage->getTrigger() . "]");
			if($externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_CONVERT_FINISHED)
			{
				kLog::log("Init kStorageExportAction");
				$action = new kStorageExportOperation($dbBatchJob);
				$action->setStorageProfile($externalStorage);
				$action->execute();
			}
		
			if(
				$externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_FLAVOR_READY
				||
					(
						$externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_MODERATION_APPROVED
						&&
						$dbBatchJob->getEntry()->getModerationStatus() == entry::ENTRY_MODERATION_STATUS_APPROVED
					)
				)
			{
				$sourceFlavor = flavorAssetPeer::retrieveOriginalReadyByEntryId($dbBatchJob->getEntryId());
				if($sourceFlavor)
				{
					kLog::log("Init kStorageExportAction");
					$action = new kStorageExportOperation($sourceFlavor);
					$action->setStorageProfile($externalStorage);
					$action->execute();
				}
			}
		}
		
		return $dbBatchJob; 	
	}
	
	public static function handleRemoteConvertPending(BatchJob $dbBatchJob, kRemoteConvertJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		// creates pull job
		$pullData = new kPullJobData();
		$pullData->setSrcFileUrl($data->getSrcFileUrl()); 
		kJobsManager::addJob($dbBatchJob->createChild(false), $pullData, BatchJob::BATCHJOB_TYPE_PULL);
		
		// mark the job as almost done
		$dbBatchJob = kJobsManager::updateBatchJob($dbBatchJob, BatchJob::BATCHJOB_STATUS_ALMOST_DONE);
			
		return $dbBatchJob; 	
	}

	public static function handleBulkDownloadPending(BatchJob $dbBatchJob, kBulkDownloadJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		$entryIds = explode(',', $data->getEntryIds());
		$flavorParamsId = $data->getFlavorParamsId();
		$jobIsFinished = true;
		foreach($entryIds as $entryId)
		{
			$entry = entryPeer::retrieveByPK($entryId);
			if (is_null($entry))
			{
				kLog::log("Entry id [$entryId] not found.");
			}
			else
			{
				switch($entry->getType())
				{
					case entry::ENTRY_TYPE_MEDIACLIP:
						if (in_array(
							$entry->getMediaType(), 
							array(entry::ENTRY_MEDIA_TYPE_VIDEO, entry::ENTRY_MEDIA_TYPE_AUDIO)))
						{
							$flavorAsset = flavorAssetPeer::retrieveByEntryIdAndFlavorParams($entryId, $flavorParamsId);
							if ($flavorAsset && $flavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_READY)
							{
								$syncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
								$downloadUrl = $flavorAsset->getDownloadUrl();
								
								$localPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
								$downloadUrl = $flavorAsset->getDownloadUrl();
								
								$notificationData = array(
									"puserId" => $entry->getPuserId(),
									"entryId" => $entry->getId(),
									"entryIntId" => $entry->getIntId(),
									"entryVersion" => $entry->getVersion(),
									"fileFormat" => $flavorAsset->getFileExt(),
					//				"email" => '',
									"archivedFile" => $localPath,
									"downoladPath" => $localPath,
									"conversionQuality" => $entry->getConversionQuality(),
									"downloadUrl" => $downloadUrl,
								);
								
								$extraData = array(
									"data" => json_encode($notificationData),
									"partner_id" => $entry->getPartnerId(),
									"puser_id" => $entry->getPuserId(),
									"entry_id" => $entry->getId(),
									"entry_int_id" => $entry->getIntId(),
									"entry_version" => $entry->getVersion(),
									"file_format" => $flavorAsset->getFileExt(),
					//				"email" => '',
									"archived_file" => $localPath,
									"downolad_path" => $localPath,
									"target" => $localPath,
									"conversion_quality" => $entry->getConversionQuality(),
									"download_url" => $downloadUrl,
									"status" => $entry->getStatus(),
									"abort" => $dbBatchJob->getAbort(),
									"progress" => $dbBatchJob->getProgress(),
									"message" => $dbBatchJob->getMessage(),
									"description" => $dbBatchJob->getDescription(),
									"updates_count" => $dbBatchJob->getUpdatesCount(),
									"job_type" => BatchJob::BATCHJOB_TYPE_DOWNLOAD,
									"status" => BatchJob::BATCHJOB_STATUS_FINISHED,
									"progress" => 100,
									"debug" => __LINE__,
								);
								
								myNotificationMgr::createNotification(kNotificationJobData::NOTIFICATION_TYPE_BATCH_JOB_SUCCEEDED, $dbBatchJob , $dbBatchJob->getPartnerId() , null , null , 
										$extraData, $entryId );
							}
							else
							{
								$err = "";
								kBusinessPreConvertDL::decideAddEntryFlavor($dbBatchJob, $entry->getId(), $flavorParamsId, $err);
								$jobIsFinished = false;
							}
						}
						break;
						
					case entry::ENTRY_TYPE_SHOW:
						
						// if flavor params == SOURCE, or no format defined for flavor params, default to 'flv'
						$flattenFormat = '';
						if ($flavorParamsId != 0) {
							$flattenFormat = flavorParamsPeer::retrieveByPK($flavorParamsId)->getFormat(); 
						}
						if (strlen(trim($flattenFormat)) == 0) {
							$flattenFormat = 'flv'; 
						}
						
						myBatchFlattenClient::addJob($data->getPuserId(), $entry, $entry->getVersion(), $flattenFormat);
						
						// TODO: Change the flatten to API V3
//						$dbFlattenJob = new BatchJob();
//						$flattenData = new kFlattenJobData();
//						kJobsManager::addJob($dbFlattenJob, $flattenData, BatchJob::BATCHJOB_TYPE_FLATTEN);
						$jobIsFinished = false;
						break;
				}
			}
		}
		
		if ($jobIsFinished)
		{
			// mark the job as finished
			$dbBatchJob = kJobsManager::updateBatchJob($dbBatchJob, BatchJob::BATCHJOB_STATUS_FINISHED);
		}
		else
		{
			// mark the job as almost done
			$dbBatchJob = kJobsManager::updateBatchJob($dbBatchJob, BatchJob::BATCHJOB_STATUS_ALMOST_DONE);
		}
		
		return $dbBatchJob; 	
	}
	
	public static function handleProvisionProvideFinished(BatchJob $dbBatchJob, kProvisionJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		$entry = $dbBatchJob->getEntry();
		$entry->setStreamUsername($data->getEncoderUsername());
		$entry->setStreamUrl($data->getRtmp());
		$entry->setStreamRemoteId($data->getStreamID());
		$entry->setStreamRemoteBackupId($data->getBackupStreamID());
	
		kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_READY);
		return $dbBatchJob; 	
	}
	
	public static function handleProvisionProvideFailed(BatchJob $dbBatchJob, kProvisionJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_ERROR_CONVERTING);
		return $dbBatchJob; 	
	}
	
	public static function handleBulkDownloadFinished(BatchJob $dbBatchJob, kBulkDownloadJobData $data, $entryStatus, BatchJob $twinJob = null)
	{
		if($dbBatchJob->getAbort())
			return $dbBatchJob;
			
		$partner = PartnerPeer::retrieveByPK($dbBatchJob->getPartnerId());
		if (!$partner)
		{
			kLog::log("Partner id [".$dbBatchJob->getPartnerId()."] not found, not sending mail");
			return $dbBatchJob;
		}
		
		$adminName = $partner->getAdminName();
		
		$entryIds = explode(",", $data->getEntryIds());
		$flavorParamsId = $data->getFlavorParamsId();
		$links = array();
		foreach($entryIds as $entryId)
		{
			$entry = entryPeer::retrieveByPK($entryId);
			if (is_null($entry))
				continue;
				
			$link = null;
			switch($entry->getType())
			{
				case entry::ENTRY_TYPE_MEDIACLIP:
					switch($entry->getMediaType())
					{
						case entry::ENTRY_MEDIA_TYPE_VIDEO:
						case entry::ENTRY_MEDIA_TYPE_AUDIO:
							$flavorAsset = flavorAssetPeer::retrieveByEntryIdAndFlavorParams($entryId, $flavorParamsId);
							if ($flavorAsset)
								$link = $flavorAsset->getDownloadUrl();
							break;
						case entry::ENTRY_MEDIA_TYPE_IMAGE:
							$link = $entry->getRawDownloadUrl(); 
							break;
					}
					break;
				case entry::ENTRY_TYPE_SHOW: 
					$flavorAsset = flavorAssetPeer::retrieveByEntryId($entryId, $flavorParamsId);
					if ($flavorAsset)
						$link = $flavorAsset->getDownloadUrl();
					break;
			}
			
			if (is_null($link))
				$link = "Failed to prepare";
			else
				$link = '<a href="'.$link.'">Download</a>';
				
			$links[] = $entry->getName() . " - " . $link;
		}
		$linksHtml = implode("<br />", $links);
		
		// add mail job
		$jobData = new kMailJobData();
		$jobData->setIsHtml(true);
		$jobData->setMailPriority(kMailJobData::MAIL_PRIORITY_NORMAL);
		$jobData->setStatus(kMailJobData::MAIL_STATUS_PENDING);
		if (count($links) <= 1)
			$jobData->setMailType(62);
		else
			$jobData->setMailType(63);
		$jobData->setBodyParamsArray(array($adminName, $linksHtml));
		
	 	$jobData->setFromEmail(kConf::get("batch_download_video_sender_email"));
	 	$jobData->setFromName(kConf::get("batch_download_video_sender_name"));
		$jobData->setRecipientEmail($partner->getAdminEmail());
		$jobData->setSubjectParamsArray(array());
		
		kJobsManager::addJob($dbBatchJob->createChild(), $jobData, BatchJob::BATCHJOB_TYPE_MAIL, $jobData->getMailType());
		
		return $dbBatchJob;
	}
}