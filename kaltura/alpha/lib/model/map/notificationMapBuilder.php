<?php



class notificationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.notificationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('notification');
		$tMap->setPhpName('notification');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PUSER_ID', 'PuserId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NOTIFICATION_DATA', 'NotificationData', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('NUMBER_OF_ATTEMPTS', 'NumberOfAttempts', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('NOTIFICATION_RESULT', 'NotificationResult', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('OBJECT_TYPE', 'ObjectType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('PROCESSOR_NAME', 'ProcessorName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('PROCESSOR_LOCATION', 'ProcessorLocation', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('PROCESSOR_EXPIRATION', 'ProcessorExpiration', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('EXECUTION_ATTEMPTS', 'ExecutionAttempts', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('LOCK_VERSION', 'LockVersion', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 