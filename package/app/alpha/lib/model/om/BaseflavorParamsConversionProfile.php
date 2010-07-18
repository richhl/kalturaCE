<?php


abstract class BaseflavorParamsConversionProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $conversion_profile_id;


	
	protected $flavor_params_id;


	
	protected $ready_behavior;


	
	protected $force_none_complied;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aconversionProfile2;

	
	protected $aflavorParams;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getConversionProfileId()
	{

		return $this->conversion_profile_id;
	}

	
	public function getFlavorParamsId()
	{

		return $this->flavor_params_id;
	}

	
	public function getReadyBehavior()
	{

		return $this->ready_behavior;
	}

	
	public function getForceNoneComplied()
	{

		return $this->force_none_complied;
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
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::ID;
		}

	} 
	
	public function setConversionProfileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->conversion_profile_id !== $v) {
			$this->conversion_profile_id = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID;
		}

		if ($this->aconversionProfile2 !== null && $this->aconversionProfile2->getId() !== $v) {
			$this->aconversionProfile2 = null;
		}

	} 
	
	public function setFlavorParamsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flavor_params_id !== $v) {
			$this->flavor_params_id = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID;
		}

		if ($this->aflavorParams !== null && $this->aflavorParams->getId() !== $v) {
			$this->aflavorParams = null;
		}

	} 
	
	public function setReadyBehavior($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ready_behavior !== $v) {
			$this->ready_behavior = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::READY_BEHAVIOR;
		}

	} 
	
	public function setForceNoneComplied($v)
	{

		if ($this->force_none_complied !== $v) {
			$this->force_none_complied = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED;
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
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::CREATED_AT;
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
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->conversion_profile_id = $rs->getInt($startcol + 1);

			$this->flavor_params_id = $rs->getInt($startcol + 2);

			$this->ready_behavior = $rs->getInt($startcol + 3);

			$this->force_none_complied = $rs->getBoolean($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating flavorParamsConversionProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsConversionProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			flavorParamsConversionProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(flavorParamsConversionProfilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(flavorParamsConversionProfilePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsConversionProfilePeer::DATABASE_NAME);
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


												
			if ($this->aconversionProfile2 !== null) {
				if ($this->aconversionProfile2->isModified()) {
					$affectedRows += $this->aconversionProfile2->save($con);
				}
				$this->setconversionProfile2($this->aconversionProfile2);
			}

			if ($this->aflavorParams !== null) {
				if ($this->aflavorParams->isModified()) {
					$affectedRows += $this->aflavorParams->save($con);
				}
				$this->setflavorParams($this->aflavorParams);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = flavorParamsConversionProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += flavorParamsConversionProfilePeer::doUpdate($this, $con);
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


												
			if ($this->aconversionProfile2 !== null) {
				if (!$this->aconversionProfile2->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aconversionProfile2->getValidationFailures());
				}
			}

			if ($this->aflavorParams !== null) {
				if (!$this->aflavorParams->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aflavorParams->getValidationFailures());
				}
			}


			if (($retval = flavorParamsConversionProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsConversionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getConversionProfileId();
				break;
			case 2:
				return $this->getFlavorParamsId();
				break;
			case 3:
				return $this->getReadyBehavior();
				break;
			case 4:
				return $this->getForceNoneComplied();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsConversionProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getConversionProfileId(),
			$keys[2] => $this->getFlavorParamsId(),
			$keys[3] => $this->getReadyBehavior(),
			$keys[4] => $this->getForceNoneComplied(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsConversionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setConversionProfileId($value);
				break;
			case 2:
				$this->setFlavorParamsId($value);
				break;
			case 3:
				$this->setReadyBehavior($value);
				break;
			case 4:
				$this->setForceNoneComplied($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsConversionProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setConversionProfileId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFlavorParamsId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setReadyBehavior($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setForceNoneComplied($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(flavorParamsConversionProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(flavorParamsConversionProfilePeer::ID)) $criteria->add(flavorParamsConversionProfilePeer::ID, $this->id);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID)) $criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->conversion_profile_id);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID)) $criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->flavor_params_id);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::READY_BEHAVIOR)) $criteria->add(flavorParamsConversionProfilePeer::READY_BEHAVIOR, $this->ready_behavior);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED)) $criteria->add(flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED, $this->force_none_complied);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::CREATED_AT)) $criteria->add(flavorParamsConversionProfilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::UPDATED_AT)) $criteria->add(flavorParamsConversionProfilePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(flavorParamsConversionProfilePeer::DATABASE_NAME);

		$criteria->add(flavorParamsConversionProfilePeer::ID, $this->id);

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

		$copyObj->setConversionProfileId($this->conversion_profile_id);

		$copyObj->setFlavorParamsId($this->flavor_params_id);

		$copyObj->setReadyBehavior($this->ready_behavior);

		$copyObj->setForceNoneComplied($this->force_none_complied);

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
			self::$peer = new flavorParamsConversionProfilePeer();
		}
		return self::$peer;
	}

	
	public function setconversionProfile2($v)
	{


		if ($v === null) {
			$this->setConversionProfileId(NULL);
		} else {
			$this->setConversionProfileId($v->getId());
		}


		$this->aconversionProfile2 = $v;
	}


	
	public function getconversionProfile2($con = null)
	{
				include_once 'lib/model/om/BaseconversionProfile2Peer.php';

		if ($this->aconversionProfile2 === null && ($this->conversion_profile_id !== null)) {

			$this->aconversionProfile2 = conversionProfile2Peer::retrieveByPK($this->conversion_profile_id, $con);

			
		}
		return $this->aconversionProfile2;
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

} 