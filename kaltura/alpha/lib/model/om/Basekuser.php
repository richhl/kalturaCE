<?php


abstract class Basekuser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $screen_name;


	
	protected $full_name;


	
	protected $email;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $date_of_birth;


	
	protected $country;


	
	protected $state;


	
	protected $city;


	
	protected $zip;


	
	protected $url_list;


	
	protected $picture;


	
	protected $icon;


	
	protected $about_me;


	
	protected $tags;


	
	protected $tagline;


	
	protected $network_highschool;


	
	protected $network_college;


	
	protected $network_other;


	
	protected $mobile_num;


	
	protected $mature_content;


	
	protected $gender;


	
	protected $registration_ip;


	
	protected $registration_cookie;


	
	protected $im_list;


	
	protected $views = 0;


	
	protected $fans = 0;


	
	protected $entries = 0;


	
	protected $storage_size = 0;


	
	protected $produced_kshows = 0;


	
	protected $status;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partner_id = 0;


	
	protected $display_in_search;


	
	protected $search_text;


	
	protected $partner_data;


	
	protected $puser_id;


	
	protected $admin_tags;


	
	protected $indexed_partner_data_int;


	
	protected $indexed_partner_data_string;

	
	protected $collkshows;

	
	protected $lastkshowCriteria = null;

	
	protected $collentrys;

	
	protected $lastentryCriteria = null;

	
	protected $collcomments;

	
	protected $lastcommentCriteria = null;

	
	protected $collflags;

	
	protected $lastflagCriteria = null;

	
	protected $collalerts;

	
	protected $lastalertCriteria = null;

	
	protected $collfavorites;

	
	protected $lastfavoriteCriteria = null;

	
	protected $collKshowKusers;

	
	protected $lastKshowKuserCriteria = null;

	
	protected $collMailJobs;

	
	protected $lastMailJobCriteria = null;

	
	protected $collPuserKusers;

	
	protected $lastPuserKuserCriteria = null;

	
	protected $collPartners;

	
	protected $lastPartnerCriteria = null;

	
	protected $collEmailCampaigns;

	
	protected $lastEmailCampaignCriteria = null;

	
	protected $collmoderations;

	
	protected $lastmoderationCriteria = null;

	
	protected $collmoderationFlagsRelatedByKuserId;

	
	protected $lastmoderationFlagRelatedByKuserIdCriteria = null;

	
	protected $collmoderationFlagsRelatedByFlaggedKuserId;

	
	protected $lastmoderationFlagRelatedByFlaggedKuserIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getScreenName()
	{

		return $this->screen_name;
	}

	
	public function getFullName()
	{

		return $this->full_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getDateOfBirth()
	{

		return $this->date_of_birth;
	}

	
	public function getCountry()
	{

		return $this->country;
	}

	
	public function getState()
	{

		return $this->state;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getZip()
	{

		return $this->zip;
	}

	
	public function getUrlList()
	{

		return $this->url_list;
	}

	
	public function getPicture()
	{

		return $this->picture;
	}

	
	public function getIcon()
	{

		return $this->icon;
	}

	
	public function getAboutMe()
	{

		return $this->about_me;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getTagline()
	{

		return $this->tagline;
	}

	
	public function getNetworkHighschool()
	{

		return $this->network_highschool;
	}

	
	public function getNetworkCollege()
	{

		return $this->network_college;
	}

	
	public function getNetworkOther()
	{

		return $this->network_other;
	}

	
	public function getMobileNum()
	{

		return $this->mobile_num;
	}

	
	public function getMatureContent()
	{

		return $this->mature_content;
	}

	
	public function getGender()
	{

		return $this->gender;
	}

	
	public function getRegistrationIp()
	{

		return $this->registration_ip;
	}

	
	public function getRegistrationCookie()
	{

		return $this->registration_cookie;
	}

	
	public function getImList()
	{

		return $this->im_list;
	}

	
	public function getViews()
	{

		return $this->views;
	}

	
	public function getFans()
	{

		return $this->fans;
	}

	
	public function getEntries()
	{

		return $this->entries;
	}

	
	public function getStorageSize()
	{

		return $this->storage_size;
	}

	
	public function getProducedKshows()
	{

		return $this->produced_kshows;
	}

	
	public function getStatus()
	{

		return $this->status;
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

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getDisplayInSearch()
	{

		return $this->display_in_search;
	}

	
	public function getSearchText()
	{

		return $this->search_text;
	}

	
	public function getPartnerData()
	{

		return $this->partner_data;
	}

	
	public function getPuserId()
	{

		return $this->puser_id;
	}

	
	public function getAdminTags()
	{

		return $this->admin_tags;
	}

	
	public function getIndexedPartnerDataInt()
	{

		return $this->indexed_partner_data_int;
	}

	
	public function getIndexedPartnerDataString()
	{

		return $this->indexed_partner_data_string;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = kuserPeer::ID;
		}

	} 
	
	public function setScreenName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->screen_name !== $v) {
			$this->screen_name = $v;
			$this->modifiedColumns[] = kuserPeer::SCREEN_NAME;
		}

	} 
	
	public function setFullName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->full_name !== $v) {
			$this->full_name = $v;
			$this->modifiedColumns[] = kuserPeer::FULL_NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = kuserPeer::EMAIL;
		}

	} 
	
	public function setSha1Password($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = kuserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = kuserPeer::SALT;
		}

	} 
	
	public function setDateOfBirth($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date_of_birth !== $v) {
			$this->date_of_birth = $v;
			$this->modifiedColumns[] = kuserPeer::DATE_OF_BIRTH;
		}

	} 
	
	public function setCountry($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = kuserPeer::COUNTRY;
		}

	} 
	
	public function setState($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = kuserPeer::STATE;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = kuserPeer::CITY;
		}

	} 
	
	public function setZip($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->zip !== $v) {
			$this->zip = $v;
			$this->modifiedColumns[] = kuserPeer::ZIP;
		}

	} 
	
	public function setUrlList($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url_list !== $v) {
			$this->url_list = $v;
			$this->modifiedColumns[] = kuserPeer::URL_LIST;
		}

	} 
	
	public function setPicture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->picture !== $v) {
			$this->picture = $v;
			$this->modifiedColumns[] = kuserPeer::PICTURE;
		}

	} 
	
	public function setIcon($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->icon !== $v) {
			$this->icon = $v;
			$this->modifiedColumns[] = kuserPeer::ICON;
		}

	} 
	
	public function setAboutMe($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->about_me !== $v) {
			$this->about_me = $v;
			$this->modifiedColumns[] = kuserPeer::ABOUT_ME;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = kuserPeer::TAGS;
		}

	} 
	
	public function setTagline($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tagline !== $v) {
			$this->tagline = $v;
			$this->modifiedColumns[] = kuserPeer::TAGLINE;
		}

	} 
	
	public function setNetworkHighschool($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->network_highschool !== $v) {
			$this->network_highschool = $v;
			$this->modifiedColumns[] = kuserPeer::NETWORK_HIGHSCHOOL;
		}

	} 
	
	public function setNetworkCollege($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->network_college !== $v) {
			$this->network_college = $v;
			$this->modifiedColumns[] = kuserPeer::NETWORK_COLLEGE;
		}

	} 
	
	public function setNetworkOther($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->network_other !== $v) {
			$this->network_other = $v;
			$this->modifiedColumns[] = kuserPeer::NETWORK_OTHER;
		}

	} 
	
	public function setMobileNum($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mobile_num !== $v) {
			$this->mobile_num = $v;
			$this->modifiedColumns[] = kuserPeer::MOBILE_NUM;
		}

	} 
	
	public function setMatureContent($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mature_content !== $v) {
			$this->mature_content = $v;
			$this->modifiedColumns[] = kuserPeer::MATURE_CONTENT;
		}

	} 
	
	public function setGender($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = kuserPeer::GENDER;
		}

	} 
	
	public function setRegistrationIp($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->registration_ip !== $v) {
			$this->registration_ip = $v;
			$this->modifiedColumns[] = kuserPeer::REGISTRATION_IP;
		}

	} 
	
	public function setRegistrationCookie($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->registration_cookie !== $v) {
			$this->registration_cookie = $v;
			$this->modifiedColumns[] = kuserPeer::REGISTRATION_COOKIE;
		}

	} 
	
	public function setImList($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->im_list !== $v) {
			$this->im_list = $v;
			$this->modifiedColumns[] = kuserPeer::IM_LIST;
		}

	} 
	
	public function setViews($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->views !== $v || $v === 0) {
			$this->views = $v;
			$this->modifiedColumns[] = kuserPeer::VIEWS;
		}

	} 
	
	public function setFans($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fans !== $v || $v === 0) {
			$this->fans = $v;
			$this->modifiedColumns[] = kuserPeer::FANS;
		}

	} 
	
	public function setEntries($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entries !== $v || $v === 0) {
			$this->entries = $v;
			$this->modifiedColumns[] = kuserPeer::ENTRIES;
		}

	} 
	
	public function setStorageSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->storage_size !== $v || $v === 0) {
			$this->storage_size = $v;
			$this->modifiedColumns[] = kuserPeer::STORAGE_SIZE;
		}

	} 
	
	public function setProducedKshows($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->produced_kshows !== $v || $v === 0) {
			$this->produced_kshows = $v;
			$this->modifiedColumns[] = kuserPeer::PRODUCED_KSHOWS;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = kuserPeer::STATUS;
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
			$this->modifiedColumns[] = kuserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = kuserPeer::UPDATED_AT;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = kuserPeer::PARTNER_ID;
		}

	} 
	
	public function setDisplayInSearch($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_in_search !== $v) {
			$this->display_in_search = $v;
			$this->modifiedColumns[] = kuserPeer::DISPLAY_IN_SEARCH;
		}

	} 
	
	public function setSearchText($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->search_text !== $v) {
			$this->search_text = $v;
			$this->modifiedColumns[] = kuserPeer::SEARCH_TEXT;
		}

	} 
	
	public function setPartnerData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_data !== $v) {
			$this->partner_data = $v;
			$this->modifiedColumns[] = kuserPeer::PARTNER_DATA;
		}

	} 
	
	public function setPuserId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->puser_id !== $v) {
			$this->puser_id = $v;
			$this->modifiedColumns[] = kuserPeer::PUSER_ID;
		}

	} 
	
	public function setAdminTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->admin_tags !== $v) {
			$this->admin_tags = $v;
			$this->modifiedColumns[] = kuserPeer::ADMIN_TAGS;
		}

	} 
	
	public function setIndexedPartnerDataInt($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->indexed_partner_data_int !== $v) {
			$this->indexed_partner_data_int = $v;
			$this->modifiedColumns[] = kuserPeer::INDEXED_PARTNER_DATA_INT;
		}

	} 
	
	public function setIndexedPartnerDataString($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->indexed_partner_data_string !== $v) {
			$this->indexed_partner_data_string = $v;
			$this->modifiedColumns[] = kuserPeer::INDEXED_PARTNER_DATA_STRING;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->screen_name = $rs->getString($startcol + 1);

			$this->full_name = $rs->getString($startcol + 2);

			$this->email = $rs->getString($startcol + 3);

			$this->sha1_password = $rs->getString($startcol + 4);

			$this->salt = $rs->getString($startcol + 5);

			$this->date_of_birth = $rs->getString($startcol + 6);

			$this->country = $rs->getString($startcol + 7);

			$this->state = $rs->getString($startcol + 8);

			$this->city = $rs->getString($startcol + 9);

			$this->zip = $rs->getString($startcol + 10);

			$this->url_list = $rs->getString($startcol + 11);

			$this->picture = $rs->getString($startcol + 12);

			$this->icon = $rs->getInt($startcol + 13);

			$this->about_me = $rs->getString($startcol + 14);

			$this->tags = $rs->getString($startcol + 15);

			$this->tagline = $rs->getString($startcol + 16);

			$this->network_highschool = $rs->getString($startcol + 17);

			$this->network_college = $rs->getString($startcol + 18);

			$this->network_other = $rs->getString($startcol + 19);

			$this->mobile_num = $rs->getString($startcol + 20);

			$this->mature_content = $rs->getInt($startcol + 21);

			$this->gender = $rs->getInt($startcol + 22);

			$this->registration_ip = $rs->getInt($startcol + 23);

			$this->registration_cookie = $rs->getString($startcol + 24);

			$this->im_list = $rs->getString($startcol + 25);

			$this->views = $rs->getInt($startcol + 26);

			$this->fans = $rs->getInt($startcol + 27);

			$this->entries = $rs->getInt($startcol + 28);

			$this->storage_size = $rs->getInt($startcol + 29);

			$this->produced_kshows = $rs->getInt($startcol + 30);

			$this->status = $rs->getInt($startcol + 31);

			$this->created_at = $rs->getTimestamp($startcol + 32, null);

			$this->updated_at = $rs->getTimestamp($startcol + 33, null);

			$this->partner_id = $rs->getInt($startcol + 34);

			$this->display_in_search = $rs->getInt($startcol + 35);

			$this->search_text = $rs->getString($startcol + 36);

			$this->partner_data = $rs->getString($startcol + 37);

			$this->puser_id = $rs->getString($startcol + 38);

			$this->admin_tags = $rs->getString($startcol + 39);

			$this->indexed_partner_data_int = $rs->getInt($startcol + 40);

			$this->indexed_partner_data_string = $rs->getString($startcol + 41);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 42; 
		} catch (Exception $e) {
			throw new PropelException("Error populating kuser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kuserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			kuserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(kuserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(kuserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kuserPeer::DATABASE_NAME);
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
					$pk = kuserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += kuserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collkshows !== null) {
				foreach($this->collkshows as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collentrys !== null) {
				foreach($this->collentrys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collcomments !== null) {
				foreach($this->collcomments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collflags !== null) {
				foreach($this->collflags as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collalerts !== null) {
				foreach($this->collalerts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collfavorites !== null) {
				foreach($this->collfavorites as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collKshowKusers !== null) {
				foreach($this->collKshowKusers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMailJobs !== null) {
				foreach($this->collMailJobs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPuserKusers !== null) {
				foreach($this->collPuserKusers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPartners !== null) {
				foreach($this->collPartners as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEmailCampaigns !== null) {
				foreach($this->collEmailCampaigns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collmoderations !== null) {
				foreach($this->collmoderations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collmoderationFlagsRelatedByKuserId !== null) {
				foreach($this->collmoderationFlagsRelatedByKuserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collmoderationFlagsRelatedByFlaggedKuserId !== null) {
				foreach($this->collmoderationFlagsRelatedByFlaggedKuserId as $referrerFK) {
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


			if (($retval = kuserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collkshows !== null) {
					foreach($this->collkshows as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collentrys !== null) {
					foreach($this->collentrys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collcomments !== null) {
					foreach($this->collcomments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collflags !== null) {
					foreach($this->collflags as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collalerts !== null) {
					foreach($this->collalerts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collfavorites !== null) {
					foreach($this->collfavorites as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collKshowKusers !== null) {
					foreach($this->collKshowKusers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMailJobs !== null) {
					foreach($this->collMailJobs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPuserKusers !== null) {
					foreach($this->collPuserKusers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPartners !== null) {
					foreach($this->collPartners as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEmailCampaigns !== null) {
					foreach($this->collEmailCampaigns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collmoderations !== null) {
					foreach($this->collmoderations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collmoderationFlagsRelatedByKuserId !== null) {
					foreach($this->collmoderationFlagsRelatedByKuserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collmoderationFlagsRelatedByFlaggedKuserId !== null) {
					foreach($this->collmoderationFlagsRelatedByFlaggedKuserId as $referrerFK) {
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
		$pos = kuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getScreenName();
				break;
			case 2:
				return $this->getFullName();
				break;
			case 3:
				return $this->getEmail();
				break;
			case 4:
				return $this->getSha1Password();
				break;
			case 5:
				return $this->getSalt();
				break;
			case 6:
				return $this->getDateOfBirth();
				break;
			case 7:
				return $this->getCountry();
				break;
			case 8:
				return $this->getState();
				break;
			case 9:
				return $this->getCity();
				break;
			case 10:
				return $this->getZip();
				break;
			case 11:
				return $this->getUrlList();
				break;
			case 12:
				return $this->getPicture();
				break;
			case 13:
				return $this->getIcon();
				break;
			case 14:
				return $this->getAboutMe();
				break;
			case 15:
				return $this->getTags();
				break;
			case 16:
				return $this->getTagline();
				break;
			case 17:
				return $this->getNetworkHighschool();
				break;
			case 18:
				return $this->getNetworkCollege();
				break;
			case 19:
				return $this->getNetworkOther();
				break;
			case 20:
				return $this->getMobileNum();
				break;
			case 21:
				return $this->getMatureContent();
				break;
			case 22:
				return $this->getGender();
				break;
			case 23:
				return $this->getRegistrationIp();
				break;
			case 24:
				return $this->getRegistrationCookie();
				break;
			case 25:
				return $this->getImList();
				break;
			case 26:
				return $this->getViews();
				break;
			case 27:
				return $this->getFans();
				break;
			case 28:
				return $this->getEntries();
				break;
			case 29:
				return $this->getStorageSize();
				break;
			case 30:
				return $this->getProducedKshows();
				break;
			case 31:
				return $this->getStatus();
				break;
			case 32:
				return $this->getCreatedAt();
				break;
			case 33:
				return $this->getUpdatedAt();
				break;
			case 34:
				return $this->getPartnerId();
				break;
			case 35:
				return $this->getDisplayInSearch();
				break;
			case 36:
				return $this->getSearchText();
				break;
			case 37:
				return $this->getPartnerData();
				break;
			case 38:
				return $this->getPuserId();
				break;
			case 39:
				return $this->getAdminTags();
				break;
			case 40:
				return $this->getIndexedPartnerDataInt();
				break;
			case 41:
				return $this->getIndexedPartnerDataString();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kuserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getScreenName(),
			$keys[2] => $this->getFullName(),
			$keys[3] => $this->getEmail(),
			$keys[4] => $this->getSha1Password(),
			$keys[5] => $this->getSalt(),
			$keys[6] => $this->getDateOfBirth(),
			$keys[7] => $this->getCountry(),
			$keys[8] => $this->getState(),
			$keys[9] => $this->getCity(),
			$keys[10] => $this->getZip(),
			$keys[11] => $this->getUrlList(),
			$keys[12] => $this->getPicture(),
			$keys[13] => $this->getIcon(),
			$keys[14] => $this->getAboutMe(),
			$keys[15] => $this->getTags(),
			$keys[16] => $this->getTagline(),
			$keys[17] => $this->getNetworkHighschool(),
			$keys[18] => $this->getNetworkCollege(),
			$keys[19] => $this->getNetworkOther(),
			$keys[20] => $this->getMobileNum(),
			$keys[21] => $this->getMatureContent(),
			$keys[22] => $this->getGender(),
			$keys[23] => $this->getRegistrationIp(),
			$keys[24] => $this->getRegistrationCookie(),
			$keys[25] => $this->getImList(),
			$keys[26] => $this->getViews(),
			$keys[27] => $this->getFans(),
			$keys[28] => $this->getEntries(),
			$keys[29] => $this->getStorageSize(),
			$keys[30] => $this->getProducedKshows(),
			$keys[31] => $this->getStatus(),
			$keys[32] => $this->getCreatedAt(),
			$keys[33] => $this->getUpdatedAt(),
			$keys[34] => $this->getPartnerId(),
			$keys[35] => $this->getDisplayInSearch(),
			$keys[36] => $this->getSearchText(),
			$keys[37] => $this->getPartnerData(),
			$keys[38] => $this->getPuserId(),
			$keys[39] => $this->getAdminTags(),
			$keys[40] => $this->getIndexedPartnerDataInt(),
			$keys[41] => $this->getIndexedPartnerDataString(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = kuserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setScreenName($value);
				break;
			case 2:
				$this->setFullName($value);
				break;
			case 3:
				$this->setEmail($value);
				break;
			case 4:
				$this->setSha1Password($value);
				break;
			case 5:
				$this->setSalt($value);
				break;
			case 6:
				$this->setDateOfBirth($value);
				break;
			case 7:
				$this->setCountry($value);
				break;
			case 8:
				$this->setState($value);
				break;
			case 9:
				$this->setCity($value);
				break;
			case 10:
				$this->setZip($value);
				break;
			case 11:
				$this->setUrlList($value);
				break;
			case 12:
				$this->setPicture($value);
				break;
			case 13:
				$this->setIcon($value);
				break;
			case 14:
				$this->setAboutMe($value);
				break;
			case 15:
				$this->setTags($value);
				break;
			case 16:
				$this->setTagline($value);
				break;
			case 17:
				$this->setNetworkHighschool($value);
				break;
			case 18:
				$this->setNetworkCollege($value);
				break;
			case 19:
				$this->setNetworkOther($value);
				break;
			case 20:
				$this->setMobileNum($value);
				break;
			case 21:
				$this->setMatureContent($value);
				break;
			case 22:
				$this->setGender($value);
				break;
			case 23:
				$this->setRegistrationIp($value);
				break;
			case 24:
				$this->setRegistrationCookie($value);
				break;
			case 25:
				$this->setImList($value);
				break;
			case 26:
				$this->setViews($value);
				break;
			case 27:
				$this->setFans($value);
				break;
			case 28:
				$this->setEntries($value);
				break;
			case 29:
				$this->setStorageSize($value);
				break;
			case 30:
				$this->setProducedKshows($value);
				break;
			case 31:
				$this->setStatus($value);
				break;
			case 32:
				$this->setCreatedAt($value);
				break;
			case 33:
				$this->setUpdatedAt($value);
				break;
			case 34:
				$this->setPartnerId($value);
				break;
			case 35:
				$this->setDisplayInSearch($value);
				break;
			case 36:
				$this->setSearchText($value);
				break;
			case 37:
				$this->setPartnerData($value);
				break;
			case 38:
				$this->setPuserId($value);
				break;
			case 39:
				$this->setAdminTags($value);
				break;
			case 40:
				$this->setIndexedPartnerDataInt($value);
				break;
			case 41:
				$this->setIndexedPartnerDataString($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kuserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setScreenName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFullName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSha1Password($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSalt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDateOfBirth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCountry($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setState($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCity($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setZip($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUrlList($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPicture($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIcon($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setAboutMe($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setTags($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setTagline($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setNetworkHighschool($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setNetworkCollege($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setNetworkOther($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setMobileNum($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setMatureContent($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setGender($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setRegistrationIp($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setRegistrationCookie($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setImList($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setViews($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setFans($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setEntries($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setStorageSize($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setProducedKshows($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setStatus($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCreatedAt($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setUpdatedAt($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setPartnerId($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setDisplayInSearch($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setSearchText($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setPartnerData($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setPuserId($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setAdminTags($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setIndexedPartnerDataInt($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setIndexedPartnerDataString($arr[$keys[41]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(kuserPeer::DATABASE_NAME);

		if ($this->isColumnModified(kuserPeer::ID)) $criteria->add(kuserPeer::ID, $this->id);
		if ($this->isColumnModified(kuserPeer::SCREEN_NAME)) $criteria->add(kuserPeer::SCREEN_NAME, $this->screen_name);
		if ($this->isColumnModified(kuserPeer::FULL_NAME)) $criteria->add(kuserPeer::FULL_NAME, $this->full_name);
		if ($this->isColumnModified(kuserPeer::EMAIL)) $criteria->add(kuserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(kuserPeer::SHA1_PASSWORD)) $criteria->add(kuserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(kuserPeer::SALT)) $criteria->add(kuserPeer::SALT, $this->salt);
		if ($this->isColumnModified(kuserPeer::DATE_OF_BIRTH)) $criteria->add(kuserPeer::DATE_OF_BIRTH, $this->date_of_birth);
		if ($this->isColumnModified(kuserPeer::COUNTRY)) $criteria->add(kuserPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(kuserPeer::STATE)) $criteria->add(kuserPeer::STATE, $this->state);
		if ($this->isColumnModified(kuserPeer::CITY)) $criteria->add(kuserPeer::CITY, $this->city);
		if ($this->isColumnModified(kuserPeer::ZIP)) $criteria->add(kuserPeer::ZIP, $this->zip);
		if ($this->isColumnModified(kuserPeer::URL_LIST)) $criteria->add(kuserPeer::URL_LIST, $this->url_list);
		if ($this->isColumnModified(kuserPeer::PICTURE)) $criteria->add(kuserPeer::PICTURE, $this->picture);
		if ($this->isColumnModified(kuserPeer::ICON)) $criteria->add(kuserPeer::ICON, $this->icon);
		if ($this->isColumnModified(kuserPeer::ABOUT_ME)) $criteria->add(kuserPeer::ABOUT_ME, $this->about_me);
		if ($this->isColumnModified(kuserPeer::TAGS)) $criteria->add(kuserPeer::TAGS, $this->tags);
		if ($this->isColumnModified(kuserPeer::TAGLINE)) $criteria->add(kuserPeer::TAGLINE, $this->tagline);
		if ($this->isColumnModified(kuserPeer::NETWORK_HIGHSCHOOL)) $criteria->add(kuserPeer::NETWORK_HIGHSCHOOL, $this->network_highschool);
		if ($this->isColumnModified(kuserPeer::NETWORK_COLLEGE)) $criteria->add(kuserPeer::NETWORK_COLLEGE, $this->network_college);
		if ($this->isColumnModified(kuserPeer::NETWORK_OTHER)) $criteria->add(kuserPeer::NETWORK_OTHER, $this->network_other);
		if ($this->isColumnModified(kuserPeer::MOBILE_NUM)) $criteria->add(kuserPeer::MOBILE_NUM, $this->mobile_num);
		if ($this->isColumnModified(kuserPeer::MATURE_CONTENT)) $criteria->add(kuserPeer::MATURE_CONTENT, $this->mature_content);
		if ($this->isColumnModified(kuserPeer::GENDER)) $criteria->add(kuserPeer::GENDER, $this->gender);
		if ($this->isColumnModified(kuserPeer::REGISTRATION_IP)) $criteria->add(kuserPeer::REGISTRATION_IP, $this->registration_ip);
		if ($this->isColumnModified(kuserPeer::REGISTRATION_COOKIE)) $criteria->add(kuserPeer::REGISTRATION_COOKIE, $this->registration_cookie);
		if ($this->isColumnModified(kuserPeer::IM_LIST)) $criteria->add(kuserPeer::IM_LIST, $this->im_list);
		if ($this->isColumnModified(kuserPeer::VIEWS)) $criteria->add(kuserPeer::VIEWS, $this->views);
		if ($this->isColumnModified(kuserPeer::FANS)) $criteria->add(kuserPeer::FANS, $this->fans);
		if ($this->isColumnModified(kuserPeer::ENTRIES)) $criteria->add(kuserPeer::ENTRIES, $this->entries);
		if ($this->isColumnModified(kuserPeer::STORAGE_SIZE)) $criteria->add(kuserPeer::STORAGE_SIZE, $this->storage_size);
		if ($this->isColumnModified(kuserPeer::PRODUCED_KSHOWS)) $criteria->add(kuserPeer::PRODUCED_KSHOWS, $this->produced_kshows);
		if ($this->isColumnModified(kuserPeer::STATUS)) $criteria->add(kuserPeer::STATUS, $this->status);
		if ($this->isColumnModified(kuserPeer::CREATED_AT)) $criteria->add(kuserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(kuserPeer::UPDATED_AT)) $criteria->add(kuserPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(kuserPeer::PARTNER_ID)) $criteria->add(kuserPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(kuserPeer::DISPLAY_IN_SEARCH)) $criteria->add(kuserPeer::DISPLAY_IN_SEARCH, $this->display_in_search);
		if ($this->isColumnModified(kuserPeer::SEARCH_TEXT)) $criteria->add(kuserPeer::SEARCH_TEXT, $this->search_text);
		if ($this->isColumnModified(kuserPeer::PARTNER_DATA)) $criteria->add(kuserPeer::PARTNER_DATA, $this->partner_data);
		if ($this->isColumnModified(kuserPeer::PUSER_ID)) $criteria->add(kuserPeer::PUSER_ID, $this->puser_id);
		if ($this->isColumnModified(kuserPeer::ADMIN_TAGS)) $criteria->add(kuserPeer::ADMIN_TAGS, $this->admin_tags);
		if ($this->isColumnModified(kuserPeer::INDEXED_PARTNER_DATA_INT)) $criteria->add(kuserPeer::INDEXED_PARTNER_DATA_INT, $this->indexed_partner_data_int);
		if ($this->isColumnModified(kuserPeer::INDEXED_PARTNER_DATA_STRING)) $criteria->add(kuserPeer::INDEXED_PARTNER_DATA_STRING, $this->indexed_partner_data_string);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(kuserPeer::DATABASE_NAME);

		$criteria->add(kuserPeer::ID, $this->id);

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

		$copyObj->setScreenName($this->screen_name);

		$copyObj->setFullName($this->full_name);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setDateOfBirth($this->date_of_birth);

		$copyObj->setCountry($this->country);

		$copyObj->setState($this->state);

		$copyObj->setCity($this->city);

		$copyObj->setZip($this->zip);

		$copyObj->setUrlList($this->url_list);

		$copyObj->setPicture($this->picture);

		$copyObj->setIcon($this->icon);

		$copyObj->setAboutMe($this->about_me);

		$copyObj->setTags($this->tags);

		$copyObj->setTagline($this->tagline);

		$copyObj->setNetworkHighschool($this->network_highschool);

		$copyObj->setNetworkCollege($this->network_college);

		$copyObj->setNetworkOther($this->network_other);

		$copyObj->setMobileNum($this->mobile_num);

		$copyObj->setMatureContent($this->mature_content);

		$copyObj->setGender($this->gender);

		$copyObj->setRegistrationIp($this->registration_ip);

		$copyObj->setRegistrationCookie($this->registration_cookie);

		$copyObj->setImList($this->im_list);

		$copyObj->setViews($this->views);

		$copyObj->setFans($this->fans);

		$copyObj->setEntries($this->entries);

		$copyObj->setStorageSize($this->storage_size);

		$copyObj->setProducedKshows($this->produced_kshows);

		$copyObj->setStatus($this->status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setDisplayInSearch($this->display_in_search);

		$copyObj->setSearchText($this->search_text);

		$copyObj->setPartnerData($this->partner_data);

		$copyObj->setPuserId($this->puser_id);

		$copyObj->setAdminTags($this->admin_tags);

		$copyObj->setIndexedPartnerDataInt($this->indexed_partner_data_int);

		$copyObj->setIndexedPartnerDataString($this->indexed_partner_data_string);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getkshows() as $relObj) {
				$copyObj->addkshow($relObj->copy($deepCopy));
			}

			foreach($this->getentrys() as $relObj) {
				$copyObj->addentry($relObj->copy($deepCopy));
			}

			foreach($this->getcomments() as $relObj) {
				$copyObj->addcomment($relObj->copy($deepCopy));
			}

			foreach($this->getflags() as $relObj) {
				$copyObj->addflag($relObj->copy($deepCopy));
			}

			foreach($this->getalerts() as $relObj) {
				$copyObj->addalert($relObj->copy($deepCopy));
			}

			foreach($this->getfavorites() as $relObj) {
				$copyObj->addfavorite($relObj->copy($deepCopy));
			}

			foreach($this->getKshowKusers() as $relObj) {
				$copyObj->addKshowKuser($relObj->copy($deepCopy));
			}

			foreach($this->getMailJobs() as $relObj) {
				$copyObj->addMailJob($relObj->copy($deepCopy));
			}

			foreach($this->getPuserKusers() as $relObj) {
				$copyObj->addPuserKuser($relObj->copy($deepCopy));
			}

			foreach($this->getPartners() as $relObj) {
				$copyObj->addPartner($relObj->copy($deepCopy));
			}

			foreach($this->getEmailCampaigns() as $relObj) {
				$copyObj->addEmailCampaign($relObj->copy($deepCopy));
			}

			foreach($this->getmoderations() as $relObj) {
				$copyObj->addmoderation($relObj->copy($deepCopy));
			}

			foreach($this->getmoderationFlagsRelatedByKuserId() as $relObj) {
				$copyObj->addmoderationFlagRelatedByKuserId($relObj->copy($deepCopy));
			}

			foreach($this->getmoderationFlagsRelatedByFlaggedKuserId() as $relObj) {
				$copyObj->addmoderationFlagRelatedByFlaggedKuserId($relObj->copy($deepCopy));
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
			self::$peer = new kuserPeer();
		}
		return self::$peer;
	}

	
	public function initkshows()
	{
		if ($this->collkshows === null) {
			$this->collkshows = array();
		}
	}

	
	public function getkshows($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkshows === null) {
			if ($this->isNew()) {
			   $this->collkshows = array();
			} else {

				$criteria->add(kshowPeer::PRODUCER_ID, $this->getId());

				kshowPeer::addSelectColumns($criteria);
				$this->collkshows = kshowPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(kshowPeer::PRODUCER_ID, $this->getId());

				kshowPeer::addSelectColumns($criteria);
				if (!isset($this->lastkshowCriteria) || !$this->lastkshowCriteria->equals($criteria)) {
					$this->collkshows = kshowPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastkshowCriteria = $criteria;
		return $this->collkshows;
	}

	
	public function countkshows($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(kshowPeer::PRODUCER_ID, $this->getId());

		return kshowPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addkshow(kshow $l)
	{
		$this->collkshows[] = $l;
		$l->setkuser($this);
	}

	
	public function initentrys()
	{
		if ($this->collentrys === null) {
			$this->collentrys = array();
		}
	}

	
	public function getentrys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
			   $this->collentrys = array();
			} else {

				$criteria->add(entryPeer::KUSER_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				$this->collentrys = entryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(entryPeer::KUSER_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
					$this->collentrys = entryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastentryCriteria = $criteria;
		return $this->collentrys;
	}

	
	public function countentrys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(entryPeer::KUSER_ID, $this->getId());

		return entryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addentry(entry $l)
	{
		$this->collentrys[] = $l;
		$l->setkuser($this);
	}


	
	public function getentrysJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseentryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collentrys === null) {
			if ($this->isNew()) {
				$this->collentrys = array();
			} else {

				$criteria->add(entryPeer::KUSER_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::KUSER_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}

	
	public function initcomments()
	{
		if ($this->collcomments === null) {
			$this->collcomments = array();
		}
	}

	
	public function getcomments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasecommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collcomments === null) {
			if ($this->isNew()) {
			   $this->collcomments = array();
			} else {

				$criteria->add(commentPeer::KUSER_ID, $this->getId());

				commentPeer::addSelectColumns($criteria);
				$this->collcomments = commentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(commentPeer::KUSER_ID, $this->getId());

				commentPeer::addSelectColumns($criteria);
				if (!isset($this->lastcommentCriteria) || !$this->lastcommentCriteria->equals($criteria)) {
					$this->collcomments = commentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastcommentCriteria = $criteria;
		return $this->collcomments;
	}

	
	public function countcomments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasecommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(commentPeer::KUSER_ID, $this->getId());

		return commentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addcomment(comment $l)
	{
		$this->collcomments[] = $l;
		$l->setkuser($this);
	}

	
	public function initflags()
	{
		if ($this->collflags === null) {
			$this->collflags = array();
		}
	}

	
	public function getflags($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseflagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collflags === null) {
			if ($this->isNew()) {
			   $this->collflags = array();
			} else {

				$criteria->add(flagPeer::KUSER_ID, $this->getId());

				flagPeer::addSelectColumns($criteria);
				$this->collflags = flagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(flagPeer::KUSER_ID, $this->getId());

				flagPeer::addSelectColumns($criteria);
				if (!isset($this->lastflagCriteria) || !$this->lastflagCriteria->equals($criteria)) {
					$this->collflags = flagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastflagCriteria = $criteria;
		return $this->collflags;
	}

	
	public function countflags($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseflagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(flagPeer::KUSER_ID, $this->getId());

		return flagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addflag(flag $l)
	{
		$this->collflags[] = $l;
		$l->setkuser($this);
	}

	
	public function initalerts()
	{
		if ($this->collalerts === null) {
			$this->collalerts = array();
		}
	}

	
	public function getalerts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasealertPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collalerts === null) {
			if ($this->isNew()) {
			   $this->collalerts = array();
			} else {

				$criteria->add(alertPeer::KUSER_ID, $this->getId());

				alertPeer::addSelectColumns($criteria);
				$this->collalerts = alertPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(alertPeer::KUSER_ID, $this->getId());

				alertPeer::addSelectColumns($criteria);
				if (!isset($this->lastalertCriteria) || !$this->lastalertCriteria->equals($criteria)) {
					$this->collalerts = alertPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastalertCriteria = $criteria;
		return $this->collalerts;
	}

	
	public function countalerts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasealertPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(alertPeer::KUSER_ID, $this->getId());

		return alertPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addalert(alert $l)
	{
		$this->collalerts[] = $l;
		$l->setkuser($this);
	}

	
	public function initfavorites()
	{
		if ($this->collfavorites === null) {
			$this->collfavorites = array();
		}
	}

	
	public function getfavorites($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasefavoritePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collfavorites === null) {
			if ($this->isNew()) {
			   $this->collfavorites = array();
			} else {

				$criteria->add(favoritePeer::KUSER_ID, $this->getId());

				favoritePeer::addSelectColumns($criteria);
				$this->collfavorites = favoritePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(favoritePeer::KUSER_ID, $this->getId());

				favoritePeer::addSelectColumns($criteria);
				if (!isset($this->lastfavoriteCriteria) || !$this->lastfavoriteCriteria->equals($criteria)) {
					$this->collfavorites = favoritePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastfavoriteCriteria = $criteria;
		return $this->collfavorites;
	}

	
	public function countfavorites($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasefavoritePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(favoritePeer::KUSER_ID, $this->getId());

		return favoritePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addfavorite(favorite $l)
	{
		$this->collfavorites[] = $l;
		$l->setkuser($this);
	}

	
	public function initKshowKusers()
	{
		if ($this->collKshowKusers === null) {
			$this->collKshowKusers = array();
		}
	}

	
	public function getKshowKusers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKshowKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKshowKusers === null) {
			if ($this->isNew()) {
			   $this->collKshowKusers = array();
			} else {

				$criteria->add(KshowKuserPeer::KUSER_ID, $this->getId());

				KshowKuserPeer::addSelectColumns($criteria);
				$this->collKshowKusers = KshowKuserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KshowKuserPeer::KUSER_ID, $this->getId());

				KshowKuserPeer::addSelectColumns($criteria);
				if (!isset($this->lastKshowKuserCriteria) || !$this->lastKshowKuserCriteria->equals($criteria)) {
					$this->collKshowKusers = KshowKuserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastKshowKuserCriteria = $criteria;
		return $this->collKshowKusers;
	}

	
	public function countKshowKusers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseKshowKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(KshowKuserPeer::KUSER_ID, $this->getId());

		return KshowKuserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addKshowKuser(KshowKuser $l)
	{
		$this->collKshowKusers[] = $l;
		$l->setkuser($this);
	}


	
	public function getKshowKusersJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKshowKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKshowKusers === null) {
			if ($this->isNew()) {
				$this->collKshowKusers = array();
			} else {

				$criteria->add(KshowKuserPeer::KUSER_ID, $this->getId());

				$this->collKshowKusers = KshowKuserPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(KshowKuserPeer::KUSER_ID, $this->getId());

			if (!isset($this->lastKshowKuserCriteria) || !$this->lastKshowKuserCriteria->equals($criteria)) {
				$this->collKshowKusers = KshowKuserPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastKshowKuserCriteria = $criteria;

		return $this->collKshowKusers;
	}

	
	public function initMailJobs()
	{
		if ($this->collMailJobs === null) {
			$this->collMailJobs = array();
		}
	}

	
	public function getMailJobs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMailJobPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMailJobs === null) {
			if ($this->isNew()) {
			   $this->collMailJobs = array();
			} else {

				$criteria->add(MailJobPeer::RECIPIENT_ID, $this->getId());

				MailJobPeer::addSelectColumns($criteria);
				$this->collMailJobs = MailJobPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MailJobPeer::RECIPIENT_ID, $this->getId());

				MailJobPeer::addSelectColumns($criteria);
				if (!isset($this->lastMailJobCriteria) || !$this->lastMailJobCriteria->equals($criteria)) {
					$this->collMailJobs = MailJobPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMailJobCriteria = $criteria;
		return $this->collMailJobs;
	}

	
	public function countMailJobs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMailJobPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MailJobPeer::RECIPIENT_ID, $this->getId());

		return MailJobPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMailJob(MailJob $l)
	{
		$this->collMailJobs[] = $l;
		$l->setkuser($this);
	}

	
	public function initPuserKusers()
	{
		if ($this->collPuserKusers === null) {
			$this->collPuserKusers = array();
		}
	}

	
	public function getPuserKusers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserKusers === null) {
			if ($this->isNew()) {
			   $this->collPuserKusers = array();
			} else {

				$criteria->add(PuserKuserPeer::KUSER_ID, $this->getId());

				PuserKuserPeer::addSelectColumns($criteria);
				$this->collPuserKusers = PuserKuserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PuserKuserPeer::KUSER_ID, $this->getId());

				PuserKuserPeer::addSelectColumns($criteria);
				if (!isset($this->lastPuserKuserCriteria) || !$this->lastPuserKuserCriteria->equals($criteria)) {
					$this->collPuserKusers = PuserKuserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPuserKuserCriteria = $criteria;
		return $this->collPuserKusers;
	}

	
	public function countPuserKusers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePuserKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PuserKuserPeer::KUSER_ID, $this->getId());

		return PuserKuserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPuserKuser(PuserKuser $l)
	{
		$this->collPuserKusers[] = $l;
		$l->setkuser($this);
	}

	
	public function initPartners()
	{
		if ($this->collPartners === null) {
			$this->collPartners = array();
		}
	}

	
	public function getPartners($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePartnerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPartners === null) {
			if ($this->isNew()) {
			   $this->collPartners = array();
			} else {

				$criteria->add(PartnerPeer::ANONYMOUS_KUSER_ID, $this->getId());

				PartnerPeer::addSelectColumns($criteria);
				$this->collPartners = PartnerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PartnerPeer::ANONYMOUS_KUSER_ID, $this->getId());

				PartnerPeer::addSelectColumns($criteria);
				if (!isset($this->lastPartnerCriteria) || !$this->lastPartnerCriteria->equals($criteria)) {
					$this->collPartners = PartnerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPartnerCriteria = $criteria;
		return $this->collPartners;
	}

	
	public function countPartners($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePartnerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PartnerPeer::ANONYMOUS_KUSER_ID, $this->getId());

		return PartnerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPartner(Partner $l)
	{
		$this->collPartners[] = $l;
		$l->setkuser($this);
	}

	
	public function initEmailCampaigns()
	{
		if ($this->collEmailCampaigns === null) {
			$this->collEmailCampaigns = array();
		}
	}

	
	public function getEmailCampaigns($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailCampaignPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailCampaigns === null) {
			if ($this->isNew()) {
			   $this->collEmailCampaigns = array();
			} else {

				$criteria->add(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, $this->getId());

				EmailCampaignPeer::addSelectColumns($criteria);
				$this->collEmailCampaigns = EmailCampaignPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, $this->getId());

				EmailCampaignPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailCampaignCriteria) || !$this->lastEmailCampaignCriteria->equals($criteria)) {
					$this->collEmailCampaigns = EmailCampaignPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailCampaignCriteria = $criteria;
		return $this->collEmailCampaigns;
	}

	
	public function countEmailCampaigns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEmailCampaignPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailCampaignPeer::CAMPAIGN_MGR_KUSER_ID, $this->getId());

		return EmailCampaignPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailCampaign(EmailCampaign $l)
	{
		$this->collEmailCampaigns[] = $l;
		$l->setkuser($this);
	}

	
	public function initmoderations()
	{
		if ($this->collmoderations === null) {
			$this->collmoderations = array();
		}
	}

	
	public function getmoderations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasemoderationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmoderations === null) {
			if ($this->isNew()) {
			   $this->collmoderations = array();
			} else {

				$criteria->add(moderationPeer::KUSER_ID, $this->getId());

				moderationPeer::addSelectColumns($criteria);
				$this->collmoderations = moderationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(moderationPeer::KUSER_ID, $this->getId());

				moderationPeer::addSelectColumns($criteria);
				if (!isset($this->lastmoderationCriteria) || !$this->lastmoderationCriteria->equals($criteria)) {
					$this->collmoderations = moderationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastmoderationCriteria = $criteria;
		return $this->collmoderations;
	}

	
	public function countmoderations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasemoderationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(moderationPeer::KUSER_ID, $this->getId());

		return moderationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addmoderation(moderation $l)
	{
		$this->collmoderations[] = $l;
		$l->setkuser($this);
	}

	
	public function initmoderationFlagsRelatedByKuserId()
	{
		if ($this->collmoderationFlagsRelatedByKuserId === null) {
			$this->collmoderationFlagsRelatedByKuserId = array();
		}
	}

	
	public function getmoderationFlagsRelatedByKuserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasemoderationFlagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmoderationFlagsRelatedByKuserId === null) {
			if ($this->isNew()) {
			   $this->collmoderationFlagsRelatedByKuserId = array();
			} else {

				$criteria->add(moderationFlagPeer::KUSER_ID, $this->getId());

				moderationFlagPeer::addSelectColumns($criteria);
				$this->collmoderationFlagsRelatedByKuserId = moderationFlagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(moderationFlagPeer::KUSER_ID, $this->getId());

				moderationFlagPeer::addSelectColumns($criteria);
				if (!isset($this->lastmoderationFlagRelatedByKuserIdCriteria) || !$this->lastmoderationFlagRelatedByKuserIdCriteria->equals($criteria)) {
					$this->collmoderationFlagsRelatedByKuserId = moderationFlagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastmoderationFlagRelatedByKuserIdCriteria = $criteria;
		return $this->collmoderationFlagsRelatedByKuserId;
	}

	
	public function countmoderationFlagsRelatedByKuserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasemoderationFlagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(moderationFlagPeer::KUSER_ID, $this->getId());

		return moderationFlagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addmoderationFlagRelatedByKuserId(moderationFlag $l)
	{
		$this->collmoderationFlagsRelatedByKuserId[] = $l;
		$l->setkuserRelatedByKuserId($this);
	}


	
	public function getmoderationFlagsRelatedByKuserIdJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasemoderationFlagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmoderationFlagsRelatedByKuserId === null) {
			if ($this->isNew()) {
				$this->collmoderationFlagsRelatedByKuserId = array();
			} else {

				$criteria->add(moderationFlagPeer::KUSER_ID, $this->getId());

				$this->collmoderationFlagsRelatedByKuserId = moderationFlagPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(moderationFlagPeer::KUSER_ID, $this->getId());

			if (!isset($this->lastmoderationFlagRelatedByKuserIdCriteria) || !$this->lastmoderationFlagRelatedByKuserIdCriteria->equals($criteria)) {
				$this->collmoderationFlagsRelatedByKuserId = moderationFlagPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastmoderationFlagRelatedByKuserIdCriteria = $criteria;

		return $this->collmoderationFlagsRelatedByKuserId;
	}

	
	public function initmoderationFlagsRelatedByFlaggedKuserId()
	{
		if ($this->collmoderationFlagsRelatedByFlaggedKuserId === null) {
			$this->collmoderationFlagsRelatedByFlaggedKuserId = array();
		}
	}

	
	public function getmoderationFlagsRelatedByFlaggedKuserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasemoderationFlagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmoderationFlagsRelatedByFlaggedKuserId === null) {
			if ($this->isNew()) {
			   $this->collmoderationFlagsRelatedByFlaggedKuserId = array();
			} else {

				$criteria->add(moderationFlagPeer::FLAGGED_KUSER_ID, $this->getId());

				moderationFlagPeer::addSelectColumns($criteria);
				$this->collmoderationFlagsRelatedByFlaggedKuserId = moderationFlagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(moderationFlagPeer::FLAGGED_KUSER_ID, $this->getId());

				moderationFlagPeer::addSelectColumns($criteria);
				if (!isset($this->lastmoderationFlagRelatedByFlaggedKuserIdCriteria) || !$this->lastmoderationFlagRelatedByFlaggedKuserIdCriteria->equals($criteria)) {
					$this->collmoderationFlagsRelatedByFlaggedKuserId = moderationFlagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastmoderationFlagRelatedByFlaggedKuserIdCriteria = $criteria;
		return $this->collmoderationFlagsRelatedByFlaggedKuserId;
	}

	
	public function countmoderationFlagsRelatedByFlaggedKuserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasemoderationFlagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(moderationFlagPeer::FLAGGED_KUSER_ID, $this->getId());

		return moderationFlagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addmoderationFlagRelatedByFlaggedKuserId(moderationFlag $l)
	{
		$this->collmoderationFlagsRelatedByFlaggedKuserId[] = $l;
		$l->setkuserRelatedByFlaggedKuserId($this);
	}


	
	public function getmoderationFlagsRelatedByFlaggedKuserIdJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasemoderationFlagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmoderationFlagsRelatedByFlaggedKuserId === null) {
			if ($this->isNew()) {
				$this->collmoderationFlagsRelatedByFlaggedKuserId = array();
			} else {

				$criteria->add(moderationFlagPeer::FLAGGED_KUSER_ID, $this->getId());

				$this->collmoderationFlagsRelatedByFlaggedKuserId = moderationFlagPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(moderationFlagPeer::FLAGGED_KUSER_ID, $this->getId());

			if (!isset($this->lastmoderationFlagRelatedByFlaggedKuserIdCriteria) || !$this->lastmoderationFlagRelatedByFlaggedKuserIdCriteria->equals($criteria)) {
				$this->collmoderationFlagsRelatedByFlaggedKuserId = moderationFlagPeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastmoderationFlagRelatedByFlaggedKuserIdCriteria = $criteria;

		return $this->collmoderationFlagsRelatedByFlaggedKuserId;
	}

} 