<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaBaseEntry extends KalturaObject 
{
	/**
	 * Auto generated 10 characters alphanumeric string
	 * 
	 * @var string
	 * @readonly
	 */
	public $id;
	
	/**
	 * Entry name
	 * 
	 * @var string
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
	 */
	public $partnerId;
	
	/**
	 * The ID of the user who is the owner of this entry 
	 * 
	 * @var string
	 */
	public $userId;
	
	/**
	 * Entry tags
	 * 
	 * @var string
	 */
	public $tags;
	
	/**
	 * Entry admin tags can be updated only by administrators and are not visible to the user
	 * 
	 * @var string
	 */
	public $adminTags;
	
	/**
	 * 
	 * @var KalturaEntryStatus
	 * @readonly
	 */
	public $status;
	
	/**
	 * The type of the entry, this is auto filled by the derived entry object
	 * 
	 * @var KalturaEntryType
	 * @readonly
	 */
	public $type;
	
	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 * 
	 * @var int
	 * @readonly
	 */
	public $createdAt;
	
	/**
	 * Calculated rank
	 * 
	 * @var int
	 * @readonly
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
	 * License type used for this entry
	 * 
	 * @var KalturaLicenseType
	 */
	public $licenseType = KalturaLicenseType::UNKNOWN;
	
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
	 );
		 
	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
/*
	public function toObject(entry $entry , $props_to_skip = array() )
	{
		return parent::toObject($entry);
	}
	
	public function fromObject(entry $entry , $props_to_skip = array() )
	{
		parent::fromObject($entry);
	}
*/
}