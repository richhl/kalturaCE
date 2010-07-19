<?php
 
class CrontabUtils {
	
	/**
	 * crontab executable
	 * @var string
	 */
	var $crontab = '/usr/bin/crontab';
	
	/**
	 * temporary file to save cron jobs
	 * @var string
	 */
	var $destination = '/tmp/kalcron';

	/**
	 * list of jobs to be added
	 * @var string[]
	 */
	var $jobs = array();
	
	
	public function __construct()
	{
		$this->jobs = null;
		$this->jobs = array();
	}
	
	
	/**
	 * Add a new job
	 * @param string $job script to be executed
	 * @param string $timeCode timecode in crontab syntax
	 */
	public function addJob($job, $timeCode) {
		$this->jobs[] =	$timeCode .' '.$job;
	}
	
	
	
	/**
	 * Append all added jobs to the current crontab jobs list
	 * @param string $user name of user that should run all cronjobs
	 * @return true/false according to success
	 */
	public function activate($user = null) {
		$this->destination = $this->destination . $user;
		$user_cmd = '';
		$contents  = implode(PHP_EOL, $this->jobs);
		$contents .= PHP_EOL;
		
		if ($user) {
			$user_cmd = "-u $user";
		}	
		
		// add old jobs
		@exec($this->crontab.' '.$user_cmd.' -l 2>&1', $output);
		if ($output && is_array($output) && isset($output[0])) {
			if (strstr($output[0], 'no cron') === false) {
				foreach ($output as $job) {
					$contents .= $job.PHP_EOL;
				}
			}
		}
				
		if (is_file($this->destination)) {
			FileUtils::recursiveDelete($this->destination);
		}
		
		if(is_writable($this->destination) || !file_exists($this->destination)){
			file_put_contents($this->destination, $contents, LOCK_EX);
			$result = @exec($this->crontab.' '.$user_cmd.' '.$this->destination.';');
			return (trim($result) == '');
		}
		
		return false;
	}
	

}
