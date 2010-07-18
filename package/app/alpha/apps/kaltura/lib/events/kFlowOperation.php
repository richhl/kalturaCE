<?php

abstract class kFlowOperation
{
	/**
	 * @var BaseObject
	 */
	protected $sourceObject = null;
	
	/**
	 * @param BaseObject $sourceObject
	 */
	public function __construct(BaseObject $sourceObject)
	{
		$this->sourceObject = $sourceObject;
	}
	
	/**
	 * @return bool
	 */
	public abstract function execute();
	
	/**
	 * @return entry
	 */
	protected function getEntry()
	{
		if(!$this->sourceObject)
			return null;
			
		if($this->sourceObject instanceof entry)
			return $this->sourceObject;
			
		if($this->sourceObject instanceof flavorAsset)
			return $this->sourceObject->getentry();
			
		if($this->sourceObject instanceof BatchJob)
			return $this->sourceObject->getEntry();
			
		if($this->sourceObject instanceof FileSync)
		{
			if($this->sourceObject->getObjectType() == FileSync::FILE_SYNC_OBJECT_TYPE_ENTRY)
				return entryPeer::retrieveByPKNoFilter($this->sourceObject->getObjectId());
				
			if($this->sourceObject->getObjectType() == FileSync::FILE_SYNC_OBJECT_TYPE_BATCHJOB)
			{
				$job = BatchJobPeer::retrieveByPK($this->sourceObject->getObjectId());
				if($job)
					return entryPeer::retrieveByPKNoFilter($job->getEntryId());
			}
				
			if($this->sourceObject->getObjectType() == FileSync::FILE_SYNC_OBJECT_TYPE_FLAVOR_ASSET)
			{
				$flavor = flavorAssetPeer::retrieveById($this->sourceObject->getObjectId());
				if($flavor)
					return entryPeer::retrieveByPKNoFilter($flavor->getEntryId());
			}
		}
			
		return null;
	}
	
	/**
	 * @return BatchJob
	 */
	protected function getBatchJob()
	{
		if(!$this->sourceObject)
			return null;
			
		if($this->sourceObject instanceof BatchJob)
			return $this->sourceObject;
			
		return null;
	}
	
	/**
	 * @return flavorAsset
	 */
	protected function getFlavorAsset()
	{
		if(!$this->sourceObject)
			return null;
			
		if($this->sourceObject instanceof flavorAsset)
			return $this->sourceObject;
			
		return null;
	}
}