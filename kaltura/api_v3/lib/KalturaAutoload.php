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
			self::buildPath(KALTURA_ROOT_PATH,"lib"),
	   		self::buildPath(KALTURA_ROOT_PATH,"actions"),
	   		self::buildPath(KALTURA_ROOT_PATH,"generator"),
	   		self::buildPath(KALTURA_ROOT_PATH,"cache"),
	   		self::buildPath(KALTURA_ROOT_PATH,"vendor","symfony"),
	   		self::buildPath(SF_ROOT_DIR,"lib"),
	   		self::buildPath(SF_ROOT_DIR,"config"),
	   		self::buildPath(SF_ROOT_DIR,"apps","kaltura","lib"),
	   		self::buildPath(SF_ROOT_DIR,"apps","kaltura","lib","batch"),
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
		
		$alias  = KalturaAutoloadNonStandard::getClassAlias ( $class ); 
		
		// cached map doesn't exists, scan the file system
		foreach(self::$_classDirs as $dir)
		{
			self::scanDirectory($dir, $class , $alias );
		}
  		
   		// finally cache the modified map
   		file_put_contents(self::$_classMapFileLocation, serialize(self::$_classMap));
	}
	
	static function scanDirectory($directory, $class , $alias = null)
	{
		// don't need to scan if already found
		if (isset ( self::$_classMap[$class]) ) return true;
	
		if (!is_dir($directory))
		{
			return true;
		}

		foreach(scandir($directory) as $file)
		{
			if ($file[0] != ".") // ignore linux hidden files
			{
				$path = realpath($directory."/".$file);
				if (is_dir($path))
				{
					$found = KalturaAutoload::scanDirectory($path, $class , $alias);
					if ($found)
						return true;
				}
				else 
				{
					$file_name_to_compare = $alias ? $alias : $class;
					if ($file == ($file_name_to_compare.".php") || $file == ($file_name_to_compare.".class.php"))
					{
						require_once($path);
						self::$_classMap[$class] = $path;
						return true;
					}
				}
			}
		}
		return false;
	}
	
	static function buildPath()
	{
		$args = func_get_args();
		return implode( DIRECTORY_SEPARATOR , $args ) . DIRECTORY_SEPARATOR; 
	}
	
	static function buildFilePath ()
	{
		$args = func_get_args();
		return implode( DIRECTORY_SEPARATOR , $args ) ; 
	}
}

?>