<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaBaseEntryFilter extends KalturaFilter
{
	private $map_between_objects = array
	(
		"idEqual" => "_eq_id",
		"idIn" => "_in_id",
		"nameLike" => "_like_name",
		"nameMultiLikeOr" => "_mlikeor_name",
		"nameMultiLikeAnd" => "_mlikeand_name",
		"nameEqual" => "_eq_name",
		"partnerIdEqual" => "_eq_partner_id",
		"partnerIdIn" => "_in_partner_id",
		"userIdEqual" => "_eq_user_id",
		"tagsLike" => "_like_tags",
		"tagsMultiLikeOr" => "_mlikeor_tags",
		"tagsMultiLikeAnd" => "_mlikeand_tags",
		"adminTagsLike" => "_like_admin_tags",
		"adminTagsMultiLikeOr" => "_mlikeor_admin_tags",
		"adminTagsMultiLikeAnd" => "_mlikeand_admin_tags",
		"statusEqual" => "_eq_status",
		"statusIn" => "_in_status",
		"typeEqual" => "_eq_type",
		"typeIn" => "_in_type",
		"createdAtGreaterThanOrEqual" => "_gte_created_at",
		"createdAtLessThanOrEqual" => "_lte_created_at",
		"groupIdEqual" => "_eq_group_id",
		"searchTextMatchAnd" => "_matchand_search_text",
		"searchTextMatchOr" => "_matchor_search_text",
		"tagsNameMultiLikeOr" => "_mlikeor_tags-name",
		"tagsAdminTagsMultiLikeOr" => "_mlikeor_tags-adminTags",
		"tagsAdminTagsNameMultiLikeOr" => "_mlikeor_tags-adminTags-name",
		"tagsNameMultiLikeAnd" => "_mlikeand_tags-name",
		"tagsAdminTagsMultiLikeAnd" => "_mlikeand_tags-adminTags",
		"tagsAdminTagsNameMultiLikeAnd" => "_mlikeand_tags-adminTags-name",
	);

	private $order_by_map = array
	(
		"+name" => "+name",
		"-name" => "-name",
		"+createdAt" => "+created_at",
		"-createdAt" => "-created_at",
		"+rank" => "+rank",
		"-rank" => "-rank",
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), $this->map_between_objects);
	}

	public function getOrderByMap()
	{
		return array_merge(parent::getOrderByMap(), $this->order_by_map);
	}

	/**
	 * This filter should be in use for retrieving only a specific entry (identified by its entryId).
	 * 
	 * @var string
	 */
	public $idEqual;

	/**
	 * This filter should be in use for retrieving few specific entries (string should include comma separated list of entryId strings).
	 * 
	 * @var string
	 */
	public $idIn;

	/**
	 * This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry names. It should include only one pattern for matching entry names against.
	 * 
	 * @var string
	 */
	public $nameLike;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry names. It could include few (comma separated) patterns for matching entry names against, while applying an OR logic to retrieve entries that match at least one input pattern.
	 * 
	 * @var string
	 */
	public $nameMultiLikeOr;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry names. It could include few (comma separated) patterns for matching entry names against, while applying an AND logic to retrieve entries that match all input patterns.
	 * 
	 * @var string
	 */
	public $nameMultiLikeAnd;

	/**
	 * This filter should be in use for retrieving entries with a specific name.
	 * 
	 * @var string
	 */
	public $nameEqual;

	/**
	 * This filter should be in use for retrieving only entries which were uploaded by/assigned to users of a specific Kaltura Partner (identified by Partner ID).
	 * 
	 * @var int
	 */
	public $partnerIdEqual;

	/**
	 * This filter should be in use for retrieving only entries within Kaltura network which were uploaded by/assigned to users of few Kaltura Partners  (string should include comma separated list of PartnerIDs)
	 * 
	 * @var string
	 */
	public $partnerIdIn;

	/**
	 * This filter parameter should be in use for retrieving only entries, uploaded by/assigned to a specific user (identified by user Id).
	 * 
	 * @var string
	 */
	public $userIdEqual;

	/**
	 * This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry tags. It should include only one pattern for matching entry tags against.
	 * 
	 * @var string
	 */
	public $tagsLike;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match at least one input pattern.
	 * 
	 * @var string
	 */
	public $tagsMultiLikeOr;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags.  It could include few (comma separated) patterns for matching entry tags against, while applying an AND logic to retrieve entries that match all input patterns.
	 * 
	 * @var string
	 */
	public $tagsMultiLikeAnd;

	/**
	 * This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry tags, set by an ADMIN user. It should include only one pattern for matching entry tags against.
	 * 
	 * @var string
	 */
	public $adminTagsLike;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags, set by an ADMIN user.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match at least one input pattern.
	 * 
	 * @var string
	 */
	public $adminTagsMultiLikeOr;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags, set by an ADMIN user.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match all input patterns.
	 * 
	 * @var string
	 */
	public $adminTagsMultiLikeAnd;

	/**
	 * This filter should be in use for retrieving only entries, at a specific {@link ?object=KalturaEntryStatus KalturaEntryStatus}.
	 * 
	 * @var KalturaEntryStatus
	 */
	public $statusEqual;

	/**
	 * This filter should be in use for retrieving only entries, at few specific {@link ?object=KalturaEntryStatus KalturaEntryStatus}.
	 * 
	 * @var string
	 */
	public $statusIn;

	/**
	 * 
	 * 
	 * @var KalturaEntryType
	 */
	public $typeEqual;

	/**
	 * This filter should be in use for retrieving entries of few {@link ?object=KalturaEntryType KalturaEntryType} (string should include a comma separated list of {@link ?object=KalturaEntryType KalturaEntryType} enumerated parameters).
	 * 
	 * @var string
	 */
	public $typeIn;

	/**
	 * This filter parameter should be in use for retrieving only entries which were created at Kaltura system after a specific time/date (standard timestamp format).
	 * 
	 * @var int
	 */
	public $createdAtGreaterThanOrEqual;

	/**
	 * This filter parameter should be in use for retrieving only entries which were created at Kaltura system before a specific time/date (standard timestamp format).
	 * 
	 * @var int
	 */
	public $createdAtLessThanOrEqual;

	/**
	 * 
	 * 
	 * @var int
	 */
	public $groupIdEqual;

	/**
	 * This filter should be in use for retrieving specific entries while search match the input string within all of the following metadata attributes: name, description, tags, adminTags.
	 * 
	 * @var string
	 */
	public $searchTextMatchAnd;

	/**
	 * This filter should be in use for retrieving specific entries while search match the input string within at least one of the following metadata attributes: name, description, tags, adminTags.
	 * 
	 * @var string
	 */
	public $searchTextMatchOr;

	/**
	 * @var string
	 */
	public $tagsNameMultiLikeOr;

	/**
	 * @var string
	 */
	public $tagsAdminTagsMultiLikeOr;

	/**
	 * @var string
	 */
	public $tagsAdminTagsNameMultiLikeOr;

	/**
	 * @var string
	 */
	public $tagsNameMultiLikeAnd;

	/**
	 * @var string
	 */
	public $tagsAdminTagsMultiLikeAnd;

	/**
	 * @var string
	 */
	public $tagsAdminTagsNameMultiLikeAnd;
}
