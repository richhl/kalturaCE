<?php



class PartnerTransactionsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PartnerTransactionsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('partner_transactions');
		$tMap->setPhpName('PartnerTransactions');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_ID', 'PartnerId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('AMOUNT', 'Amount', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('CURRENCY', 'Currency', 'string', CreoleTypes::VARCHAR, false, 6);

		$tMap->addColumn('TRANSACTION_ID', 'TransactionId', 'string', CreoleTypes::VARCHAR, false, 17);

		$tMap->addColumn('TIMESTAMP', 'Timestamp', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CORRELATION_ID', 'CorrelationId', 'string', CreoleTypes::VARCHAR, false, 12);

		$tMap->addColumn('ACK', 'Ack', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TRANSACTION_DATA', 'TransactionData', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 