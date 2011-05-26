<?php
/**
 * @service contentDistributionBatch
 * @package plugins.contentDistribution
 * @subpackage api.services
 */
class ContentDistributionBatchService extends BatchService 
{

	
// --------------------------------- DistributionSubmitJob functions 	--------------------------------- //
	
	/**
	 * batch getExclusiveDistributionSubmitJob action allows to get a BatchJob of type DISTRIBUTION_SUBMIT 
	 * 
	 * @action getExclusiveDistributionSubmitJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveDistributionSubmitJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_SUBMIT);
		return $this->getExclusiveJobsAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}

	
	/**
	 * batch updateExclusiveDistributionSubmitJob action updates a BatchJob of type DISTRIBUTION_SUBMIT that was claimed using the getExclusiveDistributionSubmitJobs
	 * 
	 * @action updateExclusiveDistributionSubmitJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param KalturaBatchJob $job
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveDistributionSubmitJobAction($id ,KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$dbBatchJob = BatchJobPeer::retrieveByPK($id);
		
		// verifies that the job is of the right type
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_SUBMIT);
		if($dbBatchJob->getJobType() != $jobType)
			throw new KalturaAPIException(APIErrors::UPDATE_EXCLUSIVE_JOB_WRONG_TYPE, $id, serialize($lockKey), serialize($job));
	
		$dbBatchJob = kBatchManager::updateExclusiveBatchJob($id, $lockKey->toObject(), $job->toObject($dbBatchJob));
				
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromObject($dbBatchJob);
	}

	
	/**
	 * batch freeExclusiveDistributionSubmitJob action frees a BatchJob of type DistributionSubmit that was claimed using the getExclusiveDistributionSubmitJobs
	 * 
	 * @action freeExclusiveDistributionSubmitJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism
	 * @param bool $resetExecutionAttempts Resets the job execution attampts to zero  
	 * @return KalturaFreeJobResponse 
	 */
	function freeExclusiveDistributionSubmitJobAction($id ,KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_SUBMIT);
		return $this->freeExclusiveJobAction($id ,$lockKey, $jobType, $resetExecutionAttempts);
	}
	
	
	/**
	 * batch getExclusiveAlmostDoneDistributionSubmitJobs action allows to get a BatchJob of type DISTRIBUTION_SUBMIT that wait for remote closure 
	 * 
	 * @action getExclusiveAlmostDoneDistributionSubmitJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveAlmostDoneDistributionSubmitJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_SUBMIT);
		return $this->getExclusiveAlmostDoneAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}
	
// --------------------------------- DistributionSubmitJob functions 	--------------------------------- //
	
	
// --------------------------------- DistributionUpdateJob functions 	--------------------------------- //
	
	/**
	 * batch getExclusiveDistributionUpdateJob action allows to get a BatchJob of type DISTRIBUTION_UPDATE 
	 * 
	 * @action getExclusiveDistributionUpdateJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveDistributionUpdateJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_UPDATE);
		return $this->getExclusiveJobsAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}

	
	/**
	 * batch updateExclusiveDistributionUpdateJob action updates a BatchJob of type DISTRIBUTION_UPDATE that was claimed using the getExclusiveDistributionUpdateJobs
	 * 
	 * @action updateExclusiveDistributionUpdateJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param KalturaBatchJob $job
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveDistributionUpdateJobAction($id ,KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$dbBatchJob = BatchJobPeer::retrieveByPK($id);
		
		// verifies that the job is of the right type
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_UPDATE);
		if($dbBatchJob->getJobType() != $jobType)
			throw new KalturaAPIException(APIErrors::UPDATE_EXCLUSIVE_JOB_WRONG_TYPE, $id, serialize($lockKey), serialize($job));
	
		$dbBatchJob = kBatchManager::updateExclusiveBatchJob($id, $lockKey->toObject(), $job->toObject($dbBatchJob));
				
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromObject($dbBatchJob);
	}

	
	/**
	 * batch freeExclusiveDistributionUpdateJob action frees a BatchJob of type DistributionUpdate that was claimed using the getExclusiveDistributionUpdateJobs
	 * 
	 * @action freeExclusiveDistributionUpdateJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism
	 * @param bool $resetExecutionAttempts Resets the job execution attampts to zero  
	 * @return KalturaFreeJobResponse 
	 */
	function freeExclusiveDistributionUpdateJobAction($id ,KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_UPDATE);
		return $this->freeExclusiveJobAction($id ,$lockKey, $jobType, $resetExecutionAttempts);
	}
	
	
	/**
	 * batch getExclusiveAlmostDoneDistributionUpdateJobs action allows to get a BatchJob of type DISTRIBUTION_UPDATE that wait for remote closure 
	 * 
	 * @action getExclusiveAlmostDoneDistributionUpdateJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveAlmostDoneDistributionUpdateJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_UPDATE);
		return $this->getExclusiveAlmostDoneAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}
	
// --------------------------------- DistributionUpdateJob functions 	--------------------------------- //
	
// --------------------------------- DistributionEnableJob functions 	--------------------------------- //
	
	/**
	 * batch getExclusiveDistributionEnableJob action allows to get a BatchJob of type DISTRIBUTION_ENABLE 
	 * 
	 * @action getExclusiveDistributionEnableJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveDistributionEnableJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_ENABLE);
		return $this->getExclusiveJobsAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}

	
	/**
	 * batch updateExclusiveDistributionEnableJob action updates a BatchJob of type DISTRIBUTION_ENABLE that was claimed using the getExclusiveDistributionEnableJobs
	 * 
	 * @action updateExclusiveDistributionEnableJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param KalturaBatchJob $job
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveDistributionEnableJobAction($id ,KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$dbBatchJob = BatchJobPeer::retrieveByPK($id);
		
		// verifies that the job is of the right type
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_ENABLE);
		if($dbBatchJob->getJobType() != $jobType)
			throw new KalturaAPIException(APIErrors::UPDATE_EXCLUSIVE_JOB_WRONG_TYPE, $id, serialize($lockKey), serialize($job));
	
		$dbBatchJob = kBatchManager::updateExclusiveBatchJob($id, $lockKey->toObject(), $job->toObject($dbBatchJob));
				
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromObject($dbBatchJob);
	}

	
	/**
	 * batch freeExclusiveDistributionEnableJob action frees a BatchJob of type DistributionEnable that was claimed using the getExclusiveDistributionEnableJobs
	 * 
	 * @action freeExclusiveDistributionEnableJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism
	 * @param bool $resetExecutionAttempts Resets the job execution attampts to zero  
	 * @return KalturaFreeJobResponse 
	 */
	function freeExclusiveDistributionEnableJobAction($id ,KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_ENABLE);
		return $this->freeExclusiveJobAction($id ,$lockKey, $jobType, $resetExecutionAttempts);
	}
	
	
	/**
	 * batch getExclusiveAlmostDoneDistributionEnableJobs action allows to get a BatchJob of type DISTRIBUTION_ENABLE that wait for remote closure 
	 * 
	 * @action getExclusiveAlmostDoneDistributionEnableJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveAlmostDoneDistributionEnableJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_ENABLE);
		return $this->getExclusiveAlmostDoneAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}
	
// --------------------------------- DistributionEnableJob functions 	--------------------------------- //
	
// --------------------------------- DistributionDisableJob functions 	--------------------------------- //
	
	/**
	 * batch getExclusiveDistributionDisableJob action allows to get a BatchJob of type DISTRIBUTION_DISABLE 
	 * 
	 * @action getExclusiveDistributionDisableJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveDistributionDisableJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DISABLE);
		return $this->getExclusiveJobsAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}

	
	/**
	 * batch updateExclusiveDistributionDisableJob action updates a BatchJob of type DISTRIBUTION_DISABLE that was claimed using the getExclusiveDistributionDisableJobs
	 * 
	 * @action updateExclusiveDistributionDisableJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param KalturaBatchJob $job
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveDistributionDisableJobAction($id ,KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$dbBatchJob = BatchJobPeer::retrieveByPK($id);
		
		// verifies that the job is of the right type
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DISABLE);
		if($dbBatchJob->getJobType() != $jobType)
			throw new KalturaAPIException(APIErrors::UPDATE_EXCLUSIVE_JOB_WRONG_TYPE, $id, serialize($lockKey), serialize($job));
	
		$dbBatchJob = kBatchManager::updateExclusiveBatchJob($id, $lockKey->toObject(), $job->toObject($dbBatchJob));
				
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromObject($dbBatchJob);
	}

	
	/**
	 * batch freeExclusiveDistributionDisableJob action frees a BatchJob of type DistributionDisable that was claimed using the getExclusiveDistributionDisableJobs
	 * 
	 * @action freeExclusiveDistributionDisableJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism
	 * @param bool $resetExecutionAttempts Resets the job execution attampts to zero  
	 * @return KalturaFreeJobResponse 
	 */
	function freeExclusiveDistributionDisableJobAction($id ,KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DISABLE);
		return $this->freeExclusiveJobAction($id ,$lockKey, $jobType, $resetExecutionAttempts);
	}
	
	
	/**
	 * batch getExclusiveAlmostDoneDistributionDisableJobs action allows to get a BatchJob of type DISTRIBUTION_DISABLE that wait for remote closure 
	 * 
	 * @action getExclusiveAlmostDoneDistributionDisableJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveAlmostDoneDistributionDisableJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DISABLE);
		return $this->getExclusiveAlmostDoneAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}
	
// --------------------------------- DistributionDisableJob functions 	--------------------------------- //
	
// --------------------------------- DistributionDeleteJob functions 	--------------------------------- //
	
	/**
	 * batch getExclusiveDistributionDeleteJob action allows to get a BatchJob of type DISTRIBUTION_DELETE 
	 * 
	 * @action getExclusiveDistributionDeleteJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveDistributionDeleteJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DELETE);
		return $this->getExclusiveJobsAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}

	
	/**
	 * batch updateExclusiveDistributionDeleteJob action updates a BatchJob of type DISTRIBUTION_DELETE that was claimed using the getExclusiveDistributionDeleteJobs
	 * 
	 * @action updateExclusiveDistributionDeleteJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param KalturaBatchJob $job
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveDistributionDeleteJobAction($id ,KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$dbBatchJob = BatchJobPeer::retrieveByPK($id);
		
		// verifies that the job is of the right type
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DELETE);
		if($dbBatchJob->getJobType() != $jobType)
			throw new KalturaAPIException(APIErrors::UPDATE_EXCLUSIVE_JOB_WRONG_TYPE, $id, serialize($lockKey), serialize($job));
	
		$dbBatchJob = kBatchManager::updateExclusiveBatchJob($id, $lockKey->toObject(), $job->toObject($dbBatchJob));
				
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromObject($dbBatchJob);
	}

	
	/**
	 * batch freeExclusiveDistributionDeleteJob action frees a BatchJob of type DistributionDelete that was claimed using the getExclusiveDistributionDeleteJobs
	 * 
	 * @action freeExclusiveDistributionDeleteJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism
	 * @param bool $resetExecutionAttempts Resets the job execution attampts to zero  
	 * @return KalturaFreeJobResponse 
	 */
	function freeExclusiveDistributionDeleteJobAction($id ,KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DELETE);
		return $this->freeExclusiveJobAction($id ,$lockKey, $jobType, $resetExecutionAttempts);
	}
	
	
	/**
	 * batch getExclusiveAlmostDoneDistributionDeleteJobs action allows to get a BatchJob of type DISTRIBUTION_DELETE that wait for remote closure 
	 * 
	 * @action getExclusiveAlmostDoneDistributionDeleteJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveAlmostDoneDistributionDeleteJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DELETE);
		return $this->getExclusiveAlmostDoneAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}
	
// --------------------------------- DistributionDeleteJob functions 	--------------------------------- //
	
// --------------------------------- DistributionFetchReportJob functions 	--------------------------------- //
	
	/**
	 * batch getExclusiveDistributionFetchReportJob action allows to get a BatchJob of type DISTRIBUTION_FETCH_REPORT 
	 * 
	 * @action getExclusiveDistributionFetchReportJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveDistributionFetchReportJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_FETCH_REPORT);
		return $this->getExclusiveJobsAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}

	
	/**
	 * batch updateExclusiveDistributionFetchReportJob action updates a BatchJob of type DISTRIBUTION_FETCH_REPORT that was claimed using the getExclusiveDistributionFetchReportJobs
	 * 
	 * @action updateExclusiveDistributionFetchReportJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param KalturaBatchJob $job
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveDistributionFetchReportJobAction($id ,KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$dbBatchJob = BatchJobPeer::retrieveByPK($id);
		
		// verifies that the job is of the right type
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_FETCH_REPORT);
		if($dbBatchJob->getJobType() != $jobType)
			throw new KalturaAPIException(APIErrors::UPDATE_EXCLUSIVE_JOB_WRONG_TYPE, $id, serialize($lockKey), serialize($job));
	
		$dbBatchJob = kBatchManager::updateExclusiveBatchJob($id, $lockKey->toObject(), $job->toObject($dbBatchJob));
				
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromObject($dbBatchJob);
	}

	
	/**
	 * batch freeExclusiveDistributionFetchReportJob action frees a BatchJob of type DistributionFetchReport that was claimed using the getExclusiveDistributionFetchReportJobs
	 * 
	 * @action freeExclusiveDistributionFetchReportJob
	 * @param int $id The id of the job to free
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism
	 * @param bool $resetExecutionAttempts Resets the job execution attampts to zero  
	 * @return KalturaFreeJobResponse 
	 */
	function freeExclusiveDistributionFetchReportJobAction($id ,KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_FETCH_REPORT);
		return $this->freeExclusiveJobAction($id ,$lockKey, $jobType, $resetExecutionAttempts);
	}
	
	
	/**
	 * batch getExclusiveAlmostDoneDistributionFetchReportJobs action allows to get a BatchJob of type DISTRIBUTION_FETCH_REPORT that wait for remote closure 
	 * 
	 * @action getExclusiveAlmostDoneDistributionFetchReportJobs
	 * @param KalturaExclusiveLockKey $lockKey The unique lock key from the batch-process. Is used for the locking mechanism  
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param KalturaBatchJobFilter $filter Set of rules to fetch only rartial list of jobs  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveAlmostDoneDistributionFetchReportJobsAction(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_FETCH_REPORT);
		return $this->getExclusiveAlmostDoneAction($lockKey, $maxExecutionTime, $numberOfJobs, $filter, $jobType);
	}
	
// --------------------------------- DistributionFetchReportJob functions 	--------------------------------- //

// --------------------------------- Distribution Synchronizer functions 	--------------------------------- //


	
	/**
	 * updates entry distribution sun status in the search engine
	 * 
	 * @action updateSunStatus
	 */
	function updateSunStatusAction()
	{
		// serach all records that their sun status changed to after sunset
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::SUN_STATUS, EntryDistributionSunStatus::AFTER_SUNSET , Criteria::NOT_EQUAL);
		$criteria->add(EntryDistributionPeer::SUNSET, time(), Criteria::GREATER_THAN);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution) // raise the updated events to trigger index in search engine (sphinx)
			kEventsManager::raiseEvent(new kObjectUpdatedEvent($entryDistribution));
		
			
		// serach all records that their sun status changed to after sunrise
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::SUN_STATUS, EntryDistributionSunStatus::BEFORE_SUNRISE);
		$criteria->add(EntryDistributionPeer::SUNRISE, time(), Criteria::GREATER_THAN);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution) // raise the updated events to trigger index in search engine (sphinx)
			kEventsManager::raiseEvent(new kObjectUpdatedEvent($entryDistribution));
	}
	

	/**
	 * creates all required jobs according to entry distribution dirty flags 
	 * 
	 * @action createRequiredJobs
	 */
	function createRequiredJobsAction()
	{
		// serach all records that their next report time arrived
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::NEXT_REPORT, time(), Criteria::LESS_EQUAL);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution)
		{
			$distributionProfile = DistributionProfilePeer::retrieveByPK($entryDistribution->getDistributionProfileId());
			if($distributionProfile)
				kContentDistributionManager::submitFetchEntryDistributionReport($entryDistribution, $distributionProfile);
			else
				KalturaLog::err("Distribution profile [" . $entryDistribution->getDistributionProfileId() . "] not found for entry distribution [" . $entryDistribution->getId() . "]");
		}
		
		
		// serach all records that arrived their sunrise time and requires submittion
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::DIRTY_STATUS, EntryDistributionDirtyStatus::SUBMIT_REQUIRED);
		$criteria->add(EntryDistributionPeer::SUNRISE, time(), Criteria::LESS_EQUAL);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution)
		{
			$distributionProfile = DistributionProfilePeer::retrieveByPK($entryDistribution->getDistributionProfileId());
			if($distributionProfile)
				kContentDistributionManager::submitAddEntryDistribution($entryDistribution, $distributionProfile);
			else
				KalturaLog::err("Distribution profile [" . $entryDistribution->getDistributionProfileId() . "] not found for entry distribution [" . $entryDistribution->getId() . "]");
		}
		
		
		// serach all records that arrived their sunrise time and requires enable
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::DIRTY_STATUS, EntryDistributionDirtyStatus::ENABLE_REQUIRED);
		$criteria->add(EntryDistributionPeer::SUNRISE, time(), Criteria::LESS_EQUAL);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution)
		{
			$distributionProfile = DistributionProfilePeer::retrieveByPK($entryDistribution->getDistributionProfileId());
			if($distributionProfile)
				kContentDistributionManager::submitEnableEntryDistribution($entryDistribution, $distributionProfile);
			else
				KalturaLog::err("Distribution profile [" . $entryDistribution->getDistributionProfileId() . "] not found for entry distribution [" . $entryDistribution->getId() . "]");
		}
		
		
		// serach all records that arrived their sunset time and requires deletion
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::DIRTY_STATUS, EntryDistributionDirtyStatus::DELETE_REQUIRED);
		$criteria->add(EntryDistributionPeer::SUNSET, time(), Criteria::LESS_EQUAL);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution)
		{
			$distributionProfile = DistributionProfilePeer::retrieveByPK($entryDistribution->getDistributionProfileId());
			if($distributionProfile)
				kContentDistributionManager::submitDeleteEntryDistribution($entryDistribution, $distributionProfile);
			else
				KalturaLog::err("Distribution profile [" . $entryDistribution->getDistributionProfileId() . "] not found for entry distribution [" . $entryDistribution->getId() . "]");
		}
		
		
		// serach all records that arrived their sunset time and requires disable
		$criteria = KalturaCriteria::create(EntryDistributionPeer::OM_CLASS);
		$criteria->add(EntryDistributionPeer::DIRTY_STATUS, EntryDistributionDirtyStatus::DISABLE_REQUIRED);
		$criteria->add(EntryDistributionPeer::SUNSET, time(), Criteria::LESS_EQUAL);
		$entryDistributions = EntryDistributionPeer::doSelect($criteria);
		foreach($entryDistributions as $entryDistribution)
		{
			$distributionProfile = DistributionProfilePeer::retrieveByPK($entryDistribution->getDistributionProfileId());
			if($distributionProfile)
				kContentDistributionManager::submitDisableEntryDistribution($entryDistribution, $distributionProfile);
			else
				KalturaLog::err("Distribution profile [" . $entryDistribution->getDistributionProfileId() . "] not found for entry distribution [" . $entryDistribution->getId() . "]");
		}
	}
// --------------------------------- Distribution Synchronizer functions 	--------------------------------- //


	/**
	 * returns absolute valid url for asset file
	 * 
	 * @action getAssetUrl
	 * @param string $assetId
	 * @return string
	 * @throws KalturaErrors::INVALID_OBJECT_ID
	 * @throws KalturaErrors::FLAVOR_ASSET_IS_NOT_READY
	 * @throws KalturaErrors::FLAVOR_ASSET_ID_NOT_FOUND
	 */
	function getAssetUrlAction($assetId)
	{
		assetPeer::resetInstanceCriteriaFilter();
		$asset = assetPeer::retrieveById($assetId);
		if(!$asset)
			throw new KalturaAPIException(KalturaErrors::INVALID_OBJECT_ID, $assetId);
		
		$ext = $asset->getFileExt();
		if(is_null($ext))
			$ext = 'jpg';
			
		$fileName = $asset->getEntryId() . "_" . $asset->getId() . ".$ext";
		
		$syncKey = $asset->getSyncKey(asset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
		if(!kFileSyncUtils::fileSync_exists($syncKey))
			throw new KalturaAPIException(KalturaErrors::FLAVOR_ASSET_IS_NOT_READY, $asset->getId());

		list($fileSync, $local) = kFileSyncUtils::getReadyFileSyncForKey($syncKey, true, false);
		if(!$fileSync)
			throw new KalturaAPIException(KalturaErrors::FLAVOR_ASSET_ID_NOT_FOUND, $asset->getId());
			
		return $fileSync->getExternalUrl();
	}
}
