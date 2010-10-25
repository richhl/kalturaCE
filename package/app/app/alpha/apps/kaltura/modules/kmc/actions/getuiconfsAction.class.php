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
			
		$this->templatePartnerId = $this->partner ? $this->partner->getTemplatePartnerId() : 0;
		$this->isKDP3 = ($this->partner->getKmcVersion() != '1')? true: false;

		// FIXME: validate the ks!
		
		
		$partnerUiconfs = kmcUtils::getPartnersUiconfs($this->partner_id, $type);
		$partner_uiconfs_array = array();
		foreach($partnerUiconfs as $uiconf)
		{
			$uiconf_array = array();
			$uiconf_array["id"] = $uiconf->getId();
			$uiconf_array["name"] = $uiconf->getName();
			$uiconf_array["width"] = $uiconf->getWidth();
			$uiconf_array["height"] = $uiconf->getHeight();
			$uiconf_array["swfUrlVersion"] = $uiconf->getSwfUrlVersion();
			$uiconf_array["swf_version"] = "v" . $uiconf->getSwfUrlVersion();

			$partner_uiconfs_array[] = $uiconf_array;
		}
		
		// default uiconf array
		$this->kmc_content_version = kConf::get('kmc_content_version');
		$contentTemplateConfs = kmcUtils::getAllKMCUiconfs('content',   $this->kmc_content_version, $this->templatePartnerId);
		$contentSystemConfs = kmcUtils::getAllKMCUiconfs('content',   $this->kmc_content_version, 0);
		if($type == 'player')
		{
			$silverLightTag = 'slp';
			$content_uiconfs_previewembed = kmcUtils::find_confs_by_usage_tag($contentTemplateConfs, "content_previewembed", true, $contentSystemConfs);
		}
		else
		{
			$silverLightTag = 'sll';
			$content_uiconfs_previewembed = kmcUtils::find_confs_by_usage_tag($contentTemplateConfs, "content_previewembed_list", true, $contentSystemConfs);
		}
		foreach($content_uiconfs_previewembed as $uiconf)
		{
			$uiconf_array = array();
			$uiconf_array["id"] = $uiconf->getId();
			$uiconf_array["name"] = $uiconf->getName();
			$uiconf_array["width"] = $uiconf->getWidth();
			$uiconf_array["height"] = $uiconf->getHeight();
			$uiconf_array["swfUrlVersion"] = $uiconf->getSwfUrlVersion();
			$uiconf_array["swf_version"] = "v" . $uiconf->getSwfUrlVersion();

			$default_uiconfs_array[] = $uiconf_array;
		}
		
		$silverlight_uiconfs = array();
		if($this->partner->getEnableSilverLight())
		{
			$silverlight_uiconfs = kmcUtils::getSilverLightPlayerUiConfs($silverLightTag);
		}
		$kdp508_uiconfs = array();
		if($type == 'player' && $this->partner->getEnable508Players())
		{
			$kdp508_uiconfs = kmcUtils::getKdp508PlayerUiconfs();
		}
		
		$jw_confs = ($type == 'player')? kmcUtils::getJWPlayerUIConfs(): kmcUtils::getJWPlaylistUIConfs();
		
		$merged_list = array_merge($default_uiconfs_array, $kdp508_uiconfs, $silverlight_uiconfs, $partner_uiconfs_array, $jw_confs);
		return $this->renderText(json_encode($merged_list));
	}
}
?>