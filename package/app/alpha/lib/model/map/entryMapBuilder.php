<?php



class entryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.entryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('entry');
		$tMap->setPhpName('entry');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addForeignKey('KSHOW_ID', 'KshowId', 'string', CreoleTypes::VARCHAR, 'kshow', 'ID', false, 20);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('MEDIA_TYPE', 'MediaType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('DATA', 'Data', 'string', CreoleTypes::VARCHAR, false, 48);

		$tMap->addColumn('THUMBNAIL', 'Thumbnail', 'string', CreoleTypes::VARCHAR, false, 48);

		$tMap->addColumn('VIEWS', 'Views', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VOTES', 'Votes', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FAVORITES', 'Favorites', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_RANK', 'TotalRank', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ANONYMOUS', 'Anonymous', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SOURCE', 'Source', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('SOURCE_ID', 'SourceId', 'string', CreoleTypes::VARCHAR, false, 48);

		$tMap->addColumn('SOURCE_LINK', 'SourceLink', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('LICENSE_TYPE', 'LicenseType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREDIT', 'Credit', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('LENGTH_IN_MSECS', 'LengthInMsecs', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DISPLAY_IN_SEARCH', 'DisplayInSearch', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SEARCH_TEXT', 'SearchText', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('SCREEN_NAME', 'ScreenName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SITE_URL', 'SiteUrl', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('PERMISSIONS', 'Permissions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('GROUP_ID', 'GroupId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('PLAYS', 'Plays', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PARTNER_DATA', 'PartnerData', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('INT_ID', 'IntId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('INDEXED_CUSTOM_DATA_1', 'IndexedCustomData1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MEDIA_DATE', 'MediaDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ADMIN_TAGS', 'AdminTags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MODERATION_STATUS', 'ModerationStatus', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MODERATION_COUNT', 'ModerationCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PUSER_ID', 'PuserId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addForeignKey('ACCESS_CONTROL_ID', 'AccessControlId', 'int', CreoleTypes::INTEGER, 'access_control', 'ID', false, null);

		$tMap->addForeignKey('CONVERSION_PROFILE_ID', 'ConversionProfileId', 'int', CreoleTypes::INTEGER, 'conversion_profile_2', 'ID', false, null);

		$tMap->addColumn('CATEGORIES', 'Categories', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('CATEGORIES_IDS', 'CategoriesIds', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('START_DATE', 'StartDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('END_DATE', 'EndDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SEARCH_TEXT_DISCRETE', 'SearchTextDiscrete', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('FLAVOR_PARAMS_IDS', 'FlavorParamsIds', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('AVAILABLE_FROM', 'AvailableFrom', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 