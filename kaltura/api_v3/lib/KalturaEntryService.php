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
		
		if ($filter->userIdEqual !== null)
		{
		    // the user_id is infact a puser_id and the kuser_id should be retrieved
		    $targetPuserId = $filter->userIdEqual;
			$puserKuser = PuserKuserPeer::retrieveByPartnerAndUid($this->getPartnerId(), null, $targetPuserId, false);
			if ($puserKuser)
			{
				$filter->userIdEqual = $puserKuser->getkuserId();
			}
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
		$kshow->setAllowQuickEdit(true);
		$kshow->save();
		
		return $kshow;
	}
}