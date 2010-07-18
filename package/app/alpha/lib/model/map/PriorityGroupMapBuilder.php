<?php



class PriorityGroupMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PriorityGroupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('priority_group');
		$tMap->setPhpName('PriorityGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('PRIORITY', 'Priority', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('BULK_PRIORITY', 'BulkPriority', 'int', CreoleTypes::TINYINT, false, null);

	} 
} 