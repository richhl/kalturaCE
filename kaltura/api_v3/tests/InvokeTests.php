<?php
require_once 'PHPUnit/Framework.php';

class InvokeTests extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		static $loaderRegistered = false;
		if (!$loaderRegistered)
		{
			require_once("bootstrap.php");
			KalturaAutoload::register();
			$loaderRegistered = true;
		}
	}
	
	public function testBasicInvoke()
	{
		$requestParams = array(
			"entryId" => "1q2w3e4r",
		);
		
		$dispatcher = KalturaDispatcher::getInstance();
		$result = $dispatcher->dispatch("media", "get", $requestParams);
		$this->assertType("KalturaMediaEntry", $result);
		$this->assertEquals("1q2w3e4r", $result->id);
	}
	
	public function testInvokeOfInvalidServiceOrAction()
	{
		$dispatcher = KalturaDispatcher::getInstance();
		try 
		{
			$dispatcher->dispatch("noservice", "noaction", array());
		}
		catch(KalturaAPIException $ex)
		{
			$dummyEx = new KalturaAPIException(KalturaErrors::SERVICE_DOES_NOT_EXISTS);
			$this->assertSame($dummyEx->getCode(), $ex->getCode());
			return; 
		}
		
		$this->fail("Expecting exception");
	}
}