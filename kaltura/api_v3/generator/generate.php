<?php 

require_once("../bootstrap.php");

//$generator = new DotNetClientGenerator();
//$generator->generate();

$generator = new Php5ClientGenerator();
$generator->generate();