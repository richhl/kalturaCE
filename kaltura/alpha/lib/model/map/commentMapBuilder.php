<?php



class commentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.commentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('comment');
		$tMap->setPhpName('comment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('KUSER_ID', 'KuserId', 'int', CreoleTypes::INTEGER, 'kuser', 'ID', false, null);

		$tMap->addColumn('COMMENT_TYPE', 'CommentType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUBJECT_ID', 'SubjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BASE_DATE', 'BaseDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('REPLY_TO', 'ReplyTo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::VARCHAR, false, 256);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 