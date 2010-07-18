<?php


abstract class BaseTrackEntry extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $track_event_type_id;


	
	protected $ps_version;


	
	protected $context;


	
	protected $partner_id;


	
	protected $entry_id;


	
	protected $host_name;


	
	protected $uid;


	
	protected $track_event_status_id;


	
	protected $changed_properties;


	
	protected $param_1_str;


	
	protected $param_2_str;


	
	protected $param_3_str;


	
	protected $ks;


	
	protected $description;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $user_ip;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTrackEventTypeId()
	{

		return $this->track_event_type_id;
	}

	
	public function getPsVersion()
	{

		return $this->ps_version;
	}

	
	public function getContext()
	{

		return $this->context;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getHostName()
	{

		return $this->host_name;
	}

	
	public function getUid()
	{

		return $this->uid;
	}

	
	public function getTrackEventStatusId()
	{

		return $this->track_event_status_id;
	}

	
	public function getChangedProperties()
	{

		return $this->changed_properties;
	}

	
	public function getParam1Str()
	{

		return $this->param_1_str;
	}

	
	public function getParam2Str()
	{

		return $this->param_2_str;
	}

	
	public function getParam3Str()
	{

		return $this->param_3_str;
	}

	
	public function getKs()
	{

		return $this->ks;
	}

	
	public function getDescription()
	{

		return $this->description;
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

	
	public function getUserIp()
	{

		return $this->user_ip;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TrackEntryPeer::ID;
		}

	} 
	
	public function setTrackEventTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->track_event_type_id !== $v) {
			$this->track_event_type_id = $v;
			$this->modifiedColumns[] = TrackEntryPeer::TRACK_EVENT_TYPE_ID;
		}

	} 
	
	public function setPsVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ps_version !== $v) {
			$this->ps_version = $v;
			$this->modifiedColumns[] = TrackEntryPeer::PS_VERSION;
		}

	} 
	
	public function setContext($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->context !== $v) {
			$this->context = $v;
			$this->modifiedColumns[] = TrackEntryPeer::CONTEXT;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = TrackEntryPeer::PARTNER_ID;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = TrackEntryPeer::ENTRY_ID;
		}

	} 
	
	public function setHostName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->host_name !== $v) {
			$this->host_name = $v;
			$this->modifiedColumns[] = TrackEntryPeer::HOST_NAME;
		}

	} 
	
	public function setUid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uid !== $v) {
			$this->uid = $v;
			$this->modifiedColumns[] = TrackEntryPeer::UID;
		}

	} 
	
	public function setTrackEventStatusId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->track_event_status_id !== $v) {
			$this->track_event_status_id = $v;
			$this->modifiedColumns[] = TrackEntryPeer::TRACK_EVENT_STATUS_ID;
		}

	} 
	
	public function setChangedProperties($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->changed_properties !== $v) {
			$this->changed_properties = $v;
			$this->modifiedColumns[] = TrackEntryPeer::CHANGED_PROPERTIES;
		}

	} 
	
	public function setParam1Str($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->param_1_str !== $v) {
			$this->param_1_str = $v;
			$this->modifiedColumns[] = TrackEntryPeer::PARAM_1_STR;
		}

	} 
	
	public function setParam2Str($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->param_2_str !== $v) {
			$this->param_2_str = $v;
			$this->modifiedColumns[] = TrackEntryPeer::PARAM_2_STR;
		}

	} 
	
	public function setParam3Str($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->param_3_str !== $v) {
			$this->param_3_str = $v;
			$this->modifiedColumns[] = TrackEntryPeer::PARAM_3_STR;
		}

	} 
	
	public function setKs($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ks !== $v) {
			$this->ks = $v;
			$this->modifiedColumns[] = TrackEntryPeer::KS;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = TrackEntryPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = TrackEntryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = TrackEntryPeer::UPDATED_AT;
		}

	} 
	
	public function setUserIp($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_ip !== $v) {
			$this->user_ip = $v;
			$this->modifiedColumns[] = TrackEntryPeer::USER_IP;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->track_event_type_id = $rs->getInt($startcol + 1);

			$this->ps_version = $rs->getString($startcol + 2);

			$this->context = $rs->getString($startcol + 3);

			$this->partner_id = $rs->getInt($startcol + 4);

			$this->entry_id = $rs->getString($startcol + 5);

			$this->host_name = $rs->getString($startcol + 6);

			$this->uid = $rs->getString($startcol + 7);

			$this->track_event_status_id = $rs->getInt($startcol + 8);

			$this->changed_properties = $rs->getString($startcol + 9);

			$this->param_1_str = $rs->getString($startcol + 10);

			$this->param_2_str = $rs->getString($startcol + 11);

			$this->param_3_str = $rs->getString($startcol + 12);

			$this->ks = $rs->getString($startcol + 13);

			$this->description = $rs->getString($startcol + 14);

			$this->created_at = $rs->getTimestamp($startcol + 15, null);

			$this->updated_at = $rs->getTimestamp($startcol + 16, null);

			$this->user_ip = $rs->getString($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TrackEntry object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TrackEntryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TrackEntryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TrackEntryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TrackEntryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TrackEntryPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackEntryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TrackEntryPeer::doUpdate($this, $con);
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


			if (($retval = TrackEntryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackEntryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTrackEventTypeId();
				break;
			case 2:
				return $this->getPsVersion();
				break;
			case 3:
				return $this->getContext();
				break;
			case 4:
				return $this->getPartnerId();
				break;
			case 5:
				return $this->getEntryId();
				break;
			case 6:
				return $this->getHostName();
				break;
			case 7:
				return $this->getUid();
				break;
			case 8:
				return $this->getTrackEventStatusId();
				break;
			case 9:
				return $this->getChangedProperties();
				break;
			case 10:
				return $this->getParam1Str();
				break;
			case 11:
				return $this->getParam2Str();
				break;
			case 12:
				return $this->getParam3Str();
				break;
			case 13:
				return $this->getKs();
				break;
			case 14:
				return $this->getDescription();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
				return $this->getUpdatedAt();
				break;
			case 17:
				return $this->getUserIp();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrackEntryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTrackEventTypeId(),
			$keys[2] => $this->getPsVersion(),
			$keys[3] => $this->getContext(),
			$keys[4] => $this->getPartnerId(),
			$keys[5] => $this->getEntryId(),
			$keys[6] => $this->getHostName(),
			$keys[7] => $this->getUid(),
			$keys[8] => $this->getTrackEventStatusId(),
			$keys[9] => $this->getChangedProperties(),
			$keys[10] => $this->getParam1Str(),
			$keys[11] => $this->getParam2Str(),
			$keys[12] => $this->getParam3Str(),
			$keys[13] => $this->getKs(),
			$keys[14] => $this->getDescription(),
			$keys[15] => $this->getCreatedAt(),
			$keys[16] => $this->getUpdatedAt(),
			$keys[17] => $this->getUserIp(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackEntryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTrackEventTypeId($value);
				break;
			case 2:
				$this->setPsVersion($value);
				break;
			case 3:
				$this->setContext($value);
				break;
			case 4:
				$this->setPartnerId($value);
				break;
			case 5:
				$this->setEntryId($value);
				break;
			case 6:
				$this->setHostName($value);
				break;
			case 7:
				$this->setUid($value);
				break;
			case 8:
				$this->setTrackEventStatusId($value);
				break;
			case 9:
				$this->setChangedProperties($value);
				break;
			case 10:
				$this->setParam1Str($value);
				break;
			case 11:
				$this->setParam2Str($value);
				break;
			case 12:
				$this->setParam3Str($value);
				break;
			case 13:
				$this->setKs($value);
				break;
			case 14:
				$this->setDescription($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
				$this->setUpdatedAt($value);
				break;
			case 17:
				$this->setUserIp($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrackEntryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTrackEventTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPsVersion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContext($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPartnerId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEntryId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHostName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUid($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTrackEventStatusId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setChangedProperties($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setParam1Str($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setParam2Str($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setParam3Str($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setKs($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDescription($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUserIp($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackEntryPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackEntryPeer::ID)) $criteria->add(TrackEntryPeer::ID, $this->id);
		if ($this->isColumnModified(TrackEntryPeer::TRACK_EVENT_TYPE_ID)) $criteria->add(TrackEntryPeer::TRACK_EVENT_TYPE_ID, $this->track_event_type_id);
		if ($this->isColumnModified(TrackEntryPeer::PS_VERSION)) $criteria->add(TrackEntryPeer::PS_VERSION, $this->ps_version);
		if ($this->isColumnModified(TrackEntryPeer::CONTEXT)) $criteria->add(TrackEntryPeer::CONTEXT, $this->context);
		if ($this->isColumnModified(TrackEntryPeer::PARTNER_ID)) $criteria->add(TrackEntryPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(TrackEntryPeer::ENTRY_ID)) $criteria->add(TrackEntryPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(TrackEntryPeer::HOST_NAME)) $criteria->add(TrackEntryPeer::HOST_NAME, $this->host_name);
		if ($this->isColumnModified(TrackEntryPeer::UID)) $criteria->add(TrackEntryPeer::UID, $this->uid);
		if ($this->isColumnModified(TrackEntryPeer::TRACK_EVENT_STATUS_ID)) $criteria->add(TrackEntryPeer::TRACK_EVENT_STATUS_ID, $this->track_event_status_id);
		if ($this->isColumnModified(TrackEntryPeer::CHANGED_PROPERTIES)) $criteria->add(TrackEntryPeer::CHANGED_PROPERTIES, $this->changed_properties);
		if ($this->isColumnModified(TrackEntryPeer::PARAM_1_STR)) $criteria->add(TrackEntryPeer::PARAM_1_STR, $this->param_1_str);
		if ($this->isColumnModified(TrackEntryPeer::PARAM_2_STR)) $criteria->add(TrackEntryPeer::PARAM_2_STR, $this->param_2_str);
		if ($this->isColumnModified(TrackEntryPeer::PARAM_3_STR)) $criteria->add(TrackEntryPeer::PARAM_3_STR, $this->param_3_str);
		if ($this->isColumnModified(TrackEntryPeer::KS)) $criteria->add(TrackEntryPeer::KS, $this->ks);
		if ($this->isColumnModified(TrackEntryPeer::DESCRIPTION)) $criteria->add(TrackEntryPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(TrackEntryPeer::CREATED_AT)) $criteria->add(TrackEntryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TrackEntryPeer::UPDATED_AT)) $criteria->add(TrackEntryPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(TrackEntryPeer::USER_IP)) $criteria->add(TrackEntryPeer::USER_IP, $this->user_ip);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TrackEntryPeer::DATABASE_NAME);

		$criteria->add(TrackEntryPeer::ID, $this->id);

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

		$copyObj->setTrackEventTypeId($this->track_event_type_id);

		$copyObj->setPsVersion($this->ps_version);

		$copyObj->setContext($this->context);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setHostName($this->host_name);

		$copyObj->setUid($this->uid);

		$copyObj->setTrackEventStatusId($this->track_event_status_id);

		$copyObj->setChangedProperties($this->changed_properties);

		$copyObj->setParam1Str($this->param_1_str);

		$copyObj->setParam2Str($this->param_2_str);

		$copyObj->setParam3Str($this->param_3_str);

		$copyObj->setKs($this->ks);

		$copyObj->setDescription($this->description);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setUserIp($this->user_ip);


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
			self::$peer = new TrackEntryPeer();
		}
		return self::$peer;
	}

} 