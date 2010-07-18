<?php


abstract class BaseFileSyncPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'file_sync';

	
	const CLASS_DEFAULT = 'lib.model.FileSync';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'file_sync.ID';

	
	const PARTNER_ID = 'file_sync.PARTNER_ID';

	
	const OBJECT_TYPE = 'file_sync.OBJECT_TYPE';

	
	const OBJECT_ID = 'file_sync.OBJECT_ID';

	
	const VERSION = 'file_sync.VERSION';

	
	const OBJECT_SUB_TYPE = 'file_sync.OBJECT_SUB_TYPE';

	
	const DC = 'file_sync.DC';

	
	const ORIGINAL = 'file_sync.ORIGINAL';

	
	const CREATED_AT = 'file_sync.CREATED_AT';

	
	const UPDATED_AT = 'file_sync.UPDATED_AT';

	
	const READY_AT = 'file_sync.READY_AT';

	
	const SYNC_TIME = 'file_sync.SYNC_TIME';

	
	const STATUS = 'file_sync.STATUS';

	
	const FILE_TYPE = 'file_sync.FILE_TYPE';

	
	const LINKED_ID = 'file_sync.LINKED_ID';

	
	const LINK_COUNT = 'file_sync.LINK_COUNT';

	
	const FILE_ROOT = 'file_sync.FILE_ROOT';

	
	const FILE_PATH = 'file_sync.FILE_PATH';

	
	const FILE_SIZE = 'file_sync.FILE_SIZE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'ObjectType', 'ObjectId', 'Version', 'ObjectSubType', 'Dc', 'Original', 'CreatedAt', 'UpdatedAt', 'ReadyAt', 'SyncTime', 'Status', 'FileType', 'LinkedId', 'LinkCount', 'FileRoot', 'FilePath', 'FileSize', ),
		BasePeer::TYPE_COLNAME => array (FileSyncPeer::ID, FileSyncPeer::PARTNER_ID, FileSyncPeer::OBJECT_TYPE, FileSyncPeer::OBJECT_ID, FileSyncPeer::VERSION, FileSyncPeer::OBJECT_SUB_TYPE, FileSyncPeer::DC, FileSyncPeer::ORIGINAL, FileSyncPeer::CREATED_AT, FileSyncPeer::UPDATED_AT, FileSyncPeer::READY_AT, FileSyncPeer::SYNC_TIME, FileSyncPeer::STATUS, FileSyncPeer::FILE_TYPE, FileSyncPeer::LINKED_ID, FileSyncPeer::LINK_COUNT, FileSyncPeer::FILE_ROOT, FileSyncPeer::FILE_PATH, FileSyncPeer::FILE_SIZE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'object_type', 'object_id', 'version', 'object_sub_type', 'dc', 'original', 'created_at', 'updated_at', 'ready_at', 'sync_time', 'status', 'file_type', 'linked_id', 'link_count', 'file_root', 'file_path', 'file_size', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'ObjectType' => 2, 'ObjectId' => 3, 'Version' => 4, 'ObjectSubType' => 5, 'Dc' => 6, 'Original' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'ReadyAt' => 10, 'SyncTime' => 11, 'Status' => 12, 'FileType' => 13, 'LinkedId' => 14, 'LinkCount' => 15, 'FileRoot' => 16, 'FilePath' => 17, 'FileSize' => 18, ),
		BasePeer::TYPE_COLNAME => array (FileSyncPeer::ID => 0, FileSyncPeer::PARTNER_ID => 1, FileSyncPeer::OBJECT_TYPE => 2, FileSyncPeer::OBJECT_ID => 3, FileSyncPeer::VERSION => 4, FileSyncPeer::OBJECT_SUB_TYPE => 5, FileSyncPeer::DC => 6, FileSyncPeer::ORIGINAL => 7, FileSyncPeer::CREATED_AT => 8, FileSyncPeer::UPDATED_AT => 9, FileSyncPeer::READY_AT => 10, FileSyncPeer::SYNC_TIME => 11, FileSyncPeer::STATUS => 12, FileSyncPeer::FILE_TYPE => 13, FileSyncPeer::LINKED_ID => 14, FileSyncPeer::LINK_COUNT => 15, FileSyncPeer::FILE_ROOT => 16, FileSyncPeer::FILE_PATH => 17, FileSyncPeer::FILE_SIZE => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'object_type' => 2, 'object_id' => 3, 'version' => 4, 'object_sub_type' => 5, 'dc' => 6, 'original' => 7, 'created_at' => 8, 'updated_at' => 9, 'ready_at' => 10, 'sync_time' => 11, 'status' => 12, 'file_type' => 13, 'linked_id' => 14, 'link_count' => 15, 'file_root' => 16, 'file_path' => 17, 'file_size' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FileSyncMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FileSyncMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FileSyncPeer::getTableMap();
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
		return str_replace(FileSyncPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FileSyncPeer::ID);

		$criteria->addSelectColumn(FileSyncPeer::PARTNER_ID);

		$criteria->addSelectColumn(FileSyncPeer::OBJECT_TYPE);

		$criteria->addSelectColumn(FileSyncPeer::OBJECT_ID);

		$criteria->addSelectColumn(FileSyncPeer::VERSION);

		$criteria->addSelectColumn(FileSyncPeer::OBJECT_SUB_TYPE);

		$criteria->addSelectColumn(FileSyncPeer::DC);

		$criteria->addSelectColumn(FileSyncPeer::ORIGINAL);

		$criteria->addSelectColumn(FileSyncPeer::CREATED_AT);

		$criteria->addSelectColumn(FileSyncPeer::UPDATED_AT);

		$criteria->addSelectColumn(FileSyncPeer::READY_AT);

		$criteria->addSelectColumn(FileSyncPeer::SYNC_TIME);

		$criteria->addSelectColumn(FileSyncPeer::STATUS);

		$criteria->addSelectColumn(FileSyncPeer::FILE_TYPE);

		$criteria->addSelectColumn(FileSyncPeer::LINKED_ID);

		$criteria->addSelectColumn(FileSyncPeer::LINK_COUNT);

		$criteria->addSelectColumn(FileSyncPeer::FILE_ROOT);

		$criteria->addSelectColumn(FileSyncPeer::FILE_PATH);

		$criteria->addSelectColumn(FileSyncPeer::FILE_SIZE);

	}

	const COUNT = 'COUNT(file_sync.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT file_sync.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FileSyncPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileSyncPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FileSyncPeer::doSelectRS($criteria, $con);
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
		$objects = FileSyncPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FileSyncPeer::populateObjects(FileSyncPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FileSyncPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FileSyncPeer::getOMClass();
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
		return FileSyncPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(FileSyncPeer::ID); 

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
			$comparison = $criteria->getComparison(FileSyncPeer::ID);
			$selectCriteria->add(FileSyncPeer::ID, $criteria->remove(FileSyncPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(FileSyncPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FileSyncPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof FileSync) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FileSyncPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(FileSync $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FileSyncPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FileSyncPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FileSyncPeer::DATABASE_NAME, FileSyncPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FileSyncPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FileSyncPeer::DATABASE_NAME);

		$criteria->add(FileSyncPeer::ID, $pk);


		$v = FileSyncPeer::doSelect($criteria, $con);

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
			$criteria->add(FileSyncPeer::ID, $pks, Criteria::IN);
			$objs = FileSyncPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFileSyncPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/FileSyncMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FileSyncMapBuilder');
}
