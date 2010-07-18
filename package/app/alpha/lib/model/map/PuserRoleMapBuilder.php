<?php



class PuserRoleMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PuserRoleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('puser_role');
		$tMap->setPhpName('PuserRole');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('KSHOW_ID', 'KshowId', 'string', CreoleTypes::VARCHAR, 'kshow', 'ID', false, 20);

		$tMap->addForeignKey('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, 'puser_kuser', 'PARTNER_ID', false, null);

		$tMap->addForeignKey('PUSER_ID', 'PuserId', 'string', CreoleTypes::VARCHAR, 'puser_kuser', 'PUSER_ID', false, 64);

		$tMap->addColumn('ROLE', 'Role', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 