<?php

class ErrorObject
{
	private $step;
	private $error_code;
	private $description;
	private $data;
	private $stack_trace;
	
	public function __construct($step, $error_code, $description, $data = null)
	{
		$this->step = $step;
		$this->error_code = $error_code;
		$this->description = $description;
		$this->data = $data;
		$this->stack_trace = self::debug_string_backtrace();
	}
	

	public function getStep()
	{
		return $this->step;
	}
	
	public function setStep($step)
	{
		$this->step = $step;
	}
	
	public function getCode()
	{
		return $this->error_code;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function getData()
	{
		return $this->data;
	}
	
	public function getStackTrace()
	{
		return $this->stack_trace;
	}
	
	public static function isErrorObject($object)
	{
		return is_object($object) && (get_class($object) == 'ErrorObject');
	}
	
	private static function debug_string_backtrace()
	{ 
        ob_start(); 
        debug_print_backtrace(); 
        $trace = ob_get_contents(); 
        ob_end_clean(); 
        return $trace; 
    } 
	
	
}