<?php
/**
 * A helper class to access service actions, action params and does the real invocation.
 *
 */
class KalturaServiceReflector
{
	private $_serviceId = null;
	private $_serviceClass = null;
	private $_servicesMap = null;
	private $_actions = null;
	private $_docCommentParser = null;
	
	private $_serviceInstance = null;
	
	public function KalturaServiceReflector($service)
	{
		$this->_serviceId = strtolower($service);
		$this->_serviceClass = $service."Service";
		$this->_servicesMap = KalturaServicesMap::getMap();
		
		if (!$this->isServiceExists($this->_serviceClass))
			throw new Exception("Service [$service] does not exists");
			
		require_once($this->_servicesMap[$this->_serviceId]);
		
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		$this->_docCommentParser = new KalturaDocCommentParser($reflectionClass->getDocComment()); 
	}
	
	public function getServiceInfo()
	{
	    return $this->_docCommentParser;
	}
	
    public function getServiceId()
	{
		return $this->_serviceId;
	}
	
	public function getServiceName()
	{
		return $this->_docCommentParser->serviceName;
	}
	
	public function isServiceExists()
	{
		return array_key_exists($this->_serviceId, $this->_servicesMap);
	}
	
	public function isActionExists($actionName)
	{
		$actions = $this->getActions();
		$actionId = strtolower($actionName);
		return array_key_exists($actionId, $actions);
	}
	
	public function getActions()
	{
		if ($this->_actions)
			return $this->_actions;
		
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		
		$reflectionMethods = $reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC);
		
		$actions = array();
		foreach($reflectionMethods as $reflectionMethod)
		{
			$docComment = $reflectionMethod->getDocComment();
			$parsedDocComment = new KalturaDocCommentParser( $docComment );
			if ($parsedDocComment->action)
			{
				$actionName = $parsedDocComment->action;
				$actionId = strtolower($actionName);
				$actions[$actionId] = $reflectionMethod->getName(); // key is the action id (action name lower cased), value is the method name
			}
		}
		
		$this->_actions = $actions;
		
		return $this->_actions;
	}
	
	public function getActionInfo($actionName)
	{
		if (!$this->isActionExists($actionName))
			throw new Exception("Action [$actionName] does not exists for service [$this->_serviceId]");
		
		$actionId = strtolower($actionName);
		$methodName = $this->_actions[$actionId];
		// reflect the service 
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		$reflectionMethod = $reflectionClass->getMethod($methodName);
		
		$docComment = $reflectionMethod->getDocComment();
		$parsedDocComment = new KalturaDocCommentParser( $docComment );
		return $parsedDocComment;
	}
	
	public function getActionParams($actionName)
	{
		if (!$this->isActionExists($actionName))
			throw new Exception("Action [$actionName] does not exists for service [$this->_serviceId]");
			
		$actionId = strtolower($actionName);
		$methodName = $this->_actions[$actionId];
		
		// reflect the service 
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		$reflectionMethod = $reflectionClass->getMethod($methodName);
		
		$docComment = $reflectionMethod->getDocComment();
		$reflectionParams = $reflectionMethod->getParameters();
		$actionParams = array();
		foreach($reflectionParams as $reflectionParam)
		{
			$name = $reflectionParam->getName();
			$parsedDocComment = new KalturaDocCommentParser( $docComment, array(
				KalturaDocCommentParser::DOCCOMMENT_REPLACENET_PARAM_NAME => $name , ) );
			$paramClass = $reflectionParam->getClass(); // type hinting for objects  
			if ($paramClass)
			{
				$type = $paramClass->getName();
			}
			else //
			{
				$result = null;
				if ($parsedDocComment->param)
					$type = $parsedDocComment->param;
				else 
				{
					// FIXME: Change to another exception
					throw new KalturaDispatcherException("Type not found in doc comment for param [".$name."] in action [".$actionName."] in service [".$this->_serviceId."]");
				}
			}
			
			$paramInfo = new KalturaParamInfo($type, $name);
			$paramInfo->setDescription($parsedDocComment->paramDescription);
			
			if ($reflectionParam->isOptional()) // for normal parameters
			{
				$paramInfo->setDefaultValue($reflectionParam->getDefaultValue());
				$paramInfo->setOptional(true);
			}
			else if ($reflectionParam->getClass() && $reflectionParam->allowsNull()) // for object parameter
			{
				$paramInfo->setOptional(true);
			}
			
			$actionParams[] = $paramInfo;
		}
		
		return $actionParams;
	}
	
	public function getActionOutputType($actionName)
	{
		if (!$this->isActionExists($actionName))
			throw new Exception("Action [$actionName] does not exists for service [$this->_serviceId]");

		$actionId = strtolower($actionName);
		$methodName = $this->_actions[$actionId];
		
		// reflect the service
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		$reflectionMethod = $reflectionClass->getMethod($methodName);
		
		$docComment = $reflectionMethod->getDocComment();
		$parsedDocComment = new KalturaDocCommentParser($docComment);
		if ($parsedDocComment->returnType)
			return new KalturaParamInfo($parsedDocComment->returnType, "output");
		
		return null;
	}
	
	public function invoke($actionName, $arguments)
	{
	    $actionId = strtolower($actionName);
		$methodName = $this->_actions[$actionId];
		$instance = $this->getServiceInstance();
		return call_user_func_array(array($instance, $methodName), $arguments);
	}
	
	public function getServiceInstance()
	{
		if ( ! $this->_serviceInstance ) 
		{
			 $this->_serviceInstance = new $this->_serviceClass();
		}
		
		return $this->_serviceInstance;
	}
}