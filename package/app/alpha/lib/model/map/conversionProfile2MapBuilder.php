<?php



class conversionProfile2MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.conversionProfile2MapBuilder';

	
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

		$tMap = $this->dbMap->addTable('conversion_profile_2');
		$tMap->setPhpName('conversionProfile2');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, true, 1024);

		$tMap->addColumn('CROP_LEFT', 'CropLeft', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CROP_TOP', 'CropTop', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CROP_WIDTH', 'CropWidth', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CROP_HEIGHT', 'CropHeight', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLIP_START', 'ClipStart', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLIP_DURATION', 'ClipDuration', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('INPUT_TAGS_MAP', 'InputTagsMap', 'string', CreoleTypes::VARCHAR, false, 1023);

		$tMap->addColumn('CREATION_MODE', 'CreationMode', 'int', CreoleTypes::SMALLINT, false, null);

	} 
} 