<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaMixListResponse extends KalturaObject
{
	/**
	 * @var KalturaMixEntries
	 * @readonly
	 */
	public $objects;

	/**
	 * @var int
	 * @readonly
	 */
	public $totalCount;
}