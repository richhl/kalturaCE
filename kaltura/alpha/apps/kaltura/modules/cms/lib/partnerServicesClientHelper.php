<?php

require_once (MODULES.'cms/lib/partnerServicesClient.php');

class PartnerServicesClientHelper 
{
	private $default_params = null;
	private $user = null;
	
	function __construct(/*sfBasicSecurityUser*/ $user) 
	{
		$this->user = $user; 
		$this->loadDefaultParams();
	}
	
	private function loadDefaultParams() 
	{
		$partner_id = $this->user->getAttribute('adminkuser_partner_id');
		$id_for_partner_services = $this->user->getAttribute('adminkuser_id_for_partner_services');
		$subp_id = $partner_id * 100;
		
		$this->default_params = 
			array
				(
					"format" => kalturaWebserviceRenderer::RESPONSE_TYPE_RAW,
					"uid" => $id_for_partner_services, 
					"partner_id" => $partner_id,
					"subp_id" => $subp_id	
				);
	}
	
	function execute($action, $action_params)
	{
		if (!$this->default_params)
			$this->loadDefaultParams();
		
		$params = array_merge($this->default_params, $action_params);
		$psc = new PartnerServicesClient($action);
		$result = $psc->execute($params);
		return $result;
	}
}
?>