<?php



class BBForumMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BBForumMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('bb_forum');
		$tMap->setPhpName('BBForum');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('POST_COUNT', 'PostCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('THREAD_COUNT', 'ThreadCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('LAST_POST', 'LastPost', 'int', CreoleTypes::INTEGER, 'bb_post', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IS_LIVE', 'IsLive', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 