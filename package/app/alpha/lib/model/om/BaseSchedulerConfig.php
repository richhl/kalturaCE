<?php


abstract class BaseSchedulerConfig extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $created_by;


	
	protected $updated_at;


	
	protected $updated_by;


	
	protected $command_id = 0;


	
	protected $command_status;


	
	protected $scheduler_id;


	
	protected $scheduler_configured_id;


	
	protected $scheduler_name;


	
	protected $worker_id = 0;


	
	protected $worker_configured_id = 0;


	
	protected $worker_name = 'null';


	
	protected $variable;


	
	protected $variable_part;


	
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

	
	public function getCommandId()
	{

		return $this->command_id;
	}

	
	public function getCommandStatus()
	{

		return $this->command_status;
	}

	
	public function getSchedulerId()
	{

		return $this->scheduler_id;
	}

	
	public function getSchedulerConfiguredId()
	{

		return $this->scheduler_configured_id;
	}

	
	public function getSchedulerName()
	{

		return $this->scheduler_name;
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

	
	public function getVariable()
	{

		return $this->variable;
	}

	
	public function getVariablePart()
	{

		return $this->variable_part;
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
			$this->modifiedColumns[] = SchedulerConfigPeer::ID;
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
			$this->modifiedColumns[] = SchedulerConfigPeer::CREATED_AT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::CREATED_BY;
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
			$this->modifiedColumns[] = SchedulerConfigPeer::UPDATED_AT;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::UPDATED_BY;
		}

	} 
	
	public function setCommandId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->command_id !== $v || $v === 0) {
			$this->command_id = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::COMMAND_ID;
		}

	} 
	
	public function setCommandStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->command_status !== $v) {
			$this->command_status = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::COMMAND_STATUS;
		}

	} 
	
	public function setSchedulerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_id !== $v) {
			$this->scheduler_id = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::SCHEDULER_ID;
		}

	} 
	
	public function setSchedulerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_configured_id !== $v) {
			$this->scheduler_configured_id = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::SCHEDULER_CONFIGURED_ID;
		}

	} 
	
	public function setSchedulerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->scheduler_name !== $v) {
			$this->scheduler_name = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::SCHEDULER_NAME;
		}

	} 
	
	public function setWorkerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_id !== $v || $v === 0) {
			$this->worker_id = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::WORKER_ID;
		}

	} 
	
	public function setWorkerConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_configured_id !== $v || $v === 0) {
			$this->worker_configured_id = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::WORKER_CONFIGURED_ID;
		}

	} 
	
	public function setWorkerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->worker_name !== $v || $v === 'null') {
			$this->worker_name = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::WORKER_NAME;
		}

	} 
	
	public function setVariable($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->variable !== $v) {
			$this->variable = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::VARIABLE;
		}

	} 
	
	public function setVariablePart($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->variable_part !== $v) {
			$this->variable_part = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::VARIABLE_PART;
		}

	} 
	
	public function setValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = SchedulerConfigPeer::VALUE;
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

			$this->command_id = $rs->getInt($startcol + 5);

			$this->command_status = $rs->getInt($startcol + 6);

			$this->scheduler_id = $rs->getInt($startcol + 7);

			$this->scheduler_configured_id = $rs->getInt($startcol + 8);

			$this->scheduler_name = $rs->getString($startcol + 9);

			$this->worker_id = $rs->getInt($startcol + 10);

			$this->worker_configured_id = $rs->getInt($startcol + 11);

			$this->worker_name = $rs->getString($startcol + 12);

			$this->variable = $rs->getString($startcol + 13);

			$this->variable_part = $rs->getString($startcol + 14);

			$this->value = $rs->getString($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SchedulerConfig object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerConfigPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchedulerConfigPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SchedulerConfigPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SchedulerConfigPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerConfigPeer::DATABASE_NAME);
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
					$pk = SchedulerConfigPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SchedulerConfigPeer::doUpdate($this, $con);
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


			if (($retval = SchedulerConfigPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerConfigPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCommandId();
				break;
			case 6:
				return $this->getCommandStatus();
				break;
			case 7:
				return $this->getSchedulerId();
				break;
			case 8:
				return $this->getSchedulerConfiguredId();
				break;
			case 9:
				return $this->getSchedulerName();
				break;
			case 10:
				return $this->getWorkerId();
				break;
			case 11:
				return $this->getWorkerConfiguredId();
				break;
			case 12:
				return $this->getWorkerName();
				break;
			case 13:
				return $this->getVariable();
				break;
			case 14:
				return $this->getVariablePart();
				break;
			case 15:
				return $this->getValue();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerConfigPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getCreatedBy(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getUpdatedBy(),
			$keys[5] => $this->getCommandId(),
			$keys[6] => $this->getCommandStatus(),
			$keys[7] => $this->getSchedulerId(),
			$keys[8] => $this->getSchedulerConfiguredId(),
			$keys[9] => $this->getSchedulerName(),
			$keys[10] => $this->getWorkerId(),
			$keys[11] => $this->getWorkerConfiguredId(),
			$keys[12] => $this->getWorkerName(),
			$keys[13] => $this->getVariable(),
			$keys[14] => $this->getVariablePart(),
			$keys[15] => $this->getValue(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerConfigPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCommandId($value);
				break;
			case 6:
				$this->setCommandStatus($value);
				break;
			case 7:
				$this->setSchedulerId($value);
				break;
			case 8:
				$this->setSchedulerConfiguredId($value);
				break;
			case 9:
				$this->setSchedulerName($value);
				break;
			case 10:
				$this->setWorkerId($value);
				break;
			case 11:
				$this->setWorkerConfiguredId($value);
				break;
			case 12:
				$this->setWorkerName($value);
				break;
			case 13:
				$this->setVariable($value);
				break;
			case 14:
				$this->setVariablePart($value);
				break;
			case 15:
				$this->setValue($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerConfigPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedBy($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCommandId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCommandStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSchedulerId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSchedulerConfiguredId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSchedulerName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setWorkerId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setWorkerConfiguredId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setWorkerName($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setVariable($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setVariablePart($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setValue($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SchedulerConfigPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchedulerConfigPeer::ID)) $criteria->add(SchedulerConfigPeer::ID, $this->id);
		if ($this->isColumnModified(SchedulerConfigPeer::CREATED_AT)) $criteria->add(SchedulerConfigPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchedulerConfigPeer::CREATED_BY)) $criteria->add(SchedulerConfigPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(SchedulerConfigPeer::UPDATED_AT)) $criteria->add(SchedulerConfigPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SchedulerConfigPeer::UPDATED_BY)) $criteria->add(SchedulerConfigPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(SchedulerConfigPeer::COMMAND_ID)) $criteria->add(SchedulerConfigPeer::COMMAND_ID, $this->command_id);
		if ($this->isColumnModified(SchedulerConfigPeer::COMMAND_STATUS)) $criteria->add(SchedulerConfigPeer::COMMAND_STATUS, $this->command_status);
		if ($this->isColumnModified(SchedulerConfigPeer::SCHEDULER_ID)) $criteria->add(SchedulerConfigPeer::SCHEDULER_ID, $this->scheduler_id);
		if ($this->isColumnModified(SchedulerConfigPeer::SCHEDULER_CONFIGURED_ID)) $criteria->add(SchedulerConfigPeer::SCHEDULER_CONFIGURED_ID, $this->scheduler_configured_id);
		if ($this->isColumnModified(SchedulerConfigPeer::SCHEDULER_NAME)) $criteria->add(SchedulerConfigPeer::SCHEDULER_NAME, $this->scheduler_name);
		if ($this->isColumnModified(SchedulerConfigPeer::WORKER_ID)) $criteria->add(SchedulerConfigPeer::WORKER_ID, $this->worker_id);
		if ($this->isColumnModified(SchedulerConfigPeer::WORKER_CONFIGURED_ID)) $criteria->add(SchedulerConfigPeer::WORKER_CONFIGURED_ID, $this->worker_configured_id);
		if ($this->isColumnModified(SchedulerConfigPeer::WORKER_NAME)) $criteria->add(SchedulerConfigPeer::WORKER_NAME, $this->worker_name);
		if ($this->isColumnModified(SchedulerConfigPeer::VARIABLE)) $criteria->add(SchedulerConfigPeer::VARIABLE, $this->variable);
		if ($this->isColumnModified(SchedulerConfigPeer::VARIABLE_PART)) $criteria->add(SchedulerConfigPeer::VARIABLE_PART, $this->variable_part);
		if ($this->isColumnModified(SchedulerConfigPeer::VALUE)) $criteria->add(SchedulerConfigPeer::VALUE, $this->value);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SchedulerConfigPeer::DATABASE_NAME);

		$criteria->add(SchedulerConfigPeer::ID, $this->id);

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

		$copyObj->setCommandId($this->command_id);

		$copyObj->setCommandStatus($this->command_status);

		$copyObj->setSchedulerId($this->scheduler_id);

		$copyObj->setSchedulerConfiguredId($this->scheduler_configured_id);

		$copyObj->setSchedulerName($this->scheduler_name);

		$copyObj->setWorkerId($this->worker_id);

		$copyObj->setWorkerConfiguredId($this->worker_configured_id);

		$copyObj->setWorkerName($this->worker_name);

		$copyObj->setVariable($this->variable);

		$copyObj->setVariablePart($this->variable_part);

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
			self::$peer = new SchedulerConfigPeer();
		}
		return self::$peer;
	}

} 