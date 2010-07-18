<?php



class conversionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.conversionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('conversion');
		$tMap->setPhpName('conversion');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ENTRY_ID', 'EntryId', 'string', CreoleTypes::VARCHAR, 'entry', 'ID', false, 20);

		$tMap->addColumn('IN_FILE_NAME', 'InFileName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('IN_FILE_EXT', 'InFileExt', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('IN_FILE_SIZE', 'InFileSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SOURCE', 'Source', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONVERSION_PARAMS', 'ConversionParams', 'string', CreoleTypes::VARCHAR, false, 512);

		$tMap->addColumn('OUT_FILE_NAME', 'OutFileName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('OUT_FILE_SIZE', 'OutFileSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OUT_FILE_NAME_2', 'OutFileName2', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('OUT_FILE_SIZE_2', 'OutFileSize2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONVERSION_TIME', 'ConversionTime', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_PROCESS_TIME', 'TotalProcessTime', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 