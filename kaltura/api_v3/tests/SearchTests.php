<?php
require_once("KalturaBaseTest.php");

class SearchTests extends KalturaBaseTest 
{
	public function setUp() 
	{
	}
	
	public function tearDown() 
	{
	}
	
	public function testSearchYouTube() 
	{
	    $searchService = $this->getServiceInitializedForAction("search", "search");
	    
	    $search = new KalturaSearch();
	    $search->keyWords = "trailer";
	    $search->mediaType = KalturaMediaType::VIDEO;
	    $search->searchSource = KalturaSearchProviderType::YOUTUBE;
	    $searchResponse = $searchService->searchAction($search);
	    
	    $this->assertType("KalturaSearchResultResponse", $searchResponse);
	    $this->assertNotNull($searchResponse);
	    $this->assertTrue($searchResponse->needMediaInfo);
	    $this->assertEquals(30, $searchResponse->objects->count);
	}
	
	public function testSearchFlickr() 
	{
	    $searchService = $this->getServiceInitializedForAction("search", "search");
	    
	    $search = new KalturaSearch();
	    $search->keyWords = "dog";
	    $search->mediaType = KalturaMediaType::IMAGE;
	    $search->searchSource = KalturaSearchProviderType::FLICKR;
	    $searchResponse = $searchService->searchAction($search);
	    
	    $this->assertType("KalturaSearchResultResponse", $searchResponse);
	    $this->assertNotNull($searchResponse);
	    $this->assertTrue($searchResponse->needMediaInfo);
	    $this->assertEquals(30, $searchResponse->objects->count);
	}
	
	public function testSearchPhotobucket() 
	{
	    $searchService = $this->getServiceInitializedForAction("search", "search");
	    
	    $search = new KalturaSearch();
	    $search->keyWords = "cat";
	    $search->mediaType = KalturaMediaType::IMAGE;
	    $search->searchSource = KalturaSearchProviderType::PHOTOBUCKET;
	    $searchResponse = $searchService->searchAction($search);
	    
	    $this->assertType("KalturaSearchResultResponse", $searchResponse);
	    $this->assertNotNull($searchResponse);
	    $this->assertFalse($searchResponse->needMediaInfo);
	    $this->assertGreaterThan(10, $searchResponse->objects->count);
	}
}


