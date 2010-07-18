<?php



class accessControlMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.accessControlMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('access_control');
		$tMap->setPhpName('accessControl');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, true, 1024);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SITE_RESTRICT_TYPE', 'SiteRestrictType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SITE_RESTRICT_LIST', 'SiteRestrictList', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('COUNTRY_RESTRICT_TYPE', 'CountryRestrictType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('COUNTRY_RESTRICT_LIST', 'CountryRestrictList', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('KS_RESTRICT_PRIVILEGE', 'KsRestrictPrivilege', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PRV_RESTRICT_PRIVILEGE', 'PrvRestrictPrivilege', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PRV_RESTRICT_LENGTH', 'PrvRestrictLength', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('KDIR_RESTRICT_TYPE', 'KdirRestrictType', 'int', CreoleTypes::TINYINT, false, null);

	} 
} 