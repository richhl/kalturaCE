<?php



class StorageProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.StorageProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('storage_profile');
		$tMap->setPhpName('StorageProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 31);

		$tMap->addColumn('DESCIPTION', 'Desciption', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PROTOCOL', 'Protocol', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('STORAGE_URL', 'StorageUrl', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('STORAGE_BASE_DIR', 'StorageBaseDir', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('STORAGE_USERNAME', 'StorageUsername', 'string', CreoleTypes::VARCHAR, false, 31);

		$tMap->addColumn('STORAGE_PASSWORD', 'StoragePassword', 'string', CreoleTypes::VARCHAR, false, 31);

		$tMap->addColumn('STORAGE_FTP_PASSIVE_MODE', 'StorageFtpPassiveMode', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('DELIVERY_HTTP_BASE_URL', 'DeliveryHttpBaseUrl', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('DELIVERY_RMP_BASE_URL', 'DeliveryRmpBaseUrl', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('DELIVERY_IIS_BASE_URL', 'DeliveryIisBaseUrl', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('MIN_FILE_SIZE', 'MinFileSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MAX_FILE_SIZE', 'MaxFileSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FLAVOR_PARAMS_IDS', 'FlavorParamsIds', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('MAX_CONCURRENT_CONNECTIONS', 'MaxConcurrentConnections', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CUSTOM_DATA', 'CustomData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PATH_MANAGER_CLASS', 'PathManagerClass', 'string', CreoleTypes::VARCHAR, false, 127);

		$tMap->addColumn('URL_MANAGER_CLASS', 'UrlManagerClass', 'string', CreoleTypes::VARCHAR, false, 127);

	} 
} 