<?php
class SearchTestSuite extends PHPUnit_Framework_TestSuite
{
    public function __construct ()
    {
    	require_once("tests/bootstrap.php");
    	
        $this->setName(__CLASS__);
        
        $this->addTestSuite('SearchTest');
    }
    
    public static function suite ()
    {
        return new self();
    }
}