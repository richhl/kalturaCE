<?php

/**
 * Session service
 *
 * @service session
 * @package api
 * @subpackage services
 */
class SessionService extends KalturaBaseService
{
	/**
	 * Start a session with Kaltura's server.
	 * The result KS is the session key that you should pass to all services that requires a ticket.
	 * 
	 * @action start
	 * @param int $partnerId
	 * @param string $secret Remember to provide the correct secret according to the sessionType you want
	 * @param string $userId
	 * @param KalturaSessionType $type Regular session or Admin session
	 * @param int $expiry KS expiry time in seconds
	 * @param string $privileges 
	 * @return string
	 *
	 * @throws APIErrors::START_SESSION_ERROR
	 */
	function startAction($partnerId, $secret, $userId, $type = 0, $expiry = 86400 , $privileges = null )
	{
		// make sure the secret fits the one in the partner's table
		$ks = "";
		$result = kSessionUtils::startKSession ( $partnerId , $secret , $userId , $ks , $expiry , $type , "" , $privileges );

		if ( $result >= 0 )
		{
			return $ks;
		}
		else
		{
			throw new KalturaAPIException ( APIErrors::START_SESSION_ERROR ,$partnerId );
		}
	}
	
	/**
	 * Start a session for Kaltura's flash widgets
	 * 
	 * @action startWidgetSession
	 * @param string $widgetId
	 * @param int $expiry
	 * 
	 * @throws APIErrors::INVALID_WIDGET_ID
	 * @throws APIErrors::MISSING_KS
	 * @throws APIErrors::INVALID_KS
	 * @throws APIErrors::START_WIDGET_SESSION_ERROR
	 * @return string
	 */	
	function startWidgetSession ( $widgetId , $expiry = 86400 )
	{
			// make sure the secret fits the one in the partner's table
		$ks_str = "";
		$user = $this->getUser();
		
		$widget = widgetPeer::retrieveByPK( $widgetId );
		if ( !$widget )
		{
			throw new KalturaAPIException ( APIErrors::INVALID_WIDGET_ID , $widgetId );
		}

		$partner_id = $widget->getPartnerId();

		$partner = PartnerPeer::retrieveByPK( $partner_id );
		// TODO - see how to decide if the partner has a URL to redirect to


		// according to the partner's policy and the widget's policy - define the privileges of the ks
		// TODO - decide !! - for now only view - any kshow
		$privileges = "view:*";

		if ( $widget->getSecurityType() == widget::WIDGET_SECURITY_TYPE_FORCE_KS )
		{
			
			if ( ! $this->getKS() )// the one from the base class
				throw new KalturaAPIException ( APIErrors::MISSING_KS );

			$ks = $this->getKS() ;
			$widget_partner_id = $widget->getPartnerId();
			$res = kSessionUtils::validateKSession2 ( 1 ,$widget_partner_id  , $user->getId() , $ks_str , $this->ks );
			
			if ( 0 >= $res )
			{
				// chaned this to be an exception rather than an error
				throw new KalturaAPIException ( APIErrors::INVALID_KS , $ks_str , $res , ks::getErrorStr( $res ));
			}			
		}
		else
		{
			// 	the session will be for NON admins and privileges of view only
			$result = kSessionUtils::createKSessionNoValidations ( $partner_id , $puser_id , $ks_str , $expiry , false , "" , $privileges );
		}

		if ( $result >= 0 )
		{
			return $ks_str;
		}
		else
		{
			// TODO - see that there is a good error for when the invalid login count exceed s the max
			throw new  KalturaAPIException  ( APIErrors::START_WIDGET_SESSION_ERROR ,$widget_id );
		}		
	}
}