<?php


abstract class BasewidgetPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'widget';

	
	const CLASS_DEFAULT = 'lib.model.widget';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'widget.ID';

	
	const INT_ID = 'widget.INT_ID';

	
	const SOURCE_WIDGET_ID = 'widget.SOURCE_WIDGET_ID';

	
	const ROOT_WIDGET_ID = 'widget.ROOT_WIDGET_ID';

	
	const PARTNER_ID = 'widget.PARTNER_ID';

	
	const SUBP_ID = 'widget.SUBP_ID';

	
	const KSHOW_ID = 'widget.KSHOW_ID';

	
	const ENTRY_ID = 'widget.ENTRY_ID';

	
	const UI_CONF_ID = 'widget.UI_CONF_ID';

	
	const CUSTOM_DATA = 'widget.CUSTOM_DATA';

	
	const SECURITY_TYPE = 'widget.SECURITY_TYPE';

	
	const SECURITY_POLICY = 'widget.SECURITY_POLICY';

	
	const CREATED_AT = 'widget.CREATED_AT';

	
	const UPDATED_AT = 'widget.UPDATED_AT';

	
	const PARTNER_DATA = 'widget.PARTNER_DATA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IntId', 'SourceWidgetId', 'RootWidgetId', 'PartnerId', 'SubpId', 'KshowId', 'EntryId', 'UiConfId', 'CustomData', 'SecurityType', 'SecurityPolicy', 'CreatedAt', 'UpdatedAt', 'PartnerData', ),
		BasePeer::TYPE_COLNAME => array (widgetPeer::ID, widgetPeer::INT_ID, widgetPeer::SOURCE_WIDGET_ID, widgetPeer::ROOT_WIDGET_ID, widgetPeer::PARTNER_ID, widgetPeer::SUBP_ID, widgetPeer::KSHOW_ID, widgetPeer::ENTRY_ID, widgetPeer::UI_CONF_ID, widgetPeer::CUSTOM_DATA, widgetPeer::SECURITY_TYPE, widgetPeer::SECURITY_POLICY, widgetPeer::CREATED_AT, widgetPeer::UPDATED_AT, widgetPeer::PARTNER_DATA, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'int_id', 'source_widget_id', 'root_widget_id', 'partner_id', 'subp_id', 'kshow_id', 'entry_id', 'ui_conf_id', 'custom_data', 'security_type', 'security_policy', 'created_at', 'updated_at', 'partner_data', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IntId' => 1, 'SourceWidgetId' => 2, 'RootWidgetId' => 3, 'PartnerId' => 4, 'SubpId' => 5, 'KshowId' => 6, 'EntryId' => 7, 'UiConfId' => 8, 'CustomData' => 9, 'SecurityType' => 10, 'SecurityPolicy' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, 'PartnerData' => 14, ),
		BasePeer::TYPE_COLNAME => array (widgetPeer::ID => 0, widgetPeer::INT_ID => 1, widgetPeer::SOURCE_WIDGET_ID => 2, widgetPeer::ROOT_WIDGET_ID => 3, widgetPeer::PARTNER_ID => 4, widgetPeer::SUBP_ID => 5, widgetPeer::KSHOW_ID => 6, widgetPeer::ENTRY_ID => 7, widgetPeer::UI_CONF_ID => 8, widgetPeer::CUSTOM_DATA => 9, widgetPeer::SECURITY_TYPE => 10, widgetPeer::SECURITY_POLICY => 11, widgetPeer::CREATED_AT => 12, widgetPeer::UPDATED_AT => 13, widgetPeer::PARTNER_DATA => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'int_id' => 1, 'source_widget_id' => 2, 'root_widget_id' => 3, 'partner_id' => 4, 'subp_id' => 5, 'kshow_id' => 6, 'entry_id' => 7, 'ui_conf_id' => 8, 'custom_data' => 9, 'security_type' => 10, 'security_policy' => 11, 'created_at' => 12, 'updated_at' => 13, 'partner_data' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/widgetMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.widgetMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = widgetPeer::getTableMap();
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
		return str_replace(widgetPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(widgetPeer::ID);

		$criteria->addSelectColumn(widgetPeer::INT_ID);

		$criteria->addSelectColumn(widgetPeer::SOURCE_WIDGET_ID);

		$criteria->addSelectColumn(widgetPeer::ROOT_WIDGET_ID);

		$criteria->addSelectColumn(widgetPeer::PARTNER_ID);

		$criteria->addSelectColumn(widgetPeer::SUBP_ID);

		$criteria->addSelectColumn(widgetPeer::KSHOW_ID);

		$criteria->addSelectColumn(widgetPeer::ENTRY_ID);

		$criteria->addSelectColumn(widgetPeer::UI_CONF_ID);

		$criteria->addSelectColumn(widgetPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(widgetPeer::SECURITY_TYPE);

		$criteria->addSelectColumn(widgetPeer::SECURITY_POLICY);

		$criteria->addSelectColumn(widgetPeer::CREATED_AT);

		$criteria->addSelectColumn(widgetPeer::UPDATED_AT);

		$criteria->addSelectColumn(widgetPeer::PARTNER_DATA);

	}

	const COUNT = 'COUNT(widget.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT widget.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = widgetPeer::doSelectRS($criteria, $con);
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
		$objects = widgetPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return widgetPeer::populateObjects(widgetPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			widgetPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = widgetPeer::getOMClass();
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
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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

		widgetPeer::addSelectColumns($c);
		$startcol = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kshowPeer::addSelectColumns($c);

		$c->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();

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
										$temp_obj2->addwidget($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1); 			}
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

		widgetPeer::addSelectColumns($c);
		$startcol = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();

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
										$temp_obj2->addwidget($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1); 			}
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

		widgetPeer::addSelectColumns($c);
		$startcol = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		uiConfPeer::addSelectColumns($c);

		$c->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();

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
										$temp_obj2->addwidget($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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

		widgetPeer::addSelectColumns($c);
		$startcol2 = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();


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
					$temp_obj2->addwidget($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1);
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
					$temp_obj3->addwidget($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initwidgets();
				$obj3->addwidget($obj1);
			}


					
			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getuiConf(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addwidget($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initwidgets();
				$obj4->addwidget($obj1);
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
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(widgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(widgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);

		$rs = widgetPeer::doSelectRS($criteria, $con);
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

		widgetPeer::addSelectColumns($c);
		$startcol2 = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();

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
					$temp_obj2->addwidget($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1);
			}

			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getuiConf(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addwidget($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initwidgets();
				$obj3->addwidget($obj1);
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

		widgetPeer::addSelectColumns($c);
		$startcol2 = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		uiConfPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + uiConfPeer::NUM_COLUMNS;

		$c->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(widgetPeer::UI_CONF_ID, uiConfPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();

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
					$temp_obj2->addwidget($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1);
			}

			$omClass = uiConfPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getuiConf(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addwidget($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initwidgets();
				$obj3->addwidget($obj1);
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

		widgetPeer::addSelectColumns($c);
		$startcol2 = (widgetPeer::NUM_COLUMNS - widgetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		entryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + entryPeer::NUM_COLUMNS;

		$c->addJoin(widgetPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(widgetPeer::ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = widgetPeer::getOMClass();

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
					$temp_obj2->addwidget($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initwidgets();
				$obj2->addwidget($obj1);
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
					$temp_obj3->addwidget($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initwidgets();
				$obj3->addwidget($obj1);
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
		return widgetPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(widgetPeer::ID);
			$selectCriteria->add(widgetPeer::ID, $criteria->remove(widgetPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(widgetPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(widgetPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof widget) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(widgetPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(widget $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(widgetPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(widgetPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(widgetPeer::DATABASE_NAME, widgetPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = widgetPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(widgetPeer::DATABASE_NAME);

		$criteria->add(widgetPeer::ID, $pk);


		$v = widgetPeer::doSelect($criteria, $con);

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
			$criteria->add(widgetPeer::ID, $pks, Criteria::IN);
			$objs = widgetPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasewidgetPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/widgetMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.widgetMapBuilder');
}
