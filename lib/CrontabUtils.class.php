<?php
 
class CrontabUtils {
	

	var $crontab = '/usr/bin/crontab';
	
	var $destination = '/tmp/kalcron';

	var $jobs = array();
	
	
	
	public function __construct()
	{
	}
	

	public function addJob($job, $timeCode) {
		$this->jobs[] =	$timeCode .' '.$job;
	}
	
	
	
	
	public function activate($user = null) {
		$contents  = implode(PHP_EOL, $this->jobs);
		$contents .= PHP_EOL;
		
		// add old jobs
		@exec($this->crontab.' -l 2>&1', $output);
		if ($output && is_array($output)) {
			foreach ($output as $job) {
				$contents .= $job.PHP_EOL;
			}
		}
		
		if ($user) {
			$user_cmd = "-u $user ";
		}
	
		
		if (is_file($this->destination)) {
			FileUtils::recursiveDelete($this->destination);
		}
		
		if(is_writable($this->destination) || !file_exists($this->destination)){
			file_put_contents($this->destination, $contents, LOCK_EX);
			$result = @exec($this->crontab." $user_cmd".$this->destination.';');
			return (trim($result) == '');
		}
		
		return false;
	}
	

}
