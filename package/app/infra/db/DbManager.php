<?php
/**
 * Our version of sfDatabaseManager - taken from the generated version from config_core_compile.yml.php
 *
 */
class DbManager 
{
	protected $databases = array();
	protected $config;
	
	public function setConfig(Zend_Config_Ini $config)
	{
		$this->config = $config;
	}
	
	public function getConfig($config)
	{
		return $this->config;
	}

	private static $extraConfigurations = array();
	
	public static function addExtraConfiguration(Zend_Config_Ini $config)
	{
		self::$extraConfigurations[] = $config;
	}
	
	public function getDatabase($name = 'default') 
	{
		if (isset ( $this->databases [$name] )) 
		{
			return $this->databases [$name];
		}
		$error = 'Database "%s" does not exist';
		$error = sprintf ( $error, $name );
		throw new sfDatabaseException ( $error );
	}
	
	public function initialize() 
	{
		if (is_null($this->config))
			throw new Exception("Config was not set");
			
		$config = $this->config;
		foreach ( $config as $db ) 
		{
			$database = new sfPropelDatabase();
			$database->initialize ( $db->database->toArray (), $config->key () );
			$this->databases [$config->key ()] = $database;
		}
		
		foreach(self::$extraConfigurations as $extraConfig)
		{
			foreach($extraConfig as $db)
			{
				$database = new sfPropelDatabase();
				$database->initialize($db->database->toArray(), $config->key());
				$this->databases[$config->key()] = $database;			   
			}
		}		
		
		// will write more info to the log
		Creole::registerDriver('*', 'infra.db.KDebugConnection');
		
		Propel::setConfiguration(sfPropelDatabase::getConfiguration());
		Propel::initialize();
		
		Propel::setLogger(KalturaLog::getInstance());
	}
	
	public function shutdown() 
	{
		foreach ( $this->databases as $database ) {
			$database->shutdown ();
		}
	}
}
?>