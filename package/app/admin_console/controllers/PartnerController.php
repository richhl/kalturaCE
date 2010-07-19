<?php
class PartnerController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$this->_helper->redirector('list');
	}
	
	public function createAction()
	{
		$request = $this->getRequest();
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_PartnerCreate();
		Form_PackageHelper::addPackagesToForm($form, $client->systemPartner->getPackages());
		
		if ($request->isPost())
		{
			if ($form->isValid($request->getPost()))
			{
				$partner = $form->getObject("KalturaPartner", $request->getPost());
				if(is_array($partner->contentCategories))
					$partner->contentCategories = implode(',', $partner->contentCategories);
					
				$partner->adminName = $partner->name;
				$partner->description = "Admin Console";
				$client->startMultiRequest();
				
				// queue register partner without a ks, otherwise we get an exception saying partner -2 is not a VAR/GROUP
				$originalKs = $client->getKs();
				$client->setKs(null);
				$client->partner->register($partner);
				
				// queue partner package update
				$client->setKs($originalKs);
				$config = new KalturaSystemPartnerConfiguration();
				$config->partnerPackage = $form->getValue('partner_package');
				$client->systemPartner->updateConfiguration('{1:result:id}', $config);
				
				// do multirequest
				$result = $client->doMultiRequest();
				
				// check for errors in partner.register
				if ($client->isError($result[0])) 
				{
					if (strpos($result[0]['message'], 'already exists in system') !== false)
						$form->getElement('admin_email')->addError('Email already exists');
					else
						throw new KalturaException($result[0]['message'], $result[0]['code']);
				}
				else
				{
					$this->_helper->redirector('list');
				}
			}
			else
			{
				$form->populate($request->getPost());
			}
		}
		
		$this->view->form = $form;
	}
	
	public function listAction()
	{
		$request = $this->getRequest();
		$page = $this->_getParam('page', 1);
		$pageSize = $this->_getParam('pageSize', 10);
		
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_PartnerFilter();
		
		// init filter
		$partnerFilter = $this->getPartnerFilterFromRequest($request);
		
		// get results and paginate
		$paginatorAdapter = new Kaltura_FilterPaginator("systemPartner", "listAction", $partnerFilter);
		$paginator = new Kaltura_Paginator($paginatorAdapter, $request);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($pageSize);
		
		// popule the form
		$form->populate($request->getParams());
		
		// set view
		$this->view->form = $form;
		$this->view->paginator = $paginator;
	}
	
	public function updateStorageStatusAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$storageId = $this->_getParam('storageId');
		$status = $this->_getParam('status');
		$client = Kaltura_ClientHelper::getClient();
		$client->storageProfile->updateStatus($storageId, $status);
		echo $this->_helper->json('ok', false);
	}
	
	public function updateStatusAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$partnerId = $this->_getParam('partner_id');
		$status = $this->_getParam('status');
		$client = Kaltura_ClientHelper::getClient();
		$client->systemPartner->updateStatus($partnerId, $status);
		echo $this->_helper->json('ok', false);
	}
	
	public function kmcRedirectAction()
	{
		$partnerId = $this->_getParam('partner_id');
		$client = Kaltura_ClientHelper::getClient();
		$ks = $client->systemPartner->getAdminSession($partnerId);
		$subp_id = ((int)$partnerId)*100;
		$url = Kaltura_ClientHelper::getServiceUrl();
		$url = $url . '/index.php/kmc/extlogin?partner_id='.$partnerId.'&ks='.$ks.'&subp_id='.$subp_id;
		$this->getResponse()->setRedirect($url);
	}
	
	public function configureStorageAction()
	{
		$this->_helper->layout->disableLayout();
		$storageId = $this->_getParam('storageId');
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_Partner_StorageConfiguration();
		Form_Partner_StorageHelper::addProtocolsToForm($form);
		Form_Partner_StorageHelper::addPathManagersToForm($form);
		Form_Partner_StorageHelper::addUrlManagersToForm($form);
		Form_Partner_StorageHelper::addTriggersToForm($form);
		
		$request = $this->getRequest();
		
		$storage = $client->storageProfile->get($storageId);

		Kaltura_ClientHelper::impersonate($storage->partnerId);
		$flavorParamsResponse = $client->flavorParams->listAction();
		Kaltura_ClientHelper::unimpersonate();
		
		if ($request->isPost())
		{
			$form->populate($request->getPost());
			$storage = $form->getObject("KalturaStorageProfile", $request->getPost(), false, true);
			
			$flavorParams = array();
			foreach($flavorParamsResponse->objects as $flavorParamsItem)
				if($this->_getParam('flavorParamsId_' . $flavorParamsItem->id, false))
					$flavorParams[] = $flavorParamsItem->id;
			
			if(count($flavorParams))
				$storage->flavorParamsIds = implode(',', $flavorParams);
			else		
				$storage->flavorParamsIds = '';
				
			$client->storageProfile->update($storageId, $storage);
		}
		else
		{
			$flavorParamsIds = array();
			if($storage->flavorParamsIds)
				$flavorParamsIds = explode(',', $storage->flavorParamsIds);
				
			$form->addFlavorParamsFields($flavorParamsResponse, $flavorParamsIds);
			$form->populateFromObject($storage, false);
		}
		
		$this->view->form = $form;
	}

	public function newStorageAction()
	{
		$this->_helper->layout->disableLayout();
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_Partner_StorageConfiguration();
		Form_Partner_StorageHelper::addProtocolsToForm($form);
		Form_Partner_StorageHelper::addPathManagersToForm($form);
		Form_Partner_StorageHelper::addUrlManagersToForm($form);
		Form_Partner_StorageHelper::addTriggersToForm($form);
		
		$request = $this->getRequest();
		$partnerId = $request->getParam('partnerId');
		KalturaLog::log('Request: ' . print_r($request, true));
		KalturaLog::log("newStorageAction partner [$partnerId]");
		
		Kaltura_ClientHelper::impersonate($partnerId);
		$flavorParamsResponse = $client->flavorParams->listAction();
		Kaltura_ClientHelper::unimpersonate();
		
		if ($request->isPost())
		{
			KalturaLog::log('Request: ' . print_r($request->getPost(), true));
			$form->populate($request->getPost());
			$storage = $form->getObject("KalturaStorageProfile", $request->getPost(), false, true);	
			
			$flavorParams = array();
			foreach($flavorParamsResponse->objects as $flavorParamsItem)
				if($this->_getParam('flavorParamsId_' . $flavorParamsItem->id, false))
					$flavorParams[] = $flavorParamsItem->id;
			
			if(count($flavorParams))
				$storage->flavorParamsIds = implode(',', $flavorParams);
			else		
				$storage->flavorParamsIds = '';
			
			KalturaLog::log('Storage: ' . print_r($storage, true));
			$client->storageProfile->add($storage);
		}
		else
		{
			KalturaLog::log("Load form, partner id [$partnerId]");
			$form->setPartnerId($partnerId);
			$form->addFlavorParamsFields($flavorParamsResponse);
		}
		
		$this->view->form = $form;
	}
	
	public function configureAction()
	{
		$this->_helper->layout->disableLayout();
		$partnerId = $this->_getParam('partner_id');
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_PartnerConfiguration();
		Form_PackageHelper::addPackagesToForm($form, $client->systemPartner->getPackages());
		
		$request = $this->getRequest();
		
		if ($request->isPost())
		{
			$form->populate($request->getPost());
			$config = $form->getObject("KalturaSystemPartnerConfiguration", $request->getPost());
			$client->systemPartner->updateConfiguration($partnerId, $config);
		}
		else
		{
			$client->startMultiRequest();
			$client->systemPartner->get($partnerId);
			$client->systemPartner->getConfiguration($partnerId);
			$result = $client->doMultiRequest();
			$partner = $result[0];
			$config = $result[1];
			$form->populateFromObject($config);
			$form->getElement('account_name')->setDescription($partner->name);
		}
		
		$this->view->form = $form;
	}
	
	private function getPartnerFilterFromRequest(Zend_Controller_Request_Abstract $request)
	{
		$filter = new KalturaPartnerFilter();
		$filterType = $request->getParam('filter_type');
		$filterInput = $request->getParam('filter_input');
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
		$statuses = array();
		$statuses[] = KalturaPartnerStatus::ACTIVE;
		$statuses[] = KalturaPartnerStatus::BLOCKED;
		$filter->statusIn = implode(',', $statuses);
		$filter->orderBy = KalturaPartnerOrderBy::ID_DESC;
		return $filter;
	}

	public function externalStoragesAction()
	{
		$request = $this->getRequest();
		$page = $this->_getParam('page', 1);
		$pageSize = $this->_getParam('pageSize', 10);
		
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_PartnerFilter();
		$newForm = new Form_NewStorage();
		
		// init filter
		$partnerFilter = $this->getPartnerFilterFromRequest($request);
		
		// get results and paginate
		$paginatorAdapter = new Kaltura_FilterPaginator("storageProfile", "listByPartner", $partnerFilter);
		$paginator = new Kaltura_Paginator($paginatorAdapter, $request);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($pageSize);
		
		// popule the form
		$form->populate($request->getParams());
		
		// set view
		$this->view->form = $form;
		$this->view->newForm = $newForm;
		$this->view->paginator = $paginator;
	}
}