<?php


abstract class BaseConversionParamsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'conversion_params';

	
	const CLASS_DEFAULT = 'lib.model.ConversionParams';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'conversion_params.ID';

	
	const PARTNER_ID = 'conversion_params.PARTNER_ID';

	
	const ENABLED = 'conversion_params.ENABLED';

	
	const NAME = 'conversion_params.NAME';

	
	const PROFILE_TYPE = 'conversion_params.PROFILE_TYPE';

	
	const PROFILE_TYPE_INDEX = 'conversion_params.PROFILE_TYPE_INDEX';

	
	const WIDTH = 'conversion_params.WIDTH';

	
	const HEIGHT = 'conversion_params.HEIGHT';

	
	const ASPECT_RATIO = 'conversion_params.ASPECT_RATIO';

	
	const GOP_SIZE = 'conversion_params.GOP_SIZE';

	
	const BITRATE = 'conversion_params.BITRATE';

	
	const QSCALE = 'conversion_params.QSCALE';

	
	const FILE_SUFFIX = 'conversion_params.FILE_SUFFIX';

	
	const CUSTOM_DATA = 'conversion_params.CUSTOM_DATA';

	
	const CREATED_AT = 'conversion_params.CREATED_AT';

	
	const UPDATED_AT = 'conversion_params.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'Enabled', 'Name', 'ProfileType', 'ProfileTypeIndex', 'Width', 'Height', 'AspectRatio', 'GopSize', 'Bitrate', 'Qscale', 'FileSuffix', 'CustomData', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ConversionParamsPeer::ID, ConversionParamsPeer::PARTNER_ID, ConversionParamsPeer::ENABLED, ConversionParamsPeer::NAME, ConversionParamsPeer::PROFILE_TYPE, ConversionParamsPeer::PROFILE_TYPE_INDEX, ConversionParamsPeer::WIDTH, ConversionParamsPeer::HEIGHT, ConversionParamsPeer::ASPECT_RATIO, ConversionParamsPeer::GOP_SIZE, ConversionParamsPeer::BITRATE, ConversionParamsPeer::QSCALE, ConversionParamsPeer::FILE_SUFFIX, ConversionParamsPeer::CUSTOM_DATA, ConversionParamsPeer::CREATED_AT, ConversionParamsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'enabled', 'name', 'profile_type', 'profile_type_index', 'width', 'height', 'aspect_ratio', 'gop_size', 'bitrate', 'qscale', 'file_suffix', 'custom_data', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'Enabled' => 2, 'Name' => 3, 'ProfileType' => 4, 'ProfileTypeIndex' => 5, 'Width' => 6, 'Height' => 7, 'AspectRatio' => 8, 'GopSize' => 9, 'Bitrate' => 10, 'Qscale' => 11, 'FileSuffix' => 12, 'CustomData' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
		BasePeer::TYPE_COLNAME => array (ConversionParamsPeer::ID => 0, ConversionParamsPeer::PARTNER_ID => 1, ConversionParamsPeer::ENABLED => 2, ConversionParamsPeer::NAME => 3, ConversionParamsPeer::PROFILE_TYPE => 4, ConversionParamsPeer::PROFILE_TYPE_INDEX => 5, ConversionParamsPeer::WIDTH => 6, ConversionParamsPeer::HEIGHT => 7, ConversionParamsPeer::ASPECT_RATIO => 8, ConversionParamsPeer::GOP_SIZE => 9, ConversionParamsPeer::BITRATE => 10, ConversionParamsPeer::QSCALE => 11, ConversionParamsPeer::FILE_SUFFIX => 12, ConversionParamsPeer::CUSTOM_DATA => 13, ConversionParamsPeer::CREATED_AT => 14, ConversionParamsPeer::UPDATED_AT => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'enabled' => 2, 'name' => 3, 'profile_type' => 4, 'profile_type_index' => 5, 'width' => 6, 'height' => 7, 'aspect_ratio' => 8, 'gop_size' => 9, 'bitrate' => 10, 'qscale' => 11, 'file_suffix' => 12, 'custom_data' => 13, 'created_at' => 14, 'updated_at' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConversionParamsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConversionParamsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConversionParamsPeer::getTableMap();
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
		return str_replace(ConversionParamsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConversionParamsPeer::ID);

		$criteria->addSelectColumn(ConversionParamsPeer::PARTNER_ID);

		$criteria->addSelectColumn(ConversionParamsPeer::ENABLED);

		$criteria->addSelectColumn(ConversionParamsPeer::NAME);

		$criteria->addSelectColumn(ConversionParamsPeer::PROFILE_TYPE);

		$criteria->addSelectColumn(ConversionParamsPeer::PROFILE_TYPE_INDEX);

		$criteria->addSelectColumn(ConversionParamsPeer::WIDTH);

		$criteria->addSelectColumn(ConversionParamsPeer::HEIGHT);

		$criteria->addSelectColumn(ConversionParamsPeer::ASPECT_RATIO);

		$criteria->addSelectColumn(ConversionParamsPeer::GOP_SIZE);

		$criteria->addSelectColumn(ConversionParamsPeer::BITRATE);

		$criteria->addSelectColumn(ConversionParamsPeer::QSCALE);

		$criteria->addSelectColumn(ConversionParamsPeer::FILE_SUFFIX);

		$criteria->addSelectColumn(ConversionParamsPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(ConversionParamsPeer::CREATED_AT);

		$criteria->addSelectColumn(ConversionParamsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(conversion_params.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT conversion_params.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConversionParamsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConversionParamsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConversionParamsPeer::doSelectRS($criteria, $con);
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
		$objects = ConversionParamsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConversionParamsPeer::populateObjects(ConversionParamsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConversionParamsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ConversionParamsPeer::getOMClass();
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
		return ConversionParamsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ConversionParamsPeer::ID); 

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
			$comparison = $criteria->getComparison(ConversionParamsPeer::ID);
			$selectCriteria->add(ConversionParamsPeer::ID, $criteria->remove(ConversionParamsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ConversionParamsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConversionParamsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ConversionParams) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConversionParamsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ConversionParams $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConversionParamsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConversionParamsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ConversionParamsPeer::DATABASE_NAME, ConversionParamsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ConversionParamsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ConversionParamsPeer::DATABASE_NAME);

		$criteria->add(ConversionParamsPeer::ID, $pk);


		$v = ConversionParamsPeer::doSelect($criteria, $con);

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
			$criteria->add(ConversionParamsPeer::ID, $pks, Criteria::IN);
			$objs = ConversionParamsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseConversionParamsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ConversionParamsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConversionParamsMapBuilder');
}
