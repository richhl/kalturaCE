<?php
/**
 * batch service lets you handle different batch process from remote machines.
 * As oppesed to other ojects in the system, locking mechanism is critical in this case.
 * For this reason the GetExclusiveXXX , UpdateExclusiveXXX and FreeExclusiveXXX actions are important for the system's intergity.
 * In general - updating batch object should be done only using the UpdateExclusiveXXX which in turn can be called only after 
 * acuiring a batch objet properly (using  GetExclusiveXXX).
 * If an object was aquired and should be returned to the pool in it's initial state - use the FreeExclusiveXXX action 
 *
 *	Terminology:
 *		LocationId
 *		ServerID
 *		ParternGroups 
 * 
 * @service batch
 * @package api
 * @subpackage services
 */
class BatchService extends KalturaBaseService 
{
	// use initService to add a peer to the partner filter
	/**
	 * @ignore
	 */
	public function initService ($partnerId , $puserId , $ksStr , $serviceName , $action )
	{
		parent::initService ($partnerId , $puserId , $ksStr , $serviceName , $action );
		parent::applyPartnerFilterForClass ( new BatchJobPeer() ); 	
		parent::applyPartnerFilterForClass ( new notificationPeer() );
	}
	
	
// --------------------------------- ImportJob functions 	--------------------------------- //
	/**
	 * batch addImportJob action allows to add a BatchJob of type IMPORT 
	 * 
	 * @action addImportJob
	 * @param KalturaBatchJob $importJob  
	 * @return KalturaBatchJob 
	 */
	function addImportJobAction ( KalturaBatchJob $importJob )
	{
		// make sure it's of type IMPORT
		$importJob->jobType = KalturaBatchJobType::IMPORT;
		return $this->addBatchJob ( $importJob );
	}
	
	/**
	 * batch getExclusiveImportJob action allows to get a BatchJob of type IMPORT 
	 * 
	 * @action getExclusiveImportJobs
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param string $partnerGroups Set of rules for how to prefer some partner's jobs over others  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusiveImportJobsAction( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups )
	{
		return $this->getExclusiveBatchJobs ( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups  , BatchJob::BATCHJOB_TYPE_IMPORT );
	}

	
	/**
	 * batch updateExclusiveImportJob action updates a BatchJob of type IMPORT that was claimed using the getExclusiveImportJobs
	 * 
	 * @action updateExclusiveImportJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism
	 * @param KalturaBatchJob $importJob
	 * @param KalturaEntryStatus $entryStatus Optional parameter if the entry of the batch should change 
	 * @return KalturaBatchJob 
	 */
	function updateExclusiveImportJobAction( $id ,$processorLocation , $pocessorName , KalturaBatchJob $importJob ,
		 $entryStatus = null)
	{
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromBatchJob ( $this->updateExclusiveBatchJob( $id , $processorLocation , $pocessorName , $importJob->toBatchJob() , $entryStatus ) );
	}

	
	/**
	 * batch freeExclusiveImportJob action frees a BatchJob of type IMPORT that was claimed using the getExclusiveImportJobs
	 * 
	 * @action freeExclusiveImportJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @return KalturaBatchJob 
	 */
	function freeExclusiveImportJobAction( $id ,$processorLocation , $pocessorName )
	{
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromBatchJob ( $this->freeExclusiveBatchJob( $id , $processorLocation , $pocessorName ) );
	}	
// --------------------------------- ImportJob functions 	--------------------------------- //

	
	
// --------------------------------- PreConvertJob functions 	--------------------------------- //
	/**
	 * batch addPreConvertJob action allows to add a BatchJob of type PRECONVERT 
	 * 
	 * @action addPreConvertJob
	 * @param KalturaBatchJob $preConvertJob  
	 * @return KalturaBatchJob 
	 */
	function addPreConvertJobAction ( KalturaBatchJob $preConvertJob )
	{
		// make sure it's of type PRECONVERT
		$preConvertJob->jobType = KalturaBatchJobType::PRECONVERT;
		return $this->addBatchJob ( $preConvertJob );
	}
	
	/**
	 * batch getExclusivePreConvertJob action allows to get a BatchJob of type PRECONVERT 
	 * 
	 * @action getExclusivePreConvertJobs
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param string $partnerGroups Set of rules for how to prefer some partner's jobs over others  
	 * @return KalturaBatchJobArray 
	 */
	function getExclusivePreConvertJobsAction( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups )
	{
		return $this->getExclusiveBatchJobs ( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups  , BatchJob::BATCHJOB_TYPE_PRECONVERT );
	}

	
	/**
	 * batch updateExclusivePreConvertJob action updates a BatchJob of type PRECONVERT that was claimed using the getExclusivePreConvertJobs
	 * 
	 * @action updateExclusivePreConvertJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism
	 * @param KalturaBatchJob $preCponverJob
	 * @param KalturaEntryStatus $entryStatus Optional parameter if the entry of the batch should change 
	 * @return KalturaBatchJob 
	 */
	function updateExclusivePreConvertJobAction( $id ,$processorLocation , $pocessorName , KalturaBatchJob $preConvertJob ,
		 $entryStatus = null)
	{
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromBatchJob ( $this->updateExclusiveBatchJob( $id , $processorLocation , $pocessorName , $preConvertJob->toBatchJob() , $entryStatus ) );
	}

	
	/**
	 * batch freeExclusivePreConvertJob action frees a BatchJob of type IMPORT that was claimed using the getExclusivePreConvertJobs
	 * 
	 * @action freeExclusivePreConvertJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @return KalturaBatchJob 
	 */
	function freeExclusivePreConvertJobAction( $id ,$processorLocation , $pocessorName )
	{
		$batchJob = new KalturaBatchJob(); // start from blank
		return $batchJob->fromBatchJob ( $this->freeExclusiveBatchJob( $id , $processorLocation , $pocessorName ) );
	}	
// --------------------------------- ImportJob functions 	--------------------------------- //
	
// --------------------------------- Notification functions 	--------------------------------- //	
	/**
	 * batch createNotification action allows to create a Notification for a specific object
	 * Will not return any value 
	 * 
	 * @action createNotification
	 * @param KalturaNotification $notificationJob  
	 */
	function createNotificationAction ( KalturaNotification $notificationJob )
	{
		$dbNotificationJob = $notificationJob->toNotification();
		
		$obj = null;
		if ( $notificationJob->objectType == KalturaNotificationObjectType::ENTRY )
		{
			$obj = entryPeer::retrieveByPK( $notificationJob->objectId );
		}
		else
		{
		}
		
		if ( $obj === null )
		{
			throw new KalturaAPIException ( APIErrors::ERROR_CREATING_NOTIFICATION , $notificationJob->objectType );
		}
		myNotificationMgr::createNotification( $notificationJob->type , $obj , $this->getPartnerId() );
	}
	
	/**
	 * batch getExclusiveNotificationJob action allows to get a Notification object 
	 * 
	 * @action getExclusiveNotificationJobs
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param string $partnerGroups Set of rules for how to prefer some partner's jobs over others  
	 * @return KalturaBatchGetExclusiveNotificationJobsResponse 
	 */
	function getExclusiveNotificationJobsAction( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups )
	{
		$c = new Criteria();
		
		// get either notifications with status PENDING or ones that should be re-sent and are XXX seconds old
		$secsBetweeRetry = 180 ;// kConf::get ( "seconds_between_retry_notify" );
		
		// add to the criteria all the notifications of status PENDING or those of status SHOULD_RESEND that were updated several seconds ago 
		// this is to prevent attacking the partner's notification url with notification retries

		// TODO - maybe skip this and handle the notifications retries in the lock mechanism !?!?
		 
		$relevantTime = time() + $secsBetweeRetry;
		$queryRelevantTime =  date('Y-m-d H:i:s', $relevantTime);
		$resentCrit = $c->getNewCriterion( notificationPeer::STATUS , 
			array ( KalturaNotificationStatus::SHOULD_RESEND , ) , Criteria::IN );
		$resentCrit->addAnd ( $c->getNewCriterion( notificationPeer::UPDATED_AT ,  $queryRelevantTime , Criteria::LESS_EQUAL ) );
		$crit = $c->getNewCriterion( notificationPeer::STATUS , 
			array ( KalturaNotificationStatus::PENDING ,
					KalturaNotificationStatus::QUEUED ) , Criteria::IN );
		$crit->addOr ( $resentCrit );
		$c->add ( $crit );
		
//		$c->addAscendingOrderByColumn ( notificationPeer::OBJECT_ID ); // collect all notifications for a specific object in one bulk
		$c->addAscendingOrderByColumn ( notificationPeer::CREATED_AT );
					
		$peer = new notificationPeer();
		
		$list = $this->getExclusiveJobs ( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups , $c , $peer );
		
		$notList = KalturaNotificationArray::fromNotificationArray( $list );

//		return $notList;
		
		$dbPartners = array();
		// Because the notifications need the partner's url and policy of mulriNotifications - we'll send the partner list
		$partnerIds = array();
		foreach ( $notList as $not )
		{
			if ( isset ( $partnerIds[$not->partnerId])) continue;
			$dbPartner = PartnerPeer::retrieveByPK( $not->partnerId );
			$dbPartners[] = $dbPartner;
			$partnerIds[$not->partnerId] = $not->partnerId;
		}
		
		
		$response = new KalturaBatchGetExclusiveNotificationJobsResponse ();
		$response->notifications = $notList;
		$response->partners = KalturaPartnerArray::fromPartnerArray( $dbPartners ) ;

		return $response;
	}

	
	/**
	 * batch updateExclusiveNotificationJob action updates a Notification that was claimed using the getExclusiveNotificationJobs
	 * 
	 * @action updateExclusiveNotificationJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism
	 * @param KalturaNotification $notificationJob
	 * @return KalturaNotification 
	 */
	function updateExclusiveNotificationJobAction( $id ,$processorLocation , $pocessorName , KalturaNotification $notificationJob  )
	{
		
		$peer = new notificationPeer();
		$dbNotificaiton = $this->updateExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer , $notificationJob->toNotification()  );
		$notificationJob->fromNotification ( $dbNotificaiton );
		return $notificationJob;
	}

	
	/**
	 * batch freeExclusiveNotificationJob action frees a Notification that was claimed using the getExclusiveNotificationJobs
	 * 
	 * @action freeExclusiveNotificationJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism
	 * @param KalturaNotification $notificationJob  
	 * @return KalturaBatchJob 
	 */
	function freeExclusiveNotificationJobAction( $id ,$processorLocation , $pocessorName , KalturaNotification $notificationJob = null )
	{
		$peer = new notificationPeer();
		$notificationJob = new KalturaNotification(); // start from blank
		if ( $notificationJob )
		{
			// update the status of the notification
//	/		$dbNotificaiton = $this->updateExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer , $notificationJob->toNotification()  );
		}
		return $notificationJob->fromNotification ( $this->freeExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer ));
	}	
// --------------------------------- Notification functions 	--------------------------------- //


	
// --------------------------------- MailJob functions 	--------------------------------- //	
	/**
	 * batch addMailJob action allows to add a KalturaMailJob
	 * Will not return any value 
	 * 
	 * @action addMailJob
	 * @param KalturaMailJob $mailJob  
	 */
	function addMailJobAction ( KalturaMailJob $mailJob )
	{
		$dbMailJob = $mailJob->toMailJob();
		$dbMailJob->setPartnerId ( $this->getPartnerId() );
		$dbMailJob->save();
		
		$mailJob = new KalturaMailJob(); // start from blank
		$mailJob->fromMailJob ( $dbMailJob );
		
		return $mailJob;		
	}
	
	/**
	 * batch getExclusiveMailJobs action allows to add a MailJob object
	 * 
	 * @action getExclusiveMailJobs
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @param int $maxExecutionTime The maximum time in seconds the job reguarly take. Is used for the locking mechanism when determining an unexpected termination of a batch-process.
	 * @param int $numberOfJobs The maximum number of jobs to return. 
	 * @param string $partnerGroups Set of rules for how to prefer some partner's jobs over others  
	 * @return KalturaMailJobArray 
	 */
	function getExclusiveMailJobsAction( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups )
	{
		$c = new Criteria();

		$peer = new MailJobPeer();
		
		$list = $this->getExclusiveJobs ( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups , $c , $peer );
		$mailJobList = KalturaMailJobArray::fromMailJobArray( $list );
		return $mailJobList;
	}

	
	/**
	 * batch updateExclusiveMailJob action updates a MailJob that was claimed using the getExclusiveMailJobsAction
	 * 
	 * @action updateExclusiveMailJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism
	 * @param KalturaMailJob $mailJob
	 * @return KalturaMailJob 
	 */
	function updateExclusiveMailJobAction( $id ,$processorLocation , $pocessorName , KalturaMailJob $mailJob  )
	{
		// TODO - fix the update !!
		$peer = new MailJobPeer();
		$bdMailJob =  $this->updateExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer , $mailJob->toMailJob() );
		$mailJob->fromMailJob( $bdMailJob );
		return $mailJob;
	}

	
	/**
	 * batch freeExclusiveMailJob action frees a MailJob that was claimed using the getExclusiveMailJobsAction
	 * 
	 * @action freeExclusiveMailJob
	 * @param int $id The id of the job to free
	 * @param string $processorLocation The location name from which the batch-process is running. Is used for the locking mechanism  
	 * @param string $pocessorName The name of the batch-process. Is used for the locking mechanism 
	 * @return KalturaMailJob 
	 */
	function freeExclusiveMailJobAction( $id ,$processorLocation , $pocessorName )
	{
		$mailJobJob = new KalturaMailJob(); // start from blank
		$peer = new MailJobPeer();
		return $mailJobJob->fromMailJob( $this->freeExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer ));
	}	
// --------------------------------- MailJob functions 	--------------------------------- //
	
		
// --------------------------------- private functions 	--------------------------------- //
	// common to all the jobs using the BatchJob table 
	private function addBatchJob ( KalturaBatchJob $batchJob  )
	{
		$dbBatchJob = $batchJob->toBatchJob();
		$dbBatchJob->setPartnerId ( $this->getPartnerId() );
		$dbBatchJob->save();
		
		$batchJob = new KalturaBatchJob(); // start from blank
		$batchJob->fromBatchJob( $dbBatchJob );
		
		return $batchJob;		
	}

	// common to all the jobs using the BatchJob table
	private function listBatchJobs ( KalturaBatchJobFilter $filter=null , KalturaFilterPager $pager=null)
	{
		if (!$filter)
			$filter = new KalturaBatchJobFilter();
		$batchJobFilter = new BatchJobFilter ();
		$filter->toObject( $batchJobFilter );
		
		$c = new Criteria();
		$batchJobFilter->attachToCriteria( $c );
		if ( $pager )	$pager->attachToCriteria( $c );
		
		$list = batchJObPeer::doSelect( $c );
		
		$newList = KalturaBatchJobArray::fromUiConfArray( $list );
		
		return $newList;
	}
		
	// common to all the jobs using the BatchJob table 
	private function getExclusiveBatchJobs( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups , $job_type )
	{
		$c = new Criteria();
		$c->add ( BatchJobPeer::JOB_TYPE , $job_type );
		$peer = new BatchJobPeer();
		
		$list = $this->getExclusiveJobs ( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups , $c , $peer );
		
		$batchJobArray = new KalturaBatchJobArray(); // start from blank
		
		return $batchJobArray->fromBatchJobArray( $list ); 
	}	
	/*
	 * This is the actual worker function that returns the IExclusiveLock object using the IExclusiveLockPeer, combining the locking mechanism with the parternGroups filters
	 */
	private function getExclusiveJobs ( $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs , $partnerGroups , 
		Criteria $c , IExclusiveLockPeer $peer )
	{
		$partnerGroupsObj = new myPartnerGroups( $partnerGroups );
		
		$cloned_c = clone $c;
		
		$res = null;
		while ( $partnerGroupsObj->applyPartnerGroupToCriteria ( $cloned_c , $peer ) )
		{
			$res = myDbExclusiveLock::getExclusive( $cloned_c, $peer , $processorLocation , $pocessorName , $maxExecutionTime , $numberOfJobs );
			if ( $res ) break;
			$cloned_c = clone $c;
		}
	
//		$res = myDbExclusiveLock::getExclusive( $cloned_c, $peer , $locationId , $serverId , $maxExecutionTime , $numberOfJobs );
		return $res;
	}
	

	// common to all the jobs using the BatchJob table 
	private function updateExclusiveBatchJob ( $id , $processorLocation , $pocessorName , BatchJob $dbBatchJob , $entryStatus = null )
	{
		$dbBatchJob->setJobType ( null );
		$peer = new BatchJobPeer();
		$res = $this->updateExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer , $dbBatchJob );
		if ( $entryStatus )
		{
			$entry = $dbBatchJob->getEntry() ;
			if ( $entry )
			{
				$entry->setStatus ( $entryStatus )	;
				$entry->save();
			}
		}
		return $res;
	}		
	
	/*
	 * This is the actual worker function that updates the IExclusiveLock object using the IExclusiveLockPeer
	 */
	private function updateExclusiveJob ( $id , $processorLocation , $pocessorName ,  IExclusiveLockPeer $peer , IExclusiveLock $dbBatchJob )
	{
		$res = myDbExclusiveLock::updateExclusive( $id , $peer , $processorLocation , $pocessorName , $dbBatchJob );
		return $res;
	}	

	
	// common to all the jobs using the BatchJob table 
	private function freeExclusiveBatchJob ( $id , $processorLocation , $pocessorName  )
	{
		$peer = new BatchJobPeer();
		return $this->freeExclusiveJob ( $id , $processorLocation , $pocessorName ,  $peer );
	}		
	
	/*
	 * This is the actual worker function that frees the IExclusiveLock object using the IExclusiveLockPeer
	 */
	private function freeExclusiveJob ( $id , $processorLocation , $pocessorName ,  IExclusiveLockPeer $peer , $pendingStatus = null )
	{
		$res = myDbExclusiveLock::freeExclusive( $id , $peer , $processorLocation , $pocessorName );
		return $res;
	}	
	
	
// --------------------------------- private functions 	--------------------------------- //	
	
	

}
?>