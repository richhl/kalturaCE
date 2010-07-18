<?php



class categoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.categoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('category');
		$tMap->setPhpName('category');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DEPTH', 'Depth', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('FULL_NAME', 'FullName', 'string', CreoleTypes::VARCHAR, true, 512);

		$tMap->addColumn('ENTRIES_COUNT', 'EntriesCount', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 