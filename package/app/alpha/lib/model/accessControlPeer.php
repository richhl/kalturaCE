<?php

/**
 * Subclass for performing query and update operations on the 'access_control' table.
 *
 * 
 *
 * @package lib.model
 */ 
class accessControlPeer extends BaseaccessControlPeer
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
	
	public static function getIdsValidForScope(accessControlScope $scope)
	{
		$profiles = self::getValidForScope($scope);
		$ids = array();
		foreach($profiles as $profile)
		{
			$ids[] = $profile->getId();
		}
		return $ids;
	}
	
	public static function getValidForScope(accessControlScope $scope)
	{
		$c = new Criteria();
		$c->setLimit(Partner::MAX_ACCESS_CONTROLS);
		$profiles = self::doSelect($c);
		$curretProfiles = array();
		foreach($profiles as $profile)
		{
			$profile->setScope($scope);
			if ($profile->isValid())
				$curretProfiles[] = $profile;
		}
		
		return $curretProfiles;
	}
}