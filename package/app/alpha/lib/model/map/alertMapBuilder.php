<?php



class alertMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.alertMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('alert');
		$tMap->setPhpName('alert');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('ALERT_TYPE', 'AlertType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBJECT_ID', 'SubjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RULE_TYPE', 'RuleType', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 