<?php
require_once("../../bootstrap.php");
require_once('systemAuth.php');

function getP ( $param_name , $default_val = NULL , $allow_zero = false )
{
	$value = @$_REQUEST[$param_name];
	if ( $allow_zero && ($value === '0' ) ) return "0";
	if ( ! $value && $default_val )
		return $default_val;
	return $value;
}


$databaseManager = new DbManager();
$databaseManager->initialize();

Propel::setLogger( KalturaLog::getInstance());

?>