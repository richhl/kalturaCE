<?php


	
class fanMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.fanMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('fan');
		$tMap->setPhpName('fan');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('FAN_ID', 'FanId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);
				
    } 
} 