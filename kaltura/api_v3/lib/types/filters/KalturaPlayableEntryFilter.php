<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaPlayableEntryFilter extends KalturaBaseEntryFilter
{
	private $map_between_objects = array
	(
	);

	private $order_by_map = array
	(
		"+plays" => "+plays",
		"-plays" => "-plays",
		"+views" => "+views",
		"-views" => "-views",
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), $this->map_between_objects);
	}

	public function getOrderByMap()
	{
		return array_merge(parent::getOrderByMap(), $this->order_by_map);
	}
}
