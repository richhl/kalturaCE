<?php
/**
 * @package api
 * @subpackage enum
 */
class KalturaBatchJobStatus extends KalturaEnum
{
	const PENDING = 0;
	const QUEUED = 1;
	const PROCESSING = 2;
	const PROCESSED = 3;
	const MOVEFILE = 4;
	const FINISHED = 5;
	const FAILED = 6;
	const ABORTED = 7;
}
?>