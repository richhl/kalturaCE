<?php

abstract class ClientGeneratorBase 
{
	protected $_services = array();
	protected $_types = array();
	
	/**
	 * Ctor
	 *
	 */
	public function __construct() 
	{
		$this->loadServicesInfo();
		
		// orginized types so enums will be first
		$enumTypes = array();
		$classTypes = array();
	    foreach($this->_types as $typeReflector)
		{
			if ($typeReflector->isEnum())
			    $enumTypes[$typeReflector->getType()] = $typeReflector;
		    else
		        $classTypes[$typeReflector->getType()] = $typeReflector; 
		}
		
		// sort by type name
		ksort($enumTypes);
		ksort($classTypes);
		
		// merge back
		$this->_types = array_merge($enumTypes, $classTypes);
	}
	
	/**
	 * Main generation method, can be overload to support a different flow
	 *
	 */
	public function generate() 
	{
		$this->writeHeader();

		$this->writeBeforeTypes();
		// types
		foreach($this->_types as $typeReflector)
		{
			$this->writeType($typeReflector);
		}
		$this->writeAfterTypes();
		
		$this->writeBeforeServices();
		// services
		foreach($this->_services as $serviceReflector)
		{
			$this->writeBeforeService($serviceReflector);
			$serviceName = $serviceReflector->getServiceName();
			$actions = $serviceReflector->getActions();
			$actions = array_keys($actions);
			foreach($actions as $action)
			{
				$actionInfo = $serviceReflector->getActionInfo($action);
				if (strpos($actionInfo->clientgenerator, "ignore") !== false)
					continue;
					
				$outputTypeReflector = $serviceReflector->getActionOutputType($action);
				$actionParams = $serviceReflector->getActionParams($action);
				$this->writeServiceAction($serviceName, $action, $actionParams, $outputTypeReflector);				
			}
			$this->writeAfterService($serviceReflector);
		}
		$this->writeAfterServices();
		
		$this->writeFooter();
	}
	
	/**
	 * Called to write the header
	 *
	 */
	protected abstract function writeHeader();
	
	/**
	 * Called to write the footer
	 *
	 */
	protected abstract function writeFooter();
	
	protected abstract function writeBeforeServices();
	
	protected abstract function writeBeforeService(KalturaServiceReflector $serviceReflector);
	
	/**
	 * Called while looping the actions inside a service to write the service action description
	 *
	 * @param string $serviceName
	 * @param string $action
	 * @param array $actionParams
	 * @param KalturaTypeReflector $outputTypeReflector
	 */
	protected abstract function writeServiceAction($serviceName, $action, $actionParams, $outputTypeReflector);
	
	protected abstract function writeAfterService(KalturaServiceReflector $serviceReflector);
	
	protected abstract function writeAfterServices();
	
	protected abstract function writeBeforeTypes();
	
	/**
	 * Called to write the description of a type
	 * 
	 * @param array $typeDescription 
	 */
	protected abstract function writeType(KalturaTypeReflector $type);
	
	protected abstract function writeAfterTypes();
	

	/**
	 * Scans the file system and loads the description of the services to an array
	 *
	 */
	protected function loadServicesInfo() 
	{
		$serviceMap = KalturaServicesMap::getMap();
		$services = array_keys($serviceMap);
		foreach($services as $service)
		{
			$serviceReflector = new KalturaServiceReflector($service);
			$this->addService($serviceReflector);
		
			$actions = array_keys($serviceReflector->getActions());
			foreach($actions as $action)
			{
				// params
				$actionParams = $serviceReflector->getActionParams($action);
				$actionInfo = $serviceReflector->getActionInfo($action);
				
				if (strpos($actionInfo->clientgenerator, "ignore") !== false)
					continue;
					
				foreach ($actionParams as $actionParam)
				{
					if ($actionParam->isComplexType())
					{
						$typeReflector = new KalturaTypeReflector($actionParam->getType());
						$this->loadTypesRecursive($typeReflector);						
					}
				}

				// output type
				$outputInfo = $serviceReflector->getActionOutputType($action);
				if ($outputInfo && $outputInfo->isComplexType())
				{
					$this->loadTypesRecursive($outputInfo->getTypeReflector());
				}
			}
		}
	}
	
	private function loadTypesRecursive(KalturaTypeReflector $typeReflector)
	{
	    $parentTypeReflector = $typeReflector->getParentTypeReflector();
	    if ($parentTypeReflector)
	    {
	        $parentType = $parentTypeReflector->getType();
            $this->loadTypesRecursive($parentTypeReflector);   
	    }
	    
		$properties = $typeReflector->getProperties();
		foreach($properties as $property)
		{
			$subTypeReflector = $property->getTypeReflector();
			if ($subTypeReflector)
				$this->loadTypesRecursive($subTypeReflector);
		}
		
		$this->addType($typeReflector);
	}
	
	protected function addService(KalturaServiceReflector $serviceReflector)
	{
		$serviceName = $serviceReflector->getServiceName();
		if (array_key_exists($serviceName, $this->_services))
			throw new Exception("Service already exists");
			
		$this->_services[$serviceName] = $serviceReflector;
	}
	
	protected function addType(KalturaTypeReflector $objectReflector)
	{
		$type = $objectReflector->getType();
		if (!array_key_exists($type, $this->_types))
			$this->_types[$type] = $objectReflector;
	}
	
	/**
	 * Check if a string ends with another string
	 *
	 * @param string $str
	 * @param string $end
	 * @return boolean
	 */
	protected function endsWith($str, $end) 
	{
		return (substr($str, strlen($str) - strlen($end)) === $end);
	}
	
	/**
	 * Check if a string begins with another string
	 *
	 * @param string $str
	 * @param string $end
	 * @return boolean
	 */
	protected function beginsWith($str, $end) 
	{
		return (substr($str, 0, strlen($end)) === $end);
	}
}