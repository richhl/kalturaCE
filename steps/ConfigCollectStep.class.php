<?php


class ConfigCollectStep extends InstallStep
{

	public function install()
	{
		echo PHP_EOL;
		$this->collectData();
		$this->setDefaults();
		myConf::writeToFile(INSTALL_CONFIG_FILE);
		return true;		
	}
	
	
	
	public function prepareForRetry()
	{
		return true;
	}
	
	private function setDefaults()
	{
		// directories
		myConf::set('APP_DIR', myConf::get('BASE_DIR').'/app/');	
		myConf::set('LOG_DIR', myConf::get('BASE_DIR').'/log/');	
		myConf::set('BIN_DIR', myConf::get('BASE_DIR').'/bin/');	
		myConf::set('TMP_DIR', myConf::get('BASE_DIR').'/tmp/');
		
		// databases (copy information collected during prerequisites
		$this->collectDatabaseCopier('1', '2');
		$this->collectDatabaseCopier('1', '3');
		
		
		// admin console defaults
		myConf::set('ADMIN_CONSOLE_PARTNER_SECRET', InstallUtils::generateSecret());
		myConf::set('ADMIN_CONSOLE_PARTNER_ADMIN_SECRET',  InstallUtils::generateSecret());
		myConf::set('SYSTEM_USER_ADMIN_EMAIL', myConf::get('ADMIN_CONSOLE_ADMIN_MAIL'));
		myConf::set('ADMIN_CONSOLE_PARTNER_ALIAS', md5('-2kaltura partner'));
		myConf::set('ADMIN_CONSOLE_KUSER_MAIL', 'admin_console@kaltura.com');
		myConf::set('ADMIN_CONSOLE_KUSER_SHA1', myConf::get('SYSTEM_USER_ADMIN_SHA1'));
		myConf::set('ADMIN_CONSOLE_KUSER_SALT', myConf::get('SYSTEM_USER_ADMIN_SALT'));
		//myConf::set('XYMON_SERVER_MONITORING_CONTROL_SCRIPT', UserInputUtils::getInput($this->getTextFor('xymon_control_script')));
		
		// stats DB
		$this->collectDatabaseCopier('1', '_STATS');
		myConf::set('DB_STATS_NAME', 'kaltura_stats');
		
		// data warehouse
		myConf::set('DWH_HOST', myConf::get('DB1_HOST'));
		myConf::set('DWH_PORT', myConf::get('DB1_PORT'));
		myConf::set('DWH_DATABASE_NAME', 'kalturadw');
		myConf::set('DWH_USER', 'etl');
		myConf::set('DWH_PASS', 'etl');
		myConf::set('DWH_SEND_REPORT_MAIL', myConf::get('ADMIN_CONSOLE_ADMIN_MAIL'));
		myConf::set('DWH_SEND_REPORT_MAIL', myConf::get('ADMIN_CONSOLE_ADMIN_MAIL'));
		
		
		// default partners and kusers
		myConf::set('TEMPLATE_PARTNER_MAIL', 'template@kaltura.com');
		myConf::set('TEMPLATE_KUSER_MAIL', myConf::get('TEMPLATE_PARTNER_MAIL'));
		myConf::set('TEMPLATE_ADMIN_KUSER_SALT', myConf::get('SYSTEM_USER_ADMIN_SALT'));
		myConf::set('TEMPLATE_ADMIN_KUSER_SHA1', myConf::get('SYSTEM_USER_ADMIN_SHA1'));
		
		
		// batch
		myConf::set('BATCH_ADMIN_MAIL', myConf::get('ADMIN_CONSOLE_ADMIN_MAIL'));
		myConf::set('BATCH_KUSER_MAIL', 'batch@kaltura.com');
		myConf::set('BATCH_HOST_NAME', InstallUtils::getComputerName());
		myConf::set('BATCH_PARTNER_SECRET', InstallUtils::generateSecret());
		myConf::set('BATCH_PARTNER_ADMIN_SECRET', InstallUtils::generateSecret());
		myConf::set('BATCH_PARTNER_PARTNER_ALIAS', md5('-1kaltura partner'));
		
		// site settings
		myConf::set('CORP_REDIRECT', '');	
		myConf::set('CDN_HOST', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		myConf::set('IIS_HOST', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		myConf::set('RTMP_URL', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		myConf::set('MEMCACHE_HOST', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		myConf::set('WWW_HOST', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		myConf::set('SERVICE_URL', 'http://'.myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		myConf::set('ENVIRONEMTN_NAME', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
		
		
		// other configurations
		myConf::set('APACHE_RESTART_COMMAND', myConf::get('HTTPD_BIN').' -k restart');
		myConf::set('TIME_ZONE', date('e'));
		myConf::set('GOOGLE_ANALYTICS_ACCOUNT', 'UA-7714780-1');
		myConf::set('INSTALLATION_TYPE', '');
		myConf::set('PARTNERS_USAGE_REPORT_SEND_FROM', ''); 
		myConf::set('PARTNERS_USAGE_REPORT_SEND_TO', '');
		myConf::set('SYSTEM_PAGES_LOGIN_USER', '');
		myConf::set('SYSTEM_PAGES_LOGIN_PASS', '123456');
		myConf::set('KMC_BACKDOR_SHA1_PASS', '123456');
		myConf::set('DC0_SECRET', '');
		myConf::set('APACHE_CONF', '');
		
		
		// storage profile related
		myConf::set('DC_NAME', 'local');
		myConf::set('DC_DESCRIPTION', 'local');
		myConf::set('STORAGE_BASE_DIR', myConf::get('WEB_DIR'));
		myConf::set('DELIVERY_HTTP_BASE_URL', myConf::get('SERVICE_URL'));
		myConf::set('DELIVERY_RTMP_BASE_URL', myConf::get('RTMP_URL'));
		myConf::set('DELIVERY_ISS_BASE_URL', myConf::get('SERVICE_URL'));
		myConf::set('ENVIRONMENT_NAME', myConf::get('KALTURA_VIRTUAL_HOST_NAME'));
	}
	
	
	
	private function collectData()
	{
		// kaltura site settings
		echo PHP_EOL;
		$vhost = UserInputUtils::getInput($this->getTextFor('virtual_host_name'));
		myConf::set('KALTURA_VIRTUAL_HOST_NAME', $this->remove_http(trim($vhost)));
		
		// directories
		echo $this->getTextFor('dirs_welcome').PHP_EOL.PHP_EOL;
		myConf::set('BASE_DIR', UserInputUtils::getPathInput($this->getTextFor('kaltura_base_dir'), false, true));
		myConf::set('WEB_DIR',$web_dir  = UserInputUtils::getPathInput($this->getTextFor('web_dir'), false, true));
		
		// admin console
		echo PHP_EOL.$this->getTextFor('admin_console_welcome').PHP_EOL.PHP_EOL;	
		myConf::set('ADMIN_CONSOLE_ADMIN_MAIL', UserInputUtils::getInput($this->getTextFor('admin_email')));
		$password = UserInputUtils::getInput($this->getTextFor('admin_password'));
		myConf::set('XYMON_URL', UserInputUtils::getInput($this->getTextFor('xymon_url')));
		//myConf::Set('XYMON_ROOT_DIR', UserInputUtils::getInput($this->getTextFor('xymon_root_dir')));
		
		myConf::set('ADMIN_CONSOLE_PASSWORD', $password);
		InstallUtils::generateSha1Salt($password, $salt, $sha1);	
		myConf::set('SYSTEM_USER_ADMIN_SALT', $salt);
		myConf::set('SYSTEM_USER_ADMIN_SHA1', $sha1);
	}
	
		
	
		
	private function collectDatabaseCopier($fromNum, $toNum)
	{
		myConf::set('DB'.$toNum.'_HOST', myConf::get('DB'.$fromNum.'_HOST'));
		myConf::set('DB'.$toNum.'_PORT', myConf::get('DB'.$fromNum.'_PORT'));
		myConf::set('DB'.$toNum.'_NAME', myConf::get('DB'.$fromNum.'_NAME'));
		myConf::set('DB'.$toNum.'_USER', myConf::get('DB'.$fromNum.'_USER'));
		myConf::set('DB'.$toNum.'_PASS', myConf::get('DB'.$fromNum.'_PASS'));
	}
	
	
	private function remove_http($url = '')
	{
	    $list = array('http://', 'https://');
	    foreach ($list as $item)
	        if (strncasecmp($url, $item, strlen($item)) == 0)
	            return substr($url, strlen($item));
	    return $url;
	}
			
		
}