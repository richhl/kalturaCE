<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaUiConfFilter extends KalturaFilter
{
	private static $map_between_objects = array
	(
		"id" => "_eq_id" , 
	 	"idGreaterThanEqual" => "_gte_id" ,
		"status" => "_eq_status" ,
		"nameLike" => "_like_name" ,
		"tagsMultiLikeOr" => "_mlikeor_tags" ,
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
	 * @var int $id
	 * @filter eq,not,in,notIn
	 */
	public $id;	
	
	/**
	 * @var int $idGreaterThanEqual
	 */
	public $idGreaterThanEqual;

	/**
	 * @var int $status
	 */
	public $status;	
	
	/**
	 * @var string $nameLike
	 */
	public $nameLike;	

	/**
	 * @var string $tagsMultiLikeOr
	 */
	public $tagsMultiLikeOr;	

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