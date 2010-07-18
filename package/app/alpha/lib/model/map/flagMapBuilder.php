<?php



class flagMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.flagMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('flag');
		$tMap->setPhpName('flag');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('SUBJECT_TYPE', 'SubjectType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBJECT_ID', 'SubjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FLAG_TYPE', 'FlagType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OTHER', 'Other', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::VARCHAR, false, 2048);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 