<?php
class kPermissionException extends kCoreException
{
	const PERMISSION_ITEM_NOT_FOUND = 'PERMISSION_ITEM_NOT_FOUND';
	
	const USER_ROLE_NOT_FOUND = 'USER_ROLE_NOT_FOUND';
	
	const ACCOUNT_OWNER_NEEDS_PARTNER_ADMIN_ROLE = 'ACCOUNT_OWNER_NEEDS_PARTNER_ADMIN_ROLE';
	
	const PERMISSION_NOT_FOUND = 'PERMISSION_NOT_FOUND';
	
	const PERMISSION_ALREADY_CONTAINS_ITEM = 'PERMISSION_ALREADY_CONTAINS_ITEM';
	
	const ONLY_ONE_ROLE_PER_USER_ALLOWED = 'ONLY_ONE_ROLE_PER_USER_ALLOWED';
	
	const ROLE_ID_MISSING = 'ROLE_ID_MISSING';
	
	const PERMISSION_ALREADY_EXISTS = 'PERMISSION_ALREADY_EXISTS';
	
	const ROLE_NOT_FOUND = 'ROLE_NOT_FOUND';	
	
	const ROLE_IS_BEING_USED = 'ROLE_IS_BEING_USED';
}