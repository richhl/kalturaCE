<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaUiConf extends KalturaObject 
{
	/**
	 * @var string
	 * @readonly
	 * @filter eq,not,in,notIn,gte
	 */
	public $id;
	
	/**
	 * Name of the uiConf, this is not a primary key
	 * @var string
	 */
	public $name;
	
	/**
	 * 
	 * @var string
	 */
	public $description;
	
	/**
	 * 
	 * @var int
	 * @readonly
	 */
	public $partnerId;	
	

	/**
	 * @var KalturaUiConfObjType $objType
	 */
	public $objType;

	/**
	 * @var string
	 * @readonly
	 */
	public $objTypeAsString;
	
	/**
	 *
	 * @var int
	 */
	public $width;
	
	/**
	 * @var int
	 */
	public $height;
	
	/**
	 * @var string
	 */
	public $htmlParams;
	
	/**
	 * @var string
	 */
	public $swfUrl;
	
	/**
	 * @var string
	 * @readonly
	 */
	public $confFilePath;
	
	/**
	 * @var string
	 */
	public $confFile;

	/**
	 * @var string
	 */
	public $confFileFeatures;
	
	/**
	 * @var string
	 */
	public $confVars;
	
	
	/**
	 * @var bool
	 */
	public $useCdn;
	
	/**
	 * @var string
	 */
	public $tags;
	
	
	/**
	 * @var string
	 */
	public $swfUrlVersion;
	
	
	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 * @var int
	 * @readonly
	 */
	public $createdAt;

	
	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 * @var int
	 * @readonly
	 */
	public $updatedAt;
		
	/**
	 * Enter description here...
	 *
	 * @var KalturaUiConfCreationMode $creationMode
	 */
	public $creationMode;
	

	private static $map_between_objects = array
	(
		"id" ,
		"creationMode" , 
	 	"objType" , "objTypeAsString" , "name" , "width" , "height" ,
		"htmlParams", "swfUrl" , "confFilePath" , "confFile" , "confFileFeatures" , "confVars" , "useCdn" , "tags" , "swfUrlVersion" , "createdAt" , "updatedAt" ,
        
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}

	public function fromUiConf ( uiConf  $uiConf )
	{
		parent::fromObject( $uiConf );
	}
	
	public function toUiConf () 
	{
		$uiConf = new uiConf();
		return parent::toObject( $uiConf )	;
	}
}
?>