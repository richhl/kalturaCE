<?php


abstract class BaseconversionProfile2 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $name = '';


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $deleted_at;


	
	protected $description = '';


	
	protected $crop_left = -1;


	
	protected $crop_top = -1;


	
	protected $crop_width = -1;


	
	protected $crop_height = -1;


	
	protected $clip_start = -1;


	
	protected $clip_duration = -1;


	
	protected $input_tags_map = 'null';


	
	protected $creation_mode = 1;

	
	protected $collentrys;

	
	protected $lastentryCriteria = null;

	
	protected $collflavorParamsConversionProfiles;

	
	protected $lastflavorParamsConversionProfileCriteria = null;

	
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

	
	public function getName()
	{

		return $this->name;
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

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
						$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getCropLeft()
	{

		return $this->crop_left;
	}

	
	public function getCropTop()
	{

		return $this->crop_top;
	}

	
	public function getCropWidth()
	{

		return $this->crop_width;
	}

	
	public function getCropHeight()
	{

		return $this->crop_height;
	}

	
	public function getClipStart()
	{

		return $this->clip_start;
	}

	
	public function getClipDuration()
	{

		return $this->clip_duration;
	}

	
	public function getInputTagsMap()
	{

		return $this->input_tags_map;
	}

	
	public function getCreationMode()
	{

		return $this->creation_mode;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::PARTNER_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::NAME;
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
			$this->modifiedColumns[] = conversionProfile2Peer::CREATED_AT;
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
			$this->modifiedColumns[] = conversionProfile2Peer::UPDATED_AT;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = conversionProfile2Peer::DELETED_AT;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::DESCRIPTION;
		}

	} 
	
	public function setCropLeft($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->crop_left !== $v || $v === -1) {
			$this->crop_left = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CROP_LEFT;
		}

	} 
	
	public function setCropTop($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->crop_top !== $v || $v === -1) {
			$this->crop_top = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CROP_TOP;
		}

	} 
	
	public function setCropWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->crop_width !== $v || $v === -1) {
			$this->crop_width = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CROP_WIDTH;
		}

	} 
	
	public function setCropHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->crop_height !== $v || $v === -1) {
			$this->crop_height = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CROP_HEIGHT;
		}

	} 
	
	public function setClipStart($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->clip_start !== $v || $v === -1) {
			$this->clip_start = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CLIP_START;
		}

	} 
	
	public function setClipDuration($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->clip_duration !== $v || $v === -1) {
			$this->clip_duration = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CLIP_DURATION;
		}

	} 
	
	public function setInputTagsMap($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->input_tags_map !== $v || $v === 'null') {
			$this->input_tags_map = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::INPUT_TAGS_MAP;
		}

	} 
	
	public function setCreationMode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->creation_mode !== $v || $v === 1) {
			$this->creation_mode = $v;
			$this->modifiedColumns[] = conversionProfile2Peer::CREATION_MODE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 5, null);

			$this->description = $rs->getString($startcol + 6);

			$this->crop_left = $rs->getInt($startcol + 7);

			$this->crop_top = $rs->getInt($startcol + 8);

			$this->crop_width = $rs->getInt($startcol + 9);

			$this->crop_height = $rs->getInt($startcol + 10);

			$this->clip_start = $rs->getInt($startcol + 11);

			$this->clip_duration = $rs->getInt($startcol + 12);

			$this->input_tags_map = $rs->getString($startcol + 13);

			$this->creation_mode = $rs->getInt($startcol + 14);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating conversionProfile2 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(conversionProfile2Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			conversionProfile2Peer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(conversionProfile2Peer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(conversionProfile2Peer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(conversionProfile2Peer::DATABASE_NAME);
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
					$pk = conversionProfile2Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += conversionProfile2Peer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collentrys !== null) {
				foreach($this->collentrys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collflavorParamsConversionProfiles !== null) {
				foreach($this->collflavorParamsConversionProfiles as $referrerFK) {
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


			if (($retval = conversionProfile2Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collentrys !== null) {
					foreach($this->collentrys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collflavorParamsConversionProfiles !== null) {
					foreach($this->collflavorParamsConversionProfiles as $referrerFK) {
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
		$pos = conversionProfile2Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			case 5:
				return $this->getDeletedAt();
				break;
			case 6:
				return $this->getDescription();
				break;
			case 7:
				return $this->getCropLeft();
				break;
			case 8:
				return $this->getCropTop();
				break;
			case 9:
				return $this->getCropWidth();
				break;
			case 10:
				return $this->getCropHeight();
				break;
			case 11:
				return $this->getClipStart();
				break;
			case 12:
				return $this->getClipDuration();
				break;
			case 13:
				return $this->getInputTagsMap();
				break;
			case 14:
				return $this->getCreationMode();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = conversionProfile2Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
			$keys[5] => $this->getDeletedAt(),
			$keys[6] => $this->getDescription(),
			$keys[7] => $this->getCropLeft(),
			$keys[8] => $this->getCropTop(),
			$keys[9] => $this->getCropWidth(),
			$keys[10] => $this->getCropHeight(),
			$keys[11] => $this->getClipStart(),
			$keys[12] => $this->getClipDuration(),
			$keys[13] => $this->getInputTagsMap(),
			$keys[14] => $this->getCreationMode(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = conversionProfile2Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
			case 5:
				$this->setDeletedAt($value);
				break;
			case 6:
				$this->setDescription($value);
				break;
			case 7:
				$this->setCropLeft($value);
				break;
			case 8:
				$this->setCropTop($value);
				break;
			case 9:
				$this->setCropWidth($value);
				break;
			case 10:
				$this->setCropHeight($value);
				break;
			case 11:
				$this->setClipStart($value);
				break;
			case 12:
				$this->setClipDuration($value);
				break;
			case 13:
				$this->setInputTagsMap($value);
				break;
			case 14:
				$this->setCreationMode($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = conversionProfile2Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeletedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDescription($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCropLeft($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCropTop($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCropWidth($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCropHeight($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setClipStart($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setClipDuration($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setInputTagsMap($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreationMode($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(conversionProfile2Peer::DATABASE_NAME);

		if ($this->isColumnModified(conversionProfile2Peer::ID)) $criteria->add(conversionProfile2Peer::ID, $this->id);
		if ($this->isColumnModified(conversionProfile2Peer::PARTNER_ID)) $criteria->add(conversionProfile2Peer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(conversionProfile2Peer::NAME)) $criteria->add(conversionProfile2Peer::NAME, $this->name);
		if ($this->isColumnModified(conversionProfile2Peer::CREATED_AT)) $criteria->add(conversionProfile2Peer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(conversionProfile2Peer::UPDATED_AT)) $criteria->add(conversionProfile2Peer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(conversionProfile2Peer::DELETED_AT)) $criteria->add(conversionProfile2Peer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(conversionProfile2Peer::DESCRIPTION)) $criteria->add(conversionProfile2Peer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(conversionProfile2Peer::CROP_LEFT)) $criteria->add(conversionProfile2Peer::CROP_LEFT, $this->crop_left);
		if ($this->isColumnModified(conversionProfile2Peer::CROP_TOP)) $criteria->add(conversionProfile2Peer::CROP_TOP, $this->crop_top);
		if ($this->isColumnModified(conversionProfile2Peer::CROP_WIDTH)) $criteria->add(conversionProfile2Peer::CROP_WIDTH, $this->crop_width);
		if ($this->isColumnModified(conversionProfile2Peer::CROP_HEIGHT)) $criteria->add(conversionProfile2Peer::CROP_HEIGHT, $this->crop_height);
		if ($this->isColumnModified(conversionProfile2Peer::CLIP_START)) $criteria->add(conversionProfile2Peer::CLIP_START, $this->clip_start);
		if ($this->isColumnModified(conversionProfile2Peer::CLIP_DURATION)) $criteria->add(conversionProfile2Peer::CLIP_DURATION, $this->clip_duration);
		if ($this->isColumnModified(conversionProfile2Peer::INPUT_TAGS_MAP)) $criteria->add(conversionProfile2Peer::INPUT_TAGS_MAP, $this->input_tags_map);
		if ($this->isColumnModified(conversionProfile2Peer::CREATION_MODE)) $criteria->add(conversionProfile2Peer::CREATION_MODE, $this->creation_mode);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(conversionProfile2Peer::DATABASE_NAME);

		$criteria->add(conversionProfile2Peer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setDescription($this->description);

		$copyObj->setCropLeft($this->crop_left);

		$copyObj->setCropTop($this->crop_top);

		$copyObj->setCropWidth($this->crop_width);

		$copyObj->setCropHeight($this->crop_height);

		$copyObj->setClipStart($this->clip_start);

		$copyObj->setClipDuration($this->clip_duration);

		$copyObj->setInputTagsMap($this->input_tags_map);

		$copyObj->setCreationMode($this->creation_mode);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getentrys() as $relObj) {
				$copyObj->addentry($relObj->copy($deepCopy));
			}

			foreach($this->getflavorParamsConversionProfiles() as $relObj) {
				$copyObj->addflavorParamsConversionProfile($relObj->copy($deepCopy));
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
			self::$peer = new conversionProfile2Peer();
		}
		return self::$peer;
	}

	
	public function initentrys()
	{
		if ($this->collentrys === null) {
			$this->collentrys = array();
		}
	}

	
	public function getentrys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
			   $this->collentrys = array();
			} else {

				$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				$this->collentrys = entryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
					$this->collentrys = entryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastentryCriteria = $criteria;
		return $this->collentrys;
	}

	
	public function countentrys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

		return entryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addentry(entry $l)
	{
		$this->collentrys[] = $l;
		$l->setconversionProfile2($this);
	}


	
	public function getentrysJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}


	
	public function getentrysJoinkuser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinkuser($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinkuser($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}


	
	public function getentrysJoinaccessControl($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinaccessControl($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::CONVERSION_PROFILE_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinaccessControl($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}

	
	public function initflavorParamsConversionProfiles()
	{
		if ($this->collflavorParamsConversionProfiles === null) {
			$this->collflavorParamsConversionProfiles = array();
		}
	}

	
	public function getflavorParamsConversionProfiles($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsConversionProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorParamsConversionProfiles === null) {
			if ($this->isNew()) {
			   $this->collflavorParamsConversionProfiles = array();
			} else {

				$criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->getId());

				flavorParamsConversionProfilePeer::addSelectColumns($criteria);
				$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->getId());

				flavorParamsConversionProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastflavorParamsConversionProfileCriteria) || !$this->lastflavorParamsConversionProfileCriteria->equals($criteria)) {
					$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastflavorParamsConversionProfileCriteria = $criteria;
		return $this->collflavorParamsConversionProfiles;
	}

	
	public function countflavorParamsConversionProfiles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsConversionProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->getId());

		return flavorParamsConversionProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addflavorParamsConversionProfile(flavorParamsConversionProfile $l)
	{
		$this->collflavorParamsConversionProfiles[] = $l;
		$l->setconversionProfile2($this);
	}


	
	public function getflavorParamsConversionProfilesJoinflavorParams($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsConversionProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorParamsConversionProfiles === null) {
			if ($this->isNew()) {
				$this->collflavorParamsConversionProfiles = array();
			} else {

				$criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->getId());

				$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelectJoinflavorParams($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->getId());

			if (!isset($this->lastflavorParamsConversionProfileCriteria) || !$this->lastflavorParamsConversionProfileCriteria->equals($criteria)) {
				$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelectJoinflavorParams($criteria, $con);
			}
		}
		$this->lastflavorParamsConversionProfileCriteria = $criteria;

		return $this->collflavorParamsConversionProfiles;
	}

} 