<?php
/**
 * The KalturaFilterPager object enables paging management to be applied upon service list actions. 
 * 
 * @package api
 * @subpackage filters
 */
class KalturaFilterPager extends KalturaObject
{
	/**
	 * The number of objects to retrieve. Maximum page size is 50.
	 * 
	 * @var int 
	 */
	public $pageSize = 30;
	
	/**
	 * The page number for which {pageSize} of objects should be retrieved.
	 * 
	 * @var int
	 */
	public $pageIndex = 1;	
	
	
	public $maxPageSize = 50;
	private $minPageIndex = 1;
	
	public function attachToCriteria ( Criteria $c )
	{
		$limit = $this->pageSize;
		if ( $limit > $this->maxPageSize ) 
		{	
			$limit = $this->maxPageSize;
		}
		
		$page = max ( $this->minPageIndex ,  $this->pageIndex );
		$offset = ($page-1)* $limit;
	
		$c->setLimit( $limit );
		if ( $offset > 0 ) $c->setOffset( $offset );
	}
}
?>