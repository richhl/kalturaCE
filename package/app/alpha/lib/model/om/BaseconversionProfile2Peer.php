<?php


abstract class BaseconversionProfile2Peer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'conversion_profile_2';

	
	const CLASS_DEFAULT = 'lib.model.conversionProfile2';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'conversion_profile_2.ID';

	
	const PARTNER_ID = 'conversion_profile_2.PARTNER_ID';

	
	const NAME = 'conversion_profile_2.NAME';

	
	const CREATED_AT = 'conversion_profile_2.CREATED_AT';

	
	const UPDATED_AT = 'conversion_profile_2.UPDATED_AT';

	
	const DELETED_AT = 'conversion_profile_2.DELETED_AT';

	
	const DESCRIPTION = 'conversion_profile_2.DESCRIPTION';

	
	const CROP_LEFT = 'conversion_profile_2.CROP_LEFT';

	
	const CROP_TOP = 'conversion_profile_2.CROP_TOP';

	
	const CROP_WIDTH = 'conversion_profile_2.CROP_WIDTH';

	
	const CROP_HEIGHT = 'conversion_profile_2.CROP_HEIGHT';

	
	const CLIP_START = 'conversion_profile_2.CLIP_START';

	
	const CLIP_DURATION = 'conversion_profile_2.CLIP_DURATION';

	
	const INPUT_TAGS_MAP = 'conversion_profile_2.INPUT_TAGS_MAP';

	
	const CREATION_MODE = 'conversion_profile_2.CREATION_MODE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'Name', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'Description', 'CropLeft', 'CropTop', 'CropWidth', 'CropHeight', 'ClipStart', 'ClipDuration', 'InputTagsMap', 'CreationMode', ),
		BasePeer::TYPE_COLNAME => array (conversionProfile2Peer::ID, conversionProfile2Peer::PARTNER_ID, conversionProfile2Peer::NAME, conversionProfile2Peer::CREATED_AT, conversionProfile2Peer::UPDATED_AT, conversionProfile2Peer::DELETED_AT, conversionProfile2Peer::DESCRIPTION, conversionProfile2Peer::CROP_LEFT, conversionProfile2Peer::CROP_TOP, conversionProfile2Peer::CROP_WIDTH, conversionProfile2Peer::CROP_HEIGHT, conversionProfile2Peer::CLIP_START, conversionProfile2Peer::CLIP_DURATION, conversionProfile2Peer::INPUT_TAGS_MAP, conversionProfile2Peer::CREATION_MODE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'name', 'created_at', 'updated_at', 'deleted_at', 'description', 'crop_left', 'crop_top', 'crop_width', 'crop_height', 'clip_start', 'clip_duration', 'input_tags_map', 'creation_mode', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'Name' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'DeletedAt' => 5, 'Description' => 6, 'CropLeft' => 7, 'CropTop' => 8, 'CropWidth' => 9, 'CropHeight' => 10, 'ClipStart' => 11, 'ClipDuration' => 12, 'InputTagsMap' => 13, 'CreationMode' => 14, ),
		BasePeer::TYPE_COLNAME => array (conversionProfile2Peer::ID => 0, conversionProfile2Peer::PARTNER_ID => 1, conversionProfile2Peer::NAME => 2, conversionProfile2Peer::CREATED_AT => 3, conversionProfile2Peer::UPDATED_AT => 4, conversionProfile2Peer::DELETED_AT => 5, conversionProfile2Peer::DESCRIPTION => 6, conversionProfile2Peer::CROP_LEFT => 7, conversionProfile2Peer::CROP_TOP => 8, conversionProfile2Peer::CROP_WIDTH => 9, conversionProfile2Peer::CROP_HEIGHT => 10, conversionProfile2Peer::CLIP_START => 11, conversionProfile2Peer::CLIP_DURATION => 12, conversionProfile2Peer::INPUT_TAGS_MAP => 13, conversionProfile2Peer::CREATION_MODE => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'name' => 2, 'created_at' => 3, 'updated_at' => 4, 'deleted_at' => 5, 'description' => 6, 'crop_left' => 7, 'crop_top' => 8, 'crop_width' => 9, 'crop_height' => 10, 'clip_start' => 11, 'clip_duration' => 12, 'input_tags_map' => 13, 'creation_mode' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/conversionProfile2MapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.conversionProfile2MapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = conversionProfile2Peer::getTableMap();
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
		return str_replace(conversionProfile2Peer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(conversionProfile2Peer::ID);

		$criteria->addSelectColumn(conversionProfile2Peer::PARTNER_ID);

		$criteria->addSelectColumn(conversionProfile2Peer::NAME);

		$criteria->addSelectColumn(conversionProfile2Peer::CREATED_AT);

		$criteria->addSelectColumn(conversionProfile2Peer::UPDATED_AT);

		$criteria->addSelectColumn(conversionProfile2Peer::DELETED_AT);

		$criteria->addSelectColumn(conversionProfile2Peer::DESCRIPTION);

		$criteria->addSelectColumn(conversionProfile2Peer::CROP_LEFT);

		$criteria->addSelectColumn(conversionProfile2Peer::CROP_TOP);

		$criteria->addSelectColumn(conversionProfile2Peer::CROP_WIDTH);

		$criteria->addSelectColumn(conversionProfile2Peer::CROP_HEIGHT);

		$criteria->addSelectColumn(conversionProfile2Peer::CLIP_START);

		$criteria->addSelectColumn(conversionProfile2Peer::CLIP_DURATION);

		$criteria->addSelectColumn(conversionProfile2Peer::INPUT_TAGS_MAP);

		$criteria->addSelectColumn(conversionProfile2Peer::CREATION_MODE);

	}

	const COUNT = 'COUNT(conversion_profile_2.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT conversion_profile_2.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(conversionProfile2Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(conversionProfile2Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = conversionProfile2Peer::doSelectRS($criteria, $con);
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
		$objects = conversionProfile2Peer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return conversionProfile2Peer::populateObjects(conversionProfile2Peer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			conversionProfile2Peer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = conversionProfile2Peer::getOMClass();
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
		return conversionProfile2Peer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(conversionProfile2Peer::ID); 

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
			$comparison = $criteria->getComparison(conversionProfile2Peer::ID);
			$selectCriteria->add(conversionProfile2Peer::ID, $criteria->remove(conversionProfile2Peer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(conversionProfile2Peer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(conversionProfile2Peer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof conversionProfile2) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(conversionProfile2Peer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(conversionProfile2 $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(conversionProfile2Peer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(conversionProfile2Peer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(conversionProfile2Peer::DATABASE_NAME, conversionProfile2Peer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = conversionProfile2Peer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(conversionProfile2Peer::DATABASE_NAME);

		$criteria->add(conversionProfile2Peer::ID, $pk);


		$v = conversionProfile2Peer::doSelect($criteria, $con);

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
			$criteria->add(conversionProfile2Peer::ID, $pks, Criteria::IN);
			$objs = conversionProfile2Peer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseconversionProfile2Peer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/conversionProfile2MapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.conversionProfile2MapBuilder');
}
