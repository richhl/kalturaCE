<?php
/**
 * Manage partner users on Kaltura's side
 * The userId in kaltura is the unique Id in the partner's system, and the [partnerId,Id] couple are unique key in kaltura's DB
 *
 * @service user
 * @package api
 * @subpackage services
 */
class UserService extends KalturaBaseService 
{
	// use initService to add a peer to the partner filter
	/**
	 * @ignore
	 */
	public function initService ($partner_id , $puser_id , $ks_str , $service_name , $action )
	{
		parent::initService ($partner_id , $puser_id , $ks_str , $service_name , $action );
		parent::applyPartnerFilterForClass ( new kuserPeer() );
	}

	/**
	 * Adds a user to the Kaltura DB.
	 * Input param $id is the unique identifier in the partner's system
	 *
	 * @action add
	 * @param KalturaUser $user 
	 * @return KalturaUser
	 *
	 * @throws APIErrors::DUPLICATE_USER_BY_ID
	 */
	function addAction(KalturaUser $user)
	{
		$user->validatePropertyNotNull("id");
		
		$dbUser = kuserPeer::getKuserByPartnerAndUid($this->getPartnerId(), $user->id);
		
		if ($dbUser)
			throw new KalturaAPIException(KalturaErrors::DUPLICATE_USER_BY_ID, $user->id);
			
		$dbUser = $user->toUser();
		if($dbUser->getScreenName() === null)
			$dbUser->setScreenName($user->id);
			
		if($dbUser->getFullName() === null)
			$dbUser->getFullName($user->id);

		$dbUser->setPartnerId($this->getPartnerId());
		$dbUser->save();
		
		$user = new KalturaUser(); // start from blank
		$user->fromUser($dbUser);
		
		return $user;
	}

	/**
	 * Update exisitng user, it is possible to update the user id too
	 * 
	 * @action update
	 * @param string $userId
	 * @param KalturaUser $user
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 */	
	function updateAction($userId, KalturaUser $user)
	{
		$dbUser = kuserPeer::getKuserByPartnerAndUid($this->getPartnerId(), $userId);
	
		if (!$dbUser)
			throw new KalturaAPIException(APIErrors::INVALID_USER_ID, $userId);
		
		$dbUser = $user->toUpdatableObject($dbUser);
		$dbUser->save();
	
		$user->fromUser($dbUser);
		
		return $user;
	}

	/**
	 * Retrieve user
	 * 
	 * @action get
	 * @param string $userId
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 */		
	function getAction($userId)
	{
		$dbUser = kuserPeer::getKuserByPartnerAndUid($this->getPartnerId(), $userId);
	
		if (!$dbUser)
			throw new KalturaAPIException(APIErrors::INVALID_USER_ID, $userId);

		$user = new KalturaUser();
		$user->fromUser($dbUser);
		
		return $user;
	}

	/**
	 * Mark the user as deleted
	 * 
	 * @action delete
	 * @param string $userId 
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 */		
	function deleteAction($userId)
	{
		$dbUser = kuserPeer::getKuserByPartnerAndUid($this->getPartnerId(), $userId);
	
		if (!$dbUser)
			throw new KalturaAPIException(APIErrors::INVALID_USER_ID, $userId);
		
		$dbUser->setStatus(KalturaUserStatus::DELETED);
		$dbUser->save();
			
		$user = new KalturaUser();
		$user->fromUser($dbUser);
		
		return $user;
	}
	
	/**
	 * List users (When not set in the filter, blocked and deleted users will be returned too)
	 * 
	 * @action list
	 * @param KalturaUserFilter $filter
	 * @param KalturaFilterPager $pager
	 * @return KalturaUserListResponse
	 */
	function listAction(KalturaUserFilter $filter = null, KalturaFilterPager $pager = null)
	{
		if (!$filter)
			$filter = new KalturaUserFilter();
			
		if (!$pager)
			$pager = new KalturaFilterPager();	

		$userFilter = new kuserFilter();
		$filter->toObject($userFilter);
	
		$c = new Criteria();
		$userFilter->attachToCriteria($c);
		$pager->attachToCriteria($c);
		
		$list = kuserPeer::doSelect($c);
		$totalCount = kuserPeer::doCount($c);

		$newList = KalturaUserArray::fromUserArray($list);
		$response = new KalturaUserListResponse();
		$response->objects = $newList;
		$response->totalCount = $totalCount;
		
		return $response;
	}
}