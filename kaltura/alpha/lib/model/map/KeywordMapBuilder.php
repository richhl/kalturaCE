<?php



class KeywordMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KeywordMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('keyword');
		$tMap->setPhpName('Keyword');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('WORD', 'Word', 'string', CreoleTypes::VARCHAR, true, 30);

		$tMap->addColumn('ENTITY_ID', 'EntityId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTITY_TYPE', 'EntityType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTITY_COLUMNS', 'EntityColumns', 'string', CreoleTypes::VARCHAR, false, 30);

	} 
} 