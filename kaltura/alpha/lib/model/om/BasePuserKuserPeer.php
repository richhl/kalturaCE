<?php


abstract class BasePuserKuserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'puser_kuser';

	
	const CLASS_DEFAULT = 'lib.model.PuserKuser';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'puser_kuser.ID';

	
	const PARTNER_ID = 'puser_kuser.PARTNER_ID';

	
	const PUSER_ID = 'puser_kuser.PUSER_ID';

	
	const KUSER_ID = 'puser_kuser.KUSER_ID';

	
	const PUSER_NAME = 'puser_kuser.PUSER_NAME';

	
	const CUSTOM_DATA = 'puser_kuser.CUSTOM_DATA';

	
	const CREATED_AT = 'puser_kuser.CREATED_AT';

	
	const UPDATED_AT = 'puser_kuser.UPDATED_AT';

	
	const CONTEXT = 'puser_kuser.CONTEXT';

	
	const SUBP_ID = 'puser_kuser.SUBP_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'PuserId', 'KuserId', 'PuserName', 'CustomData', 'CreatedAt', 'UpdatedAt', 'Context', 'SubpId', ),
		BasePeer::TYPE_COLNAME => array (PuserKuserPeer::ID, PuserKuserPeer::PARTNER_ID, PuserKuserPeer::PUSER_ID, PuserKuserPeer::KUSER_ID, PuserKuserPeer::PUSER_NAME, PuserKuserPeer::CUSTOM_DATA, PuserKuserPeer::CREATED_AT, PuserKuserPeer::UPDATED_AT, PuserKuserPeer::CONTEXT, PuserKuserPeer::SUBP_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'puser_id', 'kuser_id', 'puser_name', 'custom_data', 'created_at', 'updated_at', 'context', 'subp_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'PuserId' => 2, 'KuserId' => 3, 'PuserName' => 4, 'CustomData' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'Context' => 8, 'SubpId' => 9, ),
		BasePeer::TYPE_COLNAME => array (PuserKuserPeer::ID => 0, PuserKuserPeer::PARTNER_ID => 1, PuserKuserPeer::PUSER_ID => 2, PuserKuserPeer::KUSER_ID => 3, PuserKuserPeer::PUSER_NAME => 4, PuserKuserPeer::CUSTOM_DATA => 5, PuserKuserPeer::CREATED_AT => 6, PuserKuserPeer::UPDATED_AT => 7, PuserKuserPeer::CONTEXT => 8, PuserKuserPeer::SUBP_ID => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'puser_id' => 2, 'kuser_id' => 3, 'puser_name' => 4, 'custom_data' => 5, 'created_at' => 6, 'updated_at' => 7, 'context' => 8, 'subp_id' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PuserKuserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PuserKuserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PuserKuserPeer::getTableMap();
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
		return str_replace(PuserKuserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PuserKuserPeer::ID);

		$criteria->addSelectColumn(PuserKuserPeer::PARTNER_ID);

		$criteria->addSelectColumn(PuserKuserPeer::PUSER_ID);

		$criteria->addSelectColumn(PuserKuserPeer::KUSER_ID);

		$criteria->addSelectColumn(PuserKuserPeer::PUSER_NAME);

		$criteria->addSelectColumn(PuserKuserPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(PuserKuserPeer::CREATED_AT);

		$criteria->addSelectColumn(PuserKuserPeer::UPDATED_AT);

		$criteria->addSelectColumn(PuserKuserPeer::CONTEXT);

		$criteria->addSelectColumn(PuserKuserPeer::SUBP_ID);

	}

	const COUNT = 'COUNT(puser_kuser.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT puser_kuser.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PuserKuserPeer::doSelectRS($criteria, $con);
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
		$objects = PuserKuserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PuserKuserPeer::populateObjects(PuserKuserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PuserKuserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PuserKuserPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = PuserKuserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserKuserPeer::addSelectColumns($c);
		$startcol = (PuserKuserPeer::NUM_COLUMNS - PuserKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(PuserKuserPeer::KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserKuserPeer::getOMClass();

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
										$temp_obj2->addPuserKuser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPuserKusers();
				$obj2->addPuserKuser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserKuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserKuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = PuserKuserPeer::doSelectRS($criteria, $con);
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

		PuserKuserPeer::addSelectColumns($c);
		$startcol2 = (PuserKuserPeer::NUM_COLUMNS - PuserKuserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(PuserKuserPeer::KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPuserKuser($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPuserKusers();
				$obj2->addPuserKuser($obj1);
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
		return PuserKuserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PuserKuserPeer::ID); 

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
			$comparison = $criteria->getComparison(PuserKuserPeer::ID);
			$selectCriteria->add(PuserKuserPeer::ID, $criteria->remove(PuserKuserPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PuserKuserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PuserKuserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PuserKuser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PuserKuserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PuserKuser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PuserKuserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PuserKuserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PuserKuserPeer::DATABASE_NAME, PuserKuserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PuserKuserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PuserKuserPeer::DATABASE_NAME);

		$criteria->add(PuserKuserPeer::ID, $pk);


		$v = PuserKuserPeer::doSelect($criteria, $con);

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
			$criteria->add(PuserKuserPeer::ID, $pks, Criteria::IN);
			$objs = PuserKuserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePuserKuserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PuserKuserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PuserKuserMapBuilder');
}
