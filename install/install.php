<?php
  include('kaltura_client/kaltura_settings.php');
  include('install_log.php');
  include('common.php');
  include('header.html');
  $php_path = $_POST['php_path'];
  
  // * NOTE - in client_base, changed curl timeout to 60 (was 10) to avoid having the server not respond in time
?>

<?
  $relative_path = '';
  $server_host = '';
  $logger = new kalturaInstallerLog( $root_dir );
  
  $logger->writeLog('Setting db POST values in global variable $dbdata');
  $dbdata = array(
    'host' => $_POST['kdbhost'],
    'name' => $_POST['kdbname'],
    'user' => $_POST['kdbuser'],
    'pass' => $_POST['kdbpass'],
    'port' => ''
  );
  $logger->writeLog('db POST values set. verifying db port and setting to global $dbdata');
  $dbdata['port'] = (isset($_POST['kdbport']) && $_POST['kdbport'] != '')? $_POST['kdbport']: '3306';

  if (!isset($_POST['php_path']) || $_POST['php_path'] == '')
  {
    $logger->writeLog('can\'t find php executable path');
    die('can\'t find php executable path');
  }
  
  $logger->writeLog('starting replacement function');
  $replacement = do_file_replacements();
  $logger->writeLog('replacement status '.PHP_EOL.$replacement);
  //echo $replacement;
 
  $logger->writeLog('starting db injection function');
  $db_inject = inject_db_content();
  $logger->writeLog('db injection status '.PHP_EOL.$db_inject );
  //echo $db_inject;
 
 
  $logger->writeLog('registering local partner');
  $localreg = registerLocalPartner();
  $logger->writeLog('local registration status '.PHP_EOL.$localreg );
  
  $logger->writeLog('checking if registration with kaltura.com is required');
  if(isset($_POST['will_register']) && $_POST['will_register'] == 1)
  {
    $logger->writeLog('registering partner in kaltura.com');
    $remotereg = registerPartner();
    $logger->writeLog('registration to kaltura.com status '.PHP_EOL.$remotereg );
    //echo $remotereg;
  }
  else
  {
    $logger->writeLog('registration with kaltura.com skipped');
  }
  run_batch();
  set_installed();
?>
 <h2>Installation Complete</h2>
 <div id="stepsMenu">
  <div>
    <ul>
      <li>Welcome</li>
      <li class="done">Verify Requirements</li>
      <li class="done">Set up Database</li>
      <li class="done">Configure</li>
      <li class="active">Finished</li>
    </ul>
   </div> 
  </div>
  
<div id="stepDetails">
    <h2>Kaltura Community Edition Server Installed Successfully</h2>
    <br />

    <?php echo $localreg; ?>
    
    <p><strong>IMPORTANT!</strong></p>
    <ul>
      <li>This information was sent to your email, assuming your mail server was set up and operational on this server.</li>
      <li>If your mail server is not set up, save this information now! you will not be able ro recover it later.</li>
    </ul>
    <br />
    <p><input type="button" style="font-weight: bold;" value=" Continue >" onclick="location.href='installed.php'"/><br/>Go to your server's <a href="installed.php">home page</a> where you will find links to the management console, pre installed samples and more</p>

</div>

<?
include('footer.html');

function parse_inject_sql($sql_file_path)
{
  $queries = array();
  $query = '';
  $file = fopen($sql_file_path, "r");
  $lines=file($sql_file_path); //$lines is an array
  foreach($lines as $line)
  {
    $line = trim($line);
    if ($line[strlen($line)-1] != ';')
    {
      $query .= $line;
    }
    else
    {
      $query .= $line;
      $queries[] = $query;
      $query = '';
    }
  }
  return $queries;
}
  
function inject_db_content()
{
  global $logger, $dbdata, $root_dir;
  $logger->writeLog('function inject_db_content called - starting db injection');
  $server = $dbdata['host'];
  if (isset($_POST['kdbport']) && $_POST['kdbport'] != '')
    $server .= ':'.$_POST['kdbport'];
  
  $logger->writeLog('db port set to '.$dbport);
  
  $queries = parse_inject_sql($root_dir.'install/ce_dbdump.sql');
  $logger->writeLog('injection query is: '.$sql);
  mysql_connect($server , $dbdata['user'], $dbdata['pass']);
  $res = mysql_select_db($dbdata['name']);
  $logger->writeLog('connected to DB');
  if ($res)
  {
    $logger->writeLog('Going to run query');
    foreach($queries as $query)
      $result = mysql_query($query);
  }
  if (!$result)
  {
    $logger->writeLog('failed to run query');
    return '<div class="install failed">An error occured while trying to import DB.<br />Failed on query '.$sql.' <br />Please make sure that your MySql server is up, and run that query manually</div>';
  }
  return '<div class="install passed">Databse imported successfuly !</div>';
}

function do_file_replacements()
{
  global $logger;
  $output = '';
  $logger->writeLog('function do_file_replacements called - starting replacements');
  $logger->writeLog('going to replace values in kConf.php');
  $replace = replace_kConf();
  $logger->writeLog('kConf replacement output: '.$replace);
  $output .= $replace;
  $logger->writeLog('going to replace values in database.ini');
  $replace = replace_database_ini();
  $logger->writeLog('database.ini replacement output: '.$replace);
  $output .= $replace;
  $logger->writeLog('going to replace values in databases.yml');
  $replace = replace_db_yml();
  $logger->writeLog('databases.yml replacement output: '.$replace);
  $output .= $replace;
  
  $logger->writeLog('going to replace values in settings.yml');
  $replace = replace_settings_yml();
  $logger->writeLog('settings.yml replacement output: '.$replace);
  $output .= $replace;

  $logger->writeLog('going to replace values in kaltura_env.sh');
  $replace = replace_kaltura_env();
  $logger->writeLog('kaltura_env.sh replacement output: '.$replace);
  $output .= $replace;
  
  $logger->writeLog('going to replace values in emails_en.ini');
  $replace = replace_emails_ini();
  $logger->writeLog('emails_en.ini replacement output: '.$replace);
  $output .= $replace;
  
  $logger->writeLog('going to replace installation relative root in UIConf files');
  $replace = replace_uiconfs();
  $logger->writeLog('uiconf replacement output: '.$replace);
  $output .= $replace;
  $logger->writeLog('finished replacemets');
  return $output;
}

function replace_uiconfs()
{
  global $logger, $php_path, $relative_path;
  $logger->writeLog('replace_uiconfs called, going to replace UIConfs');
  $command = './run_replace_root.sh '.$php_path.' '.$relative_path;
  $logger->writeLog('replace uiconfs with command '.$command);
  exec($command, $output, $error);
  if ($error)
  {
    $logger->writeLog('failed to replace in uiconf files '.PHP_EOL.print_r($output,true));
    return '<div class="install failed">Failed to replace urls in uiconf files</div>';
  }
  
  $logger->writeLog('successfuly updated uiconf files'.print_r($output,true));
  return '<div class="install passed">UIConfs successfully updated</div>';
}

function replace_settings_yml()
{
  global $logger, $alpha_dir,$root_dir, $template_files;
  $logger->writeLog('replace_settings_yml function called - going to replace in settings.yml');

  $settings_path = $template_files['settings.yml']['source'];
  $settings_target_path = $template_files['settings.yml']['target'];
  $logger->writeLog('source file is: '.$settings_path.' target file is: '.$settings_target_path);
  $settings = file_get_contents($settings_path);
  if (!$settings)
  {
    $logger->writeLog('failed to read settings.yml.template file ');
    return '<div class="install failed">Couldn\'t load settings.yml.template file</div>';
  }
  $logger->writeLog('settings.yml.template file read, going to check for replacement strings');
  
  if (!strpos($settings, 'KALTURA_LOG_DIR'))
  {
    $logger->writeLog('settings.yml.template does not contain the correct replacement string.');
    $logger->writeLog('settings.yml - KALTURA_LOG_DIR: '.strpos($settings, 'KALTURA_LOG_DIR'));
    return '<div class="install failed">settings.yml.template doesn\'t contain the correct replacement string</div>';
  }
    
  $logger->writeLog('replacement string found, replacing settings.yml now');
  $settings_new = str_replace('KALTURA_LOG_DIR', $root_dir.'logs', $settings);
  $logger->writeLog('replacement done, going to write target file');
  $result = file_put_contents($settings_target_path, $settings_new);
  if (!$result)
  {
    $logger->writeLog('could not write target file. result: '.$result); 
    return '<div class="install failed">Couldn\'t write settings.yml.template file</div>';
  }
  
  $logger->writeLog('successfully updated settings.yml');
  return '<div class="install passed">Updated settings.yml</div>';
}

function replace_kaltura_env()
{
  global $logger, $alpha_dir,$root_dir, $template_files, $php_path;
  $logger->writeLog('replace_kaltura_env function called - going to replace in kaltura_env.sh');

  $kenv_path = $template_files['kaltura_env.sh']['source'];
  $kenv_target_path = $template_files['kaltura_env.sh']['target'];
  $logger->writeLog('source file is: '.$kenv_path.' target file is: '.$kenv_target_path);
  $kenv = file_get_contents($kenv_path);
  if (!$kenv)
  {
    $logger->writeLog('failed to read kaltura_env.sh.template file ');
    return '<div class="install failed">Couldn\'t load kaltura_env.sh.template file</div>';
  }
  $logger->writeLog('kaltura_env.sh.template file read, going to check for replacement strings');
  
  if (!strpos($kenv, '{KALTURA_PHP_PATH}'))
  {
    $logger->writeLog('kaltura_env.sh.template does not contain the correct replacement string.');
    $logger->writeLog('kaltura_env.sh - {KALTURA_PHP_PATH}: '.strpos($kenv, '{KALTURA_PHP_PATH}'));
    return '<div class="install failed">kaltura_env.sh.template doesn\'t contain the correct replacement string</div>';
  }
    
  $logger->writeLog('replacement string found, replacing kaltura_env.sh now');
  $kenv_new = str_replace('{KALTURA_PHP_PATH}', $_POST['php_path'], $kenv);
  $logger->writeLog('replacement done, going to write target file');
  $result = file_put_contents($kenv_target_path, $kenv_new);
  if (!$result)
  {
    $logger->writeLog('could not write target file. result: '.$result); 
    return '<div class="install failed">Couldn\'t write kaltura_env.sh file</div>';
  }
  
  $logger->writeLog('successfully updated kaltura_env.sh');
  return '<div class="install passed">Updated kaltura_env.sh</div>';
}

function replace_emails_ini()
{
  global $logger, $alpha_dir,$root_dir, $template_files, $server_host;
  $emailsini_path = $template_files['emails_en.ini']['source'];
  $emailsini_target_path = $template_files['emails_en.ini']['target'];
  $emailsini = file_get_contents($emailsini_path);
  $logger->writeLog('emails_en.ini.template file read, going to calculate value according to form');
  
  if (!$emailsini)
  {
    $logger->writeLog('could not read kConf.php.template');
    return '<div class="install failed">Couldn\'t load kConf.php.template file</div>';
  }
  $logger->writeLog('searching for replacement strings');
  if (!strpos($emailsini, 'KALTURA_HOST'))
  {
    $logger->writeLog('replacement strings not found.');
    $logger->writeLog('emails_en.ini - KALTURA_HOST: '.strpos($emailsini, 'KALTURA_HOST'));
    return '<div class="install failed">emails_en.ini.template doesn\'t contain the correct replacement strings</div>';
  }
  
  $logger->writeLog('replacement string found, replacing...');
  $emailsini_new = str_replace('KALTURA_HOST', $server_host, $emailsini);
  
  $logger->writeLog('replacement done, going to write target in: '.$emailsini_target_path);
  $result = file_put_contents($emailsini_target_path, $emailsini_new);
  if (!$result)
  {
    $logger->writeLog('could not write target, result: '.print_r($result,true));
    return '<div class="install failed">Couldn\'t write emails_en.ini file</div>';
  }
  
  $logger->writeLog('successfuly updated emails_en.ini');
  return '<div class="install passed">Updated emails_en.ini</div>';  
}

function replace_database_ini()
{
  global $logger, $alpha_dir, $template_files, $dbdata;
  
  $db_ini_path = $template_files['database.ini']['source'];
  $db_ini_target_path = $template_files['database.ini']['target'];
  $logger->writeLog('replace_database_ini function called');
  $logger->writeLog('database.ini template file in: '.$db_ini_path.' and target path is: '.$db_ini_target_path);
  
  $db_ini = file_get_contents($db_ini_path);
  if (!$db_ini)
  {
    $logger->writeLog('cannot read database.ini.template file...');
    return '<div class="install failed">Couldn\'t load databases.ini.template file</div>';
  }
  
  $logger->writeLog('database.ini file read, going to find replacement strings');
  if (!strpos($db_ini, 'KALTURA_DB_HOST') ||
      !strpos($db_ini, 'KALTURA_DB_NAME') ||
      !strpos($db_ini, 'KALTURA_DB_USER') ||
      !strpos($db_ini, 'KALTURA_DB_PASS') ||
      !strpos($db_ini, 'KALTURA_DB_PORT'))
  {
    $logger->writeLog('one of the replacement strings was not found in the file. cannot do replacement');
    $logger->writeLog('database.ini - KALTURA_DB_HOST: '.strpos($db_ini,'KALTURA_DB_HOST'));
    $logger->writeLog('database.ini - KALTURA_DB_NAME: '.strpos($db_ini,'KALTURA_DB_NAME'));
    $logger->writeLog('database.ini - KALTURA_DB_USER: '.strpos($db_ini,'KALTURA_DB_USER'));
    $logger->writeLog('database.ini - KALTURA_DB_PASS: '.strpos($db_ini,'KALTURA_DB_PASS'));
    $logger->writeLog('database.ini - KALTURA_DB_PORT: '.strpos($db_ini,'KALTURA_DB_PORT'));
    return '<div class="install failed">databases.ini.template doesn\'t contain the correct replacement strings</div>';
  }
  
  $logger->writeLog('all replacement strings found in database.ini, going to replace');
  $replace_from = array ('KALTURA_DB_HOST', 'KALTURA_DB_NAME', 'KALTURA_DB_USER', 'KALTURA_DB_PASS', 'KALTURA_DB_PORT');
  $replace_to = array ($dbdata['host'], $dbdata['name'], $dbdata['user'], $dbdata['pass'], $dbdata['port']);

  $logger->writeLog('replacing to values: '. print_r($dbdata,true));
  $db_ini_new = str_replace($replace_from, $replace_to, $db_ini);
  
  $logger->writeLog('going to write database.ini file');
  $result = file_put_contents($db_ini_target_path, $db_ini_new);
  if (!$result)
  {
    $logger->writeLog('failed to write database.ini file'.print_r($result,true));
    return '<div class="install failed">Couldn\'t write databases.ini file</div>';
  }

  $logger->writeLog('successfuly wrote database.ini');
  return '<div class="install passed">Updated databases.ini</div>';
}

function replace_db_yml()
{
  global $logger, $alpha_dir, $template_files, $dbdata;
  
  $db_yml_path = $template_files['databases.yml']['source'];
  $db_yml_target_path = $template_files['databases.yml']['target'];
  $logger->writeLog('replace_db_yml function called');
  $logger->writeLog('databases.yml template file in: '.$db_yml_path.' and target path is: '.$db_yml_target_path);

  $db_yml = file_get_contents($db_yml_path);
  if (!$db_yml)
  {
    $logger->writeLog('cannot read databases.yml.template file...');
    return '<div class="install failed">Couldn\'t load databases.yml.template file</div>';
  }

  $logger->writeLog('databases.yml file read, going to find replacement strings');
  if (!strpos($db_yml, 'KALTURA_DB_HOST') ||
      !strpos($db_yml, 'KALTURA_DB_NAME') ||
      !strpos($db_yml, 'KALTURA_DB_USER') ||
      !strpos($db_yml, 'KALTURA_DB_PASS') ||
      !strpos($db_yml, 'KALTURA_DB_PORT'))
  {
    $logger->writeLog('one of the replacement strings was not found in the file. cannot do replacement');
    $logger->writeLog('databases.yml - KALTURA_DB_HOST: '.strpos($db_yml,'KALTURA_DB_HOST'));
    $logger->writeLog('databases.yml - KALTURA_DB_NAME: '.strpos($db_yml,'KALTURA_DB_NAME'));
    $logger->writeLog('databases.yml - KALTURA_DB_USER: '.strpos($db_yml,'KALTURA_DB_USER'));
    $logger->writeLog('databases.yml - KALTURA_DB_PASS: '.strpos($db_yml,'KALTURA_DB_PASS'));
    $logger->writeLog('databases.yml - KALTURA_DB_PORT: '.strpos($db_yml,'KALTURA_DB_PORT'));
    return '<div class="install failed">databases.yml.template doesn\'t contain the correct replacement strings</div>';
  }
  $logger->writeLog('all replacement strings found in databases.yml, going to replace');
  
  $replace_from = array ('KALTURA_DB_HOST', 'KALTURA_DB_NAME', 'KALTURA_DB_USER', 'KALTURA_DB_PASS', 'KALTURA_DB_PORT');
  $replace_to = array ($dbdata['host'], $dbdata['name'], $dbdata['user'], $dbdata['pass'], $dbdata['port']);

  $logger->writeLog('replacing to values: '. print_r($dbdata,true));
  $db_yml_new = str_replace($replace_from, $replace_to, $db_yml);
  
  $logger->writeLog('going to write databases.yml file');
  $result = file_put_contents($db_yml_target_path, $db_yml_new);
  if (!$result)
  {
    $logger->writeLog('failed to write databases.yml file'.print_r($result,true));
    return '<div class="install failed">Couldn\'t write databases.yml file</div>';
  }

  $logger->writeLog('successfuly wrote databases.yml');
  return '<div class="install passed">Updated databases.yml</div>';
}

function replace_kConf()
{
  global $logger, $alpha_dir,$relative_path,$root_dir, $template_files, $server_host;
  $kconf_path = $template_files['kConf.php']['source'];
  $kconf_target_path = $template_files['kConf.php']['target'];
  $kconf = file_get_contents($kconf_path);
  $logger->writeLog('kConf.php.template file read, going to calculate value according to form');
  
  $host = str_replace('http://', '', $_POST['host']);
  if (strpos($host, '/') && strpos($host, '/') != strlen($host)-1) //assume the user provided a full URL (including directory under webroot)
  {
    $logger->writeLog('host from form included relative path, assuming the user knows best, going on.');
  }
  else
  {
    $logger->writeLog('provided host without relative path, checking if relative path needed');
    $CE_abs_path = $root_dir;
    $logger->writeLog('CE absolute path: '.$CE_abs_path);
    $server_root = $_SERVER['DOCUMENT_ROOT'];
    $logger->writeLog('assumed documentRoot: '.$server_root);
    $path_after_host = '';
    if ($CE_abs_path != $server_root)
    {
      $path_after_host = str_replace($server_root, '', $CE_abs_path);
    }
    $relative_path = $path_after_host;
    $logger->writeLog('relative path is: '.$relative_path);
    $host .= $path_after_host;
    $logger->writeLog('host is set to: '.$host);
  }
  $host = rtrim($host, '/');
  $logger->writeLog('trimmed / from host, new host: '.$host);
  $server_host = $host;
  
  if (!$relative_path && strpos($host, '/'))
  {
    $relative_path = substr($host, strpos($host, '/'));
  }
  
  $logger->writeLog('checking if user supllied CDN');
  if (isset($_POST['cdnhost']) && $_POST['cdnhost'] != '' && isset($_POST['iscdnhost']) && $_POST['iscdnhost'] == 1)
  {
    $logger->writeLog('CDN supplied, removing http://');
    $cdnhost = str_replace('http://', '', $_POST['cdnhost']);
  }
  else
  {
    $logger->writeLog('CDN not supllied, setting to same as host');
    $cdnhost = $host;
  }
  $logger->writeLog('CDN host is: '.$cdnhost);
  
  if (!$kconf)
  {
    $logger->writeLog('could not read kConf.php.template');
    return '<div class="install failed">Couldn\'t load kConf.php.template file</div>';
  }
  $logger->writeLog('searching for replacement strings');
  if (!strpos($kconf, 'KALTURA_HOST') ||
      !strpos($kconf, 'KALTURA_CDN') ||
      !strpos($kconf, 'KALTURA_SYSTEM_USERNAME') ||
      !strpos($kconf, 'KALTURA_SYSTEM_PASSWORD'))
  {
    $logger->writeLog('replacement strings not found.');
    $logger->writeLog('kConf.php - KALTURA_HOST: '.strpos($kconf, 'KALTURA_HOST'));
    $logger->writeLog('kConf.php - KALTURA_CDN: '.strpos($kconf, 'KALTURA_CDN'));
    $logger->writeLog('kConf.php - KALTURA_SYSTEM_USERNAME: '.strpos($kconf, 'KALTURA_SYSTEM_USERNAME'));
    $logger->writeLog('kConf.php - KALTURA_SYSTEM_PASSWORD: '.strpos($kconf, 'KALTURA_SYSTEM_PASSWORD'));
    return '<div class="install failed">kConf.php.template doesn\'t contain the correct replacement strings</div>';
  }
  
  $logger->writeLog('replacement string found, replacing...');
  $replace_from = array ('KALTURA_HOST', 'KALTURA_CDN', 'KALTURA_SYSTEM_USERNAME', 'KALTURA_SYSTEM_PASSWORD');
  $replace_to = array ($host, $cdnhost, $_POST['email'], sha1($_POST['password']));
  $kconf_new = str_replace($replace_from, $replace_to, $kconf);
  
  $logger->writeLog('replacement done, going to write target in: '.$kconf_target_path);
  $result = file_put_contents($kconf_target_path, $kconf_new);
  if (!$result)
  {
    $logger->writeLog('could not write target, result: '.print_r($result,true));
    return '<div class="install failed">Couldn\'t write kConf.php file</div>';
  }
  
  $logger->writeLog('successfuly updated kConf.php');
  return '<div class="install passed">Updated kConf.php</div>';
}

function registerPartner()
{
  global $logger;
    $session_user = KalturaSettings::getKalturaSessionUser();
    
    $partner = new KalturaPartner;
    $partner->name = $_POST['name'];
    $partner->url1 = $_POST['host'];
    $partner->appearInSearch = 0;
    $partner->adminName = $_POST['name'];
    $partner->adminEmail = $_POST['email'];
    $partner->description = $_POST['description'];
    $partner->commercialUse = 'non-commercial_use';
    $partner->contentCategories = $_POST['contentCategories'];
    $partner->type = $_POST['type'];
    $partner->phone = $_POST['phone'];
    $partner->describeYourself = $_POST['describe_yourself'];
    $partner->adultContent = $_POST['adult_content'];
    
    $conf = KalturaSettings::getKalturaConf();
    $client = new KalturaClient( $conf );
    $response = $client->registerPartner($session_user, $partner, $_POST['password']);
    $logger->writeLog('registering partner in kaltura using: '.print_r($partner,true));
    $logger->writeLog('remote server response: '.print_r($response,true));
    $logger->writeLog('using client: '.print_r($client,true));
    
    if ($response['result']['partner'])
    {
        $response['result']['partner']['cmsPassword'] = $response['result']['cms_password'];
	return format_success($response['result']['partner']);
    }
    
    return '';
    return format_error($response['error']);
}

function registerLocalPartner()
{
  global $logger, $server_host,$relative_path;
    $session_user = KalturaSettings::getKalturaSessionUser();
    
    $partner = new KalturaPartner;
    $partner->name = $_POST['name'];
    $partner->url1 = $_POST['host'];
    $partner->appearInSearch = 0;
    $partner->adminName = $_POST['name'];
    $partner->adminEmail = $_POST['email'];
    $partner->description = $_POST['description'];
    $partner->commercialUse = 'non-commercial_use';
    $partner->contentCategories = $_POST['contentCategories'];
    $partner->type = $_POST['type'];
    $partner->phone = $_POST['phone'];
    $partner->describeYourself = $_POST['describe_yourself'];
    $partner->adultContent = $_POST['adult_content'];
    
    $conf = KalturaSettings::getKalturaConf( 'http://127.0.0.1'.$relative_path );
    $client = new KalturaClient( $conf );
    $response = $client->hit('ping', $session_user, array() );
    $logger->writeLog('pinged server. response: '.print_r($response,true));
    $response = $client->registerPartner($session_user, $partner, $_POST['password']);

    $logger->writeLog('registering local partner using: '.print_r($partner,true));
    $logger->writeLog('local server response: '.print_r($response,true));
    $logger->writeLog('using client: '.print_r($client,true));
    
    if ($response['result']['partner'])
    {
        $response['result']['partner']['cmsPassword'] = $response['result']['cms_password'];
	return format_success($response['result']['partner'], 1);
    }
    
    return format_error($response['error'], 1);
}

function format_success( $partner_array , $local = false )
{
    $output = '<p>You will need the following details to access your administration console:</p>'.PHP_EOL.'<ul>'.PHP_EOL;
    $output .= '<li>Email:  '.$partner_array['adminEmail'].'</li>'.PHP_EOL;
	$output .= '<li>Password: '.$partner_array['cmsPassword'].'</li>'.PHP_EOL.'</ul>'.PHP_EOL;
   	$output .= '<p>You will need the following details to work with Kaltura API:</p>'.PHP_EOL.'<ul>'.PHP_EOL;
    $output .= '<li>Partner Id: '.$partner_array['id'].'</li>'.PHP_EOL;
    $output .= '<li>Secret: '.$partner_array['secret'].'</li>'.PHP_EOL;
    $output .= '<li>Admin Secret: '.$partner_array['adminSecret'].'</li>'.PHP_EOL.'</ul>'.PHP_EOL;

    return $output;
}

function format_error( $error_array , $local = false )
{
  $local = ($local)? 'Local ' :'';
    $output = '<div class="error"><h2>'.$local.'Registration failed</h2><h3>Error Code: '. ' '
	.'</h3><h4>Error Message: '. print_r($error_array, true) .'</h4></div>';
    return $output;
}
function run_batch()
{
  $command = '../kaltura/alpha/batch/runBatch.sh start';
  exec($command, $output, $error);
}
?>