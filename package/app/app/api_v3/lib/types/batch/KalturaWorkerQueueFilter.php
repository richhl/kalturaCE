<?php
/**
 * @package api
 * @subpackage objects
 */

/**
 */
class KalturaWorkerQueueFilter extends KalturaObject
{
	/**
	 * @var int
	 */
	public $schedulerId;
	
    
	/**
	 * @var int
	 */
	public $workerId;
	
    
	/**
	 * @var int
	 */
	public $jobType;
	
    
	/**
	 * @var KalturaBatchJobFilter
	 */
	public $filter;
	
    
}

?>