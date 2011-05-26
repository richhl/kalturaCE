<?php
$start = microtime(true);
set_time_limit(0);
require_once(dirname(__FILE__).'/../../alpha/config/sfrootdir.php');

// check cache before loading anything
require_once("../lib/KalturaResponseCacher.php");
$cache = new KalturaResponseCacher(null, "/web/cache/feed/", 86400);
$cache->checkOrStart();

require_once("../bootstrap.php");

KalturaLog::setContext("syndicationFeedRenderer");

KalturaLog::debug(">------------------------------------- syndicationFeedRenderer -------------------------------------");
KalturaLog::info("syndicationFeedRenderer-start ");

$feedId = $_GET['feedId'];
$entryId = @$_GET['entryId'];
try
{
	$syndicationFeedRenderer = new KalturaSyndicationFeedRenderer($feedId);
	$syndicationFeedRenderer->addFlavorParamsAttachedFilter();
	
	if (isset($entryId))
		$syndicationFeedRenderer->addEntryAttachedFilter($entryId);
		
	$syndicationFeedRenderer->execute();
}
catch(Exception $ex)
{
	header('KalturaSyndication: '.$ex->getMessage());
	die;
}

$end = microtime(true);
KalturaLog::info("syndicationFeedRenderer-end [".($end - $start)."]");
KalturaLog::debug("<------------------------------------- syndicationFeedRenderer -------------------------------------");

$cache->end();

?>
