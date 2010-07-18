<?php


abstract class BaseUploadToken extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $int_id;


	
	protected $partner_id = 0;


	
	protected $kuser_id;


	
	protected $status;


	
	protected $file_name;


	
	protected $file_size;


	
	protected $uploaded_file_size;


	
	protected $upload_temp_path;


	
	protected $user_ip;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $akuser;

	
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

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getFileName()
	{

		return $this->file_name;
	}

	
	public function getFileSize()
	{

		return $this->file_size;
	}

	
	public function getUploadedFileSize()
	{

		return $this->uploaded_file_size;
	}

	
	public function getUploadTempPath()
	{

		return $this->upload_temp_path;
	}

	
	public function getUserIp()
	{

		return $this->user_ip;
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

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UploadTokenPeer::ID;
		}

	} 
	
	public function setIntId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->int_id !== $v) {
			$this->int_id = $v;
			$this->modifiedColumns[] = UploadTokenPeer::INT_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = UploadTokenPeer::PARTNER_ID;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = UploadTokenPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = UploadTokenPeer::STATUS;
		}

	} 
	
	public function setFileName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_name !== $v) {
			$this->file_name = $v;
			$this->modifiedColumns[] = UploadTokenPeer::FILE_NAME;
		}

	} 
	
	public function setFileSize($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_size !== $v) {
			$this->file_size = $v;
			$this->modifiedColumns[] = UploadTokenPeer::FILE_SIZE;
		}

	} 
	
	public function setUploadedFileSize($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uploaded_file_size !== $v) {
			$this->uploaded_file_size = $v;
			$this->modifiedColumns[] = UploadTokenPeer::UPLOADED_FILE_SIZE;
		}

	} 
	
	public function setUploadTempPath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->upload_temp_path !== $v) {
			$this->upload_temp_path = $v;
			$this->modifiedColumns[] = UploadTokenPeer::UPLOAD_TEMP_PATH;
		}

	} 
	
	public function setUserIp($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_ip !== $v) {
			$this->user_ip = $v;
			$this->modifiedColumns[] = UploadTokenPeer::USER_IP;
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
			$this->modifiedColumns[] = UploadTokenPeer::CREATED_AT;
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
			$this->modifiedColumns[] = UploadTokenPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->int_id = $rs->getInt($startcol + 1);

			$this->partner_id = $rs->getInt($startcol + 2);

			$this->kuser_id = $rs->getInt($startcol + 3);

			$this->status = $rs->getInt($startcol + 4);

			$this->file_name = $rs->getString($startcol + 5);

			$this->file_size = $rs->getString($startcol + 6);

			$this->uploaded_file_size = $rs->getString($startcol + 7);

			$this->upload_temp_path = $rs->getString($startcol + 8);

			$this->user_ip = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UploadToken object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UploadTokenPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UploadTokenPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UploadTokenPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UploadTokenPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UploadTokenPeer::DATABASE_NAME);
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


												
			if ($this->akuser !== null) {
				if ($this->akuser->isModified()) {
					$affectedRows += $this->akuser->save($con);
				}
				$this->setkuser($this->akuser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UploadTokenPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UploadTokenPeer::doUpdate($this, $con);
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


												
			if ($this->akuser !== null) {
				if (!$this->akuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuser->getValidationFailures());
				}
			}


			if (($retval = UploadTokenPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UploadTokenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getKuserId();
				break;
			case 4:
				return $this->getStatus();
				break;
			case 5:
				return $this->getFileName();
				break;
			case 6:
				return $this->getFileSize();
				break;
			case 7:
				return $this->getUploadedFileSize();
				break;
			case 8:
				return $this->getUploadTempPath();
				break;
			case 9:
				return $this->getUserIp();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UploadTokenPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIntId(),
			$keys[2] => $this->getPartnerId(),
			$keys[3] => $this->getKuserId(),
			$keys[4] => $this->getStatus(),
			$keys[5] => $this->getFileName(),
			$keys[6] => $this->getFileSize(),
			$keys[7] => $this->getUploadedFileSize(),
			$keys[8] => $this->getUploadTempPath(),
			$keys[9] => $this->getUserIp(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UploadTokenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setKuserId($value);
				break;
			case 4:
				$this->setStatus($value);
				break;
			case 5:
				$this->setFileName($value);
				break;
			case 6:
				$this->setFileSize($value);
				break;
			case 7:
				$this->setUploadedFileSize($value);
				break;
			case 8:
				$this->setUploadTempPath($value);
				break;
			case 9:
				$this->setUserIp($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UploadTokenPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIntId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setKuserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFileName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFileSize($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUploadedFileSize($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUploadTempPath($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUserIp($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UploadTokenPeer::DATABASE_NAME);

		if ($this->isColumnModified(UploadTokenPeer::ID)) $criteria->add(UploadTokenPeer::ID, $this->id);
		if ($this->isColumnModified(UploadTokenPeer::INT_ID)) $criteria->add(UploadTokenPeer::INT_ID, $this->int_id);
		if ($this->isColumnModified(UploadTokenPeer::PARTNER_ID)) $criteria->add(UploadTokenPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(UploadTokenPeer::KUSER_ID)) $criteria->add(UploadTokenPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(UploadTokenPeer::STATUS)) $criteria->add(UploadTokenPeer::STATUS, $this->status);
		if ($this->isColumnModified(UploadTokenPeer::FILE_NAME)) $criteria->add(UploadTokenPeer::FILE_NAME, $this->file_name);
		if ($this->isColumnModified(UploadTokenPeer::FILE_SIZE)) $criteria->add(UploadTokenPeer::FILE_SIZE, $this->file_size);
		if ($this->isColumnModified(UploadTokenPeer::UPLOADED_FILE_SIZE)) $criteria->add(UploadTokenPeer::UPLOADED_FILE_SIZE, $this->uploaded_file_size);
		if ($this->isColumnModified(UploadTokenPeer::UPLOAD_TEMP_PATH)) $criteria->add(UploadTokenPeer::UPLOAD_TEMP_PATH, $this->upload_temp_path);
		if ($this->isColumnModified(UploadTokenPeer::USER_IP)) $criteria->add(UploadTokenPeer::USER_IP, $this->user_ip);
		if ($this->isColumnModified(UploadTokenPeer::CREATED_AT)) $criteria->add(UploadTokenPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UploadTokenPeer::UPDATED_AT)) $criteria->add(UploadTokenPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UploadTokenPeer::DATABASE_NAME);

		$criteria->add(UploadTokenPeer::ID, $this->id);

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

		$copyObj->setIntId($this->int_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setStatus($this->status);

		$copyObj->setFileName($this->file_name);

		$copyObj->setFileSize($this->file_size);

		$copyObj->setUploadedFileSize($this->uploaded_file_size);

		$copyObj->setUploadTempPath($this->upload_temp_path);

		$copyObj->setUserIp($this->user_ip);

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
			self::$peer = new UploadTokenPeer();
		}
		return self::$peer;
	}

	
	public function setkuser($v)
	{


		if ($v === null) {
			$this->setKuserId(NULL);
		} else {
			$this->setKuserId($v->getId());
		}


		$this->akuser = $v;
	}


	
	public function getkuser($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuser === null && ($this->kuser_id !== null)) {

			$this->akuser = kuserPeer::retrieveByPK($this->kuser_id, $con);

			
		}
		return $this->akuser;
	}

} 