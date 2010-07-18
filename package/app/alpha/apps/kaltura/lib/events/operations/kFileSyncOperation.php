<?php

class kFileSyncOperation extends kFlowOperation
{
	/* (non-PHPdoc)
	 * @see apps/kaltura/lib/events/kFlowOperation#execute()
	 */
	public function execute()
	{
		kLog::log(__METHOD__ . " kFileSyncOperation");
		
		if(!($this->sourceObject instanceof FileSync))
		{
			kLog::log(__METHOD__ . ' Could be executed on FileSync object only');
			return false;
		}
		
		$kalturaDc = StorageProfilePeer::retrieveByPK($this->sourceObject->getDc());
		if(!$kalturaDc)
		{
			kLog::log(__METHOD__ . ' Kaltura DC [' . $this->sourceObject->getDc() . '] not found');
			return false;
		}
			
		$key = kFileSyncUtils::getKeyForFileSync($this->sourceObject);
		$srcFileSyncLocalPath = kFileSyncUtils::getLocalFilePathForKey($key, true);
		$entryId = $this->getEntryId();
		$job = kJobsManager::addStorageExportJob(null, $entryId, $this->sourceObject->getPartnerId(), $kalturaDc, $this->sourceObject, $srcFileSyncLocalPath);
		
		if($job)
			return true;
		
		return false;
	}
	
	public function getEntryId()
	{
		$entry = $this->getEntry();
		if($entry)
			return $entry->getId();
			
		return null;
	}
}

