<?php



class flavorParamsOutputMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.flavorParamsOutputMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('flavor_params_output');
		$tMap->setPhpName('flavorParamsOutput');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('FLAVOR_PARAMS_ID', 'FlavorParamsId', 'int', CreoleTypes::INTEGER, 'flavor_params', 'ID', true, null);

		$tMap->addColumn('FLAVOR_PARAMS_VERSION', 'FlavorParamsVersion', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', true, 20);

		$tMap->addForeignKey('FLAVOR_ASSET_ID', 'FlavorAssetId', 'string', CreoleTypes::VARCHAR, 'flavor_asset', 'ID', true, 20);

		$tMap->addColumn('FLAVOR_ASSET_VERSION', 'FlavorAssetVersion', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, true, 1024);

		$tMap->addColumn('READY_BEHAVIOR', 'ReadyBehavior', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IS_DEFAULT', 'IsDefault', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('FORMAT', 'Format', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('VIDEO_CODEC', 'VideoCodec', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('VIDEO_BITRATE', 'VideoBitrate', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('AUDIO_CODEC', 'AudioCodec', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('AUDIO_BITRATE', 'AudioBitrate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_CHANNELS', 'AudioChannels', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('AUDIO_SAMPLE_RATE', 'AudioSampleRate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_RESOLUTION', 'AudioResolution', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('FRAME_RATE', 'FrameRate', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('GOP_SIZE', 'GopSize', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TWO_PASS', 'TwoPass', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CONVERSION_ENGINES', 'ConversionEngines', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('CONVERSION_ENGINES_EXTRA_PARAMS', 'ConversionEnginesExtraParams', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMMAND_LINES', 'CommandLines', 'string', CreoleTypes::VARCHAR, false, 2047);

		$tMap->addColumn('FILE_EXT', 'FileExt', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('DEINTERLICE', 'Deinterlice', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ROTATE', 'Rotate', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 