<?php
class SystemUserPlugin implements IKalturaPlugin
{
	public static function getServicesMap()
	{
		$map = array(
			'systemUser' => 'SystemUserService'
		);
		return $map;
	}
	
	public static function getServiceConfig()
	{
		return realpath(dirname(__FILE__).'/../config/system_user.ct');
	}

	public static function getDatabaseConfig()
	{
		return new Zend_Config_Ini(dirname(__FILE__).'/../config/database.ini');
	}
	
	public static function isAllowedPartner($partnerId)
	{
		if($partnerId == Partner::ADMIN_CONSOLE_PARTNER_ID)
			return true;
		
		return false;
	}
}
?>
