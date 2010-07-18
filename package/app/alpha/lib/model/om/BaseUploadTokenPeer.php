<?php


abstract class BaseUploadTokenPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'upload_token';

	
	const CLASS_DEFAULT = 'lib.model.UploadToken';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'upload_token.ID';

	
	const INT_ID = 'upload_token.INT_ID';

	
	const PARTNER_ID = 'upload_token.PARTNER_ID';

	
	const KUSER_ID = 'upload_token.KUSER_ID';

	
	const STATUS = 'upload_token.STATUS';

	
	const FILE_NAME = 'upload_token.FILE_NAME';

	
	const FILE_SIZE = 'upload_token.FILE_SIZE';

	
	const UPLOADED_FILE_SIZE = 'upload_token.UPLOADED_FILE_SIZE';

	
	const UPLOAD_TEMP_PATH = 'upload_token.UPLOAD_TEMP_PATH';

	
	const USER_IP = 'upload_token.USER_IP';

	
	const CREATED_AT = 'upload_token.CREATED_AT';

	
	const UPDATED_AT = 'upload_token.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IntId', 'PartnerId', 'KuserId', 'Status', 'FileName', 'FileSize', 'UploadedFileSize', 'UploadTempPath', 'UserIp', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (UploadTokenPeer::ID, UploadTokenPeer::INT_ID, UploadTokenPeer::PARTNER_ID, UploadTokenPeer::KUSER_ID, UploadTokenPeer::STATUS, UploadTokenPeer::FILE_NAME, UploadTokenPeer::FILE_SIZE, UploadTokenPeer::UPLOADED_FILE_SIZE, UploadTokenPeer::UPLOAD_TEMP_PATH, UploadTokenPeer::USER_IP, UploadTokenPeer::CREATED_AT, UploadTokenPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'int_id', 'partner_id', 'kuser_id', 'status', 'file_name', 'file_size', 'uploaded_file_size', 'upload_temp_path', 'user_ip', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IntId' => 1, 'PartnerId' => 2, 'KuserId' => 3, 'Status' => 4, 'FileName' => 5, 'FileSize' => 6, 'UploadedFileSize' => 7, 'UploadTempPath' => 8, 'UserIp' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (UploadTokenPeer::ID => 0, UploadTokenPeer::INT_ID => 1, UploadTokenPeer::PARTNER_ID => 2, UploadTokenPeer::KUSER_ID => 3, UploadTokenPeer::STATUS => 4, UploadTokenPeer::FILE_NAME => 5, UploadTokenPeer::FILE_SIZE => 6, UploadTokenPeer::UPLOADED_FILE_SIZE => 7, UploadTokenPeer::UPLOAD_TEMP_PATH => 8, UploadTokenPeer::USER_IP => 9, UploadTokenPeer::CREATED_AT => 10, UploadTokenPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'int_id' => 1, 'partner_id' => 2, 'kuser_id' => 3, 'status' => 4, 'file_name' => 5, 'file_size' => 6, 'uploaded_file_size' => 7, 'upload_temp_path' => 8, 'user_ip' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UploadTokenMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UploadTokenMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UploadTokenPeer::getTableMap();
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
		return str_replace(UploadTokenPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UploadTokenPeer::ID);

		$criteria->addSelectColumn(UploadTokenPeer::INT_ID);

		$criteria->addSelectColumn(UploadTokenPeer::PARTNER_ID);

		$criteria->addSelectColumn(UploadTokenPeer::KUSER_ID);

		$criteria->addSelectColumn(UploadTokenPeer::STATUS);

		$criteria->addSelectColumn(UploadTokenPeer::FILE_NAME);

		$criteria->addSelectColumn(UploadTokenPeer::FILE_SIZE);

		$criteria->addSelectColumn(UploadTokenPeer::UPLOADED_FILE_SIZE);

		$criteria->addSelectColumn(UploadTokenPeer::UPLOAD_TEMP_PATH);

		$criteria->addSelectColumn(UploadTokenPeer::USER_IP);

		$criteria->addSelectColumn(UploadTokenPeer::CREATED_AT);

		$criteria->addSelectColumn(UploadTokenPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(upload_token.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT upload_token.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UploadTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UploadTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UploadTokenPeer::doSelectRS($criteria, $con);
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
		$objects = UploadTokenPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UploadTokenPeer::populateObjects(UploadTokenPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UploadTokenPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UploadTokenPeer::getOMClass();
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
			$criteria->addSelectColumn(UploadTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UploadTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UploadTokenPeer::KUSER_ID, kuserPeer::ID);

		$rs = UploadTokenPeer::doSelectRS($criteria, $con);
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

		UploadTokenPeer::addSelectColumns($c);
		$startcol = (UploadTokenPeer::NUM_COLUMNS - UploadTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(UploadTokenPeer::KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UploadTokenPeer::getOMClass();

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
										$temp_obj2->addUploadToken($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUploadTokens();
				$obj2->addUploadToken($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UploadTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UploadTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UploadTokenPeer::KUSER_ID, kuserPeer::ID);

		$rs = UploadTokenPeer::doSelectRS($criteria, $con);
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

		UploadTokenPeer::addSelectColumns($c);
		$startcol2 = (UploadTokenPeer::NUM_COLUMNS - UploadTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(UploadTokenPeer::KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UploadTokenPeer::getOMClass();


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
					$temp_obj2->addUploadToken($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUploadTokens();
				$obj2->addUploadToken($obj1);
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
		return UploadTokenPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(UploadTokenPeer::ID);
			$selectCriteria->add(UploadTokenPeer::ID, $criteria->remove(UploadTokenPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(UploadTokenPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UploadTokenPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof UploadToken) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UploadTokenPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(UploadToken $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UploadTokenPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UploadTokenPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UploadTokenPeer::DATABASE_NAME, UploadTokenPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UploadTokenPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(UploadTokenPeer::DATABASE_NAME);

		$criteria->add(UploadTokenPeer::ID, $pk);


		$v = UploadTokenPeer::doSelect($criteria, $con);

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
			$criteria->add(UploadTokenPeer::ID, $pks, Criteria::IN);
			$objs = UploadTokenPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUploadTokenPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/UploadTokenMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UploadTokenMapBuilder');
}
