<?php
include('kaltura_client_base.php');
include('kaltura_client.php');

class KalturaSettings
{
  const KalturaSettings_SERVER_URL = "http://www.kaltura.com";
  const KalturaSettings_ANONYMOUS_USER_ID = "Anonymous";
  
  public static function getKalturaConf( $serverUrl = "")
  {
    $conf = new KalturaConfiguration(0,0);
    if( $serverUrl != "")
    {
      $conf->serviceUrl = $serverUrl;
    }
    else
    {
      $conf->serviceUrl = self::KalturaSettings_SERVER_URL;
    }
    return $conf;
  }
  
  public static function getKalturaSessionUser()
  {
    $su = new KalturaSessionUser();
    return $su;
  }
}
?>
