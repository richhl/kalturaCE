<?php

require_once 'PHPUnit/Framework/TestCase.php';
require_once 'tests/helpers/TestingHelpers.php';

class MediaTests extends PHPUnit_Framework_TestCase 
{
	private $mediaService;
	private $partner;
	private $ks;
	private $userId = "UnitTestUser";
	
	protected function setUp() 
	{
		static $loaderRegistered = false;
		if (!$loaderRegistered)
		{
			require_once("bootstrap.php");
			KalturaAutoload::register();
			$loaderRegistered = true;
		}
		
		$services = KalturaServicesMap::getMap();
		require_once($services["media"]);

		$this->mediaService = new MediaService();
		$this->partner = TestingHelpers::getPartnerForTest();
		$this->ks = TestingHelpers::getNormalKs($this->partner->getId(), $this->userId);
	}
	
	protected function tearDown() 
	{
		$this->mediaService = null;
	}
	
	public function testUserCannotAddToOtherUser() 
	{
		$this->mediaService->initService($this->partner->getId(), $this->userId, $this->ks, "media", "addfromurl");
		
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->name = "Test Name";
		$mediaEntry->userId = "BadUser";
		$url = "Dummy Url";
		
		try 
		{
			$this->mediaService->addFromUrl($mediaEntry, $url);
		}
		catch(KalturaAPIException $ex)
		{
			$this->assertEquals("INVALID_KS", $ex->getCode());
			return;
		}
		
		$this->fail("Expecting exception");
	}
	
	public function testNormalSessionCannotUpdateAdminTags()
	{
		$this->mediaService->initService($this->partner->getId(), $this->userId, $this->ks, "media", "addfromurl");
		
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->name = "Test Name";
		$mediaEntry->adminTags = "my_admin_tag";
		
		$url = "Dummy Url";
		
		try 
		{
			$this->mediaService->addFromUrl($mediaEntry, $url);
		}
		catch(KalturaAPIException $ex)
		{
			$this->assertEquals("CANNOT_UPDATE_ADMIN_TAGS", $ex->getCode());
			return;
		}
		
		$this->fail("Expecting exception");
	}
}

