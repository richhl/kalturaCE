<?php
require_once('../../alpha/config/kConf.php');
class KalturaResponseCacher
{
	protected $_params = array();
	protected $_cacheFilePrefix = "cache_v3-";
	protected $_cacheDirectory = "/tmp/";
	protected $_cacheKey = "";
	protected $_cacheDataFilePath = "";
	protected $_cacheHeadersFilePath = "";
	protected $_cacheLogFilePath = "";
	protected $_ks = "";
	protected $_useCache = true;
	
	public function __construct()
	{
		$this->_useCache = kConf::get('enable_cache');
		if (!$this->_useCache)
			return;
			
		$params = $_GET + $_POST;
		
		// check the clientTag parameter for a cache start time (cache_st:<time>) directive
		if (isset($params['clientTag']))
		{
			$clientTag = $params['clientTag'];
			$matches = null;
			if (preg_match("/cache_st:(\d+)/", $clientTag, $matches))
			{
				if ($matches[1] > time())
				{
					$this->_useCache = false;
					return;
				}
			}
		}
				
		if (isset($params['nocache']))
		{
			$this->_useCache = false;
			return;
		}
		
		$this->_ks = isset($params['ks']) ? $params['ks'] : ''; 
		unset($params['ks']);
		unset($params['kalsig']);
		unset($params['clientTag']);
		
		$this->_params = $params;
		$ksData = $this->getKsData();
		$this->_params["___cache___partnerId"] = $ksData["partnerId"];
		$this->_params["___cache___userId"] = $ksData["userId"];
		$this->_params['___cache___uri'] = $_SERVER['PHP_SELF'];
		ksort($this->_params);
		
		$this->_cacheKey = md5(implode("|", $this->_params));

		$pathWithFilePrefix = $this->_cacheDirectory . DIRECTORY_SEPARATOR . $this->_cacheFilePrefix;
		$this->_cacheDataFilePath 		= $pathWithFilePrefix . $this->_cacheKey;
		$this->_cacheHeadersFilePath 	= $pathWithFilePrefix . $this->_cacheKey . ".headers";
		$this->_cacheLogFilePath 		= $pathWithFilePrefix . $this->_cacheKey . ".log";
	}
	
	public function checkOrStart()
	{
		if (!$this->_useCache)
			return;
			
		$startTime = microtime(true);
		if ($this->hasCache())
		{
			$contentType = @file_get_contents($this->_cacheHeadersFilePath);
			if ($contentType)
				header("Content-Type: $contentType");
				
            $response = @file_get_contents($this->_cacheDataFilePath);
			if ($response)
			{
				$processingTime = microtime(true) - $startTime;
				header("X-Kaltura:cached-dispatcher,$this->_cacheKey,$processingTime");
				header("Expires: Thu, 19 Nov 2000 08:52:00 GMT");
				header("Cache-Control" , "no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
				header("Pragma" , "no-cache");
				echo $response;
				die;
			}
		}
		else
		{
			ob_start();
		}
	}
	
	public function end()
	{
		if (!$this->_useCache)
			return;
			
		if (!$this->shouldCache())
			return;
	
		$response = ob_get_contents();
		$headers = headers_list();
		$contentType = "";
		foreach($headers as $headerStr)
		{
			$header = explode(":", $headerStr);
			if (isset($header[0]) && $header[0] == "Content-Type")
			{
				$contentType = $headerStr;
				break;	
			}
		}
		
		file_put_contents($this->_cacheLogFilePath, "cachekey: $this->_cacheKey\n".print_r($this->_params, true)."\n".$response);
		file_put_contents($this->_cacheHeadersFilePath, $contentType);
		file_put_contents($this->_cacheDataFilePath, $response);
		
		ob_end_flush();
	}
	
	private function hasCache()
	{
		if (file_exists($this->_cacheDataFilePath))
		{
			if (filemtime($this->_cacheDataFilePath) + 600 < time())
			{
				@unlink($this->_cacheDataFilePath);
				@unlink($this->_cacheHeadersFilePath);
				@unlink($this->_cacheLogFilePath);
				return false;
			}
			else
			{
				return true;
			}
		}
		return false;
	}
	
	private function shouldCache()
	{
		$ksData = $this->getKsData();
		
		$uid = null;
		if ($ksData)
			$uid = $ksData["userId"];
	
		if ($uid === "0" || $uid === null) // $uid will be null when no session
			return true;
			
		return false;
	}
	
	private function getKsData()
	{
		$str = base64_decode($this->_ks, true);
		
		if (strpos($str, "|") === false)
		{
			$partnerId = null;
			$userId = null;
		}
		else
		{
			@list($hash, $realStr) = @explode("|", $str, 2);
			@list($partnerId, $dummy, $dummy, $dummy, $dummy, $userId, $dummy) = @explode (";", $realStr);
		}
		return array("partnerId" => $partnerId, "userId" => $userId);
	}
}