<?php
/**
 * Our version of sfDatabaseManager - taken from the generated version from config_core_compile.yml.php
 *
 */
class DbManager
{
	
	 protected  $databases = array();
  public function getDatabase($name = 'default')
  {
    if (isset($this->databases[$name]))
    {
      return $this->databases[$name];
    }
        $error = 'Database "%s" does not exist';
    $error = sprintf($error, $name);
    throw new sfDatabaseException($error);
  }
  
  
  public function initialize()
  {
  	$config = new Zend_Config_Ini(realpath(KALTURA_ROOT_PATH.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."database.ini"));
  	foreach($config as $db)
  	{
		$database = new sfPropelDatabase();
		$database->initialize($db->database->toArray(), $config->key());
		$this->databases[$config->key()] = $database;
  	}

  	// will write more info to the log
	Creole::registerDriver('*', 'symfony.addon.creole.drivers.sfDebugConnection');
	sfDebugConnection::setLogger(KalturaLog::getInstance());

	Propel::setConfiguration(sfPropelDatabase::getConfiguration());
	Propel::initialize();

	Propel::setLogger( KalturaLog::getInstance());
  }
  
  
  public function shutdown()
  {
        foreach ($this->databases as $database)
    {
      $database->shutdown();
    }
  }
}
?>