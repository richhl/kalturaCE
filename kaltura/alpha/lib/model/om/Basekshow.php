<?php


abstract class Basekshow extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $producer_id;


	
	protected $episode_id;


	
	protected $name;


	
	protected $subdomain;


	
	protected $description;


	
	protected $status = 0;


	
	protected $type;


	
	protected $media_type;


	
	protected $format_type;


	
	protected $language;


	
	protected $start_date;


	
	protected $end_date;


	
	protected $skin;


	
	protected $thumbnail;


	
	protected $show_entry_id;


	
	protected $intro_id;


	
	protected $views = 0;


	
	protected $votes = 0;


	
	protected $comments = 0;


	
	protected $favorites = 0;


	
	protected $rank = 0;


	
	protected $entries = 0;


	
	protected $contributors = 0;


	
	protected $subscribers = 0;


	
	protected $number_of_updates = 0;


	
	protected $tags;


	
	protected $custom_data;


	
	protected $indexed_custom_data_1;


	
	protected $indexed_custom_data_2;


	
	protected $indexed_custom_data_3;


	
	protected $reoccurence;


	
	protected $license_type;


	
	protected $length_in_msecs = 0;


	
	protected $view_permissions;


	
	protected $view_password;


	
	protected $contrib_permissions;


	
	protected $contrib_password;


	
	protected $edit_permissions;


	
	protected $edit_password;


	
	protected $salt;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $partner_id = 0;


	
	protected $display_in_search;


	
	protected $subp_id = 0;


	
	protected $search_text;


	
	protected $permissions;


	
	protected $group_id;


	
	protected $plays = 0;


	
	protected $partner_data;


	
	protected $int_id;

	
	protected $akuser;

	
	protected $collentrys;

	
	protected $lastentryCriteria = null;

	
	protected $collkvotesRelatedByKshowId;

	
	protected $lastkvoteRelatedByKshowIdCriteria = null;

	
	protected $collkvotesRelatedByKuserId;

	
	protected $lastkvoteRelatedByKuserIdCriteria = null;

	
	protected $collKshowKusers;

	
	protected $lastKshowKuserCriteria = null;

	
	protected $collPuserRoles;

	
	protected $lastPuserRoleCriteria = null;

	
	protected $collroughcutEntrys;

	
	protected $lastroughcutEntryCriteria = null;

	
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

	
	public function getProducerId()
	{

		return $this->producer_id;
	}

	
	public function getEpisodeId()
	{

		return $this->episode_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getSubdomain()
	{

		return $this->subdomain;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getMediaType()
	{

		return $this->media_type;
	}

	
	public function getFormatType()
	{

		return $this->format_type;
	}

	
	public function getLanguage()
	{

		return $this->language;
	}

	
	public function getStartDate($format = 'Y-m-d')
	{

		if ($this->start_date === null || $this->start_date === '') {
			return null;
		} elseif (!is_int($this->start_date)) {
						$ts = strtotime($this->start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_date] as date/time value: " . var_export($this->start_date, true));
			}
		} else {
			$ts = $this->start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEndDate($format = 'Y-m-d')
	{

		if ($this->end_date === null || $this->end_date === '') {
			return null;
		} elseif (!is_int($this->end_date)) {
						$ts = strtotime($this->end_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [end_date] as date/time value: " . var_export($this->end_date, true));
			}
		} else {
			$ts = $this->end_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getSkin()
	{

		return $this->skin;
	}

	
	public function getThumbnail()
	{

		return $this->thumbnail;
	}

	
	public function getShowEntryId()
	{

		return $this->show_entry_id;
	}

	
	public function getIntroId()
	{

		return $this->intro_id;
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

	
	public function getRank()
	{

		return $this->rank;
	}

	
	public function getEntries()
	{

		return $this->entries;
	}

	
	public function getContributors()
	{

		return $this->contributors;
	}

	
	public function getSubscribers()
	{

		return $this->subscribers;
	}

	
	public function getNumberOfUpdates()
	{

		return $this->number_of_updates;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getIndexedCustomData1()
	{

		return $this->indexed_custom_data_1;
	}

	
	public function getIndexedCustomData2()
	{

		return $this->indexed_custom_data_2;
	}

	
	public function getIndexedCustomData3()
	{

		return $this->indexed_custom_data_3;
	}

	
	public function getReoccurence()
	{

		return $this->reoccurence;
	}

	
	public function getLicenseType()
	{

		return $this->license_type;
	}

	
	public function getLengthInMsecs()
	{

		return $this->length_in_msecs;
	}

	
	public function getViewPermissions()
	{

		return $this->view_permissions;
	}

	
	public function getViewPassword()
	{

		return $this->view_password;
	}

	
	public function getContribPermissions()
	{

		return $this->contrib_permissions;
	}

	
	public function getContribPassword()
	{

		return $this->contrib_password;
	}

	
	public function getEditPermissions()
	{

		return $this->edit_permissions;
	}

	
	public function getEditPassword()
	{

		return $this->edit_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
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

	
	public function getSearchText()
	{

		return $this->search_text;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = kshowPeer::ID;
		}

	} 
	
	public function setProducerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->producer_id !== $v) {
			$this->producer_id = $v;
			$this->modifiedColumns[] = kshowPeer::PRODUCER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setEpisodeId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->episode_id !== $v) {
			$this->episode_id = $v;
			$this->modifiedColumns[] = kshowPeer::EPISODE_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = kshowPeer::NAME;
		}

	} 
	
	public function setSubdomain($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subdomain !== $v) {
			$this->subdomain = $v;
			$this->modifiedColumns[] = kshowPeer::SUBDOMAIN;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = kshowPeer::DESCRIPTION;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v || $v === 0) {
			$this->status = $v;
			$this->modifiedColumns[] = kshowPeer::STATUS;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = kshowPeer::TYPE;
		}

	} 
	
	public function setMediaType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->media_type !== $v) {
			$this->media_type = $v;
			$this->modifiedColumns[] = kshowPeer::MEDIA_TYPE;
		}

	} 
	
	public function setFormatType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->format_type !== $v) {
			$this->format_type = $v;
			$this->modifiedColumns[] = kshowPeer::FORMAT_TYPE;
		}

	} 
	
	public function setLanguage($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = kshowPeer::LANGUAGE;
		}

	} 
	
	public function setStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_date !== $ts) {
			$this->start_date = $ts;
			$this->modifiedColumns[] = kshowPeer::START_DATE;
		}

	} 
	
	public function setEndDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [end_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->end_date !== $ts) {
			$this->end_date = $ts;
			$this->modifiedColumns[] = kshowPeer::END_DATE;
		}

	} 
	
	public function setSkin($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->skin !== $v) {
			$this->skin = $v;
			$this->modifiedColumns[] = kshowPeer::SKIN;
		}

	} 
	
	public function setThumbnail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thumbnail !== $v) {
			$this->thumbnail = $v;
			$this->modifiedColumns[] = kshowPeer::THUMBNAIL;
		}

	} 
	
	public function setShowEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->show_entry_id !== $v) {
			$this->show_entry_id = $v;
			$this->modifiedColumns[] = kshowPeer::SHOW_ENTRY_ID;
		}

	} 
	
	public function setIntroId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->intro_id !== $v) {
			$this->intro_id = $v;
			$this->modifiedColumns[] = kshowPeer::INTRO_ID;
		}

	} 
	
	public function setViews($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->views !== $v || $v === 0) {
			$this->views = $v;
			$this->modifiedColumns[] = kshowPeer::VIEWS;
		}

	} 
	
	public function setVotes($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->votes !== $v || $v === 0) {
			$this->votes = $v;
			$this->modifiedColumns[] = kshowPeer::VOTES;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->comments !== $v || $v === 0) {
			$this->comments = $v;
			$this->modifiedColumns[] = kshowPeer::COMMENTS;
		}

	} 
	
	public function setFavorites($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->favorites !== $v || $v === 0) {
			$this->favorites = $v;
			$this->modifiedColumns[] = kshowPeer::FAVORITES;
		}

	} 
	
	public function setRank($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v || $v === 0) {
			$this->rank = $v;
			$this->modifiedColumns[] = kshowPeer::RANK;
		}

	} 
	
	public function setEntries($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entries !== $v || $v === 0) {
			$this->entries = $v;
			$this->modifiedColumns[] = kshowPeer::ENTRIES;
		}

	} 
	
	public function setContributors($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->contributors !== $v || $v === 0) {
			$this->contributors = $v;
			$this->modifiedColumns[] = kshowPeer::CONTRIBUTORS;
		}

	} 
	
	public function setSubscribers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subscribers !== $v || $v === 0) {
			$this->subscribers = $v;
			$this->modifiedColumns[] = kshowPeer::SUBSCRIBERS;
		}

	} 
	
	public function setNumberOfUpdates($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->number_of_updates !== $v || $v === 0) {
			$this->number_of_updates = $v;
			$this->modifiedColumns[] = kshowPeer::NUMBER_OF_UPDATES;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = kshowPeer::TAGS;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = kshowPeer::CUSTOM_DATA;
		}

	} 
	
	public function setIndexedCustomData1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->indexed_custom_data_1 !== $v) {
			$this->indexed_custom_data_1 = $v;
			$this->modifiedColumns[] = kshowPeer::INDEXED_CUSTOM_DATA_1;
		}

	} 
	
	public function setIndexedCustomData2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->indexed_custom_data_2 !== $v) {
			$this->indexed_custom_data_2 = $v;
			$this->modifiedColumns[] = kshowPeer::INDEXED_CUSTOM_DATA_2;
		}

	} 
	
	public function setIndexedCustomData3($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->indexed_custom_data_3 !== $v) {
			$this->indexed_custom_data_3 = $v;
			$this->modifiedColumns[] = kshowPeer::INDEXED_CUSTOM_DATA_3;
		}

	} 
	
	public function setReoccurence($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->reoccurence !== $v) {
			$this->reoccurence = $v;
			$this->modifiedColumns[] = kshowPeer::REOCCURENCE;
		}

	} 
	
	public function setLicenseType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->license_type !== $v) {
			$this->license_type = $v;
			$this->modifiedColumns[] = kshowPeer::LICENSE_TYPE;
		}

	} 
	
	public function setLengthInMsecs($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->length_in_msecs !== $v || $v === 0) {
			$this->length_in_msecs = $v;
			$this->modifiedColumns[] = kshowPeer::LENGTH_IN_MSECS;
		}

	} 
	
	public function setViewPermissions($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->view_permissions !== $v) {
			$this->view_permissions = $v;
			$this->modifiedColumns[] = kshowPeer::VIEW_PERMISSIONS;
		}

	} 
	
	public function setViewPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->view_password !== $v) {
			$this->view_password = $v;
			$this->modifiedColumns[] = kshowPeer::VIEW_PASSWORD;
		}

	} 
	
	public function setContribPermissions($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->contrib_permissions !== $v) {
			$this->contrib_permissions = $v;
			$this->modifiedColumns[] = kshowPeer::CONTRIB_PERMISSIONS;
		}

	} 
	
	public function setContribPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contrib_password !== $v) {
			$this->contrib_password = $v;
			$this->modifiedColumns[] = kshowPeer::CONTRIB_PASSWORD;
		}

	} 
	
	public function setEditPermissions($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->edit_permissions !== $v) {
			$this->edit_permissions = $v;
			$this->modifiedColumns[] = kshowPeer::EDIT_PERMISSIONS;
		}

	} 
	
	public function setEditPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->edit_password !== $v) {
			$this->edit_password = $v;
			$this->modifiedColumns[] = kshowPeer::EDIT_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = kshowPeer::SALT;
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
			$this->modifiedColumns[] = kshowPeer::CREATED_AT;
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
			$this->modifiedColumns[] = kshowPeer::UPDATED_AT;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = kshowPeer::PARTNER_ID;
		}

	} 
	
	public function setDisplayInSearch($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_in_search !== $v) {
			$this->display_in_search = $v;
			$this->modifiedColumns[] = kshowPeer::DISPLAY_IN_SEARCH;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = kshowPeer::SUBP_ID;
		}

	} 
	
	public function setSearchText($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->search_text !== $v) {
			$this->search_text = $v;
			$this->modifiedColumns[] = kshowPeer::SEARCH_TEXT;
		}

	} 
	
	public function setPermissions($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->permissions !== $v) {
			$this->permissions = $v;
			$this->modifiedColumns[] = kshowPeer::PERMISSIONS;
		}

	} 
	
	public function setGroupId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = kshowPeer::GROUP_ID;
		}

	} 
	
	public function setPlays($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->plays !== $v || $v === 0) {
			$this->plays = $v;
			$this->modifiedColumns[] = kshowPeer::PLAYS;
		}

	} 
	
	public function setPartnerData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_data !== $v) {
			$this->partner_data = $v;
			$this->modifiedColumns[] = kshowPeer::PARTNER_DATA;
		}

	} 
	
	public function setIntId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->int_id !== $v) {
			$this->int_id = $v;
			$this->modifiedColumns[] = kshowPeer::INT_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->producer_id = $rs->getInt($startcol + 1);

			$this->episode_id = $rs->getString($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->subdomain = $rs->getString($startcol + 4);

			$this->description = $rs->getString($startcol + 5);

			$this->status = $rs->getInt($startcol + 6);

			$this->type = $rs->getInt($startcol + 7);

			$this->media_type = $rs->getInt($startcol + 8);

			$this->format_type = $rs->getInt($startcol + 9);

			$this->language = $rs->getInt($startcol + 10);

			$this->start_date = $rs->getDate($startcol + 11, null);

			$this->end_date = $rs->getDate($startcol + 12, null);

			$this->skin = $rs->getString($startcol + 13);

			$this->thumbnail = $rs->getString($startcol + 14);

			$this->show_entry_id = $rs->getString($startcol + 15);

			$this->intro_id = $rs->getInt($startcol + 16);

			$this->views = $rs->getInt($startcol + 17);

			$this->votes = $rs->getInt($startcol + 18);

			$this->comments = $rs->getInt($startcol + 19);

			$this->favorites = $rs->getInt($startcol + 20);

			$this->rank = $rs->getInt($startcol + 21);

			$this->entries = $rs->getInt($startcol + 22);

			$this->contributors = $rs->getInt($startcol + 23);

			$this->subscribers = $rs->getInt($startcol + 24);

			$this->number_of_updates = $rs->getInt($startcol + 25);

			$this->tags = $rs->getString($startcol + 26);

			$this->custom_data = $rs->getString($startcol + 27);

			$this->indexed_custom_data_1 = $rs->getInt($startcol + 28);

			$this->indexed_custom_data_2 = $rs->getInt($startcol + 29);

			$this->indexed_custom_data_3 = $rs->getString($startcol + 30);

			$this->reoccurence = $rs->getInt($startcol + 31);

			$this->license_type = $rs->getInt($startcol + 32);

			$this->length_in_msecs = $rs->getInt($startcol + 33);

			$this->view_permissions = $rs->getInt($startcol + 34);

			$this->view_password = $rs->getString($startcol + 35);

			$this->contrib_permissions = $rs->getInt($startcol + 36);

			$this->contrib_password = $rs->getString($startcol + 37);

			$this->edit_permissions = $rs->getInt($startcol + 38);

			$this->edit_password = $rs->getString($startcol + 39);

			$this->salt = $rs->getString($startcol + 40);

			$this->created_at = $rs->getTimestamp($startcol + 41, null);

			$this->updated_at = $rs->getTimestamp($startcol + 42, null);

			$this->partner_id = $rs->getInt($startcol + 43);

			$this->display_in_search = $rs->getInt($startcol + 44);

			$this->subp_id = $rs->getInt($startcol + 45);

			$this->search_text = $rs->getString($startcol + 46);

			$this->permissions = $rs->getString($startcol + 47);

			$this->group_id = $rs->getString($startcol + 48);

			$this->plays = $rs->getInt($startcol + 49);

			$this->partner_data = $rs->getString($startcol + 50);

			$this->int_id = $rs->getInt($startcol + 51);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 52; 
		} catch (Exception $e) {
			throw new PropelException("Error populating kshow object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kshowPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			kshowPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(kshowPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(kshowPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(kshowPeer::DATABASE_NAME);
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
					$pk = kshowPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += kshowPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collentrys !== null) {
				foreach($this->collentrys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collkvotesRelatedByKshowId !== null) {
				foreach($this->collkvotesRelatedByKshowId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collkvotesRelatedByKuserId !== null) {
				foreach($this->collkvotesRelatedByKuserId as $referrerFK) {
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

			if ($this->collPuserRoles !== null) {
				foreach($this->collPuserRoles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collroughcutEntrys !== null) {
				foreach($this->collroughcutEntrys as $referrerFK) {
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


												
			if ($this->akuser !== null) {
				if (!$this->akuser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->akuser->getValidationFailures());
				}
			}


			if (($retval = kshowPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collentrys !== null) {
					foreach($this->collentrys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collkvotesRelatedByKshowId !== null) {
					foreach($this->collkvotesRelatedByKshowId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collkvotesRelatedByKuserId !== null) {
					foreach($this->collkvotesRelatedByKuserId as $referrerFK) {
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

				if ($this->collPuserRoles !== null) {
					foreach($this->collPuserRoles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collroughcutEntrys !== null) {
					foreach($this->collroughcutEntrys as $referrerFK) {
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
		$pos = kshowPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProducerId();
				break;
			case 2:
				return $this->getEpisodeId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getSubdomain();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getType();
				break;
			case 8:
				return $this->getMediaType();
				break;
			case 9:
				return $this->getFormatType();
				break;
			case 10:
				return $this->getLanguage();
				break;
			case 11:
				return $this->getStartDate();
				break;
			case 12:
				return $this->getEndDate();
				break;
			case 13:
				return $this->getSkin();
				break;
			case 14:
				return $this->getThumbnail();
				break;
			case 15:
				return $this->getShowEntryId();
				break;
			case 16:
				return $this->getIntroId();
				break;
			case 17:
				return $this->getViews();
				break;
			case 18:
				return $this->getVotes();
				break;
			case 19:
				return $this->getComments();
				break;
			case 20:
				return $this->getFavorites();
				break;
			case 21:
				return $this->getRank();
				break;
			case 22:
				return $this->getEntries();
				break;
			case 23:
				return $this->getContributors();
				break;
			case 24:
				return $this->getSubscribers();
				break;
			case 25:
				return $this->getNumberOfUpdates();
				break;
			case 26:
				return $this->getTags();
				break;
			case 27:
				return $this->getCustomData();
				break;
			case 28:
				return $this->getIndexedCustomData1();
				break;
			case 29:
				return $this->getIndexedCustomData2();
				break;
			case 30:
				return $this->getIndexedCustomData3();
				break;
			case 31:
				return $this->getReoccurence();
				break;
			case 32:
				return $this->getLicenseType();
				break;
			case 33:
				return $this->getLengthInMsecs();
				break;
			case 34:
				return $this->getViewPermissions();
				break;
			case 35:
				return $this->getViewPassword();
				break;
			case 36:
				return $this->getContribPermissions();
				break;
			case 37:
				return $this->getContribPassword();
				break;
			case 38:
				return $this->getEditPermissions();
				break;
			case 39:
				return $this->getEditPassword();
				break;
			case 40:
				return $this->getSalt();
				break;
			case 41:
				return $this->getCreatedAt();
				break;
			case 42:
				return $this->getUpdatedAt();
				break;
			case 43:
				return $this->getPartnerId();
				break;
			case 44:
				return $this->getDisplayInSearch();
				break;
			case 45:
				return $this->getSubpId();
				break;
			case 46:
				return $this->getSearchText();
				break;
			case 47:
				return $this->getPermissions();
				break;
			case 48:
				return $this->getGroupId();
				break;
			case 49:
				return $this->getPlays();
				break;
			case 50:
				return $this->getPartnerData();
				break;
			case 51:
				return $this->getIntId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kshowPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProducerId(),
			$keys[2] => $this->getEpisodeId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getSubdomain(),
			$keys[5] => $this->getDescription(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getType(),
			$keys[8] => $this->getMediaType(),
			$keys[9] => $this->getFormatType(),
			$keys[10] => $this->getLanguage(),
			$keys[11] => $this->getStartDate(),
			$keys[12] => $this->getEndDate(),
			$keys[13] => $this->getSkin(),
			$keys[14] => $this->getThumbnail(),
			$keys[15] => $this->getShowEntryId(),
			$keys[16] => $this->getIntroId(),
			$keys[17] => $this->getViews(),
			$keys[18] => $this->getVotes(),
			$keys[19] => $this->getComments(),
			$keys[20] => $this->getFavorites(),
			$keys[21] => $this->getRank(),
			$keys[22] => $this->getEntries(),
			$keys[23] => $this->getContributors(),
			$keys[24] => $this->getSubscribers(),
			$keys[25] => $this->getNumberOfUpdates(),
			$keys[26] => $this->getTags(),
			$keys[27] => $this->getCustomData(),
			$keys[28] => $this->getIndexedCustomData1(),
			$keys[29] => $this->getIndexedCustomData2(),
			$keys[30] => $this->getIndexedCustomData3(),
			$keys[31] => $this->getReoccurence(),
			$keys[32] => $this->getLicenseType(),
			$keys[33] => $this->getLengthInMsecs(),
			$keys[34] => $this->getViewPermissions(),
			$keys[35] => $this->getViewPassword(),
			$keys[36] => $this->getContribPermissions(),
			$keys[37] => $this->getContribPassword(),
			$keys[38] => $this->getEditPermissions(),
			$keys[39] => $this->getEditPassword(),
			$keys[40] => $this->getSalt(),
			$keys[41] => $this->getCreatedAt(),
			$keys[42] => $this->getUpdatedAt(),
			$keys[43] => $this->getPartnerId(),
			$keys[44] => $this->getDisplayInSearch(),
			$keys[45] => $this->getSubpId(),
			$keys[46] => $this->getSearchText(),
			$keys[47] => $this->getPermissions(),
			$keys[48] => $this->getGroupId(),
			$keys[49] => $this->getPlays(),
			$keys[50] => $this->getPartnerData(),
			$keys[51] => $this->getIntId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = kshowPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProducerId($value);
				break;
			case 2:
				$this->setEpisodeId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setSubdomain($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setType($value);
				break;
			case 8:
				$this->setMediaType($value);
				break;
			case 9:
				$this->setFormatType($value);
				break;
			case 10:
				$this->setLanguage($value);
				break;
			case 11:
				$this->setStartDate($value);
				break;
			case 12:
				$this->setEndDate($value);
				break;
			case 13:
				$this->setSkin($value);
				break;
			case 14:
				$this->setThumbnail($value);
				break;
			case 15:
				$this->setShowEntryId($value);
				break;
			case 16:
				$this->setIntroId($value);
				break;
			case 17:
				$this->setViews($value);
				break;
			case 18:
				$this->setVotes($value);
				break;
			case 19:
				$this->setComments($value);
				break;
			case 20:
				$this->setFavorites($value);
				break;
			case 21:
				$this->setRank($value);
				break;
			case 22:
				$this->setEntries($value);
				break;
			case 23:
				$this->setContributors($value);
				break;
			case 24:
				$this->setSubscribers($value);
				break;
			case 25:
				$this->setNumberOfUpdates($value);
				break;
			case 26:
				$this->setTags($value);
				break;
			case 27:
				$this->setCustomData($value);
				break;
			case 28:
				$this->setIndexedCustomData1($value);
				break;
			case 29:
				$this->setIndexedCustomData2($value);
				break;
			case 30:
				$this->setIndexedCustomData3($value);
				break;
			case 31:
				$this->setReoccurence($value);
				break;
			case 32:
				$this->setLicenseType($value);
				break;
			case 33:
				$this->setLengthInMsecs($value);
				break;
			case 34:
				$this->setViewPermissions($value);
				break;
			case 35:
				$this->setViewPassword($value);
				break;
			case 36:
				$this->setContribPermissions($value);
				break;
			case 37:
				$this->setContribPassword($value);
				break;
			case 38:
				$this->setEditPermissions($value);
				break;
			case 39:
				$this->setEditPassword($value);
				break;
			case 40:
				$this->setSalt($value);
				break;
			case 41:
				$this->setCreatedAt($value);
				break;
			case 42:
				$this->setUpdatedAt($value);
				break;
			case 43:
				$this->setPartnerId($value);
				break;
			case 44:
				$this->setDisplayInSearch($value);
				break;
			case 45:
				$this->setSubpId($value);
				break;
			case 46:
				$this->setSearchText($value);
				break;
			case 47:
				$this->setPermissions($value);
				break;
			case 48:
				$this->setGroupId($value);
				break;
			case 49:
				$this->setPlays($value);
				break;
			case 50:
				$this->setPartnerData($value);
				break;
			case 51:
				$this->setIntId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = kshowPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProducerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEpisodeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSubdomain($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMediaType($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setFormatType($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLanguage($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStartDate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setEndDate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setSkin($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setThumbnail($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setShowEntryId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setIntroId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setViews($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setVotes($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setComments($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setFavorites($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setRank($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setEntries($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setContributors($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setSubscribers($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setNumberOfUpdates($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setTags($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCustomData($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setIndexedCustomData1($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setIndexedCustomData2($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setIndexedCustomData3($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setReoccurence($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setLicenseType($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setLengthInMsecs($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setViewPermissions($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setViewPassword($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setContribPermissions($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setContribPassword($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setEditPermissions($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setEditPassword($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setSalt($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setCreatedAt($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setUpdatedAt($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setPartnerId($arr[$keys[43]]);
		if (array_key_exists($keys[44], $arr)) $this->setDisplayInSearch($arr[$keys[44]]);
		if (array_key_exists($keys[45], $arr)) $this->setSubpId($arr[$keys[45]]);
		if (array_key_exists($keys[46], $arr)) $this->setSearchText($arr[$keys[46]]);
		if (array_key_exists($keys[47], $arr)) $this->setPermissions($arr[$keys[47]]);
		if (array_key_exists($keys[48], $arr)) $this->setGroupId($arr[$keys[48]]);
		if (array_key_exists($keys[49], $arr)) $this->setPlays($arr[$keys[49]]);
		if (array_key_exists($keys[50], $arr)) $this->setPartnerData($arr[$keys[50]]);
		if (array_key_exists($keys[51], $arr)) $this->setIntId($arr[$keys[51]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(kshowPeer::DATABASE_NAME);

		if ($this->isColumnModified(kshowPeer::ID)) $criteria->add(kshowPeer::ID, $this->id);
		if ($this->isColumnModified(kshowPeer::PRODUCER_ID)) $criteria->add(kshowPeer::PRODUCER_ID, $this->producer_id);
		if ($this->isColumnModified(kshowPeer::EPISODE_ID)) $criteria->add(kshowPeer::EPISODE_ID, $this->episode_id);
		if ($this->isColumnModified(kshowPeer::NAME)) $criteria->add(kshowPeer::NAME, $this->name);
		if ($this->isColumnModified(kshowPeer::SUBDOMAIN)) $criteria->add(kshowPeer::SUBDOMAIN, $this->subdomain);
		if ($this->isColumnModified(kshowPeer::DESCRIPTION)) $criteria->add(kshowPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(kshowPeer::STATUS)) $criteria->add(kshowPeer::STATUS, $this->status);
		if ($this->isColumnModified(kshowPeer::TYPE)) $criteria->add(kshowPeer::TYPE, $this->type);
		if ($this->isColumnModified(kshowPeer::MEDIA_TYPE)) $criteria->add(kshowPeer::MEDIA_TYPE, $this->media_type);
		if ($this->isColumnModified(kshowPeer::FORMAT_TYPE)) $criteria->add(kshowPeer::FORMAT_TYPE, $this->format_type);
		if ($this->isColumnModified(kshowPeer::LANGUAGE)) $criteria->add(kshowPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(kshowPeer::START_DATE)) $criteria->add(kshowPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(kshowPeer::END_DATE)) $criteria->add(kshowPeer::END_DATE, $this->end_date);
		if ($this->isColumnModified(kshowPeer::SKIN)) $criteria->add(kshowPeer::SKIN, $this->skin);
		if ($this->isColumnModified(kshowPeer::THUMBNAIL)) $criteria->add(kshowPeer::THUMBNAIL, $this->thumbnail);
		if ($this->isColumnModified(kshowPeer::SHOW_ENTRY_ID)) $criteria->add(kshowPeer::SHOW_ENTRY_ID, $this->show_entry_id);
		if ($this->isColumnModified(kshowPeer::INTRO_ID)) $criteria->add(kshowPeer::INTRO_ID, $this->intro_id);
		if ($this->isColumnModified(kshowPeer::VIEWS)) $criteria->add(kshowPeer::VIEWS, $this->views);
		if ($this->isColumnModified(kshowPeer::VOTES)) $criteria->add(kshowPeer::VOTES, $this->votes);
		if ($this->isColumnModified(kshowPeer::COMMENTS)) $criteria->add(kshowPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(kshowPeer::FAVORITES)) $criteria->add(kshowPeer::FAVORITES, $this->favorites);
		if ($this->isColumnModified(kshowPeer::RANK)) $criteria->add(kshowPeer::RANK, $this->rank);
		if ($this->isColumnModified(kshowPeer::ENTRIES)) $criteria->add(kshowPeer::ENTRIES, $this->entries);
		if ($this->isColumnModified(kshowPeer::CONTRIBUTORS)) $criteria->add(kshowPeer::CONTRIBUTORS, $this->contributors);
		if ($this->isColumnModified(kshowPeer::SUBSCRIBERS)) $criteria->add(kshowPeer::SUBSCRIBERS, $this->subscribers);
		if ($this->isColumnModified(kshowPeer::NUMBER_OF_UPDATES)) $criteria->add(kshowPeer::NUMBER_OF_UPDATES, $this->number_of_updates);
		if ($this->isColumnModified(kshowPeer::TAGS)) $criteria->add(kshowPeer::TAGS, $this->tags);
		if ($this->isColumnModified(kshowPeer::CUSTOM_DATA)) $criteria->add(kshowPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(kshowPeer::INDEXED_CUSTOM_DATA_1)) $criteria->add(kshowPeer::INDEXED_CUSTOM_DATA_1, $this->indexed_custom_data_1);
		if ($this->isColumnModified(kshowPeer::INDEXED_CUSTOM_DATA_2)) $criteria->add(kshowPeer::INDEXED_CUSTOM_DATA_2, $this->indexed_custom_data_2);
		if ($this->isColumnModified(kshowPeer::INDEXED_CUSTOM_DATA_3)) $criteria->add(kshowPeer::INDEXED_CUSTOM_DATA_3, $this->indexed_custom_data_3);
		if ($this->isColumnModified(kshowPeer::REOCCURENCE)) $criteria->add(kshowPeer::REOCCURENCE, $this->reoccurence);
		if ($this->isColumnModified(kshowPeer::LICENSE_TYPE)) $criteria->add(kshowPeer::LICENSE_TYPE, $this->license_type);
		if ($this->isColumnModified(kshowPeer::LENGTH_IN_MSECS)) $criteria->add(kshowPeer::LENGTH_IN_MSECS, $this->length_in_msecs);
		if ($this->isColumnModified(kshowPeer::VIEW_PERMISSIONS)) $criteria->add(kshowPeer::VIEW_PERMISSIONS, $this->view_permissions);
		if ($this->isColumnModified(kshowPeer::VIEW_PASSWORD)) $criteria->add(kshowPeer::VIEW_PASSWORD, $this->view_password);
		if ($this->isColumnModified(kshowPeer::CONTRIB_PERMISSIONS)) $criteria->add(kshowPeer::CONTRIB_PERMISSIONS, $this->contrib_permissions);
		if ($this->isColumnModified(kshowPeer::CONTRIB_PASSWORD)) $criteria->add(kshowPeer::CONTRIB_PASSWORD, $this->contrib_password);
		if ($this->isColumnModified(kshowPeer::EDIT_PERMISSIONS)) $criteria->add(kshowPeer::EDIT_PERMISSIONS, $this->edit_permissions);
		if ($this->isColumnModified(kshowPeer::EDIT_PASSWORD)) $criteria->add(kshowPeer::EDIT_PASSWORD, $this->edit_password);
		if ($this->isColumnModified(kshowPeer::SALT)) $criteria->add(kshowPeer::SALT, $this->salt);
		if ($this->isColumnModified(kshowPeer::CREATED_AT)) $criteria->add(kshowPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(kshowPeer::UPDATED_AT)) $criteria->add(kshowPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(kshowPeer::PARTNER_ID)) $criteria->add(kshowPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(kshowPeer::DISPLAY_IN_SEARCH)) $criteria->add(kshowPeer::DISPLAY_IN_SEARCH, $this->display_in_search);
		if ($this->isColumnModified(kshowPeer::SUBP_ID)) $criteria->add(kshowPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(kshowPeer::SEARCH_TEXT)) $criteria->add(kshowPeer::SEARCH_TEXT, $this->search_text);
		if ($this->isColumnModified(kshowPeer::PERMISSIONS)) $criteria->add(kshowPeer::PERMISSIONS, $this->permissions);
		if ($this->isColumnModified(kshowPeer::GROUP_ID)) $criteria->add(kshowPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(kshowPeer::PLAYS)) $criteria->add(kshowPeer::PLAYS, $this->plays);
		if ($this->isColumnModified(kshowPeer::PARTNER_DATA)) $criteria->add(kshowPeer::PARTNER_DATA, $this->partner_data);
		if ($this->isColumnModified(kshowPeer::INT_ID)) $criteria->add(kshowPeer::INT_ID, $this->int_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(kshowPeer::DATABASE_NAME);

		$criteria->add(kshowPeer::ID, $this->id);

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

		$copyObj->setProducerId($this->producer_id);

		$copyObj->setEpisodeId($this->episode_id);

		$copyObj->setName($this->name);

		$copyObj->setSubdomain($this->subdomain);

		$copyObj->setDescription($this->description);

		$copyObj->setStatus($this->status);

		$copyObj->setType($this->type);

		$copyObj->setMediaType($this->media_type);

		$copyObj->setFormatType($this->format_type);

		$copyObj->setLanguage($this->language);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setEndDate($this->end_date);

		$copyObj->setSkin($this->skin);

		$copyObj->setThumbnail($this->thumbnail);

		$copyObj->setShowEntryId($this->show_entry_id);

		$copyObj->setIntroId($this->intro_id);

		$copyObj->setViews($this->views);

		$copyObj->setVotes($this->votes);

		$copyObj->setComments($this->comments);

		$copyObj->setFavorites($this->favorites);

		$copyObj->setRank($this->rank);

		$copyObj->setEntries($this->entries);

		$copyObj->setContributors($this->contributors);

		$copyObj->setSubscribers($this->subscribers);

		$copyObj->setNumberOfUpdates($this->number_of_updates);

		$copyObj->setTags($this->tags);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setIndexedCustomData1($this->indexed_custom_data_1);

		$copyObj->setIndexedCustomData2($this->indexed_custom_data_2);

		$copyObj->setIndexedCustomData3($this->indexed_custom_data_3);

		$copyObj->setReoccurence($this->reoccurence);

		$copyObj->setLicenseType($this->license_type);

		$copyObj->setLengthInMsecs($this->length_in_msecs);

		$copyObj->setViewPermissions($this->view_permissions);

		$copyObj->setViewPassword($this->view_password);

		$copyObj->setContribPermissions($this->contrib_permissions);

		$copyObj->setContribPassword($this->contrib_password);

		$copyObj->setEditPermissions($this->edit_permissions);

		$copyObj->setEditPassword($this->edit_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setDisplayInSearch($this->display_in_search);

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setSearchText($this->search_text);

		$copyObj->setPermissions($this->permissions);

		$copyObj->setGroupId($this->group_id);

		$copyObj->setPlays($this->plays);

		$copyObj->setPartnerData($this->partner_data);

		$copyObj->setIntId($this->int_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getentrys() as $relObj) {
				$copyObj->addentry($relObj->copy($deepCopy));
			}

			foreach($this->getkvotesRelatedByKshowId() as $relObj) {
				$copyObj->addkvoteRelatedByKshowId($relObj->copy($deepCopy));
			}

			foreach($this->getkvotesRelatedByKuserId() as $relObj) {
				$copyObj->addkvoteRelatedByKuserId($relObj->copy($deepCopy));
			}

			foreach($this->getKshowKusers() as $relObj) {
				$copyObj->addKshowKuser($relObj->copy($deepCopy));
			}

			foreach($this->getPuserRoles() as $relObj) {
				$copyObj->addPuserRole($relObj->copy($deepCopy));
			}

			foreach($this->getroughcutEntrys() as $relObj) {
				$copyObj->addroughcutEntry($relObj->copy($deepCopy));
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
			self::$peer = new kshowPeer();
		}
		return self::$peer;
	}

	
	public function setkuser($v)
	{


		if ($v === null) {
			$this->setProducerId(NULL);
		} else {
			$this->setProducerId($v->getId());
		}


		$this->akuser = $v;
	}


	
	public function getkuser($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuser === null && ($this->producer_id !== null)) {

			$this->akuser = kuserPeer::retrieveByPK($this->producer_id, $con);

			
		}
		return $this->akuser;
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

				$criteria->add(entryPeer::KSHOW_ID, $this->getId());

				entryPeer::addSelectColumns($criteria);
				$this->collentrys = entryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(entryPeer::KSHOW_ID, $this->getId());

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

		$criteria->add(entryPeer::KSHOW_ID, $this->getId());

		return entryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addentry(entry $l)
	{
		$this->collentrys[] = $l;
		$l->setkshow($this);
	}


	
	public function getentrysJoinkuser($criteria = null, $con = null)
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

				$criteria->add(entryPeer::KSHOW_ID, $this->getId());

				$this->collentrys = entryPeer::doSelectJoinkuser($criteria, $con);
			}
		} else {
									
			$criteria->add(entryPeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastentryCriteria) || !$this->lastentryCriteria->equals($criteria)) {
				$this->collentrys = entryPeer::doSelectJoinkuser($criteria, $con);
			}
		}
		$this->lastentryCriteria = $criteria;

		return $this->collentrys;
	}

	
	public function initkvotesRelatedByKshowId()
	{
		if ($this->collkvotesRelatedByKshowId === null) {
			$this->collkvotesRelatedByKshowId = array();
		}
	}

	
	public function getkvotesRelatedByKshowId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotesRelatedByKshowId === null) {
			if ($this->isNew()) {
			   $this->collkvotesRelatedByKshowId = array();
			} else {

				$criteria->add(kvotePeer::KSHOW_ID, $this->getId());

				kvotePeer::addSelectColumns($criteria);
				$this->collkvotesRelatedByKshowId = kvotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(kvotePeer::KSHOW_ID, $this->getId());

				kvotePeer::addSelectColumns($criteria);
				if (!isset($this->lastkvoteRelatedByKshowIdCriteria) || !$this->lastkvoteRelatedByKshowIdCriteria->equals($criteria)) {
					$this->collkvotesRelatedByKshowId = kvotePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastkvoteRelatedByKshowIdCriteria = $criteria;
		return $this->collkvotesRelatedByKshowId;
	}

	
	public function countkvotesRelatedByKshowId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(kvotePeer::KSHOW_ID, $this->getId());

		return kvotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addkvoteRelatedByKshowId(kvote $l)
	{
		$this->collkvotesRelatedByKshowId[] = $l;
		$l->setkshowRelatedByKshowId($this);
	}


	
	public function getkvotesRelatedByKshowIdJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotesRelatedByKshowId === null) {
			if ($this->isNew()) {
				$this->collkvotesRelatedByKshowId = array();
			} else {

				$criteria->add(kvotePeer::KSHOW_ID, $this->getId());

				$this->collkvotesRelatedByKshowId = kvotePeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(kvotePeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastkvoteRelatedByKshowIdCriteria) || !$this->lastkvoteRelatedByKshowIdCriteria->equals($criteria)) {
				$this->collkvotesRelatedByKshowId = kvotePeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastkvoteRelatedByKshowIdCriteria = $criteria;

		return $this->collkvotesRelatedByKshowId;
	}

	
	public function initkvotesRelatedByKuserId()
	{
		if ($this->collkvotesRelatedByKuserId === null) {
			$this->collkvotesRelatedByKuserId = array();
		}
	}

	
	public function getkvotesRelatedByKuserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotesRelatedByKuserId === null) {
			if ($this->isNew()) {
			   $this->collkvotesRelatedByKuserId = array();
			} else {

				$criteria->add(kvotePeer::KUSER_ID, $this->getId());

				kvotePeer::addSelectColumns($criteria);
				$this->collkvotesRelatedByKuserId = kvotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(kvotePeer::KUSER_ID, $this->getId());

				kvotePeer::addSelectColumns($criteria);
				if (!isset($this->lastkvoteRelatedByKuserIdCriteria) || !$this->lastkvoteRelatedByKuserIdCriteria->equals($criteria)) {
					$this->collkvotesRelatedByKuserId = kvotePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastkvoteRelatedByKuserIdCriteria = $criteria;
		return $this->collkvotesRelatedByKuserId;
	}

	
	public function countkvotesRelatedByKuserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(kvotePeer::KUSER_ID, $this->getId());

		return kvotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addkvoteRelatedByKuserId(kvote $l)
	{
		$this->collkvotesRelatedByKuserId[] = $l;
		$l->setkshowRelatedByKuserId($this);
	}


	
	public function getkvotesRelatedByKuserIdJoinentry($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasekvotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collkvotesRelatedByKuserId === null) {
			if ($this->isNew()) {
				$this->collkvotesRelatedByKuserId = array();
			} else {

				$criteria->add(kvotePeer::KUSER_ID, $this->getId());

				$this->collkvotesRelatedByKuserId = kvotePeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(kvotePeer::KUSER_ID, $this->getId());

			if (!isset($this->lastkvoteRelatedByKuserIdCriteria) || !$this->lastkvoteRelatedByKuserIdCriteria->equals($criteria)) {
				$this->collkvotesRelatedByKuserId = kvotePeer::doSelectJoinentry($criteria, $con);
			}
		}
		$this->lastkvoteRelatedByKuserIdCriteria = $criteria;

		return $this->collkvotesRelatedByKuserId;
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

				$criteria->add(KshowKuserPeer::KSHOW_ID, $this->getId());

				KshowKuserPeer::addSelectColumns($criteria);
				$this->collKshowKusers = KshowKuserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KshowKuserPeer::KSHOW_ID, $this->getId());

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

		$criteria->add(KshowKuserPeer::KSHOW_ID, $this->getId());

		return KshowKuserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addKshowKuser(KshowKuser $l)
	{
		$this->collKshowKusers[] = $l;
		$l->setkshow($this);
	}


	
	public function getKshowKusersJoinkuser($criteria = null, $con = null)
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

				$criteria->add(KshowKuserPeer::KSHOW_ID, $this->getId());

				$this->collKshowKusers = KshowKuserPeer::doSelectJoinkuser($criteria, $con);
			}
		} else {
									
			$criteria->add(KshowKuserPeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastKshowKuserCriteria) || !$this->lastKshowKuserCriteria->equals($criteria)) {
				$this->collKshowKusers = KshowKuserPeer::doSelectJoinkuser($criteria, $con);
			}
		}
		$this->lastKshowKuserCriteria = $criteria;

		return $this->collKshowKusers;
	}

	
	public function initPuserRoles()
	{
		if ($this->collPuserRoles === null) {
			$this->collPuserRoles = array();
		}
	}

	
	public function getPuserRoles($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRoles === null) {
			if ($this->isNew()) {
			   $this->collPuserRoles = array();
			} else {

				$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

				PuserRolePeer::addSelectColumns($criteria);
				$this->collPuserRoles = PuserRolePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

				PuserRolePeer::addSelectColumns($criteria);
				if (!isset($this->lastPuserRoleCriteria) || !$this->lastPuserRoleCriteria->equals($criteria)) {
					$this->collPuserRoles = PuserRolePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPuserRoleCriteria = $criteria;
		return $this->collPuserRoles;
	}

	
	public function countPuserRoles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

		return PuserRolePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPuserRole(PuserRole $l)
	{
		$this->collPuserRoles[] = $l;
		$l->setkshow($this);
	}


	
	public function getPuserRolesJoinPuserKuserRelatedByPartnerId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRoles === null) {
			if ($this->isNew()) {
				$this->collPuserRoles = array();
			} else {

				$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

				$this->collPuserRoles = PuserRolePeer::doSelectJoinPuserKuserRelatedByPartnerId($criteria, $con);
			}
		} else {
									
			$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastPuserRoleCriteria) || !$this->lastPuserRoleCriteria->equals($criteria)) {
				$this->collPuserRoles = PuserRolePeer::doSelectJoinPuserKuserRelatedByPartnerId($criteria, $con);
			}
		}
		$this->lastPuserRoleCriteria = $criteria;

		return $this->collPuserRoles;
	}


	
	public function getPuserRolesJoinPuserKuserRelatedByPuserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePuserRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPuserRoles === null) {
			if ($this->isNew()) {
				$this->collPuserRoles = array();
			} else {

				$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

				$this->collPuserRoles = PuserRolePeer::doSelectJoinPuserKuserRelatedByPuserId($criteria, $con);
			}
		} else {
									
			$criteria->add(PuserRolePeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastPuserRoleCriteria) || !$this->lastPuserRoleCriteria->equals($criteria)) {
				$this->collPuserRoles = PuserRolePeer::doSelectJoinPuserKuserRelatedByPuserId($criteria, $con);
			}
		}
		$this->lastPuserRoleCriteria = $criteria;

		return $this->collPuserRoles;
	}

	
	public function initroughcutEntrys()
	{
		if ($this->collroughcutEntrys === null) {
			$this->collroughcutEntrys = array();
		}
	}

	
	public function getroughcutEntrys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrys === null) {
			if ($this->isNew()) {
			   $this->collroughcutEntrys = array();
			} else {

				$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

				roughcutEntryPeer::addSelectColumns($criteria);
				$this->collroughcutEntrys = roughcutEntryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

				roughcutEntryPeer::addSelectColumns($criteria);
				if (!isset($this->lastroughcutEntryCriteria) || !$this->lastroughcutEntryCriteria->equals($criteria)) {
					$this->collroughcutEntrys = roughcutEntryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastroughcutEntryCriteria = $criteria;
		return $this->collroughcutEntrys;
	}

	
	public function countroughcutEntrys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

		return roughcutEntryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addroughcutEntry(roughcutEntry $l)
	{
		$this->collroughcutEntrys[] = $l;
		$l->setkshow($this);
	}


	
	public function getroughcutEntrysJoinentryRelatedByRoughcutId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrys === null) {
			if ($this->isNew()) {
				$this->collroughcutEntrys = array();
			} else {

				$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

				$this->collroughcutEntrys = roughcutEntryPeer::doSelectJoinentryRelatedByRoughcutId($criteria, $con);
			}
		} else {
									
			$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

			if (!isset($this->lastroughcutEntryCriteria) || !$this->lastroughcutEntryCriteria->equals($criteria)) {
				$this->collroughcutEntrys = roughcutEntryPeer::doSelectJoinentryRelatedByRoughcutId($criteria, $con);
			}
		}
		$this->lastroughcutEntryCriteria = $criteria;

		return $this->collroughcutEntrys;
	}


	
	public function getroughcutEntrysJoinentryRelatedByEntryId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseroughcutEntryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collroughcutEntrys === null) {
			if ($this->isNew()) {
				$this->collroughcutEntrys = array();
			} else {

				$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

				$this->collroughcutEntrys = roughcutEntryPeer::doSelectJoinentryRelatedByEntryId($criteria, $con);
			}
		} else {
									
			$criteria->add(roughcutEntryPeer::ROUGHCUT_KSHOW_ID, $this->getId());

			if (!isset($this->lastroughcutEntryCriteria) || !$this->lastroughcutEntryCriteria->equals($criteria)) {
				$this->collroughcutEntrys = roughcutEntryPeer::doSelectJoinentryRelatedByEntryId($criteria, $con);
			}
		}
		$this->lastroughcutEntryCriteria = $criteria;

		return $this->collroughcutEntrys;
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

				$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

				widgetPeer::addSelectColumns($criteria);
				$this->collwidgets = widgetPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

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

		$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

		return widgetPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addwidget(widget $l)
	{
		$this->collwidgets[] = $l;
		$l->setkshow($this);
	}


	
	public function getwidgetsJoinentry($criteria = null, $con = null)
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

				$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

				$this->collwidgets = widgetPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastwidgetCriteria) || !$this->lastwidgetCriteria->equals($criteria)) {
				$this->collwidgets = widgetPeer::doSelectJoinentry($criteria, $con);
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

				$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

				$this->collwidgets = widgetPeer::doSelectJoinuiConf($criteria, $con);
			}
		} else {
									
			$criteria->add(widgetPeer::KSHOW_ID, $this->getId());

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

				$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

				KwidgetLogPeer::addSelectColumns($criteria);
				$this->collKwidgetLogs = KwidgetLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

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

		$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

		return KwidgetLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addKwidgetLog(KwidgetLog $l)
	{
		$this->collKwidgetLogs[] = $l;
		$l->setkshow($this);
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

				$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinwidget($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinwidget($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}


	
	public function getKwidgetLogsJoinentry($criteria = null, $con = null)
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

				$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinentry($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinentry($criteria, $con);
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

				$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinuiConf($criteria, $con);
			}
		} else {
									
			$criteria->add(KwidgetLogPeer::KSHOW_ID, $this->getId());

			if (!isset($this->lastKwidgetLogCriteria) || !$this->lastKwidgetLogCriteria->equals($criteria)) {
				$this->collKwidgetLogs = KwidgetLogPeer::doSelectJoinuiConf($criteria, $con);
			}
		}
		$this->lastKwidgetLogCriteria = $criteria;

		return $this->collKwidgetLogs;
	}

} 