<?php


abstract class BaseuiConfPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ui_conf';

	
	const CLASS_DEFAULT = 'lib.model.uiConf';

	
	const NUM_COLUMNS = 20;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ui_conf.ID';

	
	const OBJ_TYPE = 'ui_conf.OBJ_TYPE';

	
	const PARTNER_ID = 'ui_conf.PARTNER_ID';

	
	const SUBP_ID = 'ui_conf.SUBP_ID';

	
	const CONF_FILE_PATH = 'ui_conf.CONF_FILE_PATH';

	
	const NAME = 'ui_conf.NAME';

	
	const WIDTH = 'ui_conf.WIDTH';

	
	const HEIGHT = 'ui_conf.HEIGHT';

	
	const HTML_PARAMS = 'ui_conf.HTML_PARAMS';

	
	const SWF_URL = 'ui_conf.SWF_URL';

	
	const CREATED_AT = 'ui_conf.CREATED_AT';

	
	const UPDATED_AT = 'ui_conf.UPDATED_AT';

	
	const CONF_VARS = 'ui_conf.CONF_VARS';

	
	const USE_CDN = 'ui_conf.USE_CDN';

	
	const TAGS = 'ui_conf.TAGS';

	
	const CUSTOM_DATA = 'ui_conf.CUSTOM_DATA';

	
	const STATUS = 'ui_conf.STATUS';

	
	const DESCRIPTION = 'ui_conf.DESCRIPTION';

	
	const DISPLAY_IN_SEARCH = 'ui_conf.DISPLAY_IN_SEARCH';

	
	const CREATION_MODE = 'ui_conf.CREATION_MODE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ObjType', 'PartnerId', 'SubpId', 'ConfFilePath', 'Name', 'Width', 'Height', 'HtmlParams', 'SwfUrl', 'CreatedAt', 'UpdatedAt', 'ConfVars', 'UseCdn', 'Tags', 'CustomData', 'Status', 'Description', 'DisplayInSearch', 'CreationMode', ),
		BasePeer::TYPE_COLNAME => array (uiConfPeer::ID, uiConfPeer::OBJ_TYPE, uiConfPeer::PARTNER_ID, uiConfPeer::SUBP_ID, uiConfPeer::CONF_FILE_PATH, uiConfPeer::NAME, uiConfPeer::WIDTH, uiConfPeer::HEIGHT, uiConfPeer::HTML_PARAMS, uiConfPeer::SWF_URL, uiConfPeer::CREATED_AT, uiConfPeer::UPDATED_AT, uiConfPeer::CONF_VARS, uiConfPeer::USE_CDN, uiConfPeer::TAGS, uiConfPeer::CUSTOM_DATA, uiConfPeer::STATUS, uiConfPeer::DESCRIPTION, uiConfPeer::DISPLAY_IN_SEARCH, uiConfPeer::CREATION_MODE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'obj_type', 'partner_id', 'subp_id', 'conf_file_path', 'name', 'width', 'height', 'html_params', 'swf_url', 'created_at', 'updated_at', 'conf_vars', 'use_cdn', 'tags', 'custom_data', 'status', 'description', 'display_in_search', 'creation_mode', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ObjType' => 1, 'PartnerId' => 2, 'SubpId' => 3, 'ConfFilePath' => 4, 'Name' => 5, 'Width' => 6, 'Height' => 7, 'HtmlParams' => 8, 'SwfUrl' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'ConfVars' => 12, 'UseCdn' => 13, 'Tags' => 14, 'CustomData' => 15, 'Status' => 16, 'Description' => 17, 'DisplayInSearch' => 18, 'CreationMode' => 19, ),
		BasePeer::TYPE_COLNAME => array (uiConfPeer::ID => 0, uiConfPeer::OBJ_TYPE => 1, uiConfPeer::PARTNER_ID => 2, uiConfPeer::SUBP_ID => 3, uiConfPeer::CONF_FILE_PATH => 4, uiConfPeer::NAME => 5, uiConfPeer::WIDTH => 6, uiConfPeer::HEIGHT => 7, uiConfPeer::HTML_PARAMS => 8, uiConfPeer::SWF_URL => 9, uiConfPeer::CREATED_AT => 10, uiConfPeer::UPDATED_AT => 11, uiConfPeer::CONF_VARS => 12, uiConfPeer::USE_CDN => 13, uiConfPeer::TAGS => 14, uiConfPeer::CUSTOM_DATA => 15, uiConfPeer::STATUS => 16, uiConfPeer::DESCRIPTION => 17, uiConfPeer::DISPLAY_IN_SEARCH => 18, uiConfPeer::CREATION_MODE => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'obj_type' => 1, 'partner_id' => 2, 'subp_id' => 3, 'conf_file_path' => 4, 'name' => 5, 'width' => 6, 'height' => 7, 'html_params' => 8, 'swf_url' => 9, 'created_at' => 10, 'updated_at' => 11, 'conf_vars' => 12, 'use_cdn' => 13, 'tags' => 14, 'custom_data' => 15, 'status' => 16, 'description' => 17, 'display_in_search' => 18, 'creation_mode' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/uiConfMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.uiConfMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = uiConfPeer::getTableMap();
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
		return str_replace(uiConfPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(uiConfPeer::ID);

		$criteria->addSelectColumn(uiConfPeer::OBJ_TYPE);

		$criteria->addSelectColumn(uiConfPeer::PARTNER_ID);

		$criteria->addSelectColumn(uiConfPeer::SUBP_ID);

		$criteria->addSelectColumn(uiConfPeer::CONF_FILE_PATH);

		$criteria->addSelectColumn(uiConfPeer::NAME);

		$criteria->addSelectColumn(uiConfPeer::WIDTH);

		$criteria->addSelectColumn(uiConfPeer::HEIGHT);

		$criteria->addSelectColumn(uiConfPeer::HTML_PARAMS);

		$criteria->addSelectColumn(uiConfPeer::SWF_URL);

		$criteria->addSelectColumn(uiConfPeer::CREATED_AT);

		$criteria->addSelectColumn(uiConfPeer::UPDATED_AT);

		$criteria->addSelectColumn(uiConfPeer::CONF_VARS);

		$criteria->addSelectColumn(uiConfPeer::USE_CDN);

		$criteria->addSelectColumn(uiConfPeer::TAGS);

		$criteria->addSelectColumn(uiConfPeer::CUSTOM_DATA);

		$criteria->addSelectColumn(uiConfPeer::STATUS);

		$criteria->addSelectColumn(uiConfPeer::DESCRIPTION);

		$criteria->addSelectColumn(uiConfPeer::DISPLAY_IN_SEARCH);

		$criteria->addSelectColumn(uiConfPeer::CREATION_MODE);

	}

	const COUNT = 'COUNT(ui_conf.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ui_conf.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(uiConfPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(uiConfPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = uiConfPeer::doSelectRS($criteria, $con);
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
		$objects = uiConfPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return uiConfPeer::populateObjects(uiConfPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			uiConfPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = uiConfPeer::getOMClass();
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
		return uiConfPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(uiConfPeer::ID); 

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
			$comparison = $criteria->getComparison(uiConfPeer::ID);
			$selectCriteria->add(uiConfPeer::ID, $criteria->remove(uiConfPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(uiConfPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(uiConfPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof uiConf) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(uiConfPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(uiConf $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(uiConfPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(uiConfPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(uiConfPeer::DATABASE_NAME, uiConfPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = uiConfPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(uiConfPeer::DATABASE_NAME);

		$criteria->add(uiConfPeer::ID, $pk);


		$v = uiConfPeer::doSelect($criteria, $con);

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
			$criteria->add(uiConfPeer::ID, $pks, Criteria::IN);
			$objs = uiConfPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseuiConfPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/uiConfMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.uiConfMapBuilder');
}
