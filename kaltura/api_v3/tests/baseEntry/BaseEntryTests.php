<?php
require_once("tests/bootstrapTests.php");
require_once("PHPUnit/Framework/TestCase.php");

class BaseEntryTests extends PHPUnit_Framework_TestCase 
{
	public function setUp() 
	{
	}
	
	public function tearDown() 
	{
	}
	
	public function testAddFromUploadedFile()
	{
		$ks = KalturaTestsHelpers::getNormalKs();
		$ksObj = ks::fromSecureString($ks);
		$ksUnique = $ksObj->getUniqueString();
		$uniqueId = substr(base_convert(md5(uniqid(rand(), true)), 16, 36), 1, 20);
		$ext = "flv";
		
		$token = $ksUnique."_".$uniqueId.".".$ext;
		
		$uploadPath  = myUploadUtils::getUploadPathAndUrl($token, "", null, "flv");
		$fullPath = $uploadPath[0];
		
		$currentPath = pathinfo(__FILE__, PATHINFO_DIRNAME);
		copy($currentPath."/../files/kaltura_logo_animated_black.flv", $fullPath);
		
	    $baseEntryService = KalturaTestsHelpers::getServiceInitializedForAction("baseEntry", "addFromUploadedFile");
	    
	    $baseEntry = $this->prepareBaseEntry();
	    
		$newBaseEntry = $baseEntryService->addFromUploadedFileAction(clone $baseEntry, $token);
		
		$this->assertType("KalturaBaseEntry", $newBaseEntry);
		
		$this->assertEquals($baseEntry->name, $newBaseEntry->name);
		
		$baseEntryGet = $baseEntryService->getAction($newBaseEntry->id);
		$this->assertEquals($baseEntry->name, $baseEntryGet->name);
	}
	
	private function prepareBaseEntry()
	{
		$mediaEntry = new KalturaBaseEntry();
		$mediaEntry->name = "Test Name";
		return $mediaEntry;
	}
}


