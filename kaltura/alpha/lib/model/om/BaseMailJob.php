<?php


abstract class BaseMailJob extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $mail_type;


	
	protected $mail_priority;


	
	protected $recipient_name;


	
	protected $recipient_email;


	
	protected $recipient_id;


	
	protected $from_name;


	
	protected $from_email;


	
	protected $body_params;


	
	protected $subject_params;


	
	protected $template_path;


	
	protected $culture;


	
	protected $status;


	
	protected $created_at;


	
	protected $campaign_id;


	
	protected $min_send_date;

	
	protected $akuser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getMailType()
	{

		return $this->mail_type;
	}

	
	public function getMailPriority()
	{

		return $this->mail_priority;
	}

	
	public function getRecipientName()
	{

		return $this->recipient_name;
	}

	
	public function getRecipientEmail()
	{

		return $this->recipient_email;
	}

	
	public function getRecipientId()
	{

		return $this->recipient_id;
	}

	
	public function getFromName()
	{

		return $this->from_name;
	}

	
	public function getFromEmail()
	{

		return $this->from_email;
	}

	
	public function getBodyParams()
	{

		return $this->body_params;
	}

	
	public function getSubjectParams()
	{

		return $this->subject_params;
	}

	
	public function getTemplatePath()
	{

		return $this->template_path;
	}

	
	public function getCulture()
	{

		return $this->culture;
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

	
	public function getCampaignId()
	{

		return $this->campaign_id;
	}

	
	public function getMinSendDate($format = 'Y-m-d H:i:s')
	{

		if ($this->min_send_date === null || $this->min_send_date === '') {
			return null;
		} elseif (!is_int($this->min_send_date)) {
						$ts = strtotime($this->min_send_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [min_send_date] as date/time value: " . var_export($this->min_send_date, true));
			}
		} else {
			$ts = $this->min_send_date;
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
			$this->modifiedColumns[] = MailJobPeer::ID;
		}

	} 
	
	public function setMailType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mail_type !== $v) {
			$this->mail_type = $v;
			$this->modifiedColumns[] = MailJobPeer::MAIL_TYPE;
		}

	} 
	
	public function setMailPriority($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mail_priority !== $v) {
			$this->mail_priority = $v;
			$this->modifiedColumns[] = MailJobPeer::MAIL_PRIORITY;
		}

	} 
	
	public function setRecipientName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->recipient_name !== $v) {
			$this->recipient_name = $v;
			$this->modifiedColumns[] = MailJobPeer::RECIPIENT_NAME;
		}

	} 
	
	public function setRecipientEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->recipient_email !== $v) {
			$this->recipient_email = $v;
			$this->modifiedColumns[] = MailJobPeer::RECIPIENT_EMAIL;
		}

	} 
	
	public function setRecipientId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recipient_id !== $v) {
			$this->recipient_id = $v;
			$this->modifiedColumns[] = MailJobPeer::RECIPIENT_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setFromName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->from_name !== $v) {
			$this->from_name = $v;
			$this->modifiedColumns[] = MailJobPeer::FROM_NAME;
		}

	} 
	
	public function setFromEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->from_email !== $v) {
			$this->from_email = $v;
			$this->modifiedColumns[] = MailJobPeer::FROM_EMAIL;
		}

	} 
	
	public function setBodyParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body_params !== $v) {
			$this->body_params = $v;
			$this->modifiedColumns[] = MailJobPeer::BODY_PARAMS;
		}

	} 
	
	public function setSubjectParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subject_params !== $v) {
			$this->subject_params = $v;
			$this->modifiedColumns[] = MailJobPeer::SUBJECT_PARAMS;
		}

	} 
	
	public function setTemplatePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->template_path !== $v) {
			$this->template_path = $v;
			$this->modifiedColumns[] = MailJobPeer::TEMPLATE_PATH;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = MailJobPeer::CULTURE;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = MailJobPeer::STATUS;
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
			$this->modifiedColumns[] = MailJobPeer::CREATED_AT;
		}

	} 
	
	public function setCampaignId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->campaign_id !== $v) {
			$this->campaign_id = $v;
			$this->modifiedColumns[] = MailJobPeer::CAMPAIGN_ID;
		}

	} 
	
	public function setMinSendDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [min_send_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->min_send_date !== $ts) {
			$this->min_send_date = $ts;
			$this->modifiedColumns[] = MailJobPeer::MIN_SEND_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->mail_type = $rs->getInt($startcol + 1);

			$this->mail_priority = $rs->getInt($startcol + 2);

			$this->recipient_name = $rs->getString($startcol + 3);

			$this->recipient_email = $rs->getString($startcol + 4);

			$this->recipient_id = $rs->getInt($startcol + 5);

			$this->from_name = $rs->getString($startcol + 6);

			$this->from_email = $rs->getString($startcol + 7);

			$this->body_params = $rs->getString($startcol + 8);

			$this->subject_params = $rs->getString($startcol + 9);

			$this->template_path = $rs->getString($startcol + 10);

			$this->culture = $rs->getInt($startcol + 11);

			$this->status = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->campaign_id = $rs->getInt($startcol + 14);

			$this->min_send_date = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating MailJob object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MailJobPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MailJobPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MailJobPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MailJobPeer::DATABASE_NAME);
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
					$pk = MailJobPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MailJobPeer::doUpdate($this, $con);
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


			if (($retval = MailJobPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MailJobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getMailType();
				break;
			case 2:
				return $this->getMailPriority();
				break;
			case 3:
				return $this->getRecipientName();
				break;
			case 4:
				return $this->getRecipientEmail();
				break;
			case 5:
				return $this->getRecipientId();
				break;
			case 6:
				return $this->getFromName();
				break;
			case 7:
				return $this->getFromEmail();
				break;
			case 8:
				return $this->getBodyParams();
				break;
			case 9:
				return $this->getSubjectParams();
				break;
			case 10:
				return $this->getTemplatePath();
				break;
			case 11:
				return $this->getCulture();
				break;
			case 12:
				return $this->getStatus();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getCampaignId();
				break;
			case 15:
				return $this->getMinSendDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MailJobPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMailType(),
			$keys[2] => $this->getMailPriority(),
			$keys[3] => $this->getRecipientName(),
			$keys[4] => $this->getRecipientEmail(),
			$keys[5] => $this->getRecipientId(),
			$keys[6] => $this->getFromName(),
			$keys[7] => $this->getFromEmail(),
			$keys[8] => $this->getBodyParams(),
			$keys[9] => $this->getSubjectParams(),
			$keys[10] => $this->getTemplatePath(),
			$keys[11] => $this->getCulture(),
			$keys[12] => $this->getStatus(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getCampaignId(),
			$keys[15] => $this->getMinSendDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MailJobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setMailType($value);
				break;
			case 2:
				$this->setMailPriority($value);
				break;
			case 3:
				$this->setRecipientName($value);
				break;
			case 4:
				$this->setRecipientEmail($value);
				break;
			case 5:
				$this->setRecipientId($value);
				break;
			case 6:
				$this->setFromName($value);
				break;
			case 7:
				$this->setFromEmail($value);
				break;
			case 8:
				$this->setBodyParams($value);
				break;
			case 9:
				$this->setSubjectParams($value);
				break;
			case 10:
				$this->setTemplatePath($value);
				break;
			case 11:
				$this->setCulture($value);
				break;
			case 12:
				$this->setStatus($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setCampaignId($value);
				break;
			case 15:
				$this->setMinSendDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MailJobPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMailType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMailPriority($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRecipientName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRecipientEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRecipientId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFromName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setFromEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBodyParams($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSubjectParams($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTemplatePath($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCulture($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStatus($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCampaignId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setMinSendDate($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MailJobPeer::DATABASE_NAME);

		if ($this->isColumnModified(MailJobPeer::ID)) $criteria->add(MailJobPeer::ID, $this->id);
		if ($this->isColumnModified(MailJobPeer::MAIL_TYPE)) $criteria->add(MailJobPeer::MAIL_TYPE, $this->mail_type);
		if ($this->isColumnModified(MailJobPeer::MAIL_PRIORITY)) $criteria->add(MailJobPeer::MAIL_PRIORITY, $this->mail_priority);
		if ($this->isColumnModified(MailJobPeer::RECIPIENT_NAME)) $criteria->add(MailJobPeer::RECIPIENT_NAME, $this->recipient_name);
		if ($this->isColumnModified(MailJobPeer::RECIPIENT_EMAIL)) $criteria->add(MailJobPeer::RECIPIENT_EMAIL, $this->recipient_email);
		if ($this->isColumnModified(MailJobPeer::RECIPIENT_ID)) $criteria->add(MailJobPeer::RECIPIENT_ID, $this->recipient_id);
		if ($this->isColumnModified(MailJobPeer::FROM_NAME)) $criteria->add(MailJobPeer::FROM_NAME, $this->from_name);
		if ($this->isColumnModified(MailJobPeer::FROM_EMAIL)) $criteria->add(MailJobPeer::FROM_EMAIL, $this->from_email);
		if ($this->isColumnModified(MailJobPeer::BODY_PARAMS)) $criteria->add(MailJobPeer::BODY_PARAMS, $this->body_params);
		if ($this->isColumnModified(MailJobPeer::SUBJECT_PARAMS)) $criteria->add(MailJobPeer::SUBJECT_PARAMS, $this->subject_params);
		if ($this->isColumnModified(MailJobPeer::TEMPLATE_PATH)) $criteria->add(MailJobPeer::TEMPLATE_PATH, $this->template_path);
		if ($this->isColumnModified(MailJobPeer::CULTURE)) $criteria->add(MailJobPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(MailJobPeer::STATUS)) $criteria->add(MailJobPeer::STATUS, $this->status);
		if ($this->isColumnModified(MailJobPeer::CREATED_AT)) $criteria->add(MailJobPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MailJobPeer::CAMPAIGN_ID)) $criteria->add(MailJobPeer::CAMPAIGN_ID, $this->campaign_id);
		if ($this->isColumnModified(MailJobPeer::MIN_SEND_DATE)) $criteria->add(MailJobPeer::MIN_SEND_DATE, $this->min_send_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MailJobPeer::DATABASE_NAME);

		$criteria->add(MailJobPeer::ID, $this->id);

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

		$copyObj->setMailType($this->mail_type);

		$copyObj->setMailPriority($this->mail_priority);

		$copyObj->setRecipientName($this->recipient_name);

		$copyObj->setRecipientEmail($this->recipient_email);

		$copyObj->setRecipientId($this->recipient_id);

		$copyObj->setFromName($this->from_name);

		$copyObj->setFromEmail($this->from_email);

		$copyObj->setBodyParams($this->body_params);

		$copyObj->setSubjectParams($this->subject_params);

		$copyObj->setTemplatePath($this->template_path);

		$copyObj->setCulture($this->culture);

		$copyObj->setStatus($this->status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setCampaignId($this->campaign_id);

		$copyObj->setMinSendDate($this->min_send_date);


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
			self::$peer = new MailJobPeer();
		}
		return self::$peer;
	}

	
	public function setkuser($v)
	{


		if ($v === null) {
			$this->setRecipientId(NULL);
		} else {
			$this->setRecipientId($v->getId());
		}


		$this->akuser = $v;
	}


	
	public function getkuser($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuser === null && ($this->recipient_id !== null)) {

			$this->akuser = kuserPeer::retrieveByPK($this->recipient_id, $con);

			
		}
		return $this->akuser;
	}

} 