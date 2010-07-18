<?php


abstract class BaseflickrTokenPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'flickr_token';

	
	const CLASS_DEFAULT = 'lib.model.flickrToken';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const KALT_TOKEN = 'flickr_token.KALT_TOKEN';

	
	const FROB = 'flickr_token.FROB';

	
	const TOKEN = 'flickr_token.TOKEN';

	
	const NSID = 'flickr_token.NSID';

	
	const RESPONSE = 'flickr_token.RESPONSE';

	
	const IS_VALID = 'flickr_token.IS_VALID';

	
	const CREATED_AT = 'flickr_token.CREATED_AT';

	
	const UPDATED_AT = 'flickr_token.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('KaltToken', 'Frob', 'Token', 'Nsid', 'Response', 'IsValid', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (flickrTokenPeer::KALT_TOKEN, flickrTokenPeer::FROB, flickrTokenPeer::TOKEN, flickrTokenPeer::NSID, flickrTokenPeer::RESPONSE, flickrTokenPeer::IS_VALID, flickrTokenPeer::CREATED_AT, flickrTokenPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('kalt_token', 'frob', 'token', 'nsid', 'response', 'is_valid', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('KaltToken' => 0, 'Frob' => 1, 'Token' => 2, 'Nsid' => 3, 'Response' => 4, 'IsValid' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (flickrTokenPeer::KALT_TOKEN => 0, flickrTokenPeer::FROB => 1, flickrTokenPeer::TOKEN => 2, flickrTokenPeer::NSID => 3, flickrTokenPeer::RESPONSE => 4, flickrTokenPeer::IS_VALID => 5, flickrTokenPeer::CREATED_AT => 6, flickrTokenPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('kalt_token' => 0, 'frob' => 1, 'token' => 2, 'nsid' => 3, 'response' => 4, 'is_valid' => 5, 'created_at' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/flickrTokenMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.flickrTokenMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = flickrTokenPeer::getTableMap();
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
		return str_replace(flickrTokenPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(flickrTokenPeer::KALT_TOKEN);

		$criteria->addSelectColumn(flickrTokenPeer::FROB);

		$criteria->addSelectColumn(flickrTokenPeer::TOKEN);

		$criteria->addSelectColumn(flickrTokenPeer::NSID);

		$criteria->addSelectColumn(flickrTokenPeer::RESPONSE);

		$criteria->addSelectColumn(flickrTokenPeer::IS_VALID);

		$criteria->addSelectColumn(flickrTokenPeer::CREATED_AT);

		$criteria->addSelectColumn(flickrTokenPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(flickr_token.KALT_TOKEN)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT flickr_token.KALT_TOKEN)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flickrTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flickrTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = flickrTokenPeer::doSelectRS($criteria, $con);
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
		$objects = flickrTokenPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return flickrTokenPeer::populateObjects(flickrTokenPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			flickrTokenPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = flickrTokenPeer::getOMClass();
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
		return flickrTokenPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(flickrTokenPeer::KALT_TOKEN);
			$selectCriteria->add(flickrTokenPeer::KALT_TOKEN, $criteria->remove(flickrTokenPeer::KALT_TOKEN), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(flickrTokenPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(flickrTokenPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof flickrToken) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(flickrTokenPeer::KALT_TOKEN, (array) $values, Criteria::IN);
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

	
	public static function doValidate(flickrToken $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(flickrTokenPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(flickrTokenPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(flickrTokenPeer::DATABASE_NAME, flickrTokenPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = flickrTokenPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(flickrTokenPeer::DATABASE_NAME);

		$criteria->add(flickrTokenPeer::KALT_TOKEN, $pk);


		$v = flickrTokenPeer::doSelect($criteria, $con);

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
			$criteria->add(flickrTokenPeer::KALT_TOKEN, $pks, Criteria::IN);
			$objs = flickrTokenPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseflickrTokenPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/flickrTokenMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.flickrTokenMapBuilder');
}
