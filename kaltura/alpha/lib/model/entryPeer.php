<?php
/**
 * Subclass for performing query and update operations on the 'entry' table.
 *
 * 
 *
 * @package lib.model
 */ 
class entryPeer extends BaseentryPeer 
{
	private static $s_default_count_limit = 301;
	
	private static $s_criteria_filter;
	
	/**
	 * This function sets the requested order of entries to the given criteria object.
	 * we can use an associative array to hold the ordering fields instead of the
	 * switch statement being used now
	 *
	 * @param $c = given criteria object
	 * @param int $order = the requested sort order
	 */
	public static function setOrder($c, $order)
	{
		switch ($order) {
		case entry::ENTRY_SORT_MOST_VIEWED:
			//$c->hints = array(entryPeer::TABLE_NAME => "views_index");
			$c->addDescendingOrderByColumn(entryPeer::VIEWS);
			break;
		  
		case entry::ENTRY_SORT_MOST_RECENT:
			//$c->hints = array(entryPeer::TABLE_NAME => "created_at_index");
			$c->addDescendingOrderByColumn(entryPeer::CREATED_AT);
			break;
			
		case entry::ENTRY_SORT_MOST_COMMENTS:  
			$c->addDescendingOrderByColumn(entryPeer::COMMENTS);
			break;
			
		case entry::ENTRY_SORT_MOST_FAVORITES:  
			$c->addDescendingOrderByColumn(entryPeer::FAVORITES);
			break;
			
		case entry::ENTRY_SORT_RANK:
			$c->addDescendingOrderByColumn(entryPeer::RANK);
			break;
			
		case entry::ENTRY_SORT_MEDIA_TYPE:
			$c->addAscendingOrderByColumn(entryPeer::MEDIA_TYPE);
			break;
			
		case entry::ENTRY_SORT_NAME:
			$c->addAscendingOrderByColumn(entryPeer::NAME);
			break;
			
			case entry::ENTRY_SORT_KUSER_SCREEN_NAME:
			$c->addAscendingOrderByColumn(kuserPeer::SCREEN_NAME);
			break;
		}
	}
	
	public static function getOrderedCriteria($kshowId, $order, $limit, $introId = null, $entryId = null)
	{
		$c = new Criteria();
		$c->add(entryPeer::KSHOW_ID, $kshowId);
		$c->add(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP);
		
		if ($introId)
			$c->add(entryPeer::ID, $introId, Criteria::NOT_EQUAL);
			
		if ($entryId)
			$c->addDescendingOrderByColumn('(' . entryPeer::ID . '="' . $entryId . '")');
		
		entryPeer::setOrder($c, $order);
		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID, Criteria::INNER_JOIN);
		
	    $c->setLimit($limit);
			    
	    return $c;
	}
	
	/**
	 * This function returns a pager object holding the specified kshows' entries
	 * sorted by a given sort order.
	 * each entry holds the kuser object of its host.
	 *
	 * @param int $kshowId = the requested sort order
	 * @param int $order = the requested sort order
	 * @param int $pageSize = number of kshows in each page
	 * @param int $page = the requested page
	 * @param int $firstEntries = an array of entries to be picked first (show entry, show intro,
	 *	or an arbitrary entry that was pointed to by the url)
	 * @return the pager object
	 */
	public static function getOrderedPager($kshowId, $order, $pageSize, $page, $firstEntries = null)
	{
		$c = new Criteria();
		$c->add(entryPeer::KSHOW_ID, $kshowId);
		$c->add(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP);
		
		if ($firstEntries)
			foreach($firstEntries as $firstEntryId)
				$c->addDescendingOrderByColumn('(' . entryPeer::ID . '="' . $firstEntryId . '")');
			
		entryPeer::setOrder($c, $order);
		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID, Criteria::INNER_JOIN);
		
		$pager = new sfPropelPager('entry', $pageSize);
	    $pager->setCriteria($c);
	    $pager->setPage($page);
	    $pager->setPeerMethod('doSelectJoinkuser');
	    $pager->setPeerCountMethod('doCountJoinkuser');
	    $pager->init();
			    
	    return $pager;
	}

	
		/**
	 * This function returns a pager object holding the specified kshows' entries
	 * sorted by a given sort order.
	 * each entry holds the kuser object of its host.
	 *
	 * @param int $kshowId = the requested sort order
	 * @param int $order = the requested sort order
	 * @param int $pageSize = number of kshows in each page
	 * @param int $page = the requested page
	 * @param int $firstEntries = an array of entries to be picked first (show entry, show intro,
	 *	or an arbitrary entry that was pointed to by the url)
	 * @return the pager object
	 */
	public static function getUserEntriesOrderedPager( $order, $pageSize, $page, $userid, $favorites_flag )
	{
		if( $favorites_flag ) return self::getUserFavorites($userid, favorite::SUBJECT_TYPE_ENTRY, favorite::PRIVACY_TYPE_USER, $pageSize, $page, $order );
		
		$c = new Criteria();
		$c->add(entryPeer::KUSER_ID, $userid);
		$c->add(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP);
			
		entryPeer::setOrder($c, $order);
		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID, Criteria::INNER_JOIN);
		
		$pager = new sfPropelPager('entry', $pageSize);
	    $pager->setCriteria($c);
	    $pager->setPage($page);
	    $pager->setPeerMethod('doSelectJoinkuser');
	    $pager->setPeerCountMethod('doCountJoinkuser');
	    $pager->init();
			    
	    return $pager;
	}
	
	/**
	 * This function returns a pager object holding the given user's favorite entries
	 * each entry holds the kuser object of its host.
	 *
	 * @param int $kuserId = the requested user
	 * @param int $type = the favorite type (currently only SUBJECT_TYPE_ENTRY will match)
	 * @param int $privacy = the privacy filter
	 * @param int $pageSize = number of kshows in each page
	 * @param int $page = the requested page
	 * @return the pager object
	 */
	public static function getUserFavorites($kuserId, $type, $privacy, $pageSize, $page, $order = entry::ENTRY_SORT_MOST_VIEWED )
	{
		$c = new Criteria();
		entryPeer::setOrder($c, $order);
		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID, Criteria::INNER_JOIN);
		$c->addJoin(entryPeer::ID, favoritePeer::SUBJECT_ID, Criteria::INNER_JOIN);
		$c->add(favoritePeer::KUSER_ID, $kuserId);
		$c->add(favoritePeer::SUBJECT_TYPE, $type);
		$c->add(favoritePeer::PRIVACY, $privacy);
		$c->setDistinct();
		
		// our assumption is that a request for private favorites should include public ones too 
		if( $privacy == favorite::PRIVACY_TYPE_USER ) 
		{
			$c->addOr( favoritePeer::PRIVACY, favorite::PRIVACY_TYPE_WORLD );
		}
		
		
		$c->addAscendingOrderByColumn(entryPeer::NAME);
		
	    $pager = new sfPropelPager('entry', $pageSize);
	    $pager->setCriteria($c);
	    $pager->setPage($page);
	    $pager->setPeerMethod('doSelectJoinkuser');
	    $pager->setPeerCountMethod('doCountJoinkuser');
	    $pager->init();
			    
	    return $pager;
	}
	
	public static function getUserEntries($kuserId, $pageSize, $page)
	{
		$c = new Criteria();
		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID, Criteria::INNER_JOIN);
		$c->add(entryPeer::KUSER_ID, $kuserId);
		$c->add(entryPeer::TYPE, entry::ENTRY_TYPE_MEDIACLIP);
		$c->addAscendingOrderByColumn(entryPeer::CREATED_AT);
		
	    $pager = new sfPropelPager('entry', $pageSize);
	    $pager->setCriteria($c);
	    $pager->setPage($page);
	    $pager->setPeerMethod('doSelectJoinkuser');
	    $pager->setPeerCountMethod('doCountJoinkuser');
	    $pager->init();
			    
	    return $pager;
	}
	
	public static function selectIdsForCriteria ( Criteria $c )
	{
		$c->addSelectColumn(self::ID);
		$rs = self::doSelectRS($c);
		$id_list = Array();
		
		while($rs->next())
		{
			$id_list[] = $rs->getInt(1);
		}
		
		$rs->close();
		
		return $id_list;
	}	

	public static function allowDeletedInCriteriaFilter()
	{
		$ecf = entryPeer::getCriteriaFilter();
		$ecf->getFilter()->remove ( entryPeer::STATUS );
	}
	
	public static function blockDeletedInCriteriaFilter()
	{
		$ecf = entryPeer::getCriteriaFilter();
		$ecf->getFilter()->addAnd ( entryPeer::STATUS, entry::ENTRY_STATUS_DELETED, Criteria::NOT_EQUAL);
	}	
	
/* -------------------- Critera filter functions -------------------- */	
	public static function retrieveByPKNoFilter ($pk, $con = null)
	{
		self::setUseCriteriaFilter ( false );
		$res = parent::retrieveByPK( $pk , $con );
		self::setUseCriteriaFilter ( true );
		return $res;
	}

	public static function retrieveByPKsNoFilter ($pks, $con = null)
	{
		self::setUseCriteriaFilter ( false );
		$res = parent::retrieveByPKs( $pks , $con );
		self::setUseCriteriaFilter ( true );
		return $res;
	}
	
	/**
	 * find all the entries from a list of ids that have the proper status to be considered non-pending
	 */
	public static function retrievePendingEntries ($pks, $con = null)
	{
		self::setUseCriteriaFilter ( false );
		$c= new Criteria();
		$c->add ( entryPeer::ID , $pks , Criteria::IN );
		$c->add ( entryPeer::STATUS , array ( entry::ENTRY_STATUS_READY , entry::ENTRY_STATUS_ERROR_CONVERTING ) , Criteria::NOT_IN );
		$res = self::doSelect( $c );
		self::setUseCriteriaFilter ( true );
		return $res;
	}
	
	// TODO - fix this method - it doesn't work !
	public static function  setUseCriteriaFilter ( $use )
	{
		$criteria_filter = self::getCriteriaFilter();
		
		if ( $use )  $criteria_filter->enable(); 
		else $criteria_filter->disable();
	}
	
	public static function &getCriteriaFilter ( )
	{
		if ( self::$s_criteria_filter == null )
		{
			self::setDefaultCriteriaFilter();
		}
		
		return self::$s_criteria_filter;
	}
	 
	public static function setDefaultCriteriaFilter ()
	{
		if ( self::$s_criteria_filter == null )
		{
			self::$s_criteria_filter = new criteriaFilter ();
		}
		
		$c = new myCriteria(); 
		$c->addAnd ( entryPeer::STATUS, entry::ENTRY_STATUS_DELETED, Criteria::NOT_EQUAL);
		self::$s_criteria_filter->setFilter ( $c );
	}
	/* 
		the filterCriteria will filter out all the doSelectXXX methods - ONLY if the filter is turned on.
		IMPORTANT - the filter is turend on by default and when switched off - should be turned on again manually .
		TODO - generalize the solutoin to one of a set of pre-defined criteria-filters   
	*/
	protected static function attachCriteriaFilter ( Criteria $criteria )
	{
		self::getCriteriaFilter()->applyFilter ( $criteria );
	}
	
	// The following function overides the base class so that result set includes only non-deleted entries
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria , $con );
		return  parent::doSelectRS( $criteria, $con);
	}
	
	// The following function overides the base class so that result set includes only non-deleted entries
	public static function doSelectJoinkshow(Criteria $criteria, $con = null)
	{
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria );
		return  parent::doSelectJoinkshow( $criteria, $con);
	}
	public static function doCountJoinkshow(Criteria $criteria, $distinct = false, $con = null)
	{
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria );
		return  parent::doCountJoinkshow( $criteria, $distinct , $con);
	}	
	
	// The following function overides the base class so that result set includes only non-deleted entries
	public static function doSelectJoinkuser(Criteria $criteria, $con = null)
	{	
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria );
		return  parent::doSelectJoinkuser( $criteria, $con);
	}
	public static function doCountJoinkuser(Criteria $criteria, $distinct = false, $con = null)
	{
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria );
		return  parent::doCountJoinkuser ( $criteria, $distinct , $con);
	}

	// The following function overides the base class so that result set includes only non-deleted entries
	public static function doSelectJoinAll(Criteria $criteria, $con = null)
	{	
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria );
		return  parent::doSelectJoinAll( $criteria, $con);
	}
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$con = self::alternativeCon ( $con );	
		self::attachCriteriaFilter ( $criteria );
		return  parent::doCountJoinAll( $criteria, $distinct , $con);
	}	
	
	// The following function overides the base class so that result set includes only non-deleted entries
	public static function doSelectJoinAllExceptkshow(Criteria $criteria, $con = null)
	{	
		self::attachCriteriaFilter ( $criteria );
		return  parent::doSelectJoinAllExceptkshow( $criteria, $con);
	}
	public static function doCountJoinAllExceptkshow(Criteria $criteria, $distinct = false, $con = null)
	{
		self::attachCriteriaFilter ( $criteria );
		return  parent::doCountJoinAllExceptkshow( $criteria, $distinct , $con);
	}	
	
	// The following function overides the base class so that result set includes only non-deleted entries
	public static function doSelectJoinAllExceptkuser(Criteria $criteria, $con = null)
	{	
		self::attachCriteriaFilter ( $criteria );
		return  parent::doSelectJoinAllExceptkuser( $criteria, $con);
	}
	public static function doCountJoinAllExceptkuser(Criteria $criteria, $distinct = false, $con = null)
	{
		self::attachCriteriaFilter ( $criteria );
		return  parent::doCountJoinAllExceptkuser( $criteria, $distinct , $con);
	}	
	
	public static function doCountWithLimit (Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn("DISTINCT ".entryPeer::ID);
		} else {
			$criteria->addSelectColumn(entryPeer::ID);
		}

		$criteria->setLimit( self::$s_default_count_limit );
		
		$rs = entryPeer::doSelectRS($criteria, $con);
		$count = 0;
		while($rs->next())
			$count++;
	
		return $count;
	}
	
	public static function doStubCount (Criteria $criteria, $distinct = false, $con = null)
	{
		return 0;
	}	
	
	
/* -------------------- Critera filter functions -------------------- */
	

	public static function alternativeCon ( $con )
	{
		return myDbHelper::alternativeCon ( $con );
	}

	
	// this function sets the status of an entry to entry::ENTRY_STATUS_DELETED
	// users can only delete their own entries
	public static function setStatusDeletedForEntry( $entry_id, $kuser_id  )
	{
		// 
		$entry = self::retrieveByPK( $entry_id );
		if( $entry == null ) return false;
		if( $entry->getKuserId() == $kuser_id ) $entry->setStatus( entry::ENTRY_STATUS_DELETED ); else return false;
		$entry->save();
		return true;
	}
}

class entryPool
{
	private $map ;
	public function addEntries ( $entries )
	{
		$this->map = array();
		foreach ( $entries as $entry )
		{
			$this->map[$entry->getId()]=$entry;
		}
	}
	
	public function retrieveByPK ( $id )
	{
		return @$this->map[$id];
	}
	
	public function release()
	{
		$this->map = null;
	}
}
