<?php
class GenericDistributionProviderDeleteAction extends KalturaAdminConsolePlugin
{
	public function __construct()
	{
		$this->action = 'deleteGenericDistributionProvider';
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
		return array(KalturaPermissionName::SYSTEM_ADMIN_CONTENT_DISTRIBUTION_MODIFY);
	}
	
	public function doAction(Zend_Controller_Action $action)
	{
		$action->getHelper('viewRenderer')->setNoRender();
		$providerId = $this->_getParam('provider_id');
		$client = Kaltura_ClientHelper::getClient();
		
		try
		{
			$client->genericDistributionProvider->delete($providerId);
			echo $action->getHelper('json')->sendJson('ok', false);
		}
		catch(Exception $e)
		{
			KalturaLog::err($e->getMessage() . "\n" . $e->getTraceAsString());
			echo $action->getHelper('json')->sendJson($e->getMessage(), false);
		}
	}
}

