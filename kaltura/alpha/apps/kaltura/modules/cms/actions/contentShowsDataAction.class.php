<?php

require_once ( "kalturaCmsAction.class.php" );
require_once ( "mySearchUtils.class.php" );

class contentShowsDataAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) 
	{
		$key_words = $this->getRequestParameter("keyWords", "");
		$sort_by = $this->getRequestParameter("sortBy", "created_at");
		$sort_direction = $this->getRequestParameter("sortDirection", "asc");
		$user_id = $this->getRequestParameter("userId", null);
		
		$page_index = $this->getRequestParameter("pageIndex", 1);
		if (!ctype_digit($page_index))
			return sfView::ERROR;
		$page_index = (int)$page_index;

		$page_size = $this->getRequestParameter("pageSize", 20);
		if (!ctype_digit($page_size))
			return sfView::ERROR;
		$page_size = (int)$page_size;

		// limit page size
		$page_size = min ( $page_size , 100 );

		$c = new Criteria();
		
		if ($user_id)
			$c->addAnd(kshowPeer::PRODUCER_ID, $user_id, Criteria::EQUAL);
			
		$allowed_sort_columns = array (
										'name' => kshowPeer::NAME,
										'duration' => kshowPeer::LENGTH_IN_MSECS, 
										'permissions' => kshowPeer::PERMISSIONS, 
										'created_by' => kuserPeer::SCREEN_NAME, 
										'created_on' => kshowPeer::CREATED_AT,
										'last_update' => kshowPeer::UPDATED_AT,
										'contributors' => kshowPeer::CONTRIBUTORS,
										'entries' => kshowPeer::ENTRIES,
										'views' => kshowPeer::VIEWS 
									);
									
		if (!array_key_exists($sort_by, $allowed_sort_columns))
			return sfView::ERROR;
		else
			$sort_by_column_name = $allowed_sort_columns[$sort_by];
			
		
		if ( $sort_direction == "asc" )
			$c->addAscendingOrderByColumn( $sort_by_column_name );
		else if ($sort_direction == "desc")
			$c->addDescendingOrderByColumn( $sort_by_column_name );
		else
			return sfView::ERROR;

		$search_result = mySearchUtils::search(mySearchUtils::MODE_KSHOW, $key_words, $page_index, $page_size, $c);
		
		$this->count = $search_result[1];
		$this->shows = $search_result[0];
		
		return sfView::SUCCESS;
	}
}
?>