<?php



class TagwordCountMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagwordCountMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tagword_count');
		$tMap->setPhpName('TagwordCount');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('TAG', 'Tag', 'string', CreoleTypes::VARCHAR, true, 30);

		$tMap->addColumn('TAG_COUNT', 'TagCount', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 