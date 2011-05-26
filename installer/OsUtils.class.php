<?php

/*
* This is a static OS utilities class
*/
class OsUtils {
	const WINDOWS_OS = 'Windows';
	const LINUX_OS   = 'linux';

	// returns true if the user is root, false otherwise
	public static function verifyRootUser() {
		@exec('id -u', $output, $result);
		logMessage(L_INFO, "User: $output");
		return (isset($output[0]) && $output[0] == '0' && $result == 0);
	}

	// returns true if the OS is linux, false otherwise
	public static function verifyOS() {
		logMessage(L_INFO, "OS: ".OsUtils::getOsName());
		return (OsUtils::getOsName() === OsUtils::LINUX_OS);
	}
	
	// returns the computer hostname if found, 'unknown' if not found
	public static function getComputerName() {
		if(isset($_ENV['COMPUTERNAME'])) {
			logMessage(L_INFO, "Host name: ".$_ENV['COMPUTERNAME']);
	    	return $_ENV['COMPUTERNAME'];
		} else if (isset($_ENV['HOSTNAME'])) {
			logMessage(L_INFO, "Host name: ".$_ENV['HOSTNAME']);
			return $_ENV['HOSTNAME'];
		} else if (function_exists('gethostname')) {
			logMessage(L_INFO, "Host name: ".gethostname());
			return gethostname(); 
		} else {
			logMessage(L_WARNING, "Host name unkown");
			return 'unknown';
		}
	}	
	
	// returns the OS name or empty string if not recognized
	public static function getOsName() {		
		logMessage(L_INFO, "OS: ".PHP_OS);
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return self::WINDOWS_OS;
		} else if (strtoupper(substr(PHP_OS, 0, 5)) === 'LINUX') {
			return self::LINUX_OS;
		} else {
			logMessage(L_WARNING, "OS not recognized: ".PHP_OS);
			return "";
		}
	}
	
	// returns the linux distribution
	public static function getOsLsb() {		
		$dist = OsUtils::executeReturnOutput("lsb_release -d");		
		$dist = implode('\n', $dist);
		logMessage(L_INFO, "Distribution: ".$dist);
		return $dist;
	}
	
	// returns '32bit'/'64bit' according to current system architecture - if not found, default is 32bit
	public static function getSystemArchitecture() {		
		$arch = php_uname('m');
		logMessage(L_INFO, "OS architecture: ".$arch);
		if ($arch && (stristr($arch, 'x86_64') || stristr($arch, 'amd64'))) {
			return '64bit';
		} else {
			// stristr($arch, 'i386') || stristr($arch, 'i486') || stristr($arch, 'i586') || stristr($arch, 'i686') ||
			// return 32bit as default when not recognized
			return '32bit';		
		}
	}

	// appends $newdata to the file named $filename
	public static function appendFile($filename, $newdata) {
		$f=fopen($filename,"a");
		fwrite($f,$newdata);
		fclose($f);  
	}
      			
    // Write $data to $filename
    public static function writeFile($filename, $data) {   	
    	$fh = fopen($filename, 'w');
		if (!$fh) return false; // File errors cannot be logged because it could cause an infinite loop			
		if (!fwrite($fh, $data)) return false; // File errors cannot be logged because it could cause an infinite loop
		fclose($fh);
		return true;
    }      
	
	// Write $config to ini $filename key = value
	public static function writeConfigToFile($config, $filename) {
		logMessage(L_INFO, "Writing config to file $filename");
		$data = '';
		foreach ($config as $key => $value) {
			$data = $data . $key.' = '.$value.PHP_EOL;
		}
		return OsUtils::writeFile($filename, $data);
	}

	// executes the shell $commands and returns true/false according to the execution return value
	public static function execute($command) {
		logMessage(L_INFO, "Executing $command");
		@exec($command . ' 2>&1', $output, $return_var);
		if ($return_var === 0) {
			return true;
		} else {
			logMessage(L_ERROR, "Executing command failed: $command");	
			return false;
		}
	}
	
	public static function executeInBackground($command) {
		logMessage(L_INFO, "Executing in background $command");
		@exec($command. ' > /dev/null 2>&1 &');
	}

	// Execute 'which' on each of the given $file_name (array or string) and returns the first one found (null if not found)
	public static function findBinary($file_name) {			
		if (!is_array($file_name)) {
			$file_name = array ($file_name);
		}
		
		foreach ($file_name as $file) {
			$which_path = OsUtils::executeReturnOutput("which $file");
			if (isset($which_path[0]) && (trim($which_path[0]) != '') && (substr($which_path[0],0,1) == "/")) {
				return $which_path[0];
			}
		}
		
		return null;
	}
	
	// execute the given $cmd, returning the output
	public static function executeReturnOutput($cmd) {
		// 2>&1 is needed so the output will not display on the screen
		@exec($cmd . ' 2>&1', $output);
		return $output;
	}

	// full copy $source to $target and return true/false according to success
	public static function fullCopy($source, $target) {
		return self::execute("cp -r $source $target");
	}
	
	// recursive delete the $path and return true/false according to success
	public static function recursiveDelete($path) {
		return self::execute("rm -rf $path");
    }
	
	// execute chmod with the given $chmod command and return true/false according to success
	public static function chmod($chmod) {
		return self::execute("chmod $chmod");	
	}
}