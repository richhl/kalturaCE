<?php
/**
 * @abstract
 * @package api
 * @subpackage services
 */
abstract class KalturaBaseService 
{
	private $ks = null;
	private $partner = null;
	private $puserKuser = null;
	
	private $operating_artner = null;
	 
	private $force_ticket_check = true;
	private $private_partner_data = null; /// will be used internally and from the actual services for setting the
	private static $databaseManager = null;

	public function __construct()
	{
		// initialize the database for all services
		if ( ! self::$databaseManager )
		{
			self::$databaseManager = new DbManager();
			self::$databaseManager->initialize();
		
			Propel::setLogger( KalturaLog::getInstance());
		}
	}	

	
	public function __destruct( )
	{
		if ( self::$databaseManager )
		{
			self::$databaseManager->shutdown();
		}
	}
	
	// TODO - no need to set the service_name - it should be known to the service !
	public function initService ( $partner_id , $puser_id , $ks_str , $service_name , $action )
	{
		$arr = list ( $partner_id , $uid , $private_partner_data ) = $this->validateTicketSetPartner ( $partner_id , $puser_id , $ks_str , $service_name , $action);
		$this->private_partner_data = $private_partner_data;
		$this->validateIp ( );
		
		myPartnerUtils::applyPartnerFilters ( $partner_id , $private_partner_data , $this->partnerGroup() , $this->kalturaNetwork()  );
	}
	
/* >--------------------- Security and config settings ----------------------- */
	// TODO - no need to set the service_name - it should be known to the service !
	public function validateTicketSetPartner ( $partner_id , $puser_id , $ks_str  , $service_name , $action )
	{
		if ( $ks_str )
		{
			// 	1. crack the ks - 
			$ks = kSessionUtils::crackKs ( $ks_str );
			
			// 2. extract partner_id
			$ks_partner_id= $ks->partner_id;
			
			if ( ! $partner_id ) $partner_id = $ks_partner_id;
			// use the user from the ks if not explicity set 
			if ( ! $puser_id ) $puser_id = $ks->user;
			
			// 3. retrieve partner
			$ks_partner = PartnerPeer::retrieveByPK( $ks_partner_id );
			// the service_confgi is assumed to be the one of the operating_partner == ks_partner

			if ( ! $ks_partner )
			{
				throw new KalturaAPIException ( APIErrors::UNKNOWN_PARTNER_ID , $ks_partner_id );
			}
			$this->setServiceConfigFromPartner( $ks_partner , $service_name , $action );
			
			// 4. validate ticket per service for the ticket's partner
			$ticket_type = $this->ticketType();
			if ( $ticket_type == kSessionUtils::REQUIED_TICKET_NOT_ACCESSIBLE )
			{
				// partner cannot access this service
				throw new KalturaAPIException ( APIErrors::SERVICE_FORBIDDEN );
			}
			
			if ( $this->force_ticket_check && $ticket_type != kSessionUtils::REQUIED_TICKET_NONE )
			{
				// TODO - which user is this ? from the ks ? from the puser_id ? 
				$ks_puser_id = $ks->user;
				//$ks = null;
				$res = kSessionUtils::validateKSession2 ( $ticket_type , $ks_partner_id , $ks_puser_id , $ks_str , $ks );

				if ( 0 >= $res )
				{
					// chaned this to be an exception rather than an error
					throw new KalturaAPIException ( APIErrors::INVALID_KS , $ks_str , $res , ks::getErrorStr( $res ));
				}
				$this->ks = $ks;
			}
				
			// 5. see partner is allowed to access the desired partner (if himself - easy, else - should appear in the partnerGroup)
			$allow_access = myPartnerUtils::allowPartnerAccessPartner ( $ks_partner_id , $this->partnerGroup() , $partner_id );
			if ( ! $allow_access )
			{
				throw new KalturaAPIException ( APIErrors::PARTNER_ACCESS_FORBIDDEN , $ks_partner_id , $partner_id ); 
			}
			
			// 6. set the partner to be the desired partner and the operating_partner to be the one from the ks
			$this->partner = PartnerPeer::retrieveByPK( $partner_id );
			$this->operating_partner = $ks_partner;
			// the config is that of the ks_partner NOT of the partner
			// $this->setServiceConfigFromPartner( $ks_partner ); - was already set above to extract the ks
			// TODO - should change  service_config to be the one of the partner_id ?? 

			// 7. if ok - return the partner_id to be used from this point onwards 
			return array ( $partner_id , $puser_id , true ); // allow private_partner_data
		}
		else
		{
			// no ks_str
	 		// 1. extract partner by partner_id +
			// 2. retrieve partner
	 		$this->partner = PartnerPeer::retrieveByPK( $partner_id );
			if ( ! $this->partner )
			{
				$this->partner = null;
				{
					// go to the default config 
					$this->setServiceConfigFromPartner( null , $service_name , $action );
				}
				
				if ( $this->requirePartner() )
				{
					throw new KalturaAPIException ( APIErrors::MISSING_KS , $partner_id );
				}
			}

			// 3. make sure the service can be accessed with no ticket
 			$this->setServiceConfigFromPartner( $this->partner , $service_name , $action  );
			$ticket_type = $this->ticketType();
			if ( $ticket_type == kSessionUtils::REQUIED_TICKET_NOT_ACCESSIBLE )
			{
				// partner cannot access this service
				throw new KalturaAPIException ( APIErrors::SERVICE_FORBIDDEN );
			}
			if ( $this->force_ticket_check && $ticket_type != kSessionUtils::REQUIED_TICKET_NONE )
			{
				// NEW: 2008-12-28
				// Instead of throwing an exception, see if the service allows KN.
				// If so - a relativly week partner access 
				if ( $this->kalturaNetwork() )
				{
					// if the service supports KN - continue without private data 
					return array ( $partner_id , $puser_id , false ); // DONT allow private_partner_data
				}
				
				// chaned this to be an exception rather than an error
				throw new KalturaAPIException ( APIErrors::MISSING_KS  );
			}
			
			// 4. set the partner & operating_partner to be the one-and-only partner of this session
			$this->operating_partner = $this->partner;
			return array ( $partner_id , $puser_id , true ); // allow private_partner_data			
		}
	}

	private function validateIp ( )
	{
		if ( ! $this->matchIp() ) return; // no need to match the IP
		$ip_to_match = $this->getPartner()->getMatchIp();
		if ( ! $ip_to_match ) return ; // althogh the service requires the match - the partner didn't specify the ip prefix.
		$user_ip = null;
		if ( ! requestUtils::validateIp( $ip_to_match , $user_ip ) )
		{
			throw new KalturaAPIException( APIErrors::ACCESS_FORBIDDEN_FROM_UNKNOWN_IP , $user_ip );		
		}
	}
	
	// use the new service config - the files and content will be different from ps2
	// in the config file - names are always lower case
	private function setServiceConfigFromPartner (  $partner , $service , $action )
	{
		$service_name = strtolower( "$service.$action" );
		try 
		{
			$this->service_config = KalturaServiceConfig::getServiceConfigForPartner ( $partner );
			$this->service_config->setServiceName ( $service_name );
		}
		catch(Exception $ex)
		{
			if (strpos(strtolower($ex->getMessage()), "unknown service") !== false)
				throw new KalturaAPIException(KalturaErrors::INVALID_SERVICE_CONFIGURATION);
			else
				throw $ex;
		}
	}
	
	private function getServiceConfig ()
	{
		return $this->service_config;
	}	
	
	// can be used from derived classes to set additionl filter that don't automatically happen in applyPartnerFilters  
	protected function applyPartnerFilterForClass ( $peer )//, $partner_id= null )
	{
		if ( $this->getPartner() )
			$partner_id = $this->getPartner()->getId();
		else
			$partner_id = -1; 
		myPartnerUtils::addPartnerToCriteria ( $peer , $partner_id , $this->private_partner_data , $this->partnerGroup() , $this->kalturaNetwork()  );
	}	
/* <--------------------- Security and config settings ----------------------- */	
	
	protected function ticketType ()		{		return $this->getServiceConfig()->getTicketType();	}
	protected function requirePartner () 	{ 		return $this->getServiceConfig()->getRequirePartner();	}
	protected function kalturaNetwork() 	{ 		return $this->getServiceConfig()->getKalturaNetwork();	}
	protected function matchIp() 			{ 		return $this->getServiceConfig()->getMatchIp();	}
	protected function partnerGroup() 		{ 		return $this->getServiceConfig()->getPartnerGroup();	}
	
	public function getKs()
	{
		return $this->ks;
	}

	public function getPartnerId()
	{
		if ($this->partner) 
			return $this->partner->getId();
			
		return null;
	}
	
	public function getPartner()
	{
		return $this->partner; 
	}
	
	public function getPuserKuser()
	{
		if (!$this->puserKuser)
		{
			// if no ks, puser id will be null
			if ($this->ks)
				$puserId = $this->ks->user;
			else
				$puserId = null;
				
			$puserKuser = PuserKuserPeer::createPuserKuser($this->getPartnerId(), $this->getPartnerId() * 100, $puserId, $puserId, $puserId, true);
			
			$this->puserKuser = $puserKuser->getKuser();
		}
		
		return $this->puserKuser;
	}
	
	protected function getKsUniqueString()
	{
		if ( $this->ks )
		{
			return $this->ks->getUniqueString();
		}
		else
		{
			return substr ( md5( rand ( 10000,99999 ) . microtime(true) ) , 1 , 7 );
			//throw new Exception ( "Cannot find unique string" );
		}

	}
}