<?php



class KshowKuserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KshowKuserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('kshow_kuser');
		$tMap->setPhpName('KshowKuser');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('KSHOW_ID', 'KshowId', 'string', CreoleTypes::VARCHAR, 'kshow', 'ID', false, 10);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('SUBSCRIPTION_TYPE', 'SubscriptionType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALERT_TYPE', 'AlertType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 