<?php
define("KALTURA_ROOT_PATH", dirname(__FILE__));
define("SF_ROOT_DIR",   realpath(KALTURA_ROOT_PATH.DIRECTORY_SEPARATOR."../alpha"));
define("SF_APP",         'kaltura'); 
define("SF_ENVIRONMENT", 'prod');
define("SF_DEBUG",       false);

require_once(KALTURA_ROOT_PATH . "/lib/KalturaAutoload.php");
require_once(KALTURA_ROOT_PATH . "/lib/KalturaAutoloadNonStandard.php");
KalturaAutoload::register();

date_default_timezone_set("America/New_York");

// for places where kLog is used
kLog::setLogger(KalturaLog::getInstance());