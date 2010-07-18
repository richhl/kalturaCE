<?php


abstract class BaseaccessControl extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $name = '';


	
	protected $description = '';


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $deleted_at;


	
	protected $site_restrict_type;


	
	protected $site_restrict_list;


	
	protected $country_restrict_type;


	
	protected $country_restrict_list;


	
	protected $ks_restrict_privilege;


	
	protected $prv_restrict_privilege;


	
	protected $prv_restrict_length;


	
	protected $kdir_restrict_type;

	
	protected $collentrys;

	
	protected $lastentryCriteria = null;

	
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

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
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

	
	public function getSiteRestrictType()
	{

		return $this->site_restrict_type;
	}

	
	public function getSiteRestrictList()
	{

		return $this->site_restrict_list;
	}

	
	public function getCountryRestrictType()
	{

		return $this->country_restrict_type;
	}

	
	public function getCountryRestrictList()
	{

		return $this->country_restrict_list;
	}

	
	public function getKsRestrictPrivilege()
	{

		return $this->ks_restrict_privilege;
	}

	
	public function getPrvRestrictPrivilege()
	{

		return $this->prv_restrict_privilege;
	}

	
	public function getPrvRestrictLength()
	{

		return $this->prv_restrict_length;
	}

	
	public function getKdirRestrictType()
	{

		return $this->kdir_restrict_type;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = accessControlPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = accessControlPeer::PARTNER_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = accessControlPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = accessControlPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = accessControlPeer::CREATED_AT;
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
			$this->modifiedColumns[] = accessControlPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = accessControlPeer::DELETED_AT;
		}

	} 
	
	public function setSiteRestrictType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->site_restrict_type !== $v) {
			$this->site_restrict_type = $v;
			$this->modifiedColumns[] = accessControlPeer::SITE_RESTRICT_TYPE;
		}

	} 
	
	public function setSiteRestrictList($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->site_restrict_list !== $v) {
			$this->site_restrict_list = $v;
			$this->modifiedColumns[] = accessControlPeer::SITE_RESTRICT_LIST;
		}

	} 
	
	public function setCountryRestrictType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->country_restrict_type !== $v) {
			$this->country_restrict_type = $v;
			$this->modifiedColumns[] = accessControlPeer::COUNTRY_RESTRICT_TYPE;
		}

	} 
	
	public function setCountryRestrictList($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->country_restrict_list !== $v) {
			$this->country_restrict_list = $v;
			$this->modifiedColumns[] = accessControlPeer::COUNTRY_RESTRICT_LIST;
		}

	} 
	
	public function setKsRestrictPrivilege($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ks_restrict_privilege !== $v) {
			$this->ks_restrict_privilege = $v;
			$this->modifiedColumns[] = accessControlPeer::KS_RESTRICT_PRIVILEGE;
		}

	} 
	
	public function setPrvRestrictPrivilege($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prv_restrict_privilege !== $v) {
			$this->prv_restrict_privilege = $v;
			$this->modifiedColumns[] = accessControlPeer::PRV_RESTRICT_PRIVILEGE;
		}

	} 
	
	public function setPrvRestrictLength($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->prv_restrict_length !== $v) {
			$this->prv_restrict_length = $v;
			$this->modifiedColumns[] = accessControlPeer::PRV_RESTRICT_LENGTH;
		}

	} 
	
	public function setKdirRestrictType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kdir_restrict_type !== $v) {
			$this->kdir_restrict_type = $v;
			$this->modifiedColumns[] = accessControlPeer::KDIR_RESTRICT_TYPE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 6, null);

			$this->site_restrict_type = $rs->getInt($startcol + 7);

			$this->site_restrict_list = $rs->getString($startcol + 8);

			$this->country_restrict_type = $rs->getInt($startcol + 9);

			$this->country_restrict_list = $rs->getString($startcol + 10);

			$this->ks_restrict_privilege = $rs->getString($startcol + 11);

			$this->prv_restrict_privilege = $rs->getString($startcol + 12);

			$this->prv_restrict_length = $rs->getInt($startcol + 13);

			$this->kdir_restrict_type = $rs->getInt($startcol + 14);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating accessControl object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(accessControlPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			accessControlPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(accessControlPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(accessControlPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(accessControlPeer::DATABASE_NAME);
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
					$pk = accessControlPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += accessControlPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collentrys !== null) {
				foreach($this->collentrys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = accessControlPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collentrys !== null) {
					foreach($this->collentrys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = accessControlPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			case 6:
				return $this->getDeletedAt();
				break;
			case 7:
				return $this->getSiteRestrictType();
				break;
			case 8:
				return $this->getSiteRestrictList();
				break;
			case 9:
				return $this->getCountryRestrictType();
				break;
			case 10:
				return $this->getCountryRestrictList();
				break;
			case 11:
				return $this->getKsRestrictPrivilege();
				break;
			case 12:
				return $this->getPrvRestrictPrivilege();
				break;
			case 13:
				return $this->getPrvRestrictLength();
				break;
			case 14:
				return $this->getKdirRestrictType();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = accessControlPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
			$keys[6] => $this->getDeletedAt(),
			$keys[7] => $this->getSiteRestrictType(),
			$keys[8] => $this->getSiteRestrictList(),
			$keys[9] => $this->getCountryRestrictType(),
			$keys[10] => $this->getCountryRestrictList(),
			$keys[11] => $this->getKsRestrictPrivilege(),
			$keys[12] => $this->getPrvRestrictPrivilege(),
			$keys[13] => $this->getPrvRestrictLength(),
			$keys[14] => $this->getKdirRestrictType(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = accessControlPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
			case 6:
				$this->setDeletedAt($value);
				break;
			case 7:
				$this->setSiteRestrictType($value);
				break;
			case 8:
				$this->setSiteRestrictList($value);
				break;
			case 9:
				$this->setCountryRestrictType($value);
				break;
			case 10:
				$this->setCountryRestrictList($value);
				break;
			case 11:
				$this->setKsRestrictPrivilege($value);
				break;
			case 12:
				$this->setPrvRestrictPrivilege($value);
				break;
			case 13:
				$this->setPrvRestrictLength($value);
				break;
			case 14:
				$this->setKdirRestrictType($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = accessControlPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeletedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSiteRestrictType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSiteRestrictList($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCountryRestrictType($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCountryRestrictList($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setKsRestrictPrivilege($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPrvRestrictPrivilege($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPrvRestrictLength($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setKdirRestrictType($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(accessControlPeer::DATABASE_NAME);

		if ($this->isColumnModified(accessControlPeer::ID)) $criteria->add(accessControlPeer::ID, $this->id);
		if ($this->isColumnModified(accessControlPeer::PARTNER_ID)) $criteria->add(accessControlPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(accessControlPeer::NAME)) $criteria->add(accessControlPeer::NAME, $this->name);
		if ($this->isColumnModified(accessControlPeer::DESCRIPTION)) $criteria->add(accessControlPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(accessControlPeer::CREATED_AT)) $criteria->add(accessControlPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(accessControlPeer::UPDATED_AT)) $criteria->add(accessControlPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(accessControlPeer::DELETED_AT)) $criteria->add(accessControlPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(accessControlPeer::SITE_RESTRICT_TYPE)) $criteria->add(accessControlPeer::SITE_RESTRICT_TYPE, $this->site_restrict_type);
		if ($this->isColumnModified(accessControlPeer::SITE_RESTRICT_LIST)) $criteria->add(accessControlPeer::SITE_RESTRICT_LIST, $this->site_restrict_list);
		if ($this->isColumnModified(accessControlPeer::COUNTRY_RESTRICT_TYPE)) $criteria->add(accessControlPeer::COUNTRY_RESTRICT_TYPE, $this->country_restrict_type);
		if ($this->isColumnModified(accessControlPeer::COUNTRY_RESTRICT_LIST)) $criteria->add(accessControlPeer::COUNTRY_RESTRICT_LIST, $this->country_restrict_list);
		if ($this->isColumnModified(accessControlPeer::KS_RESTRICT_PRIVILEGE)) $criteria->add(accessControlPeer::KS_RESTRICT_PRIVILEGE, $this->ks_restrict_privilege);
		if ($this->isColumnModified(accessControlPeer::PRV_RESTRICT_PRIVILEGE)) $criteria->add(accessControlPeer::PRV_RESTRICT_PRIVILEGE, $this->prv_restrict_privilege);
		if ($this->isColumnModified(accessControlPeer::PRV_RESTRICT_LENGTH)) $criteria->add(accessControlPeer::PRV_RESTRICT_LENGTH, $this->prv_restrict_length);
		if ($this->isColumnModified(accessControlPeer::KDIR_RESTRICT_TYPE)) $criteria->add(accessControlPeer::KDIR_RESTRICT_TYPE, $this->kdir_restrict_type);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(accessControlPeer::DATABASE_NAME);

		$criteria->add(accessControlPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setSiteRestrictType($this->site_restrict_type);

		$copyObj->setSiteRestrictList($this->site_restrict_list);

		$copyObj->setCountryRestrictType($this->country_restrict_type);

		$copyObj->setCountryRestrictList($this->country_restrict_list);

		$copyObj->setKsRestrictPrivilege($this->ks_restrict_privilege);

		$copyObj->setPrvRestrictPrivilege($this->prv_restrict_privilege);

		$copyObj->setPrvRestrictLength($this->prv_restrict_length);

		$copyObj->setKdirRestrictType($this->kdir_restrict_type);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getentrys() as $relObj) {
				$copyObj->addentry($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new accessControlPeer();
		}
		return self::$peer;
	}

	
	public function initentrys()
	{
		if ($this->collentrys === null) {
			$this->collentrys = array();
		}
	}

	
	public function getentrys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
			   $this->collentrys = array();
			} else {

				$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				$this->collentrys = entryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
					$this->collentrys = entryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastentryCriteria = $criteria;
		return $this->collentrys;
	}

	
	public function countentrys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

		return entryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addentry(entry $l)
	{
		$this->collentrys[] = $l;
		$l->setaccessControl($this);
	}


	
	public function getentrysJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}


	
	public function getentrysJoinkuser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinkuser($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinkuser($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}


	
	public function getentrysJoinconversionProfile2($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinconversionProfile2($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinconversionProfile2($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}

} 