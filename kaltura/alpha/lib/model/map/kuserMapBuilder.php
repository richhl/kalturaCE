<?php



class kuserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.kuserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('kuser');
		$tMap->setPhpName('kuser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SCREEN_NAME', 'ScreenName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('FULL_NAME', 'FullName', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('DATE_OF_BIRTH', 'DateOfBirth', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('COUNTRY', 'Country', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('STATE', 'State', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('ZIP', 'Zip', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('URL_LIST', 'UrlList', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('PICTURE', 'Picture', 'string', CreoleTypes::VARCHAR, false, 48);

		$tMap->addColumn('ICON', 'Icon', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('ABOUT_ME', 'AboutMe', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TAGLINE', 'Tagline', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('NETWORK_HIGHSCHOOL', 'NetworkHighschool', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('NETWORK_COLLEGE', 'NetworkCollege', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('NETWORK_OTHER', 'NetworkOther', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('MOBILE_NUM', 'MobileNum', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('MATURE_CONTENT', 'MatureContent', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('GENDER', 'Gender', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('REGISTRATION_IP', 'RegistrationIp', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('REGISTRATION_COOKIE', 'RegistrationCookie', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('IM_LIST', 'ImList', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('VIEWS', 'Views', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FANS', 'Fans', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRIES', 'Entries', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PRODUCED_KSHOWS', 'ProducedKshows', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DISPLAY_IN_SEARCH', 'DisplayInSearch', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SEARCH_TEXT', 'SearchText', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('PARTNER_DATA', 'PartnerData', 'string', CreoleTypes::VARCHAR, false, 4096);

	} 
} 