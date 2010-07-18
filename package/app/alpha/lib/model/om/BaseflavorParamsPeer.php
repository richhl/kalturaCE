<?php


abstract class BaseflavorParamsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'flavor_params';

	
	const CLASS_DEFAULT = 'lib.model.flavorParams';

	
	const NUM_COLUMNS = 31;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'flavor_params.ID';

	
	const VERSION = 'flavor_params.VERSION';

	
	const PARTNER_ID = 'flavor_params.PARTNER_ID';

	
	const NAME = 'flavor_params.NAME';

	
	const TAGS = 'flavor_params.TAGS';

	
	const DESCRIPTION = 'flavor_params.DESCRIPTION';

	
	const READY_BEHAVIOR = 'flavor_params.READY_BEHAVIOR';

	
	const CREATED_AT = 'flavor_params.CREATED_AT';

	
	const UPDATED_AT = 'flavor_params.UPDATED_AT';

	
	const DELETED_AT = 'flavor_params.DELETED_AT';

	
	const IS_DEFAULT = 'flavor_params.IS_DEFAULT';

	
	const FORMAT = 'flavor_params.FORMAT';

	
	const VIDEO_CODEC = 'flavor_params.VIDEO_CODEC';

	
	const VIDEO_BITRATE = 'flavor_params.VIDEO_BITRATE';

	
	const AUDIO_CODEC = 'flavor_params.AUDIO_CODEC';

	
	const AUDIO_BITRATE = 'flavor_params.AUDIO_BITRATE';

	
	const AUDIO_CHANNELS = 'flavor_params.AUDIO_CHANNELS';

	
	const AUDIO_SAMPLE_RATE = 'flavor_params.AUDIO_SAMPLE_RATE';

	
	const AUDIO_RESOLUTION = 'flavor_params.AUDIO_RESOLUTION';

	
	const WIDTH = 'flavor_params.WIDTH';

	
	const HEIGHT = 'flavor_params.HEIGHT';

	
	const FRAME_RATE = 'flavor_params.FRAME_RATE';

	
	const GOP_SIZE = 'flavor_params.GOP_SIZE';

	
	const TWO_PASS = 'flavor_params.TWO_PASS';

	
	const CONVERSION_ENGINES = 'flavor_params.CONVERSION_ENGINES';

	
	const CONVERSION_ENGINES_EXTRA_PARAMS = 'flavor_params.CONVERSION_ENGINES_EXTRA_PARAMS';

	
	const CUSTOM_DATA = 'flavor_params.CUSTOM_DATA';

	
	const VIEW_ORDER = 'flavor_params.VIEW_ORDER';

	
	const CREATION_MODE = 'flavor_params.CREATION_MODE';

	
	const DEINTERLICE = 'flavor_params.DEINTERLICE';

	
	const ROTATE = 'flavor_params.ROTATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Version', 'PartnerId', 'Name', 'Tags', 'Description', 'ReadyBehavior', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'IsDefault', 'Format', 'VideoCodec', 'VideoBitrate', 'AudioCodec', 'AudioBitrate', 'AudioChannels', 'AudioSampleRate', 'AudioResolution', 'Width', 'Height', 'FrameRate', 'GopSize', 'TwoPass', 'ConversionEngines', 'ConversionEnginesExtraParams', 'CustomData', 'ViewOrder', 'CreationMode', 'Deinterlice', 'Rotate', ),
		BasePeer::TYPE_COLNAME => array (flavorParamsPeer::ID, flavorParamsPeer::VERSION, flavorParamsPeer::PARTNER_ID, flavorParamsPeer::NAME, flavorParamsPeer::TAGS, flavorParamsPeer::DESCRIPTION, flavorParamsPeer::READY_BEHAVIOR, flavorParamsPeer::CREATED_AT, flavorParamsPeer::UPDATED_AT, flavorParamsPeer::DELETED_AT, flavorParamsPeer::IS_DEFAULT, flavorParamsPeer::FORMAT, flavorParamsPeer::VIDEO_CODEC, flavorParamsPeer::VIDEO_BITRATE, flavorParamsPeer::AUDIO_CODEC, flavorParamsPeer::AUDIO_BITRATE, flavorParamsPeer::AUDIO_CHANNELS, flavorParamsPeer::AUDIO_SAMPLE_RATE, flavorParamsPeer::AUDIO_RESOLUTION, flavorParamsPeer::WIDTH, flavorParamsPeer::HEIGHT, flavorParamsPeer::FRAME_RATE, flavorParamsPeer::GOP_SIZE, flavorParamsPeer::TWO_PASS, flavorParamsPeer::CONVERSION_ENGINES, flavorParamsPeer::CONVERSION_ENGINES_EXTRA_PARAMS, flavorParamsPeer::CUSTOM_DATA, flavorParamsPeer::VIEW_ORDER, flavorParamsPeer::CREATION_MODE, flavorParamsPeer::DEINTERLICE, flavorParamsPeer::ROTATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'version', 'partner_id', 'name', 'tags', 'description', 'ready_behavior', 'created_at', 'updated_at', 'deleted_at', 'is_default', 'format', 'video_codec', 'video_bitrate', 'audio_codec', 'audio_bitrate', 'audio_channels', 'audio_sample_rate', 'audio_resolution', 'width', 'height', 'frame_rate', 'gop_size', 'two_pass', 'conversion_engines', 'conversion_engines_extra_params', 'custom_data', 'view_order', 'creation_mode', 'deinterlice', 'rotate', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Version' => 1, 'PartnerId' => 2, 'Name' => 3, 'Tags' => 4, 'Description' => 5, 'ReadyBehavior' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'DeletedAt' => 9, 'IsDefault' => 10, 'Format' => 11, 'VideoCodec' => 12, 'VideoBitrate' => 13, 'AudioCodec' => 14, 'AudioBitrate' => 15, 'AudioChannels' => 16, 'AudioSampleRate' => 17, 'AudioResolution' => 18, 'Width' => 19, 'Height' => 20, 'FrameRate' => 21, 'GopSize' => 22, 'TwoPass' => 23, 'ConversionEngines' => 24, 'ConversionEnginesExtraParams' => 25, 'CustomData' => 26, 'ViewOrder' => 27, 'CreationMode' => 28, 'Deinterlice' => 29, 'Rotate' => 30, ),
		BasePeer::TYPE_COLNAME => array (flavorParamsPeer::ID => 0, flavorParamsPeer::VERSION => 1, flavorParamsPeer::PARTNER_ID => 2, flavorParamsPeer::NAME => 3, flavorParamsPeer::TAGS => 4, flavorParamsPeer::DESCRIPTION => 5, flavorParamsPeer::READY_BEHAVIOR => 6, flavorParamsPeer::CREATED_AT => 7, flavorParamsPeer::UPDATED_AT => 8, flavorParamsPeer::DELETED_AT => 9, flavorParamsPeer::IS_DEFAULT => 10, flavorParamsPeer::FORMAT => 11, flavorParamsPeer::VIDEO_CODEC => 12, flavorParamsPeer::VIDEO_BITRATE => 13, flavorParamsPeer::AUDIO_CODEC => 14, flavorParamsPeer::AUDIO_BITRATE => 15, flavorParamsPeer::AUDIO_CHANNELS => 16, flavorParamsPeer::AUDIO_SAMPLE_RATE => 17, flavorParamsPeer::AUDIO_RESOLUTION => 18, flavorParamsPeer::WIDTH => 19, flavorParamsPeer::HEIGHT => 20, flavorParamsPeer::FRAME_RATE => 21, flavorParamsPeer::GOP_SIZE => 22, flavorParamsPeer::TWO_PASS => 23, flavorParamsPeer::CONVERSION_ENGINES => 24, flavorParamsPeer::CONVERSION_ENGINES_EXTRA_PARAMS => 25, flavorParamsPeer::CUSTOM_DATA => 26, flavorParamsPeer::VIEW_ORDER => 27, flavorParamsPeer::CREATION_MODE => 28, flavorParamsPeer::DEINTERLICE => 29, flavorParamsPeer::ROTATE => 30, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'version' => 1, 'partner_id' => 2, 'name' => 3, 'tags' => 4, 'description' => 5, 'ready_behavior' => 6, 'created_at' => 7, 'updated_at' => 8, 'deleted_at' => 9, 'is_default' => 10, 'format' => 11, 'video_codec' => 12, 'video_bitrate' => 13, 'audio_codec' => 14, 'audio_bitrate' => 15, 'audio_channels' => 16, 'audio_sample_rate' => 17, 'audio_resolution' => 18, 'width' => 19, 'height' => 20, 'frame_rate' => 21, 'gop_size' => 22, 'two_pass' => 23, 'conversion_engines' => 24, 'conversion_engines_extra_params' => 25, 'custom_data' => 26, 'view_order' => 27, 'creation_mode' => 28, 'deinterlice' => 29, 'rotate' => 30, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/flavorParamsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.flavorParamsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = flavorParamsPeer::getTableMap();
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
		return str_replace(flavorParamsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(flavorParamsPeer::ID);

		$criteria->addSelectColumn(flavorParamsPeer::VERSION);

		$criteria->addSelectColumn(flavorParamsPeer::PARTNER_ID);

		$criteria->addSelectColumn(flavorParamsPeer::NAME);

		$criteria->addSelectColumn(flavorParamsPeer::TAGS);

		$criteria->addSelectColumn(flavorParamsPeer::DESCRIPTION);

		$criteria->addSelectColumn(flavorParamsPeer::READY_BEHAVIOR);

		$criteria->addSelectColumn(flavorParamsPeer::CREATED_AT);

		$criteria->addSelectColumn(flavorParamsPeer::UPDATED_AT);

		$criteria->addSelectColumn(flavorParamsPeer::DELETED_AT);

		$criteria->addSelectColumn(flavorParamsPeer::IS_DEFAULT);

		$criteria->addSelectColumn(flavorParamsPeer::FORMAT);

		$criteria->addSelectColumn(flavorParamsPeer::VIDEO_CODEC);

		$criteria->addSelectColumn(flavorParamsPeer::VIDEO_BITRATE);

		$criteria->addSelectColumn(flavorParamsPeer::AUDIO_CODEC);

		$criteria->addSelectColumn(flavorParamsPeer::AUDIO_BITRATE);

		$criteria->addSelectColumn(flavorParamsPeer::AUDIO_CHANNELS);

		$criteria->addSelectColumn(flavorParamsPeer::AUDIO_SAMPLE_RATE);

		$criteria->addSelectColumn(flavorParamsPeer::AUDIO_RESOLUTION);

		$criteria->addSelectColumn(flavorParamsPeer::WIDTH);

		$criteria->addSelectColumn(flavorParamsPeer::HEIGHT);

		$criteria->addSelectColumn(flavorParamsPeer::FRAME_RATE);

		$criteria->addSelectColumn(flavorParamsPeer::GOP_SIZE);

		$criteria->addSelectColumn(flavorParamsPeer::TWO_PASS);

		$criteria->addSelectColumn(flavorParamsPeer::CONVERSION_ENGINES);

		$criteria->addSelectColumn(flavorParamsPeer::CONVERSION_ENGINES_EXTRA_PARAMS);

		$criteria->addSelectColumn(flavorParamsPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(flavorParamsPeer::VIEW_ORDER);

		$criteria->addSelectColumn(flavorParamsPeer::CREATION_MODE);

		$criteria->addSelectColumn(flavorParamsPeer::DEINTERLICE);

		$criteria->addSelectColumn(flavorParamsPeer::ROTATE);

	}

	const COUNT = 'COUNT(flavor_params.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT flavor_params.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = flavorParamsPeer::doSelectRS($criteria, $con);
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
		$objects = flavorParamsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return flavorParamsPeer::populateObjects(flavorParamsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			flavorParamsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = flavorParamsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return flavorParamsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(flavorParamsPeer::ID); 

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
			$comparison = $criteria->getComparison(flavorParamsPeer::ID);
			$selectCriteria->add(flavorParamsPeer::ID, $criteria->remove(flavorParamsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(flavorParamsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(flavorParamsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof flavorParams) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(flavorParamsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(flavorParams $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(flavorParamsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(flavorParamsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(flavorParamsPeer::DATABASE_NAME, flavorParamsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = flavorParamsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(flavorParamsPeer::DATABASE_NAME);

		$criteria->add(flavorParamsPeer::ID, $pk);


		$v = flavorParamsPeer::doSelect($criteria, $con);

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
			$criteria->add(flavorParamsPeer::ID, $pks, Criteria::IN);
			$objs = flavorParamsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseflavorParamsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/flavorParamsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.flavorParamsMapBuilder');
}
