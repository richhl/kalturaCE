<?php
require_once ( "defPartnerservices2Action.class.php");

class testnotificationAction extends defPartnerservices2Action
{
	public function describe()
	{
		return 
			array (
				"display_name" => "testNotification",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array ( 
						),
					"optional" => array (
						)
					),
				"out" => array (
					"notifications" => array ("type" => "*notification", "desc" => ""),
					// hit result ?
					),
				"errors" => array (
				)
			); 
	}
	
	protected function ticketType()	{		return self::REQUIED_TICKET_REGULAR;	}
	// ask to fetch the kuser from puser_kuser
	public function needKuserFromPuser ( )	{		return self::KUSER_DATA_NO_KUSER ;	}

	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		// create notification of type "test"
		$notification = new notification();
		$notification->setType( notification::NOTIFICATION_TYPE_TEST );
		$notification->setNotificationData('test|' . $partner_id);
		$notification->setId( notification::NOTIFICATION_TYPE_TEST + (int)time() );
		$notification->setPuserId($puser_id);
		
		
		$partner = PartnerPeer::retrieveByPK($partner_id);
		list ( $url , $signature_key ) = myNotificationMgr::getPartnerNotificationInfo ( $partner );
		$holder = new myBatchNotificationServer;
		SET_CONTEXT(null);
		list ( $params_sent , $res, $http_code ) = $holder->sendNotification ( $url , $signature_key , $notification );
	}
}
?>