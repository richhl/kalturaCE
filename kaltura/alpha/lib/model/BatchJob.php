<?php
require_once( 'dateUtils.class.php');
require_once( 'myFileIndicator.class.php');
/**
 * Subclass for representing a row from the 'batch_job' table.
 *
 * 
 *
 * @package lib.model
 */ 
class BatchJob extends BaseBatchJob
{
	const BATCHJOB_TYPE_CONVERT = 0;
	const BATCHJOB_TYPE_IMPORT = 1;
	const BATCHJOB_TYPE_DELETE = 2;
	const BATCHJOB_TYPE_FLATTEN = 3;
	const BATCHJOB_TYPE_BULKUPLOAD = 4;
	const BATCHJOB_TYPE_DVDCREATOR = 5;
	const BATCHJOB_TYPE_DOWNLOAD = 6;
	const BATCHJOB_TYPE_PROJECT = 1000;
		
	const BATCHJOB_SUB_TYPE_YOUTUBE = 0;
	const BATCHJOB_SUB_TYPE_MYSPACE = 1;
	const BATCHJOB_SUB_TYPE_PHOTOBUCKET = 2;
	const BATCHJOB_SUB_TYPE_JAMENDO = 3;
	const BATCHJOB_SUB_TYPE_CCMIXTER = 4;
	
	const BATCHJOB_STATUS_PENDING = 0;
	const BATCHJOB_STATUS_QUEUED = 1;
	const BATCHJOB_STATUS_PROCESSING = 2;
	const BATCHJOB_STATUS_PROCESSED = 3;
	const BATCHJOB_STATUS_MOVEFILE = 4;
	const BATCHJOB_STATUS_FINISHED = 5;
	const BATCHJOB_STATUS_FAILED = 6;
	const BATCHJOB_STATUS_ABORTED = 7;

	private static $indicator = null;//= new myFileIndicator( "gogobatchjob" );
	
	private $aEntry = null;
	
	public static function createDeleteEntryJob ( entry $entry )
	{
		if ( $entry == null ) return;

//		if ( ! myPartnerUtils::shouldModerate( $entry->getPartnerId() ) ) return;
		$batch_job = new BatchJob();
		$batch_job->setJobType( BatchJob::BATCHJOB_TYPE_DELETE );
		$batch_job->setStatus(BatchJob::BATCHJOB_STATUS_PENDING);
		$batch_job->setEntryId( $entry->getId() );
		$batch_job->save();		 
	}
	
	public function save ( $con = null )
	{
		kLog::log( "BatchJob: save()" );
		$is_new = $this->isNew() ;
		$res = parent::save( $con );
		// when new object or status is pending - add the indicator for the batch job to start running
		if ( $is_new || ( $this->getStatus() == self::BATCHJOB_STATUS_PENDING ) )
		{
			self::addIndicator( $this->getId() , $this->getJobType() );
			kLog::log ( "BatchJob: Added indicator for BatchJob [" . $this->getId() . "] of type [{$this->getJobType() }]" );
			//debugUtils::st();			
		}
		else
		{
			kLog::log ( "BatchJob: Didn't add an indicator for BatchJob [" . $this->getId() . "]" );
		}
		
		return $res;
		
	}
	
	public function getEntry()
	{
		if ( $this->aEntry == null && $this->getEntryId() )
		{
			$this->aEntry = entryPeer::retrieveByPK( $this->getEntryId()  );
		}
		return $this->aEntry;
	}
	
	 	 
	public function getFormattedCreatedAt( $format = dateUtils::KALTURA_FORMAT )
	{
		return dateUtils::formatKalturaDate( $this , 'getCreatedAt' , $format );
	}

	public function getFormattedUpdatedAt( $format = dateUtils::KALTURA_FORMAT )
	{
		return dateUtils::formatKalturaDate( $this , 'getUpdatedAt' , $format );
	}
	
	public static function isIndicatorSet ( $type = self::BATCHJOB_TYPE_IMPORT )
	{
		return self::getIndicator( $type )->isIndicatorSet();
	}
	
	public static function addIndicator ( $id , $type = self::BATCHJOB_TYPE_IMPORT)
	{
		// TODO - remove the double indicator !
		self::getIndicator( $type )->addIndicator( $id );
		self::getIndicator( $type )->addIndicator( $id . "_"); // for now add an extra indicator 
	}
	
	
	public static function removeIndicator ( $type = self::BATCHJOB_TYPE_IMPORT )
	{
		self::getIndicator( $type )->removeIndicator();
	}
	
	private static function getIndicator( $type = self::BATCHJOB_TYPE_IMPORT )
	{
		if ( ! self::$indicator ) self::$indicator = array();
		
		if ( ! isset ( self::$indicator[$type] ) )
		{
			self::$indicator[$type] = new myFileIndicator( "gogobatchjob_{$type}" ); 
		}
		
		return self::$indicator[$type];
	}
}
