<?php



class flickrTokenMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.flickrTokenMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('flickr_token');
		$tMap->setPhpName('flickrToken');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('KALT_TOKEN', 'KaltToken', 'string', CreoleTypes::VARCHAR, true, 256);

		$tMap->addColumn('FROB', 'Frob', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('NSID', 'Nsid', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('RESPONSE', 'Response', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('IS_VALID', 'IsValid', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 