<?php



class FacebookInviteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FacebookInviteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('facebook_invite');
		$tMap->setPhpName('FacebookInvite');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PUSER_ID', 'PuserId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('INVITED_PUSER_ID', 'InvitedPuserId', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 