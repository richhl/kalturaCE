<?php


abstract class BaseWidgetLogPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'widget_log';

	
	const CLASS_DEFAULT = 'lib.model.WidgetLog';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'widget_log.ID';

	
	const KSHOW_ID = 'widget_log.KSHOW_ID';

	
	const ENTRY_ID = 'widget_log.ENTRY_ID';

	
	const KMEDIA_TYPE = 'widget_log.KMEDIA_TYPE';

	
	const WIDGET_TYPE = 'widget_log.WIDGET_TYPE';

	
	const REFERER = 'widget_log.REFERER';

	
	const VIEWS = 'widget_log.VIEWS';

	
	const IP1 = 'widget_log.IP1';

	
	const IP1_COUNT = 'widget_log.IP1_COUNT';

	
	const IP2 = 'widget_log.IP2';

	
	const IP2_COUNT = 'widget_log.IP2_COUNT';

	
	const CREATED_AT = 'widget_log.CREATED_AT';

	
	const UPDATED_AT = 'widget_log.UPDATED_AT';

	
	const PLAYS = 'widget_log.PLAYS';

	
	const PARTNER_ID = 'widget_log.PARTNER_ID';

	
	const SUBP_ID = 'widget_log.SUBP_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'KshowId', 'EntryId', 'KmediaType', 'WidgetType', 'Referer', 'Views', 'Ip1', 'Ip1Count', 'Ip2', 'Ip2Count', 'CreatedAt', 'UpdatedAt', 'Plays', 'PartnerId', 'SubpId', ),
		BasePeer::TYPE_COLNAME => array (WidgetLogPeer::ID, WidgetLogPeer::KSHOW_ID, WidgetLogPeer::ENTRY_ID, WidgetLogPeer::KMEDIA_TYPE, WidgetLogPeer::WIDGET_TYPE, WidgetLogPeer::REFERER, WidgetLogPeer::VIEWS, WidgetLogPeer::IP1, WidgetLogPeer::IP1_COUNT, WidgetLogPeer::IP2, WidgetLogPeer::IP2_COUNT, WidgetLogPeer::CREATED_AT, WidgetLogPeer::UPDATED_AT, WidgetLogPeer::PLAYS, WidgetLogPeer::PARTNER_ID, WidgetLogPeer::SUBP_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'kshow_id', 'entry_id', 'kmedia_type', 'widget_type', 'referer', 'views', 'ip1', 'ip1_count', 'ip2', 'ip2_count', 'created_at', 'updated_at', 'plays', 'partner_id', 'subp_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'KshowId' => 1, 'EntryId' => 2, 'KmediaType' => 3, 'WidgetType' => 4, 'Referer' => 5, 'Views' => 6, 'Ip1' => 7, 'Ip1Count' => 8, 'Ip2' => 9, 'Ip2Count' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'Plays' => 13, 'PartnerId' => 14, 'SubpId' => 15, ),
		BasePeer::TYPE_COLNAME => array (WidgetLogPeer::ID => 0, WidgetLogPeer::KSHOW_ID => 1, WidgetLogPeer::ENTRY_ID => 2, WidgetLogPeer::KMEDIA_TYPE => 3, WidgetLogPeer::WIDGET_TYPE => 4, WidgetLogPeer::REFERER => 5, WidgetLogPeer::VIEWS => 6, WidgetLogPeer::IP1 => 7, WidgetLogPeer::IP1_COUNT => 8, WidgetLogPeer::IP2 => 9, WidgetLogPeer::IP2_COUNT => 10, WidgetLogPeer::CREATED_AT => 11, WidgetLogPeer::UPDATED_AT => 12, WidgetLogPeer::PLAYS => 13, WidgetLogPeer::PARTNER_ID => 14, WidgetLogPeer::SUBP_ID => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'kshow_id' => 1, 'entry_id' => 2, 'kmedia_type' => 3, 'widget_type' => 4, 'referer' => 5, 'views' => 6, 'ip1' => 7, 'ip1_count' => 8, 'ip2' => 9, 'ip2_count' => 10, 'created_at' => 11, 'updated_at' => 12, 'plays' => 13, 'partner_id' => 14, 'subp_id' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/WidgetLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.WidgetLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = WidgetLogPeer::getTableMap();
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
		return str_replace(WidgetLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WidgetLogPeer::ID);

		$criteria->addSelectColumn(WidgetLogPeer::KSHOW_ID);

		$criteria->addSelectColumn(WidgetLogPeer::ENTRY_ID);

		$criteria->addSelectColumn(WidgetLogPeer::KMEDIA_TYPE);

		$criteria->addSelectColumn(WidgetLogPeer::WIDGET_TYPE);

		$criteria->addSelectColumn(WidgetLogPeer::REFERER);

		$criteria->addSelectColumn(WidgetLogPeer::VIEWS);

		$criteria->addSelectColumn(WidgetLogPeer::IP1);

		$criteria->addSelectColumn(WidgetLogPeer::IP1_COUNT);

		$criteria->addSelectColumn(WidgetLogPeer::IP2);

		$criteria->addSelectColumn(WidgetLogPeer::IP2_COUNT);

		$criteria->addSelectColumn(WidgetLogPeer::CREATED_AT);

		$criteria->addSelectColumn(WidgetLogPeer::UPDATED_AT);

		$criteria->addSelectColumn(WidgetLogPeer::PLAYS);

		$criteria->addSelectColumn(WidgetLogPeer::PARTNER_ID);

		$criteria->addSelectColumn(WidgetLogPeer::SUBP_ID);

	}

	const COUNT = 'COUNT(widget_log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT widget_log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = WidgetLogPeer::doSelectRS($criteria, $con);
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
		$objects = WidgetLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return WidgetLogPeer::populateObjects(WidgetLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			WidgetLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = WidgetLogPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$rs = WidgetLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinentry(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WidgetLogPeer::addSelectColumns($c);
		$startcol = (WidgetLogPeer::NUM_COLUMNS - WidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(WidgetLogPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WidgetLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWidgetLog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWidgetLogs();
				$obj2->addWidgetLog($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$rs = WidgetLogPeer::doSelectRS($criteria, $con);
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

		WidgetLogPeer::addSelectColumns($c);
		$startcol2 = (WidgetLogPeer::NUM_COLUMNS - WidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		$c->addJoin(WidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WidgetLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWidgetLog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initWidgetLogs();
				$obj2->addWidgetLog($obj1);
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
		return WidgetLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(WidgetLogPeer::ID); 

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
			$comparison = $criteria->getComparison(WidgetLogPeer::ID);
			$selectCriteria->add(WidgetLogPeer::ID, $criteria->remove(WidgetLogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(WidgetLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WidgetLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof WidgetLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WidgetLogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(WidgetLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WidgetLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WidgetLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WidgetLogPeer::DATABASE_NAME, WidgetLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WidgetLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(WidgetLogPeer::DATABASE_NAME);

		$criteria->add(WidgetLogPeer::ID, $pk);


		$v = WidgetLogPeer::doSelect($criteria, $con);

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
			$criteria->add(WidgetLogPeer::ID, $pks, Criteria::IN);
			$objs = WidgetLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseWidgetLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/WidgetLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.WidgetLogMapBuilder');
}
