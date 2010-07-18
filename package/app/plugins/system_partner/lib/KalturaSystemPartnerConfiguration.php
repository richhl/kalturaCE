<?php
class KalturaSystemPartnerConfiguration extends KalturaObject
{
	/**
	 * @var string
	 */
	public $host;
	
	/**
	 * @var string
	 */
	public $cdnHost;
	
	/**
	 * @var int
	 */
	public $maxBulkSize;
	
	/**
	 * @var int
	 */
	public $partnerPackage;
	
	private static $map_between_objects = array
	(
		"host",
		"cdnHost",
		"maxBulkSize",
		"partnerPackage",
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
}