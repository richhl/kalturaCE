<?php


abstract class BaseBatchJobPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'batch_job';

	
	const CLASS_DEFAULT = 'lib.model.BatchJob';

	
	const NUM_COLUMNS = 42;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'batch_job.ID';

	
	const JOB_TYPE = 'batch_job.JOB_TYPE';

	
	const JOB_SUB_TYPE = 'batch_job.JOB_SUB_TYPE';

	
	const DATA = 'batch_job.DATA';

	
	const FILE_SIZE = 'batch_job.FILE_SIZE';

	
	const DUPLICATION_KEY = 'batch_job.DUPLICATION_KEY';

	
	const STATUS = 'batch_job.STATUS';

	
	const ABORT = 'batch_job.ABORT';

	
	const CHECK_AGAIN_TIMEOUT = 'batch_job.CHECK_AGAIN_TIMEOUT';

	
	const PROGRESS = 'batch_job.PROGRESS';

	
	const MESSAGE = 'batch_job.MESSAGE';

	
	const DESCRIPTION = 'batch_job.DESCRIPTION';

	
	const UPDATES_COUNT = 'batch_job.UPDATES_COUNT';

	
	const CREATED_AT = 'batch_job.CREATED_AT';

	
	const CREATED_BY = 'batch_job.CREATED_BY';

	
	const UPDATED_AT = 'batch_job.UPDATED_AT';

	
	const UPDATED_BY = 'batch_job.UPDATED_BY';

	
	const DELETED_AT = 'batch_job.DELETED_AT';

	
	const PRIORITY = 'batch_job.PRIORITY';

	
	const WORK_GROUP_ID = 'batch_job.WORK_GROUP_ID';

	
	const QUEUE_TIME = 'batch_job.QUEUE_TIME';

	
	const FINISH_TIME = 'batch_job.FINISH_TIME';

	
	const ENTRY_ID = 'batch_job.ENTRY_ID';

	
	const PARTNER_ID = 'batch_job.PARTNER_ID';

	
	const SUBP_ID = 'batch_job.SUBP_ID';

	
	const SCHEDULER_ID = 'batch_job.SCHEDULER_ID';

	
	const WORKER_ID = 'batch_job.WORKER_ID';

	
	const BATCH_INDEX = 'batch_job.BATCH_INDEX';

	
	const LAST_SCHEDULER_ID = 'batch_job.LAST_SCHEDULER_ID';

	
	const LAST_WORKER_ID = 'batch_job.LAST_WORKER_ID';

	
	const LAST_WORKER_REMOTE = 'batch_job.LAST_WORKER_REMOTE';

	
	const PROCESSOR_EXPIRATION = 'batch_job.PROCESSOR_EXPIRATION';

	
	const EXECUTION_ATTEMPTS = 'batch_job.EXECUTION_ATTEMPTS';

	
	const LOCK_VERSION = 'batch_job.LOCK_VERSION';

	
	const TWIN_JOB_ID = 'batch_job.TWIN_JOB_ID';

	
	const BULK_JOB_ID = 'batch_job.BULK_JOB_ID';

	
	const ROOT_JOB_ID = 'batch_job.ROOT_JOB_ID';

	
	const PARENT_JOB_ID = 'batch_job.PARENT_JOB_ID';

	
	const DC = 'batch_job.DC';

	
	const ERR_TYPE = 'batch_job.ERR_TYPE';

	
	const ERR_NUMBER = 'batch_job.ERR_NUMBER';

	
	const ON_STRESS_DIVERT_TO = 'batch_job.ON_STRESS_DIVERT_TO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'JobType', 'JobSubType', 'Data', 'FileSize', 'DuplicationKey', 'Status', 'Abort', 'CheckAgainTimeout', 'Progress', 'Message', 'Description', 'UpdatesCount', 'CreatedAt', 'CreatedBy', 'UpdatedAt', 'UpdatedBy', 'DeletedAt', 'Priority', 'WorkGroupId', 'QueueTime', 'FinishTime', 'EntryId', 'PartnerId', 'SubpId', 'SchedulerId', 'WorkerId', 'BatchIndex', 'LastSchedulerId', 'LastWorkerId', 'LastWorkerRemote', 'ProcessorExpiration', 'ExecutionAttempts', 'LockVersion', 'TwinJobId', 'BulkJobId', 'RootJobId', 'ParentJobId', 'Dc', 'ErrType', 'ErrNumber', 'OnStressDivertTo', ),
		BasePeer::TYPE_COLNAME => array (BatchJobPeer::ID, BatchJobPeer::JOB_TYPE, BatchJobPeer::JOB_SUB_TYPE, BatchJobPeer::DATA, BatchJobPeer::FILE_SIZE, BatchJobPeer::DUPLICATION_KEY, BatchJobPeer::STATUS, BatchJobPeer::ABORT, BatchJobPeer::CHECK_AGAIN_TIMEOUT, BatchJobPeer::PROGRESS, BatchJobPeer::MESSAGE, BatchJobPeer::DESCRIPTION, BatchJobPeer::UPDATES_COUNT, BatchJobPeer::CREATED_AT, BatchJobPeer::CREATED_BY, BatchJobPeer::UPDATED_AT, BatchJobPeer::UPDATED_BY, BatchJobPeer::DELETED_AT, BatchJobPeer::PRIORITY, BatchJobPeer::WORK_GROUP_ID, BatchJobPeer::QUEUE_TIME, BatchJobPeer::FINISH_TIME, BatchJobPeer::ENTRY_ID, BatchJobPeer::PARTNER_ID, BatchJobPeer::SUBP_ID, BatchJobPeer::SCHEDULER_ID, BatchJobPeer::WORKER_ID, BatchJobPeer::BATCH_INDEX, BatchJobPeer::LAST_SCHEDULER_ID, BatchJobPeer::LAST_WORKER_ID, BatchJobPeer::LAST_WORKER_REMOTE, BatchJobPeer::PROCESSOR_EXPIRATION, BatchJobPeer::EXECUTION_ATTEMPTS, BatchJobPeer::LOCK_VERSION, BatchJobPeer::TWIN_JOB_ID, BatchJobPeer::BULK_JOB_ID, BatchJobPeer::ROOT_JOB_ID, BatchJobPeer::PARENT_JOB_ID, BatchJobPeer::DC, BatchJobPeer::ERR_TYPE, BatchJobPeer::ERR_NUMBER, BatchJobPeer::ON_STRESS_DIVERT_TO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'job_type', 'job_sub_type', 'data', 'file_size', 'duplication_key', 'status', 'abort', 'check_again_timeout', 'progress', 'message', 'description', 'updates_count', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'priority', 'work_group_id', 'queue_time', 'finish_time', 'entry_id', 'partner_id', 'subp_id', 'scheduler_id', 'worker_id', 'batch_index', 'last_scheduler_id', 'last_worker_id', 'last_worker_remote', 'processor_expiration', 'execution_attempts', 'lock_version', 'twin_job_id', 'bulk_job_id', 'root_job_id', 'parent_job_id', 'dc', 'err_type', 'err_number', 'on_stress_divert_to', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'JobType' => 1, 'JobSubType' => 2, 'Data' => 3, 'FileSize' => 4, 'DuplicationKey' => 5, 'Status' => 6, 'Abort' => 7, 'CheckAgainTimeout' => 8, 'Progress' => 9, 'Message' => 10, 'Description' => 11, 'UpdatesCount' => 12, 'CreatedAt' => 13, 'CreatedBy' => 14, 'UpdatedAt' => 15, 'UpdatedBy' => 16, 'DeletedAt' => 17, 'Priority' => 18, 'WorkGroupId' => 19, 'QueueTime' => 20, 'FinishTime' => 21, 'EntryId' => 22, 'PartnerId' => 23, 'SubpId' => 24, 'SchedulerId' => 25, 'WorkerId' => 26, 'BatchIndex' => 27, 'LastSchedulerId' => 28, 'LastWorkerId' => 29, 'LastWorkerRemote' => 30, 'ProcessorExpiration' => 31, 'ExecutionAttempts' => 32, 'LockVersion' => 33, 'TwinJobId' => 34, 'BulkJobId' => 35, 'RootJobId' => 36, 'ParentJobId' => 37, 'Dc' => 38, 'ErrType' => 39, 'ErrNumber' => 40, 'OnStressDivertTo' => 41, ),
		BasePeer::TYPE_COLNAME => array (BatchJobPeer::ID => 0, BatchJobPeer::JOB_TYPE => 1, BatchJobPeer::JOB_SUB_TYPE => 2, BatchJobPeer::DATA => 3, BatchJobPeer::FILE_SIZE => 4, BatchJobPeer::DUPLICATION_KEY => 5, BatchJobPeer::STATUS => 6, BatchJobPeer::ABORT => 7, BatchJobPeer::CHECK_AGAIN_TIMEOUT => 8, BatchJobPeer::PROGRESS => 9, BatchJobPeer::MESSAGE => 10, BatchJobPeer::DESCRIPTION => 11, BatchJobPeer::UPDATES_COUNT => 12, BatchJobPeer::CREATED_AT => 13, BatchJobPeer::CREATED_BY => 14, BatchJobPeer::UPDATED_AT => 15, BatchJobPeer::UPDATED_BY => 16, BatchJobPeer::DELETED_AT => 17, BatchJobPeer::PRIORITY => 18, BatchJobPeer::WORK_GROUP_ID => 19, BatchJobPeer::QUEUE_TIME => 20, BatchJobPeer::FINISH_TIME => 21, BatchJobPeer::ENTRY_ID => 22, BatchJobPeer::PARTNER_ID => 23, BatchJobPeer::SUBP_ID => 24, BatchJobPeer::SCHEDULER_ID => 25, BatchJobPeer::WORKER_ID => 26, BatchJobPeer::BATCH_INDEX => 27, BatchJobPeer::LAST_SCHEDULER_ID => 28, BatchJobPeer::LAST_WORKER_ID => 29, BatchJobPeer::LAST_WORKER_REMOTE => 30, BatchJobPeer::PROCESSOR_EXPIRATION => 31, BatchJobPeer::EXECUTION_ATTEMPTS => 32, BatchJobPeer::LOCK_VERSION => 33, BatchJobPeer::TWIN_JOB_ID => 34, BatchJobPeer::BULK_JOB_ID => 35, BatchJobPeer::ROOT_JOB_ID => 36, BatchJobPeer::PARENT_JOB_ID => 37, BatchJobPeer::DC => 38, BatchJobPeer::ERR_TYPE => 39, BatchJobPeer::ERR_NUMBER => 40, BatchJobPeer::ON_STRESS_DIVERT_TO => 41, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'job_type' => 1, 'job_sub_type' => 2, 'data' => 3, 'file_size' => 4, 'duplication_key' => 5, 'status' => 6, 'abort' => 7, 'check_again_timeout' => 8, 'progress' => 9, 'message' => 10, 'description' => 11, 'updates_count' => 12, 'created_at' => 13, 'created_by' => 14, 'updated_at' => 15, 'updated_by' => 16, 'deleted_at' => 17, 'priority' => 18, 'work_group_id' => 19, 'queue_time' => 20, 'finish_time' => 21, 'entry_id' => 22, 'partner_id' => 23, 'subp_id' => 24, 'scheduler_id' => 25, 'worker_id' => 26, 'batch_index' => 27, 'last_scheduler_id' => 28, 'last_worker_id' => 29, 'last_worker_remote' => 30, 'processor_expiration' => 31, 'execution_attempts' => 32, 'lock_version' => 33, 'twin_job_id' => 34, 'bulk_job_id' => 35, 'root_job_id' => 36, 'parent_job_id' => 37, 'dc' => 38, 'err_type' => 39, 'err_number' => 40, 'on_stress_divert_to' => 41, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
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

		$criteria->addSelectColumn(BatchJobPeer::FILE_SIZE);

		$criteria->addSelectColumn(BatchJobPeer::DUPLICATION_KEY);

		$criteria->addSelectColumn(BatchJobPeer::STATUS);

		$criteria->addSelectColumn(BatchJobPeer::ABORT);

		$criteria->addSelectColumn(BatchJobPeer::CHECK_AGAIN_TIMEOUT);

		$criteria->addSelectColumn(BatchJobPeer::PROGRESS);

		$criteria->addSelectColumn(BatchJobPeer::MESSAGE);

		$criteria->addSelectColumn(BatchJobPeer::DESCRIPTION);

		$criteria->addSelectColumn(BatchJobPeer::UPDATES_COUNT);

		$criteria->addSelectColumn(BatchJobPeer::CREATED_AT);

		$criteria->addSelectColumn(BatchJobPeer::CREATED_BY);

		$criteria->addSelectColumn(BatchJobPeer::UPDATED_AT);

		$criteria->addSelectColumn(BatchJobPeer::UPDATED_BY);

		$criteria->addSelectColumn(BatchJobPeer::DELETED_AT);

		$criteria->addSelectColumn(BatchJobPeer::PRIORITY);

		$criteria->addSelectColumn(BatchJobPeer::WORK_GROUP_ID);

		$criteria->addSelectColumn(BatchJobPeer::QUEUE_TIME);

		$criteria->addSelectColumn(BatchJobPeer::FINISH_TIME);

		$criteria->addSelectColumn(BatchJobPeer::ENTRY_ID);

		$criteria->addSelectColumn(BatchJobPeer::PARTNER_ID);

		$criteria->addSelectColumn(BatchJobPeer::SUBP_ID);

		$criteria->addSelectColumn(BatchJobPeer::SCHEDULER_ID);

		$criteria->addSelectColumn(BatchJobPeer::WORKER_ID);

		$criteria->addSelectColumn(BatchJobPeer::BATCH_INDEX);

		$criteria->addSelectColumn(BatchJobPeer::LAST_SCHEDULER_ID);

		$criteria->addSelectColumn(BatchJobPeer::LAST_WORKER_ID);

		$criteria->addSelectColumn(BatchJobPeer::LAST_WORKER_REMOTE);

		$criteria->addSelectColumn(BatchJobPeer::PROCESSOR_EXPIRATION);

		$criteria->addSelectColumn(BatchJobPeer::EXECUTION_ATTEMPTS);

		$criteria->addSelectColumn(BatchJobPeer::LOCK_VERSION);

		$criteria->addSelectColumn(BatchJobPeer::TWIN_JOB_ID);

		$criteria->addSelectColumn(BatchJobPeer::BULK_JOB_ID);

		$criteria->addSelectColumn(BatchJobPeer::ROOT_JOB_ID);

		$criteria->addSelectColumn(BatchJobPeer::PARENT_JOB_ID);

		$criteria->addSelectColumn(BatchJobPeer::DC);

		$criteria->addSelectColumn(BatchJobPeer::ERR_TYPE);

		$criteria->addSelectColumn(BatchJobPeer::ERR_NUMBER);

		$criteria->addSelectColumn(BatchJobPeer::ON_STRESS_DIVERT_TO);

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
