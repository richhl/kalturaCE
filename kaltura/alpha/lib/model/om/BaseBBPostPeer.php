<?php


abstract class BaseBBPostPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'bb_post';

	
	const CLASS_DEFAULT = 'lib.model.BBPost';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'bb_post.ID';

	
	const TITLE = 'bb_post.TITLE';

	
	const CONTENT = 'bb_post.CONTENT';

	
	const CREATED_AT = 'bb_post.CREATED_AT';

	
	const UPDATED_AT = 'bb_post.UPDATED_AT';

	
	const KUSER_ID = 'bb_post.KUSER_ID';

	
	const FORUM_ID = 'bb_post.FORUM_ID';

	
	const PARENT_ID = 'bb_post.PARENT_ID';

	
	const NODE_LEVEL = 'bb_post.NODE_LEVEL';

	
	const NODE_ID = 'bb_post.NODE_ID';

	
	const NUM_CHILDERN = 'bb_post.NUM_CHILDERN';

	
	const LAST_CHILD = 'bb_post.LAST_CHILD';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Content', 'CreatedAt', 'UpdatedAt', 'KuserId', 'ForumId', 'ParentId', 'NodeLevel', 'NodeId', 'NumChildern', 'LastChild', ),
		BasePeer::TYPE_COLNAME => array (BBPostPeer::ID, BBPostPeer::TITLE, BBPostPeer::CONTENT, BBPostPeer::CREATED_AT, BBPostPeer::UPDATED_AT, BBPostPeer::KUSER_ID, BBPostPeer::FORUM_ID, BBPostPeer::PARENT_ID, BBPostPeer::NODE_LEVEL, BBPostPeer::NODE_ID, BBPostPeer::NUM_CHILDERN, BBPostPeer::LAST_CHILD, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'content', 'created_at', 'updated_at', 'kuser_id', 'forum_id', 'parent_id', 'node_level', 'node_id', 'num_childern', 'last_child', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Content' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'KuserId' => 5, 'ForumId' => 6, 'ParentId' => 7, 'NodeLevel' => 8, 'NodeId' => 9, 'NumChildern' => 10, 'LastChild' => 11, ),
		BasePeer::TYPE_COLNAME => array (BBPostPeer::ID => 0, BBPostPeer::TITLE => 1, BBPostPeer::CONTENT => 2, BBPostPeer::CREATED_AT => 3, BBPostPeer::UPDATED_AT => 4, BBPostPeer::KUSER_ID => 5, BBPostPeer::FORUM_ID => 6, BBPostPeer::PARENT_ID => 7, BBPostPeer::NODE_LEVEL => 8, BBPostPeer::NODE_ID => 9, BBPostPeer::NUM_CHILDERN => 10, BBPostPeer::LAST_CHILD => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'content' => 2, 'created_at' => 3, 'updated_at' => 4, 'kuser_id' => 5, 'forum_id' => 6, 'parent_id' => 7, 'node_level' => 8, 'node_id' => 9, 'num_childern' => 10, 'last_child' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/BBPostMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.BBPostMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = BBPostPeer::getTableMap();
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
		return str_replace(BBPostPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(BBPostPeer::ID);

		$criteria->addSelectColumn(BBPostPeer::TITLE);

		$criteria->addSelectColumn(BBPostPeer::CONTENT);

		$criteria->addSelectColumn(BBPostPeer::CREATED_AT);

		$criteria->addSelectColumn(BBPostPeer::UPDATED_AT);

		$criteria->addSelectColumn(BBPostPeer::KUSER_ID);

		$criteria->addSelectColumn(BBPostPeer::FORUM_ID);

		$criteria->addSelectColumn(BBPostPeer::PARENT_ID);

		$criteria->addSelectColumn(BBPostPeer::NODE_LEVEL);

		$criteria->addSelectColumn(BBPostPeer::NODE_ID);

		$criteria->addSelectColumn(BBPostPeer::NUM_CHILDERN);

		$criteria->addSelectColumn(BBPostPeer::LAST_CHILD);

	}

	const COUNT = 'COUNT(bb_post.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT bb_post.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = BBPostPeer::doSelectRS($criteria, $con);
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
		$objects = BBPostPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return BBPostPeer::populateObjects(BBPostPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			BBPostPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = BBPostPeer::getOMClass();
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
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);

		$rs = BBPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinBBForum(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);

		$rs = BBPostPeer::doSelectRS($criteria, $con);
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

		BBPostPeer::addSelectColumns($c);
		$startcol = (BBPostPeer::NUM_COLUMNS - BBPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBPostPeer::getOMClass();

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
										$temp_obj2->addBBPost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initBBPosts();
				$obj2->addBBPost($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinBBForum(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BBPostPeer::addSelectColumns($c);
		$startcol = (BBPostPeer::NUM_COLUMNS - BBPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BBForumPeer::addSelectColumns($c);

		$c->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBPostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BBForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getBBForum(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addBBPost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initBBPosts();
				$obj2->addBBPost($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);

		$criteria->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);

		$rs = BBPostPeer::doSelectRS($criteria, $con);
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

		BBPostPeer::addSelectColumns($c);
		$startcol2 = (BBPostPeer::NUM_COLUMNS - BBPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		BBForumPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + BBForumPeer::NUM_COLUMNS;

		$c->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);

		$c->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBPostPeer::getOMClass();


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
					$temp_obj2->addBBPost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initBBPosts();
				$obj2->addBBPost($obj1);
			}


					
			$omClass = BBForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getBBForum(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addBBPost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initBBPosts();
				$obj3->addBBPost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);

		$rs = BBPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptBBForum(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);

		$rs = BBPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptBBPostRelatedByParentId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BBPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BBPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);

		$criteria->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);

		$rs = BBPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BBPostPeer::addSelectColumns($c);
		$startcol2 = (BBPostPeer::NUM_COLUMNS - BBPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		BBForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + BBForumPeer::NUM_COLUMNS;

		$c->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBPostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BBForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getBBForum(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addBBPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initBBPosts();
				$obj2->addBBPost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptBBForum(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BBPostPeer::addSelectColumns($c);
		$startcol2 = (BBPostPeer::NUM_COLUMNS - BBPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBPostPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addBBPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initBBPosts();
				$obj2->addBBPost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptBBPostRelatedByParentId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BBPostPeer::addSelectColumns($c);
		$startcol2 = (BBPostPeer::NUM_COLUMNS - BBPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		BBForumPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + BBForumPeer::NUM_COLUMNS;

		$c->addJoin(BBPostPeer::KUSER_ID, kuserPeer::ID);

		$c->addJoin(BBPostPeer::FORUM_ID, BBForumPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BBPostPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addBBPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initBBPosts();
				$obj2->addBBPost($obj1);
			}

			$omClass = BBForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getBBForum(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addBBPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initBBPosts();
				$obj3->addBBPost($obj1);
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
		return BBPostPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(BBPostPeer::ID); 

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
			$comparison = $criteria->getComparison(BBPostPeer::ID);
			$selectCriteria->add(BBPostPeer::ID, $criteria->remove(BBPostPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(BBPostPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(BBPostPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof BBPost) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(BBPostPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(BBPost $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(BBPostPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(BBPostPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(BBPostPeer::DATABASE_NAME, BBPostPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = BBPostPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(BBPostPeer::DATABASE_NAME);

		$criteria->add(BBPostPeer::ID, $pk);


		$v = BBPostPeer::doSelect($criteria, $con);

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
			$criteria->add(BBPostPeer::ID, $pks, Criteria::IN);
			$objs = BBPostPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseBBPostPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/BBPostMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.BBPostMapBuilder');
}
