<?php


abstract class BaseConversionProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id = 0;


	
	protected $enabled;


	
	protected $name;


	
	protected $profile_type;


	
	protected $commercial_transcoder;


	
	protected $width;


	
	protected $height;


	
	protected $aspect_ratio;


	
	protected $bypass_flv;


	
	protected $use_with_bulk;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $profile_type_suffix;

	
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

	
	public function getCommercialTranscoder()
	{

		return $this->commercial_transcoder;
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

	
	public function getBypassFlv()
	{

		return $this->bypass_flv;
	}

	
	public function getUseWithBulk()
	{

		return $this->use_with_bulk;
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

	
	public function getProfileTypeSuffix()
	{

		return $this->profile_type_suffix;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::PARTNER_ID;
		}

	} 
	
	public function setEnabled($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::ENABLED;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::NAME;
		}

	} 
	
	public function setProfileType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profile_type !== $v) {
			$this->profile_type = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::PROFILE_TYPE;
		}

	} 
	
	public function setCommercialTranscoder($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->commercial_transcoder !== $v) {
			$this->commercial_transcoder = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::COMMERCIAL_TRANSCODER;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::HEIGHT;
		}

	} 
	
	public function setAspectRatio($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->aspect_ratio !== $v) {
			$this->aspect_ratio = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::ASPECT_RATIO;
		}

	} 
	
	public function setBypassFlv($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bypass_flv !== $v) {
			$this->bypass_flv = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::BYPASS_FLV;
		}

	} 
	
	public function setUseWithBulk($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->use_with_bulk !== $v) {
			$this->use_with_bulk = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::USE_WITH_BULK;
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
			$this->modifiedColumns[] = ConversionProfilePeer::CREATED_AT;
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
			$this->modifiedColumns[] = ConversionProfilePeer::UPDATED_AT;
		}

	} 
	
	public function setProfileTypeSuffix($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profile_type_suffix !== $v) {
			$this->profile_type_suffix = $v;
			$this->modifiedColumns[] = ConversionProfilePeer::PROFILE_TYPE_SUFFIX;
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

			$this->commercial_transcoder = $rs->getInt($startcol + 5);

			$this->width = $rs->getInt($startcol + 6);

			$this->height = $rs->getInt($startcol + 7);

			$this->aspect_ratio = $rs->getString($startcol + 8);

			$this->bypass_flv = $rs->getInt($startcol + 9);

			$this->use_with_bulk = $rs->getInt($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->profile_type_suffix = $rs->getString($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ConversionProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConversionProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConversionProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ConversionProfilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ConversionProfilePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConversionProfilePeer::DATABASE_NAME);
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
					$pk = ConversionProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConversionProfilePeer::doUpdate($this, $con);
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


			if (($retval = ConversionProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConversionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCommercialTranscoder();
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
				return $this->getBypassFlv();
				break;
			case 10:
				return $this->getUseWithBulk();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			case 13:
				return $this->getProfileTypeSuffix();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConversionProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getEnabled(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getProfileType(),
			$keys[5] => $this->getCommercialTranscoder(),
			$keys[6] => $this->getWidth(),
			$keys[7] => $this->getHeight(),
			$keys[8] => $this->getAspectRatio(),
			$keys[9] => $this->getBypassFlv(),
			$keys[10] => $this->getUseWithBulk(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
			$keys[13] => $this->getProfileTypeSuffix(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConversionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCommercialTranscoder($value);
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
				$this->setBypassFlv($value);
				break;
			case 10:
				$this->setUseWithBulk($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
			case 13:
				$this->setProfileTypeSuffix($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConversionProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEnabled($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProfileType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCommercialTranscoder($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setWidth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHeight($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAspectRatio($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBypassFlv($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUseWithBulk($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setProfileTypeSuffix($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConversionProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(ConversionProfilePeer::ID)) $criteria->add(ConversionProfilePeer::ID, $this->id);
		if ($this->isColumnModified(ConversionProfilePeer::PARTNER_ID)) $criteria->add(ConversionProfilePeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(ConversionProfilePeer::ENABLED)) $criteria->add(ConversionProfilePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ConversionProfilePeer::NAME)) $criteria->add(ConversionProfilePeer::NAME, $this->name);
		if ($this->isColumnModified(ConversionProfilePeer::PROFILE_TYPE)) $criteria->add(ConversionProfilePeer::PROFILE_TYPE, $this->profile_type);
		if ($this->isColumnModified(ConversionProfilePeer::COMMERCIAL_TRANSCODER)) $criteria->add(ConversionProfilePeer::COMMERCIAL_TRANSCODER, $this->commercial_transcoder);
		if ($this->isColumnModified(ConversionProfilePeer::WIDTH)) $criteria->add(ConversionProfilePeer::WIDTH, $this->width);
		if ($this->isColumnModified(ConversionProfilePeer::HEIGHT)) $criteria->add(ConversionProfilePeer::HEIGHT, $this->height);
		if ($this->isColumnModified(ConversionProfilePeer::ASPECT_RATIO)) $criteria->add(ConversionProfilePeer::ASPECT_RATIO, $this->aspect_ratio);
		if ($this->isColumnModified(ConversionProfilePeer::BYPASS_FLV)) $criteria->add(ConversionProfilePeer::BYPASS_FLV, $this->bypass_flv);
		if ($this->isColumnModified(ConversionProfilePeer::USE_WITH_BULK)) $criteria->add(ConversionProfilePeer::USE_WITH_BULK, $this->use_with_bulk);
		if ($this->isColumnModified(ConversionProfilePeer::CREATED_AT)) $criteria->add(ConversionProfilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConversionProfilePeer::UPDATED_AT)) $criteria->add(ConversionProfilePeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ConversionProfilePeer::PROFILE_TYPE_SUFFIX)) $criteria->add(ConversionProfilePeer::PROFILE_TYPE_SUFFIX, $this->profile_type_suffix);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConversionProfilePeer::DATABASE_NAME);

		$criteria->add(ConversionProfilePeer::ID, $this->id);

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

		$copyObj->setCommercialTranscoder($this->commercial_transcoder);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setAspectRatio($this->aspect_ratio);

		$copyObj->setBypassFlv($this->bypass_flv);

		$copyObj->setUseWithBulk($this->use_with_bulk);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setProfileTypeSuffix($this->profile_type_suffix);


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
			self::$peer = new ConversionProfilePeer();
		}
		return self::$peer;
	}

} 