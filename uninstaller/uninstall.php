<?php

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'InstallUtils.class.php');
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'FileUtils.class.php');
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'DatabaseUtils.class.php');
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'ErrorObject.class.php');
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'error_codes.php');

$config_file = dirname(__FILE__).DIRECTORY_SEPARATOR.'my_config.ini';

if (!is_file($config_file)) {
	echo 'Your configuration file is missing, therefore automatic uninstallation cannot be done.'.PHP_EOL;
	echo 'To uninstall manually please :'.PHP_EOL;
	echo '  1. Exec "[base_kaltura_dir]/scripts/serviceBatchMgr.sh stop" to stop batch services.'.PHP_EOL;
	echo '  2. Delete all your Kaltura directories.'.PHP_EOL;
	echo '  3. Delete all your Kaltura databases.'.PHP_EOL;
	echo '  4. Delete the \'etl\' user and it\'s home directory.'.PHP_EOL;
	echo '  5. Disable all kaltura cron jobs.'.PHP_EOL;
	echo '  6. Erase file \'/etc/logrotate.d/kaltura_log_rotate\''.PHP_EOL;
	echo '  7. Remove Kaltura related includes from your httpd.conf or httpd-vhosts.conf file'.PHP_EOL;
	die();
}

$config = parse_ini_file($config_file);

@exec($config['APP_DIR'].'/scripts/serviceBatchMgr.sh stop  2>&1');
$result = FileUtils::recursiveDelete($config['APP_DIR']);
if ($result === true) { $result = FileUtils::recursiveDelete($config['BIN_DIR']); }
if ($result === true) { $result = FileUtils::recursiveDelete($config['LOG_DIR']); }
if ($result === true) { $result = FileUtils::recursiveDelete($config['TMP_DIR']); }
if ($result === true) { $result = FileUtils::recursiveDelete($config['WEB_DIR']); }
if ($result === true) { $result = DatabaseUtils::dropDb($config['DB1_NAME'], $config['DB1_HOST'], $config['DB1_USER'], $config['DB1_PASS'], $config['DB1_PORT']); }
if ($result === true) { $result = DatabaseUtils::dropDb($config['DB_STATS_NAME'], $config['DB_STATS_HOST'], $config['DB_STATS_USER'], $config['DB_STATS_PASS'], $config['DB_STATS_PORT']); }
if ($result === true) { $result = FileUtils::execAsUser($config['ETL_HOME_DIR'].'/ddl/dwh_drop_databases.sh', 'etl'); }
if ($result === true) { $result = FileUtils::recursiveDelete($config['ETL_HOME_DIR'].DIRECTORY_SEPARATOR.'*'); }
if ($result === true) { $result = FileUtils::recursiveDelete('/etc/logrotate.d/kaltura_log_rotate'); }



if ($result === true) {
	echo 'Uninstall done successfully but needs you to do the following steps manually :'.PHP_EOL;
	echo '  1. Delete your kaltura base directory ['.$config['BASE_DIR'].']'.PHP_EOL;
	echo '  2. Disable kaltura cron jobs for user "root" and "etl"'.PHP_EOL;
	echo '  3. Remove Kaltura related includes from your httpd.conf or httpd-vhosts.conf files'.PHP_EOL;
}
else {
	echo 'An error occured - '.$result->getDescription().PHP_EOL;
	echo 'Please fix it and try again.'.PHP_EOL;
}
