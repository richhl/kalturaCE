<?php
require_once("../../bootstrap.php");
$service = $_GET["service"];
$action = $_GET["action"];
$bench_start = microtime(true);
KalturaLog::INFO ( ">------- api_v3 testme [$service][$action]-------");

try
{
$serviceReflector = new KalturaServiceReflector($service);

$actionParams = $serviceReflector->getActionParams($action);
$actionInfo = $serviceReflector->getActionInfo($action);

$actionInfo = array(
	"actionParams" => array(),
    "description" => $actionInfo->description
);

foreach($actionParams as $actionParam)
{
	$paramType = $actionParam->getType();
	$paramName = $actionParam->getName();
	
	$param = array();
	$param["type"] = $paramType;
	$param["name"] = $paramName;
	
	$param["isComplexType"] = false;
	$param["isEnum"] 	= false;
	$param["isArray"] 	= false;
	$param["isObject"] 	= false;
	if ($actionParam->isFile())
	{
		$param["isFile"] = true;
	}
	elseif ($actionParam->isComplexType())
	{
		$param["isComplexType"] = true;
		if ($actionParam->isEnum())
		{
			 $param["isEnum"] = true;
			 $constants = $actionParam->getTypeReflector()->getConstants();
			 
			 foreach($constants as $constant)
			 {
			 	$param["constants"][] = array(
			 		"type" => $constant->getType(),
			 		"name" => $constant->getName(),
			 		"defaultValue" => $constant->getDefaultValue()
			 	);
			 }
		}
		else if ($actionParam->isArray())
		{
			$param["isArray"] = true;
			$param["arrayType"] = $actionParam->getArrayType();
			// loop over the array type properties
		}
		else
		{
			$param["isObject"] = true;
			$properties = $actionParam->getTypeReflector()->getProperties();
			
			foreach($properties as $property)
			{
				$subProperty= array(
					"type" => $property->getType(),
					"name" => $property->getName(),
					"defaultValue" => $property->getDefaultValue(),
					"isEnum" => $property->isEnum(),
					"isComplexType" => $property->isComplexType(),
					"isReadOnly" => $property->isReadOnly(),
					"isInsertOnly" => $property->isInsertOnly(),
					"description" => $property->getDescription() ? $property->getDescription() : ""
				);
				
				if ($property->isEnum())
				{
					$constants = $property->getTypeReflector()->getConstants();
					
					foreach($constants as $constant)
			 		{
						$subProperty["constants"][] = array(
				 			"type" => $constant->getType(),
				 			"name" => $constant->getName(),
				 			"defaultValue" => (int)$constant->getDefaultValue() // casting is due to a bug in php (looks like it was fixed in php 5.2.8)
			 			); 
			 		}
				}
				
				$param["properties"][] = $subProperty;
			}
		}
	}
	else 
	{
		$param["defaultValue"] = $actionParam->getDefaultValue();
	}
	
	$param["description"] = $actionParam->getDescription();
	
	$actionInfo["actionParams"][] = $param;
}
}
catch ( Exception $ex )
{
	KalturaLog::ERR ( "<------- api_v3 testme [$service][$action\n" . 
		 $ex->__toString() .  " " ." -------");
}
//echo print_r($actionInfo);
echo json_encode($actionInfo);
$bench_end = microtime(true);
KalturaLog::INFO ( "<------- api_v3 testme [$service][$action][" . ($bench_end - $bench_start) . "] -------");
?>