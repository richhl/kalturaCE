<?php
/**
 * adminuser service
 *
 * @service adminuser
 * @package api
 * @subpackage services
 */
class adminuserService extends KalturaBaseService 
{
	// use initService to add a peer to the partner filter
	/**
	 * @ignore
	 */
	public function initService ($partner_id , $puser_id , $ks_str , $service_name , $action )
	{
		parent::initService ($partner_id , $puser_id , $ks_str , $service_name , $action );
	}

	/**
	 * Update AdminUser password and email
	 * 
	 * @action updatepassword
	 * @param string $email
	 * @param string $password
	 * @param string $newEmail Optional, provide only when you want to update the email
	 * @param string $newPassword
	 * @return KalturaAdminUser
	 *
	 * @throws APIErrors::INVALID_FIELD_VALUE
	 * @throws APIErrors::ADMIN_KUSER_WRONG_OLD_PASSWORD
	 */
	function updatePasswordAction( $email , $password , $newEmail = "" , $newPassword = "" )
	{
		if ($newEmail != "")
		{
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $newEmail))
				throw new KalturaAPIException ( APIErrors::INVALID_FIELD_VALUE, "newEmail" );
		}
		
		$adminKuser = new adminKuserPeer(); // TODO - why not static ?
		list( $new_password , $new_email ) = $adminKuser->resetUserPassword ( $email , $newPassword , $password , $newEmail );
		
		if ( ! $new_password )
			throw new KalturaAPIException ( APIErrors::ADMIN_KUSER_WRONG_OLD_PASSWORD, "wrong password" );
		
		$adminUser = new KalturaAdminUser;
		$adminUser->email = ( $new_email )? $new_email: $email;
		$adminUser->password = $new_password;
		
		return $adminUser;
	}

	/**
	 * Reset AdminUser password
	 * 
	 * @action resetpassword
	 * @param string $email
	 * @return string
	 *
	 * @throws APIErrors::ADMIN_KUSER_NOT_FOUND
	 */	
	function resetPasswordAction( $email )
	{
		$adminKuser = new adminKuserPeer(); // TODO - why not static ?
		$newPassword = $adminKuser->resetUserPassword ( $email  );
		
		if ( ! $newPassword )
			throw new KalturaAPIException ( APIErrors::ADMIN_KUSER_NOT_FOUND, "user not found" );
		
		return "email sent to the address specified";
	}

	/**
	 * Login to KMC application
	 * 
	 * @action login
	 * @param string $email
	 * @param string $password
	 * @return KalturaAdminLoginResponse
	 *
	 * @throws APIErrors::ADMIN_KUSER_NOT_FOUND
	 * @throws APIErrors::UNKNOWN_PARTNER_ID
	 */		
	function loginAction( $email , $password )
	{
		$response = new KalturaAdminLoginResponse;
		
		$adminKuser = adminKuserPeer::getAdminKuserByEmail ( $email , true );
		if ( count ( $adminKuser ) < 1 )
			throw new KalturaAPIException ( APIErrors::ADMIN_KUSER_NOT_FOUND );
		
		if ( ! $adminKuser->isPasswordValid ( $password ) )
			throw new KalturaAPIException ( APIErrors::ADMIN_KUSER_NOT_FOUND );
		
		$partner = PartnerPeer::retrieveByPK( $adminKuser->getPartnerId() );
		
		if ( ! $partner )
			throw new KalturaAPIException ( APIErrors::UNKNOWN_PARTNER_ID );
		
		$admin_puser_id = "__ADMIN__" . $adminKuser->getId(); // the prefix __ADMIN__ and the id in the admin_kuser table
		
		// get the puser_kuser for this admin if exists, if not - creae it and return it - create a kuser too
		$puser_kuser = PuserKuserPeer::createPuserKuser ( $partner->getId() , $partner->getSubpId() , $admin_puser_id , $adminKuser->getScreenName() , $adminKuser->getScreenName(), true );
		

		$ks = null;
		// create a ks for this admin_kuser as if entered the admin_secret using the API
		kSessionUtils::createKSessionNoValidations ( $partner->getId() ,  $puser_kuser->getPuserId() , $ks , 86400 , 2 , "" , "*" );
		
		$response->fromObjects( $adminKuser , $ks , $puser_kuser , $partner );
		
		return $response;
	}

}