<?php



class moderationFlagMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.moderationFlagMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('moderation_flag');
		$tMap->setPhpName('moderationFlag');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('OBJECT_TYPE', 'ObjectType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addForeignKey('FLAGGED_ENTRY_ID', 'FlaggedEntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 10);

		$tMap->addForeignKey('FLAGGED_KUSER_ID', 'FlaggedKuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('FLAG_TYPE', 'FlagType', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 