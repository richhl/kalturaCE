<?php



class EmailCampaignMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EmailCampaignMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_campaign');
		$tMap->setPhpName('EmailCampaign');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CRITERIA_ID', 'CriteriaId', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CRITERIA_STR', 'CriteriaStr', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('CRITERIA_PARAMS', 'CriteriaParams', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('TEMPLATE_PATH', 'TemplatePath', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addForeignKey('CAMPAIGN_MGR_KUSER_ID', 'CampaignMgrKuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('SEND_COUNT', 'SendCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OPEN_COUNT', 'OpenCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CLICK_COUNT', 'ClickCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 