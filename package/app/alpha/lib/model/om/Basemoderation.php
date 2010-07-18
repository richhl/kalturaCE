<?php


abstract class Basemoderation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $subp_id;


	
	protected $object_id;


	
	protected $object_type;


	
	protected $kuser_id;


	
	protected $puser_id;


	
	protected $status;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $comments;


	
	protected $group_id;


	
	protected $report_code;

	
	protected $akuser;

	
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

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getObjectType()
	{

		return $this->object_type;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getPuserId()
	{

		return $this->puser_id;
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

	
	public function getGroupId()
	{

		return $this->group_id;
	}

	
	public function getReportCode()
	{

		return $this->report_code;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = moderationPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = moderationPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = moderationPeer::SUBP_ID;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = moderationPeer::OBJECT_ID;
		}

	} 
	
	public function setObjectType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_type !== $v) {
			$this->object_type = $v;
			$this->modifiedColumns[] = moderationPeer::OBJECT_TYPE;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = moderationPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setPuserId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->puser_id !== $v) {
			$this->puser_id = $v;
			$this->modifiedColumns[] = moderationPeer::PUSER_ID;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = moderationPeer::STATUS;
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
			$this->modifiedColumns[] = moderationPeer::CREATED_AT;
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
			$this->modifiedColumns[] = moderationPeer::UPDATED_AT;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = moderationPeer::COMMENTS;
		}

	} 
	
	public function setGroupId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = moderationPeer::GROUP_ID;
		}

	} 
	
	public function setReportCode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->report_code !== $v) {
			$this->report_code = $v;
			$this->modifiedColumns[] = moderationPeer::REPORT_CODE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->subp_id = $rs->getInt($startcol + 2);

			$this->object_id = $rs->getString($startcol + 3);

			$this->object_type = $rs->getInt($startcol + 4);

			$this->kuser_id = $rs->getInt($startcol + 5);

			$this->puser_id = $rs->getString($startcol + 6);

			$this->status = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->comments = $rs->getString($startcol + 10);

			$this->group_id = $rs->getString($startcol + 11);

			$this->report_code = $rs->getInt($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating moderation object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(moderationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			moderationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(moderationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(moderationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(moderationPeer::DATABASE_NAME);
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


												
			if ($this->akuser !== null) {
				if ($this->akuser->isModified()) {
					$affectedRows += $this->akuser->save($con);
				}
				$this->setkuser($this->akuser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = moderationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += moderationPeer::doUpdate($this, $con);
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


												
			if ($this->akuser !== null) {
				if (!$this->akuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuser->getValidationFailures());
				}
			}


			if (($retval = moderationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = moderationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSubpId();
				break;
			case 3:
				return $this->getObjectId();
				break;
			case 4:
				return $this->getObjectType();
				break;
			case 5:
				return $this->getKuserId();
				break;
			case 6:
				return $this->getPuserId();
				break;
			case 7:
				return $this->getStatus();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			case 10:
				return $this->getComments();
				break;
			case 11:
				return $this->getGroupId();
				break;
			case 12:
				return $this->getReportCode();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = moderationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getSubpId(),
			$keys[3] => $this->getObjectId(),
			$keys[4] => $this->getObjectType(),
			$keys[5] => $this->getKuserId(),
			$keys[6] => $this->getPuserId(),
			$keys[7] => $this->getStatus(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
			$keys[10] => $this->getComments(),
			$keys[11] => $this->getGroupId(),
			$keys[12] => $this->getReportCode(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = moderationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSubpId($value);
				break;
			case 3:
				$this->setObjectId($value);
				break;
			case 4:
				$this->setObjectType($value);
				break;
			case 5:
				$this->setKuserId($value);
				break;
			case 6:
				$this->setPuserId($value);
				break;
			case 7:
				$this->setStatus($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
			case 10:
				$this->setComments($value);
				break;
			case 11:
				$this->setGroupId($value);
				break;
			case 12:
				$this->setReportCode($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = moderationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSubpId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObjectType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setKuserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPuserId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setComments($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setGroupId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setReportCode($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(moderationPeer::DATABASE_NAME);

		if ($this->isColumnModified(moderationPeer::ID)) $criteria->add(moderationPeer::ID, $this->id);
		if ($this->isColumnModified(moderationPeer::PARTNER_ID)) $criteria->add(moderationPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(moderationPeer::SUBP_ID)) $criteria->add(moderationPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(moderationPeer::OBJECT_ID)) $criteria->add(moderationPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(moderationPeer::OBJECT_TYPE)) $criteria->add(moderationPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(moderationPeer::KUSER_ID)) $criteria->add(moderationPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(moderationPeer::PUSER_ID)) $criteria->add(moderationPeer::PUSER_ID, $this->puser_id);
		if ($this->isColumnModified(moderationPeer::STATUS)) $criteria->add(moderationPeer::STATUS, $this->status);
		if ($this->isColumnModified(moderationPeer::CREATED_AT)) $criteria->add(moderationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(moderationPeer::UPDATED_AT)) $criteria->add(moderationPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(moderationPeer::COMMENTS)) $criteria->add(moderationPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(moderationPeer::GROUP_ID)) $criteria->add(moderationPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(moderationPeer::REPORT_CODE)) $criteria->add(moderationPeer::REPORT_CODE, $this->report_code);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(moderationPeer::DATABASE_NAME);

		$criteria->add(moderationPeer::ID, $this->id);

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

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setObjectType($this->object_type);

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setPuserId($this->puser_id);

		$copyObj->setStatus($this->status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setComments($this->comments);

		$copyObj->setGroupId($this->group_id);

		$copyObj->setReportCode($this->report_code);


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
			self::$peer = new moderationPeer();
		}
		return self::$peer;
	}

	
	public function setkuser($v)
	{


		if ($v === null) {
			$this->setKuserId(NULL);
		} else {
			$this->setKuserId($v->getId());
		}


		$this->akuser = $v;
	}


	
	public function getkuser($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuser === null && ($this->kuser_id !== null)) {

			$this->akuser = kuserPeer::retrieveByPK($this->kuser_id, $con);

			
		}
		return $this->akuser;
	}

} 