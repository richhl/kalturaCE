<?php


abstract class BaseadminPermission extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $groups;


	
	protected $admin_kuser_id;

	
	protected $aadminKuser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getGroups()
	{

		return $this->groups;
	}

	
	public function getAdminKuserId()
	{

		return $this->admin_kuser_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = adminPermissionPeer::ID;
		}

	} 
	
	public function setGroups($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->groups !== $v) {
			$this->groups = $v;
			$this->modifiedColumns[] = adminPermissionPeer::GROUPS;
		}

	} 
	
	public function setAdminKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->admin_kuser_id !== $v) {
			$this->admin_kuser_id = $v;
			$this->modifiedColumns[] = adminPermissionPeer::ADMIN_KUSER_ID;
		}

		if ($this->aadminKuser !== null && $this->aadminKuser->getId() !== $v) {
			$this->aadminKuser = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->groups = $rs->getString($startcol + 1);

			$this->admin_kuser_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating adminPermission object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(adminPermissionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			adminPermissionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(adminPermissionPeer::DATABASE_NAME);
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


												
			if ($this->aadminKuser !== null) {
				if ($this->aadminKuser->isModified()) {
					$affectedRows += $this->aadminKuser->save($con);
				}
				$this->setadminKuser($this->aadminKuser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = adminPermissionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += adminPermissionPeer::doUpdate($this, $con);
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


												
			if ($this->aadminKuser !== null) {
				if (!$this->aadminKuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aadminKuser->getValidationFailures());
				}
			}


			if (($retval = adminPermissionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = adminPermissionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getGroups();
				break;
			case 2:
				return $this->getAdminKuserId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = adminPermissionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGroups(),
			$keys[2] => $this->getAdminKuserId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = adminPermissionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setGroups($value);
				break;
			case 2:
				$this->setAdminKuserId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = adminPermissionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGroups($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAdminKuserId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(adminPermissionPeer::DATABASE_NAME);

		if ($this->isColumnModified(adminPermissionPeer::ID)) $criteria->add(adminPermissionPeer::ID, $this->id);
		if ($this->isColumnModified(adminPermissionPeer::GROUPS)) $criteria->add(adminPermissionPeer::GROUPS, $this->groups);
		if ($this->isColumnModified(adminPermissionPeer::ADMIN_KUSER_ID)) $criteria->add(adminPermissionPeer::ADMIN_KUSER_ID, $this->admin_kuser_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(adminPermissionPeer::DATABASE_NAME);

		$criteria->add(adminPermissionPeer::ID, $this->id);

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

		$copyObj->setGroups($this->groups);

		$copyObj->setAdminKuserId($this->admin_kuser_id);


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
			self::$peer = new adminPermissionPeer();
		}
		return self::$peer;
	}

	
	public function setadminKuser($v)
	{


		if ($v === null) {
			$this->setAdminKuserId(NULL);
		} else {
			$this->setAdminKuserId($v->getId());
		}


		$this->aadminKuser = $v;
	}


	
	public function getadminKuser($con = null)
	{
				include_once 'lib/model/om/BaseadminKuserPeer.php';

		if ($this->aadminKuser === null && ($this->admin_kuser_id !== null)) {

			$this->aadminKuser = adminKuserPeer::retrieveByPK($this->admin_kuser_id, $con);

			
		}
		return $this->aadminKuser;
	}

} 