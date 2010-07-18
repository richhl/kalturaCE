<?php



class AuditTrailMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AuditTrailMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('audit_trail');
		$tMap->setPhpName('AuditTrail');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('OBJECT_NAME', 'ObjectName', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('OBJECT_TYPE_ID', 'ObjectTypeId', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UID', 'Uid', 'string', CreoleTypes::VARCHAR, false, 63);

		$tMap->addColumn('KS_PARTNER_ID', 'KsPartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('KS_UID', 'KsUid', 'string', CreoleTypes::VARCHAR, false, 63);

		$tMap->addColumn('BEFORE', 'Before', 'string', CreoleTypes::VARCHAR, false, 2047);

		$tMap->addColumn('AFTER', 'After', 'string', CreoleTypes::VARCHAR, false, 2047);

		$tMap->addColumn('CONTEXT', 'Context', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('HOST_NAME', 'HostName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ACTION_ID', 'ActionId', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 