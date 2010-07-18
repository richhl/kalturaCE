<?php 

error_reporting(E_ALL); //TODO: remove

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'KalturaInstaller.class.php');

// installation might take a few minutes

$time_limit       = ini_get('max_execution_time');
$memory_limit     = ini_get('memory_limit');
$input_time_limit = ini_get('max_input_time');
ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);
ini_set('max_input_time ', 0);


// installation steps - will be followed one after the other
@system('clear');

$install_steps = Array(

	1 => 'Prerequisites',
	2 => 'ConfigCollect',
	3 => 'ServerInstall',
	4 => 'OperDatabase',
	5 => 'StatsDb',
	6 => 'DataWarehouse',
	7 => 'CronJobs',
	
);

$installer = new KalturaInstaller($install_steps);
$installer->run();


// resetting parameters

ini_set('max_execution_time', $time_limit);
ini_set('memory_limit', $memory_limit);
ini_set('max_input_time ', $input_time_limit);
