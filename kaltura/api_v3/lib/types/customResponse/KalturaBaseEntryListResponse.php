<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaBaseEntryListResponse extends KalturaObject
{
	/**
	 * @var KalturaBaseEntries
	 * @readonly
	 */
	public $objects;

	/**
	 * @var int
	 * @readonly
	 */
	public $totalCount;
}