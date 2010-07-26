<?php

class myConf
{
	/**
	 * Configuration
	 * @var array
	 */
	static $config = array();
	
	/**
	 * Set a new $value for $key
	 * @param string $key key name
	 * @param * $value value to set
	 */
	public static function set($key, $value)
	{
		self::$config[$key] = $value;
	}
	
	/**
	 * @param string $key
	 * @return the key's value, or null if key wasn't found
	 */
	public static function get($key)
	{
		if (isset(self::$config[$key])) {
			return self::$config[$key];
		}
		return null;
	}
	
	/**
	 * @return return the full $config array
	 */
	public static function getAll()
	{
		return self::$config;
	}
	
	/**
	 * Erase all configurations
	 */
	public static function delAll()
	{
		self::$config = array();
	}
	
	
	/**
	 * Write configurations to file as key = value
	 * @param string $filename file name to write
	 * @return true on success, or ErrorObject on failure
	 */
	public static function writeToFile($filename)
	{
		$data = '';
		foreach (self::$config as $key => $value) {
			$data = $data . $key.' = '.$value.PHP_EOL;
		}
		return FileUtils::writeFile($filename, $data);
	}
	
	/**
	 * Load configurations from file
	 * @param $filename file name to read from
	 */
	public static function loadFromFile($filename)
	{
		if (is_file($filename)) {
			self::$config = parse_ini_file($filename);
		}
	}
}