<?php


abstract class BaseStoragePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'storage';

	
	const CLASS_DEFAULT = 'lib.model.Storage';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'storage.ID';

	
	const CREATED_AT = 'storage.CREATED_AT';

	
	const UPDATED_AT = 'storage.UPDATED_AT';

	
	const PARTNER_ID = 'storage.PARTNER_ID';

	
	const NAME = 'storage.NAME';

	
	const DESCIPTION = 'storage.DESCIPTION';

	
	const STATUS = 'storage.STATUS';

	
	const PROTOCOL = 'storage.PROTOCOL';

	
	const STORAGE_URL = 'storage.STORAGE_URL';

	
	const STORAGE_BASE_DIR = 'storage.STORAGE_BASE_DIR';

	
	const STORAGE_USERNAME = 'storage.STORAGE_USERNAME';

	
	const STORAGE_PASSWORD = 'storage.STORAGE_PASSWORD';

	
	const STORAGE_FTP_PASSIVE_MODE = 'storage.STORAGE_FTP_PASSIVE_MODE';

	
	const DELIVERY_HTTP_BASE_URL = 'storage.DELIVERY_HTTP_BASE_URL';

	
	const DELIVERY_RMP_BASE_URL = 'storage.DELIVERY_RMP_BASE_URL';

	
	const DELIVERY_IIS_BASE_URL = 'storage.DELIVERY_IIS_BASE_URL';

	
	const MIN_FILE_SIZE = 'storage.MIN_FILE_SIZE';

	
	const MAX_FILE_SIZE = 'storage.MAX_FILE_SIZE';

	
	const FLAVOR_PARAMS_IDS = 'storage.FLAVOR_PARAMS_IDS';

	
	const MAX_CONCURRENT_CONNECTIONS = 'storage.MAX_CONCURRENT_CONNECTIONS';

	
	const CUSTOM_DATA = 'storage.CUSTOM_DATA';

	
	const PATH_MANAGER = 'storage.PATH_MANAGER';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'PartnerId', 'Name', 'Desciption', 'Status', 'Protocol', 'StorageUrl', 'StorageBaseDir', 'StorageUsername', 'StoragePassword', 'StorageFtpPassiveMode', 'DeliveryHttpBaseUrl', 'DeliveryRmpBaseUrl', 'DeliveryIisBaseUrl', 'MinFileSize', 'MaxFileSize', 'FlavorParamsIds', 'MaxConcurrentConnections', 'CustomData', 'PathManager', ),
		BasePeer::TYPE_COLNAME => array (StoragePeer::ID, StoragePeer::CREATED_AT, StoragePeer::UPDATED_AT, StoragePeer::PARTNER_ID, StoragePeer::NAME, StoragePeer::DESCIPTION, StoragePeer::STATUS, StoragePeer::PROTOCOL, StoragePeer::STORAGE_URL, StoragePeer::STORAGE_BASE_DIR, StoragePeer::STORAGE_USERNAME, StoragePeer::STORAGE_PASSWORD, StoragePeer::STORAGE_FTP_PASSIVE_MODE, StoragePeer::DELIVERY_HTTP_BASE_URL, StoragePeer::DELIVERY_RMP_BASE_URL, StoragePeer::DELIVERY_IIS_BASE_URL, StoragePeer::MIN_FILE_SIZE, StoragePeer::MAX_FILE_SIZE, StoragePeer::FLAVOR_PARAMS_IDS, StoragePeer::MAX_CONCURRENT_CONNECTIONS, StoragePeer::CUSTOM_DATA, StoragePeer::PATH_MANAGER, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'partner_id', 'name', 'desciption', 'status', 'protocol', 'storage_url', 'storage_base_dir', 'storage_username', 'storage_password', 'storage_ftp_passive_mode', 'delivery_http_base_url', 'delivery_rmp_base_url', 'delivery_iis_base_url', 'min_file_size', 'max_file_size', 'flavor_params_ids', 'max_concurrent_connections', 'custom_data', 'path_manager', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'PartnerId' => 3, 'Name' => 4, 'Desciption' => 5, 'Status' => 6, 'Protocol' => 7, 'StorageUrl' => 8, 'StorageBaseDir' => 9, 'StorageUsername' => 10, 'StoragePassword' => 11, 'StorageFtpPassiveMode' => 12, 'DeliveryHttpBaseUrl' => 13, 'DeliveryRmpBaseUrl' => 14, 'DeliveryIisBaseUrl' => 15, 'MinFileSize' => 16, 'MaxFileSize' => 17, 'FlavorParamsIds' => 18, 'MaxConcurrentConnections' => 19, 'CustomData' => 20, 'PathManager' => 21, ),
		BasePeer::TYPE_COLNAME => array (StoragePeer::ID => 0, StoragePeer::CREATED_AT => 1, StoragePeer::UPDATED_AT => 2, StoragePeer::PARTNER_ID => 3, StoragePeer::NAME => 4, StoragePeer::DESCIPTION => 5, StoragePeer::STATUS => 6, StoragePeer::PROTOCOL => 7, StoragePeer::STORAGE_URL => 8, StoragePeer::STORAGE_BASE_DIR => 9, StoragePeer::STORAGE_USERNAME => 10, StoragePeer::STORAGE_PASSWORD => 11, StoragePeer::STORAGE_FTP_PASSIVE_MODE => 12, StoragePeer::DELIVERY_HTTP_BASE_URL => 13, StoragePeer::DELIVERY_RMP_BASE_URL => 14, StoragePeer::DELIVERY_IIS_BASE_URL => 15, StoragePeer::MIN_FILE_SIZE => 16, StoragePeer::MAX_FILE_SIZE => 17, StoragePeer::FLAVOR_PARAMS_IDS => 18, StoragePeer::MAX_CONCURRENT_CONNECTIONS => 19, StoragePeer::CUSTOM_DATA => 20, StoragePeer::PATH_MANAGER => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'partner_id' => 3, 'name' => 4, 'desciption' => 5, 'status' => 6, 'protocol' => 7, 'storage_url' => 8, 'storage_base_dir' => 9, 'storage_username' => 10, 'storage_password' => 11, 'storage_ftp_passive_mode' => 12, 'delivery_http_base_url' => 13, 'delivery_rmp_base_url' => 14, 'delivery_iis_base_url' => 15, 'min_file_size' => 16, 'max_file_size' => 17, 'flavor_params_ids' => 18, 'max_concurrent_connections' => 19, 'custom_data' => 20, 'path_manager' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/StorageMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.StorageMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = StoragePeer::getTableMap();
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
		return str_replace(StoragePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(StoragePeer::ID);

		$criteria->addSelectColumn(StoragePeer::CREATED_AT);

		$criteria->addSelectColumn(StoragePeer::UPDATED_AT);

		$criteria->addSelectColumn(StoragePeer::PARTNER_ID);

		$criteria->addSelectColumn(StoragePeer::NAME);

		$criteria->addSelectColumn(StoragePeer::DESCIPTION);

		$criteria->addSelectColumn(StoragePeer::STATUS);

		$criteria->addSelectColumn(StoragePeer::PROTOCOL);

		$criteria->addSelectColumn(StoragePeer::STORAGE_URL);

		$criteria->addSelectColumn(StoragePeer::STORAGE_BASE_DIR);

		$criteria->addSelectColumn(StoragePeer::STORAGE_USERNAME);

		$criteria->addSelectColumn(StoragePeer::STORAGE_PASSWORD);

		$criteria->addSelectColumn(StoragePeer::STORAGE_FTP_PASSIVE_MODE);

		$criteria->addSelectColumn(StoragePeer::DELIVERY_HTTP_BASE_URL);

		$criteria->addSelectColumn(StoragePeer::DELIVERY_RMP_BASE_URL);

		$criteria->addSelectColumn(StoragePeer::DELIVERY_IIS_BASE_URL);

		$criteria->addSelectColumn(StoragePeer::MIN_FILE_SIZE);

		$criteria->addSelectColumn(StoragePeer::MAX_FILE_SIZE);

		$criteria->addSelectColumn(StoragePeer::FLAVOR_PARAMS_IDS);

		$criteria->addSelectColumn(StoragePeer::MAX_CONCURRENT_CONNECTIONS);

		$criteria->addSelectColumn(StoragePeer::CUSTOM_DATA);

		$criteria->addSelectColumn(StoragePeer::PATH_MANAGER);

	}

	const COUNT = 'COUNT(storage.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT storage.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(StoragePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(StoragePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = StoragePeer::doSelectRS($criteria, $con);
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
		$objects = StoragePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return StoragePeer::populateObjects(StoragePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			StoragePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = StoragePeer::getOMClass();
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
		return StoragePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(StoragePeer::ID); 

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
			$comparison = $criteria->getComparison(StoragePeer::ID);
			$selectCriteria->add(StoragePeer::ID, $criteria->remove(StoragePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(StoragePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(StoragePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Storage) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(StoragePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Storage $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(StoragePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(StoragePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(StoragePeer::DATABASE_NAME, StoragePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = StoragePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(StoragePeer::DATABASE_NAME);

		$criteria->add(StoragePeer::ID, $pk);


		$v = StoragePeer::doSelect($criteria, $con);

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
			$criteria->add(StoragePeer::ID, $pks, Criteria::IN);
			$objs = StoragePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseStoragePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/StorageMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.StorageMapBuilder');
}
