<?php


abstract class BaseflavorParamsOutput extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $flavor_params_id;


	
	protected $flavor_params_version;


	
	protected $partner_id;


	
	protected $entry_id;


	
	protected $flavor_asset_id;


	
	protected $flavor_asset_version;


	
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


	
	protected $audio_codec = 'null';


	
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


	
	protected $command_lines;


	
	protected $file_ext;


	
	protected $deinterlice;


	
	protected $rotate;

	
	protected $aflavorParams;

	
	protected $aentry;

	
	protected $aflavorAsset;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getFlavorParamsId()
	{

		return $this->flavor_params_id;
	}

	
	public function getFlavorParamsVersion()
	{

		return $this->flavor_params_version;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getFlavorAssetId()
	{

		return $this->flavor_asset_id;
	}

	
	public function getFlavorAssetVersion()
	{

		return $this->flavor_asset_version;
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

	
	public function getCommandLines()
	{

		return $this->command_lines;
	}

	
	public function getFileExt()
	{

		return $this->file_ext;
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
			$this->modifiedColumns[] = flavorParamsOutputPeer::ID;
		}

	} 
	
	public function setFlavorParamsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flavor_params_id !== $v) {
			$this->flavor_params_id = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FLAVOR_PARAMS_ID;
		}

		if ($this->aflavorParams !== null && $this->aflavorParams->getId() !== $v) {
			$this->aflavorParams = null;
		}

	} 
	
	public function setFlavorParamsVersion($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flavor_params_version !== $v) {
			$this->flavor_params_version = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FLAVOR_PARAMS_VERSION;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::PARTNER_ID;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setFlavorAssetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->flavor_asset_id !== $v) {
			$this->flavor_asset_id = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FLAVOR_ASSET_ID;
		}

		if ($this->aflavorAsset !== null && $this->aflavorAsset->getId() !== $v) {
			$this->aflavorAsset = null;
		}

	} 
	
	public function setFlavorAssetVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->flavor_asset_version !== $v) {
			$this->flavor_asset_version = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FLAVOR_ASSET_VERSION;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::NAME;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::TAGS;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::DESCRIPTION;
		}

	} 
	
	public function setReadyBehavior($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ready_behavior !== $v) {
			$this->ready_behavior = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::READY_BEHAVIOR;
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
			$this->modifiedColumns[] = flavorParamsOutputPeer::CREATED_AT;
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
			$this->modifiedColumns[] = flavorParamsOutputPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = flavorParamsOutputPeer::DELETED_AT;
		}

	} 
	
	public function setIsDefault($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_default !== $v || $v === 0) {
			$this->is_default = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::IS_DEFAULT;
		}

	} 
	
	public function setFormat($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->format !== $v) {
			$this->format = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FORMAT;
		}

	} 
	
	public function setVideoCodec($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->video_codec !== $v) {
			$this->video_codec = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::VIDEO_CODEC;
		}

	} 
	
	public function setVideoBitrate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_bitrate !== $v || $v === 0) {
			$this->video_bitrate = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::VIDEO_BITRATE;
		}

	} 
	
	public function setAudioCodec($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->audio_codec !== $v || $v === 'null') {
			$this->audio_codec = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::AUDIO_CODEC;
		}

	} 
	
	public function setAudioBitrate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_bitrate !== $v || $v === 0) {
			$this->audio_bitrate = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::AUDIO_BITRATE;
		}

	} 
	
	public function setAudioChannels($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_channels !== $v || $v === 0) {
			$this->audio_channels = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::AUDIO_CHANNELS;
		}

	} 
	
	public function setAudioSampleRate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_sample_rate !== $v || $v === 0) {
			$this->audio_sample_rate = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::AUDIO_SAMPLE_RATE;
		}

	} 
	
	public function setAudioResolution($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_resolution !== $v || $v === 0) {
			$this->audio_resolution = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::AUDIO_RESOLUTION;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v || $v === 0) {
			$this->width = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v || $v === 0) {
			$this->height = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::HEIGHT;
		}

	} 
	
	public function setFrameRate($v)
	{

		if ($this->frame_rate !== $v || $v === 0) {
			$this->frame_rate = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FRAME_RATE;
		}

	} 
	
	public function setGopSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gop_size !== $v || $v === 0) {
			$this->gop_size = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::GOP_SIZE;
		}

	} 
	
	public function setTwoPass($v)
	{

		if ($this->two_pass !== $v || $v === false) {
			$this->two_pass = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::TWO_PASS;
		}

	} 
	
	public function setConversionEngines($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conversion_engines !== $v) {
			$this->conversion_engines = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::CONVERSION_ENGINES;
		}

	} 
	
	public function setConversionEnginesExtraParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conversion_engines_extra_params !== $v) {
			$this->conversion_engines_extra_params = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::CONVERSION_ENGINES_EXTRA_PARAMS;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::CUSTOM_DATA;
		}

	} 
	
	public function setCommandLines($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->command_lines !== $v) {
			$this->command_lines = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::COMMAND_LINES;
		}

	} 
	
	public function setFileExt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_ext !== $v) {
			$this->file_ext = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::FILE_EXT;
		}

	} 
	
	public function setDeinterlice($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deinterlice !== $v) {
			$this->deinterlice = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::DEINTERLICE;
		}

	} 
	
	public function setRotate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rotate !== $v) {
			$this->rotate = $v;
			$this->modifiedColumns[] = flavorParamsOutputPeer::ROTATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->flavor_params_id = $rs->getInt($startcol + 1);

			$this->flavor_params_version = $rs->getInt($startcol + 2);

			$this->partner_id = $rs->getInt($startcol + 3);

			$this->entry_id = $rs->getString($startcol + 4);

			$this->flavor_asset_id = $rs->getString($startcol + 5);

			$this->flavor_asset_version = $rs->getString($startcol + 6);

			$this->name = $rs->getString($startcol + 7);

			$this->tags = $rs->getString($startcol + 8);

			$this->description = $rs->getString($startcol + 9);

			$this->ready_behavior = $rs->getInt($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 13, null);

			$this->is_default = $rs->getInt($startcol + 14);

			$this->format = $rs->getString($startcol + 15);

			$this->video_codec = $rs->getString($startcol + 16);

			$this->video_bitrate = $rs->getInt($startcol + 17);

			$this->audio_codec = $rs->getString($startcol + 18);

			$this->audio_bitrate = $rs->getInt($startcol + 19);

			$this->audio_channels = $rs->getInt($startcol + 20);

			$this->audio_sample_rate = $rs->getInt($startcol + 21);

			$this->audio_resolution = $rs->getInt($startcol + 22);

			$this->width = $rs->getInt($startcol + 23);

			$this->height = $rs->getInt($startcol + 24);

			$this->frame_rate = $rs->getFloat($startcol + 25);

			$this->gop_size = $rs->getInt($startcol + 26);

			$this->two_pass = $rs->getBoolean($startcol + 27);

			$this->conversion_engines = $rs->getString($startcol + 28);

			$this->conversion_engines_extra_params = $rs->getString($startcol + 29);

			$this->custom_data = $rs->getString($startcol + 30);

			$this->command_lines = $rs->getString($startcol + 31);

			$this->file_ext = $rs->getString($startcol + 32);

			$this->deinterlice = $rs->getInt($startcol + 33);

			$this->rotate = $rs->getInt($startcol + 34);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 35; 
		} catch (Exception $e) {
			throw new PropelException("Error populating flavorParamsOutput object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsOutputPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			flavorParamsOutputPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(flavorParamsOutputPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(flavorParamsOutputPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsOutputPeer::DATABASE_NAME);
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


												
			if ($this->aflavorParams !== null) {
				if ($this->aflavorParams->isModified()) {
					$affectedRows += $this->aflavorParams->save($con);
				}
				$this->setflavorParams($this->aflavorParams);
			}

			if ($this->aentry !== null) {
				if ($this->aentry->isModified()) {
					$affectedRows += $this->aentry->save($con);
				}
				$this->setentry($this->aentry);
			}

			if ($this->aflavorAsset !== null) {
				if ($this->aflavorAsset->isModified()) {
					$affectedRows += $this->aflavorAsset->save($con);
				}
				$this->setflavorAsset($this->aflavorAsset);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = flavorParamsOutputPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += flavorParamsOutputPeer::doUpdate($this, $con);
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


												
			if ($this->aflavorParams !== null) {
				if (!$this->aflavorParams->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aflavorParams->getValidationFailures());
				}
			}

			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}

			if ($this->aflavorAsset !== null) {
				if (!$this->aflavorAsset->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aflavorAsset->getValidationFailures());
				}
			}


			if (($retval = flavorParamsOutputPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsOutputPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFlavorParamsId();
				break;
			case 2:
				return $this->getFlavorParamsVersion();
				break;
			case 3:
				return $this->getPartnerId();
				break;
			case 4:
				return $this->getEntryId();
				break;
			case 5:
				return $this->getFlavorAssetId();
				break;
			case 6:
				return $this->getFlavorAssetVersion();
				break;
			case 7:
				return $this->getName();
				break;
			case 8:
				return $this->getTags();
				break;
			case 9:
				return $this->getDescription();
				break;
			case 10:
				return $this->getReadyBehavior();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			case 13:
				return $this->getDeletedAt();
				break;
			case 14:
				return $this->getIsDefault();
				break;
			case 15:
				return $this->getFormat();
				break;
			case 16:
				return $this->getVideoCodec();
				break;
			case 17:
				return $this->getVideoBitrate();
				break;
			case 18:
				return $this->getAudioCodec();
				break;
			case 19:
				return $this->getAudioBitrate();
				break;
			case 20:
				return $this->getAudioChannels();
				break;
			case 21:
				return $this->getAudioSampleRate();
				break;
			case 22:
				return $this->getAudioResolution();
				break;
			case 23:
				return $this->getWidth();
				break;
			case 24:
				return $this->getHeight();
				break;
			case 25:
				return $this->getFrameRate();
				break;
			case 26:
				return $this->getGopSize();
				break;
			case 27:
				return $this->getTwoPass();
				break;
			case 28:
				return $this->getConversionEngines();
				break;
			case 29:
				return $this->getConversionEnginesExtraParams();
				break;
			case 30:
				return $this->getCustomData();
				break;
			case 31:
				return $this->getCommandLines();
				break;
			case 32:
				return $this->getFileExt();
				break;
			case 33:
				return $this->getDeinterlice();
				break;
			case 34:
				return $this->getRotate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsOutputPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFlavorParamsId(),
			$keys[2] => $this->getFlavorParamsVersion(),
			$keys[3] => $this->getPartnerId(),
			$keys[4] => $this->getEntryId(),
			$keys[5] => $this->getFlavorAssetId(),
			$keys[6] => $this->getFlavorAssetVersion(),
			$keys[7] => $this->getName(),
			$keys[8] => $this->getTags(),
			$keys[9] => $this->getDescription(),
			$keys[10] => $this->getReadyBehavior(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
			$keys[13] => $this->getDeletedAt(),
			$keys[14] => $this->getIsDefault(),
			$keys[15] => $this->getFormat(),
			$keys[16] => $this->getVideoCodec(),
			$keys[17] => $this->getVideoBitrate(),
			$keys[18] => $this->getAudioCodec(),
			$keys[19] => $this->getAudioBitrate(),
			$keys[20] => $this->getAudioChannels(),
			$keys[21] => $this->getAudioSampleRate(),
			$keys[22] => $this->getAudioResolution(),
			$keys[23] => $this->getWidth(),
			$keys[24] => $this->getHeight(),
			$keys[25] => $this->getFrameRate(),
			$keys[26] => $this->getGopSize(),
			$keys[27] => $this->getTwoPass(),
			$keys[28] => $this->getConversionEngines(),
			$keys[29] => $this->getConversionEnginesExtraParams(),
			$keys[30] => $this->getCustomData(),
			$keys[31] => $this->getCommandLines(),
			$keys[32] => $this->getFileExt(),
			$keys[33] => $this->getDeinterlice(),
			$keys[34] => $this->getRotate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsOutputPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFlavorParamsId($value);
				break;
			case 2:
				$this->setFlavorParamsVersion($value);
				break;
			case 3:
				$this->setPartnerId($value);
				break;
			case 4:
				$this->setEntryId($value);
				break;
			case 5:
				$this->setFlavorAssetId($value);
				break;
			case 6:
				$this->setFlavorAssetVersion($value);
				break;
			case 7:
				$this->setName($value);
				break;
			case 8:
				$this->setTags($value);
				break;
			case 9:
				$this->setDescription($value);
				break;
			case 10:
				$this->setReadyBehavior($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
			case 13:
				$this->setDeletedAt($value);
				break;
			case 14:
				$this->setIsDefault($value);
				break;
			case 15:
				$this->setFormat($value);
				break;
			case 16:
				$this->setVideoCodec($value);
				break;
			case 17:
				$this->setVideoBitrate($value);
				break;
			case 18:
				$this->setAudioCodec($value);
				break;
			case 19:
				$this->setAudioBitrate($value);
				break;
			case 20:
				$this->setAudioChannels($value);
				break;
			case 21:
				$this->setAudioSampleRate($value);
				break;
			case 22:
				$this->setAudioResolution($value);
				break;
			case 23:
				$this->setWidth($value);
				break;
			case 24:
				$this->setHeight($value);
				break;
			case 25:
				$this->setFrameRate($value);
				break;
			case 26:
				$this->setGopSize($value);
				break;
			case 27:
				$this->setTwoPass($value);
				break;
			case 28:
				$this->setConversionEngines($value);
				break;
			case 29:
				$this->setConversionEnginesExtraParams($value);
				break;
			case 30:
				$this->setCustomData($value);
				break;
			case 31:
				$this->setCommandLines($value);
				break;
			case 32:
				$this->setFileExt($value);
				break;
			case 33:
				$this->setDeinterlice($value);
				break;
			case 34:
				$this->setRotate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsOutputPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFlavorParamsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFlavorParamsVersion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPartnerId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEntryId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFlavorAssetId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFlavorAssetVersion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTags($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDescription($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setReadyBehavior($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDeletedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIsDefault($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setFormat($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setVideoCodec($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setVideoBitrate($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setAudioCodec($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setAudioBitrate($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setAudioChannels($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setAudioSampleRate($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setAudioResolution($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setWidth($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setHeight($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setFrameRate($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setGopSize($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setTwoPass($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setConversionEngines($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setConversionEnginesExtraParams($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCustomData($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCommandLines($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setFileExt($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setDeinterlice($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setRotate($arr[$keys[34]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(flavorParamsOutputPeer::DATABASE_NAME);

		if ($this->isColumnModified(flavorParamsOutputPeer::ID)) $criteria->add(flavorParamsOutputPeer::ID, $this->id);
		if ($this->isColumnModified(flavorParamsOutputPeer::FLAVOR_PARAMS_ID)) $criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_ID, $this->flavor_params_id);
		if ($this->isColumnModified(flavorParamsOutputPeer::FLAVOR_PARAMS_VERSION)) $criteria->add(flavorParamsOutputPeer::FLAVOR_PARAMS_VERSION, $this->flavor_params_version);
		if ($this->isColumnModified(flavorParamsOutputPeer::PARTNER_ID)) $criteria->add(flavorParamsOutputPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(flavorParamsOutputPeer::ENTRY_ID)) $criteria->add(flavorParamsOutputPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(flavorParamsOutputPeer::FLAVOR_ASSET_ID)) $criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $this->flavor_asset_id);
		if ($this->isColumnModified(flavorParamsOutputPeer::FLAVOR_ASSET_VERSION)) $criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_VERSION, $this->flavor_asset_version);
		if ($this->isColumnModified(flavorParamsOutputPeer::NAME)) $criteria->add(flavorParamsOutputPeer::NAME, $this->name);
		if ($this->isColumnModified(flavorParamsOutputPeer::TAGS)) $criteria->add(flavorParamsOutputPeer::TAGS, $this->tags);
		if ($this->isColumnModified(flavorParamsOutputPeer::DESCRIPTION)) $criteria->add(flavorParamsOutputPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(flavorParamsOutputPeer::READY_BEHAVIOR)) $criteria->add(flavorParamsOutputPeer::READY_BEHAVIOR, $this->ready_behavior);
		if ($this->isColumnModified(flavorParamsOutputPeer::CREATED_AT)) $criteria->add(flavorParamsOutputPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(flavorParamsOutputPeer::UPDATED_AT)) $criteria->add(flavorParamsOutputPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(flavorParamsOutputPeer::DELETED_AT)) $criteria->add(flavorParamsOutputPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(flavorParamsOutputPeer::IS_DEFAULT)) $criteria->add(flavorParamsOutputPeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(flavorParamsOutputPeer::FORMAT)) $criteria->add(flavorParamsOutputPeer::FORMAT, $this->format);
		if ($this->isColumnModified(flavorParamsOutputPeer::VIDEO_CODEC)) $criteria->add(flavorParamsOutputPeer::VIDEO_CODEC, $this->video_codec);
		if ($this->isColumnModified(flavorParamsOutputPeer::VIDEO_BITRATE)) $criteria->add(flavorParamsOutputPeer::VIDEO_BITRATE, $this->video_bitrate);
		if ($this->isColumnModified(flavorParamsOutputPeer::AUDIO_CODEC)) $criteria->add(flavorParamsOutputPeer::AUDIO_CODEC, $this->audio_codec);
		if ($this->isColumnModified(flavorParamsOutputPeer::AUDIO_BITRATE)) $criteria->add(flavorParamsOutputPeer::AUDIO_BITRATE, $this->audio_bitrate);
		if ($this->isColumnModified(flavorParamsOutputPeer::AUDIO_CHANNELS)) $criteria->add(flavorParamsOutputPeer::AUDIO_CHANNELS, $this->audio_channels);
		if ($this->isColumnModified(flavorParamsOutputPeer::AUDIO_SAMPLE_RATE)) $criteria->add(flavorParamsOutputPeer::AUDIO_SAMPLE_RATE, $this->audio_sample_rate);
		if ($this->isColumnModified(flavorParamsOutputPeer::AUDIO_RESOLUTION)) $criteria->add(flavorParamsOutputPeer::AUDIO_RESOLUTION, $this->audio_resolution);
		if ($this->isColumnModified(flavorParamsOutputPeer::WIDTH)) $criteria->add(flavorParamsOutputPeer::WIDTH, $this->width);
		if ($this->isColumnModified(flavorParamsOutputPeer::HEIGHT)) $criteria->add(flavorParamsOutputPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(flavorParamsOutputPeer::FRAME_RATE)) $criteria->add(flavorParamsOutputPeer::FRAME_RATE, $this->frame_rate);
		if ($this->isColumnModified(flavorParamsOutputPeer::GOP_SIZE)) $criteria->add(flavorParamsOutputPeer::GOP_SIZE, $this->gop_size);
		if ($this->isColumnModified(flavorParamsOutputPeer::TWO_PASS)) $criteria->add(flavorParamsOutputPeer::TWO_PASS, $this->two_pass);
		if ($this->isColumnModified(flavorParamsOutputPeer::CONVERSION_ENGINES)) $criteria->add(flavorParamsOutputPeer::CONVERSION_ENGINES, $this->conversion_engines);
		if ($this->isColumnModified(flavorParamsOutputPeer::CONVERSION_ENGINES_EXTRA_PARAMS)) $criteria->add(flavorParamsOutputPeer::CONVERSION_ENGINES_EXTRA_PARAMS, $this->conversion_engines_extra_params);
		if ($this->isColumnModified(flavorParamsOutputPeer::CUSTOM_DATA)) $criteria->add(flavorParamsOutputPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(flavorParamsOutputPeer::COMMAND_LINES)) $criteria->add(flavorParamsOutputPeer::COMMAND_LINES, $this->command_lines);
		if ($this->isColumnModified(flavorParamsOutputPeer::FILE_EXT)) $criteria->add(flavorParamsOutputPeer::FILE_EXT, $this->file_ext);
		if ($this->isColumnModified(flavorParamsOutputPeer::DEINTERLICE)) $criteria->add(flavorParamsOutputPeer::DEINTERLICE, $this->deinterlice);
		if ($this->isColumnModified(flavorParamsOutputPeer::ROTATE)) $criteria->add(flavorParamsOutputPeer::ROTATE, $this->rotate);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(flavorParamsOutputPeer::DATABASE_NAME);

		$criteria->add(flavorParamsOutputPeer::ID, $this->id);

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

		$copyObj->setFlavorParamsId($this->flavor_params_id);

		$copyObj->setFlavorParamsVersion($this->flavor_params_version);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setFlavorAssetId($this->flavor_asset_id);

		$copyObj->setFlavorAssetVersion($this->flavor_asset_version);

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

		$copyObj->setCommandLines($this->command_lines);

		$copyObj->setFileExt($this->file_ext);

		$copyObj->setDeinterlice($this->deinterlice);

		$copyObj->setRotate($this->rotate);


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
			self::$peer = new flavorParamsOutputPeer();
		}
		return self::$peer;
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

	
	public function setflavorAsset($v)
	{


		if ($v === null) {
			$this->setFlavorAssetId(NULL);
		} else {
			$this->setFlavorAssetId($v->getId());
		}


		$this->aflavorAsset = $v;
	}


	
	public function getflavorAsset($con = null)
	{
				include_once 'lib/model/om/BaseflavorAssetPeer.php';

		if ($this->aflavorAsset === null && (($this->flavor_asset_id !== "" && $this->flavor_asset_id !== null))) {

			$this->aflavorAsset = flavorAssetPeer::retrieveByPK($this->flavor_asset_id, $con);

			
		}
		return $this->aflavorAsset;
	}

} 