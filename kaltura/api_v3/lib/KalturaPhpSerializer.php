<?php
class KalturaPhpSerializer
{
	private $_serializedString = "";
	private $_ignoreNull = false;
	
	function KalturaPhpSerializer($ignoreNull)
	{
		$this->_ignoreNull = (bool)$ignoreNull;
	}
	
	function serialize($object)
	{
		if (is_object($object))
		{
		    $object = $this->convertTypedArraysToPhpArrays($object);

			if ($object instanceof Exception)
			{
				$error = array(
					"code" => $object->getCode(),
					"message" => $object->getMessage()
				);
				$this->_serializedString .= serialize($error);
			}
			else if ($object instanceof KalturaTypedArray)
			{
				$array = array();
				foreach($object as $item)
				{
					$array[] = $item;					
				}
				$this->_serializedString .= serialize($array);
			}
			else 
			{
				$this->_serializedString .= serialize($object);
			}
		}
		else 
		{
			$this->_serializedString .= serialize($object);			
		}
	}
	
	function convertTypedArraysToPhpArrays($object)
	{
	    if ($object instanceof KalturaTypedArray)
    	{
    		$array = array();
    		foreach($object as $item)
    		{
    			$array[] = $this->convertTypedArraysToPhpArrays($item);					
    		}
    		return $array;
    	}
    	else 
    	{
    	    foreach($object as $key => $value)
    	    {
    	        $object->$key = $this->convertTypedArraysToPhpArrays($object->$key);
    	    }
    	    return $object;
    	}
	}
	
	function getSerializedData()
	{
		return $this->_serializedString;
	}
}