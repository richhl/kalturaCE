<?php


abstract class BaseBatchJob extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $job_type;


	
	protected $job_sub_type;


	
	protected $data;


	
	protected $status;


	
	protected $abort;


	
	protected $check_again_timeout;


	
	protected $progress;


	
	protected $message;


	
	protected $description;


	
	protected $updates_count;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $entry_id = '';


	
	protected $partner_id = 0;


	
	protected $subp_id = 0;


	
	protected $processor_name;


	
	protected $processor_expiration;


	
	protected $parent_job_id;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getJobType()
	{

		return $this->job_type;
	}

	
	public function getJobSubType()
	{

		return $this->job_sub_type;
	}

	
	public function getData()
	{

		return $this->data;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getAbort()
	{

		return $this->abort;
	}

	
	public function getCheckAgainTimeout()
	{

		return $this->check_again_timeout;
	}

	
	public function getProgress()
	{

		return $this->progress;
	}

	
	public function getMessage()
	{

		return $this->message;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getUpdatesCount()
	{

		return $this->updates_count;
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

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function getProcessorName()
	{

		return $this->processor_name;
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

	
	public function getParentJobId()
	{

		return $this->parent_job_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BatchJobPeer::ID;
		}

	} 
	
	public function setJobType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->job_type !== $v) {
			$this->job_type = $v;
			$this->modifiedColumns[] = BatchJobPeer::JOB_TYPE;
		}

	} 
	
	public function setJobSubType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->job_sub_type !== $v) {
			$this->job_sub_type = $v;
			$this->modifiedColumns[] = BatchJobPeer::JOB_SUB_TYPE;
		}

	} 
	
	public function setData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = BatchJobPeer::DATA;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = BatchJobPeer::STATUS;
		}

	} 
	
	public function setAbort($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->abort !== $v) {
			$this->abort = $v;
			$this->modifiedColumns[] = BatchJobPeer::ABORT;
		}

	} 
	
	public function setCheckAgainTimeout($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->check_again_timeout !== $v) {
			$this->check_again_timeout = $v;
			$this->modifiedColumns[] = BatchJobPeer::CHECK_AGAIN_TIMEOUT;
		}

	} 
	
	public function setProgress($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->progress !== $v) {
			$this->progress = $v;
			$this->modifiedColumns[] = BatchJobPeer::PROGRESS;
		}

	} 
	
	public function setMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = BatchJobPeer::MESSAGE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = BatchJobPeer::DESCRIPTION;
		}

	} 
	
	public function setUpdatesCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updates_count !== $v) {
			$this->updates_count = $v;
			$this->modifiedColumns[] = BatchJobPeer::UPDATES_COUNT;
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
			$this->modifiedColumns[] = BatchJobPeer::CREATED_AT;
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
			$this->modifiedColumns[] = BatchJobPeer::UPDATED_AT;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v || $v === '') {
			$this->entry_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::ENTRY_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::SUBP_ID;
		}

	} 
	
	public function setProcessorName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->processor_name !== $v) {
			$this->processor_name = $v;
			$this->modifiedColumns[] = BatchJobPeer::PROCESSOR_NAME;
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
			$this->modifiedColumns[] = BatchJobPeer::PROCESSOR_EXPIRATION;
		}

	} 
	
	public function setParentJobId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_job_id !== $v) {
			$this->parent_job_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::PARENT_JOB_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->job_type = $rs->getInt($startcol + 1);

			$this->job_sub_type = $rs->getInt($startcol + 2);

			$this->data = $rs->getString($startcol + 3);

			$this->status = $rs->getInt($startcol + 4);

			$this->abort = $rs->getInt($startcol + 5);

			$this->check_again_timeout = $rs->getInt($startcol + 6);

			$this->progress = $rs->getInt($startcol + 7);

			$this->message = $rs->getString($startcol + 8);

			$this->description = $rs->getString($startcol + 9);

			$this->updates_count = $rs->getInt($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->entry_id = $rs->getString($startcol + 13);

			$this->partner_id = $rs->getInt($startcol + 14);

			$this->subp_id = $rs->getInt($startcol + 15);

			$this->processor_name = $rs->getString($startcol + 16);

			$this->processor_expiration = $rs->getTimestamp($startcol + 17, null);

			$this->parent_job_id = $rs->getInt($startcol + 18);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating BatchJob object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BatchJobPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BatchJobPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(BatchJobPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BatchJobPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BatchJobPeer::DATABASE_NAME);
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
					$pk = BatchJobPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BatchJobPeer::doUpdate($this, $con);
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


			if (($retval = BatchJobPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BatchJobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getJobType();
				break;
			case 2:
				return $this->getJobSubType();
				break;
			case 3:
				return $this->getData();
				break;
			case 4:
				return $this->getStatus();
				break;
			case 5:
				return $this->getAbort();
				break;
			case 6:
				return $this->getCheckAgainTimeout();
				break;
			case 7:
				return $this->getProgress();
				break;
			case 8:
				return $this->getMessage();
				break;
			case 9:
				return $this->getDescription();
				break;
			case 10:
				return $this->getUpdatesCount();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			case 13:
				return $this->getEntryId();
				break;
			case 14:
				return $this->getPartnerId();
				break;
			case 15:
				return $this->getSubpId();
				break;
			case 16:
				return $this->getProcessorName();
				break;
			case 17:
				return $this->getProcessorExpiration();
				break;
			case 18:
				return $this->getParentJobId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BatchJobPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getJobType(),
			$keys[2] => $this->getJobSubType(),
			$keys[3] => $this->getData(),
			$keys[4] => $this->getStatus(),
			$keys[5] => $this->getAbort(),
			$keys[6] => $this->getCheckAgainTimeout(),
			$keys[7] => $this->getProgress(),
			$keys[8] => $this->getMessage(),
			$keys[9] => $this->getDescription(),
			$keys[10] => $this->getUpdatesCount(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
			$keys[13] => $this->getEntryId(),
			$keys[14] => $this->getPartnerId(),
			$keys[15] => $this->getSubpId(),
			$keys[16] => $this->getProcessorName(),
			$keys[17] => $this->getProcessorExpiration(),
			$keys[18] => $this->getParentJobId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BatchJobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setJobType($value);
				break;
			case 2:
				$this->setJobSubType($value);
				break;
			case 3:
				$this->setData($value);
				break;
			case 4:
				$this->setStatus($value);
				break;
			case 5:
				$this->setAbort($value);
				break;
			case 6:
				$this->setCheckAgainTimeout($value);
				break;
			case 7:
				$this->setProgress($value);
				break;
			case 8:
				$this->setMessage($value);
				break;
			case 9:
				$this->setDescription($value);
				break;
			case 10:
				$this->setUpdatesCount($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
			case 13:
				$this->setEntryId($value);
				break;
			case 14:
				$this->setPartnerId($value);
				break;
			case 15:
				$this->setSubpId($value);
				break;
			case 16:
				$this->setProcessorName($value);
				break;
			case 17:
				$this->setProcessorExpiration($value);
				break;
			case 18:
				$this->setParentJobId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BatchJobPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setJobType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setJobSubType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setData($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAbort($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCheckAgainTimeout($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setProgress($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMessage($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDescription($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatesCount($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEntryId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPartnerId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setSubpId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setProcessorName($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setProcessorExpiration($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setParentJobId($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BatchJobPeer::DATABASE_NAME);

		if ($this->isColumnModified(BatchJobPeer::ID)) $criteria->add(BatchJobPeer::ID, $this->id);
		if ($this->isColumnModified(BatchJobPeer::JOB_TYPE)) $criteria->add(BatchJobPeer::JOB_TYPE, $this->job_type);
		if ($this->isColumnModified(BatchJobPeer::JOB_SUB_TYPE)) $criteria->add(BatchJobPeer::JOB_SUB_TYPE, $this->job_sub_type);
		if ($this->isColumnModified(BatchJobPeer::DATA)) $criteria->add(BatchJobPeer::DATA, $this->data);
		if ($this->isColumnModified(BatchJobPeer::STATUS)) $criteria->add(BatchJobPeer::STATUS, $this->status);
		if ($this->isColumnModified(BatchJobPeer::ABORT)) $criteria->add(BatchJobPeer::ABORT, $this->abort);
		if ($this->isColumnModified(BatchJobPeer::CHECK_AGAIN_TIMEOUT)) $criteria->add(BatchJobPeer::CHECK_AGAIN_TIMEOUT, $this->check_again_timeout);
		if ($this->isColumnModified(BatchJobPeer::PROGRESS)) $criteria->add(BatchJobPeer::PROGRESS, $this->progress);
		if ($this->isColumnModified(BatchJobPeer::MESSAGE)) $criteria->add(BatchJobPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(BatchJobPeer::DESCRIPTION)) $criteria->add(BatchJobPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(BatchJobPeer::UPDATES_COUNT)) $criteria->add(BatchJobPeer::UPDATES_COUNT, $this->updates_count);
		if ($this->isColumnModified(BatchJobPeer::CREATED_AT)) $criteria->add(BatchJobPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BatchJobPeer::UPDATED_AT)) $criteria->add(BatchJobPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(BatchJobPeer::ENTRY_ID)) $criteria->add(BatchJobPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(BatchJobPeer::PARTNER_ID)) $criteria->add(BatchJobPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(BatchJobPeer::SUBP_ID)) $criteria->add(BatchJobPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(BatchJobPeer::PROCESSOR_NAME)) $criteria->add(BatchJobPeer::PROCESSOR_NAME, $this->processor_name);
		if ($this->isColumnModified(BatchJobPeer::PROCESSOR_EXPIRATION)) $criteria->add(BatchJobPeer::PROCESSOR_EXPIRATION, $this->processor_expiration);
		if ($this->isColumnModified(BatchJobPeer::PARENT_JOB_ID)) $criteria->add(BatchJobPeer::PARENT_JOB_ID, $this->parent_job_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BatchJobPeer::DATABASE_NAME);

		$criteria->add(BatchJobPeer::ID, $this->id);

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

		$copyObj->setJobType($this->job_type);

		$copyObj->setJobSubType($this->job_sub_type);

		$copyObj->setData($this->data);

		$copyObj->setStatus($this->status);

		$copyObj->setAbort($this->abort);

		$copyObj->setCheckAgainTimeout($this->check_again_timeout);

		$copyObj->setProgress($this->progress);

		$copyObj->setMessage($this->message);

		$copyObj->setDescription($this->description);

		$copyObj->setUpdatesCount($this->updates_count);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setProcessorName($this->processor_name);

		$copyObj->setProcessorExpiration($this->processor_expiration);

		$copyObj->setParentJobId($this->parent_job_id);


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
			self::$peer = new BatchJobPeer();
		}
		return self::$peer;
	}

} 