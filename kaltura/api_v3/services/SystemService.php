<?php

/**
 * System Service
 *
 * @service system
 * @package api
 * @subpackage services
 */
class SystemService extends KalturaBaseService 
{
	/**
	 *
	 * 
	 * @action ping
	 * @return bool Always true if service is working
	 */
	function pingAction()
	{
		return true;
	}
}