<?php


abstract class BaseKceInstallationError extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $browser;


	
	protected $server_ip;


	
	protected $server_os;


	
	protected $php_version;


	
	protected $ce_admin_email;


	
	protected $type;


	
	protected $description;


	
	protected $data;

	
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

	
	public function getBrowser()
	{

		return $this->browser;
	}

	
	public function getServerIp()
	{

		return $this->server_ip;
	}

	
	public function getServerOs()
	{

		return $this->server_os;
	}

	
	public function getPhpVersion()
	{

		return $this->php_version;
	}

	
	public function getCeAdminEmail()
	{

		return $this->ce_admin_email;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getData()
	{

		return $this->data;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::PARTNER_ID;
		}

	} 
	
	public function setBrowser($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->browser !== $v) {
			$this->browser = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::BROWSER;
		}

	} 
	
	public function setServerIp($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->server_ip !== $v) {
			$this->server_ip = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::SERVER_IP;
		}

	} 
	
	public function setServerOs($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->server_os !== $v) {
			$this->server_os = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::SERVER_OS;
		}

	} 
	
	public function setPhpVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->php_version !== $v) {
			$this->php_version = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::PHP_VERSION;
		}

	} 
	
	public function setCeAdminEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ce_admin_email !== $v) {
			$this->ce_admin_email = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::CE_ADMIN_EMAIL;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::TYPE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::DESCRIPTION;
		}

	} 
	
	public function setData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = KceInstallationErrorPeer::DATA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->browser = $rs->getString($startcol + 2);

			$this->server_ip = $rs->getString($startcol + 3);

			$this->server_os = $rs->getString($startcol + 4);

			$this->php_version = $rs->getString($startcol + 5);

			$this->ce_admin_email = $rs->getString($startcol + 6);

			$this->type = $rs->getString($startcol + 7);

			$this->description = $rs->getString($startcol + 8);

			$this->data = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating KceInstallationError object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KceInstallationErrorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			KceInstallationErrorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KceInstallationErrorPeer::DATABASE_NAME);
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
					$pk = KceInstallationErrorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += KceInstallationErrorPeer::doUpdate($this, $con);
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


			if (($retval = KceInstallationErrorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KceInstallationErrorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getBrowser();
				break;
			case 3:
				return $this->getServerIp();
				break;
			case 4:
				return $this->getServerOs();
				break;
			case 5:
				return $this->getPhpVersion();
				break;
			case 6:
				return $this->getCeAdminEmail();
				break;
			case 7:
				return $this->getType();
				break;
			case 8:
				return $this->getDescription();
				break;
			case 9:
				return $this->getData();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KceInstallationErrorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getBrowser(),
			$keys[3] => $this->getServerIp(),
			$keys[4] => $this->getServerOs(),
			$keys[5] => $this->getPhpVersion(),
			$keys[6] => $this->getCeAdminEmail(),
			$keys[7] => $this->getType(),
			$keys[8] => $this->getDescription(),
			$keys[9] => $this->getData(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KceInstallationErrorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setBrowser($value);
				break;
			case 3:
				$this->setServerIp($value);
				break;
			case 4:
				$this->setServerOs($value);
				break;
			case 5:
				$this->setPhpVersion($value);
				break;
			case 6:
				$this->setCeAdminEmail($value);
				break;
			case 7:
				$this->setType($value);
				break;
			case 8:
				$this->setDescription($value);
				break;
			case 9:
				$this->setData($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KceInstallationErrorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBrowser($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setServerIp($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setServerOs($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPhpVersion($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCeAdminEmail($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDescription($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setData($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(KceInstallationErrorPeer::DATABASE_NAME);

		if ($this->isColumnModified(KceInstallationErrorPeer::ID)) $criteria->add(KceInstallationErrorPeer::ID, $this->id);
		if ($this->isColumnModified(KceInstallationErrorPeer::PARTNER_ID)) $criteria->add(KceInstallationErrorPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(KceInstallationErrorPeer::BROWSER)) $criteria->add(KceInstallationErrorPeer::BROWSER, $this->browser);
		if ($this->isColumnModified(KceInstallationErrorPeer::SERVER_IP)) $criteria->add(KceInstallationErrorPeer::SERVER_IP, $this->server_ip);
		if ($this->isColumnModified(KceInstallationErrorPeer::SERVER_OS)) $criteria->add(KceInstallationErrorPeer::SERVER_OS, $this->server_os);
		if ($this->isColumnModified(KceInstallationErrorPeer::PHP_VERSION)) $criteria->add(KceInstallationErrorPeer::PHP_VERSION, $this->php_version);
		if ($this->isColumnModified(KceInstallationErrorPeer::CE_ADMIN_EMAIL)) $criteria->add(KceInstallationErrorPeer::CE_ADMIN_EMAIL, $this->ce_admin_email);
		if ($this->isColumnModified(KceInstallationErrorPeer::TYPE)) $criteria->add(KceInstallationErrorPeer::TYPE, $this->type);
		if ($this->isColumnModified(KceInstallationErrorPeer::DESCRIPTION)) $criteria->add(KceInstallationErrorPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(KceInstallationErrorPeer::DATA)) $criteria->add(KceInstallationErrorPeer::DATA, $this->data);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KceInstallationErrorPeer::DATABASE_NAME);

		$criteria->add(KceInstallationErrorPeer::ID, $this->id);

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

		$copyObj->setBrowser($this->browser);

		$copyObj->setServerIp($this->server_ip);

		$copyObj->setServerOs($this->server_os);

		$copyObj->setPhpVersion($this->php_version);

		$copyObj->setCeAdminEmail($this->ce_admin_email);

		$copyObj->setType($this->type);

		$copyObj->setDescription($this->description);

		$copyObj->setData($this->data);


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
			self::$peer = new KceInstallationErrorPeer();
		}
		return self::$peer;
	}

} 