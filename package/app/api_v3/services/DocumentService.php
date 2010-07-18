<?php

/**
 * Document service lets you upload and manage document files
 *
 * @service document
 * @package api
 * @subpackage services
 */
class DocumentService extends KalturaEntryService
{
	/**
	 * Add new document entry after the specific document file was uploaded and the upload token id exists
	 *
	 * @action addFromUploadedFile
	 * @param KalturaDocumentEntry $documentEntry Document entry metadata
	 * @param string $uploadTokenId Upload token id
	 * @return KalturaDocumentEntry The new document entry
	 * 
	 * @throws KalturaErrors::PROPERTY_VALIDATION_MIN_LENGTH
	 * @throws KalturaErrors::PROPERTY_VALIDATION_CANNOT_BE_NULL
	 * @throws KalturaErrors::UPLOADED_FILE_NOT_FOUND_BY_TOKEN
	 */
	function addFromUploadedFileAction(KalturaDocumentEntry $documentEntry, $uploadTokenId)
	{
		try
	    {
	    	// check that the uploaded file exists
			$entryFullPath = kUploadTokenMgr::getFullPathByUploadTokenId($uploadTokenId);
			
			if (!file_exists($entryFullPath))
				throw new KalturaAPIException(KalturaErrors::UPLOADED_FILE_NOT_FOUND_BY_TOKEN);
				
			// validate the input object
	        //$documentEntry->validatePropertyMinLength("name", 1);
	        $documentEntry->validatePropertyNotNull("documentType");
			if (!$documentEntry->name)
				$documentEntry->name = $this->getPartnerId().'_'.time();
			
			// first copy all the properties to the db entry, then we'll check for security stuff
			$dbEntry = $documentEntry->toObject(new entry());
	        
			$this->checkAndSetValidUser($documentEntry, $dbEntry);
			$this->checkAdminOnlyInsertProperties($documentEntry);
			$this->validateAccessControlId($documentEntry);
			$this->validateEntryScheduleDates($documentEntry);
				
			$dbEntry->setPartnerId($this->getPartnerId());
			$dbEntry->setSubpId($this->getPartnerId() * 100);
			$dbEntry->setStatusReady();
			$dbEntry->save();
			
			$kshow = $this->createDummyKShow();
	        $kshowId = $kshow->getId();
				
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
	
			$documentEntry->fromObject($dbEntry);
			return $documentEntry;
	    }
		catch(kCoreException $ex)
	    {
	    	if ($ex->getCode() == kUploadTokenException::UPLOAD_TOKEN_INVALID_STATUS);
	    		throw new KalturaAPIException(KalturaErrors::UPLOAD_TOKEN_INVALID_STATUS_FOR_ADD_ENTRY);
	    		
    		throw $ex;
	    }
	}
	
	/**
	 * Get document entry by ID.
	 * 
	 * @action get
	 * @param string $entryId Document entry id
	 * @param int $version Desired version of the data
	 * @return KalturaDocumentEntry The requested document entry
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	function getAction($entryId, $version = -1)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::DOCUMENT)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);

		if ($version !== -1)
			$dbEntry->setDesiredVersion($version);
			
		$docEntry = new KalturaDocumentEntry();
		$docEntry->fromObject($dbEntry);

		return $docEntry;
	}
	
	/**
	 * Update document entry. Only the properties that were set will be updated.
	 * 
	 * @action update
	 * @param string $entryId Document entry id to update
	 * @param KalturaDocumentEntry $documentEntry Document entry metadata to update
	 * @return KalturaDocumentEntry The updated document entry
	 * 
	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	function updateAction($entryId, KalturaDocumentEntry $documentEntry)
	{
		return $this->updateEntry($entryId, $documentEntry, KalturaEntryType::DOCUMENT);
	}
	
	/**
	 * Delete a document entry.
	 *
	 * @action delete
	 * @param string $entryId Document entry id to delete
	 * 
 	 * @throws KalturaErrors::ENTRY_ID_NOT_FOUND
	 */
	function deleteAction($entryId)
	{
		$this->deleteEntry($entryId, KalturaEntryType::DOCUMENT);
	}
	
	/**
	 * List document entries by filter with paging support.
	 * 
	 * @action list
     * @param KalturaDocumentEntryFilter $filter Document entry filter
	 * @param KalturaFilterPager $pager Pager
	 * @return KalturaDocumentListResponse Wrapper for array of document entries and total count
	 */
	function listAction(KalturaDocumentEntryFilter $filter = null, KalturaFilterPager $pager = null)
	{
	    if (!$filter)
			$filter = new KalturaDocumentEntryFilter();
			
	    $filter->typeEqual = KalturaEntryType::DOCUMENT;
	    list($list, $totalCount) = parent::listEntriesByFilter($filter, $pager);
	    
	    $newList = KalturaDocumentEntryArray::fromEntryArray($list);
		$response = new KalturaDocumentListResponse();
		$response->objects = $newList;
		$response->totalCount = $totalCount;
		return $response;
	}
	
	/**
	 * Upload a document file to Kaltura, then the file can be used to create a document entry. 
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
		
		$res = myUploadUtils::uploadFileByToken($fileData, $token, "", null, true);
	
		return $res["token"];
	}
	
	/**
	 * This will queue a batch job for converting the ppt file to swf
	 * Returns the URL where the new swf will be available 
	 * 
	 * @action convertPptToSwf
	 * @param string $entryId
	 * @return string
	 */
	function convertPptToSwf($entryId)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || $dbEntry->getType() != KalturaEntryType::DOCUMENT)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		$job = myBatchOpenOfficeConvert::addJob($this->getKuser()->getPuserId(), $dbEntry, null, 'swf');
		if (is_array($job))
			$job = $job[0];
			
		$jobData = json_decode($job->getData());
		$downloadPath = $dbEntry->getDownloadUrl().'/direct_serve/true/type/download/forceproxy/true/format/swf';
		KalturaLog::info("Added myBatchOpenOfficeConvert batch job #".$job->getId());
		
		return $downloadPath;
	}
}
