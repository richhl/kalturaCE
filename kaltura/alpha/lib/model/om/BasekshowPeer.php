<?php


abstract class BasekshowPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'kshow';

	
	const CLASS_DEFAULT = 'lib.model.kshow';

	
	const NUM_COLUMNS = 52;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'kshow.ID';

	
	const PRODUCER_ID = 'kshow.PRODUCER_ID';

	
	const EPISODE_ID = 'kshow.EPISODE_ID';

	
	const NAME = 'kshow.NAME';

	
	const SUBDOMAIN = 'kshow.SUBDOMAIN';

	
	const DESCRIPTION = 'kshow.DESCRIPTION';

	
	const STATUS = 'kshow.STATUS';

	
	const TYPE = 'kshow.TYPE';

	
	const MEDIA_TYPE = 'kshow.MEDIA_TYPE';

	
	const FORMAT_TYPE = 'kshow.FORMAT_TYPE';

	
	const LANGUAGE = 'kshow.LANGUAGE';

	
	const START_DATE = 'kshow.START_DATE';

	
	const END_DATE = 'kshow.END_DATE';

	
	const SKIN = 'kshow.SKIN';

	
	const THUMBNAIL = 'kshow.THUMBNAIL';

	
	const SHOW_ENTRY_ID = 'kshow.SHOW_ENTRY_ID';

	
	const INTRO_ID = 'kshow.INTRO_ID';

	
	const VIEWS = 'kshow.VIEWS';

	
	const VOTES = 'kshow.VOTES';

	
	const COMMENTS = 'kshow.COMMENTS';

	
	const FAVORITES = 'kshow.FAVORITES';

	
	const RANK = 'kshow.RANK';

	
	const ENTRIES = 'kshow.ENTRIES';

	
	const CONTRIBUTORS = 'kshow.CONTRIBUTORS';

	
	const SUBSCRIBERS = 'kshow.SUBSCRIBERS';

	
	const NUMBER_OF_UPDATES = 'kshow.NUMBER_OF_UPDATES';

	
	const TAGS = 'kshow.TAGS';

	
	const CUSTOM_DATA = 'kshow.CUSTOM_DATA';

	
	const INDEXED_CUSTOM_DATA_1 = 'kshow.INDEXED_CUSTOM_DATA_1';

	
	const INDEXED_CUSTOM_DATA_2 = 'kshow.INDEXED_CUSTOM_DATA_2';

	
	const INDEXED_CUSTOM_DATA_3 = 'kshow.INDEXED_CUSTOM_DATA_3';

	
	const REOCCURENCE = 'kshow.REOCCURENCE';

	
	const LICENSE_TYPE = 'kshow.LICENSE_TYPE';

	
	const LENGTH_IN_MSECS = 'kshow.LENGTH_IN_MSECS';

	
	const VIEW_PERMISSIONS = 'kshow.VIEW_PERMISSIONS';

	
	const VIEW_PASSWORD = 'kshow.VIEW_PASSWORD';

	
	const CONTRIB_PERMISSIONS = 'kshow.CONTRIB_PERMISSIONS';

	
	const CONTRIB_PASSWORD = 'kshow.CONTRIB_PASSWORD';

	
	const EDIT_PERMISSIONS = 'kshow.EDIT_PERMISSIONS';

	
	const EDIT_PASSWORD = 'kshow.EDIT_PASSWORD';

	
	const SALT = 'kshow.SALT';

	
	const CREATED_AT = 'kshow.CREATED_AT';

	
	const UPDATED_AT = 'kshow.UPDATED_AT';

	
	const PARTNER_ID = 'kshow.PARTNER_ID';

	
	const DISPLAY_IN_SEARCH = 'kshow.DISPLAY_IN_SEARCH';

	
	const SUBP_ID = 'kshow.SUBP_ID';

	
	const SEARCH_TEXT = 'kshow.SEARCH_TEXT';

	
	const PERMISSIONS = 'kshow.PERMISSIONS';

	
	const GROUP_ID = 'kshow.GROUP_ID';

	
	const PLAYS = 'kshow.PLAYS';

	
	const PARTNER_DATA = 'kshow.PARTNER_DATA';

	
	const INT_ID = 'kshow.INT_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProducerId', 'EpisodeId', 'Name', 'Subdomain', 'Description', 'Status', 'Type', 'MediaType', 'FormatType', 'Language', 'StartDate', 'EndDate', 'Skin', 'Thumbnail', 'ShowEntryId', 'IntroId', 'Views', 'Votes', 'Comments', 'Favorites', 'Rank', 'Entries', 'Contributors', 'Subscribers', 'NumberOfUpdates', 'Tags', 'CustomData', 'IndexedCustomData1', 'IndexedCustomData2', 'IndexedCustomData3', 'Reoccurence', 'LicenseType', 'LengthInMsecs', 'ViewPermissions', 'ViewPassword', 'ContribPermissions', 'ContribPassword', 'EditPermissions', 'EditPassword', 'Salt', 'CreatedAt', 'UpdatedAt', 'PartnerId', 'DisplayInSearch', 'SubpId', 'SearchText', 'Permissions', 'GroupId', 'Plays', 'PartnerData', 'IntId', ),
		BasePeer::TYPE_COLNAME => array (kshowPeer::ID, kshowPeer::PRODUCER_ID, kshowPeer::EPISODE_ID, kshowPeer::NAME, kshowPeer::SUBDOMAIN, kshowPeer::DESCRIPTION, kshowPeer::STATUS, kshowPeer::TYPE, kshowPeer::MEDIA_TYPE, kshowPeer::FORMAT_TYPE, kshowPeer::LANGUAGE, kshowPeer::START_DATE, kshowPeer::END_DATE, kshowPeer::SKIN, kshowPeer::THUMBNAIL, kshowPeer::SHOW_ENTRY_ID, kshowPeer::INTRO_ID, kshowPeer::VIEWS, kshowPeer::VOTES, kshowPeer::COMMENTS, kshowPeer::FAVORITES, kshowPeer::RANK, kshowPeer::ENTRIES, kshowPeer::CONTRIBUTORS, kshowPeer::SUBSCRIBERS, kshowPeer::NUMBER_OF_UPDATES, kshowPeer::TAGS, kshowPeer::CUSTOM_DATA, kshowPeer::INDEXED_CUSTOM_DATA_1, kshowPeer::INDEXED_CUSTOM_DATA_2, kshowPeer::INDEXED_CUSTOM_DATA_3, kshowPeer::REOCCURENCE, kshowPeer::LICENSE_TYPE, kshowPeer::LENGTH_IN_MSECS, kshowPeer::VIEW_PERMISSIONS, kshowPeer::VIEW_PASSWORD, kshowPeer::CONTRIB_PERMISSIONS, kshowPeer::CONTRIB_PASSWORD, kshowPeer::EDIT_PERMISSIONS, kshowPeer::EDIT_PASSWORD, kshowPeer::SALT, kshowPeer::CREATED_AT, kshowPeer::UPDATED_AT, kshowPeer::PARTNER_ID, kshowPeer::DISPLAY_IN_SEARCH, kshowPeer::SUBP_ID, kshowPeer::SEARCH_TEXT, kshowPeer::PERMISSIONS, kshowPeer::GROUP_ID, kshowPeer::PLAYS, kshowPeer::PARTNER_DATA, kshowPeer::INT_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'producer_id', 'episode_id', 'name', 'subdomain', 'description', 'status', 'type', 'media_type', 'format_type', 'language', 'start_date', 'end_date', 'skin', 'thumbnail', 'show_entry_id', 'intro_id', 'views', 'votes', 'comments', 'favorites', 'rank', 'entries', 'contributors', 'subscribers', 'number_of_updates', 'tags', 'custom_data', 'indexed_custom_data_1', 'indexed_custom_data_2', 'indexed_custom_data_3', 'reoccurence', 'license_type', 'length_in_msecs', 'view_permissions', 'view_password', 'contrib_permissions', 'contrib_password', 'edit_permissions', 'edit_password', 'salt', 'created_at', 'updated_at', 'partner_id', 'display_in_search', 'subp_id', 'search_text', 'permissions', 'group_id', 'plays', 'partner_data', 'int_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProducerId' => 1, 'EpisodeId' => 2, 'Name' => 3, 'Subdomain' => 4, 'Description' => 5, 'Status' => 6, 'Type' => 7, 'MediaType' => 8, 'FormatType' => 9, 'Language' => 10, 'StartDate' => 11, 'EndDate' => 12, 'Skin' => 13, 'Thumbnail' => 14, 'ShowEntryId' => 15, 'IntroId' => 16, 'Views' => 17, 'Votes' => 18, 'Comments' => 19, 'Favorites' => 20, 'Rank' => 21, 'Entries' => 22, 'Contributors' => 23, 'Subscribers' => 24, 'NumberOfUpdates' => 25, 'Tags' => 26, 'CustomData' => 27, 'IndexedCustomData1' => 28, 'IndexedCustomData2' => 29, 'IndexedCustomData3' => 30, 'Reoccurence' => 31, 'LicenseType' => 32, 'LengthInMsecs' => 33, 'ViewPermissions' => 34, 'ViewPassword' => 35, 'ContribPermissions' => 36, 'ContribPassword' => 37, 'EditPermissions' => 38, 'EditPassword' => 39, 'Salt' => 40, 'CreatedAt' => 41, 'UpdatedAt' => 42, 'PartnerId' => 43, 'DisplayInSearch' => 44, 'SubpId' => 45, 'SearchText' => 46, 'Permissions' => 47, 'GroupId' => 48, 'Plays' => 49, 'PartnerData' => 50, 'IntId' => 51, ),
		BasePeer::TYPE_COLNAME => array (kshowPeer::ID => 0, kshowPeer::PRODUCER_ID => 1, kshowPeer::EPISODE_ID => 2, kshowPeer::NAME => 3, kshowPeer::SUBDOMAIN => 4, kshowPeer::DESCRIPTION => 5, kshowPeer::STATUS => 6, kshowPeer::TYPE => 7, kshowPeer::MEDIA_TYPE => 8, kshowPeer::FORMAT_TYPE => 9, kshowPeer::LANGUAGE => 10, kshowPeer::START_DATE => 11, kshowPeer::END_DATE => 12, kshowPeer::SKIN => 13, kshowPeer::THUMBNAIL => 14, kshowPeer::SHOW_ENTRY_ID => 15, kshowPeer::INTRO_ID => 16, kshowPeer::VIEWS => 17, kshowPeer::VOTES => 18, kshowPeer::COMMENTS => 19, kshowPeer::FAVORITES => 20, kshowPeer::RANK => 21, kshowPeer::ENTRIES => 22, kshowPeer::CONTRIBUTORS => 23, kshowPeer::SUBSCRIBERS => 24, kshowPeer::NUMBER_OF_UPDATES => 25, kshowPeer::TAGS => 26, kshowPeer::CUSTOM_DATA => 27, kshowPeer::INDEXED_CUSTOM_DATA_1 => 28, kshowPeer::INDEXED_CUSTOM_DATA_2 => 29, kshowPeer::INDEXED_CUSTOM_DATA_3 => 30, kshowPeer::REOCCURENCE => 31, kshowPeer::LICENSE_TYPE => 32, kshowPeer::LENGTH_IN_MSECS => 33, kshowPeer::VIEW_PERMISSIONS => 34, kshowPeer::VIEW_PASSWORD => 35, kshowPeer::CONTRIB_PERMISSIONS => 36, kshowPeer::CONTRIB_PASSWORD => 37, kshowPeer::EDIT_PERMISSIONS => 38, kshowPeer::EDIT_PASSWORD => 39, kshowPeer::SALT => 40, kshowPeer::CREATED_AT => 41, kshowPeer::UPDATED_AT => 42, kshowPeer::PARTNER_ID => 43, kshowPeer::DISPLAY_IN_SEARCH => 44, kshowPeer::SUBP_ID => 45, kshowPeer::SEARCH_TEXT => 46, kshowPeer::PERMISSIONS => 47, kshowPeer::GROUP_ID => 48, kshowPeer::PLAYS => 49, kshowPeer::PARTNER_DATA => 50, kshowPeer::INT_ID => 51, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'producer_id' => 1, 'episode_id' => 2, 'name' => 3, 'subdomain' => 4, 'description' => 5, 'status' => 6, 'type' => 7, 'media_type' => 8, 'format_type' => 9, 'language' => 10, 'start_date' => 11, 'end_date' => 12, 'skin' => 13, 'thumbnail' => 14, 'show_entry_id' => 15, 'intro_id' => 16, 'views' => 17, 'votes' => 18, 'comments' => 19, 'favorites' => 20, 'rank' => 21, 'entries' => 22, 'contributors' => 23, 'subscribers' => 24, 'number_of_updates' => 25, 'tags' => 26, 'custom_data' => 27, 'indexed_custom_data_1' => 28, 'indexed_custom_data_2' => 29, 'indexed_custom_data_3' => 30, 'reoccurence' => 31, 'license_type' => 32, 'length_in_msecs' => 33, 'view_permissions' => 34, 'view_password' => 35, 'contrib_permissions' => 36, 'contrib_password' => 37, 'edit_permissions' => 38, 'edit_password' => 39, 'salt' => 40, 'created_at' => 41, 'updated_at' => 42, 'partner_id' => 43, 'display_in_search' => 44, 'subp_id' => 45, 'search_text' => 46, 'permissions' => 47, 'group_id' => 48, 'plays' => 49, 'partner_data' => 50, 'int_id' => 51, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/kshowMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.kshowMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = kshowPeer::getTableMap();
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
		return str_replace(kshowPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(kshowPeer::ID);

		$criteria->addSelectColumn(kshowPeer::PRODUCER_ID);

		$criteria->addSelectColumn(kshowPeer::EPISODE_ID);

		$criteria->addSelectColumn(kshowPeer::NAME);

		$criteria->addSelectColumn(kshowPeer::SUBDOMAIN);

		$criteria->addSelectColumn(kshowPeer::DESCRIPTION);

		$criteria->addSelectColumn(kshowPeer::STATUS);

		$criteria->addSelectColumn(kshowPeer::TYPE);

		$criteria->addSelectColumn(kshowPeer::MEDIA_TYPE);

		$criteria->addSelectColumn(kshowPeer::FORMAT_TYPE);

		$criteria->addSelectColumn(kshowPeer::LANGUAGE);

		$criteria->addSelectColumn(kshowPeer::START_DATE);

		$criteria->addSelectColumn(kshowPeer::END_DATE);

		$criteria->addSelectColumn(kshowPeer::SKIN);

		$criteria->addSelectColumn(kshowPeer::THUMBNAIL);

		$criteria->addSelectColumn(kshowPeer::SHOW_ENTRY_ID);

		$criteria->addSelectColumn(kshowPeer::INTRO_ID);

		$criteria->addSelectColumn(kshowPeer::VIEWS);

		$criteria->addSelectColumn(kshowPeer::VOTES);

		$criteria->addSelectColumn(kshowPeer::COMMENTS);

		$criteria->addSelectColumn(kshowPeer::FAVORITES);

		$criteria->addSelectColumn(kshowPeer::RANK);

		$criteria->addSelectColumn(kshowPeer::ENTRIES);

		$criteria->addSelectColumn(kshowPeer::CONTRIBUTORS);

		$criteria->addSelectColumn(kshowPeer::SUBSCRIBERS);

		$criteria->addSelectColumn(kshowPeer::NUMBER_OF_UPDATES);

		$criteria->addSelectColumn(kshowPeer::TAGS);

		$criteria->addSelectColumn(kshowPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(kshowPeer::INDEXED_CUSTOM_DATA_1);

		$criteria->addSelectColumn(kshowPeer::INDEXED_CUSTOM_DATA_2);

		$criteria->addSelectColumn(kshowPeer::INDEXED_CUSTOM_DATA_3);

		$criteria->addSelectColumn(kshowPeer::REOCCURENCE);

		$criteria->addSelectColumn(kshowPeer::LICENSE_TYPE);

		$criteria->addSelectColumn(kshowPeer::LENGTH_IN_MSECS);

		$criteria->addSelectColumn(kshowPeer::VIEW_PERMISSIONS);

		$criteria->addSelectColumn(kshowPeer::VIEW_PASSWORD);

		$criteria->addSelectColumn(kshowPeer::CONTRIB_PERMISSIONS);

		$criteria->addSelectColumn(kshowPeer::CONTRIB_PASSWORD);

		$criteria->addSelectColumn(kshowPeer::EDIT_PERMISSIONS);

		$criteria->addSelectColumn(kshowPeer::EDIT_PASSWORD);

		$criteria->addSelectColumn(kshowPeer::SALT);

		$criteria->addSelectColumn(kshowPeer::CREATED_AT);

		$criteria->addSelectColumn(kshowPeer::UPDATED_AT);

		$criteria->addSelectColumn(kshowPeer::PARTNER_ID);

		$criteria->addSelectColumn(kshowPeer::DISPLAY_IN_SEARCH);

		$criteria->addSelectColumn(kshowPeer::SUBP_ID);

		$criteria->addSelectColumn(kshowPeer::SEARCH_TEXT);

		$criteria->addSelectColumn(kshowPeer::PERMISSIONS);

		$criteria->addSelectColumn(kshowPeer::GROUP_ID);

		$criteria->addSelectColumn(kshowPeer::PLAYS);

		$criteria->addSelectColumn(kshowPeer::PARTNER_DATA);

		$criteria->addSelectColumn(kshowPeer::INT_ID);

	}

	const COUNT = 'COUNT(kshow.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT kshow.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(kshowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(kshowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = kshowPeer::doSelectRS($criteria, $con);
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
		$objects = kshowPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return kshowPeer::populateObjects(kshowPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			kshowPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = kshowPeer::getOMClass();
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
			$criteria->addSelectColumn(kshowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(kshowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(kshowPeer::PRODUCER_ID, kuserPeer::ID);

		$rs = kshowPeer::doSelectRS($criteria, $con);
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

		kshowPeer::addSelectColumns($c);
		$startcol = (kshowPeer::NUM_COLUMNS - kshowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(kshowPeer::PRODUCER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = kshowPeer::getOMClass();

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
										$temp_obj2->addkshow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initkshows();
				$obj2->addkshow($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(kshowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(kshowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(kshowPeer::PRODUCER_ID, kuserPeer::ID);

		$rs = kshowPeer::doSelectRS($criteria, $con);
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

		kshowPeer::addSelectColumns($c);
		$startcol2 = (kshowPeer::NUM_COLUMNS - kshowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(kshowPeer::PRODUCER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = kshowPeer::getOMClass();


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
					$temp_obj2->addkshow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initkshows();
				$obj2->addkshow($obj1);
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
		return kshowPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(kshowPeer::ID);
			$selectCriteria->add(kshowPeer::ID, $criteria->remove(kshowPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(kshowPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(kshowPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof kshow) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(kshowPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(kshow $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(kshowPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(kshowPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(kshowPeer::DATABASE_NAME, kshowPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = kshowPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(kshowPeer::DATABASE_NAME);

		$criteria->add(kshowPeer::ID, $pk);


		$v = kshowPeer::doSelect($criteria, $con);

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
			$criteria->add(kshowPeer::ID, $pks, Criteria::IN);
			$objs = kshowPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasekshowPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/kshowMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.kshowMapBuilder');
}
