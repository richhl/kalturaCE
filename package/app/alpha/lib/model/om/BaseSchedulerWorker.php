<?php


abstract class BaseSchedulerWorker extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $created_by;


	
	protected $updated_at;


	
	protected $updated_by;


	
	protected $scheduler_id;


	
	protected $scheduler_configured_id;


	
	protected $configured_id;


	
	protected $type;


	
	protected $name = '';


	
	protected $description = '';


	
	protected $statuses = '';


	
	protected $last_status;

	
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

	
	public function getConfiguredId()
	{

		return $this->configured_id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getStatuses()
	{

		return $this->statuses;
	}

	
	public function getLastStatus($format = 'Y-m-d H:i:s')
	{

		if ($this->last_status === null || $this->last_status === '') {
			return null;
		} elseif (!is_int($this->last_status)) {
						$ts = strtotime($this->last_status);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_status] as date/time value: " . var_export($this->last_status, true));
			}
		} else {
			$ts = $this->last_status;
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
			$this->modifiedColumns[] = SchedulerWorkerPeer::ID;
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
			$this->modifiedColumns[] = SchedulerWorkerPeer::CREATED_AT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::CREATED_BY;
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
			$this->modifiedColumns[] = SchedulerWorkerPeer::UPDATED_AT;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::UPDATED_BY;
		}

	} 
	
	public function setSchedulerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_id !== $v) {
			$this->scheduler_id = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::SCHEDULER_ID;
		}

	} 
	
	public function setSchedulerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_configured_id !== $v) {
			$this->scheduler_configured_id = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::SCHEDULER_CONFIGURED_ID;
		}

	} 
	
	public function setConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->configured_id !== $v) {
			$this->configured_id = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::CONFIGURED_ID;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::TYPE;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::DESCRIPTION;
		}

	} 
	
	public function setStatuses($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->statuses !== $v || $v === '') {
			$this->statuses = $v;
			$this->modifiedColumns[] = SchedulerWorkerPeer::STATUSES;
		}

	} 
	
	public function setLastStatus($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_status] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_status !== $ts) {
			$this->last_status = $ts;
			$this->modifiedColumns[] = SchedulerWorkerPeer::LAST_STATUS;
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

			$this->configured_id = $rs->getInt($startcol + 7);

			$this->type = $rs->getInt($startcol + 8);

			$this->name = $rs->getString($startcol + 9);

			$this->description = $rs->getString($startcol + 10);

			$this->statuses = $rs->getString($startcol + 11);

			$this->last_status = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SchedulerWorker object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerWorkerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchedulerWorkerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SchedulerWorkerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SchedulerWorkerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerWorkerPeer::DATABASE_NAME);
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
					$pk = SchedulerWorkerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SchedulerWorkerPeer::doUpdate($this, $con);
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


			if (($retval = SchedulerWorkerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerWorkerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getConfiguredId();
				break;
			case 8:
				return $this->getType();
				break;
			case 9:
				return $this->getName();
				break;
			case 10:
				return $this->getDescription();
				break;
			case 11:
				return $this->getStatuses();
				break;
			case 12:
				return $this->getLastStatus();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerWorkerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getCreatedBy(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getUpdatedBy(),
			$keys[5] => $this->getSchedulerId(),
			$keys[6] => $this->getSchedulerConfiguredId(),
			$keys[7] => $this->getConfiguredId(),
			$keys[8] => $this->getType(),
			$keys[9] => $this->getName(),
			$keys[10] => $this->getDescription(),
			$keys[11] => $this->getStatuses(),
			$keys[12] => $this->getLastStatus(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerWorkerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setConfiguredId($value);
				break;
			case 8:
				$this->setType($value);
				break;
			case 9:
				$this->setName($value);
				break;
			case 10:
				$this->setDescription($value);
				break;
			case 11:
				$this->setStatuses($value);
				break;
			case 12:
				$this->setLastStatus($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerWorkerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedBy($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSchedulerId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchedulerConfiguredId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setConfiguredId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setType($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStatuses($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLastStatus($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SchedulerWorkerPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchedulerWorkerPeer::ID)) $criteria->add(SchedulerWorkerPeer::ID, $this->id);
		if ($this->isColumnModified(SchedulerWorkerPeer::CREATED_AT)) $criteria->add(SchedulerWorkerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchedulerWorkerPeer::CREATED_BY)) $criteria->add(SchedulerWorkerPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(SchedulerWorkerPeer::UPDATED_AT)) $criteria->add(SchedulerWorkerPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SchedulerWorkerPeer::UPDATED_BY)) $criteria->add(SchedulerWorkerPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(SchedulerWorkerPeer::SCHEDULER_ID)) $criteria->add(SchedulerWorkerPeer::SCHEDULER_ID, $this->scheduler_id);
		if ($this->isColumnModified(SchedulerWorkerPeer::SCHEDULER_CONFIGURED_ID)) $criteria->add(SchedulerWorkerPeer::SCHEDULER_CONFIGURED_ID, $this->scheduler_configured_id);
		if ($this->isColumnModified(SchedulerWorkerPeer::CONFIGURED_ID)) $criteria->add(SchedulerWorkerPeer::CONFIGURED_ID, $this->configured_id);
		if ($this->isColumnModified(SchedulerWorkerPeer::TYPE)) $criteria->add(SchedulerWorkerPeer::TYPE, $this->type);
		if ($this->isColumnModified(SchedulerWorkerPeer::NAME)) $criteria->add(SchedulerWorkerPeer::NAME, $this->name);
		if ($this->isColumnModified(SchedulerWorkerPeer::DESCRIPTION)) $criteria->add(SchedulerWorkerPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SchedulerWorkerPeer::STATUSES)) $criteria->add(SchedulerWorkerPeer::STATUSES, $this->statuses);
		if ($this->isColumnModified(SchedulerWorkerPeer::LAST_STATUS)) $criteria->add(SchedulerWorkerPeer::LAST_STATUS, $this->last_status);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SchedulerWorkerPeer::DATABASE_NAME);

		$criteria->add(SchedulerWorkerPeer::ID, $this->id);

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

		$copyObj->setConfiguredId($this->configured_id);

		$copyObj->setType($this->type);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setStatuses($this->statuses);

		$copyObj->setLastStatus($this->last_status);


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
			self::$peer = new SchedulerWorkerPeer();
		}
		return self::$peer;
	}

} 