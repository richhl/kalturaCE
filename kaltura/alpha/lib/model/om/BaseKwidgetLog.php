<?php


abstract class BaseKwidgetLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $widget_id;


	
	protected $source_widget_id;


	
	protected $root_widget_id;


	
	protected $kshow_id;


	
	protected $entry_id;


	
	protected $ui_conf_id;


	
	protected $referer;


	
	protected $views = 0;


	
	protected $ip1;


	
	protected $ip1_count = 0;


	
	protected $ip2;


	
	protected $ip2_count = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $plays = 0;


	
	protected $partner_id = 0;


	
	protected $subp_id = 0;

	
	protected $awidget;

	
	protected $akshow;

	
	protected $aentry;

	
	protected $auiConf;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getWidgetId()
	{

		return $this->widget_id;
	}

	
	public function getSourceWidgetId()
	{

		return $this->source_widget_id;
	}

	
	public function getRootWidgetId()
	{

		return $this->root_widget_id;
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

	
	public function getReferer()
	{

		return $this->referer;
	}

	
	public function getViews()
	{

		return $this->views;
	}

	
	public function getIp1()
	{

		return $this->ip1;
	}

	
	public function getIp1Count()
	{

		return $this->ip1_count;
	}

	
	public function getIp2()
	{

		return $this->ip2;
	}

	
	public function getIp2Count()
	{

		return $this->ip2_count;
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

	
	public function getPlays()
	{

		return $this->plays;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::ID;
		}

	} 
	
	public function setWidgetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->widget_id !== $v) {
			$this->widget_id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::WIDGET_ID;
		}

		if ($this->awidget !== null && $this->awidget->getId() !== $v) {
			$this->awidget = null;
		}

	} 
	
	public function setSourceWidgetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_widget_id !== $v) {
			$this->source_widget_id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::SOURCE_WIDGET_ID;
		}

	} 
	
	public function setRootWidgetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->root_widget_id !== $v) {
			$this->root_widget_id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::ROOT_WIDGET_ID;
		}

	} 
	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::KSHOW_ID;
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
			$this->modifiedColumns[] = KwidgetLogPeer::ENTRY_ID;
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
			$this->modifiedColumns[] = KwidgetLogPeer::UI_CONF_ID;
		}

		if ($this->auiConf !== null && $this->auiConf->getId() !== $v) {
			$this->auiConf = null;
		}

	} 
	
	public function setReferer($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->referer !== $v) {
			$this->referer = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::REFERER;
		}

	} 
	
	public function setViews($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->views !== $v || $v === 0) {
			$this->views = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::VIEWS;
		}

	} 
	
	public function setIp1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip1 !== $v) {
			$this->ip1 = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::IP1;
		}

	} 
	
	public function setIp1Count($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip1_count !== $v || $v === 0) {
			$this->ip1_count = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::IP1_COUNT;
		}

	} 
	
	public function setIp2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip2 !== $v) {
			$this->ip2 = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::IP2;
		}

	} 
	
	public function setIp2Count($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ip2_count !== $v || $v === 0) {
			$this->ip2_count = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::IP2_COUNT;
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
			$this->modifiedColumns[] = KwidgetLogPeer::CREATED_AT;
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
			$this->modifiedColumns[] = KwidgetLogPeer::UPDATED_AT;
		}

	} 
	
	public function setPlays($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->plays !== $v || $v === 0) {
			$this->plays = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::PLAYS;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = KwidgetLogPeer::SUBP_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->widget_id = $rs->getString($startcol + 1);

			$this->source_widget_id = $rs->getString($startcol + 2);

			$this->root_widget_id = $rs->getString($startcol + 3);

			$this->kshow_id = $rs->getString($startcol + 4);

			$this->entry_id = $rs->getString($startcol + 5);

			$this->ui_conf_id = $rs->getInt($startcol + 6);

			$this->referer = $rs->getString($startcol + 7);

			$this->views = $rs->getInt($startcol + 8);

			$this->ip1 = $rs->getInt($startcol + 9);

			$this->ip1_count = $rs->getInt($startcol + 10);

			$this->ip2 = $rs->getInt($startcol + 11);

			$this->ip2_count = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->plays = $rs->getInt($startcol + 15);

			$this->partner_id = $rs->getInt($startcol + 16);

			$this->subp_id = $rs->getInt($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating KwidgetLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KwidgetLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			KwidgetLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(KwidgetLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(KwidgetLogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KwidgetLogPeer::DATABASE_NAME);
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


												
			if ($this->awidget !== null) {
				if ($this->awidget->isModified()) {
					$affectedRows += $this->awidget->save($con);
				}
				$this->setwidget($this->awidget);
			}

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
					$pk = KwidgetLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += KwidgetLogPeer::doUpdate($this, $con);
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


												
			if ($this->awidget !== null) {
				if (!$this->awidget->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->awidget->getValidationFailures());
				}
			}

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


			if (($retval = KwidgetLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KwidgetLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getWidgetId();
				break;
			case 2:
				return $this->getSourceWidgetId();
				break;
			case 3:
				return $this->getRootWidgetId();
				break;
			case 4:
				return $this->getKshowId();
				break;
			case 5:
				return $this->getEntryId();
				break;
			case 6:
				return $this->getUiConfId();
				break;
			case 7:
				return $this->getReferer();
				break;
			case 8:
				return $this->getViews();
				break;
			case 9:
				return $this->getIp1();
				break;
			case 10:
				return $this->getIp1Count();
				break;
			case 11:
				return $this->getIp2();
				break;
			case 12:
				return $this->getIp2Count();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			case 15:
				return $this->getPlays();
				break;
			case 16:
				return $this->getPartnerId();
				break;
			case 17:
				return $this->getSubpId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KwidgetLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWidgetId(),
			$keys[2] => $this->getSourceWidgetId(),
			$keys[3] => $this->getRootWidgetId(),
			$keys[4] => $this->getKshowId(),
			$keys[5] => $this->getEntryId(),
			$keys[6] => $this->getUiConfId(),
			$keys[7] => $this->getReferer(),
			$keys[8] => $this->getViews(),
			$keys[9] => $this->getIp1(),
			$keys[10] => $this->getIp1Count(),
			$keys[11] => $this->getIp2(),
			$keys[12] => $this->getIp2Count(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getUpdatedAt(),
			$keys[15] => $this->getPlays(),
			$keys[16] => $this->getPartnerId(),
			$keys[17] => $this->getSubpId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KwidgetLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setWidgetId($value);
				break;
			case 2:
				$this->setSourceWidgetId($value);
				break;
			case 3:
				$this->setRootWidgetId($value);
				break;
			case 4:
				$this->setKshowId($value);
				break;
			case 5:
				$this->setEntryId($value);
				break;
			case 6:
				$this->setUiConfId($value);
				break;
			case 7:
				$this->setReferer($value);
				break;
			case 8:
				$this->setViews($value);
				break;
			case 9:
				$this->setIp1($value);
				break;
			case 10:
				$this->setIp1Count($value);
				break;
			case 11:
				$this->setIp2($value);
				break;
			case 12:
				$this->setIp2Count($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
			case 15:
				$this->setPlays($value);
				break;
			case 16:
				$this->setPartnerId($value);
				break;
			case 17:
				$this->setSubpId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KwidgetLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWidgetId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSourceWidgetId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRootWidgetId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setKshowId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEntryId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUiConfId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setReferer($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setViews($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIp1($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIp1Count($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIp2($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIp2Count($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPlays($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setPartnerId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setSubpId($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(KwidgetLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(KwidgetLogPeer::ID)) $criteria->add(KwidgetLogPeer::ID, $this->id);
		if ($this->isColumnModified(KwidgetLogPeer::WIDGET_ID)) $criteria->add(KwidgetLogPeer::WIDGET_ID, $this->widget_id);
		if ($this->isColumnModified(KwidgetLogPeer::SOURCE_WIDGET_ID)) $criteria->add(KwidgetLogPeer::SOURCE_WIDGET_ID, $this->source_widget_id);
		if ($this->isColumnModified(KwidgetLogPeer::ROOT_WIDGET_ID)) $criteria->add(KwidgetLogPeer::ROOT_WIDGET_ID, $this->root_widget_id);
		if ($this->isColumnModified(KwidgetLogPeer::KSHOW_ID)) $criteria->add(KwidgetLogPeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(KwidgetLogPeer::ENTRY_ID)) $criteria->add(KwidgetLogPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(KwidgetLogPeer::UI_CONF_ID)) $criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->ui_conf_id);
		if ($this->isColumnModified(KwidgetLogPeer::REFERER)) $criteria->add(KwidgetLogPeer::REFERER, $this->referer);
		if ($this->isColumnModified(KwidgetLogPeer::VIEWS)) $criteria->add(KwidgetLogPeer::VIEWS, $this->views);
		if ($this->isColumnModified(KwidgetLogPeer::IP1)) $criteria->add(KwidgetLogPeer::IP1, $this->ip1);
		if ($this->isColumnModified(KwidgetLogPeer::IP1_COUNT)) $criteria->add(KwidgetLogPeer::IP1_COUNT, $this->ip1_count);
		if ($this->isColumnModified(KwidgetLogPeer::IP2)) $criteria->add(KwidgetLogPeer::IP2, $this->ip2);
		if ($this->isColumnModified(KwidgetLogPeer::IP2_COUNT)) $criteria->add(KwidgetLogPeer::IP2_COUNT, $this->ip2_count);
		if ($this->isColumnModified(KwidgetLogPeer::CREATED_AT)) $criteria->add(KwidgetLogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(KwidgetLogPeer::UPDATED_AT)) $criteria->add(KwidgetLogPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(KwidgetLogPeer::PLAYS)) $criteria->add(KwidgetLogPeer::PLAYS, $this->plays);
		if ($this->isColumnModified(KwidgetLogPeer::PARTNER_ID)) $criteria->add(KwidgetLogPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(KwidgetLogPeer::SUBP_ID)) $criteria->add(KwidgetLogPeer::SUBP_ID, $this->subp_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KwidgetLogPeer::DATABASE_NAME);

		$criteria->add(KwidgetLogPeer::ID, $this->id);

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

		$copyObj->setWidgetId($this->widget_id);

		$copyObj->setSourceWidgetId($this->source_widget_id);

		$copyObj->setRootWidgetId($this->root_widget_id);

		$copyObj->setKshowId($this->kshow_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setUiConfId($this->ui_conf_id);

		$copyObj->setReferer($this->referer);

		$copyObj->setViews($this->views);

		$copyObj->setIp1($this->ip1);

		$copyObj->setIp1Count($this->ip1_count);

		$copyObj->setIp2($this->ip2);

		$copyObj->setIp2Count($this->ip2_count);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPlays($this->plays);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setSubpId($this->subp_id);


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
			self::$peer = new KwidgetLogPeer();
		}
		return self::$peer;
	}

	
	public function setwidget($v)
	{


		if ($v === null) {
			$this->setWidgetId(NULL);
		} else {
			$this->setWidgetId($v->getId());
		}


		$this->awidget = $v;
	}


	
	public function getwidget($con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';

		if ($this->awidget === null && (($this->widget_id !== "" && $this->widget_id !== null))) {

			$this->awidget = widgetPeer::retrieveByPK($this->widget_id, $con);

			
		}
		return $this->awidget;
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

} 