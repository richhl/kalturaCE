<?php
require_once("bootstrap.php");
/**
 * Distributes kaltura entries to remote destination  
 *
 * @package plugins.contentDistribution 
 * @subpackage Scheduler.Distribute
 */
class KAsyncDistributeEnable extends KAsyncDistribute
{
	/**
	 * @return number
	 */
	public static function getType()
	{
		return KalturaBatchJobType::DISTRIBUTION_ENABLE;
	}
	
	/* (non-PHPdoc)
	 * @see KBatchBase::init()
	 */
	protected function init()
	{
		$this->saveQueueFilter(self::getType());
	}
	
	/* (non-PHPdoc)
	 * @see KAsyncDistribute::saveEmptyQueue()
	 */
	protected function saveEmptyQueue()
	{
		$this->saveSchedulerQueue(self::getType());
	}
	
	/* (non-PHPdoc)
	 * @see KAsyncDistribute::getExclusiveDistributeJobs()
	 */
	public function getExclusiveDistributeJobs()
	{
		return $this->kClient->contentDistributionBatch->getExclusiveDistributionEnableJobs($this->getExclusiveLockKey(), $this->taskConfig->maximumExecutionTime, $this->taskConfig->maxJobsEachRun, $this->getFilter());
	}
	
	/* (non-PHPdoc)
	 * @see KBatchBase::updateExclusiveJob()
	 */
	protected function updateExclusiveJob($jobId, KalturaBatchJob $job, $entryStatus = null)
	{
		return $this->kClient->contentDistributionBatch->updateExclusiveDistributionEnableJob($jobId, $this->getExclusiveLockKey(), $job, $entryStatus);
	}
	
	/* (non-PHPdoc)
	 * @see KBatchBase::freeExclusiveJob()
	 */
	protected function freeExclusiveJob(KalturaBatchJob $job)
	{
		$resetExecutionAttempts = false;
		if($job->status == KalturaBatchJobStatus::ALMOST_DONE)
			$resetExecutionAttempts = true;
	
		$response = $this->kClient->contentDistributionBatch->freeExclusiveDistributionEnableJob($job->id, $this->getExclusiveLockKey(), $resetExecutionAttempts);
		
		KalturaLog::info("Queue size: $response->queueSize sent to scheduler");
		$this->saveSchedulerQueue(self::getType(), $response->queueSize);
		
		return $response->job;
	}
	
	/* (non-PHPdoc)
	 * @see KAsyncDistribute::getDistributionEngine()
	 */
	protected function getDistributionEngine($providerType, KalturaDistributionJobData $data)
	{
		return DistributionEngine::getEngine('IDistributionEngineEnable', $providerType, $this->getClient(), $this->taskConfig, $data);
	}
	
	/* (non-PHPdoc)
	 * @see KAsyncDistribute::execute()
	 */
	protected function execute(KalturaDistributionJobData $data)
	{
		return $this->engine->enable($data);
	}
}