<?php


abstract class BasenotificationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'notification';

	
	const CLASS_DEFAULT = 'lib.model.notification';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'notification.ID';

	
	const PARTNER_ID = 'notification.PARTNER_ID';

	
	const PUSER_ID = 'notification.PUSER_ID';

	
	const TYPE = 'notification.TYPE';

	
	const OBJECT_ID = 'notification.OBJECT_ID';

	
	const STATUS = 'notification.STATUS';

	
	const NOTIFICATION_DATA = 'notification.NOTIFICATION_DATA';

	
	const NUMBER_OF_ATTEMPTS = 'notification.NUMBER_OF_ATTEMPTS';

	
	const CREATED_AT = 'notification.CREATED_AT';

	
	const UPDATED_AT = 'notification.UPDATED_AT';

	
	const NOTIFICATION_RESULT = 'notification.NOTIFICATION_RESULT';

	
	const OBJECT_TYPE = 'notification.OBJECT_TYPE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'PuserId', 'Type', 'ObjectId', 'Status', 'NotificationData', 'NumberOfAttempts', 'CreatedAt', 'UpdatedAt', 'NotificationResult', 'ObjectType', ),
		BasePeer::TYPE_COLNAME => array (notificationPeer::ID, notificationPeer::PARTNER_ID, notificationPeer::PUSER_ID, notificationPeer::TYPE, notificationPeer::OBJECT_ID, notificationPeer::STATUS, notificationPeer::NOTIFICATION_DATA, notificationPeer::NUMBER_OF_ATTEMPTS, notificationPeer::CREATED_AT, notificationPeer::UPDATED_AT, notificationPeer::NOTIFICATION_RESULT, notificationPeer::OBJECT_TYPE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'puser_id', 'type', 'object_id', 'status', 'notification_data', 'number_of_attempts', 'created_at', 'updated_at', 'notification_result', 'object_type', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'PuserId' => 2, 'Type' => 3, 'ObjectId' => 4, 'Status' => 5, 'NotificationData' => 6, 'NumberOfAttempts' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'NotificationResult' => 10, 'ObjectType' => 11, ),
		BasePeer::TYPE_COLNAME => array (notificationPeer::ID => 0, notificationPeer::PARTNER_ID => 1, notificationPeer::PUSER_ID => 2, notificationPeer::TYPE => 3, notificationPeer::OBJECT_ID => 4, notificationPeer::STATUS => 5, notificationPeer::NOTIFICATION_DATA => 6, notificationPeer::NUMBER_OF_ATTEMPTS => 7, notificationPeer::CREATED_AT => 8, notificationPeer::UPDATED_AT => 9, notificationPeer::NOTIFICATION_RESULT => 10, notificationPeer::OBJECT_TYPE => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'puser_id' => 2, 'type' => 3, 'object_id' => 4, 'status' => 5, 'notification_data' => 6, 'number_of_attempts' => 7, 'created_at' => 8, 'updated_at' => 9, 'notification_result' => 10, 'object_type' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/notificationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.notificationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = notificationPeer::getTableMap();
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
		return str_replace(notificationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(notificationPeer::ID);

		$criteria->addSelectColumn(notificationPeer::PARTNER_ID);

		$criteria->addSelectColumn(notificationPeer::PUSER_ID);

		$criteria->addSelectColumn(notificationPeer::TYPE);

		$criteria->addSelectColumn(notificationPeer::OBJECT_ID);

		$criteria->addSelectColumn(notificationPeer::STATUS);

		$criteria->addSelectColumn(notificationPeer::NOTIFICATION_DATA);

		$criteria->addSelectColumn(notificationPeer::NUMBER_OF_ATTEMPTS);

		$criteria->addSelectColumn(notificationPeer::CREATED_AT);

		$criteria->addSelectColumn(notificationPeer::UPDATED_AT);

		$criteria->addSelectColumn(notificationPeer::NOTIFICATION_RESULT);

		$criteria->addSelectColumn(notificationPeer::OBJECT_TYPE);

	}

	const COUNT = 'COUNT(notification.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT notification.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(notificationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(notificationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = notificationPeer::doSelectRS($criteria, $con);
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
		$objects = notificationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return notificationPeer::populateObjects(notificationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			notificationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = notificationPeer::getOMClass();
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
		return notificationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(notificationPeer::ID); 

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
			$comparison = $criteria->getComparison(notificationPeer::ID);
			$selectCriteria->add(notificationPeer::ID, $criteria->remove(notificationPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(notificationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(notificationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof notification) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(notificationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(notification $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(notificationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(notificationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(notificationPeer::DATABASE_NAME, notificationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = notificationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(notificationPeer::DATABASE_NAME);

		$criteria->add(notificationPeer::ID, $pk);


		$v = notificationPeer::doSelect($criteria, $con);

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
			$criteria->add(notificationPeer::ID, $pks, Criteria::IN);
			$objs = notificationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasenotificationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/notificationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.notificationMapBuilder');
}
