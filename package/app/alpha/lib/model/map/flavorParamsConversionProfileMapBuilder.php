<?php



class flavorParamsConversionProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.flavorParamsConversionProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('flavor_params_conversion_profile');
		$tMap->setPhpName('flavorParamsConversionProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CONVERSION_PROFILE_ID', 'ConversionProfileId', 'int', CreoleTypes::INTEGER, 'conversion_profile_2', 'ID', true, null);

		$tMap->addForeignKey('FLAVOR_PARAMS_ID', 'FlavorParamsId', 'int', CreoleTypes::INTEGER, 'flavor_params', 'ID', true, null);

		$tMap->addColumn('READY_BEHAVIOR', 'ReadyBehavior', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('FORCE_NONE_COMPLIED', 'ForceNoneComplied', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 