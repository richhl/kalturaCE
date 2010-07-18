<?php



class mediaInfoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.mediaInfoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('media_info');
		$tMap->setPhpName('mediaInfo');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('FLAVOR_ASSET_ID', 'FlavorAssetId', 'string', CreoleTypes::VARCHAR, 'flavor_asset', 'ID', false, 20);

		$tMap->addColumn('FILE_SIZE', 'FileSize', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CONTAINER_FORMAT', 'ContainerFormat', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('CONTAINER_ID', 'ContainerId', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('CONTAINER_PROFILE', 'ContainerProfile', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('CONTAINER_DURATION', 'ContainerDuration', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONTAINER_BIT_RATE', 'ContainerBitRate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIDEO_FORMAT', 'VideoFormat', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('VIDEO_CODEC_ID', 'VideoCodecId', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('VIDEO_DURATION', 'VideoDuration', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIDEO_BIT_RATE', 'VideoBitRate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIDEO_BIT_RATE_MODE', 'VideoBitRateMode', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('VIDEO_WIDTH', 'VideoWidth', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('VIDEO_HEIGHT', 'VideoHeight', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('VIDEO_FRAME_RATE', 'VideoFrameRate', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('VIDEO_DAR', 'VideoDar', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('VIDEO_ROTATION', 'VideoRotation', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_FORMAT', 'AudioFormat', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('AUDIO_CODEC_ID', 'AudioCodecId', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('AUDIO_DURATION', 'AudioDuration', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_BIT_RATE', 'AudioBitRate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_BIT_RATE_MODE', 'AudioBitRateMode', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('AUDIO_CHANNELS', 'AudioChannels', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('AUDIO_SAMPLING_RATE', 'AudioSamplingRate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AUDIO_RESOLUTION', 'AudioResolution', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WRITING_LIB', 'WritingLib', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RAW_DATA', 'RawData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MULTI_STREAM_INFO', 'MultiStreamInfo', 'string', CreoleTypes::VARCHAR, false, 1023);

		$tMap->addColumn('FLAVOR_ASSET_VERSION', 'FlavorAssetVersion', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SCAN_TYPE', 'ScanType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MULTI_STREAM', 'MultiStream', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 