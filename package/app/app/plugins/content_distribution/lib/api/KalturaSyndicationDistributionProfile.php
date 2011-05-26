<?php
/**
 * @package plugins.contentDistribution
 * @subpackage api.objects
 */
class KalturaSyndicationDistributionProfile extends KalturaDistributionProfile
{	
	/**
	 * @var string
	 */
	public $xsl;
	
	/**
	 * @var string
	 * @readonly
	 */
	public $feedId;
	
	/*
	 * mapping between the field on this object (on the left) and the setter/getter on the object (on the right)  
	 */
	private static $map_between_objects = array 
	(
		'xsl',
		'feedId',
	);
		 
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
	
	public function toObject($object = null, $skip = array())
	{
		if(is_null($object))
			$object = new SyndicationDistributionProfile();
			
		return parent::toObject($object, $skip);
	}
}