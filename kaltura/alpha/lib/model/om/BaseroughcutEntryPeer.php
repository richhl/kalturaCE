<?php


abstract class BaseroughcutEntryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'roughcut_entry';

	
	const CLASS_DEFAULT = 'lib.model.roughcutEntry';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'roughcut_entry.ID';

	
	const ROUGHCUT_ID = 'roughcut_entry.ROUGHCUT_ID';

	
	const ROUGHCUT_VERSION = 'roughcut_entry.ROUGHCUT_VERSION';

	
	const ROUGHCUT_KSHOW_ID = 'roughcut_entry.ROUGHCUT_KSHOW_ID';

	
	const ENTRY_ID = 'roughcut_entry.ENTRY_ID';

	
	const PARTNER_ID = 'roughcut_entry.PARTNER_ID';

	
	const OP_TYPE = 'roughcut_entry.OP_TYPE';

	
	const CREATED_AT = 'roughcut_entry.CREATED_AT';

	
	const UPDATED_AT = 'roughcut_entry.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'RoughcutId', 'RoughcutVersion', 'RoughcutKshowId', 'EntryId', 'PartnerId', 'OpType', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (roughcutEntryPeer::ID, roughcutEntryPeer::ROUGHCUT_ID, roughcutEntryPeer::ROUGHCUT_VERSION, roughcutEntryPeer::ROUGHCUT_KSHOW_ID, roughcutEntryPeer::ENTRY_ID, roughcutEntryPeer::PARTNER_ID, roughcutEntryPeer::OP_TYPE, roughcutEntryPeer::CREATED_AT, roughcutEntryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'roughcut_id', 'roughcut_version', 'roughcut_kshow_id', 'entry_id', 'partner_id', 'op_type', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'RoughcutId' => 1, 'RoughcutVersion' => 2, 'RoughcutKshowId' => 3, 'EntryId' => 4, 'PartnerId' => 5, 'OpType' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (roughcutEntryPeer::ID => 0, roughcutEntryPeer::ROUGHCUT_ID => 1, roughcutEntryPeer::ROUGHCUT_VERSION => 2, roughcutEntryPeer::ROUGHCUT_KSHOW_ID => 3, roughcutEntryPeer::ENTRY_ID => 4, roughcutEntryPeer::PARTNER_ID => 5, roughcutEntryPeer::OP_TYPE => 6, roughcutEntryPeer::CREATED_AT => 7, roughcutEntryPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'roughcut_id' => 1, 'roughcut_version' => 2, 'roughcut_kshow_id' => 3, 'entry_id' => 4, 'partner_id' => 5, 'op_type' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/roughcutEntryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.roughcutEntryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = roughcutEntryPeer::getTableMap();
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
		return str_replace(roughcutEntryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(roughcutEntryPeer::ID);

		$criteria->addSelectColumn(roughcutEntryPeer::ROUGHCUT_ID);

		$criteria->addSelectColumn(roughcutEntryPeer::ROUGHCUT_VERSION);

		$criteria->addSelectColumn(roughcutEntryPeer::ROUGHCUT_KSHOW_ID);

		$criteria->addSelectColumn(roughcutEntryPeer::ENTRY_ID);

		$criteria->addSelectColumn(roughcutEntryPeer::PARTNER_ID);

		$criteria->addSelectColumn(roughcutEntryPeer::OP_TYPE);

		$criteria->addSelectColumn(roughcutEntryPeer::CREATED_AT);

		$criteria->addSelectColumn(roughcutEntryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(roughcut_entry.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT roughcut_entry.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
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
		$objects = roughcutEntryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return roughcutEntryPeer::populateObjects(roughcutEntryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			roughcutEntryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = roughcutEntryPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinentryRelatedByRoughcutId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_ID, entryPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinkshow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinentryRelatedByEntryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ENTRY_ID, entryPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinentryRelatedByRoughcutId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		roughcutEntryPeer::addSelectColumns($c);
		$startcol = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getentryRelatedByRoughcutId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addroughcutEntryRelatedByRoughcutId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initroughcutEntrysRelatedByRoughcutId();
				$obj2->addroughcutEntryRelatedByRoughcutId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinkshow(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		roughcutEntryPeer::addSelectColumns($c);
		$startcol = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kshowPeer::addSelectColumns($c);

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();

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
										$temp_obj2->addroughcutEntry($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initroughcutEntrys();
				$obj2->addroughcutEntry($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinentryRelatedByEntryId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		roughcutEntryPeer::addSelectColumns($c);
		$startcol = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(roughcutEntryPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getentryRelatedByEntryId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addroughcutEntryRelatedByEntryId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initroughcutEntrysRelatedByEntryId();
				$obj2->addroughcutEntryRelatedByEntryId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_ID, entryPeer::ID);

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(roughcutEntryPeer::ENTRY_ID, entryPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
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

		roughcutEntryPeer::addSelectColumns($c);
		$startcol2 = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		kshowPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kshowPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + entryPeer::NUM_COLUMNS;

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_ID, entryPeer::ID);

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);

		$c->addJoin(roughcutEntryPeer::ENTRY_ID, entryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getentryRelatedByRoughcutId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addroughcutEntryRelatedByRoughcutId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initroughcutEntrysRelatedByRoughcutId();
				$obj2->addroughcutEntryRelatedByRoughcutId($obj1);
			}


					
			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getkshow(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addroughcutEntry($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initroughcutEntrys();
				$obj3->addroughcutEntry($obj1);
			}


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getentryRelatedByEntryId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addroughcutEntryRelatedByEntryId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initroughcutEntrysRelatedByEntryId();
				$obj4->addroughcutEntryRelatedByEntryId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptentryRelatedByRoughcutId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptkshow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_ID, entryPeer::ID);

		$criteria->addJoin(roughcutEntryPeer::ENTRY_ID, entryPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptentryRelatedByEntryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(roughcutEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);

		$rs = roughcutEntryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptentryRelatedByRoughcutId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		roughcutEntryPeer::addSelectColumns($c);
		$startcol2 = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();

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
					$temp_obj2->addroughcutEntry($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initroughcutEntrys();
				$obj2->addroughcutEntry($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptkshow(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		roughcutEntryPeer::addSelectColumns($c);
		$startcol2 = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_ID, entryPeer::ID);

		$c->addJoin(roughcutEntryPeer::ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getentryRelatedByRoughcutId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addroughcutEntryRelatedByRoughcutId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initroughcutEntrysRelatedByRoughcutId();
				$obj2->addroughcutEntryRelatedByRoughcutId($obj1);
			}

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getentryRelatedByEntryId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addroughcutEntryRelatedByEntryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initroughcutEntrysRelatedByEntryId();
				$obj3->addroughcutEntryRelatedByEntryId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptentryRelatedByEntryId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		roughcutEntryPeer::addSelectColumns($c);
		$startcol2 = (roughcutEntryPeer::NUM_COLUMNS - roughcutEntryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		$c->addJoin(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, kshowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = roughcutEntryPeer::getOMClass();

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
					$temp_obj2->addroughcutEntry($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initroughcutEntrys();
				$obj2->addroughcutEntry($obj1);
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
		return roughcutEntryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(roughcutEntryPeer::ID); 

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
			$comparison = $criteria->getComparison(roughcutEntryPeer::ID);
			$selectCriteria->add(roughcutEntryPeer::ID, $criteria->remove(roughcutEntryPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(roughcutEntryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(roughcutEntryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof roughcutEntry) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(roughcutEntryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(roughcutEntry $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(roughcutEntryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(roughcutEntryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(roughcutEntryPeer::DATABASE_NAME, roughcutEntryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = roughcutEntryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(roughcutEntryPeer::DATABASE_NAME);

		$criteria->add(roughcutEntryPeer::ID, $pk);


		$v = roughcutEntryPeer::doSelect($criteria, $con);

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
			$criteria->add(roughcutEntryPeer::ID, $pks, Criteria::IN);
			$objs = roughcutEntryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseroughcutEntryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/roughcutEntryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.roughcutEntryMapBuilder');
}
