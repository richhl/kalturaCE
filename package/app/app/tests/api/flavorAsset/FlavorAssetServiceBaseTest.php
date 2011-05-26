<?php

/**
 * flavorAsset service base test case.
 */
abstract class FlavorAssetServiceBaseTest extends KalturaApiUnitTestCase
{
	/**
	 * Tests flavorAsset->get action
	 * @param string $id 
	 * @param KalturaFlavorAsset $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testGet($id, KalturaFlavorAsset $reference)
	{
		$resultObject = $this->client->flavorAsset->get($id);
		$this->assertType('KalturaFlavorAsset', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateGet($id, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testGet results
	 */
	protected function validateGet($id, KalturaFlavorAsset $reference)
	{
	}

	/**
	 * Tests flavorAsset->list action
	 * @param KalturaAssetFilter $filter 
	 * @param KalturaFilterPager $pager 
	 * @param KalturaFlavorAssetListResponse $reference 
	 * @dataProvider provideData
	 */
	public function testList(KalturaAssetFilter $filter = null, KalturaFilterPager $pager = null, KalturaFlavorAssetListResponse $reference)
	{
		$resultObject = $this->client->flavorAsset->list($filter, $pager);
		$this->assertType('KalturaFlavorAssetListResponse', $resultObject);
		$this->validateList($filter, $pager, $reference);
	}

	/**
	 * Validates testList results
	 */
	protected function validateList(KalturaAssetFilter $filter = null, KalturaFilterPager $pager = null, KalturaFlavorAssetListResponse $reference)
	{
	}

	/**
	 * Tests flavorAsset->delete action
	 * @param string $id 
	 * @dataProvider provideData
	 */
	public function testDelete($id)
	{
		$resultObject = $this->client->flavorAsset->delete($id);
		$this->validateDelete($id);
	}

	/**
	 * Validates testDelete results
	 */
	protected function validateDelete($id)
	{
	}

	/**
	 * Called when all tests are done
	 * @param int $id
	 * @return int
	 */
	abstract public function testFinished($id);

}
