<?php
class KalturaAutoload 
{
	static private $_oldIncludePath = "";
	static private $_classDirs = array();
	static private $_includeDirs = array();
	static private $_classMap = array();
	static private $_classMapFileLocation;
	
	static function register()
	{
		self::$_classDirs = array(
			self::buildPath(KALTURA_ROOT_PATH,"lib","*"),
	   		self::buildPath(KALTURA_ROOT_PATH,"generator"),
	   		self::buildPath(KALTURA_ROOT_PATH,"cache"),
	   		self::buildPath(KALTURA_ROOT_PATH,"vendor","symfony","*"),
	   		self::buildPath(SF_ROOT_DIR,"lib","*"),
	   		self::buildPath(SF_ROOT_DIR,"config"),
	   		self::buildPath(SF_ROOT_DIR,"apps","kaltura","lib","*"),
		);	
		
		self::$_includeDirs = array(
			self::buildPath(KALTURA_ROOT_PATH, "vendor", "symfony"),
			self::buildPath(KALTURA_ROOT_PATH, "vendor", "symfony", "vendor"),
	   		self::buildPath(KALTURA_ROOT_PATH, "vendor", "ZendFramework", "library"),
	   		self::buildPath(SF_ROOT_DIR),
	   		self::buildPath(SF_ROOT_DIR,"lib"),
	   		self::buildPath(SF_ROOT_DIR,"apps","kaltura","lib"),
		);
		
		// register the autoload
		spl_autoload_register(array("KalturaAutoload", "autoload"));
		
		// set include path
		self::$_oldIncludePath = get_include_path();
		set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, self::$_includeDirs));
	}
	
	static function unregister()
	{
		spl_autoload_unregister(array("KalturaAutoload", "autoload"));
		set_include_path(self::$_oldIncludePath);
	}
	
	static function autoload($class)
	{
		// if the class is part of Zend Framework, use Zend's loader
		if (strpos($class, "Zend_") === 0)
		{
			$zendLoaderClass = "Zend_Loader.php";
			require_once(self::buildPath(KALTURA_ROOT_PATH, "vendor", "ZendFramework", "library").str_replace("_", DIRECTORY_SEPARATOR, $zendLoaderClass));
			Zend_Loader::loadClass($class);
			return;
		}
		
		self::$_classMapFileLocation = self::buildFilePath(KALTURA_ROOT_PATH, "cache", "KalturaClassMap.cache");
		
		// if cached map exists, look for the class in the cached map  
		if (file_exists(self::$_classMapFileLocation))
		{
			self::$_classMap = unserialize(file_get_contents(self::$_classMapFileLocation));
			if (array_key_exists($class, self::$_classMap))
			{
				require_once(self::$_classMap[$class]);
				return;
			}
		}
		else 
		{
			// cached map doesn't exists or class was not found, rebuild the cache map
			foreach(self::$_classDirs as $dir)
			{
				if (strpos($dir, DIRECTORY_SEPARATOR."*") == strlen($dir) - 2)
				{
					$dir = substr($dir, 0, strlen($dir) - 2);
					$recursive = true;
				}
				else 
				{
					$recursive = false;
				}
					
				self::scanDirectory($dir, $recursive);
			}
	  		
	   		// save the cached map
	   		file_put_contents(self::$_classMapFileLocation, serialize(self::$_classMap));
	   		
	   		// try to load again
	   		if (array_key_exists($class, self::$_classMap))
				require_once(self::$_classMap[$class]);
		}
	}
	
	static function scanDirectory($directory, $recursive)
	{
		if (!is_dir($directory))
		{
			return;
		}

		foreach(scandir($directory) as $file)
		{
			if ($file[0] != ".") // ignore linux hidden files
			{
				$path = realpath($directory."/".$file);
				if (is_dir($path) && $recursive)
				{
					$found = self::scanDirectory($path, $recursive);
					if ($found)
						return true;
				}
				else if (is_file($path)) 
				{
					$classes = array();
					if (preg_match_all('~^\s*(?:abstract\s+|final\s+)?(?:class|interface)\s+(\w+)~mi', file_get_contents($path), $classes))
					{
						foreach($classes[1] as $class)
						{
							self::$_classMap[$class] = $path;
						}
					}
				}
			}
		}
		return false;
	}
	
	static function buildFilePath()
	{
		$args = func_get_args();
		return implode(DIRECTORY_SEPARATOR, $args);
	}
	
	static function buildPath()
	{
		$args = func_get_args();
		if ($args[count($args) - 1] === "*")
			return implode(DIRECTORY_SEPARATOR, $args);
		else 
			return implode(DIRECTORY_SEPARATOR, $args) . DIRECTORY_SEPARATOR;
	}
}

?>