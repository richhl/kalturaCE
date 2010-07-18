<?php


abstract class BaseflavorParamsConversionProfilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'flavor_params_conversion_profile';

	
	const CLASS_DEFAULT = 'lib.model.flavorParamsConversionProfile';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'flavor_params_conversion_profile.ID';

	
	const CONVERSION_PROFILE_ID = 'flavor_params_conversion_profile.CONVERSION_PROFILE_ID';

	
	const FLAVOR_PARAMS_ID = 'flavor_params_conversion_profile.FLAVOR_PARAMS_ID';

	
	const READY_BEHAVIOR = 'flavor_params_conversion_profile.READY_BEHAVIOR';

	
	const FORCE_NONE_COMPLIED = 'flavor_params_conversion_profile.FORCE_NONE_COMPLIED';

	
	const CREATED_AT = 'flavor_params_conversion_profile.CREATED_AT';

	
	const UPDATED_AT = 'flavor_params_conversion_profile.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ConversionProfileId', 'FlavorParamsId', 'ReadyBehavior', 'ForceNoneComplied', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (flavorParamsConversionProfilePeer::ID, flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsConversionProfilePeer::READY_BEHAVIOR, flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED, flavorParamsConversionProfilePeer::CREATED_AT, flavorParamsConversionProfilePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'conversion_profile_id', 'flavor_params_id', 'ready_behavior', 'force_none_complied', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ConversionProfileId' => 1, 'FlavorParamsId' => 2, 'ReadyBehavior' => 3, 'ForceNoneComplied' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (flavorParamsConversionProfilePeer::ID => 0, flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID => 1, flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID => 2, flavorParamsConversionProfilePeer::READY_BEHAVIOR => 3, flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED => 4, flavorParamsConversionProfilePeer::CREATED_AT => 5, flavorParamsConversionProfilePeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'conversion_profile_id' => 1, 'flavor_params_id' => 2, 'ready_behavior' => 3, 'force_none_complied' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/flavorParamsConversionProfileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.flavorParamsConversionProfileMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = flavorParamsConversionProfilePeer::getTableMap();
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
		return str_replace(flavorParamsConversionProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::ID);

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID);

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID);

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::READY_BEHAVIOR);

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED);

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::CREATED_AT);

		$criteria->addSelectColumn(flavorParamsConversionProfilePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(flavor_params_conversion_profile.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT flavor_params_conversion_profile.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = flavorParamsConversionProfilePeer::doSelectRS($criteria, $con);
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
		$objects = flavorParamsConversionProfilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return flavorParamsConversionProfilePeer::populateObjects(flavorParamsConversionProfilePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			flavorParamsConversionProfilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = flavorParamsConversionProfilePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinconversionProfile2(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, conversionProfile2Peer::ID);

		$rs = flavorParamsConversionProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinflavorParams(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorParamsConversionProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinconversionProfile2(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsConversionProfilePeer::addSelectColumns($c);
		$startcol = (flavorParamsConversionProfilePeer::NUM_COLUMNS - flavorParamsConversionProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		conversionProfile2Peer::addSelectColumns($c);

		$c->addJoin(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, conversionProfile2Peer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsConversionProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = conversionProfile2Peer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getconversionProfile2(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorParamsConversionProfile($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorParamsConversionProfiles();
				$obj2->addflavorParamsConversionProfile($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinflavorParams(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsConversionProfilePeer::addSelectColumns($c);
		$startcol = (flavorParamsConversionProfilePeer::NUM_COLUMNS - flavorParamsConversionProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		flavorParamsPeer::addSelectColumns($c);

		$c->addJoin(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsConversionProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorParamsConversionProfile($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorParamsConversionProfiles();
				$obj2->addflavorParamsConversionProfile($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, conversionProfile2Peer::ID);

		$criteria->addJoin(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorParamsConversionProfilePeer::doSelectRS($criteria, $con);
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

		flavorParamsConversionProfilePeer::addSelectColumns($c);
		$startcol2 = (flavorParamsConversionProfilePeer::NUM_COLUMNS - flavorParamsConversionProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		conversionProfile2Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + conversionProfile2Peer::NUM_COLUMNS;

		flavorParamsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + flavorParamsPeer::NUM_COLUMNS;

		$c->addJoin(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, conversionProfile2Peer::ID);

		$c->addJoin(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsConversionProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = conversionProfile2Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getconversionProfile2(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsConversionProfile($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsConversionProfiles();
				$obj2->addflavorParamsConversionProfile($obj1);
			}


					
			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getflavorParams(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addflavorParamsConversionProfile($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initflavorParamsConversionProfiles();
				$obj3->addflavorParamsConversionProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptconversionProfile2(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorParamsConversionProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptflavorParams(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorParamsConversionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, conversionProfile2Peer::ID);

		$rs = flavorParamsConversionProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptconversionProfile2(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsConversionProfilePeer::addSelectColumns($c);
		$startcol2 = (flavorParamsConversionProfilePeer::NUM_COLUMNS - flavorParamsConversionProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		flavorParamsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + flavorParamsPeer::NUM_COLUMNS;

		$c->addJoin(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsConversionProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsConversionProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsConversionProfiles();
				$obj2->addflavorParamsConversionProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptflavorParams(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorParamsConversionProfilePeer::addSelectColumns($c);
		$startcol2 = (flavorParamsConversionProfilePeer::NUM_COLUMNS - flavorParamsConversionProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		conversionProfile2Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + conversionProfile2Peer::NUM_COLUMNS;

		$c->addJoin(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, conversionProfile2Peer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorParamsConversionProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = conversionProfile2Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getconversionProfile2(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorParamsConversionProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorParamsConversionProfiles();
				$obj2->addflavorParamsConversionProfile($obj1);
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
		return flavorParamsConversionProfilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(flavorParamsConversionProfilePeer::ID); 

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
			$comparison = $criteria->getComparison(flavorParamsConversionProfilePeer::ID);
			$selectCriteria->add(flavorParamsConversionProfilePeer::ID, $criteria->remove(flavorParamsConversionProfilePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(flavorParamsConversionProfilePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(flavorParamsConversionProfilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof flavorParamsConversionProfile) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(flavorParamsConversionProfilePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(flavorParamsConversionProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(flavorParamsConversionProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(flavorParamsConversionProfilePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(flavorParamsConversionProfilePeer::DATABASE_NAME, flavorParamsConversionProfilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = flavorParamsConversionProfilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(flavorParamsConversionProfilePeer::DATABASE_NAME);

		$criteria->add(flavorParamsConversionProfilePeer::ID, $pk);


		$v = flavorParamsConversionProfilePeer::doSelect($criteria, $con);

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
			$criteria->add(flavorParamsConversionProfilePeer::ID, $pks, Criteria::IN);
			$objs = flavorParamsConversionProfilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseflavorParamsConversionProfilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/flavorParamsConversionProfileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.flavorParamsConversionProfileMapBuilder');
}
