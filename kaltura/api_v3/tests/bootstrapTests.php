<?php
require_once("cache/KalturaServicesMap.php");
require_once("tests/helpers/KalturaTestsAutoload.php"); 
if (!defined("KALTURA_ROOT_PATH"))
{
	require_once("bootstrap.php");
	KalturaAutoload::register();
	KalturaTestsAutoload::register();
	
	$dbManager = new DbManager();
	$dbManager->initialize();
}