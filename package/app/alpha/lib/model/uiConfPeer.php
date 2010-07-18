<?php

/**
 * Subclass for performing query and update operations on the 'ui_conf' table.
 *
 * 
 *
 * @package lib.model
 */ 
class uiConfPeer extends BaseuiConfPeer
{
	public static function retrieveByConfFilePath ( $path , $id =null)
	{
		// search for the canonical way of writing the path
		$c = new Criteria();
		$c->add ( self::CONF_FILE_PATH , $path );
		if ( $id ) $c->add ( self::ID , $id , Criteria::NOT_EQUAL );
		self::getCriteriaFilter()->disable();
		$res = self::doSelect( $c );
		self::getCriteriaFilter()->enable();
		return $res;
	}
	
	private static $s_criteria_filter;
	
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
		$c->add ( self::STATUS , uiConf::UI_CONF_STATUS_DELETED , Criteria::NOT_EQUAL );
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

	
/* -------------------- Critera filter functions -------------------- */

	public static function alternativeCon ( $con )
	{
		return myDbHelper::alternativeCon ( $con );
	}
		
}
