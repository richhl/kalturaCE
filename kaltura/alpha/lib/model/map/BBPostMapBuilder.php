<?php



class BBPostMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BBPostMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('bb_post');
		$tMap->setPhpName('BBPost');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addForeignKey('FORUM_ID', 'ForumId', 'int', CreoleTypes::INTEGER, 'bb_forum', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'bb_post', 'ID', false, null);

		$tMap->addColumn('NODE_LEVEL', 'NodeLevel', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NODE_ID', 'NodeId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('NUM_CHILDERN', 'NumChildern', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_CHILD', 'LastChild', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 