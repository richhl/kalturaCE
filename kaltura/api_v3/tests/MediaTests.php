<?php
require_once("KalturaBaseTest.php");

class MediaTests extends KalturaBaseTest 
{
	public function setUp() 
	{
	}
	
	public function tearDown() 
	{
	}
	
	public function testUserCannotAddToOtherUser() 
	{
	    $mediaService = $this->getServiceInitializedForAction("media", "addFromUrl");
		
		$mediaEntry = $this->prepareMediaEntry();
		$mediaEntry->userId = "BadUser";

		$url = $this->prepareDummyUrl();
		
		try 
		{
			$mediaService->addFromUrlAction($mediaEntry, $url);
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
		$mediaService = $this->getServiceInitializedForAction("media", "addFromUrl");
		
		$mediaEntry = $this->prepareMediaEntry();
		$mediaEntry->adminTags = "my_admin_tag";
		
		$url = $this->prepareDummyUrl();
		
		try 
		{
			$mediaService->addFromUrlAction($mediaEntry, $url);
		}
		catch(KalturaAPIException $ex)
		{
			$this->assertEquals("CANNOT_UPDATE_ADMIN_TAGS", $ex->getCode());
			return;
		}
		
		$this->fail("Expecting exception");
	}
	
	public function testAddFromUrl()
	{
        $mediaService = $this->getServiceInitializedForAction("media", "addFromUrl");
	    
	    $mediaEntry = $this->prepareMediaEntry();
		
		$url = $this->prepareDummyUrl();
		
		$newMediaEntry = $mediaService->addFromUrlAction(clone $mediaEntry, $url);
		
		$this->assertType("KalturaMediaEntry", $newMediaEntry);
		
		$this->assertEquals($mediaEntry->name, $newMediaEntry->name);
		$this->assertEquals($mediaEntry->mediaType, $newMediaEntry->mediaType);
		
		$mediaEntryGet = $mediaService->getAction($newMediaEntry->id);
		$this->assertEquals($mediaEntry->name, $mediaEntryGet->name);
		$this->assertEquals($mediaEntry->mediaType, $mediaEntryGet->mediaType);
	}
	
	public function testAddFromSearchResult()
	{
	    $mediaService = $this->getServiceInitializedForAction("media", "addFromSearchResult");
	    
	    // media entry
	    $mediaEntry = $this->prepareMediaEntry();
		
		// search result
		$searchService = $this->getServiceInitializedForAction("search", "search");
	    $search = new KalturaSearch();
	    $search->keyWords = "dog";
	    $search->mediaType = KalturaMediaType::VIDEO;
	    $search->searchSource = KalturaSearchProviderType::YOUTUBE;
	    $searchResponse = $searchService->searchAction($search);
	    $searchResult = $searchResponse->objects[0];
	    
		$newMediaEntry = $mediaService->addFromSearchResultAction(clone $mediaEntry, clone $searchResult);
		
		$this->assertType("KalturaMediaEntry", $newMediaEntry);
		
		$this->assertEquals($mediaEntry->name, $newMediaEntry->name);
		$this->assertEquals($mediaEntry->mediaType, $newMediaEntry->mediaType);
		
		$mediaEntryGet = $mediaService->getAction($newMediaEntry->id);
		$this->assertEquals($mediaEntry->name, $mediaEntryGet->name);
		$this->assertEquals($mediaEntry->mediaType, $mediaEntryGet->mediaType);
	}
	
	public function testAddFromUploadedFile()
	{
		$ks = $this->getNormalKs();
		$ksObj = ks::fromSecureString($ks);
		$ksUnique = $ksObj->getUniqueString();
		$uniqueId = substr(base_convert(md5(uniqid(rand(), true)), 16, 36), 1, 20);
		$ext = "flv";
		
		$token = $ksUnique."_".$uniqueId.".".$ext;
		
		$uploadPath  = myUploadUtils::getUploadPathAndUrl($token, "", null, "flv");
		$fullPath = $uploadPath[0];
		
		$currentPath = pathinfo(__FILE__, PATHINFO_DIRNAME);
		copy($currentPath."/files/kaltura_logo_animated_black.flv", $fullPath);
		
	    $mediaService = $this->getServiceInitializedForAction("media", "addFromUploadedFile");
	    
	    $mediaEntry = $this->prepareMediaEntry();
	    
		$newMediaEntry = $mediaService->addFromUploadedFileAction(clone $mediaEntry, $token);
		
		$this->assertType("KalturaMediaEntry", $newMediaEntry);
		
		$this->assertEquals($mediaEntry->name, $newMediaEntry->name);
		$this->assertEquals($mediaEntry->mediaType, $newMediaEntry->mediaType);
		
		$mediaEntryGet = $mediaService->getAction($newMediaEntry->id);
		$this->assertEquals($mediaEntry->name, $mediaEntryGet->name);
		$this->assertEquals($mediaEntry->mediaType, $mediaEntryGet->mediaType);
	}
	
	public function testUpdate()
	{
		$mediaService = $this->getServiceInitializedForAction("media", "update");
	    
	    $mediaEntry = $this->prepareMediaEntry();
		$url = $this->prepareDummyUrl();
		$newMediaEntry = $mediaService->addFromUrlAction(clone $mediaEntry, $url);
		$id = $newMediaEntry->id;
		
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->name = "New Name";
		$mediaService->updateAction($id, clone $mediaEntry);
		
		$updatedMediaEntry = $mediaService->getAction($id);
		
		$this->assertEquals($mediaEntry->name, $updatedMediaEntry->name);
	}
	
	public function testList()
	{
		$mediaService = $this->getServiceInitializedForAction("media", "list");
	    
	    $mediaEntry = $this->prepareMediaEntry();
		$url = $this->prepareDummyUrl();
		$newMediaEntry = $mediaService->addFromUrlAction(clone $mediaEntry, $url);
		
		$filter = new KalturaMediaEntryFilter();
		$filter->orderBy = KalturaMediaEntryOrderBy::CREATED_AT_DESC;
		$pager = new KalturaFilterPager();
		$pager->pageSize = 10;

		$response = $mediaService->listAction($filter, $pager);
		$this->assertGreaterThan(1, $response->objects->count);
		
		$found = false;
		foreach($response->objects as $object)
		{
			$this->assertType("KalturaMediaEntry", $object);
			if ($object->id == $newMediaEntry->id)
				$found = true;
		}
		
		$this->assertTrue($found, "Entry not found in list");
	}
	
	public function testDelete()
	{
		$mediaService = $this->getServiceInitializedForAction("media", "addFromUrl");
	    
	    $mediaEntry = $this->prepareMediaEntry();
		$url = $this->prepareDummyUrl();
		$newMediaEntry = $mediaService->addFromUrlAction($mediaEntry, $url);
		$id = $newMediaEntry->id;
		
		$result = $mediaService->deleteAction($id);
		$this->assertNull($result);
		
		// check entry db status status
		$entryDb = entryPeer::retrieveByPKNoFilter($id);
		$this->assertEquals(KalturaEntryStatus::DELETED, $entryDb->getStatus());
		
		// make sure it is not returned in get
		try 
		{
			$mediaEntry = $mediaService->getAction($id);
		}
		catch(KalturaAPIException $ex)
		{
			$dummyEx = new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, "");
			$this->assertEquals($dummyEx->getCode(), $ex->getCode());
			
			// make sure is is not returned in list
			$filter = new KalturaMediaEntryFilter();
			$filter->idIn = $id;
			$response = $mediaService->listAction($filter);
			$this->assertEquals(0, $response->totalCount);
			
			return;
		}
		
		$this->fail("Expecting exception");
	}
	
	private function prepareMediaEntry()
	{
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->name = "Test Name";
		$mediaEntry->mediaType = KalturaMediaType::VIDEO;
		return $mediaEntry;
	}
	
	private function prepareDummyUrl()
	{
		return "http://dumyurl/";		
	}
}


