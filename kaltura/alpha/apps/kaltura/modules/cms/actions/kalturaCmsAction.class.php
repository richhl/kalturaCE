<?php
//require_once ( "kalturaAction.class.php" );

abstract class kalturaCmsAction extends kalturaAction
{
	const CMS_CRED_EXPIRY_SEC = 86400; // one day
	
	private $cmsHashSecret = '%CMSS3cr3t1t$';

	protected function forceCmsAuthentication()
	{
		list($id) = $this->getCmsCookie();
		$adminuser = adminKuserPeer::retrieveByPK($id);
		if ($adminuser) 
		{
			$cms_session = $this->getContext()->getUser()->getAttribute('cms_session');
			
			// we might need to restore session parameters
			if (!$cms_session) 
			{
				 $this->setCmsSessionParams($adminuser);
			}
			
			return true;
		}

		$this->redirect($this->getController()->genUrl('cms/login', true));
	}
	
	protected function cmsAuthenticated($id)
	{
		$adminuser = adminKuserPeer::retrieveByPK($id);
		if ($adminuser) 
		{
			$this->setCmsSessionParams($adminuser);
			$this->setCmsCookie($id);
		}
	}
	
	private function setCmsSessionParams($adminuser) 
	{
		$this->getContext()->getUser()->setAttribute('cms_session', true);
		$this->getContext()->getUser()->setAttribute('adminkuser_email', $adminuser->getEmail()); 
		$this->getContext()->getUser()->setAttribute('adminkuser_id', $adminuser->getId());
		$this->getContext()->getUser()->setAttribute('adminkuser_id_for_partner_services', $adminuser->getIdForPartnerServices());
		$this->getContext()->getUser()->setAttribute('adminkuser_partner_id', $adminuser->getPartnerId());
	}

	protected function cmsLogout( )
	{
		$this->setCmsCookie(null);
		$this->getContext()->getUser()->getAttributeHolder()->clear();
	}
	
	public function execute() 
	{
		$this->forceCmsAuthentication();
		
		$partner_id = $this->getUser()->getAttribute('adminkuser_partner_id');
		
		// apply filters for Criteria so there will be no chance of exposure of date from other partners !
		myPartnerUtils::applyPartnerFilters ( $partner_id , true );
		
		return $this->executeImpl($partner_id);
	}
	
	abstract protected function executeImpl($partner_id);

  function setCmsCookie($id) 
  {
  	if ($id == null) 
  	{
  		$this->getContext()->getResponse()->setCookie('cms', '', time() - 3600);
  	}
  	else 
  	{
		$cookie_data = array('id' => $id);
		$serialized_data = base64_encode(serialize($cookie_data));
		$hash_signiture = md5($serialized_data . $this->cmsHashSecret);
		$cookie = $serialized_data . $hash_signiture;
		$this->getContext()->getResponse()->setCookie('cms', $cookie, time() + sfConfig::get('sf_timeout') , '/' );
  	}
  }
  	
  function getCmsCookie() 
  {
  	$cookie = $this->getContext()->getRequest()->getCookie('cms');
  	$length = strlen($cookie);
  	if ($length <= 0)
  		return null;
  		
  	$serialized_data = substr($cookie, 0, $length - 32);
  	$hash_signiture = substr($cookie, $length - 32);
  	  	 
  	// check the signiture
  	if (md5($serialized_data . $this->cmsHashSecret) != $hash_signiture)
  		return null;
  	
  	$userzone_data = unserialize(base64_decode($serialized_data));
  	
  	return array($userzone_data['id']);
  }
}
?>
