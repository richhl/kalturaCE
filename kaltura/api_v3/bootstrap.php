<?php
define("KALTURA_API_V3", true);
define("KALTURA_ROOT_PATH", dirname(__FILE__));
if (!defined("SF_ROOT_DIR")) // when bootstraping api v3 under symfony, this will throw notices
{
	define("SF_ROOT_DIR",   realpath(KALTURA_ROOT_PATH.DIRECTORY_SEPARATOR."../alpha"));
	define("SF_APP",         'kaltura'); 
	define("SF_ENVIRONMENT", 'prod');
	define("SF_DEBUG",       false);
}

require_once(KALTURA_ROOT_PATH . "/lib/KalturaAutoload.php");
require_once(KALTURA_ROOT_PATH . "/lib/KalturaAutoloadNonStandard.php");
KalturaAutoload::register();

date_default_timezone_set("America/New_York");

$loggerConfigPath = KALTURA_ROOT_PATH.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."logger.ini";

try // we don't want to fail when logger is not configured right
{
	$config = new Zend_Config_Ini($loggerConfigPath);
}
catch(Zend_Config_Exception $ex)
{
	$config = null;
}

KalturaLog::initLog($config);

// for places where kLog is used
kLog::setLogger(KalturaLog::getInstance());
