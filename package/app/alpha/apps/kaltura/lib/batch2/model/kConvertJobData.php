<?php

/** 
 * @package Core
 * @subpackage Batch
 */
class kConvertJobData extends kConvartableJobData
{
	const CONVERSION_ENGINE_KALTURA_COM = 0;
	const CONVERSION_ENGINE_ON2 = 1;
	const CONVERSION_ENGINE_FFMPEG = 2;
	const CONVERSION_ENGINE_MENCODER = 3;
	const CONVERSION_ENGINE_ENCODING_COM = 4;
	const CONVERSION_ENGINE_EXPRESSION_ENCODER3 = 5;
	
	const CONVERSION_ENGINE_FFMPEG_VP8 = 98;
	const CONVERSION_ENGINE_FFMPEG_AUX = 99;
	
	const CONVERSION_MILTI_COMMAND_LINE_SEPERATOR = ';';
	const CONVERSION_FAST_START_SIGN = 'FS';
	
	
	
	/**
	 * @var string
	 */
	private $destFileSyncLocalPath;
	
	/**
	 * @var string
	 */
	private $destFileSyncRemoteUrl;
	
	/**
	 * @var string
	 */
	private $flavorAssetId;
	
	
	/**
	 * @var string
	 */
	private $remoteMediaId;
	
	
	/**
	 * @return the $destFileSyncLocalPath
	 */
	public function getDestFileSyncLocalPath()
	{
		return $this->destFileSyncLocalPath;
	}
	/**
	 * @param $remoteMediaId the $remoteMediaId to set
	 */
	public function setRemoteMediaId($remoteMediaId)
	{
		$this->remoteMediaId = $remoteMediaId;
	}

	/**
	 * @return the $remoteMediaId
	 */
	public function getRemoteMediaId()
	{
		return $this->remoteMediaId;
	}

	/**
	 * @param $destFileSyncRemoteUrl the $destFileSyncRemoteUrl to set
	 */
	public function setDestFileSyncRemoteUrl($destFileSyncRemoteUrl)
	{
		$this->destFileSyncRemoteUrl = $destFileSyncRemoteUrl;
	}

	/**
	 * @return the $destFileSyncRemoteUrl
	 */
	public function getDestFileSyncRemoteUrl()
	{
		return $this->destFileSyncRemoteUrl;
	}


	/**
	 * @return the $flavorAssetId
	 */
	public function getFlavorAssetId()
	{
		return $this->flavorAssetId;
	}

	/**
	 * @param $destFileSyncLocalPath the $destFileSyncLocalPath to set
	 */
	public function setDestFileSyncLocalPath($destFileSyncLocalPath)
	{
		$this->destFileSyncLocalPath = $destFileSyncLocalPath;
	}

	/**
	 * @param $flavorAssetId the $flavorAssetId to set
	 */
	public function setFlavorAssetId($flavorAssetId)
	{
		$this->flavorAssetId = $flavorAssetId;
	}
}

?>