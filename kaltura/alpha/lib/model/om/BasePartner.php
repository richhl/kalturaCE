<?php


abstract class BasePartner extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $partner_name;


	
	protected $partner_alias;


	
	protected $url1;


	
	protected $url2;


	
	protected $secret;


	
	protected $admin_secret;


	
	protected $max_number_of_hits_per_day = -1;


	
	protected $appear_in_search = 2;


	
	protected $debug_level = 0;


	
	protected $invalid_login_count = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $anonymous_kuser_id;


	
	protected $ks_max_expiry_in_seconds = 86400;


	
	protected $create_user_on_demand = 1;


	
	protected $prefix;


	
	protected $admin_name;


	
	protected $admin_email;


	
	protected $description;


	
	protected $commercial_use = 0;


	
	protected $moderate_content = 0;


	
	protected $notify = 0;


	
	protected $custom_data;


	
	protected $service_config_id;


	
	protected $status = 1;


	
	protected $content_categories;


	
	protected $type = 1;


	
	protected $phone;


	
	protected $describe_yourself;


	
	protected $adult_content = 0;


	
	protected $partner_package = 1;


	
	protected $usage_percent = 0;


	
	protected $storage_usage = 0;


	
	protected $eighty_percent_warning;


	
	protected $usage_limit_warning;

	
	protected $akuser;

	
	protected $colladminKusers;

	
	protected $lastadminKuserCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPartnerName()
	{

		return $this->partner_name;
	}

	
	public function getPartnerAlias()
	{

		return $this->partner_alias;
	}

	
	public function getUrl1()
	{

		return $this->url1;
	}

	
	public function getUrl2()
	{

		return $this->url2;
	}

	
	public function getSecret()
	{

		return $this->secret;
	}

	
	public function getAdminSecret()
	{

		return $this->admin_secret;
	}

	
	public function getMaxNumberOfHitsPerDay()
	{

		return $this->max_number_of_hits_per_day;
	}

	
	public function getAppearInSearch()
	{

		return $this->appear_in_search;
	}

	
	public function getDebugLevel()
	{

		return $this->debug_level;
	}

	
	public function getInvalidLoginCount()
	{

		return $this->invalid_login_count;
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

	
	public function getAnonymousKuserId()
	{

		return $this->anonymous_kuser_id;
	}

	
	public function getKsMaxExpiryInSeconds()
	{

		return $this->ks_max_expiry_in_seconds;
	}

	
	public function getCreateUserOnDemand()
	{

		return $this->create_user_on_demand;
	}

	
	public function getPrefix()
	{

		return $this->prefix;
	}

	
	public function getAdminName()
	{

		return $this->admin_name;
	}

	
	public function getAdminEmail()
	{

		return $this->admin_email;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getCommercialUse()
	{

		return $this->commercial_use;
	}

	
	public function getModerateContent()
	{

		return $this->moderate_content;
	}

	
	public function getNotify()
	{

		return $this->notify;
	}

	
	public function getCustomData()
	{

		return $this->custom_data;
	}

	
	public function getServiceConfigId()
	{

		return $this->service_config_id;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getContentCategories()
	{

		return $this->content_categories;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getPhone()
	{

		return $this->phone;
	}

	
	public function getDescribeYourself()
	{

		return $this->describe_yourself;
	}

	
	public function getAdultContent()
	{

		return $this->adult_content;
	}

	
	public function getPartnerPackage()
	{

		return $this->partner_package;
	}

	
	public function getUsagePercent()
	{

		return $this->usage_percent;
	}

	
	public function getStorageUsage()
	{

		return $this->storage_usage;
	}

	
	public function getEightyPercentWarning()
	{

		return $this->eighty_percent_warning;
	}

	
	public function getUsageLimitWarning()
	{

		return $this->usage_limit_warning;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PartnerPeer::ID;
		}

	} 
	
	public function setPartnerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_name !== $v) {
			$this->partner_name = $v;
			$this->modifiedColumns[] = PartnerPeer::PARTNER_NAME;
		}

	} 
	
	public function setPartnerAlias($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partner_alias !== $v) {
			$this->partner_alias = $v;
			$this->modifiedColumns[] = PartnerPeer::PARTNER_ALIAS;
		}

	} 
	
	public function setUrl1($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url1 !== $v) {
			$this->url1 = $v;
			$this->modifiedColumns[] = PartnerPeer::URL1;
		}

	} 
	
	public function setUrl2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url2 !== $v) {
			$this->url2 = $v;
			$this->modifiedColumns[] = PartnerPeer::URL2;
		}

	} 
	
	public function setSecret($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secret !== $v) {
			$this->secret = $v;
			$this->modifiedColumns[] = PartnerPeer::SECRET;
		}

	} 
	
	public function setAdminSecret($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->admin_secret !== $v) {
			$this->admin_secret = $v;
			$this->modifiedColumns[] = PartnerPeer::ADMIN_SECRET;
		}

	} 
	
	public function setMaxNumberOfHitsPerDay($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->max_number_of_hits_per_day !== $v || $v === -1) {
			$this->max_number_of_hits_per_day = $v;
			$this->modifiedColumns[] = PartnerPeer::MAX_NUMBER_OF_HITS_PER_DAY;
		}

	} 
	
	public function setAppearInSearch($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->appear_in_search !== $v || $v === 2) {
			$this->appear_in_search = $v;
			$this->modifiedColumns[] = PartnerPeer::APPEAR_IN_SEARCH;
		}

	} 
	
	public function setDebugLevel($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->debug_level !== $v || $v === 0) {
			$this->debug_level = $v;
			$this->modifiedColumns[] = PartnerPeer::DEBUG_LEVEL;
		}

	} 
	
	public function setInvalidLoginCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->invalid_login_count !== $v || $v === 0) {
			$this->invalid_login_count = $v;
			$this->modifiedColumns[] = PartnerPeer::INVALID_LOGIN_COUNT;
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
			$this->modifiedColumns[] = PartnerPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PartnerPeer::UPDATED_AT;
		}

	} 
	
	public function setAnonymousKuserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->anonymous_kuser_id !== $v) {
			$this->anonymous_kuser_id = $v;
			$this->modifiedColumns[] = PartnerPeer::ANONYMOUS_KUSER_ID;
		}

		if ($this->akuser !== null && $this->akuser->getId() !== $v) {
			$this->akuser = null;
		}

	} 
	
	public function setKsMaxExpiryInSeconds($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ks_max_expiry_in_seconds !== $v || $v === 86400) {
			$this->ks_max_expiry_in_seconds = $v;
			$this->modifiedColumns[] = PartnerPeer::KS_MAX_EXPIRY_IN_SECONDS;
		}

	} 
	
	public function setCreateUserOnDemand($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->create_user_on_demand !== $v || $v === 1) {
			$this->create_user_on_demand = $v;
			$this->modifiedColumns[] = PartnerPeer::CREATE_USER_ON_DEMAND;
		}

	} 
	
	public function setPrefix($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prefix !== $v) {
			$this->prefix = $v;
			$this->modifiedColumns[] = PartnerPeer::PREFIX;
		}

	} 
	
	public function setAdminName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->admin_name !== $v) {
			$this->admin_name = $v;
			$this->modifiedColumns[] = PartnerPeer::ADMIN_NAME;
		}

	} 
	
	public function setAdminEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->admin_email !== $v) {
			$this->admin_email = $v;
			$this->modifiedColumns[] = PartnerPeer::ADMIN_EMAIL;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = PartnerPeer::DESCRIPTION;
		}

	} 
	
	public function setCommercialUse($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->commercial_use !== $v || $v === 0) {
			$this->commercial_use = $v;
			$this->modifiedColumns[] = PartnerPeer::COMMERCIAL_USE;
		}

	} 
	
	public function setModerateContent($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->moderate_content !== $v || $v === 0) {
			$this->moderate_content = $v;
			$this->modifiedColumns[] = PartnerPeer::MODERATE_CONTENT;
		}

	} 
	
	public function setNotify($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->notify !== $v || $v === 0) {
			$this->notify = $v;
			$this->modifiedColumns[] = PartnerPeer::NOTIFY;
		}

	} 
	
	public function setCustomData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_data !== $v) {
			$this->custom_data = $v;
			$this->modifiedColumns[] = PartnerPeer::CUSTOM_DATA;
		}

	} 
	
	public function setServiceConfigId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->service_config_id !== $v) {
			$this->service_config_id = $v;
			$this->modifiedColumns[] = PartnerPeer::SERVICE_CONFIG_ID;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v || $v === 1) {
			$this->status = $v;
			$this->modifiedColumns[] = PartnerPeer::STATUS;
		}

	} 
	
	public function setContentCategories($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content_categories !== $v) {
			$this->content_categories = $v;
			$this->modifiedColumns[] = PartnerPeer::CONTENT_CATEGORIES;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v || $v === 1) {
			$this->type = $v;
			$this->modifiedColumns[] = PartnerPeer::TYPE;
		}

	} 
	
	public function setPhone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = PartnerPeer::PHONE;
		}

	} 
	
	public function setDescribeYourself($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->describe_yourself !== $v) {
			$this->describe_yourself = $v;
			$this->modifiedColumns[] = PartnerPeer::DESCRIBE_YOURSELF;
		}

	} 
	
	public function setAdultContent($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->adult_content !== $v || $v === 0) {
			$this->adult_content = $v;
			$this->modifiedColumns[] = PartnerPeer::ADULT_CONTENT;
		}

	} 
	
	public function setPartnerPackage($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_package !== $v || $v === 1) {
			$this->partner_package = $v;
			$this->modifiedColumns[] = PartnerPeer::PARTNER_PACKAGE;
		}

	} 
	
	public function setUsagePercent($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->usage_percent !== $v || $v === 0) {
			$this->usage_percent = $v;
			$this->modifiedColumns[] = PartnerPeer::USAGE_PERCENT;
		}

	} 
	
	public function setStorageUsage($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->storage_usage !== $v || $v === 0) {
			$this->storage_usage = $v;
			$this->modifiedColumns[] = PartnerPeer::STORAGE_USAGE;
		}

	} 
	
	public function setEightyPercentWarning($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->eighty_percent_warning !== $v) {
			$this->eighty_percent_warning = $v;
			$this->modifiedColumns[] = PartnerPeer::EIGHTY_PERCENT_WARNING;
		}

	} 
	
	public function setUsageLimitWarning($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->usage_limit_warning !== $v) {
			$this->usage_limit_warning = $v;
			$this->modifiedColumns[] = PartnerPeer::USAGE_LIMIT_WARNING;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->partner_name = $rs->getString($startcol + 1);

			$this->partner_alias = $rs->getString($startcol + 2);

			$this->url1 = $rs->getString($startcol + 3);

			$this->url2 = $rs->getString($startcol + 4);

			$this->secret = $rs->getString($startcol + 5);

			$this->admin_secret = $rs->getString($startcol + 6);

			$this->max_number_of_hits_per_day = $rs->getInt($startcol + 7);

			$this->appear_in_search = $rs->getInt($startcol + 8);

			$this->debug_level = $rs->getInt($startcol + 9);

			$this->invalid_login_count = $rs->getInt($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->anonymous_kuser_id = $rs->getInt($startcol + 13);

			$this->ks_max_expiry_in_seconds = $rs->getInt($startcol + 14);

			$this->create_user_on_demand = $rs->getInt($startcol + 15);

			$this->prefix = $rs->getString($startcol + 16);

			$this->admin_name = $rs->getString($startcol + 17);

			$this->admin_email = $rs->getString($startcol + 18);

			$this->description = $rs->getString($startcol + 19);

			$this->commercial_use = $rs->getInt($startcol + 20);

			$this->moderate_content = $rs->getInt($startcol + 21);

			$this->notify = $rs->getInt($startcol + 22);

			$this->custom_data = $rs->getString($startcol + 23);

			$this->service_config_id = $rs->getString($startcol + 24);

			$this->status = $rs->getInt($startcol + 25);

			$this->content_categories = $rs->getString($startcol + 26);

			$this->type = $rs->getInt($startcol + 27);

			$this->phone = $rs->getString($startcol + 28);

			$this->describe_yourself = $rs->getString($startcol + 29);

			$this->adult_content = $rs->getInt($startcol + 30);

			$this->partner_package = $rs->getInt($startcol + 31);

			$this->usage_percent = $rs->getInt($startcol + 32);

			$this->storage_usage = $rs->getInt($startcol + 33);

			$this->eighty_percent_warning = $rs->getInt($startcol + 34);

			$this->usage_limit_warning = $rs->getInt($startcol + 35);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 36; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Partner object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PartnerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PartnerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PartnerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PartnerPeer::DATABASE_NAME);
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
					$pk = PartnerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PartnerPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->colladminKusers !== null) {
				foreach($this->colladminKusers as $referrerFK) {
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


			if (($retval = PartnerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->colladminKusers !== null) {
					foreach($this->colladminKusers as $referrerFK) {
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
		$pos = PartnerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPartnerName();
				break;
			case 2:
				return $this->getPartnerAlias();
				break;
			case 3:
				return $this->getUrl1();
				break;
			case 4:
				return $this->getUrl2();
				break;
			case 5:
				return $this->getSecret();
				break;
			case 6:
				return $this->getAdminSecret();
				break;
			case 7:
				return $this->getMaxNumberOfHitsPerDay();
				break;
			case 8:
				return $this->getAppearInSearch();
				break;
			case 9:
				return $this->getDebugLevel();
				break;
			case 10:
				return $this->getInvalidLoginCount();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			case 13:
				return $this->getAnonymousKuserId();
				break;
			case 14:
				return $this->getKsMaxExpiryInSeconds();
				break;
			case 15:
				return $this->getCreateUserOnDemand();
				break;
			case 16:
				return $this->getPrefix();
				break;
			case 17:
				return $this->getAdminName();
				break;
			case 18:
				return $this->getAdminEmail();
				break;
			case 19:
				return $this->getDescription();
				break;
			case 20:
				return $this->getCommercialUse();
				break;
			case 21:
				return $this->getModerateContent();
				break;
			case 22:
				return $this->getNotify();
				break;
			case 23:
				return $this->getCustomData();
				break;
			case 24:
				return $this->getServiceConfigId();
				break;
			case 25:
				return $this->getStatus();
				break;
			case 26:
				return $this->getContentCategories();
				break;
			case 27:
				return $this->getType();
				break;
			case 28:
				return $this->getPhone();
				break;
			case 29:
				return $this->getDescribeYourself();
				break;
			case 30:
				return $this->getAdultContent();
				break;
			case 31:
				return $this->getPartnerPackage();
				break;
			case 32:
				return $this->getUsagePercent();
				break;
			case 33:
				return $this->getStorageUsage();
				break;
			case 34:
				return $this->getEightyPercentWarning();
				break;
			case 35:
				return $this->getUsageLimitWarning();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPartnerName(),
			$keys[2] => $this->getPartnerAlias(),
			$keys[3] => $this->getUrl1(),
			$keys[4] => $this->getUrl2(),
			$keys[5] => $this->getSecret(),
			$keys[6] => $this->getAdminSecret(),
			$keys[7] => $this->getMaxNumberOfHitsPerDay(),
			$keys[8] => $this->getAppearInSearch(),
			$keys[9] => $this->getDebugLevel(),
			$keys[10] => $this->getInvalidLoginCount(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
			$keys[13] => $this->getAnonymousKuserId(),
			$keys[14] => $this->getKsMaxExpiryInSeconds(),
			$keys[15] => $this->getCreateUserOnDemand(),
			$keys[16] => $this->getPrefix(),
			$keys[17] => $this->getAdminName(),
			$keys[18] => $this->getAdminEmail(),
			$keys[19] => $this->getDescription(),
			$keys[20] => $this->getCommercialUse(),
			$keys[21] => $this->getModerateContent(),
			$keys[22] => $this->getNotify(),
			$keys[23] => $this->getCustomData(),
			$keys[24] => $this->getServiceConfigId(),
			$keys[25] => $this->getStatus(),
			$keys[26] => $this->getContentCategories(),
			$keys[27] => $this->getType(),
			$keys[28] => $this->getPhone(),
			$keys[29] => $this->getDescribeYourself(),
			$keys[30] => $this->getAdultContent(),
			$keys[31] => $this->getPartnerPackage(),
			$keys[32] => $this->getUsagePercent(),
			$keys[33] => $this->getStorageUsage(),
			$keys[34] => $this->getEightyPercentWarning(),
			$keys[35] => $this->getUsageLimitWarning(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PartnerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPartnerName($value);
				break;
			case 2:
				$this->setPartnerAlias($value);
				break;
			case 3:
				$this->setUrl1($value);
				break;
			case 4:
				$this->setUrl2($value);
				break;
			case 5:
				$this->setSecret($value);
				break;
			case 6:
				$this->setAdminSecret($value);
				break;
			case 7:
				$this->setMaxNumberOfHitsPerDay($value);
				break;
			case 8:
				$this->setAppearInSearch($value);
				break;
			case 9:
				$this->setDebugLevel($value);
				break;
			case 10:
				$this->setInvalidLoginCount($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
			case 13:
				$this->setAnonymousKuserId($value);
				break;
			case 14:
				$this->setKsMaxExpiryInSeconds($value);
				break;
			case 15:
				$this->setCreateUserOnDemand($value);
				break;
			case 16:
				$this->setPrefix($value);
				break;
			case 17:
				$this->setAdminName($value);
				break;
			case 18:
				$this->setAdminEmail($value);
				break;
			case 19:
				$this->setDescription($value);
				break;
			case 20:
				$this->setCommercialUse($value);
				break;
			case 21:
				$this->setModerateContent($value);
				break;
			case 22:
				$this->setNotify($value);
				break;
			case 23:
				$this->setCustomData($value);
				break;
			case 24:
				$this->setServiceConfigId($value);
				break;
			case 25:
				$this->setStatus($value);
				break;
			case 26:
				$this->setContentCategories($value);
				break;
			case 27:
				$this->setType($value);
				break;
			case 28:
				$this->setPhone($value);
				break;
			case 29:
				$this->setDescribeYourself($value);
				break;
			case 30:
				$this->setAdultContent($value);
				break;
			case 31:
				$this->setPartnerPackage($value);
				break;
			case 32:
				$this->setUsagePercent($value);
				break;
			case 33:
				$this->setStorageUsage($value);
				break;
			case 34:
				$this->setEightyPercentWarning($value);
				break;
			case 35:
				$this->setUsageLimitWarning($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PartnerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartnerName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartnerAlias($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUrl1($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUrl2($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSecret($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAdminSecret($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMaxNumberOfHitsPerDay($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAppearInSearch($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDebugLevel($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInvalidLoginCount($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAnonymousKuserId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setKsMaxExpiryInSeconds($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreateUserOnDemand($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setPrefix($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setAdminName($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setAdminEmail($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setDescription($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCommercialUse($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setModerateContent($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setNotify($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCustomData($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setServiceConfigId($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setStatus($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setContentCategories($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setType($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setPhone($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setDescribeYourself($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setAdultContent($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setPartnerPackage($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setUsagePercent($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setStorageUsage($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setEightyPercentWarning($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setUsageLimitWarning($arr[$keys[35]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PartnerPeer::DATABASE_NAME);

		if ($this->isColumnModified(PartnerPeer::ID)) $criteria->add(PartnerPeer::ID, $this->id);
		if ($this->isColumnModified(PartnerPeer::PARTNER_NAME)) $criteria->add(PartnerPeer::PARTNER_NAME, $this->partner_name);
		if ($this->isColumnModified(PartnerPeer::PARTNER_ALIAS)) $criteria->add(PartnerPeer::PARTNER_ALIAS, $this->partner_alias);
		if ($this->isColumnModified(PartnerPeer::URL1)) $criteria->add(PartnerPeer::URL1, $this->url1);
		if ($this->isColumnModified(PartnerPeer::URL2)) $criteria->add(PartnerPeer::URL2, $this->url2);
		if ($this->isColumnModified(PartnerPeer::SECRET)) $criteria->add(PartnerPeer::SECRET, $this->secret);
		if ($this->isColumnModified(PartnerPeer::ADMIN_SECRET)) $criteria->add(PartnerPeer::ADMIN_SECRET, $this->admin_secret);
		if ($this->isColumnModified(PartnerPeer::MAX_NUMBER_OF_HITS_PER_DAY)) $criteria->add(PartnerPeer::MAX_NUMBER_OF_HITS_PER_DAY, $this->max_number_of_hits_per_day);
		if ($this->isColumnModified(PartnerPeer::APPEAR_IN_SEARCH)) $criteria->add(PartnerPeer::APPEAR_IN_SEARCH, $this->appear_in_search);
		if ($this->isColumnModified(PartnerPeer::DEBUG_LEVEL)) $criteria->add(PartnerPeer::DEBUG_LEVEL, $this->debug_level);
		if ($this->isColumnModified(PartnerPeer::INVALID_LOGIN_COUNT)) $criteria->add(PartnerPeer::INVALID_LOGIN_COUNT, $this->invalid_login_count);
		if ($this->isColumnModified(PartnerPeer::CREATED_AT)) $criteria->add(PartnerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PartnerPeer::UPDATED_AT)) $criteria->add(PartnerPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(PartnerPeer::ANONYMOUS_KUSER_ID)) $criteria->add(PartnerPeer::ANONYMOUS_KUSER_ID, $this->anonymous_kuser_id);
		if ($this->isColumnModified(PartnerPeer::KS_MAX_EXPIRY_IN_SECONDS)) $criteria->add(PartnerPeer::KS_MAX_EXPIRY_IN_SECONDS, $this->ks_max_expiry_in_seconds);
		if ($this->isColumnModified(PartnerPeer::CREATE_USER_ON_DEMAND)) $criteria->add(PartnerPeer::CREATE_USER_ON_DEMAND, $this->create_user_on_demand);
		if ($this->isColumnModified(PartnerPeer::PREFIX)) $criteria->add(PartnerPeer::PREFIX, $this->prefix);
		if ($this->isColumnModified(PartnerPeer::ADMIN_NAME)) $criteria->add(PartnerPeer::ADMIN_NAME, $this->admin_name);
		if ($this->isColumnModified(PartnerPeer::ADMIN_EMAIL)) $criteria->add(PartnerPeer::ADMIN_EMAIL, $this->admin_email);
		if ($this->isColumnModified(PartnerPeer::DESCRIPTION)) $criteria->add(PartnerPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(PartnerPeer::COMMERCIAL_USE)) $criteria->add(PartnerPeer::COMMERCIAL_USE, $this->commercial_use);
		if ($this->isColumnModified(PartnerPeer::MODERATE_CONTENT)) $criteria->add(PartnerPeer::MODERATE_CONTENT, $this->moderate_content);
		if ($this->isColumnModified(PartnerPeer::NOTIFY)) $criteria->add(PartnerPeer::NOTIFY, $this->notify);
		if ($this->isColumnModified(PartnerPeer::CUSTOM_DATA)) $criteria->add(PartnerPeer::CUSTOM_DATA, $this->custom_data);
		if ($this->isColumnModified(PartnerPeer::SERVICE_CONFIG_ID)) $criteria->add(PartnerPeer::SERVICE_CONFIG_ID, $this->service_config_id);
		if ($this->isColumnModified(PartnerPeer::STATUS)) $criteria->add(PartnerPeer::STATUS, $this->status);
		if ($this->isColumnModified(PartnerPeer::CONTENT_CATEGORIES)) $criteria->add(PartnerPeer::CONTENT_CATEGORIES, $this->content_categories);
		if ($this->isColumnModified(PartnerPeer::TYPE)) $criteria->add(PartnerPeer::TYPE, $this->type);
		if ($this->isColumnModified(PartnerPeer::PHONE)) $criteria->add(PartnerPeer::PHONE, $this->phone);
		if ($this->isColumnModified(PartnerPeer::DESCRIBE_YOURSELF)) $criteria->add(PartnerPeer::DESCRIBE_YOURSELF, $this->describe_yourself);
		if ($this->isColumnModified(PartnerPeer::ADULT_CONTENT)) $criteria->add(PartnerPeer::ADULT_CONTENT, $this->adult_content);
		if ($this->isColumnModified(PartnerPeer::PARTNER_PACKAGE)) $criteria->add(PartnerPeer::PARTNER_PACKAGE, $this->partner_package);
		if ($this->isColumnModified(PartnerPeer::USAGE_PERCENT)) $criteria->add(PartnerPeer::USAGE_PERCENT, $this->usage_percent);
		if ($this->isColumnModified(PartnerPeer::STORAGE_USAGE)) $criteria->add(PartnerPeer::STORAGE_USAGE, $this->storage_usage);
		if ($this->isColumnModified(PartnerPeer::EIGHTY_PERCENT_WARNING)) $criteria->add(PartnerPeer::EIGHTY_PERCENT_WARNING, $this->eighty_percent_warning);
		if ($this->isColumnModified(PartnerPeer::USAGE_LIMIT_WARNING)) $criteria->add(PartnerPeer::USAGE_LIMIT_WARNING, $this->usage_limit_warning);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PartnerPeer::DATABASE_NAME);

		$criteria->add(PartnerPeer::ID, $this->id);

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

		$copyObj->setPartnerName($this->partner_name);

		$copyObj->setPartnerAlias($this->partner_alias);

		$copyObj->setUrl1($this->url1);

		$copyObj->setUrl2($this->url2);

		$copyObj->setSecret($this->secret);

		$copyObj->setAdminSecret($this->admin_secret);

		$copyObj->setMaxNumberOfHitsPerDay($this->max_number_of_hits_per_day);

		$copyObj->setAppearInSearch($this->appear_in_search);

		$copyObj->setDebugLevel($this->debug_level);

		$copyObj->setInvalidLoginCount($this->invalid_login_count);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setAnonymousKuserId($this->anonymous_kuser_id);

		$copyObj->setKsMaxExpiryInSeconds($this->ks_max_expiry_in_seconds);

		$copyObj->setCreateUserOnDemand($this->create_user_on_demand);

		$copyObj->setPrefix($this->prefix);

		$copyObj->setAdminName($this->admin_name);

		$copyObj->setAdminEmail($this->admin_email);

		$copyObj->setDescription($this->description);

		$copyObj->setCommercialUse($this->commercial_use);

		$copyObj->setModerateContent($this->moderate_content);

		$copyObj->setNotify($this->notify);

		$copyObj->setCustomData($this->custom_data);

		$copyObj->setServiceConfigId($this->service_config_id);

		$copyObj->setStatus($this->status);

		$copyObj->setContentCategories($this->content_categories);

		$copyObj->setType($this->type);

		$copyObj->setPhone($this->phone);

		$copyObj->setDescribeYourself($this->describe_yourself);

		$copyObj->setAdultContent($this->adult_content);

		$copyObj->setPartnerPackage($this->partner_package);

		$copyObj->setUsagePercent($this->usage_percent);

		$copyObj->setStorageUsage($this->storage_usage);

		$copyObj->setEightyPercentWarning($this->eighty_percent_warning);

		$copyObj->setUsageLimitWarning($this->usage_limit_warning);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getadminKusers() as $relObj) {
				$copyObj->addadminKuser($relObj->copy($deepCopy));
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
			self::$peer = new PartnerPeer();
		}
		return self::$peer;
	}

	
	public function setkuser($v)
	{


		if ($v === null) {
			$this->setAnonymousKuserId(NULL);
		} else {
			$this->setAnonymousKuserId($v->getId());
		}


		$this->akuser = $v;
	}


	
	public function getkuser($con = null)
	{
				include_once 'lib/model/om/BasekuserPeer.php';

		if ($this->akuser === null && ($this->anonymous_kuser_id !== null)) {

			$this->akuser = kuserPeer::retrieveByPK($this->anonymous_kuser_id, $con);

			
		}
		return $this->akuser;
	}

	
	public function initadminKusers()
	{
		if ($this->colladminKusers === null) {
			$this->colladminKusers = array();
		}
	}

	
	public function getadminKusers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseadminKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colladminKusers === null) {
			if ($this->isNew()) {
			   $this->colladminKusers = array();
			} else {

				$criteria->add(adminKuserPeer::PARTNER_ID, $this->getId());

				adminKuserPeer::addSelectColumns($criteria);
				$this->colladminKusers = adminKuserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(adminKuserPeer::PARTNER_ID, $this->getId());

				adminKuserPeer::addSelectColumns($criteria);
				if (!isset($this->lastadminKuserCriteria) || !$this->lastadminKuserCriteria->equals($criteria)) {
					$this->colladminKusers = adminKuserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastadminKuserCriteria = $criteria;
		return $this->colladminKusers;
	}

	
	public function countadminKusers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseadminKuserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(adminKuserPeer::PARTNER_ID, $this->getId());

		return adminKuserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addadminKuser(adminKuser $l)
	{
		$this->colladminKusers[] = $l;
		$l->setPartner($this);
	}

} 