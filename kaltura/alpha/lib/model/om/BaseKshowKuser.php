<?php


abstract class BaseKshowKuser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $kshow_id;


	
	protected $kuser_id;


	
	protected $subscription_type;


	
	protected $alert_type;


	
	protected $id;

	
	protected $akshow;

	
	protected $akuser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getKshowId()
	{

		return $this->kshow_id;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getSubscriptionType()
	{

		return $this->subscription_type;
	}

	
	public function getAlertType()
	{

		return $this->alert_type;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = KshowKuserPeer::KSHOW_ID;
		}

		if ($this->akshow !== null && $this->akshow->getId() !== $v) {
			$this->akshow = null;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = KshowKuserPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setSubscriptionType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subscription_type !== $v) {
			$this->subscription_type = $v;
			$this->modifiedColumns[] = KshowKuserPeer::SUBSCRIPTION_TYPE;
		}

	} 
	
	public function setAlertType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->alert_type !== $v) {
			$this->alert_type = $v;
			$this->modifiedColumns[] = KshowKuserPeer::ALERT_TYPE;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = KshowKuserPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->kshow_id = $rs->getString($startcol + 0);

			$this->kuser_id = $rs->getInt($startcol + 1);

			$this->subscription_type = $rs->getInt($startcol + 2);

			$this->alert_type = $rs->getInt($startcol + 3);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating KshowKuser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KshowKuserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			KshowKuserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(KshowKuserPeer::DATABASE_NAME);
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

			if ($this->akuser !== null) {
				if ($this->akuser->isModified()) {
					$affectedRows += $this->akuser->save($con);
				}
				$this->setkuser($this->akuser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = KshowKuserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += KshowKuserPeer::doUpdate($this, $con);
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

			if ($this->akuser !== null) {
				if (!$this->akuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuser->getValidationFailures());
				}
			}


			if (($retval = KshowKuserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KshowKuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getKshowId();
				break;
			case 1:
				return $this->getKuserId();
				break;
			case 2:
				return $this->getSubscriptionType();
				break;
			case 3:
				return $this->getAlertType();
				break;
			case 4:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KshowKuserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKshowId(),
			$keys[1] => $this->getKuserId(),
			$keys[2] => $this->getSubscriptionType(),
			$keys[3] => $this->getAlertType(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KshowKuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setKshowId($value);
				break;
			case 1:
				$this->setKuserId($value);
				break;
			case 2:
				$this->setSubscriptionType($value);
				break;
			case 3:
				$this->setAlertType($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KshowKuserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKshowId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKuserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSubscriptionType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlertType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(KshowKuserPeer::DATABASE_NAME);

		if ($this->isColumnModified(KshowKuserPeer::KSHOW_ID)) $criteria->add(KshowKuserPeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(KshowKuserPeer::KUSER_ID)) $criteria->add(KshowKuserPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(KshowKuserPeer::SUBSCRIPTION_TYPE)) $criteria->add(KshowKuserPeer::SUBSCRIPTION_TYPE, $this->subscription_type);
		if ($this->isColumnModified(KshowKuserPeer::ALERT_TYPE)) $criteria->add(KshowKuserPeer::ALERT_TYPE, $this->alert_type);
		if ($this->isColumnModified(KshowKuserPeer::ID)) $criteria->add(KshowKuserPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KshowKuserPeer::DATABASE_NAME);

		$criteria->add(KshowKuserPeer::ID, $this->id);

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

		$copyObj->setSubscriptionType($this->subscription_type);

		$copyObj->setAlertType($this->alert_type);


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
			self::$peer = new KshowKuserPeer();
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