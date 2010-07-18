<?php


abstract class BaseAuditTrailPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'audit_trail';

	
	const CLASS_DEFAULT = 'lib.model.AuditTrail';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'audit_trail.ID';

	
	const OBJECT_NAME = 'audit_trail.OBJECT_NAME';

	
	const OBJECT_TYPE_ID = 'audit_trail.OBJECT_TYPE_ID';

	
	const OBJECT_ID = 'audit_trail.OBJECT_ID';

	
	const PARTNER_ID = 'audit_trail.PARTNER_ID';

	
	const UID = 'audit_trail.UID';

	
	const KS_PARTNER_ID = 'audit_trail.KS_PARTNER_ID';

	
	const KS_UID = 'audit_trail.KS_UID';

	
	const BEFORE = 'audit_trail.BEFORE';

	
	const AFTER = 'audit_trail.AFTER';

	
	const CONTEXT = 'audit_trail.CONTEXT';

	
	const HOST_NAME = 'audit_trail.HOST_NAME';

	
	const ACTION_ID = 'audit_trail.ACTION_ID';

	
	const CREATED_AT = 'audit_trail.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ObjectName', 'ObjectTypeId', 'ObjectId', 'PartnerId', 'Uid', 'KsPartnerId', 'KsUid', 'Before', 'After', 'Context', 'HostName', 'ActionId', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (AuditTrailPeer::ID, AuditTrailPeer::OBJECT_NAME, AuditTrailPeer::OBJECT_TYPE_ID, AuditTrailPeer::OBJECT_ID, AuditTrailPeer::PARTNER_ID, AuditTrailPeer::UID, AuditTrailPeer::KS_PARTNER_ID, AuditTrailPeer::KS_UID, AuditTrailPeer::BEFORE, AuditTrailPeer::AFTER, AuditTrailPeer::CONTEXT, AuditTrailPeer::HOST_NAME, AuditTrailPeer::ACTION_ID, AuditTrailPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'object_name', 'object_type_id', 'object_id', 'partner_id', 'uid', 'ks_partner_id', 'ks_uid', 'before', 'after', 'context', 'host_name', 'action_id', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ObjectName' => 1, 'ObjectTypeId' => 2, 'ObjectId' => 3, 'PartnerId' => 4, 'Uid' => 5, 'KsPartnerId' => 6, 'KsUid' => 7, 'Before' => 8, 'After' => 9, 'Context' => 10, 'HostName' => 11, 'ActionId' => 12, 'CreatedAt' => 13, ),
		BasePeer::TYPE_COLNAME => array (AuditTrailPeer::ID => 0, AuditTrailPeer::OBJECT_NAME => 1, AuditTrailPeer::OBJECT_TYPE_ID => 2, AuditTrailPeer::OBJECT_ID => 3, AuditTrailPeer::PARTNER_ID => 4, AuditTrailPeer::UID => 5, AuditTrailPeer::KS_PARTNER_ID => 6, AuditTrailPeer::KS_UID => 7, AuditTrailPeer::BEFORE => 8, AuditTrailPeer::AFTER => 9, AuditTrailPeer::CONTEXT => 10, AuditTrailPeer::HOST_NAME => 11, AuditTrailPeer::ACTION_ID => 12, AuditTrailPeer::CREATED_AT => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'object_name' => 1, 'object_type_id' => 2, 'object_id' => 3, 'partner_id' => 4, 'uid' => 5, 'ks_partner_id' => 6, 'ks_uid' => 7, 'before' => 8, 'after' => 9, 'context' => 10, 'host_name' => 11, 'action_id' => 12, 'created_at' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AuditTrailMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AuditTrailMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AuditTrailPeer::getTableMap();
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
		return str_replace(AuditTrailPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AuditTrailPeer::ID);

		$criteria->addSelectColumn(AuditTrailPeer::OBJECT_NAME);

		$criteria->addSelectColumn(AuditTrailPeer::OBJECT_TYPE_ID);

		$criteria->addSelectColumn(AuditTrailPeer::OBJECT_ID);

		$criteria->addSelectColumn(AuditTrailPeer::PARTNER_ID);

		$criteria->addSelectColumn(AuditTrailPeer::UID);

		$criteria->addSelectColumn(AuditTrailPeer::KS_PARTNER_ID);

		$criteria->addSelectColumn(AuditTrailPeer::KS_UID);

		$criteria->addSelectColumn(AuditTrailPeer::BEFORE);

		$criteria->addSelectColumn(AuditTrailPeer::AFTER);

		$criteria->addSelectColumn(AuditTrailPeer::CONTEXT);

		$criteria->addSelectColumn(AuditTrailPeer::HOST_NAME);

		$criteria->addSelectColumn(AuditTrailPeer::ACTION_ID);

		$criteria->addSelectColumn(AuditTrailPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(audit_trail.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT audit_trail.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AuditTrailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AuditTrailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AuditTrailPeer::doSelectRS($criteria, $con);
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
		$objects = AuditTrailPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AuditTrailPeer::populateObjects(AuditTrailPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AuditTrailPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AuditTrailPeer::getOMClass();
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
		return AuditTrailPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(AuditTrailPeer::ID); 

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
			$comparison = $criteria->getComparison(AuditTrailPeer::ID);
			$selectCriteria->add(AuditTrailPeer::ID, $criteria->remove(AuditTrailPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(AuditTrailPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AuditTrailPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof AuditTrail) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AuditTrailPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(AuditTrail $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AuditTrailPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AuditTrailPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AuditTrailPeer::DATABASE_NAME, AuditTrailPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AuditTrailPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AuditTrailPeer::DATABASE_NAME);

		$criteria->add(AuditTrailPeer::ID, $pk);


		$v = AuditTrailPeer::doSelect($criteria, $con);

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
			$criteria->add(AuditTrailPeer::ID, $pks, Criteria::IN);
			$objs = AuditTrailPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAuditTrailPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AuditTrailMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AuditTrailMapBuilder');
}
