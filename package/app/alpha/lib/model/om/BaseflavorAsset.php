<?php


abstract class BaseflavorAsset extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $int_id;


	
	protected $partner_id;


	
	protected $tags;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $deleted_at;


	
	protected $entry_id;


	
	protected $flavor_params_id;


	
	protected $status;


	
	protected $version;


	
	protected $description;


	
	protected $width = 0;


	
	protected $height = 0;


	
	protected $bitrate = 0;


	
	protected $frame_rate = 0;


	
	protected $size = 0;


	
	protected $is_original = false;


	
	protected $file_ext;


	
	protected $container_format;


	
	protected $video_codec_id;

	
	protected $aentry;

	
	protected $aflavorParams;

	
	protected $collmediaInfos;

	
	protected $lastmediaInfoCriteria = null;

	
	protected $collflavorParamsOutputs;

	
	protected $lastflavorParamsOutputCriteria = null;

	
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

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getTags()
	{

		return $this->tags;
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

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getFlavorParamsId()
	{

		return $this->flavor_params_id;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getVersion()
	{

		return $this->version;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getBitrate()
	{

		return $this->bitrate;
	}

	
	public function getFrameRate()
	{

		return $this->frame_rate;
	}

	
	public function getSize()
	{

		return $this->size;
	}

	
	public function getIsOriginal()
	{

		return $this->is_original;
	}

	
	public function getFileExt()
	{

		return $this->file_ext;
	}

	
	public function getContainerFormat()
	{

		return $this->container_format;
	}

	
	public function getVideoCodecId()
	{

		return $this->video_codec_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = flavorAssetPeer::ID;
		}

	} 
	
	public function setIntId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->int_id !== $v) {
			$this->int_id = $v;
			$this->modifiedColumns[] = flavorAssetPeer::INT_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = flavorAssetPeer::PARTNER_ID;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = flavorAssetPeer::TAGS;
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
			$this->modifiedColumns[] = flavorAssetPeer::CREATED_AT;
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
			$this->modifiedColumns[] = flavorAssetPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = flavorAssetPeer::DELETED_AT;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = flavorAssetPeer::ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setFlavorParamsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flavor_params_id !== $v) {
			$this->flavor_params_id = $v;
			$this->modifiedColumns[] = flavorAssetPeer::FLAVOR_PARAMS_ID;
		}

		if ($this->aflavorParams !== null && $this->aflavorParams->getId() !== $v) {
			$this->aflavorParams = null;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = flavorAssetPeer::STATUS;
		}

	} 
	
	public function setVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = flavorAssetPeer::VERSION;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = flavorAssetPeer::DESCRIPTION;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v || $v === 0) {
			$this->width = $v;
			$this->modifiedColumns[] = flavorAssetPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v || $v === 0) {
			$this->height = $v;
			$this->modifiedColumns[] = flavorAssetPeer::HEIGHT;
		}

	} 
	
	public function setBitrate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bitrate !== $v || $v === 0) {
			$this->bitrate = $v;
			$this->modifiedColumns[] = flavorAssetPeer::BITRATE;
		}

	} 
	
	public function setFrameRate($v)
	{

		if ($this->frame_rate !== $v || $v === 0) {
			$this->frame_rate = $v;
			$this->modifiedColumns[] = flavorAssetPeer::FRAME_RATE;
		}

	} 
	
	public function setSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->size !== $v || $v === 0) {
			$this->size = $v;
			$this->modifiedColumns[] = flavorAssetPeer::SIZE;
		}

	} 
	
	public function setIsOriginal($v)
	{

		if ($this->is_original !== $v || $v === false) {
			$this->is_original = $v;
			$this->modifiedColumns[] = flavorAssetPeer::IS_ORIGINAL;
		}

	} 
	
	public function setFileExt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_ext !== $v) {
			$this->file_ext = $v;
			$this->modifiedColumns[] = flavorAssetPeer::FILE_EXT;
		}

	} 
	
	public function setContainerFormat($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->container_format !== $v) {
			$this->container_format = $v;
			$this->modifiedColumns[] = flavorAssetPeer::CONTAINER_FORMAT;
		}

	} 
	
	public function setVideoCodecId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->video_codec_id !== $v) {
			$this->video_codec_id = $v;
			$this->modifiedColumns[] = flavorAssetPeer::VIDEO_CODEC_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->int_id = $rs->getInt($startcol + 1);

			$this->partner_id = $rs->getInt($startcol + 2);

			$this->tags = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 6, null);

			$this->entry_id = $rs->getString($startcol + 7);

			$this->flavor_params_id = $rs->getInt($startcol + 8);

			$this->status = $rs->getInt($startcol + 9);

			$this->version = $rs->getString($startcol + 10);

			$this->description = $rs->getString($startcol + 11);

			$this->width = $rs->getInt($startcol + 12);

			$this->height = $rs->getInt($startcol + 13);

			$this->bitrate = $rs->getInt($startcol + 14);

			$this->frame_rate = $rs->getFloat($startcol + 15);

			$this->size = $rs->getInt($startcol + 16);

			$this->is_original = $rs->getBoolean($startcol + 17);

			$this->file_ext = $rs->getString($startcol + 18);

			$this->container_format = $rs->getString($startcol + 19);

			$this->video_codec_id = $rs->getString($startcol + 20);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 21; 
		} catch (Exception $e) {
			throw new PropelException("Error populating flavorAsset object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorAssetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			flavorAssetPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(flavorAssetPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(flavorAssetPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorAssetPeer::DATABASE_NAME);
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


												
			if ($this->aentry !== null) {
				if ($this->aentry->isModified()) {
					$affectedRows += $this->aentry->save($con);
				}
				$this->setentry($this->aentry);
			}

			if ($this->aflavorParams !== null) {
				if ($this->aflavorParams->isModified()) {
					$affectedRows += $this->aflavorParams->save($con);
				}
				$this->setflavorParams($this->aflavorParams);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = flavorAssetPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIntId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += flavorAssetPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collmediaInfos !== null) {
				foreach($this->collmediaInfos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collflavorParamsOutputs !== null) {
				foreach($this->collflavorParamsOutputs as $referrerFK) {
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


												
			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}

			if ($this->aflavorParams !== null) {
				if (!$this->aflavorParams->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aflavorParams->getValidationFailures());
				}
			}


			if (($retval = flavorAssetPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collmediaInfos !== null) {
					foreach($this->collmediaInfos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collflavorParamsOutputs !== null) {
					foreach($this->collflavorParamsOutputs as $referrerFK) {
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
		$pos = flavorAssetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPartnerId();
				break;
			case 3:
				return $this->getTags();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			case 6:
				return $this->getDeletedAt();
				break;
			case 7:
				return $this->getEntryId();
				break;
			case 8:
				return $this->getFlavorParamsId();
				break;
			case 9:
				return $this->getStatus();
				break;
			case 10:
				return $this->getVersion();
				break;
			case 11:
				return $this->getDescription();
				break;
			case 12:
				return $this->getWidth();
				break;
			case 13:
				return $this->getHeight();
				break;
			case 14:
				return $this->getBitrate();
				break;
			case 15:
				return $this->getFrameRate();
				break;
			case 16:
				return $this->getSize();
				break;
			case 17:
				return $this->getIsOriginal();
				break;
			case 18:
				return $this->getFileExt();
				break;
			case 19:
				return $this->getContainerFormat();
				break;
			case 20:
				return $this->getVideoCodecId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorAssetPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIntId(),
			$keys[2] => $this->getPartnerId(),
			$keys[3] => $this->getTags(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
			$keys[6] => $this->getDeletedAt(),
			$keys[7] => $this->getEntryId(),
			$keys[8] => $this->getFlavorParamsId(),
			$keys[9] => $this->getStatus(),
			$keys[10] => $this->getVersion(),
			$keys[11] => $this->getDescription(),
			$keys[12] => $this->getWidth(),
			$keys[13] => $this->getHeight(),
			$keys[14] => $this->getBitrate(),
			$keys[15] => $this->getFrameRate(),
			$keys[16] => $this->getSize(),
			$keys[17] => $this->getIsOriginal(),
			$keys[18] => $this->getFileExt(),
			$keys[19] => $this->getContainerFormat(),
			$keys[20] => $this->getVideoCodecId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorAssetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPartnerId($value);
				break;
			case 3:
				$this->setTags($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
			case 6:
				$this->setDeletedAt($value);
				break;
			case 7:
				$this->setEntryId($value);
				break;
			case 8:
				$this->setFlavorParamsId($value);
				break;
			case 9:
				$this->setStatus($value);
				break;
			case 10:
				$this->setVersion($value);
				break;
			case 11:
				$this->setDescription($value);
				break;
			case 12:
				$this->setWidth($value);
				break;
			case 13:
				$this->setHeight($value);
				break;
			case 14:
				$this->setBitrate($value);
				break;
			case 15:
				$this->setFrameRate($value);
				break;
			case 16:
				$this->setSize($value);
				break;
			case 17:
				$this->setIsOriginal($value);
				break;
			case 18:
				$this->setFileExt($value);
				break;
			case 19:
				$this->setContainerFormat($value);
				break;
			case 20:
				$this->setVideoCodecId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorAssetPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIntId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTags($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeletedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEntryId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFlavorParamsId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setVersion($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDescription($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setWidth($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setHeight($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setBitrate($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setFrameRate($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setSize($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setIsOriginal($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setFileExt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setContainerFormat($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setVideoCodecId($arr[$keys[20]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(flavorAssetPeer::DATABASE_NAME);

		if ($this->isColumnModified(flavorAssetPeer::ID)) $criteria->add(flavorAssetPeer::ID, $this->id);
		if ($this->isColumnModified(flavorAssetPeer::INT_ID)) $criteria->add(flavorAssetPeer::INT_ID, $this->int_id);
		if ($this->isColumnModified(flavorAssetPeer::PARTNER_ID)) $criteria->add(flavorAssetPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(flavorAssetPeer::TAGS)) $criteria->add(flavorAssetPeer::TAGS, $this->tags);
		if ($this->isColumnModified(flavorAssetPeer::CREATED_AT)) $criteria->add(flavorAssetPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(flavorAssetPeer::UPDATED_AT)) $criteria->add(flavorAssetPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(flavorAssetPeer::DELETED_AT)) $criteria->add(flavorAssetPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(flavorAssetPeer::ENTRY_ID)) $criteria->add(flavorAssetPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(flavorAssetPeer::FLAVOR_PARAMS_ID)) $criteria->add(flavorAssetPeer::FLAVOR_PARAMS_ID, $this->flavor_params_id);
		if ($this->isColumnModified(flavorAssetPeer::STATUS)) $criteria->add(flavorAssetPeer::STATUS, $this->status);
		if ($this->isColumnModified(flavorAssetPeer::VERSION)) $criteria->add(flavorAssetPeer::VERSION, $this->version);
		if ($this->isColumnModified(flavorAssetPeer::DESCRIPTION)) $criteria->add(flavorAssetPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(flavorAssetPeer::WIDTH)) $criteria->add(flavorAssetPeer::WIDTH, $this->width);
		if ($this->isColumnModified(flavorAssetPeer::HEIGHT)) $criteria->add(flavorAssetPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(flavorAssetPeer::BITRATE)) $criteria->add(flavorAssetPeer::BITRATE, $this->bitrate);
		if ($this->isColumnModified(flavorAssetPeer::FRAME_RATE)) $criteria->add(flavorAssetPeer::FRAME_RATE, $this->frame_rate);
		if ($this->isColumnModified(flavorAssetPeer::SIZE)) $criteria->add(flavorAssetPeer::SIZE, $this->size);
		if ($this->isColumnModified(flavorAssetPeer::IS_ORIGINAL)) $criteria->add(flavorAssetPeer::IS_ORIGINAL, $this->is_original);
		if ($this->isColumnModified(flavorAssetPeer::FILE_EXT)) $criteria->add(flavorAssetPeer::FILE_EXT, $this->file_ext);
		if ($this->isColumnModified(flavorAssetPeer::CONTAINER_FORMAT)) $criteria->add(flavorAssetPeer::CONTAINER_FORMAT, $this->container_format);
		if ($this->isColumnModified(flavorAssetPeer::VIDEO_CODEC_ID)) $criteria->add(flavorAssetPeer::VIDEO_CODEC_ID, $this->video_codec_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(flavorAssetPeer::DATABASE_NAME);

		$criteria->add(flavorAssetPeer::INT_ID, $this->int_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIntId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIntId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setId($this->id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setTags($this->tags);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setFlavorParamsId($this->flavor_params_id);

		$copyObj->setStatus($this->status);

		$copyObj->setVersion($this->version);

		$copyObj->setDescription($this->description);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setBitrate($this->bitrate);

		$copyObj->setFrameRate($this->frame_rate);

		$copyObj->setSize($this->size);

		$copyObj->setIsOriginal($this->is_original);

		$copyObj->setFileExt($this->file_ext);

		$copyObj->setContainerFormat($this->container_format);

		$copyObj->setVideoCodecId($this->video_codec_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getmediaInfos() as $relObj) {
				$copyObj->addmediaInfo($relObj->copy($deepCopy));
			}

			foreach($this->getflavorParamsOutputs() as $relObj) {
				$copyObj->addflavorParamsOutput($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIntId(NULL); 
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
			self::$peer = new flavorAssetPeer();
		}
		return self::$peer;
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

	
	public function setflavorParams($v)
	{


		if ($v === null) {
			$this->setFlavorParamsId(NULL);
		} else {
			$this->setFlavorParamsId($v->getId());
		}


		$this->aflavorParams = $v;
	}


	
	public function getflavorParams($con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsPeer.php';

		if ($this->aflavorParams === null && ($this->flavor_params_id !== null)) {

			$this->aflavorParams = flavorParamsPeer::retrieveByPK($this->flavor_params_id, $con);

			
		}
		return $this->aflavorParams;
	}

	
	public function initmediaInfos()
	{
		if ($this->collmediaInfos === null) {
			$this->collmediaInfos = array();
		}
	}

	
	public function getmediaInfos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasemediaInfoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmediaInfos === null) {
			if ($this->isNew()) {
			   $this->collmediaInfos = array();
			} else {

				$criteria->add(mediaInfoPeer::FLAVOR_ASSET_ID, $this->getId());

				mediaInfoPeer::addSelectColumns($criteria);
				$this->collmediaInfos = mediaInfoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(mediaInfoPeer::FLAVOR_ASSET_ID, $this->getId());

				mediaInfoPeer::addSelectColumns($criteria);
				if (!isset($this->lastmediaInfoCriteria) || !$this->lastmediaInfoCriteria->equals($criteria)) {
					$this->collmediaInfos = mediaInfoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastmediaInfoCriteria = $criteria;
		return $this->collmediaInfos;
	}

	
	public function countmediaInfos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasemediaInfoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(mediaInfoPeer::FLAVOR_ASSET_ID, $this->getId());

		return mediaInfoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addmediaInfo(mediaInfo $l)
	{
		$this->collmediaInfos[] = $l;
		$l->setflavorAsset($this);
	}

	
	public function initflavorParamsOutputs()
	{
		if ($this->collflavorParamsOutputs === null) {
			$this->collflavorParamsOutputs = array();
		}
	}

	
	public function getflavorParamsOutputs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsOutputPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorParamsOutputs === null) {
			if ($this->isNew()) {
			   $this->collflavorParamsOutputs = array();
			} else {

				$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

				flavorParamsOutputPeer::addSelectColumns($criteria);
				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

				flavorParamsOutputPeer::addSelectColumns($criteria);
				if (!isset($this->lastflavorParamsOutputCriteria) || !$this->lastflavorParamsOutputCriteria->equals($criteria)) {
					$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastflavorParamsOutputCriteria = $criteria;
		return $this->collflavorParamsOutputs;
	}

	
	public function countflavorParamsOutputs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsOutputPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

		return flavorParamsOutputPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addflavorParamsOutput(flavorParamsOutput $l)
	{
		$this->collflavorParamsOutputs[] = $l;
		$l->setflavorAsset($this);
	}


	
	public function getflavorParamsOutputsJoinflavorParams($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsOutputPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorParamsOutputs === null) {
			if ($this->isNew()) {
				$this->collflavorParamsOutputs = array();
			} else {

				$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinflavorParams($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

			if (!isset($this->lastflavorParamsOutputCriteria) || !$this->lastflavorParamsOutputCriteria->equals($criteria)) {
				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinflavorParams($criteria, $con);
			}
		}
		$this->lastflavorParamsOutputCriteria = $criteria;

		return $this->collflavorParamsOutputs;
	}


	
	public function getflavorParamsOutputsJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorParamsOutputPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorParamsOutputs === null) {
			if ($this->isNew()) {
				$this->collflavorParamsOutputs = array();
			} else {

				$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->getId());

			if (!isset($this->lastflavorParamsOutputCriteria) || !$this->lastflavorParamsOutputCriteria->equals($criteria)) {
				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastflavorParamsOutputCriteria = $criteria;

		return $this->collflavorParamsOutputs;
	}

} 