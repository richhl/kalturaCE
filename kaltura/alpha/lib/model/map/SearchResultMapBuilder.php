<?php



class SearchResultMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SearchResultMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('search_result');
		$tMap->setPhpName('SearchResult');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('KEYWORDS', 'Keywords', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SOURCE', 'Source', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('MEDIA_TYPE', 'MediaType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('THUMB_URL', 'ThumbUrl', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SOURCE_LINK', 'SourceLink', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREDIT', 'Credit', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('EMBED_CODE', 'EmbedCode', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LICENSE_TYPE', 'LicenseType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 