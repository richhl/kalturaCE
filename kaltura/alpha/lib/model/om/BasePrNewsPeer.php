<?php


abstract class BasePrNewsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'pr_news';

	
	const CLASS_DEFAULT = 'lib.model.PrNews';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'pr_news.ID';

	
	const PR_ORDER = 'pr_news.PR_ORDER';

	
	const IMAGE_PATH = 'pr_news.IMAGE_PATH';

	
	const HREF = 'pr_news.HREF';

	
	const TEXT = 'pr_news.TEXT';

	
	const ALT = 'pr_news.ALT';

	
	const CREATED_AT = 'pr_news.CREATED_AT';

	
	const UPDATED_AT = 'pr_news.UPDATED_AT';

	
	const PRESS_DATE = 'pr_news.PRESS_DATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PrOrder', 'ImagePath', 'Href', 'Text', 'Alt', 'CreatedAt', 'UpdatedAt', 'PressDate', ),
		BasePeer::TYPE_COLNAME => array (PrNewsPeer::ID, PrNewsPeer::PR_ORDER, PrNewsPeer::IMAGE_PATH, PrNewsPeer::HREF, PrNewsPeer::TEXT, PrNewsPeer::ALT, PrNewsPeer::CREATED_AT, PrNewsPeer::UPDATED_AT, PrNewsPeer::PRESS_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'pr_order', 'image_path', 'href', 'text', 'alt', 'created_at', 'updated_at', 'press_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PrOrder' => 1, 'ImagePath' => 2, 'Href' => 3, 'Text' => 4, 'Alt' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'PressDate' => 8, ),
		BasePeer::TYPE_COLNAME => array (PrNewsPeer::ID => 0, PrNewsPeer::PR_ORDER => 1, PrNewsPeer::IMAGE_PATH => 2, PrNewsPeer::HREF => 3, PrNewsPeer::TEXT => 4, PrNewsPeer::ALT => 5, PrNewsPeer::CREATED_AT => 6, PrNewsPeer::UPDATED_AT => 7, PrNewsPeer::PRESS_DATE => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'pr_order' => 1, 'image_path' => 2, 'href' => 3, 'text' => 4, 'alt' => 5, 'created_at' => 6, 'updated_at' => 7, 'press_date' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PrNewsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PrNewsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PrNewsPeer::getTableMap();
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
		return str_replace(PrNewsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PrNewsPeer::ID);

		$criteria->addSelectColumn(PrNewsPeer::PR_ORDER);

		$criteria->addSelectColumn(PrNewsPeer::IMAGE_PATH);

		$criteria->addSelectColumn(PrNewsPeer::HREF);

		$criteria->addSelectColumn(PrNewsPeer::TEXT);

		$criteria->addSelectColumn(PrNewsPeer::ALT);

		$criteria->addSelectColumn(PrNewsPeer::CREATED_AT);

		$criteria->addSelectColumn(PrNewsPeer::UPDATED_AT);

		$criteria->addSelectColumn(PrNewsPeer::PRESS_DATE);

	}

	const COUNT = 'COUNT(pr_news.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT pr_news.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PrNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PrNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PrNewsPeer::doSelectRS($criteria, $con);
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
		$objects = PrNewsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PrNewsPeer::populateObjects(PrNewsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PrNewsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PrNewsPeer::getOMClass();
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
		return PrNewsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PrNewsPeer::ID); 

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
			$comparison = $criteria->getComparison(PrNewsPeer::ID);
			$selectCriteria->add(PrNewsPeer::ID, $criteria->remove(PrNewsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PrNewsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PrNewsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PrNews) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PrNewsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PrNews $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PrNewsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PrNewsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PrNewsPeer::DATABASE_NAME, PrNewsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PrNewsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PrNewsPeer::DATABASE_NAME);

		$criteria->add(PrNewsPeer::ID, $pk);


		$v = PrNewsPeer::doSelect($criteria, $con);

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
			$criteria->add(PrNewsPeer::ID, $pks, Criteria::IN);
			$objs = PrNewsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePrNewsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PrNewsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PrNewsMapBuilder');
}
