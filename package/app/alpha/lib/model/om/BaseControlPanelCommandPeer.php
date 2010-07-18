<?php


abstract class BaseControlPanelCommandPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'control_panel_command';

	
	const CLASS_DEFAULT = 'lib.model.ControlPanelCommand';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'control_panel_command.ID';

	
	const CREATED_AT = 'control_panel_command.CREATED_AT';

	
	const CREATED_BY = 'control_panel_command.CREATED_BY';

	
	const UPDATED_AT = 'control_panel_command.UPDATED_AT';

	
	const UPDATED_BY = 'control_panel_command.UPDATED_BY';

	
	const CREATED_BY_ID = 'control_panel_command.CREATED_BY_ID';

	
	const SCHEDULER_ID = 'control_panel_command.SCHEDULER_ID';

	
	const SCHEDULER_CONFIGURED_ID = 'control_panel_command.SCHEDULER_CONFIGURED_ID';

	
	const WORKER_ID = 'control_panel_command.WORKER_ID';

	
	const WORKER_CONFIGURED_ID = 'control_panel_command.WORKER_CONFIGURED_ID';

	
	const WORKER_NAME = 'control_panel_command.WORKER_NAME';

	
	const BATCH_INDEX = 'control_panel_command.BATCH_INDEX';

	
	const TYPE = 'control_panel_command.TYPE';

	
	const TARGET_TYPE = 'control_panel_command.TARGET_TYPE';

	
	const STATUS = 'control_panel_command.STATUS';

	
	const CAUSE = 'control_panel_command.CAUSE';

	
	const DESCRIPTION = 'control_panel_command.DESCRIPTION';

	
	const ERROR_DESCRIPTION = 'control_panel_command.ERROR_DESCRIPTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'CreatedBy', 'UpdatedAt', 'UpdatedBy', 'CreatedById', 'SchedulerId', 'SchedulerConfiguredId', 'WorkerId', 'WorkerConfiguredId', 'WorkerName', 'BatchIndex', 'Type', 'TargetType', 'Status', 'Cause', 'Description', 'ErrorDescription', ),
		BasePeer::TYPE_COLNAME => array (ControlPanelCommandPeer::ID, ControlPanelCommandPeer::CREATED_AT, ControlPanelCommandPeer::CREATED_BY, ControlPanelCommandPeer::UPDATED_AT, ControlPanelCommandPeer::UPDATED_BY, ControlPanelCommandPeer::CREATED_BY_ID, ControlPanelCommandPeer::SCHEDULER_ID, ControlPanelCommandPeer::SCHEDULER_CONFIGURED_ID, ControlPanelCommandPeer::WORKER_ID, ControlPanelCommandPeer::WORKER_CONFIGURED_ID, ControlPanelCommandPeer::WORKER_NAME, ControlPanelCommandPeer::BATCH_INDEX, ControlPanelCommandPeer::TYPE, ControlPanelCommandPeer::TARGET_TYPE, ControlPanelCommandPeer::STATUS, ControlPanelCommandPeer::CAUSE, ControlPanelCommandPeer::DESCRIPTION, ControlPanelCommandPeer::ERROR_DESCRIPTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'created_by_id', 'scheduler_id', 'scheduler_configured_id', 'worker_id', 'worker_configured_id', 'worker_name', 'batch_index', 'type', 'target_type', 'status', 'cause', 'description', 'error_description', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'CreatedBy' => 2, 'UpdatedAt' => 3, 'UpdatedBy' => 4, 'CreatedById' => 5, 'SchedulerId' => 6, 'SchedulerConfiguredId' => 7, 'WorkerId' => 8, 'WorkerConfiguredId' => 9, 'WorkerName' => 10, 'BatchIndex' => 11, 'Type' => 12, 'TargetType' => 13, 'Status' => 14, 'Cause' => 15, 'Description' => 16, 'ErrorDescription' => 17, ),
		BasePeer::TYPE_COLNAME => array (ControlPanelCommandPeer::ID => 0, ControlPanelCommandPeer::CREATED_AT => 1, ControlPanelCommandPeer::CREATED_BY => 2, ControlPanelCommandPeer::UPDATED_AT => 3, ControlPanelCommandPeer::UPDATED_BY => 4, ControlPanelCommandPeer::CREATED_BY_ID => 5, ControlPanelCommandPeer::SCHEDULER_ID => 6, ControlPanelCommandPeer::SCHEDULER_CONFIGURED_ID => 7, ControlPanelCommandPeer::WORKER_ID => 8, ControlPanelCommandPeer::WORKER_CONFIGURED_ID => 9, ControlPanelCommandPeer::WORKER_NAME => 10, ControlPanelCommandPeer::BATCH_INDEX => 11, ControlPanelCommandPeer::TYPE => 12, ControlPanelCommandPeer::TARGET_TYPE => 13, ControlPanelCommandPeer::STATUS => 14, ControlPanelCommandPeer::CAUSE => 15, ControlPanelCommandPeer::DESCRIPTION => 16, ControlPanelCommandPeer::ERROR_DESCRIPTION => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'created_by' => 2, 'updated_at' => 3, 'updated_by' => 4, 'created_by_id' => 5, 'scheduler_id' => 6, 'scheduler_configured_id' => 7, 'worker_id' => 8, 'worker_configured_id' => 9, 'worker_name' => 10, 'batch_index' => 11, 'type' => 12, 'target_type' => 13, 'status' => 14, 'cause' => 15, 'description' => 16, 'error_description' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ControlPanelCommandMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ControlPanelCommandMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ControlPanelCommandPeer::getTableMap();
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
		return str_replace(ControlPanelCommandPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ControlPanelCommandPeer::ID);

		$criteria->addSelectColumn(ControlPanelCommandPeer::CREATED_AT);

		$criteria->addSelectColumn(ControlPanelCommandPeer::CREATED_BY);

		$criteria->addSelectColumn(ControlPanelCommandPeer::UPDATED_AT);

		$criteria->addSelectColumn(ControlPanelCommandPeer::UPDATED_BY);

		$criteria->addSelectColumn(ControlPanelCommandPeer::CREATED_BY_ID);

		$criteria->addSelectColumn(ControlPanelCommandPeer::SCHEDULER_ID);

		$criteria->addSelectColumn(ControlPanelCommandPeer::SCHEDULER_CONFIGURED_ID);

		$criteria->addSelectColumn(ControlPanelCommandPeer::WORKER_ID);

		$criteria->addSelectColumn(ControlPanelCommandPeer::WORKER_CONFIGURED_ID);

		$criteria->addSelectColumn(ControlPanelCommandPeer::WORKER_NAME);

		$criteria->addSelectColumn(ControlPanelCommandPeer::BATCH_INDEX);

		$criteria->addSelectColumn(ControlPanelCommandPeer::TYPE);

		$criteria->addSelectColumn(ControlPanelCommandPeer::TARGET_TYPE);

		$criteria->addSelectColumn(ControlPanelCommandPeer::STATUS);

		$criteria->addSelectColumn(ControlPanelCommandPeer::CAUSE);

		$criteria->addSelectColumn(ControlPanelCommandPeer::DESCRIPTION);

		$criteria->addSelectColumn(ControlPanelCommandPeer::ERROR_DESCRIPTION);

	}

	const COUNT = 'COUNT(control_panel_command.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT control_panel_command.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ControlPanelCommandPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ControlPanelCommandPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ControlPanelCommandPeer::doSelectRS($criteria, $con);
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
		$objects = ControlPanelCommandPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ControlPanelCommandPeer::populateObjects(ControlPanelCommandPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ControlPanelCommandPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ControlPanelCommandPeer::getOMClass();
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
		return ControlPanelCommandPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ControlPanelCommandPeer::ID); 

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
			$comparison = $criteria->getComparison(ControlPanelCommandPeer::ID);
			$selectCriteria->add(ControlPanelCommandPeer::ID, $criteria->remove(ControlPanelCommandPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ControlPanelCommandPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ControlPanelCommandPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ControlPanelCommand) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ControlPanelCommandPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ControlPanelCommand $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ControlPanelCommandPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ControlPanelCommandPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ControlPanelCommandPeer::DATABASE_NAME, ControlPanelCommandPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ControlPanelCommandPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ControlPanelCommandPeer::DATABASE_NAME);

		$criteria->add(ControlPanelCommandPeer::ID, $pk);


		$v = ControlPanelCommandPeer::doSelect($criteria, $con);

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
			$criteria->add(ControlPanelCommandPeer::ID, $pks, Criteria::IN);
			$objs = ControlPanelCommandPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseControlPanelCommandPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ControlPanelCommandMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ControlPanelCommandMapBuilder');
}
