<?php

/**
 * Subclass for performing query and update operations on the 'notification' table.
 *
 * 
 *
 * @package lib.model
 */ 
class notificationPeer extends BasenotificationPeer
{
	function getPendingStatus()
	{
		return notification::NOTIFICATION_STATUS_PENDING;
	}
	
	function getInProcStatus()
	{
		return notification::NOTIFICATION_STATUS_QUEUED;
	}
	
	function getInProcStatusList()
	{
		return notification::NOTIFICATION_STATUS_QUEUED;
	}
	
	public static function retrieveByEntryId ( $obj_id )
	{
		$c = new Criteria();
		$c->add ( self::OBJECT_ID , $obj_id );
		$c->add ( self::OBJECT_TYPE , notification::NOTIFICATION_OBJECT_TYPE_ENTRY );
		return self::doSelect( $c );
	}
	
	public static function retrieveByEntryIdAndType($obj_id, $type)
	{
	    $c = new Criteria();
		$c->add ( self::OBJECT_ID , $obj_id );
		$c->add ( self::OBJECT_TYPE , notification::NOTIFICATION_OBJECT_TYPE_ENTRY );
		$c->add ( self::TYPE, $type);
		return self::doSelect( $c );
	}

	public static function retrieveByKshowId ( $obj_id )
	{
		$c = new Criteria();
		$c->add ( self::OBJECT_ID , $obj_id );
		$c->add ( self::OBJECT_TYPE , notification::NOTIFICATION_OBJECT_TYPE_KSHOW );
		return self::doSelect( $c );
	}
	
	
/* -------------------- Critera filter functions -------------------- */

	private static $s_criteria_filter;

	public static function  setUseCriteriaFilter ( $use )
	{
		$criteria_filter = self::getCriteriaFilter();
		
		if ( $use )  $criteria_filter->enable(); 
		else $criteria_filter->disable();
	}
	
	public static function getCriteriaFilter ( )
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
		
		$c = new Criteria();
		//$c->addAnd ( entryPeer::STATUS, entry::ENTRY_STATUS_DELETED, Criteria::NOT_EQUAL);
		self::$s_criteria_filter->setFilter ( $c );
	}
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
	public static function doCount (Criteria $criteria, $distinct = false, $con = null)
	{
		$con = self::alternativeCon ( $con );	
		self::attachCriteriaFilter ( $criteria );
		return  parent::doCount( $criteria, $distinct , $con);
	}	
	
	
	
/* -------------------- Critera filter functions -------------------- */

	public static function alternativeCon ( $con )
	{
		return myDbHelper::alternativeCon ( $con );
	}
	
	
}
