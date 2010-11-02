<?php

/**
 * Add & Manage Flavor Params
 *
 * @service flavorParams
 * @package api
 * @subpackage services
 */
class FlavorParamsService extends KalturaBaseService
{
	public function initService($partnerId, $puserId, $ksStr, $serviceName, $action)
	{
		parent::initService($partnerId, $puserId, $ksStr, $serviceName, $action);
		parent::applyPartnerFilterForClass(new conversionProfile2Peer());
		parent::applyPartnerFilterForClass(new flavorAssetPeer());
		parent::applyPartnerFilterForClass(new flavorParamsPeer()); // note that partner 0 is defined as partner group in service.ct
	}
	
	/**
	 * Add new Flavor Params
	 * 
	 * @action add
	 * @param KalturaFlavorParams $flavorParams
	 * @return KalturaFlavorParams
	 */
	public function addAction(KalturaFlavorParams $flavorParams)
	{
		$flavorParams->validatePropertyMinLength("name", 1);
		
		$flavorParamsDb = new flavorParams();
		$flavorParams->toObject($flavorParamsDb);
		
		$flavorParamsDb->setPartnerId($this->getPartnerId());
		$flavorParamsDb->save();
		
		$flavorParams->fromObject($flavorParamsDb);
		return $flavorParams;
	}
	
	/**
	 * Get Flavor Params by ID
	 * 
	 * @action get
	 * @param int $id
	 * @return KalturaFlavorParams
	 */
	public function getAction($id)
	{
		$flavorParamsDb = flavorParamsPeer::retrieveByPK($id);
		
		if (!$flavorParamsDb)
			throw new KalturaAPIException(KalturaErrors::FLAVOR_PARAMS_ID_NOT_FOUND, $id);
			
		$flavorParams = KalturaFlavorParamsFactory::getFlavorParamsInstanceByFormat($flavorParamsDb->getFormat());
		$flavorParams->fromObject($flavorParamsDb);
		
		return $flavorParams;
	}
	
	/**
	 * Update Flavor Params by ID
	 * 
	 * @action update
	 * @param int $id
	 * @param KalturaFlavorParams $flavorParams
	 * @return KalturaFlavorParams
	 */
	public function updateAction($id, KalturaFlavorParams $flavorParams)
	{
		if ($flavorParams->name !== null)
			$flavorParams->validatePropertyMinLength("name", 1);
			
		$flavorParamsDb = flavorParamsPeer::retrieveByPK($id);
		if (!$flavorParamsDb)
			throw new KalturaAPIException(KalturaErrors::FLAVOR_PARAMS_ID_NOT_FOUND, $id);
			
		$flavorParams->validatePropertyMinLength("name", 1);
		
		$flavorParamsDb = new flavorParams();
		$flavorParams->toObject($flavorParamsDb);
		$flavorParamsDb->save();
			
		$flavorParams->fromObject($flavorParamsDb);
		return $flavorParams;
	}
	
	/**
	 * Delete Flavor Params by ID
	 * 
	 * @action delete
	 * @param int $id
	 */
	public function deleteAction($id)
	{
		$flavorParamsDb = flavorParamsPeer::retrieveByPK($id);
		if (!$flavorParamsDb)
			throw new KalturaAPIException(KalturaErrors::FLAVOR_PARAMS_ID_NOT_FOUND, $id);
			
		$flavorParamsDb->setDeletedAt(time());
		$flavorParamsDb->save();
	}
	
	/**
	 * List Flavor Params by filter with paging support (By default - all system default params will be listed too)
	 * 
	 * @action list
	 * @param KalturaFlavorParamsFilter $filter
	 * @param KalturaFilterPager $pager
	 * @return KalturaFlavorParamsListResponse
	 */
	public function listAction(KalturaFlavorParamsFilter $filter = null, KalturaFilterPager $pager = null)
	{
		flavorParamsPeer::allowAccessToSystemDefaultParamsAndPartnerX($this->getPartnerId());
		
		if (!$filter)
			$filter = new KalturaFlavorParamsFilter();

		if (!$pager)
			$pager = new KalturaFilterPager();
			
		$flavorParamsFilter = new flavorParamsFilter();
		
		$filter->toObject($flavorParamsFilter);
		
		$c = new Criteria();
		$flavorParamsFilter->attachToCriteria($c);
		
		$totalCount = flavorParamsPeer::doCount($c);
		$pager->attachToCriteria($c);
		$dbList = flavorParamsPeer::doSelect($c);

		$list = KalturaFlavorParamsArray::fromDbArray($dbList);
		$response = new KalturaFlavorParamsListResponse();
		$response->objects = $list;
		$response->totalCount = $totalCount;
		return $response;    
	}
	
	/**
	 * Get Flavor Params by Conversion Profile ID
	 * 
	 * @action getByConversionProfileId
	 * @param int $conversionProfileId
	 * @return KalturaFlavorParamsArray
	 */
	public function getByConversionProfileIdAction($conversionProfileId)
	{
		$conversionProfileDb = conversionProfile2Peer::retrieveByPK($conversionProfileId);
		if (!$conversionProfileDb)
			throw new KalturaAPIException(KalturaErrors::CONVERSION_PROFILE_ID_NOT_FOUND, $conversionProfileId);
			
		$flavorParamsConversionProfilesDb = $conversionProfileDb->getflavorParamsConversionProfilesJoinflavorParams();
		$flavorParamsDb = array();
		foreach($flavorParamsConversionProfilesDb as $item)
		{
			$flavorParamsDb[] = $item->getFlavorParams();
		}
		
		$flavorParams = KalturaFlavorParamsArray::fromDbArray($flavorParamsDb);
		
		return $flavorParams; 
	}
}