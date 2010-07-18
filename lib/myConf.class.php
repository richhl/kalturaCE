<?php

class myConf
{
	
	static $config = array();
	
	
	public static function set($key, $value)
	{
		self::$config[$key] = $value;
	}
	
	
	public static function get($key)
	{
		if (isset(self::$config[$key])) {
			return self::$config[$key];
		}
		return null;
	}
	
	
	public static function getAll()
	{
		return self::$config;
	}
	
	public static function delAll()
	{
		self::$config = array();
	}
	
	
	public static function writeToFile($filename)
	{
		$data = '';
		foreach (self::$config as $key => $value) {
			$data = $data . $key.' = '.$value.PHP_EOL;
		}
		return FileUtils::writeFile($filename, $data);
	}
	
	
	public static function loadFromFile($filename)
	{
		if (is_file($filename)) {
			self::$config = parse_ini_file($filename);
		}
	}
}