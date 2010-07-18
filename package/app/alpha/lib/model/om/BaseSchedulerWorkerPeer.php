<?php


abstract class BaseSchedulerWorkerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'scheduler_worker';

	
	const CLASS_DEFAULT = 'lib.model.SchedulerWorker';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'scheduler_worker.ID';

	
	const CREATED_AT = 'scheduler_worker.CREATED_AT';

	
	const CREATED_BY = 'scheduler_worker.CREATED_BY';

	
	const UPDATED_AT = 'scheduler_worker.UPDATED_AT';

	
	const UPDATED_BY = 'scheduler_worker.UPDATED_BY';

	
	const SCHEDULER_ID = 'scheduler_worker.SCHEDULER_ID';

	
	const SCHEDULER_CONFIGURED_ID = 'scheduler_worker.SCHEDULER_CONFIGURED_ID';

	
	const CONFIGURED_ID = 'scheduler_worker.CONFIGURED_ID';

	
	const TYPE = 'scheduler_worker.TYPE';

	
	const NAME = 'scheduler_worker.NAME';

	
	const DESCRIPTION = 'scheduler_worker.DESCRIPTION';

	
	const STATUSES = 'scheduler_worker.STATUSES';

	
	const LAST_STATUS = 'scheduler_worker.LAST_STATUS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'CreatedBy', 'UpdatedAt', 'UpdatedBy', 'SchedulerId', 'SchedulerConfiguredId', 'ConfiguredId', 'Type', 'Name', 'Description', 'Statuses', 'LastStatus', ),
		BasePeer::TYPE_COLNAME => array (SchedulerWorkerPeer::ID, SchedulerWorkerPeer::CREATED_AT, SchedulerWorkerPeer::CREATED_BY, SchedulerWorkerPeer::UPDATED_AT, SchedulerWorkerPeer::UPDATED_BY, SchedulerWorkerPeer::SCHEDULER_ID, SchedulerWorkerPeer::SCHEDULER_CONFIGURED_ID, SchedulerWorkerPeer::CONFIGURED_ID, SchedulerWorkerPeer::TYPE, SchedulerWorkerPeer::NAME, SchedulerWorkerPeer::DESCRIPTION, SchedulerWorkerPeer::STATUSES, SchedulerWorkerPeer::LAST_STATUS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'scheduler_id', 'scheduler_configured_id', 'configured_id', 'type', 'name', 'description', 'statuses', 'last_status', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'CreatedBy' => 2, 'UpdatedAt' => 3, 'UpdatedBy' => 4, 'SchedulerId' => 5, 'SchedulerConfiguredId' => 6, 'ConfiguredId' => 7, 'Type' => 8, 'Name' => 9, 'Description' => 10, 'Statuses' => 11, 'LastStatus' => 12, ),
		BasePeer::TYPE_COLNAME => array (SchedulerWorkerPeer::ID => 0, SchedulerWorkerPeer::CREATED_AT => 1, SchedulerWorkerPeer::CREATED_BY => 2, SchedulerWorkerPeer::UPDATED_AT => 3, SchedulerWorkerPeer::UPDATED_BY => 4, SchedulerWorkerPeer::SCHEDULER_ID => 5, SchedulerWorkerPeer::SCHEDULER_CONFIGURED_ID => 6, SchedulerWorkerPeer::CONFIGURED_ID => 7, SchedulerWorkerPeer::TYPE => 8, SchedulerWorkerPeer::NAME => 9, SchedulerWorkerPeer::DESCRIPTION => 10, SchedulerWorkerPeer::STATUSES => 11, SchedulerWorkerPeer::LAST_STATUS => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'created_by' => 2, 'updated_at' => 3, 'updated_by' => 4, 'scheduler_id' => 5, 'scheduler_configured_id' => 6, 'configured_id' => 7, 'type' => 8, 'name' => 9, 'description' => 10, 'statuses' => 11, 'last_status' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchedulerWorkerMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchedulerWorkerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SchedulerWorkerPeer::getTableMap();
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
		return str_replace(SchedulerWorkerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SchedulerWorkerPeer::ID);

		$criteria->addSelectColumn(SchedulerWorkerPeer::CREATED_AT);

		$criteria->addSelectColumn(SchedulerWorkerPeer::CREATED_BY);

		$criteria->addSelectColumn(SchedulerWorkerPeer::UPDATED_AT);

		$criteria->addSelectColumn(SchedulerWorkerPeer::UPDATED_BY);

		$criteria->addSelectColumn(SchedulerWorkerPeer::SCHEDULER_ID);

		$criteria->addSelectColumn(SchedulerWorkerPeer::SCHEDULER_CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerWorkerPeer::CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerWorkerPeer::TYPE);

		$criteria->addSelectColumn(SchedulerWorkerPeer::NAME);

		$criteria->addSelectColumn(SchedulerWorkerPeer::DESCRIPTION);

		$criteria->addSelectColumn(SchedulerWorkerPeer::STATUSES);

		$criteria->addSelectColumn(SchedulerWorkerPeer::LAST_STATUS);

	}

	const COUNT = 'COUNT(scheduler_worker.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT scheduler_worker.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulerWorkerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulerWorkerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchedulerWorkerPeer::doSelectRS($criteria, $con);
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
		$objects = SchedulerWorkerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SchedulerWorkerPeer::populateObjects(SchedulerWorkerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchedulerWorkerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SchedulerWorkerPeer::getOMClass();
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
		return SchedulerWorkerPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SchedulerWorkerPeer::ID); 

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
			$comparison = $criteria->getComparison(SchedulerWorkerPeer::ID);
			$selectCriteria->add(SchedulerWorkerPeer::ID, $criteria->remove(SchedulerWorkerPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SchedulerWorkerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SchedulerWorkerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SchedulerWorker) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchedulerWorkerPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SchedulerWorker $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchedulerWorkerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchedulerWorkerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchedulerWorkerPeer::DATABASE_NAME, SchedulerWorkerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchedulerWorkerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SchedulerWorkerPeer::DATABASE_NAME);

		$criteria->add(SchedulerWorkerPeer::ID, $pk);


		$v = SchedulerWorkerPeer::doSelect($criteria, $con);

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
			$criteria->add(SchedulerWorkerPeer::ID, $pks, Criteria::IN);
			$objs = SchedulerWorkerPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSchedulerWorkerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SchedulerWorkerMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchedulerWorkerMapBuilder');
}
