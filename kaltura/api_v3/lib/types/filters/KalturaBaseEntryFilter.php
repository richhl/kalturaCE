<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaBaseEntryFilter extends KalturaFilter
{
	private static $map_between_objects = array
	(
		"idEqual" => "_eq_id",
		"idIn" => "_in_id",
	
		"userEqual" => "_eq_user_id",
	
		"statusEqual" => "_eq_status",
		"statusIn" => "_in_status",
	
		"nameLike" => "_like_name",
		"nameMultiLikeOr" => "_mlikeor_name", 			
		"nameMultiLikeAnd" => "_mlikeand_name",
		"nameEqual" => "_eq_name",
	
		"tagsLike" => "_like_tags",
		"tagsMultiLikeOr" => "_mlikeor_tags",
		"tagsMultiLikeAnd" => "_mlikeand_tags",
	 
		"adminTagsLike" => "_like_tags",
		"adminTagsMultiLikeOr" => "_mlikeor_tags",
		"adminTagsMultiLikeAnd" => "_mlikeand_tags",
	
		"groupIdEqual" => "_eq_group_id",
	
		"createdAtGreaterThanEqual" => "_gte_created_at",
		"createdAtLessThenEqual" => "_lte_created_at",
	
		"updatedAtGreaterThanEqual" => "_gte_updated_at",
		"updatedAtLessThenEqual" => "_lte_updated_at",
	
		"modifiedAtGreaterThanEqual" => "_gte_modified_at",
		"modifiedAtLessThenEqual" => "_lte_modified_at",
	
		"partnerIdIn" => "_in_partner_id",
		"partnerIdEqual" => "_eq_partner_id",
		
		"moderationStatusEqual" => "_eq_moderation_status", 
		"moderationStatusIn" => "_in_moderation_status",
	
		"tagsAndNameMultiLikeOr" => "_mlikeor_tags-name",
		"tagsAndAdminTagsMultiLikeOr" => "_mlikeor_tags-admin_tags",
		"tagsAndAdminTagsAndNameMultiLikeOr" => "_mlikeor_tags-admin_tags-name",
	
		"tagsAndNameMultiLikeAnd" => "_mlikeand_tags",	
		"tagsAndAdminTagsMultiLikeAnd" => "_mlikeand_tags-admin_tags",
		"tagsAndAdminTagsAndNameMultiLikeAnd" => "_mlikeand_tags-admin_tags-name",
		
		"searchTextMatchAnd" => "_matchand_search_text",
		"searchTextMatchOr" => "_matchor_search_text",
	);
	
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
	
	/**
	 * @var string $idEqual
	 */
	public $idEqual;
	
	/**
	 * @var string $idIn
	 */
	public $idIn;
	
	/**
	 * @var string $userEqual
	 */
	public $userEqual;
	
	/**
	 * @var KalturaEntryStatus $statusEqual
	 */
	public $statusEqual;
	
	/**
	 * @var string $statusIn
	 */
	public $statusIn;
	
	/**
	 * @var string $nameLike
	 */
	public $nameLike;
	
	/**
	 * @var string $nameMultiLikeOr
	 */
	public $nameMultiLikeOr;
	
	/**
	 * @var string $nameMultiLikeAnd
	 */
	public $nameMultiLikeAnd;
	
	/**
	 * @var string $nameEqual
	 */
	public $nameEqual;
	
	/**
	 * @var string $tagsLike
	 */
	public $tagsLike;
	
	/**
	 * @var string $tagsMultiLikeOr
	 */
	public $tagsMultiLikeOr;
	
	/**
	 * @var string $tagsMultiLikeAnd
	 */
	public $tagsMultiLikeAnd;
	
	/**
	 * @var string $adminTagsLike
	 */
	public $adminTagsLike;
	
	/**
	 * @var string $adminTagsMultiLikeOr
	 */
	public $adminTagsMultiLikeOr;
	
	/**
	 * @var string $adminTagsMultiLikeAnd
	 */
	public $adminTagsMultiLikeAnd;
	
	/**
	 * @var int $groupIdEqual
	 */
	public $groupIdEqual;
	
	/**
	 * @var int $createdAtGreaterThanEqual
	 */
	public $createdAtGreaterThanEqual;
	
	/**
	 * @var int $createdAtLessThenEqual
	 */
	public $createdAtLessThenEqual;
	
	/**
	 * @var int $updatedAtGreaterThanEqual
	 */
	public $updatedAtGreaterThanEqual;
	
	/**
	 * @var int $updatedAtLessThenEqual
	 */
	public $updatedAtLessThenEqual;
	
	/**
	 * @var int $modifiedAtGreaterThanEqual
	 */
	public $modifiedAtGreaterThanEqual;
	
	/**
	 * @var int $modifiedAtLessThenEqual
	 */
	public $modifiedAtLessThenEqual;
	
	/**
	 * @var int $partnerIdEqual
	 */
	public $partnerIdEqual;
	
	/**
	 * @var string $partnerIdIn
	 */
	public $partnerIdIn;
	
	/**
	 * @var int $moderationStatusEqual
	 */
	public $moderationStatusEqual;
	
	/**
	 * @var string $moderationStatusIn
	 */
	public $moderationStatusIn;
	
	/**
	 * @var string $tagsAndNameMultiLikeOr
	 */
	public $tagsAndNameMultiLikeOr;
	
	/**
	 * @var string $tagsAndAdminTagsMultiLikeOr
	 */
	public $tagsAndAdminTagsMultiLikeOr;
	
	/**
	 * @var string $tagsAndAdminTagsAndNameMultiLikeOr
	 */
	public $tagsAndAdminTagsAndNameMultiLikeOr;
	
	/**
	 * @var string $tagsAndNameMultiLikeAnd
	 */
	public $tagsAndNameMultiLikeAnd;
	
	/**
	 * @var string $tagsAndAdminTagsMultiLikeAnd
	 */
	public $tagsAndAdminTagsMultiLikeAnd;
	
	/**
	 * @var string $tagsAndAdminTagsAndNameMultiLikeAnd
	 */
	public $tagsAndAdminTagsAndNameMultiLikeAnd;
	
	/**
	 * @var string $searchTextMatchAnd
	 */
	public $searchTextMatchAnd;
	
	/**
	 * @var string $searchTextMatchOr
	 */
	public $searchTextMatchOr;
	
}
?>