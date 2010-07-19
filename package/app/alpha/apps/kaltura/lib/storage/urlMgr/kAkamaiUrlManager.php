<?php
class kAkamaiUrlManager extends kUrlManager
{

	/**
	 * Returns the URL path with the authorization token appended. See the
	 *   README for more details.
	 */
	function urlauth_gen_url($sUrl, $sParam, $nWindow,
	                         $sSalt, $sExtract, $nTime) {
	
		$sToken = $this->urlauth_gen_token($sUrl, $nWindow, $sSalt,
	                                    $sExtract, $nTime);
		if ($sToken == null) {
			return;
		}
	
		if (($sParam == "") || (!is_string($sParam))) {
			$sParam = "__gda__";
		}
	
	    if ((strlen($sParam) < 5) || (strlen($sParam) > 12)) {
	        return;
	    }
	
		if (($nWindow < 0) || (!is_integer($nWindow))) {
			return;
		}
	
		if (($nTime <= 0) || (!is_integer($nTime))) {
			$nTime = time();
		}
	
		$nExpires = $nWindow + $nTime;
	
		if (strpos($sUrl, "?") === false) {
			$res = $sUrl . "?" . $sParam . "=" . $nExpires . "_" . $sToken;
		} else {
			$res = $sUrl . "&" . $sParam . "=" . $nExpires . "_" . $sToken;
		}
	
		return $res;
	}
	
	/**
	 * Returns the hash portion of the token. This function should not be
	 *   called directly.
	 */
	function urlauth_gen_token($sUrl, $nWindow, $sSalt,
	                           $sExtract, $nTime) {
		if (($sUrl == "") || (!is_string($sUrl))) {
			return;
		}
	
		if (($nWindow < 0) || (!is_integer($nWindow))) {
			return;
		}
	
		if (($sSalt == "") || (!is_string($sSalt))) {
			return;
		}
	
		if (!is_string($sExtract)) {
			$sExtract = "";
		}
	
		if (($nTime <= 0) || (!is_integer($nTime))) {
			$nTime = time();
		}
	
		$nExpires = $nWindow + $nTime;
		$sExpByte1 = chr($nExpires & 0xff);
		$sExpByte2 = chr(($nExpires >> 8) & 0xff);
		$sExpByte3 = chr(($nExpires >> 16) & 0xff);
		$sExpByte4 = chr(($nExpires >> 24) & 0xff);
	
		$sData = $sExpByte1 . $sExpByte2 . $sExpByte3 . $sExpByte4
	                 . $sUrl . $sExtract . $sSalt;
	
		$sHash = $this->_unHex(md5($sData));
	
		$sToken = md5($sSalt . $sHash);
		return $sToken;
	}
	
	/**
	 * Helper function used to translate hex data to binary
	 */
	function _unHex($str) {
		$res = "";
		for ($i = 0; $i < strlen($str); $i += 2) {
	        $res .= chr(hexdec(substr($str, $i, 2)));
		}
		return $res;
	}

	/**
	 * @param flavorAsset $flavorAsset
	 * @return string
	 */
	public function getFlavorAssetUrl(flavorAsset $flavorAsset)
	{
		$partnerId = $flavorAsset->getPartnerId();
		$subpId = $flavorAsset->getentry()->getSubpId();
		$flavorAssetId = $flavorAsset->getId();
		$partnerPath = myPartnerUtils::getUrlForPartner($partnerId, $subpId);
		
		$this->setFileExtension($flavorAsset->getFileExt());
	
		$url = "$partnerPath/serveFlavor/flavorId/$flavorAssetId";
		
		if($this->clipTo)
			$url .= "/clipTo/$this->clipTo";

		if($this->extention)
			$url .= "/name/$flavorAssetId.$this->extention";
					
		if($this->protocol == StorageProfile::PLAY_FORMAT_RTMP)
		{
			$url .= '/forceproxy/true';
			if($this->extention && strtolower($this->extention) != 'flv')
				$url = "mp4:$url";
		}
		else
		{		
			$url .= '?novar=0';
				
			if($this->seekFromTime > 0)
				$url .= '&aktimeoffset=' . floor($this->seekFromTime / 1000);
		}
			
		$url = str_replace('\\', '/', $url);
		return $url;
	}

	/**
	 * @param FileSync $fileSync
	 * @return string
	 */
	public function getFileSyncUrl(FileSync $fileSync)
	{
		if($fileSync->getObjectSubType() != entry::FILE_SYNC_ENTRY_SUB_TYPE_ISM)
			return parent::getFileSyncUrl($fileSync);
		
		$storage = StorageProfilePeer::retrieveByPK($fileSync->getDc());
		if(!$storage)
			return parent::getFileSyncUrl($fileSync);
		
		$serverUrl = $storage->getDeliveryIisBaseUrl();
		$partnerPath = myPartnerUtils::getUrlForPartner($fileSync->getPartnerId(), $fileSync->getPartnerId() * 100);
		$path = $partnerPath.'/serveIsm/objectId/'.pathinfo(kFileSyncUtils::resolve($fileSync)->getFilePath(), PATHINFO_BASENAME).'/manifest';		
		$matches = null;
		if(preg_match('/(https?:\/\/[^\/]+)(.*)/', $serverUrl, $matches))
		{
			$serverUrl = $matches[1];
			$path = $matches[2] . $path;
		}
		
		$path = str_replace('//', '/', $path);
		
		$window = 120; // seconds
		$param = kConf::get('akamai_auth_smooth_param');
		$salt = kConf::get('akamai_auth_smooth_salt');
		$authPath = $this->urlauth_gen_url($path, $param, $window, $salt, null, null);
		
		return $serverUrl . '/' . $authPath;
	}
}