<?php
//require_once( 'myBatchBase.class.php');

class myBatchSaysmeConvertServer extends myBatchBase
{
	const MAX_NOTIFICATIONS_TO_HANDLE = 300;
	
	const KALTURA_NOTIFICAITON_ERROR_EMAIL = 70;
	
	private static $saysme ;
	private static $curl;
	
	private static $partner_ids; 
	public function myBatchSaysmeConvertServer ( $script_name , $partner_ids = false  )
	{
		$this->script_name = $script_name;
		$this->register( $script_name , $partner_ids );
		
		self::$partner_ids = explode ( "," , $partner_ids );
		SET_CONTEXT ( "SAYSME [$partner_ids]");
	}
	
	public function doConvertLoop()
	{
		self::$saysme = new saysmeProject();
		
		$this->m_config = self::getConfig( 'app_saysme_' );
		
		list ( $sleep_between_cycles ,
		$number_of_times_to_skip_writing_sleeping ) = self::getSleepParams( 'app_saysme_' );

		self::initDb();

		$temp_count = 0;
		while ( true )
		{
			self::exitIfDone();
			try
			{
				$this->doConvert();
			}
			catch ( Exception $ex )
			{
				// TODO - log exceptions !!!
				// try to recover !!
				echo ( $ex );

				self::initDb( true );
				self::failed();
			}


			if ( $temp_count == 0 )
			{
				TRACE ( "Ended conversion. sleeping for a while (" . $sleep_between_cycles .
				" seconds). Will write to the log in (" . ( $sleep_between_cycles * $number_of_times_to_skip_writing_sleeping ) . ") seconds" );
			}

			$temp_count++;
			if ($temp_count >= $number_of_times_to_skip_writing_sleeping ) $temp_count = 0;

			sleep ( $sleep_between_cycles );
		}
	}


	private function doConvert ( $new_first = false )
	{
		clearstatcache();
		
		// get a job to convert
		$c = new Criteria();
		$c->add(BatchJobPeer::DC, kDataCenterMgr::getCurrentDcId() );
		$c->addAnd ( BatchJobPeer::JOB_TYPE , BatchJob::BATCHJOB_TYPE_PROJECT + self::$saysme->getId() );
		$c->addAnd ( BatchJobPeer::STATUS , BatchJob::BATCHJOB_STATUS_PENDING );
		$c->addAscendingOrderByColumn ( BatchJobPeer::CREATED_AT );
		
		$job = BatchJobPeer::doSelectOne( $c );
		if ( !$job ) return;
		
		$job->setStatus( batchjob::BATCHJOB_STATUS_PROCESSING );
		$job->setProgress ( 1 );
		$job->save();
		
		$entry_id = $job->getEntryId();
		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry )
		{
			$this->writeToLog ( "Error in job [" . $job->getId() . "]. Cannot find entry [$entry_id]" );
			return;	
		}

		$job_data_str = $job->getData();
		$saysme_job_data = unserialize ( $job_data_str );
		
		if( !$saysme_job_data->isci ) 
		{
			// USE the partner_data of the entry as a fallback incase the isci does not exist on the job
			$saysme_job_data->isci = $entry->getPartnerData() 	;
		}
		$workdir = $saysme_job_data->isci;

		
		TRACE ( "Now processing job [" . $job->getId() ."] for entry [$entry_id] with data:\n" . print_r ( $saysme_job_data , true ) );
		
		$sc = new saysmeConvert( self::$saysme->getPrjectDataDir() );
		$source_file = $entry->getFullArchivePath();

		if( ! $source_file )
		{
			$this->writeToLog ( "Error in job [" . $job->getId() . "]. Cannot entry [$entry_id] does not have an archive file to convert from" );
			// TODO : send failed notification 
			return;	
		}
		
		$progress = new batchJobProgress ( $job , 15 ); // assume there are 15 steps
		
		list ( $result_file , $exists) = $sc->alreadyExists( $source_file , $saysme_job_data , self::$saysme->getPrjectWorkDir() . "/" . $workdir );
		if ( !$exists )
		{
			list ( $result_file , $log_file ) = 
				$sc->convert ( $source_file , $saysme_job_data , self::$saysme->getPrjectWorkDir() . "/" . $workdir , true , $progress );
		} 
		else
		{
			$this->writeToLog ( "Result already exists [$result_file]. Skipping creation" );
		}
		
		// send notification 
		//$entry->set 
		$this->writeToLog ( "Sending notification [transcoding completed]" );
		myNotificationMgr::createNotification( kNotificationJobData::NOTIFICATION_TYPE_ENTRY_UPDATE , $entry , null,null,null,"transcoding completed");
		
		// FTP to the drop box
		list ( $ftp_server , $ftp_user , $ftp_pass ) = self::$saysme->getFtpDetails ();
		$ftp_url = "[$ftp_server, $ftp_user]";
		$ftp_mgr = kFileTransferMgr::getInstance(kFileTransferMgrType::FTP);
		try
		{
			$ftp_target = ( self::$saysme->getFtpRemotePath() ? self::$saysme->getFtpRemotePath() . "/" : "" ) . $saysme_job_data->isci . "." . pathinfo ( $result_file , PATHINFO_EXTENSION );
			$this->writeToLog (  "Sending [$result_file] to ftp [$ftp_user@$ftp_server] $ftp_target " );
			
			$ftp_mgr->login( $ftp_server , $ftp_user , $ftp_pass );
			$res = $ftp_mgr->putFile( $ftp_target , $result_file , false, FTP_BINARY );
			
			if ( $res == kFileTransferMgr::FILETRANSFERMGR_RES_OK )
			{
				$this->writeToLog ( "Sending notification [dropped in dropbox [$ftp_url]]" );
				myNotificationMgr::createNotification( kNotificationJobData::NOTIFICATION_TYPE_ENTRY_UPDATE , $entry , null,null,null,"dropped in dropbox [$ftp_url]" );
				$progress->done();
			}
			else
			{
				throw new Exception ( "Error in ftp_put" );
			}
			
		}
		catch ( Exception $ex )
		{
			$this->writeToLog ( "Sending notification [error while sending to ftp [$ftp_url]]" );
			myNotificationMgr::createNotification( kNotificationJobData::NOTIFICATION_TYPE_ENTRY_UPDATE , $entry , null,null,null,"error while sending to ftp [$ftp_url]" );
		}
	}
	
	public function writeToLog( $message )
	{
		TRACE ( $message );
	}
}

?>