<?php


abstract class Baseentry extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $kshow_id;


	
	protected $kuser_id;


	
	protected $name;


	
	protected $type;


	
	protected $media_type;


	
	protected $data;


	
	protected $thumbnail;


	
	protected $views = 0;


	
	protected $votes = 0;


	
	protected $comments = 0;


	
	protected $favorites = 0;


	
	protected $total_rank = 0;


	
	protected $rank = 0;


	
	protected $tags;


	
	protected $anonymous;


	
	protected $status;


	
	protected $source;


	
	protected $source_id;


	
	protected $source_link;


	
	protected $license_type;


	
	protected $credit;


	
	protected $length_in_msecs = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partner_id = 0;


	
	protected $display_in_search;


	
	protected $subp_id = 0;


	
	protected $custom_data;


	
	protected $search_text;


	
	protected $screen_name;


	
	protected $site_url;


	
	protected $permissions = 1;


	
	protected $group_id;


	
	protected $plays = 0;


	
	protected $partner_data;


	
	protected $int_id;


	
	protected $indexed_custom_data_1;


	
	protected $description;


	
	protected $media_date;


	
	protected $admin_tags;


	
	protected $moderation_status;


	
	protected $moderation_count;


	
	protected $modified_at;

	
	protected $akshow;

	
	protected $akuser;

	
	protected $collkvotes;

	
	protected $lastkvoteCriteria = null;

	
	protected $collconversions;

	
	protected $lastconversionCriteria = null;

	
	protected $collWidgetLogs;

	
	protected $lastWidgetLogCriteria = null;

	
	protected $collroughcutEntrysRelatedByRoughcutId;

	
	protected $lastroughcutEntryRelatedByRoughcutIdCriteria = null;

	
	protected $collroughcutEntrysRelatedByEntryId;

	
	protected $lastroughcutEntryRelatedByEntryIdCriteria = null;

	
	protected $collwidgets;

	
	protected $lastwidgetCriteria = null;

	
	protected $collKwidgetLogs;

	
	protected $lastKwidgetLogCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getKshowId()
	{

		return $this->kshow_id;
	}

	
	public function getKuserId()
	{

		return $this->kuser_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getMediaType()
	{

		return $this->media_type;
	}

	
	public function getData()
	{

		return $this->data;
	}

	
	public function getThumbnail()
	{

		return $this->thumbnail;
	}

	
	public function getViews()
	{

		return $this->views;
	}

	
	public function getVotes()
	{

		return $this->votes;
	}

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getFavorites()
	{

		return $this->favorites;
	}

	
	public function getTotalRank()
	{

		return $this->total_rank;
	}

	
	public function getRank()
	{

		return $this->rank;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getAnonymous()
	{

		return $this->anonymous;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getSource()
	{

		return $this->source;
	}

	
	public function getSourceId()
	{

		return $this->source_id;
	}

	
	public function getSourceLink()
	{

		return $this->source_link;
	}

	
	public function getLicenseType()
	{

		return $this->license_type;
	}

	
	public function getCredit()
	{

		return $this->credit;
	}

	
	public function getLengthInMsecs()
	{

		return $this->length_in_msecs;
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

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getSearchText()
	{

		return $this->search_text;
	}

	
	public function getScreenName()
	{

		return $this->screen_name;
	}

	
	public function getSiteUrl()
	{

		return $this->site_url;
	}

	
	public function getPermissions()
	{

		return $this->permissions;
	}

	
	public function getGroupId()
	{

		return $this->group_id;
	}

	
	public function getPlays()
	{

		return $this->plays;
	}

	
	public function getPartnerData()
	{

		return $this->partner_data;
	}

	
	public function getIntId()
	{

		return $this->int_id;
	}

	
	public function getIndexedCustomData1()
	{

		return $this->indexed_custom_data_1;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getMediaDate($format = 'Y-m-d H:i:s')
	{

		if ($this->media_date === null || $this->media_date === '') {
			return null;
		} elseif (!is_int($this->media_date)) {
						$ts = strtotime($this->media_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [media_date] as date/time value: " . var_export($this->media_date, true));
			}
		} else {
			$ts = $this->media_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getAdminTags()
	{

		return $this->admin_tags;
	}

	
	public function getModerationStatus()
	{

		return $this->moderation_status;
	}

	
	public function getModerationCount()
	{

		return $this->moderation_count;
	}

	
	public function getModifiedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->modified_at === null || $this->modified_at === '') {
			return null;
		} elseif (!is_int($this->modified_at)) {
						$ts = strtotime($this->modified_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [modified_at] as date/time value: " . var_export($this->modified_at, true));
			}
		} else {
			$ts = $this->modified_at;
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
			$this->modifiedColumns[] = entryPeer::ID;
		}

	} 
	
	public function setKshowId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->kshow_id !== $v) {
			$this->kshow_id = $v;
			$this->modifiedColumns[] = entryPeer::KSHOW_ID;
		}

		if ($this->akshow !== null && $this->akshow->getId() !== $v) {
			$this->akshow = null;
		}

	} 
	
	public function setKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->kuser_id !== $v) {
			$this->kuser_id = $v;
			$this->modifiedColumns[] = entryPeer::KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = entryPeer::NAME;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = entryPeer::TYPE;
		}

	} 
	
	public function setMediaType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->media_type !== $v) {
			$this->media_type = $v;
			$this->modifiedColumns[] = entryPeer::MEDIA_TYPE;
		}

	} 
	
	public function setData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = entryPeer::DATA;
		}

	} 
	
	public function setThumbnail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thumbnail !== $v) {
			$this->thumbnail = $v;
			$this->modifiedColumns[] = entryPeer::THUMBNAIL;
		}

	} 
	
	public function setViews($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->views !== $v || $v === 0) {
			$this->views = $v;
			$this->modifiedColumns[] = entryPeer::VIEWS;
		}

	} 
	
	public function setVotes($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->votes !== $v || $v === 0) {
			$this->votes = $v;
			$this->modifiedColumns[] = entryPeer::VOTES;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->comments !== $v || $v === 0) {
			$this->comments = $v;
			$this->modifiedColumns[] = entryPeer::COMMENTS;
		}

	} 
	
	public function setFavorites($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->favorites !== $v || $v === 0) {
			$this->favorites = $v;
			$this->modifiedColumns[] = entryPeer::FAVORITES;
		}

	} 
	
	public function setTotalRank($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_rank !== $v || $v === 0) {
			$this->total_rank = $v;
			$this->modifiedColumns[] = entryPeer::TOTAL_RANK;
		}

	} 
	
	public function setRank($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v || $v === 0) {
			$this->rank = $v;
			$this->modifiedColumns[] = entryPeer::RANK;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = entryPeer::TAGS;
		}

	} 
	
	public function setAnonymous($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->anonymous !== $v) {
			$this->anonymous = $v;
			$this->modifiedColumns[] = entryPeer::ANONYMOUS;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = entryPeer::STATUS;
		}

	} 
	
	public function setSource($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->source !== $v) {
			$this->source = $v;
			$this->modifiedColumns[] = entryPeer::SOURCE;
		}

	} 
	
	public function setSourceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->source_id !== $v) {
			$this->source_id = $v;
			$this->modifiedColumns[] = entryPeer::SOURCE_ID;
		}

	} 
	
	public function setSourceLink($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_link !== $v) {
			$this->source_link = $v;
			$this->modifiedColumns[] = entryPeer::SOURCE_LINK;
		}

	} 
	
	public function setLicenseType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->license_type !== $v) {
			$this->license_type = $v;
			$this->modifiedColumns[] = entryPeer::LICENSE_TYPE;
		}

	} 
	
	public function setCredit($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credit !== $v) {
			$this->credit = $v;
			$this->modifiedColumns[] = entryPeer::CREDIT;
		}

	} 
	
	public function setLengthInMsecs($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->length_in_msecs !== $v || $v === 0) {
			$this->length_in_msecs = $v;
			$this->modifiedColumns[] = entryPeer::LENGTH_IN_MSECS;
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
			$this->modifiedColumns[] = entryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = entryPeer::UPDATED_AT;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = entryPeer::PARTNER_ID;
		}

	} 
	
	public function setDisplayInSearch($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_in_search !== $v) {
			$this->display_in_search = $v;
			$this->modifiedColumns[] = entryPeer::DISPLAY_IN_SEARCH;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = entryPeer::SUBP_ID;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = entryPeer::CUSTOM_DATA;
		}

	} 
	
	public function setSearchText($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->search_text !== $v) {
			$this->search_text = $v;
			$this->modifiedColumns[] = entryPeer::SEARCH_TEXT;
		}

	} 
	
	public function setScreenName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->screen_name !== $v) {
			$this->screen_name = $v;
			$this->modifiedColumns[] = entryPeer::SCREEN_NAME;
		}

	} 
	
	public function setSiteUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->site_url !== $v) {
			$this->site_url = $v;
			$this->modifiedColumns[] = entryPeer::SITE_URL;
		}

	} 
	
	public function setPermissions($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->permissions !== $v || $v === 1) {
			$this->permissions = $v;
			$this->modifiedColumns[] = entryPeer::PERMISSIONS;
		}

	} 
	
	public function setGroupId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = entryPeer::GROUP_ID;
		}

	} 
	
	public function setPlays($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->plays !== $v || $v === 0) {
			$this->plays = $v;
			$this->modifiedColumns[] = entryPeer::PLAYS;
		}

	} 
	
	public function setPartnerData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_data !== $v) {
			$this->partner_data = $v;
			$this->modifiedColumns[] = entryPeer::PARTNER_DATA;
		}

	} 
	
	public function setIntId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->int_id !== $v) {
			$this->int_id = $v;
			$this->modifiedColumns[] = entryPeer::INT_ID;
		}

	} 
	
	public function setIndexedCustomData1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->indexed_custom_data_1 !== $v) {
			$this->indexed_custom_data_1 = $v;
			$this->modifiedColumns[] = entryPeer::INDEXED_CUSTOM_DATA_1;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = entryPeer::DESCRIPTION;
		}

	} 
	
	public function setMediaDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [media_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->media_date !== $ts) {
			$this->media_date = $ts;
			$this->modifiedColumns[] = entryPeer::MEDIA_DATE;
		}

	} 
	
	public function setAdminTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->admin_tags !== $v) {
			$this->admin_tags = $v;
			$this->modifiedColumns[] = entryPeer::ADMIN_TAGS;
		}

	} 
	
	public function setModerationStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->moderation_status !== $v) {
			$this->moderation_status = $v;
			$this->modifiedColumns[] = entryPeer::MODERATION_STATUS;
		}

	} 
	
	public function setModerationCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->moderation_count !== $v) {
			$this->moderation_count = $v;
			$this->modifiedColumns[] = entryPeer::MODERATION_COUNT;
		}

	} 
	
	public function setModifiedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [modified_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->modified_at !== $ts) {
			$this->modified_at = $ts;
			$this->modifiedColumns[] = entryPeer::MODIFIED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->kshow_id = $rs->getString($startcol + 1);

			$this->kuser_id = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->type = $rs->getInt($startcol + 4);

			$this->media_type = $rs->getInt($startcol + 5);

			$this->data = $rs->getString($startcol + 6);

			$this->thumbnail = $rs->getString($startcol + 7);

			$this->views = $rs->getInt($startcol + 8);

			$this->votes = $rs->getInt($startcol + 9);

			$this->comments = $rs->getInt($startcol + 10);

			$this->favorites = $rs->getInt($startcol + 11);

			$this->total_rank = $rs->getInt($startcol + 12);

			$this->rank = $rs->getInt($startcol + 13);

			$this->tags = $rs->getString($startcol + 14);

			$this->anonymous = $rs->getInt($startcol + 15);

			$this->status = $rs->getInt($startcol + 16);

			$this->source = $rs->getInt($startcol + 17);

			$this->source_id = $rs->getInt($startcol + 18);

			$this->source_link = $rs->getString($startcol + 19);

			$this->license_type = $rs->getInt($startcol + 20);

			$this->credit = $rs->getString($startcol + 21);

			$this->length_in_msecs = $rs->getInt($startcol + 22);

			$this->created_at = $rs->getTimestamp($startcol + 23, null);

			$this->updated_at = $rs->getTimestamp($startcol + 24, null);

			$this->partner_id = $rs->getInt($startcol + 25);

			$this->display_in_search = $rs->getInt($startcol + 26);

			$this->subp_id = $rs->getInt($startcol + 27);

			$this->custom_data = $rs->getString($startcol + 28);

			$this->search_text = $rs->getString($startcol + 29);

			$this->screen_name = $rs->getString($startcol + 30);

			$this->site_url = $rs->getString($startcol + 31);

			$this->permissions = $rs->getInt($startcol + 32);

			$this->group_id = $rs->getString($startcol + 33);

			$this->plays = $rs->getInt($startcol + 34);

			$this->partner_data = $rs->getString($startcol + 35);

			$this->int_id = $rs->getInt($startcol + 36);

			$this->indexed_custom_data_1 = $rs->getInt($startcol + 37);

			$this->description = $rs->getString($startcol + 38);

			$this->media_date = $rs->getTimestamp($startcol + 39, null);

			$this->admin_tags = $rs->getString($startcol + 40);

			$this->moderation_status = $rs->getInt($startcol + 41);

			$this->moderation_count = $rs->getInt($startcol + 42);

			$this->modified_at = $rs->getTimestamp($startcol + 43, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 44; 
		} catch (Exception $e) {
			throw new PropelException("Error populating entry object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(entryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			entryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(entryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(entryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(entryPeer::DATABASE_NAME);
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


												
			if ($this->akshow !== null) {
				if ($this->akshow->isModified()) {
					$affectedRows += $this->akshow->save($con);
				}
				$this->setkshow($this->akshow);
			}

			if ($this->akuser !== null) {
				if ($this->akuser->isModified()) {
					$affectedRows += $this->akuser->save($con);
				}
				$this->setkuser($this->akuser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = entryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += entryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collkvotes !== null) {
				foreach($this->collkvotes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collconversions !== null) {
				foreach($this->collconversions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWidgetLogs !== null) {
				foreach($this->collWidgetLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collroughcutEntrysRelatedByRoughcutId !== null) {
				foreach($this->collroughcutEntrysRelatedByRoughcutId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collroughcutEntrysRelatedByEntryId !== null) {
				foreach($this->collroughcutEntrysRelatedByEntryId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collwidgets !== null) {
				foreach($this->collwidgets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collKwidgetLogs !== null) {
				foreach($this->collKwidgetLogs as $referrerFK) {
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


												
			if ($this->akshow !== null) {
				if (!$this->akshow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akshow->getValidationFailures());
				}
			}

			if ($this->akuser !== null) {
				if (!$this->akuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuser->getValidationFailures());
				}
			}


			if (($retval = entryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collkvotes !== null) {
					foreach($this->collkvotes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collconversions !== null) {
					foreach($this->collconversions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWidgetLogs !== null) {
					foreach($this->collWidgetLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collroughcutEntrysRelatedByRoughcutId !== null) {
					foreach($this->collroughcutEntrysRelatedByRoughcutId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collroughcutEntrysRelatedByEntryId !== null) {
					foreach($this->collroughcutEntrysRelatedByEntryId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collwidgets !== null) {
					foreach($this->collwidgets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collKwidgetLogs !== null) {
					foreach($this->collKwidgetLogs as $referrerFK) {
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
		$pos = entryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKshowId();
				break;
			case 2:
				return $this->getKuserId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getType();
				break;
			case 5:
				return $this->getMediaType();
				break;
			case 6:
				return $this->getData();
				break;
			case 7:
				return $this->getThumbnail();
				break;
			case 8:
				return $this->getViews();
				break;
			case 9:
				return $this->getVotes();
				break;
			case 10:
				return $this->getComments();
				break;
			case 11:
				return $this->getFavorites();
				break;
			case 12:
				return $this->getTotalRank();
				break;
			case 13:
				return $this->getRank();
				break;
			case 14:
				return $this->getTags();
				break;
			case 15:
				return $this->getAnonymous();
				break;
			case 16:
				return $this->getStatus();
				break;
			case 17:
				return $this->getSource();
				break;
			case 18:
				return $this->getSourceId();
				break;
			case 19:
				return $this->getSourceLink();
				break;
			case 20:
				return $this->getLicenseType();
				break;
			case 21:
				return $this->getCredit();
				break;
			case 22:
				return $this->getLengthInMsecs();
				break;
			case 23:
				return $this->getCreatedAt();
				break;
			case 24:
				return $this->getUpdatedAt();
				break;
			case 25:
				return $this->getPartnerId();
				break;
			case 26:
				return $this->getDisplayInSearch();
				break;
			case 27:
				return $this->getSubpId();
				break;
			case 28:
				return $this->getCustomData();
				break;
			case 29:
				return $this->getSearchText();
				break;
			case 30:
				return $this->getScreenName();
				break;
			case 31:
				return $this->getSiteUrl();
				break;
			case 32:
				return $this->getPermissions();
				break;
			case 33:
				return $this->getGroupId();
				break;
			case 34:
				return $this->getPlays();
				break;
			case 35:
				return $this->getPartnerData();
				break;
			case 36:
				return $this->getIntId();
				break;
			case 37:
				return $this->getIndexedCustomData1();
				break;
			case 38:
				return $this->getDescription();
				break;
			case 39:
				return $this->getMediaDate();
				break;
			case 40:
				return $this->getAdminTags();
				break;
			case 41:
				return $this->getModerationStatus();
				break;
			case 42:
				return $this->getModerationCount();
				break;
			case 43:
				return $this->getModifiedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = entryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKshowId(),
			$keys[2] => $this->getKuserId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getType(),
			$keys[5] => $this->getMediaType(),
			$keys[6] => $this->getData(),
			$keys[7] => $this->getThumbnail(),
			$keys[8] => $this->getViews(),
			$keys[9] => $this->getVotes(),
			$keys[10] => $this->getComments(),
			$keys[11] => $this->getFavorites(),
			$keys[12] => $this->getTotalRank(),
			$keys[13] => $this->getRank(),
			$keys[14] => $this->getTags(),
			$keys[15] => $this->getAnonymous(),
			$keys[16] => $this->getStatus(),
			$keys[17] => $this->getSource(),
			$keys[18] => $this->getSourceId(),
			$keys[19] => $this->getSourceLink(),
			$keys[20] => $this->getLicenseType(),
			$keys[21] => $this->getCredit(),
			$keys[22] => $this->getLengthInMsecs(),
			$keys[23] => $this->getCreatedAt(),
			$keys[24] => $this->getUpdatedAt(),
			$keys[25] => $this->getPartnerId(),
			$keys[26] => $this->getDisplayInSearch(),
			$keys[27] => $this->getSubpId(),
			$keys[28] => $this->getCustomData(),
			$keys[29] => $this->getSearchText(),
			$keys[30] => $this->getScreenName(),
			$keys[31] => $this->getSiteUrl(),
			$keys[32] => $this->getPermissions(),
			$keys[33] => $this->getGroupId(),
			$keys[34] => $this->getPlays(),
			$keys[35] => $this->getPartnerData(),
			$keys[36] => $this->getIntId(),
			$keys[37] => $this->getIndexedCustomData1(),
			$keys[38] => $this->getDescription(),
			$keys[39] => $this->getMediaDate(),
			$keys[40] => $this->getAdminTags(),
			$keys[41] => $this->getModerationStatus(),
			$keys[42] => $this->getModerationCount(),
			$keys[43] => $this->getModifiedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = entryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKshowId($value);
				break;
			case 2:
				$this->setKuserId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setType($value);
				break;
			case 5:
				$this->setMediaType($value);
				break;
			case 6:
				$this->setData($value);
				break;
			case 7:
				$this->setThumbnail($value);
				break;
			case 8:
				$this->setViews($value);
				break;
			case 9:
				$this->setVotes($value);
				break;
			case 10:
				$this->setComments($value);
				break;
			case 11:
				$this->setFavorites($value);
				break;
			case 12:
				$this->setTotalRank($value);
				break;
			case 13:
				$this->setRank($value);
				break;
			case 14:
				$this->setTags($value);
				break;
			case 15:
				$this->setAnonymous($value);
				break;
			case 16:
				$this->setStatus($value);
				break;
			case 17:
				$this->setSource($value);
				break;
			case 18:
				$this->setSourceId($value);
				break;
			case 19:
				$this->setSourceLink($value);
				break;
			case 20:
				$this->setLicenseType($value);
				break;
			case 21:
				$this->setCredit($value);
				break;
			case 22:
				$this->setLengthInMsecs($value);
				break;
			case 23:
				$this->setCreatedAt($value);
				break;
			case 24:
				$this->setUpdatedAt($value);
				break;
			case 25:
				$this->setPartnerId($value);
				break;
			case 26:
				$this->setDisplayInSearch($value);
				break;
			case 27:
				$this->setSubpId($value);
				break;
			case 28:
				$this->setCustomData($value);
				break;
			case 29:
				$this->setSearchText($value);
				break;
			case 30:
				$this->setScreenName($value);
				break;
			case 31:
				$this->setSiteUrl($value);
				break;
			case 32:
				$this->setPermissions($value);
				break;
			case 33:
				$this->setGroupId($value);
				break;
			case 34:
				$this->setPlays($value);
				break;
			case 35:
				$this->setPartnerData($value);
				break;
			case 36:
				$this->setIntId($value);
				break;
			case 37:
				$this->setIndexedCustomData1($value);
				break;
			case 38:
				$this->setDescription($value);
				break;
			case 39:
				$this->setMediaDate($value);
				break;
			case 40:
				$this->setAdminTags($value);
				break;
			case 41:
				$this->setModerationStatus($value);
				break;
			case 42:
				$this->setModerationCount($value);
				break;
			case 43:
				$this->setModifiedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = entryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKshowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKuserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMediaType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setData($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setThumbnail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setViews($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setVotes($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setComments($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFavorites($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTotalRank($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setRank($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setTags($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAnonymous($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setStatus($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setSource($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setSourceId($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setSourceLink($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setLicenseType($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCredit($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setLengthInMsecs($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCreatedAt($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setUpdatedAt($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setPartnerId($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setDisplayInSearch($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setSubpId($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCustomData($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setSearchText($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setScreenName($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setSiteUrl($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setPermissions($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setGroupId($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setPlays($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setPartnerData($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setIntId($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setIndexedCustomData1($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setDescription($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setMediaDate($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setAdminTags($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setModerationStatus($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setModerationCount($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setModifiedAt($arr[$keys[43]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(entryPeer::DATABASE_NAME);

		if ($this->isColumnModified(entryPeer::ID)) $criteria->add(entryPeer::ID, $this->id);
		if ($this->isColumnModified(entryPeer::KSHOW_ID)) $criteria->add(entryPeer::KSHOW_ID, $this->kshow_id);
		if ($this->isColumnModified(entryPeer::KUSER_ID)) $criteria->add(entryPeer::KUSER_ID, $this->kuser_id);
		if ($this->isColumnModified(entryPeer::NAME)) $criteria->add(entryPeer::NAME, $this->name);
		if ($this->isColumnModified(entryPeer::TYPE)) $criteria->add(entryPeer::TYPE, $this->type);
		if ($this->isColumnModified(entryPeer::MEDIA_TYPE)) $criteria->add(entryPeer::MEDIA_TYPE, $this->media_type);
		if ($this->isColumnModified(entryPeer::DATA)) $criteria->add(entryPeer::DATA, $this->data);
		if ($this->isColumnModified(entryPeer::THUMBNAIL)) $criteria->add(entryPeer::THUMBNAIL, $this->thumbnail);
		if ($this->isColumnModified(entryPeer::VIEWS)) $criteria->add(entryPeer::VIEWS, $this->views);
		if ($this->isColumnModified(entryPeer::VOTES)) $criteria->add(entryPeer::VOTES, $this->votes);
		if ($this->isColumnModified(entryPeer::COMMENTS)) $criteria->add(entryPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(entryPeer::FAVORITES)) $criteria->add(entryPeer::FAVORITES, $this->favorites);
		if ($this->isColumnModified(entryPeer::TOTAL_RANK)) $criteria->add(entryPeer::TOTAL_RANK, $this->total_rank);
		if ($this->isColumnModified(entryPeer::RANK)) $criteria->add(entryPeer::RANK, $this->rank);
		if ($this->isColumnModified(entryPeer::TAGS)) $criteria->add(entryPeer::TAGS, $this->tags);
		if ($this->isColumnModified(entryPeer::ANONYMOUS)) $criteria->add(entryPeer::ANONYMOUS, $this->anonymous);
		if ($this->isColumnModified(entryPeer::STATUS)) $criteria->add(entryPeer::STATUS, $this->status);
		if ($this->isColumnModified(entryPeer::SOURCE)) $criteria->add(entryPeer::SOURCE, $this->source);
		if ($this->isColumnModified(entryPeer::SOURCE_ID)) $criteria->add(entryPeer::SOURCE_ID, $this->source_id);
		if ($this->isColumnModified(entryPeer::SOURCE_LINK)) $criteria->add(entryPeer::SOURCE_LINK, $this->source_link);
		if ($this->isColumnModified(entryPeer::LICENSE_TYPE)) $criteria->add(entryPeer::LICENSE_TYPE, $this->license_type);
		if ($this->isColumnModified(entryPeer::CREDIT)) $criteria->add(entryPeer::CREDIT, $this->credit);
		if ($this->isColumnModified(entryPeer::LENGTH_IN_MSECS)) $criteria->add(entryPeer::LENGTH_IN_MSECS, $this->length_in_msecs);
		if ($this->isColumnModified(entryPeer::CREATED_AT)) $criteria->add(entryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(entryPeer::UPDATED_AT)) $criteria->add(entryPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(entryPeer::PARTNER_ID)) $criteria->add(entryPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(entryPeer::DISPLAY_IN_SEARCH)) $criteria->add(entryPeer::DISPLAY_IN_SEARCH, $this->display_in_search);
		if ($this->isColumnModified(entryPeer::SUBP_ID)) $criteria->add(entryPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(entryPeer::CUSTOM_DATA)) $criteria->add(entryPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(entryPeer::SEARCH_TEXT)) $criteria->add(entryPeer::SEARCH_TEXT, $this->search_text);
		if ($this->isColumnModified(entryPeer::SCREEN_NAME)) $criteria->add(entryPeer::SCREEN_NAME, $this->screen_name);
		if ($this->isColumnModified(entryPeer::SITE_URL)) $criteria->add(entryPeer::SITE_URL, $this->site_url);
		if ($this->isColumnModified(entryPeer::PERMISSIONS)) $criteria->add(entryPeer::PERMISSIONS, $this->permissions);
		if ($this->isColumnModified(entryPeer::GROUP_ID)) $criteria->add(entryPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(entryPeer::PLAYS)) $criteria->add(entryPeer::PLAYS, $this->plays);
		if ($this->isColumnModified(entryPeer::PARTNER_DATA)) $criteria->add(entryPeer::PARTNER_DATA, $this->partner_data);
		if ($this->isColumnModified(entryPeer::INT_ID)) $criteria->add(entryPeer::INT_ID, $this->int_id);
		if ($this->isColumnModified(entryPeer::INDEXED_CUSTOM_DATA_1)) $criteria->add(entryPeer::INDEXED_CUSTOM_DATA_1, $this->indexed_custom_data_1);
		if ($this->isColumnModified(entryPeer::DESCRIPTION)) $criteria->add(entryPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(entryPeer::MEDIA_DATE)) $criteria->add(entryPeer::MEDIA_DATE, $this->media_date);
		if ($this->isColumnModified(entryPeer::ADMIN_TAGS)) $criteria->add(entryPeer::ADMIN_TAGS, $this->admin_tags);
		if ($this->isColumnModified(entryPeer::MODERATION_STATUS)) $criteria->add(entryPeer::MODERATION_STATUS, $this->moderation_status);
		if ($this->isColumnModified(entryPeer::MODERATION_COUNT)) $criteria->add(entryPeer::MODERATION_COUNT, $this->moderation_count);
		if ($this->isColumnModified(entryPeer::MODIFIED_AT)) $criteria->add(entryPeer::MODIFIED_AT, $this->modified_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(entryPeer::DATABASE_NAME);

		$criteria->add(entryPeer::ID, $this->id);

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

		$copyObj->setKshowId($this->kshow_id);

		$copyObj->setKuserId($this->kuser_id);

		$copyObj->setName($this->name);

		$copyObj->setType($this->type);

		$copyObj->setMediaType($this->media_type);

		$copyObj->setData($this->data);

		$copyObj->setThumbnail($this->thumbnail);

		$copyObj->setViews($this->views);

		$copyObj->setVotes($this->votes);

		$copyObj->setComments($this->comments);

		$copyObj->setFavorites($this->favorites);

		$copyObj->setTotalRank($this->total_rank);

		$copyObj->setRank($this->rank);

		$copyObj->setTags($this->tags);

		$copyObj->setAnonymous($this->anonymous);

		$copyObj->setStatus($this->status);

		$copyObj->setSource($this->source);

		$copyObj->setSourceId($this->source_id);

		$copyObj->setSourceLink($this->source_link);

		$copyObj->setLicenseType($this->license_type);

		$copyObj->setCredit($this->credit);

		$copyObj->setLengthInMsecs($this->length_in_msecs);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setDisplayInSearch($this->display_in_search);

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setSearchText($this->search_text);

		$copyObj->setScreenName($this->screen_name);

		$copyObj->setSiteUrl($this->site_url);

		$copyObj->setPermissions($this->permissions);

		$copyObj->setGroupId($this->group_id);

		$copyObj->setPlays($this->plays);

		$copyObj->setPartnerData($this->partner_data);

		$copyObj->setIntId($this->int_id);

		$copyObj->setIndexedCustomData1($this->indexed_custom_data_1);

		$copyObj->setDescription($this->description);

		$copyObj->setMediaDate($this->media_date);

		$copyObj->setAdminTags($this->admin_tags);

		$copyObj->setModerationStatus($this->moderation_status);

		$copyObj->setModerationCount($this->moderation_count);

		$copyObj->setModifiedAt($this->modified_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getkvotes() as $relObj) {
				$copyObj->addkvote($relObj->copy($deepCopy));
			}

			foreach($this->getconversions() as $relObj) {
				$copyObj->addconversion($relObj->copy($deepCopy));
			}

			foreach($this->getWidgetLogs() as $relObj) {
				$copyObj->addWidgetLog($relObj->copy($deepCopy));
			}

			foreach($this->getroughcutEntrysRelatedByRoughcutId() as $relObj) {
				$copyObj->addroughcutEntryRelatedByRoughcutId($relObj->copy($deepCopy));
			}

			foreach($this->getroughcutEntrysRelatedByEntryId() as $relObj) {
				$copyObj->addroughcutEntryRelatedByEntryId($relObj->copy($deepCopy));
			}

			foreach($this->getwidgets() as $relObj) {
				$copyObj->addwidget($relObj->copy($deepCopy));
			}

			foreach($this->getKwidgetLogs() as $relObj) {
				$copyObj->addKwidgetLog($relObj->copy($deepCopy));
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
			self::$peer = new entryPeer();
		}
		return self::$peer;
	}

	
	public function setkshow($v)
	{


		if ($v === null) {
			$this->setKshowId(NULL);
		} else {
			$this->setKshowId($v->getId());
		}


		$this->akshow = $v;
	}


	
	public function getkshow($con = null)
	{
				include_once 'lib/model/om/BasekshowPeer.php';

		if ($this->akshow === null && (($this->kshow_id !== "" && $this->kshow_id !== null))) {

			$this->akshow = kshowPeer::retrieveByPK($this->kshow_id, $con);

			
		}
		return $this->akshow;
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

	
	public function initkvotes()
	{
		if ($this->collkvotes === null) {
			$this->collkvotes = array();
		}
	}

	
	public function getkvotes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotes === null) {
			if ($this->isNew()) {
			   $this->collkvotes = array();
			} else {

				$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

				kvotePeer::addSelectColumns($criteria);
				$this->collkvotes = kvotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

				kvotePeer::addSelectColumns($criteria);
				if (!isset($this->lastkvoteCriteria) || !$this->lastkvoteCriteria->equals($criteria)) {
					$this->collkvotes = kvotePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastkvoteCriteria = $criteria;
		return $this->collkvotes;
	}

	
	public function countkvotes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

		return kvotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addkvote(kvote $l)
	{
		$this->collkvotes[] = $l;
		$l->setentry($this);
	}


	
	public function getkvotesJoinkshowRelatedByKshowId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotes === null) {
			if ($this->isNew()) {
				$this->collkvotes = array();
			} else {

				$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

				$this->collkvotes = kvotePeer::doSelectJoinkshowRelatedByKshowId($criteria, $con);
			}
		} else {
									
			$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastkvoteCriteria) || !$this->lastkvoteCriteria->equals($criteria)) {
				$this->collkvotes = kvotePeer::doSelectJoinkshowRelatedByKshowId($criteria, $con);
			}
		}
		$this->lastkvoteCriteria = $criteria;

		return $this->collkvotes;
	}


	
	public function getkvotesJoinkshowRelatedByKuserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotes === null) {
			if ($this->isNew()) {
				$this->collkvotes = array();
			} else {

				$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

				$this->collkvotes = kvotePeer::doSelectJoinkshowRelatedByKuserId($criteria, $con);
			}
		} else {
									
			$criteria->add(kvotePeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastkvoteCriteria) || !$this->lastkvoteCriteria->equals($criteria)) {
				$this->collkvotes = kvotePeer::doSelectJoinkshowRelatedByKuserId($criteria, $con);
			}
		}
		$this->lastkvoteCriteria = $criteria;

		return $this->collkvotes;
	}

	
	public function initconversions()
	{
		if ($this->collconversions === null) {
			$this->collconversions = array();
		}
	}

	
	public function getconversions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseconversionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collconversions === null) {
			if ($this->isNew()) {
			   $this->collconversions = array();
			} else {

				$criteria->add(conversionPeer::ENTRY_ID, $this->getId());

				conversionPeer::addSelectColumns($criteria);
				$this->collconversions = conversionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(conversionPeer::ENTRY_ID, $this->getId());

				conversionPeer::addSelectColumns($criteria);
				if (!isset($this->lastconversionCriteria) || !$this->lastconversionCriteria->equals($criteria)) {
					$this->collconversions = conversionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastconversionCriteria = $criteria;
		return $this->collconversions;
	}

	
	public function countconversions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseconversionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(conversionPeer::ENTRY_ID, $this->getId());

		return conversionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addconversion(conversion $l)
	{
		$this->collconversions[] = $l;
		$l->setentry($this);
	}

	
	public function initWidgetLogs()
	{
		if ($this->collWidgetLogs === null) {
			$this->collWidgetLogs = array();
		}
	}

	
	public function getWidgetLogs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetLogs === null) {
			if ($this->isNew()) {
			   $this->collWidgetLogs = array();
			} else {

				$criteria->add(WidgetLogPeer::ENTRY_ID, $this->getId());

				WidgetLogPeer::addSelectColumns($criteria);
				$this->collWidgetLogs = WidgetLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WidgetLogPeer::ENTRY_ID, $this->getId());

				WidgetLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastWidgetLogCriteria) || !$this->lastWidgetLogCriteria->equals($criteria)) {
					$this->collWidgetLogs = WidgetLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWidgetLogCriteria = $criteria;
		return $this->collWidgetLogs;
	}

	
	public function countWidgetLogs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseWidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WidgetLogPeer::ENTRY_ID, $this->getId());

		return WidgetLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWidgetLog(WidgetLog $l)
	{
		$this->collWidgetLogs[] = $l;
		$l->setentry($this);
	}

	
	public function initroughcutEntrysRelatedByRoughcutId()
	{
		if ($this->collroughcutEntrysRelatedByRoughcutId === null) {
			$this->collroughcutEntrysRelatedByRoughcutId = array();
		}
	}

	
	public function getroughcutEntrysRelatedByRoughcutId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrysRelatedByRoughcutId === null) {
			if ($this->isNew()) {
			   $this->collroughcutEntrysRelatedByRoughcutId = array();
			} else {

				$criteria->add(roughcutEntryPeer::ROUGHCUT_ID, $this->getId());

				roughcutEntryPeer::addSelectColumns($criteria);
				$this->collroughcutEntrysRelatedByRoughcutId = roughcutEntryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(roughcutEntryPeer::ROUGHCUT_ID, $this->getId());

				roughcutEntryPeer::addSelectColumns($criteria);
				if (!isset($this->lastroughcutEntryRelatedByRoughcutIdCriteria) || !$this->lastroughcutEntryRelatedByRoughcutIdCriteria->equals($criteria)) {
					$this->collroughcutEntrysRelatedByRoughcutId = roughcutEntryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastroughcutEntryRelatedByRoughcutIdCriteria = $criteria;
		return $this->collroughcutEntrysRelatedByRoughcutId;
	}

	
	public function countroughcutEntrysRelatedByRoughcutId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(roughcutEntryPeer::ROUGHCUT_ID, $this->getId());

		return roughcutEntryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addroughcutEntryRelatedByRoughcutId(roughcutEntry $l)
	{
		$this->collroughcutEntrysRelatedByRoughcutId[] = $l;
		$l->setentryRelatedByRoughcutId($this);
	}


	
	public function getroughcutEntrysRelatedByRoughcutIdJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrysRelatedByRoughcutId === null) {
			if ($this->isNew()) {
				$this->collroughcutEntrysRelatedByRoughcutId = array();
			} else {

				$criteria->add(roughcutEntryPeer::ROUGHCUT_ID, $this->getId());

				$this->collroughcutEntrysRelatedByRoughcutId = roughcutEntryPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(roughcutEntryPeer::ROUGHCUT_ID, $this->getId());

			if (!isset($this->lastroughcutEntryRelatedByRoughcutIdCriteria) || !$this->lastroughcutEntryRelatedByRoughcutIdCriteria->equals($criteria)) {
				$this->collroughcutEntrysRelatedByRoughcutId = roughcutEntryPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastroughcutEntryRelatedByRoughcutIdCriteria = $criteria;

		return $this->collroughcutEntrysRelatedByRoughcutId;
	}

	
	public function initroughcutEntrysRelatedByEntryId()
	{
		if ($this->collroughcutEntrysRelatedByEntryId === null) {
			$this->collroughcutEntrysRelatedByEntryId = array();
		}
	}

	
	public function getroughcutEntrysRelatedByEntryId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrysRelatedByEntryId === null) {
			if ($this->isNew()) {
			   $this->collroughcutEntrysRelatedByEntryId = array();
			} else {

				$criteria->add(roughcutEntryPeer::ENTRY_ID, $this->getId());

				roughcutEntryPeer::addSelectColumns($criteria);
				$this->collroughcutEntrysRelatedByEntryId = roughcutEntryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(roughcutEntryPeer::ENTRY_ID, $this->getId());

				roughcutEntryPeer::addSelectColumns($criteria);
				if (!isset($this->lastroughcutEntryRelatedByEntryIdCriteria) || !$this->lastroughcutEntryRelatedByEntryIdCriteria->equals($criteria)) {
					$this->collroughcutEntrysRelatedByEntryId = roughcutEntryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastroughcutEntryRelatedByEntryIdCriteria = $criteria;
		return $this->collroughcutEntrysRelatedByEntryId;
	}

	
	public function countroughcutEntrysRelatedByEntryId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(roughcutEntryPeer::ENTRY_ID, $this->getId());

		return roughcutEntryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addroughcutEntryRelatedByEntryId(roughcutEntry $l)
	{
		$this->collroughcutEntrysRelatedByEntryId[] = $l;
		$l->setentryRelatedByEntryId($this);
	}


	
	public function getroughcutEntrysRelatedByEntryIdJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrysRelatedByEntryId === null) {
			if ($this->isNew()) {
				$this->collroughcutEntrysRelatedByEntryId = array();
			} else {

				$criteria->add(roughcutEntryPeer::ENTRY_ID, $this->getId());

				$this->collroughcutEntrysRelatedByEntryId = roughcutEntryPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(roughcutEntryPeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastroughcutEntryRelatedByEntryIdCriteria) || !$this->lastroughcutEntryRelatedByEntryIdCriteria->equals($criteria)) {
				$this->collroughcutEntrysRelatedByEntryId = roughcutEntryPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastroughcutEntryRelatedByEntryIdCriteria = $criteria;

		return $this->collroughcutEntrysRelatedByEntryId;
	}

	
	public function initwidgets()
	{
		if ($this->collwidgets === null) {
			$this->collwidgets = array();
		}
	}

	
	public function getwidgets($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collwidgets === null) {
			if ($this->isNew()) {
			   $this->collwidgets = array();
			} else {

				$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

				widgetPeer::addSelectColumns($criteria);
				$this->collwidgets = widgetPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

				widgetPeer::addSelectColumns($criteria);
				if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
					$this->collwidgets = widgetPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastwidgetCriteria = $criteria;
		return $this->collwidgets;
	}

	
	public function countwidgets($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

		return widgetPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addwidget(widget $l)
	{
		$this->collwidgets[] = $l;
		$l->setentry($this);
	}


	
	public function getwidgetsJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collwidgets === null) {
			if ($this->isNew()) {
				$this->collwidgets = array();
			} else {

				$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

				$this->collwidgets = widgetPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
				$this->collwidgets = widgetPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastwidgetCriteria = $criteria;

		return $this->collwidgets;
	}


	
	public function getwidgetsJoinuiConf($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasewidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collwidgets === null) {
			if ($this->isNew()) {
				$this->collwidgets = array();
			} else {

				$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

				$this->collwidgets = widgetPeer::doSelectJoinuiConf($criteria, $con);
			}
		} else {
									
			$criteria->add(widgetPeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
				$this->collwidgets = widgetPeer::doSelectJoinuiConf($criteria, $con);
			}
		}
		$this->lastwidgetCriteria = $criteria;

		return $this->collwidgets;
	}

	
	public function initKwidgetLogs()
	{
		if ($this->collKwidgetLogs === null) {
			$this->collKwidgetLogs = array();
		}
	}

	
	public function getKwidgetLogs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
			   $this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

				KwidgetLogPeer::addSelectColumns($criteria);
				$this->collKwidgetLogs = KwidgetLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

				KwidgetLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
					$this->collKwidgetLogs = KwidgetLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;
		return $this->collKwidgetLogs;
	}

	
	public function countKwidgetLogs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

		return KwidgetLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addKwidgetLog(KwidgetLog $l)
	{
		$this->collKwidgetLogs[] = $l;
		$l->setentry($this);
	}


	
	public function getKwidgetLogsJoinwidget($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
				$this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinwidget($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinwidget($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}


	
	public function getKwidgetLogsJoinkshow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
				$this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinkshow($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinkshow($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}


	
	public function getKwidgetLogsJoinuiConf($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseKwidgetLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKwidgetLogs === null) {
			if ($this->isNew()) {
				$this->collKwidgetLogs = array();
			} else {

				$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinuiConf($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::ENTRY_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinuiConf($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}

} 