<?php


abstract class BasePartnershipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'partnership';

	
	const CLASS_DEFAULT = 'lib.model.Partnership';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'partnership.ID';

	
	const PARTNERSHIP_ORDER = 'partnership.PARTNERSHIP_ORDER';

	
	const IMAGE_PATH = 'partnership.IMAGE_PATH';

	
	const HREF = 'partnership.HREF';

	
	const TEXT = 'partnership.TEXT';

	
	const ALT = 'partnership.ALT';

	
	const CREATED_AT = 'partnership.CREATED_AT';

	
	const UPDATED_AT = 'partnership.UPDATED_AT';

	
	const PARTNERSHIP_DATE = 'partnership.PARTNERSHIP_DATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnershipOrder', 'ImagePath', 'Href', 'Text', 'Alt', 'CreatedAt', 'UpdatedAt', 'PartnershipDate', ),
		BasePeer::TYPE_COLNAME => array (PartnershipPeer::ID, PartnershipPeer::PARTNERSHIP_ORDER, PartnershipPeer::IMAGE_PATH, PartnershipPeer::HREF, PartnershipPeer::TEXT, PartnershipPeer::ALT, PartnershipPeer::CREATED_AT, PartnershipPeer::UPDATED_AT, PartnershipPeer::PARTNERSHIP_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partnership_order', 'image_path', 'href', 'text', 'alt', 'created_at', 'updated_at', 'partnership_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnershipOrder' => 1, 'ImagePath' => 2, 'Href' => 3, 'Text' => 4, 'Alt' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'PartnershipDate' => 8, ),
		BasePeer::TYPE_COLNAME => array (PartnershipPeer::ID => 0, PartnershipPeer::PARTNERSHIP_ORDER => 1, PartnershipPeer::IMAGE_PATH => 2, PartnershipPeer::HREF => 3, PartnershipPeer::TEXT => 4, PartnershipPeer::ALT => 5, PartnershipPeer::CREATED_AT => 6, PartnershipPeer::UPDATED_AT => 7, PartnershipPeer::PARTNERSHIP_DATE => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partnership_order' => 1, 'image_path' => 2, 'href' => 3, 'text' => 4, 'alt' => 5, 'created_at' => 6, 'updated_at' => 7, 'partnership_date' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PartnershipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PartnershipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PartnershipPeer::getTableMap();
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
		return str_replace(PartnershipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PartnershipPeer::ID);

		$criteria->addSelectColumn(PartnershipPeer::PARTNERSHIP_ORDER);

		$criteria->addSelectColumn(PartnershipPeer::IMAGE_PATH);

		$criteria->addSelectColumn(PartnershipPeer::HREF);

		$criteria->addSelectColumn(PartnershipPeer::TEXT);

		$criteria->addSelectColumn(PartnershipPeer::ALT);

		$criteria->addSelectColumn(PartnershipPeer::CREATED_AT);

		$criteria->addSelectColumn(PartnershipPeer::UPDATED_AT);

		$criteria->addSelectColumn(PartnershipPeer::PARTNERSHIP_DATE);

	}

	const COUNT = 'COUNT(partnership.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT partnership.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PartnershipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PartnershipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PartnershipPeer::doSelectRS($criteria, $con);
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
		$objects = PartnershipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PartnershipPeer::populateObjects(PartnershipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PartnershipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PartnershipPeer::getOMClass();
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
		return PartnershipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PartnershipPeer::ID); 

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
			$comparison = $criteria->getComparison(PartnershipPeer::ID);
			$selectCriteria->add(PartnershipPeer::ID, $criteria->remove(PartnershipPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PartnershipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PartnershipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Partnership) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PartnershipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Partnership $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PartnershipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PartnershipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PartnershipPeer::DATABASE_NAME, PartnershipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PartnershipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PartnershipPeer::DATABASE_NAME);

		$criteria->add(PartnershipPeer::ID, $pk);


		$v = PartnershipPeer::doSelect($criteria, $con);

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
			$criteria->add(PartnershipPeer::ID, $pks, Criteria::IN);
			$objs = PartnershipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePartnershipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PartnershipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PartnershipMapBuilder');
}
