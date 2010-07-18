<?php


abstract class BasePartnerStats extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $partner_id;


	
	protected $views;


	
	protected $plays;


	
	protected $videos;


	
	protected $audios;


	
	protected $images;


	
	protected $entries;


	
	protected $users_1;


	
	protected $users_2;


	
	protected $rc_1;


	
	protected $rc_2;


	
	protected $kshows_1;


	
	protected $kshows_2;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $custom_data;


	
	protected $widgets;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getViews()
	{

		return $this->views;
	}

	
	public function getPlays()
	{

		return $this->plays;
	}

	
	public function getVideos()
	{

		return $this->videos;
	}

	
	public function getAudios()
	{

		return $this->audios;
	}

	
	public function getImages()
	{

		return $this->images;
	}

	
	public function getEntries()
	{

		return $this->entries;
	}

	
	public function getUsers1()
	{

		return $this->users_1;
	}

	
	public function getUsers2()
	{

		return $this->users_2;
	}

	
	public function getRc1()
	{

		return $this->rc_1;
	}

	
	public function getRc2()
	{

		return $this->rc_2;
	}

	
	public function getKshows1()
	{

		return $this->kshows_1;
	}

	
	public function getKshows2()
	{

		return $this->kshows_2;
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

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getWidgets()
	{

		return $this->widgets;
	}

	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::PARTNER_ID;
		}

	} 
	
	public function setViews($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->views !== $v) {
			$this->views = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::VIEWS;
		}

	} 
	
	public function setPlays($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->plays !== $v) {
			$this->plays = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::PLAYS;
		}

	} 
	
	public function setVideos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->videos !== $v) {
			$this->videos = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::VIDEOS;
		}

	} 
	
	public function setAudios($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->audios !== $v) {
			$this->audios = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::AUDIOS;
		}

	} 
	
	public function setImages($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->images !== $v) {
			$this->images = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::IMAGES;
		}

	} 
	
	public function setEntries($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entries !== $v) {
			$this->entries = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::ENTRIES;
		}

	} 
	
	public function setUsers1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->users_1 !== $v) {
			$this->users_1 = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::USERS_1;
		}

	} 
	
	public function setUsers2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->users_2 !== $v) {
			$this->users_2 = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::USERS_2;
		}

	} 
	
	public function setRc1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rc_1 !== $v) {
			$this->rc_1 = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::RC_1;
		}

	} 
	
	public function setRc2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rc_2 !== $v) {
			$this->rc_2 = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::RC_2;
		}

	} 
	
	public function setKshows1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kshows_1 !== $v) {
			$this->kshows_1 = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::KSHOWS_1;
		}

	} 
	
	public function setKshows2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kshows_2 !== $v) {
			$this->kshows_2 = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::KSHOWS_2;
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
			$this->modifiedColumns[] = PartnerStatsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PartnerStatsPeer::UPDATED_AT;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::CUSTOM_DATA;
		}

	} 
	
	public function setWidgets($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->widgets !== $v) {
			$this->widgets = $v;
			$this->modifiedColumns[] = PartnerStatsPeer::WIDGETS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->partner_id = $rs->getInt($startcol + 0);

			$this->views = $rs->getInt($startcol + 1);

			$this->plays = $rs->getInt($startcol + 2);

			$this->videos = $rs->getInt($startcol + 3);

			$this->audios = $rs->getInt($startcol + 4);

			$this->images = $rs->getInt($startcol + 5);

			$this->entries = $rs->getInt($startcol + 6);

			$this->users_1 = $rs->getInt($startcol + 7);

			$this->users_2 = $rs->getInt($startcol + 8);

			$this->rc_1 = $rs->getInt($startcol + 9);

			$this->rc_2 = $rs->getInt($startcol + 10);

			$this->kshows_1 = $rs->getInt($startcol + 11);

			$this->kshows_2 = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->custom_data = $rs->getString($startcol + 15);

			$this->widgets = $rs->getInt($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PartnerStats object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerStatsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PartnerStatsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PartnerStatsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PartnerStatsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerStatsPeer::DATABASE_NAME);
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
					$pk = PartnerStatsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PartnerStatsPeer::doUpdate($this, $con);
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


			if (($retval = PartnerStatsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerStatsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPartnerId();
				break;
			case 1:
				return $this->getViews();
				break;
			case 2:
				return $this->getPlays();
				break;
			case 3:
				return $this->getVideos();
				break;
			case 4:
				return $this->getAudios();
				break;
			case 5:
				return $this->getImages();
				break;
			case 6:
				return $this->getEntries();
				break;
			case 7:
				return $this->getUsers1();
				break;
			case 8:
				return $this->getUsers2();
				break;
			case 9:
				return $this->getRc1();
				break;
			case 10:
				return $this->getRc2();
				break;
			case 11:
				return $this->getKshows1();
				break;
			case 12:
				return $this->getKshows2();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			case 15:
				return $this->getCustomData();
				break;
			case 16:
				return $this->getWidgets();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerStatsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPartnerId(),
			$keys[1] => $this->getViews(),
			$keys[2] => $this->getPlays(),
			$keys[3] => $this->getVideos(),
			$keys[4] => $this->getAudios(),
			$keys[5] => $this->getImages(),
			$keys[6] => $this->getEntries(),
			$keys[7] => $this->getUsers1(),
			$keys[8] => $this->getUsers2(),
			$keys[9] => $this->getRc1(),
			$keys[10] => $this->getRc2(),
			$keys[11] => $this->getKshows1(),
			$keys[12] => $this->getKshows2(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getUpdatedAt(),
			$keys[15] => $this->getCustomData(),
			$keys[16] => $this->getWidgets(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerStatsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPartnerId($value);
				break;
			case 1:
				$this->setViews($value);
				break;
			case 2:
				$this->setPlays($value);
				break;
			case 3:
				$this->setVideos($value);
				break;
			case 4:
				$this->setAudios($value);
				break;
			case 5:
				$this->setImages($value);
				break;
			case 6:
				$this->setEntries($value);
				break;
			case 7:
				$this->setUsers1($value);
				break;
			case 8:
				$this->setUsers2($value);
				break;
			case 9:
				$this->setRc1($value);
				break;
			case 10:
				$this->setRc2($value);
				break;
			case 11:
				$this->setKshows1($value);
				break;
			case 12:
				$this->setKshows2($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
			case 15:
				$this->setCustomData($value);
				break;
			case 16:
				$this->setWidgets($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerStatsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPartnerId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setViews($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPlays($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVideos($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAudios($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setImages($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEntries($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUsers1($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUsers2($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setRc1($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRc2($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setKshows1($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setKshows2($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCustomData($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setWidgets($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PartnerStatsPeer::DATABASE_NAME);

		if ($this->isColumnModified(PartnerStatsPeer::PARTNER_ID)) $criteria->add(PartnerStatsPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(PartnerStatsPeer::VIEWS)) $criteria->add(PartnerStatsPeer::VIEWS, $this->views);
		if ($this->isColumnModified(PartnerStatsPeer::PLAYS)) $criteria->add(PartnerStatsPeer::PLAYS, $this->plays);
		if ($this->isColumnModified(PartnerStatsPeer::VIDEOS)) $criteria->add(PartnerStatsPeer::VIDEOS, $this->videos);
		if ($this->isColumnModified(PartnerStatsPeer::AUDIOS)) $criteria->add(PartnerStatsPeer::AUDIOS, $this->audios);
		if ($this->isColumnModified(PartnerStatsPeer::IMAGES)) $criteria->add(PartnerStatsPeer::IMAGES, $this->images);
		if ($this->isColumnModified(PartnerStatsPeer::ENTRIES)) $criteria->add(PartnerStatsPeer::ENTRIES, $this->entries);
		if ($this->isColumnModified(PartnerStatsPeer::USERS_1)) $criteria->add(PartnerStatsPeer::USERS_1, $this->users_1);
		if ($this->isColumnModified(PartnerStatsPeer::USERS_2)) $criteria->add(PartnerStatsPeer::USERS_2, $this->users_2);
		if ($this->isColumnModified(PartnerStatsPeer::RC_1)) $criteria->add(PartnerStatsPeer::RC_1, $this->rc_1);
		if ($this->isColumnModified(PartnerStatsPeer::RC_2)) $criteria->add(PartnerStatsPeer::RC_2, $this->rc_2);
		if ($this->isColumnModified(PartnerStatsPeer::KSHOWS_1)) $criteria->add(PartnerStatsPeer::KSHOWS_1, $this->kshows_1);
		if ($this->isColumnModified(PartnerStatsPeer::KSHOWS_2)) $criteria->add(PartnerStatsPeer::KSHOWS_2, $this->kshows_2);
		if ($this->isColumnModified(PartnerStatsPeer::CREATED_AT)) $criteria->add(PartnerStatsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PartnerStatsPeer::UPDATED_AT)) $criteria->add(PartnerStatsPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(PartnerStatsPeer::CUSTOM_DATA)) $criteria->add(PartnerStatsPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(PartnerStatsPeer::WIDGETS)) $criteria->add(PartnerStatsPeer::WIDGETS, $this->widgets);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PartnerStatsPeer::DATABASE_NAME);

		$criteria->add(PartnerStatsPeer::PARTNER_ID, $this->partner_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getPartnerId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setPartnerId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setViews($this->views);

		$copyObj->setPlays($this->plays);

		$copyObj->setVideos($this->videos);

		$copyObj->setAudios($this->audios);

		$copyObj->setImages($this->images);

		$copyObj->setEntries($this->entries);

		$copyObj->setUsers1($this->users_1);

		$copyObj->setUsers2($this->users_2);

		$copyObj->setRc1($this->rc_1);

		$copyObj->setRc2($this->rc_2);

		$copyObj->setKshows1($this->kshows_1);

		$copyObj->setKshows2($this->kshows_2);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setWidgets($this->widgets);


		$copyObj->setNew(true);

		$copyObj->setPartnerId(NULL); 
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
			self::$peer = new PartnerStatsPeer();
		}
		return self::$peer;
	}

} 