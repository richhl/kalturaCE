<?php
class XmlClientGenerator extends ClientGeneratorBase 
{
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
		$this->echoLine('');
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
	}
	
	protected function writeHeader()
	{
		$this->echoLine('<xml >');

		$this->echoLine("	<![CDATA[ " .
		 "\n		Generated on date " . strftime( "%d/%m %H:%M:%S." , time() ) 
		. "\n	]]>");
	}
	
	protected function writeFooter()
	{
		$this->echoLine('</xml>');
	}
	
	protected function writeBeforeTypes()
	{
		$this->echoLine('	<classes>');
	}
	
	protected function writeType(KalturaTypeReflector $typeReflector)
	{
		$type = $typeReflector->getType();
		if ($typeReflector->isEnum())
		{
			$contants = $typeReflector->getConstants();
			$this->echoLine("		<class name=\"$type\">");
			foreach($contants as $contant)
			{
				$name = $contant->getName();
				$value = $contant->getDefaultValue();
				$this->echoLine("			<const name=\"$name\" value=\"$value\"/>");
			}
			$this->echoLine("		</class>");
		}
		else if (!$typeReflector->isArray())
		{
			// class definition
			$properties = $typeReflector->getProperties();
			$this->echoLine("		<class name=\"$type\">");
			// class properties
			foreach($properties as $property)
			{
				$propType = $property->getType();
				$propName = $property->getName();
				$cdata =  "	<![CDATA[" ;
				$description = str_replace("\n", "\n	 * ", $property->getDescription()); // to format multiline descriptions
				$cdata .= "\n	 " . $description;
				$cdata .= "\n	  @var $propType";
				if ($property->isReadOnly())
					$cdata .= "\n	 * @readonly";
				if ($property->isInsertOnly())
					$cdata .= "\n	 * @insertonly";
				$cdata .= "\n	 ]]>";
				
				if ( false ) $this->echoLine( $cdata ); 
				
				$propertyLine =	"<property name=\"$propName\" type=\"$propType\" ";

				if ($property->isReadOnly())
					$propertyLine .= " readonly=\"1\"";
				if ($property->isInsertOnly())
					$propertyLine .= " insertonly=\"1\"";				
				if ($property->isSimpleType() || $property->isEnum())
				{
					$propertyLine .= " optional=\"1\"";
				}
				
				$propertyLine .= "/>"; // close property
				$this->echoLine("			$propertyLine");
			}

			// close class
			$this->echoLine("		</class>");
		}
	}
	
	protected function writeAfterTypes()
	{
		$this->echoLine("	</classes>" );
	}
	
	protected function writeBeforeServices()
	{
		$this->echoLine("	<services>");
	}

	protected function writeBeforeService(KalturaServiceReflector $serviceReflector)
	{
		$serviceName = $serviceReflector->getServiceName();
		
		$serviceClassName = "Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
//		$this->echoLine();		
		$this->echoLine("		<service name=\"$serviceClassName\">");
	}
	
	protected function writeServiceAction($serviceName, $action, $actionParams, $outputTypeReflector)
	{
			$outputType = null;
			if ($outputTypeReflector)
				$outputType = $outputTypeReflector->getType();
			
			// method signiture
			$signature = "";
/*			if (in_array($action, array("list", "clone"))) // because list & clone are preserved in PHP
				$signature .= "function ".$action."Action(";
			else
				$signature .= "function ".$action."(";
	*/
			$this->echoLine( "			<action name=\"$action\">");		
			foreach($actionParams as $actionParam)
			{
				$paramName = $actionParam->getName();
				if ($actionParam->isSimpleType() || $actionParam->isEnum())
					$signature .= "$".$paramName;
				else if ($actionParam->isArray())
					$signature .= "array $".$paramName;
				else if ($actionParam->isComplexType())
					$signature .= $actionParam->getType()." $".$paramName;
				
				
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
					
				$this->echoLine( "				<param name=\"$paramName\" " .
					" type=\"" . $actionParam->getType() . "\"" . 
					" enum=\"" . $actionParam->isEnum() . "\"" .
					" simple=\"" . $actionParam->isSimpleType() . "\"" . 
					" array=\"" . $actionParam->isArray() . "\"" . "/>");	
			}
			
			
			if (!$outputTypeReflector)
				$outputType = "null";
			
			if ($outputTypeReflector && $outputTypeReflector->isArray())
				$outputType = "array";

			$this->echoLine("				<result type=\"$outputType\"/>" );
				
//			$this->echoLine("		\$this->client->validateObjectType(\$resultObject, \"$outputType\");");
//			$this->echoLine("		return \$resultObject;");
			
//			$this->echoLine("	}");
			$this->echoLine("			</action>");
	}
	
	protected function writeAfterService(KalturaServiceReflector $serviceReflector)
	{
		$this->echoLine("		</service>");
	}
	
	protected function writeAfterServices()
	{
        $this->echoLine("	</services>");
	}
	
	private function writeMainClassDeclaration()
	{
	}
	
	private function writeMainClassServiceDeclaration(KalturaServiceReflector $serviceReflector)
	{
	}
	
	private function writeMainClassConstructorDeclaration()
	{
	}
	
	private function writeMainClassServiceInitialization(KalturaServiceReflector $serviceReflector)
	{
	}
	
	private function writeMainClassConstructorClosure()
	{
	}
	
	private function writeMainClassClosure()
	{
	}
	
	private function echoLine($text = "")
	{
		echo $text."\n";
	}
	
	private function upperCaseFirstLetter($text)
	{
		if (strlen($text) > 0)
			$text[0] = strtoupper($text[0]);
		return $text;
	}
}