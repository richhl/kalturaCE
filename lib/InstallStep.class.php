<?php


abstract class InstallStep
{
	protected $texts;
	
	
	public abstract function install();

	public abstract function prepareForRetry();
	
	public function startMsg()
	{
		$start_str = '_____________________________________________________'.PHP_EOL.PHP_EOL;
		$start_str .= $this->getTextFor('step_start');
		return $start_str;
	}
	
	public function successMsg()
	{
		return $this->getTextFor('step_success');
	}
	

	public function __construct($texts = null)
	{
		$this->texts  = $texts;
	}
	
	
	public function canRetry()
	{
		return true;
	}
	
	
	protected function getTextFor($key)
	{
		if (isset($this->texts[$key])) {
			return $this->texts[$key];
		}
		else {
			return false;
		}
	}
	
	protected function getConfigFor($key)
	{
		if (isset($this->config[$key])) {
			return $this->config[$key];
		}
		else {
			return false;
		}
	}
	
		
	
	protected function newError($code, $description, $data = null)
	{
		return new ErrorObject(get_class($this), $code, $description, $data);
	}
	
	
	protected function addStepToError(ErrorObject &$error)
	{
		$error->setStep(get_class($this).' - '.$error->getStep());
	}

}