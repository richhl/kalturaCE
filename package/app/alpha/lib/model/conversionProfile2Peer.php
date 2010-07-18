<?php

/**
 * Subclass for performing query and update operations on the 'conversion_profile_2' table.
 *
 * 
 *
 * @package lib.model
 */ 
class conversionProfile2Peer extends BaseconversionProfile2Peer
{
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
		$c->add ( self::DELETED_AT, null, Criteria::EQUAL );
		self::$s_criteria_filter->setFilter ( $c );
	}

	protected static function attachCriteriaFilter ( Criteria $criteria )
	{
		self::getCriteriaFilter()->applyFilter ( $criteria );
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		$con = self::alternativeCon ( $con );
		self::attachCriteriaFilter ( $criteria , $con );
		return  parent::doSelectRS( $criteria, $con);
	}
	
	public static function alternativeCon ( $con )
	{
		return myDbHelper::alternativeCon ( $con );
	}
	
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
}
