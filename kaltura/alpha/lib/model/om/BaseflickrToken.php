<?php


abstract class BaseflickrToken extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $kalt_token;


	
	protected $frob;


	
	protected $token;


	
	protected $nsid;


	
	protected $response;


	
	protected $is_valid = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getKaltToken()
	{

		return $this->kalt_token;
	}

	
	public function getFrob()
	{

		return $this->frob;
	}

	
	public function getToken()
	{

		return $this->token;
	}

	
	public function getNsid()
	{

		return $this->nsid;
	}

	
	public function getResponse()
	{

		return $this->response;
	}

	
	public function getIsValid()
	{

		return $this->is_valid;
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

	
	public function setKaltToken($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kalt_token !== $v) {
			$this->kalt_token = $v;
			$this->modifiedColumns[] = flickrTokenPeer::KALT_TOKEN;
		}

	} 
	
	public function setFrob($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->frob !== $v) {
			$this->frob = $v;
			$this->modifiedColumns[] = flickrTokenPeer::FROB;
		}

	} 
	
	public function setToken($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->token !== $v) {
			$this->token = $v;
			$this->modifiedColumns[] = flickrTokenPeer::TOKEN;
		}

	} 
	
	public function setNsid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nsid !== $v) {
			$this->nsid = $v;
			$this->modifiedColumns[] = flickrTokenPeer::NSID;
		}

	} 
	
	public function setResponse($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->response !== $v) {
			$this->response = $v;
			$this->modifiedColumns[] = flickrTokenPeer::RESPONSE;
		}

	} 
	
	public function setIsValid($v)
	{

		if ($this->is_valid !== $v || $v === false) {
			$this->is_valid = $v;
			$this->modifiedColumns[] = flickrTokenPeer::IS_VALID;
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
			$this->modifiedColumns[] = flickrTokenPeer::CREATED_AT;
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
			$this->modifiedColumns[] = flickrTokenPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->kalt_token = $rs->getString($startcol + 0);

			$this->frob = $rs->getString($startcol + 1);

			$this->token = $rs->getString($startcol + 2);

			$this->nsid = $rs->getString($startcol + 3);

			$this->response = $rs->getString($startcol + 4);

			$this->is_valid = $rs->getBoolean($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating flickrToken object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flickrTokenPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			flickrTokenPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(flickrTokenPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(flickrTokenPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flickrTokenPeer::DATABASE_NAME);
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
					$pk = flickrTokenPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += flickrTokenPeer::doUpdate($this, $con);
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


			if (($retval = flickrTokenPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flickrTokenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getKaltToken();
				break;
			case 1:
				return $this->getFrob();
				break;
			case 2:
				return $this->getToken();
				break;
			case 3:
				return $this->getNsid();
				break;
			case 4:
				return $this->getResponse();
				break;
			case 5:
				return $this->getIsValid();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flickrTokenPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKaltToken(),
			$keys[1] => $this->getFrob(),
			$keys[2] => $this->getToken(),
			$keys[3] => $this->getNsid(),
			$keys[4] => $this->getResponse(),
			$keys[5] => $this->getIsValid(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flickrTokenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setKaltToken($value);
				break;
			case 1:
				$this->setFrob($value);
				break;
			case 2:
				$this->setToken($value);
				break;
			case 3:
				$this->setNsid($value);
				break;
			case 4:
				$this->setResponse($value);
				break;
			case 5:
				$this->setIsValid($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flickrTokenPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKaltToken($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFrob($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setToken($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNsid($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setResponse($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsValid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(flickrTokenPeer::DATABASE_NAME);

		if ($this->isColumnModified(flickrTokenPeer::KALT_TOKEN)) $criteria->add(flickrTokenPeer::KALT_TOKEN, $this->kalt_token);
		if ($this->isColumnModified(flickrTokenPeer::FROB)) $criteria->add(flickrTokenPeer::FROB, $this->frob);
		if ($this->isColumnModified(flickrTokenPeer::TOKEN)) $criteria->add(flickrTokenPeer::TOKEN, $this->token);
		if ($this->isColumnModified(flickrTokenPeer::NSID)) $criteria->add(flickrTokenPeer::NSID, $this->nsid);
		if ($this->isColumnModified(flickrTokenPeer::RESPONSE)) $criteria->add(flickrTokenPeer::RESPONSE, $this->response);
		if ($this->isColumnModified(flickrTokenPeer::IS_VALID)) $criteria->add(flickrTokenPeer::IS_VALID, $this->is_valid);
		if ($this->isColumnModified(flickrTokenPeer::CREATED_AT)) $criteria->add(flickrTokenPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(flickrTokenPeer::UPDATED_AT)) $criteria->add(flickrTokenPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(flickrTokenPeer::DATABASE_NAME);

		$criteria->add(flickrTokenPeer::KALT_TOKEN, $this->kalt_token);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getKaltToken();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setKaltToken($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFrob($this->frob);

		$copyObj->setToken($this->token);

		$copyObj->setNsid($this->nsid);

		$copyObj->setResponse($this->response);

		$copyObj->setIsValid($this->is_valid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setKaltToken(NULL); 
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
			self::$peer = new flickrTokenPeer();
		}
		return self::$peer;
	}

} 