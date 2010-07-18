<?php



class PuserKuserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PuserKuserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('puser_kuser');
		$tMap->setPhpName('PuserKuser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PUSER_ID', 'PuserId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('PUSER_NAME', 'PuserName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CONTEXT', 'Context', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 