<?php


abstract class BaseSchedulerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'scheduler';

	
	const CLASS_DEFAULT = 'lib.model.Scheduler';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'scheduler.ID';

	
	const CREATED_AT = 'scheduler.CREATED_AT';

	
	const CREATED_BY = 'scheduler.CREATED_BY';

	
	const UPDATED_AT = 'scheduler.UPDATED_AT';

	
	const UPDATED_BY = 'scheduler.UPDATED_BY';

	
	const CONFIGURED_ID = 'scheduler.CONFIGURED_ID';

	
	const NAME = 'scheduler.NAME';

	
	const DESCRIPTION = 'scheduler.DESCRIPTION';

	
	const STATUSES = 'scheduler.STATUSES';

	
	const LAST_STATUS = 'scheduler.LAST_STATUS';

	
	const HOST = 'scheduler.HOST';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'CreatedBy', 'UpdatedAt', 'UpdatedBy', 'ConfiguredId', 'Name', 'Description', 'Statuses', 'LastStatus', 'Host', ),
		BasePeer::TYPE_COLNAME => array (SchedulerPeer::ID, SchedulerPeer::CREATED_AT, SchedulerPeer::CREATED_BY, SchedulerPeer::UPDATED_AT, SchedulerPeer::UPDATED_BY, SchedulerPeer::CONFIGURED_ID, SchedulerPeer::NAME, SchedulerPeer::DESCRIPTION, SchedulerPeer::STATUSES, SchedulerPeer::LAST_STATUS, SchedulerPeer::HOST, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'configured_id', 'name', 'description', 'statuses', 'last_status', 'host', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'CreatedBy' => 2, 'UpdatedAt' => 3, 'UpdatedBy' => 4, 'ConfiguredId' => 5, 'Name' => 6, 'Description' => 7, 'Statuses' => 8, 'LastStatus' => 9, 'Host' => 10, ),
		BasePeer::TYPE_COLNAME => array (SchedulerPeer::ID => 0, SchedulerPeer::CREATED_AT => 1, SchedulerPeer::CREATED_BY => 2, SchedulerPeer::UPDATED_AT => 3, SchedulerPeer::UPDATED_BY => 4, SchedulerPeer::CONFIGURED_ID => 5, SchedulerPeer::NAME => 6, SchedulerPeer::DESCRIPTION => 7, SchedulerPeer::STATUSES => 8, SchedulerPeer::LAST_STATUS => 9, SchedulerPeer::HOST => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'created_by' => 2, 'updated_at' => 3, 'updated_by' => 4, 'configured_id' => 5, 'name' => 6, 'description' => 7, 'statuses' => 8, 'last_status' => 9, 'host' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchedulerMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchedulerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SchedulerPeer::getTableMap();
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
		return str_replace(SchedulerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SchedulerPeer::ID);

		$criteria->addSelectColumn(SchedulerPeer::CREATED_AT);

		$criteria->addSelectColumn(SchedulerPeer::CREATED_BY);

		$criteria->addSelectColumn(SchedulerPeer::UPDATED_AT);

		$criteria->addSelectColumn(SchedulerPeer::UPDATED_BY);

		$criteria->addSelectColumn(SchedulerPeer::CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerPeer::NAME);

		$criteria->addSelectColumn(SchedulerPeer::DESCRIPTION);

		$criteria->addSelectColumn(SchedulerPeer::STATUSES);

		$criteria->addSelectColumn(SchedulerPeer::LAST_STATUS);

		$criteria->addSelectColumn(SchedulerPeer::HOST);

	}

	const COUNT = 'COUNT(scheduler.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT scheduler.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchedulerPeer::doSelectRS($criteria, $con);
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
		$objects = SchedulerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SchedulerPeer::populateObjects(SchedulerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchedulerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SchedulerPeer::getOMClass();
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
		return SchedulerPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SchedulerPeer::ID); 

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
			$comparison = $criteria->getComparison(SchedulerPeer::ID);
			$selectCriteria->add(SchedulerPeer::ID, $criteria->remove(SchedulerPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SchedulerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SchedulerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Scheduler) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchedulerPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Scheduler $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchedulerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchedulerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchedulerPeer::DATABASE_NAME, SchedulerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchedulerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SchedulerPeer::DATABASE_NAME);

		$criteria->add(SchedulerPeer::ID, $pk);


		$v = SchedulerPeer::doSelect($criteria, $con);

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
			$criteria->add(SchedulerPeer::ID, $pks, Criteria::IN);
			$objs = SchedulerPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSchedulerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SchedulerMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchedulerMapBuilder');
}
