<?php 
require_once("../bootstrap.php");

$config = new Zend_Config_Ini("config.ini");

foreach($config as $name => $item)
{
	$generator = $item->get("generator");
	if ($generator === null)
		throw new Exception("No generator for [".$name."]");
		
	$include = $item->get("include");
	$exclude = $item->get("exclude");
	if ($include !== null && $exclude !== null)
		throw new Exception("Only include or exclude should be declared");
		
	if (!class_exists($generator))
		throw new Exception("Generator [".$generator."] not found");
		
	$includeList = getServicesIncludeList($include, $exclude);
	
	$reflectionClass = new ReflectionClass($generator);
	$fromXml = $reflectionClass->isSubclassOf("ClientGeneratorFromXml");
	$fromPhp = $reflectionClass->isSubclassOf("ClientGeneratorFromPhp");
	if ($fromXml)
	{
		// first generate the xml
		$xmlGenerator = new XmlClientGenerator();
		$xmlGenerator->setIncludeList($includeList);
		$xmlGenerator->generate();
		$files = $xmlGenerator->getOutputFiles();
		file_put_contents("temp.xml", $files["KalturaClient.xml"]);
		
		$instance = $reflectionClass->newInstance("temp.xml");
		
		if (isset($item->params))
		{
			foreach($item->params as $key => $val)
			{
				$instance->setParam($key, $val);
			}
		}
	}
	else if ($fromPhp)
	{
		$instance = $reflectionClass->newInstance();
		$instance->setIncludeList($includeList);
	}
	
	$instance->generate();
	$outputPath = "output".DIRECTORY_SEPARATOR.$name;
	if (realpath($outputPath) === false)
		mkdir($outputPath, "0777", true);

	$files = $instance->getOutputFiles();
	foreach($files as $file => $data)
	{
		$filePath = realpath($outputPath).DIRECTORY_SEPARATOR.$file;
		$dirName = pathinfo($filePath, PATHINFO_DIRNAME);
		if (!file_exists($dirName))
			mkdir($dirName, "0777", true);
			
		file_put_contents($filePath, $data);
	}
	
	if ($fromXml)
		unlink("temp.xml");
}

function getServicesIncludeList($include, $exclude)
{
	// load full list of actions and services
	$fullList = array();
	$serviceMap = KalturaServicesMap::getMap();
	$services = array_keys($serviceMap);
	foreach($services as $service)
	{
		$serviceReflector = new KalturaServiceReflector($service);
		$actions = $serviceReflector->getActions();
		foreach($actions as &$action) // we need only the keys
			$action = null;
		$fullList[$service] = $actions;
	}
				
	$includeList = array();
	if ($include !== null) 
	{
		$tempList = explode(",", str_replace(" ", "", $include));
		foreach($tempList as $item)
		{
			list($service, $action) = explode(".", strtolower($item));
			if (!key_exists($service, $includeList))
				$includeList[$service] = array();
				
			if ($action == "*")
				$includeList[$service] = $fullList[$service]; 
			else 
				$includeList[$service][$action] = null; 
		}
	}
	else if ($exclude !== null)
	{
		$includeList = $fullList;
		$tempList = explode(",", str_replace(" ", "", $exclude));
		foreach($tempList as $item)
		{
			list($service, $action) = explode(".", strtolower($item));
				
			if ($action == "*")
				unset($includeList[$service]);
			else 
				unset($includeList[$service][$action]); 
		}
	}
	else
	{
		$includeList = $fullList;
	}
	
	return $includeList;
}

die;

//$generator = new DotNetClientGenerator();
//$generator->generate();

$generator = new DotNetClientGenerator("xml/KalturaClient.xml", "output", "dotnet/source");
$generator->generate();

$a = 1;