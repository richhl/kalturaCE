<?php

class kStorageExportOperation extends kFlowOperation
{
	/**
	 * @var bool
	 */
	protected $force = false;
	
	/**
	 * @var StorageProfile
	 * TODO - maybe we need to remove it and run the export on all storages when triggered
	 */
	protected $storageProfile = null;
	
	public function execute()
	{
		kLog::log(__METHOD__ . " kStorageExportOperation");
		
		if(!$this->storageProfile)
		{
			kLog::log(__METHOD__ . 'Storage Profile not defined');
			return false;
		}
		
		if($this->sourceObject instanceof flavorAsset)
			return $this->exportFlavorAsset();
		
		if($this->sourceObject instanceof FileSync)
			return $this->exportFileSync();
			
		return $this->exportEntry();
	}
	
	protected function exportFileSync()
	{
		$entry = $this->getEntry();
		if(!$entry)
			return false;
			
		$key = kFileSyncUtils::getKeyForFileSync($this->sourceObject);
		$this->export($entry, $key);
				
		return true;
	}
	
	protected function exportFlavorAsset()
	{
		$flavor = $this->getFlavorAsset();
		if(!$flavor)
		{
			kLog::log(__METHOD__ . 'flavor not found');
			return false;
		}
			
		$flavorParamsIds = $this->storageProfile->getFlavorParamsIds();
		kLog::log(__METHOD__ . " flavorParamsIds [$flavorParamsIds]");
		if(!is_null($flavorParamsIds) && strlen(trim($flavorParamsIds)))
		{
			$flavorParamsArr = explode(',', $flavorParamsIds);
			if(!in_array($flavor->getFlavorParamsId(), $flavorParamsArr))
				return true;
		}
			
		$key = $flavor->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
		$this->export($flavor->getentry(), $key);
				
		return true;
	}
	
	protected function exportEntry()
	{
		$entry = $this->getEntry();
		if(!$entry)
		{
			kLog::log(__METHOD__ . 'Entry not found');
			return false;
		}
			
		$checkFileSyncsKeys = $this->getEntrySyncKeys($entry);
		foreach($checkFileSyncsKeys as $key)
			$this->export($entry, $key);
			
		return true;
	}
	
	/**
	 * @param entry $entry
	 * @param FileSyncKey $key
	 */
	protected function export(entry $entry, FileSyncKey $key)
	{
		if(!$this->shouldExport($key))
		{
			kLog::log(__METHOD__ . " no need to export key [$key] to externalStorage id[" . $this->storageProfile->getId() . "]");
			return;
		}
			
		$parentJob = $this->getBatchJob();
		$fileSync = kFileSyncUtils::createPendingExternalSyncFileForKey($key, $this->storageProfile);
		$srcFileSyncLocalPath = kFileSyncUtils::getLocalFilePathForKey($key, true);
		kJobsManager::addStorageExportJob($parentJob, $entry->getId(), $entry->getPartnerId(), $this->storageProfile, $fileSync, $srcFileSyncLocalPath, $this->force);
	}
	
	/**
	 * @param FileSyncKey $key
	 * @return bool
	 */
	protected function shouldExport(FileSyncKey $key)
	{
		kLog::log(__METHOD__ . " - key [$key], externalStorage id[" . $this->storageProfile->getId() . "]");
		
		list($kalturaFileSync, $local) = kFileSyncUtils::getReadyFileSyncForKey($key, false, false);
		if(!$kalturaFileSync) // no local copy to export from
		{
			kLog::log(__METHOD__ . " key [$key] not found localy");
			return false;
		}
		
		kLog::log(__METHOD__ . " validating file size [" . $kalturaFileSync->getFileSize() . "] is between min [" . $this->storageProfile->getMinFileSize() . "] and max [" . $this->storageProfile->getMaxFileSize() . "]");
		if($this->storageProfile->getMaxFileSize() && $kalturaFileSync->getFileSize() > $this->storageProfile->getMaxFileSize()) // too big
		{
			kLog::log(__METHOD__ . " key [$key] file too big");
			return false;
		}
			
		if($this->storageProfile->getMinFileSize() && $kalturaFileSync->getFileSize() < $this->storageProfile->getMinFileSize()) // too small
		{
			kLog::log(__METHOD__ . " key [$key] file too small");
			return false;
		}
		
		if($this->force)
			return true;
			
		$storageFileSync = kFileSyncUtils::getReadyExternalFileSyncForKey($key, $this->storageProfile->getId());
		if($storageFileSync) // already exported
		{
			kLog::log(__METHOD__ . " key [$key] already exported");
			return false;
		}
			
		return true;
	}
	
	/**
	 * @param entry $entry
	 * @return array<FileSyncKey>
	 */
	protected function getEntrySyncKeys(entry $entry)
	{
		$exportFileSyncsKeys = array();
		
		$exportFileSyncsKeys[] = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_DATA);
		$exportFileSyncsKeys[] = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_ISM);
		$exportFileSyncsKeys[] = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_ISMC);
		
		$flavorAssets = array();
		$flavorParamsIds = $this->storageProfile->getFlavorParamsIds();
		kLog::log(__METHOD__ . " flavorParamsIds [$flavorParamsIds]");
		if(is_null($flavorParamsIds) || !strlen(trim($flavorParamsIds)))
		{
			$flavorAssets = flavorAssetPeer::retreiveReadyByEntryId($entry->getId());
		}
		else
		{
			$flavorParamsArr = explode(',', $flavorParamsIds);
			kLog::log(__METHOD__ . " flavorParamsIds count [" . count($flavorParamsArr) . "]");
			$flavorAssets = flavorAssetPeer::retreiveReadyByEntryIdAndFlavorParams($entry->getId(), $flavorParamsArr);
		}
		
		foreach($flavorAssets as $flavorAsset)
			$exportFileSyncsKeys[] = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
		
		return $exportFileSyncsKeys;
	}
	
	/**
	 * @param bool $force
	 */
	public function setForce($force)
	{
		$this->force = $force;
	}
	
	/**
	 * @param StorageProfile $storageProfile
	 */
	public function setStorageProfile(StorageProfile $storageProfile)
	{
		$this->storageProfile = $storageProfile;
	}

}

