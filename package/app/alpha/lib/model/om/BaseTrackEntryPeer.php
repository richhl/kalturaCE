<?php


abstract class BaseTrackEntryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'track_entry';

	
	const CLASS_DEFAULT = 'lib.model.TrackEntry';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'track_entry.ID';

	
	const TRACK_EVENT_TYPE_ID = 'track_entry.TRACK_EVENT_TYPE_ID';

	
	const PS_VERSION = 'track_entry.PS_VERSION';

	
	const CONTEXT = 'track_entry.CONTEXT';

	
	const PARTNER_ID = 'track_entry.PARTNER_ID';

	
	const ENTRY_ID = 'track_entry.ENTRY_ID';

	
	const HOST_NAME = 'track_entry.HOST_NAME';

	
	const UID = 'track_entry.UID';

	
	const TRACK_EVENT_STATUS_ID = 'track_entry.TRACK_EVENT_STATUS_ID';

	
	const CHANGED_PROPERTIES = 'track_entry.CHANGED_PROPERTIES';

	
	const PARAM_1_STR = 'track_entry.PARAM_1_STR';

	
	const PARAM_2_STR = 'track_entry.PARAM_2_STR';

	
	const PARAM_3_STR = 'track_entry.PARAM_3_STR';

	
	const KS = 'track_entry.KS';

	
	const DESCRIPTION = 'track_entry.DESCRIPTION';

	
	const CREATED_AT = 'track_entry.CREATED_AT';

	
	const UPDATED_AT = 'track_entry.UPDATED_AT';

	
	const USER_IP = 'track_entry.USER_IP';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TrackEventTypeId', 'PsVersion', 'Context', 'PartnerId', 'EntryId', 'HostName', 'Uid', 'TrackEventStatusId', 'ChangedProperties', 'Param1Str', 'Param2Str', 'Param3Str', 'Ks', 'Description', 'CreatedAt', 'UpdatedAt', 'UserIp', ),
		BasePeer::TYPE_COLNAME => array (TrackEntryPeer::ID, TrackEntryPeer::TRACK_EVENT_TYPE_ID, TrackEntryPeer::PS_VERSION, TrackEntryPeer::CONTEXT, TrackEntryPeer::PARTNER_ID, TrackEntryPeer::ENTRY_ID, TrackEntryPeer::HOST_NAME, TrackEntryPeer::UID, TrackEntryPeer::TRACK_EVENT_STATUS_ID, TrackEntryPeer::CHANGED_PROPERTIES, TrackEntryPeer::PARAM_1_STR, TrackEntryPeer::PARAM_2_STR, TrackEntryPeer::PARAM_3_STR, TrackEntryPeer::KS, TrackEntryPeer::DESCRIPTION, TrackEntryPeer::CREATED_AT, TrackEntryPeer::UPDATED_AT, TrackEntryPeer::USER_IP, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'track_event_type_id', 'ps_version', 'context', 'partner_id', 'entry_id', 'host_name', 'uid', 'track_event_status_id', 'changed_properties', 'param_1_str', 'param_2_str', 'param_3_str', 'ks', 'description', 'created_at', 'updated_at', 'user_ip', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TrackEventTypeId' => 1, 'PsVersion' => 2, 'Context' => 3, 'PartnerId' => 4, 'EntryId' => 5, 'HostName' => 6, 'Uid' => 7, 'TrackEventStatusId' => 8, 'ChangedProperties' => 9, 'Param1Str' => 10, 'Param2Str' => 11, 'Param3Str' => 12, 'Ks' => 13, 'Description' => 14, 'CreatedAt' => 15, 'UpdatedAt' => 16, 'UserIp' => 17, ),
		BasePeer::TYPE_COLNAME => array (TrackEntryPeer::ID => 0, TrackEntryPeer::TRACK_EVENT_TYPE_ID => 1, TrackEntryPeer::PS_VERSION => 2, TrackEntryPeer::CONTEXT => 3, TrackEntryPeer::PARTNER_ID => 4, TrackEntryPeer::ENTRY_ID => 5, TrackEntryPeer::HOST_NAME => 6, TrackEntryPeer::UID => 7, TrackEntryPeer::TRACK_EVENT_STATUS_ID => 8, TrackEntryPeer::CHANGED_PROPERTIES => 9, TrackEntryPeer::PARAM_1_STR => 10, TrackEntryPeer::PARAM_2_STR => 11, TrackEntryPeer::PARAM_3_STR => 12, TrackEntryPeer::KS => 13, TrackEntryPeer::DESCRIPTION => 14, TrackEntryPeer::CREATED_AT => 15, TrackEntryPeer::UPDATED_AT => 16, TrackEntryPeer::USER_IP => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'track_event_type_id' => 1, 'ps_version' => 2, 'context' => 3, 'partner_id' => 4, 'entry_id' => 5, 'host_name' => 6, 'uid' => 7, 'track_event_status_id' => 8, 'changed_properties' => 9, 'param_1_str' => 10, 'param_2_str' => 11, 'param_3_str' => 12, 'ks' => 13, 'description' => 14, 'created_at' => 15, 'updated_at' => 16, 'user_ip' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/TrackEntryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.TrackEntryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TrackEntryPeer::getTableMap();
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
		return str_replace(TrackEntryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TrackEntryPeer::ID);

		$criteria->addSelectColumn(TrackEntryPeer::TRACK_EVENT_TYPE_ID);

		$criteria->addSelectColumn(TrackEntryPeer::PS_VERSION);

		$criteria->addSelectColumn(TrackEntryPeer::CONTEXT);

		$criteria->addSelectColumn(TrackEntryPeer::PARTNER_ID);

		$criteria->addSelectColumn(TrackEntryPeer::ENTRY_ID);

		$criteria->addSelectColumn(TrackEntryPeer::HOST_NAME);

		$criteria->addSelectColumn(TrackEntryPeer::UID);

		$criteria->addSelectColumn(TrackEntryPeer::TRACK_EVENT_STATUS_ID);

		$criteria->addSelectColumn(TrackEntryPeer::CHANGED_PROPERTIES);

		$criteria->addSelectColumn(TrackEntryPeer::PARAM_1_STR);

		$criteria->addSelectColumn(TrackEntryPeer::PARAM_2_STR);

		$criteria->addSelectColumn(TrackEntryPeer::PARAM_3_STR);

		$criteria->addSelectColumn(TrackEntryPeer::KS);

		$criteria->addSelectColumn(TrackEntryPeer::DESCRIPTION);

		$criteria->addSelectColumn(TrackEntryPeer::CREATED_AT);

		$criteria->addSelectColumn(TrackEntryPeer::UPDATED_AT);

		$criteria->addSelectColumn(TrackEntryPeer::USER_IP);

	}

	const COUNT = 'COUNT(track_entry.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT track_entry.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TrackEntryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrackEntryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TrackEntryPeer::doSelectRS($criteria, $con);
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
		$objects = TrackEntryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TrackEntryPeer::populateObjects(TrackEntryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TrackEntryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TrackEntryPeer::getOMClass();
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
		return TrackEntryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(TrackEntryPeer::ID); 

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
			$comparison = $criteria->getComparison(TrackEntryPeer::ID);
			$selectCriteria->add(TrackEntryPeer::ID, $criteria->remove(TrackEntryPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(TrackEntryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TrackEntryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof TrackEntry) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TrackEntryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(TrackEntry $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TrackEntryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TrackEntryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TrackEntryPeer::DATABASE_NAME, TrackEntryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TrackEntryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(TrackEntryPeer::DATABASE_NAME);

		$criteria->add(TrackEntryPeer::ID, $pk);


		$v = TrackEntryPeer::doSelect($criteria, $con);

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
			$criteria->add(TrackEntryPeer::ID, $pks, Criteria::IN);
			$objs = TrackEntryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTrackEntryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/TrackEntryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.TrackEntryMapBuilder');
}
