<?php
$executables = false;
function verifyRequirements()
{
  global $reqs;
  $output = '';
  foreach($reqs as $req)
  {
    $function = 'verify_'.$req;
    $output .= $function();
  }
  return $output;
}

function verify_exec()
{
  global $executables,$requirements_stats,$reqs_error;
  // only check for exec, it gives the best output.
  if (function_exists('exec') &&  function_exists('passthru'))
  {
    $requirements_stats++;
    $executables = 'exec';
    return '';
  }
  $reqs_error = false;
  return '<li class="verify failed">PHP system commands (exec, passthru) are disabled<br />Please enable these functions.</li>';
}

function verify_php52()
{
  global $requirements_stats,$reqs_error;
  $min_version = '5.2.0';
  if (function_exists('version_compare'))
  {
    if(version_compare( phpversion(), $min_version ) >= 0)
    {
      $requirements_stats++;
      return '<li class="verify passed">PHP version - <strong>OK</strong> (>= '.$min_version.')</li>';
    }
  }
  $reqs_error = false;
  return '<li class="verify failed">Required PHP version '.$min_version.' and above. &nbsp;You need to upgrade your PHP</li>';
}

function verify_phpcli()
{
  global $requirements_stats,$reqs_error;
  // try running php from environment path
  $optional_paths = array(
    0 => '/Applications/XAMPP/xamppfiles/bin/php', // try to find common mac-xampp php-cli
    1 => '/opt/lampp/bin/php', // try to find common linux-xampp php-cli
    2 => 'C:\xampp\php\php', // try to find common windows-xampp php-cli
    3 => 'C:\Program Files\xampp\php\php', // try to find another common windows-xampp php-cli
    4 => 'php', // try to find php-cli in environment path
  );
  $errorFlag = true;
  foreach($optional_paths as $tryPath)
  {
    exec($tryPath.' -v', $output, $error);
    if(!$error)
    {
      $errorFlag = false;
      $_SESSION['php_path_value'] = $tryPath;
      break;
    }
    unset($output);
    unset($error);
  }
  if ($errorFlag)
  {
    $_SESSION['php_path_value'] = null;
    $reqs_error = false;
    return '<li class="verify failed">
      You must have php-cli. &nbsp;This is required in order to run batch jobs, etc.<br />
      Please install php-cli and make sure that php executable is in PATH<br />
      WINDOWS users - after adding php executable to the PATH, you will need to restart<br />
      your computer in order for the changes to take effect.</li>';
  }
  $requirements_stats++;
  return '<li class="verify passed">php-cli - <strong>found</strong></li>';
}

function verify_GD()
{
  global $requirements_stats,$reqs_error;
 
  if(function_exists('gd_info'))
  {
    $requirements_stats++;
    return '<li class="verify passed">PHP GD - <strong>available</strong></li>';
  }
  $reqs_error = false;
  return '<li class="verify failed">PHP must be installed with GD support.<br />In most linux distributions it can be installed using the default package manager.</li>';
}

function verify_DOMDocument()
{
  global $requirements_stats,$reqs_error;
  if (function_exists('DOMDocument'))
  {
    $reqs_error = false;
    return '<li class="verify failed">DOMDocument is not available.<br />Please check your PHP installation and add DOMDocument support.</li>';
  }

  $requirements_stats++;
  return '<li class="verify passed">PHP DOMDocument - <strong>available</strong></li>';
}

function verify_libcURL()
{
  global $requirements_stats,$reqs_error;
  if(function_exists('curl_init'))
  {
    $requirements_stats++;
    return '<li class="verify passed">PHP libcURL - <strong>available</strong></li>';
  }
  $reqs_error = false;
  return '<li class="verify failed">libcURL is not available.<br />Please check your PHP installation and add libcURL support.</li>';
}
function verify_memcache()
{
  global $requirements_stats,$memcache_server,$warnings;
  $requirements_stats++;
  if (class_exists('Memcache'))
  {
    $m = new Memcache;
    $connection = @$m->connect('localhost', 11211);
  }
  if (!$connection)
  {
    $output = '<li class="verify optional">memcache is recommended for better performance, however it is not mandatory, and you can continue installation without it.<br />'.
      'This test assumes memcache is installed on localhost and listening to port 11211.</li>';
    $warnings[] = $output;
    return $output;
  }
  $memcache_server = true;
  return '<li class="verify passed">memcache - <strong>available</strong></li>';
}


function check_file_perms($filename)
{
  clearstatcache();
  return is_writable($filename);
}
function verify_upload()
{
  global $requirements_stats,$root_dir,$perms_script;
  $upload_folder = $root_dir.'content/uploads';
  if (check_file_perms($upload_folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$upload_folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$upload_folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';
}


function verify_logs()
{
  global $requirements_stats,$root_dir,$perms_script;
  $logs_folder = $root_dir.'logs';
  if (check_file_perms($logs_folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$logs_folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$logs_folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';
}

function verify_cache()
{
  global $requirements_stats,$alpha_dir,$perms_script;
  $cache_folder = $alpha_dir.'cache';
  if (check_file_perms($cache_folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$cache_folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$cache_folder.' has no write permissions. &nbsp;Make sure this file is writable by Apache.</li>';
}

function verify_indicators()
{
  global $requirements_stats,$root_dir,$perms_script;
  $indi_folder = $root_dir.'indicators';
  if (check_file_perms($indi_folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$indi_folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$indi_folder.' has no write permissions. &nbsp;Make sure this file is writable by Apache.</li>';
}

function verify_batchwatch()
{
  global $requirements_stats,$root_dir,$perms_script;
  $error = '<li class="verify failed">Folder: '.$root_dir.'batchwatch and all its subdirectories and files should have write permissions.</li>';
  $arch_status = is_writable($root_dir.'batchwatch');
  if (!$arch_status)
  {
    $perms_script = true;
    return $error;
  }
  
  $arch_dir = opendir($root_dir.'batchwatch');
  while($arch_sub = readdir($arch_dir))
  {
    if($arch_sub == '..' || $arch_sub == '.') continue;
    if (!is_writable($root_dir.'batchwatch/'.$arch_sub))
    {
      $perms_script = true;
      return str_replace($root_dir.'batchwatch', $root_dir.'batchwatch/'.$arch_sub, $error);
    }
  }
  $requirements_stats++;
  return '<li class="verify passed">Permissions on '.$root_dir.'batchwatch - <strong>OK</strong></li>';
}

function verify_content()
{
  global $requirements_stats,$root_dir,$perms_script;
  $error = '<li class="verify failed">Folder: '.$root_dir.'content and all its subdirectories and files should have write permissions</li>';
  $content_status = is_writable($root_dir.'content');
  if (!$content_status)
  {
    $perms_script = true;
    return $error;
  }
  
  $content_dir = opendir($root_dir.'content');
  while($content_sub = readdir($content_dir))
  {
    if($content_sub == '..' || $content_sub == '.') continue;
    if (!is_writable($root_dir.'content/'.$content_sub))
    {
      $perms_script = true;
      return str_replace($root_dir.'content', $root_dir.'content/'.$content_sub, $error);
    }
  }
  
  $requirements_stats++;
  return '<li class="verify passed">Permissions on '.$root_dir.'content - <strong>OK</strong></li>';
}

function verify_appsconfig()
{
  global $requirements_stats,$alpha_dir;
  $folder = $alpha_dir.'apps/kaltura/config';
  if (check_file_perms($folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$folder.' - <strong>OK</strong></li>';
  }
  return '<li class="verify failed">Folder: '.$folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';  
}

function verify_alphaconfig()
{
  global $requirements_stats,$alpha_dir,$perms_script;
  $folder = $alpha_dir.'config';
  if (check_file_perms($folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';  
}

function verify_api3config()
{
  global $requirements_stats,$api_v3_dir,$perms_script;
  $folder = $api_v3_dir.'config';
  if (check_file_perms($folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';
}

function verify_alphabatch()
{
  global $requirements_stats,$alpha_dir,$perms_script;
  $folder = $alpha_dir.'batch';
  if (check_file_perms($folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';
}

function verify_api3cache()
{
  global $requirements_stats,$api_v3_dir,$perms_script;
  $folder = $api_v3_dir.'cache';
  if (check_file_perms($folder))
  {
    $requirements_stats++;
    return '<li class="verify passed">Permissions on '.$folder.' - <strong>OK</strong></li>';
  }
  $perms_script = true;
  return '<li class="verify failed">Folder: '.$folder.' has no write permissions. &nbsp;Make sure this file is writable by apache.</li>';
}


function verify_conversions()
{
  global $requirements_stats,$root_dir,$perms_script;
  $error = '<li class="verify failed">Folder: '.$root_dir.'conversions and all its subdirectories and files should have write permissions</li>';
  $conv_status = is_writable($root_dir.'conversions');
  if (!$conv_status)
  {
    $perms_script = true;
    return $error;
  }
  
  $conv_dir = opendir($root_dir.'conversions');
  while($conv_sub = readdir($conv_dir))
  {
    if($conv_sub == '..' || $conv_sub == '.') continue;
    if (!is_writable($root_dir.'conversions/'.$conv_sub))
    {
      $perms_script = true;
      return str_replace($root_dir.'conversions', $root_dir.'conversions/'.$conv_sub, $error);
    }
  }
  $requirements_stats++;
  return '<li class="verify passed">Permissions on '.$root_dir.'conversions - <strong>OK</strong></li>';
}


function verify_archive()
{
  global $requirements_stats,$root_dir,$perms_script;
  $error = '<li class="verify failed">Folder: '.$root_dir.'archive and all its subdirectories and files should have write permissions</li>';
  $arch_status = is_writable($root_dir.'archive');
  if (!$arch_status)
  {
    $perms_script = true;
    return $error;
  }
  
  $arch_dir = opendir($root_dir.'archive');
  while($arch_sub = readdir($arch_dir))
  {
    if($arch_sub == '..' || $arch_sub == '.') continue;
    if (!is_writable($root_dir.'archive/'.$arch_sub))
    {
      $perms_script = true;
      return str_replace($root_dir.'archive', $root_dir.'archive/'.$arch_sub, $error);
    }
  }
  $requirements_stats++;
  return '<li class="verify passed">Permissions on '.$root_dir.'archive - <strong>OK</strong></li>';  
}

function verify_mail()
{
  global $requirements_stats, $mail_server,$warnings;
  $smtp_server = (ini_get('SMTP'))? ini_get('SMTP') :"localhost";
  $port = (ini_get('smtp_port'))? ini_get('smtp_port'): 25;
  $handle = @fsockopen($smtp_server,$port,$errorno, $errstr, $timeout = 5);
  $requirements_stats++;
  if ($handle)
  {
    fputs($handle, "QUIT\r\n");
    $mail_server = true;
    return '<li class="verify passed">Mail server - <strong>found</strong> (at '.$smtp_server.':'.$port.')</li>';
  }
  $output = '<li class="verify optional">Failed to connect to mailserver at "'.$smtp_server.'" port '.$port.'. &nbsp;Verify your "SMTP" and "smtp_port" setting in php.ini. &nbsp;Kaltura Server uses email sending for user/password changes and reminders as well as notifications on background processes completion. It is recommended, though not mandatory, that you configure your mail server accordingly.</li>';
  $warnings[] = $output;
  return $output;
}

function verify_phpmysql()
{
  global $requirements_stats,$reqs_error;
  if (!function_exists('mysql_connect'))
  {
    $reqs_error = false;
    return '<li class="verify failed">Your PHP is missing MySql support.  &nbsp;If you installed LAMP from your distibution packages, make sure you have php5-mysql package installed.<br />To pass this requirement, make sure you can call PHP mysql_connect() function.</li>';
  }
  $requirements_stats++;
  return '<li class="verify passed">PHP MySql support - <strong>OK</strong></li>';
}

function verify_ffmpeg()
{
  global $requirements_stats, $root_dir,$reqs_error;
  $exec_ffmpeg = '../kaltura/bin/ffmpeg/ffmpeg -version';
  $os = 'nix';
  if (isset($_SERVER['SERVER_SOFTWARE']))
  {
    if(substr_count($_SERVER['SERVER_SOFTWARE'], 'Win32'))
    {
      $os = 'win';
    }
  }
  else
  {
    if(substr_count(strtolower($_SERVER['OS']), 'windows'))
    {
      $os = 'win';
    }
  }
  $exec_ffmpeg = ($os == 'win')? str_replace("/", "\\", $exec_ffmpeg): $exec_ffmpeg;
  exec($exec_ffmpeg, $output, $error);
  if ($error)
  {
    $reqs_error = false;
    return '<li class="verify failed">Could not run FFMPEG. &nbsp;FFMPEG is crucial for converting media to FlashVideo format. &nbsp;The system should be able to run the script located at: <br />'.$root_dir.'kaltura/bin/ffmpeg/ffmpeg - please make sure apache can run that script.</li>';
  }
  
  $requirements_stats++;
  return '<li class="verify passed">FFMPEG - <strong>available</strong></li>';
}
?>