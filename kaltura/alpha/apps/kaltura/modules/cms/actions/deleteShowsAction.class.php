<?php

require_once ( "kalturaCmsAction.class.php" );
require_once (MODULES.'cms/lib/partnerServicesClientHelper.php');

class deleteShowsAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$show_ids = $_POST["showIds"];
		
		if (!is_array($show_ids))
		{
			return $this->renderText("Error");
		}
		
		$partnerServicesHelper = new PartnerServicesClientHelper($this->getUser());
		
		foreach ($show_ids as $show_id) 
		{
			$partnerServicesHelper->execute("deletekshow", Array("kshow_id" => $show_id));
		}
		
		return $this->renderText("");
	}
}
?>