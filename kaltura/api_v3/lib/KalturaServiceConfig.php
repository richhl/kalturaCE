<?php
class KalturaServiceConfig extends myServiceConfig
{
	public static function getServiceConfigForPartner ( $partner )
	{
		kConfigTable::$should_use_cache = false;
		
		if ( $partner )
			$service_config_id = $partner->getServiceConfigId() ;
		else 
			$service_config_id = null;
		$file_name = $service_config_id ? "v3_" . $service_config_id  : null;
		return  self::getInstance (  $file_name  );	
	}
	
	
	public static function getInstance ( $file_name , $service_name = null )
	{
		// TODO - maybe cache ??
		return new KalturaServiceConfig ( $file_name , $service_name  );
	}
	
	
	protected function getDefaultName ()
	{
		return "v3_services.ct";
	}
	
	protected  function getPath ()
	{
		return KALTURA_ROOT_PATH.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR;
	}
}
?>