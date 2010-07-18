<?php



class syndicationFeedMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.syndicationFeedMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('syndication_feed');
		$tMap->setPhpName('syndicationFeed');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('INT_ID', 'IntId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PLAYLIST_ID', 'PlaylistId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('LANDING_PAGE', 'LandingPage', 'string', CreoleTypes::VARCHAR, true, 512);

		$tMap->addColumn('FLAVOR_PARAM_ID', 'FlavorParamId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PLAYER_UICONF_ID', 'PlayerUiconfId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALLOW_EMBED', 'AllowEmbed', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ADULT_CONTENT', 'AdultContent', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('TRANSCODE_EXISTING_CONTENT', 'TranscodeExistingContent', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ADD_TO_DEFAULT_CONVERSION_PROFILE', 'AddToDefaultConversionProfile', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CATEGORIES', 'Categories', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('FEED_DESCRIPTION', 'FeedDescription', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('LANGUAGE', 'Language', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('FEED_LANDING_PAGE', 'FeedLandingPage', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('OWNER_NAME', 'OwnerName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('OWNER_EMAIL', 'OwnerEmail', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('FEED_IMAGE_URL', 'FeedImageUrl', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('FEED_AUTHOR', 'FeedAuthor', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 