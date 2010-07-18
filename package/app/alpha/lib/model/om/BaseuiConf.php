<?php


abstract class BaseuiConf extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $obj_type;


	
	protected $partner_id;


	
	protected $subp_id;


	
	protected $conf_file_path;


	
	protected $name;


	
	protected $width;


	
	protected $height;


	
	protected $html_params;


	
	protected $swf_url;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $conf_vars;


	
	protected $use_cdn;


	
	protected $tags;


	
	protected $custom_data;


	
	protected $status;


	
	protected $description;


	
	protected $display_in_search;


	
	protected $creation_mode;


	
	protected $version;

	
	protected $collwidgets;

	
	protected $lastwidgetCriteria = null;

	
	protected $collKwidgetLogs;

	
	protected $lastKwidgetLogCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getObjType()
	{

		return $this->obj_type;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function getConfFilePath()
	{

		return $this->conf_file_path;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getHtmlParams()
	{

		return $this->html_params;
	}

	
	public function getSwfUrl()
	{

		return $this->swf_url;
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

	
	public function getConfVars()
	{

		return $this->conf_vars;
	}

	
	public function getUseCdn()
	{

		return $this->use_cdn;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getDisplayInSearch()
	{

		return $this->display_in_search;
	}

	
	public function getCreationMode()
	{

		return $this->creation_mode;
	}

	
	public function getVersion()
	{

		return $this->version;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = uiConfPeer::ID;
		}

	} 
	
	public function setObjType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->obj_type !== $v) {
			$this->obj_type = $v;
			$this->modifiedColumns[] = uiConfPeer::OBJ_TYPE;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = uiConfPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = uiConfPeer::SUBP_ID;
		}

	} 
	
	public function setConfFilePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conf_file_path !== $v) {
			$this->conf_file_path = $v;
			$this->modifiedColumns[] = uiConfPeer::CONF_FILE_PATH;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = uiConfPeer::NAME;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = uiConfPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = uiConfPeer::HEIGHT;
		}

	} 
	
	public function setHtmlParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->html_params !== $v) {
			$this->html_params = $v;
			$this->modifiedColumns[] = uiConfPeer::HTML_PARAMS;
		}

	} 
	
	public function setSwfUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->swf_url !== $v) {
			$this->swf_url = $v;
			$this->modifiedColumns[] = uiConfPeer::SWF_URL;
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
			$this->modifiedColumns[] = uiConfPeer::CREATED_AT;
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
			$this->modifiedColumns[] = uiConfPeer::UPDATED_AT;
		}

	} 
	
	public function setConfVars($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conf_vars !== $v) {
			$this->conf_vars = $v;
			$this->modifiedColumns[] = uiConfPeer::CONF_VARS;
		}

	} 
	
	public function setUseCdn($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->use_cdn !== $v) {
			$this->use_cdn = $v;
			$this->modifiedColumns[] = uiConfPeer::USE_CDN;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = uiConfPeer::TAGS;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = uiConfPeer::CUSTOM_DATA;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = uiConfPeer::STATUS;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = uiConfPeer::DESCRIPTION;
		}

	} 
	
	public function setDisplayInSearch($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_in_search !== $v) {
			$this->display_in_search = $v;
			$this->modifiedColumns[] = uiConfPeer::DISPLAY_IN_SEARCH;
		}

	} 
	
	public function setCreationMode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->creation_mode !== $v) {
			$this->creation_mode = $v;
			$this->modifiedColumns[] = uiConfPeer::CREATION_MODE;
		}

	} 
	
	public function setVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = uiConfPeer::VERSION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->obj_type = $rs->getInt($startcol + 1);

			$this->partner_id = $rs->getInt($startcol + 2);

			$this->subp_id = $rs->getInt($startcol + 3);

			$this->conf_file_path = $rs->getString($startcol + 4);

			$this->name = $rs->getString($startcol + 5);

			$this->width = $rs->getString($startcol + 6);

			$this->height = $rs->getString($startcol + 7);

			$this->html_params = $rs->getString($startcol + 8);

			$this->swf_url = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->conf_vars = $rs->getString($startcol + 12);

			$this->use_cdn = $rs->getInt($startcol + 13);

			$this->tags = $rs->getString($startcol + 14);

			$this->custom_data = $rs->getString($startcol + 15);

			$this->status = $rs->getInt($startcol + 16);

			$this->description = $rs->getString($startcol + 17);

			$this->display_in_search = $rs->getInt($startcol + 18);

			$this->creation_mode = $rs->getInt($startcol + 19);

			$this->version = $rs->getString($startcol + 20);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 21; 
		} catch (Exception $e) {
			throw new PropelException("Error populating uiConf object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(uiConfPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			uiConfPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(uiConfPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(uiConfPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(uiConfPeer::DATABASE_NAME);
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
					$pk = uiConfPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += uiConfPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collwidgets !== null) {
				foreach($this->collwidgets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = uiConfPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collwidgets !== null) {
					foreach($this->collwidgets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = uiConfPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getObjType();
				break;
			case 2:
				return $this->getPartnerId();
				break;
			case 3:
				return $this->getSubpId();
				break;
			case 4:
				return $this->getConfFilePath();
				break;
			case 5:
				return $this->getName();
				break;
			case 6:
				return $this->getWidth();
				break;
			case 7:
				return $this->getHeight();
				break;
			case 8:
				return $this->getHtmlParams();
				break;
			case 9:
				return $this->getSwfUrl();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			case 12:
				return $this->getConfVars();
				break;
			case 13:
				return $this->getUseCdn();
				break;
			case 14:
				return $this->getTags();
				break;
			case 15:
				return $this->getCustomData();
				break;
			case 16:
				return $this->getStatus();
				break;
			case 17:
				return $this->getDescription();
				break;
			case 18:
				return $this->getDisplayInSearch();
				break;
			case 19:
				return $this->getCreationMode();
				break;
			case 20:
				return $this->getVersion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = uiConfPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getObjType(),
			$keys[2] => $this->getPartnerId(),
			$keys[3] => $this->getSubpId(),
			$keys[4] => $this->getConfFilePath(),
			$keys[5] => $this->getName(),
			$keys[6] => $this->getWidth(),
			$keys[7] => $this->getHeight(),
			$keys[8] => $this->getHtmlParams(),
			$keys[9] => $this->getSwfUrl(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
			$keys[12] => $this->getConfVars(),
			$keys[13] => $this->getUseCdn(),
			$keys[14] => $this->getTags(),
			$keys[15] => $this->getCustomData(),
			$keys[16] => $this->getStatus(),
			$keys[17] => $this->getDescription(),
			$keys[18] => $this->getDisplayInSearch(),
			$keys[19] => $this->getCreationMode(),
			$keys[20] => $this->getVersion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = uiConfPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setObjType($value);
				break;
			case 2:
				$this->setPartnerId($value);
				break;
			case 3:
				$this->setSubpId($value);
				break;
			case 4:
				$this->setConfFilePath($value);
				break;
			case 5:
				$this->setName($value);
				break;
			case 6:
				$this->setWidth($value);
				break;
			case 7:
				$this->setHeight($value);
				break;
			case 8:
				$this->setHtmlParams($value);
				break;
			case 9:
				$this->setSwfUrl($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
			case 12:
				$this->setConfVars($value);
				break;
			case 13:
				$this->setUseCdn($value);
				break;
			case 14:
				$this->setTags($value);
				break;
			case 15:
				$this->setCustomData($value);
				break;
			case 16:
				$this->setStatus($value);
				break;
			case 17:
				$this->setDescription($value);
				break;
			case 18:
				$this->setDisplayInSearch($value);
				break;
			case 19:
				$this->setCreationMode($value);
				break;
			case 20:
				$this->setVersion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = uiConfPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setObjType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSubpId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setConfFilePath($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setWidth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHeight($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setHtmlParams($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSwfUrl($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setConfVars($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUseCdn($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setTags($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCustomData($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setStatus($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDescription($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setDisplayInSearch($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCreationMode($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setVersion($arr[$keys[20]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(uiConfPeer::DATABASE_NAME);

		if ($this->isColumnModified(uiConfPeer::ID)) $criteria->add(uiConfPeer::ID, $this->id);
		if ($this->isColumnModified(uiConfPeer::OBJ_TYPE)) $criteria->add(uiConfPeer::OBJ_TYPE, $this->obj_type);
		if ($this->isColumnModified(uiConfPeer::PARTNER_ID)) $criteria->add(uiConfPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(uiConfPeer::SUBP_ID)) $criteria->add(uiConfPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(uiConfPeer::CONF_FILE_PATH)) $criteria->add(uiConfPeer::CONF_FILE_PATH, $this->conf_file_path);
		if ($this->isColumnModified(uiConfPeer::NAME)) $criteria->add(uiConfPeer::NAME, $this->name);
		if ($this->isColumnModified(uiConfPeer::WIDTH)) $criteria->add(uiConfPeer::WIDTH, $this->width);
		if ($this->isColumnModified(uiConfPeer::HEIGHT)) $criteria->add(uiConfPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(uiConfPeer::HTML_PARAMS)) $criteria->add(uiConfPeer::HTML_PARAMS, $this->html_params);
		if ($this->isColumnModified(uiConfPeer::SWF_URL)) $criteria->add(uiConfPeer::SWF_URL, $this->swf_url);
		if ($this->isColumnModified(uiConfPeer::CREATED_AT)) $criteria->add(uiConfPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(uiConfPeer::UPDATED_AT)) $criteria->add(uiConfPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(uiConfPeer::CONF_VARS)) $criteria->add(uiConfPeer::CONF_VARS, $this->conf_vars);
		if ($this->isColumnModified(uiConfPeer::USE_CDN)) $criteria->add(uiConfPeer::USE_CDN, $this->use_cdn);
		if ($this->isColumnModified(uiConfPeer::TAGS)) $criteria->add(uiConfPeer::TAGS, $this->tags);
		if ($this->isColumnModified(uiConfPeer::CUSTOM_DATA)) $criteria->add(uiConfPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(uiConfPeer::STATUS)) $criteria->add(uiConfPeer::STATUS, $this->status);
		if ($this->isColumnModified(uiConfPeer::DESCRIPTION)) $criteria->add(uiConfPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(uiConfPeer::DISPLAY_IN_SEARCH)) $criteria->add(uiConfPeer::DISPLAY_IN_SEARCH, $this->display_in_search);
		if ($this->isColumnModified(uiConfPeer::CREATION_MODE)) $criteria->add(uiConfPeer::CREATION_MODE, $this->creation_mode);
		if ($this->isColumnModified(uiConfPeer::VERSION)) $criteria->add(uiConfPeer::VERSION, $this->version);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(uiConfPeer::DATABASE_NAME);

		$criteria->add(uiConfPeer::ID, $this->id);

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

		$copyObj->setObjType($this->obj_type);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setConfFilePath($this->conf_file_path);

		$copyObj->setName($this->name);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setHtmlParams($this->html_params);

		$copyObj->setSwfUrl($this->swf_url);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setConfVars($this->conf_vars);

		$copyObj->setUseCdn($this->use_cdn);

		$copyObj->setTags($this->tags);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setStatus($this->status);

		$copyObj->setDescription($this->description);

		$copyObj->setDisplayInSearch($this->display_in_search);

		$copyObj->setCreationMode($this->creation_mode);

		$copyObj->setVersion($this->version);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getwidgets() as $relObj) {
				$copyObj->addwidget($relObj->copy($deepCopy));
			}

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
			self::$peer = new uiConfPeer();
		}
		return self::$peer;
	}

	
	public function initwidgets()
	{
		if ($this->collwidgets === null) {
			$this->collwidgets = array();
		}
	}

	
	public function getwidgets($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collwidgets === null) {
			if ($this->isNew()) {
			   $this->collwidgets = array();
			} else {

				$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

				widgetPeer::addSelectColumns($criteria);
				$this->collwidgets = widgetPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

				widgetPeer::addSelectColumns($criteria);
				if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
					$this->collwidgets = widgetPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastwidgetCriteria = $criteria;
		return $this->collwidgets;
	}

	
	public function countwidgets($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

		return widgetPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addwidget(widget $l)
	{
		$this->collwidgets[] = $l;
		$l->setuiConf($this);
	}


	
	public function getwidgetsJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collwidgets === null) {
			if ($this->isNew()) {
				$this->collwidgets = array();
			} else {

				$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

				$this->collwidgets = widgetPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

			if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
				$this->collwidgets = widgetPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastwidgetCriteria = $criteria;

		return $this->collwidgets;
	}


	
	public function getwidgetsJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collwidgets === null) {
			if ($this->isNew()) {
				$this->collwidgets = array();
			} else {

				$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

				$this->collwidgets = widgetPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(widgetPeer::UI_CONF_ID, $this->getId());

			if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
				$this->collwidgets = widgetPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastwidgetCriteria = $criteria;

		return $this->collwidgets;
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

				$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

				KwidgetLogPeer::addSelectColumns($criteria);
				$this->collKwidgetLogs = KwidgetLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

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

		$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

		return KwidgetLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addKwidgetLog(KwidgetLog $l)
	{
		$this->collKwidgetLogs[] = $l;
		$l->setuiConf($this);
	}


	
	public function getKwidgetLogsJoinwidget($criteria = null, $con = null)
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

				$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinwidget($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinwidget($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
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

				$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

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

				$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::UI_CONF_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}

} 