<?php


abstract class BaseBBForumPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'bb_forum';

	
	const CLASS_DEFAULT = 'lib.model.BBForum';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'bb_forum.ID';

	
	const NAME = 'bb_forum.NAME';

	
	const DESCRIPTION = 'bb_forum.DESCRIPTION';

	
	const POST_COUNT = 'bb_forum.POST_COUNT';

	
	const THREAD_COUNT = 'bb_forum.THREAD_COUNT';

	
	const LAST_POST = 'bb_forum.LAST_POST';

	
	const CREATED_AT = 'bb_forum.CREATED_AT';

	
	const UPDATED_AT = 'bb_forum.UPDATED_AT';

	
	const IS_LIVE = 'bb_forum.IS_LIVE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'PostCount', 'ThreadCount', 'LastPost', 'CreatedAt', 'UpdatedAt', 'IsLive', ),
		BasePeer::TYPE_COLNAME => array (BBForumPeer::ID, BBForumPeer::NAME, BBForumPeer::DESCRIPTION, BBForumPeer::POST_COUNT, BBForumPeer::THREAD_COUNT, BBForumPeer::LAST_POST, BBForumPeer::CREATED_AT, BBForumPeer::UPDATED_AT, BBForumPeer::IS_LIVE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'post_count', 'thread_count', 'last_post', 'created_at', 'updated_at', 'is_live', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'PostCount' => 3, 'ThreadCount' => 4, 'LastPost' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'IsLive' => 8, ),
		BasePeer::TYPE_COLNAME => array (BBForumPeer::ID => 0, BBForumPeer::NAME => 1, BBForumPeer::DESCRIPTION => 2, BBForumPeer::POST_COUNT => 3, BBForumPeer::THREAD_COUNT => 4, BBForumPeer::LAST_POST => 5, BBForumPeer::CREATED_AT => 6, BBForumPeer::UPDATED_AT => 7, BBForumPeer::IS_LIVE => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'post_count' => 3, 'thread_count' => 4, 'last_post' => 5, 'created_at' => 6, 'updated_at' => 7, 'is_live' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/BBForumMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.BBForumMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = BBForumPeer::getTableMap();
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
		return str_replace(BBForumPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(BBForumPeer::ID);

		$criteria->addSelectColumn(BBForumPeer::NAME);

		$criteria->addSelectColumn(BBForumPeer::DESCRIPTION);

		$criteria->addSelectColumn(BBForumPeer::POST_COUNT);

		$criteria->addSelectColumn(BBForumPeer::THREAD_COUNT);

		$criteria->addSelectColumn(BBForumPeer::LAST_POST);

		$criteria->addSelectColumn(BBForumPeer::CREATED_AT);

		$criteria->addSelectColumn(BBForumPeer::UPDATED_AT);

		$criteria->addSelectColumn(BBForumPeer::IS_LIVE);

	}

	const COUNT = 'COUNT(bb_forum.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT bb_forum.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = BBForumPeer::doSelectRS($criteria, $con);
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
		$objects = BBForumPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return BBForumPeer::populateObjects(BBForumPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			BBForumPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = BBForumPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinBBPost(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBForumPeer::LAST_POST, BBPostPeer::ID);

		$rs = BBForumPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinBBPost(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BBForumPeer::addSelectColumns($c);
		$startcol = (BBForumPeer::NUM_COLUMNS - BBForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BBPostPeer::addSelectColumns($c);

		$c->addJoin(BBForumPeer::LAST_POST, BBPostPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BBPostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getBBPost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addBBForum($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initBBForums();
				$obj2->addBBForum($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBForumPeer::LAST_POST, BBPostPeer::ID);

		$rs = BBForumPeer::doSelectRS($criteria, $con);
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

		BBForumPeer::addSelectColumns($c);
		$startcol2 = (BBForumPeer::NUM_COLUMNS - BBForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		BBPostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + BBPostPeer::NUM_COLUMNS;

		$c->addJoin(BBForumPeer::LAST_POST, BBPostPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = BBPostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getBBPost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addBBForum($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initBBForums();
				$obj2->addBBForum($obj1);
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
		return BBForumPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(BBForumPeer::ID); 

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
			$comparison = $criteria->getComparison(BBForumPeer::ID);
			$selectCriteria->add(BBForumPeer::ID, $criteria->remove(BBForumPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(BBForumPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(BBForumPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof BBForum) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(BBForumPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(BBForum $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(BBForumPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(BBForumPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(BBForumPeer::DATABASE_NAME, BBForumPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = BBForumPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(BBForumPeer::DATABASE_NAME);

		$criteria->add(BBForumPeer::ID, $pk);


		$v = BBForumPeer::doSelect($criteria, $con);

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
			$criteria->add(BBForumPeer::ID, $pks, Criteria::IN);
			$objs = BBForumPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseBBForumPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/BBForumMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.BBForumMapBuilder');
}
