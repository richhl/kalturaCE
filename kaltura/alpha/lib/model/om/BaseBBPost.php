<?php


abstract class BaseBBPost extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $content;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $kuser_id;


	
	protected $forum_id;


	
	protected $parent_id;


	
	protected $node_level;


	
	protected $node_id;


	
	protected $num_childern = 0;


	
	protected $last_child;

	
	protected $akuser;

	
	protected $aBBForum;

	
	protected $aBBPostRelatedByParentId;

	
	protected $collBBForums;

	
	protected $lastBBForumCriteria = null;

	
	protected $collBBPostsRelatedByParentId;

	
	protected $lastBBPostRelatedByParentIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getContent()
	{

		return $this->content;
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

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getForumId()
	{

		return $this->forum_id;
	}

	
	public function getParentId()
	{

		return $this->parent_id;
	}

	
	public function getNodeLevel()
	{

		return $this->node_level;
	}

	
	public function getNodeId()
	{

		return $this->node_id;
	}

	
	public function getNumChildern()
	{

		return $this->num_childern;
	}

	
	public function getLastChild()
	{

		return $this->last_child;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BBPostPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = BBPostPeer::TITLE;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = BBPostPeer::CONTENT;
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
			$this->modifiedColumns[] = BBPostPeer::CREATED_AT;
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
			$this->modifiedColumns[] = BBPostPeer::UPDATED_AT;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = BBPostPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setForumId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = BBPostPeer::FORUM_ID;
		}

		if ($this->aBBForum !== null && $this->aBBForum->getId() !== $v) {
			$this->aBBForum = null;
		}

	} 
	
	public function setParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = BBPostPeer::PARENT_ID;
		}

		if ($this->aBBPostRelatedByParentId !== null && $this->aBBPostRelatedByParentId->getId() !== $v) {
			$this->aBBPostRelatedByParentId = null;
		}

	} 
	
	public function setNodeLevel($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->node_level !== $v) {
			$this->node_level = $v;
			$this->modifiedColumns[] = BBPostPeer::NODE_LEVEL;
		}

	} 
	
	public function setNodeId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->node_id !== $v) {
			$this->node_id = $v;
			$this->modifiedColumns[] = BBPostPeer::NODE_ID;
		}

	} 
	
	public function setNumChildern($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_childern !== $v || $v === 0) {
			$this->num_childern = $v;
			$this->modifiedColumns[] = BBPostPeer::NUM_CHILDERN;
		}

	} 
	
	public function setLastChild($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_child !== $v) {
			$this->last_child = $v;
			$this->modifiedColumns[] = BBPostPeer::LAST_CHILD;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->content = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->kuser_id = $rs->getInt($startcol + 5);

			$this->forum_id = $rs->getInt($startcol + 6);

			$this->parent_id = $rs->getInt($startcol + 7);

			$this->node_level = $rs->getInt($startcol + 8);

			$this->node_id = $rs->getString($startcol + 9);

			$this->num_childern = $rs->getInt($startcol + 10);

			$this->last_child = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating BBPost object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BBPostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BBPostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(BBPostPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BBPostPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BBPostPeer::DATABASE_NAME);
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

			if ($this->aBBForum !== null) {
				if ($this->aBBForum->isModified()) {
					$affectedRows += $this->aBBForum->save($con);
				}
				$this->setBBForum($this->aBBForum);
			}

			if ($this->aBBPostRelatedByParentId !== null) {
				if ($this->aBBPostRelatedByParentId->isModified()) {
					$affectedRows += $this->aBBPostRelatedByParentId->save($con);
				}
				$this->setBBPostRelatedByParentId($this->aBBPostRelatedByParentId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BBPostPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BBPostPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBBForums !== null) {
				foreach($this->collBBForums as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collBBPostsRelatedByParentId !== null) {
				foreach($this->collBBPostsRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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

			if ($this->aBBForum !== null) {
				if (!$this->aBBForum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBBForum->getValidationFailures());
				}
			}

			if ($this->aBBPostRelatedByParentId !== null) {
				if (!$this->aBBPostRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBBPostRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = BBPostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBBForums !== null) {
					foreach($this->collBBForums as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BBPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getContent();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			case 5:
				return $this->getKuserId();
				break;
			case 6:
				return $this->getForumId();
				break;
			case 7:
				return $this->getParentId();
				break;
			case 8:
				return $this->getNodeLevel();
				break;
			case 9:
				return $this->getNodeId();
				break;
			case 10:
				return $this->getNumChildern();
				break;
			case 11:
				return $this->getLastChild();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BBPostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getContent(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
			$keys[5] => $this->getKuserId(),
			$keys[6] => $this->getForumId(),
			$keys[7] => $this->getParentId(),
			$keys[8] => $this->getNodeLevel(),
			$keys[9] => $this->getNodeId(),
			$keys[10] => $this->getNumChildern(),
			$keys[11] => $this->getLastChild(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BBPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setContent($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
			case 5:
				$this->setKuserId($value);
				break;
			case 6:
				$this->setForumId($value);
				break;
			case 7:
				$this->setParentId($value);
				break;
			case 8:
				$this->setNodeLevel($value);
				break;
			case 9:
				$this->setNodeId($value);
				break;
			case 10:
				$this->setNumChildern($value);
				break;
			case 11:
				$this->setLastChild($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BBPostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setKuserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setForumId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setParentId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setNodeLevel($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNodeId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNumChildern($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLastChild($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BBPostPeer::DATABASE_NAME);

		if ($this->isColumnModified(BBPostPeer::ID)) $criteria->add(BBPostPeer::ID, $this->id);
		if ($this->isColumnModified(BBPostPeer::TITLE)) $criteria->add(BBPostPeer::TITLE, $this->title);
		if ($this->isColumnModified(BBPostPeer::CONTENT)) $criteria->add(BBPostPeer::CONTENT, $this->content);
		if ($this->isColumnModified(BBPostPeer::CREATED_AT)) $criteria->add(BBPostPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BBPostPeer::UPDATED_AT)) $criteria->add(BBPostPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(BBPostPeer::KUSER_ID)) $criteria->add(BBPostPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(BBPostPeer::FORUM_ID)) $criteria->add(BBPostPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(BBPostPeer::PARENT_ID)) $criteria->add(BBPostPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(BBPostPeer::NODE_LEVEL)) $criteria->add(BBPostPeer::NODE_LEVEL, $this->node_level);
		if ($this->isColumnModified(BBPostPeer::NODE_ID)) $criteria->add(BBPostPeer::NODE_ID, $this->node_id);
		if ($this->isColumnModified(BBPostPeer::NUM_CHILDERN)) $criteria->add(BBPostPeer::NUM_CHILDERN, $this->num_childern);
		if ($this->isColumnModified(BBPostPeer::LAST_CHILD)) $criteria->add(BBPostPeer::LAST_CHILD, $this->last_child);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BBPostPeer::DATABASE_NAME);

		$criteria->add(BBPostPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setContent($this->content);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setParentId($this->parent_id);

		$copyObj->setNodeLevel($this->node_level);

		$copyObj->setNodeId($this->node_id);

		$copyObj->setNumChildern($this->num_childern);

		$copyObj->setLastChild($this->last_child);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBBForums() as $relObj) {
				$copyObj->addBBForum($relObj->copy($deepCopy));
			}

			foreach($this->getBBPostsRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addBBPostRelatedByParentId($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new BBPostPeer();
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

	
	public function setBBForum($v)
	{


		if ($v === null) {
			$this->setForumId(NULL);
		} else {
			$this->setForumId($v->getId());
		}


		$this->aBBForum = $v;
	}


	
	public function getBBForum($con = null)
	{
				include_once 'lib/model/om/BaseBBForumPeer.php';

		if ($this->aBBForum === null && ($this->forum_id !== null)) {

			$this->aBBForum = BBForumPeer::retrieveByPK($this->forum_id, $con);

			
		}
		return $this->aBBForum;
	}

	
	public function setBBPostRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aBBPostRelatedByParentId = $v;
	}


	
	public function getBBPostRelatedByParentId($con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';

		if ($this->aBBPostRelatedByParentId === null && ($this->parent_id !== null)) {

			$this->aBBPostRelatedByParentId = BBPostPeer::retrieveByPK($this->parent_id, $con);

			
		}
		return $this->aBBPostRelatedByParentId;
	}

	
	public function initBBForums()
	{
		if ($this->collBBForums === null) {
			$this->collBBForums = array();
		}
	}

	
	public function getBBForums($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBForums === null) {
			if ($this->isNew()) {
			   $this->collBBForums = array();
			} else {

				$criteria->add(BBForumPeer::LAST_POST, $this->getId());

				BBForumPeer::addSelectColumns($criteria);
				$this->collBBForums = BBForumPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BBForumPeer::LAST_POST, $this->getId());

				BBForumPeer::addSelectColumns($criteria);
				if (!isset($this->lastBBForumCriteria) || !$this->lastBBForumCriteria->equals($criteria)) {
					$this->collBBForums = BBForumPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBBForumCriteria = $criteria;
		return $this->collBBForums;
	}

	
	public function countBBForums($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBBForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BBForumPeer::LAST_POST, $this->getId());

		return BBForumPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBBForum(BBForum $l)
	{
		$this->collBBForums[] = $l;
		$l->setBBPost($this);
	}

	
	public function initBBPostsRelatedByParentId()
	{
		if ($this->collBBPostsRelatedByParentId === null) {
			$this->collBBPostsRelatedByParentId = array();
		}
	}

	
	public function getBBPostsRelatedByParentId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBPostsRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collBBPostsRelatedByParentId = array();
			} else {

				$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

				BBPostPeer::addSelectColumns($criteria);
				$this->collBBPostsRelatedByParentId = BBPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

				BBPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastBBPostRelatedByParentIdCriteria) || !$this->lastBBPostRelatedByParentIdCriteria->equals($criteria)) {
					$this->collBBPostsRelatedByParentId = BBPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBBPostRelatedByParentIdCriteria = $criteria;
		return $this->collBBPostsRelatedByParentId;
	}

	
	public function countBBPostsRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

		return BBPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBBPostRelatedByParentId(BBPost $l)
	{
		$this->collBBPostsRelatedByParentId[] = $l;
		$l->setBBPostRelatedByParentId($this);
	}


	
	public function getBBPostsRelatedByParentIdJoinkuser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBPostsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collBBPostsRelatedByParentId = array();
			} else {

				$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

				$this->collBBPostsRelatedByParentId = BBPostPeer::doSelectJoinkuser($criteria, $con);
			}
		} else {
									
			$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastBBPostRelatedByParentIdCriteria) || !$this->lastBBPostRelatedByParentIdCriteria->equals($criteria)) {
				$this->collBBPostsRelatedByParentId = BBPostPeer::doSelectJoinkuser($criteria, $con);
			}
		}
		$this->lastBBPostRelatedByParentIdCriteria = $criteria;

		return $this->collBBPostsRelatedByParentId;
	}


	
	public function getBBPostsRelatedByParentIdJoinBBForum($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBPostsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collBBPostsRelatedByParentId = array();
			} else {

				$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

				$this->collBBPostsRelatedByParentId = BBPostPeer::doSelectJoinBBForum($criteria, $con);
			}
		} else {
									
			$criteria->add(BBPostPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastBBPostRelatedByParentIdCriteria) || !$this->lastBBPostRelatedByParentIdCriteria->equals($criteria)) {
				$this->collBBPostsRelatedByParentId = BBPostPeer::doSelectJoinBBForum($criteria, $con);
			}
		}
		$this->lastBBPostRelatedByParentIdCriteria = $criteria;

		return $this->collBBPostsRelatedByParentId;
	}

} 