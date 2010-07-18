<?php

/**
 * Subclass for performing query and update operations on the 'track_entry' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TrackEntryPeer extends BaseTrackEntryPeer
{
	public static function alternativeCon ( $con )
	{
		return myDbHelper::alternativeCon ( $con );
	}

	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$con = self::alternativeCon ( $con );
		return  parent::doSelectOne( $criteria, $con);
	}

	public static function doSelect(Criteria $criteria, $con = null)
	{
		$con = self::alternativeCon ( $con );
		return  parent::doSelect( $criteria, $con);
	}

	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		$con = self::alternativeCon ( $con );
		return  parent::doSelectRS( $criteria, $con);
	}
}
