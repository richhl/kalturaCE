<?php


abstract class BaseSchedulerStatus extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $created_by;


	
	protected $updated_at;


	
	protected $updated_by;


	
	protected $scheduler_id;


	
	protected $scheduler_configured_id;


	
	protected $worker_id = 0;


	
	protected $worker_configured_id = 0;


	
	protected $worker_type = 0;


	
	protected $type;


	
	protected $value;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
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

	
	public function getCreatedBy()
	{

		return $this->created_by;
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

	
	public function getUpdatedBy()
	{

		return $this->updated_by;
	}

	
	public function getSchedulerId()
	{

		return $this->scheduler_id;
	}

	
	public function getSchedulerConfiguredId()
	{

		return $this->scheduler_configured_id;
	}

	
	public function getWorkerId()
	{

		return $this->worker_id;
	}

	
	public function getWorkerConfiguredId()
	{

		return $this->worker_configured_id;
	}

	
	public function getWorkerType()
	{

		return $this->worker_type;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getValue()
	{

		return $this->value;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::ID;
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
			$this->modifiedColumns[] = SchedulerStatusPeer::CREATED_AT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::CREATED_BY;
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
			$this->modifiedColumns[] = SchedulerStatusPeer::UPDATED_AT;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::UPDATED_BY;
		}

	} 
	
	public function setSchedulerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_id !== $v) {
			$this->scheduler_id = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::SCHEDULER_ID;
		}

	} 
	
	public function setSchedulerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_configured_id !== $v) {
			$this->scheduler_configured_id = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::SCHEDULER_CONFIGURED_ID;
		}

	} 
	
	public function setWorkerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_id !== $v || $v === 0) {
			$this->worker_id = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::WORKER_ID;
		}

	} 
	
	public function setWorkerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_configured_id !== $v || $v === 0) {
			$this->worker_configured_id = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::WORKER_CONFIGURED_ID;
		}

	} 
	
	public function setWorkerType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_type !== $v || $v === 0) {
			$this->worker_type = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::WORKER_TYPE;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::TYPE;
		}

	} 
	
	public function setValue($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = SchedulerStatusPeer::VALUE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->created_by = $rs->getString($startcol + 2);

			$this->updated_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_by = $rs->getString($startcol + 4);

			$this->scheduler_id = $rs->getInt($startcol + 5);

			$this->scheduler_configured_id = $rs->getInt($startcol + 6);

			$this->worker_id = $rs->getInt($startcol + 7);

			$this->worker_configured_id = $rs->getInt($startcol + 8);

			$this->worker_type = $rs->getInt($startcol + 9);

			$this->type = $rs->getInt($startcol + 10);

			$this->value = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SchedulerStatus object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerStatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchedulerStatusPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SchedulerStatusPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SchedulerStatusPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerStatusPeer::DATABASE_NAME);
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
					$pk = SchedulerStatusPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SchedulerStatusPeer::doUpdate($this, $con);
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


			if (($retval = SchedulerStatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getCreatedBy();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			case 4:
				return $this->getUpdatedBy();
				break;
			case 5:
				return $this->getSchedulerId();
				break;
			case 6:
				return $this->getSchedulerConfiguredId();
				break;
			case 7:
				return $this->getWorkerId();
				break;
			case 8:
				return $this->getWorkerConfiguredId();
				break;
			case 9:
				return $this->getWorkerType();
				break;
			case 10:
				return $this->getType();
				break;
			case 11:
				return $this->getValue();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getCreatedBy(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getUpdatedBy(),
			$keys[5] => $this->getSchedulerId(),
			$keys[6] => $this->getSchedulerConfiguredId(),
			$keys[7] => $this->getWorkerId(),
			$keys[8] => $this->getWorkerConfiguredId(),
			$keys[9] => $this->getWorkerType(),
			$keys[10] => $this->getType(),
			$keys[11] => $this->getValue(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setCreatedBy($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
			case 4:
				$this->setUpdatedBy($value);
				break;
			case 5:
				$this->setSchedulerId($value);
				break;
			case 6:
				$this->setSchedulerConfiguredId($value);
				break;
			case 7:
				$this->setWorkerId($value);
				break;
			case 8:
				$this->setWorkerConfiguredId($value);
				break;
			case 9:
				$this->setWorkerType($value);
				break;
			case 10:
				$this->setType($value);
				break;
			case 11:
				$this->setValue($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedBy($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSchedulerId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchedulerConfiguredId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setWorkerId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setWorkerConfiguredId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setWorkerType($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setType($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setValue($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SchedulerStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchedulerStatusPeer::ID)) $criteria->add(SchedulerStatusPeer::ID, $this->id);
		if ($this->isColumnModified(SchedulerStatusPeer::CREATED_AT)) $criteria->add(SchedulerStatusPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchedulerStatusPeer::CREATED_BY)) $criteria->add(SchedulerStatusPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(SchedulerStatusPeer::UPDATED_AT)) $criteria->add(SchedulerStatusPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SchedulerStatusPeer::UPDATED_BY)) $criteria->add(SchedulerStatusPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(SchedulerStatusPeer::SCHEDULER_ID)) $criteria->add(SchedulerStatusPeer::SCHEDULER_ID, $this->scheduler_id);
		if ($this->isColumnModified(SchedulerStatusPeer::SCHEDULER_CONFIGURED_ID)) $criteria->add(SchedulerStatusPeer::SCHEDULER_CONFIGURED_ID, $this->scheduler_configured_id);
		if ($this->isColumnModified(SchedulerStatusPeer::WORKER_ID)) $criteria->add(SchedulerStatusPeer::WORKER_ID, $this->worker_id);
		if ($this->isColumnModified(SchedulerStatusPeer::WORKER_CONFIGURED_ID)) $criteria->add(SchedulerStatusPeer::WORKER_CONFIGURED_ID, $this->worker_configured_id);
		if ($this->isColumnModified(SchedulerStatusPeer::WORKER_TYPE)) $criteria->add(SchedulerStatusPeer::WORKER_TYPE, $this->worker_type);
		if ($this->isColumnModified(SchedulerStatusPeer::TYPE)) $criteria->add(SchedulerStatusPeer::TYPE, $this->type);
		if ($this->isColumnModified(SchedulerStatusPeer::VALUE)) $criteria->add(SchedulerStatusPeer::VALUE, $this->value);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SchedulerStatusPeer::DATABASE_NAME);

		$criteria->add(SchedulerStatusPeer::ID, $this->id);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setSchedulerId($this->scheduler_id);

		$copyObj->setSchedulerConfiguredId($this->scheduler_configured_id);

		$copyObj->setWorkerId($this->worker_id);

		$copyObj->setWorkerConfiguredId($this->worker_configured_id);

		$copyObj->setWorkerType($this->worker_type);

		$copyObj->setType($this->type);

		$copyObj->setValue($this->value);


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
			self::$peer = new SchedulerStatusPeer();
		}
		return self::$peer;
	}

} 