<?php


abstract class BasePuserRolePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'puser_role';

	
	const CLASS_DEFAULT = 'lib.model.PuserRole';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'puser_role.ID';

	
	const KSHOW_ID = 'puser_role.KSHOW_ID';

	
	const PARTNER_ID = 'puser_role.PARTNER_ID';

	
	const PUSER_ID = 'puser_role.PUSER_ID';

	
	const ROLE = 'puser_role.ROLE';

	
	const CREATED_AT = 'puser_role.CREATED_AT';

	
	const UPDATED_AT = 'puser_role.UPDATED_AT';

	
	const SUBP_ID = 'puser_role.SUBP_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'KshowId', 'PartnerId', 'PuserId', 'Role', 'CreatedAt', 'UpdatedAt', 'SubpId', ),
		BasePeer::TYPE_COLNAME => array (PuserRolePeer::ID, PuserRolePeer::KSHOW_ID, PuserRolePeer::PARTNER_ID, PuserRolePeer::PUSER_ID, PuserRolePeer::ROLE, PuserRolePeer::CREATED_AT, PuserRolePeer::UPDATED_AT, PuserRolePeer::SUBP_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'kshow_id', 'partner_id', 'puser_id', 'role', 'created_at', 'updated_at', 'subp_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'KshowId' => 1, 'PartnerId' => 2, 'PuserId' => 3, 'Role' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'SubpId' => 7, ),
		BasePeer::TYPE_COLNAME => array (PuserRolePeer::ID => 0, PuserRolePeer::KSHOW_ID => 1, PuserRolePeer::PARTNER_ID => 2, PuserRolePeer::PUSER_ID => 3, PuserRolePeer::ROLE => 4, PuserRolePeer::CREATED_AT => 5, PuserRolePeer::UPDATED_AT => 6, PuserRolePeer::SUBP_ID => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'kshow_id' => 1, 'partner_id' => 2, 'puser_id' => 3, 'role' => 4, 'created_at' => 5, 'updated_at' => 6, 'subp_id' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PuserRoleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PuserRoleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PuserRolePeer::getTableMap();
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
		return str_replace(PuserRolePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PuserRolePeer::ID);

		$criteria->addSelectColumn(PuserRolePeer::KSHOW_ID);

		$criteria->addSelectColumn(PuserRolePeer::PARTNER_ID);

		$criteria->addSelectColumn(PuserRolePeer::PUSER_ID);

		$criteria->addSelectColumn(PuserRolePeer::ROLE);

		$criteria->addSelectColumn(PuserRolePeer::CREATED_AT);

		$criteria->addSelectColumn(PuserRolePeer::UPDATED_AT);

		$criteria->addSelectColumn(PuserRolePeer::SUBP_ID);

	}

	const COUNT = 'COUNT(puser_role.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT puser_role.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
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
		$objects = PuserRolePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PuserRolePeer::populateObjects(PuserRolePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PuserRolePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PuserRolePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinkshow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinPuserKuserRelatedByPartnerId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::PARTNER_ID, PuserKuserPeer::PARTNER_ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinPuserKuserRelatedByPuserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::PUSER_ID, PuserKuserPeer::PUSER_ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinkshow(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserRolePeer::addSelectColumns($c);
		$startcol = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kshowPeer::addSelectColumns($c);

		$c->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kshowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPuserRole($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPuserRoles();
				$obj2->addPuserRole($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinPuserKuserRelatedByPartnerId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserRolePeer::addSelectColumns($c);
		$startcol = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PuserKuserPeer::addSelectColumns($c);

		$c->addJoin(PuserRolePeer::PARTNER_ID, PuserKuserPeer::PARTNER_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PuserKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPuserKuserRelatedByPartnerId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPuserRoleRelatedByPartnerId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPuserRolesRelatedByPartnerId();
				$obj2->addPuserRoleRelatedByPartnerId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinPuserKuserRelatedByPuserId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserRolePeer::addSelectColumns($c);
		$startcol = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PuserKuserPeer::addSelectColumns($c);

		$c->addJoin(PuserRolePeer::PUSER_ID, PuserKuserPeer::PUSER_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PuserKuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPuserKuserRelatedByPuserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPuserRoleRelatedByPuserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPuserRolesRelatedByPuserId();
				$obj2->addPuserRoleRelatedByPuserId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(PuserRolePeer::PARTNER_ID, PuserKuserPeer::PARTNER_ID);

		$criteria->addJoin(PuserRolePeer::PUSER_ID, PuserKuserPeer::PUSER_ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
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

		PuserRolePeer::addSelectColumns($c);
		$startcol2 = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		PuserKuserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PuserKuserPeer::NUM_COLUMNS;

		PuserKuserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PuserKuserPeer::NUM_COLUMNS;

		$c->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(PuserRolePeer::PARTNER_ID, PuserKuserPeer::PARTNER_ID);

		$c->addJoin(PuserRolePeer::PUSER_ID, PuserKuserPeer::PUSER_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPuserRole($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPuserRoles();
				$obj2->addPuserRole($obj1);
			}


					
			$omClass = PuserKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPuserKuserRelatedByPartnerId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPuserRoleRelatedByPartnerId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPuserRolesRelatedByPartnerId();
				$obj3->addPuserRoleRelatedByPartnerId($obj1);
			}


					
			$omClass = PuserKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPuserKuserRelatedByPuserId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPuserRoleRelatedByPuserId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initPuserRolesRelatedByPuserId();
				$obj4->addPuserRoleRelatedByPuserId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptkshow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::PARTNER_ID, PuserKuserPeer::PARTNER_ID);

		$criteria->addJoin(PuserRolePeer::PUSER_ID, PuserKuserPeer::PUSER_ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptPuserKuserRelatedByPartnerId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptPuserKuserRelatedByPuserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PuserRolePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PuserRolePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);

		$rs = PuserRolePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptkshow(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserRolePeer::addSelectColumns($c);
		$startcol2 = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PuserKuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PuserKuserPeer::NUM_COLUMNS;

		PuserKuserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PuserKuserPeer::NUM_COLUMNS;

		$c->addJoin(PuserRolePeer::PARTNER_ID, PuserKuserPeer::PARTNER_ID);

		$c->addJoin(PuserRolePeer::PUSER_ID, PuserKuserPeer::PUSER_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PuserKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPuserKuserRelatedByPartnerId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPuserRoleRelatedByPartnerId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPuserRolesRelatedByPartnerId();
				$obj2->addPuserRoleRelatedByPartnerId($obj1);
			}

			$omClass = PuserKuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPuserKuserRelatedByPuserId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPuserRoleRelatedByPuserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPuserRolesRelatedByPuserId();
				$obj3->addPuserRoleRelatedByPuserId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptPuserKuserRelatedByPartnerId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserRolePeer::addSelectColumns($c);
		$startcol2 = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		$c->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPuserRole($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPuserRoles();
				$obj2->addPuserRole($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptPuserKuserRelatedByPuserId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PuserRolePeer::addSelectColumns($c);
		$startcol2 = (PuserRolePeer::NUM_COLUMNS - PuserRolePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		$c->addJoin(PuserRolePeer::KSHOW_ID, kshowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PuserRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkshow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPuserRole($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPuserRoles();
				$obj2->addPuserRole($obj1);
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
		return PuserRolePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PuserRolePeer::ID); 

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
			$comparison = $criteria->getComparison(PuserRolePeer::ID);
			$selectCriteria->add(PuserRolePeer::ID, $criteria->remove(PuserRolePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PuserRolePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PuserRolePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PuserRole) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PuserRolePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PuserRole $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PuserRolePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PuserRolePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PuserRolePeer::DATABASE_NAME, PuserRolePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PuserRolePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PuserRolePeer::DATABASE_NAME);

		$criteria->add(PuserRolePeer::ID, $pk);


		$v = PuserRolePeer::doSelect($criteria, $con);

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
			$criteria->add(PuserRolePeer::ID, $pks, Criteria::IN);
			$objs = PuserRolePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePuserRolePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PuserRoleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PuserRoleMapBuilder');
}
