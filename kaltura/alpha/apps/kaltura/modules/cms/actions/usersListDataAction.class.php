<?php

require_once ( "kalturaCmsAction.class.php" );

class usersListDataAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) 
	{
		$sort_by = $this->getRequestParameter("sortBy", "created_at");
		$sort_direction = $this->getRequestParameter("sortDirection", "asc");
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
		
		// add sort column
		$allowed_sort_columns = array (
										'id' => kuserPeer::ID, 
										'puser_id' => PuserKuserPeer::PUSER_ID,
										'puser_name' => PuserKuserPeer::PUSER_NAME,  
										'email' => kuserPeer::EMAIL, 
										'created_at' => PuserKuserPeer::CREATED_AT
									);
		
		if (!array_key_exists($sort_by, $allowed_sort_columns))
			return sfView::ERROR;
		else
			$sort_by_column_name = $allowed_sort_columns[$sort_by];
			
		$c = new Criteria();
		
		if ( $sort_direction == "asc" )
			$c->addAscendingOrderByColumn( $sort_by_column_name );
		else if ($sort_direction == "desc")
			$c->addDescendingOrderByColumn( $sort_by_column_name );
		else
			return sfView::ERROR;

		$c->addAnd(kuserPeer::PARTNER_ID, $partner_id);
		$c->addAnd(PuserKuserPeer::PARTNER_ID, $partner_id);
		
		$count = PuserKuserPeer::doCountJoinAll($c);
		
		$c->setLimit($page_size);
		$c->setOffset(($page_index - 1)* $page_size);
		
		$pusersKusers = PuserKuserPeer::doSelectJoinkuser($c);
		
		// TODO: performance fix
		foreach($pusersKusers as $puserKuser) 
		{
			$puserid = $puserKuser->getKuserId();
			
			$c_entries = new Criteria();
			$c_entries->addAnd(entryPeer::KUSER_ID, $puserid, Criteria::EQUAL);
			$c_entries->addAnd(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP);
			$puserKuser->num_of_entries = entryPeer::doCount($c_entries);
			
			$c_shows = new Criteria();
			$c_shows->addAnd(kshowPeer::PRODUCER_ID, $puserid, Criteria::EQUAL);
			$puserKuser->num_of_shows = kshowPeer::doCount($c_shows);
		}
		
		$this->count = $count;
		$this->pusersKusers = $pusersKusers;
		
		return sfView::SUCCESS;
	}
}
?>