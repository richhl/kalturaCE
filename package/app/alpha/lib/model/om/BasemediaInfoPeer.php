<?php


abstract class BasemediaInfoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'media_info';

	
	const CLASS_DEFAULT = 'lib.model.mediaInfo';

	
	const NUM_COLUMNS = 35;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'media_info.ID';

	
	const CREATED_AT = 'media_info.CREATED_AT';

	
	const UPDATED_AT = 'media_info.UPDATED_AT';

	
	const FLAVOR_ASSET_ID = 'media_info.FLAVOR_ASSET_ID';

	
	const FILE_SIZE = 'media_info.FILE_SIZE';

	
	const CONTAINER_FORMAT = 'media_info.CONTAINER_FORMAT';

	
	const CONTAINER_ID = 'media_info.CONTAINER_ID';

	
	const CONTAINER_PROFILE = 'media_info.CONTAINER_PROFILE';

	
	const CONTAINER_DURATION = 'media_info.CONTAINER_DURATION';

	
	const CONTAINER_BIT_RATE = 'media_info.CONTAINER_BIT_RATE';

	
	const VIDEO_FORMAT = 'media_info.VIDEO_FORMAT';

	
	const VIDEO_CODEC_ID = 'media_info.VIDEO_CODEC_ID';

	
	const VIDEO_DURATION = 'media_info.VIDEO_DURATION';

	
	const VIDEO_BIT_RATE = 'media_info.VIDEO_BIT_RATE';

	
	const VIDEO_BIT_RATE_MODE = 'media_info.VIDEO_BIT_RATE_MODE';

	
	const VIDEO_WIDTH = 'media_info.VIDEO_WIDTH';

	
	const VIDEO_HEIGHT = 'media_info.VIDEO_HEIGHT';

	
	const VIDEO_FRAME_RATE = 'media_info.VIDEO_FRAME_RATE';

	
	const VIDEO_DAR = 'media_info.VIDEO_DAR';

	
	const VIDEO_ROTATION = 'media_info.VIDEO_ROTATION';

	
	const AUDIO_FORMAT = 'media_info.AUDIO_FORMAT';

	
	const AUDIO_CODEC_ID = 'media_info.AUDIO_CODEC_ID';

	
	const AUDIO_DURATION = 'media_info.AUDIO_DURATION';

	
	const AUDIO_BIT_RATE = 'media_info.AUDIO_BIT_RATE';

	
	const AUDIO_BIT_RATE_MODE = 'media_info.AUDIO_BIT_RATE_MODE';

	
	const AUDIO_CHANNELS = 'media_info.AUDIO_CHANNELS';

	
	const AUDIO_SAMPLING_RATE = 'media_info.AUDIO_SAMPLING_RATE';

	
	const AUDIO_RESOLUTION = 'media_info.AUDIO_RESOLUTION';

	
	const WRITING_LIB = 'media_info.WRITING_LIB';

	
	const CUSTOM_DATA = 'media_info.CUSTOM_DATA';

	
	const RAW_DATA = 'media_info.RAW_DATA';

	
	const MULTI_STREAM_INFO = 'media_info.MULTI_STREAM_INFO';

	
	const FLAVOR_ASSET_VERSION = 'media_info.FLAVOR_ASSET_VERSION';

	
	const SCAN_TYPE = 'media_info.SCAN_TYPE';

	
	const MULTI_STREAM = 'media_info.MULTI_STREAM';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'FlavorAssetId', 'FileSize', 'ContainerFormat', 'ContainerId', 'ContainerProfile', 'ContainerDuration', 'ContainerBitRate', 'VideoFormat', 'VideoCodecId', 'VideoDuration', 'VideoBitRate', 'VideoBitRateMode', 'VideoWidth', 'VideoHeight', 'VideoFrameRate', 'VideoDar', 'VideoRotation', 'AudioFormat', 'AudioCodecId', 'AudioDuration', 'AudioBitRate', 'AudioBitRateMode', 'AudioChannels', 'AudioSamplingRate', 'AudioResolution', 'WritingLib', 'CustomData', 'RawData', 'MultiStreamInfo', 'FlavorAssetVersion', 'ScanType', 'MultiStream', ),
		BasePeer::TYPE_COLNAME => array (mediaInfoPeer::ID, mediaInfoPeer::CREATED_AT, mediaInfoPeer::UPDATED_AT, mediaInfoPeer::FLAVOR_ASSET_ID, mediaInfoPeer::FILE_SIZE, mediaInfoPeer::CONTAINER_FORMAT, mediaInfoPeer::CONTAINER_ID, mediaInfoPeer::CONTAINER_PROFILE, mediaInfoPeer::CONTAINER_DURATION, mediaInfoPeer::CONTAINER_BIT_RATE, mediaInfoPeer::VIDEO_FORMAT, mediaInfoPeer::VIDEO_CODEC_ID, mediaInfoPeer::VIDEO_DURATION, mediaInfoPeer::VIDEO_BIT_RATE, mediaInfoPeer::VIDEO_BIT_RATE_MODE, mediaInfoPeer::VIDEO_WIDTH, mediaInfoPeer::VIDEO_HEIGHT, mediaInfoPeer::VIDEO_FRAME_RATE, mediaInfoPeer::VIDEO_DAR, mediaInfoPeer::VIDEO_ROTATION, mediaInfoPeer::AUDIO_FORMAT, mediaInfoPeer::AUDIO_CODEC_ID, mediaInfoPeer::AUDIO_DURATION, mediaInfoPeer::AUDIO_BIT_RATE, mediaInfoPeer::AUDIO_BIT_RATE_MODE, mediaInfoPeer::AUDIO_CHANNELS, mediaInfoPeer::AUDIO_SAMPLING_RATE, mediaInfoPeer::AUDIO_RESOLUTION, mediaInfoPeer::WRITING_LIB, mediaInfoPeer::CUSTOM_DATA, mediaInfoPeer::RAW_DATA, mediaInfoPeer::MULTI_STREAM_INFO, mediaInfoPeer::FLAVOR_ASSET_VERSION, mediaInfoPeer::SCAN_TYPE, mediaInfoPeer::MULTI_STREAM, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'flavor_asset_id', 'file_size', 'container_format', 'container_id', 'container_profile', 'container_duration', 'container_bit_rate', 'video_format', 'video_codec_id', 'video_duration', 'video_bit_rate', 'video_bit_rate_mode', 'video_width', 'video_height', 'video_frame_rate', 'video_dar', 'video_rotation', 'audio_format', 'audio_codec_id', 'audio_duration', 'audio_bit_rate', 'audio_bit_rate_mode', 'audio_channels', 'audio_sampling_rate', 'audio_resolution', 'writing_lib', 'custom_data', 'raw_data', 'multi_stream_info', 'flavor_asset_version', 'scan_type', 'multi_stream', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'FlavorAssetId' => 3, 'FileSize' => 4, 'ContainerFormat' => 5, 'ContainerId' => 6, 'ContainerProfile' => 7, 'ContainerDuration' => 8, 'ContainerBitRate' => 9, 'VideoFormat' => 10, 'VideoCodecId' => 11, 'VideoDuration' => 12, 'VideoBitRate' => 13, 'VideoBitRateMode' => 14, 'VideoWidth' => 15, 'VideoHeight' => 16, 'VideoFrameRate' => 17, 'VideoDar' => 18, 'VideoRotation' => 19, 'AudioFormat' => 20, 'AudioCodecId' => 21, 'AudioDuration' => 22, 'AudioBitRate' => 23, 'AudioBitRateMode' => 24, 'AudioChannels' => 25, 'AudioSamplingRate' => 26, 'AudioResolution' => 27, 'WritingLib' => 28, 'CustomData' => 29, 'RawData' => 30, 'MultiStreamInfo' => 31, 'FlavorAssetVersion' => 32, 'ScanType' => 33, 'MultiStream' => 34, ),
		BasePeer::TYPE_COLNAME => array (mediaInfoPeer::ID => 0, mediaInfoPeer::CREATED_AT => 1, mediaInfoPeer::UPDATED_AT => 2, mediaInfoPeer::FLAVOR_ASSET_ID => 3, mediaInfoPeer::FILE_SIZE => 4, mediaInfoPeer::CONTAINER_FORMAT => 5, mediaInfoPeer::CONTAINER_ID => 6, mediaInfoPeer::CONTAINER_PROFILE => 7, mediaInfoPeer::CONTAINER_DURATION => 8, mediaInfoPeer::CONTAINER_BIT_RATE => 9, mediaInfoPeer::VIDEO_FORMAT => 10, mediaInfoPeer::VIDEO_CODEC_ID => 11, mediaInfoPeer::VIDEO_DURATION => 12, mediaInfoPeer::VIDEO_BIT_RATE => 13, mediaInfoPeer::VIDEO_BIT_RATE_MODE => 14, mediaInfoPeer::VIDEO_WIDTH => 15, mediaInfoPeer::VIDEO_HEIGHT => 16, mediaInfoPeer::VIDEO_FRAME_RATE => 17, mediaInfoPeer::VIDEO_DAR => 18, mediaInfoPeer::VIDEO_ROTATION => 19, mediaInfoPeer::AUDIO_FORMAT => 20, mediaInfoPeer::AUDIO_CODEC_ID => 21, mediaInfoPeer::AUDIO_DURATION => 22, mediaInfoPeer::AUDIO_BIT_RATE => 23, mediaInfoPeer::AUDIO_BIT_RATE_MODE => 24, mediaInfoPeer::AUDIO_CHANNELS => 25, mediaInfoPeer::AUDIO_SAMPLING_RATE => 26, mediaInfoPeer::AUDIO_RESOLUTION => 27, mediaInfoPeer::WRITING_LIB => 28, mediaInfoPeer::CUSTOM_DATA => 29, mediaInfoPeer::RAW_DATA => 30, mediaInfoPeer::MULTI_STREAM_INFO => 31, mediaInfoPeer::FLAVOR_ASSET_VERSION => 32, mediaInfoPeer::SCAN_TYPE => 33, mediaInfoPeer::MULTI_STREAM => 34, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'flavor_asset_id' => 3, 'file_size' => 4, 'container_format' => 5, 'container_id' => 6, 'container_profile' => 7, 'container_duration' => 8, 'container_bit_rate' => 9, 'video_format' => 10, 'video_codec_id' => 11, 'video_duration' => 12, 'video_bit_rate' => 13, 'video_bit_rate_mode' => 14, 'video_width' => 15, 'video_height' => 16, 'video_frame_rate' => 17, 'video_dar' => 18, 'video_rotation' => 19, 'audio_format' => 20, 'audio_codec_id' => 21, 'audio_duration' => 22, 'audio_bit_rate' => 23, 'audio_bit_rate_mode' => 24, 'audio_channels' => 25, 'audio_sampling_rate' => 26, 'audio_resolution' => 27, 'writing_lib' => 28, 'custom_data' => 29, 'raw_data' => 30, 'multi_stream_info' => 31, 'flavor_asset_version' => 32, 'scan_type' => 33, 'multi_stream' => 34, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/mediaInfoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.mediaInfoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = mediaInfoPeer::getTableMap();
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
		return str_replace(mediaInfoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(mediaInfoPeer::ID);

		$criteria->addSelectColumn(mediaInfoPeer::CREATED_AT);

		$criteria->addSelectColumn(mediaInfoPeer::UPDATED_AT);

		$criteria->addSelectColumn(mediaInfoPeer::FLAVOR_ASSET_ID);

		$criteria->addSelectColumn(mediaInfoPeer::FILE_SIZE);

		$criteria->addSelectColumn(mediaInfoPeer::CONTAINER_FORMAT);

		$criteria->addSelectColumn(mediaInfoPeer::CONTAINER_ID);

		$criteria->addSelectColumn(mediaInfoPeer::CONTAINER_PROFILE);

		$criteria->addSelectColumn(mediaInfoPeer::CONTAINER_DURATION);

		$criteria->addSelectColumn(mediaInfoPeer::CONTAINER_BIT_RATE);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_FORMAT);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_CODEC_ID);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_DURATION);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_BIT_RATE);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_BIT_RATE_MODE);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_WIDTH);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_HEIGHT);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_FRAME_RATE);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_DAR);

		$criteria->addSelectColumn(mediaInfoPeer::VIDEO_ROTATION);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_FORMAT);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_CODEC_ID);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_DURATION);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_BIT_RATE);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_BIT_RATE_MODE);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_CHANNELS);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_SAMPLING_RATE);

		$criteria->addSelectColumn(mediaInfoPeer::AUDIO_RESOLUTION);

		$criteria->addSelectColumn(mediaInfoPeer::WRITING_LIB);

		$criteria->addSelectColumn(mediaInfoPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(mediaInfoPeer::RAW_DATA);

		$criteria->addSelectColumn(mediaInfoPeer::MULTI_STREAM_INFO);

		$criteria->addSelectColumn(mediaInfoPeer::FLAVOR_ASSET_VERSION);

		$criteria->addSelectColumn(mediaInfoPeer::SCAN_TYPE);

		$criteria->addSelectColumn(mediaInfoPeer::MULTI_STREAM);

	}

	const COUNT = 'COUNT(media_info.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT media_info.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(mediaInfoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(mediaInfoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = mediaInfoPeer::doSelectRS($criteria, $con);
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
		$objects = mediaInfoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return mediaInfoPeer::populateObjects(mediaInfoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			mediaInfoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = mediaInfoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinflavorAsset(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(mediaInfoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(mediaInfoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(mediaInfoPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = mediaInfoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinflavorAsset(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		mediaInfoPeer::addSelectColumns($c);
		$startcol = (mediaInfoPeer::NUM_COLUMNS - mediaInfoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		flavorAssetPeer::addSelectColumns($c);

		$c->addJoin(mediaInfoPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = mediaInfoPeer::getOMClass();

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
										$temp_obj2->addmediaInfo($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initmediaInfos();
				$obj2->addmediaInfo($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(mediaInfoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(mediaInfoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(mediaInfoPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = mediaInfoPeer::doSelectRS($criteria, $con);
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

		mediaInfoPeer::addSelectColumns($c);
		$startcol2 = (mediaInfoPeer::NUM_COLUMNS - mediaInfoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		flavorAssetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + flavorAssetPeer::NUM_COLUMNS;

		$c->addJoin(mediaInfoPeer::FLAVOR_ASSET_ID, flavorAssetPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = mediaInfoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = flavorAssetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getflavorAsset(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addmediaInfo($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initmediaInfos();
				$obj2->addmediaInfo($obj1);
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
		return mediaInfoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(mediaInfoPeer::ID); 

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
			$comparison = $criteria->getComparison(mediaInfoPeer::ID);
			$selectCriteria->add(mediaInfoPeer::ID, $criteria->remove(mediaInfoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(mediaInfoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(mediaInfoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof mediaInfo) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(mediaInfoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(mediaInfo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(mediaInfoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(mediaInfoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(mediaInfoPeer::DATABASE_NAME, mediaInfoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = mediaInfoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(mediaInfoPeer::DATABASE_NAME);

		$criteria->add(mediaInfoPeer::ID, $pk);


		$v = mediaInfoPeer::doSelect($criteria, $con);

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
			$criteria->add(mediaInfoPeer::ID, $pks, Criteria::IN);
			$objs = mediaInfoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasemediaInfoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/mediaInfoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.mediaInfoMapBuilder');
}
