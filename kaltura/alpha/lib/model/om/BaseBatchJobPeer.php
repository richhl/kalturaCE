<?php


abstract class BaseBatchJobPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'batch_job';

	
	const CLASS_DEFAULT = 'lib.model.BatchJob';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'batch_job.ID';

	
	const JOB_TYPE = 'batch_job.JOB_TYPE';

	
	const JOB_SUB_TYPE = 'batch_job.JOB_SUB_TYPE';

	
	const DATA = 'batch_job.DATA';

	
	const STATUS = 'batch_job.STATUS';

	
	const ABORT = 'batch_job.ABORT';

	
	const CHECK_AGAIN_TIMEOUT = 'batch_job.CHECK_AGAIN_TIMEOUT';

	
	const PROGRESS = 'batch_job.PROGRESS';

	
	const MESSAGE = 'batch_job.MESSAGE';

	
	const DESCRIPTION = 'batch_job.DESCRIPTION';

	
	const UPDATES_COUNT = 'batch_job.UPDATES_COUNT';

	
	const CREATED_AT = 'batch_job.CREATED_AT';

	
	const UPDATED_AT = 'batch_job.UPDATED_AT';

	
	const ENTRY_ID = 'batch_job.ENTRY_ID';

	
	const PARTNER_ID = 'batch_job.PARTNER_ID';

	
	const SUBP_ID = 'batch_job.SUBP_ID';

	
	const PROCESSOR_NAME = 'batch_job.PROCESSOR_NAME';

	
	const PROCESSOR_LOCATION = 'batch_job.PROCESSOR_LOCATION';

	
	const PROCESSOR_EXPIRATION = 'batch_job.PROCESSOR_EXPIRATION';

	
	const EXECUTION_ATTEMPTS = 'batch_job.EXECUTION_ATTEMPTS';

	
	const LOCK_VERSION = 'batch_job.LOCK_VERSION';

	
	const PARENT_JOB_ID = 'batch_job.PARENT_JOB_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'JobType', 'JobSubType', 'Data', 'Status', 'Abort', 'CheckAgainTimeout', 'Progress', 'Message', 'Description', 'UpdatesCount', 'CreatedAt', 'UpdatedAt', 'EntryId', 'PartnerId', 'SubpId', 'ProcessorName', 'ProcessorLocation', 'ProcessorExpiration', 'ExecutionAttempts', 'LockVersion', 'ParentJobId', ),
		BasePeer::TYPE_COLNAME => array (BatchJobPeer::ID, BatchJobPeer::JOB_TYPE, BatchJobPeer::JOB_SUB_TYPE, BatchJobPeer::DATA, BatchJobPeer::STATUS, BatchJobPeer::ABORT, BatchJobPeer::CHECK_AGAIN_TIMEOUT, BatchJobPeer::PROGRESS, BatchJobPeer::MESSAGE, BatchJobPeer::DESCRIPTION, BatchJobPeer::UPDATES_COUNT, BatchJobPeer::CREATED_AT, BatchJobPeer::UPDATED_AT, BatchJobPeer::ENTRY_ID, BatchJobPeer::PARTNER_ID, BatchJobPeer::SUBP_ID, BatchJobPeer::PROCESSOR_NAME, BatchJobPeer::PROCESSOR_LOCATION, BatchJobPeer::PROCESSOR_EXPIRATION, BatchJobPeer::EXECUTION_ATTEMPTS, BatchJobPeer::LOCK_VERSION, BatchJobPeer::PARENT_JOB_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'job_type', 'job_sub_type', 'data', 'status', 'abort', 'check_again_timeout', 'progress', 'message', 'description', 'updates_count', 'created_at', 'updated_at', 'entry_id', 'partner_id', 'subp_id', 'processor_name', 'processor_location', 'processor_expiration', 'execution_attempts', 'lock_version', 'parent_job_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'JobType' => 1, 'JobSubType' => 2, 'Data' => 3, 'Status' => 4, 'Abort' => 5, 'CheckAgainTimeout' => 6, 'Progress' => 7, 'Message' => 8, 'Description' => 9, 'UpdatesCount' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'EntryId' => 13, 'PartnerId' => 14, 'SubpId' => 15, 'ProcessorName' => 16, 'ProcessorLocation' => 17, 'ProcessorExpiration' => 18, 'ExecutionAttempts' => 19, 'LockVersion' => 20, 'ParentJobId' => 21, ),
		BasePeer::TYPE_COLNAME => array (BatchJobPeer::ID => 0, BatchJobPeer::JOB_TYPE => 1, BatchJobPeer::JOB_SUB_TYPE => 2, BatchJobPeer::DATA => 3, BatchJobPeer::STATUS => 4, BatchJobPeer::ABORT => 5, BatchJobPeer::CHECK_AGAIN_TIMEOUT => 6, BatchJobPeer::PROGRESS => 7, BatchJobPeer::MESSAGE => 8, BatchJobPeer::DESCRIPTION => 9, BatchJobPeer::UPDATES_COUNT => 10, BatchJobPeer::CREATED_AT => 11, BatchJobPeer::UPDATED_AT => 12, BatchJobPeer::ENTRY_ID => 13, BatchJobPeer::PARTNER_ID => 14, BatchJobPeer::SUBP_ID => 15, BatchJobPeer::PROCESSOR_NAME => 16, BatchJobPeer::PROCESSOR_LOCATION => 17, BatchJobPeer::PROCESSOR_EXPIRATION => 18, BatchJobPeer::EXECUTION_ATTEMPTS => 19, BatchJobPeer::LOCK_VERSION => 20, BatchJobPeer::PARENT_JOB_ID => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'job_type' => 1, 'job_sub_type' => 2, 'data' => 3, 'status' => 4, 'abort' => 5, 'check_again_timeout' => 6, 'progress' => 7, 'message' => 8, 'description' => 9, 'updates_count' => 10, 'created_at' => 11, 'updated_at' => 12, 'entry_id' => 13, 'partner_id' => 14, 'subp_id' => 15, 'processor_name' => 16, 'processor_location' => 17, 'processor_expiration' => 18, 'execution_attempts' => 19, 'lock_version' => 20, 'parent_job_id' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/BatchJobMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.BatchJobMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = BatchJobPeer::getTableMap();
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
		return str_replace(BatchJobPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(BatchJobPeer::ID);

		$criteria->addSelectColumn(BatchJobPeer::JOB_TYPE);

		$criteria->addSelectColumn(BatchJobPeer::JOB_SUB_TYPE);

		$criteria->addSelectColumn(BatchJobPeer::DATA);

		$criteria->addSelectColumn(BatchJobPeer::STATUS);

		$criteria->addSelectColumn(BatchJobPeer::ABORT);

		$criteria->addSelectColumn(BatchJobPeer::CHECK_AGAIN_TIMEOUT);

		$criteria->addSelectColumn(BatchJobPeer::PROGRESS);

		$criteria->addSelectColumn(BatchJobPeer::MESSAGE);

		$criteria->addSelectColumn(BatchJobPeer::DESCRIPTION);

		$criteria->addSelectColumn(BatchJobPeer::UPDATES_COUNT);

		$criteria->addSelectColumn(BatchJobPeer::CREATED_AT);

		$criteria->addSelectColumn(BatchJobPeer::UPDATED_AT);

		$criteria->addSelectColumn(BatchJobPeer::ENTRY_ID);

		$criteria->addSelectColumn(BatchJobPeer::PARTNER_ID);

		$criteria->addSelectColumn(BatchJobPeer::SUBP_ID);

		$criteria->addSelectColumn(BatchJobPeer::PROCESSOR_NAME);

		$criteria->addSelectColumn(BatchJobPeer::PROCESSOR_LOCATION);

		$criteria->addSelectColumn(BatchJobPeer::PROCESSOR_EXPIRATION);

		$criteria->addSelectColumn(BatchJobPeer::EXECUTION_ATTEMPTS);

		$criteria->addSelectColumn(BatchJobPeer::LOCK_VERSION);

		$criteria->addSelectColumn(BatchJobPeer::PARENT_JOB_ID);

	}

	const COUNT = 'COUNT(batch_job.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT batch_job.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BatchJobPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BatchJobPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = BatchJobPeer::doSelectRS($criteria, $con);
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
		$objects = BatchJobPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return BatchJobPeer::populateObjects(BatchJobPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			BatchJobPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = BatchJobPeer::getOMClass();
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
		return BatchJobPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(BatchJobPeer::ID); 

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
			$comparison = $criteria->getComparison(BatchJobPeer::ID);
			$selectCriteria->add(BatchJobPeer::ID, $criteria->remove(BatchJobPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(BatchJobPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(BatchJobPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof BatchJob) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(BatchJobPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(BatchJob $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(BatchJobPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(BatchJobPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(BatchJobPeer::DATABASE_NAME, BatchJobPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = BatchJobPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(BatchJobPeer::DATABASE_NAME);

		$criteria->add(BatchJobPeer::ID, $pk);


		$v = BatchJobPeer::doSelect($criteria, $con);

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
			$criteria->add(BatchJobPeer::ID, $pks, Criteria::IN);
			$objs = BatchJobPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseBatchJobPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/BatchJobMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.BatchJobMapBuilder');
}
