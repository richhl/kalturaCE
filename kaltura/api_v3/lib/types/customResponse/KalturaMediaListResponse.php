<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaMediaListResponse extends KalturaObject
{
	/**
	 * @var KalturaMediaEntries
	 * @readonly
	 */
	public $objects;

	/**
	 * @var int
	 * @readonly
	 */
	public $totalCount;
}