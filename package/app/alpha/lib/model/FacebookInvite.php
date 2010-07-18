<?php

/**
 * Subclass for representing a row from the 'facebook_invite' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FacebookInvite extends BaseFacebookInvite
{
	const FACEBOOK_STATUS_QUEUED = 1;
	const FACEBOOK_STATUS_INVITED = 2;
	const FACEBOOK_STATUS_REGISTERED = 4;
	
}
