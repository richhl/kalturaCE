<?php
// until we manage to cache all classes - also those placed in files with different names than their own-
// this will hold the list 
class KalturaAutoloadNonStandard
{
	public static function getClassAlias ( $class )
	{
		if ( isset (self::$map[$class]))
			return @self::$map[$class];
		return null;
	}
	
	private static $map = array (
		"kConfigTableChain" => "kConfigTable",
		"baseObjectFilter" => "filters" ,			//
		"myBatchUrlImportClient" => "myBatchUrlImport",
		"AdminSecurity" => "myAdminUtils",
		"myBatchUrlImportServer" => "myBatchUrlImport" ,
		"myBatchFlattenClient" => "myBatchFlattenVideo",
		"FLV_Util_AMFSerialize" => "AMFSerialize" ,
		"IExclusiveLock" => "myDbExclusiveLock" ,
		"IExclusiveLockPeer" => "myDbExclusiveLock" ,
		"myNotificationsConfig" => "myNotificationMgr"
	);
}
?>