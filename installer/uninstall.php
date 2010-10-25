<?php

define('YESNO_REGEX', '/^(y|yes|n|no)$/i');

$dbs_to_drop = array ( 
	'kaltura',
	'kalturadw',
	'kalturadw_ds',
	'kalturadw_bisources',
	'kalturalog',
	'kaltura_stats',
);
	
// returns true or false according to the user input, if empty return $default
function getTrueFalse($default) {
	$inputOk = false;
	while (!$inputOk) {
		echo '> ';
		$input = trim(fgets(STDIN));
		
		if (empty($input)) {
			return $default;
		} else if (preg_match(YESNO_REGEX, $input) === 1) {
			$inputOk = true;
		} else {
			echo "Input invalid, must be y/n/yes/no".PHP_EOL;
		}
	}
	return ((strcasecmp('y',$input) === 0) || (strcasecmp('yes',$input) === 0));	
}

// execute a shell command and returns, returns true if succeeds, false otherwise
function execute($command) {
	@exec($command . ' 2>&1', $output, $return_var);
	return ($return_var === 0);
}
	
// connect to a db, returns true if succeeds, false otherwise
function connect(&$link, $host, $user, $pass, $db, $port) {
	// set mysqli to connect via tcp
	if ($host == 'localhost') {
		$host = '127.0.0.1';
	}
	if (trim($pass) == '') $pass = null;
	
	$link = @mysqli_init();
	$result = @mysqli_real_connect($link, $host, $user, $pass, $db, $port);	
	if (!$result) {
		return false;
	}
	return true;
}

// executes a db query, returns true if succeeds, false otherwise
function executeQuery($query, $host, $user, $pass, $db, $port, $link = null) {
	if (!$link && !connect($link, $host, $user, $pass, $db, $port)) return false;
	else if (isset($db) && !mysqli_select_db($link, $db)) return false;

	if (!mysqli_multi_query($link, $query) || $link->error != '') return false;		
	
	while (mysqli_more_results($link) && mysqli_next_result($link)) {
		$discard = mysqli_store_result($link);
	}
	$link->commit();
	return true;
}

// drops a db, returns true if succeeds, false otherwise
function dropDb($db, $host, $user, $pass, $port) {
	$drop_db_query = "DROP DATABASE $db;";
	return executeQuery($drop_db_query, $host, $user, $pass, null, $port);
}
	
$config = parse_ini_file("uninstall.ini");
$success = true;
echo 'Uninstaller will fully remove the Kaltura software from your system.'.PHP_EOL;
echo 'Databases and any uploaded content will also be removed.'.PHP_EOL;
echo 'This action cannot be undone. Do you wish to continue? (y/N)'.PHP_EOL;
if (!getTrueFalse(false)) {
	echo 'Uninstallation was cancelled, uninstaller will now exit.'.PHP_EOL;
	die(0);
}

echo 'Stopping sphinx deamon... ';
if (execute($config['BASE_DIR'].'/app/scripts/searchd.sh stop')) {
	echo 'OK'.PHP_EOL;
} else {
	echo 'Failed'.PHP_EOL;
	$success = false;
}

echo 'Stopping the batch manager... ';
if (execute($config['BASE_DIR'].'/app/scripts/serviceBatchMgr.sh stop')) {
	echo 'OK'.PHP_EOL;
} else {
	echo 'Failed'.PHP_EOL;
	$success = false;
}

echo "Removing /etc/logrotate.d/kaltura_log_rotate... ";
if (execute("rm -rf /etc/logrotate.d/kaltura_log_rotate")) {
	echo 'OK'.PHP_EOL;
} else {
	echo 'Failed'.PHP_EOL;
	$success = false;
}

echo "Removing /etc/cron.d/kaltura_crontab... ";
if (execute("rm -rf /etc/cron.d/kaltura_crontab")) {
	echo 'OK'.PHP_EOL;
} else {
	echo 'Failed'.PHP_EOL;
	$success = false;
}

foreach ($dbs_to_drop as $db) {
	echo "Dropping '$db' database... ";
	if (dropDb($db, $config['DB_HOST'], $config['DB_USER'], $config['DB_PASS'], $config['DB_PORT'])) {
		echo 'OK'.PHP_EOL;
	} else {
		echo 'Failed'.PHP_EOL;
		$success = false;
	}
}

echo "Removing ".$config['BASE_DIR']."... ";
if (execute("rm -rf ".$config['BASE_DIR'])) {
	echo 'OK'.PHP_EOL;
} else {
	echo 'Failed'.PHP_EOL;
	$success = false;
}
	
if ($success) echo 'Uninstall finished successfully'.PHP_EOL;
else echo 'Some of the uninstall steps failed, please complete the process manually'.PHP_EOL;
echo 'Please maually remove Kaltura related Includes from your httpd.conf or httpd-vhosts.conf files'.PHP_EOL;

