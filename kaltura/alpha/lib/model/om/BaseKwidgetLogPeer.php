<?php


abstract class BaseKwidgetLogPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'kwidget_log';

	
	const CLASS_DEFAULT = 'lib.model.KwidgetLog';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'kwidget_log.ID';

	
	const WIDGET_ID = 'kwidget_log.WIDGET_ID';

	
	const SOURCE_WIDGET_ID = 'kwidget_log.SOURCE_WIDGET_ID';

	
	const ROOT_WIDGET_ID = 'kwidget_log.ROOT_WIDGET_ID';

	
	const KSHOW_ID = 'kwidget_log.KSHOW_ID';

	
	const ENTRY_ID = 'kwidget_log.ENTRY_ID';

	
	const UI_CONF_ID = 'kwidget_log.UI_CONF_ID';

	
	const REFERER = 'kwidget_log.REFERER';

	
	const VIEWS = 'kwidget_log.VIEWS';

	
	const IP1 = 'kwidget_log.IP1';

	
	const IP1_COUNT = 'kwidget_log.IP1_COUNT';

	
	const IP2 = 'kwidget_log.IP2';

	
	const IP2_COUNT = 'kwidget_log.IP2_COUNT';

	
	const CREATED_AT = 'kwidget_log.CREATED_AT';

	
	const UPDATED_AT = 'kwidget_log.UPDATED_AT';

	
	const PLAYS = 'kwidget_log.PLAYS';

	
	const PARTNER_ID = 'kwidget_log.PARTNER_ID';

	
	const SUBP_ID = 'kwidget_log.SUBP_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'WidgetId', 'SourceWidgetId', 'RootWidgetId', 'KshowId', 'EntryId', 'UiConfId', 'Referer', 'Views', 'Ip1', 'Ip1Count', 'Ip2', 'Ip2Count', 'CreatedAt', 'UpdatedAt', 'Plays', 'PartnerId', 'SubpId', ),
		BasePeer::TYPE_COLNAME => array (KwidgetLogPeer::ID, KwidgetLogPeer::WIDGET_ID, KwidgetLogPeer::SOURCE_WIDGET_ID, KwidgetLogPeer::ROOT_WIDGET_ID, KwidgetLogPeer::KSHOW_ID, KwidgetLogPeer::ENTRY_ID, KwidgetLogPeer::UI_CONF_ID, KwidgetLogPeer::REFERER, KwidgetLogPeer::VIEWS, KwidgetLogPeer::IP1, KwidgetLogPeer::IP1_COUNT, KwidgetLogPeer::IP2, KwidgetLogPeer::IP2_COUNT, KwidgetLogPeer::CREATED_AT, KwidgetLogPeer::UPDATED_AT, KwidgetLogPeer::PLAYS, KwidgetLogPeer::PARTNER_ID, KwidgetLogPeer::SUBP_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'widget_id', 'source_widget_id', 'root_widget_id', 'kshow_id', 'entry_id', 'ui_conf_id', 'referer', 'views', 'ip1', 'ip1_count', 'ip2', 'ip2_count', 'created_at', 'updated_at', 'plays', 'partner_id', 'subp_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'WidgetId' => 1, 'SourceWidgetId' => 2, 'RootWidgetId' => 3, 'KshowId' => 4, 'EntryId' => 5, 'UiConfId' => 6, 'Referer' => 7, 'Views' => 8, 'Ip1' => 9, 'Ip1Count' => 10, 'Ip2' => 11, 'Ip2Count' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, 'Plays' => 15, 'PartnerId' => 16, 'SubpId' => 17, ),
		BasePeer::TYPE_COLNAME => array (KwidgetLogPeer::ID => 0, KwidgetLogPeer::WIDGET_ID => 1, KwidgetLogPeer::SOURCE_WIDGET_ID => 2, KwidgetLogPeer::ROOT_WIDGET_ID => 3, KwidgetLogPeer::KSHOW_ID => 4, KwidgetLogPeer::ENTRY_ID => 5, KwidgetLogPeer::UI_CONF_ID => 6, KwidgetLogPeer::REFERER => 7, KwidgetLogPeer::VIEWS => 8, KwidgetLogPeer::IP1 => 9, KwidgetLogPeer::IP1_COUNT => 10, KwidgetLogPeer::IP2 => 11, KwidgetLogPeer::IP2_COUNT => 12, KwidgetLogPeer::CREATED_AT => 13, KwidgetLogPeer::UPDATED_AT => 14, KwidgetLogPeer::PLAYS => 15, KwidgetLogPeer::PARTNER_ID => 16, KwidgetLogPeer::SUBP_ID => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'widget_id' => 1, 'source_widget_id' => 2, 'root_widget_id' => 3, 'kshow_id' => 4, 'entry_id' => 5, 'ui_conf_id' => 6, 'referer' => 7, 'views' => 8, 'ip1' => 9, 'ip1_count' => 10, 'ip2' => 11, 'ip2_count' => 12, 'created_at' => 13, 'updated_at' => 14, 'plays' => 15, 'partner_id' => 16, 'subp_id' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/KwidgetLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.KwidgetLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = KwidgetLogPeer::getTableMap();
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
		return str_replace(KwidgetLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(KwidgetLogPeer::ID);

		$criteria->addSelectColumn(KwidgetLogPeer::WIDGET_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::SOURCE_WIDGET_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::ROOT_WIDGET_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::KSHOW_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::ENTRY_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::UI_CONF_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::REFERER);

		$criteria->addSelectColumn(KwidgetLogPeer::VIEWS);

		$criteria->addSelectColumn(KwidgetLogPeer::IP1);

		$criteria->addSelectColumn(KwidgetLogPeer::IP1_COUNT);

		$criteria->addSelectColumn(KwidgetLogPeer::IP2);

		$criteria->addSelectColumn(KwidgetLogPeer::IP2_COUNT);

		$criteria->addSelectColumn(KwidgetLogPeer::CREATED_AT);

		$criteria->addSelectColumn(KwidgetLogPeer::UPDATED_AT);

		$criteria->addSelectColumn(KwidgetLogPeer::PLAYS);

		$criteria->addSelectColumn(KwidgetLogPeer::PARTNER_ID);

		$criteria->addSelectColumn(KwidgetLogPeer::SUBP_ID);

	}

	const COUNT = 'COUNT(kwidget_log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT kwidget_log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
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
		$objects = KwidgetLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return KwidgetLogPeer::populateObjects(KwidgetLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			KwidgetLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = KwidgetLogPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinwidget(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinuiConf(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinwidget(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KwidgetLogPeer::addSelectColumns($c);
		$startcol = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		widgetPeer::addSelectColumns($c);

		$c->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = widgetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getwidget(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addKwidgetLog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1); 			}
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

		KwidgetLogPeer::addSelectColumns($c);
		$startcol = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kshowPeer::addSelectColumns($c);

		$c->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

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
										$temp_obj2->addKwidgetLog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1); 			}
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

		KwidgetLogPeer::addSelectColumns($c);
		$startcol = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

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
										$temp_obj2->addKwidgetLog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinuiConf(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KwidgetLogPeer::addSelectColumns($c);
		$startcol = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		uiConfPeer::addSelectColumns($c);

		$c->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = uiConfPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getuiConf(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addKwidgetLog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
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

		KwidgetLogPeer::addSelectColumns($c);
		$startcol2 = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		widgetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + widgetPeer::NUM_COLUMNS;

		kshowPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kshowPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + entryPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$c->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = widgetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getwidget(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKwidgetLog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1);
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
					$temp_obj3->addKwidgetLog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initKwidgetLogs();
				$obj3->addKwidgetLog($obj1);
			}


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getentry(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addKwidgetLog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initKwidgetLogs();
				$obj4->addKwidgetLog($obj1);
			}


					
			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getuiConf(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addKwidgetLog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initKwidgetLogs();
				$obj5->addKwidgetLog($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptwidget(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptuiConf(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(KwidgetLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$rs = KwidgetLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptwidget(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KwidgetLogPeer::addSelectColumns($c);
		$startcol2 = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

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
					$temp_obj2->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1);
			}

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getentry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initKwidgetLogs();
				$obj3->addKwidgetLog($obj1);
			}

			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getuiConf(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initKwidgetLogs();
				$obj4->addKwidgetLog($obj1);
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

		KwidgetLogPeer::addSelectColumns($c);
		$startcol2 = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		widgetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + widgetPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$c->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = widgetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getwidget(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1);
			}

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getentry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initKwidgetLogs();
				$obj3->addKwidgetLog($obj1);
			}

			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getuiConf(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initKwidgetLogs();
				$obj4->addKwidgetLog($obj1);
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

		KwidgetLogPeer::addSelectColumns($c);
		$startcol2 = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		widgetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + widgetPeer::NUM_COLUMNS;

		kshowPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kshowPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$c->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(KwidgetLogPeer::UI_CONF_ID, uiConfPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = widgetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getwidget(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1);
			}

			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getkshow(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initKwidgetLogs();
				$obj3->addKwidgetLog($obj1);
			}

			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getuiConf(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initKwidgetLogs();
				$obj4->addKwidgetLog($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptuiConf(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KwidgetLogPeer::addSelectColumns($c);
		$startcol2 = (KwidgetLogPeer::NUM_COLUMNS - KwidgetLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		widgetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + widgetPeer::NUM_COLUMNS;

		kshowPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kshowPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + entryPeer::NUM_COLUMNS;

		$c->addJoin(KwidgetLogPeer::WIDGET_ID, widgetPeer::ID);

		$c->addJoin(KwidgetLogPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(KwidgetLogPeer::ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = KwidgetLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = widgetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getwidget(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initKwidgetLogs();
				$obj2->addKwidgetLog($obj1);
			}

			$omClass = kshowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getkshow(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initKwidgetLogs();
				$obj3->addKwidgetLog($obj1);
			}

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getentry(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addKwidgetLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initKwidgetLogs();
				$obj4->addKwidgetLog($obj1);
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
		return KwidgetLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(KwidgetLogPeer::ID); 

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
			$comparison = $criteria->getComparison(KwidgetLogPeer::ID);
			$selectCriteria->add(KwidgetLogPeer::ID, $criteria->remove(KwidgetLogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(KwidgetLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(KwidgetLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof KwidgetLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(KwidgetLogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(KwidgetLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(KwidgetLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(KwidgetLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(KwidgetLogPeer::DATABASE_NAME, KwidgetLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = KwidgetLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(KwidgetLogPeer::DATABASE_NAME);

		$criteria->add(KwidgetLogPeer::ID, $pk);


		$v = KwidgetLogPeer::doSelect($criteria, $con);

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
			$criteria->add(KwidgetLogPeer::ID, $pks, Criteria::IN);
			$objs = KwidgetLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseKwidgetLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/KwidgetLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.KwidgetLogMapBuilder');
}
