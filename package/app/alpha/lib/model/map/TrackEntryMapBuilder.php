<?php



class TrackEntryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TrackEntryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('track_entry');
		$tMap->setPhpName('TrackEntry');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TRACK_EVENT_TYPE_ID', 'TrackEventTypeId', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('PS_VERSION', 'PsVersion', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('CONTEXT', 'Context', 'string', CreoleTypes::VARCHAR, false, 511);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('HOST_NAME', 'HostName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('UID', 'Uid', 'string', CreoleTypes::VARCHAR, false, 63);

		$tMap->addColumn('TRACK_EVENT_STATUS_ID', 'TrackEventStatusId', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CHANGED_PROPERTIES', 'ChangedProperties', 'string', CreoleTypes::VARCHAR, false, 1023);

		$tMap->addColumn('PARAM_1_STR', 'Param1Str', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PARAM_2_STR', 'Param2Str', 'string', CreoleTypes::VARCHAR, false, 511);

		$tMap->addColumn('PARAM_3_STR', 'Param3Str', 'string', CreoleTypes::VARCHAR, false, 511);

		$tMap->addColumn('KS', 'Ks', 'string', CreoleTypes::VARCHAR, false, 511);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('USER_IP', 'UserIp', 'string', CreoleTypes::VARCHAR, false, 20);

	} 
} 