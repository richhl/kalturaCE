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

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ABORT', 'Abort', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CHECK_AGAIN_TIMEOUT', 'CheckAgainTimeout', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PROGRESS', 'Progress', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('MESSAGE', 'Message', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('UPDATES_COUNT', 'UpdatesCount', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PROCESSOR_NAME', 'ProcessorName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('PROCESSOR_EXPIRATION', 'ProcessorExpiration', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARENT_JOB_ID', 'ParentJobId', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 