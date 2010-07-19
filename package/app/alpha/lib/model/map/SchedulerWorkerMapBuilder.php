<?php



class SchedulerWorkerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SchedulerWorkerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('scheduler_worker');
		$tMap->setPhpName('SchedulerWorker');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SCHEDULER_ID', 'SchedulerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEDULER_CONFIGURED_ID', 'SchedulerConfiguredId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONFIGURED_ID', 'ConfiguredId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('STATUSES', 'Statuses', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LAST_STATUS', 'LastStatus', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 