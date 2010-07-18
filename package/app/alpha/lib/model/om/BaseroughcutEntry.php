<?php


abstract class BaseroughcutEntry extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $roughcut_id;


	
	protected $roughcut_version;


	
	protected $roughcut_kshow_id;


	
	protected $entry_id;


	
	protected $partner_id;


	
	protected $op_type;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aentryRelatedByRoughcutId;

	
	protected $akshow;

	
	protected $aentryRelatedByEntryId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRoughcutId()
	{

		return $this->roughcut_id;
	}

	
	public function getRoughcutVersion()
	{

		return $this->roughcut_version;
	}

	
	public function getRoughcutKshowId()
	{

		return $this->roughcut_kshow_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getOpType()
	{

		return $this->op_type;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::ID;
		}

	} 
	
	public function setRoughcutId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->roughcut_id !== $v) {
			$this->roughcut_id = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::ROUGHCUT_ID;
		}

		if ($this->aentryRelatedByRoughcutId !== null && $this->aentryRelatedByRoughcutId->getId() !== $v) {
			$this->aentryRelatedByRoughcutId = null;
		}

	} 
	
	public function setRoughcutVersion($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->roughcut_version !== $v) {
			$this->roughcut_version = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::ROUGHCUT_VERSION;
		}

	} 
	
	public function setRoughcutKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->roughcut_kshow_id !== $v) {
			$this->roughcut_kshow_id = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::ROUGHCUT_KSHOW_ID;
		}

		if ($this->akshow !== null && $this->akshow->getId() !== $v) {
			$this->akshow = null;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::ENTRY_ID;
		}

		if ($this->aentryRelatedByEntryId !== null && $this->aentryRelatedByEntryId->getId() !== $v) {
			$this->aentryRelatedByEntryId = null;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::PARTNER_ID;
		}

	} 
	
	public function setOpType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->op_type !== $v) {
			$this->op_type = $v;
			$this->modifiedColumns[] = roughcutEntryPeer::OP_TYPE;
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
			$this->modifiedColumns[] = roughcutEntryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = roughcutEntryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->roughcut_id = $rs->getString($startcol + 1);

			$this->roughcut_version = $rs->getInt($startcol + 2);

			$this->roughcut_kshow_id = $rs->getString($startcol + 3);

			$this->entry_id = $rs->getString($startcol + 4);

			$this->partner_id = $rs->getInt($startcol + 5);

			$this->op_type = $rs->getInt($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating roughcutEntry object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(roughcutEntryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			roughcutEntryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(roughcutEntryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(roughcutEntryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(roughcutEntryPeer::DATABASE_NAME);
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


												
			if ($this->aentryRelatedByRoughcutId !== null) {
				if ($this->aentryRelatedByRoughcutId->isModified()) {
					$affectedRows += $this->aentryRelatedByRoughcutId->save($con);
				}
				$this->setentryRelatedByRoughcutId($this->aentryRelatedByRoughcutId);
			}

			if ($this->akshow !== null) {
				if ($this->akshow->isModified()) {
					$affectedRows += $this->akshow->save($con);
				}
				$this->setkshow($this->akshow);
			}

			if ($this->aentryRelatedByEntryId !== null) {
				if ($this->aentryRelatedByEntryId->isModified()) {
					$affectedRows += $this->aentryRelatedByEntryId->save($con);
				}
				$this->setentryRelatedByEntryId($this->aentryRelatedByEntryId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = roughcutEntryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += roughcutEntryPeer::doUpdate($this, $con);
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


												
			if ($this->aentryRelatedByRoughcutId !== null) {
				if (!$this->aentryRelatedByRoughcutId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentryRelatedByRoughcutId->getValidationFailures());
				}
			}

			if ($this->akshow !== null) {
				if (!$this->akshow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akshow->getValidationFailures());
				}
			}

			if ($this->aentryRelatedByEntryId !== null) {
				if (!$this->aentryRelatedByEntryId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentryRelatedByEntryId->getValidationFailures());
				}
			}


			if (($retval = roughcutEntryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = roughcutEntryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRoughcutId();
				break;
			case 2:
				return $this->getRoughcutVersion();
				break;
			case 3:
				return $this->getRoughcutKshowId();
				break;
			case 4:
				return $this->getEntryId();
				break;
			case 5:
				return $this->getPartnerId();
				break;
			case 6:
				return $this->getOpType();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = roughcutEntryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRoughcutId(),
			$keys[2] => $this->getRoughcutVersion(),
			$keys[3] => $this->getRoughcutKshowId(),
			$keys[4] => $this->getEntryId(),
			$keys[5] => $this->getPartnerId(),
			$keys[6] => $this->getOpType(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = roughcutEntryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRoughcutId($value);
				break;
			case 2:
				$this->setRoughcutVersion($value);
				break;
			case 3:
				$this->setRoughcutKshowId($value);
				break;
			case 4:
				$this->setEntryId($value);
				break;
			case 5:
				$this->setPartnerId($value);
				break;
			case 6:
				$this->setOpType($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = roughcutEntryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRoughcutId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoughcutVersion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRoughcutKshowId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEntryId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPartnerId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setOpType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(roughcutEntryPeer::DATABASE_NAME);

		if ($this->isColumnModified(roughcutEntryPeer::ID)) $criteria->add(roughcutEntryPeer::ID, $this->id);
		if ($this->isColumnModified(roughcutEntryPeer::ROUGHCUT_ID)) $criteria->add(roughcutEntryPeer::ROUGHCUT_ID, $this->roughcut_id);
		if ($this->isColumnModified(roughcutEntryPeer::ROUGHCUT_VERSION)) $criteria->add(roughcutEntryPeer::ROUGHCUT_VERSION, $this->roughcut_version);
		if ($this->isColumnModified(roughcutEntryPeer::ROUGHCUT_KSHOW_ID)) $criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->roughcut_kshow_id);
		if ($this->isColumnModified(roughcutEntryPeer::ENTRY_ID)) $criteria->add(roughcutEntryPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(roughcutEntryPeer::PARTNER_ID)) $criteria->add(roughcutEntryPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(roughcutEntryPeer::OP_TYPE)) $criteria->add(roughcutEntryPeer::OP_TYPE, $this->op_type);
		if ($this->isColumnModified(roughcutEntryPeer::CREATED_AT)) $criteria->add(roughcutEntryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(roughcutEntryPeer::UPDATED_AT)) $criteria->add(roughcutEntryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(roughcutEntryPeer::DATABASE_NAME);

		$criteria->add(roughcutEntryPeer::ID, $this->id);

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

		$copyObj->setRoughcutId($this->roughcut_id);

		$copyObj->setRoughcutVersion($this->roughcut_version);

		$copyObj->setRoughcutKshowId($this->roughcut_kshow_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setOpType($this->op_type);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new roughcutEntryPeer();
		}
		return self::$peer;
	}

	
	public function setentryRelatedByRoughcutId($v)
	{


		if ($v === null) {
			$this->setRoughcutId(NULL);
		} else {
			$this->setRoughcutId($v->getId());
		}


		$this->aentryRelatedByRoughcutId = $v;
	}


	
	public function getentryRelatedByRoughcutId($con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';

		if ($this->aentryRelatedByRoughcutId === null && (($this->roughcut_id !== "" && $this->roughcut_id !== null))) {

			$this->aentryRelatedByRoughcutId = entryPeer::retrieveByPK($this->roughcut_id, $con);

			
		}
		return $this->aentryRelatedByRoughcutId;
	}

	
	public function setkshow($v)
	{


		if ($v === null) {
			$this->setRoughcutKshowId(NULL);
		} else {
			$this->setRoughcutKshowId($v->getId());
		}


		$this->akshow = $v;
	}


	
	public function getkshow($con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';

		if ($this->akshow === null && (($this->roughcut_kshow_id !== "" && $this->roughcut_kshow_id !== null))) {

			$this->akshow = kshowPeer::retrieveByPK($this->roughcut_kshow_id, $con);

			
		}
		return $this->akshow;
	}

	
	public function setentryRelatedByEntryId($v)
	{


		if ($v === null) {
			$this->setEntryId(NULL);
		} else {
			$this->setEntryId($v->getId());
		}


		$this->aentryRelatedByEntryId = $v;
	}


	
	public function getentryRelatedByEntryId($con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';

		if ($this->aentryRelatedByEntryId === null && (($this->entry_id !== "" && $this->entry_id !== null))) {

			$this->aentryRelatedByEntryId = entryPeer::retrieveByPK($this->entry_id, $con);

			
		}
		return $this->aentryRelatedByEntryId;
	}

} 