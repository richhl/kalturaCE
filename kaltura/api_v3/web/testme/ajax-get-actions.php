<?php
require_once("../../bootstrap.php");

$service = $_GET["service"];
$serviceReflector = new KalturaServiceReflector($service);

$actions = $serviceReflector->getActions();
$actions = array_keys($actions);

// get the friendly name for all the actions
foreach($actions as &$action)
{
    $action = $serviceReflector->getActionInfo($action)->action;
}

echo json_encode($actions);
?>