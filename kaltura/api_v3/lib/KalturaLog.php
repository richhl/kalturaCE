<?php
class KalturaLog
{
	private static $_logger;
	private static $_initialized = false;
	
	private static $singleton_kaltura_log = null;
	
    const EMERG   = Zend_Log::EMERG;
    const ALERT   = Zend_Log::ALERT;
    const CRIT    = Zend_Log::CRIT;
    const ERR     = Zend_Log::ERR;
    const WARN    = Zend_Log::WARN;
    const NOTICE  = Zend_Log::NOTICE;
    const INFO    = Zend_Log::INFO;
    const DEBUG   = Zend_Log::DEBUG;
	
	public static function getInstance ()
	{
		 if ( !self::$singleton_kaltura_log ) self::$singleton_kaltura_log =  new KalturaLog();
		 return self::$singleton_kaltura_log;
	}
	
	// FIXME - Move logger configuration to logger.ini configuration file!
	private static function initLog()
	{
		if (self::$_initialized)
			return;
			
		//$formatter = new Zend_Log_Formatter_Simple(Zend_Log_Formatter_Simple::DEFAULT_FORMAT . PHP_EOL);
		//$formatter = new Zend_Log_Formatter_Simple('%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL);
		$formatter = new Zend_Log_Formatter_Simple('%timestamp% %uniqueId% %priorityName%: %message%' . PHP_EOL);
		
		$writer = new Zend_Log_Writer_Stream(KALTURA_ROOT_PATH.DIRECTORY_SEPARATOR."../../logs/kaltura_api_v3.log");
		$writer->setFormatter($formatter);
		
		$logger = new Zend_Log();
		$logger->addWriter($writer);
		
		$logger->setEventItem('timestamp', new LogTime() );
		$logger->setEventItem('uniqueId', rand() );
		
		self::$_logger = $logger;
		self::$_initialized = true;
//		self::log("Logger initialized", Zend_Log::INFO); 
	}
	
	static function log($message, $priority = self::NOTICE)
	{
		self::initLog();
		self::$_logger->log($message, $priority);
	}
	
	static function alert($message )
	{
		self::initLog();
		self::$_logger->log($message, self::ALERT);
	}

	static function crit($message )
	{
		self::initLog();
		self::$_logger->log($message, self::CRIT);
	}

	static function err($message )
	{
		self::initLog();
		self::$_logger->log($message, self::ERR);
	}	

	static function warning($message )
	{
		self::initLog();
		self::$_logger->log($message, self::WARN);
	}

	static function notice($message )
	{
		self::initLog();
		self::$_logger->log($message, self::NOTICE);
	}	

	static function info($message )
	{
		self::initLog();
		self::$_logger->log($message, self::INFO);
	}

	static function debug($message )
	{
		self::initLog();
		self::$_logger->log($message, self::DEBUG);
	}	
}

class LogTime 
{
	public function __toString()
	{
		return "" . microtime(true);
	}
}
?>