<?php



class KceInstallationErrorMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KceInstallationErrorMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('kce_installation_error');
		$tMap->setPhpName('KceInstallationError');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BROWSER', 'Browser', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('SERVER_IP', 'ServerIp', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SERVER_OS', 'ServerOs', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('PHP_VERSION', 'PhpVersion', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CE_ADMIN_EMAIL', 'CeAdminEmail', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('DATA', 'Data', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 