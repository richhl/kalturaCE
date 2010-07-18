<?php


abstract class BasemoderationFlag extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $kuser_id;


	
	protected $object_type;


	
	protected $flagged_entry_id;


	
	protected $flagged_kuser_id;


	
	protected $status;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $comments;


	
	protected $flag_type;

	
	protected $akuserRelatedByKuserId;

	
	protected $aentry;

	
	protected $akuserRelatedByFlaggedKuserId;

	
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

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getObjectType()
	{

		return $this->object_type;
	}

	
	public function getFlaggedEntryId()
	{

		return $this->flagged_entry_id;
	}

	
	public function getFlaggedKuserId()
	{

		return $this->flagged_kuser_id;
	}

	
	public function getStatus()
	{

		return $this->status;
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

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getFlagType()
	{

		return $this->flag_type;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = moderationFlagPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = moderationFlagPeer::PARTNER_ID;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = moderationFlagPeer::KUSER_ID;
		}

		if ($this->akuserRelatedByKuserId !== null && $this->akuserRelatedByKuserId->getId() !== $v) {
			$this->akuserRelatedByKuserId = null;
		}

	} 
	
	public function setObjectType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_type !== $v) {
			$this->object_type = $v;
			$this->modifiedColumns[] = moderationFlagPeer::OBJECT_TYPE;
		}

	} 
	
	public function setFlaggedEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->flagged_entry_id !== $v) {
			$this->flagged_entry_id = $v;
			$this->modifiedColumns[] = moderationFlagPeer::FLAGGED_ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setFlaggedKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flagged_kuser_id !== $v) {
			$this->flagged_kuser_id = $v;
			$this->modifiedColumns[] = moderationFlagPeer::FLAGGED_KUSER_ID;
		}

		if ($this->akuserRelatedByFlaggedKuserId !== null && $this->akuserRelatedByFlaggedKuserId->getId() !== $v) {
			$this->akuserRelatedByFlaggedKuserId = null;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = moderationFlagPeer::STATUS;
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
			$this->modifiedColumns[] = moderationFlagPeer::CREATED_AT;
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
			$this->modifiedColumns[] = moderationFlagPeer::UPDATED_AT;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = moderationFlagPeer::COMMENTS;
		}

	} 
	
	public function setFlagType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flag_type !== $v) {
			$this->flag_type = $v;
			$this->modifiedColumns[] = moderationFlagPeer::FLAG_TYPE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->kuser_id = $rs->getInt($startcol + 2);

			$this->object_type = $rs->getInt($startcol + 3);

			$this->flagged_entry_id = $rs->getString($startcol + 4);

			$this->flagged_kuser_id = $rs->getInt($startcol + 5);

			$this->status = $rs->getInt($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->comments = $rs->getString($startcol + 9);

			$this->flag_type = $rs->getInt($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating moderationFlag object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(moderationFlagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			moderationFlagPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(moderationFlagPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(moderationFlagPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(moderationFlagPeer::DATABASE_NAME);
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


												
			if ($this->akuserRelatedByKuserId !== null) {
				if ($this->akuserRelatedByKuserId->isModified()) {
					$affectedRows += $this->akuserRelatedByKuserId->save($con);
				}
				$this->setkuserRelatedByKuserId($this->akuserRelatedByKuserId);
			}

			if ($this->aentry !== null) {
				if ($this->aentry->isModified()) {
					$affectedRows += $this->aentry->save($con);
				}
				$this->setentry($this->aentry);
			}

			if ($this->akuserRelatedByFlaggedKuserId !== null) {
				if ($this->akuserRelatedByFlaggedKuserId->isModified()) {
					$affectedRows += $this->akuserRelatedByFlaggedKuserId->save($con);
				}
				$this->setkuserRelatedByFlaggedKuserId($this->akuserRelatedByFlaggedKuserId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = moderationFlagPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += moderationFlagPeer::doUpdate($this, $con);
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


												
			if ($this->akuserRelatedByKuserId !== null) {
				if (!$this->akuserRelatedByKuserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuserRelatedByKuserId->getValidationFailures());
				}
			}

			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}

			if ($this->akuserRelatedByFlaggedKuserId !== null) {
				if (!$this->akuserRelatedByFlaggedKuserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuserRelatedByFlaggedKuserId->getValidationFailures());
				}
			}


			if (($retval = moderationFlagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = moderationFlagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getKuserId();
				break;
			case 3:
				return $this->getObjectType();
				break;
			case 4:
				return $this->getFlaggedEntryId();
				break;
			case 5:
				return $this->getFlaggedKuserId();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			case 9:
				return $this->getComments();
				break;
			case 10:
				return $this->getFlagType();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = moderationFlagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getKuserId(),
			$keys[3] => $this->getObjectType(),
			$keys[4] => $this->getFlaggedEntryId(),
			$keys[5] => $this->getFlaggedKuserId(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
			$keys[9] => $this->getComments(),
			$keys[10] => $this->getFlagType(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = moderationFlagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setKuserId($value);
				break;
			case 3:
				$this->setObjectType($value);
				break;
			case 4:
				$this->setFlaggedEntryId($value);
				break;
			case 5:
				$this->setFlaggedKuserId($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
			case 9:
				$this->setComments($value);
				break;
			case 10:
				$this->setFlagType($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = moderationFlagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKuserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFlaggedEntryId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFlaggedKuserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setComments($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setFlagType($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(moderationFlagPeer::DATABASE_NAME);

		if ($this->isColumnModified(moderationFlagPeer::ID)) $criteria->add(moderationFlagPeer::ID, $this->id);
		if ($this->isColumnModified(moderationFlagPeer::PARTNER_ID)) $criteria->add(moderationFlagPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(moderationFlagPeer::KUSER_ID)) $criteria->add(moderationFlagPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(moderationFlagPeer::OBJECT_TYPE)) $criteria->add(moderationFlagPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(moderationFlagPeer::FLAGGED_ENTRY_ID)) $criteria->add(moderationFlagPeer::FLAGGED_ENTRY_ID, $this->flagged_entry_id);
		if ($this->isColumnModified(moderationFlagPeer::FLAGGED_KUSER_ID)) $criteria->add(moderationFlagPeer::FLAGGED_KUSER_ID, $this->flagged_kuser_id);
		if ($this->isColumnModified(moderationFlagPeer::STATUS)) $criteria->add(moderationFlagPeer::STATUS, $this->status);
		if ($this->isColumnModified(moderationFlagPeer::CREATED_AT)) $criteria->add(moderationFlagPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(moderationFlagPeer::UPDATED_AT)) $criteria->add(moderationFlagPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(moderationFlagPeer::COMMENTS)) $criteria->add(moderationFlagPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(moderationFlagPeer::FLAG_TYPE)) $criteria->add(moderationFlagPeer::FLAG_TYPE, $this->flag_type);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(moderationFlagPeer::DATABASE_NAME);

		$criteria->add(moderationFlagPeer::ID, $this->id);

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

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setObjectType($this->object_type);

		$copyObj->setFlaggedEntryId($this->flagged_entry_id);

		$copyObj->setFlaggedKuserId($this->flagged_kuser_id);

		$copyObj->setStatus($this->status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setComments($this->comments);

		$copyObj->setFlagType($this->flag_type);


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
			self::$peer = new moderationFlagPeer();
		}
		return self::$peer;
	}

	
	public function setkuserRelatedByKuserId($v)
	{


		if ($v === null) {
			$this->setKuserId(NULL);
		} else {
			$this->setKuserId($v->getId());
		}


		$this->akuserRelatedByKuserId = $v;
	}


	
	public function getkuserRelatedByKuserId($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuserRelatedByKuserId === null && ($this->kuser_id !== null)) {

			$this->akuserRelatedByKuserId = kuserPeer::retrieveByPK($this->kuser_id, $con);

			
		}
		return $this->akuserRelatedByKuserId;
	}

	
	public function setentry($v)
	{


		if ($v === null) {
			$this->setFlaggedEntryId(NULL);
		} else {
			$this->setFlaggedEntryId($v->getId());
		}


		$this->aentry = $v;
	}


	
	public function getentry($con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';

		if ($this->aentry === null && (($this->flagged_entry_id !== "" && $this->flagged_entry_id !== null))) {

			$this->aentry = entryPeer::retrieveByPK($this->flagged_entry_id, $con);

			
		}
		return $this->aentry;
	}

	
	public function setkuserRelatedByFlaggedKuserId($v)
	{


		if ($v === null) {
			$this->setFlaggedKuserId(NULL);
		} else {
			$this->setFlaggedKuserId($v->getId());
		}


		$this->akuserRelatedByFlaggedKuserId = $v;
	}


	
	public function getkuserRelatedByFlaggedKuserId($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuserRelatedByFlaggedKuserId === null && ($this->flagged_kuser_id !== null)) {

			$this->akuserRelatedByFlaggedKuserId = kuserPeer::retrieveByPK($this->flagged_kuser_id, $con);

			
		}
		return $this->akuserRelatedByFlaggedKuserId;
	}

} 