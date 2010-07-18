<?php



class FileSyncMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FileSyncMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('file_sync');
		$tMap->setPhpName('FileSync');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OBJECT_TYPE', 'ObjectType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('VERSION', 'Version', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('OBJECT_SUB_TYPE', 'ObjectSubType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('DC', 'Dc', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ORIGINAL', 'Original', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('READY_AT', 'ReadyAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SYNC_TIME', 'SyncTime', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('FILE_TYPE', 'FileType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('LINKED_ID', 'LinkedId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LINK_COUNT', 'LinkCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FILE_ROOT', 'FileRoot', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('FILE_PATH', 'FilePath', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('FILE_SIZE', 'FileSize', 'string', CreoleTypes::BIGINT, false, null);

	} 
} 