#!/usr/bin/php
<?php
/*
 * Created on Nov 25, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'kaltura');
define('SF_ENVIRONMENT', 'batch');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


$start_time = microtime(true);
$script_name = $_SERVER['SCRIPT_NAME'];

$saysme_server = new myBatchSaysmeConvertServer( $script_name );
SET_CONTEXT ( "SAYSME" ); // this is to prevent writing TRACEs to the output
$saysme_server->doConvertLoop();
$end_time = microtime ( true );
$diff = (int)(( $end_time - $start_time ) * 1000);
echo ( "****************\nEnded after " . $diff . " millisecond \n****************" );
?>
