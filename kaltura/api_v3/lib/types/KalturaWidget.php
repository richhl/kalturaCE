<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaWidget extends KalturaObject 
{
	/**
	 * @var string
	 * @readonly
	 * @filter eq,not,in,notIn,gte
	 */
	public $id;

	/**
	 * @var string
	 */
	public $sourceWidgetId;
	
	/**
	 * @var string
	 * @readonly
	 */
	public $rootWidgetId;
	
	/**
	 * @var int
	 * @readonly
	 * @filter
	 */
	public $partnerId;
	
	/**
	 * @var string
	 */
	public $kshowId;
	
	/**
	 * @var string
	 */
	public $entryId;
	
	/**
	 * @var int
	 */
	public $uiConfId;
	
	/**
	 * @var string
	 */
	private $customData;
	
	/**
	 * @var KalturaWidgetSecurityType
	 */
	public $securityType;
	
	/**
	 * @var int
	 */
	public $securityPolicy;
	
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
	 * @var string
	 */
	public $partnerData;
	
	/**
	 * @var string
	 * @readonly
	 */
	public $widgetHTML;

	private static $map_between_objects = array
	(
		"id" , "sourceWidgetId" , "rootWidgetId" , "partnerId" , "kshowId" , "entryId" , "uiConfId" , "widgetHTML" , 
		"securityType" , "securityPolicy" , "createdAt" , "updatedAt" , "partnerData"
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}

	public function fromWidget ( widget $entry )
	{
		parent::fromObject( $entry );
	}
	
	public function toWidget () 
	{
		$user = new widget();
		$skip_props = array ( "widgetHTML" );
		return parent::toObject( $user , $skip_props );
	}
}
?>