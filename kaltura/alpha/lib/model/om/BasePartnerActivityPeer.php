<?php


abstract class BasePartnerActivityPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'partner_activity';

	
	const CLASS_DEFAULT = 'lib.model.PartnerActivity';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'partner_activity.ID';

	
	const PARTNER_ID = 'partner_activity.PARTNER_ID';

	
	const ACTIVITY_DATE = 'partner_activity.ACTIVITY_DATE';

	
	const ACTIVITY = 'partner_activity.ACTIVITY';

	
	const SUB_ACTIVITY = 'partner_activity.SUB_ACTIVITY';

	
	const AMOUNT = 'partner_activity.AMOUNT';

	
	const AMOUNT1 = 'partner_activity.AMOUNT1';

	
	const AMOUNT2 = 'partner_activity.AMOUNT2';

	
	const AMOUNT3 = 'partner_activity.AMOUNT3';

	
	const AMOUNT4 = 'partner_activity.AMOUNT4';

	
	const AMOUNT5 = 'partner_activity.AMOUNT5';

	
	const AMOUNT6 = 'partner_activity.AMOUNT6';

	
	const AMOUNT7 = 'partner_activity.AMOUNT7';

	
	const AMOUNT9 = 'partner_activity.AMOUNT9';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'ActivityDate', 'Activity', 'SubActivity', 'Amount', 'Amount1', 'Amount2', 'Amount3', 'Amount4', 'Amount5', 'Amount6', 'Amount7', 'Amount9', ),
		BasePeer::TYPE_COLNAME => array (PartnerActivityPeer::ID, PartnerActivityPeer::PARTNER_ID, PartnerActivityPeer::ACTIVITY_DATE, PartnerActivityPeer::ACTIVITY, PartnerActivityPeer::SUB_ACTIVITY, PartnerActivityPeer::AMOUNT, PartnerActivityPeer::AMOUNT1, PartnerActivityPeer::AMOUNT2, PartnerActivityPeer::AMOUNT3, PartnerActivityPeer::AMOUNT4, PartnerActivityPeer::AMOUNT5, PartnerActivityPeer::AMOUNT6, PartnerActivityPeer::AMOUNT7, PartnerActivityPeer::AMOUNT9, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'activity_date', 'activity', 'sub_activity', 'amount', 'amount1', 'amount2', 'amount3', 'amount4', 'amount5', 'amount6', 'amount7', 'amount9', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'ActivityDate' => 2, 'Activity' => 3, 'SubActivity' => 4, 'Amount' => 5, 'Amount1' => 6, 'Amount2' => 7, 'Amount3' => 8, 'Amount4' => 9, 'Amount5' => 10, 'Amount6' => 11, 'Amount7' => 12, 'Amount9' => 13, ),
		BasePeer::TYPE_COLNAME => array (PartnerActivityPeer::ID => 0, PartnerActivityPeer::PARTNER_ID => 1, PartnerActivityPeer::ACTIVITY_DATE => 2, PartnerActivityPeer::ACTIVITY => 3, PartnerActivityPeer::SUB_ACTIVITY => 4, PartnerActivityPeer::AMOUNT => 5, PartnerActivityPeer::AMOUNT1 => 6, PartnerActivityPeer::AMOUNT2 => 7, PartnerActivityPeer::AMOUNT3 => 8, PartnerActivityPeer::AMOUNT4 => 9, PartnerActivityPeer::AMOUNT5 => 10, PartnerActivityPeer::AMOUNT6 => 11, PartnerActivityPeer::AMOUNT7 => 12, PartnerActivityPeer::AMOUNT9 => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'activity_date' => 2, 'activity' => 3, 'sub_activity' => 4, 'amount' => 5, 'amount1' => 6, 'amount2' => 7, 'amount3' => 8, 'amount4' => 9, 'amount5' => 10, 'amount6' => 11, 'amount7' => 12, 'amount9' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PartnerActivityMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PartnerActivityMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PartnerActivityPeer::getTableMap();
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
		return str_replace(PartnerActivityPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PartnerActivityPeer::ID);

		$criteria->addSelectColumn(PartnerActivityPeer::PARTNER_ID);

		$criteria->addSelectColumn(PartnerActivityPeer::ACTIVITY_DATE);

		$criteria->addSelectColumn(PartnerActivityPeer::ACTIVITY);

		$criteria->addSelectColumn(PartnerActivityPeer::SUB_ACTIVITY);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT1);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT2);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT3);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT4);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT5);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT6);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT7);

		$criteria->addSelectColumn(PartnerActivityPeer::AMOUNT9);

	}

	const COUNT = 'COUNT(partner_activity.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT partner_activity.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PartnerActivityPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PartnerActivityPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PartnerActivityPeer::doSelectRS($criteria, $con);
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
		$objects = PartnerActivityPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PartnerActivityPeer::populateObjects(PartnerActivityPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PartnerActivityPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PartnerActivityPeer::getOMClass();
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
		return PartnerActivityPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PartnerActivityPeer::ID); 

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
			$comparison = $criteria->getComparison(PartnerActivityPeer::ID);
			$selectCriteria->add(PartnerActivityPeer::ID, $criteria->remove(PartnerActivityPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PartnerActivityPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PartnerActivityPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PartnerActivity) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PartnerActivityPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PartnerActivity $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PartnerActivityPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PartnerActivityPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PartnerActivityPeer::DATABASE_NAME, PartnerActivityPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PartnerActivityPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PartnerActivityPeer::DATABASE_NAME);

		$criteria->add(PartnerActivityPeer::ID, $pk);


		$v = PartnerActivityPeer::doSelect($criteria, $con);

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
			$criteria->add(PartnerActivityPeer::ID, $pks, Criteria::IN);
			$objs = PartnerActivityPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePartnerActivityPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PartnerActivityMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PartnerActivityMapBuilder');
}
