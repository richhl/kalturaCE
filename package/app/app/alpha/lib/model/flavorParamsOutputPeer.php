<?php

/**
 * Subclass for performing query and update operations on the 'flavor_params_output' table.
 *
 * 
 *
 * @package lib.model
 */ 
class flavorParamsOutputPeer extends BaseflavorParamsOutputPeer
{
	// cache classes by their type
	private static $class_types_cache = array();
	
	/**
	 * 
	 * @param $flavorAssetId
	 * @param $flavorAssetVersion
	 * @param $con
	 * 
	 * @return flavorParamsOutput
	 */
	public static function retrieveByFlavorAssetId($flavorAssetId, $flavorAssetVersion = null, $con = null)
	{
		$criteria = new Criteria();

		$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_ID, $flavorAssetId);
		
		if($flavorAssetVersion)
		{
			$criteria->add(flavorParamsOutputPeer::FLAVOR_ASSET_VERSION, $flavorAssetVersion);
		}
		else 
		{
			$criteria->addDescendingOrderByColumn(flavorParamsOutputPeer::FLAVOR_ASSET_VERSION);
		}

		return flavorParamsOutputPeer::doSelectOne($criteria, $con);
	}
	
	/**
	 * @param string $entryId
	 * @param string $tag
	 * @param $con
	 * @return array<flavorParamsOutput>
	 */
	public static function retrieveByEntryIdAndTag($entryId, $tag, $con = null)
	{
		$criteria = new Criteria();

		$criteria->add(flavorParamsOutputPeer::ENTRY_ID, $entryId);
		$criteria->addDescendingOrderByColumn(flavorParamsOutputPeer::FLAVOR_ASSET_VERSION);

		$flavorParamsOutputs = flavorParamsOutputPeer::doSelect($criteria, $con);
		
		$ret = array();
		
		foreach($flavorParamsOutputs as $flavorParamsOutput)
			if($flavorParamsOutput->hasTag($tag))
				$ret[] = $flavorParamsOutput;
		
		return $ret;
	}
	
	/**
	 * 
	 * @param $flavorAsset
	 * @param $con
	 * 
	 * @return flavorParamsOutput
	 */
	public static function retrieveByFlavorAsset(flavorAsset $flavorAsset, $con = null)
	{
		return self::retrieveByFlavorAssetId($flavorAsset->getId(), $flavorAsset->getVersion(), $con);
	}
	
	public static function doCopy(flavorParams $flavorParams, flavorParamsOutput $flavorParamsOutput)
	{
		$flavorParamsOutput->setFlavorParamsId($flavorParams->getId());
		$flavorParamsOutput->setFlavorParamsVersion($flavorParams->getVersion());
		$flavorParamsOutput->setName($flavorParams->getName());
		$flavorParamsOutput->setTags($flavorParams->getTags());
		$flavorParamsOutput->setDescription($flavorParams->getDescription());
		$flavorParamsOutput->setReadyBehavior($flavorParams->getReadyBehavior());
		$flavorParamsOutput->setIsDefault($flavorParams->getIsDefault());
		$flavorParamsOutput->setFormat($flavorParams->getFormat());
		$flavorParamsOutput->setVideoCodec($flavorParams->getVideoCodec());
		$flavorParamsOutput->setVideoBitrate($flavorParams->getVideoBitrate());
		$flavorParamsOutput->setAudioCodec($flavorParams->getAudioCodec());
		$flavorParamsOutput->setAudioBitrate($flavorParams->getAudioBitrate());
		$flavorParamsOutput->setAudioChannels($flavorParams->getAudioChannels());
		$flavorParamsOutput->setAudioSampleRate($flavorParams->getAudioSampleRate());
		$flavorParamsOutput->setAudioResolution($flavorParams->getAudioResolution());
		$flavorParamsOutput->setWidth($flavorParams->getWidth());
		$flavorParamsOutput->setHeight($flavorParams->getHeight());
		$flavorParamsOutput->setFrameRate($flavorParams->getFrameRate());
		$flavorParamsOutput->setGopSize($flavorParams->getGopSize());
		$flavorParamsOutput->setTwoPass($flavorParams->getTwoPass());
		$flavorParamsOutput->setConversionEngines($flavorParams->getConversionEngines());
		$flavorParamsOutput->setConversionEnginesExtraParams($flavorParams->getConversionEnginesExtraParams());
		$flavorParamsOutput->setCustomData($flavorParams->getCustomData());
		$flavorParamsOutput->save();
		
		return $flavorParamsOutput;
	}
	
	/**
	 * The returned Class will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @param      array $row PropelPDO result row.
	 * @param      int $colnum Column to examine for OM class information (first is 0).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getOMClass($row, $colnum)
	{
		if($row)
		{
			$flavorParamsOutputFormat= $row[$colnum + 15]; // format
			if(isset(self::$class_types_cache[$flavorParamsOutputFormat]))
				return self::$class_types_cache[$flavorParamsOutputFormat];
			$extendedCls = KalturaPluginManager::getObjectClass(KalturaPluginManager::OBJECT_TYPE_FLAVOR_PARAMS_OUTPUT, $flavorParamsOutputFormat);
			if($extendedCls)
			{
				self::$class_types_cache[$flavorParamsOutputFormat] = $extendedCls;
				return $extendedCls;
			}
			self::$class_types_cache[$flavorParamsOutputFormat] = parent::OM_CLASS;
		}
			
		return parent::OM_CLASS;
	}
}
