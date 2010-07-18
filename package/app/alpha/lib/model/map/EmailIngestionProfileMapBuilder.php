<?php



class EmailIngestionProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EmailIngestionProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_ingestion_profile');
		$tMap->setPhpName('EmailIngestionProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 60);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('EMAIL_ADDRESS', 'EmailAddress', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('MAILBOX_ID', 'MailboxId', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CONVERSION_PROFILE_2_ID', 'ConversionProfile2Id', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MODERATION_STATUS', 'ModerationStatus', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 