<?php


abstract class BaseEmailCampaign extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $criteria_id;


	
	protected $criteria_str;


	
	protected $criteria_params;


	
	protected $template_path;


	
	protected $campaign_mgr_kuser_id;


	
	protected $send_count;


	
	protected $open_count;


	
	protected $click_count;


	
	protected $status;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $akuser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCriteriaId()
	{

		return $this->criteria_id;
	}

	
	public function getCriteriaStr()
	{

		return $this->criteria_str;
	}

	
	public function getCriteriaParams()
	{

		return $this->criteria_params;
	}

	
	public function getTemplatePath()
	{

		return $this->template_path;
	}

	
	public function getCampaignMgrKuserId()
	{

		return $this->campaign_mgr_kuser_id;
	}

	
	public function getSendCount()
	{

		return $this->send_count;
	}

	
	public function getOpenCount()
	{

		return $this->open_count;
	}

	
	public function getClickCount()
	{

		return $this->click_count;
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
			$this->modifiedColumns[] = EmailCampaignPeer::ID;
		}

	} 
	
	public function setCriteriaId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->criteria_id !== $v) {
			$this->criteria_id = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::CRITERIA_ID;
		}

	} 
	
	public function setCriteriaStr($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->criteria_str !== $v) {
			$this->criteria_str = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::CRITERIA_STR;
		}

	} 
	
	public function setCriteriaParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->criteria_params !== $v) {
			$this->criteria_params = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::CRITERIA_PARAMS;
		}

	} 
	
	public function setTemplatePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->template_path !== $v) {
			$this->template_path = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::TEMPLATE_PATH;
		}

	} 
	
	public function setCampaignMgrKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->campaign_mgr_kuser_id !== $v) {
			$this->campaign_mgr_kuser_id = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setSendCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->send_count !== $v) {
			$this->send_count = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::SEND_COUNT;
		}

	} 
	
	public function setOpenCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->open_count !== $v) {
			$this->open_count = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::OPEN_COUNT;
		}

	} 
	
	public function setClickCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->click_count !== $v) {
			$this->click_count = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::CLICK_COUNT;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = EmailCampaignPeer::STATUS;
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
			$this->modifiedColumns[] = EmailCampaignPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EmailCampaignPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->criteria_id = $rs->getInt($startcol + 1);

			$this->criteria_str = $rs->getString($startcol + 2);

			$this->criteria_params = $rs->getString($startcol + 3);

			$this->template_path = $rs->getString($startcol + 4);

			$this->campaign_mgr_kuser_id = $rs->getInt($startcol + 5);

			$this->send_count = $rs->getInt($startcol + 6);

			$this->open_count = $rs->getInt($startcol + 7);

			$this->click_count = $rs->getInt($startcol + 8);

			$this->status = $rs->getInt($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailCampaign object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailCampaignPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailCampaignPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EmailCampaignPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EmailCampaignPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailCampaignPeer::DATABASE_NAME);
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
					$pk = EmailCampaignPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailCampaignPeer::doUpdate($this, $con);
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


			if (($retval = EmailCampaignPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailCampaignPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCriteriaId();
				break;
			case 2:
				return $this->getCriteriaStr();
				break;
			case 3:
				return $this->getCriteriaParams();
				break;
			case 4:
				return $this->getTemplatePath();
				break;
			case 5:
				return $this->getCampaignMgrKuserId();
				break;
			case 6:
				return $this->getSendCount();
				break;
			case 7:
				return $this->getOpenCount();
				break;
			case 8:
				return $this->getClickCount();
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
		$keys = EmailCampaignPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCriteriaId(),
			$keys[2] => $this->getCriteriaStr(),
			$keys[3] => $this->getCriteriaParams(),
			$keys[4] => $this->getTemplatePath(),
			$keys[5] => $this->getCampaignMgrKuserId(),
			$keys[6] => $this->getSendCount(),
			$keys[7] => $this->getOpenCount(),
			$keys[8] => $this->getClickCount(),
			$keys[9] => $this->getStatus(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailCampaignPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCriteriaId($value);
				break;
			case 2:
				$this->setCriteriaStr($value);
				break;
			case 3:
				$this->setCriteriaParams($value);
				break;
			case 4:
				$this->setTemplatePath($value);
				break;
			case 5:
				$this->setCampaignMgrKuserId($value);
				break;
			case 6:
				$this->setSendCount($value);
				break;
			case 7:
				$this->setOpenCount($value);
				break;
			case 8:
				$this->setClickCount($value);
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
		$keys = EmailCampaignPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCriteriaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCriteriaStr($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCriteriaParams($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTemplatePath($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCampaignMgrKuserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSendCount($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOpenCount($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setClickCount($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailCampaignPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailCampaignPeer::ID)) $criteria->add(EmailCampaignPeer::ID, $this->id);
		if ($this->isColumnModified(EmailCampaignPeer::CRITERIA_ID)) $criteria->add(EmailCampaignPeer::CRITERIA_ID, $this->criteria_id);
		if ($this->isColumnModified(EmailCampaignPeer::CRITERIA_STR)) $criteria->add(EmailCampaignPeer::CRITERIA_STR, $this->criteria_str);
		if ($this->isColumnModified(EmailCampaignPeer::CRITERIA_PARAMS)) $criteria->add(EmailCampaignPeer::CRITERIA_PARAMS, $this->criteria_params);
		if ($this->isColumnModified(EmailCampaignPeer::TEMPLATE_PATH)) $criteria->add(EmailCampaignPeer::TEMPLATE_PATH, $this->template_path);
		if ($this->isColumnModified(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID)) $criteria->add(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, $this->campaign_mgr_kuser_id);
		if ($this->isColumnModified(EmailCampaignPeer::SEND_COUNT)) $criteria->add(EmailCampaignPeer::SEND_COUNT, $this->send_count);
		if ($this->isColumnModified(EmailCampaignPeer::OPEN_COUNT)) $criteria->add(EmailCampaignPeer::OPEN_COUNT, $this->open_count);
		if ($this->isColumnModified(EmailCampaignPeer::CLICK_COUNT)) $criteria->add(EmailCampaignPeer::CLICK_COUNT, $this->click_count);
		if ($this->isColumnModified(EmailCampaignPeer::STATUS)) $criteria->add(EmailCampaignPeer::STATUS, $this->status);
		if ($this->isColumnModified(EmailCampaignPeer::CREATED_AT)) $criteria->add(EmailCampaignPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EmailCampaignPeer::UPDATED_AT)) $criteria->add(EmailCampaignPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailCampaignPeer::DATABASE_NAME);

		$criteria->add(EmailCampaignPeer::ID, $this->id);

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

		$copyObj->setCriteriaId($this->criteria_id);

		$copyObj->setCriteriaStr($this->criteria_str);

		$copyObj->setCriteriaParams($this->criteria_params);

		$copyObj->setTemplatePath($this->template_path);

		$copyObj->setCampaignMgrKuserId($this->campaign_mgr_kuser_id);

		$copyObj->setSendCount($this->send_count);

		$copyObj->setOpenCount($this->open_count);

		$copyObj->setClickCount($this->click_count);

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
			self::$peer = new EmailCampaignPeer();
		}
		return self::$peer;
	}

	
	public function setkuser($v)
	{


		if ($v === null) {
			$this->setCampaignMgrKuserId(NULL);
		} else {
			$this->setCampaignMgrKuserId($v->getId());
		}


		$this->akuser = $v;
	}


	
	public function getkuser($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuser === null && ($this->campaign_mgr_kuser_id !== null)) {

			$this->akuser = kuserPeer::retrieveByPK($this->campaign_mgr_kuser_id, $con);

			
		}
		return $this->akuser;
	}

} 