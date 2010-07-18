<?php
require_once("../../bootstrap.php");
KalturaLog::setContext("TESTME");

$service = $_GET["service"];
$serviceReflector = new KalturaServiceReflector($service);

$actions = $serviceReflector->getActions();
$actions = array_keys($actions);
sort($actions);
// get the friendly name for all the actions
foreach($actions as &$action)
{
    $action = $serviceReflector->getActionInfo($action)->action;
}

echo json_encode($actions);
?>