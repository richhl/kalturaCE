<?php



class BulkUploadResultMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BulkUploadResultMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('bulk_upload_result');
		$tMap->setPhpName('BulkUploadResult');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('BULK_UPLOAD_JOB_ID', 'BulkUploadJobId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LINE_INDEX', 'LineIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ENTRY_STATUS', 'EntryStatus', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ROW_DATA', 'RowData', 'string', CreoleTypes::VARCHAR, false, 1023);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CONTENT_TYPE', 'ContentType', 'string', CreoleTypes::VARCHAR, false, 31);

		$tMap->addColumn('CONVERSION_PROFILE_ID', 'ConversionProfileId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ACCESS_CONTROL_PROFILE_ID', 'AccessControlProfileId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CATEGORY', 'Category', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('SCHEDULE_START_DATE', 'ScheduleStartDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SCHEDULE_END_DATE', 'ScheduleEndDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('THUMBNAIL_URL', 'ThumbnailUrl', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('THUMBNAIL_SAVED', 'ThumbnailSaved', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PARTNER_DATA', 'PartnerData', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('ERROR_DESCRIPTION', 'ErrorDescription', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 