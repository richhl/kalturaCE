<?php
/**
 * UiConf service lets you create and manage your UIConfs for the various flash components
 * This service is used by the KMC-ApplicationStudio
 *
 * @service uiConf
 * @package api
 * @subpackage services
 */
class UiConfService extends KalturaBaseService 
{
	// use initService to add a peer to the partner filter
	/**
	 * @ignore
	 */
	public function initService ($partnerId , $puserId , $ksStr , $serviceName , $action )
	{
		parent::initService ($partnerId , $puserId , $ksStr , $serviceName , $action );
		parent::applyPartnerFilterForClass ( new uiConfPeer() ); 	
	}
	
	/**
	 * UIConf Add action allows you to add a UIConf to Kaltura DB
	 * 
	 * @action add
	 * @param KalturaUiConf $uiConf Mandatory input parameter of type KalturaUiConf
	 * @return KalturaUiConf
	 */
	function addAction( KalturaUiConf $uiConf )
	{
		$dbUiConf = $uiConf->toUiConf();
		$dbUiConf->setPartnerId ( $this->getPartnerId() );
		$dbUiConf->save();
		
		$uiConf = new KalturaUiConf(); // start from blank
		$uiConf->fromUiConf( $dbUiConf );
		
		return $uiConf;
	}
	
	/**
	 * Update an existing UIConf
	 * 
	 * @action update
	 * @param int $id 
	 * @param KalturaUiConf $uiConf
	 * @return KalturaUiConf
	 *
	 * @throws APIErrors::INVALID_UI_CONF_ID
	 */	
	function updateAction( $id , KalturaUiConf $uiConf )
	{
		$dbUiConf = uiConfPeer::retrieveByPK( $id );
		
		if ( ! $dbUiConf )
			throw new KalturaAPIException ( APIErrors::INVALID_UI_CONF_ID , $id );
		
		$uiConfUpdate = $uiConf->toUiConf();

		$allowEmpty = true ; // TODO - what is the policy  ? 
		baseObjectUtils::autoFillObjectFromObject ( $uiConfUpdate , $dbUiConf , $allowEmpty );
		
		$dbUiConf->save();
		$uiConf->fromUiConf( $dbUiConf );
		
		return $uiConf;
	}	

	/**
	 * Retrieve a UIConf by id
	 * 
	 * @action get
	 * @param int $id 
	 * @return KalturaUiConf
	 *
	 * @throws APIErrors::INVALID_UI_CONF_ID
	 */		
	function getAction(  $id )
	{
		$dbUiConf = uiConfPeer::retrieveByPK( $id );
		
		if ( ! $dbUiConf )
			throw new KalturaAPIException ( APIErrors::INVALID_UI_CONF_ID , $id );
		$uiConf = new KalturaUiConf();
		$uiConf->fromUiConf( $dbUiConf );
		
		return $uiConf;
	}

	/**
	 * Delete an existing UIConf
	 * 
	 * @action delete
	 * @param int $id
	 *
	 * @throws APIErrors::INVALID_UI_CONF_ID
	 */		
	function deleteAction(  $id )
	{
		$dbUiConf = uiConfPeer::retrieveByPK( $id );
		
		if ( ! $dbUiConf )
			throw new KalturaAPIException ( APIErrors::INVALID_UI_CONF_ID , $id );
		
		$dbUiConf->setStatus ( uiConf::UI_CONF_STATUS_DELETED );

		$dbUiConf->save();
	}

	/**
	 * Clone an existing UIConf
	 * 
	 * @action clone
	 * @param int $id 
	 * @return KalturaUiConf
	 *
	 * @throws APIErrors::INVALID_UI_CONF_ID
	 */	
	// TODO - get the new data of uiConf - will help override the parameters withiout needing to call update 
	function cloneAction( $id ) // , KalturaUiConf $_uiConf )
	{
		$dbUiConf = uiConfPeer::retrieveByPK( $id );
		
		if ( ! $dbUiConf )
			throw new KalturaAPIException ( APIErrors::INVALID_UI_CONF_ID , $id );
		$ui_conf_verride_params = new uiConf();
		$ui_conf_verride_params->setPartnerId( $this->getPartnerId() );
		$ui_conf_verride_params->setDisplayInSearch(1);  // the cloned ui_conf should NOT be a template
			
		$uiConfClone = $dbUiConf->cloneToNew ( $ui_conf_verride_params );

		$uiConf = new KalturaUiConf();
		$uiConf->fromUiConf( $uiConfClone );
		
		return $uiConf;
	}		
	
	/**
	 * Retrieve a list of available UIConfs
	 * 
	 * @action list
	 * @param KalturaUiConfFilter $filter
	 * @param KalturaFilterPager $pager
	 * @return KalturaUiConfListResponse
	 */		
	function listAction( KalturaUiConfFilter $filter = null , KalturaFilterPager $pager = null)
	{
		if (!$filter)
			$filter = new KalturaUiConfFilter;
		$uiConfFilter = new uiConfFilter ();
		$filter->toObject( $uiConfFilter );
		
		$c = new Criteria();
		$uiConfFilter->attachToCriteria( $c );
		if ( $pager )	$pager->attachToCriteria( $c );
		
		$list = uiConfPeer::doSelect( $c );
		$count = uiConfPeer::doCount( $c );
		
		$newList = KalturaUiConfArray::fromUiConfArray( $list );
		
		$response = new KalturaUiConfListResponse();
		$response->objects = $newList;
		$response->totalCount = $count;
		
		return $response;
	}
}
?>