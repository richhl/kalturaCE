<?php
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class contactsalesforceAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "contactSalesforce",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array (
						),
					"optional" => array (
						"name" => array ("type" => "string", "desc" => ""),
						"phone" => array ("type" => "string", "desc" => ""),
						"comments" => array ("type" => "string", "desc" => ""),
						"services" => array ("type" => "string", "desc" => "comma-separated list of services"),
						)
					),
				"out" => array (
					
					),
				"errors" => array (
					)
			);
	}
	
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		// get partner 1 info from DB
		$partner = PartnerPeer::retrieveByPK(1);
		$comments = "kalturaCE contact through KMC - ".$partner->getAdminEmail()."; ".$this->getP("comments");
		$phone = $this->getP("phone");
		$name = $partner->getPartnerName();

		$kaltura_pid = kConf::get('kaltura_partner_id');
		if($kaltura_pid == 'KALTURACOM_PARTNER_ID' || !$kaltura_pid)
		{
			$kaltura_pid = 1;
		}

		require_once(SF_ROOT_DIR.'/../../install/kaltura_client/kaltura_client.php');

		$kconfig = new KalturaConfiguration($kaltura_pid,$kaltura_pid*100);

		$ksession = new KalturaSessionUser();
		$ksession->userId = 1;
		$kc =  new KalturaClient($kconfig);
		$result = $kc->contactSalesforce($ksession, $name, $phone, $comments);

		if (isset($result['result']['lead']))
		{
			$this->addMsg ( "lead" , $result['result']['lead'] ) ;
		}
		else
		{
			$this->addDebug ( "error", $result['error']);
		}
	}
	
}
?>
