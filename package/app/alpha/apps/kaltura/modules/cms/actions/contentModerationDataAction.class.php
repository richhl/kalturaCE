<?php

require_once ( "kalturaCmsAction.class.php" );
require_once ( "dateUtils.class.php" );
require_once ( "mySearchUtils.class.php" );

class contentModerationDataAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) 
	{
		$partnerServicesHelper = new PartnerServicesClientHelper($this->getUser());
		
		$page_index = $this->getRequestParameter("pageIndex", 1);
		$page_size = $this->getRequestParameter("pageSize", 20);
		$moderation_display = $this->getRequestParameter("moderationDisplay", 0);
		
		if (!ctype_digit($page_index))
			return sfView::ERROR;
		$page_index = (int)$page_index;

		if (!ctype_digit($page_size))
			return sfView::ERROR;
		$page_size = (int)$page_size;
		
		$moderation_status = -1;
		switch($moderation_display) {
			case "0":
				$moderation_status = moderation::MODERATION_STATUS_PENDING;
				break;
			case "1":
				$moderation_status = moderation::MODERATION_STATUS_REVIEW;
				break;
			case "2":
				$moderation_status = moderation::MODERATION_STATUS_BLOCK;
				break;
			default:
				return $this->renderText("ERROR");
		}

		// limit page size
		$page_size = min ($page_size, 100);
		
		$params = Array(
			"filter__eq_object_type" => moderation::MODERATION_OBJECT_TYPE_ENTRY,
			"filter__eq_status" => $moderation_status,
			"page_size" => $page_size,
			"page" => $page_index,
			"detailed" => false,
			"filter__order_by" => "-id"
		);
		
		$service_result = $partnerServicesHelper->execute("listmoderations", $params);
		$listmoderations_results = @$service_result["result"]["moderations"];
		$count = @$service_result["result"]["count"];
		if (!$listmoderations_results)
			$listmoderations_results = array();
			
		$moderations = array();
		foreach($listmoderations_results as $res) {
			$moderation_unwrapped = $res->getWrappedObj();
			$moderation_unwrapped->moderated_object = entryPeer::retrieveByPK($moderation_unwrapped->getObjectId());
			$moderations[] = $moderation_unwrapped; 
		}
				
		$this->count = $count;
		$this->moderations = $moderations;
		$this->moderation_display = $moderation_display;
		
		return sfView::SUCCESS;
	}
}
?>