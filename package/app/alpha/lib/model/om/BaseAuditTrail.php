<?php


abstract class BaseAuditTrail extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $object_name;


	
	protected $object_type_id;


	
	protected $object_id;


	
	protected $partner_id;


	
	protected $uid;


	
	protected $ks_partner_id;


	
	protected $ks_uid;


	
	protected $before;


	
	protected $after;


	
	protected $context;


	
	protected $host_name;


	
	protected $action_id;


	
	protected $created_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getObjectName()
	{

		return $this->object_name;
	}

	
	public function getObjectTypeId()
	{

		return $this->object_type_id;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getUid()
	{

		return $this->uid;
	}

	
	public function getKsPartnerId()
	{

		return $this->ks_partner_id;
	}

	
	public function getKsUid()
	{

		return $this->ks_uid;
	}

	
	public function getBefore()
	{

		return $this->before;
	}

	
	public function getAfter()
	{

		return $this->after;
	}

	
	public function getContext()
	{

		return $this->context;
	}

	
	public function getHostName()
	{

		return $this->host_name;
	}

	
	public function getActionId()
	{

		return $this->action_id;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AuditTrailPeer::ID;
		}

	} 
	
	public function setObjectName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_name !== $v) {
			$this->object_name = $v;
			$this->modifiedColumns[] = AuditTrailPeer::OBJECT_NAME;
		}

	} 
	
	public function setObjectTypeId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_type_id !== $v) {
			$this->object_type_id = $v;
			$this->modifiedColumns[] = AuditTrailPeer::OBJECT_TYPE_ID;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = AuditTrailPeer::OBJECT_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = AuditTrailPeer::PARTNER_ID;
		}

	} 
	
	public function setUid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uid !== $v) {
			$this->uid = $v;
			$this->modifiedColumns[] = AuditTrailPeer::UID;
		}

	} 
	
	public function setKsPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ks_partner_id !== $v) {
			$this->ks_partner_id = $v;
			$this->modifiedColumns[] = AuditTrailPeer::KS_PARTNER_ID;
		}

	} 
	
	public function setKsUid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ks_uid !== $v) {
			$this->ks_uid = $v;
			$this->modifiedColumns[] = AuditTrailPeer::KS_UID;
		}

	} 
	
	public function setBefore($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->before !== $v) {
			$this->before = $v;
			$this->modifiedColumns[] = AuditTrailPeer::BEFORE;
		}

	} 
	
	public function setAfter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->after !== $v) {
			$this->after = $v;
			$this->modifiedColumns[] = AuditTrailPeer::AFTER;
		}

	} 
	
	public function setContext($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->context !== $v) {
			$this->context = $v;
			$this->modifiedColumns[] = AuditTrailPeer::CONTEXT;
		}

	} 
	
	public function setHostName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->host_name !== $v) {
			$this->host_name = $v;
			$this->modifiedColumns[] = AuditTrailPeer::HOST_NAME;
		}

	} 
	
	public function setActionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->action_id !== $v) {
			$this->action_id = $v;
			$this->modifiedColumns[] = AuditTrailPeer::ACTION_ID;
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
			$this->modifiedColumns[] = AuditTrailPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->object_name = $rs->getString($startcol + 1);

			$this->object_type_id = $rs->getString($startcol + 2);

			$this->object_id = $rs->getString($startcol + 3);

			$this->partner_id = $rs->getInt($startcol + 4);

			$this->uid = $rs->getString($startcol + 5);

			$this->ks_partner_id = $rs->getInt($startcol + 6);

			$this->ks_uid = $rs->getString($startcol + 7);

			$this->before = $rs->getString($startcol + 8);

			$this->after = $rs->getString($startcol + 9);

			$this->context = $rs->getString($startcol + 10);

			$this->host_name = $rs->getString($startcol + 11);

			$this->action_id = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AuditTrail object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AuditTrailPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AuditTrailPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(AuditTrailPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AuditTrailPeer::DATABASE_NAME);
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
					$pk = AuditTrailPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AuditTrailPeer::doUpdate($this, $con);
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


			if (($retval = AuditTrailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AuditTrailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getObjectName();
				break;
			case 2:
				return $this->getObjectTypeId();
				break;
			case 3:
				return $this->getObjectId();
				break;
			case 4:
				return $this->getPartnerId();
				break;
			case 5:
				return $this->getUid();
				break;
			case 6:
				return $this->getKsPartnerId();
				break;
			case 7:
				return $this->getKsUid();
				break;
			case 8:
				return $this->getBefore();
				break;
			case 9:
				return $this->getAfter();
				break;
			case 10:
				return $this->getContext();
				break;
			case 11:
				return $this->getHostName();
				break;
			case 12:
				return $this->getActionId();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AuditTrailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getObjectName(),
			$keys[2] => $this->getObjectTypeId(),
			$keys[3] => $this->getObjectId(),
			$keys[4] => $this->getPartnerId(),
			$keys[5] => $this->getUid(),
			$keys[6] => $this->getKsPartnerId(),
			$keys[7] => $this->getKsUid(),
			$keys[8] => $this->getBefore(),
			$keys[9] => $this->getAfter(),
			$keys[10] => $this->getContext(),
			$keys[11] => $this->getHostName(),
			$keys[12] => $this->getActionId(),
			$keys[13] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AuditTrailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setObjectName($value);
				break;
			case 2:
				$this->setObjectTypeId($value);
				break;
			case 3:
				$this->setObjectId($value);
				break;
			case 4:
				$this->setPartnerId($value);
				break;
			case 5:
				$this->setUid($value);
				break;
			case 6:
				$this->setKsPartnerId($value);
				break;
			case 7:
				$this->setKsUid($value);
				break;
			case 8:
				$this->setBefore($value);
				break;
			case 9:
				$this->setAfter($value);
				break;
			case 10:
				$this->setContext($value);
				break;
			case 11:
				$this->setHostName($value);
				break;
			case 12:
				$this->setActionId($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AuditTrailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setObjectName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setObjectTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPartnerId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setKsPartnerId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setKsUid($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBefore($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAfter($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setContext($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setHostName($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setActionId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AuditTrailPeer::DATABASE_NAME);

		if ($this->isColumnModified(AuditTrailPeer::ID)) $criteria->add(AuditTrailPeer::ID, $this->id);
		if ($this->isColumnModified(AuditTrailPeer::OBJECT_NAME)) $criteria->add(AuditTrailPeer::OBJECT_NAME, $this->object_name);
		if ($this->isColumnModified(AuditTrailPeer::OBJECT_TYPE_ID)) $criteria->add(AuditTrailPeer::OBJECT_TYPE_ID, $this->object_type_id);
		if ($this->isColumnModified(AuditTrailPeer::OBJECT_ID)) $criteria->add(AuditTrailPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(AuditTrailPeer::PARTNER_ID)) $criteria->add(AuditTrailPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(AuditTrailPeer::UID)) $criteria->add(AuditTrailPeer::UID, $this->uid);
		if ($this->isColumnModified(AuditTrailPeer::KS_PARTNER_ID)) $criteria->add(AuditTrailPeer::KS_PARTNER_ID, $this->ks_partner_id);
		if ($this->isColumnModified(AuditTrailPeer::KS_UID)) $criteria->add(AuditTrailPeer::KS_UID, $this->ks_uid);
		if ($this->isColumnModified(AuditTrailPeer::BEFORE)) $criteria->add(AuditTrailPeer::BEFORE, $this->before);
		if ($this->isColumnModified(AuditTrailPeer::AFTER)) $criteria->add(AuditTrailPeer::AFTER, $this->after);
		if ($this->isColumnModified(AuditTrailPeer::CONTEXT)) $criteria->add(AuditTrailPeer::CONTEXT, $this->context);
		if ($this->isColumnModified(AuditTrailPeer::HOST_NAME)) $criteria->add(AuditTrailPeer::HOST_NAME, $this->host_name);
		if ($this->isColumnModified(AuditTrailPeer::ACTION_ID)) $criteria->add(AuditTrailPeer::ACTION_ID, $this->action_id);
		if ($this->isColumnModified(AuditTrailPeer::CREATED_AT)) $criteria->add(AuditTrailPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AuditTrailPeer::DATABASE_NAME);

		$criteria->add(AuditTrailPeer::ID, $this->id);

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

		$copyObj->setObjectName($this->object_name);

		$copyObj->setObjectTypeId($this->object_type_id);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setUid($this->uid);

		$copyObj->setKsPartnerId($this->ks_partner_id);

		$copyObj->setKsUid($this->ks_uid);

		$copyObj->setBefore($this->before);

		$copyObj->setAfter($this->after);

		$copyObj->setContext($this->context);

		$copyObj->setHostName($this->host_name);

		$copyObj->setActionId($this->action_id);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new AuditTrailPeer();
		}
		return self::$peer;
	}

} 