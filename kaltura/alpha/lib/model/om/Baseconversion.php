<?php


abstract class Baseconversion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $entry_id;


	
	protected $in_file_name;


	
	protected $in_file_ext;


	
	protected $in_file_size;


	
	protected $source;


	
	protected $status;


	
	protected $conversion_params;


	
	protected $out_file_name;


	
	protected $out_file_size;


	
	protected $out_file_name_2;


	
	protected $out_file_size_2;


	
	protected $conversion_time;


	
	protected $total_process_time;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aentry;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getInFileName()
	{

		return $this->in_file_name;
	}

	
	public function getInFileExt()
	{

		return $this->in_file_ext;
	}

	
	public function getInFileSize()
	{

		return $this->in_file_size;
	}

	
	public function getSource()
	{

		return $this->source;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getConversionParams()
	{

		return $this->conversion_params;
	}

	
	public function getOutFileName()
	{

		return $this->out_file_name;
	}

	
	public function getOutFileSize()
	{

		return $this->out_file_size;
	}

	
	public function getOutFileName2()
	{

		return $this->out_file_name_2;
	}

	
	public function getOutFileSize2()
	{

		return $this->out_file_size_2;
	}

	
	public function getConversionTime()
	{

		return $this->conversion_time;
	}

	
	public function getTotalProcessTime()
	{

		return $this->total_process_time;
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
			$this->modifiedColumns[] = conversionPeer::ID;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = conversionPeer::ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setInFileName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->in_file_name !== $v) {
			$this->in_file_name = $v;
			$this->modifiedColumns[] = conversionPeer::IN_FILE_NAME;
		}

	} 
	
	public function setInFileExt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->in_file_ext !== $v) {
			$this->in_file_ext = $v;
			$this->modifiedColumns[] = conversionPeer::IN_FILE_EXT;
		}

	} 
	
	public function setInFileSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->in_file_size !== $v) {
			$this->in_file_size = $v;
			$this->modifiedColumns[] = conversionPeer::IN_FILE_SIZE;
		}

	} 
	
	public function setSource($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->source !== $v) {
			$this->source = $v;
			$this->modifiedColumns[] = conversionPeer::SOURCE;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = conversionPeer::STATUS;
		}

	} 
	
	public function setConversionParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->conversion_params !== $v) {
			$this->conversion_params = $v;
			$this->modifiedColumns[] = conversionPeer::CONVERSION_PARAMS;
		}

	} 
	
	public function setOutFileName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->out_file_name !== $v) {
			$this->out_file_name = $v;
			$this->modifiedColumns[] = conversionPeer::OUT_FILE_NAME;
		}

	} 
	
	public function setOutFileSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->out_file_size !== $v) {
			$this->out_file_size = $v;
			$this->modifiedColumns[] = conversionPeer::OUT_FILE_SIZE;
		}

	} 
	
	public function setOutFileName2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->out_file_name_2 !== $v) {
			$this->out_file_name_2 = $v;
			$this->modifiedColumns[] = conversionPeer::OUT_FILE_NAME_2;
		}

	} 
	
	public function setOutFileSize2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->out_file_size_2 !== $v) {
			$this->out_file_size_2 = $v;
			$this->modifiedColumns[] = conversionPeer::OUT_FILE_SIZE_2;
		}

	} 
	
	public function setConversionTime($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->conversion_time !== $v) {
			$this->conversion_time = $v;
			$this->modifiedColumns[] = conversionPeer::CONVERSION_TIME;
		}

	} 
	
	public function setTotalProcessTime($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_process_time !== $v) {
			$this->total_process_time = $v;
			$this->modifiedColumns[] = conversionPeer::TOTAL_PROCESS_TIME;
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
			$this->modifiedColumns[] = conversionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = conversionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->entry_id = $rs->getString($startcol + 1);

			$this->in_file_name = $rs->getString($startcol + 2);

			$this->in_file_ext = $rs->getString($startcol + 3);

			$this->in_file_size = $rs->getInt($startcol + 4);

			$this->source = $rs->getInt($startcol + 5);

			$this->status = $rs->getInt($startcol + 6);

			$this->conversion_params = $rs->getString($startcol + 7);

			$this->out_file_name = $rs->getString($startcol + 8);

			$this->out_file_size = $rs->getInt($startcol + 9);

			$this->out_file_name_2 = $rs->getString($startcol + 10);

			$this->out_file_size_2 = $rs->getInt($startcol + 11);

			$this->conversion_time = $rs->getInt($startcol + 12);

			$this->total_process_time = $rs->getInt($startcol + 13);

			$this->created_at = $rs->getTimestamp($startcol + 14, null);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating conversion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(conversionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			conversionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(conversionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(conversionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(conversionPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = conversionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += conversionPeer::doUpdate($this, $con);
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


												
			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}


			if (($retval = conversionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = conversionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEntryId();
				break;
			case 2:
				return $this->getInFileName();
				break;
			case 3:
				return $this->getInFileExt();
				break;
			case 4:
				return $this->getInFileSize();
				break;
			case 5:
				return $this->getSource();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getConversionParams();
				break;
			case 8:
				return $this->getOutFileName();
				break;
			case 9:
				return $this->getOutFileSize();
				break;
			case 10:
				return $this->getOutFileName2();
				break;
			case 11:
				return $this->getOutFileSize2();
				break;
			case 12:
				return $this->getConversionTime();
				break;
			case 13:
				return $this->getTotalProcessTime();
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
		$keys = conversionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEntryId(),
			$keys[2] => $this->getInFileName(),
			$keys[3] => $this->getInFileExt(),
			$keys[4] => $this->getInFileSize(),
			$keys[5] => $this->getSource(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getConversionParams(),
			$keys[8] => $this->getOutFileName(),
			$keys[9] => $this->getOutFileSize(),
			$keys[10] => $this->getOutFileName2(),
			$keys[11] => $this->getOutFileSize2(),
			$keys[12] => $this->getConversionTime(),
			$keys[13] => $this->getTotalProcessTime(),
			$keys[14] => $this->getCreatedAt(),
			$keys[15] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = conversionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEntryId($value);
				break;
			case 2:
				$this->setInFileName($value);
				break;
			case 3:
				$this->setInFileExt($value);
				break;
			case 4:
				$this->setInFileSize($value);
				break;
			case 5:
				$this->setSource($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setConversionParams($value);
				break;
			case 8:
				$this->setOutFileName($value);
				break;
			case 9:
				$this->setOutFileSize($value);
				break;
			case 10:
				$this->setOutFileName2($value);
				break;
			case 11:
				$this->setOutFileSize2($value);
				break;
			case 12:
				$this->setConversionTime($value);
				break;
			case 13:
				$this->setTotalProcessTime($value);
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
		$keys = conversionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEntryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInFileName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInFileExt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setInFileSize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSource($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setConversionParams($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setOutFileName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setOutFileSize($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setOutFileName2($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setOutFileSize2($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setConversionTime($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTotalProcessTime($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(conversionPeer::DATABASE_NAME);

		if ($this->isColumnModified(conversionPeer::ID)) $criteria->add(conversionPeer::ID, $this->id);
		if ($this->isColumnModified(conversionPeer::ENTRY_ID)) $criteria->add(conversionPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(conversionPeer::IN_FILE_NAME)) $criteria->add(conversionPeer::IN_FILE_NAME, $this->in_file_name);
		if ($this->isColumnModified(conversionPeer::IN_FILE_EXT)) $criteria->add(conversionPeer::IN_FILE_EXT, $this->in_file_ext);
		if ($this->isColumnModified(conversionPeer::IN_FILE_SIZE)) $criteria->add(conversionPeer::IN_FILE_SIZE, $this->in_file_size);
		if ($this->isColumnModified(conversionPeer::SOURCE)) $criteria->add(conversionPeer::SOURCE, $this->source);
		if ($this->isColumnModified(conversionPeer::STATUS)) $criteria->add(conversionPeer::STATUS, $this->status);
		if ($this->isColumnModified(conversionPeer::CONVERSION_PARAMS)) $criteria->add(conversionPeer::CONVERSION_PARAMS, $this->conversion_params);
		if ($this->isColumnModified(conversionPeer::OUT_FILE_NAME)) $criteria->add(conversionPeer::OUT_FILE_NAME, $this->out_file_name);
		if ($this->isColumnModified(conversionPeer::OUT_FILE_SIZE)) $criteria->add(conversionPeer::OUT_FILE_SIZE, $this->out_file_size);
		if ($this->isColumnModified(conversionPeer::OUT_FILE_NAME_2)) $criteria->add(conversionPeer::OUT_FILE_NAME_2, $this->out_file_name_2);
		if ($this->isColumnModified(conversionPeer::OUT_FILE_SIZE_2)) $criteria->add(conversionPeer::OUT_FILE_SIZE_2, $this->out_file_size_2);
		if ($this->isColumnModified(conversionPeer::CONVERSION_TIME)) $criteria->add(conversionPeer::CONVERSION_TIME, $this->conversion_time);
		if ($this->isColumnModified(conversionPeer::TOTAL_PROCESS_TIME)) $criteria->add(conversionPeer::TOTAL_PROCESS_TIME, $this->total_process_time);
		if ($this->isColumnModified(conversionPeer::CREATED_AT)) $criteria->add(conversionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(conversionPeer::UPDATED_AT)) $criteria->add(conversionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(conversionPeer::DATABASE_NAME);

		$criteria->add(conversionPeer::ID, $this->id);

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

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setInFileName($this->in_file_name);

		$copyObj->setInFileExt($this->in_file_ext);

		$copyObj->setInFileSize($this->in_file_size);

		$copyObj->setSource($this->source);

		$copyObj->setStatus($this->status);

		$copyObj->setConversionParams($this->conversion_params);

		$copyObj->setOutFileName($this->out_file_name);

		$copyObj->setOutFileSize($this->out_file_size);

		$copyObj->setOutFileName2($this->out_file_name_2);

		$copyObj->setOutFileSize2($this->out_file_size_2);

		$copyObj->setConversionTime($this->conversion_time);

		$copyObj->setTotalProcessTime($this->total_process_time);

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
			self::$peer = new conversionPeer();
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

} 