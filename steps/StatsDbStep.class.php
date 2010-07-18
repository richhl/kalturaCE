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
		$sql_files = @scandir($stats_sql_dir);
		if (!$sql_files) {
			return $this->newError('CANT_READ_DIR',
				ErrorCodes::CANT_READ_DIR, $stats_sql_dir, InstallUtils::getLastError());
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