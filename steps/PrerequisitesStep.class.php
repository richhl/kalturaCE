<?php


/**
 * Checking prerequisites as defined in 'config/prerequisites.php'
 */
class PrerequisitesStep extends InstallStep
{
	/**
	 * Problems found (missing prerequisites)
	 * @var string[]
	 */
	private $problems = array();
	
	/**
	 * mysqli php extensions exists or not (needed to check database related prerequisites) 
	 * @var boolean
	 */
	private $mysqli_ext_exists = false;

	
	/**
	 * Main
	 */
	public function install()
	{
		$this->problems = array();
		
		$os = InstallUtils::getOsName();
		if ($os != InstallUtils::LINUX_OS) {
			return new ErrorObject('PrerequisitesStep', 'OS_NOT_SUPPORTED', sprintf(ErrorCodes::OS_NOT_SUPPORTED, $os));
		}
		
		// collect configurations needed for prerequisites check (will also be used later during installation)
		$this->configCollect();
		
		echo PHP_EOL.$this->getTextFor('check_start').PHP_EOL;
		
		// check prerequisites
		$result = $this->checkRootUser();
		if ($result === true) { $result = $this->checkVersions(); }
		if ($result === true) { $result = $this->checkBins(); }
		if ($result === true) { $result = $this->checkPhpExtensions(); }
		if ($result === true) { $result = $this->checkApacheModules(); }
		if ($result === true) { $result = $this->checkEtlUser(); }
		if ($result === true) { $result = $this->checkFiles(); }
		if ($result === true) { $result = $this->checkDirs(); }
		
		if ($this->mysqli_ext_exists) {
			if ($result === true) { $result = $this->checkVersions_mySql(); }
			if ($result === true) { $result = $this->checkDatabases(); }
			if ($result === true) { $result = $this->checkMySqlSettings(); }
		}
		else {
			$this->problems['Product versions:'][] = sprintf($this->getTextFor('no_mysqli_ext'), 'mySQL version');
			$this->problems['Databases:'][] = sprintf($this->getTextFor('no_mysqli_ext'), 'database prerequisites');
			$this->problems['mySQL settings:'][] =sprintf($this->getTextFor('no_mysqli_ext'), 'mySQL settings');
		}

		if ($result !== true) {
			$this->addStepToError($result);
			return $result;
		}
		
		if (empty($this->problems)) {
			return true;
		}
		else{	
			// return an ErrorObject with all prerequisites as its description	
			$error_description = PHP_EOL;
			foreach ($this->problems as $title => $items) {
				$error_description .= $title.PHP_EOL;	
				foreach ($items as $item) {
					$error_description .= "  - $item".PHP_EOL;
				}
			}
			return new ErrorObject('PrerequisitesStep', 'MISSING_PREREQUISITES',
				sprintf(ErrorCodes::MISSING_PREREQUISITES, $error_description));			
			
		}
	}
	
		
	public function prepareForRetry()
	{
		// nothing special to do
		return true;
	}
	
	
	/**
	 * Checks that :
	 * 1. User etl exists
	 * 2. /home/dir directory exists
	 */
	private function checkEtlUser()
	{
		if (!is_dir(myConf::get('ETL_HOME_DIR'))) {
			$this->problems['Etl user:'][] = sprintf($this->getTextFor('missing_etl_home'), myConf::get('ETL_HOME_DIR'));	
		}
		@exec('id -u etl', $output, $result);
		if ($result != 0) {
			$this->problems['Etl user:'][] = $this->getTextFor('missing_etl_user');
		}
		return true;
	}
	
	
	/**
	 * Checks that current user is root
	 */
	private function checkRootUser()
	{
		@exec('id -u', $output, $result);
		if (!isset($output[0]) || $output[0] != '0' || $result != 0) {
			$this->problems['Root user:'][] = $this->getTextFor('user_not_root');
		}
		return true;
	}
	
	
	/**
	 * Checks that needed php extensions exist
	 */
	private function checkPhpExtensions()
	{
		foreach (KalturaPrerequisites::$php_extensions as $ext) {
			if (!extension_loaded($ext)) {
				$this->problems['PHP extensions:'][] = sprintf($this->getTextFor('missing_php_ext'), $ext);
			}
			else if ($ext == 'mysqli') {
				$this->mysqli_ext_exists = true;
			}
		}
		return true;
	}
	
	
	/**
	 * Checks that needed binary files exist (by using 'which')
	 */
	private function checkBins()
	{
		foreach (KalturaPrerequisites::$bins as $bin) {
			$path = @exec("which $bin");
			if (trim($path) == '') {
				$this->problems['Bins:'][] = sprintf($this->getTextFor('missing_bin'), $bin);
			}
		}
		return true;
	}
	
	
	/**
	 * Check that needed file paths exist
	 */
	private function checkFiles()
	{
		foreach (KalturaPrerequisites::$files as $file) {
			if (!is_file($file)) {
				$this->problems['Files:'][] = sprintf($this->getTextFor('missing_file'), $file);
			}
		}
		return true;
	}
	
	
	/**
	 * Checks that needed directories exist
	 */
	private function checkDirs()
	{
		foreach (KalturaPrerequisites::$dirs as $dir) {
			if (!is_file($dir)) {
				$this->problems['Directories:'][] = sprintf($this->getTextFor('missing_dir'), $dir);
			}
		}
		return true;
	}
	
	
	/**
	 * Checks that needed databases DO NOT exist
	 */
	private function checkDatabases()
	{
		foreach (KalturaPrerequisites::$databases as $db) {
			$result = DatabaseUtils::dbExists($db, myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), myConf::get('DB1_PORT'));
			if (ErrorObject::isErrorObject($result)) {
				return $result;
			}
			else if ($result === true) {
				$this->problems['Databases:'][] = sprintf($this->getTextFor('db_exists'), $db);
			}
		}
		return true;
	}
	
	
	/**
	 * Checks that needed apache modules exist
	 */
	private function checkApacheModules()
	{
		$apache_cmd = myConf::get('HTTPD_BIN').' -t -D DUMP_MODULES';
		$current_modules = FileUtils::exec($apache_cmd);
				
		foreach (KalturaPrerequisites::$apache_modules as $module) {
			$found = false;
			for ($i=0; !$found && $i<count($current_modules); $i++) {
				if (strpos($current_modules[$i],$module) !== false) {
					$found = true;
				}
			}
			if (!$found) {
				$this->problems['Apache modules:'][] = sprintf($this->getTextFor('missing_apache_module'), $module);
			}
		}
		return true;
	}


	
	/**
	 * Check that mySQL settings are set as required
	 */
	private function checkMySqlSettings()
	{
		$result = DatabaseUtils::connect($link, myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), null, myConf::get('DB1_PORT'));
		if ($result !== true) {
			$this->addStepToError($result);
			return $result;
		}
		foreach (KalturaPrerequisites::$mysql_settings as $key => $value) {
			$result = mysqli_query($link, "SELECT @@$key;");
			if ($result === false) {
				$error = new ErrorObject('checkMySqlSettings', 'CANT_FIND_MYSQL_SETTING',
					sprintf(ErrorCodes::CANT_FIND_MYSQL_SETTING, $key), mysqli_error($link));
				$this->addStepToError($error);
				return $error;
			}
			
			$tmp = '@@'.$key;
			$current = $result->fetch_object()->$tmp;
			if (!$this->compare($current, $value[1], $value[0])) {
				$this->problems['mySQL settings:'][] = sprintf($this->getTextFor('bad_mysql_setting'), $key, $value[0], $value[1]);
			}
		}
		return true;		
	}


	
	/**
	 * Check different product versions
	 */
	private function checkVersions()
	{
		foreach (KalturaPrerequisites::$versions as $module => $version) {
			switch ($module) {
				case 'php':
					$this->checkVersions_php($version);
					break;
				case 'apache':
					$this->checkVersions_apache($version);
					break;
				case 'mysql':
					// will be checked later if mysqli extension exists
					break;
				default :
					$this->problems['Product versions:'][] = $this->getTextFor('unknown_product');
					break;
			}
		}
		return true;
	}
	
	/**
	 * Check PHP version
	 * @param array[] $check
	 */
	private function checkVersions_php($check)
	{
		if (!version_compare(phpversion(), $check[1], $check[0])) {
			$this->problems['Product versions:'][] = sprintf($this->getTextFor('bad_version'), 'PHP', $check[0], $check[1]);
		}
		return true;
	}
	
	/**
	 * Check APACHE version
	 * @param array[] $check
	 */
	private function checkVersions_apache($check)
	{
		//$this->problems['versions'][] = sprintf($this->getTextFor('bad_version'), 'apache', $check[0], $check[1]);
		return true;
	}
	
	/**
	 * Check MYSQL version
	 */
	private function checkVersions_mySql()
	{
		if (!isset(KalturaPrerequisites::$versions['mysql'])) {
			return true;
		}
		
		$check = KalturaPrerequisites::$versions['mysql'];
		
		$result = DatabaseUtils::connect($link, myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), null, myConf::get('DB1_PORT'));
		if ($result !== true) {
			$this->addStepToError($result);
			return $result;
		}

		$key = '@@version';
		$result = mysqli_query($link, "SELECT $key;");
		if ($result === false) {
			$this->problems['Product versions:'][] = sprintf($this->getTextFor('bad_version'), 'mySQL', $check[0], $check[1]);
			$error = new ErrorObject('checkVersions_mySql', 'CANT_FIND_MYSQL_VERSIONS',
					ErrorCodes::CANT_FIND_MYSQL_VERSIONS, mysqli_error($link));
			$this->addStepToError($error);
			return $error;	
		}

		$current = $result->fetch_object()->$key;
		if (!version_compare($current, $check[1], $check[0])) {
			$this->problems['Product versions:'][] = sprintf($this->getTextFor('bad_version'), 'mySQL', $check[0], $check[1]);
		}
		return true;
	}
	
	
	/**
	 * compare numbers according to given operator $op (note: assumes only numbers are passed as $val1 & $val2)
	 * @param string $val1 1st value
	 * @param string $val2 2nd value
	 * @param string $op   operator
	 */
	private function compare($val1, $val2, $op)
	{
		switch ($op) {
			case '=':
				return strtoupper($val1) === strtoupper($val2);
				
			case '>':
				return intval($val1) > intval($val2);
				
			case '>=':
				return intval($val1) >= intval($val2);
				
			case '<':		
				return (intval($val1) < intval($val2));	
				
			case '<=':
				return intval($val1) <= intval($val2);
				
		}
		return false;
	}
	
	  	
  	
  	/**
  	 * Collect configurations needed for checking prerequisites
  	 */
  	private function configCollect()
  	{
  		echo $this->getTextFor('config_collect').PHP_EOL.PHP_EOL;
		
  		// httpd and php binaries
  		$http_bin = UserInputUtils::getPathInput($this->getTextFor('httpd_bin'), true, false, array('apachectl', 'apache2ctl'));
		echo PHP_EOL;
  		myConf::set('HTTPD_BIN', $http_bin);

		$php_bin = UserInputUtils::getPathInput($this->getTextFor('php_bin'), true, false, 'php');
		echo PHP_EOL;
		myConf::set('PHP_BIN', $php_bin);
  		
		// database configurations
  		$db1_host = UserInputUtils::getInput($this->getTextFor('db_host'));
  		echo PHP_EOL;
		if ($db1_host == '') { $db1_host = 'localhost'; }
		
		$db1_port = UserInputUtils::getInput($this->getTextFor('db_port'));
		echo PHP_EOL;
		if ($db1_port == '') { $db1_port = '3306'; }
		
		myConf::set('DB1_HOST', $db1_host);
		myConf::set('DB1_PORT', $db1_port);
		myConf::set('DB1_NAME', 'kaltura');
		myConf::set('DB1_USER', UserInputUtils::getInput($this->getTextFor('db_user')));
		myConf::set('DB1_PASS', UserInputUtils::getInput($this->getTextFor('db_pass')));
		
		// etl home directory
		myConf::set('ETL_HOME_DIR', '/home/etl/');
  	}
  	

  		
	
}
