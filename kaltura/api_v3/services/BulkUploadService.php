<?php

/**
 * Bulk Upload Service
 *
 * @service bulkUpload
 * @package api
 * @subpackage services
 */
class BulkUploadService extends KalturaBaseService
{
	/**
	 * Add new bulk upload batch job
	 * 
	 * @action add
	 * @param int $conversionProfileId Convertion profile id to use for converting the current bulk
	 * @param file $csvFileData CSV File
	 * @return KalturaBulkUpload
	 */
	function addAction($conversionProfileId, $csvFileData)
	{
		// first we copy the file to "content/batchfiles/[partner_id]/"
		$origFilename = $csvFileData["name"];

		$fileInfo = pathinfo($origFilename);
		$extension = strtolower($fileInfo["extension"]);
		
		if ($extension != "csv")
			throw new KalturaAPIException(KalturaErrors::INVALID_FILE_EXTENSION);
	
		$filename = strtolower($fileInfo["basename"]);
		$filename = substr($filename, 0, strrpos($filename, "csv") - 1);
		
		$filename = $filename . "_" . date("Y-m-d_H-i-s", time()) . "." . $extension;
			
		$relativePath = "/content/batchfiles/bulkupload/".$this->getPartnerId()."/".$filename;
		$fullPath = myContentStorage::getFSContentRootPath().$relativePath;
		
		myContentStorage::fullMkdir($fullPath);
		move_uploaded_file($csvFileData["tmp_name"], $fullPath);
		chmod($fullPath, 0777);
		
		$batchJob = new BatchJob();
		$batchJob->setPartnerId($this->getPartnerId());
		$batchJob->setSubpId($this->getPartnerId()*100);
		$batchJob->setJobType(BatchJob::BATCHJOB_TYPE_BULKUPLOAD);
		$batchJob->setStatus(BatchJob::BATCHJOB_STATUS_PENDING);
		
		// add basic data
		$data = array (
			"uid" => $this->getKuser()->getPuserId(),
			"profileId" => $conversionProfileId,
			"fileLocation" => $fullPath,
			"fileRelativeLocation" => $relativePath,
			"uploadedBy" => $this->getKuser()->getScreenName(),
			"uploadedOn" => time()
		);
		$batchJob->setData(serialize($data));
		
		$batchJob->save();
		
		return KalturaBulkUpload::fromBatchJob($batchJob);
	}
	
	/**
	 * Get bulk upload batch job by id
	 *
	 * @action get
	 * @param int $id
	 * @return KalturaBulkUpload
	 */
	function getAction($id)
	{
	    $c = new Criteria();
	    $c->addAnd(BatchJobPeer::ID, $id);
		$c->addAnd(BatchJobPeer::PARTNER_ID, $this->getPartnerId());
		$c->addAnd(BatchJobPeer::JOB_TYPE, BatchJob::BATCHJOB_TYPE_BULKUPLOAD);
		$batchJob = BatchJobPeer::doSelectOne($c);
		
		if (!$batchJob)
		    throw new KalturaAPIException(KalturaErrors::BULK_UPLOAD_NOT_FOUND, $id);
		    
		return KalturaBulkUpload::fromBatchJob($batchJob);
	}
	
	/**
	 * List bulk upload batch jobs
	 *
	 * @action list
	 * @param KalturaFilterPager $pager
	 * @return KalturaBulkUploadListResponse
	 */
	function listAction(KalturaFilterPager $pager = null)
	{
	    if (!$pager)
			$pager = new KalturaFilterPager();
			
	    $c = new Criteria();
		$c->addAnd(BatchJobPeer::PARTNER_ID, $this->getPartnerId());
		$c->addAnd(BatchJobPeer::JOB_TYPE, BatchJob::BATCHJOB_TYPE_BULKUPLOAD);
		$c->addDescendingOrderByColumn(BatchJobPeer::ID);
		
		$count = BatchJobPeer::doCount($c);
		$pager->attachToCriteria($c);
		$jobs = BatchJobPeer::doSelect($c);
		
		$response = new KalturaBulkUploadListResponse();
		$response->objects = KalturaBulkUploads::fromBatchJobArray($jobs);
		$response->totalCount = $count; 
		
		return $response;
	}
}