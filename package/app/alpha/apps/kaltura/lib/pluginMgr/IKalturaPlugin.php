<?php
interface IKalturaPlugin
{
	public static function getServicesMap();
	
	/*public static function getAutoload();*/
	
	public static function getServiceConfig();
	
	public static function getDatabaseConfig();
	
	public static function isAllowedPartner($partnerId);
}