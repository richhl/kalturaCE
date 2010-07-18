<?php


class InstallReport
{
	private $install_event;
	private $install_event_post;
	private $should_report;
	private $log_file;
	

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
	
	
	public function reportEvent($error)
	{		
		
		// add specific error data
		$this->install_event['step'] = $error->getStep();
		$this->install_event['code'] = $error->getCode();
		$this->install_event_post['description'] = $error->getDescription();
		$this->install_event_post['data'] = 'Stack trace:'.PHP_EOL.$error->getStackTrace().PHP_EOL.PHP_EOL.'Additonal data:'.PHP_EOL.$error->getData();
		
		$this->logEvent($error);
		
		// send error report
		if ($this->should_report) {
			try {
				$this->sendReport();
			}
			catch (Exception $e) {
				// report wasn't properly sent
				return false;
			}
		}
		
		return true;
	}
	
	
	private function sendReport()
	{
		// create a new cURL resource
		$ch = curl_init();
		
		$url = INSTALL_REPORT_URL;
		$url .= '?' . http_build_query($this->install_event);
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
        curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->install_event_post);
        
		// grab URL and pass it to the browser
		$result = curl_exec($ch);
		if (!$result) {
			$error = PHP_EOL.'CURL error - '.curl_error($ch).PHP_EOL;
			file_put_contents($this->log_file, $error, FILE_APPEND);
		}
		
		// close cURL resource, and free up system resources
		curl_close($ch);
	}
	
	
	private function logSystemData($event)
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
	
	private function logEvent($event)
	{
		$log = '[TIME: '.time().'] '.$event->getStep().' - '.$event->getCode().PHP_EOL;
		$log .= 'Description:'.PHP_EOL.'		'.$event->getDescription().PHP_EOL;
		$log .= 'Stack Trace:'.PHP_EOL.'		'.$event->getStackTrace().PHP_EOL;
		$log .= 'Data:'.PHP_EOL.'		'.$event->getData().PHP_EOL;		
		$log .= PHP_EOL.'------------------------------------------------'.PHP_EOL;
		file_put_contents($this->log_file, $log, FILE_APPEND);
	}
	
	
	public function reportStart()
	{
		$this->logSystemData($this->install_event);
		$this->reportEvent(new ErrorObject('Install START', 'INSTALL_START', ErrorCodes::INSTALL_START, null));
	}
	
	
	public function reportSuccess()
	{
		$this->reportEvent(new ErrorObject('Install SUCCESS', 'INSTALL_SUCCESS', ErrorCodes::INSTALL_SUCCESS, null));
	}
	
	public function reportFailure()
	{
		$this->reportEvent(new ErrorObject('Install FAILED', 'INSTALL_FAILED', ErrorCodes::INSTALL_FAILED, null));
	}
	
	
	public function reportUserStopped($step)
	{
		$this->reportEvent(new ErrorObject($step, 'USER_STOPPED', ErrorCodes::USER_STOPPED, null));
	}
	
	
	public function reportCantRetry($step)
	{
		$this->reportEvent(new ErrorObject($step, 'CANT_RETRY', ErrorCodes::CANT_RETRY, null));
	}
	
	
	public function reportError(ErrorObject $error)
	{
		$this->reportEvent($error);
	}

		
}