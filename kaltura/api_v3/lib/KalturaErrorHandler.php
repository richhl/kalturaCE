<?php
class KalturaErrorHandler
{
	private static $instance;
	
	private static function getInstance()
	{
		if (!self::$instance)
		{
			$class = __CLASS__;
			self::$instance = new $class();
		}
		
		return self::$instance;
	}
	
	private function KalturaErrorHandler()
	{
		
	}
	
	public static function register()
	{
		self::getInstance()->registerInternal();	
	}
	
	public static function unregister()
	{
		self::getInstance()->unregisterInternal();
	}
	
	private function registerInternal()
	{
		set_error_handler(array(&$this, "errorHandler"));
		set_exception_handler(array(&$this, "exceptionHandler"));	
	}
	
	private function unregisterInternal()
	{
		restore_error_handler();
		restore_exception_handler();		
	}
	

}
