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
		 try
	    {
	    	// check that the uploaded file exists
			$entryFullPath = kUploadTokenMgr::getFullPathByUploadTokenId($uploadTokenId);
	    }
	    catch(kCoreException $ex)
	    {
	    	if ($ex->getCode() == kUploadTokenException::UPLOAD_TOKEN_INVALID_STATUS);
	    		throw new KalturaAPIException(KalturaErrors::UPLOAD_TOKEN_INVALID_STATUS_FOR_ADD_ENTRY);
	    		
    		throw $ex;
	    }

		if (!file_exists($entryFullPath))
		{
			$remoteDCHost = kUploadTokenMgr::getRemoteHostForUploadToken($uploadTokenId, kDataCenterMgr::getCurrentDcId());
			if($remoteDCHost)
			{
				kFile::dumpApiRequest($remoteDCHost);
			}
			else
			{
				throw new KalturaAPIException(KalturaErrors::UPLOADED_FILE_NOT_FOUND_BY_TOKEN);
			}
		}
	    
	    // validate the input object
	    //$entry->validatePropertyMinLength("name", 1);
	    if (!$entry->name)
		    $entry->name = $this->getPartnerId().'_'.time();
			
	    try
	    {
		    // first copy all the properties to the db entry, then we'll check for security stuff
		    $dbEntry = $entry->toObject(new entry());
	    }
	    catch(kCoreException $ex)
	    {
		    $this->handleCoreException($ex, $dbEntry);
	    }
			
	    $dbEntry->setType($type);
	    $dbEntry->setMediaType(entry::ENTRY_MEDIA_TYPE_AUTOMATIC);
	        
	    $this->checkAndSetValidUser($entry, $dbEntry);
	    $this->checkAdminOnlyInsertProperties($entry);
	    $this->validateAccessControlId($entry);
	    $this->validateEntryScheduleDates($entry);
	    
	    $dbEntry->setPartnerId($this->getPartnerId());
	    $dbEntry->setSubpId($this->getPartnerId() * 100);
	    $dbEntry->setStatusReady();
	    $dbEntry->setSourceId( $uploadTokenId );
	    $dbEntry->setSourceLink( $entryFullPath );
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
	    
	    kUploadTokenMgr::closeUploadTokenById($uploadTokenId);
	    
	    myNotificationMgr::createNotification( kNotificationJobData::NOTIFICATION_TYPE_ENTRY_ADD, $dbEntry);

	    $entry->fromObject($dbEntry);
	    return $entry;
    }
    
	/**
	 * Get base entry by ID.
	 * 
	 * @action get
	 * @param string $entryId Entry id
	 * @param int $version Desired version of the data
	 * @return KalturaBaseEntry The requested entry
	 */
	function getAction($entryId, $version = -1)
	{
		return $this->getEntry($entryId, $version);
	}
	
	/**
	 * Update base entry. Only the properties that were set will be updated.
	 * 
	 * @action update
	 * @param string $entryId Entry id to update
	 * @param KalturaBaseEntry $baseEntry Base entry metadata to update
	 * @return KalturaBaseEntry The updated entry
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	function updateAction($entryId, KalturaBaseEntry $baseEntry)
	{
		return $this->updateEntry($entryId, $baseEntry);
	}
	
	/**
	 * Get base entry by comma separated entry ids.
	 * 
	 * @action getByIds
	 * @param string $entryIds Comma separated string of entry ids
	 * @return KalturaBaseEntryArray Array of base entry ids
	 */
	function getByIdsAction($entryIds)
	{
		$entryIdsArray = explode(",", $entryIds);
		
		// remove white spaces
		foreach($entryIdsArray as &$entryId)
			$entryId = trim($entryId);
			
	 	$list = entryPeer::retrieveByPKs($entryIdsArray);
		$newList = array();
		
		$ks = $this->getKs();
		$isAdmin = false;
		if($ks)
			$isAdmin = $ks->isAdmin();
			
	 	foreach($list as $dbEntry)
	 	{
	 		$entry = KalturaEntryFactory::getInstanceByType($dbEntry->getType(), $isAdmin);
		    $entry->fromObject($dbEntry);
		    $newList[] = $entry;
	 	}
	 	
	 	return $newList;
	}

	/**
	 * Delete an entry.
	 *
	 * @action delete
	 * @param string $entryId Entry id to delete
	 */
	function deleteAction($entryId)
	{
		$this->deleteEntry($entryId);
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
	    myDbHelper::$use_alternative_con = myDbHelper::DB_HELPER_CONN_PROPEL3;
		

	    list($list, $totalCount) = parent::listEntriesByFilter($filter, $pager);
	    
		$ks = $this->getKs();
		$isAdmin = false;
		if($ks)
			$isAdmin = $ks->isAdmin();
			
	    $newList = KalturaBaseEntryArray::fromEntryArray($list, $isAdmin);
		$response = new KalturaBaseEntryListResponse();
		$response->objects = $newList;
		$response->totalCount = $totalCount;
		return $response;
	}
	
	/**
	 * Count base entries by filter.
	 * 
	 * @action count
     * @param KalturaBaseEntryFilter $filter Entry filter
	 * @return int
	 */
	function countAction(KalturaBaseEntryFilter $filter = null)
	{
	    return parent::countEntriesByFilter($filter);
	}
	
	/**
	 * Upload a file to Kaltura, that can be used to create an entry. 
	 * 
	 * @action upload
	 * @param file $fileData The file data
	 * @return string Upload token id
	 */
	function uploadAction($fileData)
	{
		$ksUnique = $this->getKsUniqueString();
		
		$uniqueId = substr(base_convert(md5(uniqid(rand(), true)), 16, 36), 1, 20);
		
		$ext = pathinfo($fileData["name"], PATHINFO_EXTENSION);
		$token = $ksUnique."_".$uniqueId.".".$ext;
		// filesync ok
		$res = myUploadUtils::uploadFileByToken($fileData, $token, "", null, true);
	
		return $res["token"];
	}
	
	/**
	 * Update entry thumbnail using a raw jpeg file
	 * 
	 * @action updateThumbnailJpeg
	 * @param string $entryId Media entry id
	 * @param file $fileData Jpeg file data
	 * @return KalturaBaseEntry The media entry
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 * @throws KalturaErrors::PERMISSION_DENIED_TO_UPDATE_ENTRY
	 */
	function updateThumbnailJpegAction($entryId, $fileData)
	{
		return parent::updateThumbnailJpegForEntry($entryId, $fileData);
	}
	
	/**
	 * Update entry thumbnail using url
	 * 
	 * @action updateThumbnailFromUrl
	 * @param string $entryId Media entry id
	 * @param string $url file url
	 * @return KalturaBaseEntry The media entry
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 * @throws KalturaErrors::PERMISSION_DENIED_TO_UPDATE_ENTRY
	 */
	function updateThumbnailFromUrlAction($entryId, $url)
	{
		return parent::updateThumbnailForEntryFromUrl($entryId, $url);
	}
	
	/**
	 * Update entry thumbnail from a different entry by a specified time offset (In seconds)
	 * 
	 * @action updateThumbnailFromSourceEntry
	 * @param string $entryId Media entry id
	 * @param string $sourceEntryId Media entry id
	 * @param int $timeOffset Time offset (in seconds)
	 * @return KalturaBaseEntry The media entry
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 * @throws KalturaErrors::PERMISSION_DENIED_TO_UPDATE_ENTRY
	 */
	function updateThumbnailFromSourceEntryAction($entryId, $sourceEntryId, $timeOffset)
	{
		return parent::updateThumbnailForEntryFromSourceEntry($entryId, $sourceEntryId, $timeOffset);
	}
	
	/**
	 * Flag inappropriate entry for moderation
	 *
	 * @action flag
	 * @param string $entryId
	 * @param KalturaModerationFlag $moderationFlag
	 * 
 	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	public function flagAction(KalturaModerationFlag $moderationFlag)
	{
		return parent::flagEntry($moderationFlag);
	}
	
	/**
	 * Reject the entry and mark the pending flags (if any) as moderated (this will make the entry non playable)
	 *
	 * @action reject
	 * @param string $entryId
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	public function rejectAction($entryId)
	{
		parent::rejectEntry($entryId);
	}
	
	/**
	 * Approve the entry and mark the pending flags (if any) as moderated (this will make the entry playable) 
	 *
	 * @action approve
	 * @param string $entryId
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	public function approveAction($entryId)
	{
		parent::approveEntry($entryId);
	}
	
	/**
	 * List all pending flags for the entry
	 *
	 * @action listFlags
	 * @param string $entryId
	 * @param KalturaFilterPager $pager
	 * 
	 * @return KalturaModerationFlagListResponse
	 */
	public function listFlags($entryId, KalturaFilterPager $pager = null)
	{
		return parent::listFlagsForEntry($entryId, $pager);
	}
	
	/**
	 * Anonymously rank an entry, no validation is done on duplicate rankings
	 *  
	 * @action anonymousRank
	 * @param string $entryId
	 * @param int $rank
	 */
	public function anonymousRankAction($entryId, $rank)
	{
		return parent::anonymousRankEntry($entryId, null, $rank);
	}
	
	/**
	 * @action getContextData
	 * @param string $entryId
	 * @param KalturaEntryContextDataParams $contextDataParams
	 * @return KalturaEntryContextDataResult
	 */
	public function getContextData($entryId, KalturaEntryContextDataParams $contextDataParams)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);
		if (!$dbEntry)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		$ks = $this->getKs();
		$isAdmin = false;
		if($ks)
			$isAdmin = $ks->isAdmin();
			
		$accessControl = $dbEntry->getAccessControl();
		$result = new KalturaEntryContextDataResult();
		$result->isAdmin = $isAdmin;
		$result->isScheduledNow = $dbEntry->isScheduledNow();

		// defaults
		$result->isSiteRestricted = false;
		$result->isCountryRestricted = false;
		$result->isSessionRestricted = false;
		$result->previewLength = -1;
		if ($accessControl)
		{
			KalturaResponseCacher::disableCache();
			
			$accessControlScope = accessControlScope::partialInit();
			$accessControlScope->setReferrer($contextDataParams->referrer);
			$accessControlScope->setKs($this->getKs());
            $accessControlScope->setEntryId($entryId);
			$accessControl->setScope($accessControlScope);

			
			if ($accessControl->hasSiteRestriction())
				$result->isSiteRestricted = !$accessControl->getSiteRestriction()->isValid();
				
			if ($accessControl->hasCountryRestriction())
				$result->isCountryRestricted = !$accessControl->getCountryRestriction()->isValid();
				
			if ($accessControl->hasSessionRestriction())
				$result->isSessionRestricted = !$accessControl->getSessionRestriction()->isValid();
				
			if ($accessControl->hasPreviewRestriction())
			{
				$result->isSessionRestricted = !$accessControl->getPreviewRestriction()->isValid();
				$result->previewLength = $accessControl->getPreviewRestriction()->getPreviewLength();
			}
		}
		
		return $result;
	}
}
