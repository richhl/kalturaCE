<?php



class PartnerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PartnerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('partner');
		$tMap->setPhpName('Partner');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_NAME', 'PartnerName', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('PARTNER_ALIAS', 'PartnerAlias', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('URL1', 'Url1', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('URL2', 'Url2', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('SECRET', 'Secret', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ADMIN_SECRET', 'AdminSecret', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MAX_NUMBER_OF_HITS_PER_DAY', 'MaxNumberOfHitsPerDay', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('APPEAR_IN_SEARCH', 'AppearInSearch', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DEBUG_LEVEL', 'DebugLevel', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INVALID_LOGIN_COUNT', 'InvalidLoginCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('ANONYMOUS_KUSER_ID', 'AnonymousKuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('KS_MAX_EXPIRY_IN_SECONDS', 'KsMaxExpiryInSeconds', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATE_USER_ON_DEMAND', 'CreateUserOnDemand', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PREFIX', 'Prefix', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('ADMIN_NAME', 'AdminName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ADMIN_EMAIL', 'AdminEmail', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('COMMERCIAL_USE', 'CommercialUse', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('MODERATE_CONTENT', 'ModerateContent', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('NOTIFY', 'Notify', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SERVICE_CONFIG_ID', 'ServiceConfigId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CONTENT_CATEGORIES', 'ContentCategories', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('DESCRIBE_YOURSELF', 'DescribeYourself', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('ADULT_CONTENT', 'AdultContent', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PARTNER_PACKAGE', 'PartnerPackage', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('USAGE_PERCENT', 'UsagePercent', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STORAGE_USAGE', 'StorageUsage', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EIGHTY_PERCENT_WARNING', 'EightyPercentWarning', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USAGE_LIMIT_WARNING', 'UsageLimitWarning', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 