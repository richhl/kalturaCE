<?php


abstract class BasemediaInfo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $flavor_asset_id = 'null';


	
	protected $file_size;


	
	protected $container_format;


	
	protected $container_id;


	
	protected $container_profile;


	
	protected $container_duration;


	
	protected $container_bit_rate;


	
	protected $video_format;


	
	protected $video_codec_id;


	
	protected $video_duration;


	
	protected $video_bit_rate;


	
	protected $video_bit_rate_mode;


	
	protected $video_width;


	
	protected $video_height;


	
	protected $video_frame_rate;


	
	protected $video_dar;


	
	protected $video_rotation;


	
	protected $audio_format;


	
	protected $audio_codec_id;


	
	protected $audio_duration;


	
	protected $audio_bit_rate;


	
	protected $audio_bit_rate_mode;


	
	protected $audio_channels;


	
	protected $audio_sampling_rate;


	
	protected $audio_resolution;


	
	protected $writing_lib;


	
	protected $custom_data;


	
	protected $raw_data;


	
	protected $multi_stream_info;


	
	protected $flavor_asset_version;


	
	protected $scan_type;


	
	protected $multi_stream;

	
	protected $aflavorAsset;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
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

	
	public function getFlavorAssetId()
	{

		return $this->flavor_asset_id;
	}

	
	public function getFileSize()
	{

		return $this->file_size;
	}

	
	public function getContainerFormat()
	{

		return $this->container_format;
	}

	
	public function getContainerId()
	{

		return $this->container_id;
	}

	
	public function getContainerProfile()
	{

		return $this->container_profile;
	}

	
	public function getContainerDuration()
	{

		return $this->container_duration;
	}

	
	public function getContainerBitRate()
	{

		return $this->container_bit_rate;
	}

	
	public function getVideoFormat()
	{

		return $this->video_format;
	}

	
	public function getVideoCodecId()
	{

		return $this->video_codec_id;
	}

	
	public function getVideoDuration()
	{

		return $this->video_duration;
	}

	
	public function getVideoBitRate()
	{

		return $this->video_bit_rate;
	}

	
	public function getVideoBitRateMode()
	{

		return $this->video_bit_rate_mode;
	}

	
	public function getVideoWidth()
	{

		return $this->video_width;
	}

	
	public function getVideoHeight()
	{

		return $this->video_height;
	}

	
	public function getVideoFrameRate()
	{

		return $this->video_frame_rate;
	}

	
	public function getVideoDar()
	{

		return $this->video_dar;
	}

	
	public function getVideoRotation()
	{

		return $this->video_rotation;
	}

	
	public function getAudioFormat()
	{

		return $this->audio_format;
	}

	
	public function getAudioCodecId()
	{

		return $this->audio_codec_id;
	}

	
	public function getAudioDuration()
	{

		return $this->audio_duration;
	}

	
	public function getAudioBitRate()
	{

		return $this->audio_bit_rate;
	}

	
	public function getAudioBitRateMode()
	{

		return $this->audio_bit_rate_mode;
	}

	
	public function getAudioChannels()
	{

		return $this->audio_channels;
	}

	
	public function getAudioSamplingRate()
	{

		return $this->audio_sampling_rate;
	}

	
	public function getAudioResolution()
	{

		return $this->audio_resolution;
	}

	
	public function getWritingLib()
	{

		return $this->writing_lib;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getRawData()
	{

		return $this->raw_data;
	}

	
	public function getMultiStreamInfo()
	{

		return $this->multi_stream_info;
	}

	
	public function getFlavorAssetVersion()
	{

		return $this->flavor_asset_version;
	}

	
	public function getScanType()
	{

		return $this->scan_type;
	}

	
	public function getMultiStream()
	{

		return $this->multi_stream;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = mediaInfoPeer::ID;
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
			$this->modifiedColumns[] = mediaInfoPeer::CREATED_AT;
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
			$this->modifiedColumns[] = mediaInfoPeer::UPDATED_AT;
		}

	} 
	
	public function setFlavorAssetId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->flavor_asset_id !== $v || $v === 'null') {
			$this->flavor_asset_id = $v;
			$this->modifiedColumns[] = mediaInfoPeer::FLAVOR_ASSET_ID;
		}

		if ($this->aflavorAsset !== null && $this->aflavorAsset->getId() !== $v) {
			$this->aflavorAsset = null;
		}

	} 
	
	public function setFileSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_size !== $v) {
			$this->file_size = $v;
			$this->modifiedColumns[] = mediaInfoPeer::FILE_SIZE;
		}

	} 
	
	public function setContainerFormat($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->container_format !== $v) {
			$this->container_format = $v;
			$this->modifiedColumns[] = mediaInfoPeer::CONTAINER_FORMAT;
		}

	} 
	
	public function setContainerId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->container_id !== $v) {
			$this->container_id = $v;
			$this->modifiedColumns[] = mediaInfoPeer::CONTAINER_ID;
		}

	} 
	
	public function setContainerProfile($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->container_profile !== $v) {
			$this->container_profile = $v;
			$this->modifiedColumns[] = mediaInfoPeer::CONTAINER_PROFILE;
		}

	} 
	
	public function setContainerDuration($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->container_duration !== $v) {
			$this->container_duration = $v;
			$this->modifiedColumns[] = mediaInfoPeer::CONTAINER_DURATION;
		}

	} 
	
	public function setContainerBitRate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->container_bit_rate !== $v) {
			$this->container_bit_rate = $v;
			$this->modifiedColumns[] = mediaInfoPeer::CONTAINER_BIT_RATE;
		}

	} 
	
	public function setVideoFormat($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->video_format !== $v) {
			$this->video_format = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_FORMAT;
		}

	} 
	
	public function setVideoCodecId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->video_codec_id !== $v) {
			$this->video_codec_id = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_CODEC_ID;
		}

	} 
	
	public function setVideoDuration($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_duration !== $v) {
			$this->video_duration = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_DURATION;
		}

	} 
	
	public function setVideoBitRate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_bit_rate !== $v) {
			$this->video_bit_rate = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_BIT_RATE;
		}

	} 
	
	public function setVideoBitRateMode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_bit_rate_mode !== $v) {
			$this->video_bit_rate_mode = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_BIT_RATE_MODE;
		}

	} 
	
	public function setVideoWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_width !== $v) {
			$this->video_width = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_WIDTH;
		}

	} 
	
	public function setVideoHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_height !== $v) {
			$this->video_height = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_HEIGHT;
		}

	} 
	
	public function setVideoFrameRate($v)
	{

		if ($this->video_frame_rate !== $v) {
			$this->video_frame_rate = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_FRAME_RATE;
		}

	} 
	
	public function setVideoDar($v)
	{

		if ($this->video_dar !== $v) {
			$this->video_dar = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_DAR;
		}

	} 
	
	public function setVideoRotation($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->video_rotation !== $v) {
			$this->video_rotation = $v;
			$this->modifiedColumns[] = mediaInfoPeer::VIDEO_ROTATION;
		}

	} 
	
	public function setAudioFormat($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->audio_format !== $v) {
			$this->audio_format = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_FORMAT;
		}

	} 
	
	public function setAudioCodecId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->audio_codec_id !== $v) {
			$this->audio_codec_id = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_CODEC_ID;
		}

	} 
	
	public function setAudioDuration($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_duration !== $v) {
			$this->audio_duration = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_DURATION;
		}

	} 
	
	public function setAudioBitRate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_bit_rate !== $v) {
			$this->audio_bit_rate = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_BIT_RATE;
		}

	} 
	
	public function setAudioBitRateMode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_bit_rate_mode !== $v) {
			$this->audio_bit_rate_mode = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_BIT_RATE_MODE;
		}

	} 
	
	public function setAudioChannels($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_channels !== $v) {
			$this->audio_channels = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_CHANNELS;
		}

	} 
	
	public function setAudioSamplingRate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_sampling_rate !== $v) {
			$this->audio_sampling_rate = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_SAMPLING_RATE;
		}

	} 
	
	public function setAudioResolution($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audio_resolution !== $v) {
			$this->audio_resolution = $v;
			$this->modifiedColumns[] = mediaInfoPeer::AUDIO_RESOLUTION;
		}

	} 
	
	public function setWritingLib($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->writing_lib !== $v) {
			$this->writing_lib = $v;
			$this->modifiedColumns[] = mediaInfoPeer::WRITING_LIB;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = mediaInfoPeer::CUSTOM_DATA;
		}

	} 
	
	public function setRawData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->raw_data !== $v) {
			$this->raw_data = $v;
			$this->modifiedColumns[] = mediaInfoPeer::RAW_DATA;
		}

	} 
	
	public function setMultiStreamInfo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->multi_stream_info !== $v) {
			$this->multi_stream_info = $v;
			$this->modifiedColumns[] = mediaInfoPeer::MULTI_STREAM_INFO;
		}

	} 
	
	public function setFlavorAssetVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->flavor_asset_version !== $v) {
			$this->flavor_asset_version = $v;
			$this->modifiedColumns[] = mediaInfoPeer::FLAVOR_ASSET_VERSION;
		}

	} 
	
	public function setScanType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scan_type !== $v) {
			$this->scan_type = $v;
			$this->modifiedColumns[] = mediaInfoPeer::SCAN_TYPE;
		}

	} 
	
	public function setMultiStream($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->multi_stream !== $v) {
			$this->multi_stream = $v;
			$this->modifiedColumns[] = mediaInfoPeer::MULTI_STREAM;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->flavor_asset_id = $rs->getString($startcol + 3);

			$this->file_size = $rs->getInt($startcol + 4);

			$this->container_format = $rs->getString($startcol + 5);

			$this->container_id = $rs->getString($startcol + 6);

			$this->container_profile = $rs->getString($startcol + 7);

			$this->container_duration = $rs->getInt($startcol + 8);

			$this->container_bit_rate = $rs->getInt($startcol + 9);

			$this->video_format = $rs->getString($startcol + 10);

			$this->video_codec_id = $rs->getString($startcol + 11);

			$this->video_duration = $rs->getInt($startcol + 12);

			$this->video_bit_rate = $rs->getInt($startcol + 13);

			$this->video_bit_rate_mode = $rs->getInt($startcol + 14);

			$this->video_width = $rs->getInt($startcol + 15);

			$this->video_height = $rs->getInt($startcol + 16);

			$this->video_frame_rate = $rs->getFloat($startcol + 17);

			$this->video_dar = $rs->getFloat($startcol + 18);

			$this->video_rotation = $rs->getInt($startcol + 19);

			$this->audio_format = $rs->getString($startcol + 20);

			$this->audio_codec_id = $rs->getString($startcol + 21);

			$this->audio_duration = $rs->getInt($startcol + 22);

			$this->audio_bit_rate = $rs->getInt($startcol + 23);

			$this->audio_bit_rate_mode = $rs->getInt($startcol + 24);

			$this->audio_channels = $rs->getInt($startcol + 25);

			$this->audio_sampling_rate = $rs->getInt($startcol + 26);

			$this->audio_resolution = $rs->getInt($startcol + 27);

			$this->writing_lib = $rs->getString($startcol + 28);

			$this->custom_data = $rs->getString($startcol + 29);

			$this->raw_data = $rs->getString($startcol + 30);

			$this->multi_stream_info = $rs->getString($startcol + 31);

			$this->flavor_asset_version = $rs->getString($startcol + 32);

			$this->scan_type = $rs->getInt($startcol + 33);

			$this->multi_stream = $rs->getString($startcol + 34);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 35; 
		} catch (Exception $e) {
			throw new PropelException("Error populating mediaInfo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(mediaInfoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			mediaInfoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(mediaInfoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(mediaInfoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(mediaInfoPeer::DATABASE_NAME);
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


												
			if ($this->aflavorAsset !== null) {
				if ($this->aflavorAsset->isModified()) {
					$affectedRows += $this->aflavorAsset->save($con);
				}
				$this->setflavorAsset($this->aflavorAsset);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = mediaInfoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += mediaInfoPeer::doUpdate($this, $con);
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


												
			if ($this->aflavorAsset !== null) {
				if (!$this->aflavorAsset->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aflavorAsset->getValidationFailures());
				}
			}


			if (($retval = mediaInfoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = mediaInfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getFlavorAssetId();
				break;
			case 4:
				return $this->getFileSize();
				break;
			case 5:
				return $this->getContainerFormat();
				break;
			case 6:
				return $this->getContainerId();
				break;
			case 7:
				return $this->getContainerProfile();
				break;
			case 8:
				return $this->getContainerDuration();
				break;
			case 9:
				return $this->getContainerBitRate();
				break;
			case 10:
				return $this->getVideoFormat();
				break;
			case 11:
				return $this->getVideoCodecId();
				break;
			case 12:
				return $this->getVideoDuration();
				break;
			case 13:
				return $this->getVideoBitRate();
				break;
			case 14:
				return $this->getVideoBitRateMode();
				break;
			case 15:
				return $this->getVideoWidth();
				break;
			case 16:
				return $this->getVideoHeight();
				break;
			case 17:
				return $this->getVideoFrameRate();
				break;
			case 18:
				return $this->getVideoDar();
				break;
			case 19:
				return $this->getVideoRotation();
				break;
			case 20:
				return $this->getAudioFormat();
				break;
			case 21:
				return $this->getAudioCodecId();
				break;
			case 22:
				return $this->getAudioDuration();
				break;
			case 23:
				return $this->getAudioBitRate();
				break;
			case 24:
				return $this->getAudioBitRateMode();
				break;
			case 25:
				return $this->getAudioChannels();
				break;
			case 26:
				return $this->getAudioSamplingRate();
				break;
			case 27:
				return $this->getAudioResolution();
				break;
			case 28:
				return $this->getWritingLib();
				break;
			case 29:
				return $this->getCustomData();
				break;
			case 30:
				return $this->getRawData();
				break;
			case 31:
				return $this->getMultiStreamInfo();
				break;
			case 32:
				return $this->getFlavorAssetVersion();
				break;
			case 33:
				return $this->getScanType();
				break;
			case 34:
				return $this->getMultiStream();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = mediaInfoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getFlavorAssetId(),
			$keys[4] => $this->getFileSize(),
			$keys[5] => $this->getContainerFormat(),
			$keys[6] => $this->getContainerId(),
			$keys[7] => $this->getContainerProfile(),
			$keys[8] => $this->getContainerDuration(),
			$keys[9] => $this->getContainerBitRate(),
			$keys[10] => $this->getVideoFormat(),
			$keys[11] => $this->getVideoCodecId(),
			$keys[12] => $this->getVideoDuration(),
			$keys[13] => $this->getVideoBitRate(),
			$keys[14] => $this->getVideoBitRateMode(),
			$keys[15] => $this->getVideoWidth(),
			$keys[16] => $this->getVideoHeight(),
			$keys[17] => $this->getVideoFrameRate(),
			$keys[18] => $this->getVideoDar(),
			$keys[19] => $this->getVideoRotation(),
			$keys[20] => $this->getAudioFormat(),
			$keys[21] => $this->getAudioCodecId(),
			$keys[22] => $this->getAudioDuration(),
			$keys[23] => $this->getAudioBitRate(),
			$keys[24] => $this->getAudioBitRateMode(),
			$keys[25] => $this->getAudioChannels(),
			$keys[26] => $this->getAudioSamplingRate(),
			$keys[27] => $this->getAudioResolution(),
			$keys[28] => $this->getWritingLib(),
			$keys[29] => $this->getCustomData(),
			$keys[30] => $this->getRawData(),
			$keys[31] => $this->getMultiStreamInfo(),
			$keys[32] => $this->getFlavorAssetVersion(),
			$keys[33] => $this->getScanType(),
			$keys[34] => $this->getMultiStream(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = mediaInfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setFlavorAssetId($value);
				break;
			case 4:
				$this->setFileSize($value);
				break;
			case 5:
				$this->setContainerFormat($value);
				break;
			case 6:
				$this->setContainerId($value);
				break;
			case 7:
				$this->setContainerProfile($value);
				break;
			case 8:
				$this->setContainerDuration($value);
				break;
			case 9:
				$this->setContainerBitRate($value);
				break;
			case 10:
				$this->setVideoFormat($value);
				break;
			case 11:
				$this->setVideoCodecId($value);
				break;
			case 12:
				$this->setVideoDuration($value);
				break;
			case 13:
				$this->setVideoBitRate($value);
				break;
			case 14:
				$this->setVideoBitRateMode($value);
				break;
			case 15:
				$this->setVideoWidth($value);
				break;
			case 16:
				$this->setVideoHeight($value);
				break;
			case 17:
				$this->setVideoFrameRate($value);
				break;
			case 18:
				$this->setVideoDar($value);
				break;
			case 19:
				$this->setVideoRotation($value);
				break;
			case 20:
				$this->setAudioFormat($value);
				break;
			case 21:
				$this->setAudioCodecId($value);
				break;
			case 22:
				$this->setAudioDuration($value);
				break;
			case 23:
				$this->setAudioBitRate($value);
				break;
			case 24:
				$this->setAudioBitRateMode($value);
				break;
			case 25:
				$this->setAudioChannels($value);
				break;
			case 26:
				$this->setAudioSamplingRate($value);
				break;
			case 27:
				$this->setAudioResolution($value);
				break;
			case 28:
				$this->setWritingLib($value);
				break;
			case 29:
				$this->setCustomData($value);
				break;
			case 30:
				$this->setRawData($value);
				break;
			case 31:
				$this->setMultiStreamInfo($value);
				break;
			case 32:
				$this->setFlavorAssetVersion($value);
				break;
			case 33:
				$this->setScanType($value);
				break;
			case 34:
				$this->setMultiStream($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = mediaInfoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFlavorAssetId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFileSize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setContainerFormat($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setContainerId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setContainerProfile($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setContainerDuration($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setContainerBitRate($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setVideoFormat($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setVideoCodecId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setVideoDuration($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setVideoBitRate($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setVideoBitRateMode($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setVideoWidth($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setVideoHeight($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setVideoFrameRate($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setVideoDar($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setVideoRotation($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setAudioFormat($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setAudioCodecId($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setAudioDuration($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setAudioBitRate($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setAudioBitRateMode($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setAudioChannels($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setAudioSamplingRate($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setAudioResolution($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setWritingLib($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCustomData($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setRawData($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setMultiStreamInfo($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setFlavorAssetVersion($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setScanType($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setMultiStream($arr[$keys[34]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(mediaInfoPeer::DATABASE_NAME);

		if ($this->isColumnModified(mediaInfoPeer::ID)) $criteria->add(mediaInfoPeer::ID, $this->id);
		if ($this->isColumnModified(mediaInfoPeer::CREATED_AT)) $criteria->add(mediaInfoPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(mediaInfoPeer::UPDATED_AT)) $criteria->add(mediaInfoPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(mediaInfoPeer::FLAVOR_ASSET_ID)) $criteria->add(mediaInfoPeer::FLAVOR_ASSET_ID, $this->flavor_asset_id);
		if ($this->isColumnModified(mediaInfoPeer::FILE_SIZE)) $criteria->add(mediaInfoPeer::FILE_SIZE, $this->file_size);
		if ($this->isColumnModified(mediaInfoPeer::CONTAINER_FORMAT)) $criteria->add(mediaInfoPeer::CONTAINER_FORMAT, $this->container_format);
		if ($this->isColumnModified(mediaInfoPeer::CONTAINER_ID)) $criteria->add(mediaInfoPeer::CONTAINER_ID, $this->container_id);
		if ($this->isColumnModified(mediaInfoPeer::CONTAINER_PROFILE)) $criteria->add(mediaInfoPeer::CONTAINER_PROFILE, $this->container_profile);
		if ($this->isColumnModified(mediaInfoPeer::CONTAINER_DURATION)) $criteria->add(mediaInfoPeer::CONTAINER_DURATION, $this->container_duration);
		if ($this->isColumnModified(mediaInfoPeer::CONTAINER_BIT_RATE)) $criteria->add(mediaInfoPeer::CONTAINER_BIT_RATE, $this->container_bit_rate);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_FORMAT)) $criteria->add(mediaInfoPeer::VIDEO_FORMAT, $this->video_format);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_CODEC_ID)) $criteria->add(mediaInfoPeer::VIDEO_CODEC_ID, $this->video_codec_id);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_DURATION)) $criteria->add(mediaInfoPeer::VIDEO_DURATION, $this->video_duration);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_BIT_RATE)) $criteria->add(mediaInfoPeer::VIDEO_BIT_RATE, $this->video_bit_rate);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_BIT_RATE_MODE)) $criteria->add(mediaInfoPeer::VIDEO_BIT_RATE_MODE, $this->video_bit_rate_mode);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_WIDTH)) $criteria->add(mediaInfoPeer::VIDEO_WIDTH, $this->video_width);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_HEIGHT)) $criteria->add(mediaInfoPeer::VIDEO_HEIGHT, $this->video_height);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_FRAME_RATE)) $criteria->add(mediaInfoPeer::VIDEO_FRAME_RATE, $this->video_frame_rate);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_DAR)) $criteria->add(mediaInfoPeer::VIDEO_DAR, $this->video_dar);
		if ($this->isColumnModified(mediaInfoPeer::VIDEO_ROTATION)) $criteria->add(mediaInfoPeer::VIDEO_ROTATION, $this->video_rotation);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_FORMAT)) $criteria->add(mediaInfoPeer::AUDIO_FORMAT, $this->audio_format);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_CODEC_ID)) $criteria->add(mediaInfoPeer::AUDIO_CODEC_ID, $this->audio_codec_id);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_DURATION)) $criteria->add(mediaInfoPeer::AUDIO_DURATION, $this->audio_duration);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_BIT_RATE)) $criteria->add(mediaInfoPeer::AUDIO_BIT_RATE, $this->audio_bit_rate);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_BIT_RATE_MODE)) $criteria->add(mediaInfoPeer::AUDIO_BIT_RATE_MODE, $this->audio_bit_rate_mode);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_CHANNELS)) $criteria->add(mediaInfoPeer::AUDIO_CHANNELS, $this->audio_channels);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_SAMPLING_RATE)) $criteria->add(mediaInfoPeer::AUDIO_SAMPLING_RATE, $this->audio_sampling_rate);
		if ($this->isColumnModified(mediaInfoPeer::AUDIO_RESOLUTION)) $criteria->add(mediaInfoPeer::AUDIO_RESOLUTION, $this->audio_resolution);
		if ($this->isColumnModified(mediaInfoPeer::WRITING_LIB)) $criteria->add(mediaInfoPeer::WRITING_LIB, $this->writing_lib);
		if ($this->isColumnModified(mediaInfoPeer::CUSTOM_DATA)) $criteria->add(mediaInfoPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(mediaInfoPeer::RAW_DATA)) $criteria->add(mediaInfoPeer::RAW_DATA, $this->raw_data);
		if ($this->isColumnModified(mediaInfoPeer::MULTI_STREAM_INFO)) $criteria->add(mediaInfoPeer::MULTI_STREAM_INFO, $this->multi_stream_info);
		if ($this->isColumnModified(mediaInfoPeer::FLAVOR_ASSET_VERSION)) $criteria->add(mediaInfoPeer::FLAVOR_ASSET_VERSION, $this->flavor_asset_version);
		if ($this->isColumnModified(mediaInfoPeer::SCAN_TYPE)) $criteria->add(mediaInfoPeer::SCAN_TYPE, $this->scan_type);
		if ($this->isColumnModified(mediaInfoPeer::MULTI_STREAM)) $criteria->add(mediaInfoPeer::MULTI_STREAM, $this->multi_stream);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(mediaInfoPeer::DATABASE_NAME);

		$criteria->add(mediaInfoPeer::ID, $this->id);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setFlavorAssetId($this->flavor_asset_id);

		$copyObj->setFileSize($this->file_size);

		$copyObj->setContainerFormat($this->container_format);

		$copyObj->setContainerId($this->container_id);

		$copyObj->setContainerProfile($this->container_profile);

		$copyObj->setContainerDuration($this->container_duration);

		$copyObj->setContainerBitRate($this->container_bit_rate);

		$copyObj->setVideoFormat($this->video_format);

		$copyObj->setVideoCodecId($this->video_codec_id);

		$copyObj->setVideoDuration($this->video_duration);

		$copyObj->setVideoBitRate($this->video_bit_rate);

		$copyObj->setVideoBitRateMode($this->video_bit_rate_mode);

		$copyObj->setVideoWidth($this->video_width);

		$copyObj->setVideoHeight($this->video_height);

		$copyObj->setVideoFrameRate($this->video_frame_rate);

		$copyObj->setVideoDar($this->video_dar);

		$copyObj->setVideoRotation($this->video_rotation);

		$copyObj->setAudioFormat($this->audio_format);

		$copyObj->setAudioCodecId($this->audio_codec_id);

		$copyObj->setAudioDuration($this->audio_duration);

		$copyObj->setAudioBitRate($this->audio_bit_rate);

		$copyObj->setAudioBitRateMode($this->audio_bit_rate_mode);

		$copyObj->setAudioChannels($this->audio_channels);

		$copyObj->setAudioSamplingRate($this->audio_sampling_rate);

		$copyObj->setAudioResolution($this->audio_resolution);

		$copyObj->setWritingLib($this->writing_lib);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setRawData($this->raw_data);

		$copyObj->setMultiStreamInfo($this->multi_stream_info);

		$copyObj->setFlavorAssetVersion($this->flavor_asset_version);

		$copyObj->setScanType($this->scan_type);

		$copyObj->setMultiStream($this->multi_stream);


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
			self::$peer = new mediaInfoPeer();
		}
		return self::$peer;
	}

	
	public function setflavorAsset($v)
	{


		if ($v === null) {
			$this->setFlavorAssetId('null');
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