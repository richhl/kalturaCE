<?php



class PartnershipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PartnershipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('partnership');
		$tMap->setPhpName('Partnership');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNERSHIP_ORDER', 'PartnershipOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IMAGE_PATH', 'ImagePath', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('HREF', 'Href', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('TEXT', 'Text', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('ALT', 'Alt', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARTNERSHIP_DATE', 'PartnershipDate', 'string', CreoleTypes::VARCHAR, false, 128);

	} 
} 