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



	$saysme = new saysmeProject ();
	
	$slate_template = $saysme->getPrjectDataDir() . "/slate_template/slate.png";
	
	$sc = new saysmeConvert( $saysme->getPrjectDataDir() );
//	$source_file = $entry->getFullArchivePath();

	$saysme_job_data = new saysmeJobData();
	$saysme_job_data->isci = "SMT111";
	$saysme_job_data->spot_title = "Says Me TV, Free Speach Ad ";
	$saysme_job_data->date = date ( "d/m/Y" ); 
	$saysme_job_data->duration = "1232";
		
	
	$working_dir = "C:\\web\\projects_tmp\\saysme\\";
	saysmeConvert::fullMkdir ( $working_dir . "/slate/dummy.txt" );
	
	$sc->createSlateImage( $slate_template , $saysme_job_data , $working_dir );
		
?>