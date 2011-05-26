<?php

/**
 * widget service base test case.
 */
abstract class WidgetServiceBaseTest extends KalturaApiUnitTestCase
{
	/**
	 * Tests widget->add action
	 * @param KalturaWidget $widget 
	 * @param KalturaWidget $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testAdd(KalturaWidget $widget, KalturaWidget $reference)
	{
		$resultObject = $this->client->widget->add($widget);
		$this->assertType('KalturaWidget', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateAdd($widget, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testAdd results
	 */
	protected function validateAdd(KalturaWidget $widget, KalturaWidget $reference)
	{
	}

	/**
	 * Tests widget->update action
	 * @param string $id 
	 * @param KalturaWidget $widget 
	 * @param KalturaWidget $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testUpdate($id, KalturaWidget $widget, KalturaWidget $reference)
	{
		$resultObject = $this->client->widget->update($id, $widget);
		$this->assertType('KalturaWidget', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateUpdate($id, $widget, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testUpdate results
	 */
	protected function validateUpdate($id, KalturaWidget $widget, KalturaWidget $reference)
	{
	}

	/**
	 * Tests widget->get action
	 * @param string $id 
	 * @param KalturaWidget $reference 
	 * @return int
	 * @dataProvider provideData
	 */
	public function testGet($id, KalturaWidget $reference)
	{
		$resultObject = $this->client->widget->get($id);
		$this->assertType('KalturaWidget', $resultObject);
		$this->assertNotNull($resultObject->id);
		$this->validateGet($id, $reference);
		return $resultObject->id;
	}

	/**
	 * Validates testGet results
	 */
	protected function validateGet($id, KalturaWidget $reference)
	{
	}

	/**
	 * Tests widget->list action
	 * @param KalturaWidgetFilter $filter 
	 * @param KalturaFilterPager $pager 
	 * @param KalturaWidgetListResponse $reference 
	 * @dataProvider provideData
	 */
	public function testList(KalturaWidgetFilter $filter = null, KalturaFilterPager $pager = null, KalturaWidgetListResponse $reference)
	{
		$resultObject = $this->client->widget->list($filter, $pager);
		$this->assertType('KalturaWidgetListResponse', $resultObject);
		$this->validateList($filter, $pager, $reference);
	}

	/**
	 * Validates testList results
	 */
	protected function validateList(KalturaWidgetFilter $filter = null, KalturaFilterPager $pager = null, KalturaWidgetListResponse $reference)
	{
	}

	/**
	 * Called when all tests are done
	 * @param int $id
	 * @return int
	 */
	abstract public function testFinished($id);

}
