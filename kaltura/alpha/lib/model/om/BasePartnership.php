<?php


abstract class BasePartnership extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partnership_order;


	
	protected $image_path;


	
	protected $href;


	
	protected $text;


	
	protected $alt;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partnership_date;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPartnershipOrder()
	{

		return $this->partnership_order;
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

	
	public function getPartnershipDate()
	{

		return $this->partnership_date;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PartnershipPeer::ID;
		}

	} 
	
	public function setPartnershipOrder($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partnership_order !== $v) {
			$this->partnership_order = $v;
			$this->modifiedColumns[] = PartnershipPeer::PARTNERSHIP_ORDER;
		}

	} 
	
	public function setImagePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_path !== $v) {
			$this->image_path = $v;
			$this->modifiedColumns[] = PartnershipPeer::IMAGE_PATH;
		}

	} 
	
	public function setHref($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->href !== $v) {
			$this->href = $v;
			$this->modifiedColumns[] = PartnershipPeer::HREF;
		}

	} 
	
	public function setText($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = PartnershipPeer::TEXT;
		}

	} 
	
	public function setAlt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alt !== $v) {
			$this->alt = $v;
			$this->modifiedColumns[] = PartnershipPeer::ALT;
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
			$this->modifiedColumns[] = PartnershipPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PartnershipPeer::UPDATED_AT;
		}

	} 
	
	public function setPartnershipDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partnership_date !== $v) {
			$this->partnership_date = $v;
			$this->modifiedColumns[] = PartnershipPeer::PARTNERSHIP_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partnership_order = $rs->getInt($startcol + 1);

			$this->image_path = $rs->getString($startcol + 2);

			$this->href = $rs->getString($startcol + 3);

			$this->text = $rs->getString($startcol + 4);

			$this->alt = $rs->getString($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->partnership_date = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Partnership object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnershipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PartnershipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PartnershipPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PartnershipPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnershipPeer::DATABASE_NAME);
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
					$pk = PartnershipPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PartnershipPeer::doUpdate($this, $con);
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


			if (($retval = PartnershipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnershipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPartnershipOrder();
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
				return $this->getPartnershipDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnershipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnershipOrder(),
			$keys[2] => $this->getImagePath(),
			$keys[3] => $this->getHref(),
			$keys[4] => $this->getText(),
			$keys[5] => $this->getAlt(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
			$keys[8] => $this->getPartnershipDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnershipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPartnershipOrder($value);
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
				$this->setPartnershipDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnershipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnershipOrder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setImagePath($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHref($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setText($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAlt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPartnershipDate($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PartnershipPeer::DATABASE_NAME);

		if ($this->isColumnModified(PartnershipPeer::ID)) $criteria->add(PartnershipPeer::ID, $this->id);
		if ($this->isColumnModified(PartnershipPeer::PARTNERSHIP_ORDER)) $criteria->add(PartnershipPeer::PARTNERSHIP_ORDER, $this->partnership_order);
		if ($this->isColumnModified(PartnershipPeer::IMAGE_PATH)) $criteria->add(PartnershipPeer::IMAGE_PATH, $this->image_path);
		if ($this->isColumnModified(PartnershipPeer::HREF)) $criteria->add(PartnershipPeer::HREF, $this->href);
		if ($this->isColumnModified(PartnershipPeer::TEXT)) $criteria->add(PartnershipPeer::TEXT, $this->text);
		if ($this->isColumnModified(PartnershipPeer::ALT)) $criteria->add(PartnershipPeer::ALT, $this->alt);
		if ($this->isColumnModified(PartnershipPeer::CREATED_AT)) $criteria->add(PartnershipPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PartnershipPeer::UPDATED_AT)) $criteria->add(PartnershipPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(PartnershipPeer::PARTNERSHIP_DATE)) $criteria->add(PartnershipPeer::PARTNERSHIP_DATE, $this->partnership_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PartnershipPeer::DATABASE_NAME);

		$criteria->add(PartnershipPeer::ID, $this->id);

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

		$copyObj->setPartnershipOrder($this->partnership_order);

		$copyObj->setImagePath($this->image_path);

		$copyObj->setHref($this->href);

		$copyObj->setText($this->text);

		$copyObj->setAlt($this->alt);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPartnershipDate($this->partnership_date);


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
			self::$peer = new PartnershipPeer();
		}
		return self::$peer;
	}

} 