<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaMediaEntryFilter extends KalturaBaseEntryFilter
{
	public function __construct()
	{
		$this->typeEqual = KalturaEntryType::MEDIA_CLIP;
	}
	
	private static $map_between_objects = array
	(
		"mediaTypeEqual" => "_eq_media_type",
		"mediaTypeIn" => "_in_media_type",
		"mediaDateGreaterThanEqual" => "_gte_media_date",
		"mediaDateLessThanEqual" => "_lte_media_date",
	);
	
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
	
	/**
	 * @var KalturaMediaType $mediaTypeEqual
	 */
	public $mediaTypeEqual;
	
	/**
	 * @var string $mediaTypeIn
	 */
	public $mediaTypeIn;
	
	/**
	 * @var int $mediaDateGreaterThanEqual
	 */
	public $mediaDateGreaterThanEqual;
	
	/**
	 * @var int $mediaDateLessThanEqual
	 */
	public $mediaDateLessThanEqual;
}
?>