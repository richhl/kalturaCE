<?php
/**
 * @package api
 * @subpackage objects
 */

/**
 * Will be used as the base class for all the job objects.
 * The derived classes will implicitly resemble (via the core objects) tne IExclusiveLock interface 
 */
class KalturaBaseJob extends KalturaObject implements IFilterable 
{
	/**
	 * @var int
	 * @readonly
	 * @filter eq,gte
	 */
	public $id;

	/**
	 * @var int
	 * @readonly
	 */
	public $partnerId;	
	
	
    /**
	 * @var int
	 * @readonly
	 * @filter gte,lte,order
	 */
    public $createdAt;
    
    /**
	 * @var int
	 * @readonly 
	 */
    public $updatedAt;
	
	
	/**
	 * @var string
	 * @readonly 
	 */	
	Public $processorName;

	/**
	 * @var string
	 * @readonly 
	 */	
	public $processorLocation;
	
	/**
	 * @var int
	 * @readonly 
	 */	
	public $processorExpiration;
	
	/**
	 * @_var int
	 * @readonly
	 */	
	public $executionAttempts;
	
	/**
	 * @_var int
	 * @readonly
	 */	
	public $lockVersion;

	
	private static $map_between_objects = array
	(
		"id" ,
		"partnerId" , 
	 	"createdAt" , "updatedAt" , 
	 	"processorName" , "processorLocation" , "processorExpiration" ,
		"executionAttempts", "lockVersion" ,
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	
	public function getExtraFilters()
	{
		return array();
	}
	
	public function getFilterDocs()
	{
		return array();
	}
}

?>