<?php


abstract class BaseConversionParams extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $enabled;


	
	protected $name;


	
	protected $profile_type;


	
	protected $profile_type_index;


	
	protected $width;


	
	protected $height;


	
	protected $aspect_ratio;


	
	protected $gop_size;


	
	protected $bitrate;


	
	protected $qscale;


	
	protected $file_suffix;


	
	protected $custom_data;


	
	protected $created_at;


	
	protected $updated_at;

	
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

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getProfileType()
	{

		return $this->profile_type;
	}

	
	public function getProfileTypeIndex()
	{

		return $this->profile_type_index;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getAspectRatio()
	{

		return $this->aspect_ratio;
	}

	
	public function getGopSize()
	{

		return $this->gop_size;
	}

	
	public function getBitrate()
	{

		return $this->bitrate;
	}

	
	public function getQscale()
	{

		return $this->qscale;
	}

	
	public function getFileSuffix()
	{

		return $this->file_suffix;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
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
			$this->modifiedColumns[] = ConversionParamsPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::PARTNER_ID;
		}

	} 
	
	public function setEnabled($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::ENABLED;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::NAME;
		}

	} 
	
	public function setProfileType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profile_type !== $v) {
			$this->profile_type = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::PROFILE_TYPE;
		}

	} 
	
	public function setProfileTypeIndex($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profile_type_index !== $v) {
			$this->profile_type_index = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::PROFILE_TYPE_INDEX;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::HEIGHT;
		}

	} 
	
	public function setAspectRatio($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->aspect_ratio !== $v) {
			$this->aspect_ratio = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::ASPECT_RATIO;
		}

	} 
	
	public function setGopSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gop_size !== $v) {
			$this->gop_size = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::GOP_SIZE;
		}

	} 
	
	public function setBitrate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bitrate !== $v) {
			$this->bitrate = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::BITRATE;
		}

	} 
	
	public function setQscale($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->qscale !== $v) {
			$this->qscale = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::QSCALE;
		}

	} 
	
	public function setFileSuffix($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_suffix !== $v) {
			$this->file_suffix = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::FILE_SUFFIX;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = ConversionParamsPeer::CUSTOM_DATA;
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
			$this->modifiedColumns[] = ConversionParamsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ConversionParamsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->enabled = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->profile_type = $rs->getString($startcol + 4);

			$this->profile_type_index = $rs->getInt($startcol + 5);

			$this->width = $rs->getInt($startcol + 6);

			$this->height = $rs->getInt($startcol + 7);

			$this->aspect_ratio = $rs->getString($startcol + 8);

			$this->gop_size = $rs->getInt($startcol + 9);

			$this->bitrate = $rs->getInt($startcol + 10);

			$this->qscale = $rs->getInt($startcol + 11);

			$this->file_suffix = $rs->getString($startcol + 12);

			$this->custom_data = $rs->getString($startcol + 13);

			$this->created_at = $rs->getTimestamp($startcol + 14, null);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ConversionParams object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConversionParamsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConversionParamsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ConversionParamsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ConversionParamsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConversionParamsPeer::DATABASE_NAME);
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
					$pk = ConversionParamsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConversionParamsPeer::doUpdate($this, $con);
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


			if (($retval = ConversionParamsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConversionParamsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEnabled();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getProfileType();
				break;
			case 5:
				return $this->getProfileTypeIndex();
				break;
			case 6:
				return $this->getWidth();
				break;
			case 7:
				return $this->getHeight();
				break;
			case 8:
				return $this->getAspectRatio();
				break;
			case 9:
				return $this->getGopSize();
				break;
			case 10:
				return $this->getBitrate();
				break;
			case 11:
				return $this->getQscale();
				break;
			case 12:
				return $this->getFileSuffix();
				break;
			case 13:
				return $this->getCustomData();
				break;
			case 14:
				return $this->getCreatedAt();
				break;
			case 15:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConversionParamsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getEnabled(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getProfileType(),
			$keys[5] => $this->getProfileTypeIndex(),
			$keys[6] => $this->getWidth(),
			$keys[7] => $this->getHeight(),
			$keys[8] => $this->getAspectRatio(),
			$keys[9] => $this->getGopSize(),
			$keys[10] => $this->getBitrate(),
			$keys[11] => $this->getQscale(),
			$keys[12] => $this->getFileSuffix(),
			$keys[13] => $this->getCustomData(),
			$keys[14] => $this->getCreatedAt(),
			$keys[15] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConversionParamsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEnabled($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setProfileType($value);
				break;
			case 5:
				$this->setProfileTypeIndex($value);
				break;
			case 6:
				$this->setWidth($value);
				break;
			case 7:
				$this->setHeight($value);
				break;
			case 8:
				$this->setAspectRatio($value);
				break;
			case 9:
				$this->setGopSize($value);
				break;
			case 10:
				$this->setBitrate($value);
				break;
			case 11:
				$this->setQscale($value);
				break;
			case 12:
				$this->setFileSuffix($value);
				break;
			case 13:
				$this->setCustomData($value);
				break;
			case 14:
				$this->setCreatedAt($value);
				break;
			case 15:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConversionParamsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEnabled($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProfileType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setProfileTypeIndex($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setWidth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHeight($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAspectRatio($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setGopSize($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBitrate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setQscale($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setFileSuffix($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCustomData($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConversionParamsPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConversionParamsPeer::ID)) $criteria->add(ConversionParamsPeer::ID, $this->id);
		if ($this->isColumnModified(ConversionParamsPeer::PARTNER_ID)) $criteria->add(ConversionParamsPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(ConversionParamsPeer::ENABLED)) $criteria->add(ConversionParamsPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ConversionParamsPeer::NAME)) $criteria->add(ConversionParamsPeer::NAME, $this->name);
		if ($this->isColumnModified(ConversionParamsPeer::PROFILE_TYPE)) $criteria->add(ConversionParamsPeer::PROFILE_TYPE, $this->profile_type);
		if ($this->isColumnModified(ConversionParamsPeer::PROFILE_TYPE_INDEX)) $criteria->add(ConversionParamsPeer::PROFILE_TYPE_INDEX, $this->profile_type_index);
		if ($this->isColumnModified(ConversionParamsPeer::WIDTH)) $criteria->add(ConversionParamsPeer::WIDTH, $this->width);
		if ($this->isColumnModified(ConversionParamsPeer::HEIGHT)) $criteria->add(ConversionParamsPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(ConversionParamsPeer::ASPECT_RATIO)) $criteria->add(ConversionParamsPeer::ASPECT_RATIO, $this->aspect_ratio);
		if ($this->isColumnModified(ConversionParamsPeer::GOP_SIZE)) $criteria->add(ConversionParamsPeer::GOP_SIZE, $this->gop_size);
		if ($this->isColumnModified(ConversionParamsPeer::BITRATE)) $criteria->add(ConversionParamsPeer::BITRATE, $this->bitrate);
		if ($this->isColumnModified(ConversionParamsPeer::QSCALE)) $criteria->add(ConversionParamsPeer::QSCALE, $this->qscale);
		if ($this->isColumnModified(ConversionParamsPeer::FILE_SUFFIX)) $criteria->add(ConversionParamsPeer::FILE_SUFFIX, $this->file_suffix);
		if ($this->isColumnModified(ConversionParamsPeer::CUSTOM_DATA)) $criteria->add(ConversionParamsPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(ConversionParamsPeer::CREATED_AT)) $criteria->add(ConversionParamsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConversionParamsPeer::UPDATED_AT)) $criteria->add(ConversionParamsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConversionParamsPeer::DATABASE_NAME);

		$criteria->add(ConversionParamsPeer::ID, $this->id);

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

		$copyObj->setEnabled($this->enabled);

		$copyObj->setName($this->name);

		$copyObj->setProfileType($this->profile_type);

		$copyObj->setProfileTypeIndex($this->profile_type_index);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setAspectRatio($this->aspect_ratio);

		$copyObj->setGopSize($this->gop_size);

		$copyObj->setBitrate($this->bitrate);

		$copyObj->setQscale($this->qscale);

		$copyObj->setFileSuffix($this->file_suffix);

		$copyObj->setCustomData($this->custom_data);

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
			self::$peer = new ConversionParamsPeer();
		}
		return self::$peer;
	}

} 