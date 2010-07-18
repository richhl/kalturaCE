<?php

require_once ( "kalturaAction.class.php" );

class getuiconfsAction extends kalturaAction
{
	public function execute ( ) 
	{
		$this->partner_id = $this->getP ( "partner_id" );
		$this->ks = $this->getP ( "ks" );
		$type = $this->getP("type");
		
		$this->partner = PartnerPeer::retrieveByPK($this->partner_id);
		if (!$this->partner)
			die;
			
		$this->isKDP3 = ($this->partner->getKmcVersion() != '1')? true: false;
		
		$this->exclude_uiconfids = array();
		if($this->partner->getKmcVersion() == '2')
		{
			$this->exclude_uiconfids = array(48120, 48121, 48130, 48131, 48132, 48133, 48134, 48135);
		}
		elseif($this->partner->getKmcVersion() == '3')
		{
			$this->exclude_uiconfids = array(48501, 48502, 48504, 48505);
		}

		// FIXME: validate the ks!
		
		$uiconf_list = $this->getUiconfList($type);
		
		$uiconfs_array = array();
		foreach($uiconf_list as $uiconf)
		{
			$uiconf_array = array();
			$uiconf_array["id"] = $uiconf->getId();
			$uiconf_array["name"] = $uiconf->getName();
			$uiconf_array["width"] = $uiconf->getWidth();
			$uiconf_array["height"] = $uiconf->getHeight();
			$uiconf_array["swfUrlVersion"] = $uiconf->getSwfUrlVersion();
			$uiconf_array["swf_version"] = "v" . $uiconf->getSwfUrlVersion();

			$uiconfs_array[] = $uiconf_array;
		}
		$jw_confs = ($type == 'player')? kmcUtils::getJWPlayerUIConfs(): kmcUtils::getJWPlaylistUIConfs();
		return $this->renderText(json_encode(array_merge($uiconfs_array,$jw_confs)));
	}
	
	private function getUiconfList($tag = 'player')
	{
		$template_partner_id = (isset($this->templatePartnerId))? $this->templatePartnerId: 0;
		$c = new Criteria();
		$crit_partner = $c->getNewCriterion(uiConfPeer::PARTNER_ID, $this->partner_id);
		$crit_default = $c->getNewCriterion(uiConfPeer::DISPLAY_IN_SEARCH, mySearchUtils::DISPLAY_IN_SEARCH_KALTURA_NETWORK, Criteria::GREATER_EQUAL);
		
		$crit_default_partner_id = $c->getNewCriterion(uiConfPeer::PARTNER_ID, $template_partner_id);
		if($this->isKDP3)
		{
			$crit_default_swf_url = $c->getNewCriterion(uiConfPeer::SWF_URL, '%/kdp3/%kdp3.swf', Criteria::LIKE);
		}
		else
		{
			$crit_default_swf_url = $c->getNewCriterion(uiConfPeer::SWF_URL, '%/kdp3/%kdp3.swf', Criteria::NOT_LIKE);
		}
		$crit_default->addAnd($crit_default_partner_id);
		$crit_default->addAnd($crit_default_swf_url);
		
		$crit_partner->addOr($crit_default);
		$c->add($crit_partner);
		$c->addAnd(uiConfPeer::OBJ_TYPE, array(uiConf::UI_CONF_TYPE_WIDGET, uiConf::UI_CONF_TYPE_KDP3), Criteria::IN);
		$c->addAnd ( uiConfPeer::STATUS , uiConf::UI_CONF_STATUS_READY );
		$c->addAnd ( uiConfPeer::TAGS, '%'.$tag.'%', Criteria::LIKE );
		$c->addAnd ( uiConfPeer::TAGS, '%jw'.$tag.'%', Criteria::NOT_LIKE );
		
		if(count($this->exclude_uiconfids))
		{
			$c->addAnd ( uiConfPeer::ID, $this->exclude_uiconfids, Criteria::NOT_IN );
		}
		
		$order_by = "(" . uiConfPeer::PARTNER_ID . "=".$this->partner_id.")";
		$c->addAscendingOrderByColumn ( $order_by );
		$c->addDescendingOrderByColumn(uiConfPeer::CREATED_AT);
		
		$confs = uiConfPeer::doSelect($c);
		return $confs;
	}	
}
?>