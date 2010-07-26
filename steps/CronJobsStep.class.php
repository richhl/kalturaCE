<?php


class CronJobsStep extends InstallStep
{

	public function install()
	{
		if (InstallUtils::getOsName() == InstallUtils::LINUX_OS)
		{
			$cron_utils = new CrontabUtils();
			// batch and others
			$cron_utils->addJob(myConf::get('APP_DIR').'/scripts/watch.batchMgr.sh', '*/30 * * * *');
			$cron_utils->addJob(myConf::get('APP_DIR').'/alpha/crond/kaltura/clear_cache.sh', '*/15 * * * *');
			$cron_utils->addJob(myConf::get('APP_DIR').'/scripts/storage_update.sh', '30 7 * * *');	
			$cron_utils->addJob(myConf::get('APP_DIR').'/scripts/www_logs_insert.sh', '30 8 * * *');
			$result = $cron_utils->activate();
			
			if ($result === true) {
				$cron_utils = new CrontabUtils();
				
				// data warehouse cron jobs
				$cron_utils->addJob(myConf::get('ETL_HOME_DIR').'/etlsource/execute/etl_logs.sh', '30 5 * * *', 'etl');
				$cron_utils->addJob(myConf::get('ETL_HOME_DIR').'/etlsource/execute/daily.sh',    '30 6 * * *', 'etl');
				$result = $cron_utils->activate('etl');
			}
			if ($result !== true) {
				return self::newError(CANT_SET_CRON_JOBS, ErrorCodes::CANT_SET_CRON_JOBS);
			}

			//run batch scheduler now
			@exec(myConf::get('APP_DIR').'/scripts/serviceBatchMgr.sh start');
			//TODO: how to find out if failed ??
			return true;
			
		}
		else {
			return $this->newError('OS_NOT_SUPPORTED',
				sprintf(ErrorCodes::OS_NOT_SUPPORTED, PHP_OS)
			);
		}	
	}
	
		
	public function prepareForRetry()
	{
		return true;
	}
		
		
}