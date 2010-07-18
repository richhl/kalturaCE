<?php


abstract class BaseStorageProfilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'storage_profile';

	
	const CLASS_DEFAULT = 'lib.model.StorageProfile';

	
	const NUM_COLUMNS = 23;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'storage_profile.ID';

	
	const CREATED_AT = 'storage_profile.CREATED_AT';

	
	const UPDATED_AT = 'storage_profile.UPDATED_AT';

	
	const PARTNER_ID = 'storage_profile.PARTNER_ID';

	
	const NAME = 'storage_profile.NAME';

	
	const DESCIPTION = 'storage_profile.DESCIPTION';

	
	const STATUS = 'storage_profile.STATUS';

	
	const PROTOCOL = 'storage_profile.PROTOCOL';

	
	const STORAGE_URL = 'storage_profile.STORAGE_URL';

	
	const STORAGE_BASE_DIR = 'storage_profile.STORAGE_BASE_DIR';

	
	const STORAGE_USERNAME = 'storage_profile.STORAGE_USERNAME';

	
	const STORAGE_PASSWORD = 'storage_profile.STORAGE_PASSWORD';

	
	const STORAGE_FTP_PASSIVE_MODE = 'storage_profile.STORAGE_FTP_PASSIVE_MODE';

	
	const DELIVERY_HTTP_BASE_URL = 'storage_profile.DELIVERY_HTTP_BASE_URL';

	
	const DELIVERY_RMP_BASE_URL = 'storage_profile.DELIVERY_RMP_BASE_URL';

	
	const DELIVERY_IIS_BASE_URL = 'storage_profile.DELIVERY_IIS_BASE_URL';

	
	const MIN_FILE_SIZE = 'storage_profile.MIN_FILE_SIZE';

	
	const MAX_FILE_SIZE = 'storage_profile.MAX_FILE_SIZE';

	
	const FLAVOR_PARAMS_IDS = 'storage_profile.FLAVOR_PARAMS_IDS';

	
	const MAX_CONCURRENT_CONNECTIONS = 'storage_profile.MAX_CONCURRENT_CONNECTIONS';

	
	const CUSTOM_DATA = 'storage_profile.CUSTOM_DATA';

	
	const PATH_MANAGER_CLASS = 'storage_profile.PATH_MANAGER_CLASS';

	
	const URL_MANAGER_CLASS = 'storage_profile.URL_MANAGER_CLASS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'PartnerId', 'Name', 'Desciption', 'Status', 'Protocol', 'StorageUrl', 'StorageBaseDir', 'StorageUsername', 'StoragePassword', 'StorageFtpPassiveMode', 'DeliveryHttpBaseUrl', 'DeliveryRmpBaseUrl', 'DeliveryIisBaseUrl', 'MinFileSize', 'MaxFileSize', 'FlavorParamsIds', 'MaxConcurrentConnections', 'CustomData', 'PathManagerClass', 'UrlManagerClass', ),
		BasePeer::TYPE_COLNAME => array (StorageProfilePeer::ID, StorageProfilePeer::CREATED_AT, StorageProfilePeer::UPDATED_AT, StorageProfilePeer::PARTNER_ID, StorageProfilePeer::NAME, StorageProfilePeer::DESCIPTION, StorageProfilePeer::STATUS, StorageProfilePeer::PROTOCOL, StorageProfilePeer::STORAGE_URL, StorageProfilePeer::STORAGE_BASE_DIR, StorageProfilePeer::STORAGE_USERNAME, StorageProfilePeer::STORAGE_PASSWORD, StorageProfilePeer::STORAGE_FTP_PASSIVE_MODE, StorageProfilePeer::DELIVERY_HTTP_BASE_URL, StorageProfilePeer::DELIVERY_RMP_BASE_URL, StorageProfilePeer::DELIVERY_IIS_BASE_URL, StorageProfilePeer::MIN_FILE_SIZE, StorageProfilePeer::MAX_FILE_SIZE, StorageProfilePeer::FLAVOR_PARAMS_IDS, StorageProfilePeer::MAX_CONCURRENT_CONNECTIONS, StorageProfilePeer::CUSTOM_DATA, StorageProfilePeer::PATH_MANAGER_CLASS, StorageProfilePeer::URL_MANAGER_CLASS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'partner_id', 'name', 'desciption', 'status', 'protocol', 'storage_url', 'storage_base_dir', 'storage_username', 'storage_password', 'storage_ftp_passive_mode', 'delivery_http_base_url', 'delivery_rmp_base_url', 'delivery_iis_base_url', 'min_file_size', 'max_file_size', 'flavor_params_ids', 'max_concurrent_connections', 'custom_data', 'path_manager_class', 'url_manager_class', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'PartnerId' => 3, 'Name' => 4, 'Desciption' => 5, 'Status' => 6, 'Protocol' => 7, 'StorageUrl' => 8, 'StorageBaseDir' => 9, 'StorageUsername' => 10, 'StoragePassword' => 11, 'StorageFtpPassiveMode' => 12, 'DeliveryHttpBaseUrl' => 13, 'DeliveryRmpBaseUrl' => 14, 'DeliveryIisBaseUrl' => 15, 'MinFileSize' => 16, 'MaxFileSize' => 17, 'FlavorParamsIds' => 18, 'MaxConcurrentConnections' => 19, 'CustomData' => 20, 'PathManagerClass' => 21, 'UrlManagerClass' => 22, ),
		BasePeer::TYPE_COLNAME => array (StorageProfilePeer::ID => 0, StorageProfilePeer::CREATED_AT => 1, StorageProfilePeer::UPDATED_AT => 2, StorageProfilePeer::PARTNER_ID => 3, StorageProfilePeer::NAME => 4, StorageProfilePeer::DESCIPTION => 5, StorageProfilePeer::STATUS => 6, StorageProfilePeer::PROTOCOL => 7, StorageProfilePeer::STORAGE_URL => 8, StorageProfilePeer::STORAGE_BASE_DIR => 9, StorageProfilePeer::STORAGE_USERNAME => 10, StorageProfilePeer::STORAGE_PASSWORD => 11, StorageProfilePeer::STORAGE_FTP_PASSIVE_MODE => 12, StorageProfilePeer::DELIVERY_HTTP_BASE_URL => 13, StorageProfilePeer::DELIVERY_RMP_BASE_URL => 14, StorageProfilePeer::DELIVERY_IIS_BASE_URL => 15, StorageProfilePeer::MIN_FILE_SIZE => 16, StorageProfilePeer::MAX_FILE_SIZE => 17, StorageProfilePeer::FLAVOR_PARAMS_IDS => 18, StorageProfilePeer::MAX_CONCURRENT_CONNECTIONS => 19, StorageProfilePeer::CUSTOM_DATA => 20, StorageProfilePeer::PATH_MANAGER_CLASS => 21, StorageProfilePeer::URL_MANAGER_CLASS => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'partner_id' => 3, 'name' => 4, 'desciption' => 5, 'status' => 6, 'protocol' => 7, 'storage_url' => 8, 'storage_base_dir' => 9, 'storage_username' => 10, 'storage_password' => 11, 'storage_ftp_passive_mode' => 12, 'delivery_http_base_url' => 13, 'delivery_rmp_base_url' => 14, 'delivery_iis_base_url' => 15, 'min_file_size' => 16, 'max_file_size' => 17, 'flavor_params_ids' => 18, 'max_concurrent_connections' => 19, 'custom_data' => 20, 'path_manager_class' => 21, 'url_manager_class' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/StorageProfileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.StorageProfileMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = StorageProfilePeer::getTableMap();
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
		return str_replace(StorageProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(StorageProfilePeer::ID);

		$criteria->addSelectColumn(StorageProfilePeer::CREATED_AT);

		$criteria->addSelectColumn(StorageProfilePeer::UPDATED_AT);

		$criteria->addSelectColumn(StorageProfilePeer::PARTNER_ID);

		$criteria->addSelectColumn(StorageProfilePeer::NAME);

		$criteria->addSelectColumn(StorageProfilePeer::DESCIPTION);

		$criteria->addSelectColumn(StorageProfilePeer::STATUS);

		$criteria->addSelectColumn(StorageProfilePeer::PROTOCOL);

		$criteria->addSelectColumn(StorageProfilePeer::STORAGE_URL);

		$criteria->addSelectColumn(StorageProfilePeer::STORAGE_BASE_DIR);

		$criteria->addSelectColumn(StorageProfilePeer::STORAGE_USERNAME);

		$criteria->addSelectColumn(StorageProfilePeer::STORAGE_PASSWORD);

		$criteria->addSelectColumn(StorageProfilePeer::STORAGE_FTP_PASSIVE_MODE);

		$criteria->addSelectColumn(StorageProfilePeer::DELIVERY_HTTP_BASE_URL);

		$criteria->addSelectColumn(StorageProfilePeer::DELIVERY_RMP_BASE_URL);

		$criteria->addSelectColumn(StorageProfilePeer::DELIVERY_IIS_BASE_URL);

		$criteria->addSelectColumn(StorageProfilePeer::MIN_FILE_SIZE);

		$criteria->addSelectColumn(StorageProfilePeer::MAX_FILE_SIZE);

		$criteria->addSelectColumn(StorageProfilePeer::FLAVOR_PARAMS_IDS);

		$criteria->addSelectColumn(StorageProfilePeer::MAX_CONCURRENT_CONNECTIONS);

		$criteria->addSelectColumn(StorageProfilePeer::CUSTOM_DATA);

		$criteria->addSelectColumn(StorageProfilePeer::PATH_MANAGER_CLASS);

		$criteria->addSelectColumn(StorageProfilePeer::URL_MANAGER_CLASS);

	}

	const COUNT = 'COUNT(storage_profile.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT storage_profile.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(StorageProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(StorageProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = StorageProfilePeer::doSelectRS($criteria, $con);
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
		$objects = StorageProfilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return StorageProfilePeer::populateObjects(StorageProfilePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			StorageProfilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = StorageProfilePeer::getOMClass();
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
		return StorageProfilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(StorageProfilePeer::ID); 

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
			$comparison = $criteria->getComparison(StorageProfilePeer::ID);
			$selectCriteria->add(StorageProfilePeer::ID, $criteria->remove(StorageProfilePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(StorageProfilePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(StorageProfilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof StorageProfile) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(StorageProfilePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(StorageProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(StorageProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(StorageProfilePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(StorageProfilePeer::DATABASE_NAME, StorageProfilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = StorageProfilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(StorageProfilePeer::DATABASE_NAME);

		$criteria->add(StorageProfilePeer::ID, $pk);


		$v = StorageProfilePeer::doSelect($criteria, $con);

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
			$criteria->add(StorageProfilePeer::ID, $pks, Criteria::IN);
			$objs = StorageProfilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseStorageProfilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/StorageProfileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.StorageProfileMapBuilder');
}
