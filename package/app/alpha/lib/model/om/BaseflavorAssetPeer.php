<?php


abstract class BaseflavorAssetPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'flavor_asset';

	
	const CLASS_DEFAULT = 'lib.model.flavorAsset';

	
	const NUM_COLUMNS = 21;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'flavor_asset.ID';

	
	const INT_ID = 'flavor_asset.INT_ID';

	
	const PARTNER_ID = 'flavor_asset.PARTNER_ID';

	
	const TAGS = 'flavor_asset.TAGS';

	
	const CREATED_AT = 'flavor_asset.CREATED_AT';

	
	const UPDATED_AT = 'flavor_asset.UPDATED_AT';

	
	const DELETED_AT = 'flavor_asset.DELETED_AT';

	
	const ENTRY_ID = 'flavor_asset.ENTRY_ID';

	
	const FLAVOR_PARAMS_ID = 'flavor_asset.FLAVOR_PARAMS_ID';

	
	const STATUS = 'flavor_asset.STATUS';

	
	const VERSION = 'flavor_asset.VERSION';

	
	const DESCRIPTION = 'flavor_asset.DESCRIPTION';

	
	const WIDTH = 'flavor_asset.WIDTH';

	
	const HEIGHT = 'flavor_asset.HEIGHT';

	
	const BITRATE = 'flavor_asset.BITRATE';

	
	const FRAME_RATE = 'flavor_asset.FRAME_RATE';

	
	const SIZE = 'flavor_asset.SIZE';

	
	const IS_ORIGINAL = 'flavor_asset.IS_ORIGINAL';

	
	const FILE_EXT = 'flavor_asset.FILE_EXT';

	
	const CONTAINER_FORMAT = 'flavor_asset.CONTAINER_FORMAT';

	
	const VIDEO_CODEC_ID = 'flavor_asset.VIDEO_CODEC_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IntId', 'PartnerId', 'Tags', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'EntryId', 'FlavorParamsId', 'Status', 'Version', 'Description', 'Width', 'Height', 'Bitrate', 'FrameRate', 'Size', 'IsOriginal', 'FileExt', 'ContainerFormat', 'VideoCodecId', ),
		BasePeer::TYPE_COLNAME => array (flavorAssetPeer::ID, flavorAssetPeer::INT_ID, flavorAssetPeer::PARTNER_ID, flavorAssetPeer::TAGS, flavorAssetPeer::CREATED_AT, flavorAssetPeer::UPDATED_AT, flavorAssetPeer::DELETED_AT, flavorAssetPeer::ENTRY_ID, flavorAssetPeer::FLAVOR_PARAMS_ID, flavorAssetPeer::STATUS, flavorAssetPeer::VERSION, flavorAssetPeer::DESCRIPTION, flavorAssetPeer::WIDTH, flavorAssetPeer::HEIGHT, flavorAssetPeer::BITRATE, flavorAssetPeer::FRAME_RATE, flavorAssetPeer::SIZE, flavorAssetPeer::IS_ORIGINAL, flavorAssetPeer::FILE_EXT, flavorAssetPeer::CONTAINER_FORMAT, flavorAssetPeer::VIDEO_CODEC_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'int_id', 'partner_id', 'tags', 'created_at', 'updated_at', 'deleted_at', 'entry_id', 'flavor_params_id', 'status', 'version', 'description', 'width', 'height', 'bitrate', 'frame_rate', 'size', 'is_original', 'file_ext', 'container_format', 'video_codec_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IntId' => 1, 'PartnerId' => 2, 'Tags' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'DeletedAt' => 6, 'EntryId' => 7, 'FlavorParamsId' => 8, 'Status' => 9, 'Version' => 10, 'Description' => 11, 'Width' => 12, 'Height' => 13, 'Bitrate' => 14, 'FrameRate' => 15, 'Size' => 16, 'IsOriginal' => 17, 'FileExt' => 18, 'ContainerFormat' => 19, 'VideoCodecId' => 20, ),
		BasePeer::TYPE_COLNAME => array (flavorAssetPeer::ID => 0, flavorAssetPeer::INT_ID => 1, flavorAssetPeer::PARTNER_ID => 2, flavorAssetPeer::TAGS => 3, flavorAssetPeer::CREATED_AT => 4, flavorAssetPeer::UPDATED_AT => 5, flavorAssetPeer::DELETED_AT => 6, flavorAssetPeer::ENTRY_ID => 7, flavorAssetPeer::FLAVOR_PARAMS_ID => 8, flavorAssetPeer::STATUS => 9, flavorAssetPeer::VERSION => 10, flavorAssetPeer::DESCRIPTION => 11, flavorAssetPeer::WIDTH => 12, flavorAssetPeer::HEIGHT => 13, flavorAssetPeer::BITRATE => 14, flavorAssetPeer::FRAME_RATE => 15, flavorAssetPeer::SIZE => 16, flavorAssetPeer::IS_ORIGINAL => 17, flavorAssetPeer::FILE_EXT => 18, flavorAssetPeer::CONTAINER_FORMAT => 19, flavorAssetPeer::VIDEO_CODEC_ID => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'int_id' => 1, 'partner_id' => 2, 'tags' => 3, 'created_at' => 4, 'updated_at' => 5, 'deleted_at' => 6, 'entry_id' => 7, 'flavor_params_id' => 8, 'status' => 9, 'version' => 10, 'description' => 11, 'width' => 12, 'height' => 13, 'bitrate' => 14, 'frame_rate' => 15, 'size' => 16, 'is_original' => 17, 'file_ext' => 18, 'container_format' => 19, 'video_codec_id' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/flavorAssetMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.flavorAssetMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = flavorAssetPeer::getTableMap();
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
		return str_replace(flavorAssetPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(flavorAssetPeer::ID);

		$criteria->addSelectColumn(flavorAssetPeer::INT_ID);

		$criteria->addSelectColumn(flavorAssetPeer::PARTNER_ID);

		$criteria->addSelectColumn(flavorAssetPeer::TAGS);

		$criteria->addSelectColumn(flavorAssetPeer::CREATED_AT);

		$criteria->addSelectColumn(flavorAssetPeer::UPDATED_AT);

		$criteria->addSelectColumn(flavorAssetPeer::DELETED_AT);

		$criteria->addSelectColumn(flavorAssetPeer::ENTRY_ID);

		$criteria->addSelectColumn(flavorAssetPeer::FLAVOR_PARAMS_ID);

		$criteria->addSelectColumn(flavorAssetPeer::STATUS);

		$criteria->addSelectColumn(flavorAssetPeer::VERSION);

		$criteria->addSelectColumn(flavorAssetPeer::DESCRIPTION);

		$criteria->addSelectColumn(flavorAssetPeer::WIDTH);

		$criteria->addSelectColumn(flavorAssetPeer::HEIGHT);

		$criteria->addSelectColumn(flavorAssetPeer::BITRATE);

		$criteria->addSelectColumn(flavorAssetPeer::FRAME_RATE);

		$criteria->addSelectColumn(flavorAssetPeer::SIZE);

		$criteria->addSelectColumn(flavorAssetPeer::IS_ORIGINAL);

		$criteria->addSelectColumn(flavorAssetPeer::FILE_EXT);

		$criteria->addSelectColumn(flavorAssetPeer::CONTAINER_FORMAT);

		$criteria->addSelectColumn(flavorAssetPeer::VIDEO_CODEC_ID);

	}

	const COUNT = 'COUNT(flavor_asset.INT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT flavor_asset.INT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = flavorAssetPeer::doSelectRS($criteria, $con);
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
		$objects = flavorAssetPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return flavorAssetPeer::populateObjects(flavorAssetPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			flavorAssetPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = flavorAssetPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorAssetPeer::ENTRY_ID, entryPeer::ID);

		$rs = flavorAssetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinflavorParams(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorAssetPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorAssetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinentry(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorAssetPeer::addSelectColumns($c);
		$startcol = (flavorAssetPeer::NUM_COLUMNS - flavorAssetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		entryPeer::addSelectColumns($c);

		$c->addJoin(flavorAssetPeer::ENTRY_ID, entryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorAssetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorAsset($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorAssets();
				$obj2->addflavorAsset($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinflavorParams(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorAssetPeer::addSelectColumns($c);
		$startcol = (flavorAssetPeer::NUM_COLUMNS - flavorAssetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		flavorParamsPeer::addSelectColumns($c);

		$c->addJoin(flavorAssetPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorAssetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addflavorAsset($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initflavorAssets();
				$obj2->addflavorAsset($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorAssetPeer::ENTRY_ID, entryPeer::ID);

		$criteria->addJoin(flavorAssetPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorAssetPeer::doSelectRS($criteria, $con);
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

		flavorAssetPeer::addSelectColumns($c);
		$startcol2 = (flavorAssetPeer::NUM_COLUMNS - flavorAssetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		flavorParamsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + flavorParamsPeer::NUM_COLUMNS;

		$c->addJoin(flavorAssetPeer::ENTRY_ID, entryPeer::ID);

		$c->addJoin(flavorAssetPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorAssetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorAsset($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorAssets();
				$obj2->addflavorAsset($obj1);
			}


					
			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getflavorParams(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addflavorAsset($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initflavorAssets();
				$obj3->addflavorAsset($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptentry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorAssetPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);

		$rs = flavorAssetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptflavorParams(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(flavorAssetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(flavorAssetPeer::ENTRY_ID, entryPeer::ID);

		$rs = flavorAssetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptentry(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorAssetPeer::addSelectColumns($c);
		$startcol2 = (flavorAssetPeer::NUM_COLUMNS - flavorAssetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		flavorParamsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + flavorParamsPeer::NUM_COLUMNS;

		$c->addJoin(flavorAssetPeer::FLAVOR_PARAMS_ID, flavorParamsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorAssetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = flavorParamsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getflavorParams(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorAsset($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorAssets();
				$obj2->addflavorAsset($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptflavorParams(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		flavorAssetPeer::addSelectColumns($c);
		$startcol2 = (flavorAssetPeer::NUM_COLUMNS - flavorAssetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		entryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + entryPeer::NUM_COLUMNS;

		$c->addJoin(flavorAssetPeer::ENTRY_ID, entryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = flavorAssetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = entryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getentry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addflavorAsset($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initflavorAssets();
				$obj2->addflavorAsset($obj1);
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
		return flavorAssetPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(flavorAssetPeer::INT_ID); 

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
			$comparison = $criteria->getComparison(flavorAssetPeer::INT_ID);
			$selectCriteria->add(flavorAssetPeer::INT_ID, $criteria->remove(flavorAssetPeer::INT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(flavorAssetPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(flavorAssetPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof flavorAsset) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(flavorAssetPeer::INT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(flavorAsset $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(flavorAssetPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(flavorAssetPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(flavorAssetPeer::DATABASE_NAME, flavorAssetPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = flavorAssetPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(flavorAssetPeer::DATABASE_NAME);

		$criteria->add(flavorAssetPeer::INT_ID, $pk);


		$v = flavorAssetPeer::doSelect($criteria, $con);

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
			$criteria->add(flavorAssetPeer::INT_ID, $pks, Criteria::IN);
			$objs = flavorAssetPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseflavorAssetPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/flavorAssetMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.flavorAssetMapBuilder');
}
