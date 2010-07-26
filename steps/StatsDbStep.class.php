<?php


class StatsDbStep extends InstallStep
{

	public function install()
	{
		// create database
		$result = DatabaseUtils::createDb(myConf::get('DB_STATS_NAME'), myConf::get('DB_STATS_HOST'), myConf::get('DB_STATS_USER'), myConf::get('DB_STATS_PASS'), myConf::get('DB_STATS_PORT'));
		if ($result !== true) {
			$this->addStepToError($result);
			return $result;
		}
		
		// deploy all sqls
		$stats_sql_dir = PACKAGE_DIR.PACKAGE_STATS_DB_BASE_SQL;
		$sql_files = FileUtils::readDir($stats_sql_dir);
		if (ErrorObject::isErrorObject($sql_files)) {
			return $sql_files;
		}
		
    	foreach ($sql_files as $file) {
    		if ($file !== '.' && $file !== '..') {
    			$file = $stats_sql_dir.DIRECTORY_SEPARATOR.$file;
				$result = DatabaseUtils::runScript($file, myConf::get('DB_STATS_HOST'), myConf::get('DB_STATS_USER'), myConf::get('DB_STATS_PASS'), myConf::get('DB_STATS_NAME'), myConf::get('DB_STATS_PORT'));
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
		$result = DatabaseUtils::dropDb(myConf::get('DB_STATS_NAME'), myConf::get('DB_STATS_HOST'), myConf::get('DB_STATS_USER'), myConf::get('DB_STATS_PASS'), myConf::get('DB_STATS_PORT'));
		return ($result === true);
	}
		
}