<?php

require_once ( "kalturaCmsAction.class.php" );

class bulkUploadDoUploadAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) 
	{
		$error = "";
		$msg = "";
		if (count($_FILES) > 0)
		{
			// first we copy the file to "content/batchfiles/[partner_id]/"
			$origFilename = $_FILES['fileToUpload']['name'];
			
			$fileInfo = pathinfo($origFilename);
			$extension = strtolower($fileInfo['extension']);
			
			if ($extension != "csv")
			{
				$error = "File extension is invalid";
			}
			else
			{
				$filename = strtolower($fileInfo['basename']);
				
				$filename = substr($filename, 0, strrpos($filename, "csv") - 1);
				
				$filename = $filename . "_" . date("Y-m-d_H-i-s", time()) . "." . $extension;
					
				$relativePath = "/content/batchfiles/bulkupload/".$partner_id."/".$filename;
				$fullPath = myContentStorage::getFSContentRootPath().$relativePath;
				
				myContentStorage::fullMkdir($fullPath);
				move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fullPath);
				chmod($fullPath, 0777);
				
				$adminKuserId = $this->getContext()->getUser()->getAttribute('adminkuser_id');
				$adminKuser = adminKuserPeer::retrieveByPK($adminKuserId);
				
				$batchJob = new BatchJob();
				$batchJob->setPartnerId($partner_id);
				$batchJob->setSubpId($partner_id*100);
				$batchJob->setJobType(BatchJob::BATCHJOB_TYPE_BULKUPLOAD);
				$batchJob->setStatus(BatchJob::BATCHJOB_STATUS_PENDING);
				
				// add basic data
				$data = array (
					"uid" => $this->getRequestParameter("uid"),
					"name" => $this->getRequestParameter("name"),
					"homePageLink" => $this->getRequestParameter("homePageLink"),
					"conversionQuality" => $this->getRequestParameter("conversionQuality"),
					"contentPermissions" => $this->getRequestParameter("contentPermissions"),
					"fileLocation" => $fullPath,
					"fileRelativeLocation" => $relativePath,
					"uploadedBy" => $adminKuser->getFullName(),
					"uploadedOn" => time()
				);
				$batchJob->setData(serialize($data));
				
				$batchJob->save();
			}
		}
		
		$res = "";
		$res .= "{";
		$res .=		"error: '" . $error . "',\n";
		$res .=		"msg: '" . $msg . "'\n";
		$res .= "}";
		
		return $this->renderText($res);
	}
}
?>