<?php

/**
 * Subclass for performing query and update operations on the 'puser_kuser' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PuserKuserPeer extends BasePuserKuserPeer
{
	public static function retrieveByPartnerAndUid ( $partner_id , $subp_id, $puser_id , $join_kuser = false )
	{
		$c = new Criteria();
		myCriteria::addComment( $c , "PuserKuserPeer::retrieveByPartnerAndUid" );
		$c->add ( self::PARTNER_ID , $partner_id );
		if ($subp_id)
			$c->add ( self::SUBP_ID , $subp_id );
		$c->add ( self::PUSER_ID , $puser_id );
		if ( $join_kuser )
			$puser_kusers = self::doSelectJoinkuser( $c );
		else
			$puser_kusers = self::doSelect( $c );

		if ( count ( $puser_kusers ) > 0 )
		{
			$puser_kuser = $puser_kusers[0];
		}
		else
		{
			$puser_kuser = null;
		}
		
		return $puser_kuser;
	}
	
	/**
		Returns newly created puser - after creating it's corresponding kuser.
		If the puser_kuser already exists && $verify_not_exists==true , don't create a new one and return the existing one
	*/
	public static function createPuserKuser ( $partner_id , $subp_id, $puser_id , $kuser_name , $puser_name, $create_kuser = false, $kuser = null)
	{		
		$puser_kuser = self::retrieveByPartnerAndUid ( $partner_id , $subp_id, $puser_id , true );
		
		if ( $puser_kuser )
		{
			if ( !$create_kuser )
			{
				// if the puser_kuser already exists - don't re-create it
				$puser_kuser->exists = true;
				return $puser_kuser;
			}
			else
			{
				// puser_kuser exists but it's OK
				// this might be the case where we don't mind creating a new one each time
			}
		}
		else
		{
			$puser_kuser = new PuserKuser();
		}
		
		$c = new Criteria();
		$c->add ( self::PARTNER_ID , $partner_id );
		$c->add ( self::PUSER_ID , $puser_id );
		$partner_puser_kuser = self::doSelectOne( $c );
		
		if ($kuser !== null)
		{
			$kuser_id = $kuser->getId();
		}
		else
		{
			if ($partner_puser_kuser)
			{
				$kuser_id = $partner_puser_kuser->getKuserId();
				$kuser = kuserPeer::retrieveByPK($kuser_id);
			}
			else
			{
				// create kuser for this puser
				$kuser = new kuser ();
				$kuser->setScreenName( $kuser_name );
				$kuser->setFullName( $kuser_name );
				$kuser->setPartnerId( $partner_id );
				// set puserId for forward compatibility with PS3
				$kuser->setPuserId( $puser_id );
				$kuser->setStatus( kuser::KUSER_STATUS_ACTIVE ); // so he won't appear in the search
				$kuser->save();
				$kuser_id = $kuser->getId();
			}
		}
		
		$puser_kuser->setPartnerId( $partner_id );
		$puser_kuser->setSubpId( $subp_id );
		$puser_kuser->setPuserId( $puser_id );
		$puser_kuser->setKuserId( $kuser_id );
		$puser_kuser->setPuserName($puser_name );
		$puser_kuser->save();
		$puser_kuser->setkuser( $kuser );
		
		return $puser_kuser;
	}
	
	// depending on return_type :
	// 0 - return puser_kuser
	// 1 - return puser_id 
	public static function getByKuserId ( $kuser_id , $return_type = 0 )
	{
		$c = new Criteria();
		$c->add ( self::KUSER_ID , $kuser_id );
		$puser_kuser = self::doSelectOne( $c );
		if ( $return_type == 0 )		return  $puser_kuser;
		if ( $return_type == 1 )
		{
			if ( $puser_kuser )
			{
				return $puser_kuser->getPuserId();		
			}
			return null;
		}
	}
	
	public static  function removeFromCache ( $object )
	{
		$cache = new myObjectCache ( );
		$key = $object->getPartnerId() ."|" . $object->getKuserId();
		$puser_id = $cache->remove ( "puser_kuser_id" , $key );
	}
	
	public static  function getPuserIdFromKuserId ( $partner_id , $kuser_id )
	{
		$cache = new myObjectCache ( );
		$key = $partner_id ."|" . $kuser_id;
		$puser_id = $cache->get ( "puser_kuser_id" , $key );

		if ( $puser_id == null )
		{
			$c = new Criteria();
			$c->add ( self::PARTNER_ID , $partner_id );
			$c->add ( self::KUSER_ID , $kuser_id );
			$puser_kusers = self::doSelect( $c );
	
			if ( count ( $puser_kusers ) > 0 )
			{
				$puser_kuser = $puser_kusers[0];
				$puser_id = $puser_kuser->getPuserId();
			}
			else
			{
				$puser_kuser = null;
				$puser_id = "null"; // set the string null so this will be set in the cache
			}

			$cache->putValue ( "puser_kuser_id" , $key , null , $puser_id );
		}
		
		if ( $puser_id == "null" ) return null; // return the null object not the "null" string
		return $puser_id;
	}
	
	public static  function getPuserIdFromKuserIds ( $partner_id , array $kuser_ids )
	{
		if( $kuser_ids == null || count($kuser_ids))
		{
			return array();
		}
		$c = new Criteria();
		$c->add ( self::PARTNER_ID , $partner_id );
		$c->add ( self::KUSER_ID , $kuser_ids , Criteria::IN );
		$puser_kusers = self::doSelect( $c );
		return $puser_kusers;
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
