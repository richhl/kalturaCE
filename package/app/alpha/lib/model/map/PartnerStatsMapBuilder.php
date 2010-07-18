<?php



class PartnerStatsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PartnerStatsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('partner_stats');
		$tMap->setPhpName('PartnerStats');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('VIEWS', 'Views', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PLAYS', 'Plays', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIDEOS', 'Videos', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIOS', 'Audios', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IMAGES', 'Images', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRIES', 'Entries', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USERS_1', 'Users1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USERS_2', 'Users2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RC_1', 'Rc1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RC_2', 'Rc2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('KSHOWS_1', 'Kshows1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('KSHOWS_2', 'Kshows2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('WIDGETS', 'Widgets', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 