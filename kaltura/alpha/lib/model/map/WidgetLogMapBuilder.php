<?php



class WidgetLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WidgetLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('widget_log');
		$tMap->setPhpName('WidgetLog');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('KSHOW_ID', 'KshowId', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 10);

		$tMap->addColumn('KMEDIA_TYPE', 'KmediaType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WIDGET_TYPE', 'WidgetType', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('REFERER', 'Referer', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('VIEWS', 'Views', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IP1', 'Ip1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IP1_COUNT', 'Ip1Count', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IP2', 'Ip2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IP2_COUNT', 'Ip2Count', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PLAYS', 'Plays', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 