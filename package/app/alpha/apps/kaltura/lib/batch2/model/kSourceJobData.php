<?php

/**
 *  
 * @package Core
 * @subpackage Batch
 */
class kSourceJobData
{
	/**
	 * @var string
	 */
	private $srcFileSyncLocalPath;
	
	/**
	 * The translated path as used by the scheduler
	 * @var string
	 */
	private $actualSrcFileSyncLocalPath;
	
	/**
	 * @var string
	 */
	private $srcFileSyncRemoteUrl;
	
	
	
	/**
	 * @return the $srcFileSyncLocalPath
	 */
	public function getSrcFileSyncLocalPath()
	{
		return $this->srcFileSyncLocalPath;
	}
	/**
	 * @param $srcFileSyncRemoteUrl the $srcFileSyncRemoteUrl to set
	 */
	public function setSrcFileSyncRemoteUrl($srcFileSyncRemoteUrl)
	{
		$this->srcFileSyncRemoteUrl = $srcFileSyncRemoteUrl;
	}

	/**
	 * @return the $srcFileSyncRemoteUrl
	 */
	public function getSrcFileSyncRemoteUrl()
	{
		return $this->srcFileSyncRemoteUrl;
	}

	/**
	 * @param $flavorParamsOutput the $flavorParamsOutput to set
	 */
	public function setFlavorParamsOutput($flavorParamsOutput)
	{
		$this->flavorParamsOutput = $flavorParamsOutput;
	}

	/**
	 * @param $srcFileSyncLocalPath the $srcFileSyncLocalPath to set
	 */
	public function setSrcFileSyncLocalPath($srcFileSyncLocalPath)
	{
		$this->srcFileSyncLocalPath = $srcFileSyncLocalPath;
	}

	/**
	 * @return the $actualSrcFileSyncLocalPath
	 */
	public function getActualSrcFileSyncLocalPath()
	{
		return $this->actualSrcFileSyncLocalPath;
	}

	/**
	 * @param $actualSrcFileSyncLocalPath the $actualSrcFileSyncLocalPath to set
	 */
	public function setActualSrcFileSyncLocalPath($actualSrcFileSyncLocalPath)
	{
		$this->actualSrcFileSyncLocalPath = $actualSrcFileSyncLocalPath;
	}


}