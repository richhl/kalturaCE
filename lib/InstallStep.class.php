<?php

/**
 * Defines an installation step
 */
abstract class InstallStep
{
	/**
	 * Installation texts
	 * @var string[]
	 */
	protected $texts;
	
	/**
	 * Abstract function - must be implemented in extending classes.
	 * Main function that should be executed for current installation step.
	 */
	public abstract function install();

	/**
	 * Abstract function - must be implemented in extending classes.
	 * Prepare the system for a retrying current installation step.
	 * @return boolean must return true/false whether retying is premitted or not.
	 */
	public abstract function prepareForRetry();
	
	/**
	 * Construct a new InstallStep object
	 * @param string[] $texts installation texts
	 */
	public function __construct($texts = null)
	{
		$this->texts  = $texts;
	}
	
	/**
	 * Text that should be displayed before current installation step.
	 */
	public function startMsg()
	{
		$start_str = '____________________________________________________________'.PHP_EOL.PHP_EOL;
		$start_str .= $this->getTextFor('step_start');
		return $start_str;
	}
	
	/**
	 * Text that should be displayed after current installation step.
	 */
	public function successMsg()
	{
		return $this->getTextFor('step_success');
	}
			
	/**
	 * Returns the text defined for $key in $this->texts
	 * @param string $key key name for desired text
	 * @return string desired text, or 'false' if not found
	 */
	protected function getTextFor($key)
	{
		if (isset($this->texts[$key])) {
			return $this->texts[$key];
		}
		else {
			return false;
		}
	}

	/**
	 * Return a new ErrorObject, with current class name as the error step.
	 * @param string $code error code
	 * @param string $description error description
	 * @param string $data additional error data
	 */
	protected function newError($code, $description, $data = null)
	{
		return new ErrorObject(get_class($this), $code, $description, $data);
	}
	
	/**
	 * Add current class name to given error's step
	 * @param ErrorObject $error
	 */
	protected function addStepToError(ErrorObject &$error)
	{
		$error->setStep(get_class($this).' - '.$error->getStep());
	}

}