<?php

$dryRun = true; //TODO: change for real run
$stopFile = dirname(__FILE__).'/stop_live_migration'; // creating this file will stop the script
$entryLimitEachLoop = 50;

//------------------------------------------------------

require_once(dirname(__FILE__).'/../../bootstrap.php');


// stores the last handled entry int id, helps to restore in case of crash
$lastEntryFile = 'last_entry';
$lastEntry = 0;
if(file_exists($lastEntryFile))
	$lastEntry = file_get_contents($lastEntryFile);
if(!$lastEntry)
	$lastEntry = 0;

$con = myDbHelper::getConnection(myDbHelper::DB_HELPER_CONN_PROPEL2);
	
$entries = getEntries($con, $lastEntry, $entryLimitEachLoop);

while(count($entries))
{
	foreach($entries as $entry)
	{
		if (file_exists($stopFile)) {
			die('STOP FILE CREATED');
		}
		$lastEntry = $entry->getIntId();
		KalturaLog::log('-- entry id ' . $entry->getId() . " int id[$lastEntry]");
		
		$streamId = $entry->getStreamRemoteId();
		$entry->setStreamName($entry->getId().'_%i@'.$streamId);
		$entry->setPrimaryBroadcastingUrl  ('rtmp://p.ep'.$streamId.'.i.akamaientrypoint.net/EntryPoint');
		$entry->setSecondaryBroadcastingUrl('rtmp://b.ep'.$streamId.'.i.akamaientrypoint.net/EntryPoint');
		
		if (!$dryRun) {
			KalturaLog::log('Saving new entry with the following parameters: '.PHP_EOL);
			KalturaLog::log('Stream name = '.$entry->getStreamName().PHP_EOL);
			KalturaLog::log('Primary broadcasting URL = '.$entry->getPrimaryBroadcastingUrl().PHP_EOL);
			KalturaLog::log('Secondary broadcasting URL =  '.$entry->getSecondaryBroadcastingUrl().PHP_EOL);
			$entry->save();
		}
		else {
			KalturaLog::log('DRY RUN - entry is not being saved with the following new parameters: '.PHP_EOL);
			KalturaLog::log('Stream name = '.$entry->getStreamName().PHP_EOL);
			KalturaLog::log('Primary broadcasting URL = '.$entry->getPrimaryBroadcastingUrl().PHP_EOL);
			KalturaLog::log('Secondary broadcasting URL =  '.$entry->getSecondaryBroadcastingUrl().PHP_EOL);
		}		
				
		file_put_contents($lastEntryFile, $lastEntry);
	}
	
	entryPeer::clearInstancePool();
	
	$entries = getEntries($con, $lastEntry, $entryLimitEachLoop);
}

KalturaLog::log('Done');


function getEntries($con, $lastEntry, $entryLimitEachLoop)
{
	$c = new Criteria();
	$c->add(entryPeer::INT_ID, $lastEntry, Criteria::GREATER_THAN);
	$c->addAnd(entryPeer::TYPE, entryType::LIVE_STREAM);
	$c->addAscendingOrderByColumn(entryPeer::INT_ID);
	$c->setLimit($entryLimitEachLoop);
	return entryPeer::doSelect($c, $con);
}