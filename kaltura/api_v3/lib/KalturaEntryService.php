<?php

class KalturaEntryService extends KalturaBaseService 
{
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
			$dbEntry->setKuserId($this->getPuserKuser()->getKuserId());
		}
	}
	
	protected function createDummyKShow()
	{
		$kshow = new kshow();
		$kshow->setName("DUMMY KSHOW FOR API V3");
		$kshow->setProducerId( $this->getPuserKuser()->getKuserId() );
		$kshow->setPartnerId( $this->getPartnerId() );
		$kshow->setSubpId( $this->getPartnerId() * 100 );
		$kshow->setViewPermissions( kshow::KSHOW_PERMISSION_EVERYONE );
		$kshow->setPermissions( myPrivilegesMgr::PERMISSIONS_PUBLIC );
		$kshow->save();
		
		return $kshow;
	}
}