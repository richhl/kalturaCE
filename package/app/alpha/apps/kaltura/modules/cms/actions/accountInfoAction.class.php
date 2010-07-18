<?php

require_once ( "kalturaCmsAction.class.php" );

class accountInfoAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$this->partner = PartnerPeer::retrieveByPK($partner_id);
		$this->sub_partner_id = $this->partner->getId() * 100;
		sfView::SUCCESS;
	}
}
?>