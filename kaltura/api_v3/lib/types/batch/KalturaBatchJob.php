<?php
/**
 * @package api
 * @subpackage objects
 */

/**
 */
class KalturaBatchJob extends KalturaBaseJob
{
	/**
	 * @var string
	 */
	public $entryId;

	/**
	 * @var KalturaBatchJobType
	 * @readonly 
	 * @filter eq
	 */
    public $jobType;
    
//    job_sub_type : smallint

    
	/**
	 * @var string
	 */
    public $data;

    /**
	 * @var KalturaBatchJobStatus
	 * @filter eq
	 */
    public $status;
    
    /**
	 * @var int
	 */
    public $abort;
    
    /**
	 * @var int
	 */
    public $checkAgainTimeout;

    /**
	 * @var int
	 */
    public $progress;
    
    /**
	 * @var string
	 */
    public $message ;
    
    /**
	 * @var string
	 */
    public $description ;
    
    /**
	 * @var int
	 */
    public $updatesCount ;

    
    /**
     * When one job creates another - the parent should set this parentJobId to be its own id.
	 * @var int
	 */    
    public $parentJobId;

    
	private static $map_between_objects = array
	(
		"entryId" ,
		"jobType" , 
	 	"data" , "status" , "abort" , "checkAgainTimeout" , "progress" ,
		"message", "description" , "updatesCount" , "parentJobId" ,
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	    
	public function fromBatchJob ( BatchJob   $dbBatchJob )
	{
		parent::fromObject( $dbBatchJob );
		return $this;
	}
	
	public function toBatchJob () 
	{
		$dbBatchJob = new BatchJob();
		return parent::toObject( $dbBatchJob )	;
	}    
}

?>