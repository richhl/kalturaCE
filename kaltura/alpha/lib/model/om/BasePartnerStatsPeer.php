<?php


abstract class BasePartnerStatsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'partner_stats';

	
	const CLASS_DEFAULT = 'lib.model.PartnerStats';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PARTNER_ID = 'partner_stats.PARTNER_ID';

	
	const VIEWS = 'partner_stats.VIEWS';

	
	const PLAYS = 'partner_stats.PLAYS';

	
	const VIDEOS = 'partner_stats.VIDEOS';

	
	const AUDIOS = 'partner_stats.AUDIOS';

	
	const IMAGES = 'partner_stats.IMAGES';

	
	const ENTRIES = 'partner_stats.ENTRIES';

	
	const USERS_1 = 'partner_stats.USERS_1';

	
	const USERS_2 = 'partner_stats.USERS_2';

	
	const RC_1 = 'partner_stats.RC_1';

	
	const RC_2 = 'partner_stats.RC_2';

	
	const KSHOWS_1 = 'partner_stats.KSHOWS_1';

	
	const KSHOWS_2 = 'partner_stats.KSHOWS_2';

	
	const CREATED_AT = 'partner_stats.CREATED_AT';

	
	const UPDATED_AT = 'partner_stats.UPDATED_AT';

	
	const CUSTOM_DATA = 'partner_stats.CUSTOM_DATA';

	
	const WIDGETS = 'partner_stats.WIDGETS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('PartnerId', 'Views', 'Plays', 'Videos', 'Audios', 'Images', 'Entries', 'Users1', 'Users2', 'Rc1', 'Rc2', 'Kshows1', 'Kshows2', 'CreatedAt', 'UpdatedAt', 'CustomData', 'Widgets', ),
		BasePeer::TYPE_COLNAME => array (PartnerStatsPeer::PARTNER_ID, PartnerStatsPeer::VIEWS, PartnerStatsPeer::PLAYS, PartnerStatsPeer::VIDEOS, PartnerStatsPeer::AUDIOS, PartnerStatsPeer::IMAGES, PartnerStatsPeer::ENTRIES, PartnerStatsPeer::USERS_1, PartnerStatsPeer::USERS_2, PartnerStatsPeer::RC_1, PartnerStatsPeer::RC_2, PartnerStatsPeer::KSHOWS_1, PartnerStatsPeer::KSHOWS_2, PartnerStatsPeer::CREATED_AT, PartnerStatsPeer::UPDATED_AT, PartnerStatsPeer::CUSTOM_DATA, PartnerStatsPeer::WIDGETS, ),
		BasePeer::TYPE_FIELDNAME => array ('partner_id', 'views', 'plays', 'videos', 'audios', 'images', 'entries', 'users_1', 'users_2', 'rc_1', 'rc_2', 'kshows_1', 'kshows_2', 'created_at', 'updated_at', 'custom_data', 'widgets', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('PartnerId' => 0, 'Views' => 1, 'Plays' => 2, 'Videos' => 3, 'Audios' => 4, 'Images' => 5, 'Entries' => 6, 'Users1' => 7, 'Users2' => 8, 'Rc1' => 9, 'Rc2' => 10, 'Kshows1' => 11, 'Kshows2' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, 'CustomData' => 15, 'Widgets' => 16, ),
		BasePeer::TYPE_COLNAME => array (PartnerStatsPeer::PARTNER_ID => 0, PartnerStatsPeer::VIEWS => 1, PartnerStatsPeer::PLAYS => 2, PartnerStatsPeer::VIDEOS => 3, PartnerStatsPeer::AUDIOS => 4, PartnerStatsPeer::IMAGES => 5, PartnerStatsPeer::ENTRIES => 6, PartnerStatsPeer::USERS_1 => 7, PartnerStatsPeer::USERS_2 => 8, PartnerStatsPeer::RC_1 => 9, PartnerStatsPeer::RC_2 => 10, PartnerStatsPeer::KSHOWS_1 => 11, PartnerStatsPeer::KSHOWS_2 => 12, PartnerStatsPeer::CREATED_AT => 13, PartnerStatsPeer::UPDATED_AT => 14, PartnerStatsPeer::CUSTOM_DATA => 15, PartnerStatsPeer::WIDGETS => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('partner_id' => 0, 'views' => 1, 'plays' => 2, 'videos' => 3, 'audios' => 4, 'images' => 5, 'entries' => 6, 'users_1' => 7, 'users_2' => 8, 'rc_1' => 9, 'rc_2' => 10, 'kshows_1' => 11, 'kshows_2' => 12, 'created_at' => 13, 'updated_at' => 14, 'custom_data' => 15, 'widgets' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PartnerStatsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PartnerStatsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PartnerStatsPeer::getTableMap();
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
		return str_replace(PartnerStatsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PartnerStatsPeer::PARTNER_ID);

		$criteria->addSelectColumn(PartnerStatsPeer::VIEWS);

		$criteria->addSelectColumn(PartnerStatsPeer::PLAYS);

		$criteria->addSelectColumn(PartnerStatsPeer::VIDEOS);

		$criteria->addSelectColumn(PartnerStatsPeer::AUDIOS);

		$criteria->addSelectColumn(PartnerStatsPeer::IMAGES);

		$criteria->addSelectColumn(PartnerStatsPeer::ENTRIES);

		$criteria->addSelectColumn(PartnerStatsPeer::USERS_1);

		$criteria->addSelectColumn(PartnerStatsPeer::USERS_2);

		$criteria->addSelectColumn(PartnerStatsPeer::RC_1);

		$criteria->addSelectColumn(PartnerStatsPeer::RC_2);

		$criteria->addSelectColumn(PartnerStatsPeer::KSHOWS_1);

		$criteria->addSelectColumn(PartnerStatsPeer::KSHOWS_2);

		$criteria->addSelectColumn(PartnerStatsPeer::CREATED_AT);

		$criteria->addSelectColumn(PartnerStatsPeer::UPDATED_AT);

		$criteria->addSelectColumn(PartnerStatsPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(PartnerStatsPeer::WIDGETS);

	}

	const COUNT = 'COUNT(partner_stats.PARTNER_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT partner_stats.PARTNER_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PartnerStatsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PartnerStatsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PartnerStatsPeer::doSelectRS($criteria, $con);
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
		$objects = PartnerStatsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PartnerStatsPeer::populateObjects(PartnerStatsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PartnerStatsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PartnerStatsPeer::getOMClass();
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
		return PartnerStatsPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(PartnerStatsPeer::PARTNER_ID);
			$selectCriteria->add(PartnerStatsPeer::PARTNER_ID, $criteria->remove(PartnerStatsPeer::PARTNER_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PartnerStatsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PartnerStatsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PartnerStats) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PartnerStatsPeer::PARTNER_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PartnerStats $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PartnerStatsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PartnerStatsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PartnerStatsPeer::DATABASE_NAME, PartnerStatsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PartnerStatsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PartnerStatsPeer::DATABASE_NAME);

		$criteria->add(PartnerStatsPeer::PARTNER_ID, $pk);


		$v = PartnerStatsPeer::doSelect($criteria, $con);

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
			$criteria->add(PartnerStatsPeer::PARTNER_ID, $pks, Criteria::IN);
			$objs = PartnerStatsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePartnerStatsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PartnerStatsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PartnerStatsMapBuilder');
}
