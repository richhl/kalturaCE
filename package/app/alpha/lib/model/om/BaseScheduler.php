<?php


abstract class BaseScheduler extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $created_by;


	
	protected $updated_at;


	
	protected $updated_by;


	
	protected $configured_id;


	
	protected $name = '';


	
	protected $description = '';


	
	protected $statuses = '';


	
	protected $last_status;


	
	protected $host = '';

	
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

	
	public function getConfiguredId()
	{

		return $this->configured_id;
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

	
	public function getHost()
	{

		return $this->host;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SchedulerPeer::ID;
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
			$this->modifiedColumns[] = SchedulerPeer::CREATED_AT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = SchedulerPeer::CREATED_BY;
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
			$this->modifiedColumns[] = SchedulerPeer::UPDATED_AT;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = SchedulerPeer::UPDATED_BY;
		}

	} 
	
	public function setConfiguredId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->configured_id !== $v) {
			$this->configured_id = $v;
			$this->modifiedColumns[] = SchedulerPeer::CONFIGURED_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = SchedulerPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = SchedulerPeer::DESCRIPTION;
		}

	} 
	
	public function setStatuses($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->statuses !== $v || $v === '') {
			$this->statuses = $v;
			$this->modifiedColumns[] = SchedulerPeer::STATUSES;
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
			$this->modifiedColumns[] = SchedulerPeer::LAST_STATUS;
		}

	} 
	
	public function setHost($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->host !== $v || $v === '') {
			$this->host = $v;
			$this->modifiedColumns[] = SchedulerPeer::HOST;
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

			$this->configured_id = $rs->getInt($startcol + 5);

			$this->name = $rs->getString($startcol + 6);

			$this->description = $rs->getString($startcol + 7);

			$this->statuses = $rs->getString($startcol + 8);

			$this->last_status = $rs->getTimestamp($startcol + 9, null);

			$this->host = $rs->getString($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Scheduler object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchedulerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SchedulerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SchedulerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulerPeer::DATABASE_NAME);
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
					$pk = SchedulerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SchedulerPeer::doUpdate($this, $con);
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


			if (($retval = SchedulerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getConfiguredId();
				break;
			case 6:
				return $this->getName();
				break;
			case 7:
				return $this->getDescription();
				break;
			case 8:
				return $this->getStatuses();
				break;
			case 9:
				return $this->getLastStatus();
				break;
			case 10:
				return $this->getHost();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getCreatedBy(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getUpdatedBy(),
			$keys[5] => $this->getConfiguredId(),
			$keys[6] => $this->getName(),
			$keys[7] => $this->getDescription(),
			$keys[8] => $this->getStatuses(),
			$keys[9] => $this->getLastStatus(),
			$keys[10] => $this->getHost(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setConfiguredId($value);
				break;
			case 6:
				$this->setName($value);
				break;
			case 7:
				$this->setDescription($value);
				break;
			case 8:
				$this->setStatuses($value);
				break;
			case 9:
				$this->setLastStatus($value);
				break;
			case 10:
				$this->setHost($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedBy($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setConfiguredId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDescription($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStatuses($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLastStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setHost($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SchedulerPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchedulerPeer::ID)) $criteria->add(SchedulerPeer::ID, $this->id);
		if ($this->isColumnModified(SchedulerPeer::CREATED_AT)) $criteria->add(SchedulerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchedulerPeer::CREATED_BY)) $criteria->add(SchedulerPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(SchedulerPeer::UPDATED_AT)) $criteria->add(SchedulerPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SchedulerPeer::UPDATED_BY)) $criteria->add(SchedulerPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(SchedulerPeer::CONFIGURED_ID)) $criteria->add(SchedulerPeer::CONFIGURED_ID, $this->configured_id);
		if ($this->isColumnModified(SchedulerPeer::NAME)) $criteria->add(SchedulerPeer::NAME, $this->name);
		if ($this->isColumnModified(SchedulerPeer::DESCRIPTION)) $criteria->add(SchedulerPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SchedulerPeer::STATUSES)) $criteria->add(SchedulerPeer::STATUSES, $this->statuses);
		if ($this->isColumnModified(SchedulerPeer::LAST_STATUS)) $criteria->add(SchedulerPeer::LAST_STATUS, $this->last_status);
		if ($this->isColumnModified(SchedulerPeer::HOST)) $criteria->add(SchedulerPeer::HOST, $this->host);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SchedulerPeer::DATABASE_NAME);

		$criteria->add(SchedulerPeer::ID, $this->id);

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

		$copyObj->setConfiguredId($this->configured_id);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setStatuses($this->statuses);

		$copyObj->setLastStatus($this->last_status);

		$copyObj->setHost($this->host);


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
			self::$peer = new SchedulerPeer();
		}
		return self::$peer;
	}

} 