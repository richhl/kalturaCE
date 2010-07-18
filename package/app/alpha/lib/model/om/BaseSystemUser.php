<?php


abstract class BaseSystemUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $email;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $created_by;


	
	protected $status;


	
	protected $is_primary = false;


	
	protected $status_updated_at;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $deleted_at;


	
	protected $role;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getIsPrimary()
	{

		return $this->is_primary;
	}

	
	public function getStatusUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->status_updated_at === null || $this->status_updated_at === '') {
			return null;
		} elseif (!is_int($this->status_updated_at)) {
						$ts = strtotime($this->status_updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [status_updated_at] as date/time value: " . var_export($this->status_updated_at, true));
			}
		} else {
			$ts = $this->status_updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
						$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getRole()
	{

		return $this->role;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SystemUserPeer::ID;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = SystemUserPeer::EMAIL;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = SystemUserPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = SystemUserPeer::LAST_NAME;
		}

	} 
	
	public function setSha1Password($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = SystemUserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = SystemUserPeer::SALT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = SystemUserPeer::CREATED_BY;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = SystemUserPeer::STATUS;
		}

	} 
	
	public function setIsPrimary($v)
	{

		if ($this->is_primary !== $v || $v === false) {
			$this->is_primary = $v;
			$this->modifiedColumns[] = SystemUserPeer::IS_PRIMARY;
		}

	} 
	
	public function setStatusUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [status_updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->status_updated_at !== $ts) {
			$this->status_updated_at = $ts;
			$this->modifiedColumns[] = SystemUserPeer::STATUS_UPDATED_AT;
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
			$this->modifiedColumns[] = SystemUserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SystemUserPeer::UPDATED_AT;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = SystemUserPeer::DELETED_AT;
		}

	} 
	
	public function setRole($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->role !== $v) {
			$this->role = $v;
			$this->modifiedColumns[] = SystemUserPeer::ROLE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->email = $rs->getString($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->sha1_password = $rs->getString($startcol + 4);

			$this->salt = $rs->getString($startcol + 5);

			$this->created_by = $rs->getInt($startcol + 6);

			$this->status = $rs->getInt($startcol + 7);

			$this->is_primary = $rs->getBoolean($startcol + 8);

			$this->status_updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 12, null);

			$this->role = $rs->getString($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SystemUser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SystemUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SystemUserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SystemUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SystemUserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SystemUserPeer::DATABASE_NAME);
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
					$pk = SystemUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SystemUserPeer::doUpdate($this, $con);
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


			if (($retval = SystemUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SystemUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEmail();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getSha1Password();
				break;
			case 5:
				return $this->getSalt();
				break;
			case 6:
				return $this->getCreatedBy();
				break;
			case 7:
				return $this->getStatus();
				break;
			case 8:
				return $this->getIsPrimary();
				break;
			case 9:
				return $this->getStatusUpdatedAt();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			case 12:
				return $this->getDeletedAt();
				break;
			case 13:
				return $this->getRole();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SystemUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEmail(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getSha1Password(),
			$keys[5] => $this->getSalt(),
			$keys[6] => $this->getCreatedBy(),
			$keys[7] => $this->getStatus(),
			$keys[8] => $this->getIsPrimary(),
			$keys[9] => $this->getStatusUpdatedAt(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
			$keys[12] => $this->getDeletedAt(),
			$keys[13] => $this->getRole(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SystemUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEmail($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setSha1Password($value);
				break;
			case 5:
				$this->setSalt($value);
				break;
			case 6:
				$this->setCreatedBy($value);
				break;
			case 7:
				$this->setStatus($value);
				break;
			case 8:
				$this->setIsPrimary($value);
				break;
			case 9:
				$this->setStatusUpdatedAt($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
			case 12:
				$this->setDeletedAt($value);
				break;
			case 13:
				$this->setRole($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SystemUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSha1Password($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSalt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedBy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsPrimary($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatusUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDeletedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setRole($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SystemUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(SystemUserPeer::ID)) $criteria->add(SystemUserPeer::ID, $this->id);
		if ($this->isColumnModified(SystemUserPeer::EMAIL)) $criteria->add(SystemUserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(SystemUserPeer::FIRST_NAME)) $criteria->add(SystemUserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(SystemUserPeer::LAST_NAME)) $criteria->add(SystemUserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(SystemUserPeer::SHA1_PASSWORD)) $criteria->add(SystemUserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(SystemUserPeer::SALT)) $criteria->add(SystemUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(SystemUserPeer::CREATED_BY)) $criteria->add(SystemUserPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(SystemUserPeer::STATUS)) $criteria->add(SystemUserPeer::STATUS, $this->status);
		if ($this->isColumnModified(SystemUserPeer::IS_PRIMARY)) $criteria->add(SystemUserPeer::IS_PRIMARY, $this->is_primary);
		if ($this->isColumnModified(SystemUserPeer::STATUS_UPDATED_AT)) $criteria->add(SystemUserPeer::STATUS_UPDATED_AT, $this->status_updated_at);
		if ($this->isColumnModified(SystemUserPeer::CREATED_AT)) $criteria->add(SystemUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SystemUserPeer::UPDATED_AT)) $criteria->add(SystemUserPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SystemUserPeer::DELETED_AT)) $criteria->add(SystemUserPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(SystemUserPeer::ROLE)) $criteria->add(SystemUserPeer::ROLE, $this->role);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SystemUserPeer::DATABASE_NAME);

		$criteria->add(SystemUserPeer::ID, $this->id);

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

		$copyObj->setEmail($this->email);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setStatus($this->status);

		$copyObj->setIsPrimary($this->is_primary);

		$copyObj->setStatusUpdatedAt($this->status_updated_at);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setRole($this->role);


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
			self::$peer = new SystemUserPeer();
		}
		return self::$peer;
	}

} 