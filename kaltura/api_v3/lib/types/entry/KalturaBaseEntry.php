<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaBaseEntry extends KalturaObject implements IFilterable 
{
	/**
	 * Auto generated 10 characters alphanumeric string
	 * 
	 * @var string
	 * @readonly
	 * @filter eq,in
	 */
	public $id;
	
	/**
	 * Entry name (Min 1 chars)
	 * 
	 * @var string
	 * @filter like,mlikeor,mlikeand,eq,order
	 */
	public $name;
	
	/**
	 * Entry description
	 * 
	 * @var string
	 */
	public $description;
	
	/**
	 * 
	 * 
	 * @var int
	 * @readonly
	 * @filter eq,in
	 */
	public $partnerId;
	
	/**
	 * The ID of the user who is the owner of this entry 
	 * 
	 * @var string
	 * @filter eq
	 */
	public $userId;
	
	/**
	 * Entry tags
	 * 
	 * @var string
	 * @filter like,mlikeor,mlikeand
	 */
	public $tags;
	
	/**
	 * Entry admin tags can be updated only by administrators
	 * 
	 * @var string
	 * @filter like,mlikeor,mlikeand
	 */
	public $adminTags;
	
	/**
	 * 
	 * @var KalturaEntryStatus
	 * @readonly
	 * @filter eq,in
	 */
	public $status;
	
	/**
	 * The type of the entry, this is auto filled by the derived entry object
	 * 
	 * @var KalturaEntryType
	 * @readonly
	 * @filter eq,in
	 */
	public $type;
	
	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 * 
	 * @var int
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $createdAt;
	
	/**
	 * Calculated rank
	 * 
	 * @var int
	 * @readonly
	 * @filter order
	 */
	public $rank;
	
	/**
	 * The total (sum) of all votes
	 * 
	 * @var int
	 * @readonly
	 */
	public $totalRank;
	
	/**
	 * Number of votes
	 *  
	 * @var int
	 * @readonly
	 */
	public $votes;
	
	/**
	 * 
	 * @var int
	 * @filter eq
	 */
	public $groupId;
	
	/**
	 * Can be used to store various partner related data as a string 
	 * 
	 * @var string
	 */
	public $partnerData;
	
	/**
	 * Download URL for the entry
	 * 
	 * @var string
	 * @readonly
	 */
	public $downloadUrl;
	
	/**
	 * Indexed search text for full text search
	 * @var string
	 * @readonly
	 * @filter matchand, matchor
	 */
	public $searchText;
	
	/**
	 * License type used for this entry
	 * 
	 * @var KalturaLicenseType
	 */
	public $licenseType = KalturaLicenseType::UNKNOWN;
	
	/**
	 * Version of the entry data
	 *
	 * @var int
	 * @readonly
	 */
	public $version;
	
	/**
	 * Thumbnail URL
	 * 
	 * @var string
	 * @readonly
	 */
	public $thumbnailUrl;
	
	/*
	 * mapping between the field on this object (on the left) and the setter/getter on the entry object (on the right)  
	 */
	private static $map_between_objects = array 
	 (
	 	"id" , 
	 	"name" , 
	 	"description" ,
	 	"userId" => "puserId" ,		// what should be extracted is only the puserId NOT kuserId
	 	"tags" ,
	 	"adminTags" ,
	 	"partnerId" ,
	 	"status" , 
	 	"type" , // this will need to be set according to the class
	 	"createdAt" , 
	 	"rank" , 
	 	"totalRank" ,
	 	"votes" ,
	 	"groupId" ,
	 	"partnerData" , 
	 	"downloadUrl" ,
	 	"licenseType" ,
	 	"searchText",
	 	"version",
	 	"thumbnailUrl",
	 );
		 
	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	
	public function getExtraFilters()
	{
		return array(
			array("filter" => "mlikeor", "fields" => array("tags", "name")),
			array("filter" => "mlikeor", "fields" => array("tags", "adminTags")),
			array("filter" => "mlikeor", "fields" => array("tags", "adminTags", "name")),
			array("filter" => "mlikeand", "fields" => array("tags", "name")),
			array("filter" => "mlikeand", "fields" => array("tags", "adminTags")),
			array("filter" => "mlikeand", "fields" => array("tags", "adminTags", "name"))
		);
	}
	
	public function getFilterDocs()
	{
		return array(
			"idEqual" => "This filter should be in use for retrieving only a specific entry (identified by its entryId).",
			"idIn" => "This filter should be in use for retrieving few specific entries (string should include comma separated list of entryId strings).",
			"userIdEqual" => "This filter parameter should be in use for retrieving only entries, uploaded by/assigned to a specific user (identified by user Id).",
			"typeIn" => "This filter should be in use for retrieving entries of few {@link ?object=KalturaEntryType KalturaEntryType} (string should include a comma separated list of {@link ?object=KalturaEntryType KalturaEntryType} enumerated parameters).",
			
			"statusEqual" => "This filter should be in use for retrieving only entries, at a specific {@link ?object=KalturaEntryStatus KalturaEntryStatus}.",
			"statusIn" => "This filter should be in use for retrieving only entries, at few specific {@link ?object=KalturaEntryStatus KalturaEntryStatus}.",
			
			"nameLike" => "This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry names. It should include only one pattern for matching entry names against.",
			"nameMultiLikeOr" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry names. It could include few (comma separated) patterns for matching entry names against, while applying an OR logic to retrieve entries that match at least one input pattern.",
			"nameMultiLikeAnd" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry names. It could include few (comma separated) patterns for matching entry names against, while applying an AND logic to retrieve entries that match all input patterns.",
			"nameEqual" => "This filter should be in use for retrieving entries with a specific name.",
		
			"tagsLike" => "This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry tags. It should include only one pattern for matching entry tags against.",
			"tagsMultiLikeOr" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match at least one input pattern.",
			"tagsMultiLikeAnd" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags.  It could include few (comma separated) patterns for matching entry tags against, while applying an AND logic to retrieve entries that match all input patterns.",
		
			"adminTagsLike" => "This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry tags, set by an ADMIN user. It should include only one pattern for matching entry tags against.",
			"adminTagsMultiLikeOr" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags, set by an ADMIN user.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match at least one input pattern.",
			"adminTagsMultiLikeAnd" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags, set by an ADMIN user.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match all input patterns.",
			
			"createdAtGreaterThanOrEqual" => "This filter parameter should be in use for retrieving only entries which were created at Kaltura system after a specific time/date (standard timestamp format).",
			"createdAtLessThanOrEqual" => "This filter parameter should be in use for retrieving only entries which were created at Kaltura system before a specific time/date (standard timestamp format).",
			
			//"updatedAtGreaterThanEqual" => "This filter parameter should be in use for retrieving only entries which were created at Kaltura system after or at an exact time/date (standard timestamp format).",
			//"updatedAtLessThenEqual" => "This filter parameter should be in use for retrieving only entries which were created at Kaltura system before or at an exact time/date (standard timestamp format).",
			
			"modifiedAtGreaterThanEqual" => "This filter parameter should be in use for retrieving only entries which were updated at Kaltura system after or at an exact time/date (standard timestamp format).",
			"modifiedAtLessThenEqual" => "This filter parameter should be in use for retrieving only entries which were updated at Kaltura system before or at an exact time/date (standard timestamp format).",
		
			"partnerIdEqual" => "This filter should be in use for retrieving only entries which were uploaded by/assigned to users of a specific Kaltura Partner (identified by Partner ID).",
			"partnerIdIn" => "This filter should be in use for retrieving only entries within Kaltura network which were uploaded by/assigned to users of few Kaltura Partners  (string should include comma separated list of PartnerIDs)",
			
			"tagsAndNameMultiLikeOr" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags and names.  It could include few (comma separated) patterns for matching entry tags/names against, while applying an OR logic to retrieve entries that match at least one input pattern.",
			"tagsAndNameMultiLikeAnd	String	This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags and entry names.  It could include few (comma separated) patterns for matching entry tags/names against, while applying an AND logic to retrieve entries that match all input patterns.",
		
			"tagsAndAdminTagsMultiLikeOr" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry tags set by both users and ADMIN users. It could include few (comma separated) patterns for matching entry tags/Admin tags against, while applying an OR logic to retrieve entries that match at least one input pattern.",
			"tagsAndAdminTagsAndNameMultiLikeOr" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry tags set by both users and ADMIN users and on entry names.  It could include few (comma separated) patterns for matching entry tags/Admin tags/names against, while applying an OR logic to retrieve entries that match at least one input pattern.",
			
			"tagsAndAdminTagsMultiLikeAnd" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry tags set by both users and ADMIN users. It could include few (comma separated) patterns for matching entry tags/Admin tags against, while applying an AND logic to retrieve entries that match all input patterns.",
			"tagsAndAdminTagsAndNameMultiLikeAnd" => "This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry tags set by both users and ADMIN users and on entry names.  It could include few (comma separated) patterns for matching entry tags/Admin tags/names against, while applying an AND logic to retrieve entries that match all  input patterns.",
			
			"searchTextMatchAnd" => "This filter should be in use for retrieving specific entries while search match the input string within all of the following metadata attributes: name, description, tags, adminTags.",
			"searchTextMatchOr" => "This filter should be in use for retrieving specific entries while search match the input string within at least one of the following metadata attributes: name, description, tags, adminTags.",
		);
	}
}