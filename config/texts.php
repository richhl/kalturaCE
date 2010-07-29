<?php


class InstallerTexts
{
	
	public static function getTextsForStep($step_name)
	{
		switch ($step_name)
		{
			case 'global':
				return self::$global_texts;
			case 'PrerequisitesStep':
				return self::$prerequisites_texts;
			case 'ConfigCollectStep':
				return self::$config_collect_texts;
			case 'ServerInstallStep':
				return self::$server_install_texts;
			case 'OperDatabaseStep':
				return self::$oper_database_texts;
			case 'StatsDbStep':
				return self::$stats_database_texts;
			case 'DataWarehouseStep':
				return self::$data_warehouse_texts;
			case 'CronJobsStep':
				return self::$cron_jobs_texts;
			default:
				return false;
		}
	}
	
	public static function getText($step_name, $key)
	{
		$texts = self::getTextsForStep($step_name);
		return $texts[$key];
	}

	static $global_texts = array (
		'package_corrupt' => "Your Kaltura package is corrupt.\nPlease download a new package from http://www.kaltura.org",
		'install_fail' => "Installation failed.\nCritical errors occurred during the installation process.\nFor assistance, please upload the install-log.txt file to the Kaltura CE forum at kaltura.org. ",
		'install_success' => "Installation Completed Successfully.\n
Your Kaltura Admin Console credentials:\n
System Admin user: %s\n
System Admin password: %s\n\n
Please keep this information for future use.\nAssuming your mail server is up, the above \ninformation will also be sent to your email.",
		
	'finish_mail' => "Thank you for installing the Kaltura Video Platform\n\n

	To get started, please browse to your kaltura start page at:\n
http://%s/start\n\n
	
Your kaltura administration console can be accessed at:\n
http://%s/admin_console\n\n

Your Admin Console credentials are:\n
System admin user: %s\n
System admin password: %s\n\n

Please keep this information for future use.\n\n

Thank you for choosing Kaltura !",
		
	
		'after_install_steps' => "To start using Kaltura, please do the following steps:\n
1. Add the following line to your /etc/hosts file:\n
   127.0.0.1 %s\n
2. Add the following line to your Apache configurations file (Usually called httpd.conf or apache2.conf):\n
   Include %s/app/configurations/apache/my_kaltura.conf\n
3. Restart apache by executing the following command:
   %s\n
4. Browse to your Kaltura start page at:  http://%s/start\n",

		'ask_to_report' => "In order to improve Kaltura CE, we would like your permission to send system data from your server to Kaltura.\nThis information will not be used for any purpose other than improving service quality. I agree (Y/n)",
		'report_email' => "If you wish, please provide your email address so that we can\noffer you future assistance (Leave empty to pass):",
		'offer_try_again' => "Installation cannot continue unless this problem is resolved.\nWould you like to try again? (y/N)",
		'error_occured' => 'The following error occured - %1$s',
		'welcome_msg' => "Thank you for using the Kaltura video platform installation script.",

		'proceed_with_install' => 'Do you want to start installation now? (Y/n)',
		
		'skipping_step' => 'Skipped',
		'offer_to_repeat' => 'It seems like this step was already completed. Would you like to repeat it? (y/N)',
		'path_not_valid' => 'The path you inserted is not valid. Please try again.',
		'not_full_path' => 'The path you inserted is not full (should begin with a \'/\'). Please try again.',
	
	
	);


	/* Texts for the prerequisites step */
	
	static $prerequisites_texts = array (
		'step_start' => '',
		'step_success' => 'Prerequisites verification completed successfully',
	
		'check_start' => 'Verifying prerequisites...',
		'no_mysqli_ext' => 'Cannot check %1$s because php mysqli extension was not found',
		'missing_etl_user' => 'User \'etl\' does not exist on the system',
		'missing_etl_home' => 'etl user\'s home directory does not exist [%1$s]',
		'user_not_root' => 'You must have root privileges to run installation process',
		'missing_php_ext' => 'Missing %1$s PHP extension',
		'missing_bin' => 'Missing %1$s bin file',
		'missing_file' => 'Missing %1$s file',
		'missing_dir' => 'Missing %1$s directory',
		'missing_apache_module' => 'Apache %1$s module is missing',
		'bad_mysql_setting' => 'MySQL setting %1$s is not %2$s %3$s',
		'bad_version' => '%1$s version is not %2$s %3$s',
		'unknown_product' => 'Error in prerequisites file',
		'db_exists' => '%1$s database already exists',
	
		'config_collect' => "For prerequisites verification, please provide the following information:",
		'httpd_bin' => "The full pathname to your Apache apachectl/apache2ctl file:\nExamples:\n/usr/bin/apachectl\n/usr/bin/apache2ctl\n/opt/lampp/bin/apachectl" ,
		'php_bin' => "The full pathname to your PHP binary file:\nExamples:\n/usr/bin/php\n/opt/lampp/bin/php",
		'db_host' => 'Database host (Leave empty for \'localhost\'):',
		'db_port' => 'Database port (Leave empty for \'3306\'):',
		'db_user' => 'Database username (With create & write privileges):',
		'db_pass' => 'Database password (Leave empty for no password):',
	);

	/* Texts for the operational database step */
	
	static $oper_database_texts = array (
		'step_start' => 'Installing operational database...',
		'step_success' => 'Operational database installation completed successfully',
	);
	
	
	/* Texts for the statistics database step */
	
	static $stats_database_texts = array (
		'step_start' => 'Installing statistics database...',
		'step_success' => 'Statistics database installation completed successfully',
	);

	/* Texts for the data warehouse step */
	
	static $data_warehouse_texts = array (
		'step_start' => 'Installing data warehouse...',
		'step_success' => 'Data warehouse installation completed successfully',
	);
	
	/* Texts for the server install step */

	static $server_install_texts = array (
		'step_start' => 'Installing and configuring server (this might take a few minutes)...',
		'step_success' => 'Server installation and configuration completed successfully',
	);
	
	/* Texts for the cron jobs step */
	
	static $cron_jobs_texts = array (
		'step_start' => 'Setting up cron jobs...',
		'step_success' => 'All cron jobs set successfully',
	);

	
	/* Texts for the ConfigCollect installation step */
	
	static $config_collect_texts = array (
		'step_start' => 'Configuration Details',
		'step_success' => 'Configuration details completed',

		// directories
		'dirs_welcome' => "Dedicated directories will be created to serve your Kaltura setup.\nPlease provide the directories you want to create.",
		'kaltura_base_dir' => "The full directory pathname of the Kaltura application base directory.\n
This does not need to be in your web server directory tree.\n
Examples:\n/opt/myKalturaApp",
		'web_dir' => "The full directory pathname of the Kaltura storage base directory.\n
This does not need to be in your web server directory tree.\n
Examples:\n/opt/myKalturaStorage",
			
		// admin console
		'admin_console_welcome' => "A primary system administrator user will be created\nwith full access to the Kaltura Administration Console.\nPlease provide the following information:",
		'admin_email' => "Your primary system administrator email address.\nA real email address is required, so you can recieve system auto-generated emails.",
		'admin_password' => 'The password you want to set for your primary administrator:',
		'xymon_url' => "The URL to your xymon/hobbit monitoring location.\nXymon is an optional installation. Leave empty to set manually later\nExamples:\nhttp://www.xymondomain.com/xymon/\nhttp://www.xymondomain.com/hobbit/",
		'xymon_root_dir' =>"The full directory pathname of your xymon installation.\nExamples:\n/usr/lib/xymon",
		'xymon_control_script' => "The URL to your xymon hobbit-enadis.sh control script\nxymon is an optional installation. Leave empty to set xymon manually later",
	
		// site settings
		'site_settings_welcome' => '',
		'virtual_host_name' => "Please enter the domain name/virtual hostname that will be used for the kaltura server :\nExamples:\nmysite.com (without http://)", 
	);

}
