<?php

/**
 * This class is used to reflect specific Kaltura objects, arrays & enums
 * This will be the place to boost performance by caching the reflection results to memcache or the filesystem 
 *
 */
class KalturaTypeReflector
{
	private $_type;
	private $_instance;
	private $_properties;
	private $_currentProperties;
	private $_constants;
	private $_isEnum;
	private $_isStringEnum;
	private $_isArray;
	private $_description;
	
	/**
	 * Contructs new type reflector instance
	 *
	 * @param string $type
	 * @return KalturaTypeReflector
	 */
	public function KalturaTypeReflector($type)
	{
		if (!class_exists($type))
			throw new KalturaReflectionException("Type \"".$type."\" not found");
			
		$this->_type = $type;
		$this->_instance = new $type;
	}
	
	/**
	 * Returns the type of the reflected class
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}
	
	/**
	 * Return the type properties 
	 *
	 * @return array
	 */
	public function getProperties()
	{
		if ($this->_properties === null)
		{
			$this->_properties = array();
			$this->_currentProperties = array();
			
			if (!$this->isEnum() && !$this->isArray())
			{
				$reflectClass = new ReflectionClass($this->_type);
				$classesHierarchy = array();
				$classesHierarchy[] = $reflectClass;
				$parentClass = $reflectClass;
				
				// lets get the class hierarchy so we could order the properties in the right order
				while($parentClass = $parentClass->getParentClass())
				{
					$classesHierarchy[] = $parentClass;
				}
				
				// reverse the hierarchy, top class properties should be first 
				$classesHierarchy = array_reverse($classesHierarchy);
				foreach($classesHierarchy as $currentReflectClass)
				{
					$properties = $currentReflectClass->getProperties(ReflectionProperty::IS_PUBLIC);
					foreach($properties as $property)
					{
						if ($property->getDeclaringClass() == $currentReflectClass) // only properties defined in the current class, ignore the inherited
						{
							$name = $property->name;
							$docComment = $property->getDocComment();
							$parsedDocComment = new KalturaDocCommentParser( $docComment );
							if ($parsedDocComment->varType)
							{
								$prop = new KalturaPropertyInfo($parsedDocComment->varType, $name);
								
								if ($parsedDocComment->readOnly)
									$prop->setReadOnly(true);
								
								if ($parsedDocComment->insertOnly)
									$prop->setInsertOnly(true);
									
								$this->_properties[] = $prop;
								
								if ($property->getDeclaringClass() == $reflectClass) // store current class properties
								{
								     $this->_currentProperties[] = $prop;   
								}
							}
							
							if ($parsedDocComment->description)
								$prop->setDescription($parsedDocComment->description);
								
							if ($parsedDocComment->filter)
								$prop->setFilters($parsedDocComment->filter);
						}
					}
				}
				
				$reflectClass = null;
			}
		}
		
		return $this->_properties;
	}
	
	/**
	 * Return a type reflector for the parent class (null if none) 
	 *
	 * @return KalturaTypeReflector
	 */
	public function getParentTypeReflector()
	{
	    $reflectClass = new ReflectionClass($this->_type);
	    $parentClass = $reflectClass->getParentClass();
	    $parentClassName = $parentClass->getName();
	    if (!in_array($parentClassName, array("KalturaObject", "KalturaEnum", "KalturaStringEnum", "KalturaTypedArray"))) // from the api point of view, those objects are ignored
            return new KalturaTypeReflector($parentClass->getName());
	    else
	        return null;
	}
	
	/**
	 * Return only the properties defined in the current class
	 *
	 * @return array
	 */
	public function getCurrentProperties()
	{
		if ($this->_currentProperties === null)
		{
		    $this->getProperties();
		}
		
		return $this->_currentProperties;
	}
	
	/**
	 * Returns the enum constants
	 *
	 * @return array
	 */
	public function getConstants()
	{
		if ($this->_constants === null)
		{
			$this->_constants = array();
			
			if ($this->isEnum() || $this->isStringEnum())
			{
				$reflectClass = new ReflectionClass($this->_type);
				$constantsDescription = array();
				if ($reflectClass->hasMethod("getDescription"))
					$constantsDescription = $reflectClass->getMethod("getDescription")->invoke($this->_instance);
				$contants = $reflectClass->getConstants();
				foreach($contants as $enum => $value)
				{
					if ($this->isEnum())
						$prop = new KalturaPropertyInfo("int", $enum);
					else
						$prop = new KalturaPropertyInfo("string", $enum);
						
					if (array_key_exists($value, $constantsDescription))
						$prop->setDescription($constantsDescription[$value]);
					$prop->setDefaultValue($value);
					$this->_constants[] = $prop;
				}
			}
		}
		
		return $this->_constants;
	}
	
	/**
	 * Returns true when the type is (for what we know) an enum
	 *
	 * @return boolean
	 */
	public function isEnum()
	{
		if ($this->_isEnum === null)
		{
			if ($this->_instance instanceof KalturaEnum)
				$this->_isEnum = true;
			else
				$this->_isEnum = false;
		}
			
		return $this->_isEnum; 
	}
	
	/**
	 * Returns true when the type is (for what we know) an enum
	 *
	 * @return boolean
	 */
	public function isStringEnum()
	{
		if ($this->_isStringEnum === null)
		{
			if ($this->_instance instanceof KalturaStringEnum)
				$this->_isStringEnum = true;
			else
				$this->_isStringEnum = false;
		}
			
		return $this->_isStringEnum; 
	}
	
	
	/**
	 * Returns true when the type is (for what we know) an array
	 *
	 * @return boolean
	 */
	public function isArray()
	{
		if ($this->_isArray === null)
		{
			if ($this->_instance instanceof KalturaTypedArray)
				$this->_isArray = true;
			else
				$this->_isArray = false;
		}
			
		return $this->_isArray;
	}
	
	/**
	 * When reflecting an array, returns the type of the array as string
	 *
	 * @return string
	 */
	public function getArrayType()
	{
		if ($this->isArray())
		{
			return $this->_instance->getType(); 
		}
		return null;
	}
	
	public function setDescription($desc)
	{
		$this->_description = $desc;
	}
	
	public function getDescription()
	{
		return $this->_description;
	}	
	
	/**
	 * Checks whether the enum value is valid for the reflected enum 
	 *
	 * @param mixed $value
	 * @return boolean
	 */
	public function checkEnumValue($value)
	{
		if (!$this->isEnum())
			return false;
			
		$this->getConstants();
		
		foreach($this->_constants as $constValue)
		{
			if ((int)$constValue->getDefaultValue() === (int)$value)
			{
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Checks whether the string enum value is valid for the reflected string enum 
	 *
	 * @param mixed $value
	 * @return boolean
	 */
	public function checkStringEnumValue($value)
	{
		if (!$this->isStringEnum())
			return false;
			
		$this->getConstants();
		
		foreach($this->_constants as $constValue)
		{
			if ((string)$constValue->getDefaultValue() === (string)$value)
			{
				return true;
			}
		}
		return false;
	}
	
	/**
	 * @param string $class
	 * @return boolean
	 */
	public function isParentOf($class)
	{
	    if (!class_exists($class))
	        return false;
	        
	    $possibleReflectionClass = new ReflectionClass($class);
        return $possibleReflectionClass->isSubclassOf(new ReflectionClass($this->_type));
	}
	
	public function isFilterable()
	{
		$reflectionClass = new ReflectionClass($this->_type);
		return $reflectionClass->implementsInterface("IFilterable");
	}
	
	public function getInstance()
	{
		return $this->_instance;
	}
}