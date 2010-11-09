<?php

define("FILE_INSTALL_CONFIG", "installer/installation.ini"); // this file contains the definitions of the installation itself
define("APP_SQL_DIR", "/app/deployment/base/sql/"); // this is the relative directory where the base sql files are
define("SYMLINK_SEPARATOR", "^"); // this is the separator between the two parts of the symbolic link definition

/*
* This class handles the installation itself. It has functions for installing and for cleaning up.
*/
class Installer {	
	private $install_config;

	// crteate a new installer, loads installation configurations from installation configuration file
	public function __construct() {
		$this->install_config = parse_ini_file(FILE_INSTALL_CONFIG, true);
	}
	
	// detects if there are leftovers of an installation
	// can be used both before installation to verify and when the installation failed for cleaning up
	// $report_only - if set to true only returns the leftovers found and does not removes them
	// $app - the AppConfig used for the installation
	// $db_params - the database parameters array used for the installation ('db_host', 'db_user', 'db_pass', 'db_port')
	// returns null if no leftovers are found or it is not report only or a text containing all the leftovers found
	public function detectLeftovers($report_only, $app, $db_params) {
		$leftovers = null;		
		
		// symbloic links leftovers
		foreach ($this->install_config['symlinks'] as $slink) {
			$link_items = explode(SYMLINK_SEPARATOR, $app->replaceTokensInString($slink));	
			if (is_file($link_items[1]) && (strpos($link_items[1], $app->get('BASE_DIR')) === false)) {
				if ($report_only) {
					$leftovers .= "   ".$link_items[1]." symbolic link exists".PHP_EOL;
				} else {
					logMessage(L_USER, "Removing symbolic link $link_items[1]");
					OsUtils::recursiveDelete($link_items[1]);
				}
			}
		}
		
		// database leftovers
		$verify = $this->detectDatabases($db_params);
		if (isset($verify)) {
			if ($report_only) {
				$leftovers .= $verify;
			} else {			
				$this->detectDatabases($db_params, true);
			}
		}
		
		// application leftovers
		if (is_dir($app->get('BASE_DIR'))) {
			if ($report_only) {
				$leftovers .= "   Target directory ".$app->get('BASE_DIR')." already exists".PHP_EOL;
			} else {
				logMessage(L_USER, "Stopping sphinx if running");
				@exec($app->get('BASE_DIR').'/app/scripts/searchd.sh stop 2>&1', $output, $return_var);
				logMessage(L_USER, "Stopping the batch manager if running");
				@exec($app->get('BASE_DIR').'/app/scripts/serviceBatchMgr.sh stop 2>&1', $output, $return_var);
				logMessage(L_USER, "Deleting ".$app->get('BASE_DIR'));
				OsUtils::recursiveDelete($app->get('BASE_DIR'));			
			}
		}
		
		return $leftovers;
	}	
	
	// installs the application according to the given parameters
	// $app - the AppConfig used for the installation
	// $db_params - the database parameters array used for the installation ('db_host', 'db_user', 'db_pass', 'db_port')	
	// returns null if the installation succeeded or an error text if it failed
	public function install($app, $db_params) {
		logMessage(L_USER, sprintf("Copying application files to %s", $app->get('BASE_DIR')));
		if (!OsUtils::fullCopy('package/app/', $app->get('BASE_DIR'))) {
			return "Failed to copy application files to target directory";
		}		

		$os_name = 	OsUtils::getOsName();
		$architecture = OsUtils::getSystemArchitecture();	
		logMessage(L_USER, "Copying binaries for $os_name $architecture");
		if (!OsUtils::fullCopy("package/bin/$os_name/$architecture", $app->get('BIN_DIR'))) {
			return "Failed to copy binaris for $os_name $architecture";
		}
				
		logMessage(L_USER, "Replacing configuration tokens in files");
		foreach ($this->install_config['token_files'] as $file) {
			$replace_file = $app->replaceTokensInString($file);
			if (!$app->replaceTokensInFile($replace_file)) {
				return "Failed to replace tokens in $replace_file";
			}
		}		

		logMessage(L_USER, "Changing permissions of directories and files");
		foreach ($this->install_config['chmod_items'] as $item) {
			$chmod_item = $app->replaceTokensInString($item);
			if (!OsUtils::chmod($chmod_item)) {
				return "Failed to change permissions for $chmod_item";
			}
		}

		$sql_files = parse_ini_file($app->get('BASE_DIR').APP_SQL_DIR.'create_kaltura_db.ini', true);

		logMessage(L_USER, sprintf("Creating and initializing '%s' database", $app->get('DB1_NAME')));
		if (!DatabaseUtils::createDb($db_params, $app->get('DB1_NAME'))) {
			return "Failed to create '".$app->get('DB1_NAME')."' database";
		}
		foreach ($sql_files['kaltura']['sql'] as $sql) {
			$sql_file = $app->get('BASE_DIR').APP_SQL_DIR.$sql;
			if (!DatabaseUtils::runScript($sql_file, $db_params, $app->get('DB1_NAME'))) {
				return "Failed running database script $sql_file";
			}
		}

		logMessage(L_USER, sprintf("Creating and initializing '%s' database", $app->get('DB_STATS_NAME')));
		if (!DatabaseUtils::createDb($db_params, $app->get('DB_STATS_NAME'))) {
			return "Failed to create '".$app->get('DB_STATS_NAME')."' database";
		}
		foreach ($sql_files['stats']['sql'] as $sql) {
			$sql_file = $app->get('BASE_DIR').APP_SQL_DIR.$sql;
			if (!DatabaseUtils::runScript($sql_file, $db_params, $app->get('DB_STATS_NAME'))) {
				return "Failed running database script $sql_file";
			}
		}
			
		logMessage(L_USER, "Creating data warehouse");
		if (!OsUtils::execute(sprintf("%s/ddl/dwh_ddl_install.sh -u %s -p %s -d %s", $app->get('DWH_DIR'), $app->get('DWH_USER'), $app->get('DWH_PASS'), $app->get('DWH_DIR')))) {		
			return "Failed running data warehouse initialization script";
		}

		logMessage(L_USER, "Creating system symbolic links");
		foreach ($this->install_config['symlinks'] as $slink) {
			$link_items = explode(SYMLINK_SEPARATOR, $app->replaceTokensInString($slink));	
			if (symlink($link_items[0], $link_items[1])) {
				logMessage(L_INFO, "Created symbolic link $link_items[0] -> $link_items[1]");
			} else {
				return sprintf("Failed to create symblic link from %s to %s", $link_items[0], $link_items[1]);
			}
		}

		if (strcasecmp($app->get('KALTURA_VERSION_TYPE'), K_CE_TYPE) == 0) {
			$app->simMafteach();
		}

		logMessage(L_USER, "Deploying uiconfs in order to configure the application");
		foreach ($this->install_config['uiconfs'] as $uiconfapp) {
			$to_deploy = $app->replaceTokensInString($uiconfapp);
			if (OsUtils::execute(sprintf("%s %s/deployment/uiconf/deploy.php --disableUrlHashing=true --ini=%s", $app->get('PHP_BIN'), $app->get('APP_DIR'), $to_deploy))) {
				logMessage(L_INFO, "Deployed uiconf $to_deploy");
			} else {
				return "Failed to deploy uiconf $to_deploy";
			}
		}
		
		logMessage(L_USER, "Creating the uninstaller");
		if (!OsUtils::fullCopy('installer/uninstall.php', $app->get('BASE_DIR')."/uninstaller/")) {
			return "Failed to create the uninstaller";
		}
		$app->saveUninstallerConfig();
		
		logMessage(L_USER, "Running the sphinx search deamon");
		if (!OsUtils::execute($app->get('APP_DIR').'/scripts/searchd.sh start')) {
			return "Failed running the sphinx search deamon";
		}
		
		logMessage(L_USER, "Populating sphinx entries");
		if (!OsUtils::execute($app->get('PHP_BIN').' '.$app->get('APP_DIR').'/deployment/base/scripts/populateSphinxEntries.php')) {
			return "Failed to populate initial sphinx entries";
		}
		logMessage(L_USER, "Running the batch manager");
		if (!OsUtils::execute($app->get('APP_DIR').'/scripts/serviceBatchMgr.sh start')) {
			return "Failed running the btach manager";
		}
		
		return null;
	}
	
	// detects if there are databases leftovers
	// can be used both for verification and for dropping the databases
	// $db_params - the database parameters array used for the installation ('db_host', 'db_user', 'db_pass', 'db_port')
	// $should_drop - whether to drop the databases that are found or not (default - false) 
	// returns null if no leftovers are found or a text containing all the leftovers found
	private function detectDatabases($db_params, $should_drop=false) {
		$verify = null;
		foreach ($this->install_config['databases'] as $db) {
			$result = DatabaseUtils::dbExists($db_params, $db);
			
			if ($result === -1) {
				$verify .= "   Cannot verify if '$db' database exists".PHP_EOL;
			} else if ($result === true) {
				if (!$should_drop) {
					$verify .= "   '$db' database already exists ".PHP_EOL;
				} else {
					logMessage(L_USER, "Dropping '$db' database");
					DatabaseUtils::dropDb($db_params, $db);
				}
			}
		}
		return $verify;
	}	
}