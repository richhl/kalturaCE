<?php

class ErrorObject
{
	/**
	 * Installation / Packaging step
	 * @var string
	 */
	private $step;
	/**
	 * Error code
	 * @var string
	 */
	private $error_code;
	/**
	 * Error description
	 * @var string
	 */
	private $description;
	/**
	 * Additional data
	 * @var string
	 */
	private $data;
	/**
	 * Stack trace
	 * @var string
	 */
	private $stack_trace;
	
	
	/**
	 * Construct a new ErrorObject object
	 * @param string $step
	 * @param string $error_code
	 * @param string $description
	 * @param string $data
	 */
	public function __construct($step, $error_code, $description, $data = null)
	{
		$this->step = $step;
		$this->error_code = $error_code;
		$this->description = $description;
		$this->data = $data;
		$this->stack_trace = self::debug_string_backtrace();
	}
	
	/**
	 * @return string error step
	 */
	public function getStep()
	{
		return $this->step;
	}
	
	/**
	 * @param string $step
	 */
	public function setStep($step)
	{
		$this->step = $step;
	}
	
	/**
	 * @return string error code
	 */
	public function getCode()
	{
		return $this->error_code;
	}
	
	/**
	 * @return string error description
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * @return string error data
	 */
	public function getData()
	{
		return $this->data;
	}
	
	/**
	 * @return string error stack trace
	 */
	public function getStackTrace()
	{
		return $this->stack_trace;
	}
	
	/**
	 * Checks if the given object is an ErrorObject
	 * @param Object $object object to check
	 * @return boolean true/false
	 */
	public static function isErrorObject($object)
	{
		return is_object($object) && (get_class($object) == 'ErrorObject');
	}
	
	/**
	 * Prints a stack trace.
	 */
	private static function debug_string_backtrace()
	{ 
        ob_start(); 
        debug_print_backtrace(); 
        $trace = ob_get_contents(); 
        ob_end_clean(); 
        return $trace; 
    } 
	
	
}