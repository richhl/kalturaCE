<?php

/**
 * Notification Service
 *
 * @service notification
 * @package api
 * @subpackage services
 */
class NotificationService extends KalturaBaseService 
{
	/**
	 * Return the entries for a specific entry id and type
	 * 
	 * @action getClientNotification
	 * @param string $entryId
	 * @param KalturaNotificationType $type
	 * @return KalturaClientNotification
	 */
	function getClientNotificationAction($entryId, $type)
	{
	    
		$notifications = notificationPeer::retrieveByEntryIdAndType($entryId, $type);
		
		// FIXME: throw error if not found		
		if (count($notifications) == 0)
		{
            throw new KalturaAPIException(KalturaErrors::NOTIFICATION_FOR_ENTRY_NOT_FOUND, $entryId);
		}
		
	    $notification = $notifications[0];
		
		$partnerId = $this->getPartnerId();
		$partner = PartnerPeer::retrieveByPK($partnerId);
		list($url, $signatureKey) = myNotificationMgr::getPartnerNotificationInfo ($partner );
		
		list($params, $rawSignature) = myNotificationMgr::prepareNotificationData($url, $signatureKey, $notification, null);
		$serializedParams = http_build_query( $params , "" , "&" );
		
		$result = new KalturaClientNotification();
		$result->url = $url;
		$result->data = $serializedParams;
		
		return $result;
	}
}