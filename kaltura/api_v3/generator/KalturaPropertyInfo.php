<?php
class KalturaPropertyInfo
{
	private $_type;
	private $_name;
	private $_defaultValue;
	private $_typeReflector;
	private $_arrayTypeReflector;
	private $_readOnly = false;
	private $_insertOnly = false;
	private $_description;
	
	public function KalturaPropertyInfo($type, $name)
	{
		$this->_type = $type;
		$this->_name = $name;
	}
	
	public function setType($type)
	{
		$this->_type = $type;
	}
	
	public function getType()
	{
		return $this->_type;
	}
	
	public function setName($name)
	{
		$this->_name = $name;
	}
	
	public function getName()
	{
		return $this->_name;
	}

	public function setDefaultValue($value)
	{
		$this->_defaultValue = $value;
	}
	
	public function getDefaultValue()
	{
		return $this->_defaultValue;
	}
	
	public function getTypeReflector()
	{
		if ($this->_typeReflector === null)
		{
			if (!$this->isSimpleType())
				$this->_typeReflector = new KalturaTypeReflector($this->_type);
		}
		
		return $this->_typeReflector;
	}
	
	public function getArrayTypeReflector()
	{
		if ($this->_arrayTypeReflector === null)
		{
			if (!$this->isSimpleType())
				$this->_arrayTypeReflector = new KalturaTypeReflector($this->getArrayType());
		}
		
		return $this->_arrayTypeReflector;
	}
	
	public function isSimpleType()
	{
		$simpleTypes = array("int", "string", "bool", "float");
		return in_array($this->_type, $simpleTypes);
	}
	
	public function isComplexType()
	{
		return !$this->isSimpleType();
	}
	
	public function isEnum()
	{
		$this->getTypeReflector();
		if ($this->_typeReflector)
			return $this->_typeReflector->isEnum();
		else
			return false;
	}
	
	public function isArray()
	{
		$this->getTypeReflector();
		if ($this->_typeReflector)
			return $this->_typeReflector->isArray();
		else
			return false;
	}
	
	public function getArrayType()
	{
		$this->getTypeReflector();
		if ($this->_typeReflector)
			return $this->_typeReflector->getArrayType();
		else
			return false;
	}
	
	public function setReadOnly($value)
	{
		$this->_readOnly = $value;
	}
	
	public function isReadOnly()
	{
		return $this->_readOnly;
	}
	
	public function setInsertOnly($value)
	{
		$this->_insertOnly = $value;
	}
	
	public function isInsertOnly()
	{
		return $this->_insertOnly;
	}
	
	public function setDescription($desc)
	{
		$this->_description = $desc;
	}
	
	public function getDescription()
	{
		return $this->_description;
	}	
}