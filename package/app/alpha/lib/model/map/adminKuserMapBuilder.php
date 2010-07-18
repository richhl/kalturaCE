<?php



class adminKuserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.adminKuserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('admin_kuser');
		$tMap->setPhpName('adminKuser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SCREEN_NAME', 'ScreenName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('FULL_NAME', 'FullName', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('PICTURE', 'Picture', 'string', CreoleTypes::VARCHAR, false, 48);

		$tMap->addColumn('ICON', 'Icon', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, 'partner', 'ID', false, null);

	} 
} 