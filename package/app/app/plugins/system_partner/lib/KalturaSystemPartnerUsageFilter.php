<?php
/**
 * @package plugins.systemPartner
 * @subpackage api.objects
 */
class KalturaSystemPartnerUsageFilter extends KalturaFilter
{
	/**
	 * Date range from
	 * 
	 * @var int
	 */
	public $fromDate;
	
	/**
	 * Date range to
	 * 
	 * @var int
	 */
	public $toDate;
}