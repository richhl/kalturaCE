<?php



class ConversionParamsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConversionParamsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('conversion_params');
		$tMap->setPhpName('ConversionParams');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('PROFILE_TYPE', 'ProfileType', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('PROFILE_TYPE_INDEX', 'ProfileTypeIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ASPECT_RATIO', 'AspectRatio', 'string', CreoleTypes::VARCHAR, false, 6);

		$tMap->addColumn('GOP_SIZE', 'GopSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BITRATE', 'Bitrate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('QSCALE', 'Qscale', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FILE_SUFFIX', 'FileSuffix', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 