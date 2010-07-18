<?php



class UploadTokenMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UploadTokenMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('upload_token');
		$tMap->setPhpName('UploadToken');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('INT_ID', 'IntId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FILE_NAME', 'FileName', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('FILE_SIZE', 'FileSize', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('UPLOADED_FILE_SIZE', 'UploadedFileSize', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('UPLOAD_TEMP_PATH', 'UploadTempPath', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('USER_IP', 'UserIp', 'string', CreoleTypes::VARCHAR, true, 39);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 