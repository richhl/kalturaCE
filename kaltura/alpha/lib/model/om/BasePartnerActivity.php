<?php


abstract class BasePartnerActivity extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $activity_date;


	
	protected $activity;


	
	protected $sub_activity;


	
	protected $amount;


	
	protected $amount1;


	
	protected $amount2;


	
	protected $amount3;


	
	protected $amount4;


	
	protected $amount5;


	
	protected $amount6;


	
	protected $amount7;


	
	protected $amount9;

	
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

	
	public function getActivityDate()
	{

		return $this->activity_date;
	}

	
	public function getActivity()
	{

		return $this->activity;
	}

	
	public function getSubActivity()
	{

		return $this->sub_activity;
	}

	
	public function getAmount()
	{

		return $this->amount;
	}

	
	public function getAmount1()
	{

		return $this->amount1;
	}

	
	public function getAmount2()
	{

		return $this->amount2;
	}

	
	public function getAmount3()
	{

		return $this->amount3;
	}

	
	public function getAmount4()
	{

		return $this->amount4;
	}

	
	public function getAmount5()
	{

		return $this->amount5;
	}

	
	public function getAmount6()
	{

		return $this->amount6;
	}

	
	public function getAmount7()
	{

		return $this->amount7;
	}

	
	public function getAmount9()
	{

		return $this->amount9;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::PARTNER_ID;
		}

	} 
	
	public function setActivityDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->activity_date !== $v) {
			$this->activity_date = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::ACTIVITY_DATE;
		}

	} 
	
	public function setActivity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->activity !== $v) {
			$this->activity = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::ACTIVITY;
		}

	} 
	
	public function setSubActivity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sub_activity !== $v) {
			$this->sub_activity = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::SUB_ACTIVITY;
		}

	} 
	
	public function setAmount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount !== $v) {
			$this->amount = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT;
		}

	} 
	
	public function setAmount1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount1 !== $v) {
			$this->amount1 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT1;
		}

	} 
	
	public function setAmount2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount2 !== $v) {
			$this->amount2 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT2;
		}

	} 
	
	public function setAmount3($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount3 !== $v) {
			$this->amount3 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT3;
		}

	} 
	
	public function setAmount4($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount4 !== $v) {
			$this->amount4 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT4;
		}

	} 
	
	public function setAmount5($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount5 !== $v) {
			$this->amount5 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT5;
		}

	} 
	
	public function setAmount6($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount6 !== $v) {
			$this->amount6 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT6;
		}

	} 
	
	public function setAmount7($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount7 !== $v) {
			$this->amount7 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT7;
		}

	} 
	
	public function setAmount9($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->amount9 !== $v) {
			$this->amount9 = $v;
			$this->modifiedColumns[] = PartnerActivityPeer::AMOUNT9;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->activity_date = $rs->getString($startcol + 2);

			$this->activity = $rs->getInt($startcol + 3);

			$this->sub_activity = $rs->getInt($startcol + 4);

			$this->amount = $rs->getInt($startcol + 5);

			$this->amount1 = $rs->getInt($startcol + 6);

			$this->amount2 = $rs->getInt($startcol + 7);

			$this->amount3 = $rs->getInt($startcol + 8);

			$this->amount4 = $rs->getInt($startcol + 9);

			$this->amount5 = $rs->getInt($startcol + 10);

			$this->amount6 = $rs->getInt($startcol + 11);

			$this->amount7 = $rs->getInt($startcol + 12);

			$this->amount9 = $rs->getInt($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PartnerActivity object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerActivityPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PartnerActivityPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PartnerActivityPeer::DATABASE_NAME);
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
					$pk = PartnerActivityPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PartnerActivityPeer::doUpdate($this, $con);
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


			if (($retval = PartnerActivityPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerActivityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getActivityDate();
				break;
			case 3:
				return $this->getActivity();
				break;
			case 4:
				return $this->getSubActivity();
				break;
			case 5:
				return $this->getAmount();
				break;
			case 6:
				return $this->getAmount1();
				break;
			case 7:
				return $this->getAmount2();
				break;
			case 8:
				return $this->getAmount3();
				break;
			case 9:
				return $this->getAmount4();
				break;
			case 10:
				return $this->getAmount5();
				break;
			case 11:
				return $this->getAmount6();
				break;
			case 12:
				return $this->getAmount7();
				break;
			case 13:
				return $this->getAmount9();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerActivityPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getActivityDate(),
			$keys[3] => $this->getActivity(),
			$keys[4] => $this->getSubActivity(),
			$keys[5] => $this->getAmount(),
			$keys[6] => $this->getAmount1(),
			$keys[7] => $this->getAmount2(),
			$keys[8] => $this->getAmount3(),
			$keys[9] => $this->getAmount4(),
			$keys[10] => $this->getAmount5(),
			$keys[11] => $this->getAmount6(),
			$keys[12] => $this->getAmount7(),
			$keys[13] => $this->getAmount9(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerActivityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setActivityDate($value);
				break;
			case 3:
				$this->setActivity($value);
				break;
			case 4:
				$this->setSubActivity($value);
				break;
			case 5:
				$this->setAmount($value);
				break;
			case 6:
				$this->setAmount1($value);
				break;
			case 7:
				$this->setAmount2($value);
				break;
			case 8:
				$this->setAmount3($value);
				break;
			case 9:
				$this->setAmount4($value);
				break;
			case 10:
				$this->setAmount5($value);
				break;
			case 11:
				$this->setAmount6($value);
				break;
			case 12:
				$this->setAmount7($value);
				break;
			case 13:
				$this->setAmount9($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerActivityPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setActivityDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setActivity($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSubActivity($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAmount($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAmount1($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAmount2($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAmount3($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAmount4($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setAmount5($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setAmount6($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setAmount7($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAmount9($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PartnerActivityPeer::DATABASE_NAME);

		if ($this->isColumnModified(PartnerActivityPeer::ID)) $criteria->add(PartnerActivityPeer::ID, $this->id);
		if ($this->isColumnModified(PartnerActivityPeer::PARTNER_ID)) $criteria->add(PartnerActivityPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(PartnerActivityPeer::ACTIVITY_DATE)) $criteria->add(PartnerActivityPeer::ACTIVITY_DATE, $this->activity_date);
		if ($this->isColumnModified(PartnerActivityPeer::ACTIVITY)) $criteria->add(PartnerActivityPeer::ACTIVITY, $this->activity);
		if ($this->isColumnModified(PartnerActivityPeer::SUB_ACTIVITY)) $criteria->add(PartnerActivityPeer::SUB_ACTIVITY, $this->sub_activity);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT)) $criteria->add(PartnerActivityPeer::AMOUNT, $this->amount);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT1)) $criteria->add(PartnerActivityPeer::AMOUNT1, $this->amount1);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT2)) $criteria->add(PartnerActivityPeer::AMOUNT2, $this->amount2);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT3)) $criteria->add(PartnerActivityPeer::AMOUNT3, $this->amount3);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT4)) $criteria->add(PartnerActivityPeer::AMOUNT4, $this->amount4);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT5)) $criteria->add(PartnerActivityPeer::AMOUNT5, $this->amount5);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT6)) $criteria->add(PartnerActivityPeer::AMOUNT6, $this->amount6);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT7)) $criteria->add(PartnerActivityPeer::AMOUNT7, $this->amount7);
		if ($this->isColumnModified(PartnerActivityPeer::AMOUNT9)) $criteria->add(PartnerActivityPeer::AMOUNT9, $this->amount9);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PartnerActivityPeer::DATABASE_NAME);

		$criteria->add(PartnerActivityPeer::ID, $this->id);

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

		$copyObj->setActivityDate($this->activity_date);

		$copyObj->setActivity($this->activity);

		$copyObj->setSubActivity($this->sub_activity);

		$copyObj->setAmount($this->amount);

		$copyObj->setAmount1($this->amount1);

		$copyObj->setAmount2($this->amount2);

		$copyObj->setAmount3($this->amount3);

		$copyObj->setAmount4($this->amount4);

		$copyObj->setAmount5($this->amount5);

		$copyObj->setAmount6($this->amount6);

		$copyObj->setAmount7($this->amount7);

		$copyObj->setAmount9($this->amount9);


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
			self::$peer = new PartnerActivityPeer();
		}
		return self::$peer;
	}

} 