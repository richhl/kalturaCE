<?php

class kEventsManager
{
	public static function handleObjectCreated(BaseObject $object)
	{
		if($object instanceof FileSync)
		{
			if($object->getStatus() != FileSync::FILE_SYNC_STATUS_PENDING || $object->getFileType() != FileSync::FILE_SYNC_FILE_TYPE_FILE)
				return;
			
			kLog::log("Init kFileSyncOperation");
			$action = new kFileSyncOperation($object);
			$action->execute();
		}
	}
	
	public static function handleObjectChanged(BaseObject $object, array $modifiedColumns)
	{
		// TODO - implement cache and checking in the events table

		
		// TODO - remove after implementing real events handling
		if($object instanceof entry)
		{
			if(in_array(entryPeer::MODERATION_STATUS, $modifiedColumns) && $object->getModerationStatus() == entry::ENTRY_MODERATION_STATUS_APPROVED)
			{
				$externalStorages = StorageProfilePeer::retrieveAutomaticByPartnerId($object->getPartnerId());
				foreach($externalStorages as $externalStorage)
				{
					kLog::log("Checking storage [" . $externalStorage->getId() . "]");
					kLog::log("Storage trigger [" . $externalStorage->getTrigger() . "]");
					if($externalStorage->getTrigger() == StorageProfile::STORAGE_TEMP_TRIGGER_MODERATION_APPROVED)
					{
						kLog::log("Init kStorageExportAction");
						$action = new kStorageExportOperation($object);
						$action->setStorageProfile($externalStorage);
						$action->execute();
					}
				}
			}
		}
	}
}