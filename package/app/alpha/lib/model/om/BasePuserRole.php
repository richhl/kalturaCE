<?php


abstract class BasePuserRole extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kshow_id;


	
	protected $partner_id;


	
	protected $puser_id;


	
	protected $role;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $subp_id = 0;

	
	protected $akshow;

	
	protected $aPuserKuserRelatedByPartnerId;

	
	protected $aPuserKuserRelatedByPuserId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getKshowId()
	{

		return $this->kshow_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getPuserId()
	{

		return $this->puser_id;
	}

	
	public function getRole()
	{

		return $this->role;
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

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PuserRolePeer::ID;
		}

	} 
	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = PuserRolePeer::KSHOW_ID;
		}

		if ($this->akshow !== null && $this->akshow->getId() !== $v) {
			$this->akshow = null;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = PuserRolePeer::PARTNER_ID;
		}

		if ($this->aPuserKuserRelatedByPartnerId !== null && $this->aPuserKuserRelatedByPartnerId->getPartnerId() !== $v) {
			$this->aPuserKuserRelatedByPartnerId = null;
		}

	} 
	
	public function setPuserId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->puser_id !== $v) {
			$this->puser_id = $v;
			$this->modifiedColumns[] = PuserRolePeer::PUSER_ID;
		}

		if ($this->aPuserKuserRelatedByPuserId !== null && $this->aPuserKuserRelatedByPuserId->getPuserId() !== $v) {
			$this->aPuserKuserRelatedByPuserId = null;
		}

	} 
	
	public function setRole($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->role !== $v) {
			$this->role = $v;
			$this->modifiedColumns[] = PuserRolePeer::ROLE;
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
			$this->modifiedColumns[] = PuserRolePeer::CREATED_AT;
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
			$this->modifiedColumns[] = PuserRolePeer::UPDATED_AT;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = PuserRolePeer::SUBP_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->kshow_id = $rs->getString($startcol + 1);

			$this->partner_id = $rs->getInt($startcol + 2);

			$this->puser_id = $rs->getString($startcol + 3);

			$this->role = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->subp_id = $rs->getInt($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PuserRole object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PuserRolePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PuserRolePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PuserRolePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PuserRolePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PuserRolePeer::DATABASE_NAME);
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


												
			if ($this->akshow !== null) {
				if ($this->akshow->isModified()) {
					$affectedRows += $this->akshow->save($con);
				}
				$this->setkshow($this->akshow);
			}

			if ($this->aPuserKuserRelatedByPartnerId !== null) {
				if ($this->aPuserKuserRelatedByPartnerId->isModified()) {
					$affectedRows += $this->aPuserKuserRelatedByPartnerId->save($con);
				}
				$this->setPuserKuserRelatedByPartnerId($this->aPuserKuserRelatedByPartnerId);
			}

			if ($this->aPuserKuserRelatedByPuserId !== null) {
				if ($this->aPuserKuserRelatedByPuserId->isModified()) {
					$affectedRows += $this->aPuserKuserRelatedByPuserId->save($con);
				}
				$this->setPuserKuserRelatedByPuserId($this->aPuserKuserRelatedByPuserId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PuserRolePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PuserRolePeer::doUpdate($this, $con);
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


												
			if ($this->akshow !== null) {
				if (!$this->akshow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akshow->getValidationFailures());
				}
			}

			if ($this->aPuserKuserRelatedByPartnerId !== null) {
				if (!$this->aPuserKuserRelatedByPartnerId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPuserKuserRelatedByPartnerId->getValidationFailures());
				}
			}

			if ($this->aPuserKuserRelatedByPuserId !== null) {
				if (!$this->aPuserKuserRelatedByPuserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPuserKuserRelatedByPuserId->getValidationFailures());
				}
			}


			if (($retval = PuserRolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PuserRolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKshowId();
				break;
			case 2:
				return $this->getPartnerId();
				break;
			case 3:
				return $this->getPuserId();
				break;
			case 4:
				return $this->getRole();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getSubpId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PuserRolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKshowId(),
			$keys[2] => $this->getPartnerId(),
			$keys[3] => $this->getPuserId(),
			$keys[4] => $this->getRole(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getSubpId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PuserRolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKshowId($value);
				break;
			case 2:
				$this->setPartnerId($value);
				break;
			case 3:
				$this->setPuserId($value);
				break;
			case 4:
				$this->setRole($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setSubpId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PuserRolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKshowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPuserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRole($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSubpId($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PuserRolePeer::DATABASE_NAME);

		if ($this->isColumnModified(PuserRolePeer::ID)) $criteria->add(PuserRolePeer::ID, $this->id);
		if ($this->isColumnModified(PuserRolePeer::KSHOW_ID)) $criteria->add(PuserRolePeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(PuserRolePeer::PARTNER_ID)) $criteria->add(PuserRolePeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(PuserRolePeer::PUSER_ID)) $criteria->add(PuserRolePeer::PUSER_ID, $this->puser_id);
		if ($this->isColumnModified(PuserRolePeer::ROLE)) $criteria->add(PuserRolePeer::ROLE, $this->role);
		if ($this->isColumnModified(PuserRolePeer::CREATED_AT)) $criteria->add(PuserRolePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PuserRolePeer::UPDATED_AT)) $criteria->add(PuserRolePeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(PuserRolePeer::SUBP_ID)) $criteria->add(PuserRolePeer::SUBP_ID, $this->subp_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PuserRolePeer::DATABASE_NAME);

		$criteria->add(PuserRolePeer::ID, $this->id);

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

		$copyObj->setKshowId($this->kshow_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setPuserId($this->puser_id);

		$copyObj->setRole($this->role);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setSubpId($this->subp_id);


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
			self::$peer = new PuserRolePeer();
		}
		return self::$peer;
	}

	
	public function setkshow($v)
	{


		if ($v === null) {
			$this->setKshowId(NULL);
		} else {
			$this->setKshowId($v->getId());
		}


		$this->akshow = $v;
	}


	
	public function getkshow($con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';

		if ($this->akshow === null && (($this->kshow_id !== "" && $this->kshow_id !== null))) {

			$this->akshow = kshowPeer::retrieveByPK($this->kshow_id, $con);

			
		}
		return $this->akshow;
	}

	
	public function setPuserKuserRelatedByPartnerId($v)
	{


		if ($v === null) {
			$this->setPartnerId(NULL);
		} else {
			$this->setPartnerId($v->getPartnerId());
		}


		$this->aPuserKuserRelatedByPartnerId = $v;
	}


	
	public function getPuserKuserRelatedByPartnerId($con = null)
	{
				include_once 'lib/model/om/BasePuserKuserPeer.php';

		if ($this->aPuserKuserRelatedByPartnerId === null && ($this->partner_id !== null)) {

			$this->aPuserKuserRelatedByPartnerId = PuserKuserPeer::retrieveByPK($this->partner_id, $con);

			
		}
		return $this->aPuserKuserRelatedByPartnerId;
	}

	
	public function setPuserKuserRelatedByPuserId($v)
	{


		if ($v === null) {
			$this->setPuserId(NULL);
		} else {
			$this->setPuserId($v->getPuserId());
		}


		$this->aPuserKuserRelatedByPuserId = $v;
	}


	
	public function getPuserKuserRelatedByPuserId($con = null)
	{
				include_once 'lib/model/om/BasePuserKuserPeer.php';

		if ($this->aPuserKuserRelatedByPuserId === null && (($this->puser_id !== "" && $this->puser_id !== null))) {

			$this->aPuserKuserRelatedByPuserId = PuserKuserPeer::retrieveByPK($this->puser_id, $con);

			
		}
		return $this->aPuserKuserRelatedByPuserId;
	}

} 