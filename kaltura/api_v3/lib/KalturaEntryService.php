<?php

class KalturaEntryService extends KalturaBaseService 
{
	protected function listEntriesByFilter(KalturaBaseEntryFilter $filter = null, KalturaFilterPager $pager = null)
	{
		if (!$filter)
			$filter = new KalturaBaseEntryFilter();

		if (!$pager)
			$pager = new KalturaFilterPager();
			
		$entryFilter = new entryFilter();
		
		// when session is not admin, allow access to user entries only
		if (!$this->getKs()->isAdmin())
		{
			$filter->userIdEqual = $this->getKuser()->getPuserId();
		}
		
		if ($filter->userIdEqual !== null)
		{
			// the user_id is infact a puser_id and the kuser_id should be retrieved
			$filter->userIdEqual = $this->getKuser()->getId();
		}
		$filter->toObject($entryFilter);

		$c = new Criteria();
		$entryFilter->attachToCriteria($c);
		
		$totalCount = entryPeer::doCount($c);
		
		$pager->attachToCriteria($c);
		$list = entryPeer::doSelect($c);
		
		return array($list, $totalCount);        
    	}
    
	protected function checkAndSetValidUser(KalturaBaseEntry $entry, entry $dbEntry)
	{
		// check if trying to add entry to a specific user (not the one initiated the session)
		if ($entry->userId !== null && $entry->userId !== $this->getKs()->user)
		{
			if ($this->getKs()->isAdmin())
			{
				// make sure we created the user
				$puserKuser = PuserKuserPeer::createPuserKuser($this->getPartnerId(), $this->getPartnerId() * 100, $entry->userId, $entry->userId, $entry->userId, true);
				
				$dbEntry->setKuserId($puserKuser->getKuserId());
			}
			else
			{
				throw new KalturaAPIException(KalturaErrors::INVALID_KS, "", ks::INVALID_TYPE, ks::getErrorStr(ks::INVALID_TYPE));
			}
		}
		else
		{
			$dbEntry->setKuserId($this->getKuser()->getId());
		}
	}
	
	protected function createDummyKShow()
	{
		$kshow = new kshow();
		$kshow->setName("DUMMY KSHOW FOR API V3");
		$kshow->setProducerId($this->getKuser()->getId());
		$kshow->setPartnerId($this->getPartnerId());
		$kshow->setSubpId($this->getPartnerId() * 100);
		$kshow->setViewPermissions(kshow::KSHOW_PERMISSION_EVERYONE);
		$kshow->setPermissions(myPrivilegesMgr::PERMISSIONS_PUBLIC);
		$kshow->setAllowQuickEdit(true);
		$kshow->save();
		
		return $kshow;
	}
	
	public function updateThumbnailJpegForEntry($entryId, $fileData, $entryType)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);

		if (!$dbEntry || ($entryType !== null && $dbEntry->getType() != $entryType))
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		// if session is not admin, we should check that the user that is updating the thumbnail is the one created the entry
		// FIXME: Temporary disabled because update thumbnail feature (in app studio) is working with anonymous ks
		/*if (!$this->getKs()->isAdmin())
		{
			if ($dbEntry->getPuserId() !== $this->getKs()->user)
			{
				throw new KalturaAPIException(KalturaErrors::PERMISSION_DENIED_TO_UPDATE_ENTRY);
			}
		}*/
		
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
	
	public function flagEntry(KalturaModerationFlag $moderationFlag, $entryType = null)
	{
		$moderationFlag->validatePropertyNotNull("flaggedEntryId");

		$entryId = $moderationFlag->flaggedEntryId;
		$dbEntry = entryPeer::retrieveByPKNoFilter($entryId);

		if (!$dbEntry || ($entryType !== null && $dbEntry->getType() != $entryType))
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		$dbModerationFlag = new moderationFlag();
		$dbModerationFlag->setPartnerId($dbEntry->getPartnerId());
		$dbModerationFlag->setKuserId($this->getKuser()->getId());
		$dbModerationFlag->setFlaggedEntryId($dbEntry->getId());
		$dbModerationFlag->setObjectType(KalturaModerationObjectType::ENTRY);
		$dbModerationFlag->setStatus(KalturaModerationFlagStatus::PENDING);
		$dbModerationFlag->setFlagType($moderationFlag->flagType);
		$dbModerationFlag->setComments($moderationFlag->comments);
		$dbModerationFlag->save();
		
		$moderationCount = $dbEntry->getModerationCount();
		$dbEntry->setModerationCount($moderationCount + 1);
		$dbEntry->save();
		
		$moderationFlag = new KalturaModerationFlag();
		$moderationFlag->fromObject($dbModerationFlag);
		return $moderationFlag;
	}
	
	public function rejectEntry($entryId, $entryType = null)
	{
		$dbEntry = entryPeer::retrieveByPK($entryId);
		if (!$dbEntry || ($entryType !== null && $dbEntry->getType() != $entryType))
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		myEntryUtils::deleteEntry($dbEntry);
		$dbEntry->setModerationCount(0);
		$dbEntry->save();
		myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_BLOCK , $dbEntry->getId());
		
		moderationFlagPeer::markAsModeratedByEntryId($this->getPartnerId(), $dbEntry->getId());
	}
	
	public function approveEntry($entryId, $entryType = null)
	{
		entryPeer::allowDeletedInCriteriaFilter();
		$dbEntry = entryPeer::retrieveByPK($entryId);
		entryPeer::blockDeletedInCriteriaFilter();
		if (!$dbEntry || ($entryType !== null && $dbEntry->getType() != $entryType))
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $entryId);
			
		myEntryUtils::undeleteEntry($dbEntry);
		$dbEntry->setStatus(entry::ENTRY_STATUS_READY);
		$dbEntry->setModerationCount(0);
		$dbEntry->save();
		
		myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_BLOCK , $dbEntry->getId());
		
		moderationFlagPeer::markAsModeratedByEntryId($this->getPartnerId(), $dbEntry->getId());
	}
	
	public function listFlagsForEntry($entryId, KalturaFilterPager $pager = null)
	{
		if (!$pager)
			$pager = new KalturaFilterPager();
			
		$c = new Criteria();
		$c->addAnd(moderationFlagPeer::PARTNER_ID, $this->getPartnerId());
		$c->addAnd(moderationFlagPeer::FLAGGED_ENTRY_ID, $entryId);
		$c->addAnd(moderationFlagPeer::OBJECT_TYPE, KalturaModerationObjectType::ENTRY);
		$c->addAnd(moderationFlagPeer::STATUS, KalturaModerationFlagStatus::PENDING);
		
		$pager->attachToCriteria($c);
		$totalCount = moderationFlagPeer::doCount($c);
		$list = moderationFlagPeer::doSelect($c);
		
		$newList = KalturaModerationFlagArray::fromModerationFlagArray($list);
		$response = new KalturaModerationFlagListResponse();
		$response->objects = $newList;
		$response->totalCount = $totalCount;
		return $response;
	}
}