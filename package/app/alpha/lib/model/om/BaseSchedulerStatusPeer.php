<?php


abstract class BaseSchedulerStatusPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'scheduler_status';

	
	const CLASS_DEFAULT = 'lib.model.SchedulerStatus';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'scheduler_status.ID';

	
	const CREATED_AT = 'scheduler_status.CREATED_AT';

	
	const CREATED_BY = 'scheduler_status.CREATED_BY';

	
	const UPDATED_AT = 'scheduler_status.UPDATED_AT';

	
	const UPDATED_BY = 'scheduler_status.UPDATED_BY';

	
	const SCHEDULER_ID = 'scheduler_status.SCHEDULER_ID';

	
	const SCHEDULER_CONFIGURED_ID = 'scheduler_status.SCHEDULER_CONFIGURED_ID';

	
	const WORKER_ID = 'scheduler_status.WORKER_ID';

	
	const WORKER_CONFIGURED_ID = 'scheduler_status.WORKER_CONFIGURED_ID';

	
	const WORKER_TYPE = 'scheduler_status.WORKER_TYPE';

	
	const TYPE = 'scheduler_status.TYPE';

	
	const VALUE = 'scheduler_status.VALUE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'CreatedBy', 'UpdatedAt', 'UpdatedBy', 'SchedulerId', 'SchedulerConfiguredId', 'WorkerId', 'WorkerConfiguredId', 'WorkerType', 'Type', 'Value', ),
		BasePeer::TYPE_COLNAME => array (SchedulerStatusPeer::ID, SchedulerStatusPeer::CREATED_AT, SchedulerStatusPeer::CREATED_BY, SchedulerStatusPeer::UPDATED_AT, SchedulerStatusPeer::UPDATED_BY, SchedulerStatusPeer::SCHEDULER_ID, SchedulerStatusPeer::SCHEDULER_CONFIGURED_ID, SchedulerStatusPeer::WORKER_ID, SchedulerStatusPeer::WORKER_CONFIGURED_ID, SchedulerStatusPeer::WORKER_TYPE, SchedulerStatusPeer::TYPE, SchedulerStatusPeer::VALUE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'scheduler_id', 'scheduler_configured_id', 'worker_id', 'worker_configured_id', 'worker_type', 'type', 'value', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'CreatedBy' => 2, 'UpdatedAt' => 3, 'UpdatedBy' => 4, 'SchedulerId' => 5, 'SchedulerConfiguredId' => 6, 'WorkerId' => 7, 'WorkerConfiguredId' => 8, 'WorkerType' => 9, 'Type' => 10, 'Value' => 11, ),
		BasePeer::TYPE_COLNAME => array (SchedulerStatusPeer::ID => 0, SchedulerStatusPeer::CREATED_AT => 1, SchedulerStatusPeer::CREATED_BY => 2, SchedulerStatusPeer::UPDATED_AT => 3, SchedulerStatusPeer::UPDATED_BY => 4, SchedulerStatusPeer::SCHEDULER_ID => 5, SchedulerStatusPeer::SCHEDULER_CONFIGURED_ID => 6, SchedulerStatusPeer::WORKER_ID => 7, SchedulerStatusPeer::WORKER_CONFIGURED_ID => 8, SchedulerStatusPeer::WORKER_TYPE => 9, SchedulerStatusPeer::TYPE => 10, SchedulerStatusPeer::VALUE => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'created_by' => 2, 'updated_at' => 3, 'updated_by' => 4, 'scheduler_id' => 5, 'scheduler_configured_id' => 6, 'worker_id' => 7, 'worker_configured_id' => 8, 'worker_type' => 9, 'type' => 10, 'value' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchedulerStatusMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchedulerStatusMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SchedulerStatusPeer::getTableMap();
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
		return str_replace(SchedulerStatusPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SchedulerStatusPeer::ID);

		$criteria->addSelectColumn(SchedulerStatusPeer::CREATED_AT);

		$criteria->addSelectColumn(SchedulerStatusPeer::CREATED_BY);

		$criteria->addSelectColumn(SchedulerStatusPeer::UPDATED_AT);

		$criteria->addSelectColumn(SchedulerStatusPeer::UPDATED_BY);

		$criteria->addSelectColumn(SchedulerStatusPeer::SCHEDULER_ID);

		$criteria->addSelectColumn(SchedulerStatusPeer::SCHEDULER_CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerStatusPeer::WORKER_ID);

		$criteria->addSelectColumn(SchedulerStatusPeer::WORKER_CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerStatusPeer::WORKER_TYPE);

		$criteria->addSelectColumn(SchedulerStatusPeer::TYPE);

		$criteria->addSelectColumn(SchedulerStatusPeer::VALUE);

	}

	const COUNT = 'COUNT(scheduler_status.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT scheduler_status.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulerStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulerStatusPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchedulerStatusPeer::doSelectRS($criteria, $con);
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
		$objects = SchedulerStatusPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SchedulerStatusPeer::populateObjects(SchedulerStatusPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchedulerStatusPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SchedulerStatusPeer::getOMClass();
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
		return SchedulerStatusPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SchedulerStatusPeer::ID); 

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
			$comparison = $criteria->getComparison(SchedulerStatusPeer::ID);
			$selectCriteria->add(SchedulerStatusPeer::ID, $criteria->remove(SchedulerStatusPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SchedulerStatusPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SchedulerStatusPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SchedulerStatus) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchedulerStatusPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SchedulerStatus $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchedulerStatusPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchedulerStatusPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchedulerStatusPeer::DATABASE_NAME, SchedulerStatusPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchedulerStatusPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SchedulerStatusPeer::DATABASE_NAME);

		$criteria->add(SchedulerStatusPeer::ID, $pk);


		$v = SchedulerStatusPeer::doSelect($criteria, $con);

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
			$criteria->add(SchedulerStatusPeer::ID, $pks, Criteria::IN);
			$objs = SchedulerStatusPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSchedulerStatusPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SchedulerStatusMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchedulerStatusMapBuilder');
}
