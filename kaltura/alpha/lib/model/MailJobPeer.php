<?php

/**
 * Subclass for performing query and update operations on the 'mail_job' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MailJobPeer extends BaseMailJobPeer
{
	const MAIL_STATUS_PENDING = 1;
	const MAIL_STATUS_SENT = 2;
	const MAIL_STATUS_ERROR = 3;
	
	const MAIL_PRIORITY_REALTIME = 1;
	const MAIL_PRIORITY_HIGH = 2;
	const MAIL_PRIORITY_NORMAL = 2;
	const MAIL_PRIORITY_LOW = 3;
	
}
