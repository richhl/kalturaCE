<?php



class MailJobMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MailJobMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('mail_job');
		$tMap->setPhpName('MailJob');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('MAIL_TYPE', 'MailType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('MAIL_PRIORITY', 'MailPriority', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('RECIPIENT_NAME', 'RecipientName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('RECIPIENT_EMAIL', 'RecipientEmail', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addForeignKey('RECIPIENT_ID', 'RecipientId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('FROM_NAME', 'FromName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('FROM_EMAIL', 'FromEmail', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('BODY_PARAMS', 'BodyParams', 'string', CreoleTypes::VARCHAR, false, 2048);

		$tMap->addColumn('SUBJECT_PARAMS', 'SubjectParams', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('TEMPLATE_PATH', 'TemplatePath', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('CULTURE', 'Culture', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CAMPAIGN_ID', 'CampaignId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MIN_SEND_DATE', 'MinSendDate', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 