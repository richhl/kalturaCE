<?php


abstract class BaseadminKuserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'admin_kuser';

	
	const CLASS_DEFAULT = 'lib.model.adminKuser';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'admin_kuser.ID';

	
	const SCREEN_NAME = 'admin_kuser.SCREEN_NAME';

	
	const FULL_NAME = 'admin_kuser.FULL_NAME';

	
	const EMAIL = 'admin_kuser.EMAIL';

	
	const SHA1_PASSWORD = 'admin_kuser.SHA1_PASSWORD';

	
	const SALT = 'admin_kuser.SALT';

	
	const PICTURE = 'admin_kuser.PICTURE';

	
	const ICON = 'admin_kuser.ICON';

	
	const CREATED_AT = 'admin_kuser.CREATED_AT';

	
	const UPDATED_AT = 'admin_kuser.UPDATED_AT';

	
	const PARTNER_ID = 'admin_kuser.PARTNER_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ScreenName', 'FullName', 'Email', 'Sha1Password', 'Salt', 'Picture', 'Icon', 'CreatedAt', 'UpdatedAt', 'PartnerId', ),
		BasePeer::TYPE_COLNAME => array (adminKuserPeer::ID, adminKuserPeer::SCREEN_NAME, adminKuserPeer::FULL_NAME, adminKuserPeer::EMAIL, adminKuserPeer::SHA1_PASSWORD, adminKuserPeer::SALT, adminKuserPeer::PICTURE, adminKuserPeer::ICON, adminKuserPeer::CREATED_AT, adminKuserPeer::UPDATED_AT, adminKuserPeer::PARTNER_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'screen_name', 'full_name', 'email', 'sha1_password', 'salt', 'picture', 'icon', 'created_at', 'updated_at', 'partner_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ScreenName' => 1, 'FullName' => 2, 'Email' => 3, 'Sha1Password' => 4, 'Salt' => 5, 'Picture' => 6, 'Icon' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'PartnerId' => 10, ),
		BasePeer::TYPE_COLNAME => array (adminKuserPeer::ID => 0, adminKuserPeer::SCREEN_NAME => 1, adminKuserPeer::FULL_NAME => 2, adminKuserPeer::EMAIL => 3, adminKuserPeer::SHA1_PASSWORD => 4, adminKuserPeer::SALT => 5, adminKuserPeer::PICTURE => 6, adminKuserPeer::ICON => 7, adminKuserPeer::CREATED_AT => 8, adminKuserPeer::UPDATED_AT => 9, adminKuserPeer::PARTNER_ID => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'screen_name' => 1, 'full_name' => 2, 'email' => 3, 'sha1_password' => 4, 'salt' => 5, 'picture' => 6, 'icon' => 7, 'created_at' => 8, 'updated_at' => 9, 'partner_id' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/adminKuserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.adminKuserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = adminKuserPeer::getTableMap();
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
		return str_replace(adminKuserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(adminKuserPeer::ID);

		$criteria->addSelectColumn(adminKuserPeer::SCREEN_NAME);

		$criteria->addSelectColumn(adminKuserPeer::FULL_NAME);

		$criteria->addSelectColumn(adminKuserPeer::EMAIL);

		$criteria->addSelectColumn(adminKuserPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(adminKuserPeer::SALT);

		$criteria->addSelectColumn(adminKuserPeer::PICTURE);

		$criteria->addSelectColumn(adminKuserPeer::ICON);

		$criteria->addSelectColumn(adminKuserPeer::CREATED_AT);

		$criteria->addSelectColumn(adminKuserPeer::UPDATED_AT);

		$criteria->addSelectColumn(adminKuserPeer::PARTNER_ID);

	}

	const COUNT = 'COUNT(admin_kuser.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT admin_kuser.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(adminKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(adminKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = adminKuserPeer::doSelectRS($criteria, $con);
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
		$objects = adminKuserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return adminKuserPeer::populateObjects(adminKuserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			adminKuserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = adminKuserPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPartner(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(adminKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(adminKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(adminKuserPeer::PARTNER_ID, PartnerPeer::ID);

		$rs = adminKuserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPartner(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		adminKuserPeer::addSelectColumns($c);
		$startcol = (adminKuserPeer::NUM_COLUMNS - adminKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PartnerPeer::addSelectColumns($c);

		$c->addJoin(adminKuserPeer::PARTNER_ID, PartnerPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = adminKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PartnerPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPartner(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addadminKuser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initadminKusers();
				$obj2->addadminKuser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(adminKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(adminKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(adminKuserPeer::PARTNER_ID, PartnerPeer::ID);

		$rs = adminKuserPeer::doSelectRS($criteria, $con);
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

		adminKuserPeer::addSelectColumns($c);
		$startcol2 = (adminKuserPeer::NUM_COLUMNS - adminKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PartnerPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PartnerPeer::NUM_COLUMNS;

		$c->addJoin(adminKuserPeer::PARTNER_ID, PartnerPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = adminKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PartnerPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPartner(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addadminKuser($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initadminKusers();
				$obj2->addadminKuser($obj1);
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
		return adminKuserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(adminKuserPeer::ID); 

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
			$comparison = $criteria->getComparison(adminKuserPeer::ID);
			$selectCriteria->add(adminKuserPeer::ID, $criteria->remove(adminKuserPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(adminKuserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(adminKuserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof adminKuser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(adminKuserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(adminKuser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(adminKuserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(adminKuserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(adminKuserPeer::DATABASE_NAME, adminKuserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = adminKuserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(adminKuserPeer::DATABASE_NAME);

		$criteria->add(adminKuserPeer::ID, $pk);


		$v = adminKuserPeer::doSelect($criteria, $con);

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
			$criteria->add(adminKuserPeer::ID, $pks, Criteria::IN);
			$objs = adminKuserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseadminKuserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/adminKuserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.adminKuserMapBuilder');
}
