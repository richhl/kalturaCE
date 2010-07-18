<?php



class adminPermissionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.adminPermissionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('admin_permission');
		$tMap->setPhpName('adminPermission');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('GROUPS', 'Groups', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addForeignKey('ADMIN_KUSER_ID', 'AdminKuserId', 'int', CreoleTypes::INTEGER, 'admin_kuser', 'ID', false, null);

	} 
} 