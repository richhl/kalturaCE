<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaConversionProfile extends KalturaObject
{
	/**
     * @var int
     * @readonly
     */
    public $id;
    
    /**
     * @var int
     * @readonly
     */
    public $partnerId;
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $profileType;
    
    /**
     * @var bool
     */
    public $commercialTranscoder;
    
    /**
     * @var int
     */
    public $width;
    
    /**
     * @var int
     */
    public $height;
    
    /**
     * @var KalturaAspectRatioType
     */
    public $aspectRatioType;
    
    /**
     * @var bool
     */
    public $bypassFlv;
    
    /**
     * @var int
     * @readonly
     */
    public $createdAt;
    
    /**
     * @var int
     * @readonly
     */
    public $updatedAt;
    
    /**
     * @var int
     */
    public $profileTypeSuffix;
    
    private static $map_between_objects = array
	(
		"id",
	    "partnerId",
	    "name",
	    "profileType",
	    "commercialTranscoder",
	    "width",
	    "height",
	    "aspectRatioType" => "aspectRatio",
	    "bypassFlv",
	    "createdAt",
	    "updatedAt",
	    "profileTypeSuffix"
	);
	
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
}