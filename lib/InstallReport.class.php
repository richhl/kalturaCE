<?php


class InstallReport
{
	
	/** 
	 * Installation event data
	 * @var string[]
	 */
	private $install_event;
	
	/**
	 * Additional installation event data that is sent via POST
	 * @var string[]
	 */
	private $install_event_post;
	
	/**
	 * Should the report be sent to kaltura
	 * @var boolean true/false
	 */
	private $should_report;
	
	/**
	 * Log file to write to
	 * @var string file path
	 */
	private $log_file;
	

	/**
	 * Construct a new InstallReport object
	 * @param boolean $should_report
	 * @param string $log_file log file name
	 * @param string $admin_email admin email
	 */
	public function __construct($should_report, $log_file, $admin_email)
	{	
		$this->should_report = $should_report;
		$this->log_file = $log_file;
		$this->install_event = array();
		$this->install_event_post = array();
		$this->install_event['email'] = $admin_email;
		$this->install_event['client_type'] = 'PHP CLI';
		$this->install_event['server_ip'] = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : null;
		$this->install_event['host_name'] = php_uname('n');
		$this->install_event['operating_system'] = php_uname('s');
		$this->install_event['architecture'] = php_uname('m');
		$this->install_event['php_version'] = phpversion();
		$this->install_event['package_version'] = myConf::get('KALTURA_VERSION');
	}
	
	
	/**
	 * Report a new event (writing to log + send to kaltura if needed)
	 * @param ErrorObject $error
	 * @return true/false according to success
	 */
	public function reportEvent($error)
	{		
		$event_post = array();
		
		// add specific error data
		$this->install_event['step'] = $error->getStep();
		$this->install_event['code'] = $error->getCode();
		$event_post['description'] = $error->getDescription();
		$event_post['data'] = 'Stack trace:'.PHP_EOL.$error->getStackTrace().PHP_EOL.PHP_EOL.'Additonal data:'.PHP_EOL.$error->getData();
		
		// write to log
		$this->logEvent($error);
		
		// send error report to kaltura
		if ($this->should_report) {
			try {
				$this->sendReport($this->install_event, $event_post);
			}
			catch (Exception $e) {
				// report wasn't properly sent
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Send current event to kaltura
	 */
	private function sendReport($event, $event_post)
	{
		// create a new cURL resource
		$ch = curl_init();
		
		$url = INSTALL_REPORT_URL;
		$url .= '?' . http_build_query($event);
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
        curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $event_post);
        
		// grab URL and pass it to the browser
		$result = curl_exec($ch);
		if (!$result) {
			$error = PHP_EOL.'CURL error - '.curl_error($ch).PHP_EOL;
			file_put_contents($this->log_file, $error, FILE_APPEND);
		}
		
		// close cURL resource, and free up system resources
		curl_close($ch);
	}
	
	
	/**
	 * Write system data to log file
	 */
	private function logSystemData()
	{
		$log = PHP_EOL.PHP_EOL;
		$log .= 'Admin Email: '.$this->install_event['email'].PHP_EOL;
		$log .= 'Client Type: '.$this->install_event['client_type'].PHP_EOL;
		$log .= 'Server IP: '.$this->install_event['server_ip'].PHP_EOL;
		$log .= 'Host name: '.$this->install_event['host_name'].PHP_EOL;
		$log .= 'OS: '.$this->install_event['operating_system'].PHP_EOL;
		$log .= 'Architecture: '.$this->install_event['architecture'].PHP_EOL;
		$log .= 'PHP version: '.$this->install_event['php_version'].PHP_EOL;
		$log .= 'Package version: '.$this->install_event['package_version'].PHP_EOL;
		$log .= PHP_EOL.PHP_EOL;
		file_put_contents($this->log_file, $log, FILE_APPEND);
	}
	
	/**
	 * Write event data to log file
	 * @param ErrorObject $event
	 */
	private function logEvent($event)
	{
		$log = '[TIME: '.time().'] '.$event->getStep().' - '.$event->getCode().PHP_EOL;
		$log .= 'Description:'.PHP_EOL.'		'.$event->getDescription().PHP_EOL;
		$log .= 'Stack Trace:'.PHP_EOL.'		'.$event->getStackTrace().PHP_EOL;
		$log .= 'Data:'.PHP_EOL.'		'.$event->getData().PHP_EOL;		
		$log .= PHP_EOL.'------------------------------------------------'.PHP_EOL;
		file_put_contents($this->log_file, $log, FILE_APPEND);
	}
	
	
	/**
	 * Report installation start + write system data to log file
	 */
	public function reportStart()
	{
		$this->logSystemData();
		$this->reportEvent(new ErrorObject('Install START', 'INSTALL_START', ErrorCodes::INSTALL_START, null));
	}
	
	/**
	 * Report installation finished successfully.
	 */
	public function reportSuccess()
	{
		$this->reportEvent(new ErrorObject('Install SUCCESS', 'INSTALL_SUCCESS', ErrorCodes::INSTALL_SUCCESS, null));
	}
	
	/**
	 * Report installation failed
	 */
	public function reportFailure()
	{
		$this->reportEvent(new ErrorObject('Install FAILED', 'INSTALL_FAILED', ErrorCodes::INSTALL_FAILED, null));
	}
	
	/**
	 * Report when user stopped the installation (chose not to proceed when an error occured)
	 * @param string $step last installation step name
	 */
	public function reportUserStopped($step)
	{
		$this->reportEvent(new ErrorObject($step, 'USER_STOPPED', ErrorCodes::USER_STOPPED, null));
	}
	
	/**
	 * Report installation failed because a step cannot be retried.
	 * @param string $step installation step name
	 */
	public function reportCantRetry($step)
	{
		$this->reportEvent(new ErrorObject($step, 'CANT_RETRY', ErrorCodes::CANT_RETRY, null));
	}
	
	/**
	 * Report an error
	 * @param ErrorObject $error
	 */
	public function reportError(ErrorObject $error)
	{
		$this->reportEvent($error);
	}

		
}