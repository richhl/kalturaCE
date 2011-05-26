<?php

/**
 * bulkUpload service base test case.
 */
abstract class BulkUploadServiceBaseTest extends KalturaApiUnitTestCase
{
	/**
	 * Tests bulkUpload->add action
	 * @param int $conversionProfileId Convertion profile id to use for converting the current bulk (-1 to use partner's default)
	 * @param file $csvFileData CSV File
	 * @param KalturaBulkUpload $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testAdd($conversionProfileId, file $csvFileData, KalturaBulkUpload $reference)
	{
		$resultObject = $this->client->bulkUpload->add($conversionProfileId, $csvFileData);
		$this->assertType('KalturaBulkUpload', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateAdd($conversionProfileId, $csvFileData, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testAdd results
	 */
	protected function validateAdd($conversionProfileId, file $csvFileData, KalturaBulkUpload $reference)
	{
	}

	/**
	 * Tests bulkUpload->get action
	 * @param KalturaBulkUpload $reference 
	 * @param int id - returned from testAdd
	 * @return int
	 * @depends testAdd with data set #0
	 * @dataProvider provideData
	 */
	public function testGet(KalturaBulkUpload $reference, $id)
	{
		$resultObject = $this->client->bulkUpload->get($id);
		$this->assertType('KalturaBulkUpload', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateGet($reference);
		return $resultObject->id;
	}

	/**
	 * Validates testGet results
	 */
	protected function validateGet(KalturaBulkUpload $reference, $id)
	{
	}

	/**
	 * Tests bulkUpload->list action
	 * @param KalturaFilterPager $pager 
	 * @param KalturaBulkUploadListResponse $reference 
	 * @dataProvider provideData
	 */
	public function testList(KalturaFilterPager $pager = null, KalturaBulkUploadListResponse $reference)
	{
		$resultObject = $this->client->bulkUpload->list($pager);
		$this->assertType('KalturaBulkUploadListResponse', $resultObject);
		$this->validateList($pager, $reference);
	}

	/**
	 * Validates testList results
	 */
	protected function validateList(KalturaFilterPager $pager = null, KalturaBulkUploadListResponse $reference)
	{
	}

	/**
	 * Called when all tests are done
	 * @param int $id
	 * @return int
	 */
	abstract public function testFinished($id);

}
