<?php

require_once("../bootstrap.php");

KalturaLog::info(">------------------------------------- api_v3 -------------------------------------");
$start = microtime(true);
KalturaLog::notice("API-start ");

$controller = KalturaFrontController::getInstance();
$controller->run();

$end = microtime(true);
KalturaLog::notice("API-end [".($end - $start)."]");
KalturaLog::info("<------------------------------------- api_v3 -------------------------------------");