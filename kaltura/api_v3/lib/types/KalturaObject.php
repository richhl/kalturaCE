<?php 
/**
 * @package api
 * @subpackage objects
 */
class KalturaObject 
{
	protected function getReadOnly ()
	{
		
	}
	
	// TODO - get the set of properties from the annotations
	protected function getPropertiresForField ( $field )
	{
		
	}
	
	protected function getMapBetweenObjects ( )
	{
		return array();
	}
		

	public function fromObject ( $source_object  )
	{
		foreach ( $this->getMapBetweenObjects() as $this_prop => $object_prop )
		{
//	echo "Mapping $this_prop => $entry_prop<br>";
			if ( is_numeric( $this_prop) ) $this_prop = $object_prop;
//	echo "setting  $this_prop => $entry_prop<br>";
			$this->$this_prop = call_user_func(array ( $source_object ,"get{$object_prop}"  ) );
		}
	}
	
	public function fromArray ( $source_array )
	{
		foreach ( $this->getMapBetweenObjects() as $this_prop => $object_prop )
		{
			if ( is_numeric( $this_prop ) ) $this_prop = $object_prop;
			$this->$this_prop = $source_array[$object_prop];
		}
	}
	
	public function toObject ( $object_to_fill , $props_to_skip = array() )
	{
		foreach ( $this->getMapBetweenObjects() as $this_prop => $object_prop )
		{
		 	if ( is_numeric( $this_prop) ) $this_prop = $object_prop;
			if (in_array($this_prop, $props_to_skip)) continue;
		 	call_user_func_array( array ( $object_to_fill ,"set{$object_prop}"  ) , array ($this->$this_prop ) );
		 }		
		return $object_to_fill;		
	}
	
	public function toUpdatableObject ( $object_to_fill , $props_to_skip = array() )
	{
		$this->validateForUpdate(); // will check that not updatable properties are not set 
		
		foreach($this->getMapBetweenObjects() as $this_prop => $object_prop)
		{
		 	if (is_numeric($this_prop)) 
		 		$this_prop = $object_prop;
			if (in_array($this_prop, $props_to_skip)) 
				continue;
				
			if ($this->$this_prop !== null)
		 		call_user_func_array(array($object_to_fill ,"set{$object_prop}"), array($this->$this_prop));
		}
		return $object_to_fill;		
	}
	
	public function validatePropertyNotNull($propertyName)
	{
		if (!property_exists($this, $propertyName) || $this->$propertyName === null)
		{
			throw new KalturaAPIException(KalturaErrors::PROPERTY_VALIDATION_CANNOT_BE_NULL, $this->getFormattedPropertyNameWithClassName($propertyName));
		}
	}
	
	public function validatePropertyMinLength($propertyName, $minLength)
	{
		$this->validatePropertyNotNull($propertyName);
		if (strlen($this->$propertyName) < $minLength)
			throw new KalturaAPIException(KalturaErrors::PROPERTY_VALIDATION_MIN_LENGTH, $this->getFormattedPropertyNameWithClassName($propertyName), $minLength);
	}
	
	public function validatePropertyMaxLength($propertyName, $maxLength)
	{
		$this->validatePropertyNotNull($propertyName);
		if (strlen($this->$propertyName) > $maxLength)
			throw new KalturaAPIException(KalturaErrors::PROPERTY_VALIDATION_MAX_LENGTH, $this->getFormattedPropertyNameWithClassName($propertyName), $maxLength);
	}
	
	public function validatePropertyMinMaxLength($propertyName, $minLength, $maxLength)
	{
		$this->validatePropertyMinLength($propertyName, $minLength);
		$this->validatePropertyMaxLength($propertyName, $maxLength);
	}
	
	public function getFormattedPropertyNameWithClassName($propertyName)
	{
		return get_class($this) . "::" . $propertyName;
	}
	
	public function validateForUpdate()
	{
		$updatableProperties = array();
		$reflector = new KalturaTypeReflector(get_class($this));
		$properties = $reflector->getProperties();
		
		foreach($properties as $property)
		{
			$propertyName = $property->getName();
			if ($property->isReadOnly() || $property->isInsertOnly())
			{
				if ($this->$propertyName !== null)
					throw new KalturaAPIException(KalturaErrors::PROPERTY_VALIDATION_NOT_UPDATABLE, $this->getFormattedPropertyNameWithClassName($propertyName));
			}
		}
		
		return $updatableProperties;
	}
}