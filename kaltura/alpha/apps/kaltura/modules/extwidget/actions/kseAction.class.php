<?php

class kseAction extends sfAction
{
	// TODO - this is no longer se only - it should be generalized for advanced editro and simple editor
	/**
	 * Will forward to the regular swf player according to the widget_id 
	 */
	public function execute()
	{
		$ui_conf_id = $this->getRequestParameter( "ui_conf_id" );
		
		$uiConf = uiConfPeer::retrieveByPK( $ui_conf_id );
		
		if ( !$uiConf )
		{
			die();	
		}
		
		$partner_id = $uiConf->getPartnerId();
		$subp_id = $uiConf->getSubpId();
		
		$host = requestUtils::getRequestHost();
		
		$ui_conf_swf_url = $uiConf->getSwfUrl();
		if (!$ui_conf_swf_url)
			$ui_conf_swf_url = "/swf/simpleeditor.swf";
			
		if( kString::beginsWith( $ui_conf_swf_url , "http") )
		{
			$swf_url = 	$ui_conf_swf_url; // absolute URL 
		}
		else
		{
			$use_cdn = $uiConf->getUseCdn();
			$cdn_host = $use_cdn ?  requestUtils::getCdnHost() : requestUtils::getRequestHost();
			$swf_url = 	$cdn_host . myPartnerUtils::getUrlForPartner( $partner_id , $subp_id ) .  $ui_conf_swf_url ; // relative to the current host
		}

		// handle buggy case for backward compatiblity
		$partner_host = $host;
		if ($partner_host == "http://www.kaltura.com")
			$partner_host = 1; // otherwise the kse will build a flawed url with [[IMPORT]]
				
		$params = "contentUrl=".urlencode($swf_url).
			"&host=" . str_replace("http://", "", $partner_host).
			"&cdnHost=". str_replace("http://", "", requestUtils::getCdnHost()).
			"&uiConfId=" . $ui_conf_id;
			
		$this->redirect(  $host . myPartnerUtils::getUrlForPartner( $partner_id , $subp_id ) . "/swf/FlexWrapper.swf?$params");
	}
}
?>
