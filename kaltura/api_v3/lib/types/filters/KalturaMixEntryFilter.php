<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaMixEntryFilter extends KalturaBaseEntryFilter
{
	public function __construct()
	{
		$this->typeEqual = KalturaEntryType::MIX;
	}
	
	private static $map_between_objects = array
	(
		
	);
	
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
}
?>