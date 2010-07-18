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

	$result_file = $argv[1];
	
	$saysme = new saysmeProject();
	$saysme_job_data = new saysmeJobData();
	$saysme_job_data->isci = $argv[2];
	
	// FTP to the drop box
	list ( $ftp_server , $ftp_user , $ftp_pass ) = $saysme->getFtpDetails ();
	$ftp_url = "[$ftp_server, $ftp_user]";
	$ftp_mgr = kFileTransferMgr::getInstance(kFileTransferMgrType::FTP);

	$ftp_target = ( $saysme->getFtpRemotePath() ? $saysme->getFtpRemotePath() . "/" : "" ) . $saysme_job_data->isci;
	TRACE (  "Sending [$result_file] to ftp [$ftp_user@$ftp_server] $ftp_target " );
	
	$ftp_mgr->login( $ftp_server , $ftp_user , $ftp_pass );
	$res = $ftp_mgr->putFile( $ftp_target , $result_file , true , FTP_BINARY );
	
print_r ( $res );
		
?>