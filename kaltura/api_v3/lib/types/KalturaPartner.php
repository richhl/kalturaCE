<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaPartner extends KalturaObject 
{
	/**
	 * @var int
	 * @readonly
	 */
	public $id;
	
	/**
	 * @var string
	 * @filter
	 */
	public $name;
	
	/**
	 * @var string
	 */
	public $website;
	
	/**
	 * @var string
	 */
	public $notificationUrl;
	
	/**
	 * @var int
	 */
	public $appearInSearch;
	
	/**
	 * @var string
	 * @readonly
	 */
	public $createdAt;
	
	/**
	 * @var string
	 */
	public $adminName;
	
	/**
	 * @var string
	 */
	public $adminEmail;
	
	/**
	 * @var string
	 */
	public $description;
	
	/**
	 * @var KalturaCommercialUseType
	 */
	public $commercialUse;
	
	/**
	 * @var string
	 */
	public $landingPage;
	
	/**
	 * @var string
	 */
	public $userLandingPage;
	
	/**
	 * @var string
	 */
	public $contentCategories;
	
	/**
	 * @var KalturaPartnerType
	 */
	public $type;
	
	/**
	 * @var string
	 */
	public $phone;
	
	/**
	 * @var string
	 */
	public $describeYourself;
	
	/**
	 * @var bool
	 */
	public $adultContent;
	
	/**
	 * @var string
	 */
	public $defConversionProfileType;
	
	/**
	 * @var int
	 */
	public $notify;
	
	/**
	 * @var int
	 * @readonly
	 */
	public $status;
	
	/**
	 * @var int
	 */
	private $shouldForceUniqueKshow;
	
	/**
	 * @var int
	 */
	private $returnDuplicateKshow;
	
	/**
	 * @var int
	 */
	public $allowQuickEdit;
	
	/**
	 * @var int
	 */
	public $mergeEntryLists;
	
	/**
	 * @var string
	 */
	public $notificationsConfig;
	
	/**
	 * @var int
	 */
	public $maxUploadSize;
	
	/**
	 * @var int
	 * readonly
	 */
	public $partnerPackage;
	
	/**
	 * @var string
	 * readonly
	 */
	public $secret;
	
	/**
	 * @var string
	 * readonly
	 */
	public $adminSecret;
	
	/**
	 * @var string
	 * @readonly
	 */
	public $cmsPassword;

	private static $map_between_objects = array
	(
		"id" , "name" , "website" => "url1" , "notificationUrl" => "url2" , "appearInSearch" , "createdAt" , "adminName" , "adminEmail" ,
		"description" , "commercialUse" , "landingPage" , "userLandingPage" , "contentCategories" , "type" , "phone" , "describeYourself" ,
		"adultContent" , "defConversionProfileType" , "notify" , "status" , "allowQuickEdit" , "mergeEntryLists" , "notificationsConfig" ,
		"maxUploadSize" , "partnerPackage" , "secret" , "adminSecret" , "cmsPassword" => "cms_password" ,
	);
	
	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}	
	
	public function fromPartner( Partner $partner )
	{
		parent::fromObject( $partner );
		return $this;
	}
	
	public function toPartner()
	{
		$partner = new Partner();
		return parent::toObject( $partner );
	}
	
}