<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaBulkUpload extends KalturaObject
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $uploadedBy;
    
    /**
     * @var int
     */
    public $uploadedOn;
    
    /**
     * @var int
     */
    public $numOfEntries;
    
    /**
     * @var KalturaBatchJobStatus
     */
    public $status;
    
    /**
     * @var string
     */
    public $logFileUrl;
    
    /**
     * @var string;
     */
    public $csvFileUrl;
    
    public static function fromBatchJob(BatchJob $batchJob)
    {
        if ($batchJob->getJobType() != BatchJob::BATCHJOB_TYPE_BULKUPLOAD)
            throw new Exception("Bulk upload object can be initialized from bulk upload job only");
            
        $bulkUpload = new KalturaBulkUpload();
        $jobData = unserialize($batchJob->getData());
        $bulkUpload->id = $batchJob->getId();
		$bulkUpload->uploadedBy = $jobData["uploadedBy"];
		$bulkUpload->uploadedOn = $jobData["uploadedOn"];
	    $bulkUpload->numOfEntries = (@$jobData["numOfEntries"]) ? $jobData["numOfEntries"] : -1;
		$bulkUpload->status = $batchJob->getStatus();
		$bulkUpload->error = @$jobData["error"];
		$bulkUpload->logFileUrl = (@$jobData["logFile"]) ? requestUtils::getCdnHost() . $jobData["logFile"] : "";
		$bulkUpload->csvFileUrl = (@$jobData["fileRelativeLocation"]) ? requestUtils::getCdnHost() . $jobData["fileRelativeLocation"] : "";
		return $bulkUpload;
    }
}