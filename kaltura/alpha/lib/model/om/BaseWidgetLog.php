<?php


abstract class BaseWidgetLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kshow_id;


	
	protected $entry_id;


	
	protected $kmedia_type;


	
	protected $widget_type;


	
	protected $referer;


	
	protected $views = 0;


	
	protected $ip1;


	
	protected $ip1_count = 0;


	
	protected $ip2;


	
	protected $ip2_count = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $plays = 0;


	
	protected $partner_id = 0;


	
	protected $subp_id = 0;

	
	protected $aentry;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getKshowId()
	{

		return $this->kshow_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getKmediaType()
	{

		return $this->kmedia_type;
	}

	
	public function getWidgetType()
	{

		return $this->widget_type;
	}

	
	public function getReferer()
	{

		return $this->referer;
	}

	
	public function getViews()
	{

		return $this->views;
	}

	
	public function getIp1()
	{

		return $this->ip1;
	}

	
	public function getIp1Count()
	{

		return $this->ip1_count;
	}

	
	public function getIp2()
	{

		return $this->ip2;
	}

	
	public function getIp2Count()
	{

		return $this->ip2_count;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getPlays()
	{

		return $this->plays;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WidgetLogPeer::ID;
		}

	} 
	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = WidgetLogPeer::KSHOW_ID;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = WidgetLogPeer::ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setKmediaType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kmedia_type !== $v) {
			$this->kmedia_type = $v;
			$this->modifiedColumns[] = WidgetLogPeer::KMEDIA_TYPE;
		}

	} 
	
	public function setWidgetType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->widget_type !== $v) {
			$this->widget_type = $v;
			$this->modifiedColumns[] = WidgetLogPeer::WIDGET_TYPE;
		}

	} 
	
	public function setReferer($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->referer !== $v) {
			$this->referer = $v;
			$this->modifiedColumns[] = WidgetLogPeer::REFERER;
		}

	} 
	
	public function setViews($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->views !== $v || $v === 0) {
			$this->views = $v;
			$this->modifiedColumns[] = WidgetLogPeer::VIEWS;
		}

	} 
	
	public function setIp1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip1 !== $v) {
			$this->ip1 = $v;
			$this->modifiedColumns[] = WidgetLogPeer::IP1;
		}

	} 
	
	public function setIp1Count($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip1_count !== $v || $v === 0) {
			$this->ip1_count = $v;
			$this->modifiedColumns[] = WidgetLogPeer::IP1_COUNT;
		}

	} 
	
	public function setIp2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip2 !== $v) {
			$this->ip2 = $v;
			$this->modifiedColumns[] = WidgetLogPeer::IP2;
		}

	} 
	
	public function setIp2Count($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip2_count !== $v || $v === 0) {
			$this->ip2_count = $v;
			$this->modifiedColumns[] = WidgetLogPeer::IP2_COUNT;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = WidgetLogPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = WidgetLogPeer::UPDATED_AT;
		}

	} 
	
	public function setPlays($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->plays !== $v || $v === 0) {
			$this->plays = $v;
			$this->modifiedColumns[] = WidgetLogPeer::PLAYS;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = WidgetLogPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = WidgetLogPeer::SUBP_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->kshow_id = $rs->getString($startcol + 1);

			$this->entry_id = $rs->getString($startcol + 2);

			$this->kmedia_type = $rs->getInt($startcol + 3);

			$this->widget_type = $rs->getString($startcol + 4);

			$this->referer = $rs->getString($startcol + 5);

			$this->views = $rs->getInt($startcol + 6);

			$this->ip1 = $rs->getInt($startcol + 7);

			$this->ip1_count = $rs->getInt($startcol + 8);

			$this->ip2 = $rs->getInt($startcol + 9);

			$this->ip2_count = $rs->getInt($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->plays = $rs->getInt($startcol + 13);

			$this->partner_id = $rs->getInt($startcol + 14);

			$this->subp_id = $rs->getInt($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WidgetLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WidgetLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WidgetLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WidgetLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(WidgetLogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WidgetLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aentry !== null) {
				if ($this->aentry->isModified()) {
					$affectedRows += $this->aentry->save($con);
				}
				$this->setentry($this->aentry);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WidgetLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WidgetLogPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}


			if (($retval = WidgetLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WidgetLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKshowId();
				break;
			case 2:
				return $this->getEntryId();
				break;
			case 3:
				return $this->getKmediaType();
				break;
			case 4:
				return $this->getWidgetType();
				break;
			case 5:
				return $this->getReferer();
				break;
			case 6:
				return $this->getViews();
				break;
			case 7:
				return $this->getIp1();
				break;
			case 8:
				return $this->getIp1Count();
				break;
			case 9:
				return $this->getIp2();
				break;
			case 10:
				return $this->getIp2Count();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			case 13:
				return $this->getPlays();
				break;
			case 14:
				return $this->getPartnerId();
				break;
			case 15:
				return $this->getSubpId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WidgetLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKshowId(),
			$keys[2] => $this->getEntryId(),
			$keys[3] => $this->getKmediaType(),
			$keys[4] => $this->getWidgetType(),
			$keys[5] => $this->getReferer(),
			$keys[6] => $this->getViews(),
			$keys[7] => $this->getIp1(),
			$keys[8] => $this->getIp1Count(),
			$keys[9] => $this->getIp2(),
			$keys[10] => $this->getIp2Count(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
			$keys[13] => $this->getPlays(),
			$keys[14] => $this->getPartnerId(),
			$keys[15] => $this->getSubpId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WidgetLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKshowId($value);
				break;
			case 2:
				$this->setEntryId($value);
				break;
			case 3:
				$this->setKmediaType($value);
				break;
			case 4:
				$this->setWidgetType($value);
				break;
			case 5:
				$this->setReferer($value);
				break;
			case 6:
				$this->setViews($value);
				break;
			case 7:
				$this->setIp1($value);
				break;
			case 8:
				$this->setIp1Count($value);
				break;
			case 9:
				$this->setIp2($value);
				break;
			case 10:
				$this->setIp2Count($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
			case 13:
				$this->setPlays($value);
				break;
			case 14:
				$this->setPartnerId($value);
				break;
			case 15:
				$this->setSubpId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WidgetLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKshowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEntryId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setKmediaType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWidgetType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setReferer($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setViews($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIp1($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIp1Count($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIp2($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIp2Count($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPlays($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPartnerId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setSubpId($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WidgetLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(WidgetLogPeer::ID)) $criteria->add(WidgetLogPeer::ID, $this->id);
		if ($this->isColumnModified(WidgetLogPeer::KSHOW_ID)) $criteria->add(WidgetLogPeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(WidgetLogPeer::ENTRY_ID)) $criteria->add(WidgetLogPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(WidgetLogPeer::KMEDIA_TYPE)) $criteria->add(WidgetLogPeer::KMEDIA_TYPE, $this->kmedia_type);
		if ($this->isColumnModified(WidgetLogPeer::WIDGET_TYPE)) $criteria->add(WidgetLogPeer::WIDGET_TYPE, $this->widget_type);
		if ($this->isColumnModified(WidgetLogPeer::REFERER)) $criteria->add(WidgetLogPeer::REFERER, $this->referer);
		if ($this->isColumnModified(WidgetLogPeer::VIEWS)) $criteria->add(WidgetLogPeer::VIEWS, $this->views);
		if ($this->isColumnModified(WidgetLogPeer::IP1)) $criteria->add(WidgetLogPeer::IP1, $this->ip1);
		if ($this->isColumnModified(WidgetLogPeer::IP1_COUNT)) $criteria->add(WidgetLogPeer::IP1_COUNT, $this->ip1_count);
		if ($this->isColumnModified(WidgetLogPeer::IP2)) $criteria->add(WidgetLogPeer::IP2, $this->ip2);
		if ($this->isColumnModified(WidgetLogPeer::IP2_COUNT)) $criteria->add(WidgetLogPeer::IP2_COUNT, $this->ip2_count);
		if ($this->isColumnModified(WidgetLogPeer::CREATED_AT)) $criteria->add(WidgetLogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WidgetLogPeer::UPDATED_AT)) $criteria->add(WidgetLogPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(WidgetLogPeer::PLAYS)) $criteria->add(WidgetLogPeer::PLAYS, $this->plays);
		if ($this->isColumnModified(WidgetLogPeer::PARTNER_ID)) $criteria->add(WidgetLogPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(WidgetLogPeer::SUBP_ID)) $criteria->add(WidgetLogPeer::SUBP_ID, $this->subp_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WidgetLogPeer::DATABASE_NAME);

		$criteria->add(WidgetLogPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setKshowId($this->kshow_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setKmediaType($this->kmedia_type);

		$copyObj->setWidgetType($this->widget_type);

		$copyObj->setReferer($this->referer);

		$copyObj->setViews($this->views);

		$copyObj->setIp1($this->ip1);

		$copyObj->setIp1Count($this->ip1_count);

		$copyObj->setIp2($this->ip2);

		$copyObj->setIp2Count($this->ip2_count);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPlays($this->plays);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setSubpId($this->subp_id);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WidgetLogPeer();
		}
		return self::$peer;
	}

	
	public function setentry($v)
	{


		if ($v === null) {
			$this->setEntryId(NULL);
		} else {
			$this->setEntryId($v->getId());
		}


		$this->aentry = $v;
	}


	
	public function getentry($con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';

		if ($this->aentry === null && (($this->entry_id !== "" && $this->entry_id !== null))) {

			$this->aentry = entryPeer::retrieveByPK($this->entry_id, $con);

			
		}
		return $this->aentry;
	}

} 