<?php



class flavorAssetMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.flavorAssetMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('flavor_asset');
		$tMap->setPhpName('flavorAsset');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('ID', 'Id', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addPrimaryKey('INT_ID', 'IntId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', true, 20);

		$tMap->addForeignKey('FLAVOR_PARAMS_ID', 'FlavorParamsId', 'int', CreoleTypes::INTEGER, 'flavor_params', 'ID', true, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('VERSION', 'Version', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('BITRATE', 'Bitrate', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('FRAME_RATE', 'FrameRate', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('SIZE', 'Size', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('IS_ORIGINAL', 'IsOriginal', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('FILE_EXT', 'FileExt', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('CONTAINER_FORMAT', 'ContainerFormat', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('VIDEO_CODEC_ID', 'VideoCodecId', 'string', CreoleTypes::VARCHAR, false, 127);

	} 
} 