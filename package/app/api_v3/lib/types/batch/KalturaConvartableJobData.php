<?php
/**
 * @package api
 * @subpackage objects
 */

/**
 */
class KalturaConvartableJobData extends KalturaSourceJobData
{
	/**
	 * @var int
	 */
	public $flavorParamsOutputId;
	
	/**
	 * @var KalturaFlavorParamsOutput
	 */
	public $flavorParamsOutput;
	
	/**
	 * @var int
	 */
	public $mediaInfoId;
	
	private static $map_between_objects = array
	(
		"mediaInfoId" ,
		"flavorParamsOutputId" ,
	);


	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}
	    
	/**
	 * @param kConvartableJobData $dbConvartableJobData
	 * @return KalturaConvartableJobData
	 */
	public function fromObject(  $dbConvartableJobData)
	{
		parent::fromObject($dbConvartableJobData);
		
		$dbFlavorParams = $dbConvartableJobData->getFlavorParamsOutput();
		if($dbFlavorParams)
		{
			$this->flavorParamsOutput = new KalturaFlavorParamsOutput();
			$this->flavorParamsOutput->fromObject($dbFlavorParams);
		}
		
		return $this;
	}

	public function toObject(  $dbConvartableJobData = null, $props_to_skip = array()) 
	{
		if(is_null($dbConvartableJobData))
			$dbConvartableJobData = new kConvartableJobData();
			
		if($this->flavorParamsOutput instanceof KalturaFlavorParams)
		{
			$dbFlavorParams = new flavorParamsOutput();
			$dbFlavorParams = $this->flavorParamsOutput->toObject($dbFlavorParams);
			$dbConvartableJobData->setFlavorParamsOutput($dbFlavorParams);
		}
		
		return parent::toObject($dbConvartableJobData, $props_to_skip);
	}
}

?>