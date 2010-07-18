<?php



class SchedulerConfigMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SchedulerConfigMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('scheduler_config');
		$tMap->setPhpName('SchedulerConfig');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('COMMAND_ID', 'CommandId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMAND_STATUS', 'CommandStatus', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SCHEDULER_ID', 'SchedulerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEDULER_CONFIGURED_ID', 'SchedulerConfiguredId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEDULER_NAME', 'SchedulerName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('WORKER_ID', 'WorkerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WORKER_CONFIGURED_ID', 'WorkerConfiguredId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WORKER_NAME', 'WorkerName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('VARIABLE', 'Variable', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('VARIABLE_PART', 'VariablePart', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('VALUE', 'Value', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 