<?php

require_once("../bootstrap.php");

class IndexContext
{
	private $logLine = "";
	private $start = null;
	private $end = null;
	private $params = array();
	
	public function IndexContext()
	{
		KalturaLog::info(">------------------------------------- api_v3 -------------------------------------");
		
		ob_start();
		error_reporting(E_STRICT & E_ALL);
		error_reporting(E_STRICT | E_ALL);
		
		set_error_handler(array(&$this, "errorHandler"));
		set_exception_handler(array(&$this, "exceptionHandler"));
		
		$service = $_GET["service"];
		$action = $_GET["action"];
		$this->params = array_merge($_GET, $_POST);
		
		$p = isset ($this->params["p"]) ? $this->params["p"] : null;
		if ( ! $p ) $p = isset ($this->params["partnerId"] ) ? $this->params["partnerId"] : null;
		$this->logLine = "[$service][$action][$p]";
		
		$this->logStart();
		
		$dispatcher = KalturaDispatcher::getInstance();
		$result = $dispatcher->dispatch($service, $action, $this->params);
		
		if (isset($_REQUEST["ignoreNull"]))
			$ignoreNull = ($_REQUEST["ignoreNull"] === "1") ? true : false;
		else
			$ignoreNull = false;

		ob_end_clean();
		
		$this->serializeResponse($result, $ignoreNull);
		
		$this->logEnd();
		
	}
	
	public function errorHandler($errNo, $errStr, $errFile, $errLine)
	{
		$errorFormat = "%s line %d - %s";
		switch ($errNo)
		{
			case E_NOTICE:
			case E_STRICT:
			case E_USER_NOTICE:
				KalturaLog::log(sprintf($errorFormat, $errFile, $errLine, $errStr), KalturaLog::NOTICE);
				break;
			case E_USER_WARNING:
			case E_WARNING:
				KalturaLog::log(sprintf($errorFormat, $errFile, $errLine, $errStr), KalturaLog::WARN);
				break;
			default: // throw it as an exception
				throw new ErrorException($errStr, 0, $errNo, $errFile, $errLine); 
		}
	}
	
	public function exceptionHandler($ex)
	{
		if ($ex instanceof KalturaAPIException)
		{
		    KalturaLog::err($ex);
			$object = $ex;
			
		}
		else if ($ex instanceof APIException)  // don't let unwanted exception to be serialized
		{
		    $args = $ex->extra_data;
	        $reflectionException = new ReflectionClass("KalturaAPIException");
	        $ex = $reflectionException->newInstanceArgs($args);
		    KalturaLog::err($ex);
			$object = $ex;
		}
		else
		{ 
		    KalturaLog::crit($ex);
			$object = new KalturaAPIException(KalturaErrors::INTERNAL_SERVERL_ERROR);
		}
		
		$this->logEnd();
		
		$this->serializeResponse($object);

		die;
	}
	
	private function logStart()
	{
		$this->start = microtime(true);
		KalturaLog::notice("API-start ".$this->logLine);
	}
	
	private function logEnd()
	{
		$this->end = microtime(true);
		KalturaLog::notice("API-end ".$this->logLine." [".($this->end - $this->start)."]");
		KalturaLog::info("<------------------------------------- api_v3 -------------------------------------");
	}
	
	function serializeResponse($object, $ignoreNull = false)
	{
		$format = isset($this->params["format"]) ? $this->params["format"] : KalturaResponseType::RESPONSE_TYPE_XML;
		
		switch($format)
		{
			case KalturaResponseType::RESPONSE_TYPE_XML:
				header("Content-Type: text/xml");
				$serializer = new KalturaXmlSerializer($ignoreNull);
				$serializer->serialize($object);
				
				echo '<?xml version="1.0" encoding="utf-8"?>';
				echo "<xml>";
					echo "<result>";
						echo $serializer->getSerializedData();
					echo "</result>";
					echo "<executionTime>" . ($this->end - $this->start) ."</executionTime>";
				echo "</xml>";
				break;
			case KalturaResponseType::RESPONSE_TYPE_PHP:
				$serializer = new KalturaPhpSerializer($ignoreNull);
				$serializer->serialize($object);
				echo $serializer->getSerializedData();
				break;
		}
		
	}
}

new IndexContext;