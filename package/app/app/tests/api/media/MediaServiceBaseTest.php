<?php

/**
 * media service base test case.
 */
abstract class MediaServiceBaseTest extends KalturaApiUnitTestCase
{
	/**
	 * Tests media->get action
	 * @param string $entryId Media entry id
	 * @param int $version Desired version of the data
	 * @param KalturaMediaEntry $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testGet($entryId, $version = -1, KalturaMediaEntry $reference)
	{
		$resultObject = $this->client->media->get($entryId, $version);
		$this->assertType('KalturaMediaEntry', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateGet($entryId, $version, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testGet results
	 */
	protected function validateGet($entryId, $version = -1, KalturaMediaEntry $reference)
	{
	}

	/**
	 * Tests media->update action
	 * @param string $entryId Media entry id to update
	 * @param KalturaMediaEntry $mediaEntry Media entry metadata to update
	 * @param KalturaMediaEntry $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testUpdate($entryId, KalturaMediaEntry $mediaEntry, KalturaMediaEntry $reference)
	{
		$resultObject = $this->client->media->update($entryId, $mediaEntry);
		$this->assertType('KalturaMediaEntry', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateUpdate($entryId, $mediaEntry, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testUpdate results
	 */
	protected function validateUpdate($entryId, KalturaMediaEntry $mediaEntry, KalturaMediaEntry $reference)
	{
	}

	/**
	 * Tests media->delete action
	 * @param string $entryId Media entry id to delete
	 * @dataProvider provideData
	 */
	public function testDelete($entryId)
	{
		$resultObject = $this->client->media->delete($entryId);
		$this->validateDelete($entryId);
	}

	/**
	 * Validates testDelete results
	 */
	protected function validateDelete($entryId)
	{
	}

	/**
	 * Tests media->list action
	 * @param KalturaMediaEntryFilter $filter Media entry filter
	 * @param KalturaFilterPager $pager Pager
	 * @param KalturaMediaListResponse $reference 
	 * @dataProvider provideData
	 */
	public function testList(KalturaMediaEntryFilter $filter = null, KalturaFilterPager $pager = null, KalturaMediaListResponse $reference)
	{
		$resultObject = $this->client->media->list($filter, $pager);
		$this->assertType('KalturaMediaListResponse', $resultObject);
		$this->validateList($filter, $pager, $reference);
	}

	/**
	 * Validates testList results
	 */
	protected function validateList(KalturaMediaEntryFilter $filter = null, KalturaFilterPager $pager = null, KalturaMediaListResponse $reference)
	{
	}

	/**
	 * Called when all tests are done
	 * @param int $id
	 * @return int
	 */
	abstract public function testFinished($id);

}
