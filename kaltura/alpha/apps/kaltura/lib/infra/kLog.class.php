<?php
class kLog
{
	private static $s_context;
	
	private static $logger = null;
	
	public static function setContext ( $prefix )
	{
		self::$s_context = $prefix;	
	}
	
	// TODO - allow mor args - add to string at the end
	public static function log ( $str )
	{
		if ( self::$s_context )
			self::getLogger()->log ( self::$s_context . " " . $str );
		else
			self::getLogger()->log ( $str );
	}
	
	public static function setLogger ( $logger )
	{
		self::$logger = $logger;	
	}
	
	private static function getLogger ()
	{
		if ( ! self::$logger )
		{
			self::$logger = sfLogger::getInstance()	;	
		}
		return self::$logger;
	}
}
?>