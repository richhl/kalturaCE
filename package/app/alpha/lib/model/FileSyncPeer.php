<?php

/**
 * Subclass for performing query and update operations on the 'file_sync' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FileSyncPeer extends BaseFileSyncPeer
{
	/**
	 * 
	 * @param FileSyncKey $key
	 * @param Criteria $c
	 * @return Criteria
	 */
	public static function getCriteriaForFileSyncKey ( FileSyncKey $key , Criteria $c = null )
	{
		if ( $c == null ) $c = new Criteria();
		$c->addAnd ( self::OBJECT_ID , $key->object_id );
		$c->addAnd ( self::OBJECT_TYPE , $key->object_type );
		$c->addAnd ( self::OBJECT_SUB_TYPE , $key->object_sub_type );
		$c->addAnd ( self::VERSION , $key->version );
		return $c;
	}
	
	
	/**
	 * 
	 * @param FileSyncKey $key
	 * @return FileSync
	 */
	public static function retreiveByFileSyncKey(FileSyncKey $key)
	{
		$c = self::getCriteriaForFileSyncKey($key);
		return self::doSelectOne($c);
	}
	
	/**
	 * @param FileSyncKey $key
	 * @return array
	 */
	public static function retreiveAllByFileSyncKey(FileSyncKey $key)
	{
		$c = self::getCriteriaForFileSyncKey($key);
		return self::doSelect($c);
	}

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
