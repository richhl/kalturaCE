<?php


	
class KshowKuserAlertMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KshowKuserAlertMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('kshow_kuser_alert');
		$tMap->setPhpName('KshowKuserAlert');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('KSHOW_ID', 'KshowId', 'int', CreoleTypes::INTEGER, 'kshow', 'ID', false, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kshow', 'ID', false, null);

		$tMap->addColumn('ALERT_TYPE', 'AlertType', 'int', CreoleTypes::INTEGER, false);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);
				
    } 
} 