<?php

class KalturaBulkUploads extends KalturaTypedArray
{
	public static function fromBatchJobArray ($arr)
	{
		$newArr = new KalturaBulkUploads();
		if ($arr == null)
			return $newArr;
					
		foreach ($arr as $obj)
		{
			$newArr[] = KalturaBulkUpload::fromBatchJob($obj);
		}
		
		return $newArr;
	}
		
	public function __construct()
	{
		parent::__construct("KalturaBulkUpload");	
	}
}