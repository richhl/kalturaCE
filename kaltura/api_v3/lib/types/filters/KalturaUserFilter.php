<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaUserFilter extends KalturaFilter
{
	private static $map_between_objects = array
	(
		"screenNameLike" => "_like_screen_name" ,
		"emailLike" => "_like_email" ,
		"emailLikeRegexp" => "_likex_email" ,
		"tagsLike" => "_like_tags" ,
		"countryLike" => "_like_country",
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
	 * @var int $status
	 */
	public $status;	
	
	/**
	 * @var string $screenNameLike
	 */
	public $screenNameLike;	

	/**
	 * @var string $tagsMultiLikeOr
	 */
	public $tagsLike;
	
	/**
	 * @var string $email
	 */
	public $emailLike;
	
	/**
	 * @var string $countryLike
	 */
	public $countryLike;
	
	/**
	 * @var string $emailLikeRegexp
	 */
	public $emailLikeRegexp;
	
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