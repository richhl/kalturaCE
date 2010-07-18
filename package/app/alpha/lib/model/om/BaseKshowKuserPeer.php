<?php


abstract class BaseKshowKuserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'kshow_kuser';

	
	const CLASS_DEFAULT = 'lib.model.KshowKuser';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const KSHOW_ID = 'kshow_kuser.KSHOW_ID';

	
	const KUSER_ID = 'kshow_kuser.KUSER_ID';

	
	const SUBSCRIPTION_TYPE = 'kshow_kuser.SUBSCRIPTION_TYPE';

	
	const ALERT_TYPE = 'kshow_kuser.ALERT_TYPE';

	
	const ID = 'kshow_kuser.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('KshowId', 'KuserId', 'SubscriptionType', 'AlertType', 'Id', ),
		BasePeer::TYPE_COLNAME => array (KshowKuserPeer::KSHOW_ID, KshowKuserPeer::KUSER_ID, KshowKuserPeer::SUBSCRIPTION_TYPE, KshowKuserPeer::ALERT_TYPE, KshowKuserPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('kshow_id', 'kuser_id', 'subscription_type', 'alert_type', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('KshowId' => 0, 'KuserId' => 1, 'SubscriptionType' => 2, 'AlertType' => 3, 'Id' => 4, ),
		BasePeer::TYPE_COLNAME => array (KshowKuserPeer::KSHOW_ID => 0, KshowKuserPeer::KUSER_ID => 1, KshowKuserPeer::SUBSCRIPTION_TYPE => 2, KshowKuserPeer::ALERT_TYPE => 3, KshowKuserPeer::ID => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('kshow_id' => 0, 'kuser_id' => 1, 'subscription_type' => 2, 'alert_type' => 3, 'id' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/KshowKuserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.KshowKuserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = KshowKuserPeer::getTableMap();
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
		return str_replace(KshowKuserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(KshowKuserPeer::KSHOW_ID);

		$criteria->addSelectColumn(KshowKuserPeer::KUSER_ID);

		$criteria->addSelectColumn(KshowKuserPeer::SUBSCRIPTION_TYPE);

		$criteria->addSelectColumn(KshowKuserPeer::ALERT_TYPE);

		$criteria->addSelectColumn(KshowKuserPeer::ID);

	}

	const COUNT = 'COUNT(kshow_kuser.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT kshow_kuser.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = KshowKuserPeer::doSelectRS($criteria, $con);
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
		$objects = KshowKuserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return KshowKuserPeer::populateObjects(KshowKuserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			KshowKuserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = KshowKuserPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinkshow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KshowKuserPeer::KSHOW_ID, kshowPeer::ID);

		$rs = KshowKuserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KshowKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = KshowKuserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinkshow(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KshowKuserPeer::addSelectColumns($c);
		$startcol = (KshowKuserPeer::NUM_COLUMNS - KshowKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kshowPeer::addSelectColumns($c);

		$c->addJoin(KshowKuserPeer::KSHOW_ID, kshowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KshowKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kshowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addKshowKuser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initKshowKusers();
				$obj2->addKshowKuser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KshowKuserPeer::addSelectColumns($c);
		$startcol = (KshowKuserPeer::NUM_COLUMNS - KshowKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(KshowKuserPeer::KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KshowKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addKshowKuser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initKshowKusers();
				$obj2->addKshowKuser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KshowKuserPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(KshowKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = KshowKuserPeer::doSelectRS($criteria, $con);
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

		KshowKuserPeer::addSelectColumns($c);
		$startcol2 = (KshowKuserPeer::NUM_COLUMNS - KshowKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		kuserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(KshowKuserPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(KshowKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KshowKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKshowKuser($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initKshowKusers();
				$obj2->addKshowKuser($obj1);
			}


					
			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getkuser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addKshowKuser($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initKshowKusers();
				$obj3->addKshowKuser($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptkshow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KshowKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = KshowKuserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KshowKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KshowKuserPeer::KSHOW_ID, kshowPeer::ID);

		$rs = KshowKuserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptkshow(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KshowKuserPeer::addSelectColumns($c);
		$startcol2 = (KshowKuserPeer::NUM_COLUMNS - KshowKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(KshowKuserPeer::KUSER_ID, kuserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KshowKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKshowKuser($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initKshowKusers();
				$obj2->addKshowKuser($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KshowKuserPeer::addSelectColumns($c);
		$startcol2 = (KshowKuserPeer::NUM_COLUMNS - KshowKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		$c->addJoin(KshowKuserPeer::KSHOW_ID, kshowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KshowKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKshowKuser($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initKshowKusers();
				$obj2->addKshowKuser($obj1);
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
		return KshowKuserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(KshowKuserPeer::ID); 

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
			$comparison = $criteria->getComparison(KshowKuserPeer::ID);
			$selectCriteria->add(KshowKuserPeer::ID, $criteria->remove(KshowKuserPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(KshowKuserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(KshowKuserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof KshowKuser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(KshowKuserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(KshowKuser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(KshowKuserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(KshowKuserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(KshowKuserPeer::DATABASE_NAME, KshowKuserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = KshowKuserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(KshowKuserPeer::DATABASE_NAME);

		$criteria->add(KshowKuserPeer::ID, $pk);


		$v = KshowKuserPeer::doSelect($criteria, $con);

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
			$criteria->add(KshowKuserPeer::ID, $pks, Criteria::IN);
			$objs = KshowKuserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseKshowKuserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/KshowKuserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.KshowKuserMapBuilder');
}
