<?php


abstract class BasemoderationFlagPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'moderation_flag';

	
	const CLASS_DEFAULT = 'lib.model.moderationFlag';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'moderation_flag.ID';

	
	const PARTNER_ID = 'moderation_flag.PARTNER_ID';

	
	const KUSER_ID = 'moderation_flag.KUSER_ID';

	
	const OBJECT_TYPE = 'moderation_flag.OBJECT_TYPE';

	
	const FLAGGED_ENTRY_ID = 'moderation_flag.FLAGGED_ENTRY_ID';

	
	const FLAGGED_KUSER_ID = 'moderation_flag.FLAGGED_KUSER_ID';

	
	const STATUS = 'moderation_flag.STATUS';

	
	const CREATED_AT = 'moderation_flag.CREATED_AT';

	
	const UPDATED_AT = 'moderation_flag.UPDATED_AT';

	
	const COMMENTS = 'moderation_flag.COMMENTS';

	
	const FLAG_TYPE = 'moderation_flag.FLAG_TYPE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'KuserId', 'ObjectType', 'FlaggedEntryId', 'FlaggedKuserId', 'Status', 'CreatedAt', 'UpdatedAt', 'Comments', 'FlagType', ),
		BasePeer::TYPE_COLNAME => array (moderationFlagPeer::ID, moderationFlagPeer::PARTNER_ID, moderationFlagPeer::KUSER_ID, moderationFlagPeer::OBJECT_TYPE, moderationFlagPeer::FLAGGED_ENTRY_ID, moderationFlagPeer::FLAGGED_KUSER_ID, moderationFlagPeer::STATUS, moderationFlagPeer::CREATED_AT, moderationFlagPeer::UPDATED_AT, moderationFlagPeer::COMMENTS, moderationFlagPeer::FLAG_TYPE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'kuser_id', 'object_type', 'flagged_entry_id', 'flagged_kuser_id', 'status', 'created_at', 'updated_at', 'comments', 'flag_type', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'KuserId' => 2, 'ObjectType' => 3, 'FlaggedEntryId' => 4, 'FlaggedKuserId' => 5, 'Status' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'Comments' => 9, 'FlagType' => 10, ),
		BasePeer::TYPE_COLNAME => array (moderationFlagPeer::ID => 0, moderationFlagPeer::PARTNER_ID => 1, moderationFlagPeer::KUSER_ID => 2, moderationFlagPeer::OBJECT_TYPE => 3, moderationFlagPeer::FLAGGED_ENTRY_ID => 4, moderationFlagPeer::FLAGGED_KUSER_ID => 5, moderationFlagPeer::STATUS => 6, moderationFlagPeer::CREATED_AT => 7, moderationFlagPeer::UPDATED_AT => 8, moderationFlagPeer::COMMENTS => 9, moderationFlagPeer::FLAG_TYPE => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'kuser_id' => 2, 'object_type' => 3, 'flagged_entry_id' => 4, 'flagged_kuser_id' => 5, 'status' => 6, 'created_at' => 7, 'updated_at' => 8, 'comments' => 9, 'flag_type' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/moderationFlagMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.moderationFlagMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = moderationFlagPeer::getTableMap();
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
		return str_replace(moderationFlagPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(moderationFlagPeer::ID);

		$criteria->addSelectColumn(moderationFlagPeer::PARTNER_ID);

		$criteria->addSelectColumn(moderationFlagPeer::KUSER_ID);

		$criteria->addSelectColumn(moderationFlagPeer::OBJECT_TYPE);

		$criteria->addSelectColumn(moderationFlagPeer::FLAGGED_ENTRY_ID);

		$criteria->addSelectColumn(moderationFlagPeer::FLAGGED_KUSER_ID);

		$criteria->addSelectColumn(moderationFlagPeer::STATUS);

		$criteria->addSelectColumn(moderationFlagPeer::CREATED_AT);

		$criteria->addSelectColumn(moderationFlagPeer::UPDATED_AT);

		$criteria->addSelectColumn(moderationFlagPeer::COMMENTS);

		$criteria->addSelectColumn(moderationFlagPeer::FLAG_TYPE);

	}

	const COUNT = 'COUNT(moderation_flag.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT moderation_flag.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
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
		$objects = moderationFlagPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return moderationFlagPeer::populateObjects(moderationFlagPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			moderationFlagPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = moderationFlagPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinkuserRelatedByKuserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::KUSER_ID, kuserPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinkuserRelatedByFlaggedKuserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::FLAGGED_KUSER_ID, kuserPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinkuserRelatedByKuserId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		moderationFlagPeer::addSelectColumns($c);
		$startcol = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(moderationFlagPeer::KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getkuserRelatedByKuserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addmoderationFlagRelatedByKuserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initmoderationFlagsRelatedByKuserId();
				$obj2->addmoderationFlagRelatedByKuserId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinentry(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		moderationFlagPeer::addSelectColumns($c);
		$startcol = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();

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
										$temp_obj2->addmoderationFlag($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initmoderationFlags();
				$obj2->addmoderationFlag($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinkuserRelatedByFlaggedKuserId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		moderationFlagPeer::addSelectColumns($c);
		$startcol = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(moderationFlagPeer::FLAGGED_KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getkuserRelatedByFlaggedKuserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addmoderationFlagRelatedByFlaggedKuserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initmoderationFlagsRelatedByFlaggedKuserId();
				$obj2->addmoderationFlagRelatedByFlaggedKuserId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::KUSER_ID, kuserPeer::ID);

		$criteria->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(moderationFlagPeer::FLAGGED_KUSER_ID, kuserPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
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

		moderationFlagPeer::addSelectColumns($c);
		$startcol2 = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		kuserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(moderationFlagPeer::KUSER_ID, kuserPeer::ID);

		$c->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);

		$c->addJoin(moderationFlagPeer::FLAGGED_KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getkuserRelatedByKuserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addmoderationFlagRelatedByKuserId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initmoderationFlagsRelatedByKuserId();
				$obj2->addmoderationFlagRelatedByKuserId($obj1);
			}


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getentry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addmoderationFlag($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initmoderationFlags();
				$obj3->addmoderationFlag($obj1);
			}


					
			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getkuserRelatedByFlaggedKuserId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addmoderationFlagRelatedByFlaggedKuserId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initmoderationFlagsRelatedByFlaggedKuserId();
				$obj4->addmoderationFlagRelatedByFlaggedKuserId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptkuserRelatedByKuserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::KUSER_ID, kuserPeer::ID);

		$criteria->addJoin(moderationFlagPeer::FLAGGED_KUSER_ID, kuserPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptkuserRelatedByFlaggedKuserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(moderationFlagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);

		$rs = moderationFlagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptkuserRelatedByKuserId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		moderationFlagPeer::addSelectColumns($c);
		$startcol2 = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		$c->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addmoderationFlag($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initmoderationFlags();
				$obj2->addmoderationFlag($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptentry(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		moderationFlagPeer::addSelectColumns($c);
		$startcol2 = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		kuserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(moderationFlagPeer::KUSER_ID, kuserPeer::ID);

		$c->addJoin(moderationFlagPeer::FLAGGED_KUSER_ID, kuserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkuserRelatedByKuserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addmoderationFlagRelatedByKuserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initmoderationFlagsRelatedByKuserId();
				$obj2->addmoderationFlagRelatedByKuserId($obj1);
			}

			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getkuserRelatedByFlaggedKuserId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addmoderationFlagRelatedByFlaggedKuserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initmoderationFlagsRelatedByFlaggedKuserId();
				$obj3->addmoderationFlagRelatedByFlaggedKuserId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptkuserRelatedByFlaggedKuserId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		moderationFlagPeer::addSelectColumns($c);
		$startcol2 = (moderationFlagPeer::NUM_COLUMNS - moderationFlagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		$c->addJoin(moderationFlagPeer::FLAGGED_ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = moderationFlagPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addmoderationFlag($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initmoderationFlags();
				$obj2->addmoderationFlag($obj1);
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
		return moderationFlagPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(moderationFlagPeer::ID); 

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
			$comparison = $criteria->getComparison(moderationFlagPeer::ID);
			$selectCriteria->add(moderationFlagPeer::ID, $criteria->remove(moderationFlagPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(moderationFlagPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(moderationFlagPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof moderationFlag) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(moderationFlagPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(moderationFlag $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(moderationFlagPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(moderationFlagPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(moderationFlagPeer::DATABASE_NAME, moderationFlagPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = moderationFlagPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(moderationFlagPeer::DATABASE_NAME);

		$criteria->add(moderationFlagPeer::ID, $pk);


		$v = moderationFlagPeer::doSelect($criteria, $con);

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
			$criteria->add(moderationFlagPeer::ID, $pks, Criteria::IN);
			$objs = moderationFlagPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasemoderationFlagPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/moderationFlagMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.moderationFlagMapBuilder');
}
