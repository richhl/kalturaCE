<?php
/**
 * Will help retrieve a ConversionProfile for an entry or a partner
 *  
 */
class myConversionProfileUtils
{
	// TODO - order please !! 	
	// what is the $conversion_profile_quality - id or type ??
	// for now it can be both
	public static function getConversionProfile ( $partner_id , $conversion_profile_quality )
	{
		if ( $conversion_profile_quality == ConversionProfile::CONVERSION_PROFILE_UNKNOWN ||
			 $conversion_profile_quality == null )
		{
			// in this case there is no explicit profile_id or profile_type - we need to select the best one from the partner
			return ConversionProfilePeer::retrieveByPartner ($partner_id  );
		}
		elseif ( is_numeric( $conversion_profile_quality ) )
		{
			return self::getConversionProfileById ( $partner_id , $conversion_profile_quality  );
		}
		else
		{
			return self::getConversionProfileByType ($partner_id , $conversion_profile_quality  );
		}		
 	}
	
	
	// return the conversion profile either if it belongs to  GLOBAL_PARTNER_PROFILE or to the curent partner_id
	public static function getConversionProfileByType ( $partner_id , $conversion_profile_type )
	{
		if ( $conversion_profile_type === null ) return null;
		
		return ConversionProfilePeer::retrieveByProfileType( $partner_id , $conversion_profile_type );
	}

	// return the conversion profile either if it belongs to  GLOBAL_PARTNER_PROFILE or to the curent partner_id
	public static function getConversionProfileById ( $partner_id , $conversion_profile_id )
	{
		if ( $conversion_profile_id === null ) return null;
		
		$conv_prof = ConversionProfilePeer::retrieveByPK( $conversion_profile_id );
		if ( $conv_prof )
		{
			if ( $conv_prof->getPartnerId() == $partner_id || $conv_prof->getPartnerId() == ConversionProfile::GLOBAL_PARTNER_PROFILE )
				return $conv_prof;
		}
		return null;
	}
	
	// TODO - attempt to create profile from $partner_convrsion_string and $partner_flv_conversion_string ??
	public static function getConversionProfileForPartner ( $partner_id , $partner_convrsion_string = null ,  $partner_flv_conversion_string = mull )
	{
		$conv_prof = ConversionProfilePeer::retrieveByPK( $conversion_profile_id );
	}
}

?>