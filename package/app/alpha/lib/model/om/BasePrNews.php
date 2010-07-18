<?php


abstract class BasePrNews extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $pr_order;


	
	protected $image_path;


	
	protected $href;


	
	protected $text;


	
	protected $alt;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $press_date;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPrOrder()
	{

		return $this->pr_order;
	}

	
	public function getImagePath()
	{

		return $this->image_path;
	}

	
	public function getHref()
	{

		return $this->href;
	}

	
	public function getText()
	{

		return $this->text;
	}

	
	public function getAlt()
	{

		return $this->alt;
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

	
	public function getPressDate()
	{

		return $this->press_date;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PrNewsPeer::ID;
		}

	} 
	
	public function setPrOrder($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pr_order !== $v) {
			$this->pr_order = $v;
			$this->modifiedColumns[] = PrNewsPeer::PR_ORDER;
		}

	} 
	
	public function setImagePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_path !== $v) {
			$this->image_path = $v;
			$this->modifiedColumns[] = PrNewsPeer::IMAGE_PATH;
		}

	} 
	
	public function setHref($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->href !== $v) {
			$this->href = $v;
			$this->modifiedColumns[] = PrNewsPeer::HREF;
		}

	} 
	
	public function setText($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = PrNewsPeer::TEXT;
		}

	} 
	
	public function setAlt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alt !== $v) {
			$this->alt = $v;
			$this->modifiedColumns[] = PrNewsPeer::ALT;
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
			$this->modifiedColumns[] = PrNewsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PrNewsPeer::UPDATED_AT;
		}

	} 
	
	public function setPressDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->press_date !== $v) {
			$this->press_date = $v;
			$this->modifiedColumns[] = PrNewsPeer::PRESS_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->pr_order = $rs->getInt($startcol + 1);

			$this->image_path = $rs->getString($startcol + 2);

			$this->href = $rs->getString($startcol + 3);

			$this->text = $rs->getString($startcol + 4);

			$this->alt = $rs->getString($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->press_date = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PrNews object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PrNewsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PrNewsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PrNewsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PrNewsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PrNewsPeer::DATABASE_NAME);
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
					$pk = PrNewsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PrNewsPeer::doUpdate($this, $con);
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


			if (($retval = PrNewsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPrOrder();
				break;
			case 2:
				return $this->getImagePath();
				break;
			case 3:
				return $this->getHref();
				break;
			case 4:
				return $this->getText();
				break;
			case 5:
				return $this->getAlt();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			case 8:
				return $this->getPressDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrNewsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPrOrder(),
			$keys[2] => $this->getImagePath(),
			$keys[3] => $this->getHref(),
			$keys[4] => $this->getText(),
			$keys[5] => $this->getAlt(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
			$keys[8] => $this->getPressDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PrNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPrOrder($value);
				break;
			case 2:
				$this->setImagePath($value);
				break;
			case 3:
				$this->setHref($value);
				break;
			case 4:
				$this->setText($value);
				break;
			case 5:
				$this->setAlt($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
			case 8:
				$this->setPressDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PrNewsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPrOrder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setImagePath($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHref($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setText($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAlt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPressDate($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PrNewsPeer::DATABASE_NAME);

		if ($this->isColumnModified(PrNewsPeer::ID)) $criteria->add(PrNewsPeer::ID, $this->id);
		if ($this->isColumnModified(PrNewsPeer::PR_ORDER)) $criteria->add(PrNewsPeer::PR_ORDER, $this->pr_order);
		if ($this->isColumnModified(PrNewsPeer::IMAGE_PATH)) $criteria->add(PrNewsPeer::IMAGE_PATH, $this->image_path);
		if ($this->isColumnModified(PrNewsPeer::HREF)) $criteria->add(PrNewsPeer::HREF, $this->href);
		if ($this->isColumnModified(PrNewsPeer::TEXT)) $criteria->add(PrNewsPeer::TEXT, $this->text);
		if ($this->isColumnModified(PrNewsPeer::ALT)) $criteria->add(PrNewsPeer::ALT, $this->alt);
		if ($this->isColumnModified(PrNewsPeer::CREATED_AT)) $criteria->add(PrNewsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PrNewsPeer::UPDATED_AT)) $criteria->add(PrNewsPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(PrNewsPeer::PRESS_DATE)) $criteria->add(PrNewsPeer::PRESS_DATE, $this->press_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PrNewsPeer::DATABASE_NAME);

		$criteria->add(PrNewsPeer::ID, $this->id);

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

		$copyObj->setPrOrder($this->pr_order);

		$copyObj->setImagePath($this->image_path);

		$copyObj->setHref($this->href);

		$copyObj->setText($this->text);

		$copyObj->setAlt($this->alt);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPressDate($this->press_date);


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
			self::$peer = new PrNewsPeer();
		}
		return self::$peer;
	}

} 