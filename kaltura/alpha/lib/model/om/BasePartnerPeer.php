<?php


abstract class BasePartnerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'partner';

	
	const CLASS_DEFAULT = 'lib.model.Partner';

	
	const NUM_COLUMNS = 36;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'partner.ID';

	
	const PARTNER_NAME = 'partner.PARTNER_NAME';

	
	const PARTNER_ALIAS = 'partner.PARTNER_ALIAS';

	
	const URL1 = 'partner.URL1';

	
	const URL2 = 'partner.URL2';

	
	const SECRET = 'partner.SECRET';

	
	const ADMIN_SECRET = 'partner.ADMIN_SECRET';

	
	const MAX_NUMBER_OF_HITS_PER_DAY = 'partner.MAX_NUMBER_OF_HITS_PER_DAY';

	
	const APPEAR_IN_SEARCH = 'partner.APPEAR_IN_SEARCH';

	
	const DEBUG_LEVEL = 'partner.DEBUG_LEVEL';

	
	const INVALID_LOGIN_COUNT = 'partner.INVALID_LOGIN_COUNT';

	
	const CREATED_AT = 'partner.CREATED_AT';

	
	const UPDATED_AT = 'partner.UPDATED_AT';

	
	const ANONYMOUS_KUSER_ID = 'partner.ANONYMOUS_KUSER_ID';

	
	const KS_MAX_EXPIRY_IN_SECONDS = 'partner.KS_MAX_EXPIRY_IN_SECONDS';

	
	const CREATE_USER_ON_DEMAND = 'partner.CREATE_USER_ON_DEMAND';

	
	const PREFIX = 'partner.PREFIX';

	
	const ADMIN_NAME = 'partner.ADMIN_NAME';

	
	const ADMIN_EMAIL = 'partner.ADMIN_EMAIL';

	
	const DESCRIPTION = 'partner.DESCRIPTION';

	
	const COMMERCIAL_USE = 'partner.COMMERCIAL_USE';

	
	const MODERATE_CONTENT = 'partner.MODERATE_CONTENT';

	
	const NOTIFY = 'partner.NOTIFY';

	
	const CUSTOM_DATA = 'partner.CUSTOM_DATA';

	
	const SERVICE_CONFIG_ID = 'partner.SERVICE_CONFIG_ID';

	
	const STATUS = 'partner.STATUS';

	
	const CONTENT_CATEGORIES = 'partner.CONTENT_CATEGORIES';

	
	const TYPE = 'partner.TYPE';

	
	const PHONE = 'partner.PHONE';

	
	const DESCRIBE_YOURSELF = 'partner.DESCRIBE_YOURSELF';

	
	const ADULT_CONTENT = 'partner.ADULT_CONTENT';

	
	const PARTNER_PACKAGE = 'partner.PARTNER_PACKAGE';

	
	const USAGE_PERCENT = 'partner.USAGE_PERCENT';

	
	const STORAGE_USAGE = 'partner.STORAGE_USAGE';

	
	const EIGHTY_PERCENT_WARNING = 'partner.EIGHTY_PERCENT_WARNING';

	
	const USAGE_LIMIT_WARNING = 'partner.USAGE_LIMIT_WARNING';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerName', 'PartnerAlias', 'Url1', 'Url2', 'Secret', 'AdminSecret', 'MaxNumberOfHitsPerDay', 'AppearInSearch', 'DebugLevel', 'InvalidLoginCount', 'CreatedAt', 'UpdatedAt', 'AnonymousKuserId', 'KsMaxExpiryInSeconds', 'CreateUserOnDemand', 'Prefix', 'AdminName', 'AdminEmail', 'Description', 'CommercialUse', 'ModerateContent', 'Notify', 'CustomData', 'ServiceConfigId', 'Status', 'ContentCategories', 'Type', 'Phone', 'DescribeYourself', 'AdultContent', 'PartnerPackage', 'UsagePercent', 'StorageUsage', 'EightyPercentWarning', 'UsageLimitWarning', ),
		BasePeer::TYPE_COLNAME => array (PartnerPeer::ID, PartnerPeer::PARTNER_NAME, PartnerPeer::PARTNER_ALIAS, PartnerPeer::URL1, PartnerPeer::URL2, PartnerPeer::SECRET, PartnerPeer::ADMIN_SECRET, PartnerPeer::MAX_NUMBER_OF_HITS_PER_DAY, PartnerPeer::APPEAR_IN_SEARCH, PartnerPeer::DEBUG_LEVEL, PartnerPeer::INVALID_LOGIN_COUNT, PartnerPeer::CREATED_AT, PartnerPeer::UPDATED_AT, PartnerPeer::ANONYMOUS_KUSER_ID, PartnerPeer::KS_MAX_EXPIRY_IN_SECONDS, PartnerPeer::CREATE_USER_ON_DEMAND, PartnerPeer::PREFIX, PartnerPeer::ADMIN_NAME, PartnerPeer::ADMIN_EMAIL, PartnerPeer::DESCRIPTION, PartnerPeer::COMMERCIAL_USE, PartnerPeer::MODERATE_CONTENT, PartnerPeer::NOTIFY, PartnerPeer::CUSTOM_DATA, PartnerPeer::SERVICE_CONFIG_ID, PartnerPeer::STATUS, PartnerPeer::CONTENT_CATEGORIES, PartnerPeer::TYPE, PartnerPeer::PHONE, PartnerPeer::DESCRIBE_YOURSELF, PartnerPeer::ADULT_CONTENT, PartnerPeer::PARTNER_PACKAGE, PartnerPeer::USAGE_PERCENT, PartnerPeer::STORAGE_USAGE, PartnerPeer::EIGHTY_PERCENT_WARNING, PartnerPeer::USAGE_LIMIT_WARNING, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_name', 'partner_alias', 'url1', 'url2', 'secret', 'admin_secret', 'max_number_of_hits_per_day', 'appear_in_search', 'debug_level', 'invalid_login_count', 'created_at', 'updated_at', 'anonymous_kuser_id', 'ks_max_expiry_in_seconds', 'create_user_on_demand', 'prefix', 'admin_name', 'admin_email', 'description', 'commercial_use', 'moderate_content', 'notify', 'custom_data', 'service_config_id', 'status', 'content_categories', 'type', 'phone', 'describe_yourself', 'adult_content', 'partner_package', 'usage_percent', 'storage_usage', 'eighty_percent_warning', 'usage_limit_warning', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerName' => 1, 'PartnerAlias' => 2, 'Url1' => 3, 'Url2' => 4, 'Secret' => 5, 'AdminSecret' => 6, 'MaxNumberOfHitsPerDay' => 7, 'AppearInSearch' => 8, 'DebugLevel' => 9, 'InvalidLoginCount' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'AnonymousKuserId' => 13, 'KsMaxExpiryInSeconds' => 14, 'CreateUserOnDemand' => 15, 'Prefix' => 16, 'AdminName' => 17, 'AdminEmail' => 18, 'Description' => 19, 'CommercialUse' => 20, 'ModerateContent' => 21, 'Notify' => 22, 'CustomData' => 23, 'ServiceConfigId' => 24, 'Status' => 25, 'ContentCategories' => 26, 'Type' => 27, 'Phone' => 28, 'DescribeYourself' => 29, 'AdultContent' => 30, 'PartnerPackage' => 31, 'UsagePercent' => 32, 'StorageUsage' => 33, 'EightyPercentWarning' => 34, 'UsageLimitWarning' => 35, ),
		BasePeer::TYPE_COLNAME => array (PartnerPeer::ID => 0, PartnerPeer::PARTNER_NAME => 1, PartnerPeer::PARTNER_ALIAS => 2, PartnerPeer::URL1 => 3, PartnerPeer::URL2 => 4, PartnerPeer::SECRET => 5, PartnerPeer::ADMIN_SECRET => 6, PartnerPeer::MAX_NUMBER_OF_HITS_PER_DAY => 7, PartnerPeer::APPEAR_IN_SEARCH => 8, PartnerPeer::DEBUG_LEVEL => 9, PartnerPeer::INVALID_LOGIN_COUNT => 10, PartnerPeer::CREATED_AT => 11, PartnerPeer::UPDATED_AT => 12, PartnerPeer::ANONYMOUS_KUSER_ID => 13, PartnerPeer::KS_MAX_EXPIRY_IN_SECONDS => 14, PartnerPeer::CREATE_USER_ON_DEMAND => 15, PartnerPeer::PREFIX => 16, PartnerPeer::ADMIN_NAME => 17, PartnerPeer::ADMIN_EMAIL => 18, PartnerPeer::DESCRIPTION => 19, PartnerPeer::COMMERCIAL_USE => 20, PartnerPeer::MODERATE_CONTENT => 21, PartnerPeer::NOTIFY => 22, PartnerPeer::CUSTOM_DATA => 23, PartnerPeer::SERVICE_CONFIG_ID => 24, PartnerPeer::STATUS => 25, PartnerPeer::CONTENT_CATEGORIES => 26, PartnerPeer::TYPE => 27, PartnerPeer::PHONE => 28, PartnerPeer::DESCRIBE_YOURSELF => 29, PartnerPeer::ADULT_CONTENT => 30, PartnerPeer::PARTNER_PACKAGE => 31, PartnerPeer::USAGE_PERCENT => 32, PartnerPeer::STORAGE_USAGE => 33, PartnerPeer::EIGHTY_PERCENT_WARNING => 34, PartnerPeer::USAGE_LIMIT_WARNING => 35, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_name' => 1, 'partner_alias' => 2, 'url1' => 3, 'url2' => 4, 'secret' => 5, 'admin_secret' => 6, 'max_number_of_hits_per_day' => 7, 'appear_in_search' => 8, 'debug_level' => 9, 'invalid_login_count' => 10, 'created_at' => 11, 'updated_at' => 12, 'anonymous_kuser_id' => 13, 'ks_max_expiry_in_seconds' => 14, 'create_user_on_demand' => 15, 'prefix' => 16, 'admin_name' => 17, 'admin_email' => 18, 'description' => 19, 'commercial_use' => 20, 'moderate_content' => 21, 'notify' => 22, 'custom_data' => 23, 'service_config_id' => 24, 'status' => 25, 'content_categories' => 26, 'type' => 27, 'phone' => 28, 'describe_yourself' => 29, 'adult_content' => 30, 'partner_package' => 31, 'usage_percent' => 32, 'storage_usage' => 33, 'eighty_percent_warning' => 34, 'usage_limit_warning' => 35, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PartnerMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PartnerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PartnerPeer::getTableMap();
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
		return str_replace(PartnerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PartnerPeer::ID);

		$criteria->addSelectColumn(PartnerPeer::PARTNER_NAME);

		$criteria->addSelectColumn(PartnerPeer::PARTNER_ALIAS);

		$criteria->addSelectColumn(PartnerPeer::URL1);

		$criteria->addSelectColumn(PartnerPeer::URL2);

		$criteria->addSelectColumn(PartnerPeer::SECRET);

		$criteria->addSelectColumn(PartnerPeer::ADMIN_SECRET);

		$criteria->addSelectColumn(PartnerPeer::MAX_NUMBER_OF_HITS_PER_DAY);

		$criteria->addSelectColumn(PartnerPeer::APPEAR_IN_SEARCH);

		$criteria->addSelectColumn(PartnerPeer::DEBUG_LEVEL);

		$criteria->addSelectColumn(PartnerPeer::INVALID_LOGIN_COUNT);

		$criteria->addSelectColumn(PartnerPeer::CREATED_AT);

		$criteria->addSelectColumn(PartnerPeer::UPDATED_AT);

		$criteria->addSelectColumn(PartnerPeer::ANONYMOUS_KUSER_ID);

		$criteria->addSelectColumn(PartnerPeer::KS_MAX_EXPIRY_IN_SECONDS);

		$criteria->addSelectColumn(PartnerPeer::CREATE_USER_ON_DEMAND);

		$criteria->addSelectColumn(PartnerPeer::PREFIX);

		$criteria->addSelectColumn(PartnerPeer::ADMIN_NAME);

		$criteria->addSelectColumn(PartnerPeer::ADMIN_EMAIL);

		$criteria->addSelectColumn(PartnerPeer::DESCRIPTION);

		$criteria->addSelectColumn(PartnerPeer::COMMERCIAL_USE);

		$criteria->addSelectColumn(PartnerPeer::MODERATE_CONTENT);

		$criteria->addSelectColumn(PartnerPeer::NOTIFY);

		$criteria->addSelectColumn(PartnerPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(PartnerPeer::SERVICE_CONFIG_ID);

		$criteria->addSelectColumn(PartnerPeer::STATUS);

		$criteria->addSelectColumn(PartnerPeer::CONTENT_CATEGORIES);

		$criteria->addSelectColumn(PartnerPeer::TYPE);

		$criteria->addSelectColumn(PartnerPeer::PHONE);

		$criteria->addSelectColumn(PartnerPeer::DESCRIBE_YOURSELF);

		$criteria->addSelectColumn(PartnerPeer::ADULT_CONTENT);

		$criteria->addSelectColumn(PartnerPeer::PARTNER_PACKAGE);

		$criteria->addSelectColumn(PartnerPeer::USAGE_PERCENT);

		$criteria->addSelectColumn(PartnerPeer::STORAGE_USAGE);

		$criteria->addSelectColumn(PartnerPeer::EIGHTY_PERCENT_WARNING);

		$criteria->addSelectColumn(PartnerPeer::USAGE_LIMIT_WARNING);

	}

	const COUNT = 'COUNT(partner.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT partner.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PartnerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PartnerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PartnerPeer::doSelectRS($criteria, $con);
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
		$objects = PartnerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PartnerPeer::populateObjects(PartnerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PartnerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PartnerPeer::getOMClass();
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
			$criteria->addSelectColumn(PartnerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PartnerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PartnerPeer::ANONYMOUS_KUSER_ID, kuserPeer::ID);

		$rs = PartnerPeer::doSelectRS($criteria, $con);
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

		PartnerPeer::addSelectColumns($c);
		$startcol = (PartnerPeer::NUM_COLUMNS - PartnerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(PartnerPeer::ANONYMOUS_KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PartnerPeer::getOMClass();

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
										$temp_obj2->addPartner($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPartners();
				$obj2->addPartner($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PartnerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PartnerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PartnerPeer::ANONYMOUS_KUSER_ID, kuserPeer::ID);

		$rs = PartnerPeer::doSelectRS($criteria, $con);
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

		PartnerPeer::addSelectColumns($c);
		$startcol2 = (PartnerPeer::NUM_COLUMNS - PartnerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(PartnerPeer::ANONYMOUS_KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PartnerPeer::getOMClass();


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
					$temp_obj2->addPartner($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPartners();
				$obj2->addPartner($obj1);
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
		return PartnerPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PartnerPeer::ID); 

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
			$comparison = $criteria->getComparison(PartnerPeer::ID);
			$selectCriteria->add(PartnerPeer::ID, $criteria->remove(PartnerPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PartnerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PartnerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Partner) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PartnerPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Partner $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PartnerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PartnerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PartnerPeer::DATABASE_NAME, PartnerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PartnerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PartnerPeer::DATABASE_NAME);

		$criteria->add(PartnerPeer::ID, $pk);


		$v = PartnerPeer::doSelect($criteria, $con);

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
			$criteria->add(PartnerPeer::ID, $pks, Criteria::IN);
			$objs = PartnerPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePartnerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PartnerMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PartnerMapBuilder');
}
