<?php

require_once("Xml2As3ClientGenerator.php"); 

$generator = new Xml2As3ClientGenerator();
$generator->generate( "../xml/KalturaClient.xml" );

echo "'Mazal Tov' you have a new Kaltura's AS3 client waiting for you in /client folder.";
?>
