<?php
class EntryManager extends ManagerBase
{
	public function addEntry(KalturaBaseEntry $entry)
	{
		$entryDb = new entry();
		$entryDb->setName($entry->name);
		$entryDb->setDescription($entry->description);
			
		// check if trying to add entry to a specific user (not the one initiated the session)
		if ($entry->userId !== null && $entry->userId !== $this->ks->userId)
		{
			if ($this->ks->canAccessUser($entry->userId))
				$entryDb->setUserId($entry->userId);
			else
				throw new KalturaAPIException(KalturaErrors::INVALID_KS, $this->ks->ksString, "", "") ;// FIXME: Add the session error code & description
		}
		else
		{
			$entryDb->setUserId($this->ks->userId);
		}
			
		if ($entry->adminTags !== null && !$this->ks->hasPrivileges("updateAdminTags"))
			throw new KalturaAPIException(KalturaErrors::INVALID_PRIVILEGES, "updateAdminTags");
			
		$entryDb->getPartnerId($this->ks->partnerId);
		
		$entryDb->getGroupId($entry->groupId);
		$entryDb->getPartnerData($entry->partnerData);
		$entryDb->getLicenseType($entry->licenseType);
	}
}