<?php
error_reporting(E_ALL);
$server_root = @$argv[1];
if (!$server_root)
{
  echo 'must have server root as argument';
  exit(4);
}

include('replace_root.php');

if(is_dir('../content/uiconf'))
{
  deleteDirectory('../content/uiconf');
  echo "deleting ../content/uiconf\n";
}
if(is_dir('../content/uiconf.template'))
{
  recurse_copy_and_change('../content/uiconf.template', '../content/uiconf', $server_root);
}


function recurse_copy_and_change($src,$dst, $server_root) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy_and_change($src . '/' . $file,$dst . '/' . $file, $server_root);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
                replace_root($dst . '/' . $file, $server_root);
            }
        }
    }
    closedir($dir);
} 

function deleteDirectory($dir) {
if (!file_exists($dir)) return true;
    if (!is_dir($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) return false;
    }
    return rmdir($dir);
}