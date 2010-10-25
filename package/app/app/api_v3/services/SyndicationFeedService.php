<?php
/**
 * Add & Manage Syndication Feeds
 *
 * @service syndicationFeed
 * @package api
 * @subpackage services
 */
class SyndicationFeedService extends KalturaBaseService 
{
	
	public function initService($partnerId, $puserId, $ksStr, $serviceName, $action)
	{
		parent::initService($partnerId, $puserId, $ksStr, $serviceName, $action);
		parent::applyPartnerFilterForClass(new entryPeer());
		parent::applyPartnerFilterForClass(new syndicationFeedPeer());
	}
	
	/**
	 * Add new Syndication Feed
	 * 
	 * @action add
	 * @param KalturaBaseSyndicationFeed $syndicationFeed
	 * @return KalturaBaseSyndicationFeed 
	 */
	public function addAction(KalturaBaseSyndicationFeed $syndicationFeed)
	{
		$syndicationFeed->validatePlaylistId();

		$syndicationFeedDB = new syndicationFeed();
		$syndicationFeed->partnerId = $this->getPartnerId();
		$syndicationFeed->status = KalturaSyndicationFeedStatus::ACTIVE;
		$syndicationFeed->toObject($syndicationFeedDB);
		
		$syndicationFeedDB->save();
		
		if($syndicationFeed->addToDefaultConversionProfile)
		{
			$partner = PartnerPeer::retrieveByPK($this->getPartnerId());
			
			$c = new Criteria;
			$c->addAnd(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $partner->getDefaultConversionProfileId());
			$c->addAnd(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $syndicationFeed->flavorParamId);
			$is_exist = flavorParamsConversionProfilePeer::doCount($c);
			if(!$is_exist || $is_exist === 0)
			{
				$fpc = new flavorParamsConversionProfile();
				$fpc->setConversionProfileId($partner->getDefaultConversionProfileId());
				$fpc->setFlavorParamsId($syndicationFeed->flavorParamId);
				$fpc->save();
			}
		}
		
		$syndicationFeed->fromObject($syndicationFeedDB);
		return $syndicationFeed;
	}
	
	/**
	 * Get Syndication Feed by ID
	 * 
	 * @action get
	 * @param string $id
	 * @return KalturaBaseSyndicationFeed
	 */
	public function getAction($id)
	{
		$syndicationFeedDB = syndicationFeedPeer::retrieveByPK($id);
		if (!$syndicationFeedDB)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $id);
		$syndicationFeed = KalturaSyndicationFeedFactory::getInstanceByType($syndicationFeedDB->getType());
		//echo $syndicationFeed->feedUrl; die;
		$syndicationFeed->fromObject($syndicationFeedDB);
		return $syndicationFeed;
	}
        
	/**
	 * Update Syndication Feed by ID
	 * 
	 * @action update
	 * @param string $id
	 * @param KalturaBaseSyndicationFeed $syndicationFeed
	 * @return KalturaBaseSyndicationFeed
	 */
	public function updateAction($id, KalturaBaseSyndicationFeed $syndicationFeed)
	{
		$syndicationFeed->type = null;
		$syndicationFeedDB = syndicationFeedPeer::retrieveByPK($id);
		if (!$syndicationFeedDB)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $id);
		
        	$syndicationFeed = $syndicationFeed->toUpdatableObject($syndicationFeedDB, array('type'));
		$syndicationFeedDB->save();

		$syndicationFeed = KalturaSyndicationFeedFactory::getInstanceByType($syndicationFeedDB->getType());
		$syndicationFeed->fromObject($syndicationFeedDB);
		return $syndicationFeed;
	}
	
	/**
	 * Delete Syndication Feed by ID
	 * 
	 * @action delete
	 * @param string $id
	 */
	public function deleteAction($id)
	{
		$syndicationFeedDB = syndicationFeedPeer::retrieveByPK($id);
		if (!$syndicationFeedDB)
			throw new KalturaAPIException(KalturaErrors::ENTRY_ID_NOT_FOUND, $id);
		
		$syndicationFeedDB->setStatus(KalturaSyndicationFeedStatus::DELETED);
		$syndicationFeedDB->save();
	}
	
	/**
	 * List Syndication Feeds by filter with paging support
	 * 
	 * @action list
	 * @param KalturaBaseSyndicationFeedFilter $filter
	 * @param KalturaFilterPager $pager
	 * @return KalturaBaseSyndicationFeedListResponse
	 */
	public function listAction(KalturaBaseSyndicationFeedFilter $filter = null, KalturaFilterPager $pager = null)
	{
		if ($filter === null)
			$filter = new KalturaBaseSyndicationFeedFilter();
			
		if ($filter->orderBy === null)
			$filter->orderBy = KalturaBaseSyndicationFeedOrderBy::CREATED_AT_DESC;
			
		$syndicationFilter = new syndicationFeedFilter();
		
		$filter->toObject($syndicationFilter);

		$c = new Criteria();
		$syndicationFilter->attachToCriteria($c);
		
		$totalCount = syndicationFeedPeer::doCount($c);
                
        if($pager === null)
        	$pager = new KalturaFilterPager();
                
        $pager->attachToCriteria($c);
		$dbList = syndicationFeedPeer::doSelect($c);
		
		$list = KalturaBaseSyndicationFeedArray::fromSyndicationFeedArray($dbList);
		$response = new KalturaBaseSyndicationFeedListResponse();
		$response->objects = $list;
		$response->totalCount = $totalCount;
		return $response;
		
	}
	
	/**
	 * get entry count for a syndication feed
	 *
	 * @action getEntryCount
	 * @param string $feedId
	 * @return KalturaSyndicationFeedEntryCount
	 */
	public function getEntryCountAction($feedId)
	{
		$feedCount = new KalturaSyndicationFeedEntryCount();
		
		$feedRenderer = new KalturaSyndicationFeedRenderer($feedId, true);
		$feedRenderer->fetchEntriesForFeed(true);
		$feedCount->totalEntryCount = $feedRenderer->feedTotalEntryCount;
		
		unset($feedRenderer);
		
		$feedRenderer2 = new KalturaSyndicationFeedRenderer($feedId);
		$feedRenderer2->fetchEntriesForFeed(true);
		$feedCount->actualEntryCount = $feedRenderer2->feedTotalEntryCount;
		
		$feedCount->requireTranscodingCount = $feedCount->totalEntryCount - $feedCount->actualEntryCount;
		
		return $feedCount;
	}
	
	/**
	 *  request conversion for all entries that doesnt have the required flavor param
	 *  returns a comma-separated ids of conversion jobs
	 *
	 *  @action requestConversion
	 *  @param string $feedId
	 *  @return string
	 */
	public function requestConversionAction($feedId)
	{
		flavorParamsPeer::allowAccessToSystemDefaultParamsAndPartnerX($this->getPartnerId()); // the flavor params can be from partner 0 too
		$feedRenderer = new KalturaSyndicationFeedRenderer($feedId, null);
		$feedRenderer->fetchEntriesForFeed();
		
		$createdJobsIds = array();
		
		$flavorParamsId = $feedRenderer->syndicationFeed->flavorParamId;
		
		foreach($feedRenderer->getEntries() as $entry)
		{
			$originalFlavorAsset = flavorAssetPeer::retrieveOriginalByEntryId($entry->getId());
			if (is_null($originalFlavorAsset))
			{
				// do not add job for entries with no original flavor
				continue;
			}
			$err = "";
			$job = kBusinessPreConvertDL::decideAddEntryFlavor(null, $entry->getId(), $flavorParamsId, $err);
			if($job && is_object($job))
			{
				$createdJobsIds[] = $job->getId();
			}
		}
		return(implode(',', $createdJobsIds));
	}
}