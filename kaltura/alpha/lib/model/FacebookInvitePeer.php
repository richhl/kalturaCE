<?php

/**
 * Subclass for performing query and update operations on the 'facebook_invite' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FacebookInvitePeer extends BaseFacebookInvitePeer
{
	public static function setNewStatus ( $invited_puser_id , $status )
	{
		// TODO
		// this is the wrong way to do it - we need to use doUpdate
		$c = new Criteria();
		$c->add ( FacebookInvitePeer::INVITED_PUSER_ID , $invited_puser_id );
		$c->add ( FacebookInvitePeer::STATUS , FacebookInvite::FACEBOOK_STATUS_REGISTERED , Criteria::NOT_EQUAL );
		$facebook_inivite_list = FacebookInvitePeer::doSelect ( $c );
		
		if ( $facebook_inivite_list == null ) return;
		
		foreach ( $facebook_inivite_list   as $invite )
		{
			$invite->setStatus ( $status );
			$invite->save();
		}
	}
	
	public static function getInvitedIdsForPuser ( $puser_id , $status_list )
	{
		$c = new Criteria();
		$c->addSelectColumn( FacebookInvitePeer::INVITED_PUSER_ID );
		$c->addSelectColumn( FacebookInvitePeer::STATUS );
		$c->add ( FacebookInvitePeer::PUSER_ID , $puser_id );
		
		$c->add ( FacebookInvitePeer::STATUS ,  FacebookInvitePeer::STATUS . "&" . $status_list , Criteria::CUSTOM );	
		
		$rs = FacebookInvitePeer::doSelectRs ( $c );
		
		$users_status = array();
		while($rs->next())
		{
			$uid = $rs->getInt(1);
			$users_status[$uid] = $rs->getInt(2);
		}

		$rs->close();	
		
		return $users_status;
	}
  
}
