<?php

/**
 * Base Entry Service
 *
 * @service baseEntry
 * @package api
 * @subpackage services
 */
class BaseEntryService extends KalturaEntryService
{
    /**
     * Generic add entry using an uploaded file, should be used when the uploaded entry type is not known
     *
     * @action addFromUploadedFile
     * @param KalturaBaseEntry $entry
     * @param string $uploadTokenId
     * @param KalturaEntryType $type
     * @return KalturaBaseEntry
     */
    function addFromUploadedFileAction(KalturaBaseEntry $entry, $uploadTokenId, $type = -1)
    {
		// check that the uploaded file exists
		$fileExtension = strtolower(pathinfo($uploadTokenId, PATHINFO_EXTENSION));
		$entryFullPath = myUploadUtils::getUploadPath($uploadTokenId, "", null , $fileExtension);
		if (!file_exists($entryFullPath))
			throw new KalturaAPIException(KalturaErrors::UPLOADED_FILE_NOT_FOUND_BY_TOKEN);
			
        // validate the input object
		$entry->validatePropertyMinLength("name", 1);
		
		// first copy all the properties to the db entry, then we'll check for security stuff
		$dbEntry = $entry->toObject(new entry());
		
        $dbEntry->setType($type);
        $dbEntry->setMediaType(entry::ENTRY_MEDIA_TYPE_AUTOMATIC);
        
		$this->checkAndSetValidUser($entry, $dbEntry);
			
		// check if allowed to set admin tags
		if ($dbEntry->getAdminTags() !== null && !$this->getKs()->isAdmin())
			throw new KalturaAPIException(KalturaErrors::CANNOT_UPDATE_ADMIN_TAGS);
			
		$dbEntry->setPartnerId($this->getPartnerId());
		$dbEntry->setSubpId($this->getPartnerId() * 100);
		$dbEntry->setStatusReady();
		$dbEntry->save();
		
		$kshow = $this->createDummyKShow();
        $kshowId = $kshow->getId();
			
		myEntryUtils::setEntryTypeAndMediaTypeFromFile($dbEntry, $entryFullPath);
			
		// setup the needed params for my insert entry helper
		$paramsArray = array (
			"entry_media_source" => KalturaSourceType::FILE,
            "entry_media_type" => $dbEntry->getMediaType(),
			"entry_full_path" => $entryFullPath,
			"entry_license" => $dbEntry->getLicenseType(),
			"entry_credit" => $dbEntry->getCredit(),
			"entry_source_link" => $dbEntry->getSourceLink(),
			"entry_tags" => $dbEntry->getTags(),
		);
		
		$token = $this->getKsUniqueString();
		$insert_entry_helper = new myInsertEntryHelper(null , $dbEntry->getKuserId(), $kshowId, $paramsArray);
		$insert_entry_helper->setPartnerId($this->getPartnerId(), $this->getPartnerId() * 100);
		$insert_entry_helper->insertEntry($token, $dbEntry->getType(), $dbEntry->getId(), $dbEntry->getName(), $dbEntry->getTags(), $dbEntry);
		$dbEntry = $insert_entry_helper->getEntry();

		myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_ADD, $dbEntry);

		$entry->fromObject($dbEntry);
		return $entry;
    }
    
	/**
	 * Get base entry by ID.
	 * 
	 * @action get
	 * @param string $entryId Entry id
	 * @return KalturaBaseEntry The requested entry
	 */
	function getAction($entryId)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);

	    switch($dbEntry)
	    {
	        case KalturaEntryType::MEDIA_CLIP:
	            $entry = new KalturaMediaEntry();
	            break;
            case KalturaEntryType::MIX:
                $entry = new KalturaMixEntry();
	            break;
            case KalturaEntryType::PLAYLIST:
                $entry = new KalturaPlaylist();
	            break;
            default:
                $entry = new KalturaBaseEntry();
                break;
	    }
	    
		$entry->fromObject($dbEntry);

		return $entry;
	}

	/**
	 * Delete an entry.
	 *
	 * @action delete
	 * @param string $entryId Entry id to delete
	 */
	function deleteAction($entryId)
	{
		$entryToDelete = entryPeer::retrieveByPK($entryId);

		if (!$entryToDelete)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);

		myEntryUtils::deleteEntry($entryToDelete);
		$entryToDelete->setStatus(entry::ENTRY_STATUS_DELETED);
		
		// make sure the moderation_status is set to moderation::MODERATION_STATUS_DELETE
		$entryToDelete->setModerationStatus(moderation::MODERATION_STATUS_DELETE); 
		$entryToDelete->setModifiedAt(time());
		$entryToDelete->save();
		
		$wrapper = objectWrapperBase::getWrapperClass($entryToDelete);
		$wrapper->removeFromCache("entry", $entryToDelete->getId());
		
		myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_DELETE, $entryToDelete);
	}
	
	/**
	 * List base entries by filter with paging support.
	 * 
	 * @action list
     * @param KalturaBaseEntryFilter $filter Entry filter
	 * @param KalturaFilterPager $pager Pager
	 * @return KalturaBaseEntryListResponse Wrapper for array of base entries and total count
	 */
	function listAction(KalturaBaseEntryFilter $filter = null, KalturaFilterPager $pager = null)
	{
	    list($list, $totalCount) = parent::listEntriesByFilter($filter, $pager);
	    
	    $newList = KalturaBaseEntries::fromEntryArray($list);
		$response = new KalturaBaseEntryListResponse();
		$response->objects = $newList;
		$response->totalCount = $totalCount;
		return $response;
	}
}