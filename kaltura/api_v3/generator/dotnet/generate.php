<?php 

require_once("../../bootstrap.php");

$generator = new DotNetClientGenerator("../xml/KalturaClient.xml");
$generator->generate();