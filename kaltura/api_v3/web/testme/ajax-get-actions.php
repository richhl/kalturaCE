<?php
require_once("../../bootstrap.php");

$service = $_GET["service"];
$serviceReflector = new KalturaServiceReflector($service);

$actions = array_keys($serviceReflector->getActions());
echo json_encode($actions);
?>