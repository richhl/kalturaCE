<?php

class KalturaDispatcher 
{
	private static $instance;
	
	private $databaseManager = null;
	
	/**
	 * Return a KalturaDispatcher instance
	 *
	 * @return KalturaDispatcher
	 */
	public static function getInstance()
	{
		if (!self::$instance)
		{
			$class = __CLASS__;
			self::$instance = new $class();
		}
		
		return self::$instance;
	}
	
	public function dispatch($service, $action, $params = array()) 
	{
		$start = microtime( true );

		$p = isset ($params["p"]) ? $params["p"] : null;
		if ( ! $p ) $p = isset ($params["partnerId"] ) ? $params["partnerId"] : null ;
		
		$userId = "";
		$ksStr = isset($params["ks"]) ? $params["ks"] : null ;
		 
		if (!$service)
			throw new KalturaAPIException(KalturaErrors::SERVICE_NOT_SPECIFIED);
		
        try 
        {
            // load the service reflector
		    $reflector = new KalturaServiceReflector($service);
        }
        catch(Exception $ex)
        {
			throw new KalturaAPIException(KalturaErrors::SERVICE_DOES_NOT_EXISTS, $service);
        }
		
		// check if action exists
		if (!$action)
			throw new KalturaAPIException(KalturaErrors::ACTION_NOT_SPECIFIED, $service);
		
		if (!$reflector->isActionExists($action))
			throw new KalturaAPIException(KalturaErrors::ACTION_DOES_NOT_EXISTS, $action, $service);
		
		$actionParams = $reflector->getActionParams($action);

		// services.ct - check if partner is allowed to access service ...

		// validate it's ok to access this service
		$deserializer = new KalturaRequestDeserializer($params);
		$arguments = $deserializer->buildActionArguments($actionParams);

		// initialize the service before invoking the action on it
		$serviceInstance = $reflector->getServiceInstance();
		$serviceInstance->initService ( $p , $userId , $ksStr , $reflector->getServiceName() , $action );
		
		$res =  $reflector->invoke($action, $arguments);
		
		// run service config security validations 
				
		return $res;
	}
}

