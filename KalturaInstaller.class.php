<?php

include_once(dirname(__FILE__).'/config/includes.php');

class KalturaInstaller
{
	/**
	 * steps to perform during installation
	 * @var string
	 */
	private $steps;
	
	/**
	 * global installation texts
	 * @var array[string]
	 */
	private $global_texts;
	
	/**
	 * installation error reporter
	 * @var InstallReport
	 */
	private $error_report;
	
	/**
	 * installtion steps that were previously done
	 * @var array[string]
	 */
	private $done_steps;
	
	/**
	 * config collect step was performed or not
	 * @var boolean
	 */
	private $config_collected;
	
	/**
	 * default constructor
	 * @param array[string] $steps
	 */
	public function __construct($steps)
	{
		$this->steps = $steps;
		$this->global_texts = InstallerTexts::getTextsForStep('global');
		$this->done_steps = array();
		myConf::loadFromFile(INSTALL_CONFIG_FILE);
		$this->config_collected = false;
	}
	
	/**
	 * load an insallation step object
	 * @param string $step step name
	 */
	private function loadStep($step)
	{
		$step_name = $step.'Step';
		$step_file = STEPS_DIR.$step_name.'.class.php';
			
		$error = false;
		if (!is_file($step_file)) {
			$error = new ErrorObject('MAIN', 'STEP_FILE_NOT_FOUND', sprintf(ErrorCodes::STEP_FILE_NOT_FOUND, $step_file));
		}
		if (!include_once($step_file)) {
			$error = new ErrorObject('MAIN', 'CANT_INCLUDE_STEP_FILE', sprintf(ErrorCodes::CANT_INCLUDE_STEP_FILE, $step_file));
		}
		if (!class_exists($step_name)) {
			$error = new ErrorObject('MAIN', 'STEP_CLASS_NOT_EXISTS', sprintf(ErrorCodes::STEP_CLASS_NOT_EXISTS, $step_file));
		}
		
		if ($error) {
			return $error;	
		}
		
		$step_obj = new $step_name(InstallerTexts::getTextsForStep($step_name));	
		
		if (!$step_obj) {
			$error = new ErrorObject('MAIN', 'INSTALL_CORRUPT', sprintf(ErrorCodes::INSTALL_CORRUPT, $step_file));
			echo $error->getDescription().PHP_EOL;
			$this->finishFail();
		}
		
		return $step_obj;
	}
	

	
	private function finishSuccess()
	{
		InstallUtils::simMafteach();
		$this->error_report->reportSuccess();
		$this->postInstallFilesCopy();
		echo sprintf($this->global_texts['install_success'], myConf::get('ADMIN_CONSOLE_ADMIN_MAIL'),
															 myConf::get('ADMIN_CONSOLE_PASSWORD')).PHP_EOL;
	 	echo PHP_EOL.PHP_EOL;
	  	echo sprintf($this->global_texts['after_install_steps'], myConf::get('KALTURA_VIRTUAL_HOST_NAME'),
	  															 myConf::get('BASE_DIR'),
															 	 myConf::get('APACHE_RESTART_COMMAND'),
															 	 myConf::get('KALTURA_VIRTUAL_HOST_NAME')).PHP_EOL;
		$this->sendFinishEmail();
	}
	
	private function sendFinishEmail()
	{
		if (function_exists('mail')) {
			$msg = sprintf($this->global_texts['finish_mail'], myConf::get('KALTURA_VIRTUAL_HOST_NAME'),
															   myConf::get('KALTURA_VIRTUAL_HOST_NAME'),
	  														   myConf::get('ADMIN_CONSOLE_ADMIN_MAIL'),
															   myConf::get('ADMIN_CONSOLE_PASSWORD')).PHP_EOL;
			@mail('TO', 'Kaltura installation settings', $msg);
		}
	}
	
	
	private function finishFail()
	{
		$this->error_report->reportFailure();
		$this->postInstallFilesCopy();
		echo $this->global_texts['install_fail'].PHP_EOL;
		die();
	}
	
	
	private function postInstallFilesCopy()
	{
		// Copy the uninstaller
		$base_dir = myConf::get('BASE_DIR');
		FileUtils::fullCopy(UNINSTALLER_DIR, $base_dir.'/uninstaller');
		FileUtils::fullCopy(LIB_DIR.'FileUtils.class.php', $base_dir.'/uninstaller/FileUtils.class.php');
		FileUtils::fullCopy(LIB_DIR.'DatabaseUtils.class.php', $base_dir.'/uninstaller/DatabaseUtils.class.php');
		FileUtils::fullCopy(LIB_DIR.'InstallUtils.class.php', $base_dir.'/uninstaller/InstallUtils.class.php');
		FileUtils::fullCopy(LIB_DIR.'ErrorObject.class.php', $base_dir.'/uninstaller/ErrorObject.class.php');
		FileUtils::fullCopy(CONFIG_DIR.'error_codes.php', $base_dir.'/uninstaller/error_codes.php');
		myConf::writeToFile($base_dir.'/uninstaller/my_config.ini');
		
		// Copy the root files
		FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_ROOT_FILES, $base_dir);
	}
	
	
	private function offerTryAgain(ErrorObject $error)
	{
		$this->echoError($error);
		return UserInputUtils::getTrueFalse($this->global_texts['offer_try_again'], 'n');
		echo PHP_EOL;
	}
	
	private function offerToRepeat()
	{
		return UserInputUtils::getTrueFalse($this->global_texts['offer_to_repeat'], 'n');
	}
	
	
	private function askToReport()
	{
		// For On-Prem it is mandatory to provide an e-mail, for CE it is optional 
		if ($result = 
				((strcasecmp(myConf::get('KALTURA_VERSION_TYPE'), 'On-Prem') == 0) || 
				 (UserInputUtils::getTrueFalse($this->global_texts['ask_to_report'], 'y')))) {
			$email = UserInputUtils::getInput($this->global_texts['report_email']);
			myConf::set('REPORT_ADMIN_EMAIL', $email);
		}
		if ($result) {
			myConf::set('TRACK_KDPWRAPPER', 'true');
		}
		else {
			myConf::set('TRACK_KDPWRAPPER', 'false');
		}
		return $result;	
		
	}
	
	
	private function echoError($error)
	{
		echo sprintf($this->global_texts['error_occured'], $error->getDescription());
		echo PHP_EOL;
	}
	
	private function loadDoneSteps()
	{
		if (is_file(DONE_STEPS)) {
			$data = file_get_contents(DONE_STEPS);
			$this->done_steps = explode(',', $data);
		}
	}
	
	private function addDoneStep($step)
	{
		if (!in_array($step, $this->done_steps)) {
			$this->done_steps[] = $step;
		}
		file_put_contents(DONE_STEPS, $step.',', FILE_APPEND);
	}
	
	
	public function run()
	{
		try {
			$version = parse_ini_file(PACKAGE_DIR.'version.ini');
			myConf::set('KALTURA_VERSION', 'Kaltura '.$version['type'].' '.$version['number']);
			myConf::set('KALTURA_VERSION_TYPE', $version['type']);
		}
		catch (Exception $e) {}
		
		echo PHP_EOL;
		echo $this->global_texts['welcome_msg'].PHP_EOL;
		
		if (!UserInputUtils::getTrueFalse($this->global_texts['proceed_with_install'], 'y')) {
			die('Bye!'.PHP_EOL);
		}		
		
		$this->loadDoneSteps();
	
		$should_report = $this->askToReport();		

		$this->error_report = new InstallReport($should_report, INSTALL_ERROR_LOG, myConf::get('REPORT_ADMIN_EMAIL'));
		$this->error_report->reportStart();

		
		foreach ($this->steps as $step)
		{
			$step_obj = $this->loadStep($step);
			
			if (ErrorObject::isErrorObject($step_obj)) {
				$this->error_report->reportError($error);
				$this->echoError($error);
				echo $this->global_texts['package_corrupt'].PHP_EOL;
				$this->finishFail();
			}
			
			echo PHP_EOL.$step_obj->startMsg().PHP_EOL;
			
			// offer to skip step if already done and new configuration wasn't collected
			if (!$this->config_collected && $step != 'Prerequisites' && in_array($step, $this->done_steps)) {
				if (!$this->offerToRepeat()) {
					echo $this->global_texts['skipping_step'].PHP_EOL;
					continue;
				}
				$step_obj->prepareForRetry();
			}
			
			// install step
			$result = $step_obj->install();
			
			// error with step ?
			if ($result !== true) {
				
				$this->error_report->reportError($result);
								
				$tryAgain = true;
				while ($tryAgain) {
					
					if (!$this->offerTryAgain($result)) {
						$this->error_report->reportUserStopped($step);
						$this->finishFail();
					}
					
					if (!$step_obj->prepareForRetry()) {
						echo $this->global_texts['cant_retry_step'].PHP_EOL;
						$this->error_report->reportCantRetry($step);
						$this->finishFail();
					}
					
					echo $step_obj->startMsg().PHP_EOL;
					$result = $step_obj->install();
					if ($result !== true) {
						$this->error_report->reportError($result);
					}
					
					$tryAgain = $result !== true;
				}
	
			}
				
			$this->addDoneStep($step);
			echo $step_obj->successMsg().PHP_EOL;
			
			if ($step == 'ConfigCollect') {
				$this->config_collected = true;
			}
		}
		
		
		$this->finishSuccess();
		
	}
	

}


