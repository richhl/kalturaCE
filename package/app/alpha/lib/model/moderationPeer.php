<?php

/**
 * Subclass for performing query and update operations on the 'moderation' table.
 *
 * 
 *
 * @package lib.model
 */ 
class moderationPeer extends BasemoderationPeer
{
	private static $s_default_count_limit = 301;
	
	private static $s_criteria_filter;
		
	
	public static function getByStatusAndObject ( $status , $object_id , $object_type )
	{
		$c = new Criteria();
		$c->add ( self::STATUS , $status );
		$c->add ( self::OBJECT_ID , $object_id );
		$c->add ( self::OBJECT_TYPE , $object_type ) ;
		return self::doSelectOne( $c );
	}
	
	
	public static function doUpdateAllModerations($selectCriteria , $values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		return BasePeer::doUpdate($selectCriteria, $values, $con);		
	}
/* -------------------- Critera filter functions -------------------- */
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
