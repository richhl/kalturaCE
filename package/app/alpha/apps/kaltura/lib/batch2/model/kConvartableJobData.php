<?php

/**
 *  
 * @package Core
 * @subpackage Batch
 */
class kConvartableJobData extends kSourceJobData
{
	/**
	 * @var int
	 */
	private $flavorParamsOutputId;
	
	/**
	 * @var flavorParamsOutput
	 */
	private $flavorParamsOutput;
	
	/**
	 * @var int
	 */
	private $mediaInfoId;
	
	
	
	/**
	 * @param $flavorParamsOutput the $flavorParamsOutput to set
	 */
	public function setFlavorParamsOutput($flavorParamsOutput)
	{
		$this->flavorParamsOutput = $flavorParamsOutput;
	}

	/**
	 * @param $flavorParamsOutputId the $flavorParamsOutputId to set
	 */
	public function setFlavorParamsOutputId($flavorParamsOutputId)
	{
		$this->flavorParamsOutputId = $flavorParamsOutputId;
	}

	/**
	 * @return flavorParamsOutput the $flavorParamsOutput
	 */
	public function getFlavorParamsOutput()
	{
		return $this->flavorParamsOutput;
	}

	/**
	 * @return int the $flavorParamsOutputId
	 */
	public function getFlavorParamsOutputId()
	{
		return $this->flavorParamsOutputId;
	}


	/**
	 * @return int the $mediaInfoId
	 */
	public function getMediaInfoId()
	{
		return $this->mediaInfoId;
	}

	/**
	 * @param $mediaInfoId the $mediaInfoId to set
	 */
	public function setMediaInfoId($mediaInfoId)
	{
		$this->mediaInfoId = $mediaInfoId;
	}

	/**
	 * @return the ready behavior
	 */
	public function getReadyBehavior()
	{
		$flavorParamsOutput = flavorParamsOutputPeer::retrieveByPK($this->flavorParamsOutputId);
		if($flavorParamsOutput)
			return $flavorParamsOutput->getReadyBehavior();
			
		return null;
	}
}