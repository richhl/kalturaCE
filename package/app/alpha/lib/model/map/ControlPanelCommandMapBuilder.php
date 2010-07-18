<?php



class ControlPanelCommandMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ControlPanelCommandMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('control_panel_command');
		$tMap->setPhpName('ControlPanelCommand');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CREATED_BY_ID', 'CreatedById', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEDULER_ID', 'SchedulerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEDULER_CONFIGURED_ID', 'SchedulerConfiguredId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WORKER_ID', 'WorkerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WORKER_CONFIGURED_ID', 'WorkerConfiguredId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WORKER_NAME', 'WorkerName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('BATCH_INDEX', 'BatchIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('TARGET_TYPE', 'TargetType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CAUSE', 'Cause', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ERROR_DESCRIPTION', 'ErrorDescription', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 