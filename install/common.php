<?php
$root_dir = rtrim(str_replace('install', '', dirname(__FILE__)),'/').'/';
$alpha_dir = $root_dir.'kaltura/alpha/';
$api_v3_dir = $root_dir.'kaltura/api_v3/';
$template_files = array(
  'kConf.php' => array(
    'source' => 'templates/kConf.php.template',
    'target' => $alpha_dir.'config/kConf.php' ,
  ),
  'databases.yml' => array(
    'source' => 'templates/databases.yml.template',
    'target' => $alpha_dir.'config/databases.yml' ,
  ),
  'settings.yml' => array(
    'source' => 'templates/settings.yml.template',
    'target' => $alpha_dir.'apps/kaltura/config/settings.yml' ,
  ),
  'database.ini' => array(
    'source' => 'templates/database.ini.template',
    'target' => $api_v3_dir.'config/database.ini' ,
  ),
  'logger.ini' => array(
    'source' => 'templates/logger.ini.template',
    'target' => $api_v3_dir.'config/logger.ini' ,
  ),  
  'kaltura_env.sh' => array(
    'source' => 'templates/kaltura_env.sh.template',
    'target' => $alpha_dir.'batch/kaltura_env.sh',
  ),
  'emails_en.ini' => array(
    'source' => 'templates/emails_en.ini.template',
    'target' => $alpha_dir.'apps/kaltura/config/emails_en.ini' ,
  ),
  'templates_path' => $root_dir.'install/templates/',
);
$php_path = '';
is_installed();
function is_installed()
{
    global $root_dir;
    clearstatcache();
    $file_name = $root_dir.'logs/.kinstalled';

    if (file_exists($file_name) && filesize($file_name))
    {
        header("Location: ../index.php");
    }
    
    return false;
}

function set_installed()
{
    global $root_dir;
    $time = date('Y-m-d H:i:s');
    $file_name = $root_dir.'logs/.kinstalled';
    file_put_contents($file_name, $time);
}
?>