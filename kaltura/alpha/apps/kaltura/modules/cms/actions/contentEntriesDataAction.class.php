<?php

require_once ( "kalturaCmsAction.class.php" );
require_once ( "dateUtils.class.php" );
require_once ( "mySearchUtils.class.php" );

class contentEntriesDataAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) 
	{
		$start_date = $this->getRequestParameter("startDate", null);
		$end_date = $this->getRequestParameter("endDate", null);
		$key_words = $this->getRequestParameter("keyWords", "");
		$sort_by = $this->getRequestParameter("sortBy", "created_at");
		$sort_direction = $this->getRequestParameter("sortDirection", "asc");
		$page_index = $this->getRequestParameter("pageIndex", 1);
		$page_size = $this->getRequestParameter("pageSize", 20);
		$user_id = $this->getRequestParameter("userId", null);		
		
		if (!ctype_digit($page_index))
			return sfView::ERROR;
		$page_index = (int)$page_index;

		if (!ctype_digit($page_size))
			return sfView::ERROR;
		$page_size = (int)$page_size;

		// limit page size
		$page_size = min ( $page_size , 100 );
		
		$c = new Criteria();
		
		// only entreis
		
		$c->addAnd(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP);
		
		// start date filter
		if ($start_date) 		
			$c->addAnd(entryPeer::CREATED_AT, dateUtils::convertFromPhpDate($start_date), Criteria::GREATER_EQUAL);
			
		// end date fillter
		if ($end_date) 		
			$c->addAnd(entryPeer::CREATED_AT, dateUtils::convertFromPhpDate($end_date), Criteria::LESS_EQUAL);
		
		if ($key_words) 		
			$c->addAnd(entryPeer::SEARCH_TEXT, "%$key_words%", Criteria::LIKE);
			
		if ($user_id)
			$c->addAnd(entryPeer::KUSER_ID, $user_id, Criteria::EQUAL);
			
		// add sort column
		$allowed_sort_columns = array (
										'name' => entryPeer::NAME, 
										'permissions' => entryPeer::PERMISSIONS, 
										'created_by' => kuserPeer::SCREEN_NAME, 
										'created_on' => entryPeer::CREATED_AT,
										'views' => entryPeer::VIEWS
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
		
		$search_result = mySearchUtils::search(mySearchUtils::MODE_ENTRY, $key_words, $page_index, $page_size, $c);
		
		$count = $search_result[1];
		$entries = $search_result[0];
		$entry_ids = array();
		
		foreach ($entries as $entry)
		{
			//TODO: perfomace fix
			$kshows = kshowPeer::getKshowsByEntryIds($entry->getId());
			$entry->shows = $kshows; 
		}
		
		
		$this->count = $count;
		$this->entries = $entries;
		
		return sfView::SUCCESS;
	}
}
?>