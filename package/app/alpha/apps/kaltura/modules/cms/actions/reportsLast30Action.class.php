<?php

require_once ( "kalturaCmsAction.class.php" );

class reportsLast30Action extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$last24HoursTimeStamp = time() - 24 * 60 * 60;
		$last7DaysTimeStamp = time() - 7 * 24 * 60 * 60;
		
		$reportSummury['shows']['total'] = $this->getTotalShowsByPeriod($partner_id, null, null);
		$reportSummury['shows']['day'] = $this->getTotalShowsByPeriod($partner_id, $last24HoursTimeStamp, null);
		$reportSummury['shows']['week'] = $this->getTotalShowsByPeriod($partner_id, $last7DaysTimeStamp, null);
		
		$reportSummury['entries']['total'] = $this->getTotalEntriesByPeriod($partner_id, null, null);
		$reportSummury['entries']['day'] = $this->getTotalEntriesByPeriod($partner_id, $last24HoursTimeStamp, null);
		$reportSummury['entries']['week'] = $this->getTotalEntriesByPeriod($partner_id, $last7DaysTimeStamp, null);
		
		$reportSummury['users']['total'] = $this->getTotalUsersByPeriod($partner_id, null, null);
		$reportSummury['users']['day'] = $this->getTotalUsersByPeriod($partner_id, $last24HoursTimeStamp, null);
		$reportSummury['users']['week'] = $this->getTotalUsersByPeriod($partner_id, $last7DaysTimeStamp, null);
		
		$reportSummury['views']['total'] = $this->getTotalViewsByPeriod($partner_id, null, null);
		$reportSummury['views']['day'] = $this->getTotalViewsByPeriod($partner_id, $last24HoursTimeStamp, null);
		$reportSummury['views']['week'] = $this->getTotalViewsByPeriod($partner_id, $last7DaysTimeStamp, null);
		
		$reportSummury['moderation_queue'] = $this->getModerationQueueCount();
		
		
		$this->reportSummury = $reportSummury;
		sfView::SUCCESS;
	}
	
	private function getTotalShowsByPeriod($partner_id, $startDate, $endDate) 
	{
		$c = new Criteria();
		$c->addSelectColumn("count(*)");
		$c->addAnd(kshowPeer::PARTNER_ID, $partner_id); // just for caution
		kshowPeer::getCriteriaFilter()->applyFilter($c);
		
		if ($startDate)
			$c->addAnd(kshowPeer::CREATED_AT, $startDate, Criteria::GREATER_EQUAL);
		if ($endDate)
			$c->addAnd(kshowPeer::CREATED_AT, $endDate, Criteria::LESS_EQUAL);
		
		$rs = BasePeer::doSelect($c);
		
		if ($rs->next())
			return $rs->getInt(1);
		else
			return 0;
	}
	
	private function getTotalEntriesByPeriod($partner_id, $startDate, $endDate) 
	{
		$c = new Criteria();
		$c->addSelectColumn("count(*)");
		$c->addAnd(entryPeer::PARTNER_ID, $partner_id); // just for caution
		entryPeer::getCriteriaFilter()->applyFilter($c);
		
		if ($startDate)
			$c->addAnd(entryPeer::CREATED_AT, $startDate, Criteria::GREATER_EQUAL);
		if ($endDate)
			$c->addAnd(entryPeer::CREATED_AT, $endDate, Criteria::LESS_EQUAL);
		
		$rs = BasePeer::doSelect($c);
		
		if ($rs->next())
			return $rs->getInt(1);
		else
			return 0;
	}
	
	private function getTotalUsersByPeriod($partner_id, $startDate, $endDate) 
	{
		$c = new Criteria();
		$c->addSelectColumn("count(*)");
		$c->addAnd(kuserPeer::PARTNER_ID, $partner_id); // just for caution
		kuserPeer::getCriteriaFilter()->applyFilter($c);
		
		if ($startDate)
			$c->addAnd(kuserPeer::CREATED_AT, $startDate, Criteria::GREATER_EQUAL);
		if ($endDate)
			$c->addAnd(kuserPeer::CREATED_AT, $endDate, Criteria::LESS_EQUAL);
		
		$rs = BasePeer::doSelect($c);
		
		if ($rs->next())
			return $rs->getInt(1);
		else
			return 0;
	}
	
	private function getTotalViewsByPeriod($partner_id, $startDate, $endDate) 
	{/*
		$c = new Criteria();
		$c->addSelectColumn("count(*)");
		$c->addAnd(kuserPeer::PARTNER_ID, $partner_id); // just for caution
		kuserPeer::getCriteriaFilter()->applyFilter($c);
		
		if ($startDate)
			$c->addAnd(kuserPeer::CREATED_AT, $startDate, Criteria::GREATER_EQUAL);
		if ($endDate)
			$c->addAnd(kuserPeer::CREATED_AT, $endDate, Criteria::LESS_EQUAL);
		
		$rs = BasePeer::doSelect($c);
		
		if ($rs->next())
			return $rs->getInt(1);
		else
*/
			return 'N/A';
	}
	
	private function getModerationQueueCount() 
	{
		$partnerServicesHelper = new PartnerServicesClientHelper($this->getUser());
		$params = Array(
			"filter__eq_object_type" => moderation::MODERATION_OBJECT_TYPE_ENTRY,
			"filter__eq_status" => moderation::MODERATION_STATUS_PENDING,
			"page_size" => 100,
			"page" => 1,
			"detailed" => false
		);
		
		$service_result = $partnerServicesHelper->execute("listmoderations", $params);
		$listmoderations_results = @$service_result["result"]["moderations"];
		$count = @$service_result["result"]["count"];
				
		return $count;
	}
}
?>