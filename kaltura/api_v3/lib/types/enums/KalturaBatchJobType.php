<?php
/**
 * @package api
 * @subpackage enum
 */
class KalturaBatchJobType extends KalturaEnum
{
	const CONVERT = 0;
	const IMPORT = 1;
	const DELETE = 2;
	const FLATTEN = 3;
	const BULKUPLOAD = 4;
	const DVDCREATOR = 5;
	const DOWNLOAD = 6;
	const OOCONVERT = 7;
	const PRECONVERT = 10;
	const POSTCONVERT = 11;
	
	const PROJECT = 1000;
}
?>