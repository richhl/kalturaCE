<?php


	
class kuserRoleMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.kuserRoleMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('kuser_role');
		$tMap->setPhpName('kuserRole');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('KSHOW_ID', 'KshowId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('ROLE', 'Role', 'int', CreoleTypes::INTEGER, false);
				
    } 
} 