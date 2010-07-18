<?php


abstract class BaseBBForum extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $description;


	
	protected $post_count = 0;


	
	protected $thread_count = 0;


	
	protected $last_post;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $is_live = true;

	
	protected $aBBPost;

	
	protected $collBBPosts;

	
	protected $lastBBPostCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getPostCount()
	{

		return $this->post_count;
	}

	
	public function getThreadCount()
	{

		return $this->thread_count;
	}

	
	public function getLastPost()
	{

		return $this->last_post;
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

	
	public function getIsLive()
	{

		return $this->is_live;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BBForumPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = BBForumPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = BBForumPeer::DESCRIPTION;
		}

	} 
	
	public function setPostCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->post_count !== $v || $v === 0) {
			$this->post_count = $v;
			$this->modifiedColumns[] = BBForumPeer::POST_COUNT;
		}

	} 
	
	public function setThreadCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->thread_count !== $v || $v === 0) {
			$this->thread_count = $v;
			$this->modifiedColumns[] = BBForumPeer::THREAD_COUNT;
		}

	} 
	
	public function setLastPost($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_post !== $v) {
			$this->last_post = $v;
			$this->modifiedColumns[] = BBForumPeer::LAST_POST;
		}

		if ($this->aBBPost !== null && $this->aBBPost->getId() !== $v) {
			$this->aBBPost = null;
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
			$this->modifiedColumns[] = BBForumPeer::CREATED_AT;
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
			$this->modifiedColumns[] = BBForumPeer::UPDATED_AT;
		}

	} 
	
	public function setIsLive($v)
	{

		if ($this->is_live !== $v || $v === true) {
			$this->is_live = $v;
			$this->modifiedColumns[] = BBForumPeer::IS_LIVE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->post_count = $rs->getInt($startcol + 3);

			$this->thread_count = $rs->getInt($startcol + 4);

			$this->last_post = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->is_live = $rs->getBoolean($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating BBForum object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BBForumPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BBForumPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(BBForumPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BBForumPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BBForumPeer::DATABASE_NAME);
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


												
			if ($this->aBBPost !== null) {
				if ($this->aBBPost->isModified()) {
					$affectedRows += $this->aBBPost->save($con);
				}
				$this->setBBPost($this->aBBPost);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BBForumPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BBForumPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBBPosts !== null) {
				foreach($this->collBBPosts as $referrerFK) {
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


												
			if ($this->aBBPost !== null) {
				if (!$this->aBBPost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBBPost->getValidationFailures());
				}
			}


			if (($retval = BBForumPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBBPosts !== null) {
					foreach($this->collBBPosts as $referrerFK) {
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
		$pos = BBForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getPostCount();
				break;
			case 4:
				return $this->getThreadCount();
				break;
			case 5:
				return $this->getLastPost();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			case 8:
				return $this->getIsLive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BBForumPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getPostCount(),
			$keys[4] => $this->getThreadCount(),
			$keys[5] => $this->getLastPost(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
			$keys[8] => $this->getIsLive(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BBForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setPostCount($value);
				break;
			case 4:
				$this->setThreadCount($value);
				break;
			case 5:
				$this->setLastPost($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
			case 8:
				$this->setIsLive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BBForumPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPostCount($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setThreadCount($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLastPost($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsLive($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BBForumPeer::DATABASE_NAME);

		if ($this->isColumnModified(BBForumPeer::ID)) $criteria->add(BBForumPeer::ID, $this->id);
		if ($this->isColumnModified(BBForumPeer::NAME)) $criteria->add(BBForumPeer::NAME, $this->name);
		if ($this->isColumnModified(BBForumPeer::DESCRIPTION)) $criteria->add(BBForumPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(BBForumPeer::POST_COUNT)) $criteria->add(BBForumPeer::POST_COUNT, $this->post_count);
		if ($this->isColumnModified(BBForumPeer::THREAD_COUNT)) $criteria->add(BBForumPeer::THREAD_COUNT, $this->thread_count);
		if ($this->isColumnModified(BBForumPeer::LAST_POST)) $criteria->add(BBForumPeer::LAST_POST, $this->last_post);
		if ($this->isColumnModified(BBForumPeer::CREATED_AT)) $criteria->add(BBForumPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BBForumPeer::UPDATED_AT)) $criteria->add(BBForumPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(BBForumPeer::IS_LIVE)) $criteria->add(BBForumPeer::IS_LIVE, $this->is_live);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BBForumPeer::DATABASE_NAME);

		$criteria->add(BBForumPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setPostCount($this->post_count);

		$copyObj->setThreadCount($this->thread_count);

		$copyObj->setLastPost($this->last_post);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setIsLive($this->is_live);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBBPosts() as $relObj) {
				$copyObj->addBBPost($relObj->copy($deepCopy));
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
			self::$peer = new BBForumPeer();
		}
		return self::$peer;
	}

	
	public function setBBPost($v)
	{


		if ($v === null) {
			$this->setLastPost(NULL);
		} else {
			$this->setLastPost($v->getId());
		}


		$this->aBBPost = $v;
	}


	
	public function getBBPost($con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';

		if ($this->aBBPost === null && ($this->last_post !== null)) {

			$this->aBBPost = BBPostPeer::retrieveByPK($this->last_post, $con);

			
		}
		return $this->aBBPost;
	}

	
	public function initBBPosts()
	{
		if ($this->collBBPosts === null) {
			$this->collBBPosts = array();
		}
	}

	
	public function getBBPosts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBPosts === null) {
			if ($this->isNew()) {
			   $this->collBBPosts = array();
			} else {

				$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

				BBPostPeer::addSelectColumns($criteria);
				$this->collBBPosts = BBPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

				BBPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastBBPostCriteria) || !$this->lastBBPostCriteria->equals($criteria)) {
					$this->collBBPosts = BBPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBBPostCriteria = $criteria;
		return $this->collBBPosts;
	}

	
	public function countBBPosts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

		return BBPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBBPost(BBPost $l)
	{
		$this->collBBPosts[] = $l;
		$l->setBBForum($this);
	}


	
	public function getBBPostsJoinkuser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBPosts === null) {
			if ($this->isNew()) {
				$this->collBBPosts = array();
			} else {

				$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

				$this->collBBPosts = BBPostPeer::doSelectJoinkuser($criteria, $con);
			}
		} else {
									
			$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastBBPostCriteria) || !$this->lastBBPostCriteria->equals($criteria)) {
				$this->collBBPosts = BBPostPeer::doSelectJoinkuser($criteria, $con);
			}
		}
		$this->lastBBPostCriteria = $criteria;

		return $this->collBBPosts;
	}


	
	public function getBBPostsJoinBBPostRelatedByParentId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBBPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBBPosts === null) {
			if ($this->isNew()) {
				$this->collBBPosts = array();
			} else {

				$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

				$this->collBBPosts = BBPostPeer::doSelectJoinBBPostRelatedByParentId($criteria, $con);
			}
		} else {
									
			$criteria->add(BBPostPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastBBPostCriteria) || !$this->lastBBPostCriteria->equals($criteria)) {
				$this->collBBPosts = BBPostPeer::doSelectJoinBBPostRelatedByParentId($criteria, $con);
			}
		}
		$this->lastBBPostCriteria = $criteria;

		return $this->collBBPosts;
	}

} 