<?php

require_once ( "kalturaCmsAction.class.php" );
require_once (MODULES.'cms/lib/partnerServicesClientHelper.php');

class deleteEntriesAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$entry_ids = $_POST["entryIds"];
		
		if (!is_array($entry_ids))
		{
			return $this->renderText("Error");
		}
		
		$partnerServicesHelper = new PartnerServicesClientHelper($this->getUser());
		
		foreach ($entry_ids as $entry_id) 
		{
			$partnerServicesHelper->execute("deleteentry", Array("entry_id" => $entry_id));
		}
		
		return $this->renderText("");
	}
}
?>