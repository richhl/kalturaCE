<?php
class Kaltura_InfraLoader implements Zend_Loader_Autoloader_Interface
{
	public function autoload($class)
	{
		$infaDir = realpath('../../infra/');
		require_once($infaDir . DIRECTORY_SEPARATOR . 'KAutoloader.php');
		KAutoloader::setClassPath(array($infaDir . DIRECTORY_SEPARATOR . '*'));
		KAutoloader::setNoCache(true);
		KAutoloader::autoload($class);
	}
}