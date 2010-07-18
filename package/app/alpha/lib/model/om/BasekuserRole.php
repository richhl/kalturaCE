<?php


abstract class BasekuserRole extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kshow_id;


	
	protected $kuser_id;


	
	protected $role;

	
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

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getRole()
	{

		return $this->role;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = kuserRolePeer::ID;
		}

	} 
	
	public function setKshowId($v)
	{

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = kuserRolePeer::KSHOW_ID;
		}

	} 
	
	public function setKuserId($v)
	{

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = kuserRolePeer::KUSER_ID;
		}

	} 
	
	public function setRole($v)
	{

		if ($this->role !== $v) {
			$this->role = $v;
			$this->modifiedColumns[] = kuserRolePeer::ROLE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->kshow_id = $rs->getInt($startcol + 1);

			$this->kuser_id = $rs->getInt($startcol + 2);

			$this->role = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating kuserRole object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kuserRolePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			kuserRolePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(kuserRolePeer::DATABASE_NAME);
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
					$pk = kuserRolePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += kuserRolePeer::doUpdate($this, $con);
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


			if (($retval = kuserRolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = kuserRolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getKuserId();
				break;
			case 3:
				return $this->getRole();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kuserRolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKshowId(),
			$keys[2] => $this->getKuserId(),
			$keys[3] => $this->getRole(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = kuserRolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setKuserId($value);
				break;
			case 3:
				$this->setRole($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kuserRolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKshowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKuserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRole($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(kuserRolePeer::DATABASE_NAME);

		if ($this->isColumnModified(kuserRolePeer::ID)) $criteria->add(kuserRolePeer::ID, $this->id);
		if ($this->isColumnModified(kuserRolePeer::KSHOW_ID)) $criteria->add(kuserRolePeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(kuserRolePeer::KUSER_ID)) $criteria->add(kuserRolePeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(kuserRolePeer::ROLE)) $criteria->add(kuserRolePeer::ROLE, $this->role);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(kuserRolePeer::DATABASE_NAME);

		$criteria->add(kuserRolePeer::ID, $this->id);

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

		$copyObj->setKuserId($this->kuser_id);

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
			self::$peer = new kuserRolePeer();
		}
		return self::$peer;
	}

} 