<?php


class OperDatabaseStep extends InstallStep
{

	public function install()
	{
		// replace tokens in base sql files
		$tmp_base_sql_dir = TMP_DIR.'/server/'.PACKAGE_SERVER_BASE_SQL;
		$result = FileUtils::recursiveDelete($tmp_base_sql_dir);
		if ($result === true) { $result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_SERVER_BASE_SQL, $tmp_base_sql_dir); }
		if ($result === true) { $result = FileUtils::replaceTokens(myConf::getAll(), $tmp_base_sql_dir); }
		
		// create database
		$result = DatabaseUtils::createDb(myConf::get('DB1_NAME'), myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), myConf::get('DB1_PORT'));
		if ($result !== true) {
			$this->addStepToError($result);
			return $result;
		}
		
		// deploy all sqls
		$sql_files = FileUtils::readDir($tmp_base_sql_dir);
		if (ErrorObjecT::isErrorObject($sql_files)) {
			return $sql_files;
		}
		
    	foreach ($sql_files as $file) {
    		if ($file !== '.' && $file !== '..') {
    			$file = $tmp_base_sql_dir.DIRECTORY_SEPARATOR.$file;
				$result = DatabaseUtils::runScript($file, myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), myConf::get('DB1_NAME'), myConf::get('DB1_PORT'));
				if ($result !== true) {
					$this->addStepToError($result);
					return $result;
				}
    		}
    	}
    	
    	return true;	
	}
	
	
	
	public function prepareForRetry()
	{
		$result = DatabaseUtils::dropDb(myConf::get('DB1_NAME'), myConf::get('DB1_HOST'), myConf::get('DB1_USER'), myConf::get('DB1_PASS'), myConf::get('DB1_PORT'));
		return ($result === true);
	}
		
}