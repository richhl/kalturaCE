<?php


abstract class Basekvote extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kshow_id;


	
	protected $entry_id;


	
	protected $kuser_id;


	
	protected $rank;


	
	protected $created_at;

	
	protected $akshowRelatedByKshowId;

	
	protected $aentry;

	
	protected $akshowRelatedByKuserId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getKshowId()
	{

		return $this->kshow_id;
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getRank()
	{

		return $this->rank;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = kvotePeer::ID;
		}

	} 
	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = kvotePeer::KSHOW_ID;
		}

		if ($this->akshowRelatedByKshowId !== null && $this->akshowRelatedByKshowId->getId() !== $v) {
			$this->akshowRelatedByKshowId = null;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v) {
			$this->entry_id = $v;
			$this->modifiedColumns[] = kvotePeer::ENTRY_ID;
		}

		if ($this->aentry !== null && $this->aentry->getId() !== $v) {
			$this->aentry = null;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = kvotePeer::KUSER_ID;
		}

		if ($this->akshowRelatedByKuserId !== null && $this->akshowRelatedByKuserId->getId() !== $v) {
			$this->akshowRelatedByKuserId = null;
		}

	} 
	
	public function setRank($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = kvotePeer::RANK;
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
			$this->modifiedColumns[] = kvotePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->kshow_id = $rs->getString($startcol + 1);

			$this->entry_id = $rs->getString($startcol + 2);

			$this->kuser_id = $rs->getInt($startcol + 3);

			$this->rank = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating kvote object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kvotePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			kvotePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(kvotePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kvotePeer::DATABASE_NAME);
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


												
			if ($this->akshowRelatedByKshowId !== null) {
				if ($this->akshowRelatedByKshowId->isModified()) {
					$affectedRows += $this->akshowRelatedByKshowId->save($con);
				}
				$this->setkshowRelatedByKshowId($this->akshowRelatedByKshowId);
			}

			if ($this->aentry !== null) {
				if ($this->aentry->isModified()) {
					$affectedRows += $this->aentry->save($con);
				}
				$this->setentry($this->aentry);
			}

			if ($this->akshowRelatedByKuserId !== null) {
				if ($this->akshowRelatedByKuserId->isModified()) {
					$affectedRows += $this->akshowRelatedByKuserId->save($con);
				}
				$this->setkshowRelatedByKuserId($this->akshowRelatedByKuserId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = kvotePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += kvotePeer::doUpdate($this, $con);
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


												
			if ($this->akshowRelatedByKshowId !== null) {
				if (!$this->akshowRelatedByKshowId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akshowRelatedByKshowId->getValidationFailures());
				}
			}

			if ($this->aentry !== null) {
				if (!$this->aentry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aentry->getValidationFailures());
				}
			}

			if ($this->akshowRelatedByKuserId !== null) {
				if (!$this->akshowRelatedByKuserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akshowRelatedByKuserId->getValidationFailures());
				}
			}


			if (($retval = kvotePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = kvotePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKshowId();
				break;
			case 2:
				return $this->getEntryId();
				break;
			case 3:
				return $this->getKuserId();
				break;
			case 4:
				return $this->getRank();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kvotePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKshowId(),
			$keys[2] => $this->getEntryId(),
			$keys[3] => $this->getKuserId(),
			$keys[4] => $this->getRank(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = kvotePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKshowId($value);
				break;
			case 2:
				$this->setEntryId($value);
				break;
			case 3:
				$this->setKuserId($value);
				break;
			case 4:
				$this->setRank($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kvotePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKshowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEntryId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setKuserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRank($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(kvotePeer::DATABASE_NAME);

		if ($this->isColumnModified(kvotePeer::ID)) $criteria->add(kvotePeer::ID, $this->id);
		if ($this->isColumnModified(kvotePeer::KSHOW_ID)) $criteria->add(kvotePeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(kvotePeer::ENTRY_ID)) $criteria->add(kvotePeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(kvotePeer::KUSER_ID)) $criteria->add(kvotePeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(kvotePeer::RANK)) $criteria->add(kvotePeer::RANK, $this->rank);
		if ($this->isColumnModified(kvotePeer::CREATED_AT)) $criteria->add(kvotePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(kvotePeer::DATABASE_NAME);

		$criteria->add(kvotePeer::ID, $this->id);

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

		$copyObj->setKshowId($this->kshow_id);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setRank($this->rank);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new kvotePeer();
		}
		return self::$peer;
	}

	
	public function setkshowRelatedByKshowId($v)
	{


		if ($v === null) {
			$this->setKshowId(NULL);
		} else {
			$this->setKshowId($v->getId());
		}


		$this->akshowRelatedByKshowId = $v;
	}


	
	public function getkshowRelatedByKshowId($con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';

		if ($this->akshowRelatedByKshowId === null && (($this->kshow_id !== "" && $this->kshow_id !== null))) {

			$this->akshowRelatedByKshowId = kshowPeer::retrieveByPK($this->kshow_id, $con);

			
		}
		return $this->akshowRelatedByKshowId;
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

	
	public function setkshowRelatedByKuserId($v)
	{


		if ($v === null) {
			$this->setKuserId(NULL);
		} else {
			$this->setKuserId($v->getId());
		}


		$this->akshowRelatedByKuserId = $v;
	}


	
	public function getkshowRelatedByKuserId($con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';

		if ($this->akshowRelatedByKuserId === null && ($this->kuser_id !== null)) {

			$this->akshowRelatedByKuserId = kshowPeer::retrieveByPK($this->kuser_id, $con);

			
		}
		return $this->akshowRelatedByKuserId;
	}

} 