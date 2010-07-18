<?php
/**
 * @package api
 * @subpackage objects
 */

/**
 */
class KalturaSourceJobData extends KalturaJobData
{
	/**
	 * @var string
	 */
	public $srcFileSyncLocalPath;
	
	/**
	 * The translated path as used by the scheduler
	 * @var string
	 */
	public $actualSrcFileSyncLocalPath;
	
	/**
	 * @var string
	 */
	public $srcFileSyncRemoteUrl;
	
	private static $map_between_objects = array
	(
		"srcFileSyncLocalPath" ,
		"actualSrcFileSyncLocalPath" ,
		"srcFileSyncRemoteUrl" ,
	);


	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	
	public function toObject($dbData = null, $props_to_skip = array()) 
	{
		if(is_null($dbData))
			$dbData = new kSourceJobData();
			
		return parent::toObject($dbData, $props_to_skip);
	}
}

?>