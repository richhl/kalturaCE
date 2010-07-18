<?php
class Php4ClientGenerator extends Php5ClientGenerator 
{
	public function Php4ClientGenerator()
	{
		parent::ClientGeneratorFromPhp(realpath("sources/php4"));
	}
	
	public function generate() 
	{
		$this->load();
		
		$this->writeHeader();

		$this->writeBeforeTypes();
		
		$this->sortTypesForPhp();
		
		// types
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
			$serviceName = $serviceReflector->getServiceName();
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
				$this->writeServiceAction($serviceId, $serviceName, $actionName, $actionParams, $outputTypeReflector);				
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
			
			foreach($contants as $contant)
			{
				$name = $contant->getName();
				$value = $contant->getDefaultValue();
				if ($typeReflector->isEnum())
					$this->echoLine("define(\"".$type."_".$name."\", $value);");
				elseif ($typeReflector->isStringEnum())
					$this->echoLine("define(\"".$type."_".$name."\", \"$value\");");
			}
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
				
				$propertyLine =	"var $$propName";
				
				if ($property->isSimpleType() || $property->isEnum())
				{
					$propertyLine .= " = null";
				}
				$this->echoLine("	$propertyLine;");
				$this->echoLine("");
			}
			$this->echoLine();
			
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
		$this->echoLine("	function $serviceClassName(&\$client)");
		$this->echoLine("	{");
		$this->echoLine("		parent::KalturaServiceBase(\$client);");
		$this->echoLine("	}");
	}
	
	protected function writeServiceAction($serviceId, $serviceName, $action, $actionParams, $outputTypeReflector)
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
				if ($actionParam->isSimpleType() || $actionParam->isEnum())
					$signature .= "$".$paramName;
				else if ($actionParam->isArray())
					$signature .= "$".$paramName; // php4 doesn't support array type hinting
				else if ($actionParam->isComplexType())
					$signature .= "$".$paramName;
				
				
				if ($actionParam->isOptional())
				{
					if ($actionParam->isSimpleType() || $actionParam->isEnum())
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
			foreach($actionParams as $actionParam)
			{
				$paramName = $actionParam->getName();
				
				if ($actionParam->isComplexType())
				{
					if ($actionParam->isEnum())
					{
						$this->echoLine("		\$this->client->addParam(\$kparams, \"$paramName\", \$$paramName);");
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
			
			$this->echoLine("		\$resultObject = \$this->client->callService(\"$serviceId\", \"$action\", \$kparams);");
			$this->echoLine("		\$this->client->checkForError(\$resultObject);");
			
			if (!$outputTypeReflector)
				$outputType = "null";
			
			if ($outputTypeReflector && $outputTypeReflector->isArray())
				$outputType = "array";
				
			if ($outputType == 'int')
				$outputType = "integer";
				
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
		$this->echoLine("	var \$$serviceName = null;");
		$this->echoLine("");
	}
	
	private function writeMainClassConstructorDeclaration()
	{
		$this->echoLine("");
		$this->echoLine("	function KalturaClient(\$config)");
		$this->echoLine("	{");
		$this->echoLine("		parent::KalturaClientBase(/*KalturaConfiguration*/ \$config);");
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
}