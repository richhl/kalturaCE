<?php


abstract class BaseBulkUploadResult extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $bulk_upload_job_id;


	
	protected $line_index;


	
	protected $partner_id;


	
	protected $entry_id;


	
	protected $entry_status;


	
	protected $row_data;


	
	protected $title;


	
	protected $description;


	
	protected $tags;


	
	protected $url;


	
	protected $content_type;


	
	protected $conversion_profile_id;


	
	protected $access_control_profile_id;


	
	protected $category;


	
	protected $schedule_start_date;


	
	protected $schedule_end_date;


	
	protected $thumbnail_url;


	
	protected $thumbnail_saved;


	
	protected $partner_data;


	
	protected $error_description;

	
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

	
	public function getBulkUploadJobId()
	{

		return $this->bulk_upload_job_id;
	}

	
	public function getLineIndex()
	{

		return $this->line_index;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getEntryStatus()
	{

		return $this->entry_status;
	}

	
	public function getRowData()
	{

		return $this->row_data;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getContentType()
	{

		return $this->content_type;
	}

	
	public function getConversionProfileId()
	{

		return $this->conversion_profile_id;
	}

	
	public function getAccessControlProfileId()
	{

		return $this->access_control_profile_id;
	}

	
	public function getCategory()
	{

		return $this->category;
	}

	
	public function getScheduleStartDate($format = 'Y-m-d H:i:s')
	{

		if ($this->schedule_start_date === null || $this->schedule_start_date === '') {
			return null;
		} elseif (!is_int($this->schedule_start_date)) {
						$ts = strtotime($this->schedule_start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [schedule_start_date] as date/time value: " . var_export($this->schedule_start_date, true));
			}
		} else {
			$ts = $this->schedule_start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getScheduleEndDate($format = 'Y-m-d H:i:s')
	{

		if ($this->schedule_end_date === null || $this->schedule_end_date === '') {
			return null;
		} elseif (!is_int($this->schedule_end_date)) {
						$ts = strtotime($this->schedule_end_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [schedule_end_date] as date/time value: " . var_export($this->schedule_end_date, true));
			}
		} else {
			$ts = $this->schedule_end_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getThumbnailUrl()
	{

		return $this->thumbnail_url;
	}

	
	public function getThumbnailSaved()
	{

		return $this->thumbnail_saved;
	}

	
	public function getPartnerData()
	{

		return $this->partner_data;
	}

	
	public function getErrorDescription()
	{

		return $this->error_description;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::ID;
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
			$this->modifiedColumns[] = BulkUploadResultPeer::CREATED_AT;
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
			$this->modifiedColumns[] = BulkUploadResultPeer::UPDATED_AT;
		}

	} 
	
	public function setBulkUploadJobId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bulk_upload_job_id !== $v) {
			$this->bulk_upload_job_id = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::BULK_UPLOAD_JOB_ID;
		}

	} 
	
	public function setLineIndex($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->line_index !== $v) {
			$this->line_index = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::LINE_INDEX;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::PARTNER_ID;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::ENTRY_ID;
		}

	} 
	
	public function setEntryStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entry_status !== $v) {
			$this->entry_status = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::ENTRY_STATUS;
		}

	} 
	
	public function setRowData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->row_data !== $v) {
			$this->row_data = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::ROW_DATA;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::TITLE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::DESCRIPTION;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::TAGS;
		}

	} 
	
	public function setUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::URL;
		}

	} 
	
	public function setContentType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content_type !== $v) {
			$this->content_type = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::CONTENT_TYPE;
		}

	} 
	
	public function setConversionProfileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->conversion_profile_id !== $v) {
			$this->conversion_profile_id = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::CONVERSION_PROFILE_ID;
		}

	} 
	
	public function setAccessControlProfileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->access_control_profile_id !== $v) {
			$this->access_control_profile_id = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::ACCESS_CONTROL_PROFILE_ID;
		}

	} 
	
	public function setCategory($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->category !== $v) {
			$this->category = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::CATEGORY;
		}

	} 
	
	public function setScheduleStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [schedule_start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->schedule_start_date !== $ts) {
			$this->schedule_start_date = $ts;
			$this->modifiedColumns[] = BulkUploadResultPeer::SCHEDULE_START_DATE;
		}

	} 
	
	public function setScheduleEndDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [schedule_end_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->schedule_end_date !== $ts) {
			$this->schedule_end_date = $ts;
			$this->modifiedColumns[] = BulkUploadResultPeer::SCHEDULE_END_DATE;
		}

	} 
	
	public function setThumbnailUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thumbnail_url !== $v) {
			$this->thumbnail_url = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::THUMBNAIL_URL;
		}

	} 
	
	public function setThumbnailSaved($v)
	{

		if ($this->thumbnail_saved !== $v) {
			$this->thumbnail_saved = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::THUMBNAIL_SAVED;
		}

	} 
	
	public function setPartnerData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_data !== $v) {
			$this->partner_data = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::PARTNER_DATA;
		}

	} 
	
	public function setErrorDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->error_description !== $v) {
			$this->error_description = $v;
			$this->modifiedColumns[] = BulkUploadResultPeer::ERROR_DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->bulk_upload_job_id = $rs->getInt($startcol + 3);

			$this->line_index = $rs->getInt($startcol + 4);

			$this->partner_id = $rs->getInt($startcol + 5);

			$this->entry_id = $rs->getString($startcol + 6);

			$this->entry_status = $rs->getInt($startcol + 7);

			$this->row_data = $rs->getString($startcol + 8);

			$this->title = $rs->getString($startcol + 9);

			$this->description = $rs->getString($startcol + 10);

			$this->tags = $rs->getString($startcol + 11);

			$this->url = $rs->getString($startcol + 12);

			$this->content_type = $rs->getString($startcol + 13);

			$this->conversion_profile_id = $rs->getInt($startcol + 14);

			$this->access_control_profile_id = $rs->getInt($startcol + 15);

			$this->category = $rs->getString($startcol + 16);

			$this->schedule_start_date = $rs->getTimestamp($startcol + 17, null);

			$this->schedule_end_date = $rs->getTimestamp($startcol + 18, null);

			$this->thumbnail_url = $rs->getString($startcol + 19);

			$this->thumbnail_saved = $rs->getBoolean($startcol + 20);

			$this->partner_data = $rs->getString($startcol + 21);

			$this->error_description = $rs->getString($startcol + 22);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 23; 
		} catch (Exception $e) {
			throw new PropelException("Error populating BulkUploadResult object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BulkUploadResultPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BulkUploadResultPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(BulkUploadResultPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BulkUploadResultPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BulkUploadResultPeer::DATABASE_NAME);
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
					$pk = BulkUploadResultPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BulkUploadResultPeer::doUpdate($this, $con);
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


			if (($retval = BulkUploadResultPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BulkUploadResultPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getBulkUploadJobId();
				break;
			case 4:
				return $this->getLineIndex();
				break;
			case 5:
				return $this->getPartnerId();
				break;
			case 6:
				return $this->getEntryId();
				break;
			case 7:
				return $this->getEntryStatus();
				break;
			case 8:
				return $this->getRowData();
				break;
			case 9:
				return $this->getTitle();
				break;
			case 10:
				return $this->getDescription();
				break;
			case 11:
				return $this->getTags();
				break;
			case 12:
				return $this->getUrl();
				break;
			case 13:
				return $this->getContentType();
				break;
			case 14:
				return $this->getConversionProfileId();
				break;
			case 15:
				return $this->getAccessControlProfileId();
				break;
			case 16:
				return $this->getCategory();
				break;
			case 17:
				return $this->getScheduleStartDate();
				break;
			case 18:
				return $this->getScheduleEndDate();
				break;
			case 19:
				return $this->getThumbnailUrl();
				break;
			case 20:
				return $this->getThumbnailSaved();
				break;
			case 21:
				return $this->getPartnerData();
				break;
			case 22:
				return $this->getErrorDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BulkUploadResultPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getBulkUploadJobId(),
			$keys[4] => $this->getLineIndex(),
			$keys[5] => $this->getPartnerId(),
			$keys[6] => $this->getEntryId(),
			$keys[7] => $this->getEntryStatus(),
			$keys[8] => $this->getRowData(),
			$keys[9] => $this->getTitle(),
			$keys[10] => $this->getDescription(),
			$keys[11] => $this->getTags(),
			$keys[12] => $this->getUrl(),
			$keys[13] => $this->getContentType(),
			$keys[14] => $this->getConversionProfileId(),
			$keys[15] => $this->getAccessControlProfileId(),
			$keys[16] => $this->getCategory(),
			$keys[17] => $this->getScheduleStartDate(),
			$keys[18] => $this->getScheduleEndDate(),
			$keys[19] => $this->getThumbnailUrl(),
			$keys[20] => $this->getThumbnailSaved(),
			$keys[21] => $this->getPartnerData(),
			$keys[22] => $this->getErrorDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BulkUploadResultPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setBulkUploadJobId($value);
				break;
			case 4:
				$this->setLineIndex($value);
				break;
			case 5:
				$this->setPartnerId($value);
				break;
			case 6:
				$this->setEntryId($value);
				break;
			case 7:
				$this->setEntryStatus($value);
				break;
			case 8:
				$this->setRowData($value);
				break;
			case 9:
				$this->setTitle($value);
				break;
			case 10:
				$this->setDescription($value);
				break;
			case 11:
				$this->setTags($value);
				break;
			case 12:
				$this->setUrl($value);
				break;
			case 13:
				$this->setContentType($value);
				break;
			case 14:
				$this->setConversionProfileId($value);
				break;
			case 15:
				$this->setAccessControlProfileId($value);
				break;
			case 16:
				$this->setCategory($value);
				break;
			case 17:
				$this->setScheduleStartDate($value);
				break;
			case 18:
				$this->setScheduleEndDate($value);
				break;
			case 19:
				$this->setThumbnailUrl($value);
				break;
			case 20:
				$this->setThumbnailSaved($value);
				break;
			case 21:
				$this->setPartnerData($value);
				break;
			case 22:
				$this->setErrorDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BulkUploadResultPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBulkUploadJobId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLineIndex($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPartnerId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEntryId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEntryStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRowData($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTitle($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTags($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUrl($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setContentType($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setConversionProfileId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAccessControlProfileId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCategory($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setScheduleStartDate($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setScheduleEndDate($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setThumbnailUrl($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setThumbnailSaved($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setPartnerData($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setErrorDescription($arr[$keys[22]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BulkUploadResultPeer::DATABASE_NAME);

		if ($this->isColumnModified(BulkUploadResultPeer::ID)) $criteria->add(BulkUploadResultPeer::ID, $this->id);
		if ($this->isColumnModified(BulkUploadResultPeer::CREATED_AT)) $criteria->add(BulkUploadResultPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BulkUploadResultPeer::UPDATED_AT)) $criteria->add(BulkUploadResultPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(BulkUploadResultPeer::BULK_UPLOAD_JOB_ID)) $criteria->add(BulkUploadResultPeer::BULK_UPLOAD_JOB_ID, $this->bulk_upload_job_id);
		if ($this->isColumnModified(BulkUploadResultPeer::LINE_INDEX)) $criteria->add(BulkUploadResultPeer::LINE_INDEX, $this->line_index);
		if ($this->isColumnModified(BulkUploadResultPeer::PARTNER_ID)) $criteria->add(BulkUploadResultPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(BulkUploadResultPeer::ENTRY_ID)) $criteria->add(BulkUploadResultPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(BulkUploadResultPeer::ENTRY_STATUS)) $criteria->add(BulkUploadResultPeer::ENTRY_STATUS, $this->entry_status);
		if ($this->isColumnModified(BulkUploadResultPeer::ROW_DATA)) $criteria->add(BulkUploadResultPeer::ROW_DATA, $this->row_data);
		if ($this->isColumnModified(BulkUploadResultPeer::TITLE)) $criteria->add(BulkUploadResultPeer::TITLE, $this->title);
		if ($this->isColumnModified(BulkUploadResultPeer::DESCRIPTION)) $criteria->add(BulkUploadResultPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(BulkUploadResultPeer::TAGS)) $criteria->add(BulkUploadResultPeer::TAGS, $this->tags);
		if ($this->isColumnModified(BulkUploadResultPeer::URL)) $criteria->add(BulkUploadResultPeer::URL, $this->url);
		if ($this->isColumnModified(BulkUploadResultPeer::CONTENT_TYPE)) $criteria->add(BulkUploadResultPeer::CONTENT_TYPE, $this->content_type);
		if ($this->isColumnModified(BulkUploadResultPeer::CONVERSION_PROFILE_ID)) $criteria->add(BulkUploadResultPeer::CONVERSION_PROFILE_ID, $this->conversion_profile_id);
		if ($this->isColumnModified(BulkUploadResultPeer::ACCESS_CONTROL_PROFILE_ID)) $criteria->add(BulkUploadResultPeer::ACCESS_CONTROL_PROFILE_ID, $this->access_control_profile_id);
		if ($this->isColumnModified(BulkUploadResultPeer::CATEGORY)) $criteria->add(BulkUploadResultPeer::CATEGORY, $this->category);
		if ($this->isColumnModified(BulkUploadResultPeer::SCHEDULE_START_DATE)) $criteria->add(BulkUploadResultPeer::SCHEDULE_START_DATE, $this->schedule_start_date);
		if ($this->isColumnModified(BulkUploadResultPeer::SCHEDULE_END_DATE)) $criteria->add(BulkUploadResultPeer::SCHEDULE_END_DATE, $this->schedule_end_date);
		if ($this->isColumnModified(BulkUploadResultPeer::THUMBNAIL_URL)) $criteria->add(BulkUploadResultPeer::THUMBNAIL_URL, $this->thumbnail_url);
		if ($this->isColumnModified(BulkUploadResultPeer::THUMBNAIL_SAVED)) $criteria->add(BulkUploadResultPeer::THUMBNAIL_SAVED, $this->thumbnail_saved);
		if ($this->isColumnModified(BulkUploadResultPeer::PARTNER_DATA)) $criteria->add(BulkUploadResultPeer::PARTNER_DATA, $this->partner_data);
		if ($this->isColumnModified(BulkUploadResultPeer::ERROR_DESCRIPTION)) $criteria->add(BulkUploadResultPeer::ERROR_DESCRIPTION, $this->error_description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BulkUploadResultPeer::DATABASE_NAME);

		$criteria->add(BulkUploadResultPeer::ID, $this->id);

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

		$copyObj->setBulkUploadJobId($this->bulk_upload_job_id);

		$copyObj->setLineIndex($this->line_index);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setEntryStatus($this->entry_status);

		$copyObj->setRowData($this->row_data);

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setTags($this->tags);

		$copyObj->setUrl($this->url);

		$copyObj->setContentType($this->content_type);

		$copyObj->setConversionProfileId($this->conversion_profile_id);

		$copyObj->setAccessControlProfileId($this->access_control_profile_id);

		$copyObj->setCategory($this->category);

		$copyObj->setScheduleStartDate($this->schedule_start_date);

		$copyObj->setScheduleEndDate($this->schedule_end_date);

		$copyObj->setThumbnailUrl($this->thumbnail_url);

		$copyObj->setThumbnailSaved($this->thumbnail_saved);

		$copyObj->setPartnerData($this->partner_data);

		$copyObj->setErrorDescription($this->error_description);


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
			self::$peer = new BulkUploadResultPeer();
		}
		return self::$peer;
	}

} 