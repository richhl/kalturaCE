<?php

class kaeAction extends sfAction
{
	/**
	 * Will forward to the advanced editor swf according to the ui_conf_id 
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
		{
			die();
		}
			
		if( kString::beginsWith( $ui_conf_swf_url , "http") )
		{
			$swf_url = 	$ui_conf_swf_url; // absolute URL 
		}
		else
		{
			$use_cdn = $uiConf->getUseCdn();
			$cdn_host = $use_cdn ?  requestUtils::getCdnHost() : requestUtils::getRequestHost();
			$swf_url = 	$cdn_host . myPartnerUtils::getUrlForPartner( $partner_id , $subp_id ) . $ui_conf_swf_url ; // relative to the current host 
		}
			
		$params = "contentUrl=".urlencode($swf_url).
			"&host=" . str_replace("http://", "", requestUtils::getRequestHost()).
			"&cdnHost=". str_replace("http://", "", requestUtils::getCdnHost()).
			"&uiConfId=" . $ui_conf_id;
			
		$this->redirect(  $cdn_host . myPartnerUtils::getUrlForPartner( $partner_id , $subp_id ) . "/swf/FlexWrapper.swf?$params");
	}
}
?>
