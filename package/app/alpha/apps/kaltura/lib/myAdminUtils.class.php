<?php

class AdminSecurity
{
	//const GROUP_ALL = 0;
	const GROUP_ALL = "All";
	
	
	const ADMIN_PERMISSION_CREATE_APP = "ALL";
	/*const ADMIN_PERMISSION_CREATE_APP = "CreateApp";
	const ADMIN_PERMISSION_CREATE_APP = "CreateApp";
	const ADMIN_PERMISSION_CREATE_APP = "CreateApp";
	const ADMIN_PERMISSION_CREATE_APP = "CreateApp";
	*/
	
	public function buildPermissionString($mode)
	{
		$res = "";
		switch ($mode) {
			
		}
		
		return $res;
	}
	
	// $requiredPermission - is an array of permissions, if any of those exists for the user, action is approved
	public function validatePermissionForUser($kuserId, $requiredPermission)
	{
		//TODO: check in the DB if the user has the right permission in his perms string
		return true;
	}
	
	// the code ahead is not ready, and might be deleted/changed
	/////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////	
	/////////////////////////////////////////////////////////////////////////////////
	const CMS_VIEW_LEVEL_PROVIDER_ADMIN = 1;	// can create users, admins, and view data for all provider`s apps
	const CMS_VIEW_LEVEL_APP_ADMIN = 2;		// An application administrator, can add app monitors
											// view grapsh, etc. only for current app
	const CMS_VIEW_LEVEL_APP_MONITOR = 3; 	// can only view the data
	
	const PARTNER_ID_KALTURA = 0; // reserved id for kaltura
	const CMS_USER_TOP_MANGMER = 0;	// this is the only user who can certain pages, such as
									// statistics for providers, etc.
	
	public function AdminSecurity($user)
	{
		if (!$user) {
			throw new Exception("CMS: invalid user id in select"); 
		}		
		$this->user = $user;
		/*
		// Set user menu options by level, user id
		$this->userLevel = $user->getLevel();
		
		// only users who are of level CMS_VIEW_LEVEL_PROVIDER_ADMIN
		// with partner KALTURA_PROVIDER_ID
		// are of this level
		$this->isTopLevelAdminstrator = false;
		if (($user->getLevel() >= self::CMS_VIEW_LEVEL_PROVIDER_ADMIN) &&
			($user->getPartnerId() >= self::PARTNER_ID_KALTURA)) {
			$this->isTopLevelAdminstrator = true;
		}
		*/
	}

	const CMS_MENU_REPORT				= 200;
	const CMS_MENU_REPORT_LAST_30		= 201;
	const CMS_MENU_REPORT_GRAPHS		= 202;
	const CMS_MENU_REPORT_WIDGETS		= 203;
	
	const CMS_MENU_USERS				= 300;
	const CMS_MENU_USERS_USERS_LIST 	= 301;
	const CMS_MENU_USERS_ADD_USERS		= 302;
	const CMS_MENU_USERS_USERS_REPORT	= 303;

	const CMS_MENU_ACCOUNT				= 400;
	
	const CMS_MENU_APPLICATION			= 500;
	const CMS_MENU_APPLICATION_NEW_APP	= 501;
	const CMS_MENU_APPLICATION_SWITCH	= 502;

	public function checkCredentials($menu)
	{
		// this user can view/alter everything
		//TODO: restore code if ($this->isTopLevelAdminstrator) return true;
		
		switch ($menu) {
			case AdminSecurity::CMS_MENU_REPORT:
			case AdminSecurity::CMS_MENU_REPORT_LAST_30:
			case AdminSecurity::CMS_MENU_REPORT_GRAPHS:
			case AdminSecurity::CMS_MENU_REPORT_WIDGETS:
				if ($this->userLevel <= AdminSecurity::CMS_VIEW_LEVEL_APP_MONITOR) {
					return true;
				}
				
			case AdminSecurity::CMS_MENU_USERS:
			case AdminSecurity::CMS_MENU_USERS_USERS_LIST:
			case AdminSecurity::CMS_MENU_USERS_USERS_REPORT:
			case AdminSecurity::CMS_MENU_USERS_ADD_USERS:
				if ($this->userLevel <= AdminSecurity::CMS_VIEW_LEVEL_APP_ADMIN) {
					return true;
				}
			
			default:
				return false;
		}
	}
}
?>