<?php



class SystemUserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SystemUserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('system_user');
		$tMap->setPhpName('SystemUser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, true, 40);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, true, 40);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, true, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('IS_PRIMARY', 'IsPrimary', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STATUS_UPDATED_AT', 'StatusUpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ROLE', 'Role', 'string', CreoleTypes::VARCHAR, false, 40);

	} 
} 