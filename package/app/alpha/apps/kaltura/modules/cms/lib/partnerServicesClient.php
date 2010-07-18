<?php
class PartnerServicesClient
{
	private $action;
	private $actionInstance = null;
	public function __construct($action)
	{
		$this->action = $action;
        $this->loadAction();
	}
	
	public function execute($params)
	{
		if (!$this->actionInstance)
		{
			throw new Exception("Action not loaded");
		}
		
		$this->actionInstance->setInputParams($params);
		$result = $this->actionInstance->internalExecute();
		return $result;
		/*$obj_wrapper = @$result["result"]["kshow"];
		if ($kshow_wrapper)
		{
			$kshow = $kshow_wrapper->getWrappedObj();
			return 	$kshow	;
		}
		else
		{
			return null;
		}*/
	}
	
	private function loadAction() 
	{
		if (!$this->actionInstance)
		{
			if (require_once(MODULES . 'partnerservices2/actions/' . $this->action . 'Action.class.php')) 
			{
	            $action_class_name = $this->action . 'Action';
	            $this->actionInstance = new $action_class_name ;
	        } 
	        else 
        	{
	            throw new Exception ('Action not found');
	        }
		}
	}
}

?>