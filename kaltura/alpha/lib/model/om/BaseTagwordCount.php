<?php


abstract class BaseTagwordCount extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $tag;


	
	protected $tag_count;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getTag()
	{

		return $this->tag;
	}

	
	public function getTagCount()
	{

		return $this->tag_count;
	}

	
	public function setTag($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag !== $v) {
			$this->tag = $v;
			$this->modifiedColumns[] = TagwordCountPeer::TAG;
		}

	} 
	
	public function setTagCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tag_count !== $v) {
			$this->tag_count = $v;
			$this->modifiedColumns[] = TagwordCountPeer::TAG_COUNT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->tag = $rs->getString($startcol + 0);

			$this->tag_count = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TagwordCount object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TagwordCountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TagwordCountPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TagwordCountPeer::DATABASE_NAME);
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
					$pk = TagwordCountPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TagwordCountPeer::doUpdate($this, $con);
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


			if (($retval = TagwordCountPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagwordCountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getTag();
				break;
			case 1:
				return $this->getTagCount();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagwordCountPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTag(),
			$keys[1] => $this->getTagCount(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagwordCountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setTag($value);
				break;
			case 1:
				$this->setTagCount($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagwordCountPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTag($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTagCount($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TagwordCountPeer::DATABASE_NAME);

		if ($this->isColumnModified(TagwordCountPeer::TAG)) $criteria->add(TagwordCountPeer::TAG, $this->tag);
		if ($this->isColumnModified(TagwordCountPeer::TAG_COUNT)) $criteria->add(TagwordCountPeer::TAG_COUNT, $this->tag_count);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TagwordCountPeer::DATABASE_NAME);

		$criteria->add(TagwordCountPeer::TAG, $this->tag);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getTag();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setTag($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTagCount($this->tag_count);


		$copyObj->setNew(true);

		$copyObj->setTag(NULL); 
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
			self::$peer = new TagwordCountPeer();
		}
		return self::$peer;
	}

} 