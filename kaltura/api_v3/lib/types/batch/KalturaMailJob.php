<?php

/**
 * @package api
 * @subpackage objects
 */

/**
 *  
 */
class KalturaMailJob extends KalturaBaseJob
{
	/**
	 * //TODO- make this of type KalturaMailType
	 * @var int
	 */
	public $mailType;

	/**
	 * @var int
	 */
    public $mailPriority;

    /**
	 * @var KalturaMailJobStatus
	 */
    public $status ;
    
	/**
	 * @var string
	 */
	public $recipientName;  

	/**
	 * @var string
	 */	
   	public $recipientEmail;
   	
	/**
	 * kuserId  
	 * @var int
	 */   	
    public $recipientId;
    
	/**
	 * @var string
	 */    
    public $fromName;
    
	/**
	 * @var string
	 */    
    public $fromEmail;
  
	/**
	 * @var string
	 */    
    public $bodyParams;

	/**
	 * @var string
	 */    
    public $subjectParams;  

	/**
 	* @var string
 	*/
    public $templatePath;

	/**
 	* @var int
 	*/
    public $culture;

	/**
 	* @var int
 	*/
    public $campaignId;

	/**
 	* @var int
 	*/
    public $minSendDate;
        
    
    private static $map_between_objects = array
	(
		"mailType" ,
		"mailPriority" , 
	 	"recipientName" , "recipientEmail" , "recipientId" , "fromName" , "fromEmail" , "bodyParams" ,
		"subjectParams", "templatePath" , "culture" , "campaignId" , "minSendDate" ,
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	    
	public function fromMailJob ( MailJob $dbMailJob )
	{
		parent::fromObject( $dbMailJob );
		return $this;
	}
	
	public function toMailJob () 
	{
		$dbMailJob = new MailJob();
		return parent::toObject( $dbMailJob )	;
	}    
}

?>