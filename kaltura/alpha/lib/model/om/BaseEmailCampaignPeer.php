<?php


abstract class BaseEmailCampaignPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'email_campaign';

	
	const CLASS_DEFAULT = 'lib.model.EmailCampaign';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'email_campaign.ID';

	
	const CRITERIA_ID = 'email_campaign.CRITERIA_ID';

	
	const CRITERIA_STR = 'email_campaign.CRITERIA_STR';

	
	const CRITERIA_PARAMS = 'email_campaign.CRITERIA_PARAMS';

	
	const TEMPLATE_PATH = 'email_campaign.TEMPLATE_PATH';

	
	const CAMPAIGN_MGR_KUSER_ID = 'email_campaign.CAMPAIGN_MGR_KUSER_ID';

	
	const SEND_COUNT = 'email_campaign.SEND_COUNT';

	
	const OPEN_COUNT = 'email_campaign.OPEN_COUNT';

	
	const CLICK_COUNT = 'email_campaign.CLICK_COUNT';

	
	const STATUS = 'email_campaign.STATUS';

	
	const CREATED_AT = 'email_campaign.CREATED_AT';

	
	const UPDATED_AT = 'email_campaign.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CriteriaId', 'CriteriaStr', 'CriteriaParams', 'TemplatePath', 'CampaignMgrKuserId', 'SendCount', 'OpenCount', 'ClickCount', 'Status', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EmailCampaignPeer::ID, EmailCampaignPeer::CRITERIA_ID, EmailCampaignPeer::CRITERIA_STR, EmailCampaignPeer::CRITERIA_PARAMS, EmailCampaignPeer::TEMPLATE_PATH, EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, EmailCampaignPeer::SEND_COUNT, EmailCampaignPeer::OPEN_COUNT, EmailCampaignPeer::CLICK_COUNT, EmailCampaignPeer::STATUS, EmailCampaignPeer::CREATED_AT, EmailCampaignPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'criteria_id', 'criteria_str', 'criteria_params', 'template_path', 'campaign_mgr_kuser_id', 'send_count', 'open_count', 'click_count', 'status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CriteriaId' => 1, 'CriteriaStr' => 2, 'CriteriaParams' => 3, 'TemplatePath' => 4, 'CampaignMgrKuserId' => 5, 'SendCount' => 6, 'OpenCount' => 7, 'ClickCount' => 8, 'Status' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (EmailCampaignPeer::ID => 0, EmailCampaignPeer::CRITERIA_ID => 1, EmailCampaignPeer::CRITERIA_STR => 2, EmailCampaignPeer::CRITERIA_PARAMS => 3, EmailCampaignPeer::TEMPLATE_PATH => 4, EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID => 5, EmailCampaignPeer::SEND_COUNT => 6, EmailCampaignPeer::OPEN_COUNT => 7, EmailCampaignPeer::CLICK_COUNT => 8, EmailCampaignPeer::STATUS => 9, EmailCampaignPeer::CREATED_AT => 10, EmailCampaignPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'criteria_id' => 1, 'criteria_str' => 2, 'criteria_params' => 3, 'template_path' => 4, 'campaign_mgr_kuser_id' => 5, 'send_count' => 6, 'open_count' => 7, 'click_count' => 8, 'status' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EmailCampaignMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EmailCampaignMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EmailCampaignPeer::getTableMap();
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
		return str_replace(EmailCampaignPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailCampaignPeer::ID);

		$criteria->addSelectColumn(EmailCampaignPeer::CRITERIA_ID);

		$criteria->addSelectColumn(EmailCampaignPeer::CRITERIA_STR);

		$criteria->addSelectColumn(EmailCampaignPeer::CRITERIA_PARAMS);

		$criteria->addSelectColumn(EmailCampaignPeer::TEMPLATE_PATH);

		$criteria->addSelectColumn(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID);

		$criteria->addSelectColumn(EmailCampaignPeer::SEND_COUNT);

		$criteria->addSelectColumn(EmailCampaignPeer::OPEN_COUNT);

		$criteria->addSelectColumn(EmailCampaignPeer::CLICK_COUNT);

		$criteria->addSelectColumn(EmailCampaignPeer::STATUS);

		$criteria->addSelectColumn(EmailCampaignPeer::CREATED_AT);

		$criteria->addSelectColumn(EmailCampaignPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(email_campaign.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT email_campaign.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailCampaignPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailCampaignPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EmailCampaignPeer::doSelectRS($criteria, $con);
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
		$objects = EmailCampaignPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EmailCampaignPeer::populateObjects(EmailCampaignPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EmailCampaignPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EmailCampaignPeer::getOMClass();
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
			$criteria->addSelectColumn(EmailCampaignPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailCampaignPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, kuserPeer::ID);

		$rs = EmailCampaignPeer::doSelectRS($criteria, $con);
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

		EmailCampaignPeer::addSelectColumns($c);
		$startcol = (EmailCampaignPeer::NUM_COLUMNS - EmailCampaignPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		kuserPeer::addSelectColumns($c);

		$c->addJoin(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, kuserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailCampaignPeer::getOMClass();

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
										$temp_obj2->addEmailCampaign($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEmailCampaigns();
				$obj2->addEmailCampaign($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailCampaignPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailCampaignPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, kuserPeer::ID);

		$rs = EmailCampaignPeer::doSelectRS($criteria, $con);
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

		EmailCampaignPeer::addSelectColumns($c);
		$startcol2 = (EmailCampaignPeer::NUM_COLUMNS - EmailCampaignPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		kuserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + kuserPeer::NUM_COLUMNS;

		$c->addJoin(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, kuserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailCampaignPeer::getOMClass();


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
					$temp_obj2->addEmailCampaign($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailCampaigns();
				$obj2->addEmailCampaign($obj1);
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
		return EmailCampaignPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EmailCampaignPeer::ID); 

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
			$comparison = $criteria->getComparison(EmailCampaignPeer::ID);
			$selectCriteria->add(EmailCampaignPeer::ID, $criteria->remove(EmailCampaignPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EmailCampaignPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EmailCampaignPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EmailCampaign) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EmailCampaignPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EmailCampaign $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailCampaignPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailCampaignPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailCampaignPeer::DATABASE_NAME, EmailCampaignPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailCampaignPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EmailCampaignPeer::DATABASE_NAME);

		$criteria->add(EmailCampaignPeer::ID, $pk);


		$v = EmailCampaignPeer::doSelect($criteria, $con);

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
			$criteria->add(EmailCampaignPeer::ID, $pks, Criteria::IN);
			$objs = EmailCampaignPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEmailCampaignPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EmailCampaignMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EmailCampaignMapBuilder');
}
