<?php
/**
 * Manage partner users on Kaltura's side
 * The userId in kaltura is the unique Id in the partner's system, and the [partnerId,Id] couple are unique key in kaltura's DB
 *
 * @service user
 * @package api
 * @subpackage services
 */
class userService extends KalturaBaseService 
{
	// use initService to add a peer to the partner filter
	/**
	 * @ignore
	 */
	public function initService ($partner_id , $puser_id , $ks_str , $service_name , $action )
	{
		parent::initService ($partner_id , $puser_id , $ks_str , $service_name , $action );
		parent::applyPartnerFilterForClass ( new kuserPeer() );
		parent::applyPartnerFilterForClass ( new PuserKuserPeer() ); 
	}

	/**
	 * Adds a user to the Kaltura DB.
	 * Input param $id is the unique identifier in the partner's system
	 *
	 * @action add
	 * @param int $id
	 * @param KalturaUser $user 
	 * @return KalturaUser
	 *
	 * @throws APIErrors::DUPLICATE_USER_BY_ID
	 */
	function addAction( $id , KalturaUser $user )
	{
		$shouldCreatePuser = FALSE;
		$shouldUpdatePuser = FALSE;

		$puserKuser = PuserKuserPeer::retrieveByPartnerAndUid( $this->getPartnerId() , null, $id );
		if ( $puserKuser )
		{
			// puser exists, checking is kuser exists
			$kuser = kuserPeer::retrieveByPK( $puserKuser->getKuserId() );
			if ( $kuser )
			{
				throw new KalturaAPIException ( APIErrors::DUPLICATE_USER_BY_ID , $id );
			}
			// puser exists, kuser not, set flag to update puser
			$shouldUpdatePuser = TRUE;
		}
		else
		{
			// no puser at all, set flag to create puser with kuser
			$shouldCreatePuser = TRUE;
		}

		$dbUser = $user->toUser();
		$dbUser->setPartnerId ( $this->getPartnerId() );
		$dbUser->save();
		if ( $shouldCreatePuser || $shouldUpdatePuser )
		{
			if ( $shouldCreatePuser )
			{
				$puserKuser = new PuserKuser;
				$puserKuser->setPartnerId( $this->getPartnerId() );
				$puserKuser->setPuserId( $id );
			}
			$puserKuser->setKuserId( $dbUser->getId() );
			$puserKuser->setPuserName ( $dbUser->getScreenName() );
			$puserKuser->save();
		}
		
		$user = new KalturaUser(); // start from blank
		$user->fromUser( $dbUser );
		
		return $user;
	}

	/**
	 * Update exisitng user
	 * 
	 * @action update
	 * @param string $id
	 * @param KalturaUser $user
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 */	
	function updateAction( $id = null , KalturaUser $user )
	{
		
		$dbKuser = KalturaUser::getKuserByPuserId( $id , $this->getPartnerId() );
	
		if ( ! $dbKuser )
			throw new KalturaAPIException ( APIErrors::INVALID_USER_ID , $id );
		
		$kuserUpdate = $user->toUser();

		$allow_empty = true ; // TODO - what is the policy  ? 
		baseObjectUtils::autoFillObjectFromObject ( $kuserUpdate , $dbKuser , $allow_empty );
		
		$dbKuser->save();
		$user->fromUser( $dbKuser );
		
		return $user;
	}

	/**
	 * Update the id of partner user
	 * Use this action when the unique Id in your system changed, and you want to update the user in kaltura's DB
	 * 
	 * @action updateid
	 * @param string $id Current Id of the user
	 * @param string $newId New Id of the user
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 * @throws APIErrors::DUPLICATE_USER_BY_ID
	 */
	function updateidAction( $id , $newId )
	{
		$puserKuser = PuserKuserPeer::retrieveByPartnerAndUid( $this->getPartnerId() , null, $id );
		
		if ( ! $puserKuser )
			throw new KalturaAPIException ( APIErrors::INVALID_USER_ID , $id );
		
		// validate that $newId is not in use with this partner
		$targetPuserKuser = PuserKuserPeer::retrieveByPartnerAndUid( $this->getPartnerId() , null, $newId );
		if ( $targetPuserKuser )
			throw new KalturaAPIException ( APIErrors::DUPLICATE_USER_BY_ID );

		$puserKuser->setPuserId( $newId );
		$puserKuser->save();

		PuserKuserPeer::removeFromCache($puserKuser);

		$kuser = $puserKuser->getKuser();	
		$user = new KalturaUser;
		$user->fromUser( $kuser );

		return $user;
	}
	
	/**
	 * Retrieve user
	 * 
	 * @action get
	 * @param string $id
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 */		
	function getAction( $id )
	{
		$dbKuser = KalturaUser::getKuserByPuserId( $id , $this->getPartnerId() );
		
		if ( ! $dbKuser )
				throw new KalturaAPIException ( APIErrors::INVALID_USER_ID , $id );
		
		$user = new KalturaUser();
		$user->fromUser( $dbKuser );
		
		return $user;
	}

	/**
	 * Delete a user
	 * 
	 * @action delete
	 * @param string $id 
	 * @return KalturaUser
	 *
	 * @throws APIErrors::INVALID_USER_ID
	 */		
	function deleteAction(  $id )
	{
		$dbKuser = KalturaUser::getKuserByPuserId( $id , $this->getPartnerId() );
		
		if ( ! $dbKuser )
			throw new KalturaAPIException ( APIErrors::INVALID_USER_ID , $id );
		
		$dbKuser->setStatus ( kuser::KUSER_STATUS_SUSPENDED );

		$dbKuser->save();
			
		$user = new KalturaUser();
		
		$user->fromUser( $dbKuser );
		// remove/change other fields
		return $user;
	}
	
	/**
	 * List partner users
	 * 
	 * @action list
	 * @param KalturaUserFilter $filter
	 * @param KalturaFilterPager $pager
	 * @return KalturaUserArray
	 */
	function listAction( KalturaUserFilter $filter = null, KalturaFilterPager $pager = null )
	{
		if (!$filter)
			$filter = new KalturaUserFilter;
		$userFilter = new kuserFilter ();
		$filter->toObject( $userFilter );
	
		$c = new Criteria();
		$userFilter->attachToCriteria( $c );
		if (!$pager)
			$pager = new KalturaFilterPager;
		$pager->attachToCriteria( $c );
		
		$list = kuserPeer::doSelect( $c );

		$newList = KalturaUserArray::fromUserArray( $list );
		
		return $newList;
	}
}