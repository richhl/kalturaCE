<?php

/**
 * Subclass for representing a row from the 'bulk_upload_result' table.
 *
 * 
 *
 * @package lib.model
 */ 
class BulkUploadResult extends BaseBulkUploadResult
{
	private $aEntry = null;
	
	public function getEntry()
	{
		if ( $this->aEntry == null && $this->getEntryId() )
		{
			$this->aEntry = entryPeer::retrieveByPK( $this->getEntryId()  );
		}
		return $this->aEntry;
	}
	
	public function updateStatusFromEntry()
	{
		$entry = $this->getEntry();
		if(!$entry)
			return;
			
		$this->setEntryStatus($entry->getStatus());
		$this->save();
		
		return $this->getEntryStatus();
	}
}
