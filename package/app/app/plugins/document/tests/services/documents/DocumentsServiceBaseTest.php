<?php

/**
 * documents service base test case.
 */
abstract class DocumentsServiceBaseTest extends KalturaApiUnitTestCase
{
	/**
	 * Tests documents->get action
	 * @param string $entryId Document entry id
	 * @param int $version Desired version of the data
	 * @param KalturaDocumentEntry $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testGet($entryId, $version = -1, KalturaDocumentEntry $reference)
	{
		$resultObject = $this->client->documents->get($entryId, $version);
		$this->assertType('KalturaDocumentEntry', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateGet($entryId, $version, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testGet results
	 */
	protected function validateGet($entryId, $version = -1, KalturaDocumentEntry $reference)
	{
	}

	/**
	 * Tests documents->update action
	 * @param string $entryId Document entry id to update
	 * @param KalturaDocumentEntry $documentEntry Document entry metadata to update
	 * @param KalturaDocumentEntry $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testUpdate($entryId, KalturaDocumentEntry $documentEntry, KalturaDocumentEntry $reference)
	{
		$resultObject = $this->client->documents->update($entryId, $documentEntry);
		$this->assertType('KalturaDocumentEntry', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateUpdate($entryId, $documentEntry, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testUpdate results
	 */
	protected function validateUpdate($entryId, KalturaDocumentEntry $documentEntry, KalturaDocumentEntry $reference)
	{
	}

	/**
	 * Tests documents->delete action
	 * @param string $entryId Document entry id to delete
	 * @dataProvider provideData
	 */
	public function testDelete($entryId)
	{
		$resultObject = $this->client->documents->delete($entryId);
		$this->validateDelete($entryId);
	}

	/**
	 * Validates testDelete results
	 */
	protected function validateDelete($entryId)
	{
	}

	/**
	 * Tests documents->list action
	 * @param KalturaDocumentEntryFilter $filter Document entry filter
	 * @param KalturaFilterPager $pager Pager
	 * @param KalturaDocumentListResponse $reference 
	 * @dataProvider provideData
	 */
	public function testList(KalturaDocumentEntryFilter $filter = null, KalturaFilterPager $pager = null, KalturaDocumentListResponse $reference)
	{
		$resultObject = $this->client->documents->list($filter, $pager);
		$this->assertType('KalturaDocumentListResponse', $resultObject);
		$this->validateList($filter, $pager, $reference);
	}

	/**
	 * Validates testList results
	 */
	protected function validateList(KalturaDocumentEntryFilter $filter = null, KalturaFilterPager $pager = null, KalturaDocumentListResponse $reference)
	{
	}

	/**
	 * Called when all tests are done
	 * @param int $id
	 * @return int
	 */
	abstract public function testFinished($id);

}
