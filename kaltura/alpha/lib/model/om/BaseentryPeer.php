<?php


abstract class BaseentryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'entry';

	
	const CLASS_DEFAULT = 'lib.model.entry';

	
	const NUM_COLUMNS = 45;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'entry.ID';

	
	const KSHOW_ID = 'entry.KSHOW_ID';

	
	const KUSER_ID = 'entry.KUSER_ID';

	
	const NAME = 'entry.NAME';

	
	const TYPE = 'entry.TYPE';

	
	const MEDIA_TYPE = 'entry.MEDIA_TYPE';

	
	const DATA = 'entry.DATA';

	
	const THUMBNAIL = 'entry.THUMBNAIL';

	
	const VIEWS = 'entry.VIEWS';

	
	const VOTES = 'entry.VOTES';

	
	const COMMENTS = 'entry.COMMENTS';

	
	const FAVORITES = 'entry.FAVORITES';

	
	const TOTAL_RANK = 'entry.TOTAL_RANK';

	
	const RANK = 'entry.RANK';

	
	const TAGS = 'entry.TAGS';

	
	const ANONYMOUS = 'entry.ANONYMOUS';

	
	const STATUS = 'entry.STATUS';

	
	const SOURCE = 'entry.SOURCE';

	
	const SOURCE_ID = 'entry.SOURCE_ID';

	
	const SOURCE_LINK = 'entry.SOURCE_LINK';

	
	const LICENSE_TYPE = 'entry.LICENSE_TYPE';

	
	const CREDIT = 'entry.CREDIT';

	
	const LENGTH_IN_MSECS = 'entry.LENGTH_IN_MSECS';

	
	const CREATED_AT = 'entry.CREATED_AT';

	
	const UPDATED_AT = 'entry.UPDATED_AT';

	
	const PARTNER_ID = 'entry.PARTNER_ID';

	
	const DISPLAY_IN_SEARCH = 'entry.DISPLAY_IN_SEARCH';

	
	const SUBP_ID = 'entry.SUBP_ID';

	
	const CUSTOM_DATA = 'entry.CUSTOM_DATA';

	
	const SEARCH_TEXT = 'entry.SEARCH_TEXT';

	
	const SCREEN_NAME = 'entry.SCREEN_NAME';

	
	const SITE_URL = 'entry.SITE_URL';

	
	const PERMISSIONS = 'entry.PERMISSIONS';

	
	const GROUP_ID = 'entry.GROUP_ID';

	
	const PLAYS = 'entry.PLAYS';

	
	const PARTNER_DATA = 'entry.PARTNER_DATA';

	
	const INT_ID = 'entry.INT_ID';

	
	const INDEXED_CUSTOM_DATA_1 = 'entry.INDEXED_CUSTOM_DATA_1';

	
	const DESCRIPTION = 'entry.DESCRIPTION';

	
	const MEDIA_DATE = 'entry.MEDIA_DATE';

	
	const ADMIN_TAGS = 'entry.ADMIN_TAGS';

	
	const MODERATION_STATUS = 'entry.MODERATION_STATUS';

	
	const MODERATION_COUNT = 'entry.MODERATION_COUNT';

	
	const MODIFIED_AT = 'entry.MODIFIED_AT';

	
	const PUSER_ID = 'entry.PUSER_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'KshowId', 'KuserId', 'Name', 'Type', 'MediaType', 'Data', 'Thumbnail', 'Views', 'Votes', 'Comments', 'Favorites', 'TotalRank', 'Rank', 'Tags', 'Anonymous', 'Status', 'Source', 'SourceId', 'SourceLink', 'LicenseType', 'Credit', 'LengthInMsecs', 'CreatedAt', 'UpdatedAt', 'PartnerId', 'DisplayInSearch', 'SubpId', 'CustomData', 'SearchText', 'ScreenName', 'SiteUrl', 'Permissions', 'GroupId', 'Plays', 'PartnerData', 'IntId', 'IndexedCustomData1', 'Description', 'MediaDate', 'AdminTags', 'ModerationStatus', 'ModerationCount', 'ModifiedAt', 'PuserId', ),
		BasePeer::TYPE_COLNAME => array (entryPeer::ID, entryPeer::KSHOW_ID, entryPeer::KUSER_ID, entryPeer::NAME, entryPeer::TYPE, entryPeer::MEDIA_TYPE, entryPeer::DATA, entryPeer::THUMBNAIL, entryPeer::VIEWS, entryPeer::VOTES, entryPeer::COMMENTS, entryPeer::FAVORITES, entryPeer::TOTAL_RANK, entryPeer::RANK, entryPeer::TAGS, entryPeer::ANONYMOUS, entryPeer::STATUS, entryPeer::SOURCE, entryPeer::SOURCE_ID, entryPeer::SOURCE_LINK, entryPeer::LICENSE_TYPE, entryPeer::CREDIT, entryPeer::LENGTH_IN_MSECS, entryPeer::CREATED_AT, entryPeer::UPDATED_AT, entryPeer::PARTNER_ID, entryPeer::DISPLAY_IN_SEARCH, entryPeer::SUBP_ID, entryPeer::CUSTOM_DATA, entryPeer::SEARCH_TEXT, entryPeer::SCREEN_NAME, entryPeer::SITE_URL, entryPeer::PERMISSIONS, entryPeer::GROUP_ID, entryPeer::PLAYS, entryPeer::PARTNER_DATA, entryPeer::INT_ID, entryPeer::INDEXED_CUSTOM_DATA_1, entryPeer::DESCRIPTION, entryPeer::MEDIA_DATE, entryPeer::ADMIN_TAGS, entryPeer::MODERATION_STATUS, entryPeer::MODERATION_COUNT, entryPeer::MODIFIED_AT, entryPeer::PUSER_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'kshow_id', 'kuser_id', 'name', 'type', 'media_type', 'data', 'thumbnail', 'views', 'votes', 'comments', 'favorites', 'total_rank', 'rank', 'tags', 'anonymous', 'status', 'source', 'source_id', 'source_link', 'license_type', 'credit', 'length_in_msecs', 'created_at', 'updated_at', 'partner_id', 'display_in_search', 'subp_id', 'custom_data', 'search_text', 'screen_name', 'site_url', 'permissions', 'group_id', 'plays', 'partner_data', 'int_id', 'indexed_custom_data_1', 'description', 'media_date', 'admin_tags', 'moderation_status', 'moderation_count', 'modified_at', 'puser_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'KshowId' => 1, 'KuserId' => 2, 'Name' => 3, 'Type' => 4, 'MediaType' => 5, 'Data' => 6, 'Thumbnail' => 7, 'Views' => 8, 'Votes' => 9, 'Comments' => 10, 'Favorites' => 11, 'TotalRank' => 12, 'Rank' => 13, 'Tags' => 14, 'Anonymous' => 15, 'Status' => 16, 'Source' => 17, 'SourceId' => 18, 'SourceLink' => 19, 'LicenseType' => 20, 'Credit' => 21, 'LengthInMsecs' => 22, 'CreatedAt' => 23, 'UpdatedAt' => 24, 'PartnerId' => 25, 'DisplayInSearch' => 26, 'SubpId' => 27, 'CustomData' => 28, 'SearchText' => 29, 'ScreenName' => 30, 'SiteUrl' => 31, 'Permissions' => 32, 'GroupId' => 33, 'Plays' => 34, 'PartnerData' => 35, 'IntId' => 36, 'IndexedCustomData1' => 37, 'Description' => 38, 'MediaDate' => 39, 'AdminTags' => 40, 'ModerationStatus' => 41, 'ModerationCount' => 42, 'ModifiedAt' => 43, 'PuserId' => 44, ),
		BasePeer::TYPE_COLNAME => array (entryPeer::ID => 0, entryPeer::KSHOW_ID => 1, entryPeer::KUSER_ID => 2, entryPeer::NAME => 3, entryPeer::TYPE => 4, entryPeer::MEDIA_TYPE => 5, entryPeer::DATA => 6, entryPeer::THUMBNAIL => 7, entryPeer::VIEWS => 8, entryPeer::VOTES => 9, entryPeer::COMMENTS => 10, entryPeer::FAVORITES => 11, entryPeer::TOTAL_RANK => 12, entryPeer::RANK => 13, entryPeer::TAGS => 14, entryPeer::ANONYMOUS => 15, entryPeer::STATUS => 16, entryPeer::SOURCE => 17, entryPeer::SOURCE_ID => 18, entryPeer::SOURCE_LINK => 19, entryPeer::LICENSE_TYPE => 20, entryPeer::CREDIT => 21, entryPeer::LENGTH_IN_MSECS => 22, entryPeer::CREATED_AT => 23, entryPeer::UPDATED_AT => 24, entryPeer::PARTNER_ID => 25, entryPeer::DISPLAY_IN_SEARCH => 26, entryPeer::SUBP_ID => 27, entryPeer::CUSTOM_DATA => 28, entryPeer::SEARCH_TEXT => 29, entryPeer::SCREEN_NAME => 30, entryPeer::SITE_URL => 31, entryPeer::PERMISSIONS => 32, entryPeer::GROUP_ID => 33, entryPeer::PLAYS => 34, entryPeer::PARTNER_DATA => 35, entryPeer::INT_ID => 36, entryPeer::INDEXED_CUSTOM_DATA_1 => 37, entryPeer::DESCRIPTION => 38, entryPeer::MEDIA_DATE => 39, entryPeer::ADMIN_TAGS => 40, entryPeer::MODERATION_STATUS => 41, entryPeer::MODERATION_COUNT => 42, entryPeer::MODIFIED_AT => 43, entryPeer::PUSER_ID => 44, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'kshow_id' => 1, 'kuser_id' => 2, 'name' => 3, 'type' => 4, 'media_type' => 5, 'data' => 6, 'thumbnail' => 7, 'views' => 8, 'votes' => 9, 'comments' => 10, 'favorites' => 11, 'total_rank' => 12, 'rank' => 13, 'tags' => 14, 'anonymous' => 15, 'status' => 16, 'source' => 17, 'source_id' => 18, 'source_link' => 19, 'license_type' => 20, 'credit' => 21, 'length_in_msecs' => 22, 'created_at' => 23, 'updated_at' => 24, 'partner_id' => 25, 'display_in_search' => 26, 'subp_id' => 27, 'custom_data' => 28, 'search_text' => 29, 'screen_name' => 30, 'site_url' => 31, 'permissions' => 32, 'group_id' => 33, 'plays' => 34, 'partner_data' => 35, 'int_id' => 36, 'indexed_custom_data_1' => 37, 'description' => 38, 'media_date' => 39, 'admin_tags' => 40, 'moderation_status' => 41, 'moderation_count' => 42, 'modified_at' => 43, 'puser_id' => 44, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/entryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.entryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = entryPeer::getTableMap();
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
		return str_replace(entryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(entryPeer::ID);

		$criteria->addSelectColumn(entryPeer::KSHOW_ID);

		$criteria->addSelectColumn(entryPeer::KUSER_ID);

		$criteria->addSelectColumn(entryPeer::NAME);

		$criteria->addSelectColumn(entryPeer::TYPE);

		$criteria->addSelectColumn(entryPeer::MEDIA_TYPE);

		$criteria->addSelectColumn(entryPeer::DATA);

		$criteria->addSelectColumn(entryPeer::THUMBNAIL);

		$criteria->addSelectColumn(entryPeer::VIEWS);

		$criteria->addSelectColumn(entryPeer::VOTES);

		$criteria->addSelectColumn(entryPeer::COMMENTS);

		$criteria->addSelectColumn(entryPeer::FAVORITES);

		$criteria->addSelectColumn(entryPeer::TOTAL_RANK);

		$criteria->addSelectColumn(entryPeer::RANK);

		$criteria->addSelectColumn(entryPeer::TAGS);

		$criteria->addSelectColumn(entryPeer::ANONYMOUS);

		$criteria->addSelectColumn(entryPeer::STATUS);

		$criteria->addSelectColumn(entryPeer::SOURCE);

		$criteria->addSelectColumn(entryPeer::SOURCE_ID);

		$criteria->addSelectColumn(entryPeer::SOURCE_LINK);

		$criteria->addSelectColumn(entryPeer::LICENSE_TYPE);

		$criteria->addSelectColumn(entryPeer::CREDIT);

		$criteria->addSelectColumn(entryPeer::LENGTH_IN_MSECS);

		$criteria->addSelectColumn(entryPeer::CREATED_AT);

		$criteria->addSelectColumn(entryPeer::UPDATED_AT);

		$criteria->addSelectColumn(entryPeer::PARTNER_ID);

		$criteria->addSelectColumn(entryPeer::DISPLAY_IN_SEARCH);

		$criteria->addSelectColumn(entryPeer::SUBP_ID);

		$criteria->addSelectColumn(entryPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(entryPeer::SEARCH_TEXT);

		$criteria->addSelectColumn(entryPeer::SCREEN_NAME);

		$criteria->addSelectColumn(entryPeer::SITE_URL);

		$criteria->addSelectColumn(entryPeer::PERMISSIONS);

		$criteria->addSelectColumn(entryPeer::GROUP_ID);

		$criteria->addSelectColumn(entryPeer::PLAYS);

		$criteria->addSelectColumn(entryPeer::PARTNER_DATA);

		$criteria->addSelectColumn(entryPeer::INT_ID);

		$criteria->addSelectColumn(entryPeer::INDEXED_CUSTOM_DATA_1);

		$criteria->addSelectColumn(entryPeer::DESCRIPTION);

		$criteria->addSelectColumn(entryPeer::MEDIA_DATE);

		$criteria->addSelectColumn(entryPeer::ADMIN_TAGS);

		$criteria->addSelectColumn(entryPeer::MODERATION_STATUS);

		$criteria->addSelectColumn(entryPeer::MODERATION_COUNT);

		$criteria->addSelectColumn(entryPeer::MODIFIED_AT);

		$criteria->addSelectColumn(entryPeer::PUSER_ID);

	}

	const COUNT = 'COUNT(entry.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT entry.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(entryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(entryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = entryPeer::doSelectRS($criteria, $con);
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
		$objects = entryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return entryPeer::populateObjects(entryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			entryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = entryPeer::getOMClass();
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
			$criteria->addSelectColumn(entryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(entryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(entryPeer::KSHOW_ID, kshowPeer::ID);

		$rs = entryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(entryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(entryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(entryPeer::KUSER_ID, kuserPeer::ID);

		$rs = entryPeer::doSelectRS($criteria, $con);
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

		entryPeer::addSelectColumns($c);
		$startcol = (entryPeer::NUM_COLUMNS - entryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kshowPeer::addSelectColumns($c);

		$c->addJoin(entryPeer::KSHOW_ID, kshowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = entryPeer::getOMClass();

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
										$temp_obj2->addentry($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initentrys();
				$obj2->addentry($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		entryPeer::addSelectColumns($c);
		$startcol = (entryPeer::NUM_COLUMNS - entryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = entryPeer::getOMClass();

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
										$temp_obj2->addentry($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initentrys();
				$obj2->addentry($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(entryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(entryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(entryPeer::KSHOW_ID, kshowPeer::ID);

		$criteria->addJoin(entryPeer::KUSER_ID, kuserPeer::ID);

		$rs = entryPeer::doSelectRS($criteria, $con);
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

		entryPeer::addSelectColumns($c);
		$startcol2 = (entryPeer::NUM_COLUMNS - entryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		kuserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(entryPeer::KSHOW_ID, kshowPeer::ID);

		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = entryPeer::getOMClass();


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
					$temp_obj2->addentry($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initentrys();
				$obj2->addentry($obj1);
			}


					
			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getkuser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addentry($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initentrys();
				$obj3->addentry($obj1);
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
			$criteria->addSelectColumn(entryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(entryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(entryPeer::KUSER_ID, kuserPeer::ID);

		$rs = entryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(entryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(entryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(entryPeer::KSHOW_ID, kshowPeer::ID);

		$rs = entryPeer::doSelectRS($criteria, $con);
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

		entryPeer::addSelectColumns($c);
		$startcol2 = (entryPeer::NUM_COLUMNS - entryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(entryPeer::KUSER_ID, kuserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = entryPeer::getOMClass();

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
					$temp_obj2->addentry($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initentrys();
				$obj2->addentry($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		entryPeer::addSelectColumns($c);
		$startcol2 = (entryPeer::NUM_COLUMNS - entryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kshowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kshowPeer::NUM_COLUMNS;

		$c->addJoin(entryPeer::KSHOW_ID, kshowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = entryPeer::getOMClass();

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
					$temp_obj2->addentry($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initentrys();
				$obj2->addentry($obj1);
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
		return entryPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(entryPeer::ID);
			$selectCriteria->add(entryPeer::ID, $criteria->remove(entryPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(entryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(entryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof entry) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(entryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(entry $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(entryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(entryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(entryPeer::DATABASE_NAME, entryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = entryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(entryPeer::DATABASE_NAME);

		$criteria->add(entryPeer::ID, $pk);


		$v = entryPeer::doSelect($criteria, $con);

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
			$criteria->add(entryPeer::ID, $pks, Criteria::IN);
			$objs = entryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseentryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/entryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.entryMapBuilder');
}
