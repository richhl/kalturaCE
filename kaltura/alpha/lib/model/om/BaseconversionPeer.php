<?php


abstract class BaseconversionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'conversion';

	
	const CLASS_DEFAULT = 'lib.model.conversion';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'conversion.ID';

	
	const ENTRY_ID = 'conversion.ENTRY_ID';

	
	const IN_FILE_NAME = 'conversion.IN_FILE_NAME';

	
	const IN_FILE_EXT = 'conversion.IN_FILE_EXT';

	
	const IN_FILE_SIZE = 'conversion.IN_FILE_SIZE';

	
	const SOURCE = 'conversion.SOURCE';

	
	const STATUS = 'conversion.STATUS';

	
	const CONVERSION_PARAMS = 'conversion.CONVERSION_PARAMS';

	
	const OUT_FILE_NAME = 'conversion.OUT_FILE_NAME';

	
	const OUT_FILE_SIZE = 'conversion.OUT_FILE_SIZE';

	
	const OUT_FILE_NAME_2 = 'conversion.OUT_FILE_NAME_2';

	
	const OUT_FILE_SIZE_2 = 'conversion.OUT_FILE_SIZE_2';

	
	const CONVERSION_TIME = 'conversion.CONVERSION_TIME';

	
	const TOTAL_PROCESS_TIME = 'conversion.TOTAL_PROCESS_TIME';

	
	const CREATED_AT = 'conversion.CREATED_AT';

	
	const UPDATED_AT = 'conversion.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'EntryId', 'InFileName', 'InFileExt', 'InFileSize', 'Source', 'Status', 'ConversionParams', 'OutFileName', 'OutFileSize', 'OutFileName2', 'OutFileSize2', 'ConversionTime', 'TotalProcessTime', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (conversionPeer::ID, conversionPeer::ENTRY_ID, conversionPeer::IN_FILE_NAME, conversionPeer::IN_FILE_EXT, conversionPeer::IN_FILE_SIZE, conversionPeer::SOURCE, conversionPeer::STATUS, conversionPeer::CONVERSION_PARAMS, conversionPeer::OUT_FILE_NAME, conversionPeer::OUT_FILE_SIZE, conversionPeer::OUT_FILE_NAME_2, conversionPeer::OUT_FILE_SIZE_2, conversionPeer::CONVERSION_TIME, conversionPeer::TOTAL_PROCESS_TIME, conversionPeer::CREATED_AT, conversionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'entry_id', 'in_file_name', 'in_file_ext', 'in_file_size', 'source', 'status', 'conversion_params', 'out_file_name', 'out_file_size', 'out_file_name_2', 'out_file_size_2', 'conversion_time', 'total_process_time', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'EntryId' => 1, 'InFileName' => 2, 'InFileExt' => 3, 'InFileSize' => 4, 'Source' => 5, 'Status' => 6, 'ConversionParams' => 7, 'OutFileName' => 8, 'OutFileSize' => 9, 'OutFileName2' => 10, 'OutFileSize2' => 11, 'ConversionTime' => 12, 'TotalProcessTime' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
		BasePeer::TYPE_COLNAME => array (conversionPeer::ID => 0, conversionPeer::ENTRY_ID => 1, conversionPeer::IN_FILE_NAME => 2, conversionPeer::IN_FILE_EXT => 3, conversionPeer::IN_FILE_SIZE => 4, conversionPeer::SOURCE => 5, conversionPeer::STATUS => 6, conversionPeer::CONVERSION_PARAMS => 7, conversionPeer::OUT_FILE_NAME => 8, conversionPeer::OUT_FILE_SIZE => 9, conversionPeer::OUT_FILE_NAME_2 => 10, conversionPeer::OUT_FILE_SIZE_2 => 11, conversionPeer::CONVERSION_TIME => 12, conversionPeer::TOTAL_PROCESS_TIME => 13, conversionPeer::CREATED_AT => 14, conversionPeer::UPDATED_AT => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'entry_id' => 1, 'in_file_name' => 2, 'in_file_ext' => 3, 'in_file_size' => 4, 'source' => 5, 'status' => 6, 'conversion_params' => 7, 'out_file_name' => 8, 'out_file_size' => 9, 'out_file_name_2' => 10, 'out_file_size_2' => 11, 'conversion_time' => 12, 'total_process_time' => 13, 'created_at' => 14, 'updated_at' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/conversionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.conversionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = conversionPeer::getTableMap();
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
		return str_replace(conversionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(conversionPeer::ID);

		$criteria->addSelectColumn(conversionPeer::ENTRY_ID);

		$criteria->addSelectColumn(conversionPeer::IN_FILE_NAME);

		$criteria->addSelectColumn(conversionPeer::IN_FILE_EXT);

		$criteria->addSelectColumn(conversionPeer::IN_FILE_SIZE);

		$criteria->addSelectColumn(conversionPeer::SOURCE);

		$criteria->addSelectColumn(conversionPeer::STATUS);

		$criteria->addSelectColumn(conversionPeer::CONVERSION_PARAMS);

		$criteria->addSelectColumn(conversionPeer::OUT_FILE_NAME);

		$criteria->addSelectColumn(conversionPeer::OUT_FILE_SIZE);

		$criteria->addSelectColumn(conversionPeer::OUT_FILE_NAME_2);

		$criteria->addSelectColumn(conversionPeer::OUT_FILE_SIZE_2);

		$criteria->addSelectColumn(conversionPeer::CONVERSION_TIME);

		$criteria->addSelectColumn(conversionPeer::TOTAL_PROCESS_TIME);

		$criteria->addSelectColumn(conversionPeer::CREATED_AT);

		$criteria->addSelectColumn(conversionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(conversion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT conversion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(conversionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(conversionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = conversionPeer::doSelectRS($criteria, $con);
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
		$objects = conversionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return conversionPeer::populateObjects(conversionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			conversionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = conversionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(conversionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(conversionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(conversionPeer::ENTRY_ID, entryPeer::ID);

		$rs = conversionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinentry(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		conversionPeer::addSelectColumns($c);
		$startcol = (conversionPeer::NUM_COLUMNS - conversionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(conversionPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = conversionPeer::getOMClass();

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
										$temp_obj2->addconversion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initconversions();
				$obj2->addconversion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(conversionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(conversionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(conversionPeer::ENTRY_ID, entryPeer::ID);

		$rs = conversionPeer::doSelectRS($criteria, $con);
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

		conversionPeer::addSelectColumns($c);
		$startcol2 = (conversionPeer::NUM_COLUMNS - conversionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		$c->addJoin(conversionPeer::ENTRY_ID, entryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = conversionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addconversion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initconversions();
				$obj2->addconversion($obj1);
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
		return conversionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(conversionPeer::ID); 

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
			$comparison = $criteria->getComparison(conversionPeer::ID);
			$selectCriteria->add(conversionPeer::ID, $criteria->remove(conversionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(conversionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(conversionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof conversion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(conversionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(conversion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(conversionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(conversionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(conversionPeer::DATABASE_NAME, conversionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = conversionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(conversionPeer::DATABASE_NAME);

		$criteria->add(conversionPeer::ID, $pk);


		$v = conversionPeer::doSelect($criteria, $con);

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
			$criteria->add(conversionPeer::ID, $pks, Criteria::IN);
			$objs = conversionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseconversionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/conversionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.conversionMapBuilder');
}
