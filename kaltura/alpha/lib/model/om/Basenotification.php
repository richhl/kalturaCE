<?php


abstract class Basenotification extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $puser_id;


	
	protected $type;


	
	protected $object_id;


	
	protected $status;


	
	protected $notification_data;


	
	protected $number_of_attempts = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $notification_result;


	
	protected $object_type;


	
	protected $processor_name;


	
	protected $processor_location;


	
	protected $processor_expiration;


	
	protected $execution_attempts;


	
	protected $lock_version;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getPuserId()
	{

		return $this->puser_id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getNotificationData()
	{

		return $this->notification_data;
	}

	
	public function getNumberOfAttempts()
	{

		return $this->number_of_attempts;
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

	
	public function getNotificationResult()
	{

		return $this->notification_result;
	}

	
	public function getObjectType()
	{

		return $this->object_type;
	}

	
	public function getProcessorName()
	{

		return $this->processor_name;
	}

	
	public function getProcessorLocation()
	{

		return $this->processor_location;
	}

	
	public function getProcessorExpiration($format = 'Y-m-d H:i:s')
	{

		if ($this->processor_expiration === null || $this->processor_expiration === '') {
			return null;
		} elseif (!is_int($this->processor_expiration)) {
						$ts = strtotime($this->processor_expiration);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [processor_expiration] as date/time value: " . var_export($this->processor_expiration, true));
			}
		} else {
			$ts = $this->processor_expiration;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getExecutionAttempts()
	{

		return $this->execution_attempts;
	}

	
	public function getLockVersion()
	{

		return $this->lock_version;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = notificationPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = notificationPeer::PARTNER_ID;
		}

	} 
	
	public function setPuserId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->puser_id !== $v) {
			$this->puser_id = $v;
			$this->modifiedColumns[] = notificationPeer::PUSER_ID;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = notificationPeer::TYPE;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = notificationPeer::OBJECT_ID;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = notificationPeer::STATUS;
		}

	} 
	
	public function setNotificationData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notification_data !== $v) {
			$this->notification_data = $v;
			$this->modifiedColumns[] = notificationPeer::NOTIFICATION_DATA;
		}

	} 
	
	public function setNumberOfAttempts($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->number_of_attempts !== $v || $v === 0) {
			$this->number_of_attempts = $v;
			$this->modifiedColumns[] = notificationPeer::NUMBER_OF_ATTEMPTS;
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
			$this->modifiedColumns[] = notificationPeer::CREATED_AT;
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
			$this->modifiedColumns[] = notificationPeer::UPDATED_AT;
		}

	} 
	
	public function setNotificationResult($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notification_result !== $v) {
			$this->notification_result = $v;
			$this->modifiedColumns[] = notificationPeer::NOTIFICATION_RESULT;
		}

	} 
	
	public function setObjectType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_type !== $v) {
			$this->object_type = $v;
			$this->modifiedColumns[] = notificationPeer::OBJECT_TYPE;
		}

	} 
	
	public function setProcessorName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->processor_name !== $v) {
			$this->processor_name = $v;
			$this->modifiedColumns[] = notificationPeer::PROCESSOR_NAME;
		}

	} 
	
	public function setProcessorLocation($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->processor_location !== $v) {
			$this->processor_location = $v;
			$this->modifiedColumns[] = notificationPeer::PROCESSOR_LOCATION;
		}

	} 
	
	public function setProcessorExpiration($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [processor_expiration] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->processor_expiration !== $ts) {
			$this->processor_expiration = $ts;
			$this->modifiedColumns[] = notificationPeer::PROCESSOR_EXPIRATION;
		}

	} 
	
	public function setExecutionAttempts($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->execution_attempts !== $v) {
			$this->execution_attempts = $v;
			$this->modifiedColumns[] = notificationPeer::EXECUTION_ATTEMPTS;
		}

	} 
	
	public function setLockVersion($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->lock_version !== $v) {
			$this->lock_version = $v;
			$this->modifiedColumns[] = notificationPeer::LOCK_VERSION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->puser_id = $rs->getString($startcol + 2);

			$this->type = $rs->getInt($startcol + 3);

			$this->object_id = $rs->getString($startcol + 4);

			$this->status = $rs->getInt($startcol + 5);

			$this->notification_data = $rs->getString($startcol + 6);

			$this->number_of_attempts = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->notification_result = $rs->getString($startcol + 10);

			$this->object_type = $rs->getInt($startcol + 11);

			$this->processor_name = $rs->getString($startcol + 12);

			$this->processor_location = $rs->getString($startcol + 13);

			$this->processor_expiration = $rs->getTimestamp($startcol + 14, null);

			$this->execution_attempts = $rs->getInt($startcol + 15);

			$this->lock_version = $rs->getInt($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating notification object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(notificationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			notificationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(notificationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(notificationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(notificationPeer::DATABASE_NAME);
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
					$pk = notificationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += notificationPeer::doUpdate($this, $con);
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


			if (($retval = notificationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = notificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPartnerId();
				break;
			case 2:
				return $this->getPuserId();
				break;
			case 3:
				return $this->getType();
				break;
			case 4:
				return $this->getObjectId();
				break;
			case 5:
				return $this->getStatus();
				break;
			case 6:
				return $this->getNotificationData();
				break;
			case 7:
				return $this->getNumberOfAttempts();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			case 10:
				return $this->getNotificationResult();
				break;
			case 11:
				return $this->getObjectType();
				break;
			case 12:
				return $this->getProcessorName();
				break;
			case 13:
				return $this->getProcessorLocation();
				break;
			case 14:
				return $this->getProcessorExpiration();
				break;
			case 15:
				return $this->getExecutionAttempts();
				break;
			case 16:
				return $this->getLockVersion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = notificationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getPuserId(),
			$keys[3] => $this->getType(),
			$keys[4] => $this->getObjectId(),
			$keys[5] => $this->getStatus(),
			$keys[6] => $this->getNotificationData(),
			$keys[7] => $this->getNumberOfAttempts(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
			$keys[10] => $this->getNotificationResult(),
			$keys[11] => $this->getObjectType(),
			$keys[12] => $this->getProcessorName(),
			$keys[13] => $this->getProcessorLocation(),
			$keys[14] => $this->getProcessorExpiration(),
			$keys[15] => $this->getExecutionAttempts(),
			$keys[16] => $this->getLockVersion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = notificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPartnerId($value);
				break;
			case 2:
				$this->setPuserId($value);
				break;
			case 3:
				$this->setType($value);
				break;
			case 4:
				$this->setObjectId($value);
				break;
			case 5:
				$this->setStatus($value);
				break;
			case 6:
				$this->setNotificationData($value);
				break;
			case 7:
				$this->setNumberOfAttempts($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
			case 10:
				$this->setNotificationResult($value);
				break;
			case 11:
				$this->setObjectType($value);
				break;
			case 12:
				$this->setProcessorName($value);
				break;
			case 13:
				$this->setProcessorLocation($value);
				break;
			case 14:
				$this->setProcessorExpiration($value);
				break;
			case 15:
				$this->setExecutionAttempts($value);
				break;
			case 16:
				$this->setLockVersion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = notificationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPuserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObjectId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNotificationData($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setNumberOfAttempts($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNotificationResult($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setObjectType($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setProcessorName($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setProcessorLocation($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setProcessorExpiration($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setExecutionAttempts($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLockVersion($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(notificationPeer::DATABASE_NAME);

		if ($this->isColumnModified(notificationPeer::ID)) $criteria->add(notificationPeer::ID, $this->id);
		if ($this->isColumnModified(notificationPeer::PARTNER_ID)) $criteria->add(notificationPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(notificationPeer::PUSER_ID)) $criteria->add(notificationPeer::PUSER_ID, $this->puser_id);
		if ($this->isColumnModified(notificationPeer::TYPE)) $criteria->add(notificationPeer::TYPE, $this->type);
		if ($this->isColumnModified(notificationPeer::OBJECT_ID)) $criteria->add(notificationPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(notificationPeer::STATUS)) $criteria->add(notificationPeer::STATUS, $this->status);
		if ($this->isColumnModified(notificationPeer::NOTIFICATION_DATA)) $criteria->add(notificationPeer::NOTIFICATION_DATA, $this->notification_data);
		if ($this->isColumnModified(notificationPeer::NUMBER_OF_ATTEMPTS)) $criteria->add(notificationPeer::NUMBER_OF_ATTEMPTS, $this->number_of_attempts);
		if ($this->isColumnModified(notificationPeer::CREATED_AT)) $criteria->add(notificationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(notificationPeer::UPDATED_AT)) $criteria->add(notificationPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(notificationPeer::NOTIFICATION_RESULT)) $criteria->add(notificationPeer::NOTIFICATION_RESULT, $this->notification_result);
		if ($this->isColumnModified(notificationPeer::OBJECT_TYPE)) $criteria->add(notificationPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(notificationPeer::PROCESSOR_NAME)) $criteria->add(notificationPeer::PROCESSOR_NAME, $this->processor_name);
		if ($this->isColumnModified(notificationPeer::PROCESSOR_LOCATION)) $criteria->add(notificationPeer::PROCESSOR_LOCATION, $this->processor_location);
		if ($this->isColumnModified(notificationPeer::PROCESSOR_EXPIRATION)) $criteria->add(notificationPeer::PROCESSOR_EXPIRATION, $this->processor_expiration);
		if ($this->isColumnModified(notificationPeer::EXECUTION_ATTEMPTS)) $criteria->add(notificationPeer::EXECUTION_ATTEMPTS, $this->execution_attempts);
		if ($this->isColumnModified(notificationPeer::LOCK_VERSION)) $criteria->add(notificationPeer::LOCK_VERSION, $this->lock_version);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(notificationPeer::DATABASE_NAME);

		$criteria->add(notificationPeer::ID, $this->id);

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

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setPuserId($this->puser_id);

		$copyObj->setType($this->type);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setStatus($this->status);

		$copyObj->setNotificationData($this->notification_data);

		$copyObj->setNumberOfAttempts($this->number_of_attempts);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setNotificationResult($this->notification_result);

		$copyObj->setObjectType($this->object_type);

		$copyObj->setProcessorName($this->processor_name);

		$copyObj->setProcessorLocation($this->processor_location);

		$copyObj->setProcessorExpiration($this->processor_expiration);

		$copyObj->setExecutionAttempts($this->execution_attempts);

		$copyObj->setLockVersion($this->lock_version);


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
			self::$peer = new notificationPeer();
		}
		return self::$peer;
	}

} 