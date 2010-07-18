<?php



class BatchJobMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BatchJobMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('batch_job');
		$tMap->setPhpName('BatchJob');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('JOB_TYPE', 'JobType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('JOB_SUB_TYPE', 'JobSubType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('DATA', 'Data', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('FILE_SIZE', 'FileSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DUPLICATION_KEY', 'DuplicationKey', 'string', CreoleTypes::VARCHAR, false, 2047);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ABORT', 'Abort', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CHECK_AGAIN_TIMEOUT', 'CheckAgainTimeout', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PROGRESS', 'Progress', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('MESSAGE', 'Message', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('UPDATES_COUNT', 'UpdatesCount', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PRIORITY', 'Priority', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('WORK_GROUP_ID', 'WorkGroupId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('QUEUE_TIME', 'QueueTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FINISH_TIME', 'FinishTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEDULER_ID', 'SchedulerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WORKER_ID', 'WorkerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BATCH_INDEX', 'BatchIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_SCHEDULER_ID', 'LastSchedulerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_WORKER_ID', 'LastWorkerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_WORKER_REMOTE', 'LastWorkerRemote', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PROCESSOR_EXPIRATION', 'ProcessorExpiration', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('EXECUTION_ATTEMPTS', 'ExecutionAttempts', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('LOCK_VERSION', 'LockVersion', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TWIN_JOB_ID', 'TwinJobId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BULK_JOB_ID', 'BulkJobId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ROOT_JOB_ID', 'RootJobId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PARENT_JOB_ID', 'ParentJobId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DC', 'Dc', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ERR_TYPE', 'ErrType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ERR_NUMBER', 'ErrNumber', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ON_STRESS_DIVERT_TO', 'OnStressDivertTo', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 