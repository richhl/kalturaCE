<?php

abstract class ClientGeneratorFromPhp 
{
	protected $_files = array();
	protected $_services = array();
	protected $_types = array();
	protected $_includeList = array();
	protected $_sourcePath = "";
	
	/**
	 * Ctor
	 *
	 */
	public function ClientGeneratorFromPhp($sourcePath = null) 
	{
		$this->_sourcePath = realpath($sourcePath);
		
		if (($sourcePath !== null) && !(is_dir($sourcePath)))
			throw new Exception("Source path was not found");
		
		if (is_dir($sourcePath))
			$this->addSourceFiles($this->_sourcePath);	
	}
	
	public function getOutputFiles()
	{
		return $this->_files;
	}
	
	protected function addFile($fileName, $fileContents)
	{
		 $this->_files[$fileName] = $fileContents;
	}
	
	protected function addSourceFiles($directory)
	{
		// add if file
		if (is_file($directory)) 
		{
			$file = str_replace($this->_sourcePath.DIRECTORY_SEPARATOR, "", $directory);
			$this->addFile($file, file_get_contents($directory));
			return;
		}
		
		// loop through the folder
		$dir = dir($directory);
		while (false !== $entry = $dir->read()) 
		{
			// skip pointers & hidden files
			if ($this->beginsWith($entry, ".")) 
			{
				continue;
			}
			 
			$this->addSourceFiles(realpath("$directory/$entry"));
		}
		 
		// clean up
		$dir->close();
	}
	
	/**
	 * Main generation method, can be overload to support a different flow
	 *
	 */
	public function generate() 
	{
		$this->load();
		
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
	
	protected function load()
	{
		$this->loadServicesInfo();
		
		// load the filter order by string enums
		$filterOrderByStringEnums = array();
		foreach($this->_types as $typeReflector)
		{
			if (strpos($typeReflector->getType(), "Filter", strlen($typeReflector->getType()) - 6))
			{
				$filterOrderByStringEnumTypeName = str_replace("Filter", "OrderBy", $typeReflector->getType());
				if (class_exists($filterOrderByStringEnumTypeName))
					$filterOrderByStringEnums[] = new KalturaTypeReflector($filterOrderByStringEnumTypeName);
			}
		}
		$this->_types = array_merge($this->_types, $filterOrderByStringEnums);
		
		// organize types so enums will be first
		$enumTypes = array();
		$classTypes = array();
	    foreach($this->_types as $typeReflector)
		{
			if ($typeReflector->isEnum())
			    $enumTypes[$typeReflector->getType()] = $typeReflector;
		    else
		        $classTypes[$typeReflector->getType()] = $typeReflector; 
		};
		
		// sort by type name
		ksort($enumTypes);
		ksort($classTypes);
		
		// merge back
		$this->_types = array_merge($enumTypes, $classTypes);
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
			if (count($this->_includeList) > 0 && array_key_exists($service, $this->_includeList)) 
			{
				$actionToInclude = $this->_includeList[$service];
				$this->addService($serviceReflector);
				
				$actions = array_keys($serviceReflector->getActions());
				foreach($actions as $action)
				{
					if (count($actionToInclude) && !array_key_exists($action, $actionToInclude))
					{
						$serviceReflector->removeAction($action);
						continue;
					}
					
					// params
					$actionParams = $serviceReflector->getActionParams($action);
					$actionInfo = $serviceReflector->getActionInfo($action);
					
					if (strpos($actionInfo->clientgenerator, "ignore") !== false)
						continue;
						
					foreach ($actionParams as $actionParam)
					{
						if ($actionParam->isComplexType() && !$actionParam->isFile())
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
		
		if ($typeReflector->isArray())
			$this->loadTypesRecursive(new KalturaTypeReflector($typeReflector->getArrayType()));
		
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
	
	public function setIncludeList($list)
	{
		$this->_includeList = $list;
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