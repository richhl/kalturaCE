<?php 

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'KalturaInstaller.class.php');

// installation might take a few minutes

$time_limit       = ini_get('max_execution_time');
$memory_limit     = ini_get('memory_limit');
$input_time_limit = ini_get('max_input_time');
ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);
ini_set('max_input_time ', 0);


// clear terminal screen
@system('clear');


// installation steps - will be followed one after the other
$install_steps = Array(

	1 => 'Prerequisites', /* THIS STEP IS REQUIRED FOR ALL OTHER STEPS TO FUNCTION CORRECTLY */
	2 => 'ConfigCollect', /* THIS STEP IS REQUIRED FOR ALL OTHER STEPS TO FUNCTION CORRECTLY */
	3 => 'ServerInstall',
	4 => 'OperDatabase',
	5 => 'StatsDb',
	6 => 'DataWarehouse',
	7 => 'CronJobs',

);

// execute installation
$installer = new KalturaInstaller($install_steps);
$installer->run();


// resetting parameters

ini_set('max_execution_time', $time_limit);
ini_set('memory_limit', $memory_limit);
ini_set('max_input_time ', $input_time_limit);
