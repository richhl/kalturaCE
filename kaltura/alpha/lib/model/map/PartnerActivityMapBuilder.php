<?php



class PartnerActivityMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PartnerActivityMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('partner_activity');
		$tMap->setPhpName('PartnerActivity');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ACTIVITY_DATE', 'ActivityDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ACTIVITY', 'Activity', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUB_ACTIVITY', 'SubActivity', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT', 'Amount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT1', 'Amount1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT2', 'Amount2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT3', 'Amount3', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT4', 'Amount4', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT5', 'Amount5', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT6', 'Amount6', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT7', 'Amount7', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AMOUNT9', 'Amount9', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 