<?php


abstract class BaseStorageProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partner_id;


	
	protected $name;


	
	protected $desciption;


	
	protected $status;


	
	protected $protocol;


	
	protected $storage_url;


	
	protected $storage_base_dir;


	
	protected $storage_username;


	
	protected $storage_password;


	
	protected $storage_ftp_passive_mode;


	
	protected $delivery_http_base_url;


	
	protected $delivery_rmp_base_url;


	
	protected $delivery_iis_base_url;


	
	protected $min_file_size;


	
	protected $max_file_size;


	
	protected $flavor_params_ids;


	
	protected $max_concurrent_connections;


	
	protected $custom_data;


	
	protected $path_manager_class;


	
	protected $url_manager_class;

	
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

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDesciption()
	{

		return $this->desciption;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getProtocol()
	{

		return $this->protocol;
	}

	
	public function getStorageUrl()
	{

		return $this->storage_url;
	}

	
	public function getStorageBaseDir()
	{

		return $this->storage_base_dir;
	}

	
	public function getStorageUsername()
	{

		return $this->storage_username;
	}

	
	public function getStoragePassword()
	{

		return $this->storage_password;
	}

	
	public function getStorageFtpPassiveMode()
	{

		return $this->storage_ftp_passive_mode;
	}

	
	public function getDeliveryHttpBaseUrl()
	{

		return $this->delivery_http_base_url;
	}

	
	public function getDeliveryRmpBaseUrl()
	{

		return $this->delivery_rmp_base_url;
	}

	
	public function getDeliveryIisBaseUrl()
	{

		return $this->delivery_iis_base_url;
	}

	
	public function getMinFileSize()
	{

		return $this->min_file_size;
	}

	
	public function getMaxFileSize()
	{

		return $this->max_file_size;
	}

	
	public function getFlavorParamsIds()
	{

		return $this->flavor_params_ids;
	}

	
	public function getMaxConcurrentConnections()
	{

		return $this->max_concurrent_connections;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getPathManagerClass()
	{

		return $this->path_manager_class;
	}

	
	public function getUrlManagerClass()
	{

		return $this->url_manager_class;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StorageProfilePeer::ID;
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
			$this->modifiedColumns[] = StorageProfilePeer::CREATED_AT;
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
			$this->modifiedColumns[] = StorageProfilePeer::UPDATED_AT;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = StorageProfilePeer::PARTNER_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = StorageProfilePeer::NAME;
		}

	} 
	
	public function setDesciption($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->desciption !== $v) {
			$this->desciption = $v;
			$this->modifiedColumns[] = StorageProfilePeer::DESCIPTION;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = StorageProfilePeer::STATUS;
		}

	} 
	
	public function setProtocol($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->protocol !== $v) {
			$this->protocol = $v;
			$this->modifiedColumns[] = StorageProfilePeer::PROTOCOL;
		}

	} 
	
	public function setStorageUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->storage_url !== $v) {
			$this->storage_url = $v;
			$this->modifiedColumns[] = StorageProfilePeer::STORAGE_URL;
		}

	} 
	
	public function setStorageBaseDir($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->storage_base_dir !== $v) {
			$this->storage_base_dir = $v;
			$this->modifiedColumns[] = StorageProfilePeer::STORAGE_BASE_DIR;
		}

	} 
	
	public function setStorageUsername($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->storage_username !== $v) {
			$this->storage_username = $v;
			$this->modifiedColumns[] = StorageProfilePeer::STORAGE_USERNAME;
		}

	} 
	
	public function setStoragePassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->storage_password !== $v) {
			$this->storage_password = $v;
			$this->modifiedColumns[] = StorageProfilePeer::STORAGE_PASSWORD;
		}

	} 
	
	public function setStorageFtpPassiveMode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->storage_ftp_passive_mode !== $v) {
			$this->storage_ftp_passive_mode = $v;
			$this->modifiedColumns[] = StorageProfilePeer::STORAGE_FTP_PASSIVE_MODE;
		}

	} 
	
	public function setDeliveryHttpBaseUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_http_base_url !== $v) {
			$this->delivery_http_base_url = $v;
			$this->modifiedColumns[] = StorageProfilePeer::DELIVERY_HTTP_BASE_URL;
		}

	} 
	
	public function setDeliveryRmpBaseUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_rmp_base_url !== $v) {
			$this->delivery_rmp_base_url = $v;
			$this->modifiedColumns[] = StorageProfilePeer::DELIVERY_RMP_BASE_URL;
		}

	} 
	
	public function setDeliveryIisBaseUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_iis_base_url !== $v) {
			$this->delivery_iis_base_url = $v;
			$this->modifiedColumns[] = StorageProfilePeer::DELIVERY_IIS_BASE_URL;
		}

	} 
	
	public function setMinFileSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->min_file_size !== $v) {
			$this->min_file_size = $v;
			$this->modifiedColumns[] = StorageProfilePeer::MIN_FILE_SIZE;
		}

	} 
	
	public function setMaxFileSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->max_file_size !== $v) {
			$this->max_file_size = $v;
			$this->modifiedColumns[] = StorageProfilePeer::MAX_FILE_SIZE;
		}

	} 
	
	public function setFlavorParamsIds($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->flavor_params_ids !== $v) {
			$this->flavor_params_ids = $v;
			$this->modifiedColumns[] = StorageProfilePeer::FLAVOR_PARAMS_IDS;
		}

	} 
	
	public function setMaxConcurrentConnections($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->max_concurrent_connections !== $v) {
			$this->max_concurrent_connections = $v;
			$this->modifiedColumns[] = StorageProfilePeer::MAX_CONCURRENT_CONNECTIONS;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = StorageProfilePeer::CUSTOM_DATA;
		}

	} 
	
	public function setPathManagerClass($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path_manager_class !== $v) {
			$this->path_manager_class = $v;
			$this->modifiedColumns[] = StorageProfilePeer::PATH_MANAGER_CLASS;
		}

	} 
	
	public function setUrlManagerClass($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url_manager_class !== $v) {
			$this->url_manager_class = $v;
			$this->modifiedColumns[] = StorageProfilePeer::URL_MANAGER_CLASS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->partner_id = $rs->getInt($startcol + 3);

			$this->name = $rs->getString($startcol + 4);

			$this->desciption = $rs->getString($startcol + 5);

			$this->status = $rs->getInt($startcol + 6);

			$this->protocol = $rs->getInt($startcol + 7);

			$this->storage_url = $rs->getString($startcol + 8);

			$this->storage_base_dir = $rs->getString($startcol + 9);

			$this->storage_username = $rs->getString($startcol + 10);

			$this->storage_password = $rs->getString($startcol + 11);

			$this->storage_ftp_passive_mode = $rs->getInt($startcol + 12);

			$this->delivery_http_base_url = $rs->getString($startcol + 13);

			$this->delivery_rmp_base_url = $rs->getString($startcol + 14);

			$this->delivery_iis_base_url = $rs->getString($startcol + 15);

			$this->min_file_size = $rs->getInt($startcol + 16);

			$this->max_file_size = $rs->getInt($startcol + 17);

			$this->flavor_params_ids = $rs->getString($startcol + 18);

			$this->max_concurrent_connections = $rs->getInt($startcol + 19);

			$this->custom_data = $rs->getString($startcol + 20);

			$this->path_manager_class = $rs->getString($startcol + 21);

			$this->url_manager_class = $rs->getString($startcol + 22);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 23; 
		} catch (Exception $e) {
			throw new PropelException("Error populating StorageProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StorageProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			StorageProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(StorageProfilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(StorageProfilePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StorageProfilePeer::DATABASE_NAME);
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
					$pk = StorageProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += StorageProfilePeer::doUpdate($this, $con);
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


			if (($retval = StorageProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StorageProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPartnerId();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getDesciption();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getProtocol();
				break;
			case 8:
				return $this->getStorageUrl();
				break;
			case 9:
				return $this->getStorageBaseDir();
				break;
			case 10:
				return $this->getStorageUsername();
				break;
			case 11:
				return $this->getStoragePassword();
				break;
			case 12:
				return $this->getStorageFtpPassiveMode();
				break;
			case 13:
				return $this->getDeliveryHttpBaseUrl();
				break;
			case 14:
				return $this->getDeliveryRmpBaseUrl();
				break;
			case 15:
				return $this->getDeliveryIisBaseUrl();
				break;
			case 16:
				return $this->getMinFileSize();
				break;
			case 17:
				return $this->getMaxFileSize();
				break;
			case 18:
				return $this->getFlavorParamsIds();
				break;
			case 19:
				return $this->getMaxConcurrentConnections();
				break;
			case 20:
				return $this->getCustomData();
				break;
			case 21:
				return $this->getPathManagerClass();
				break;
			case 22:
				return $this->getUrlManagerClass();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StorageProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getPartnerId(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getDesciption(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getProtocol(),
			$keys[8] => $this->getStorageUrl(),
			$keys[9] => $this->getStorageBaseDir(),
			$keys[10] => $this->getStorageUsername(),
			$keys[11] => $this->getStoragePassword(),
			$keys[12] => $this->getStorageFtpPassiveMode(),
			$keys[13] => $this->getDeliveryHttpBaseUrl(),
			$keys[14] => $this->getDeliveryRmpBaseUrl(),
			$keys[15] => $this->getDeliveryIisBaseUrl(),
			$keys[16] => $this->getMinFileSize(),
			$keys[17] => $this->getMaxFileSize(),
			$keys[18] => $this->getFlavorParamsIds(),
			$keys[19] => $this->getMaxConcurrentConnections(),
			$keys[20] => $this->getCustomData(),
			$keys[21] => $this->getPathManagerClass(),
			$keys[22] => $this->getUrlManagerClass(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StorageProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPartnerId($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setDesciption($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setProtocol($value);
				break;
			case 8:
				$this->setStorageUrl($value);
				break;
			case 9:
				$this->setStorageBaseDir($value);
				break;
			case 10:
				$this->setStorageUsername($value);
				break;
			case 11:
				$this->setStoragePassword($value);
				break;
			case 12:
				$this->setStorageFtpPassiveMode($value);
				break;
			case 13:
				$this->setDeliveryHttpBaseUrl($value);
				break;
			case 14:
				$this->setDeliveryRmpBaseUrl($value);
				break;
			case 15:
				$this->setDeliveryIisBaseUrl($value);
				break;
			case 16:
				$this->setMinFileSize($value);
				break;
			case 17:
				$this->setMaxFileSize($value);
				break;
			case 18:
				$this->setFlavorParamsIds($value);
				break;
			case 19:
				$this->setMaxConcurrentConnections($value);
				break;
			case 20:
				$this->setCustomData($value);
				break;
			case 21:
				$this->setPathManagerClass($value);
				break;
			case 22:
				$this->setUrlManagerClass($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StorageProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPartnerId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDesciption($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setProtocol($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStorageUrl($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStorageBaseDir($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStorageUsername($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStoragePassword($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStorageFtpPassiveMode($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDeliveryHttpBaseUrl($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDeliveryRmpBaseUrl($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDeliveryIisBaseUrl($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setMinFileSize($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setMaxFileSize($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setFlavorParamsIds($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setMaxConcurrentConnections($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCustomData($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setPathManagerClass($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setUrlManagerClass($arr[$keys[22]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(StorageProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(StorageProfilePeer::ID)) $criteria->add(StorageProfilePeer::ID, $this->id);
		if ($this->isColumnModified(StorageProfilePeer::CREATED_AT)) $criteria->add(StorageProfilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(StorageProfilePeer::UPDATED_AT)) $criteria->add(StorageProfilePeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(StorageProfilePeer::PARTNER_ID)) $criteria->add(StorageProfilePeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(StorageProfilePeer::NAME)) $criteria->add(StorageProfilePeer::NAME, $this->name);
		if ($this->isColumnModified(StorageProfilePeer::DESCIPTION)) $criteria->add(StorageProfilePeer::DESCIPTION, $this->desciption);
		if ($this->isColumnModified(StorageProfilePeer::STATUS)) $criteria->add(StorageProfilePeer::STATUS, $this->status);
		if ($this->isColumnModified(StorageProfilePeer::PROTOCOL)) $criteria->add(StorageProfilePeer::PROTOCOL, $this->protocol);
		if ($this->isColumnModified(StorageProfilePeer::STORAGE_URL)) $criteria->add(StorageProfilePeer::STORAGE_URL, $this->storage_url);
		if ($this->isColumnModified(StorageProfilePeer::STORAGE_BASE_DIR)) $criteria->add(StorageProfilePeer::STORAGE_BASE_DIR, $this->storage_base_dir);
		if ($this->isColumnModified(StorageProfilePeer::STORAGE_USERNAME)) $criteria->add(StorageProfilePeer::STORAGE_USERNAME, $this->storage_username);
		if ($this->isColumnModified(StorageProfilePeer::STORAGE_PASSWORD)) $criteria->add(StorageProfilePeer::STORAGE_PASSWORD, $this->storage_password);
		if ($this->isColumnModified(StorageProfilePeer::STORAGE_FTP_PASSIVE_MODE)) $criteria->add(StorageProfilePeer::STORAGE_FTP_PASSIVE_MODE, $this->storage_ftp_passive_mode);
		if ($this->isColumnModified(StorageProfilePeer::DELIVERY_HTTP_BASE_URL)) $criteria->add(StorageProfilePeer::DELIVERY_HTTP_BASE_URL, $this->delivery_http_base_url);
		if ($this->isColumnModified(StorageProfilePeer::DELIVERY_RMP_BASE_URL)) $criteria->add(StorageProfilePeer::DELIVERY_RMP_BASE_URL, $this->delivery_rmp_base_url);
		if ($this->isColumnModified(StorageProfilePeer::DELIVERY_IIS_BASE_URL)) $criteria->add(StorageProfilePeer::DELIVERY_IIS_BASE_URL, $this->delivery_iis_base_url);
		if ($this->isColumnModified(StorageProfilePeer::MIN_FILE_SIZE)) $criteria->add(StorageProfilePeer::MIN_FILE_SIZE, $this->min_file_size);
		if ($this->isColumnModified(StorageProfilePeer::MAX_FILE_SIZE)) $criteria->add(StorageProfilePeer::MAX_FILE_SIZE, $this->max_file_size);
		if ($this->isColumnModified(StorageProfilePeer::FLAVOR_PARAMS_IDS)) $criteria->add(StorageProfilePeer::FLAVOR_PARAMS_IDS, $this->flavor_params_ids);
		if ($this->isColumnModified(StorageProfilePeer::MAX_CONCURRENT_CONNECTIONS)) $criteria->add(StorageProfilePeer::MAX_CONCURRENT_CONNECTIONS, $this->max_concurrent_connections);
		if ($this->isColumnModified(StorageProfilePeer::CUSTOM_DATA)) $criteria->add(StorageProfilePeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(StorageProfilePeer::PATH_MANAGER_CLASS)) $criteria->add(StorageProfilePeer::PATH_MANAGER_CLASS, $this->path_manager_class);
		if ($this->isColumnModified(StorageProfilePeer::URL_MANAGER_CLASS)) $criteria->add(StorageProfilePeer::URL_MANAGER_CLASS, $this->url_manager_class);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(StorageProfilePeer::DATABASE_NAME);

		$criteria->add(StorageProfilePeer::ID, $this->id);

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

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setName($this->name);

		$copyObj->setDesciption($this->desciption);

		$copyObj->setStatus($this->status);

		$copyObj->setProtocol($this->protocol);

		$copyObj->setStorageUrl($this->storage_url);

		$copyObj->setStorageBaseDir($this->storage_base_dir);

		$copyObj->setStorageUsername($this->storage_username);

		$copyObj->setStoragePassword($this->storage_password);

		$copyObj->setStorageFtpPassiveMode($this->storage_ftp_passive_mode);

		$copyObj->setDeliveryHttpBaseUrl($this->delivery_http_base_url);

		$copyObj->setDeliveryRmpBaseUrl($this->delivery_rmp_base_url);

		$copyObj->setDeliveryIisBaseUrl($this->delivery_iis_base_url);

		$copyObj->setMinFileSize($this->min_file_size);

		$copyObj->setMaxFileSize($this->max_file_size);

		$copyObj->setFlavorParamsIds($this->flavor_params_ids);

		$copyObj->setMaxConcurrentConnections($this->max_concurrent_connections);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setPathManagerClass($this->path_manager_class);

		$copyObj->setUrlManagerClass($this->url_manager_class);


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
			self::$peer = new StorageProfilePeer();
		}
		return self::$peer;
	}

} 