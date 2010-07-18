<?php



class flavorParamsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.flavorParamsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('flavor_params');
		$tMap->setPhpName('flavorParams');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('VERSION', 'Version', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

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

		$tMap->addColumn('AUDIO_CODEC', 'AudioCodec', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('AUDIO_BITRATE', 'AudioBitrate', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('AUDIO_CHANNELS', 'AudioChannels', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('AUDIO_SAMPLE_RATE', 'AudioSampleRate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_RESOLUTION', 'AudioResolution', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('FRAME_RATE', 'FrameRate', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('GOP_SIZE', 'GopSize', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TWO_PASS', 'TwoPass', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CONVERSION_ENGINES', 'ConversionEngines', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('CONVERSION_ENGINES_EXTRA_PARAMS', 'ConversionEnginesExtraParams', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('VIEW_ORDER', 'ViewOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATION_MODE', 'CreationMode', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('DEINTERLICE', 'Deinterlice', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ROTATE', 'Rotate', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 