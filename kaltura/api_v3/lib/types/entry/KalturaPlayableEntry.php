<?php 
/**
 * @package api
 * @subpackage objects
 */
class KalturaPlayableEntry extends KalturaBaseEntry
{
	/**
	 * Number of plays
	 * 
	 * @var int
	 * @readonly
	 * @filter order
	 */
	public $plays;
	
	/**
	 * Number of views
	 * 
	 * @var int
	 * @readonly
	 * @filter order
	 */
	public $views;
	
	/**
	 * The width in pixels
	 * 
	 * @var int
	 * @readonly
	 */
	public $width;
	
	/**
	 * The height in pixels
	 * 
	 * @var int
	 * @readonly
	 */
	public $height;
	
	/**
	 * The duration in seconds
	 * 
	 * @var int
	 * @readonly
	 */
	public $duration;
	
	private static $map_between_objects = array
	(
		"plays",
		"views",
		"width",
		"height",
		"duration"
	);
	
	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
}