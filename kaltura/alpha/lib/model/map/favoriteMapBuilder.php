<?php



class favoriteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.favoriteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('favorite');
		$tMap->setPhpName('favorite');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('SUBJECT_TYPE', 'SubjectType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBJECT_ID', 'SubjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PRIVACY', 'Privacy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 