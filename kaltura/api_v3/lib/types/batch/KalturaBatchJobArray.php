<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaBatchJobArray extends KalturaTypedArray
{
	public static function fromBatchJobArray ( $arr )
	{
		$newArr = new KalturaBatchJobArray();
		foreach ( $arr as $obj )
		{
			$nObj = new KalturaBatchJob();
			$nObj->fromBatchJob( $obj );
			$newArr[] = $nObj;
		}
		
		return $newArr;
	}
	
	public function __construct( )
	{
		return parent::__construct ( "KalturaBatchJob" );
	}
}
?>