<?php

/**
 * Subclass for performing query and update operations on the 'upload_token' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UploadTokenPeer extends BaseUploadTokenPeer
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
		$c->addAnd(self::STATUS, UploadToken::UPLOAD_TOKEN_DELETED, Criteria::NOT_EQUAL);
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
}
