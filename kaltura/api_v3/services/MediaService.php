<?php

/**
 * Media Service
 *
 * @service media
 * @package api
 * @subpackage services
 */
class MediaService extends KalturaEntryService
{
	/**
	 * Adds new media entry by importing an HTTP or FTP URL.
	 * The entry will be queued for import and then for conversion.
	 * 
	 * @action addFromUrl
	 * @param KalturaMediaEntry $mediaEntry Media entry metadata  
	 * @param string $url An HTTP or FTP URL
	 * @return KalturaMediaEntry The new media entry
	 */
	function addFromUrlAction(KalturaMediaEntry $mediaEntry, $url)
	{
		$dbEntry = $this->prepareMediaEntryForInsert($mediaEntry);
		
		$kshow = $this->createDummyKShow();
        $kshowId = $kshow->getId();
		
		// setup the needed params for my insert entry helper
		$paramsArray = array (
			"entry_media_source" => KalturaSourceType::URL,
            "entry_media_type" => $dbEntry->getMediaType(),
			"entry_url" => $url,
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

		// FIXME: need to remove something from cache? in the old code the kshow was removed
		$mediaEntry->fromObject($dbEntry);
		return $mediaEntry;
	}

	/**
	 * Adds new media entry by importing the media file from a search provider. 
	 * This action should be used with the search service result.
	 *
	 * @action addFromSearchResult
	 * @param KalturaMediaEntry $mediaEntry Media entry metadata
	 * @param KalturaSearchResult $searchResult Result object from search service
	 * @return KalturaMediaEntry The new media entry
	 */
	function addFromSearchResultAction(KalturaMediaEntry $mediaEntry = null, KalturaSearchResult $searchResult)
	{
		if ($mediaEntry === null)
			$mediaEntry = new KalturaMediaEntry();
			
		// copy the fields from search result if they are missing in media entry 
		// this should be checked before prepareEntry method call
		if ($mediaEntry->name === null)
			$mediaEntry->name = $searchResult->title;
			
		if ($mediaEntry->mediaType === null)
			$mediaEntry->mediaType = $searchResult->mediaType;

        if ($mediaEntry->description === null)
        	$mediaEntry->description = $searchResult->description;
        
        if ($mediaEntry->creditUrl === null)
        	$mediaEntry->creditUrl = $searchResult->sourceLink;
        	
       	if ($mediaEntry->creditUserName === null)
       		$mediaEntry->creditUserName = $searchResult->credit;
       		
     	if ($mediaEntry->tags === null)
      		$mediaEntry->tags = $searchResult->tags;

     	$searchResult->validatePropertyNotNull("searchSource");
     	
    	$mediaEntry->sourceType = KalturaSourceType::SEARCH_PROVIDER;
     	$mediaEntry->searchProviderType = $searchResult->searchSource;
     	$mediaEntry->searchProviderId = $searchResult->id;
     	
		$dbEntry = $this->prepareMediaEntryForInsert($mediaEntry);
      	

      	
     	$kshow = $this->createDummyKShow();
        $kshowId = $kshow->getId();
        	
       	// $searchResult->licenseType; // FIXME, No support for licenseType
        
		if ($dbEntry->getSource() == entry::ENTRY_MEDIA_SOURCE_KALTURA ||
			$dbEntry->getSource() == entry::ENTRY_MEDIA_SOURCE_KALTURA_PARTNER ||
			$dbEntry->getSource() == entry::ENTRY_MEDIA_SOURCE_KALTURA_PARTNER_KSHOW ||
			$dbEntry->getSource() == entry::ENTRY_MEDIA_SOURCE_KALTURA_KSHOW ||
			$dbEntry->getSource() == entry::ENTRY_MEDIA_SOURCE_KALTURA_USER_CLIPS)
		{
			$sourceEntryId = $searchResult->id;
			$copyDataResult = myEntryUtils::copyData($sourceEntryId, $dbEntry);
			
			if (!$copyDataResult) // will be false when the entry id was not found
				throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $sourceEntryId);
				
			$dbEntry->setStatusReady();
			$dbEntry->save();
		}
		else
		{
			// setup the needed params for my insert entry helper
			$paramsArray = array (
				"entry_media_source" => $dbEntry->getSource(),
	            "entry_media_type" => $dbEntry->getMediaType(),
				"entry_url" => $searchResult->url,
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
		}

		myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_ADD, $dbEntry);

		$mediaEntry->fromObject($dbEntry);
		return $mediaEntry;
	}
	
	/**
	 * Add new entry after the specific media file was uploaded and the upload token id exists
	 *
	 * @action addFromUploadedFile
	 * @param KalturaMediaEntry $mediaEntry Media entry metadata
	 * @param string $uploadTokenId Upload token id
	 * @return KalturaMediaEntry The new media entry
	 */
	function addFromUploadedFileAction(KalturaMediaEntry $mediaEntry, $uploadTokenId)
	{
		$dbEntry = $this->prepareMediaEntryForInsert($mediaEntry);
		
		$kshow = $this->createDummyKShow();
        $kshowId = $kshow->getId();
		
		$fileExtension = strtolower(pathinfo($uploadTokenId, PATHINFO_EXTENSION));
		$entryFullPath = myUploadUtils::getUploadPath($uploadTokenId, "", null , $fileExtension);
		if (!file_exists($entryFullPath))
			throw new KalturaAPIException(KalturaErrors::UPLOADED_FILE_NOT_FOUND_BY_TOKEN);
			
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

		$mediaEntry->fromObject($dbEntry);
		return $mediaEntry;
	}
	
	/**
	 * Get media entry by ID.
	 * 
	 * @action get
	 * @param string $entryId Media entry id
	 * @return KalturaMediaEntry The requested media entry
	 */
	function getAction($entryId)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::MEDIA_CLIP)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);

		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->fromObject($dbEntry);

		return $mediaEntry;
	}

	/**
	 * Update media entry. Only the properties that were set will be updated.
	 * 
	 * @action update
	 * @param string $entryId Media entry id to update
	 * @param KalturaMediaEntry $mediaEntry Media entry metadata to update
	 * @return KalturaMediaEntry The updated media entry
	 */
	function updateAction($entryId, KalturaMediaEntry $mediaEntry)
	{
		$mediaEntry->type = null; // because it was set in the constructor, but cannot be updated
		
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::MEDIA_CLIP)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		$this->checkAndSetValidUser($mediaEntry, $dbEntry);
		
		$dbEntry = $mediaEntry->toUpdatableObject($dbEntry);
		
		$dbEntry->save();
		$mediaEntry->fromObject($dbEntry);
		
		$wrapper = objectWrapperBase::getWrapperClass($dbEntry);
		$wrapper->removeFromCache("entry", $dbEntry->getId());
		
		myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_UPDATE, $dbEntry);
		
		return $mediaEntry;
	}

	/**
	 * Delete a media entry.
	 *
	 * @action delete
	 * @param string $entryId Media entry id to delete
	 */
	function deleteAction($entryId)
	{
		$entryToDelete = entryPeer::retrieveByPK($entryId);

		if (!$entryToDelete || $entryToDelete->getType() != KalturaEntryType::MEDIA_CLIP)
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
	 * List media entries by filter with paging support.
	 * 
	 * @action list
     * @param KalturaMediaEntryFilter $filter Media entry filter
	 * @param KalturaFilterPager $pager Pager
	 * @return KalturaMediaListResponse Wrapper for array of media entries and total count
	 */
	function listAction(KalturaMediaEntryFilter $filter = null, KalturaFilterPager $pager = null)
	{
		if (!$filter)
			$filter = new KalturaMediaEntryFilter();

		if (!$pager)
			$pager = new KalturaFilterPager();
			
		$entryFilter = new entryFilter();
		$filter->toObject($entryFilter);

		$c = new Criteria();
		$entryFilter->attachToCriteria($c);
		$c->add(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP); // only media entries
		
		$totalCount = entryPeer::doCount($c);
		
		$pager->attachToCriteria($c);
		$list = entryPeer::doSelect($c);
		
		$newList = KalturaMediaEntries::fromEntryArray($list);
		$response = new KalturaMediaListResponse();
		$response->objects = $newList;
		$response->totalCount = $totalCount;
		
		return $response;
	}

	/**
	 * Upload a media file to Kaltura, then the file can be used to create a media entry. 
	 * 
	 * @action upload
	 * @param file $fileData The file data
	 * @return string Upload token id
	 * @clientgenerator ignore 
	 */
	function uploadAction($fileData)
	{
		$ksUnique = $this->getKsUniqueString();
		
		$uniqueId = substr(base_convert(md5(uniqid(rand(), true)), 16, 36), 1, 20);
		
		$ext = pathinfo($fileData["name"], PATHINFO_EXTENSION);
		$token = $ksUnique."_".$uniqueId.".".$ext;
		
		$res = myUploadUtils::uploadFileByToken($fileData, $token, "", null, true);
	
		return $res["token"];
	}

	/**
	 * Update media entry thumbnail by a specified time offset (In seconds)
	 * 
	 * @action updateThumbnail
	 * @param string $entryId Media entry id
	 * @param int $timeOffset Time offset (in seconds)
	 * @return KalturaMediaEntry The media entry
	 */
	function updateThumbnailAction($entryId, $timeOffset)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::MEDIA_CLIP)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		// if session is not admin, we should check that the user that is updating the thumbnail is the one created the entry
		if (!$this->getKs()->isAdmin())
		{
			if ($dbEntry->getPuserId() !== $this->getKs()->user)
			{
				throw new KalturaAPIException(KalturaErrors::PERMISSION_DENIED_TO_UPDATE_ENTRY);
			}
		}
		
		$updateThumbnailResult = myEntryUtils::createThumbnailFromEntry($dbEntry, $dbEntry, $timeOffset);
		
		if (!$updateThumbnailResult)
		{
			KalturaLog::CRIT("An unknwon error occured while trying to update thumbnail");
			throw new KalturaAPIException(KalturaErrors::INTERNAL_SERVERL_ERROR);
		}
		
		$wrapper = objectWrapperBase::getWrapperClass($dbEntry);
		$wrapper->removeFromCache("entry", $dbEntry->getId());
		
		myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_UPDATE_THUMBNAIL, $dbEntry);
		
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->fromObject($dbEntry);
		
		return $mediaEntry;
	}

	/**
	 * Update media entry thumbnail using a raw jpeg file
	 * 
	 * @action updateThumbnailJpeg
	 * @param string $entryId Media entry id
	 * @param file $fileData Jpeg file data
	 * @return KalturaMediaEntry The media entry
	 * @clientgenerator ignore
	 */
	function updateThumbnailJpegAction($entryId, $fileData)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::MEDIA_CLIP)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		// if session is not admin, we should check that the user that is updating the thumbnail is the one created the entry
		if (!$this->getKs()->isAdmin())
		{
			if ($dbEntry->getPuserId() !== $this->getKs()->user)
			{
				throw new KalturaAPIException(KalturaErrors::PERMISSION_DENIED_TO_UPDATE_ENTRY);
			}
		}
		
		$dbEntry->setThumbnail(".jpg"); // this will increase the thumbnail version
		$dbEntry->save();
		
		$bigThumbPath = myContentStorage::getFSContentRootPath() . $dbEntry->getBigThumbnailPath();
		kFile::fullMkdir($bigThumbPath);
		kFile::setFileContent($bigThumbPath, file_get_contents($fileData["tmp_name"]));
		
		$path = myContentStorage::getFSContentRootPath() . $dbEntry->getThumbnailPath();
		kFile::fullMkdir($path);
		myFileConverter::createImageThumbnail($bigThumbPath, $path);
		
		$wrapper = objectWrapperBase::getWrapperClass($dbEntry);
		$wrapper->removeFromCache("entry", $dbEntry->getId());
		
		myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_UPDATE_THUMBNAIL, $dbEntry);
		
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->fromObject($dbEntry);
		
		return $mediaEntry;
	}
	
	/**
	 * Request a new conversion job, this can be used to convert the media entry to a different format
	 * 
	 * @action requestConversion
	 * @param string $entryId Media entry id
	 * @param string $fileFormat Format to convert
	 * @return int The queued job id
	 */
	public function requestConversionAction($entryId, $fileFormat)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::MEDIA_CLIP)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
		
		if ($dbEntry->getMediaType() == KalturaMediaType::AUDIO)
		{
			// for audio - force format flv regardless what the user really asked for
			$fileFormat = "flv";
		}
			
		$job = myBatchDownloadVideoServer::addJob($this->getPuserKuser()->getPuserId(), $dbEntry, null, $fileFormat);
		
		return $job[0]->getId();
	}
	
	private function prepareMediaEntryForInsert(KalturaMediaEntry $mediaEntry)
	{
		// first validate the input object
		$mediaEntry->validatePropertyMinLength("name", 2);
		$mediaEntry->validatePropertyNotNull("mediaType");
		
		// first copy all the properties to the db entry, then we'll check for security stuff
		$dbEntry = $mediaEntry->toObject(new entry());

		$this->checkAndSetValidUser($mediaEntry, $dbEntry);
			
		// check if allowed to set admin tags
		if ($dbEntry->getAdminTags() !== null && !$this->getKs()->isAdmin())
			throw new KalturaAPIException(KalturaErrors::CANNOT_UPDATE_ADMIN_TAGS);
			
		$dbEntry->setPartnerId($this->getPartnerId());
		$dbEntry->setSubpId($this->getPartnerId() * 100);
		$dbEntry->setStatusReady();
		$dbEntry->save();
		
		return $dbEntry;
	}
}