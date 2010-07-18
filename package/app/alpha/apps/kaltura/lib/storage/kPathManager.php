<?php
class kPathManager
{
	protected static function getStorageProfile($storageProfileId = null)
	{
		if(is_null($storageProfileId))
			return kDataCenterMgr::getCurrentStorageProfile();
			
		return StorageProfilePeer::retrieveByPK($storageProfileId);
	}
	
	/**
	 * will return a pair of file_root and file_path
	 * This is the only function that should be extended for building a different path
	 *
	 * @param ISyncableFile $object
	 * @param int $subType
	 * @param $version
	 */
	public function generateFilePathArr(ISyncableFile $object, $subType, $version = null)
	{
		return $object->generateFilePathArr($subType, $version);
	}
	
	/**
	 * will return a pair of file_root and file_path
	 *
	 * @param ISyncableFile $object
	 * @param int $subType
	 * @param int $storageProfileId
	 * @param $version
	 */
	public static function getFilePathArr(FileSyncKey $key, $storageProfileId = null)
	{
		kLog::log(__METHOD__." - key [$key], storageProfileId [$storageProfileId]");
		
		$storageProfile = self::getStorageProfile($storageProfileId);
		if(is_null($storageProfile))
			throw new Exception("Storage Profile [$storageProfileId] not found");

		$pathManager = $storageProfile->getPathManager();
		
		$object = kFileSyncUtils::retrieveObjectForSyncKey($key);
		return $pathManager->generateFilePathArr($object, $key->object_sub_type, $key->version);
	}
	
	/**
	 * will return a pair of file_root and file_path
	 *
	 * @param ISyncableFile $object
	 * @param int $subType
	 * @param int $storageProfileId
	 * @param $version
	 */
	public static function getFilePath(FileSyncKey $key, $storageProfileId = null)
	{
		return implode('', self::getFilePathArr($key, $storageProfileId));
	}
}