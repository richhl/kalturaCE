<?php
class MixingTestSuite extends PHPUnit_Framework_TestSuite
{
    public function __construct ()
    {
    	require_once("tests/bootstrap.php");
    	
        $this->setName('MixingTestSuite');
        
        $this->addTestSuite('MixingAddTest');
    }
    
    public static function suite ()
    {
        return new self();
    }
}

