<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaPlaylistFilter extends KalturaFilter
{
	private static $map_between_objects = array
	(
		"idEqual" => "_eq_id" , 
	 	"idGreaterThanEqual" => "_gte_id" ,
		"statusEqual" => "_eq_status" ,
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
	 * @var int $idGreaterThanEqual
	 */
	public $idGreaterThanEqual;

	/**
	 * @var int $statusEqual
	 */
	public $statusEqual;	
	
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

    public function getOrderByMap()
	{
		return array();
	}
}
?>