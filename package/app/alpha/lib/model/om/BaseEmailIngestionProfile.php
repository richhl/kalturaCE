<?php


abstract class BaseEmailIngestionProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name = '';


	
	protected $description;


	
	protected $email_address;


	
	protected $mailbox_id;


	
	protected $partner_id;


	
	protected $conversion_profile_2_id;


	
	protected $moderation_status;


	
	protected $custom_data;


	
	protected $status;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getEmailAddress()
	{

		return $this->email_address;
	}

	
	public function getMailboxId()
	{

		return $this->mailbox_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getConversionProfile2Id()
	{

		return $this->conversion_profile_2_id;
	}

	
	public function getModerationStatus()
	{

		return $this->moderation_status;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getStatus()
	{

		return $this->status;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::DESCRIPTION;
		}

	} 
	
	public function setEmailAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_address !== $v) {
			$this->email_address = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::EMAIL_ADDRESS;
		}

	} 
	
	public function setMailboxId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mailbox_id !== $v) {
			$this->mailbox_id = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::MAILBOX_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::PARTNER_ID;
		}

	} 
	
	public function setConversionProfile2Id($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->conversion_profile_2_id !== $v) {
			$this->conversion_profile_2_id = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::CONVERSION_PROFILE_2_ID;
		}

	} 
	
	public function setModerationStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->moderation_status !== $v) {
			$this->moderation_status = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::MODERATION_STATUS;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::CUSTOM_DATA;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = EmailIngestionProfilePeer::STATUS;
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
			$this->modifiedColumns[] = EmailIngestionProfilePeer::CREATED_AT;
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
			$this->modifiedColumns[] = EmailIngestionProfilePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->email_address = $rs->getString($startcol + 3);

			$this->mailbox_id = $rs->getString($startcol + 4);

			$this->partner_id = $rs->getInt($startcol + 5);

			$this->conversion_profile_2_id = $rs->getInt($startcol + 6);

			$this->moderation_status = $rs->getInt($startcol + 7);

			$this->custom_data = $rs->getString($startcol + 8);

			$this->status = $rs->getInt($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailIngestionProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailIngestionProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailIngestionProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EmailIngestionProfilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EmailIngestionProfilePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailIngestionProfilePeer::DATABASE_NAME);
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
					$pk = EmailIngestionProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailIngestionProfilePeer::doUpdate($this, $con);
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


			if (($retval = EmailIngestionProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailIngestionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getEmailAddress();
				break;
			case 4:
				return $this->getMailboxId();
				break;
			case 5:
				return $this->getPartnerId();
				break;
			case 6:
				return $this->getConversionProfile2Id();
				break;
			case 7:
				return $this->getModerationStatus();
				break;
			case 8:
				return $this->getCustomData();
				break;
			case 9:
				return $this->getStatus();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailIngestionProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getEmailAddress(),
			$keys[4] => $this->getMailboxId(),
			$keys[5] => $this->getPartnerId(),
			$keys[6] => $this->getConversionProfile2Id(),
			$keys[7] => $this->getModerationStatus(),
			$keys[8] => $this->getCustomData(),
			$keys[9] => $this->getStatus(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailIngestionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setEmailAddress($value);
				break;
			case 4:
				$this->setMailboxId($value);
				break;
			case 5:
				$this->setPartnerId($value);
				break;
			case 6:
				$this->setConversionProfile2Id($value);
				break;
			case 7:
				$this->setModerationStatus($value);
				break;
			case 8:
				$this->setCustomData($value);
				break;
			case 9:
				$this->setStatus($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailIngestionProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmailAddress($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMailboxId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPartnerId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setConversionProfile2Id($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setModerationStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCustomData($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailIngestionProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailIngestionProfilePeer::ID)) $criteria->add(EmailIngestionProfilePeer::ID, $this->id);
		if ($this->isColumnModified(EmailIngestionProfilePeer::NAME)) $criteria->add(EmailIngestionProfilePeer::NAME, $this->name);
		if ($this->isColumnModified(EmailIngestionProfilePeer::DESCRIPTION)) $criteria->add(EmailIngestionProfilePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EmailIngestionProfilePeer::EMAIL_ADDRESS)) $criteria->add(EmailIngestionProfilePeer::EMAIL_ADDRESS, $this->email_address);
		if ($this->isColumnModified(EmailIngestionProfilePeer::MAILBOX_ID)) $criteria->add(EmailIngestionProfilePeer::MAILBOX_ID, $this->mailbox_id);
		if ($this->isColumnModified(EmailIngestionProfilePeer::PARTNER_ID)) $criteria->add(EmailIngestionProfilePeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(EmailIngestionProfilePeer::CONVERSION_PROFILE_2_ID)) $criteria->add(EmailIngestionProfilePeer::CONVERSION_PROFILE_2_ID, $this->conversion_profile_2_id);
		if ($this->isColumnModified(EmailIngestionProfilePeer::MODERATION_STATUS)) $criteria->add(EmailIngestionProfilePeer::MODERATION_STATUS, $this->moderation_status);
		if ($this->isColumnModified(EmailIngestionProfilePeer::CUSTOM_DATA)) $criteria->add(EmailIngestionProfilePeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(EmailIngestionProfilePeer::STATUS)) $criteria->add(EmailIngestionProfilePeer::STATUS, $this->status);
		if ($this->isColumnModified(EmailIngestionProfilePeer::CREATED_AT)) $criteria->add(EmailIngestionProfilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EmailIngestionProfilePeer::UPDATED_AT)) $criteria->add(EmailIngestionProfilePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailIngestionProfilePeer::DATABASE_NAME);

		$criteria->add(EmailIngestionProfilePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setEmailAddress($this->email_address);

		$copyObj->setMailboxId($this->mailbox_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setConversionProfile2Id($this->conversion_profile_2_id);

		$copyObj->setModerationStatus($this->moderation_status);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setStatus($this->status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new EmailIngestionProfilePeer();
		}
		return self::$peer;
	}

} 