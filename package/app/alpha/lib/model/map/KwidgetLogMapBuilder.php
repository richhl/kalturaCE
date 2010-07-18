<?php



class KwidgetLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KwidgetLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('kwidget_log');
		$tMap->setPhpName('KwidgetLog');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('WIDGET_ID', 'WidgetId', 'string', CreoleTypes::VARCHAR, 'widget', 'ID', false, 32);

		$tMap->addColumn('SOURCE_WIDGET_ID', 'SourceWidgetId', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('ROOT_WIDGET_ID', 'RootWidgetId', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addForeignKey('KSHOW_ID', 'KshowId', 'string', CreoleTypes::VARCHAR, 'kshow', 'ID', false, 20);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 20);

		$tMap->addForeignKey('UI_CONF_ID', 'UiConfId', 'int', CreoleTypes::INTEGER, 'ui_conf', 'ID', false, null);

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