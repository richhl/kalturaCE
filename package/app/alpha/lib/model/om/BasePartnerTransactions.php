<?php


abstract class BasePartnerTransactions extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $created_at;


	
	protected $amount;


	
	protected $currency;


	
	protected $transaction_id;


	
	protected $timestamp;


	
	protected $correlation_id;


	
	protected $ack;


	
	protected $transaction_data;

	
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

	
	public function getAmount()
	{

		return $this->amount;
	}

	
	public function getCurrency()
	{

		return $this->currency;
	}

	
	public function getTransactionId()
	{

		return $this->transaction_id;
	}

	
	public function getTimestamp($format = 'Y-m-d H:i:s')
	{

		if ($this->timestamp === null || $this->timestamp === '') {
			return null;
		} elseif (!is_int($this->timestamp)) {
						$ts = strtotime($this->timestamp);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [timestamp] as date/time value: " . var_export($this->timestamp, true));
			}
		} else {
			$ts = $this->timestamp;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCorrelationId()
	{

		return $this->correlation_id;
	}

	
	public function getAck()
	{

		return $this->ack;
	}

	
	public function getTransactionData()
	{

		return $this->transaction_data;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::PARTNER_ID;
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
			$this->modifiedColumns[] = PartnerTransactionsPeer::CREATED_AT;
		}

	} 
	
	public function setAmount($v)
	{

		if ($this->amount !== $v) {
			$this->amount = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::AMOUNT;
		}

	} 
	
	public function setCurrency($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->currency !== $v) {
			$this->currency = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::CURRENCY;
		}

	} 
	
	public function setTransactionId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->transaction_id !== $v) {
			$this->transaction_id = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::TRANSACTION_ID;
		}

	} 
	
	public function setTimestamp($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [timestamp] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->timestamp !== $ts) {
			$this->timestamp = $ts;
			$this->modifiedColumns[] = PartnerTransactionsPeer::TIMESTAMP;
		}

	} 
	
	public function setCorrelationId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->correlation_id !== $v) {
			$this->correlation_id = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::CORRELATION_ID;
		}

	} 
	
	public function setAck($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ack !== $v) {
			$this->ack = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::ACK;
		}

	} 
	
	public function setTransactionData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->transaction_data !== $v) {
			$this->transaction_data = $v;
			$this->modifiedColumns[] = PartnerTransactionsPeer::TRANSACTION_DATA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->amount = $rs->getFloat($startcol + 3);

			$this->currency = $rs->getString($startcol + 4);

			$this->transaction_id = $rs->getString($startcol + 5);

			$this->timestamp = $rs->getTimestamp($startcol + 6, null);

			$this->correlation_id = $rs->getString($startcol + 7);

			$this->ack = $rs->getString($startcol + 8);

			$this->transaction_data = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PartnerTransactions object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerTransactionsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PartnerTransactionsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PartnerTransactionsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerTransactionsPeer::DATABASE_NAME);
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
					$pk = PartnerTransactionsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PartnerTransactionsPeer::doUpdate($this, $con);
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


			if (($retval = PartnerTransactionsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerTransactionsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getAmount();
				break;
			case 4:
				return $this->getCurrency();
				break;
			case 5:
				return $this->getTransactionId();
				break;
			case 6:
				return $this->getTimestamp();
				break;
			case 7:
				return $this->getCorrelationId();
				break;
			case 8:
				return $this->getAck();
				break;
			case 9:
				return $this->getTransactionData();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerTransactionsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getAmount(),
			$keys[4] => $this->getCurrency(),
			$keys[5] => $this->getTransactionId(),
			$keys[6] => $this->getTimestamp(),
			$keys[7] => $this->getCorrelationId(),
			$keys[8] => $this->getAck(),
			$keys[9] => $this->getTransactionData(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerTransactionsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setAmount($value);
				break;
			case 4:
				$this->setCurrency($value);
				break;
			case 5:
				$this->setTransactionId($value);
				break;
			case 6:
				$this->setTimestamp($value);
				break;
			case 7:
				$this->setCorrelationId($value);
				break;
			case 8:
				$this->setAck($value);
				break;
			case 9:
				$this->setTransactionData($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerTransactionsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAmount($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCurrency($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTransactionId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTimestamp($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCorrelationId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAck($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTransactionData($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PartnerTransactionsPeer::DATABASE_NAME);

		if ($this->isColumnModified(PartnerTransactionsPeer::ID)) $criteria->add(PartnerTransactionsPeer::ID, $this->id);
		if ($this->isColumnModified(PartnerTransactionsPeer::PARTNER_ID)) $criteria->add(PartnerTransactionsPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(PartnerTransactionsPeer::CREATED_AT)) $criteria->add(PartnerTransactionsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PartnerTransactionsPeer::AMOUNT)) $criteria->add(PartnerTransactionsPeer::AMOUNT, $this->amount);
		if ($this->isColumnModified(PartnerTransactionsPeer::CURRENCY)) $criteria->add(PartnerTransactionsPeer::CURRENCY, $this->currency);
		if ($this->isColumnModified(PartnerTransactionsPeer::TRANSACTION_ID)) $criteria->add(PartnerTransactionsPeer::TRANSACTION_ID, $this->transaction_id);
		if ($this->isColumnModified(PartnerTransactionsPeer::TIMESTAMP)) $criteria->add(PartnerTransactionsPeer::TIMESTAMP, $this->timestamp);
		if ($this->isColumnModified(PartnerTransactionsPeer::CORRELATION_ID)) $criteria->add(PartnerTransactionsPeer::CORRELATION_ID, $this->correlation_id);
		if ($this->isColumnModified(PartnerTransactionsPeer::ACK)) $criteria->add(PartnerTransactionsPeer::ACK, $this->ack);
		if ($this->isColumnModified(PartnerTransactionsPeer::TRANSACTION_DATA)) $criteria->add(PartnerTransactionsPeer::TRANSACTION_DATA, $this->transaction_data);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PartnerTransactionsPeer::DATABASE_NAME);

		$criteria->add(PartnerTransactionsPeer::ID, $this->id);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setAmount($this->amount);

		$copyObj->setCurrency($this->currency);

		$copyObj->setTransactionId($this->transaction_id);

		$copyObj->setTimestamp($this->timestamp);

		$copyObj->setCorrelationId($this->correlation_id);

		$copyObj->setAck($this->ack);

		$copyObj->setTransactionData($this->transaction_data);


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
			self::$peer = new PartnerTransactionsPeer();
		}
		return self::$peer;
	}

} 