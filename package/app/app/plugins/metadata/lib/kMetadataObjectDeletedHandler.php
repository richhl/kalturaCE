<?php
class kMetadataObjectDeletedHandler extends kObjectDeleteHandler
{
	/**
	 * @param BaseObject $object
	 */
	public function objectDeleted(BaseObject $object) 
	{
		if($object instanceof entry)
			$this->deleteMetadataObjects(Metadata::TYPE_ENTRY, $object->getId());
			
		if($object instanceof Metadata)
			$this->metadataDeleted($object);
			
		if($object instanceof MetadataProfile)
			$this->metadataProfileDeleted($object);
			
		return true;
	}
	
	/**
	 * @param Metadata $metadata
	 */
	protected function metadataDeleted(Metadata $metadata) 
	{
		$this->syncableDeleted($metadata->getId(), FileSyncObjectType::METADATA);
		
		// updated in the indexing server (sphinx)
		$object = kMetadataManager::getObjectFromPeer($metadata);
		if($object && $object instanceof IIndexable)
			kEventsManager::raiseEvent(new kObjectUpdatedEvent($object));
	}
	
	/**
	 * @param MetadataProfile $metadataProfile
	 */
	protected function metadataProfileDeleted(MetadataProfile $metadataProfile) 
	{
		$this->syncableDeleted($metadataProfile->getId(), FileSyncObjectType::METADATA_PROFILE);
	}
	
	/**
	 * @param int $objectType
	 * @param string $objectId
	 */
	protected function deleteMetadataObjects($objectType, $objectId) 
	{
		$c = new Criteria();
		$c->add(MetadataPeer::OBJECT_TYPE, $objectType);
		$c->add(MetadataPeer::OBJECT_ID, $objectId);
		$c->add(MetadataPeer::STATUS, Metadata::STATUS_DELETED, Criteria::NOT_EQUAL);
	
		$peer = null;
		MetadataPeer::setUseCriteriaFilter(false);
		$metadatas = MetadataPeer::doSelect($c);
		foreach($metadatas as $metadata)
			kEventsManager::raiseEvent(new kObjectDeletedEvent($metadata));
		
		$update = new Criteria();
		$update->add(MetadataPeer::STATUS, Metadata::STATUS_DELETED);
			
		$con = Propel::getConnection(MetadataPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		BasePeer::doUpdate($c, $update, $con);
	}
}