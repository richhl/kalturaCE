<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaWidgetFilter extends KalturaFilter
{
	private static $map_between_objects = array
	(
		"id" => "_eq_id" , 
		"sourceWidgetId" => "_eq_source_widget_id",
		"rootWidgetId" => "_eq_root_widget_id",
		"entryId" => "_eq_entry_id",
		"uiConfId" => "_eq_ui_conf_id",
		"partnerData" => "_like_partner_data",
		"createdAtGreaterThanEqual" => "_gte_created_at" ,
	 	"createdAtLessThanEqual" => "_lte_created_at" ,
		"updatedAtGreaterThanEqual" => "_gte_updated_at" ,
	 	"updatedAtLessThanEqual" => "_lte_updated_at" ,
	);
	
	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	
	
	/**
	 * @var string $id
	 * @filter eq,not,in,notIn
	 */
	public $id;	
	
	/**
	 * @var string $sourceWidgetId
	 */
	public $sourceWidgetId;
	
	/**
	 * @var string $rootWidgetId
	 */
	public $rootWidgetId;
	
	/**
	 * @var string $entryId
	 */
	public $entryId;
	
	/**
	 * @var int $uiConfId
	 */
	public $uiConfId;
	
	/**
	 * @var string $partnerData
	 */
	public $partnerData;

	/**
	 * @var string $createdAtGreaterThanEqual
	 */
	public $createdAtGreaterThanEqual;	

	/**
	 * @var string $createdAtLessThanEqual
	 */
	public $createdAtLessThanEqual;		
	
	/**
	 * @var string $updatedAtGreaterThanEqual
	 */
	public $updatedAtGreaterThanEqual;	

	/**
	 * @var string $updatedAtLessThanEqual
	 */
	public $updatedAtLessThanEqual;			
}
?>