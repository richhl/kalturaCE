<?php
/**
 * @package api
 * @subpackage enum
 */
class KalturaEntryStatus extends KalturaEnum
{
	const ERROR_CONVERTING = -1;
	const IMPORT = 0;
	const PRECONVERT = 1;
	const READY = 2;
	const DELETED = 3;
	const PENDING = 4;  // NOT is use !
	const MODERATE = 5; // entry waiting in the moderation queue
	const BLOCKED = 6;
}