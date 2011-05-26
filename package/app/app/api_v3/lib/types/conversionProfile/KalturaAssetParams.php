<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaAssetParams extends KalturaObject implements IFilterable 
{
	/**
	 * The id of the Flavor Params
	 * 
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
	 * The name of the Flavor Params
	 * 
	 * @var string 
	 */
	public $name;
	
	/**
	 * The description of the Flavor Params
	 * 
	 * @var string
	 */
	public $description;

	/**
	 * Creation date as Unix timestamp (In seconds)
	 *  
	 * @var int
	 * @readonly
	 */
	public $createdAt;
	
	/**
	 * True if those Flavor Params are part of system defaults
	 * 
	 * @var KalturaNullableBoolean
	 * @readonly
	 * @filter eq
	 */
	public $isSystemDefault;
	
	/**
	 * The Flavor Params tags are used to identify the flavor for different usage (e.g. web, hd, mobile)
	 * 
	 * @var string
	 * @filter eq
	 */
	public $tags;

	/**
	 * The container format of the Flavor Params
	 *  
	 * @var KalturaContainerFormat
	 * @filter eq
	 */
	public $format;

	/**
	 * Array of partner permisison names that required for using this asset params
	 *  
	 * @var KalturaStringArray
	 */
	public $requiredPermissions;
	
	private static $map_between_objects = array
	(
		"id",
		"partnerId",
		"name",
		"description",
		"createdAt",
		"isSystemDefault" => "isDefault",
		"tags",
		"format",
	);
	
	/* (non-PHPdoc)
	 * @see KalturaObject::getMapBetweenObjects()
	 */
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
	
	/* (non-PHPdoc)
	 * @see KalturaObject::toObject()
	 */
	public function toObject ( $object_to_fill = null , $props_to_skip = array() )
	{
		if(is_null($object_to_fill))
			$object_to_fill = new assetParams();
			
		$object_to_fill = parent::toObject($object_to_fill, $props_to_skip);
		
		$requiredPermissions = array();
		foreach($this->requiredPermissions as $requiredPermission)
			$requiredPermissions[] = $requiredPermission->value;
			
		$object_to_fill->setRequiredPermissions($requiredPermissions);
		
		return $object_to_fill;
	}
	
	/* (non-PHPdoc)
	 * @see KalturaObject::fromObject()
	 */
	public function fromObject ( $source_object  )
	{
		$this->requiredPermissions = KalturaStringArray::fromStringArray($source_object->getRequiredPermissions());
		return parent::fromObject($source_object);
	}
	
	/* (non-PHPdoc)
	 * @see IFilterable::getExtraFilters()
	 */
	public function getExtraFilters()
	{
		return array();
	}
	
	/* (non-PHPdoc)
	 * @see IFilterable::getFilterDocs()
	 */
	public function getFilterDocs()
	{
		return array();
	}
}
