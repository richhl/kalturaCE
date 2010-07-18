<?php


abstract class BaseBulkUploadResultPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'bulk_upload_result';

	
	const CLASS_DEFAULT = 'lib.model.BulkUploadResult';

	
	const NUM_COLUMNS = 23;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'bulk_upload_result.ID';

	
	const CREATED_AT = 'bulk_upload_result.CREATED_AT';

	
	const UPDATED_AT = 'bulk_upload_result.UPDATED_AT';

	
	const BULK_UPLOAD_JOB_ID = 'bulk_upload_result.BULK_UPLOAD_JOB_ID';

	
	const LINE_INDEX = 'bulk_upload_result.LINE_INDEX';

	
	const PARTNER_ID = 'bulk_upload_result.PARTNER_ID';

	
	const ENTRY_ID = 'bulk_upload_result.ENTRY_ID';

	
	const ENTRY_STATUS = 'bulk_upload_result.ENTRY_STATUS';

	
	const ROW_DATA = 'bulk_upload_result.ROW_DATA';

	
	const TITLE = 'bulk_upload_result.TITLE';

	
	const DESCRIPTION = 'bulk_upload_result.DESCRIPTION';

	
	const TAGS = 'bulk_upload_result.TAGS';

	
	const URL = 'bulk_upload_result.URL';

	
	const CONTENT_TYPE = 'bulk_upload_result.CONTENT_TYPE';

	
	const CONVERSION_PROFILE_ID = 'bulk_upload_result.CONVERSION_PROFILE_ID';

	
	const ACCESS_CONTROL_PROFILE_ID = 'bulk_upload_result.ACCESS_CONTROL_PROFILE_ID';

	
	const CATEGORY = 'bulk_upload_result.CATEGORY';

	
	const SCHEDULE_START_DATE = 'bulk_upload_result.SCHEDULE_START_DATE';

	
	const SCHEDULE_END_DATE = 'bulk_upload_result.SCHEDULE_END_DATE';

	
	const THUMBNAIL_URL = 'bulk_upload_result.THUMBNAIL_URL';

	
	const THUMBNAIL_SAVED = 'bulk_upload_result.THUMBNAIL_SAVED';

	
	const PARTNER_DATA = 'bulk_upload_result.PARTNER_DATA';

	
	const ERROR_DESCRIPTION = 'bulk_upload_result.ERROR_DESCRIPTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'BulkUploadJobId', 'LineIndex', 'PartnerId', 'EntryId', 'EntryStatus', 'RowData', 'Title', 'Description', 'Tags', 'Url', 'ContentType', 'ConversionProfileId', 'AccessControlProfileId', 'Category', 'ScheduleStartDate', 'ScheduleEndDate', 'ThumbnailUrl', 'ThumbnailSaved', 'PartnerData', 'ErrorDescription', ),
		BasePeer::TYPE_COLNAME => array (BulkUploadResultPeer::ID, BulkUploadResultPeer::CREATED_AT, BulkUploadResultPeer::UPDATED_AT, BulkUploadResultPeer::BULK_UPLOAD_JOB_ID, BulkUploadResultPeer::LINE_INDEX, BulkUploadResultPeer::PARTNER_ID, BulkUploadResultPeer::ENTRY_ID, BulkUploadResultPeer::ENTRY_STATUS, BulkUploadResultPeer::ROW_DATA, BulkUploadResultPeer::TITLE, BulkUploadResultPeer::DESCRIPTION, BulkUploadResultPeer::TAGS, BulkUploadResultPeer::URL, BulkUploadResultPeer::CONTENT_TYPE, BulkUploadResultPeer::CONVERSION_PROFILE_ID, BulkUploadResultPeer::ACCESS_CONTROL_PROFILE_ID, BulkUploadResultPeer::CATEGORY, BulkUploadResultPeer::SCHEDULE_START_DATE, BulkUploadResultPeer::SCHEDULE_END_DATE, BulkUploadResultPeer::THUMBNAIL_URL, BulkUploadResultPeer::THUMBNAIL_SAVED, BulkUploadResultPeer::PARTNER_DATA, BulkUploadResultPeer::ERROR_DESCRIPTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'bulk_upload_job_id', 'line_index', 'partner_id', 'entry_id', 'entry_status', 'row_data', 'title', 'description', 'tags', 'url', 'content_type', 'conversion_profile_id', 'access_control_profile_id', 'category', 'schedule_start_date', 'schedule_end_date', 'thumbnail_url', 'thumbnail_saved', 'partner_data', 'error_description', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'BulkUploadJobId' => 3, 'LineIndex' => 4, 'PartnerId' => 5, 'EntryId' => 6, 'EntryStatus' => 7, 'RowData' => 8, 'Title' => 9, 'Description' => 10, 'Tags' => 11, 'Url' => 12, 'ContentType' => 13, 'ConversionProfileId' => 14, 'AccessControlProfileId' => 15, 'Category' => 16, 'ScheduleStartDate' => 17, 'ScheduleEndDate' => 18, 'ThumbnailUrl' => 19, 'ThumbnailSaved' => 20, 'PartnerData' => 21, 'ErrorDescription' => 22, ),
		BasePeer::TYPE_COLNAME => array (BulkUploadResultPeer::ID => 0, BulkUploadResultPeer::CREATED_AT => 1, BulkUploadResultPeer::UPDATED_AT => 2, BulkUploadResultPeer::BULK_UPLOAD_JOB_ID => 3, BulkUploadResultPeer::LINE_INDEX => 4, BulkUploadResultPeer::PARTNER_ID => 5, BulkUploadResultPeer::ENTRY_ID => 6, BulkUploadResultPeer::ENTRY_STATUS => 7, BulkUploadResultPeer::ROW_DATA => 8, BulkUploadResultPeer::TITLE => 9, BulkUploadResultPeer::DESCRIPTION => 10, BulkUploadResultPeer::TAGS => 11, BulkUploadResultPeer::URL => 12, BulkUploadResultPeer::CONTENT_TYPE => 13, BulkUploadResultPeer::CONVERSION_PROFILE_ID => 14, BulkUploadResultPeer::ACCESS_CONTROL_PROFILE_ID => 15, BulkUploadResultPeer::CATEGORY => 16, BulkUploadResultPeer::SCHEDULE_START_DATE => 17, BulkUploadResultPeer::SCHEDULE_END_DATE => 18, BulkUploadResultPeer::THUMBNAIL_URL => 19, BulkUploadResultPeer::THUMBNAIL_SAVED => 20, BulkUploadResultPeer::PARTNER_DATA => 21, BulkUploadResultPeer::ERROR_DESCRIPTION => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'bulk_upload_job_id' => 3, 'line_index' => 4, 'partner_id' => 5, 'entry_id' => 6, 'entry_status' => 7, 'row_data' => 8, 'title' => 9, 'description' => 10, 'tags' => 11, 'url' => 12, 'content_type' => 13, 'conversion_profile_id' => 14, 'access_control_profile_id' => 15, 'category' => 16, 'schedule_start_date' => 17, 'schedule_end_date' => 18, 'thumbnail_url' => 19, 'thumbnail_saved' => 20, 'partner_data' => 21, 'error_description' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/BulkUploadResultMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.BulkUploadResultMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = BulkUploadResultPeer::getTableMap();
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
		return str_replace(BulkUploadResultPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(BulkUploadResultPeer::ID);

		$criteria->addSelectColumn(BulkUploadResultPeer::CREATED_AT);

		$criteria->addSelectColumn(BulkUploadResultPeer::UPDATED_AT);

		$criteria->addSelectColumn(BulkUploadResultPeer::BULK_UPLOAD_JOB_ID);

		$criteria->addSelectColumn(BulkUploadResultPeer::LINE_INDEX);

		$criteria->addSelectColumn(BulkUploadResultPeer::PARTNER_ID);

		$criteria->addSelectColumn(BulkUploadResultPeer::ENTRY_ID);

		$criteria->addSelectColumn(BulkUploadResultPeer::ENTRY_STATUS);

		$criteria->addSelectColumn(BulkUploadResultPeer::ROW_DATA);

		$criteria->addSelectColumn(BulkUploadResultPeer::TITLE);

		$criteria->addSelectColumn(BulkUploadResultPeer::DESCRIPTION);

		$criteria->addSelectColumn(BulkUploadResultPeer::TAGS);

		$criteria->addSelectColumn(BulkUploadResultPeer::URL);

		$criteria->addSelectColumn(BulkUploadResultPeer::CONTENT_TYPE);

		$criteria->addSelectColumn(BulkUploadResultPeer::CONVERSION_PROFILE_ID);

		$criteria->addSelectColumn(BulkUploadResultPeer::ACCESS_CONTROL_PROFILE_ID);

		$criteria->addSelectColumn(BulkUploadResultPeer::CATEGORY);

		$criteria->addSelectColumn(BulkUploadResultPeer::SCHEDULE_START_DATE);

		$criteria->addSelectColumn(BulkUploadResultPeer::SCHEDULE_END_DATE);

		$criteria->addSelectColumn(BulkUploadResultPeer::THUMBNAIL_URL);

		$criteria->addSelectColumn(BulkUploadResultPeer::THUMBNAIL_SAVED);

		$criteria->addSelectColumn(BulkUploadResultPeer::PARTNER_DATA);

		$criteria->addSelectColumn(BulkUploadResultPeer::ERROR_DESCRIPTION);

	}

	const COUNT = 'COUNT(bulk_upload_result.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT bulk_upload_result.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BulkUploadResultPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BulkUploadResultPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = BulkUploadResultPeer::doSelectRS($criteria, $con);
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
		$objects = BulkUploadResultPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return BulkUploadResultPeer::populateObjects(BulkUploadResultPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			BulkUploadResultPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = BulkUploadResultPeer::getOMClass();
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
		return BulkUploadResultPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(BulkUploadResultPeer::ID); 

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
			$comparison = $criteria->getComparison(BulkUploadResultPeer::ID);
			$selectCriteria->add(BulkUploadResultPeer::ID, $criteria->remove(BulkUploadResultPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(BulkUploadResultPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(BulkUploadResultPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof BulkUploadResult) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(BulkUploadResultPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(BulkUploadResult $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(BulkUploadResultPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(BulkUploadResultPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(BulkUploadResultPeer::DATABASE_NAME, BulkUploadResultPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = BulkUploadResultPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(BulkUploadResultPeer::DATABASE_NAME);

		$criteria->add(BulkUploadResultPeer::ID, $pk);


		$v = BulkUploadResultPeer::doSelect($criteria, $con);

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
			$criteria->add(BulkUploadResultPeer::ID, $pks, Criteria::IN);
			$objs = BulkUploadResultPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseBulkUploadResultPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/BulkUploadResultMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.BulkUploadResultMapBuilder');
}
