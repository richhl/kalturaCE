<?php

/**
 * Subclass for performing query and update operations on the 'widget' table.
 *
 * 
 *
 * @package lib.model
 */ 
class widgetPeer extends BasewidgetPeer
{
	const WIDGET_PEER_JOIN_KSHOW = 1;
	const WIDGET_PEER_JOIN_ENTRY = 2;
	const WIDGET_PEER_JOIN_UI_CONF = 4;
	const WIDGET_PEER_JOIN_ALL = 8;
/*	
	public static function retrieveByHashedId($pk, $con = null)
	{
		// try fetching by alias
		$c = new Criteria();
		$c->add ( self:: , $pk );
		$partner = self::doSelectOne( $c );
		return $partner;
	}
*/

	public static function retrieveByPk ($pk, $con = null , $join = null)
	{
		if ( $join == null )
			return parent::retrieveByPK( $pk , $con );
		$c = new Criteria();
		$c->add ( self::ID , $pk );
		$c->setLimit( 1 );
		// TODO - support all joins -
		// for now supporting only kshow,entry,kshow+entry and all 
		if ( $join == self::WIDGET_PEER_JOIN_KSHOW )
			$res = self::doSelectJoinkshow( $c , $con );
		elseif ( $join == self::WIDGET_PEER_JOIN_ENTRY )
			$res = self::doSelectJoinentry( $c , $con );
		elseif ( $join == self::WIDGET_PEER_JOIN_ENTRY + self::WIDGET_PEER_JOIN_KSHOW )
			$res = self::doSelectJoinAllExceptuiConf( $c , $con );
		elseif ( $join == self::WIDGET_PEER_JOIN_ALL )		
			$res = self::doSelectJoinAllExceptuiConf( $c , $con );
		else
			throw new Exception ( "still NEED to implement join type [$join]") ; 	
					
		return $res;
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
