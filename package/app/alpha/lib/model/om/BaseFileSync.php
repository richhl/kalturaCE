<?php


abstract class BaseFileSync extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $object_type;


	
	protected $object_id;


	
	protected $version;


	
	protected $object_sub_type;


	
	protected $dc;


	
	protected $original;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $ready_at;


	
	protected $sync_time;


	
	protected $status;


	
	protected $file_type;


	
	protected $linked_id;


	
	protected $link_count;


	
	protected $file_root;


	
	protected $file_path;


	
	protected $file_size;

	
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

	
	public function getObjectType()
	{

		return $this->object_type;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getVersion()
	{

		return $this->version;
	}

	
	public function getObjectSubType()
	{

		return $this->object_sub_type;
	}

	
	public function getDc()
	{

		return $this->dc;
	}

	
	public function getOriginal()
	{

		return $this->original;
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

	
	public function getReadyAt($format = 'Y-m-d H:i:s')
	{

		if ($this->ready_at === null || $this->ready_at === '') {
			return null;
		} elseif (!is_int($this->ready_at)) {
						$ts = strtotime($this->ready_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ready_at] as date/time value: " . var_export($this->ready_at, true));
			}
		} else {
			$ts = $this->ready_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getSyncTime()
	{

		return $this->sync_time;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getFileType()
	{

		return $this->file_type;
	}

	
	public function getLinkedId()
	{

		return $this->linked_id;
	}

	
	public function getLinkCount()
	{

		return $this->link_count;
	}

	
	public function getFileRoot()
	{

		return $this->file_root;
	}

	
	public function getFilePath()
	{

		return $this->file_path;
	}

	
	public function getFileSize()
	{

		return $this->file_size;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FileSyncPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = FileSyncPeer::PARTNER_ID;
		}

	} 
	
	public function setObjectType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_type !== $v) {
			$this->object_type = $v;
			$this->modifiedColumns[] = FileSyncPeer::OBJECT_TYPE;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = FileSyncPeer::OBJECT_ID;
		}

	} 
	
	public function setVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = FileSyncPeer::VERSION;
		}

	} 
	
	public function setObjectSubType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_sub_type !== $v) {
			$this->object_sub_type = $v;
			$this->modifiedColumns[] = FileSyncPeer::OBJECT_SUB_TYPE;
		}

	} 
	
	public function setDc($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dc !== $v) {
			$this->dc = $v;
			$this->modifiedColumns[] = FileSyncPeer::DC;
		}

	} 
	
	public function setOriginal($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->original !== $v) {
			$this->original = $v;
			$this->modifiedColumns[] = FileSyncPeer::ORIGINAL;
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
			$this->modifiedColumns[] = FileSyncPeer::CREATED_AT;
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
			$this->modifiedColumns[] = FileSyncPeer::UPDATED_AT;
		}

	} 
	
	public function setReadyAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ready_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ready_at !== $ts) {
			$this->ready_at = $ts;
			$this->modifiedColumns[] = FileSyncPeer::READY_AT;
		}

	} 
	
	public function setSyncTime($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sync_time !== $v) {
			$this->sync_time = $v;
			$this->modifiedColumns[] = FileSyncPeer::SYNC_TIME;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = FileSyncPeer::STATUS;
		}

	} 
	
	public function setFileType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_type !== $v) {
			$this->file_type = $v;
			$this->modifiedColumns[] = FileSyncPeer::FILE_TYPE;
		}

	} 
	
	public function setLinkedId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->linked_id !== $v) {
			$this->linked_id = $v;
			$this->modifiedColumns[] = FileSyncPeer::LINKED_ID;
		}

	} 
	
	public function setLinkCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->link_count !== $v) {
			$this->link_count = $v;
			$this->modifiedColumns[] = FileSyncPeer::LINK_COUNT;
		}

	} 
	
	public function setFileRoot($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_root !== $v) {
			$this->file_root = $v;
			$this->modifiedColumns[] = FileSyncPeer::FILE_ROOT;
		}

	} 
	
	public function setFilePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_path !== $v) {
			$this->file_path = $v;
			$this->modifiedColumns[] = FileSyncPeer::FILE_PATH;
		}

	} 
	
	public function setFileSize($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_size !== $v) {
			$this->file_size = $v;
			$this->modifiedColumns[] = FileSyncPeer::FILE_SIZE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->object_type = $rs->getInt($startcol + 2);

			$this->object_id = $rs->getString($startcol + 3);

			$this->version = $rs->getString($startcol + 4);

			$this->object_sub_type = $rs->getInt($startcol + 5);

			$this->dc = $rs->getInt($startcol + 6);

			$this->original = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->ready_at = $rs->getTimestamp($startcol + 10, null);

			$this->sync_time = $rs->getInt($startcol + 11);

			$this->status = $rs->getInt($startcol + 12);

			$this->file_type = $rs->getInt($startcol + 13);

			$this->linked_id = $rs->getInt($startcol + 14);

			$this->link_count = $rs->getInt($startcol + 15);

			$this->file_root = $rs->getString($startcol + 16);

			$this->file_path = $rs->getString($startcol + 17);

			$this->file_size = $rs->getString($startcol + 18);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FileSync object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FileSyncPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FileSyncPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(FileSyncPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(FileSyncPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FileSyncPeer::DATABASE_NAME);
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
					$pk = FileSyncPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FileSyncPeer::doUpdate($this, $con);
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


			if (($retval = FileSyncPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileSyncPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getObjectType();
				break;
			case 3:
				return $this->getObjectId();
				break;
			case 4:
				return $this->getVersion();
				break;
			case 5:
				return $this->getObjectSubType();
				break;
			case 6:
				return $this->getDc();
				break;
			case 7:
				return $this->getOriginal();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			case 10:
				return $this->getReadyAt();
				break;
			case 11:
				return $this->getSyncTime();
				break;
			case 12:
				return $this->getStatus();
				break;
			case 13:
				return $this->getFileType();
				break;
			case 14:
				return $this->getLinkedId();
				break;
			case 15:
				return $this->getLinkCount();
				break;
			case 16:
				return $this->getFileRoot();
				break;
			case 17:
				return $this->getFilePath();
				break;
			case 18:
				return $this->getFileSize();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FileSyncPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getObjectType(),
			$keys[3] => $this->getObjectId(),
			$keys[4] => $this->getVersion(),
			$keys[5] => $this->getObjectSubType(),
			$keys[6] => $this->getDc(),
			$keys[7] => $this->getOriginal(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
			$keys[10] => $this->getReadyAt(),
			$keys[11] => $this->getSyncTime(),
			$keys[12] => $this->getStatus(),
			$keys[13] => $this->getFileType(),
			$keys[14] => $this->getLinkedId(),
			$keys[15] => $this->getLinkCount(),
			$keys[16] => $this->getFileRoot(),
			$keys[17] => $this->getFilePath(),
			$keys[18] => $this->getFileSize(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileSyncPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setObjectType($value);
				break;
			case 3:
				$this->setObjectId($value);
				break;
			case 4:
				$this->setVersion($value);
				break;
			case 5:
				$this->setObjectSubType($value);
				break;
			case 6:
				$this->setDc($value);
				break;
			case 7:
				$this->setOriginal($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
			case 10:
				$this->setReadyAt($value);
				break;
			case 11:
				$this->setSyncTime($value);
				break;
			case 12:
				$this->setStatus($value);
				break;
			case 13:
				$this->setFileType($value);
				break;
			case 14:
				$this->setLinkedId($value);
				break;
			case 15:
				$this->setLinkCount($value);
				break;
			case 16:
				$this->setFileRoot($value);
				break;
			case 17:
				$this->setFilePath($value);
				break;
			case 18:
				$this->setFileSize($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FileSyncPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setObjectType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVersion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObjectSubType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDc($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOriginal($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setReadyAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSyncTime($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStatus($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setFileType($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLinkedId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLinkCount($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setFileRoot($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFilePath($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setFileSize($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FileSyncPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileSyncPeer::ID)) $criteria->add(FileSyncPeer::ID, $this->id);
		if ($this->isColumnModified(FileSyncPeer::PARTNER_ID)) $criteria->add(FileSyncPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(FileSyncPeer::OBJECT_TYPE)) $criteria->add(FileSyncPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(FileSyncPeer::OBJECT_ID)) $criteria->add(FileSyncPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(FileSyncPeer::VERSION)) $criteria->add(FileSyncPeer::VERSION, $this->version);
		if ($this->isColumnModified(FileSyncPeer::OBJECT_SUB_TYPE)) $criteria->add(FileSyncPeer::OBJECT_SUB_TYPE, $this->object_sub_type);
		if ($this->isColumnModified(FileSyncPeer::DC)) $criteria->add(FileSyncPeer::DC, $this->dc);
		if ($this->isColumnModified(FileSyncPeer::ORIGINAL)) $criteria->add(FileSyncPeer::ORIGINAL, $this->original);
		if ($this->isColumnModified(FileSyncPeer::CREATED_AT)) $criteria->add(FileSyncPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FileSyncPeer::UPDATED_AT)) $criteria->add(FileSyncPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(FileSyncPeer::READY_AT)) $criteria->add(FileSyncPeer::READY_AT, $this->ready_at);
		if ($this->isColumnModified(FileSyncPeer::SYNC_TIME)) $criteria->add(FileSyncPeer::SYNC_TIME, $this->sync_time);
		if ($this->isColumnModified(FileSyncPeer::STATUS)) $criteria->add(FileSyncPeer::STATUS, $this->status);
		if ($this->isColumnModified(FileSyncPeer::FILE_TYPE)) $criteria->add(FileSyncPeer::FILE_TYPE, $this->file_type);
		if ($this->isColumnModified(FileSyncPeer::LINKED_ID)) $criteria->add(FileSyncPeer::LINKED_ID, $this->linked_id);
		if ($this->isColumnModified(FileSyncPeer::LINK_COUNT)) $criteria->add(FileSyncPeer::LINK_COUNT, $this->link_count);
		if ($this->isColumnModified(FileSyncPeer::FILE_ROOT)) $criteria->add(FileSyncPeer::FILE_ROOT, $this->file_root);
		if ($this->isColumnModified(FileSyncPeer::FILE_PATH)) $criteria->add(FileSyncPeer::FILE_PATH, $this->file_path);
		if ($this->isColumnModified(FileSyncPeer::FILE_SIZE)) $criteria->add(FileSyncPeer::FILE_SIZE, $this->file_size);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FileSyncPeer::DATABASE_NAME);

		$criteria->add(FileSyncPeer::ID, $this->id);

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

		$copyObj->setObjectType($this->object_type);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setVersion($this->version);

		$copyObj->setObjectSubType($this->object_sub_type);

		$copyObj->setDc($this->dc);

		$copyObj->setOriginal($this->original);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setReadyAt($this->ready_at);

		$copyObj->setSyncTime($this->sync_time);

		$copyObj->setStatus($this->status);

		$copyObj->setFileType($this->file_type);

		$copyObj->setLinkedId($this->linked_id);

		$copyObj->setLinkCount($this->link_count);

		$copyObj->setFileRoot($this->file_root);

		$copyObj->setFilePath($this->file_path);

		$copyObj->setFileSize($this->file_size);


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
			self::$peer = new FileSyncPeer();
		}
		return self::$peer;
	}

} 