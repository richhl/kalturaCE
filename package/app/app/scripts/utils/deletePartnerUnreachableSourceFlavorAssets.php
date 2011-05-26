<?php

ini_set("memory_limit","256M");
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../../alpha/'));
define('SF_APP',         'kaltura');
define('SF_ENVIRONMENT', 'batch');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
require_once(SF_ROOT_DIR.'/../infra/bootstrap_base.php');
require_once(KALTURA_INFRA_PATH.DIRECTORY_SEPARATOR."KAutoloader.php");

KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "api_v3", "*"));
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "batch", "mediaInfoParser", "*"));
KAutoloader::setClassMapFilePath('./logs/classMap.cache');
KAutoloader::register();

error_reporting ( E_ALL );

$dbConf = kConf::getDB ();
DbManager::setConfig ( $dbConf );
DbManager::initialize ();

if (count($argv) !== 2)
{
	die('pleas provide partner id as input' . PHP_EOL . 
		'to run script: ' . basename(__FILE__) . ' X' . PHP_EOL . 
		'whereas X is partner id' . PHP_EOL);
}

$partner_id = @$argv[1];
$partner = PartnerPeer::retrieveByPK($partner_id);
if(!$partner)
{
        die('no such partner.'.PHP_EOL);
}

$c = new Criteria();
$c->add(flavorAssetPeer::PARTNER_ID, $partner_id);
$c->add(flavorAssetPeer::IS_ORIGINAL, true);
$c->add(flavorAssetPeer::STATUS, flavorAsset::FLAVOR_ASSET_STATUS_READY);

$con = myDbHelper::getConnection(myDbHelper::DB_HELPER_CONN_PROPEL2);
$flavorAssets = flavorAssetPeer::doSelect($c, $con);
$changedEntriesCounter = 0;

foreach ($flavorAssets as $flavorAsset)
{
	$flavorSyncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
	try
	{
		if (!kFileSyncUtils::file_exists($flavorSyncKey, true))
		{
			echo 'changed source flavor asset to status deleted for entry: ' . $flavorAsset->getEntryId() .
				' and for flavor id ' . $flavorAsset->getId() . PHP_EOL;
			// set the status of the flavor asset to deleted and set deleted time (taken from flavorAssetService)
			$entry = $flavorAsset->getEntry();
			if ($entry)
			{
				$entry->removeFlavorParamsId($flavorAsset->getFlavorParamsId());
				$entry->save();
			}
			$flavorAsset->setStatus(flavorAsset::FLAVOR_ASSET_STATUS_DELETED);
			$flavorAsset->setDeletedAt(time());
			$flavorAsset->save();
			
			$changedEntriesCounter++;
		}
	}
	catch (Exception $e)
	{
	}
}

echo "Done. {$changedEntriesCounter} unreachable source flavor asset where deleted" . PHP_EOL;
