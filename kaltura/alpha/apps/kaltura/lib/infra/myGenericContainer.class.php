<?php
class myGenericContainer
{
	private $map = null;
	
	public function myGenericContainer ( $map )
	{
		$this->map = $map;
	}
	
	public function getRequestParameter( $param , $default_value = null  )
	{
		$val = @$this->map[$param];
		if ( $val == null )
			return $default_value;
		return $val;
	}
}
?>