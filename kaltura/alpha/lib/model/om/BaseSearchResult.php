<?php


abstract class BaseSearchResult extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_id;


	
	protected $keywords;


	
	protected $source;


	
	protected $media_type;


	
	protected $title;


	
	protected $tags;


	
	protected $description;


	
	protected $url;


	
	protected $thumb_url;


	
	protected $source_link;


	
	protected $credit;


	
	protected $embed_code;


	
	protected $license_type;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getKeywords()
	{

		return $this->keywords;
	}

	
	public function getSource()
	{

		return $this->source;
	}

	
	public function getMediaType()
	{

		return $this->media_type;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getThumbUrl()
	{

		return $this->thumb_url;
	}

	
	public function getSourceLink()
	{

		return $this->source_link;
	}

	
	public function getCredit()
	{

		return $this->credit;
	}

	
	public function getEmbedCode()
	{

		return $this->embed_code;
	}

	
	public function getLicenseType()
	{

		return $this->license_type;
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
			$this->modifiedColumns[] = SearchResultPeer::ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = SearchResultPeer::PARTNER_ID;
		}

	} 
	
	public function setKeywords($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->keywords !== $v) {
			$this->keywords = $v;
			$this->modifiedColumns[] = SearchResultPeer::KEYWORDS;
		}

	} 
	
	public function setSource($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->source !== $v) {
			$this->source = $v;
			$this->modifiedColumns[] = SearchResultPeer::SOURCE;
		}

	} 
	
	public function setMediaType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->media_type !== $v) {
			$this->media_type = $v;
			$this->modifiedColumns[] = SearchResultPeer::MEDIA_TYPE;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = SearchResultPeer::TITLE;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = SearchResultPeer::TAGS;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = SearchResultPeer::DESCRIPTION;
		}

	} 
	
	public function setUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = SearchResultPeer::URL;
		}

	} 
	
	public function setThumbUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thumb_url !== $v) {
			$this->thumb_url = $v;
			$this->modifiedColumns[] = SearchResultPeer::THUMB_URL;
		}

	} 
	
	public function setSourceLink($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_link !== $v) {
			$this->source_link = $v;
			$this->modifiedColumns[] = SearchResultPeer::SOURCE_LINK;
		}

	} 
	
	public function setCredit($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credit !== $v) {
			$this->credit = $v;
			$this->modifiedColumns[] = SearchResultPeer::CREDIT;
		}

	} 
	
	public function setEmbedCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->embed_code !== $v) {
			$this->embed_code = $v;
			$this->modifiedColumns[] = SearchResultPeer::EMBED_CODE;
		}

	} 
	
	public function setLicenseType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->license_type !== $v) {
			$this->license_type = $v;
			$this->modifiedColumns[] = SearchResultPeer::LICENSE_TYPE;
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
			$this->modifiedColumns[] = SearchResultPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SearchResultPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_id = $rs->getInt($startcol + 1);

			$this->keywords = $rs->getString($startcol + 2);

			$this->source = $rs->getInt($startcol + 3);

			$this->media_type = $rs->getInt($startcol + 4);

			$this->title = $rs->getString($startcol + 5);

			$this->tags = $rs->getString($startcol + 6);

			$this->description = $rs->getString($startcol + 7);

			$this->url = $rs->getString($startcol + 8);

			$this->thumb_url = $rs->getString($startcol + 9);

			$this->source_link = $rs->getString($startcol + 10);

			$this->credit = $rs->getString($startcol + 11);

			$this->embed_code = $rs->getString($startcol + 12);

			$this->license_type = $rs->getInt($startcol + 13);

			$this->created_at = $rs->getTimestamp($startcol + 14, null);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SearchResult object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SearchResultPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SearchResultPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SearchResultPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SearchResultPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SearchResultPeer::DATABASE_NAME);
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
					$pk = SearchResultPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SearchResultPeer::doUpdate($this, $con);
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


			if (($retval = SearchResultPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SearchResultPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPartnerId();
				break;
			case 2:
				return $this->getKeywords();
				break;
			case 3:
				return $this->getSource();
				break;
			case 4:
				return $this->getMediaType();
				break;
			case 5:
				return $this->getTitle();
				break;
			case 6:
				return $this->getTags();
				break;
			case 7:
				return $this->getDescription();
				break;
			case 8:
				return $this->getUrl();
				break;
			case 9:
				return $this->getThumbUrl();
				break;
			case 10:
				return $this->getSourceLink();
				break;
			case 11:
				return $this->getCredit();
				break;
			case 12:
				return $this->getEmbedCode();
				break;
			case 13:
				return $this->getLicenseType();
				break;
			case 14:
				return $this->getCreatedAt();
				break;
			case 15:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SearchResultPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerId(),
			$keys[2] => $this->getKeywords(),
			$keys[3] => $this->getSource(),
			$keys[4] => $this->getMediaType(),
			$keys[5] => $this->getTitle(),
			$keys[6] => $this->getTags(),
			$keys[7] => $this->getDescription(),
			$keys[8] => $this->getUrl(),
			$keys[9] => $this->getThumbUrl(),
			$keys[10] => $this->getSourceLink(),
			$keys[11] => $this->getCredit(),
			$keys[12] => $this->getEmbedCode(),
			$keys[13] => $this->getLicenseType(),
			$keys[14] => $this->getCreatedAt(),
			$keys[15] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SearchResultPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPartnerId($value);
				break;
			case 2:
				$this->setKeywords($value);
				break;
			case 3:
				$this->setSource($value);
				break;
			case 4:
				$this->setMediaType($value);
				break;
			case 5:
				$this->setTitle($value);
				break;
			case 6:
				$this->setTags($value);
				break;
			case 7:
				$this->setDescription($value);
				break;
			case 8:
				$this->setUrl($value);
				break;
			case 9:
				$this->setThumbUrl($value);
				break;
			case 10:
				$this->setSourceLink($value);
				break;
			case 11:
				$this->setCredit($value);
				break;
			case 12:
				$this->setEmbedCode($value);
				break;
			case 13:
				$this->setLicenseType($value);
				break;
			case 14:
				$this->setCreatedAt($value);
				break;
			case 15:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SearchResultPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKeywords($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSource($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMediaType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTitle($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTags($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDescription($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUrl($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setThumbUrl($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSourceLink($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCredit($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setEmbedCode($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLicenseType($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SearchResultPeer::DATABASE_NAME);

		if ($this->isColumnModified(SearchResultPeer::ID)) $criteria->add(SearchResultPeer::ID, $this->id);
		if ($this->isColumnModified(SearchResultPeer::PARTNER_ID)) $criteria->add(SearchResultPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(SearchResultPeer::KEYWORDS)) $criteria->add(SearchResultPeer::KEYWORDS, $this->keywords);
		if ($this->isColumnModified(SearchResultPeer::SOURCE)) $criteria->add(SearchResultPeer::SOURCE, $this->source);
		if ($this->isColumnModified(SearchResultPeer::MEDIA_TYPE)) $criteria->add(SearchResultPeer::MEDIA_TYPE, $this->media_type);
		if ($this->isColumnModified(SearchResultPeer::TITLE)) $criteria->add(SearchResultPeer::TITLE, $this->title);
		if ($this->isColumnModified(SearchResultPeer::TAGS)) $criteria->add(SearchResultPeer::TAGS, $this->tags);
		if ($this->isColumnModified(SearchResultPeer::DESCRIPTION)) $criteria->add(SearchResultPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SearchResultPeer::URL)) $criteria->add(SearchResultPeer::URL, $this->url);
		if ($this->isColumnModified(SearchResultPeer::THUMB_URL)) $criteria->add(SearchResultPeer::THUMB_URL, $this->thumb_url);
		if ($this->isColumnModified(SearchResultPeer::SOURCE_LINK)) $criteria->add(SearchResultPeer::SOURCE_LINK, $this->source_link);
		if ($this->isColumnModified(SearchResultPeer::CREDIT)) $criteria->add(SearchResultPeer::CREDIT, $this->credit);
		if ($this->isColumnModified(SearchResultPeer::EMBED_CODE)) $criteria->add(SearchResultPeer::EMBED_CODE, $this->embed_code);
		if ($this->isColumnModified(SearchResultPeer::LICENSE_TYPE)) $criteria->add(SearchResultPeer::LICENSE_TYPE, $this->license_type);
		if ($this->isColumnModified(SearchResultPeer::CREATED_AT)) $criteria->add(SearchResultPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SearchResultPeer::UPDATED_AT)) $criteria->add(SearchResultPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SearchResultPeer::DATABASE_NAME);

		$criteria->add(SearchResultPeer::ID, $this->id);

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

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setKeywords($this->keywords);

		$copyObj->setSource($this->source);

		$copyObj->setMediaType($this->media_type);

		$copyObj->setTitle($this->title);

		$copyObj->setTags($this->tags);

		$copyObj->setDescription($this->description);

		$copyObj->setUrl($this->url);

		$copyObj->setThumbUrl($this->thumb_url);

		$copyObj->setSourceLink($this->source_link);

		$copyObj->setCredit($this->credit);

		$copyObj->setEmbedCode($this->embed_code);

		$copyObj->setLicenseType($this->license_type);

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
			self::$peer = new SearchResultPeer();
		}
		return self::$peer;
	}

} 