<?php


class DataWarehouseStep extends InstallStep
{

	public function install()
	{
		
		// copy data warehouse files to /home/etl
		$result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_DWH, myConf::get('ETL_HOME_DIR'), true);
		
		// replace tokens in config files
		$tmp_dwh_config_dir = TMP_DIR.'/dwh/'.PACKAGE_DWH_CONFIG;
		if ($result === true) { $result = FileUtils::recursiveDelete($tmp_dwh_config_dir); }
		if ($result === true) { $result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_DWH_CONFIG, $tmp_dwh_config_dir); }
		if ($result === true) { $result = FileUtils::replaceTokens(myConf::getAll(), $tmp_dwh_config_dir); }
		// copy config files (after tokens were replaced)		
		if ($result === true) { $result = FileUtils::fullCopy($tmp_dwh_config_dir, myConf::get('ETL_HOME_DIR'), true); }
		
		// replace tokens in log rotate
		$tmp_log_rotate_file = TMP_DIR.PACKAGE_LOG_ROTATE;
		if ($result === true) { $result = FileUtils::recursiveDelete($tmp_log_rotate_file); }
		if ($result === true) { $result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_LOG_ROTATE, $tmp_log_rotate_file); }
		if ($result === true) { $result = FileUtils::replaceTokens(myConf::getAll(), $tmp_log_rotate_file); }
		
		// chmod
		if ($result === true) { $result = FileUtils::chmod(myConf::get('ETL_HOME_DIR'), '-R 700'); }

		
		// chown to etl user
		if ($result === true) { $result = FileUtils::chown(myConf::get('ETL_HOME_DIR'), 'etl'); }

		
		// create dataase user etl@localhost
		if ($result === true) { $result = DatabaseUtils::executeQuery(
			"GRANT ALL ON *.* TO 'etl'@'localhost' IDENTIFIED BY 'etl';",
			myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), null, myConf::get('DB1_PORT')
		); }
		// create dataase user etl@%
		if ($result === true) { $result = DatabaseUtils::executeQuery(
			"GRANT ALL ON *.* TO 'etl'@'%' IDENTIFIED BY 'etl';",
			myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), null, myConf::get('DB1_PORT')
		); }

		// crate database user kaltura_read
		if ($result === true) { $result = DatabaseUtils::executeQuery(
			"GRANT SELECT ON *.* TO 'kaltura_read'@'localhost' IDENTIFIED BY 'kaltura_read';",
			myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), null, myConf::get('DB1_PORT')
		); }
		
		// flush priviliges
		if ($result === true) { $result = DatabaseUtils::executeQuery(
			"flush privileges;",
			myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), null, myConf::get('DB1_PORT')
		); }

		// execute installation
		if ($result === true) { $result = FileUtils::execAsUser(myConf::get('ETL_HOME_DIR').DIRECTORY_SEPARATOR.'ddl'.DIRECTORY_SEPARATOR.'dwh_ddl_install.sh', 'etl'); }
		
		if ($result === true) {
			$log_rotate_file = '/etc/logrotate.d/kaltura_log_rotate';
			$result = FileUtils::fullCopy($tmp_log_rotate_file, $log_rotate_file, true);
		}
				
		return $result;		
	}
	
		
	public function prepareForRetry()
	{
		$result = FileUtils::execAsUser('/home/etl/ddl/dwh_drop_databases.sh' , 'etl');
		if ($result === true) {
			return true;
		}
		return false;
	}
	
			
}
