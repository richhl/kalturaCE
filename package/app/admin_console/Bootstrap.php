<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initLog()
	{
		$this->bootstrap('autoloaders');
		$this->bootstrap('config');
		
		$config = Zend_Registry::get('config');
		KalturaLog::initLog($config->logger);
	}
	
	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	}

	protected function _initPaginator()
	{
		Zend_View_Helper_PaginationControl::setDefaultViewPartial(
			'paginator_control.phtml'
		);
	}

	protected function _initNavigation()
	{
		$this->bootstrap('layout');
		$this->bootstrap('acl');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		$config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml');

		$navigation = new Zend_Navigation($config);
		
		$additionalNavigation = Zend_Registry::get('config')->navigation;
		$menu = $additionalNavigation->monitoring;
		$subMenu = $menu->enableDisable;
		
		$target = '';
		if($subMenu->target)
			$target = $subMenu->target;
			
		$navigation->addPage(array(
			    'label' => $subMenu->label,
			    'uri' => $subMenu->uri,
				'target' => $target
		));
		$menuPage = $navigation->findOneBy('label', 'Monitoring');
		$subMenuPage = $navigation->findOneBy('label', $subMenu->label);
		$subMenuPage->setParent($menuPage);
		
		$this->checkAclForNavigation($navigation);
			
		$view->navigation($navigation);
	}

	protected function _initAutoloaders()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();

		$moduleAutoloader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath'  => dirname(__FILE__),
		));
		$moduleAutoloader->addResourceType('kaltura', 'lib/Kaltura', 'Kaltura');
		$autoloader->pushAutoloader($moduleAutoloader);

		$autoloader->pushAutoloader(new Kaltura_ClientLoader());
		$autoloader->pushAutoloader(new Kaltura_InfraLoader());
	}
	
	protected function _initTimeZone()
	{
		$this->bootstrap('config');
		$config = Zend_Registry::get('config');
		date_default_timezone_set($config->settings->timeZone);
	}
	
	protected function _initConfig()
	{
		$config = new Zend_Config($this->getOptions(), true);
		Zend_Registry::set('config', $config);
		return $config;
	}

	protected function _initController()
	{
		$this->bootstrap('acl');
		
		$front = Zend_Controller_Front::getInstance();
		$front->throwExceptions(true);
		
		$front->registerPlugin(new Kaltura_AuthPlugin());
		
		$acl = Zend_Registry::get('acl');
		$config = Zend_Registry::get('config');
		$front->registerPlugin(new Kaltura_ControllerPluginAcl($acl, Kaltura_AclHelper::getCurrentRole()));
	}
	
	protected function _initAcl()
	{
		// roles
		$acl = new Zend_Acl();
		$acl->addRole(Kaltura_AclHelper::ROLE_GUEST)
			->addRole(Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES, Kaltura_AclHelper::ROLE_GUEST)
      		->addRole(Kaltura_AclHelper::ROLE_ADMINISTRATOR, Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES);
      		
      	// resources
      	$acl
			->add(new Zend_Acl_Resource('batch'))
      		->add(new Zend_Acl_Resource('error'))
      		->add(new Zend_Acl_Resource('index'))
      		->add(new Zend_Acl_Resource('monitoring'))
			->add(new Zend_Acl_Resource('partner'))
			->add(new Zend_Acl_Resource('partner-usage'))
      		->add(new Zend_Acl_Resource('user'));
			
		// allow for all roles
		$acl->allow(null, 'index')
			->allow(null, 'error')
			->allow(null, 'user', array('login', 'logout', 'reset-password', 'reset-password-link', 'reset-password-ok'));

		// for ps role
		$acl->allow(Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES, 'partner')
			->allow(Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES, 'partner-usage')
			->allow(Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES, 'batch')
			->deny(Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES, 'batch', 'abort-tasks')
			->deny(Kaltura_AclHelper::ROLE_PROFESIONAL_SERVICES, 'batch', 'stop-start');
		
		// for administrator
		$acl->allow(Kaltura_AclHelper::ROLE_ADMINISTRATOR, 'batch', 'abort-tasks');
		$acl->allow(Kaltura_AclHelper::ROLE_ADMINISTRATOR, 'batch', 'stop-start');
		$acl->allow(Kaltura_AclHelper::ROLE_ADMINISTRATOR, 'user');
		$acl->allow(Kaltura_AclHelper::ROLE_ADMINISTRATOR, 'monitoring');
		
		
      	Zend_Registry::set('acl', $acl);
	}
	
	protected function checkAclForNavigation(Zend_Navigation_Container $navigation)
	{
		$acl = Zend_Registry::get('acl');
		$currentRole = Kaltura_AclHelper::getCurrentRole();
		$pages = $navigation->getPages();
		foreach($pages as $page)
		{
			$role = $page->get('role');
			if ($role)
			{
				if (!$acl->inheritsRole($currentRole, $role) && $currentRole !== $role)
				{
					$navigation->removePage($page);
					continue;
				}
			}
			$this->checkAclForNavigation($page);
		}
	}
}