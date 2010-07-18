<?php


abstract class BaseControlPanelCommand extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $created_by;


	
	protected $updated_at;


	
	protected $updated_by;


	
	protected $created_by_id;


	
	protected $scheduler_id = 0;


	
	protected $scheduler_configured_id;


	
	protected $worker_id = 0;


	
	protected $worker_configured_id = 0;


	
	protected $worker_name = 'null';


	
	protected $batch_index = 0;


	
	protected $type;


	
	protected $target_type;


	
	protected $status;


	
	protected $cause;


	
	protected $description;


	
	protected $error_description;

	
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

	
	public function getCreatedById()
	{

		return $this->created_by_id;
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

	
	public function getWorkerName()
	{

		return $this->worker_name;
	}

	
	public function getBatchIndex()
	{

		return $this->batch_index;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getTargetType()
	{

		return $this->target_type;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getCause()
	{

		return $this->cause;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getErrorDescription()
	{

		return $this->error_description;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::ID;
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
			$this->modifiedColumns[] = ControlPanelCommandPeer::CREATED_AT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::CREATED_BY;
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
			$this->modifiedColumns[] = ControlPanelCommandPeer::UPDATED_AT;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::UPDATED_BY;
		}

	} 
	
	public function setCreatedById($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by_id !== $v) {
			$this->created_by_id = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::CREATED_BY_ID;
		}

	} 
	
	public function setSchedulerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_id !== $v || $v === 0) {
			$this->scheduler_id = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::SCHEDULER_ID;
		}

	} 
	
	public function setSchedulerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_configured_id !== $v) {
			$this->scheduler_configured_id = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::SCHEDULER_CONFIGURED_ID;
		}

	} 
	
	public function setWorkerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_id !== $v || $v === 0) {
			$this->worker_id = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::WORKER_ID;
		}

	} 
	
	public function setWorkerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_configured_id !== $v || $v === 0) {
			$this->worker_configured_id = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::WORKER_CONFIGURED_ID;
		}

	} 
	
	public function setWorkerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->worker_name !== $v || $v === 'null') {
			$this->worker_name = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::WORKER_NAME;
		}

	} 
	
	public function setBatchIndex($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->batch_index !== $v || $v === 0) {
			$this->batch_index = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::BATCH_INDEX;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::TYPE;
		}

	} 
	
	public function setTargetType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->target_type !== $v) {
			$this->target_type = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::TARGET_TYPE;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::STATUS;
		}

	} 
	
	public function setCause($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cause !== $v) {
			$this->cause = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::CAUSE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::DESCRIPTION;
		}

	} 
	
	public function setErrorDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->error_description !== $v) {
			$this->error_description = $v;
			$this->modifiedColumns[] = ControlPanelCommandPeer::ERROR_DESCRIPTION;
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

			$this->created_by_id = $rs->getInt($startcol + 5);

			$this->scheduler_id = $rs->getInt($startcol + 6);

			$this->scheduler_configured_id = $rs->getInt($startcol + 7);

			$this->worker_id = $rs->getInt($startcol + 8);

			$this->worker_configured_id = $rs->getInt($startcol + 9);

			$this->worker_name = $rs->getString($startcol + 10);

			$this->batch_index = $rs->getInt($startcol + 11);

			$this->type = $rs->getInt($startcol + 12);

			$this->target_type = $rs->getInt($startcol + 13);

			$this->status = $rs->getInt($startcol + 14);

			$this->cause = $rs->getString($startcol + 15);

			$this->description = $rs->getString($startcol + 16);

			$this->error_description = $rs->getString($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ControlPanelCommand object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ControlPanelCommandPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ControlPanelCommandPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ControlPanelCommandPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ControlPanelCommandPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ControlPanelCommandPeer::DATABASE_NAME);
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
					$pk = ControlPanelCommandPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ControlPanelCommandPeer::doUpdate($this, $con);
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


			if (($retval = ControlPanelCommandPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ControlPanelCommandPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedById();
				break;
			case 6:
				return $this->getSchedulerId();
				break;
			case 7:
				return $this->getSchedulerConfiguredId();
				break;
			case 8:
				return $this->getWorkerId();
				break;
			case 9:
				return $this->getWorkerConfiguredId();
				break;
			case 10:
				return $this->getWorkerName();
				break;
			case 11:
				return $this->getBatchIndex();
				break;
			case 12:
				return $this->getType();
				break;
			case 13:
				return $this->getTargetType();
				break;
			case 14:
				return $this->getStatus();
				break;
			case 15:
				return $this->getCause();
				break;
			case 16:
				return $this->getDescription();
				break;
			case 17:
				return $this->getErrorDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ControlPanelCommandPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getCreatedBy(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getUpdatedBy(),
			$keys[5] => $this->getCreatedById(),
			$keys[6] => $this->getSchedulerId(),
			$keys[7] => $this->getSchedulerConfiguredId(),
			$keys[8] => $this->getWorkerId(),
			$keys[9] => $this->getWorkerConfiguredId(),
			$keys[10] => $this->getWorkerName(),
			$keys[11] => $this->getBatchIndex(),
			$keys[12] => $this->getType(),
			$keys[13] => $this->getTargetType(),
			$keys[14] => $this->getStatus(),
			$keys[15] => $this->getCause(),
			$keys[16] => $this->getDescription(),
			$keys[17] => $this->getErrorDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ControlPanelCommandPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCreatedById($value);
				break;
			case 6:
				$this->setSchedulerId($value);
				break;
			case 7:
				$this->setSchedulerConfiguredId($value);
				break;
			case 8:
				$this->setWorkerId($value);
				break;
			case 9:
				$this->setWorkerConfiguredId($value);
				break;
			case 10:
				$this->setWorkerName($value);
				break;
			case 11:
				$this->setBatchIndex($value);
				break;
			case 12:
				$this->setType($value);
				break;
			case 13:
				$this->setTargetType($value);
				break;
			case 14:
				$this->setStatus($value);
				break;
			case 15:
				$this->setCause($value);
				break;
			case 16:
				$this->setDescription($value);
				break;
			case 17:
				$this->setErrorDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ControlPanelCommandPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedBy($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedById($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchedulerId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSchedulerConfiguredId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setWorkerId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setWorkerConfiguredId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setWorkerName($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBatchIndex($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setType($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTargetType($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setStatus($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCause($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setDescription($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setErrorDescription($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ControlPanelCommandPeer::DATABASE_NAME);

		if ($this->isColumnModified(ControlPanelCommandPeer::ID)) $criteria->add(ControlPanelCommandPeer::ID, $this->id);
		if ($this->isColumnModified(ControlPanelCommandPeer::CREATED_AT)) $criteria->add(ControlPanelCommandPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ControlPanelCommandPeer::CREATED_BY)) $criteria->add(ControlPanelCommandPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(ControlPanelCommandPeer::UPDATED_AT)) $criteria->add(ControlPanelCommandPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ControlPanelCommandPeer::UPDATED_BY)) $criteria->add(ControlPanelCommandPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(ControlPanelCommandPeer::CREATED_BY_ID)) $criteria->add(ControlPanelCommandPeer::CREATED_BY_ID, $this->created_by_id);
		if ($this->isColumnModified(ControlPanelCommandPeer::SCHEDULER_ID)) $criteria->add(ControlPanelCommandPeer::SCHEDULER_ID, $this->scheduler_id);
		if ($this->isColumnModified(ControlPanelCommandPeer::SCHEDULER_CONFIGURED_ID)) $criteria->add(ControlPanelCommandPeer::SCHEDULER_CONFIGURED_ID, $this->scheduler_configured_id);
		if ($this->isColumnModified(ControlPanelCommandPeer::WORKER_ID)) $criteria->add(ControlPanelCommandPeer::WORKER_ID, $this->worker_id);
		if ($this->isColumnModified(ControlPanelCommandPeer::WORKER_CONFIGURED_ID)) $criteria->add(ControlPanelCommandPeer::WORKER_CONFIGURED_ID, $this->worker_configured_id);
		if ($this->isColumnModified(ControlPanelCommandPeer::WORKER_NAME)) $criteria->add(ControlPanelCommandPeer::WORKER_NAME, $this->worker_name);
		if ($this->isColumnModified(ControlPanelCommandPeer::BATCH_INDEX)) $criteria->add(ControlPanelCommandPeer::BATCH_INDEX, $this->batch_index);
		if ($this->isColumnModified(ControlPanelCommandPeer::TYPE)) $criteria->add(ControlPanelCommandPeer::TYPE, $this->type);
		if ($this->isColumnModified(ControlPanelCommandPeer::TARGET_TYPE)) $criteria->add(ControlPanelCommandPeer::TARGET_TYPE, $this->target_type);
		if ($this->isColumnModified(ControlPanelCommandPeer::STATUS)) $criteria->add(ControlPanelCommandPeer::STATUS, $this->status);
		if ($this->isColumnModified(ControlPanelCommandPeer::CAUSE)) $criteria->add(ControlPanelCommandPeer::CAUSE, $this->cause);
		if ($this->isColumnModified(ControlPanelCommandPeer::DESCRIPTION)) $criteria->add(ControlPanelCommandPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ControlPanelCommandPeer::ERROR_DESCRIPTION)) $criteria->add(ControlPanelCommandPeer::ERROR_DESCRIPTION, $this->error_description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ControlPanelCommandPeer::DATABASE_NAME);

		$criteria->add(ControlPanelCommandPeer::ID, $this->id);

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

		$copyObj->setCreatedById($this->created_by_id);

		$copyObj->setSchedulerId($this->scheduler_id);

		$copyObj->setSchedulerConfiguredId($this->scheduler_configured_id);

		$copyObj->setWorkerId($this->worker_id);

		$copyObj->setWorkerConfiguredId($this->worker_configured_id);

		$copyObj->setWorkerName($this->worker_name);

		$copyObj->setBatchIndex($this->batch_index);

		$copyObj->setType($this->type);

		$copyObj->setTargetType($this->target_type);

		$copyObj->setStatus($this->status);

		$copyObj->setCause($this->cause);

		$copyObj->setDescription($this->description);

		$copyObj->setErrorDescription($this->error_description);


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
			self::$peer = new ControlPanelCommandPeer();
		}
		return self::$peer;
	}

} 