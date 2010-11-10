<?php 

include_once('installer/DatabaseUtils.class.php');
include_once('installer/OsUtils.class.php');
include_once('installer/UserInput.class.php');
include_once('installer/Log.php');
include_once('installer/InstallReport.class.php');
include_once('installer/AppConfig.class.php');
include_once('installer/Installer.class.php');
include_once('installer/InputValidator.class.php');
include_once('installer/phpmailer/class.phpmailer.php');

// should be called whenever the installation fails
// $error - the error to print to the user
// if $cleanup and there is something to cleanup it will prompt the user whether to cleanup
function installationFailed($what_happened, $description, $what_to_do, $cleanup = false) {
	global $report, $installer, $app, $db_params, $user;

	if (isset($report)) {
		$report->reportInstallationFailed($what_happened."\n".$description);
	}
	if (!empty($what_happened)) logMessage(L_USER, $what_happened);
	if (!empty($description)) logMessage(L_USER, $description);
	if ($cleanup) {
		$leftovers = $installer->detectLeftovers(true, $app, $db_params);
		if (isset($leftovers) && $user->getTrueFalse(null, "Do you want to cleanup?", 'y')) {
			$installer->detectLeftovers(false, $app, $db_params);
		}	
	}
	if (!empty($what_to_do)) logMessage(L_USER, $what_to_do);		
	die(1);
}

// constants
define("K_TM_TYPE", "TM");
define("K_CE_TYPE", "CE");
define("FILE_INSTALL_SEQ_ID", "install_seq"); // this file is used to store a sequence of installations

// installation might take a few minutes
ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);
ini_set('max_input_time ', 0);

// TODO: parameters - config name, debug level and force

// start the log
startLog("install_log_".date("d.m.Y_H.i.s"));
logMessage(L_INFO, "Installation started");

// variables
$app = new AppConfig();
$installer = new Installer();
$user = new UserInput();
$db_params = array();

// set the installation ids
$app->set('INSTALLATION_UID', uniqid("IID")); // unique id per installation

// load or create installation sequence id
if (is_file(FILE_INSTALL_SEQ_ID)) {
	$install_seq = @file_get_contents(FILE_INSTALL_SEQ_ID);
	$app->set('INSTALLATION_SEQUENCE_UID', $install_seq);
} else {
	$install_seq = uniqid("ISEQID"); // unique id per a set of installations
	$app->set('INSTALLATION_SEQUENCE_UID', $install_seq); 
	file_put_contents(FILE_INSTALL_SEQ_ID, $install_seq);
}

// read package version
$version = parse_ini_file('package/version.ini');
logMessage(L_INFO, "Installing Kaltura ".$version['type'].' '.$version['number']);
$app->set('KALTURA_VERSION', 'Kaltura '.$version['type'].' '.$version['number']);
$app->set('KALTURA_VERSION_TYPE', $version['type']);
if (strcasecmp($app->get('KALTURA_VERSION_TYPE'), K_TM_TYPE) !== 0) {
	$hello_message = "Thank you for installing Kaltura Video Platform - Community Edition";
	$report_message = "If you wish, please provide your email address so that we can offer you future assistance (leave empty to pass)";
	$report_error_message = "Email must be in a valid email format";
	$report_validator = InputValidator::createEmailValidator(true);		
	$fail_action = "For assistance, please upload the installation log file to the Kaltura CE forum at kaltura.org";
} else {
	$hello_message = "Thank you for installing Kaltura Video Platform";
	$report_message = "Please provide the name of your company or organization";
	$report_error_message = "Name cannot be empty";
	$report_validator = InputValidator::createNonEmptyValidator();	
	$fail_action = "For assistance, please contant the support team at support@kaltura.com with the installation log attached";
}

// start user interaction
@system('clear');
logMessage(L_USER, $hello_message);
echo PHP_EOL;

// If previous installation found and the user wants to use it
if ($user->hasInput() && 
	$user->getTrueFalse(null, "A previous installation attempt has been detected, do you want to use the input you provided during you last installation?", 'y')) {
	$user->loadInput();
}

// if user wants or have to report
if ($result = ((strcasecmp($app->get('KALTURA_VERSION_TYPE'), K_TM_TYPE) == 0) || 
	($user->getTrueFalse('ASK_TO_REPORT', "In order to improve Kaltura Community Edition, we would like your permission to send system data to Kaltura.\nThis information will be used exclusively for improving our software and our service quality. I agree", 'y')))) {	
	$email = $user->getInput('REPORT_MAIL', $report_message, $report_error_message, $report_validator, null);
	$app->set('REPORT_ADMIN_EMAIL', $email);
	$app->set('TRACK_KDPWRAPPER','true');
	$app->set('USAGE_TRACKING_OPTIN','true');	
	$report = new InstallReport($email, $app->get('KALTURA_VERSION'), $app->get('INSTALLATION_SEQUENCE_UID'), $app->get('INSTALLATION_UID'));
	$report->reportInstallationStart();
} else {
	$app->set('REPORT_ADMIN_EMAIL', "");
	$app->set('TRACK_KDPWRAPPER','false');
	$app->set('USAGE_TRACKING_OPTIN','false');
}

// verify that the installation can continue
if (!OsUtils::verifyRootUser()) {
	installationFailed("Installation cannot continue, you must have root privileges to continue with the installation process.", 
					   null, null);
}
if (!OsUtils::verifyOS()) {
	installationFailed("Installation cannot continue, Kaltura platform can only be installed on Linux OS at this time.", 
					   null, null);
}

if (!extension_loaded('mysqli')) {
	installationFailed("You must have PHP mysqli extension loaded to continue with the installation.", 
					   null, null);
}

// get the user input if needed
if ($user->isInputLoaded()) {
	logMessage(L_USER, "Skipping user input, previous installation input will be used.");	
} else {
	$user->getApplicationInput();
}

// init the application configuration
$app->initFromUserInput($user->getAll());
$db_params['db_host'] = $app->get('DB1_HOST');
$db_params['db_port'] = $app->get('DB1_PORT');
$db_params['db_user'] = $app->get('DB1_USER');
$db_params['db_pass'] = $app->get('DB1_PASS');

// verify prerequisites
echo PHP_EOL;
logMessage(L_USER, "Verifing prerequisites");
@exec(sprintf("%s installer/Prerequisites.php %s %s %s %s %s 2>&1", $app->get("PHP_BIN"), $app->get("HTTPD_BIN"), $db_params['db_host'], $db_params['db_port'], $db_params['db_user'], $db_params['db_pass']), $output, $exit_value);
if ($exit_value !== 0) {
	$description = "   ".implode("\n   ", $output)."\n";
	echo PHP_EOL;
	installationFailed("One or more prerequisites required to install Kaltura failed:",
					   $description,
					   "Please resolve the issues and run the installation again.");
}

// verify that there are no leftovers from previous installations
echo PHP_EOL;
logMessage(L_USER, "Checking for leftovers from a previous installation");
$leftovers = $installer->detectLeftovers(true, $app, $db_params);
if (isset($leftovers)) {
	logMessage(L_USER, $leftovers);
	if ($user->getTrueFalse(null, "Leftovers from a previouse Kaltura installation have been detected. In order to continue with the current installation these leftovers must be removed. Do you wish to remove them now?", 'n')) {
		$installer->detectLeftovers(false, $app, $db_params);
	} else {
		installationFailed("Installation cannot continue because a previous installation of Kaltura was detected.", 
						   $leftovers,
						   "Please manually uninstall Kaltura before running the installation or select yes to remove the leftovers.");
	}
}

// last chance to stop the installation
echo PHP_EOL;
if (!$user->getTrueFalse('', "Installation is now ready to begin. Start installation now?", 'y')) {
	echo "Bye".PHP_EOL;
	die(1);	
}

// run the installation
$install_output = $installer->install($app, $db_params);
if ($install_output !== null) {
	installationFailed("Installation failed.", $install_output, $fail_action, true);
}

// add usage tracking crontab for onprem TM
if (strcasecmp($app->get('KALTURA_VERSION_TYPE'), K_TM_TYPE) === 0) {
	$tracking_cron = sprintf("\n0 8 5 * * root %s %s/admin_console/scripts/send-usage-report.php\n", $app->get('PHP_BIN'), $app->get('APP_DIR'));
	OsUtils::appendFile($app->get('BASE_DIR').'/crontab/kaltura_crontab', $tracking_cron);
}

// send settings mail if possible
$msg = sprintf("Thank you for installing the Kaltura Video Platform\n\nTo get started, please browse to your kaltura start page at:\nhttp://%s/start\n\nYour kaltura administration console can be accessed at:\nhttp://%s/admin_console\n\nYour Admin Console credentials are:\nSystem admin user: %s\nSystem admin password: %s\n\nPlease keep this information for future use.\n\nThank you for choosing Kaltura!", $app->get('KALTURA_VIRTUAL_HOST_NAME'), $app->get('KALTURA_VIRTUAL_HOST_NAME'), $app->get('ADMIN_CONSOLE_ADMIN_MAIL'), $app->get('ADMIN_CONSOLE_PASSWORD')).PHP_EOL;
$mailer = new PHPMailer();
$mailer->CharSet = 'utf-8';
$mailer->IsHTML(false);
$mailer->AddAddress($app->get('ADMIN_CONSOLE_ADMIN_MAIL'));
$mailer->Sender = "installation_confirmation@".$app->get('KALTURA_VIRTUAL_HOST_NAME');
$mailer->From = "installation_confirmation@".$app->get('KALTURA_VIRTUAL_HOST_NAME');
$mailer->FromName = $app->get('ENVIRONMENT_NAME');
$mailer->Subject = 'Kaltura Installation Settings';
$mailer->Body = $msg;

if ($mailer->Send()) {
	logMessage(L_USER, "Post installation email cannot be sent");
} else {
	logMessage(L_USER, "Sent post installation settings email to ".$app->get('ADMIN_CONSOLE_ADMIN_MAIL'));
}

// print after installation instructions
echo PHP_EOL;
logMessage(L_USER, sprintf("Installation Completed Successfully.\nYour Kaltura Admin Console credentials:\nSystem Admin user: %s\nSystem Admin password: %s\n\nPlease keep this information for future use.\n", $app->get('ADMIN_CONSOLE_ADMIN_MAIL'), $app->get('ADMIN_CONSOLE_PASSWORD')));
logMessage(L_USER, sprintf("To start using Kaltura, please complete the following steps:\n1. Add the following line to your /etc/hosts file:\n\t127.0.0.1 %s\n2. Add the following line to your Apache configurations file (Usually called httpd.conf or apache2.conf):\n\tInclude %s/app/configurations/apache/my_kaltura.conf\n3. Restart apache\n4. Browse to your Kaltura start page at: http://%s/start\n", $app->get("KALTURA_VIRTUAL_HOST_NAME"), $app->get("BASE_DIR"), $app->get("KALTURA_VIRTUAL_HOST_NAME")));

if (isset($report)) {
	$report->reportInstallationSuccess();
}

die(0);