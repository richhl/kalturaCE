<?php


abstract class BasesyndicationFeedPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'syndication_feed';

	
	const CLASS_DEFAULT = 'lib.model.syndicationFeed';

	
	const NUM_COLUMNS = 23;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'syndication_feed.ID';

	
	const INT_ID = 'syndication_feed.INT_ID';

	
	const PARTNER_ID = 'syndication_feed.PARTNER_ID';

	
	const PLAYLIST_ID = 'syndication_feed.PLAYLIST_ID';

	
	const NAME = 'syndication_feed.NAME';

	
	const STATUS = 'syndication_feed.STATUS';

	
	const TYPE = 'syndication_feed.TYPE';

	
	const LANDING_PAGE = 'syndication_feed.LANDING_PAGE';

	
	const FLAVOR_PARAM_ID = 'syndication_feed.FLAVOR_PARAM_ID';

	
	const PLAYER_UICONF_ID = 'syndication_feed.PLAYER_UICONF_ID';

	
	const ALLOW_EMBED = 'syndication_feed.ALLOW_EMBED';

	
	const ADULT_CONTENT = 'syndication_feed.ADULT_CONTENT';

	
	const TRANSCODE_EXISTING_CONTENT = 'syndication_feed.TRANSCODE_EXISTING_CONTENT';

	
	const ADD_TO_DEFAULT_CONVERSION_PROFILE = 'syndication_feed.ADD_TO_DEFAULT_CONVERSION_PROFILE';

	
	const CATEGORIES = 'syndication_feed.CATEGORIES';

	
	const FEED_DESCRIPTION = 'syndication_feed.FEED_DESCRIPTION';

	
	const LANGUAGE = 'syndication_feed.LANGUAGE';

	
	const FEED_LANDING_PAGE = 'syndication_feed.FEED_LANDING_PAGE';

	
	const OWNER_NAME = 'syndication_feed.OWNER_NAME';

	
	const OWNER_EMAIL = 'syndication_feed.OWNER_EMAIL';

	
	const FEED_IMAGE_URL = 'syndication_feed.FEED_IMAGE_URL';

	
	const FEED_AUTHOR = 'syndication_feed.FEED_AUTHOR';

	
	const CREATED_AT = 'syndication_feed.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IntId', 'PartnerId', 'PlaylistId', 'Name', 'Status', 'Type', 'LandingPage', 'FlavorParamId', 'PlayerUiconfId', 'AllowEmbed', 'AdultContent', 'TranscodeExistingContent', 'AddToDefaultConversionProfile', 'Categories', 'FeedDescription', 'Language', 'FeedLandingPage', 'OwnerName', 'OwnerEmail', 'FeedImageUrl', 'FeedAuthor', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (syndicationFeedPeer::ID, syndicationFeedPeer::INT_ID, syndicationFeedPeer::PARTNER_ID, syndicationFeedPeer::PLAYLIST_ID, syndicationFeedPeer::NAME, syndicationFeedPeer::STATUS, syndicationFeedPeer::TYPE, syndicationFeedPeer::LANDING_PAGE, syndicationFeedPeer::FLAVOR_PARAM_ID, syndicationFeedPeer::PLAYER_UICONF_ID, syndicationFeedPeer::ALLOW_EMBED, syndicationFeedPeer::ADULT_CONTENT, syndicationFeedPeer::TRANSCODE_EXISTING_CONTENT, syndicationFeedPeer::ADD_TO_DEFAULT_CONVERSION_PROFILE, syndicationFeedPeer::CATEGORIES, syndicationFeedPeer::FEED_DESCRIPTION, syndicationFeedPeer::LANGUAGE, syndicationFeedPeer::FEED_LANDING_PAGE, syndicationFeedPeer::OWNER_NAME, syndicationFeedPeer::OWNER_EMAIL, syndicationFeedPeer::FEED_IMAGE_URL, syndicationFeedPeer::FEED_AUTHOR, syndicationFeedPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'int_id', 'partner_id', 'playlist_id', 'name', 'status', 'type', 'landing_page', 'flavor_param_id', 'player_uiconf_id', 'allow_embed', 'adult_content', 'transcode_existing_content', 'add_to_default_conversion_profile', 'categories', 'feed_description', 'language', 'feed_landing_page', 'owner_name', 'owner_email', 'feed_image_url', 'feed_author', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IntId' => 1, 'PartnerId' => 2, 'PlaylistId' => 3, 'Name' => 4, 'Status' => 5, 'Type' => 6, 'LandingPage' => 7, 'FlavorParamId' => 8, 'PlayerUiconfId' => 9, 'AllowEmbed' => 10, 'AdultContent' => 11, 'TranscodeExistingContent' => 12, 'AddToDefaultConversionProfile' => 13, 'Categories' => 14, 'FeedDescription' => 15, 'Language' => 16, 'FeedLandingPage' => 17, 'OwnerName' => 18, 'OwnerEmail' => 19, 'FeedImageUrl' => 20, 'FeedAuthor' => 21, 'CreatedAt' => 22, ),
		BasePeer::TYPE_COLNAME => array (syndicationFeedPeer::ID => 0, syndicationFeedPeer::INT_ID => 1, syndicationFeedPeer::PARTNER_ID => 2, syndicationFeedPeer::PLAYLIST_ID => 3, syndicationFeedPeer::NAME => 4, syndicationFeedPeer::STATUS => 5, syndicationFeedPeer::TYPE => 6, syndicationFeedPeer::LANDING_PAGE => 7, syndicationFeedPeer::FLAVOR_PARAM_ID => 8, syndicationFeedPeer::PLAYER_UICONF_ID => 9, syndicationFeedPeer::ALLOW_EMBED => 10, syndicationFeedPeer::ADULT_CONTENT => 11, syndicationFeedPeer::TRANSCODE_EXISTING_CONTENT => 12, syndicationFeedPeer::ADD_TO_DEFAULT_CONVERSION_PROFILE => 13, syndicationFeedPeer::CATEGORIES => 14, syndicationFeedPeer::FEED_DESCRIPTION => 15, syndicationFeedPeer::LANGUAGE => 16, syndicationFeedPeer::FEED_LANDING_PAGE => 17, syndicationFeedPeer::OWNER_NAME => 18, syndicationFeedPeer::OWNER_EMAIL => 19, syndicationFeedPeer::FEED_IMAGE_URL => 20, syndicationFeedPeer::FEED_AUTHOR => 21, syndicationFeedPeer::CREATED_AT => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'int_id' => 1, 'partner_id' => 2, 'playlist_id' => 3, 'name' => 4, 'status' => 5, 'type' => 6, 'landing_page' => 7, 'flavor_param_id' => 8, 'player_uiconf_id' => 9, 'allow_embed' => 10, 'adult_content' => 11, 'transcode_existing_content' => 12, 'add_to_default_conversion_profile' => 13, 'categories' => 14, 'feed_description' => 15, 'language' => 16, 'feed_landing_page' => 17, 'owner_name' => 18, 'owner_email' => 19, 'feed_image_url' => 20, 'feed_author' => 21, 'created_at' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/syndicationFeedMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.syndicationFeedMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = syndicationFeedPeer::getTableMap();
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
		return str_replace(syndicationFeedPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(syndicationFeedPeer::ID);

		$criteria->addSelectColumn(syndicationFeedPeer::INT_ID);

		$criteria->addSelectColumn(syndicationFeedPeer::PARTNER_ID);

		$criteria->addSelectColumn(syndicationFeedPeer::PLAYLIST_ID);

		$criteria->addSelectColumn(syndicationFeedPeer::NAME);

		$criteria->addSelectColumn(syndicationFeedPeer::STATUS);

		$criteria->addSelectColumn(syndicationFeedPeer::TYPE);

		$criteria->addSelectColumn(syndicationFeedPeer::LANDING_PAGE);

		$criteria->addSelectColumn(syndicationFeedPeer::FLAVOR_PARAM_ID);

		$criteria->addSelectColumn(syndicationFeedPeer::PLAYER_UICONF_ID);

		$criteria->addSelectColumn(syndicationFeedPeer::ALLOW_EMBED);

		$criteria->addSelectColumn(syndicationFeedPeer::ADULT_CONTENT);

		$criteria->addSelectColumn(syndicationFeedPeer::TRANSCODE_EXISTING_CONTENT);

		$criteria->addSelectColumn(syndicationFeedPeer::ADD_TO_DEFAULT_CONVERSION_PROFILE);

		$criteria->addSelectColumn(syndicationFeedPeer::CATEGORIES);

		$criteria->addSelectColumn(syndicationFeedPeer::FEED_DESCRIPTION);

		$criteria->addSelectColumn(syndicationFeedPeer::LANGUAGE);

		$criteria->addSelectColumn(syndicationFeedPeer::FEED_LANDING_PAGE);

		$criteria->addSelectColumn(syndicationFeedPeer::OWNER_NAME);

		$criteria->addSelectColumn(syndicationFeedPeer::OWNER_EMAIL);

		$criteria->addSelectColumn(syndicationFeedPeer::FEED_IMAGE_URL);

		$criteria->addSelectColumn(syndicationFeedPeer::FEED_AUTHOR);

		$criteria->addSelectColumn(syndicationFeedPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(syndication_feed.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT syndication_feed.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(syndicationFeedPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(syndicationFeedPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = syndicationFeedPeer::doSelectRS($criteria, $con);
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
		$objects = syndicationFeedPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return syndicationFeedPeer::populateObjects(syndicationFeedPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			syndicationFeedPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = syndicationFeedPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return syndicationFeedPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(syndicationFeedPeer::ID);
			$selectCriteria->add(syndicationFeedPeer::ID, $criteria->remove(syndicationFeedPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(syndicationFeedPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(syndicationFeedPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof syndicationFeed) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(syndicationFeedPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(syndicationFeed $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(syndicationFeedPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(syndicationFeedPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(syndicationFeedPeer::DATABASE_NAME, syndicationFeedPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = syndicationFeedPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(syndicationFeedPeer::DATABASE_NAME);

		$criteria->add(syndicationFeedPeer::ID, $pk);


		$v = syndicationFeedPeer::doSelect($criteria, $con);

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
			$criteria->add(syndicationFeedPeer::ID, $pks, Criteria::IN);
			$objs = syndicationFeedPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasesyndicationFeedPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/syndicationFeedMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.syndicationFeedMapBuilder');
}
