<?php



class roughcutEntryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.roughcutEntryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('roughcut_entry');
		$tMap->setPhpName('roughcutEntry');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ROUGHCUT_ID', 'RoughcutId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 20);

		$tMap->addColumn('ROUGHCUT_VERSION', 'RoughcutVersion', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('ROUGHCUT_KSHOW_ID', 'RoughcutKshowId', 'string', CreoleTypes::VARCHAR, 'kshow', 'ID', false, 20);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 20);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OP_TYPE', 'OpType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 