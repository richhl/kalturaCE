<?php


abstract class BaseSystemUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'system_user';

	
	const CLASS_DEFAULT = 'lib.model.SystemUser';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'system_user.ID';

	
	const EMAIL = 'system_user.EMAIL';

	
	const FIRST_NAME = 'system_user.FIRST_NAME';

	
	const LAST_NAME = 'system_user.LAST_NAME';

	
	const SHA1_PASSWORD = 'system_user.SHA1_PASSWORD';

	
	const SALT = 'system_user.SALT';

	
	const CREATED_BY = 'system_user.CREATED_BY';

	
	const STATUS = 'system_user.STATUS';

	
	const IS_PRIMARY = 'system_user.IS_PRIMARY';

	
	const STATUS_UPDATED_AT = 'system_user.STATUS_UPDATED_AT';

	
	const CREATED_AT = 'system_user.CREATED_AT';

	
	const UPDATED_AT = 'system_user.UPDATED_AT';

	
	const DELETED_AT = 'system_user.DELETED_AT';

	
	const ROLE = 'system_user.ROLE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Email', 'FirstName', 'LastName', 'Sha1Password', 'Salt', 'CreatedBy', 'Status', 'IsPrimary', 'StatusUpdatedAt', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'Role', ),
		BasePeer::TYPE_COLNAME => array (SystemUserPeer::ID, SystemUserPeer::EMAIL, SystemUserPeer::FIRST_NAME, SystemUserPeer::LAST_NAME, SystemUserPeer::SHA1_PASSWORD, SystemUserPeer::SALT, SystemUserPeer::CREATED_BY, SystemUserPeer::STATUS, SystemUserPeer::IS_PRIMARY, SystemUserPeer::STATUS_UPDATED_AT, SystemUserPeer::CREATED_AT, SystemUserPeer::UPDATED_AT, SystemUserPeer::DELETED_AT, SystemUserPeer::ROLE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'email', 'first_name', 'last_name', 'sha1_password', 'salt', 'created_by', 'status', 'is_primary', 'status_updated_at', 'created_at', 'updated_at', 'deleted_at', 'role', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Email' => 1, 'FirstName' => 2, 'LastName' => 3, 'Sha1Password' => 4, 'Salt' => 5, 'CreatedBy' => 6, 'Status' => 7, 'IsPrimary' => 8, 'StatusUpdatedAt' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'DeletedAt' => 12, 'Role' => 13, ),
		BasePeer::TYPE_COLNAME => array (SystemUserPeer::ID => 0, SystemUserPeer::EMAIL => 1, SystemUserPeer::FIRST_NAME => 2, SystemUserPeer::LAST_NAME => 3, SystemUserPeer::SHA1_PASSWORD => 4, SystemUserPeer::SALT => 5, SystemUserPeer::CREATED_BY => 6, SystemUserPeer::STATUS => 7, SystemUserPeer::IS_PRIMARY => 8, SystemUserPeer::STATUS_UPDATED_AT => 9, SystemUserPeer::CREATED_AT => 10, SystemUserPeer::UPDATED_AT => 11, SystemUserPeer::DELETED_AT => 12, SystemUserPeer::ROLE => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'email' => 1, 'first_name' => 2, 'last_name' => 3, 'sha1_password' => 4, 'salt' => 5, 'created_by' => 6, 'status' => 7, 'is_primary' => 8, 'status_updated_at' => 9, 'created_at' => 10, 'updated_at' => 11, 'deleted_at' => 12, 'role' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SystemUserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SystemUserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SystemUserPeer::getTableMap();
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
		return str_replace(SystemUserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SystemUserPeer::ID);

		$criteria->addSelectColumn(SystemUserPeer::EMAIL);

		$criteria->addSelectColumn(SystemUserPeer::FIRST_NAME);

		$criteria->addSelectColumn(SystemUserPeer::LAST_NAME);

		$criteria->addSelectColumn(SystemUserPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(SystemUserPeer::SALT);

		$criteria->addSelectColumn(SystemUserPeer::CREATED_BY);

		$criteria->addSelectColumn(SystemUserPeer::STATUS);

		$criteria->addSelectColumn(SystemUserPeer::IS_PRIMARY);

		$criteria->addSelectColumn(SystemUserPeer::STATUS_UPDATED_AT);

		$criteria->addSelectColumn(SystemUserPeer::CREATED_AT);

		$criteria->addSelectColumn(SystemUserPeer::UPDATED_AT);

		$criteria->addSelectColumn(SystemUserPeer::DELETED_AT);

		$criteria->addSelectColumn(SystemUserPeer::ROLE);

	}

	const COUNT = 'COUNT(system_user.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT system_user.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemUserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SystemUserPeer::doSelectRS($criteria, $con);
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
		$objects = SystemUserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SystemUserPeer::populateObjects(SystemUserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SystemUserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SystemUserPeer::getOMClass();
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
		return SystemUserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SystemUserPeer::ID); 

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
			$comparison = $criteria->getComparison(SystemUserPeer::ID);
			$selectCriteria->add(SystemUserPeer::ID, $criteria->remove(SystemUserPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SystemUserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SystemUserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SystemUser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SystemUserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SystemUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SystemUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SystemUserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SystemUserPeer::DATABASE_NAME, SystemUserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SystemUserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SystemUserPeer::DATABASE_NAME);

		$criteria->add(SystemUserPeer::ID, $pk);


		$v = SystemUserPeer::doSelect($criteria, $con);

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
			$criteria->add(SystemUserPeer::ID, $pks, Criteria::IN);
			$objs = SystemUserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSystemUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SystemUserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SystemUserMapBuilder');
}
