<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaUser extends KalturaObject 
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
	public $screenName;

	/**
	 * @var string
	 */
	public $fullName;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var string
	 */
	public $dateOfBirth;
	
	/**
	 * @var string
	 */
	public $country;

	/**
	 * @var string
	 */
	public $state;

	/**
	 * @var string
	 */
	public $city;

	/**
	 * @var string
	 */
	public $zip;
	
	/**
	 * @var string
	 */
	public $urlList;
	
	/**
	 * @var string
	 */
	public $picture;
	
	/**
	 * @var int
	 * @readonly
	 */
	public $icon;
	
	/**
	 * @var string
	 */
	public $aboutMe;
	
	/**
	 * @var string
	 */
	public $tags;
	
	/**
	 * @var string
	 */
	public $mobileNum;
	
	/**
	 * @var int
	 */
	private $matureContent;
	
	/**
	 * @var int
	 */
	public $gender;

	/**
	 * @var int
	 * @readonly
	 */
	public $views;

	/**
	 * @var int
	 * @readonly
	 */
	public $fans;

	/**
	 * @var int
	 * @readonly
	 */
	public $entries;

	/**
	 * @var int
	 * @readonly
	 */
	public $producedKshows;

	/**
	 * @var int
	 */
	public $status;

	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 * @var int
	 * @readonly
	 */
	public $createdAt;

	/**
	 * Entry update date as Unix timestamp (In seconds)
	 * @var int
	 * @readonly
	 */
	public $updatedAt;

	/**
	 * @var int
	 * @readonly
	 */
	public $partnerId;

	/**
	 * @var int
	 */
	public $displayInSearch;

	/**
	 * @var int
	 */
	public $partnerData;

	private static $map_between_objects = array
	(
		"id" => "puserId" , "screenName" , "fullName" , "email" , "dateOfBirth" , "country" , "state" , "city" ,
		"zip" , "urlList" , "picture" , "icon" , "aboutMe" , "tags" , "mobileNum" , "gender" , "views" ,
		"fans" , "entries" , "producedKshows" , "status" , "createdAt" , "updatedAt" , "partnerId" , "displayInSearch" ,  "partnerData" 
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}

	public function fromUser ( kuser $entry )
	{
		parent::fromObject( $entry );
	}
	
	public function toUser () 
	{
		$user = new kuser();
		return parent::toObject( $user );
	}
	
	public static function getKuserByPuserId( $puser_id, $partner_id )
	{
		$puserKuser = PuserKuserPeer::retrieveByPartnerAndUid( $partner_id , null, $puser_id );
		if ( $puserKuser )
		{
			$userFromDb = kuserPeer::retrieveByPK( $puserKuser->getKuserId() );
		}
		return $userFromDb;
	}	
}
?>