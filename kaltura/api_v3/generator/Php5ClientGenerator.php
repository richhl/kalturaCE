<?php
class Php5ClientGenerator extends ClientGeneratorFromPhp 
{
	protected $_text = "";
	
	public function Php5ClientGenerator()
	{
		parent::ClientGeneratorFromPhp(realpath("sources/php5"));
	}
	
	public function generate() 
	{
		$this->load();
		
		$this->writeHeader();

		$this->writeBeforeTypes();

		$this->sortTypesForPhp();
		
		foreach($this->_types as $typeReflector)
		{
			$this->writeType($typeReflector);
		}
		$this->writeAfterTypes();
		
		// services
		foreach($this->_services as $serviceReflector)
		{
			$this->writeBeforeService($serviceReflector);
			$serviceId = $serviceReflector->getServiceId();
			$actions = $serviceReflector->getActions();
			$actions = array_keys($actions);
			foreach($actions as $actionId)
			{
				$actionInfo = $serviceReflector->getActionInfo($actionId);
				if (strpos($actionInfo->clientgenerator, "ignore") !== false)
					continue;
					
				$actionName = $actionInfo->action;
				$outputTypeReflector = $serviceReflector->getActionOutputType($actionId);
				$actionParams = $serviceReflector->getActionParams($actionId);
				$this->writeServiceAction($serviceId, $actionName, $actionParams, $outputTypeReflector);				
			}
			$this->writeAfterService($serviceReflector);
		}
		
		$this->writeMainClassDeclaration();
		foreach($this->_services as $serviceReflector)
		{
			$this->writeMainClassServiceDeclaration($serviceReflector);
		}
		$this->writeMainClassConstructorDeclaration();
		foreach($this->_services as $serviceReflector)
		{
			$this->writeMainClassServiceInitialization($serviceReflector);
		}
		$this->writeMainClassConstructorClosure();
		$this->writeMainClassClosure();
		
		$this->writeFooter();
		
		$this->addFile("KalturaClient.php", $this->_text);
	}
	
	protected function writeHeader()
	{
		$this->echoLine('<?php');
		$this->echoLine('require_once("KalturaClientBase.php");');
		$this->echoLine('');
	}
	
	protected function writeFooter()
	{
	}
	
	protected function writeBeforeTypes()
	{
		
	}
	
	protected function writeType(KalturaTypeReflector $typeReflector)
	{
		$type = $typeReflector->getType();
		if ($typeReflector->isEnum() || $typeReflector->isStringEnum())
		{
			$contants = $typeReflector->getConstants();
			$this->echoLine("class $type");
			$this->echoLine("{");
			foreach($contants as $contant)
			{
				$name = $contant->getName();
				$value = $contant->getDefaultValue();
				if ($typeReflector->isEnum())
					$this->echoLine("	const $name = $value;");
				else
					$this->echoLine("	const $name = \"$value\";");
			}
			$this->echoLine("}");
			$this->echoLine();
		}
		else if (!$typeReflector->isArray())
		{
			// class definition
			$properties = $typeReflector->getCurrentProperties();
			$parentTypeReflector = $typeReflector->getParentTypeReflector();
			if ($parentTypeReflector)
			    $this->echoLine("class $type extends " . $parentTypeReflector->getType());
		    else
			    $this->echoLine("class $type extends KalturaObjectBase");
			$this->echoLine("{");
			// class properties
			foreach($properties as $property)
			{
				$propType = $property->getType();
				$propName = $property->getName();
				$this->echoLine("	/**");
				$description = str_replace("\n", "\n	 * ", $property->getDescription()); // to format multiline descriptions
				$this->echoLine("	 * " . $description);
				$this->echoLine("	 *");
				$this->echoLine("	 * @var $propType");
				if ($property->isReadOnly())
					$this->echoLine("	 * @readonly");
				if ($property->isInsertOnly())
					$this->echoLine("	 * @insertonly");
				$this->echoLine("	 */");
				
				$propertyLine =	"public $$propName";
				
				if ($property->isSimpleType() || $property->isEnum() || $property->isStringEnum())
				{
					$propertyLine .= " = null";
				}
				$this->echoLine("	$propertyLine;");
				$this->echoLine("");
			}
			$this->echoLine();

			/*$this->echoLine("	public function toParams()");
			$this->echoLine("	{");
			$this->echoLine("		\$kparams = parent::toParams();");
			foreach($properties as $property)
			{
				$propType = $property->getType();
				$propName = $property->getName();
				
				if ($property->isSimpleType() || $property->isEnum())
				{
					$this->echoLine("		\$this->addIfNotNull(\$kparams, \"$propName\", \$this->$propName);");
				}
				else
				{ 
					continue; // ignore sub objects and arrays
				}
			}
			$this->echoLine("		return \$kparams;");
			$this->echoLine("	}");*/
			
			// close class
			$this->echoLine("}");
			$this->echoLine();
		}
	}
	
	protected function writeAfterTypes()
	{
	}
	
	protected function writeBeforeServices()
	{
	}

	protected function writeBeforeService(KalturaServiceReflector $serviceReflector)
	{
		$serviceName = $serviceReflector->getServiceName();
		
		$serviceClassName = "Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
		$this->echoLine();		
		$this->echoLine("class $serviceClassName extends KalturaServiceBase");
		$this->echoLine("{");
		$this->echoLine("	function __construct(KalturaClient \$client)");
		$this->echoLine("	{");
		$this->echoLine("		parent::__construct(\$client);");
		$this->echoLine("	}");
	}
	
	protected function writeServiceAction($serviceId, $action, $actionParams, $outputTypeReflector)
	{
			$outputType = null;
			if ($outputTypeReflector)
				$outputType = $outputTypeReflector->getType();
			
			// method signature
			$signature = "";
			if (in_array($action, array("list", "clone"))) // because list & clone are preserved in PHP
				$signature .= "function ".$action."Action(";
			else
				$signature .= "function ".$action."(";
				
			foreach($actionParams as $actionParam)
			{
				$paramName = $actionParam->getName();
				if ($actionParam->isSimpleType() || $actionParam->isEnum() || $actionParam->isStringEnum() || $actionParam->isFile())
					$signature .= "$".$paramName;
				else if ($actionParam->isArray())
					$signature .= "array $".$paramName;
				else if ($actionParam->isComplexType())
					$signature .= $actionParam->getType()." $".$paramName;
				
				
				if ($actionParam->isOptional())
				{
					if ($actionParam->isSimpleType() || $actionParam->isEnum() || $actionParam->isStringEnum())
					{
						$defaultValue = $actionParam->getDefaultValue();
						if ($defaultValue === false)
							$signature .= " = false";
						else if ($defaultValue === true)
							$signature .= " = true";
						else if ($defaultValue === null)
							$signature .= " = null";
						else if (is_string($defaultValue))
							$signature .= " = \"$defaultValue\"";
						else if (is_numeric($defaultValue))
							$signature .= " = $defaultValue"; 
					}
					else
						$signature .= " = null";
				}
					
				$signature .= ", ";
			}
			if ($this->endsWith($signature, ", "))
				$signature = substr($signature, 0, strlen($signature) - 2);
			$signature .= ")";
			
			$this->echoLine();	
			$this->echoLine("	$signature");
			$this->echoLine("	{");
			
			$this->echoLine("		\$kparams = array();");
			$haveFiles = false;
			foreach($actionParams as $actionParam)
			{
				$paramName = $actionParam->getName();
				
			    if ($haveFiles === false && $actionParam->isFile())
		    	{
			        $haveFiles = true;
		        	$this->echoLine("		\$kfiles = array();");
		    	}
		    
				if ($actionParam->isComplexType())
				{
					if ($actionParam->isEnum() || $actionParam->isStringEnum())
					{
						$this->echoLine("		\$this->client->addParam(\$kparams, \"$paramName\", \$$paramName);");
					}
					else if ($actionParam->isFile())
					{
						$this->echoLine("		\$this->client->addParam(\$kfiles, \"$paramName\", \$$paramName);");
					}
					else if ($actionParam->isArray())
					{
						$extraTab = "";
						if ($actionParam->isOptional())
						{
							$this->echoLine("		if (\$$paramName !== null)");
							$extraTab = "	";
						}
						$this->echoLine("$extraTab		foreach($paramName as \$obj)");
						$this->echoLine("$extraTab		{");
						$this->echoLine("$extraTab			\$this->client->addParam(\$kparams, \"$paramName\", \$obj->toParams());");
						$this->echoLine("$extraTab		}");
					}
					else
					{
						$extraTab = "";
						if ($actionParam->isOptional())
						{
							$this->echoLine("		if (\$$paramName !== null)");
							$extraTab = "	";
						}
						$this->echoLine("$extraTab		\$this->client->addParam(\$kparams, \"$paramName\", \$$paramName"."->toParams());");
					}
				}
				else
				{
					$this->echoLine("		\$this->client->addParam(\$kparams, \"$paramName\", \$$paramName);");
				}
			}
			if ($haveFiles)
				$this->echoLine("		\$this->client->queueServiceActionCall(\"$serviceId\", \"$action\", \$kparams, \$kfiles);");
			else
				$this->echoLine("		\$this->client->queueServiceActionCall(\"$serviceId\", \"$action\", \$kparams);");
			$this->echoLine("		if (\$this->client->isMultiRequest())");
			$this->echoLine("			return null;");
			$this->echoLine("		\$resultObject = \$this->client->doQueue();");
			$this->echoLine("		\$this->client->throwExceptionIfError(\$resultObject);");
			
			if (!$outputTypeReflector)
				$outputType = "null";
			
			if ($outputTypeReflector && $outputTypeReflector->isArray())
				$outputType = "array";
				
			$this->echoLine("		\$this->client->validateObjectType(\$resultObject, \"$outputType\");");
			$this->echoLine("		return \$resultObject;");
			$this->echoLine("	}");	
	}
	
	protected function writeAfterService(KalturaServiceReflector $serviceReflector)
	{
		$this->echoLine("}");
	}
	
	protected function writeAfterServices()
	{
        $this->echoLine('		}');
		$this->echoLine("	}");
	}
	
	private function writeMainClassDeclaration()
	{
		$this->echoLine("");
		$this->echoLine("class KalturaClient extends KalturaClientBase");
		$this->echoLine("{");
	}
	
	private function writeMainClassServiceDeclaration(KalturaServiceReflector $serviceReflector)
	{
		$docComment = $serviceReflector->getServiceInfo();
		
		$serviceName = $serviceReflector->getServiceName();
		$serviceClassName = "Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
		$this->echoLine("	/**");
		$description = str_replace("\n", "\n	 * ", $docComment->description); // to format multiline descriptions
		$this->echoLine("	 * " . $description);
		$this->echoLine("	 *");
		$this->echoLine("	 * @var $serviceClassName");
		$this->echoLine("	 */");
		$this->echoLine("	public \$$serviceName = null;");
		$this->echoLine("");
	}
	
	private function writeMainClassConstructorDeclaration()
	{
		$this->echoLine("");
		$this->echoLine("	public function __construct(KalturaConfiguration \$config)");
		$this->echoLine("	{");
		$this->echoLine("		parent::__construct(\$config);");
	}
	
	private function writeMainClassServiceInitialization(KalturaServiceReflector $serviceReflector)
	{
		$serviceName = $serviceReflector->getServiceName();
		$serviceClassName = "Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
		$this->echoLine("		\$this->$serviceName = new $serviceClassName(\$this);");
	}
	
	private function writeMainClassConstructorClosure()
	{
		$this->echoLine("	}");
	}
	
	private function writeMainClassClosure()
	{
		$this->echoLine("}");
	}
	
	protected function echoLine($text = "")
	{
		
		$this->_text .= ($text . "\n");
	}
	
	protected function upperCaseFirstLetter($text)
	{
		if (strlen($text) > 0)
			$text[0] = strtoupper($text[0]);
		return $text;
	}
	
	protected function sortTypesForPhp()
	{
	    // types are order alphabetically, but in php, base types should be defined before inherited types
	    $newTypesList = array();
	    foreach ($this->_types as $typeReflector)
	    {
	        $parentTypeReflector = null;
	        $tempList = array();
	        $tempList[$typeReflector->getType()] = $typeReflector;
	        while(true)
	        {
	            if ($typeReflector->getParentTypeReflector())
	            {
	                $typeReflector = $typeReflector->getParentTypeReflector();
	                $tempList[$typeReflector->getType()] = $typeReflector;
	            }
                else
                    break;
	        }
	        $tempList = array_reverse($tempList);
	        
	        $newTypesList = array_merge($newTypesList, $tempList);
	    }
	    
	    $this->_types = $newTypesList;
	}
}