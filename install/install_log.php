<?php
class kalturaInstallerLog
{
  private $logfile;
  
  function kalturaInstallerLog( $root_dir )
  {
    $this->logfile = $root_dir.'logs/kaltura_install.log';
    $f = fopen($this->logfile, 'w');
    if( !$f )
      die('can\'t write log file');
      
    fclose($f);
  }
  
  function writeLog($data)
  {
    $output = '['.date('Y-m-d H:i:s').'] '.$data.PHP_EOL;
    $f = fopen($this->logfile, 'a');
    fwrite($f, $output );
    fclose($f);
  }
}
?>