<?php

/**
 * Subclass for performing query and update operations on the 'conversion_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ConversionProfilePeer extends BaseConversionProfilePeer
{
	public static function retrieveByProfileType ( $partner_id , $profile_type )
	{
		$c = new Criteria();
		$c->addAnd ( self::PROFILE_TYPE, $profile_type);
		if ( $partner_id )
		{
			$crit = $c->getNewCriterion( self::PARTNER_ID , ConversionProfile::GLOBAL_PARTNER_PROFILE , Criteria::EQUAL );
			$crit->addOr ( $c->getNewCriterion ( self::PARTNER_ID , $partner_id , Criteria::EQUAL ) );
			$c->add ( $crit );
		}
		else
		{
			$c->add ( self::PARTNER_ID , $partner_id , Criteria::EQUAL  );
		}

		$conv_list =  self::doSelect( $c );
		if ( $conv_list == null ) return null;
		foreach ( $conv_list as $conv )
		{
			// select the first conversion profile that matchs the partner
			 if ( $conv->getPartnerId() == $partner_id  ) return $conv;
		}
		// if no conv_prof found for partner - use the global ones
		return $conv_list[0]; // first profile returned 
	}
	

	/**
	 * fetch the best conversion profile for the partner - depending on the data in the DB only (no hint from the user)
	 */
	public static function retrieveByPartner ( $partner_id  )
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn ( self::UPDATED_AT ); // make sure the first profile is the most updated
//		$c->addAnd ( self::PROFILE_TYPE, $profile_type);
		if ( $partner_id )
		{
			$crit = $c->getNewCriterion( self::PARTNER_ID , ConversionProfile::GLOBAL_PARTNER_PROFILE , Criteria::EQUAL );
			$crit->addOr ( $c->getNewCriterion ( self::PARTNER_ID , $partner_id , Criteria::EQUAL ) );
			$c->add ( $crit );
		}
		else
		{
			$c->add ( self::PARTNER_ID , $partner_id , Criteria::EQUAL  );
		}

		$conv_list =  self::doSelect( $c );
		if ( $conv_list == null ) return null;
		foreach ( $conv_list as $conv )
		{
			// select the first conversion profile that matchs the partner
			 if ( $conv->getPartnerId() == $partner_id  ) return $conv;
		}
		// if no conv_prof found for partner - use the global ones
		return $conv_list[0]; // first profile returned 
	}
		
	
	public static function retrieveSimilar ( $partner_id  , conversionProfile $conv_profile )
	{
		// don't use tht name when matching 
		$c = new Criteria();
		$c->add ( self::PARTNER_ID , $partner_id );
		$c->add ( self::PROFILE_TYPE , $conv_profile->getProfileType() );
		$c->add ( self::PROFILE_TYPE_SUFFIX , $conv_profile->getProfileTypeSuffix());
		$c->add ( self::COMMERCIAL_TRANSCODER , $conv_profile->getCommercialTranscoder() );
		$c->add ( self::WIDTH , $conv_profile->getWidth() );
		$c->add ( self::HEIGHT , $conv_profile->getHeight() );
		$c->add ( self::ASPECT_RATIO, $conv_profile->getAspectRatio());
		$c->add ( self::BYPASS_FLV, $conv_profile->getBypassFlv());
		
		$existing_conv_profile = self::doSelectOne ( $c );
		
		if ( $existing_conv_profile && ! $existing_conv_profile->getEnabled() )
		{
			// if it's off - rather than creating a new one turning it on 
			$existing_conv_profile->setEnabled ( 1 );
			$existing_conv_profile->save();
		}
		
		return $existing_conv_profile;
		
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
