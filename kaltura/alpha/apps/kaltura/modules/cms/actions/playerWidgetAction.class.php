<?php

require_once ( "kalturaCmsAction.class.php" );

class playerWidgetAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$kshow_id = $this->getRequestParameter("kshow_id");
		if (!$kshow_id)
			$kshow_id = "-1";
		$entry_id = $this->getRequestParameter("entry_id");
		if (!$entry_id)
			$entry_id = "-1";
			
		//widget/" . $kshow_id . "/-1/-1/3/-1";
		$this->swf_url = $this->getController()->genUrl("extwidget/kwidget?wid=371");

		
		$this->height = 379;
		$this->width = 410;
		
		$privileges = "view:*";
		$expiry = 86400;
		$puser_id = "__ANONYMOUS__";
		$result = kSessionUtils::createKSessionNoValidations($partner_id, $puser_id, $ks, $expiry, false, "", $privileges);
		
		$flash_vars = array (
			"kshowId" => $kshow_id,
			"entryId" => $entry_id,
			"partner_id" => $partner_id,
			"subp_id" => $partner_id * 100,
			"uid" => "",
			"ks" => $ks
		);
		
		$this->flash_vars_str = http_build_query($flash_vars , "" , "&");
		
		sfView::SUCCESS;
	}
}
?>