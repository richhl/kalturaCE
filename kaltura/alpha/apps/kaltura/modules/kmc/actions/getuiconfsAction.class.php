<?php

require_once ( "kalturaAction.class.php" );

class getuiconfsAction extends kalturaAction
{
	public function execute ( ) 
	{
		$this->partner_id = $this->getP ( "partner_id" );
		$this->ks = $this->getP ( "ks" );
		$type = $this->getP("type");
		
		// FIXME: validate the ks!
		
		if ($type == "player")
		{
    	    $c = $this->getCritria();
		    $c->addAnd ( uiConfPeer::TAGS, "%player%" , Criteria::LIKE ); //
		    $uiconf_list = uiConfPeer::doSelect( $c );	
		}
		else if ($type == "playlist")
		{
		    $c = $this->getCritria();
    		$c->addAnd ( uiConfPeer::TAGS, "%playlist%" , Criteria::LIKE ); //
    		$uiconf_list = uiConfPeer::doSelect( $c );
		}
		
		$uiconfs_array = array();
		foreach($uiconf_list as $uiconf)
		{
		    $uiconf_array = array();
            $uiconf_array["id"] = $uiconf->getId();
            $uiconf_array["name"] = $uiconf->getName();
            $uiconf_array["width"] = $uiconf->getWidth();
            $uiconf_array["height"] = $uiconf->getHeight();

            $uiconfs_array[] = $uiconf_array;
		}
		return $this->renderText(json_encode($uiconfs_array));
	}
	
	private function getCritria ( )
	{
		$c = new Criteria();
		
		// or belongs to the partner or a template  
		$criterion = $c->getNewCriterion( uiConfPeer::PARTNER_ID , $this->partner_id ) ; // or belongs to partner
		$criterion2 = $c->getNewCriterion( uiConfPeer::DISPLAY_IN_SEARCH , mySearchUtils::DISPLAY_IN_SEARCH_KALTURA_NETWORK , Criteria::GREATER_EQUAL );	// or belongs to kaltura_network == templates
		
		// if template, it should belong to partner 0!
		$criterion2partnerId = $c->getNewCriterion(uiConfPeer::PARTNER_ID, 0);
		$criterion2->addAnd($criterion2partnerId);  
		
		$criterion->addOr ( $criterion2 ) ;
		$c->addAnd ( $criterion );
		
		$c->addAnd ( uiConfPeer::OBJ_TYPE , uiConf::UI_CONF_TYPE_WIDGET );	//	only ones that are of type WIDGET
		$c->addAnd ( uiConfPeer::STATUS , uiConf::UI_CONF_STATUS_READY ); 	//	display only ones that are ready - not deleted or in draft mode
		
		
		$order_by = "(" . uiConfPeer::PARTNER_ID . "={$this->partner_id})";  // first take the templates  and then the rest
		$c->addAscendingOrderByColumn ( $order_by );//, Criteria::CUSTOM );

		return $c;
	}
}
?>