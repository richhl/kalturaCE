<?php


abstract class BaseMailJobPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'mail_job';

	
	const CLASS_DEFAULT = 'lib.model.MailJob';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'mail_job.ID';

	
	const MAIL_TYPE = 'mail_job.MAIL_TYPE';

	
	const MAIL_PRIORITY = 'mail_job.MAIL_PRIORITY';

	
	const RECIPIENT_NAME = 'mail_job.RECIPIENT_NAME';

	
	const RECIPIENT_EMAIL = 'mail_job.RECIPIENT_EMAIL';

	
	const RECIPIENT_ID = 'mail_job.RECIPIENT_ID';

	
	const FROM_NAME = 'mail_job.FROM_NAME';

	
	const FROM_EMAIL = 'mail_job.FROM_EMAIL';

	
	const BODY_PARAMS = 'mail_job.BODY_PARAMS';

	
	const SUBJECT_PARAMS = 'mail_job.SUBJECT_PARAMS';

	
	const TEMPLATE_PATH = 'mail_job.TEMPLATE_PATH';

	
	const CULTURE = 'mail_job.CULTURE';

	
	const STATUS = 'mail_job.STATUS';

	
	const CREATED_AT = 'mail_job.CREATED_AT';

	
	const CAMPAIGN_ID = 'mail_job.CAMPAIGN_ID';

	
	const MIN_SEND_DATE = 'mail_job.MIN_SEND_DATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'MailType', 'MailPriority', 'RecipientName', 'RecipientEmail', 'RecipientId', 'FromName', 'FromEmail', 'BodyParams', 'SubjectParams', 'TemplatePath', 'Culture', 'Status', 'CreatedAt', 'CampaignId', 'MinSendDate', ),
		BasePeer::TYPE_COLNAME => array (MailJobPeer::ID, MailJobPeer::MAIL_TYPE, MailJobPeer::MAIL_PRIORITY, MailJobPeer::RECIPIENT_NAME, MailJobPeer::RECIPIENT_EMAIL, MailJobPeer::RECIPIENT_ID, MailJobPeer::FROM_NAME, MailJobPeer::FROM_EMAIL, MailJobPeer::BODY_PARAMS, MailJobPeer::SUBJECT_PARAMS, MailJobPeer::TEMPLATE_PATH, MailJobPeer::CULTURE, MailJobPeer::STATUS, MailJobPeer::CREATED_AT, MailJobPeer::CAMPAIGN_ID, MailJobPeer::MIN_SEND_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'mail_type', 'mail_priority', 'recipient_name', 'recipient_email', 'recipient_id', 'from_name', 'from_email', 'body_params', 'subject_params', 'template_path', 'culture', 'status', 'created_at', 'campaign_id', 'min_send_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'MailType' => 1, 'MailPriority' => 2, 'RecipientName' => 3, 'RecipientEmail' => 4, 'RecipientId' => 5, 'FromName' => 6, 'FromEmail' => 7, 'BodyParams' => 8, 'SubjectParams' => 9, 'TemplatePath' => 10, 'Culture' => 11, 'Status' => 12, 'CreatedAt' => 13, 'CampaignId' => 14, 'MinSendDate' => 15, ),
		BasePeer::TYPE_COLNAME => array (MailJobPeer::ID => 0, MailJobPeer::MAIL_TYPE => 1, MailJobPeer::MAIL_PRIORITY => 2, MailJobPeer::RECIPIENT_NAME => 3, MailJobPeer::RECIPIENT_EMAIL => 4, MailJobPeer::RECIPIENT_ID => 5, MailJobPeer::FROM_NAME => 6, MailJobPeer::FROM_EMAIL => 7, MailJobPeer::BODY_PARAMS => 8, MailJobPeer::SUBJECT_PARAMS => 9, MailJobPeer::TEMPLATE_PATH => 10, MailJobPeer::CULTURE => 11, MailJobPeer::STATUS => 12, MailJobPeer::CREATED_AT => 13, MailJobPeer::CAMPAIGN_ID => 14, MailJobPeer::MIN_SEND_DATE => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'mail_type' => 1, 'mail_priority' => 2, 'recipient_name' => 3, 'recipient_email' => 4, 'recipient_id' => 5, 'from_name' => 6, 'from_email' => 7, 'body_params' => 8, 'subject_params' => 9, 'template_path' => 10, 'culture' => 11, 'status' => 12, 'created_at' => 13, 'campaign_id' => 14, 'min_send_date' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MailJobMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MailJobMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MailJobPeer::getTableMap();
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
		return str_replace(MailJobPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MailJobPeer::ID);

		$criteria->addSelectColumn(MailJobPeer::MAIL_TYPE);

		$criteria->addSelectColumn(MailJobPeer::MAIL_PRIORITY);

		$criteria->addSelectColumn(MailJobPeer::RECIPIENT_NAME);

		$criteria->addSelectColumn(MailJobPeer::RECIPIENT_EMAIL);

		$criteria->addSelectColumn(MailJobPeer::RECIPIENT_ID);

		$criteria->addSelectColumn(MailJobPeer::FROM_NAME);

		$criteria->addSelectColumn(MailJobPeer::FROM_EMAIL);

		$criteria->addSelectColumn(MailJobPeer::BODY_PARAMS);

		$criteria->addSelectColumn(MailJobPeer::SUBJECT_PARAMS);

		$criteria->addSelectColumn(MailJobPeer::TEMPLATE_PATH);

		$criteria->addSelectColumn(MailJobPeer::CULTURE);

		$criteria->addSelectColumn(MailJobPeer::STATUS);

		$criteria->addSelectColumn(MailJobPeer::CREATED_AT);

		$criteria->addSelectColumn(MailJobPeer::CAMPAIGN_ID);

		$criteria->addSelectColumn(MailJobPeer::MIN_SEND_DATE);

	}

	const COUNT = 'COUNT(mail_job.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT mail_job.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MailJobPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MailJobPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MailJobPeer::doSelectRS($criteria, $con);
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
		$objects = MailJobPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MailJobPeer::populateObjects(MailJobPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MailJobPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MailJobPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinkuser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MailJobPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MailJobPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MailJobPeer::RECIPIENT_ID, kuserPeer::ID);

		$rs = MailJobPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinkuser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MailJobPeer::addSelectColumns($c);
		$startcol = (MailJobPeer::NUM_COLUMNS - MailJobPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(MailJobPeer::RECIPIENT_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MailJobPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = kuserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMailJob($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMailJobs();
				$obj2->addMailJob($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MailJobPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MailJobPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MailJobPeer::RECIPIENT_ID, kuserPeer::ID);

		$rs = MailJobPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MailJobPeer::addSelectColumns($c);
		$startcol2 = (MailJobPeer::NUM_COLUMNS - MailJobPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(MailJobPeer::RECIPIENT_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MailJobPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = kuserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getkuser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMailJob($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMailJobs();
				$obj2->addMailJob($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return MailJobPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(MailJobPeer::ID); 

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
			$comparison = $criteria->getComparison(MailJobPeer::ID);
			$selectCriteria->add(MailJobPeer::ID, $criteria->remove(MailJobPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(MailJobPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MailJobPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof MailJob) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MailJobPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(MailJob $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MailJobPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MailJobPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MailJobPeer::DATABASE_NAME, MailJobPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MailJobPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(MailJobPeer::DATABASE_NAME);

		$criteria->add(MailJobPeer::ID, $pk);


		$v = MailJobPeer::doSelect($criteria, $con);

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
			$criteria->add(MailJobPeer::ID, $pks, Criteria::IN);
			$objs = MailJobPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseMailJobPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/MailJobMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MailJobMapBuilder');
}
