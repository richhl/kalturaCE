<?php
/**
 * 
 * will wrap the service configuration file per partner.
 *  
 */
class myServiceConfig
{
	const DEFAULT_COFIG_TABLE_FILE_NAME = "services.ct";
	
	private static $default_config_table = null;
//	private $config_table = null;
	private $config_chain = null;
	
	private $service_name = null;
	
	protected function getDefaultName ()
	{
		return self::DEFAULT_COFIG_TABLE_FILE_NAME;
	}
	
	protected function getPath ()
	{
		return myContentStorage::getFSContentRootPath() . "service_config/";
	}
	
	public static function getInstance ( $file_name , $service_name = null )
	{
		// TODO - maybe cache ??
		return new myServiceConfig ( $file_name , $service_name  );
	}
	
	public function myServiceConfig ( $file_name , $service_name = null )
	{
		$path = $this->getPath();
		
		if ( $file_name == $this->getDefaultName() )
		{
			// a list of 1
			$this->config_chain = new kConfigTableChain( array ( $file_name ) , $path );
		}
		else
		{
			$this->config_chain = new kConfigTableChain( array ( $file_name , $this->getDefaultName() ) , $path );
		}
		$tables =  $this->config_chain->getTables();
		self::$default_config_table = end ( $tables );

		if ( $service_name )
		{
			$this->setServiceName( $service_name );
		}
	}
	
	public function setServiceName ( $service_name )
	{
		// verify the service exists
		if ( ! self::$default_config_table->isSetPk ( $service_name ) )
		{
			throw new Exception ( "Unknown service [$service_name]" );
		}
		$this->service_name = $service_name;
	}
	
	public function getTicketType() 		{	return $this->get ( "ticket" ); 	}
	public function getRequirePartner()		{	return $this->get ( "rp" );			}	
	public function getNeedKuserFromPuser()	{	return $this->get ( "nkfp" ); 		}
	public function getCreateUserOnDemand()	{	return $this->get ( "cuod" );		}
	public function getAllowEmptyPuser()	{	return $this->get ( "aep" );		}
	public function getReadWrite()			{	return $this->get ( "wr" );			}
	public function getPartnerGroup()		{	return $this->get ( "pg" );			}
	public function getKalturaNetwork()		{	return $this->get ( "kn" );			}
	public function getMatchIp()			{	return $this->get ( "mip" );		}
	
	
	public function getServiceProperties()
	{
		return $this->get ( null );	
	}
	
	public function get ( $property )
	{
		return $this->config_chain->get ( $this->service_name , $property );
	}
	
	public function getServices ( )
	{
		return self::$default_config_table->listPks();	
	}
	
	public function isSetService ( $service_name )
	{
		// TODO - implement
	}
}
?>