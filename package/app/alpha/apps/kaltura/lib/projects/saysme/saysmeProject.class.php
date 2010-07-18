<?php
class saysmeProject extends kalturaProject
{
	const TRANSCODE = 1;
	
	private static $id = 1;
	private static $name = "SaysMe";
	public function getId() { return self::$id;} 
	public function getName() { return self::$name;}

	public function getPrjectDataDir ()
	{
		return myContentStorage::getFSContentRootPath() . "/kaltura/projects/saysme/";
	}
	
	public function getPrjectWorkDir ()
	{
		return myContentStorage::getFSContentRootPath() . "/projects_tmp/saysme/";
	}
	
	public function getFtpDetails ()
	{
		return array ( "ftp.dgsystems.com" , "SYSME-NB" , "s7sm4nb" );
		//return array ( "ftp.kaltura.com" , "projects7" , "3" );
	}
	
	public function getFtpRemotePath ()
	{
		//return array ( "ftp.dgsystems.com" , "ggg" , "hhh" );
		return "";
	}	
	
	// will creaet a new batch job for saysme conversion
	// if fource_new is false - will check for a successful similar job (same entry_id and asci) 
	//		- will not create a new one if already exists
	public static function createBatchJob ( $entry , $isci , $force_new = true )
	{
		$batch_job = new BatchJob();
		$batch_job->setPartnerId ( $entry->getPartnerId() );
		$batch_job->setEntryId ( $entry->getId() );
		$batch_job->setStatus ( BatchJob::BATCHJOB_STATUS_PENDING  );
		$batch_job->setJobType( BatchJob::BATCHJOB_TYPE_PROJECT + self::$id );
		$batch_job->setProgress( 0 );
		
		$data = new saysmeJobData ();
		$data->isci = $isci;
		$data->spot_title = $entry->getName();
		$data->date = date ( "m/d/Y" ); 
		$data->duration = (int) ($entry->getLengthInMsecs()/1000); // round out the seconds
		
		$batch_job->setData( serialize ( $data ) );
		$batch_job->save();
		
		return $batch_job;
	}
}

class batchJobProgress 
{
	private $total_steps;
	private $current_step = 0;
	private $job = null;
	
	public function batchJobProgress ( BatchJob $job , $total_steps = 10 )
	{
		$this->total_steps = $total_steps;
		$this->job = $job;
	}
	
	
	public function incStep( $message = null )
	{
		if ( $this->job )
		{
			$this->current_step ++;
			if ( $this->total_steps > 0 )
			{
				$progress = 100 * ( $this->current_step / $this->total_steps );
				if ( $progress > 100 ) $progress = 100;
				$this->job->setProgress ( $progress );
				if ( $message ) $this->job->setMessage ( $message );
				$this->job->save();
			}
		}
	}
	
	public function done ()
	{
		if ( $this->job )
		{
			$this->job->setStatus ( BatchJob::BATCHJOB_STATUS_FINISHED );
			$this->job->setProgress ( 100 );
			$this->job->setMessage ( "successfully dropped" );
			$this->job->save();					
		}
	}
	
}
class saysmeJobData 
{
	public $isci;
	public $spot_title;
	public $date;
	public $duration;
}
?>