<?php



class moderationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.moderationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('moderation');
		$tMap->setPhpName('moderation');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('OBJECT_TYPE', 'ObjectType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('PUSER_ID', 'PuserId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('GROUP_ID', 'GroupId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('REPORT_CODE', 'ReportCode', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 