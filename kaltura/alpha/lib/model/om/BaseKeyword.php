<?php


abstract class BaseKeyword extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $word;


	
	protected $entity_id;


	
	protected $entity_type;


	
	protected $entity_columns;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getWord()
	{

		return $this->word;
	}

	
	public function getEntityId()
	{

		return $this->entity_id;
	}

	
	public function getEntityType()
	{

		return $this->entity_type;
	}

	
	public function getEntityColumns()
	{

		return $this->entity_columns;
	}

	
	public function setWord($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->word !== $v) {
			$this->word = $v;
			$this->modifiedColumns[] = KeywordPeer::WORD;
		}

	} 
	
	public function setEntityId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entity_id !== $v) {
			$this->entity_id = $v;
			$this->modifiedColumns[] = KeywordPeer::ENTITY_ID;
		}

	} 
	
	public function setEntityType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entity_type !== $v) {
			$this->entity_type = $v;
			$this->modifiedColumns[] = KeywordPeer::ENTITY_TYPE;
		}

	} 
	
	public function setEntityColumns($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entity_columns !== $v) {
			$this->entity_columns = $v;
			$this->modifiedColumns[] = KeywordPeer::ENTITY_COLUMNS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->word = $rs->getString($startcol + 0);

			$this->entity_id = $rs->getInt($startcol + 1);

			$this->entity_type = $rs->getInt($startcol + 2);

			$this->entity_columns = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Keyword object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KeywordPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			KeywordPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(KeywordPeer::DATABASE_NAME);
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
					$pk = KeywordPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += KeywordPeer::doUpdate($this, $con);
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


			if (($retval = KeywordPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KeywordPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getWord();
				break;
			case 1:
				return $this->getEntityId();
				break;
			case 2:
				return $this->getEntityType();
				break;
			case 3:
				return $this->getEntityColumns();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KeywordPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getWord(),
			$keys[1] => $this->getEntityId(),
			$keys[2] => $this->getEntityType(),
			$keys[3] => $this->getEntityColumns(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KeywordPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setWord($value);
				break;
			case 1:
				$this->setEntityId($value);
				break;
			case 2:
				$this->setEntityType($value);
				break;
			case 3:
				$this->setEntityColumns($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KeywordPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setWord($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEntityId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEntityType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEntityColumns($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(KeywordPeer::DATABASE_NAME);

		if ($this->isColumnModified(KeywordPeer::WORD)) $criteria->add(KeywordPeer::WORD, $this->word);
		if ($this->isColumnModified(KeywordPeer::ENTITY_ID)) $criteria->add(KeywordPeer::ENTITY_ID, $this->entity_id);
		if ($this->isColumnModified(KeywordPeer::ENTITY_TYPE)) $criteria->add(KeywordPeer::ENTITY_TYPE, $this->entity_type);
		if ($this->isColumnModified(KeywordPeer::ENTITY_COLUMNS)) $criteria->add(KeywordPeer::ENTITY_COLUMNS, $this->entity_columns);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KeywordPeer::DATABASE_NAME);

		$criteria->add(KeywordPeer::WORD, $this->word);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getWord();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setWord($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setEntityId($this->entity_id);

		$copyObj->setEntityType($this->entity_type);

		$copyObj->setEntityColumns($this->entity_columns);


		$copyObj->setNew(true);

		$copyObj->setWord(NULL); 
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
			self::$peer = new KeywordPeer();
		}
		return self::$peer;
	}

} 