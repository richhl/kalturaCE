<?php


abstract class BaseEmailIngestionProfilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'email_ingestion_profile';

	
	const CLASS_DEFAULT = 'lib.model.EmailIngestionProfile';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'email_ingestion_profile.ID';

	
	const NAME = 'email_ingestion_profile.NAME';

	
	const DESCRIPTION = 'email_ingestion_profile.DESCRIPTION';

	
	const EMAIL_ADDRESS = 'email_ingestion_profile.EMAIL_ADDRESS';

	
	const MAILBOX_ID = 'email_ingestion_profile.MAILBOX_ID';

	
	const PARTNER_ID = 'email_ingestion_profile.PARTNER_ID';

	
	const CONVERSION_PROFILE_2_ID = 'email_ingestion_profile.CONVERSION_PROFILE_2_ID';

	
	const MODERATION_STATUS = 'email_ingestion_profile.MODERATION_STATUS';

	
	const CUSTOM_DATA = 'email_ingestion_profile.CUSTOM_DATA';

	
	const STATUS = 'email_ingestion_profile.STATUS';

	
	const CREATED_AT = 'email_ingestion_profile.CREATED_AT';

	
	const UPDATED_AT = 'email_ingestion_profile.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'EmailAddress', 'MailboxId', 'PartnerId', 'ConversionProfile2Id', 'ModerationStatus', 'CustomData', 'Status', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EmailIngestionProfilePeer::ID, EmailIngestionProfilePeer::NAME, EmailIngestionProfilePeer::DESCRIPTION, EmailIngestionProfilePeer::EMAIL_ADDRESS, EmailIngestionProfilePeer::MAILBOX_ID, EmailIngestionProfilePeer::PARTNER_ID, EmailIngestionProfilePeer::CONVERSION_PROFILE_2_ID, EmailIngestionProfilePeer::MODERATION_STATUS, EmailIngestionProfilePeer::CUSTOM_DATA, EmailIngestionProfilePeer::STATUS, EmailIngestionProfilePeer::CREATED_AT, EmailIngestionProfilePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'email_address', 'mailbox_id', 'partner_id', 'conversion_profile_2_id', 'moderation_status', 'custom_data', 'status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'EmailAddress' => 3, 'MailboxId' => 4, 'PartnerId' => 5, 'ConversionProfile2Id' => 6, 'ModerationStatus' => 7, 'CustomData' => 8, 'Status' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (EmailIngestionProfilePeer::ID => 0, EmailIngestionProfilePeer::NAME => 1, EmailIngestionProfilePeer::DESCRIPTION => 2, EmailIngestionProfilePeer::EMAIL_ADDRESS => 3, EmailIngestionProfilePeer::MAILBOX_ID => 4, EmailIngestionProfilePeer::PARTNER_ID => 5, EmailIngestionProfilePeer::CONVERSION_PROFILE_2_ID => 6, EmailIngestionProfilePeer::MODERATION_STATUS => 7, EmailIngestionProfilePeer::CUSTOM_DATA => 8, EmailIngestionProfilePeer::STATUS => 9, EmailIngestionProfilePeer::CREATED_AT => 10, EmailIngestionProfilePeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'email_address' => 3, 'mailbox_id' => 4, 'partner_id' => 5, 'conversion_profile_2_id' => 6, 'moderation_status' => 7, 'custom_data' => 8, 'status' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EmailIngestionProfileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EmailIngestionProfileMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EmailIngestionProfilePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(EmailIngestionProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailIngestionProfilePeer::ID);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::NAME);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::DESCRIPTION);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::EMAIL_ADDRESS);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::MAILBOX_ID);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::PARTNER_ID);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::CONVERSION_PROFILE_2_ID);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::MODERATION_STATUS);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::CUSTOM_DATA);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::STATUS);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::CREATED_AT);

		$criteria->addSelectColumn(EmailIngestionProfilePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(email_ingestion_profile.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT email_ingestion_profile.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailIngestionProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailIngestionProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EmailIngestionProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = EmailIngestionProfilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EmailIngestionProfilePeer::populateObjects(EmailIngestionProfilePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EmailIngestionProfilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EmailIngestionProfilePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return EmailIngestionProfilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EmailIngestionProfilePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(EmailIngestionProfilePeer::ID);
			$selectCriteria->add(EmailIngestionProfilePeer::ID, $criteria->remove(EmailIngestionProfilePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(EmailIngestionProfilePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(EmailIngestionProfilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EmailIngestionProfile) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EmailIngestionProfilePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(EmailIngestionProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailIngestionProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailIngestionProfilePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(EmailIngestionProfilePeer::DATABASE_NAME, EmailIngestionProfilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailIngestionProfilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(EmailIngestionProfilePeer::DATABASE_NAME);

		$criteria->add(EmailIngestionProfilePeer::ID, $pk);


		$v = EmailIngestionProfilePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(EmailIngestionProfilePeer::ID, $pks, Criteria::IN);
			$objs = EmailIngestionProfilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEmailIngestionProfilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EmailIngestionProfileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EmailIngestionProfileMapBuilder');
}
