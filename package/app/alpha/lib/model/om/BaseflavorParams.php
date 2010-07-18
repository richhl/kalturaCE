<?php


abstract class BaseflavorParams extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $version;


	
	protected $partner_id;


	
	protected $name = '';


	
	protected $tags;


	
	protected $description = '';


	
	protected $ready_behavior;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $deleted_at;


	
	protected $is_default = 0;


	
	protected $format;


	
	protected $video_codec;


	
	protected $video_bitrate = 0;


	
	protected $audio_codec;


	
	protected $audio_bitrate = 0;


	
	protected $audio_channels = 0;


	
	protected $audio_sample_rate = 0;


	
	protected $audio_resolution = 0;


	
	protected $width = 0;


	
	protected $height = 0;


	
	protected $frame_rate = 0;


	
	protected $gop_size = 0;


	
	protected $two_pass = false;


	
	protected $conversion_engines;


	
	protected $conversion_engines_extra_params;


	
	protected $custom_data;


	
	protected $view_order;


	
	protected $creation_mode = 1;


	
	protected $deinterlice;


	
	protected $rotate;

	
	protected $collflavorParamsOutputs;

	
	protected $lastflavorParamsOutputCriteria = null;

	
	protected $collflavorAssets;

	
	protected $lastflavorAssetCriteria = null;

	
	protected $collflavorParamsConversionProfiles;

	
	protected $lastflavorParamsConversionProfileCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getVersion()
	{

		return $this->version;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getReadyBehavior()
	{

		return $this->ready_behavior;
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

	
	public function getIsDefault()
	{

		return $this->is_default;
	}

	
	public function getFormat()
	{

		return $this->format;
	}

	
	public function getVideoCodec()
	{

		return $this->video_codec;
	}

	
	public function getVideoBitrate()
	{

		return $this->video_bitrate;
	}

	
	public function getAudioCodec()
	{

		return $this->audio_codec;
	}

	
	public function getAudioBitrate()
	{

		return $this->audio_bitrate;
	}

	
	public function getAudioChannels()
	{

		return $this->audio_channels;
	}

	
	public function getAudioSampleRate()
	{

		return $this->audio_sample_rate;
	}

	
	public function getAudioResolution()
	{

		return $this->audio_resolution;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getFrameRate()
	{

		return $this->frame_rate;
	}

	
	public function getGopSize()
	{

		return $this->gop_size;
	}

	
	public function getTwoPass()
	{

		return $this->two_pass;
	}

	
	public function getConversionEngines()
	{

		return $this->conversion_engines;
	}

	
	public function getConversionEnginesExtraParams()
	{

		return $this->conversion_engines_extra_params;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getViewOrder()
	{

		return $this->view_order;
	}

	
	public function getCreationMode()
	{

		return $this->creation_mode;
	}

	
	public function getDeinterlice()
	{

		return $this->deinterlice;
	}

	
	public function getRotate()
	{

		return $this->rotate;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = flavorParamsPeer::ID;
		}

	} 
	
	public function setVersion($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = flavorParamsPeer::VERSION;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = flavorParamsPeer::PARTNER_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = flavorParamsPeer::NAME;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = flavorParamsPeer::TAGS;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = flavorParamsPeer::DESCRIPTION;
		}

	} 
	
	public function setReadyBehavior($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ready_behavior !== $v) {
			$this->ready_behavior = $v;
			$this->modifiedColumns[] = flavorParamsPeer::READY_BEHAVIOR;
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
			$this->modifiedColumns[] = flavorParamsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = flavorParamsPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = flavorParamsPeer::DELETED_AT;
		}

	} 
	
	public function setIsDefault($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_default !== $v || $v === 0) {
			$this->is_default = $v;
			$this->modifiedColumns[] = flavorParamsPeer::IS_DEFAULT;
		}

	} 
	
	public function setFormat($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->format !== $v) {
			$this->format = $v;
			$this->modifiedColumns[] = flavorParamsPeer::FORMAT;
		}

	} 
	
	public function setVideoCodec($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->video_codec !== $v) {
			$this->video_codec = $v;
			$this->modifiedColumns[] = flavorParamsPeer::VIDEO_CODEC;
		}

	} 
	
	public function setVideoBitrate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_bitrate !== $v || $v === 0) {
			$this->video_bitrate = $v;
			$this->modifiedColumns[] = flavorParamsPeer::VIDEO_BITRATE;
		}

	} 
	
	public function setAudioCodec($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->audio_codec !== $v) {
			$this->audio_codec = $v;
			$this->modifiedColumns[] = flavorParamsPeer::AUDIO_CODEC;
		}

	} 
	
	public function setAudioBitrate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_bitrate !== $v || $v === 0) {
			$this->audio_bitrate = $v;
			$this->modifiedColumns[] = flavorParamsPeer::AUDIO_BITRATE;
		}

	} 
	
	public function setAudioChannels($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_channels !== $v || $v === 0) {
			$this->audio_channels = $v;
			$this->modifiedColumns[] = flavorParamsPeer::AUDIO_CHANNELS;
		}

	} 
	
	public function setAudioSampleRate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_sample_rate !== $v || $v === 0) {
			$this->audio_sample_rate = $v;
			$this->modifiedColumns[] = flavorParamsPeer::AUDIO_SAMPLE_RATE;
		}

	} 
	
	public function setAudioResolution($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_resolution !== $v || $v === 0) {
			$this->audio_resolution = $v;
			$this->modifiedColumns[] = flavorParamsPeer::AUDIO_RESOLUTION;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v || $v === 0) {
			$this->width = $v;
			$this->modifiedColumns[] = flavorParamsPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v || $v === 0) {
			$this->height = $v;
			$this->modifiedColumns[] = flavorParamsPeer::HEIGHT;
		}

	} 
	
	public function setFrameRate($v)
	{

		if ($this->frame_rate !== $v || $v === 0) {
			$this->frame_rate = $v;
			$this->modifiedColumns[] = flavorParamsPeer::FRAME_RATE;
		}

	} 
	
	public function setGopSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gop_size !== $v || $v === 0) {
			$this->gop_size = $v;
			$this->modifiedColumns[] = flavorParamsPeer::GOP_SIZE;
		}

	} 
	
	public function setTwoPass($v)
	{

		if ($this->two_pass !== $v || $v === false) {
			$this->two_pass = $v;
			$this->modifiedColumns[] = flavorParamsPeer::TWO_PASS;
		}

	} 
	
	public function setConversionEngines($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conversion_engines !== $v) {
			$this->conversion_engines = $v;
			$this->modifiedColumns[] = flavorParamsPeer::CONVERSION_ENGINES;
		}

	} 
	
	public function setConversionEnginesExtraParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conversion_engines_extra_params !== $v) {
			$this->conversion_engines_extra_params = $v;
			$this->modifiedColumns[] = flavorParamsPeer::CONVERSION_ENGINES_EXTRA_PARAMS;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = flavorParamsPeer::CUSTOM_DATA;
		}

	} 
	
	public function setViewOrder($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->view_order !== $v) {
			$this->view_order = $v;
			$this->modifiedColumns[] = flavorParamsPeer::VIEW_ORDER;
		}

	} 
	
	public function setCreationMode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->creation_mode !== $v || $v === 1) {
			$this->creation_mode = $v;
			$this->modifiedColumns[] = flavorParamsPeer::CREATION_MODE;
		}

	} 
	
	public function setDeinterlice($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deinterlice !== $v) {
			$this->deinterlice = $v;
			$this->modifiedColumns[] = flavorParamsPeer::DEINTERLICE;
		}

	} 
	
	public function setRotate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rotate !== $v) {
			$this->rotate = $v;
			$this->modifiedColumns[] = flavorParamsPeer::ROTATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->version = $rs->getInt($startcol + 1);

			$this->partner_id = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->tags = $rs->getString($startcol + 4);

			$this->description = $rs->getString($startcol + 5);

			$this->ready_behavior = $rs->getInt($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 9, null);

			$this->is_default = $rs->getInt($startcol + 10);

			$this->format = $rs->getString($startcol + 11);

			$this->video_codec = $rs->getString($startcol + 12);

			$this->video_bitrate = $rs->getInt($startcol + 13);

			$this->audio_codec = $rs->getString($startcol + 14);

			$this->audio_bitrate = $rs->getInt($startcol + 15);

			$this->audio_channels = $rs->getInt($startcol + 16);

			$this->audio_sample_rate = $rs->getInt($startcol + 17);

			$this->audio_resolution = $rs->getInt($startcol + 18);

			$this->width = $rs->getInt($startcol + 19);

			$this->height = $rs->getInt($startcol + 20);

			$this->frame_rate = $rs->getFloat($startcol + 21);

			$this->gop_size = $rs->getInt($startcol + 22);

			$this->two_pass = $rs->getBoolean($startcol + 23);

			$this->conversion_engines = $rs->getString($startcol + 24);

			$this->conversion_engines_extra_params = $rs->getString($startcol + 25);

			$this->custom_data = $rs->getString($startcol + 26);

			$this->view_order = $rs->getInt($startcol + 27);

			$this->creation_mode = $rs->getInt($startcol + 28);

			$this->deinterlice = $rs->getInt($startcol + 29);

			$this->rotate = $rs->getInt($startcol + 30);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 31; 
		} catch (Exception $e) {
			throw new PropelException("Error populating flavorParams object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			flavorParamsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(flavorParamsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(flavorParamsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsPeer::DATABASE_NAME);
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
					$pk = flavorParamsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += flavorParamsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collflavorParamsOutputs !== null) {
				foreach($this->collflavorParamsOutputs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collflavorAssets !== null) {
				foreach($this->collflavorAssets as $referrerFK) {
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


			if (($retval = flavorParamsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collflavorParamsOutputs !== null) {
					foreach($this->collflavorParamsOutputs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collflavorAssets !== null) {
					foreach($this->collflavorAssets as $referrerFK) {
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
		$pos = flavorParamsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getVersion();
				break;
			case 2:
				return $this->getPartnerId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getTags();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getReadyBehavior();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			case 9:
				return $this->getDeletedAt();
				break;
			case 10:
				return $this->getIsDefault();
				break;
			case 11:
				return $this->getFormat();
				break;
			case 12:
				return $this->getVideoCodec();
				break;
			case 13:
				return $this->getVideoBitrate();
				break;
			case 14:
				return $this->getAudioCodec();
				break;
			case 15:
				return $this->getAudioBitrate();
				break;
			case 16:
				return $this->getAudioChannels();
				break;
			case 17:
				return $this->getAudioSampleRate();
				break;
			case 18:
				return $this->getAudioResolution();
				break;
			case 19:
				return $this->getWidth();
				break;
			case 20:
				return $this->getHeight();
				break;
			case 21:
				return $this->getFrameRate();
				break;
			case 22:
				return $this->getGopSize();
				break;
			case 23:
				return $this->getTwoPass();
				break;
			case 24:
				return $this->getConversionEngines();
				break;
			case 25:
				return $this->getConversionEnginesExtraParams();
				break;
			case 26:
				return $this->getCustomData();
				break;
			case 27:
				return $this->getViewOrder();
				break;
			case 28:
				return $this->getCreationMode();
				break;
			case 29:
				return $this->getDeinterlice();
				break;
			case 30:
				return $this->getRotate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getVersion(),
			$keys[2] => $this->getPartnerId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getTags(),
			$keys[5] => $this->getDescription(),
			$keys[6] => $this->getReadyBehavior(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
			$keys[9] => $this->getDeletedAt(),
			$keys[10] => $this->getIsDefault(),
			$keys[11] => $this->getFormat(),
			$keys[12] => $this->getVideoCodec(),
			$keys[13] => $this->getVideoBitrate(),
			$keys[14] => $this->getAudioCodec(),
			$keys[15] => $this->getAudioBitrate(),
			$keys[16] => $this->getAudioChannels(),
			$keys[17] => $this->getAudioSampleRate(),
			$keys[18] => $this->getAudioResolution(),
			$keys[19] => $this->getWidth(),
			$keys[20] => $this->getHeight(),
			$keys[21] => $this->getFrameRate(),
			$keys[22] => $this->getGopSize(),
			$keys[23] => $this->getTwoPass(),
			$keys[24] => $this->getConversionEngines(),
			$keys[25] => $this->getConversionEnginesExtraParams(),
			$keys[26] => $this->getCustomData(),
			$keys[27] => $this->getViewOrder(),
			$keys[28] => $this->getCreationMode(),
			$keys[29] => $this->getDeinterlice(),
			$keys[30] => $this->getRotate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setVersion($value);
				break;
			case 2:
				$this->setPartnerId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setTags($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setReadyBehavior($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
			case 9:
				$this->setDeletedAt($value);
				break;
			case 10:
				$this->setIsDefault($value);
				break;
			case 11:
				$this->setFormat($value);
				break;
			case 12:
				$this->setVideoCodec($value);
				break;
			case 13:
				$this->setVideoBitrate($value);
				break;
			case 14:
				$this->setAudioCodec($value);
				break;
			case 15:
				$this->setAudioBitrate($value);
				break;
			case 16:
				$this->setAudioChannels($value);
				break;
			case 17:
				$this->setAudioSampleRate($value);
				break;
			case 18:
				$this->setAudioResolution($value);
				break;
			case 19:
				$this->setWidth($value);
				break;
			case 20:
				$this->setHeight($value);
				break;
			case 21:
				$this->setFrameRate($value);
				break;
			case 22:
				$this->setGopSize($value);
				break;
			case 23:
				$this->setTwoPass($value);
				break;
			case 24:
				$this->setConversionEngines($value);
				break;
			case 25:
				$this->setConversionEnginesExtraParams($value);
				break;
			case 26:
				$this->setCustomData($value);
				break;
			case 27:
				$this->setViewOrder($value);
				break;
			case 28:
				$this->setCreationMode($value);
				break;
			case 29:
				$this->setDeinterlice($value);
				break;
			case 30:
				$this->setRotate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVersion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTags($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setReadyBehavior($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDeletedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsDefault($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFormat($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setVideoCodec($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setVideoBitrate($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setAudioCodec($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAudioBitrate($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setAudioChannels($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setAudioSampleRate($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setAudioResolution($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setWidth($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setHeight($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setFrameRate($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setGopSize($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setTwoPass($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setConversionEngines($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setConversionEnginesExtraParams($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCustomData($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setViewOrder($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCreationMode($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setDeinterlice($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setRotate($arr[$keys[30]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(flavorParamsPeer::DATABASE_NAME);

		if ($this->isColumnModified(flavorParamsPeer::ID)) $criteria->add(flavorParamsPeer::ID, $this->id);
		if ($this->isColumnModified(flavorParamsPeer::VERSION)) $criteria->add(flavorParamsPeer::VERSION, $this->version);
		if ($this->isColumnModified(flavorParamsPeer::PARTNER_ID)) $criteria->add(flavorParamsPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(flavorParamsPeer::NAME)) $criteria->add(flavorParamsPeer::NAME, $this->name);
		if ($this->isColumnModified(flavorParamsPeer::TAGS)) $criteria->add(flavorParamsPeer::TAGS, $this->tags);
		if ($this->isColumnModified(flavorParamsPeer::DESCRIPTION)) $criteria->add(flavorParamsPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(flavorParamsPeer::READY_BEHAVIOR)) $criteria->add(flavorParamsPeer::READY_BEHAVIOR, $this->ready_behavior);
		if ($this->isColumnModified(flavorParamsPeer::CREATED_AT)) $criteria->add(flavorParamsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(flavorParamsPeer::UPDATED_AT)) $criteria->add(flavorParamsPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(flavorParamsPeer::DELETED_AT)) $criteria->add(flavorParamsPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(flavorParamsPeer::IS_DEFAULT)) $criteria->add(flavorParamsPeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(flavorParamsPeer::FORMAT)) $criteria->add(flavorParamsPeer::FORMAT, $this->format);
		if ($this->isColumnModified(flavorParamsPeer::VIDEO_CODEC)) $criteria->add(flavorParamsPeer::VIDEO_CODEC, $this->video_codec);
		if ($this->isColumnModified(flavorParamsPeer::VIDEO_BITRATE)) $criteria->add(flavorParamsPeer::VIDEO_BITRATE, $this->video_bitrate);
		if ($this->isColumnModified(flavorParamsPeer::AUDIO_CODEC)) $criteria->add(flavorParamsPeer::AUDIO_CODEC, $this->audio_codec);
		if ($this->isColumnModified(flavorParamsPeer::AUDIO_BITRATE)) $criteria->add(flavorParamsPeer::AUDIO_BITRATE, $this->audio_bitrate);
		if ($this->isColumnModified(flavorParamsPeer::AUDIO_CHANNELS)) $criteria->add(flavorParamsPeer::AUDIO_CHANNELS, $this->audio_channels);
		if ($this->isColumnModified(flavorParamsPeer::AUDIO_SAMPLE_RATE)) $criteria->add(flavorParamsPeer::AUDIO_SAMPLE_RATE, $this->audio_sample_rate);
		if ($this->isColumnModified(flavorParamsPeer::AUDIO_RESOLUTION)) $criteria->add(flavorParamsPeer::AUDIO_RESOLUTION, $this->audio_resolution);
		if ($this->isColumnModified(flavorParamsPeer::WIDTH)) $criteria->add(flavorParamsPeer::WIDTH, $this->width);
		if ($this->isColumnModified(flavorParamsPeer::HEIGHT)) $criteria->add(flavorParamsPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(flavorParamsPeer::FRAME_RATE)) $criteria->add(flavorParamsPeer::FRAME_RATE, $this->frame_rate);
		if ($this->isColumnModified(flavorParamsPeer::GOP_SIZE)) $criteria->add(flavorParamsPeer::GOP_SIZE, $this->gop_size);
		if ($this->isColumnModified(flavorParamsPeer::TWO_PASS)) $criteria->add(flavorParamsPeer::TWO_PASS, $this->two_pass);
		if ($this->isColumnModified(flavorParamsPeer::CONVERSION_ENGINES)) $criteria->add(flavorParamsPeer::CONVERSION_ENGINES, $this->conversion_engines);
		if ($this->isColumnModified(flavorParamsPeer::CONVERSION_ENGINES_EXTRA_PARAMS)) $criteria->add(flavorParamsPeer::CONVERSION_ENGINES_EXTRA_PARAMS, $this->conversion_engines_extra_params);
		if ($this->isColumnModified(flavorParamsPeer::CUSTOM_DATA)) $criteria->add(flavorParamsPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(flavorParamsPeer::VIEW_ORDER)) $criteria->add(flavorParamsPeer::VIEW_ORDER, $this->view_order);
		if ($this->isColumnModified(flavorParamsPeer::CREATION_MODE)) $criteria->add(flavorParamsPeer::CREATION_MODE, $this->creation_mode);
		if ($this->isColumnModified(flavorParamsPeer::DEINTERLICE)) $criteria->add(flavorParamsPeer::DEINTERLICE, $this->deinterlice);
		if ($this->isColumnModified(flavorParamsPeer::ROTATE)) $criteria->add(flavorParamsPeer::ROTATE, $this->rotate);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(flavorParamsPeer::DATABASE_NAME);

		$criteria->add(flavorParamsPeer::ID, $this->id);

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

		$copyObj->setVersion($this->version);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setName($this->name);

		$copyObj->setTags($this->tags);

		$copyObj->setDescription($this->description);

		$copyObj->setReadyBehavior($this->ready_behavior);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setFormat($this->format);

		$copyObj->setVideoCodec($this->video_codec);

		$copyObj->setVideoBitrate($this->video_bitrate);

		$copyObj->setAudioCodec($this->audio_codec);

		$copyObj->setAudioBitrate($this->audio_bitrate);

		$copyObj->setAudioChannels($this->audio_channels);

		$copyObj->setAudioSampleRate($this->audio_sample_rate);

		$copyObj->setAudioResolution($this->audio_resolution);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setFrameRate($this->frame_rate);

		$copyObj->setGopSize($this->gop_size);

		$copyObj->setTwoPass($this->two_pass);

		$copyObj->setConversionEngines($this->conversion_engines);

		$copyObj->setConversionEnginesExtraParams($this->conversion_engines_extra_params);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setViewOrder($this->view_order);

		$copyObj->setCreationMode($this->creation_mode);

		$copyObj->setDeinterlice($this->deinterlice);

		$copyObj->setRotate($this->rotate);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getflavorParamsOutputs() as $relObj) {
				$copyObj->addflavorParamsOutput($relObj->copy($deepCopy));
			}

			foreach($this->getflavorAssets() as $relObj) {
				$copyObj->addflavorAsset($relObj->copy($deepCopy));
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
			self::$peer = new flavorParamsPeer();
		}
		return self::$peer;
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

				$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

				flavorParamsOutputPeer::addSelectColumns($criteria);
				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

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

		$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

		return flavorParamsOutputPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addflavorParamsOutput(flavorParamsOutput $l)
	{
		$this->collflavorParamsOutputs[] = $l;
		$l->setflavorParams($this);
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

				$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

			if (!isset($this->lastflavorParamsOutputCriteria) || !$this->lastflavorParamsOutputCriteria->equals($criteria)) {
				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastflavorParamsOutputCriteria = $criteria;

		return $this->collflavorParamsOutputs;
	}


	
	public function getflavorParamsOutputsJoinflavorAsset($criteria = null, $con = null)
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

				$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinflavorAsset($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->getId());

			if (!isset($this->lastflavorParamsOutputCriteria) || !$this->lastflavorParamsOutputCriteria->equals($criteria)) {
				$this->collflavorParamsOutputs = flavorParamsOutputPeer::doSelectJoinflavorAsset($criteria, $con);
			}
		}
		$this->lastflavorParamsOutputCriteria = $criteria;

		return $this->collflavorParamsOutputs;
	}

	
	public function initflavorAssets()
	{
		if ($this->collflavorAssets === null) {
			$this->collflavorAssets = array();
		}
	}

	
	public function getflavorAssets($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorAssetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorAssets === null) {
			if ($this->isNew()) {
			   $this->collflavorAssets = array();
			} else {

				$criteria->add(flavorAssetPeer::FLAVOR_PARAMS_ID, $this->getId());

				flavorAssetPeer::addSelectColumns($criteria);
				$this->collflavorAssets = flavorAssetPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(flavorAssetPeer::FLAVOR_PARAMS_ID, $this->getId());

				flavorAssetPeer::addSelectColumns($criteria);
				if (!isset($this->lastflavorAssetCriteria) || !$this->lastflavorAssetCriteria->equals($criteria)) {
					$this->collflavorAssets = flavorAssetPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastflavorAssetCriteria = $criteria;
		return $this->collflavorAssets;
	}

	
	public function countflavorAssets($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseflavorAssetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(flavorAssetPeer::FLAVOR_PARAMS_ID, $this->getId());

		return flavorAssetPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addflavorAsset(flavorAsset $l)
	{
		$this->collflavorAssets[] = $l;
		$l->setflavorParams($this);
	}


	
	public function getflavorAssetsJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflavorAssetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflavorAssets === null) {
			if ($this->isNew()) {
				$this->collflavorAssets = array();
			} else {

				$criteria->add(flavorAssetPeer::FLAVOR_PARAMS_ID, $this->getId());

				$this->collflavorAssets = flavorAssetPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorAssetPeer::FLAVOR_PARAMS_ID, $this->getId());

			if (!isset($this->lastflavorAssetCriteria) || !$this->lastflavorAssetCriteria->equals($criteria)) {
				$this->collflavorAssets = flavorAssetPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastflavorAssetCriteria = $criteria;

		return $this->collflavorAssets;
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

				$criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->getId());

				flavorParamsConversionProfilePeer::addSelectColumns($criteria);
				$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->getId());

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

		$criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->getId());

		return flavorParamsConversionProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addflavorParamsConversionProfile(flavorParamsConversionProfile $l)
	{
		$this->collflavorParamsConversionProfiles[] = $l;
		$l->setflavorParams($this);
	}


	
	public function getflavorParamsConversionProfilesJoinconversionProfile2($criteria = null, $con = null)
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

				$criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->getId());

				$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelectJoinconversionProfile2($criteria, $con);
			}
		} else {
									
			$criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->getId());

			if (!isset($this->lastflavorParamsConversionProfileCriteria) || !$this->lastflavorParamsConversionProfileCriteria->equals($criteria)) {
				$this->collflavorParamsConversionProfiles = flavorParamsConversionProfilePeer::doSelectJoinconversionProfile2($criteria, $con);
			}
		}
		$this->lastflavorParamsConversionProfileCriteria = $criteria;

		return $this->collflavorParamsConversionProfiles;
	}

} 