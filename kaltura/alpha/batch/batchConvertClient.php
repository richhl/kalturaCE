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
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'lib/batch/myBatchFileConverter.class.php');



$mode=$argv[1];
if ( !$mode ) $mode=3;// dual mode
$start_time = microtime(true);
myBatchFileConverterClient::convert($mode);
$end_time = microtime ( true );
$diff = (int)(( $end_time - $start_time ) * 1000);
echo ( "****************\nEndes after " . $diff . " millisecond \n****************" );
?>
