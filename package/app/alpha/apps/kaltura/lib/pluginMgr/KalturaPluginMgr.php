<?php
class KalturaPluginMgr
{
	public static function isPlugin($serviceName)
	{
		// service name that starts with _ for example _streamapi
		// or as plugin in case of multiple service per plugin _pluginname_servicename
		// is considered to be a plugin
		if(strpos($serviceName, '_') === 0)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	public static function getInstance($serviceName)
	{
		if(substr_count($serviceName, '_') > 1)
		{
			$parts = explode('_', ltrim($serviceName, '_'));
			$pluginName = $parts[0];
		}
		else
		{
			$pluginName = str_replace('_', '', $serviceName).'Plugin';
		}
		
		$pluginInstance = new $pluginName;
		return $pluginInstance;
	}
	
	public static function addPluginByServiceName($service)
	{
		$pluginInstance = KalturaPluginMgr::getInstance($service);
		self::addPlugin($pluginInstance);
	}
	
	public static function addPluginByName($pluginName)
	{
		if($pluginName && class_exists($pluginName))
		{
			$pluginInstance = new $pluginName;
			self::addPlugin($pluginInstance);
		}
	}
	
	/**
	* this function adds services of specific plugin.
	* the plugin name is exctracted from the service name using KalturaPluginMgr
	*/
	public static function addPlugin($pluginInstance)
	{
	    $services = $pluginInstance->getServicesMap();
	    
	    foreach($services as $service => $class)
	    	KalturaServicesMap::addService($service, $class);
	    	
	    // TODO - add autoload extension
	    
	    // TODO - add service config
	    KalturaServiceConfig::setStrictMode(false);
	    KalturaServiceConfig::addSecondaryConfigTables($pluginInstance->getServiceConfig());
	    
	    // TODO - add database configuration
	    DbManager::addExtraConfiguration($pluginInstance->getDatabaseConfig());
	}
	
	public static function loadDefaultPlugins()
	{
		if (kConf::hasParam("default_plugins"))
		{
			$plugins = kConf::get("default_plugins");
			if (is_array($plugins))
			{
				foreach($plugins as $plugin)
				{
					self::addPluginByName($plugin);
				}
			}
		}
	}
}
?>