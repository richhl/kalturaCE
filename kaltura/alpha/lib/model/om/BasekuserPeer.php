<?php


abstract class BasekuserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'kuser';

	
	const CLASS_DEFAULT = 'lib.model.kuser';

	
	const NUM_COLUMNS = 37;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'kuser.ID';

	
	const SCREEN_NAME = 'kuser.SCREEN_NAME';

	
	const FULL_NAME = 'kuser.FULL_NAME';

	
	const EMAIL = 'kuser.EMAIL';

	
	const SHA1_PASSWORD = 'kuser.SHA1_PASSWORD';

	
	const SALT = 'kuser.SALT';

	
	const DATE_OF_BIRTH = 'kuser.DATE_OF_BIRTH';

	
	const COUNTRY = 'kuser.COUNTRY';

	
	const STATE = 'kuser.STATE';

	
	const CITY = 'kuser.CITY';

	
	const ZIP = 'kuser.ZIP';

	
	const URL_LIST = 'kuser.URL_LIST';

	
	const PICTURE = 'kuser.PICTURE';

	
	const ICON = 'kuser.ICON';

	
	const ABOUT_ME = 'kuser.ABOUT_ME';

	
	const TAGS = 'kuser.TAGS';

	
	const TAGLINE = 'kuser.TAGLINE';

	
	const NETWORK_HIGHSCHOOL = 'kuser.NETWORK_HIGHSCHOOL';

	
	const NETWORK_COLLEGE = 'kuser.NETWORK_COLLEGE';

	
	const NETWORK_OTHER = 'kuser.NETWORK_OTHER';

	
	const MOBILE_NUM = 'kuser.MOBILE_NUM';

	
	const MATURE_CONTENT = 'kuser.MATURE_CONTENT';

	
	const GENDER = 'kuser.GENDER';

	
	const REGISTRATION_IP = 'kuser.REGISTRATION_IP';

	
	const REGISTRATION_COOKIE = 'kuser.REGISTRATION_COOKIE';

	
	const IM_LIST = 'kuser.IM_LIST';

	
	const VIEWS = 'kuser.VIEWS';

	
	const FANS = 'kuser.FANS';

	
	const ENTRIES = 'kuser.ENTRIES';

	
	const PRODUCED_KSHOWS = 'kuser.PRODUCED_KSHOWS';

	
	const STATUS = 'kuser.STATUS';

	
	const CREATED_AT = 'kuser.CREATED_AT';

	
	const UPDATED_AT = 'kuser.UPDATED_AT';

	
	const PARTNER_ID = 'kuser.PARTNER_ID';

	
	const DISPLAY_IN_SEARCH = 'kuser.DISPLAY_IN_SEARCH';

	
	const SEARCH_TEXT = 'kuser.SEARCH_TEXT';

	
	const PARTNER_DATA = 'kuser.PARTNER_DATA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ScreenName', 'FullName', 'Email', 'Sha1Password', 'Salt', 'DateOfBirth', 'Country', 'State', 'City', 'Zip', 'UrlList', 'Picture', 'Icon', 'AboutMe', 'Tags', 'Tagline', 'NetworkHighschool', 'NetworkCollege', 'NetworkOther', 'MobileNum', 'MatureContent', 'Gender', 'RegistrationIp', 'RegistrationCookie', 'ImList', 'Views', 'Fans', 'Entries', 'ProducedKshows', 'Status', 'CreatedAt', 'UpdatedAt', 'PartnerId', 'DisplayInSearch', 'SearchText', 'PartnerData', ),
		BasePeer::TYPE_COLNAME => array (kuserPeer::ID, kuserPeer::SCREEN_NAME, kuserPeer::FULL_NAME, kuserPeer::EMAIL, kuserPeer::SHA1_PASSWORD, kuserPeer::SALT, kuserPeer::DATE_OF_BIRTH, kuserPeer::COUNTRY, kuserPeer::STATE, kuserPeer::CITY, kuserPeer::ZIP, kuserPeer::URL_LIST, kuserPeer::PICTURE, kuserPeer::ICON, kuserPeer::ABOUT_ME, kuserPeer::TAGS, kuserPeer::TAGLINE, kuserPeer::NETWORK_HIGHSCHOOL, kuserPeer::NETWORK_COLLEGE, kuserPeer::NETWORK_OTHER, kuserPeer::MOBILE_NUM, kuserPeer::MATURE_CONTENT, kuserPeer::GENDER, kuserPeer::REGISTRATION_IP, kuserPeer::REGISTRATION_COOKIE, kuserPeer::IM_LIST, kuserPeer::VIEWS, kuserPeer::FANS, kuserPeer::ENTRIES, kuserPeer::PRODUCED_KSHOWS, kuserPeer::STATUS, kuserPeer::CREATED_AT, kuserPeer::UPDATED_AT, kuserPeer::PARTNER_ID, kuserPeer::DISPLAY_IN_SEARCH, kuserPeer::SEARCH_TEXT, kuserPeer::PARTNER_DATA, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'screen_name', 'full_name', 'email', 'sha1_password', 'salt', 'date_of_birth', 'country', 'state', 'city', 'zip', 'url_list', 'picture', 'icon', 'about_me', 'tags', 'tagline', 'network_highschool', 'network_college', 'network_other', 'mobile_num', 'mature_content', 'gender', 'registration_ip', 'registration_cookie', 'im_list', 'views', 'fans', 'entries', 'produced_kshows', 'status', 'created_at', 'updated_at', 'partner_id', 'display_in_search', 'search_text', 'partner_data', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ScreenName' => 1, 'FullName' => 2, 'Email' => 3, 'Sha1Password' => 4, 'Salt' => 5, 'DateOfBirth' => 6, 'Country' => 7, 'State' => 8, 'City' => 9, 'Zip' => 10, 'UrlList' => 11, 'Picture' => 12, 'Icon' => 13, 'AboutMe' => 14, 'Tags' => 15, 'Tagline' => 16, 'NetworkHighschool' => 17, 'NetworkCollege' => 18, 'NetworkOther' => 19, 'MobileNum' => 20, 'MatureContent' => 21, 'Gender' => 22, 'RegistrationIp' => 23, 'RegistrationCookie' => 24, 'ImList' => 25, 'Views' => 26, 'Fans' => 27, 'Entries' => 28, 'ProducedKshows' => 29, 'Status' => 30, 'CreatedAt' => 31, 'UpdatedAt' => 32, 'PartnerId' => 33, 'DisplayInSearch' => 34, 'SearchText' => 35, 'PartnerData' => 36, ),
		BasePeer::TYPE_COLNAME => array (kuserPeer::ID => 0, kuserPeer::SCREEN_NAME => 1, kuserPeer::FULL_NAME => 2, kuserPeer::EMAIL => 3, kuserPeer::SHA1_PASSWORD => 4, kuserPeer::SALT => 5, kuserPeer::DATE_OF_BIRTH => 6, kuserPeer::COUNTRY => 7, kuserPeer::STATE => 8, kuserPeer::CITY => 9, kuserPeer::ZIP => 10, kuserPeer::URL_LIST => 11, kuserPeer::PICTURE => 12, kuserPeer::ICON => 13, kuserPeer::ABOUT_ME => 14, kuserPeer::TAGS => 15, kuserPeer::TAGLINE => 16, kuserPeer::NETWORK_HIGHSCHOOL => 17, kuserPeer::NETWORK_COLLEGE => 18, kuserPeer::NETWORK_OTHER => 19, kuserPeer::MOBILE_NUM => 20, kuserPeer::MATURE_CONTENT => 21, kuserPeer::GENDER => 22, kuserPeer::REGISTRATION_IP => 23, kuserPeer::REGISTRATION_COOKIE => 24, kuserPeer::IM_LIST => 25, kuserPeer::VIEWS => 26, kuserPeer::FANS => 27, kuserPeer::ENTRIES => 28, kuserPeer::PRODUCED_KSHOWS => 29, kuserPeer::STATUS => 30, kuserPeer::CREATED_AT => 31, kuserPeer::UPDATED_AT => 32, kuserPeer::PARTNER_ID => 33, kuserPeer::DISPLAY_IN_SEARCH => 34, kuserPeer::SEARCH_TEXT => 35, kuserPeer::PARTNER_DATA => 36, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'screen_name' => 1, 'full_name' => 2, 'email' => 3, 'sha1_password' => 4, 'salt' => 5, 'date_of_birth' => 6, 'country' => 7, 'state' => 8, 'city' => 9, 'zip' => 10, 'url_list' => 11, 'picture' => 12, 'icon' => 13, 'about_me' => 14, 'tags' => 15, 'tagline' => 16, 'network_highschool' => 17, 'network_college' => 18, 'network_other' => 19, 'mobile_num' => 20, 'mature_content' => 21, 'gender' => 22, 'registration_ip' => 23, 'registration_cookie' => 24, 'im_list' => 25, 'views' => 26, 'fans' => 27, 'entries' => 28, 'produced_kshows' => 29, 'status' => 30, 'created_at' => 31, 'updated_at' => 32, 'partner_id' => 33, 'display_in_search' => 34, 'search_text' => 35, 'partner_data' => 36, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/kuserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.kuserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = kuserPeer::getTableMap();
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
		return str_replace(kuserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(kuserPeer::ID);

		$criteria->addSelectColumn(kuserPeer::SCREEN_NAME);

		$criteria->addSelectColumn(kuserPeer::FULL_NAME);

		$criteria->addSelectColumn(kuserPeer::EMAIL);

		$criteria->addSelectColumn(kuserPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(kuserPeer::SALT);

		$criteria->addSelectColumn(kuserPeer::DATE_OF_BIRTH);

		$criteria->addSelectColumn(kuserPeer::COUNTRY);

		$criteria->addSelectColumn(kuserPeer::STATE);

		$criteria->addSelectColumn(kuserPeer::CITY);

		$criteria->addSelectColumn(kuserPeer::ZIP);

		$criteria->addSelectColumn(kuserPeer::URL_LIST);

		$criteria->addSelectColumn(kuserPeer::PICTURE);

		$criteria->addSelectColumn(kuserPeer::ICON);

		$criteria->addSelectColumn(kuserPeer::ABOUT_ME);

		$criteria->addSelectColumn(kuserPeer::TAGS);

		$criteria->addSelectColumn(kuserPeer::TAGLINE);

		$criteria->addSelectColumn(kuserPeer::NETWORK_HIGHSCHOOL);

		$criteria->addSelectColumn(kuserPeer::NETWORK_COLLEGE);

		$criteria->addSelectColumn(kuserPeer::NETWORK_OTHER);

		$criteria->addSelectColumn(kuserPeer::MOBILE_NUM);

		$criteria->addSelectColumn(kuserPeer::MATURE_CONTENT);

		$criteria->addSelectColumn(kuserPeer::GENDER);

		$criteria->addSelectColumn(kuserPeer::REGISTRATION_IP);

		$criteria->addSelectColumn(kuserPeer::REGISTRATION_COOKIE);

		$criteria->addSelectColumn(kuserPeer::IM_LIST);

		$criteria->addSelectColumn(kuserPeer::VIEWS);

		$criteria->addSelectColumn(kuserPeer::FANS);

		$criteria->addSelectColumn(kuserPeer::ENTRIES);

		$criteria->addSelectColumn(kuserPeer::PRODUCED_KSHOWS);

		$criteria->addSelectColumn(kuserPeer::STATUS);

		$criteria->addSelectColumn(kuserPeer::CREATED_AT);

		$criteria->addSelectColumn(kuserPeer::UPDATED_AT);

		$criteria->addSelectColumn(kuserPeer::PARTNER_ID);

		$criteria->addSelectColumn(kuserPeer::DISPLAY_IN_SEARCH);

		$criteria->addSelectColumn(kuserPeer::SEARCH_TEXT);

		$criteria->addSelectColumn(kuserPeer::PARTNER_DATA);

	}

	const COUNT = 'COUNT(kuser.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT kuser.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(kuserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(kuserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = kuserPeer::doSelectRS($criteria, $con);
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
		$objects = kuserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return kuserPeer::populateObjects(kuserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			kuserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = kuserPeer::getOMClass();
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
		return kuserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(kuserPeer::ID); 

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
			$comparison = $criteria->getComparison(kuserPeer::ID);
			$selectCriteria->add(kuserPeer::ID, $criteria->remove(kuserPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(kuserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(kuserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof kuser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(kuserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(kuser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(kuserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(kuserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(kuserPeer::DATABASE_NAME, kuserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = kuserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(kuserPeer::DATABASE_NAME);

		$criteria->add(kuserPeer::ID, $pk);


		$v = kuserPeer::doSelect($criteria, $con);

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
			$criteria->add(kuserPeer::ID, $pks, Criteria::IN);
			$objs = kuserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasekuserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/kuserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.kuserMapBuilder');
}
