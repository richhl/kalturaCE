<?php
class KalturaRequestDeserializer
{
	private $params = null;
	private $paramsGrouped = array();
	private $objects = array();
	private $extraParams = array("format", "ks", "fullObjects");

	const PREFIX = ":";

	public function KalturaRequestDeserializer($params)
	{
		$this->params = $params;
		$this->groupParams();
	}

	public function groupParams()
	{
		// group the params by prefix
		foreach($this->params as $key => $value)
		{
			$objDelimiterPos = strpos($key, self::PREFIX);
			if ($objDelimiterPos !== false)
			{
				$prefix = substr($key, 0, $objDelimiterPos);
				$prop = substr($key, $objDelimiterPos + 1);
				$this->paramsGrouped[$prefix][$prop] = $value;
			}
			else
			{
				$this->paramsGrouped[$key] = $value;
			}
		}
		/* not needed because we use identify the type from the action anotation
		// remove all object that doesn't have a type
		foreach($this->paramsGrouped as $prop => $value)
		{
			if (is_array($value))
			{
				$removeObject = true;
				foreach($value as $objProp => $objValue)
				{
					if ($objProp == "objectType")
						$removeObject = false;
				}

				if ($removeObject)
					unset($this->paramsGrouped[$prop]);
			}
		}
		*/
	}

	public function buildActionArguments(&$actionParams)
	{
		$serviceArguments = array();
		foreach($actionParams as &$actionParam)
		{
			$found = false;
			$type = $actionParam->getType();
			$name = $actionParam->getName();
			
			if ($actionParam->isSimpleType($type))
			{
				if (array_key_exists($name, $this->paramsGrouped))
				{
					$serviceArguments[] = $this->castSimpleType($type, $this->paramsGrouped[$name]);
					$found = true;
				}
				else if ($actionParam->isOptional())
				{
					$serviceArguments[] = $this->castSimpleType($type, $actionParam->getDefaultValue());
					$found = true;
				}
			}
			else if ($actionParam->isFile())
			{
				if (isset($_FILES[$name]))
				{
					$serviceArguments[]	= $_FILES[$name];
					$found = true;
				}
				else if ($actionParam->isOptional()) 
				{
					$serviceArguments[] = null;
					$found = true; 	
				}
			}
			else
			{
				if ($actionParam->isEnum()) // enum
				{
					if (array_key_exists($name, $this->paramsGrouped))
					{
						$enumValue = $this->paramsGrouped[$name];
						if (!$actionParam->getTypeReflector()->checkEnumValue($enumValue))
							throw new KalturaAPIException(KalturaErrors::INVALID_ENUM_VALUE, $enumValue, $name, $actionParam->getType());
						
						$serviceArguments[] = $this->castSimpleType("int", $enumValue);
						$found = true;
					}
					else if ($actionParam->isOptional())
					{
						$serviceArguments[] = $this->castSimpleType("int", $actionParam->getDefaultValue());
						$found = true;
					}
				}
				else if ($actionParam->isArray()) // array
				{
					$objects = array();
					
					// check if an object exists without an index (without index is "someobjects", with index is "someobjects1")
					if (array_key_exists($name, $this->paramsGrouped))
					{
						$objects[] = $this->buildObject($actionParam->getArrayTypeReflector(), $this->paramsGrouped[$name]);
					}
					
					$continue = true;
					$idx = 0;
					while($continue || $idx <= 1) // so we will support [someobjects1, someobjects2] and [someobjects0, someobjects1]
					{
						if (array_key_exists($name.$idx, $this->paramsGrouped))
						{
							$objects[] = $this->buildObject($actionParam->getArrayTypeReflector(), $this->paramsGrouped[$name]);
							$continue = true;
						}
						else
						{
							$continue = false;
						}
						$idx++;
					}
					
					// FIXME: add array handling
					if (count($objects)) 
					{
						$serviceArguments[] = $objects;
						$found = true;
					}
				}
				else if (isset($this->paramsGrouped[$name])) // object 
				{
					$serviceArguments[] = $this->buildObject($actionParam->getTypeReflector(), $this->paramsGrouped[$name]);
					$found = true;
				}
				else if ($actionParam->isOptional()) // object that is optional
				{
					$serviceArguments[] = null;
					$found = true;
				}
			}

			if (!$found)
			{
				throw new KalturaAPIException(KalturaErrors::MISSING_MANDATORY_PARAMETER, $name);
			}
		}
		return $serviceArguments;
	}

	private function buildObject(KalturaTypeReflector $typeReflector, array &$params)
	{
		// if objectType was specified, we will use it only if the anotation type is it's base type
		if (array_key_exists("objectType", $params))
		{
            $possibleType = $params["objectType"];
            if (strtolower($possibleType) !== strtolower($typeReflector->getType())) // reflect only if type is different
            {
                if ($typeReflector->isParentOf($possibleType)) // we know that the objectType that came from the user is right, and we can use it to initiate the object
                    $typeReflector = new KalturaTypeReflector($possibleType);
            }
		}
		
	    $class = $typeReflector->getType();
		$obj = new $class;
		$properties = $typeReflector->getProperties();
		foreach($properties as $property)
		{
			$name = $property->getName();
			$type = $property->getType();

			if (!array_key_exists($name, $params)) // missing parameters should be null or default propery value
				continue;
					
			$value = $params[$name];
			if ($property->isSimpleType())
			{
				$obj->$name = $this->castSimpleType($type, $value);
			}
			else 
			{
				if ($property->isEnum())
				{
					if (!$property->getTypeReflector()->checkEnumValue($value))
						throw new KalturaAPIException(KalturaErrors::INVALID_ENUM_VALUE, $value, $name, $property->getType());
						
					$obj->$name = $this->castSimpleType("int", $value);
				}
			}
		}
		return $obj;
	}
	
	public function getKS()
	{
		return $this->castSimpleType("string", $this->paramsGrouped["ks"]);
	}
	
	public function getTargetPartnerId()
	{
		return $this->castSimpleType("int", $this->paramsGrouped["targetPartnerId"]);
	}
	
	public function getTargetUserId()
	{
		return $this->castSimpleType("string", $this->paramsGrouped["targetUserId"]);
	}
	
	private function castSimpleType($type, $var)
	{
		switch($type)
		{
			case "int":
				return (int)$var;
			case "string":
				return (string)$var;
			case "bool":
				return (bool)$var;
			case "float":
				return (float)$var;
		}
		
		return null;
	}
}
