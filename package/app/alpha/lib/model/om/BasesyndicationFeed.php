<?php


abstract class BasesyndicationFeed extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $int_id;


	
	protected $partner_id;


	
	protected $playlist_id;


	
	protected $name = '';


	
	protected $status;


	
	protected $type;


	
	protected $landing_page = '';


	
	protected $flavor_param_id;


	
	protected $player_uiconf_id;


	
	protected $allow_embed = true;


	
	protected $adult_content;


	
	protected $transcode_existing_content = false;


	
	protected $add_to_default_conversion_profile = false;


	
	protected $categories;


	
	protected $feed_description;


	
	protected $language;


	
	protected $feed_landing_page;


	
	protected $owner_name;


	
	protected $owner_email;


	
	protected $feed_image_url;


	
	protected $feed_author;


	
	protected $created_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIntId()
	{

		return $this->int_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getPlaylistId()
	{

		return $this->playlist_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getLandingPage()
	{

		return $this->landing_page;
	}

	
	public function getFlavorParamId()
	{

		return $this->flavor_param_id;
	}

	
	public function getPlayerUiconfId()
	{

		return $this->player_uiconf_id;
	}

	
	public function getAllowEmbed()
	{

		return $this->allow_embed;
	}

	
	public function getAdultContent()
	{

		return $this->adult_content;
	}

	
	public function getTranscodeExistingContent()
	{

		return $this->transcode_existing_content;
	}

	
	public function getAddToDefaultConversionProfile()
	{

		return $this->add_to_default_conversion_profile;
	}

	
	public function getCategories()
	{

		return $this->categories;
	}

	
	public function getFeedDescription()
	{

		return $this->feed_description;
	}

	
	public function getLanguage()
	{

		return $this->language;
	}

	
	public function getFeedLandingPage()
	{

		return $this->feed_landing_page;
	}

	
	public function getOwnerName()
	{

		return $this->owner_name;
	}

	
	public function getOwnerEmail()
	{

		return $this->owner_email;
	}

	
	public function getFeedImageUrl()
	{

		return $this->feed_image_url;
	}

	
	public function getFeedAuthor()
	{

		return $this->feed_author;
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

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::ID;
		}

	} 
	
	public function setIntId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->int_id !== $v) {
			$this->int_id = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::INT_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::PARTNER_ID;
		}

	} 
	
	public function setPlaylistId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->playlist_id !== $v) {
			$this->playlist_id = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::PLAYLIST_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::NAME;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::STATUS;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::TYPE;
		}

	} 
	
	public function setLandingPage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->landing_page !== $v || $v === '') {
			$this->landing_page = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::LANDING_PAGE;
		}

	} 
	
	public function setFlavorParamId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->flavor_param_id !== $v) {
			$this->flavor_param_id = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::FLAVOR_PARAM_ID;
		}

	} 
	
	public function setPlayerUiconfId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->player_uiconf_id !== $v) {
			$this->player_uiconf_id = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::PLAYER_UICONF_ID;
		}

	} 
	
	public function setAllowEmbed($v)
	{

		if ($this->allow_embed !== $v || $v === true) {
			$this->allow_embed = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::ALLOW_EMBED;
		}

	} 
	
	public function setAdultContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->adult_content !== $v) {
			$this->adult_content = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::ADULT_CONTENT;
		}

	} 
	
	public function setTranscodeExistingContent($v)
	{

		if ($this->transcode_existing_content !== $v || $v === false) {
			$this->transcode_existing_content = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::TRANSCODE_EXISTING_CONTENT;
		}

	} 
	
	public function setAddToDefaultConversionProfile($v)
	{

		if ($this->add_to_default_conversion_profile !== $v || $v === false) {
			$this->add_to_default_conversion_profile = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::ADD_TO_DEFAULT_CONVERSION_PROFILE;
		}

	} 
	
	public function setCategories($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->categories !== $v) {
			$this->categories = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::CATEGORIES;
		}

	} 
	
	public function setFeedDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->feed_description !== $v) {
			$this->feed_description = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::FEED_DESCRIPTION;
		}

	} 
	
	public function setLanguage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::LANGUAGE;
		}

	} 
	
	public function setFeedLandingPage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->feed_landing_page !== $v) {
			$this->feed_landing_page = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::FEED_LANDING_PAGE;
		}

	} 
	
	public function setOwnerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->owner_name !== $v) {
			$this->owner_name = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::OWNER_NAME;
		}

	} 
	
	public function setOwnerEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->owner_email !== $v) {
			$this->owner_email = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::OWNER_EMAIL;
		}

	} 
	
	public function setFeedImageUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->feed_image_url !== $v) {
			$this->feed_image_url = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::FEED_IMAGE_URL;
		}

	} 
	
	public function setFeedAuthor($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->feed_author !== $v) {
			$this->feed_author = $v;
			$this->modifiedColumns[] = syndicationFeedPeer::FEED_AUTHOR;
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
			$this->modifiedColumns[] = syndicationFeedPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->int_id = $rs->getInt($startcol + 1);

			$this->partner_id = $rs->getInt($startcol + 2);

			$this->playlist_id = $rs->getString($startcol + 3);

			$this->name = $rs->getString($startcol + 4);

			$this->status = $rs->getInt($startcol + 5);

			$this->type = $rs->getInt($startcol + 6);

			$this->landing_page = $rs->getString($startcol + 7);

			$this->flavor_param_id = $rs->getInt($startcol + 8);

			$this->player_uiconf_id = $rs->getInt($startcol + 9);

			$this->allow_embed = $rs->getBoolean($startcol + 10);

			$this->adult_content = $rs->getString($startcol + 11);

			$this->transcode_existing_content = $rs->getBoolean($startcol + 12);

			$this->add_to_default_conversion_profile = $rs->getBoolean($startcol + 13);

			$this->categories = $rs->getString($startcol + 14);

			$this->feed_description = $rs->getString($startcol + 15);

			$this->language = $rs->getString($startcol + 16);

			$this->feed_landing_page = $rs->getString($startcol + 17);

			$this->owner_name = $rs->getString($startcol + 18);

			$this->owner_email = $rs->getString($startcol + 19);

			$this->feed_image_url = $rs->getString($startcol + 20);

			$this->feed_author = $rs->getString($startcol + 21);

			$this->created_at = $rs->getTimestamp($startcol + 22, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 23; 
		} catch (Exception $e) {
			throw new PropelException("Error populating syndicationFeed object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(syndicationFeedPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			syndicationFeedPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(syndicationFeedPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(syndicationFeedPeer::DATABASE_NAME);
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
					$pk = syndicationFeedPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += syndicationFeedPeer::doUpdate($this, $con);
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


			if (($retval = syndicationFeedPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = syndicationFeedPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIntId();
				break;
			case 2:
				return $this->getPartnerId();
				break;
			case 3:
				return $this->getPlaylistId();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getStatus();
				break;
			case 6:
				return $this->getType();
				break;
			case 7:
				return $this->getLandingPage();
				break;
			case 8:
				return $this->getFlavorParamId();
				break;
			case 9:
				return $this->getPlayerUiconfId();
				break;
			case 10:
				return $this->getAllowEmbed();
				break;
			case 11:
				return $this->getAdultContent();
				break;
			case 12:
				return $this->getTranscodeExistingContent();
				break;
			case 13:
				return $this->getAddToDefaultConversionProfile();
				break;
			case 14:
				return $this->getCategories();
				break;
			case 15:
				return $this->getFeedDescription();
				break;
			case 16:
				return $this->getLanguage();
				break;
			case 17:
				return $this->getFeedLandingPage();
				break;
			case 18:
				return $this->getOwnerName();
				break;
			case 19:
				return $this->getOwnerEmail();
				break;
			case 20:
				return $this->getFeedImageUrl();
				break;
			case 21:
				return $this->getFeedAuthor();
				break;
			case 22:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = syndicationFeedPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIntId(),
			$keys[2] => $this->getPartnerId(),
			$keys[3] => $this->getPlaylistId(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getStatus(),
			$keys[6] => $this->getType(),
			$keys[7] => $this->getLandingPage(),
			$keys[8] => $this->getFlavorParamId(),
			$keys[9] => $this->getPlayerUiconfId(),
			$keys[10] => $this->getAllowEmbed(),
			$keys[11] => $this->getAdultContent(),
			$keys[12] => $this->getTranscodeExistingContent(),
			$keys[13] => $this->getAddToDefaultConversionProfile(),
			$keys[14] => $this->getCategories(),
			$keys[15] => $this->getFeedDescription(),
			$keys[16] => $this->getLanguage(),
			$keys[17] => $this->getFeedLandingPage(),
			$keys[18] => $this->getOwnerName(),
			$keys[19] => $this->getOwnerEmail(),
			$keys[20] => $this->getFeedImageUrl(),
			$keys[21] => $this->getFeedAuthor(),
			$keys[22] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = syndicationFeedPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIntId($value);
				break;
			case 2:
				$this->setPartnerId($value);
				break;
			case 3:
				$this->setPlaylistId($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setStatus($value);
				break;
			case 6:
				$this->setType($value);
				break;
			case 7:
				$this->setLandingPage($value);
				break;
			case 8:
				$this->setFlavorParamId($value);
				break;
			case 9:
				$this->setPlayerUiconfId($value);
				break;
			case 10:
				$this->setAllowEmbed($value);
				break;
			case 11:
				$this->setAdultContent($value);
				break;
			case 12:
				$this->setTranscodeExistingContent($value);
				break;
			case 13:
				$this->setAddToDefaultConversionProfile($value);
				break;
			case 14:
				$this->setCategories($value);
				break;
			case 15:
				$this->setFeedDescription($value);
				break;
			case 16:
				$this->setLanguage($value);
				break;
			case 17:
				$this->setFeedLandingPage($value);
				break;
			case 18:
				$this->setOwnerName($value);
				break;
			case 19:
				$this->setOwnerEmail($value);
				break;
			case 20:
				$this->setFeedImageUrl($value);
				break;
			case 21:
				$this->setFeedAuthor($value);
				break;
			case 22:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = syndicationFeedPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIntId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPlaylistId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLandingPage($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFlavorParamId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPlayerUiconfId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setAllowEmbed($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setAdultContent($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTranscodeExistingContent($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAddToDefaultConversionProfile($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCategories($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setFeedDescription($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLanguage($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFeedLandingPage($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setOwnerName($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setOwnerEmail($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setFeedImageUrl($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setFeedAuthor($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCreatedAt($arr[$keys[22]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(syndicationFeedPeer::DATABASE_NAME);

		if ($this->isColumnModified(syndicationFeedPeer::ID)) $criteria->add(syndicationFeedPeer::ID, $this->id);
		if ($this->isColumnModified(syndicationFeedPeer::INT_ID)) $criteria->add(syndicationFeedPeer::INT_ID, $this->int_id);
		if ($this->isColumnModified(syndicationFeedPeer::PARTNER_ID)) $criteria->add(syndicationFeedPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(syndicationFeedPeer::PLAYLIST_ID)) $criteria->add(syndicationFeedPeer::PLAYLIST_ID, $this->playlist_id);
		if ($this->isColumnModified(syndicationFeedPeer::NAME)) $criteria->add(syndicationFeedPeer::NAME, $this->name);
		if ($this->isColumnModified(syndicationFeedPeer::STATUS)) $criteria->add(syndicationFeedPeer::STATUS, $this->status);
		if ($this->isColumnModified(syndicationFeedPeer::TYPE)) $criteria->add(syndicationFeedPeer::TYPE, $this->type);
		if ($this->isColumnModified(syndicationFeedPeer::LANDING_PAGE)) $criteria->add(syndicationFeedPeer::LANDING_PAGE, $this->landing_page);
		if ($this->isColumnModified(syndicationFeedPeer::FLAVOR_PARAM_ID)) $criteria->add(syndicationFeedPeer::FLAVOR_PARAM_ID, $this->flavor_param_id);
		if ($this->isColumnModified(syndicationFeedPeer::PLAYER_UICONF_ID)) $criteria->add(syndicationFeedPeer::PLAYER_UICONF_ID, $this->player_uiconf_id);
		if ($this->isColumnModified(syndicationFeedPeer::ALLOW_EMBED)) $criteria->add(syndicationFeedPeer::ALLOW_EMBED, $this->allow_embed);
		if ($this->isColumnModified(syndicationFeedPeer::ADULT_CONTENT)) $criteria->add(syndicationFeedPeer::ADULT_CONTENT, $this->adult_content);
		if ($this->isColumnModified(syndicationFeedPeer::TRANSCODE_EXISTING_CONTENT)) $criteria->add(syndicationFeedPeer::TRANSCODE_EXISTING_CONTENT, $this->transcode_existing_content);
		if ($this->isColumnModified(syndicationFeedPeer::ADD_TO_DEFAULT_CONVERSION_PROFILE)) $criteria->add(syndicationFeedPeer::ADD_TO_DEFAULT_CONVERSION_PROFILE, $this->add_to_default_conversion_profile);
		if ($this->isColumnModified(syndicationFeedPeer::CATEGORIES)) $criteria->add(syndicationFeedPeer::CATEGORIES, $this->categories);
		if ($this->isColumnModified(syndicationFeedPeer::FEED_DESCRIPTION)) $criteria->add(syndicationFeedPeer::FEED_DESCRIPTION, $this->feed_description);
		if ($this->isColumnModified(syndicationFeedPeer::LANGUAGE)) $criteria->add(syndicationFeedPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(syndicationFeedPeer::FEED_LANDING_PAGE)) $criteria->add(syndicationFeedPeer::FEED_LANDING_PAGE, $this->feed_landing_page);
		if ($this->isColumnModified(syndicationFeedPeer::OWNER_NAME)) $criteria->add(syndicationFeedPeer::OWNER_NAME, $this->owner_name);
		if ($this->isColumnModified(syndicationFeedPeer::OWNER_EMAIL)) $criteria->add(syndicationFeedPeer::OWNER_EMAIL, $this->owner_email);
		if ($this->isColumnModified(syndicationFeedPeer::FEED_IMAGE_URL)) $criteria->add(syndicationFeedPeer::FEED_IMAGE_URL, $this->feed_image_url);
		if ($this->isColumnModified(syndicationFeedPeer::FEED_AUTHOR)) $criteria->add(syndicationFeedPeer::FEED_AUTHOR, $this->feed_author);
		if ($this->isColumnModified(syndicationFeedPeer::CREATED_AT)) $criteria->add(syndicationFeedPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(syndicationFeedPeer::DATABASE_NAME);

		$criteria->add(syndicationFeedPeer::ID, $this->id);

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

		$copyObj->setIntId($this->int_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setPlaylistId($this->playlist_id);

		$copyObj->setName($this->name);

		$copyObj->setStatus($this->status);

		$copyObj->setType($this->type);

		$copyObj->setLandingPage($this->landing_page);

		$copyObj->setFlavorParamId($this->flavor_param_id);

		$copyObj->setPlayerUiconfId($this->player_uiconf_id);

		$copyObj->setAllowEmbed($this->allow_embed);

		$copyObj->setAdultContent($this->adult_content);

		$copyObj->setTranscodeExistingContent($this->transcode_existing_content);

		$copyObj->setAddToDefaultConversionProfile($this->add_to_default_conversion_profile);

		$copyObj->setCategories($this->categories);

		$copyObj->setFeedDescription($this->feed_description);

		$copyObj->setLanguage($this->language);

		$copyObj->setFeedLandingPage($this->feed_landing_page);

		$copyObj->setOwnerName($this->owner_name);

		$copyObj->setOwnerEmail($this->owner_email);

		$copyObj->setFeedImageUrl($this->feed_image_url);

		$copyObj->setFeedAuthor($this->feed_author);

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
			self::$peer = new syndicationFeedPeer();
		}
		return self::$peer;
	}

} 