<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaMediaEntryFilter extends KalturaPlayableEntryFilter
{
	private $map_between_objects = array
	(
		"mediaTypeEqual" => "_eq_media_type",
		"mediaTypeIn" => "_in_media_type",
		"mediaDateGreaterThanOrEqual" => "_gte_media_date",
		"mediaDateLessThanOrEqual" => "_lte_media_date",
	);

	private $order_by_map = array
	(
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), $this->map_between_objects);
	}

	public function getOrderByMap()
	{
		return array_merge(parent::getOrderByMap(), $this->order_by_map);
	}

	/**
	 * 
	 * 
	 * @var KalturaMediaType
	 */
	public $mediaTypeEqual;

	/**
	 * 
	 * 
	 * @var string
	 */
	public $mediaTypeIn;

	/**
	 * 
	 * 
	 * @var int
	 */
	public $mediaDateGreaterThanOrEqual;

	/**
	 * 
	 * 
	 * @var int
	 */
	public $mediaDateLessThanOrEqual;
}
