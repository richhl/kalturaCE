<?php



class widgetMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.widgetMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('widget');
		$tMap->setPhpName('widget');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('INT_ID', 'IntId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SOURCE_WIDGET_ID', 'SourceWidgetId', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('ROOT_WIDGET_ID', 'RootWidgetId', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('KSHOW_ID', 'KshowId', 'string', CreoleTypes::VARCHAR, 'kshow', 'ID', false, 20);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 20);

		$tMap->addForeignKey('UI_CONF_ID', 'UiConfId', 'int', CreoleTypes::INTEGER, 'ui_conf', 'ID', false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('SECURITY_TYPE', 'SecurityType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('SECURITY_POLICY', 'SecurityPolicy', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARTNER_DATA', 'PartnerData', 'string', CreoleTypes::VARCHAR, false, 4096);

	} 
} 