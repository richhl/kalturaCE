<?php


abstract class Basealert extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kuser_id;


	
	protected $alert_type;


	
	protected $subject_id;


	
	protected $rule_type;

	
	protected $akuser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getAlertType()
	{

		return $this->alert_type;
	}

	
	public function getSubjectId()
	{

		return $this->subject_id;
	}

	
	public function getRuleType()
	{

		return $this->rule_type;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = alertPeer::ID;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = alertPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setAlertType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->alert_type !== $v) {
			$this->alert_type = $v;
			$this->modifiedColumns[] = alertPeer::ALERT_TYPE;
		}

	} 
	
	public function setSubjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subject_id !== $v) {
			$this->subject_id = $v;
			$this->modifiedColumns[] = alertPeer::SUBJECT_ID;
		}

	} 
	
	public function setRuleType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rule_type !== $v) {
			$this->rule_type = $v;
			$this->modifiedColumns[] = alertPeer::RULE_TYPE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->kuser_id = $rs->getInt($startcol + 1);

			$this->alert_type = $rs->getInt($startcol + 2);

			$this->subject_id = $rs->getInt($startcol + 3);

			$this->rule_type = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating alert object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(alertPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			alertPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(alertPeer::DATABASE_NAME);
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
					$pk = alertPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += alertPeer::doUpdate($this, $con);
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


			if (($retval = alertPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = alertPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKuserId();
				break;
			case 2:
				return $this->getAlertType();
				break;
			case 3:
				return $this->getSubjectId();
				break;
			case 4:
				return $this->getRuleType();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = alertPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKuserId(),
			$keys[2] => $this->getAlertType(),
			$keys[3] => $this->getSubjectId(),
			$keys[4] => $this->getRuleType(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = alertPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKuserId($value);
				break;
			case 2:
				$this->setAlertType($value);
				break;
			case 3:
				$this->setSubjectId($value);
				break;
			case 4:
				$this->setRuleType($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = alertPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKuserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlertType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSubjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRuleType($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(alertPeer::DATABASE_NAME);

		if ($this->isColumnModified(alertPeer::ID)) $criteria->add(alertPeer::ID, $this->id);
		if ($this->isColumnModified(alertPeer::KUSER_ID)) $criteria->add(alertPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(alertPeer::ALERT_TYPE)) $criteria->add(alertPeer::ALERT_TYPE, $this->alert_type);
		if ($this->isColumnModified(alertPeer::SUBJECT_ID)) $criteria->add(alertPeer::SUBJECT_ID, $this->subject_id);
		if ($this->isColumnModified(alertPeer::RULE_TYPE)) $criteria->add(alertPeer::RULE_TYPE, $this->rule_type);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(alertPeer::DATABASE_NAME);

		$criteria->add(alertPeer::ID, $this->id);

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

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setAlertType($this->alert_type);

		$copyObj->setSubjectId($this->subject_id);

		$copyObj->setRuleType($this->rule_type);


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
			self::$peer = new alertPeer();
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