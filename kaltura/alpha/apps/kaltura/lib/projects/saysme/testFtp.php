<?php
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../../../../../'));
define('SF_APP',         'kaltura');
define('SF_ENVIRONMENT', 'batch');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


function TRACE ( $str )
{
	global $g_context;
	if ( $g_context === null ) return ;
	$time = ( microtime(true) );
	$milliseconds = (int)(($time - (int)$time) * 1000);  
	if ( function_exists('memory_get_usage') )
		$mem_usage = "{". memory_get_usage() . "}";
	else
		$mem_usage = ""; 
	echo strftime( "%d/%m %H:%M:%S." , time() ) . $milliseconds . " " . $mem_usage . " " .$g_context . ": " . $str ."\n";
}
	

$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();


$job_id = $argv[1];

	$job= BatchJobPeer::retrieveByPK( $job_id);
		$entry_id = $job->getEntryId();
		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry )
		{
			echo ( "Error in job [" . $job->getId() . "]. Cannot find entry [$entry_id]" );
			return;	
		}
	$saysme = new saysmeProject ();
	
		$job_data_str = $job->getData();
		$saysme_job_data = unserialize ( $job_data_str );
		
		$workdir = $saysme_job_data->isci;

		TRACE ( "Now processing job [" . $job->getId() ."] for entry [$entry_id] with data:\n" . print_r ( $saysme_job_data , true ) );
		
		$sc = new saysmeConvert( $saysme->getPrjectDataDir() );
		$source_file = $entry->getFullArchivePath();

		if( ! $source_file )
		{
			echo ( "Error in job [" . $job->getId() . "]. Cannot entry [$entry_id] does not have an archive file to convert from" );
			// TODO : send failed notification 
			return;	
		}

	$sc = new saysmeConvert( $saysme->getPrjectDataDir() );
	
	$progress = new batchJobProgress ( $job , 15 ); // assume there are 15 steps
	
		list ( $result_file , $exists) = $sc->alreadyExists( $source_file , $saysme_job_data , $saysme->getPrjectWorkDir() . "/" . $workdir );
		if ( !$exists )
		{
			list ( $result_file , $log_file ) = 
				$sc->convert ( $source_file , $saysme_job_data , $saysme->getPrjectWorkDir() . "/" . $workdir , true , $progress );
		} 
		
echo "$result_file , $exists";
		
		
		// send notification 
		//$entry->set 
		myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_UPDATE , $entry , null,null,null,"transcoding completed");
		
		// FTP to the drop box
		list ( $ftp_server , $ftp_user , $ftp_pass ) = $saysme->getFtpDetails ();
		$ftp_url = "[$ftp_server, $ftp_user]";
		$ftp_mgr = new ftpMgr();
		try
		{
			$ftp_target = ( $saysme->getFtpRemotePath() ? $saysme->getFtpRemotePath() . "/" : "" ) . $saysme_job_data->isci;
			TRACE (  "Sending [$result_file] to ftp [$ftp_user@$ftp_server] $ftp_target " );
			
			$ftp_mgr->login( $ftp_server , $ftp_user , $ftp_pass );
			$res = $ftp_mgr->putFile( $ftp_target , $result_file , FTP_BINARY );
			
			if ( $res == ftpMgr::FTPMGR_RES_OK )
			{
				myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_UPDATE , $entry , null,null,null,"dropped in dropbox [$ftp_url]" );
			}
		}
		catch ( Exception $ex )
		{
			myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_UPDATE , $entry , null,null,null,"error while sending to ftp [$ftp_url]" );
		}
			

		
?>