<?php


abstract class Basewidget extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $int_id;


	
	protected $source_widget_id;


	
	protected $root_widget_id;


	
	protected $partner_id;


	
	protected $subp_id;


	
	protected $kshow_id;


	
	protected $entry_id;


	
	protected $ui_conf_id;


	
	protected $custom_data;


	
	protected $security_type;


	
	protected $security_policy;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partner_data;

	
	protected $akshow;

	
	protected $aentry;

	
	protected $auiConf;

	
	protected $collKwidgetLogs;

	
	protected $lastKwidgetLogCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIntId()
	{

		return $this->int_id;
	}

	
	public function getSourceWidgetId()
	{

		return $this->source_widget_id;
	}

	
	public function getRootWidgetId()
	{

		return $this->root_widget_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function getKshowId()
	{

		return $this->kshow_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getUiConfId()
	{

		return $this->ui_conf_id;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getSecurityType()
	{

		return $this->security_type;
	}

	
	public function getSecurityPolicy()
	{

		return $this->security_policy;
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

	
	public function getPartnerData()
	{

		return $this->partner_data;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = widgetPeer::ID;
		}

	} 
	
	public function setIntId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->int_id !== $v) {
			$this->int_id = $v;
			$this->modifiedColumns[] = widgetPeer::INT_ID;
		}

	} 
	
	public function setSourceWidgetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_widget_id !== $v) {
			$this->source_widget_id = $v;
			$this->modifiedColumns[] = widgetPeer::SOURCE_WIDGET_ID;
		}

	} 
	
	public function setRootWidgetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->root_widget_id !== $v) {
			$this->root_widget_id = $v;
			$this->modifiedColumns[] = widgetPeer::ROOT_WIDGET_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = widgetPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = widgetPeer::SUBP_ID;
		}

	} 
	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = widgetPeer::KSHOW_ID;
		}

		if ($this->akshow !== null && $this->akshow->getId() !== $v) {
			$this->akshow = null;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = widgetPeer::ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setUiConfId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ui_conf_id !== $v) {
			$this->ui_conf_id = $v;
			$this->modifiedColumns[] = widgetPeer::UI_CONF_ID;
		}

		if ($this->auiConf !== null && $this->auiConf->getId() !== $v) {
			$this->auiConf = null;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = widgetPeer::CUSTOM_DATA;
		}

	} 
	
	public function setSecurityType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->security_type !== $v) {
			$this->security_type = $v;
			$this->modifiedColumns[] = widgetPeer::SECURITY_TYPE;
		}

	} 
	
	public function setSecurityPolicy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->security_policy !== $v) {
			$this->security_policy = $v;
			$this->modifiedColumns[] = widgetPeer::SECURITY_POLICY;
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
			$this->modifiedColumns[] = widgetPeer::CREATED_AT;
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
			$this->modifiedColumns[] = widgetPeer::UPDATED_AT;
		}

	} 
	
	public function setPartnerData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_data !== $v) {
			$this->partner_data = $v;
			$this->modifiedColumns[] = widgetPeer::PARTNER_DATA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->int_id = $rs->getInt($startcol + 1);

			$this->source_widget_id = $rs->getString($startcol + 2);

			$this->root_widget_id = $rs->getString($startcol + 3);

			$this->partner_id = $rs->getInt($startcol + 4);

			$this->subp_id = $rs->getInt($startcol + 5);

			$this->kshow_id = $rs->getString($startcol + 6);

			$this->entry_id = $rs->getString($startcol + 7);

			$this->ui_conf_id = $rs->getInt($startcol + 8);

			$this->custom_data = $rs->getString($startcol + 9);

			$this->security_type = $rs->getInt($startcol + 10);

			$this->security_policy = $rs->getInt($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->partner_data = $rs->getString($startcol + 14);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating widget object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(widgetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			widgetPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(widgetPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(widgetPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(widgetPeer::DATABASE_NAME);
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

			if ($this->aentry !== null) {
				if ($this->aentry->isModified()) {
					$affectedRows += $this->aentry->save($con);
				}
				$this->setentry($this->aentry);
			}

			if ($this->auiConf !== null) {
				if ($this->auiConf->isModified()) {
					$affectedRows += $this->auiConf->save($con);
				}
				$this->setuiConf($this->auiConf);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = widgetPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += widgetPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collKwidgetLogs !== null) {
				foreach($this->collKwidgetLogs as $referrerFK) {
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


												
			if ($this->akshow !== null) {
				if (!$this->akshow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akshow->getValidationFailures());
				}
			}

			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}

			if ($this->auiConf !== null) {
				if (!$this->auiConf->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->auiConf->getValidationFailures());
				}
			}


			if (($retval = widgetPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collKwidgetLogs !== null) {
					foreach($this->collKwidgetLogs as $referrerFK) {
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
		$pos = widgetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIntId();
				break;
			case 2:
				return $this->getSourceWidgetId();
				break;
			case 3:
				return $this->getRootWidgetId();
				break;
			case 4:
				return $this->getPartnerId();
				break;
			case 5:
				return $this->getSubpId();
				break;
			case 6:
				return $this->getKshowId();
				break;
			case 7:
				return $this->getEntryId();
				break;
			case 8:
				return $this->getUiConfId();
				break;
			case 9:
				return $this->getCustomData();
				break;
			case 10:
				return $this->getSecurityType();
				break;
			case 11:
				return $this->getSecurityPolicy();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			case 14:
				return $this->getPartnerData();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = widgetPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIntId(),
			$keys[2] => $this->getSourceWidgetId(),
			$keys[3] => $this->getRootWidgetId(),
			$keys[4] => $this->getPartnerId(),
			$keys[5] => $this->getSubpId(),
			$keys[6] => $this->getKshowId(),
			$keys[7] => $this->getEntryId(),
			$keys[8] => $this->getUiConfId(),
			$keys[9] => $this->getCustomData(),
			$keys[10] => $this->getSecurityType(),
			$keys[11] => $this->getSecurityPolicy(),
			$keys[12] => $this->getCreatedAt(),
			$keys[13] => $this->getUpdatedAt(),
			$keys[14] => $this->getPartnerData(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = widgetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIntId($value);
				break;
			case 2:
				$this->setSourceWidgetId($value);
				break;
			case 3:
				$this->setRootWidgetId($value);
				break;
			case 4:
				$this->setPartnerId($value);
				break;
			case 5:
				$this->setSubpId($value);
				break;
			case 6:
				$this->setKshowId($value);
				break;
			case 7:
				$this->setEntryId($value);
				break;
			case 8:
				$this->setUiConfId($value);
				break;
			case 9:
				$this->setCustomData($value);
				break;
			case 10:
				$this->setSecurityType($value);
				break;
			case 11:
				$this->setSecurityPolicy($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
			case 14:
				$this->setPartnerData($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = widgetPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIntId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSourceWidgetId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRootWidgetId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPartnerId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSubpId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setKshowId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEntryId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUiConfId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCustomData($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSecurityType($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSecurityPolicy($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPartnerData($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(widgetPeer::DATABASE_NAME);

		if ($this->isColumnModified(widgetPeer::ID)) $criteria->add(widgetPeer::ID, $this->id);
		if ($this->isColumnModified(widgetPeer::INT_ID)) $criteria->add(widgetPeer::INT_ID, $this->int_id);
		if ($this->isColumnModified(widgetPeer::SOURCE_WIDGET_ID)) $criteria->add(widgetPeer::SOURCE_WIDGET_ID, $this->source_widget_id);
		if ($this->isColumnModified(widgetPeer::ROOT_WIDGET_ID)) $criteria->add(widgetPeer::ROOT_WIDGET_ID, $this->root_widget_id);
		if ($this->isColumnModified(widgetPeer::PARTNER_ID)) $criteria->add(widgetPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(widgetPeer::SUBP_ID)) $criteria->add(widgetPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(widgetPeer::KSHOW_ID)) $criteria->add(widgetPeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(widgetPeer::ENTRY_ID)) $criteria->add(widgetPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(widgetPeer::UI_CONF_ID)) $criteria->add(widgetPeer::UI_CONF_ID, $this->ui_conf_id);
		if ($this->isColumnModified(widgetPeer::CUSTOM_DATA)) $criteria->add(widgetPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(widgetPeer::SECURITY_TYPE)) $criteria->add(widgetPeer::SECURITY_TYPE, $this->security_type);
		if ($this->isColumnModified(widgetPeer::SECURITY_POLICY)) $criteria->add(widgetPeer::SECURITY_POLICY, $this->security_policy);
		if ($this->isColumnModified(widgetPeer::CREATED_AT)) $criteria->add(widgetPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(widgetPeer::UPDATED_AT)) $criteria->add(widgetPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(widgetPeer::PARTNER_DATA)) $criteria->add(widgetPeer::PARTNER_DATA, $this->partner_data);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(widgetPeer::DATABASE_NAME);

		$criteria->add(widgetPeer::ID, $this->id);

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

		$copyObj->setIntId($this->int_id);

		$copyObj->setSourceWidgetId($this->source_widget_id);

		$copyObj->setRootWidgetId($this->root_widget_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setKshowId($this->kshow_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setUiConfId($this->ui_conf_id);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setSecurityType($this->security_type);

		$copyObj->setSecurityPolicy($this->security_policy);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPartnerData($this->partner_data);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getKwidgetLogs() as $relObj) {
				$copyObj->addKwidgetLog($relObj->copy($deepCopy));
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
			self::$peer = new widgetPeer();
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

	
	public function setentry($v)
	{


		if ($v === null) {
			$this->setEntryId(NULL);
		} else {
			$this->setEntryId($v->getId());
		}


		$this->aentry = $v;
	}


	
	public function getentry($con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';

		if ($this->aentry === null && (($this->entry_id !== "" && $this->entry_id !== null))) {

			$this->aentry = entryPeer::retrieveByPK($this->entry_id, $con);

			
		}
		return $this->aentry;
	}

	
	public function setuiConf($v)
	{


		if ($v === null) {
			$this->setUiConfId(NULL);
		} else {
			$this->setUiConfId($v->getId());
		}


		$this->auiConf = $v;
	}


	
	public function getuiConf($con = null)
	{
				include_once 'lib/model/om/BaseuiConfPeer.php';

		if ($this->auiConf === null && ($this->ui_conf_id !== null)) {

			$this->auiConf = uiConfPeer::retrieveByPK($this->ui_conf_id, $con);

			
		}
		return $this->auiConf;
	}

	
	public function initKwidgetLogs()
	{
		if ($this->collKwidgetLogs === null) {
			$this->collKwidgetLogs = array();
		}
	}

	
	public function getKwidgetLogs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
			   $this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

				KwidgetLogPeer::addSelectColumns($criteria);
				$this->collKwidgetLogs = KwidgetLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

				KwidgetLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
					$this->collKwidgetLogs = KwidgetLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;
		return $this->collKwidgetLogs;
	}

	
	public function countKwidgetLogs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

		return KwidgetLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addKwidgetLog(KwidgetLog $l)
	{
		$this->collKwidgetLogs[] = $l;
		$l->setwidget($this);
	}


	
	public function getKwidgetLogsJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
				$this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}


	
	public function getKwidgetLogsJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
				$this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}


	
	public function getKwidgetLogsJoinuiConf($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
				$this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinuiConf($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::WIDGET_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinuiConf($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}

} 