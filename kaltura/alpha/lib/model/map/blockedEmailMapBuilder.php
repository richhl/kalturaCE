<?php



class blockedEmailMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.blockedEmailMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('blocked_email');
		$tMap->setPhpName('blockedEmail');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 40);

	} 
} 