<?php


abstract class BaseflavorParamsOutputPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'flavor_params_output';

	
	const CLASS_DEFAULT = 'lib.model.flavorParamsOutput';

	
	const NUM_COLUMNS = 35;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'flavor_params_output.ID';

	
	const FLAVOR_PARAMS_ID = 'flavor_params_output.FLAVOR_PARAMS_ID';

	
	const FLAVOR_PARAMS_VERSION = 'flavor_params_output.FLAVOR_PARAMS_VERSION';

	
	const PARTNER_ID = 'flavor_params_output.PARTNER_ID';

	
	const ENTRY_ID = 'flavor_params_output.ENTRY_ID';

	
	const FLAVOR_ASSET_ID = 'flavor_params_output.FLAVOR_ASSET_ID';

	
	const FLAVOR_ASSET_VERSION = 'flavor_params_output.FLAVOR_ASSET_VERSION';

	
	const NAME = 'flavor_params_output.NAME';

	
	const TAGS = 'flavor_params_output.TAGS';

	
	const DESCRIPTION = 'flavor_params_output.DESCRIPTION';

	
	const READY_BEHAVIOR = 'flavor_params_output.READY_BEHAVIOR';

	
	const CREATED_AT = 'flavor_params_output.CREATED_AT';

	
	const UPDATED_AT = 'flavor_params_output.UPDATED_AT';

	
	const DELETED_AT = 'flavor_params_output.DELETED_AT';

	
	const IS_DEFAULT = 'flavor_params_output.IS_DEFAULT';

	
	const FORMAT = 'flavor_params_output.FORMAT';

	
	const VIDEO_CODEC = 'flavor_params_output.VIDEO_CODEC';

	
	const VIDEO_BITRATE = 'flavor_params_output.VIDEO_BITRATE';

	
	const AUDIO_CODEC = 'flavor_params_output.AUDIO_CODEC';

	
	const AUDIO_BITRATE = 'flavor_params_output.AUDIO_BITRATE';

	
	const AUDIO_CHANNELS = 'flavor_params_output.AUDIO_CHANNELS';

	
	const AUDIO_SAMPLE_RATE = 'flavor_params_output.AUDIO_SAMPLE_RATE';

	
	const AUDIO_RESOLUTION = 'flavor_params_output.AUDIO_RESOLUTION';

	
	const WIDTH = 'flavor_params_output.WIDTH';

	
	const HEIGHT = 'flavor_params_output.HEIGHT';

	
	const FRAME_RATE = 'flavor_params_output.FRAME_RATE';

	
	const GOP_SIZE = 'flavor_params_output.GOP_SIZE';

	
	const TWO_PASS = 'flavor_params_output.TWO_PASS';

	
	const CONVERSION_ENGINES = 'flavor_params_output.CONVERSION_ENGINES';

	
	const CONVERSION_ENGINES_EXTRA_PARAMS = 'flavor_params_output.CONVERSION_ENGINES_EXTRA_PARAMS';

	
	const CUSTOM_DATA = 'flavor_params_output.CUSTOM_DATA';

	
	const COMMAND_LINES = 'flavor_params_output.COMMAND_LINES';

	
	const FILE_EXT = 'flavor_params_output.FILE_EXT';

	
	const DEINTERLICE = 'flavor_params_output.DEINTERLICE';

	
	const ROTATE = 'flavor_params_output.ROTATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'FlavorParamsId', 'FlavorParamsVersion', 'PartnerId', 'EntryId', 'FlavorAssetId', 'FlavorAssetVersion', 'Name', 'Tags', 'Description', 'ReadyBehavior', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'IsDefault', 'Format', 'VideoCodec', 'VideoBitrate', 'AudioCodec', 'AudioBitrate', 'AudioChannels', 'AudioSampleRate', 'AudioResolution', 'Width', 'Height', 'FrameRate', 'GopSize', 'TwoPass', 'ConversionEngines', 'ConversionEnginesExtraParams', 'CustomData', 'CommandLines', 'FileExt', 'Deinterlice', 'Rotate', ),
		BasePeer::TYPE_COLNAME => array (flavorParamsOutputPeer::ID, flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsOutputPeer::FLAVOR_PARAMS_VERSION, flavorParamsOutputPeer::PARTNER_ID, flavorParamsOutputPeer::ENTRY_ID, flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorParamsOutputPeer::FLAVOR_ASSET_VERSION, flavorParamsOutputPeer::NAME, flavorParamsOutputPeer::TAGS, flavorParamsOutputPeer::DESCRIPTION, flavorParamsOutputPeer::READY_BEHAVIOR, flavorParamsOutputPeer::CREATED_AT, flavorParamsOutputPeer::UPDATED_AT, flavorParamsOutputPeer::DELETED_AT, flavorParamsOutputPeer::IS_DEFAULT, flavorParamsOutputPeer::FORMAT, flavorParamsOutputPeer::VIDEO_CODEC, flavorParamsOutputPeer::VIDEO_BITRATE, flavorParamsOutputPeer::AUDIO_CODEC, flavorParamsOutputPeer::AUDIO_BITRATE, flavorParamsOutputPeer::AUDIO_CHANNELS, flavorParamsOutputPeer::AUDIO_SAMPLE_RATE, flavorParamsOutputPeer::AUDIO_RESOLUTION, flavorParamsOutputPeer::WIDTH, flavorParamsOutputPeer::HEIGHT, flavorParamsOutputPeer::FRAME_RATE, flavorParamsOutputPeer::GOP_SIZE, flavorParamsOutputPeer::TWO_PASS, flavorParamsOutputPeer::CONVERSION_ENGINES, flavorParamsOutputPeer::CONVERSION_ENGINES_EXTRA_PARAMS, flavorParamsOutputPeer::CUSTOM_DATA, flavorParamsOutputPeer::COMMAND_LINES, flavorParamsOutputPeer::FILE_EXT, flavorParamsOutputPeer::DEINTERLICE, flavorParamsOutputPeer::ROTATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'flavor_params_id', 'flavor_params_version', 'partner_id', 'entry_id', 'flavor_asset_id', 'flavor_asset_version', 'name', 'tags', 'description', 'ready_behavior', 'created_at', 'updated_at', 'deleted_at', 'is_default', 'format', 'video_codec', 'video_bitrate', 'audio_codec', 'audio_bitrate', 'audio_channels', 'audio_sample_rate', 'audio_resolution', 'width', 'height', 'frame_rate', 'gop_size', 'two_pass', 'conversion_engines', 'conversion_engines_extra_params', 'custom_data', 'command_lines', 'file_ext', 'deinterlice', 'rotate', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'FlavorParamsId' => 1, 'FlavorParamsVersion' => 2, 'PartnerId' => 3, 'EntryId' => 4, 'FlavorAssetId' => 5, 'FlavorAssetVersion' => 6, 'Name' => 7, 'Tags' => 8, 'Description' => 9, 'ReadyBehavior' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'DeletedAt' => 13, 'IsDefault' => 14, 'Format' => 15, 'VideoCodec' => 16, 'VideoBitrate' => 17, 'AudioCodec' => 18, 'AudioBitrate' => 19, 'AudioChannels' => 20, 'AudioSampleRate' => 21, 'AudioResolution' => 22, 'Width' => 23, 'Height' => 24, 'FrameRate' => 25, 'GopSize' => 26, 'TwoPass' => 27, 'ConversionEngines' => 28, 'ConversionEnginesExtraParams' => 29, 'CustomData' => 30, 'CommandLines' => 31, 'FileExt' => 32, 'Deinterlice' => 33, 'Rotate' => 34, ),
		BasePeer::TYPE_COLNAME => array (flavorParamsOutputPeer::ID => 0, flavorParamsOutputPeer::FLAVOR_PARAMS_ID => 1, flavorParamsOutputPeer::FLAVOR_PARAMS_VERSION => 2, flavorParamsOutputPeer::PARTNER_ID => 3, flavorParamsOutputPeer::ENTRY_ID => 4, flavorParamsOutputPeer::FLAVOR_ASSET_ID => 5, flavorParamsOutputPeer::FLAVOR_ASSET_VERSION => 6, flavorParamsOutputPeer::NAME => 7, flavorParamsOutputPeer::TAGS => 8, flavorParamsOutputPeer::DESCRIPTION => 9, flavorParamsOutputPeer::READY_BEHAVIOR => 10, flavorParamsOutputPeer::CREATED_AT => 11, flavorParamsOutputPeer::UPDATED_AT => 12, flavorParamsOutputPeer::DELETED_AT => 13, flavorParamsOutputPeer::IS_DEFAULT => 14, flavorParamsOutputPeer::FORMAT => 15, flavorParamsOutputPeer::VIDEO_CODEC => 16, flavorParamsOutputPeer::VIDEO_BITRATE => 17, flavorParamsOutputPeer::AUDIO_CODEC => 18, flavorParamsOutputPeer::AUDIO_BITRATE => 19, flavorParamsOutputPeer::AUDIO_CHANNELS => 20, flavorParamsOutputPeer::AUDIO_SAMPLE_RATE => 21, flavorParamsOutputPeer::AUDIO_RESOLUTION => 22, flavorParamsOutputPeer::WIDTH => 23, flavorParamsOutputPeer::HEIGHT => 24, flavorParamsOutputPeer::FRAME_RATE => 25, flavorParamsOutputPeer::GOP_SIZE => 26, flavorParamsOutputPeer::TWO_PASS => 27, flavorParamsOutputPeer::CONVERSION_ENGINES => 28, flavorParamsOutputPeer::CONVERSION_ENGINES_EXTRA_PARAMS => 29, flavorParamsOutputPeer::CUSTOM_DATA => 30, flavorParamsOutputPeer::COMMAND_LINES => 31, flavorParamsOutputPeer::FILE_EXT => 32, flavorParamsOutputPeer::DEINTERLICE => 33, flavorParamsOutputPeer::ROTATE => 34, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'flavor_params_id' => 1, 'flavor_params_version' => 2, 'partner_id' => 3, 'entry_id' => 4, 'flavor_asset_id' => 5, 'flavor_asset_version' => 6, 'name' => 7, 'tags' => 8, 'description' => 9, 'ready_behavior' => 10, 'created_at' => 11, 'updated_at' => 12, 'deleted_at' => 13, 'is_default' => 14, 'format' => 15, 'video_codec' => 16, 'video_bitrate' => 17, 'audio_codec' => 18, 'audio_bitrate' => 19, 'audio_channels' => 20, 'audio_sample_rate' => 21, 'audio_resolution' => 22, 'width' => 23, 'height' => 24, 'frame_rate' => 25, 'gop_size' => 26, 'two_pass' => 27, 'conversion_engines' => 28, 'conversion_engines_extra_params' => 29, 'custom_data' => 30, 'command_lines' => 31, 'file_ext' => 32, 'deinterlice' => 33, 'rotate' => 34, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/flavorParamsOutputMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.flavorParamsOutputMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = flavorParamsOutputPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(flavorParamsOutputPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(flavorParamsOutputPeer::ID);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FLAVOR_PARAMS_ID);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FLAVOR_PARAMS_VERSION);

		$criteria->addSelectColumn(flavorParamsOutputPeer::PARTNER_ID);

		$criteria->addSelectColumn(flavorParamsOutputPeer::ENTRY_ID);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FLAVOR_ASSET_ID);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FLAVOR_ASSET_VERSION);

		$criteria->addSelectColumn(flavorParamsOutputPeer::NAME);

		$criteria->addSelectColumn(flavorParamsOutputPeer::TAGS);

		$criteria->addSelectColumn(flavorParamsOutputPeer::DESCRIPTION);

		$criteria->addSelectColumn(flavorParamsOutputPeer::READY_BEHAVIOR);

		$criteria->addSelectColumn(flavorParamsOutputPeer::CREATED_AT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::UPDATED_AT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::DELETED_AT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::IS_DEFAULT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FORMAT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::VIDEO_CODEC);

		$criteria->addSelectColumn(flavorParamsOutputPeer::VIDEO_BITRATE);

		$criteria->addSelectColumn(flavorParamsOutputPeer::AUDIO_CODEC);

		$criteria->addSelectColumn(flavorParamsOutputPeer::AUDIO_BITRATE);

		$criteria->addSelectColumn(flavorParamsOutputPeer::AUDIO_CHANNELS);

		$criteria->addSelectColumn(flavorParamsOutputPeer::AUDIO_SAMPLE_RATE);

		$criteria->addSelectColumn(flavorParamsOutputPeer::AUDIO_RESOLUTION);

		$criteria->addSelectColumn(flavorParamsOutputPeer::WIDTH);

		$criteria->addSelectColumn(flavorParamsOutputPeer::HEIGHT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FRAME_RATE);

		$criteria->addSelectColumn(flavorParamsOutputPeer::GOP_SIZE);

		$criteria->addSelectColumn(flavorParamsOutputPeer::TWO_PASS);

		$criteria->addSelectColumn(flavorParamsOutputPeer::CONVERSION_ENGINES);

		$criteria->addSelectColumn(flavorParamsOutputPeer::CONVERSION_ENGINES_EXTRA_PARAMS);

		$criteria->addSelectColumn(flavorParamsOutputPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(flavorParamsOutputPeer::COMMAND_LINES);

		$criteria->addSelectColumn(flavorParamsOutputPeer::FILE_EXT);

		$criteria->addSelectColumn(flavorParamsOutputPeer::DEINTERLICE);

		$criteria->addSelectColumn(flavorParamsOutputPeer::ROTATE);

	}

	const COUNT = 'COUNT(flavor_params_output.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT flavor_params_output.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = flavorParamsOutputPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return flavorParamsOutputPeer::populateObjects(flavorParamsOutputPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			flavorParamsOutputPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = flavorParamsOutputPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinflavorParams(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinflavorAsset(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinflavorParams(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		flavorParamsPeer::addSelectColumns($c);

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorParamsOutput($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinentry(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorParamsOutput($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinflavorAsset(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		flavorAssetPeer::addSelectColumns($c);

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorAssetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getflavorAsset(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorParamsOutput($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$criteria->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol2 = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		flavorParamsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + flavorParamsPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		flavorAssetPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + flavorAssetPeer::NUM_COLUMNS;

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$c->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsOutput($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1);
			}


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getentry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addflavorParamsOutput($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initflavorParamsOutputs();
				$obj3->addflavorParamsOutput($obj1);
			}


					
			$omClass = flavorAssetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getflavorAsset(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addflavorParamsOutput($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initflavorParamsOutputs();
				$obj4->addflavorParamsOutput($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptflavorParams(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptflavorAsset(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsOutputPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$criteria->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);

		$rs = flavorParamsOutputPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptflavorParams(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol2 = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		flavorAssetPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + flavorAssetPeer::NUM_COLUMNS;

		$c->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsOutput($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1);
			}

			$omClass = flavorAssetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getflavorAsset(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addflavorParamsOutput($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initflavorParamsOutputs();
				$obj3->addflavorParamsOutput($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptentry(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol2 = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		flavorParamsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + flavorParamsPeer::NUM_COLUMNS;

		flavorAssetPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + flavorAssetPeer::NUM_COLUMNS;

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsOutput($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1);
			}

			$omClass = flavorAssetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getflavorAsset(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addflavorParamsOutput($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initflavorParamsOutputs();
				$obj3->addflavorParamsOutput($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptflavorAsset(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsOutputPeer::addSelectColumns($c);
		$startcol2 = (flavorParamsOutputPeer::NUM_COLUMNS - flavorParamsOutputPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		flavorParamsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + flavorParamsPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		$c->addJoin(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$c->addJoin(flavorParamsOutputPeer::ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsOutputPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsOutput($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsOutputs();
				$obj2->addflavorParamsOutput($obj1);
			}

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getentry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addflavorParamsOutput($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initflavorParamsOutputs();
				$obj3->addflavorParamsOutput($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return flavorParamsOutputPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(flavorParamsOutputPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(flavorParamsOutputPeer::ID);
			$selectCriteria->add(flavorParamsOutputPeer::ID, $criteria->remove(flavorParamsOutputPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(flavorParamsOutputPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(flavorParamsOutputPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof flavorParamsOutput) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(flavorParamsOutputPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(flavorParamsOutput $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(flavorParamsOutputPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(flavorParamsOutputPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(flavorParamsOutputPeer::DATABASE_NAME, flavorParamsOutputPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = flavorParamsOutputPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(flavorParamsOutputPeer::DATABASE_NAME);

		$criteria->add(flavorParamsOutputPeer::ID, $pk);


		$v = flavorParamsOutputPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(flavorParamsOutputPeer::ID, $pks, Criteria::IN);
			$objs = flavorParamsOutputPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseflavorParamsOutputPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/flavorParamsOutputMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.flavorParamsOutputMapBuilder');
}
