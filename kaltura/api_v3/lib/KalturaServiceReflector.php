<?php
/**
 * A helper class to access service actions, action params and does the real invocation.
 *
 */
class KalturaServiceReflector
{
	private $_serviceName = null;
	private $_serviceClass = null;
	private $_servicesMap = null;
	private $_actions = null;
	
	private $_serviceInstance = null;
	
	public function KalturaServiceReflector($service)
	{
		$this->_serviceName = $service;
		$this->_serviceClass = $service."Service";
		$this->_servicesMap = KalturaServicesMap::getMap();
		
		if (!$this->isServiceExists($this->_serviceClass))
			throw new Exception("Service [$this->_serviceName] does not exists");
			
		require_once($this->_servicesMap[$this->_serviceName]);
	}
	
	public function getServiceInfo()
	{
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		return new KalturaDocCommentParser($reflectionClass->getDocComment());
	}
	
	public function getServiceName()
	{
		return $this->_serviceName;
	}
	
	public function isServiceExists()
	{
		return array_key_exists($this->_serviceName, $this->_servicesMap);
	}
	
	public function isActionExists($action)
	{
		$actions = $this->getActions();
		return array_key_exists($action, $actions);
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
				$actionAlias = $parsedDocComment->action;
				$actions[$actionAlias] = $reflectionMethod->getName();	// key is the action name, value is the real method name
			}
		}
		
		$this->_actions = $actions;
		
		return $this->_actions;
	}
	
	public function getActionInfo($action)
	{
		if (!$this->isActionExists($action))
			throw new Exception("Action [$action] does not exists for service [$this->_serviceName]");
		
		$methodName = $this->_actions[$action];
		// reflect the service 
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		$reflectionMethod = $reflectionClass->getMethod($methodName);
		
		$docComment = $reflectionMethod->getDocComment();
		$parsedDocComment = new KalturaDocCommentParser( $docComment );
		return $parsedDocComment;
	}
	
	public function getActionParams($action)
	{
		if (!$this->isActionExists($action))
			throw new Exception("Action [$action] does not exists for service [$this->_serviceName]");
			
		$methodName = $this->_actions[$action];
		
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
					throw new KalturaDispatcherException("Type not found in doc comment for param [".$name."] in action [".$action."] in service [".$this->_serviceName."]");
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
	
	public function getActionOutputType($action)
	{
		if (!$this->isActionExists($action))
			throw new Exception("Action [$action] does not exists for service [$this->_serviceName]");
			
		$methodName = $this->_actions[$action];
		
		// reflect the service
		$reflectionClass = new ReflectionClass($this->_serviceClass);
		$reflectionMethod = $reflectionClass->getMethod($methodName);
		
		$docComment = $reflectionMethod->getDocComment();
		$parsedDocComment = new KalturaDocCommentParser($docComment);
		if ($parsedDocComment->returnType)
			return new KalturaParamInfo($parsedDocComment->returnType, "output");
		
		return null;
	}
	
	public function invoke($action, $arguments)
	{
		$methodName = $this->_actions[$action];
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