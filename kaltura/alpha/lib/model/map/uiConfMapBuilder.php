<?php



class uiConfMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.uiConfMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ui_conf');
		$tMap->setPhpName('uiConf');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('OBJ_TYPE', 'ObjType', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBP_ID', 'SubpId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONF_FILE_PATH', 'ConfFilePath', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('WIDTH', 'Width', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('HEIGHT', 'Height', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('HTML_PARAMS', 'HtmlParams', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('SWF_URL', 'SwfUrl', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CONF_VARS', 'ConfVars', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('USE_CDN', 'UseCdn', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 4096);

		$tMap->addColumn('DISPLAY_IN_SEARCH', 'DisplayInSearch', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATION_MODE', 'CreationMode', 'int', CreoleTypes::TINYINT, false, null);

	} 
} 