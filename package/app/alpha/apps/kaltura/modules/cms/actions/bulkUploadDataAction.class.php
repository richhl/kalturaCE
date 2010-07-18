<?php

require_once ( "kalturaCmsAction.class.php" );
require_once ( "dateUtils.class.php" );
require_once ( "mySearchUtils.class.php" );

class bulkUploadDataAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) 
	{
		$page_index = $this->getRequestParameter("pageIndex", 1);
		$page_size = $this->getRequestParameter("pageSize", 20);
		
		if (!ctype_digit($page_index))
			return sfView::ERROR;
		$page_index = (int)$page_index;

		if (!ctype_digit($page_size))
			return sfView::ERROR;
		$page_size = (int)$page_size;

		// limit page size
		$page_size = min ( $page_size , 100 );
		
		$c = new Criteria();
		$c->addAnd(BatchJobPeer::PARTNER_ID, $partner_id);
		$c->addAnd(BatchJobPeer::JOB_TYPE, BatchJob::BATCHJOB_TYPE_BULKUPLOAD);
		$c->addDescendingOrderByColumn(BatchJobPeer::ID);
		
		$this->count = BatchJobPeer::doCount($c);
		
		$c->setLimit($page_size);
		$c->setOffset(($page_index - 1)* $page_size);
		$result = BatchJobPeer::doSelect($c);
		
		$this->jobs = $result;
	}
}

?>