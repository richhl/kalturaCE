<?php



class ConversionProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConversionProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('conversion_profile');
		$tMap->setPhpName('ConversionProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('PROFILE_TYPE', 'ProfileType', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('COMMERCIAL_TRANSCODER', 'CommercialTranscoder', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ASPECT_RATIO', 'AspectRatio', 'string', CreoleTypes::VARCHAR, false, 6);

		$tMap->addColumn('BYPASS_FLV', 'BypassFlv', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('USE_WITH_BULK', 'UseWithBulk', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PROFILE_TYPE_SUFFIX', 'ProfileTypeSuffix', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('CONVERSION_PROFILE_2_ID', 'ConversionProfile2Id', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 