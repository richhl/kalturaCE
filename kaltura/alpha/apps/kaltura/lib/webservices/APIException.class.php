<?php
class APIException extends Exception
{
	public $api_code = null;
	public $extra_data = null;
	
	public function APIException ( )
	{
		$args = func_get_args();
		
		if ( $args && count ( $args) > 0 )
		{
			$this->api_code = $args[0];
	//		array_shift( $args );
			$this->extra_data = $args;
		}
	}
}
?>