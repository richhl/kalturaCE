<?php
class KalturaFrontController 
{
    private static $instance;
	private $start = null;
	private $end = null;
	private $params = array();
	private $service = "";
	private $action = "";
	private $disptacher = null;
	
    private function KalturaFrontController() 
    {
        $this->dispatcher = KalturaDispatcher::getInstance();
        
        $this->service = @$_GET["service"];
		$this->action = @$_GET["action"];
		$this->params = array_merge($_GET, $_POST);
		
		$p = isset ($this->params["p"]) ? $this->params["p"] : null;
		if ( ! $p ) $p = isset ($this->params["partnerId"] ) ? $this->params["partnerId"] : null;
    }
    
	/**
	 * Return a singleton KalturaFrontController instance
	 *
	 * @return KalturaFrontController
	 */
	public static function getInstance()
	{
		if (!self::$instance)
		{
			self::$instance = new self();
		}
		    
		return self::$instance;
	}

	public function run()
	{
	    $this->start = microtime(true);
	    
		ob_start();
		error_reporting(E_STRICT & E_ALL);
		error_reporting(E_STRICT | E_ALL);
		
		set_error_handler(array(&$this, "errorHandler"));
		set_exception_handler(array(&$this, "exceptionHandler"));
		
		if ($this->service == "multirequest")
		{
		    set_exception_handler(null);
		    $result = $this->handleMultiRequest();
		}
		else
		{
		    $result = $this->dispatcher->dispatch($this->service, $this->action, $this->params);
		}
		
		if (isset($_REQUEST["ignoreNull"]))
			$ignoreNull = ($_REQUEST["ignoreNull"] === "1") ? true : false;
		else
			$ignoreNull = false;

		ob_end_clean();
		
		$this->end = microtime(true);
		
		$this->serializeResponse($result, $ignoreNull);
	}
	
	public function handleMultiRequest()
	{
	    $listOfRequests = array(); 
	    $results = array();
	    $found = true;
	    $i = 1;
	    while ($found)
	    {
	        $currentService = @$this->params[$i.":service"];
	        $currentAction = @$this->params[$i.":action"];
	        $found = ($currentAction && $currentService);
	        if ($found)
	        {
	            $listOfRequests[$i]["service"] = $currentService;
	            $listOfRequests[$i]["action"] = $currentAction;
	            
	            // find all the parameters for this request
	            foreach($this->params as $key => $val)
	            {
	                // the key "1:myparam" mean that we should input value of this key to request "1", for param "myparam" 
                    $keyArray = explode(":", $key);
                    if ($keyArray[0] == $i) 
                    {
                        array_shift($keyArray); // remove the request number
                        $requestKey = implode(":",$keyArray);
                        
                        if (in_array($requestKey, array("service", "action"))) // don't add service name and action name to the params
                            continue;
                              
                        $listOfRequests[$i]["params"][$requestKey] = $val; // store the param                
                    }
	            }
	            
	            // if ks is not set for a specific request, copy the ks from the top params 
	            if (!@$listOfRequests[$i]["params"]["ks"])
	            {
                    if (@$this->params["ks"])
                        $listOfRequests[$i]["params"]["ks"] = $this->params["ks"];                
	            }
	            
	            $i++;
	        }
	        else
	        {
	            // will break the loop
	        }
	    }
	    
	    $i = 1;
	    foreach($listOfRequests as $currentRequest)
	    {
	        $currentService = $currentRequest["service"];
	        $currentAction = $currentRequest["action"];
	        $currentParams = $currentRequest["params"];
	        
	        // check if we need to replace params with prev results
	        foreach($currentParams as $key => &$val)
	        {
                if (preg_match("/\{([0-9]*)\:result\:?(.*)?\}/", $val, $matches))
                {
                    $resultIndex = $matches[1];
                    $resultKey = $matches[2];
                    
                    if (count($results) >= $resultIndex) // if the result index is valid
                    {
                        if (strlen(trim($resultKey)) > 0)
                            $resultPathArray = explode(":",$resultKey);
                        else
                            $resultPathArray = array();
                            
                        $val = $this->getValueFromObject($results[$resultIndex], $resultPathArray);
                    }
                }	            
	        }
	        
	        
	        try 
	        {
	            $currentResult = $this->dispatcher->dispatch($currentService, $currentAction, $currentParams);
	        }
	        catch(Exception $ex)
	        {
	            $currentResult = $this->getExceptionObject($ex);
	        }
	        
            $results[$i] = $currentResult;	        
	        $i++;
	    }
	    
	    return $results;
	}
	
	private function getValueFromObject($object, $path)
	{
	    if ($path === null || count($path) == 0)
	    {
	        if (!is_object($object))
	            return $object;  
	        else
	            return null;
	    }
	    else
	    {
	        $currentProperty = @$path[0];
	        array_shift($path);
	        if (property_exists($object, $currentProperty))
                return $this->getValueFromObject($object->$currentProperty, $path);
            else
                return null;
	    }
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
		$object = $this->getExceptionObject($ex);
		
		$this->end = microtime(true);
		
		$this->serializeResponse($object);
	}
	
	public function getExceptionObject($ex)
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
		
		return $object;
	}
	
	public function serializeResponse($object, $ignoreNull = false)
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