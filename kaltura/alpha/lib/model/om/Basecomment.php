<?php


abstract class Basecomment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kuser_id;


	
	protected $comment_type;


	
	protected $subject_id;


	
	protected $base_date;


	
	protected $reply_to;


	
	protected $comment;


	
	protected $created_at;

	
	protected $akuser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getCommentType()
	{

		return $this->comment_type;
	}

	
	public function getSubjectId()
	{

		return $this->subject_id;
	}

	
	public function getBaseDate($format = 'Y-m-d')
	{

		if ($this->base_date === null || $this->base_date === '') {
			return null;
		} elseif (!is_int($this->base_date)) {
						$ts = strtotime($this->base_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [base_date] as date/time value: " . var_export($this->base_date, true));
			}
		} else {
			$ts = $this->base_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getReplyTo()
	{

		return $this->reply_to;
	}

	
	public function getComment()
	{

		return $this->comment;
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
			$this->modifiedColumns[] = commentPeer::ID;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = commentPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setCommentType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->comment_type !== $v) {
			$this->comment_type = $v;
			$this->modifiedColumns[] = commentPeer::COMMENT_TYPE;
		}

	} 
	
	public function setSubjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subject_id !== $v) {
			$this->subject_id = $v;
			$this->modifiedColumns[] = commentPeer::SUBJECT_ID;
		}

	} 
	
	public function setBaseDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [base_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->base_date !== $ts) {
			$this->base_date = $ts;
			$this->modifiedColumns[] = commentPeer::BASE_DATE;
		}

	} 
	
	public function setReplyTo($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->reply_to !== $v) {
			$this->reply_to = $v;
			$this->modifiedColumns[] = commentPeer::REPLY_TO;
		}

	} 
	
	public function setComment($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = commentPeer::COMMENT;
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
			$this->modifiedColumns[] = commentPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->kuser_id = $rs->getInt($startcol + 1);

			$this->comment_type = $rs->getInt($startcol + 2);

			$this->subject_id = $rs->getInt($startcol + 3);

			$this->base_date = $rs->getDate($startcol + 4, null);

			$this->reply_to = $rs->getInt($startcol + 5);

			$this->comment = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating comment object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(commentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			commentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(commentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(commentPeer::DATABASE_NAME);
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
					$pk = commentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += commentPeer::doUpdate($this, $con);
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


			if (($retval = commentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = commentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKuserId();
				break;
			case 2:
				return $this->getCommentType();
				break;
			case 3:
				return $this->getSubjectId();
				break;
			case 4:
				return $this->getBaseDate();
				break;
			case 5:
				return $this->getReplyTo();
				break;
			case 6:
				return $this->getComment();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = commentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKuserId(),
			$keys[2] => $this->getCommentType(),
			$keys[3] => $this->getSubjectId(),
			$keys[4] => $this->getBaseDate(),
			$keys[5] => $this->getReplyTo(),
			$keys[6] => $this->getComment(),
			$keys[7] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = commentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKuserId($value);
				break;
			case 2:
				$this->setCommentType($value);
				break;
			case 3:
				$this->setSubjectId($value);
				break;
			case 4:
				$this->setBaseDate($value);
				break;
			case 5:
				$this->setReplyTo($value);
				break;
			case 6:
				$this->setComment($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = commentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKuserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCommentType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSubjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBaseDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setReplyTo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setComment($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(commentPeer::DATABASE_NAME);

		if ($this->isColumnModified(commentPeer::ID)) $criteria->add(commentPeer::ID, $this->id);
		if ($this->isColumnModified(commentPeer::KUSER_ID)) $criteria->add(commentPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(commentPeer::COMMENT_TYPE)) $criteria->add(commentPeer::COMMENT_TYPE, $this->comment_type);
		if ($this->isColumnModified(commentPeer::SUBJECT_ID)) $criteria->add(commentPeer::SUBJECT_ID, $this->subject_id);
		if ($this->isColumnModified(commentPeer::BASE_DATE)) $criteria->add(commentPeer::BASE_DATE, $this->base_date);
		if ($this->isColumnModified(commentPeer::REPLY_TO)) $criteria->add(commentPeer::REPLY_TO, $this->reply_to);
		if ($this->isColumnModified(commentPeer::COMMENT)) $criteria->add(commentPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(commentPeer::CREATED_AT)) $criteria->add(commentPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(commentPeer::DATABASE_NAME);

		$criteria->add(commentPeer::ID, $this->id);

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

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setCommentType($this->comment_type);

		$copyObj->setSubjectId($this->subject_id);

		$copyObj->setBaseDate($this->base_date);

		$copyObj->setReplyTo($this->reply_to);

		$copyObj->setComment($this->comment);

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
			self::$peer = new commentPeer();
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