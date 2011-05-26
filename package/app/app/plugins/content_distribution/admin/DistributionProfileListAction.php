<?php
class DistributionProfileListAction extends KalturaAdminConsolePlugin
{
	public function __construct()
	{
		$this->action = 'listDistributionProfiles';
		$this->label = 'Distribution Profiles';
		$this->rootLabel = 'Distribution';
	}
	
	/**
	 * @return string - absolute file path of the phtml template
	 */
	public function getTemplatePath()
	{
		return realpath(dirname(__FILE__));
	}
	
	public function getRequiredPermissions()
	{
		return array(KalturaPermissionName::SYSTEM_ADMIN_CONTENT_DISTRIBUTION_BASE);
	}
	
	private function getPartnerFilterFromRequest(Zend_Controller_Request_Abstract $request)
	{
		$filterInput = $request->getParam('filter_input');
		if(!strlen($filterInput))
			return null;
			
		$filter = new KalturaPartnerFilter();
		$filterType = $request->getParam('filter_type');
		if ($filterType == 'byid')
		{
			$filter->idIn = $filterInput;
		}
		else
		{
			if ($filterType == 'byname')
				$filter->nameLike = $filterInput;
			elseif ($filterType == 'free' && $filterInput)
				$filter->partnerNameDescriptionWebsiteAdminNameAdminEmailLike = $filterInput;
		}
		return $filter;
	}
	
	public function doAction(Zend_Controller_Action $action)
	{
		$request = $action->getRequest();
		$page = $this->_getParam('page', 1);
		$pageSize = $this->_getParam('pageSize', 10);
		
		$form = new Form_PartnerFilter();
		$newForm = new Form_NewDistributionProfile();
		
		$actionUrl = $action->view->url(array('controller' => 'plugin', 'action' => 'DistributionProfileListAction'), null, true);
		$form->setAction($actionUrl);
		
		// init filter
		$partnerFilter = $this->getPartnerFilterFromRequest($request);
		
		// get results and paginate
		$paginatorAdapter = new Kaltura_FilterPaginator("distributionProfile", "listByPartner", null, $partnerFilter);
		$paginator = new Kaltura_Paginator($paginatorAdapter, $request);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($pageSize);
		
		$providers = array(
			KalturaDistributionProviderType::GENERIC => 'Generic',
			KalturaDistributionProviderType::SYNDICATION => 'Syndication'
		);
		$genericProviders = array();
		$client = Kaltura_ClientHelper::getClient();
		$contentDistributionClientPlugin = KalturaContentDistributionClientPlugin::get($client);
		$providersList = $contentDistributionClientPlugin->distributionProvider->listAction();
		if($providersList)
		{
			foreach($providersList->objects as $provider)
			{
				if($provider->type == KalturaDistributionProviderType::GENERIC)
					$genericProviders[$provider->id] = $provider->name;
				else
					$providers[$provider->type] = $provider->name;
			}
		}
		$newForm->setProviders($providers);
		
		// set view
		$action->view->form = $form;
		$action->view->newForm = $newForm;
		$action->view->paginator = $paginator;
		$action->view->providers = $providers;
		$action->view->genericProviders = $genericProviders;
		
	}
}

