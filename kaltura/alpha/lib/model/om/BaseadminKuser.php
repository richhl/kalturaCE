<?php


abstract class BaseadminKuser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $screen_name;


	
	protected $full_name;


	
	protected $email;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $picture;


	
	protected $icon;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partner_id;

	
	protected $aPartner;

	
	protected $colladminPermissions;

	
	protected $lastadminPermissionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getScreenName()
	{

		return $this->screen_name;
	}

	
	public function getFullName()
	{

		return $this->full_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getPicture()
	{

		return $this->picture;
	}

	
	public function getIcon()
	{

		return $this->icon;
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

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = adminKuserPeer::ID;
		}

	} 
	
	public function setScreenName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->screen_name !== $v) {
			$this->screen_name = $v;
			$this->modifiedColumns[] = adminKuserPeer::SCREEN_NAME;
		}

	} 
	
	public function setFullName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->full_name !== $v) {
			$this->full_name = $v;
			$this->modifiedColumns[] = adminKuserPeer::FULL_NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = adminKuserPeer::EMAIL;
		}

	} 
	
	public function setSha1Password($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = adminKuserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = adminKuserPeer::SALT;
		}

	} 
	
	public function setPicture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->picture !== $v) {
			$this->picture = $v;
			$this->modifiedColumns[] = adminKuserPeer::PICTURE;
		}

	} 
	
	public function setIcon($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->icon !== $v) {
			$this->icon = $v;
			$this->modifiedColumns[] = adminKuserPeer::ICON;
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
			$this->modifiedColumns[] = adminKuserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = adminKuserPeer::UPDATED_AT;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = adminKuserPeer::PARTNER_ID;
		}

		if ($this->aPartner !== null && $this->aPartner->getId() !== $v) {
			$this->aPartner = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->screen_name = $rs->getString($startcol + 1);

			$this->full_name = $rs->getString($startcol + 2);

			$this->email = $rs->getString($startcol + 3);

			$this->sha1_password = $rs->getString($startcol + 4);

			$this->salt = $rs->getString($startcol + 5);

			$this->picture = $rs->getString($startcol + 6);

			$this->icon = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->partner_id = $rs->getInt($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating adminKuser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(adminKuserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			adminKuserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(adminKuserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(adminKuserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(adminKuserPeer::DATABASE_NAME);
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


												
			if ($this->aPartner !== null) {
				if ($this->aPartner->isModified()) {
					$affectedRows += $this->aPartner->save($con);
				}
				$this->setPartner($this->aPartner);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = adminKuserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += adminKuserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->colladminPermissions !== null) {
				foreach($this->colladminPermissions as $referrerFK) {
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


												
			if ($this->aPartner !== null) {
				if (!$this->aPartner->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPartner->getValidationFailures());
				}
			}


			if (($retval = adminKuserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->colladminPermissions !== null) {
					foreach($this->colladminPermissions as $referrerFK) {
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
		$pos = adminKuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getScreenName();
				break;
			case 2:
				return $this->getFullName();
				break;
			case 3:
				return $this->getEmail();
				break;
			case 4:
				return $this->getSha1Password();
				break;
			case 5:
				return $this->getSalt();
				break;
			case 6:
				return $this->getPicture();
				break;
			case 7:
				return $this->getIcon();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			case 10:
				return $this->getPartnerId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = adminKuserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getScreenName(),
			$keys[2] => $this->getFullName(),
			$keys[3] => $this->getEmail(),
			$keys[4] => $this->getSha1Password(),
			$keys[5] => $this->getSalt(),
			$keys[6] => $this->getPicture(),
			$keys[7] => $this->getIcon(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
			$keys[10] => $this->getPartnerId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = adminKuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setScreenName($value);
				break;
			case 2:
				$this->setFullName($value);
				break;
			case 3:
				$this->setEmail($value);
				break;
			case 4:
				$this->setSha1Password($value);
				break;
			case 5:
				$this->setSalt($value);
				break;
			case 6:
				$this->setPicture($value);
				break;
			case 7:
				$this->setIcon($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
			case 10:
				$this->setPartnerId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = adminKuserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setScreenName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFullName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSha1Password($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSalt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPicture($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIcon($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPartnerId($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(adminKuserPeer::DATABASE_NAME);

		if ($this->isColumnModified(adminKuserPeer::ID)) $criteria->add(adminKuserPeer::ID, $this->id);
		if ($this->isColumnModified(adminKuserPeer::SCREEN_NAME)) $criteria->add(adminKuserPeer::SCREEN_NAME, $this->screen_name);
		if ($this->isColumnModified(adminKuserPeer::FULL_NAME)) $criteria->add(adminKuserPeer::FULL_NAME, $this->full_name);
		if ($this->isColumnModified(adminKuserPeer::EMAIL)) $criteria->add(adminKuserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(adminKuserPeer::SHA1_PASSWORD)) $criteria->add(adminKuserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(adminKuserPeer::SALT)) $criteria->add(adminKuserPeer::SALT, $this->salt);
		if ($this->isColumnModified(adminKuserPeer::PICTURE)) $criteria->add(adminKuserPeer::PICTURE, $this->picture);
		if ($this->isColumnModified(adminKuserPeer::ICON)) $criteria->add(adminKuserPeer::ICON, $this->icon);
		if ($this->isColumnModified(adminKuserPeer::CREATED_AT)) $criteria->add(adminKuserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(adminKuserPeer::UPDATED_AT)) $criteria->add(adminKuserPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(adminKuserPeer::PARTNER_ID)) $criteria->add(adminKuserPeer::PARTNER_ID, $this->partner_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(adminKuserPeer::DATABASE_NAME);

		$criteria->add(adminKuserPeer::ID, $this->id);

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

		$copyObj->setScreenName($this->screen_name);

		$copyObj->setFullName($this->full_name);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setPicture($this->picture);

		$copyObj->setIcon($this->icon);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPartnerId($this->partner_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getadminPermissions() as $relObj) {
				$copyObj->addadminPermission($relObj->copy($deepCopy));
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
			self::$peer = new adminKuserPeer();
		}
		return self::$peer;
	}

	
	public function setPartner($v)
	{


		if ($v === null) {
			$this->setPartnerId(NULL);
		} else {
			$this->setPartnerId($v->getId());
		}


		$this->aPartner = $v;
	}


	
	public function getPartner($con = null)
	{
				include_once 'lib/model/om/BasePartnerPeer.php';

		if ($this->aPartner === null && ($this->partner_id !== null)) {

			$this->aPartner = PartnerPeer::retrieveByPK($this->partner_id, $con);

			
		}
		return $this->aPartner;
	}

	
	public function initadminPermissions()
	{
		if ($this->colladminPermissions === null) {
			$this->colladminPermissions = array();
		}
	}

	
	public function getadminPermissions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseadminPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colladminPermissions === null) {
			if ($this->isNew()) {
			   $this->colladminPermissions = array();
			} else {

				$criteria->add(adminPermissionPeer::ADMIN_KUSER_ID, $this->getId());

				adminPermissionPeer::addSelectColumns($criteria);
				$this->colladminPermissions = adminPermissionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(adminPermissionPeer::ADMIN_KUSER_ID, $this->getId());

				adminPermissionPeer::addSelectColumns($criteria);
				if (!isset($this->lastadminPermissionCriteria) || !$this->lastadminPermissionCriteria->equals($criteria)) {
					$this->colladminPermissions = adminPermissionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastadminPermissionCriteria = $criteria;
		return $this->colladminPermissions;
	}

	
	public function countadminPermissions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseadminPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(adminPermissionPeer::ADMIN_KUSER_ID, $this->getId());

		return adminPermissionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addadminPermission(adminPermission $l)
	{
		$this->colladminPermissions[] = $l;
		$l->setadminKuser($this);
	}

} 