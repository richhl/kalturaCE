<?php
/*

require_once (dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "infra" . DIRECTORY_SEPARATOR . "bootstrap_base.php");
define ( "KALTURA_UNITTEST_PATH", KALTURA_ROOT_PATH . DIRECTORY_SEPARATOR . "UnitTest" );
define ( "KALTURA_API_PATH", KALTURA_ROOT_PATH . DIRECTORY_SEPARATOR . "api_v3" );

// Autoloader
require_once (KALTURA_INFRA_PATH . DIRECTORY_SEPARATOR . "KAutoloader.php");

//TBD
require_once(dirname(__FILE__).'/../alpha/config/sfrootdir.php');

KAutoloader::addClassPath ( KAutoloader::buildPath ( KALTURA_ROOT_PATH, "vendor", "propel", "*" ) );
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_API_PATH, "lib", "*"));
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_API_PATH, "services", "*"));
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "alpha", "plugins", "*")); // needed for testmeDoc
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "plugins", "*"));
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "generator")); // needed for testmeDoc
KAutoloader::setClassMapFilePath(KAutoloader::buildPath(kConf::get("cache_root_path"), "unitest", "KalturaClassMap.cache"));
KAutoloader::dumpExtra();

KAutoloader::setNoCache (true);
KAutoloader::register ();

//Set DB
DbManager::setConfig(kConf::getDB());
DbManager::initialize();

require_once ('UnitTests/UnitTestDataFileReaderWriter.php');
require_once ('UnitTestDataGenerator/UnitTestDataGenerator.php');
require_once ('UnitTestData.php');


/*
// Timezone
//date_default_timezone_set(kConf::get("date_default_timezone")); // America/New_York

// Logger
$loggerConfigPath = KALTURA_UNITTEST_PATH.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."logger.ini";

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

*/

require_once('/opt/kaltura/app/alpha/config/sfrootdir.php');
require_once('/opt/kaltura/app/api_v3/bootstrap.php');

DbManager::setConfig(kConf::getDB());
DbManager::initialize();
