<?php

function checkCache()
{
	$uri = $_SERVER["REQUEST_URI"];

	if (strpos($uri, "/kwidget") !== false)
	{
		if (!function_exists('memcache_connect')) return;
						
		$cache = new Memcache;
		$res = $cache->connect("localhost", "11211");
		if ( $res )
		{
			$cachedResponse = $cache->get("kwidget$uri");
			if ($cachedResponse)
			{
				// set our uv cookie
				$uv_cookie = @$_COOKIE['uv'];
				if (strlen($uv_cookie) != 35)
				{
					$uv_cookie = "uv_".md5(uniqid(rand(), true));
				}
				setrawcookie( 'uv', $uv_cookie, time() + 3600 * 24 * 365, '/' );
		
				header("X-Kaltura:cached-dispatcher");
				header("Expires: Thu, 19 Nov 2000 08:52:00 GMT");
				header( "Cache-Control" , "no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
				header( "Pragma" , "no-cache" );
				
				$referer = @$_SERVER['HTTP_REFERER'];
				
				$externalInterfaceDisabled = (
					strstr($referer, "bebo.com") === false &&
					strstr($referer, "myspace.com") === false &&
					strstr($referer, "current.com") === false &&
					strstr($referer, "myyearbook.com") === false &&
					strstr($referer, "friendster.com") === false) ? "" : "&externalInterfaceDisabled=1";
					
				
				header("Location:$cachedResponse".$externalInterfaceDisabled."&referer=".urlencode($referer));
				die;
			}
		}
		
	}
}

checkCache();

define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'kaltura');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       false);

define('MODULES' , SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

sfContext::getInstance()->getController()->dispatch();
