<?php


abstract class BaseSearchResultPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'search_result';

	
	const CLASS_DEFAULT = 'lib.model.SearchResult';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'search_result.ID';

	
	const PARTNER_ID = 'search_result.PARTNER_ID';

	
	const KEYWORDS = 'search_result.KEYWORDS';

	
	const SOURCE = 'search_result.SOURCE';

	
	const MEDIA_TYPE = 'search_result.MEDIA_TYPE';

	
	const TITLE = 'search_result.TITLE';

	
	const TAGS = 'search_result.TAGS';

	
	const DESCRIPTION = 'search_result.DESCRIPTION';

	
	const URL = 'search_result.URL';

	
	const THUMB_URL = 'search_result.THUMB_URL';

	
	const SOURCE_LINK = 'search_result.SOURCE_LINK';

	
	const CREDIT = 'search_result.CREDIT';

	
	const EMBED_CODE = 'search_result.EMBED_CODE';

	
	const LICENSE_TYPE = 'search_result.LICENSE_TYPE';

	
	const CREATED_AT = 'search_result.CREATED_AT';

	
	const UPDATED_AT = 'search_result.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PartnerId', 'Keywords', 'Source', 'MediaType', 'Title', 'Tags', 'Description', 'Url', 'ThumbUrl', 'SourceLink', 'Credit', 'EmbedCode', 'LicenseType', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (SearchResultPeer::ID, SearchResultPeer::PARTNER_ID, SearchResultPeer::KEYWORDS, SearchResultPeer::SOURCE, SearchResultPeer::MEDIA_TYPE, SearchResultPeer::TITLE, SearchResultPeer::TAGS, SearchResultPeer::DESCRIPTION, SearchResultPeer::URL, SearchResultPeer::THUMB_URL, SearchResultPeer::SOURCE_LINK, SearchResultPeer::CREDIT, SearchResultPeer::EMBED_CODE, SearchResultPeer::LICENSE_TYPE, SearchResultPeer::CREATED_AT, SearchResultPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'partner_id', 'keywords', 'source', 'media_type', 'title', 'tags', 'description', 'url', 'thumb_url', 'source_link', 'credit', 'embed_code', 'license_type', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PartnerId' => 1, 'Keywords' => 2, 'Source' => 3, 'MediaType' => 4, 'Title' => 5, 'Tags' => 6, 'Description' => 7, 'Url' => 8, 'ThumbUrl' => 9, 'SourceLink' => 10, 'Credit' => 11, 'EmbedCode' => 12, 'LicenseType' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
		BasePeer::TYPE_COLNAME => array (SearchResultPeer::ID => 0, SearchResultPeer::PARTNER_ID => 1, SearchResultPeer::KEYWORDS => 2, SearchResultPeer::SOURCE => 3, SearchResultPeer::MEDIA_TYPE => 4, SearchResultPeer::TITLE => 5, SearchResultPeer::TAGS => 6, SearchResultPeer::DESCRIPTION => 7, SearchResultPeer::URL => 8, SearchResultPeer::THUMB_URL => 9, SearchResultPeer::SOURCE_LINK => 10, SearchResultPeer::CREDIT => 11, SearchResultPeer::EMBED_CODE => 12, SearchResultPeer::LICENSE_TYPE => 13, SearchResultPeer::CREATED_AT => 14, SearchResultPeer::UPDATED_AT => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'partner_id' => 1, 'keywords' => 2, 'source' => 3, 'media_type' => 4, 'title' => 5, 'tags' => 6, 'description' => 7, 'url' => 8, 'thumb_url' => 9, 'source_link' => 10, 'credit' => 11, 'embed_code' => 12, 'license_type' => 13, 'created_at' => 14, 'updated_at' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SearchResultMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SearchResultMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SearchResultPeer::getTableMap();
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
		return str_replace(SearchResultPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SearchResultPeer::ID);

		$criteria->addSelectColumn(SearchResultPeer::PARTNER_ID);

		$criteria->addSelectColumn(SearchResultPeer::KEYWORDS);

		$criteria->addSelectColumn(SearchResultPeer::SOURCE);

		$criteria->addSelectColumn(SearchResultPeer::MEDIA_TYPE);

		$criteria->addSelectColumn(SearchResultPeer::TITLE);

		$criteria->addSelectColumn(SearchResultPeer::TAGS);

		$criteria->addSelectColumn(SearchResultPeer::DESCRIPTION);

		$criteria->addSelectColumn(SearchResultPeer::URL);

		$criteria->addSelectColumn(SearchResultPeer::THUMB_URL);

		$criteria->addSelectColumn(SearchResultPeer::SOURCE_LINK);

		$criteria->addSelectColumn(SearchResultPeer::CREDIT);

		$criteria->addSelectColumn(SearchResultPeer::EMBED_CODE);

		$criteria->addSelectColumn(SearchResultPeer::LICENSE_TYPE);

		$criteria->addSelectColumn(SearchResultPeer::CREATED_AT);

		$criteria->addSelectColumn(SearchResultPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(search_result.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT search_result.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SearchResultPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SearchResultPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SearchResultPeer::doSelectRS($criteria, $con);
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
		$objects = SearchResultPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SearchResultPeer::populateObjects(SearchResultPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SearchResultPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SearchResultPeer::getOMClass();
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
		return SearchResultPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SearchResultPeer::ID); 

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
			$comparison = $criteria->getComparison(SearchResultPeer::ID);
			$selectCriteria->add(SearchResultPeer::ID, $criteria->remove(SearchResultPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SearchResultPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SearchResultPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SearchResult) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SearchResultPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SearchResult $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SearchResultPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SearchResultPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SearchResultPeer::DATABASE_NAME, SearchResultPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SearchResultPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SearchResultPeer::DATABASE_NAME);

		$criteria->add(SearchResultPeer::ID, $pk);


		$v = SearchResultPeer::doSelect($criteria, $con);

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
			$criteria->add(SearchResultPeer::ID, $pks, Criteria::IN);
			$objs = SearchResultPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSearchResultPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SearchResultMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SearchResultMapBuilder');
}
