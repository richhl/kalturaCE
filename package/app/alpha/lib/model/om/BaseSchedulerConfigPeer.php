<?php


abstract class BaseSchedulerConfigPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'scheduler_config';

	
	const CLASS_DEFAULT = 'lib.model.SchedulerConfig';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'scheduler_config.ID';

	
	const CREATED_AT = 'scheduler_config.CREATED_AT';

	
	const CREATED_BY = 'scheduler_config.CREATED_BY';

	
	const UPDATED_AT = 'scheduler_config.UPDATED_AT';

	
	const UPDATED_BY = 'scheduler_config.UPDATED_BY';

	
	const COMMAND_ID = 'scheduler_config.COMMAND_ID';

	
	const COMMAND_STATUS = 'scheduler_config.COMMAND_STATUS';

	
	const SCHEDULER_ID = 'scheduler_config.SCHEDULER_ID';

	
	const SCHEDULER_CONFIGURED_ID = 'scheduler_config.SCHEDULER_CONFIGURED_ID';

	
	const SCHEDULER_NAME = 'scheduler_config.SCHEDULER_NAME';

	
	const WORKER_ID = 'scheduler_config.WORKER_ID';

	
	const WORKER_CONFIGURED_ID = 'scheduler_config.WORKER_CONFIGURED_ID';

	
	const WORKER_NAME = 'scheduler_config.WORKER_NAME';

	
	const VARIABLE = 'scheduler_config.VARIABLE';

	
	const VARIABLE_PART = 'scheduler_config.VARIABLE_PART';

	
	const VALUE = 'scheduler_config.VALUE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'CreatedBy', 'UpdatedAt', 'UpdatedBy', 'CommandId', 'CommandStatus', 'SchedulerId', 'SchedulerConfiguredId', 'SchedulerName', 'WorkerId', 'WorkerConfiguredId', 'WorkerName', 'Variable', 'VariablePart', 'Value', ),
		BasePeer::TYPE_COLNAME => array (SchedulerConfigPeer::ID, SchedulerConfigPeer::CREATED_AT, SchedulerConfigPeer::CREATED_BY, SchedulerConfigPeer::UPDATED_AT, SchedulerConfigPeer::UPDATED_BY, SchedulerConfigPeer::COMMAND_ID, SchedulerConfigPeer::COMMAND_STATUS, SchedulerConfigPeer::SCHEDULER_ID, SchedulerConfigPeer::SCHEDULER_CONFIGURED_ID, SchedulerConfigPeer::SCHEDULER_NAME, SchedulerConfigPeer::WORKER_ID, SchedulerConfigPeer::WORKER_CONFIGURED_ID, SchedulerConfigPeer::WORKER_NAME, SchedulerConfigPeer::VARIABLE, SchedulerConfigPeer::VARIABLE_PART, SchedulerConfigPeer::VALUE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'command_id', 'command_status', 'scheduler_id', 'scheduler_configured_id', 'scheduler_name', 'worker_id', 'worker_configured_id', 'worker_name', 'variable', 'variable_part', 'value', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'CreatedBy' => 2, 'UpdatedAt' => 3, 'UpdatedBy' => 4, 'CommandId' => 5, 'CommandStatus' => 6, 'SchedulerId' => 7, 'SchedulerConfiguredId' => 8, 'SchedulerName' => 9, 'WorkerId' => 10, 'WorkerConfiguredId' => 11, 'WorkerName' => 12, 'Variable' => 13, 'VariablePart' => 14, 'Value' => 15, ),
		BasePeer::TYPE_COLNAME => array (SchedulerConfigPeer::ID => 0, SchedulerConfigPeer::CREATED_AT => 1, SchedulerConfigPeer::CREATED_BY => 2, SchedulerConfigPeer::UPDATED_AT => 3, SchedulerConfigPeer::UPDATED_BY => 4, SchedulerConfigPeer::COMMAND_ID => 5, SchedulerConfigPeer::COMMAND_STATUS => 6, SchedulerConfigPeer::SCHEDULER_ID => 7, SchedulerConfigPeer::SCHEDULER_CONFIGURED_ID => 8, SchedulerConfigPeer::SCHEDULER_NAME => 9, SchedulerConfigPeer::WORKER_ID => 10, SchedulerConfigPeer::WORKER_CONFIGURED_ID => 11, SchedulerConfigPeer::WORKER_NAME => 12, SchedulerConfigPeer::VARIABLE => 13, SchedulerConfigPeer::VARIABLE_PART => 14, SchedulerConfigPeer::VALUE => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'created_by' => 2, 'updated_at' => 3, 'updated_by' => 4, 'command_id' => 5, 'command_status' => 6, 'scheduler_id' => 7, 'scheduler_configured_id' => 8, 'scheduler_name' => 9, 'worker_id' => 10, 'worker_configured_id' => 11, 'worker_name' => 12, 'variable' => 13, 'variable_part' => 14, 'value' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchedulerConfigMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchedulerConfigMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SchedulerConfigPeer::getTableMap();
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
		return str_replace(SchedulerConfigPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SchedulerConfigPeer::ID);

		$criteria->addSelectColumn(SchedulerConfigPeer::CREATED_AT);

		$criteria->addSelectColumn(SchedulerConfigPeer::CREATED_BY);

		$criteria->addSelectColumn(SchedulerConfigPeer::UPDATED_AT);

		$criteria->addSelectColumn(SchedulerConfigPeer::UPDATED_BY);

		$criteria->addSelectColumn(SchedulerConfigPeer::COMMAND_ID);

		$criteria->addSelectColumn(SchedulerConfigPeer::COMMAND_STATUS);

		$criteria->addSelectColumn(SchedulerConfigPeer::SCHEDULER_ID);

		$criteria->addSelectColumn(SchedulerConfigPeer::SCHEDULER_CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerConfigPeer::SCHEDULER_NAME);

		$criteria->addSelectColumn(SchedulerConfigPeer::WORKER_ID);

		$criteria->addSelectColumn(SchedulerConfigPeer::WORKER_CONFIGURED_ID);

		$criteria->addSelectColumn(SchedulerConfigPeer::WORKER_NAME);

		$criteria->addSelectColumn(SchedulerConfigPeer::VARIABLE);

		$criteria->addSelectColumn(SchedulerConfigPeer::VARIABLE_PART);

		$criteria->addSelectColumn(SchedulerConfigPeer::VALUE);

	}

	const COUNT = 'COUNT(scheduler_config.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT scheduler_config.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulerConfigPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulerConfigPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchedulerConfigPeer::doSelectRS($criteria, $con);
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
		$objects = SchedulerConfigPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SchedulerConfigPeer::populateObjects(SchedulerConfigPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchedulerConfigPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SchedulerConfigPeer::getOMClass();
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
		return SchedulerConfigPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SchedulerConfigPeer::ID); 

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
			$comparison = $criteria->getComparison(SchedulerConfigPeer::ID);
			$selectCriteria->add(SchedulerConfigPeer::ID, $criteria->remove(SchedulerConfigPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SchedulerConfigPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SchedulerConfigPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SchedulerConfig) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchedulerConfigPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SchedulerConfig $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchedulerConfigPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchedulerConfigPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchedulerConfigPeer::DATABASE_NAME, SchedulerConfigPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchedulerConfigPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SchedulerConfigPeer::DATABASE_NAME);

		$criteria->add(SchedulerConfigPeer::ID, $pk);


		$v = SchedulerConfigPeer::doSelect($criteria, $con);

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
			$criteria->add(SchedulerConfigPeer::ID, $pks, Criteria::IN);
			$objs = SchedulerConfigPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSchedulerConfigPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SchedulerConfigMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchedulerConfigMapBuilder');
}
