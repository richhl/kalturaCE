<?php

require_once ( "kalturaAction.class.php" );

class kmc2Action extends kalturaAction
{
	public function execute ( ) 
	{
		
		sfView::SUCCESS;
		$this->module = $this->getP ( "module" , "content" );
		$this->partner_id = $this->getP ( "partner_id" );
		$this->subp_id = $this->getP ( "subp_id" );
		$this->uid = $this->getP ( "uid" );
		$this->ks = $this->getP ( "ks" );
		$this->screen_name = $this->getP ( "screen_name" );
		$this->email = $this->getP ( "email" );
		
		$this->beta = $this->getRequestParameter( "beta" );
		
		$this->embed_code  = "";
		$this->ui_conf_width = "";
		$this->ui_conf_height = "";
		if ( $this->partner_id !== null )
		{
			$widget = widgetPeer::retrieveByPK( "_" . $this->partner_id );
			if ( $widget )
			{
				$this->embed_code = $widget->getWidgetHtml( "kaltura_player" );
				
				$ui_conf = $widget->getuiConf();
//				$this->ui_conf_width = 0; // $ui_conf->getWidth();
//				$this->ui_conf_height = 0 ; // $ui_conf->getHeight();
			}
		}
		
		$this->visibleCT = 'false';
		if(kConf::get('kmc_content_enable_commercial_transcoding') && $this->partner_id)
		{
			$partner = PartnerPeer::retrieveByPK($this->partner_id);
			if ($partner)
			{
				if ($partner->getPartnerPackage() != PartnerPackages::PARTNER_PACKAGE_FREE )
				{
					$this->visibleCT = 'true';
				}
			}
		}
		
		$c = $this->getCritria();
		$c->addAnd ( uiConfPeer::TAGS, "%playlist%" , Criteria::LIKE ); //
		$this->playlist_uiconf_list = uiConfPeer::doSelect( $c );

		$c = $this->getCritria();
		$c->addAnd ( uiConfPeer::TAGS, "%player%" , Criteria::LIKE ); //
		$this->player_uiconf_list = uiConfPeer::doSelect( $c );
		
		$this->first_login = false;
		
		if ( ! $this->module )
		{
			$this->redirect( "kmc/kmc" );
			die();
		}
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