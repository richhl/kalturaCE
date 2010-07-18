<?php


abstract class BasePuserKuser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $puser_id;


	
	protected $kuser_id;


	
	protected $puser_name;


	
	protected $custom_data;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $context;


	
	protected $subp_id = 0;

	
	protected $akuser;

	
	protected $collPuserRolesRelatedByPartnerId;

	
	protected $lastPuserRoleRelatedByPartnerIdCriteria = null;

	
	protected $collPuserRolesRelatedByPuserId;

	
	protected $lastPuserRoleRelatedByPuserIdCriteria = null;

	
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

	
	public function getPuserId()
	{

		return $this->puser_id;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getPuserName()
	{

		return $this->puser_name;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
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

	
	public function getContext()
	{

		return $this->context;
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
			$this->modifiedColumns[] = PuserKuserPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = PuserKuserPeer::PARTNER_ID;
		}

	} 
	
	public function setPuserId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->puser_id !== $v) {
			$this->puser_id = $v;
			$this->modifiedColumns[] = PuserKuserPeer::PUSER_ID;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = PuserKuserPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setPuserName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->puser_name !== $v) {
			$this->puser_name = $v;
			$this->modifiedColumns[] = PuserKuserPeer::PUSER_NAME;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = PuserKuserPeer::CUSTOM_DATA;
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
			$this->modifiedColumns[] = PuserKuserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PuserKuserPeer::UPDATED_AT;
		}

	} 
	
	public function setContext($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->context !== $v) {
			$this->context = $v;
			$this->modifiedColumns[] = PuserKuserPeer::CONTEXT;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = PuserKuserPeer::SUBP_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->puser_id = $rs->getString($startcol + 2);

			$this->kuser_id = $rs->getInt($startcol + 3);

			$this->puser_name = $rs->getString($startcol + 4);

			$this->custom_data = $rs->getString($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->context = $rs->getString($startcol + 8);

			$this->subp_id = $rs->getInt($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PuserKuser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PuserKuserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PuserKuserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PuserKuserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PuserKuserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PuserKuserPeer::DATABASE_NAME);
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
					$pk = PuserKuserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PuserKuserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPuserRolesRelatedByPartnerId !== null) {
				foreach($this->collPuserRolesRelatedByPartnerId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPuserRolesRelatedByPuserId !== null) {
				foreach($this->collPuserRolesRelatedByPuserId as $referrerFK) {
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


												
			if ($this->akuser !== null) {
				if (!$this->akuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuser->getValidationFailures());
				}
			}


			if (($retval = PuserKuserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPuserRolesRelatedByPartnerId !== null) {
					foreach($this->collPuserRolesRelatedByPartnerId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPuserRolesRelatedByPuserId !== null) {
					foreach($this->collPuserRolesRelatedByPuserId as $referrerFK) {
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
		$pos = PuserKuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPuserId();
				break;
			case 3:
				return $this->getKuserId();
				break;
			case 4:
				return $this->getPuserName();
				break;
			case 5:
				return $this->getCustomData();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			case 8:
				return $this->getContext();
				break;
			case 9:
				return $this->getSubpId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PuserKuserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getPuserId(),
			$keys[3] => $this->getKuserId(),
			$keys[4] => $this->getPuserName(),
			$keys[5] => $this->getCustomData(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
			$keys[8] => $this->getContext(),
			$keys[9] => $this->getSubpId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PuserKuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPuserId($value);
				break;
			case 3:
				$this->setKuserId($value);
				break;
			case 4:
				$this->setPuserName($value);
				break;
			case 5:
				$this->setCustomData($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
			case 8:
				$this->setContext($value);
				break;
			case 9:
				$this->setSubpId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PuserKuserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPuserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setKuserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPuserName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCustomData($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setContext($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSubpId($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PuserKuserPeer::DATABASE_NAME);

		if ($this->isColumnModified(PuserKuserPeer::ID)) $criteria->add(PuserKuserPeer::ID, $this->id);
		if ($this->isColumnModified(PuserKuserPeer::PARTNER_ID)) $criteria->add(PuserKuserPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(PuserKuserPeer::PUSER_ID)) $criteria->add(PuserKuserPeer::PUSER_ID, $this->puser_id);
		if ($this->isColumnModified(PuserKuserPeer::KUSER_ID)) $criteria->add(PuserKuserPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(PuserKuserPeer::PUSER_NAME)) $criteria->add(PuserKuserPeer::PUSER_NAME, $this->puser_name);
		if ($this->isColumnModified(PuserKuserPeer::CUSTOM_DATA)) $criteria->add(PuserKuserPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(PuserKuserPeer::CREATED_AT)) $criteria->add(PuserKuserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PuserKuserPeer::UPDATED_AT)) $criteria->add(PuserKuserPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(PuserKuserPeer::CONTEXT)) $criteria->add(PuserKuserPeer::CONTEXT, $this->context);
		if ($this->isColumnModified(PuserKuserPeer::SUBP_ID)) $criteria->add(PuserKuserPeer::SUBP_ID, $this->subp_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PuserKuserPeer::DATABASE_NAME);

		$criteria->add(PuserKuserPeer::ID, $this->id);

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

		$copyObj->setPuserId($this->puser_id);

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setPuserName($this->puser_name);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setContext($this->context);

		$copyObj->setSubpId($this->subp_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPuserRolesRelatedByPartnerId() as $relObj) {
				$copyObj->addPuserRoleRelatedByPartnerId($relObj->copy($deepCopy));
			}

			foreach($this->getPuserRolesRelatedByPuserId() as $relObj) {
				$copyObj->addPuserRoleRelatedByPuserId($relObj->copy($deepCopy));
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
			self::$peer = new PuserKuserPeer();
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

	
	public function initPuserRolesRelatedByPartnerId()
	{
		if ($this->collPuserRolesRelatedByPartnerId === null) {
			$this->collPuserRolesRelatedByPartnerId = array();
		}
	}

	
	public function getPuserRolesRelatedByPartnerId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRolesRelatedByPartnerId === null) {
			if ($this->isNew()) {
			   $this->collPuserRolesRelatedByPartnerId = array();
			} else {

				$criteria->add(PuserRolePeer::PARTNER_ID, $this->getPartnerId());

				PuserRolePeer::addSelectColumns($criteria);
				$this->collPuserRolesRelatedByPartnerId = PuserRolePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PuserRolePeer::PARTNER_ID, $this->getPartnerId());

				PuserRolePeer::addSelectColumns($criteria);
				if (!isset($this->lastPuserRoleRelatedByPartnerIdCriteria) || !$this->lastPuserRoleRelatedByPartnerIdCriteria->equals($criteria)) {
					$this->collPuserRolesRelatedByPartnerId = PuserRolePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPuserRoleRelatedByPartnerIdCriteria = $criteria;
		return $this->collPuserRolesRelatedByPartnerId;
	}

	
	public function countPuserRolesRelatedByPartnerId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PuserRolePeer::PARTNER_ID, $this->getPartnerId());

		return PuserRolePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPuserRoleRelatedByPartnerId(PuserRole $l)
	{
		$this->collPuserRolesRelatedByPartnerId[] = $l;
		$l->setPuserKuserRelatedByPartnerId($this);
	}


	
	public function getPuserRolesRelatedByPartnerIdJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRolesRelatedByPartnerId === null) {
			if ($this->isNew()) {
				$this->collPuserRolesRelatedByPartnerId = array();
			} else {

				$criteria->add(PuserRolePeer::PARTNER_ID, $this->getPartnerId());

				$this->collPuserRolesRelatedByPartnerId = PuserRolePeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(PuserRolePeer::PARTNER_ID, $this->getPartnerId());

			if (!isset($this->lastPuserRoleRelatedByPartnerIdCriteria) || !$this->lastPuserRoleRelatedByPartnerIdCriteria->equals($criteria)) {
				$this->collPuserRolesRelatedByPartnerId = PuserRolePeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastPuserRoleRelatedByPartnerIdCriteria = $criteria;

		return $this->collPuserRolesRelatedByPartnerId;
	}

	
	public function initPuserRolesRelatedByPuserId()
	{
		if ($this->collPuserRolesRelatedByPuserId === null) {
			$this->collPuserRolesRelatedByPuserId = array();
		}
	}

	
	public function getPuserRolesRelatedByPuserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRolesRelatedByPuserId === null) {
			if ($this->isNew()) {
			   $this->collPuserRolesRelatedByPuserId = array();
			} else {

				$criteria->add(PuserRolePeer::PUSER_ID, $this->getPuserId());

				PuserRolePeer::addSelectColumns($criteria);
				$this->collPuserRolesRelatedByPuserId = PuserRolePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PuserRolePeer::PUSER_ID, $this->getPuserId());

				PuserRolePeer::addSelectColumns($criteria);
				if (!isset($this->lastPuserRoleRelatedByPuserIdCriteria) || !$this->lastPuserRoleRelatedByPuserIdCriteria->equals($criteria)) {
					$this->collPuserRolesRelatedByPuserId = PuserRolePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPuserRoleRelatedByPuserIdCriteria = $criteria;
		return $this->collPuserRolesRelatedByPuserId;
	}

	
	public function countPuserRolesRelatedByPuserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PuserRolePeer::PUSER_ID, $this->getPuserId());

		return PuserRolePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPuserRoleRelatedByPuserId(PuserRole $l)
	{
		$this->collPuserRolesRelatedByPuserId[] = $l;
		$l->setPuserKuserRelatedByPuserId($this);
	}


	
	public function getPuserRolesRelatedByPuserIdJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRolesRelatedByPuserId === null) {
			if ($this->isNew()) {
				$this->collPuserRolesRelatedByPuserId = array();
			} else {

				$criteria->add(PuserRolePeer::PUSER_ID, $this->getPuserId());

				$this->collPuserRolesRelatedByPuserId = PuserRolePeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(PuserRolePeer::PUSER_ID, $this->getPuserId());

			if (!isset($this->lastPuserRoleRelatedByPuserIdCriteria) || !$this->lastPuserRoleRelatedByPuserIdCriteria->equals($criteria)) {
				$this->collPuserRolesRelatedByPuserId = PuserRolePeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastPuserRoleRelatedByPuserIdCriteria = $criteria;

		return $this->collPuserRolesRelatedByPuserId;
	}

} 