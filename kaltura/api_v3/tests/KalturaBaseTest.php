<?php
require_once("PHPUnit/Framework/TestCase.php");

abstract class KalturaBaseTest 
{
    protected function setUp ()
    {
        parent::setUp();
    }

    protected function tearDown ()
    {
        parent::tearDown();
    }
    
    public function __construct ()
    {
	
    }
}