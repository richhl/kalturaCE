<?php

class kObjectCopyHandler implements kObjectCopiedEventConsumer
{
	protected static $idsMap = array();

	public static function mapIds($className, $fromId, $toId)
	{
		if(!isset(self::$idsMap[$className]))
			self::$idsMap[$className] = array();
			
		self::$idsMap[$className][$fromId] = $toId;
	}
	
	public static function getMappedId($className, $fromId)
	{
		if(!isset(self::$idsMap[$className]) || !isset(self::$idsMap[$className][$fromId]))
			return null;
			
		return self::$idsMap[$className][$fromId];
	}
	
	/**
	 * @param BaseObject $fromObject
	 * @param BaseObject $toObject
	 * @return bool true if should continue to the next consumer
	 */
	public function objectCopied(BaseObject $fromObject, BaseObject $toObject)
	{
		if($fromObject instanceof assetParams)
			self::mapIds('assetParams', $fromObject->getId(), $toObject->getId());
			
		if($fromObject instanceof assetParamsOutput)
		{
			$flavorParamsId = self::getMappedId('assetParams', $fromObject->getFlavorParamsId());
			if($flavorParamsId)
				$toObject->setFlavorParamsId($flavorParamsId);
		}
		return true;
	}
}