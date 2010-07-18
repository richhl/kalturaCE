<?php



class kshowMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.kshowMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('kshow');
		$tMap->setPhpName('kshow');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addForeignKey('PRODUCER_ID', 'ProducerId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('EPISODE_ID', 'EpisodeId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('SUBDOMAIN', 'Subdomain', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MEDIA_TYPE', 'MediaType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FORMAT_TYPE', 'FormatType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LANGUAGE', 'Language', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('START_DATE', 'StartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('END_DATE', 'EndDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('SKIN', 'Skin', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('THUMBNAIL', 'Thumbnail', 'string', CreoleTypes::VARCHAR, false, 48);

		$tMap->addColumn('SHOW_ENTRY_ID', 'ShowEntryId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('INTRO_ID', 'IntroId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIEWS', 'Views', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VOTES', 'Votes', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FAVORITES', 'Favorites', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRIES', 'Entries', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONTRIBUTORS', 'Contributors', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBSCRIBERS', 'Subscribers', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NUMBER_OF_UPDATES', 'NumberOfUpdates', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INDEXED_CUSTOM_DATA_1', 'IndexedCustomData1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INDEXED_CUSTOM_DATA_2', 'IndexedCustomData2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INDEXED_CUSTOM_DATA_3', 'IndexedCustomData3', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('REOCCURENCE', 'Reoccurence', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LICENSE_TYPE', 'LicenseType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LENGTH_IN_MSECS', 'LengthInMsecs', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIEW_PERMISSIONS', 'ViewPermissions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VIEW_PASSWORD', 'ViewPassword', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('CONTRIB_PERMISSIONS', 'ContribPermissions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONTRIB_PASSWORD', 'ContribPassword', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('EDIT_PERMISSIONS', 'EditPermissions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EDIT_PASSWORD', 'EditPassword', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DISPLAY_IN_SEARCH', 'DisplayInSearch', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SEARCH_TEXT', 'SearchText', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('PERMISSIONS', 'Permissions', 'string', CreoleTypes::VARCHAR, false, 1024);

		$tMap->addColumn('GROUP_ID', 'GroupId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('PLAYS', 'Plays', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PARTNER_DATA', 'PartnerData', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('INT_ID', 'IntId', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 