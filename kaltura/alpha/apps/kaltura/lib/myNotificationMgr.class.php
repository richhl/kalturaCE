<?php
class myNotificationMgr
{
	const NOTIFICATION_MGR_NO_SEND = 0;
	const NOTIFICATION_MGR_SEND_ASYNCH = 1;
	const NOTIFICATION_MGR_SEND_SYNCH = 2;
	const NOTIFICATION_MGR_SEND_BOTH = 3;
	
	private $m_not_list = array ();
	private $m_not_id_list = array ();
	private $m_url ;
	private $m_params = array ();
	private $m_serialized_params;
	
	
	public function addNotification ( $notification_type , $object_data , $partner_id=null , $puser_id=null )
	{
		$index = 1 + count ( $this->m_not_list );
		$prefix = "not{$index}_";
		
		@list ( $temp_not_id  ,  $temp_not , $temp_url , $temp_params , $temp_serialized_params )= myNotificationMgr::createNotification ( $notification_type , $entry , $partner_id , $puser_id , $prefix );
		@list ( $not_id  ,  $not , $url , $params , $serialized_params )= array ( $temp_not_id  ,  $temp_not , $temp_url , $temp_params , $temp_serialized_params );
		
		$this->m_not_list[] = $not;
		$this->m_not_id_list[] = $not_id;
		if ( $this->m_url != null && $this->m_url != $url ) 
		{ // ERROR ! 
		}
		$this->m_url = $url; // assume all URLs are the same
		array_merge ( $m_params , $params ); // accumulate the params
		$this->m_serialized_params = $serialized_params;
	}
	
	public function getNotificationIds()
	{
		return $this->m_not_id_list;
	}
	
	
	public function getNotifications()
	{
		return $this->m_not_list;
	}
	
	// this map is assumed to be the request 
	public static function splitMultiNotifications ( $map , $desired_notification_prefix = null )
	{
		$debug ="";
		$signature = $map ["sig"]; // must always exist
		if ( isset ( $map["multi_notification"] ) &&   $map["multi_notification"] === "true" )
		{
			$not_data = array();
			foreach (  $map as $name => $value )
			{
				$match = preg_match ( "/^(not[^_]*)_(.*)$/" , $name , $parts );
//$debug .= "match: $match " . print_r ( $parts , true ) . "\n";				
				if ( ! $match ) continue;
				$not_name_parts = $parts[1];
				$not_property = @$parts[2];
				
				//$not_name_parts = split ( "_" , $name , 2 );
				//	$not_property = @$not_name_parts[1];
$debug .= "name: $name\n";				
				$prefix = $not_name_parts;
				if ( $desired_notification_prefix != null && $prefix == $not_prefix )
				{
					$not_data[$not_property] = $value;
				}
				else
				{
					$not_data = @$res[$prefix];
//$debug .= "3(" . print_r ( $not_data , true ) . ")";					
					if ( $nota_data == null )
					{
						$res[$prefix] = array();
						$not_data = &$res[$prefix]; 
					}
$debug .= "property: $not_property = [$value]\n";					
					$not_data[$not_property] = $value;
				}
				//$res[$prefix] = $not_data;				
			}
			
			
		}
		else
		{
			$res = $map; // return the map as-is assuming all is a sinlge notification 
		}
		
		return array ( $res , $signature  , $debug );
	}

	/**
	 * $notification_type -
	 * $puser_id - the puser_id of the kuser that caused the modification
	 * $object_data - can be either an object or an object id (if the object no longer exists
	 * $partner_id - if exists, use this (usually in case of $object_data is an id), if not - use the partner_id from the object
	 */
	public static function createNotification ( $notification_type , $object_data , $partner_id=null , $puser_id=null , $prefix=null ,
		$extra_notification_data = null  )
	{
		if ( !$partner_id )
		{
			if ( $object_data instanceof BaseObject )
			{
				$partner_id = $object_data->getPartnerId() ;
			}
			else
			{
				kLog::log ( "Cannot create notification [$notification_type] [$object_data] [$partner_id]" );
				return false;
			}
		}

		//		echo "[$partner_id]";

		$nofication_config_str = null;
		list ( $nofity , $nofication_config_str ) = myPartnerUtils::shouldNotify ( $partner_id ) ;
		if ( ! $nofity ) return false;
		$nofication_config = myNotificationsConfig::getInstance( $nofication_config_str );
		$nofity_send_type = $nofication_config->shouldNotify ( $notification_type );
		
//echo "nofication_config_str: $nofication_config_str<br>notification_type:$notification_type<br>";
		
		if ( $nofity_send_type == self::NOTIFICATION_MGR_NO_SEND ) return false;
		
//echo "nofity_send_type: $nofity_send_type<br>";
		
		// now check what type of notification to use - none / synch / a-synch

		$not = new notification();
		$not->setType( $notification_type );
		if (  $nofity_send_type == self::NOTIFICATION_MGR_SEND_ASYNCH || $nofity_send_type == self::NOTIFICATION_MGR_SEND_BOTH)
		{
 			
			// the notification should be in status pending so it will be sent in the 
			$not->setStatus( notification::NOTIFICATION_STATUS_PENDING );
		}
		elseif (  $nofity_send_type == self::NOTIFICATION_MGR_SEND_SYNCH  )
		{
			$not->setStatus( notification::NOTIFICATION_STATUS_SENT_SYNCH );
		}
		
		// return the notification to the caller
		$retrun_notification = ( $nofity_send_type == self::NOTIFICATION_MGR_SEND_SYNCH || $nofity_send_type == self::NOTIFICATION_MGR_SEND_BOTH );
		
//echo "retrun_notification: $retrun_notification<br>";
		
		$not->setPartnerId( $partner_id );
		$not->setPuserId( $puser_id );

		if ( $object_data instanceof BaseObject )
		{
			$not->setObjectId($object_data->getId() );
			$not->setNotificationData( self::createNotificationData ( $notification_type , $object_data, $extra_notification_data  ) );
				
			if ( $object_data instanceof entry )
			{
				if (defined("KALTURA_API_V3"))
					$puser_id = $object_data->getKuser()->getPuserId();
				else
					$puser_id = PuserKuserPeer::getByKuserId( $object_data->getKuserId() , 1 );
					
				$not->setPuserId( $puser_id );
				
			}
		}
		else
		{
			// in this case all we have is the object data which is the id
			// this is probably the case of some delete and we mifght not have the object in hand but only the id
			$not->setObjectId( $object_data );
		}
		$not->save();
		
		if ( $retrun_notification )
		{
			// return the notification id, notification object , url & the serialized data
			$partner = partnerPeer::retrieveByPK ( $partner_id );
			list ( $url , $signature_key ) = self::getPartnerNotificationInfo ($partner );
			list ( $params , $raw_signature ) = self::prepareNotificationData ( $url , $signature_key , $not , $prefix);	
			$serialized_params = http_build_query( $params , "" , "&" );
			return array ( $not->getId() ,  $not , $url , $params , $serialized_params )	;	  
		}
		else
		{
			return $not->getId();
		}
	}


	private static function createNotificationData ( $notification_type , $obj , $extra_notification_data = null )
	{
		$params = array();
		$param_names = null;
		switch ( $notification_type )
		{
			case notification::NOTIFICATION_TYPE_ENTRY_ADD:
				$param_names = array ( "name" , "tags" , "search_text" , "media_type" , "length_in_msecs" , "permissions", "thumbnail_url" , "kshow_id" , "roughcut_id",  
					"group_id" , "partner_data", "status", "width", "height", "data_url", "download_url", "download_size", "media_date");
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_UPDATE:
				$param_names = array ( "name" , "tags" , "search_text" , "media_type" , "length_in_msecs" , "permissions", "thumbnail_url" , "kshow_id" , 
					"group_id" , "partner_data", "status", "width", "height", "data_url", "download_url", "download_size", "media_date");
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_UPDATE_PERMISSIONS:
				$param_names = array ( "permissions" );
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_DELETE:
				$param_names = null;
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_BLOCK:
				$param_names = null;
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_UPDATE_THUMBNAIL:
				$param_names = array ( "thumbnail_url", "kshow_id" );
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_REPORT:
				$param_names = array ( "objectId", "comments" , "reportCode" );
				break;
			case notification::NOTIFICATION_TYPE_ENTRY_UPDATE_MODERATION:
				$param_names = array ( "moderation_status", "moderation_count" );
				break;
			case notification::NOTIFICATION_TYPE_KSHOW_ADD:
				//$param_names = array ( "name" , "description" , "searchText" , "permissions" ,"groupId");
				$param_names = array ( "name" , "description" , "tags" , "search_text" , "permissions" , "group_id" , "partner_data" , "show_entry_id" );
				break;
			case notification::NOTIFICATION_TYPE_KSHOW_DELETE:
				$param_names = null;
				break;
			case notification::NOTIFICATION_TYPE_KSHOW_UPDATE_INFO:
				//$param_names = array ( "name" , "description" , "searchText" ,"groupId" );
				$param_names = array ( "name" , "description" , "tags" , "search_text" , "group_id" , "partner_data"  );
				break;
			case notification::NOTIFICATION_TYPE_KSHOW_UPDATE_PERMISSIONS:
				$param_names = array ( "permissions" );
				break;
			case notification::NOTIFICATION_TYPE_KSHOW_RANK:
				$param_names = array ( "rank" , "votes" );
				break;
			case notification::NOTIFICATION_TYPE_KSHOW_BLOCK:
				$param_namesmes = null;
				break;
			case notification::NOTIFICATION_TYPE_USER_BANNED:
				$param_names = array ( "screen_name" , "email" );
				break;
			case notification::NOTIFICATION_TYPE_BATCH_JOB_STARTED:
			case notification::NOTIFICATION_TYPE_BATCH_JOB_SUCCEEDED:
			case notification::NOTIFICATION_TYPE_BATCH_JOB_FAILED:
			case notification::NOTIFICATION_TYPE_BATCH_JOB_SIMILAR_EXISTS:
				$param_names = array ( "id" , "job_type" , "job_sub_type" , "data" , "status" , "abort" , "progress" , "message", "description" ,  
					"updates_count" , "created_at" , "updated_at" , "entry_id" );
				break;
				
		}

		if ( $param_names == null )
		return "";
			
		foreach ( $param_names as $name )
		{
			$method_name = "get" . $name;
			$method_name = str_replace ( "_" , "" , $method_name ); // this is to support underscores in the names rather than camelback
			$res = call_user_func ( array ( $obj , $method_name ) );
			$params[ $name ] = $res;
		}

		if ( $extra_notification_data )
		{
			if ( is_array ( $extra_notification_data ))
			{
				foreach ( $extra_notification_data as $extra_params_name => $extra_params_value )
				{
					$params[$extra_params_name] = $extra_params_value;
				}
			}
			else
				$params["extra_notification_data"] = $extra_notification_data;
		}
		
		return serialize( $params );
	}

	public static function getDataAsArray ( $serialized_data )
	{
		if ( empty ( $serialized_data ))	return null;
		return unserialize( $serialized_data );
	}
	

	public static function getPartnerNotificationInfo ( $partner )
	{
		$url = $partner->getUrl2();
		$signature_key = $partner->getAdminSecret();
		return array (  $url , $signature_key );
	}
	
	public static function prepareNotificationData ( $url , $signature_key , notification $not , $prefix = null  )
	{
		$type = $not->getType();
		$params = array	(
			"notification_id" => $not->getId() ,
			"notification_type" => $not->getTypeAsString() ,
			"puser_id" => $not->getPuserId() ,
			"partner_id" => $not->getPartnerId() ,
			
		);
		
		if ( notification::isEntryNotification($type )) $params["entry_id"] = $not->getObjectId();
			//$params["entryId"] = $not->getObjectId();
		if ( notification::isKshowNotification($type )) $params["kshow_id"] = $not->getObjectId();
//			$params["kshowId"] = $not->getObjectId();

		$object_data_params = myNotificationMgr::getDataAsArray( $not->getNotificationData() ) ;
		
		if ( $object_data_params )
		{
			$params = array_merge( $params , $object_data_params );
		}
			
		$params = self::fixParams ( $params , $prefix );
		
		$params['signed_fields'] = '';
		foreach($params as $key => $value){
			$params['signed_fields'] .= $key.',';
		}
		
		return self::signParams ( $signature_key,$params);
	}
		
	public static function signParams ( $signature_key , &$params )
	{
		list ( $sig , $raw_str ) = self::signature($signature_key,$params);
		$params["sig"] = $sig;

		return array ( $params , $raw_str );		
	}
	
	private static function signature ( $signature_key , $params )
	{
		ksort($params);
		$str = "";
		foreach ($params as $k => $v)
		{
			if ( $k == "sig" ) continue;
			$str .= $k.$v;
		}
		
		return  array ( md5($signature_key . $str) , $str );
	}	
	
	private static function fixParams ( &$params , $prefix = null )
	{
		$new_params = array();
		foreach ( $params as $k => $v )
		{
			if ( $prefix )
				$new_params[$prefix . trim($k)] = trim($v);
			else
				$new_params[trim($k)] = trim($v); 
		}
		return $new_params		;
	}
	
}

class myNotificationsConfig 
{
	const DEFAULT_TYPE = "*";
	
	private $not_config_map = array();
	public static function getInstance ( $config_str )
	{
		return new myNotificationsConfig($config_str);
	}

	// the separator can be either ',' or ';'
	private function myNotificationsConfig ( $config_str )
	{
		//$arr = explode ( "," , trim($config_str ));
		$arr = preg_split ( "/[,;]/" , trim($config_str ) );
		foreach ( $arr as $name_value )
		{
			@list ( $n , $v ) = explode ( "=" , $name_value );
			$this->not_config_map[trim($n)]=trim($v);
		}
	}
	
	public function shouldNotify( $not_type )
	{
		$res = $this->getByType ( $not_type);
		if ( $res === null ) 
			$res = $this->getByType ( self::DEFAULT_TYPE );
		if ( $res === null )
			return myNotificationMgr::NOTIFICATION_MGR_SEND_ASYNCH ; // default is to send (the notify flag was on initially
		return $res;
	}
	
	private function getByType ( $not_type )
	{
		if ( isset ( $this->not_config_map[$not_type] ) )
			return $this->not_config_map[$not_type] ;
		return null;
	}
	
	public function toString()
	{
		return print_r ( $this->not_config_map , true );
	}
}

?>