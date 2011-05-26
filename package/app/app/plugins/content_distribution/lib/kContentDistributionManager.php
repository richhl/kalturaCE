<?php
/**
 * @package plugins.contentDistribution
 * @subpackage lib
 */
class kContentDistributionManager
{
	
	/**
	 * @param entry $entry
	 * @param DistributionProfile $distributionProfile
	 * @param bool $submit
	 * @return EntryDistribution
	 */
	public static function addEntryDistribution(entry $entry, DistributionProfile $distributionProfile, $submit = false)
	{
		$entryDistribution = self::createEntryDistribution($entry, $distributionProfile);
		$entryDistribution->save();
		
		if($distributionProfile->getSubmitEnabled() == DistributionProfileActionStatus::AUTOMATIC)
			$submit = true;
			
		if($submit)
			self::submitAddEntryDistribution($entryDistribution, $distributionProfile);
			
		return $entryDistribution;
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	protected static function addSubmitAddJob(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
 		$jobData = new kDistributionSubmitJobData();
 		$jobData->setDistributionProfileId($entryDistribution->getDistributionProfileId());
 		$jobData->setEntryDistributionId($entryDistribution->getId());
 		$jobData->setProviderType($distributionProfile->getProviderType());
 		
		$batchJob = new BatchJob();
		$batchJob->setEntryId($entryDistribution->getEntryId());
		$batchJob->setPartnerId($entryDistribution->getPartnerId());
		
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_SUBMIT);
		$jobSubType = $distributionProfile->getProviderType();
	
		return kJobsManager::addJob($batchJob, $jobData, $jobType, $jobSubType);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	protected static function addSubmitDisableJob(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
 		$jobData = new kDistributionDisableJobData();
 		$jobData->setDistributionProfileId($entryDistribution->getDistributionProfileId());
 		$jobData->setEntryDistributionId($entryDistribution->getId());
 		$jobData->setProviderType($distributionProfile->getProviderType());
 		$jobData->setRemoteId($entryDistribution->getRemoteId());
 		$jobData->setMediaFiles($entryDistribution->getMediaFiles());
 		
		$batchJob = new BatchJob();
		$batchJob->setEntryId($entryDistribution->getEntryId());
		$batchJob->setPartnerId($entryDistribution->getPartnerId());
		
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DISABLE);
		$jobSubType = $distributionProfile->getProviderType();
	
		return kJobsManager::addJob($batchJob, $jobData, $jobType, $jobSubType);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	protected static function addSubmitEnableJob(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
 		$jobData = new kDistributionEnableJobData();
 		$jobData->setDistributionProfileId($entryDistribution->getDistributionProfileId());
 		$jobData->setEntryDistributionId($entryDistribution->getId());
 		$jobData->setProviderType($distributionProfile->getProviderType());
 		$jobData->setRemoteId($entryDistribution->getRemoteId());
 		$jobData->setMediaFiles($entryDistribution->getMediaFiles());
 		
		$batchJob = new BatchJob();
		$batchJob->setEntryId($entryDistribution->getEntryId());
		$batchJob->setPartnerId($entryDistribution->getPartnerId());
		
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_ENABLE);
		$jobSubType = $distributionProfile->getProviderType();
	
		return kJobsManager::addJob($batchJob, $jobData, $jobType, $jobSubType);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	protected static function addSubmitUpdateJob(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
 		$jobData = new kDistributionUpdateJobData();
 		$jobData->setDistributionProfileId($entryDistribution->getDistributionProfileId());
 		$jobData->setEntryDistributionId($entryDistribution->getId());
 		$jobData->setProviderType($distributionProfile->getProviderType());
 		$jobData->setRemoteId($entryDistribution->getRemoteId());
 		$jobData->setMediaFiles($entryDistribution->getMediaFiles());
 		
		$batchJob = new BatchJob();
		$batchJob->setEntryId($entryDistribution->getEntryId());
		$batchJob->setPartnerId($entryDistribution->getPartnerId());
		
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_UPDATE);
		$jobSubType = $distributionProfile->getProviderType();
	
		return kJobsManager::addJob($batchJob, $jobData, $jobType, $jobSubType);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	protected static function addFetchReportJob(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
 		$jobData = new kDistributionFetchReportJobData();
 		$jobData->setDistributionProfileId($entryDistribution->getDistributionProfileId());
 		$jobData->setEntryDistributionId($entryDistribution->getId());
 		$jobData->setProviderType($distributionProfile->getProviderType());
 		$jobData->setRemoteId($entryDistribution->getRemoteId());
 		
		$batchJob = new BatchJob();
		$batchJob->setEntryId($entryDistribution->getEntryId());
		$batchJob->setPartnerId($entryDistribution->getPartnerId());
		
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_FETCH_REPORT);
		$jobSubType = $distributionProfile->getProviderType();
	
		return kJobsManager::addJob($batchJob, $jobData, $jobType, $jobSubType);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	protected static function addSubmitDeleteJob(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
 		$jobData = new kDistributionDeleteJobData();
 		$jobData->setDistributionProfileId($entryDistribution->getDistributionProfileId());
 		$jobData->setEntryDistributionId($entryDistribution->getId());
 		$jobData->setProviderType($distributionProfile->getProviderType());
 		$jobData->setRemoteId($entryDistribution->getRemoteId());
 		
		$batchJob = new BatchJob();
		$batchJob->setEntryId($entryDistribution->getEntryId());
		$batchJob->setPartnerId($entryDistribution->getPartnerId());
		
		$jobType = ContentDistributionPlugin::getBatchJobTypeCoreValue(ContentDistributionBatchJobType::DISTRIBUTION_DELETE);
		$jobSubType = $distributionProfile->getProviderType();
	
		return kJobsManager::addJob($batchJob, $jobData, $jobType, $jobSubType);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	public static function submitDeleteEntryDistribution(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
		if($distributionProfile->getStatus() != DistributionProfileStatus::ENABLED || $distributionProfile->getDeleteEnabled() == DistributionProfileActionStatus::DISABLED)
			return null;
			
		$validStatus = array(
			EntryDistributionStatus::ERROR_DELETING,
			EntryDistributionStatus::ERROR_UPDATING,
			EntryDistributionStatus::READY,
		);
		
		if(!in_array($entryDistribution->getStatus(), $validStatus))
		{
			KalturaLog::notice("wrong entry distribution status [" . $entryDistribution->getStatus() . "]");
			return null;
		} 
		
		$distributionProvider = $distributionProfile->getProvider();
		if($distributionProvider->isDeleteEnabled())
			return self::addSubmitDeleteJob($entryDistribution, $distributionProfile);
			
		if($distributionProvider->isAvailabilityUpdateEnabled())
			return self::addSubmitDisableJob($entryDistribution, $distributionProfile);
		
		if(!$distributionProvider->isScheduleUpdateEnabled() || !$distributionProvider->isUpdateEnabled())
		{
			KalturaLog::log("Entry distribution [" . $entryDistribution->getId() . "] provider [" . $distributionProfile->getProviderType() . "] doesn't support delete or update");
			return null;
		}
			
		$entryDistribution->setSunset(time());
		$entryDistribution->save();
		
		return self::addSubmitUpdateJob($entryDistribution, $distributionProfile);
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	public static function submitUpdateEntryDistribution(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
		if($distributionProfile->getStatus() != DistributionProfileStatus::ENABLED || $distributionProfile->getUpdateEnabled() == DistributionProfileActionStatus::DISABLED)
			return null;
			
		$validStatus = array(
			EntryDistributionStatus::ERROR_DELETING,
			EntryDistributionStatus::ERROR_UPDATING,
			EntryDistributionStatus::READY,
		);
		
		if(!in_array($entryDistribution->getStatus(), $validStatus))
		{
			KalturaLog::notice("wrong entry distribution status [" . $entryDistribution->getStatus() . "]");
			return null;
		} 
		
		
		$validationErrors = $entryDistribution->getValidationErrors();
		if(count($validationErrors))
		{
			KalturaLog::log("Validation errors found");
			return null;
		}
		
		$distributionProvider = $distributionProfile->getProvider();
		if($distributionProvider->isUpdateEnabled())
			return self::addSubmitUpdateJob($entryDistribution, $distributionProfile);

		if($distributionProvider->useDeleteInsteadOfUpdate())
		{
			$job = self::addSubmitDeleteJob($entryDistribution, $distributionProfile);
			return self::addSubmitAddJob($entryDistribution, $distributionProfile);
		}
	
		$entryDistribution->setStatus(EntryDistributionStatus::ERROR_UPDATING);
		$entryDistribution->save();
		
		return null;
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	public static function submitEnableEntryDistribution(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
		if($distributionProfile->getStatus() != DistributionProfileStatus::ENABLED || $distributionProfile->getUpdateEnabled() == DistributionProfileActionStatus::DISABLED)
			return null;
			
		$validStatus = array(
			EntryDistributionStatus::ERROR_DELETING,
			EntryDistributionStatus::ERROR_UPDATING,
			EntryDistributionStatus::READY,
		);
		
		if(!in_array($entryDistribution->getStatus(), $validStatus))
		{
			KalturaLog::notice("wrong entry distribution status [" . $entryDistribution->getStatus() . "]");
			return null;
		} 
		
		
		$validationErrors = $entryDistribution->getValidationErrors();
		if(count($validationErrors))
		{
			KalturaLog::log("Validation errors found");
			return null;
		}
		
		$distributionProvider = $distributionProfile->getProvider();
		if($distributionProvider->isUpdateEnabled() && $distributionProvider->isAvailabilityUpdateEnabled())
			return self::addSubmitEnableJob($entryDistribution, $distributionProfile);
	
		$entryDistribution->setStatus(EntryDistributionStatus::ERROR_UPDATING);
		$entryDistribution->save();
		
		return null;
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	public static function submitDisableEntryDistribution(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
		if($distributionProfile->getStatus() != DistributionProfileStatus::ENABLED || $distributionProfile->getUpdateEnabled() == DistributionProfileActionStatus::DISABLED)
			return null;
			
		$validStatus = array(
			EntryDistributionStatus::ERROR_DELETING,
			EntryDistributionStatus::ERROR_UPDATING,
			EntryDistributionStatus::READY,
		);
		
		if(!in_array($entryDistribution->getStatus(), $validStatus))
		{
			KalturaLog::notice("wrong entry distribution status [" . $entryDistribution->getStatus() . "]");
			return null;
		} 
		
		
		$validationErrors = $entryDistribution->getValidationErrors();
		if(count($validationErrors))
		{
			KalturaLog::log("Validation errors found");
			return null;
		}
		
		$distributionProvider = $distributionProfile->getProvider();
		if($distributionProvider->isUpdateEnabled() && $distributionProvider->isAvailabilityUpdateEnabled())
			return self::addSubmitDisableJob($entryDistribution, $distributionProfile);
	
		$entryDistribution->setStatus(EntryDistributionStatus::ERROR_UPDATING);
		$entryDistribution->save();
		
		return null;
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @return BatchJob
	 */
	public static function submitFetchEntryDistributionReport(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile)
	{
		if($distributionProfile->getStatus() != DistributionProfileStatus::ENABLED || $distributionProfile->getReportEnabled() == DistributionProfileActionStatus::DISABLED)
			return null;
			
		$validStatus = array(
			EntryDistributionStatus::READY,
		);
		
		if(!in_array($entryDistribution->getStatus(), $validStatus))
		{
			KalturaLog::notice("wrong entry distribution status [" . $entryDistribution->getStatus() . "]");
			return null;
		} 
		
		$distributionProvider = $distributionProfile->getProvider();
		if($distributionProvider->isReportsEnabled())
			return self::addFetchReportJob($entryDistribution, $distributionProfile);

		return null;
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param DistributionProfile $distributionProfile
	 * @param bool $submitWhenReady
	 * @return BatchJob
	 */
	public static function submitAddEntryDistribution(EntryDistribution $entryDistribution, DistributionProfile $distributionProfile, $submitWhenReady = true)
	{
		if($distributionProfile->getStatus() != DistributionProfileStatus::ENABLED || $distributionProfile->getSubmitEnabled() == DistributionProfileActionStatus::DISABLED)
			return null;
			
		$validStatus = array(
			EntryDistributionStatus::ERROR_DELETING,
			EntryDistributionStatus::ERROR_SUBMITTING,
			EntryDistributionStatus::ERROR_UPDATING,
			EntryDistributionStatus::PENDING,
			EntryDistributionStatus::QUEUED,
			EntryDistributionStatus::READY,
			EntryDistributionStatus::REMOVED,
		);
		
		if(!in_array($entryDistribution->getStatus(), $validStatus))
		{
			KalturaLog::notice("wrong entry distribution status [" . $entryDistribution->getStatus() . "]");
			return null;
		} 
		
		if($submitWhenReady && $entryDistribution->getStatus() != EntryDistributionStatus::QUEUED)
		{
			$entryDistribution->setStatus(EntryDistributionStatus::QUEUED);
			$entryDistribution->save();
		}
		
		$validationErrors = $entryDistribution->getValidationErrors();
		if(!count($validationErrors))
		{
			$sunrise = $entryDistribution->getSunrise(null);
			if($sunrise)
			{
				$distributionProvider = $distributionProfile->getProvider();
				if(!$distributionProvider->isScheduleUpdateEnabled() && !$distributionProvider->isAvailabilityUpdateEnabled())
				{
					$sunrise -= $distributionProvider->getJobIntervalBeforeSunrise();
					if($sunrise > time())
					{
						KalturaLog::log("Will be sent on exact time [$sunrise] for sunrise time [" . $entryDistribution->getSunrise() . "]");
						$entryDistribution->setDirtyStatus(EntryDistributionDirtyStatus::SUBMIT_REQUIRED);
						$entryDistribution->save();
						return null;
					}
				}
			}
			return self::addSubmitAddJob($entryDistribution, $distributionProfile);
		}
		
		KalturaLog::log("Validation errors found");
		$entry = entryPeer::retrieveByPK($entryDistribution->getEntryId());
		if(!$entry)
		{
			KalturaLog::err("Entry [" . $entryDistribution->getEntryId() . "] not found");
			return null;
		}
			
		$autoCreateFlavors = $distributionProfile->getAutoCreateFlavorsArray();
		$autoCreateThumbs = $distributionProfile->getAutoCreateThumbArray();
		foreach($validationErrors as $validationError)
		{
			if($validationError->getErrorType() == DistributionErrorType::MISSING_FLAVOR && in_array($validationError->getData(), $autoCreateFlavors))
			{
				$errDescription = null;
				KalturaLog::log("Adding flavor [" . $validationError->getData() . "] to entry [" . $entryDistribution->getEntryId() . "]");
				kBusinessPreConvertDL::decideAddEntryFlavor(null, $entryDistribution->getEntryId(), $validationError->getData(), $errDescription);
				if($errDescription)
					KalturaLog::log($errDescription);
			}
		
			if($validationError->getErrorType() == DistributionErrorType::MISSING_THUMBNAIL && in_array($validationError->getData(), $autoCreateThumbs))
			{
				$destThumbParams = thumbParamsPeer::retrieveByPK($validationError->getData());
				if($destThumbParams)
				{
					KalturaLog::log("Adding thumbnail [" . $validationError->getData() . "] to entry [" . $entryDistribution->getEntryId() . "]");
					kBusinessPreConvertDL::decideThumbGenerate($entry, $destThumbParams);
				}
				else 
				{
					KalturaLog::err("Required thumbnail params not found [" . $validationError->getData() . "]");
				}	
			}
		}
		
		return null;
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param entry $entry
	 * @param DistributionProfile $distributionProfile
	 * @return boolean true if the list of flavors modified
	 */
	public static function assignFlavorAssets(EntryDistribution $entryDistribution, entry $entry, DistributionProfile $distributionProfile)
	{
		$requiredFlavorParamsIds = $distributionProfile->getRequiredFlavorParamsIdsArray();
		$optionalFlavorParamsIds = $distributionProfile->getRequiredFlavorParamsIdsArray();
		$flavorParamsIds = array_merge($requiredFlavorParamsIds, $optionalFlavorParamsIds);
		$flavorAssetIds = array();
		if(!is_array($flavorParamsIds))
			return false;
			
		$originalList = $entryDistribution->getFlavorAssetIds();
		// remove deleted flavor assets
		if($originalList)
		{
			$assignedFlavorAssetIds = explode(',', $originalList);
			$assignedFlavorAssets = flavorAssetPeer::retrieveByIds($assignedFlavorAssetIds);
			foreach($assignedFlavorAssets as $assignedFlavorAsset)
				if(in_array($assignedFlavorAsset->getFlavorParamsId(), $flavorParamsIds))
					$flavorAssetIds[] = $assignedFlavorAsset->getId();
		}
		
		// adds added flavor assets
		$newFlavorAssetIds = flavorAssetPeer::getReadyIdsByParamsIds($entry->getId(), $flavorParamsIds);
		foreach($newFlavorAssetIds as $newFlavorAssetId)
			$flavorAssetIds[] = $newFlavorAssetId;
			
		$entryDistribution->setFlavorAssetIds($flavorAssetIds);
		return ($originalList != $entryDistribution->getFlavorAssetIds());
	}
	
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param entry $entry
	 * @param DistributionProfile $distributionProfile
	 * @return boolean true if the list of thumbnails modified
	 */
	public static function assignThumbAssets(EntryDistribution $entryDistribution, entry $entry, DistributionProfile $distributionProfile)
	{
		$thumbAssetsIds = array();
		$thumbDimensions = $distributionProfile->getThumbDimensionsObjects();
		$thumbDimensionsWithKeys = array();
		foreach($thumbDimensions as $thumbDimension)
			$thumbDimensionsWithKeys[$thumbDimension->getKey()] = $thumbDimension;
		
		$originalList = $entryDistribution->getThumbAssetIds();
		
		// remove deleted thumb assets
		$assignedThumbAssetIds = $originalList;
		if($assignedThumbAssetIds)
		{
			$thumbAssetsIds = explode(',', $assignedThumbAssetIds);
			$assignedThumbAssets = thumbAssetPeer::retrieveByIds($thumbAssetsIds);
			foreach($assignedThumbAssets as $assignedThumbAsset)
			{					
				$key = $assignedThumbAsset->getWidth() . 'x' . $assignedThumbAsset->getHeight();
				if(isset($thumbDimensionsWithKeys[$key]))
					unset($thumbDimensionsWithKeys[$key]);
			}
		}
		
		// add new thumb assets
		$requiredThumbParamsIds = $distributionProfile->getAutoCreateThumbArray();
		$thumbAssets = thumbAssetPeer::retreiveReadyByEntryId($entry->getId());
		foreach($thumbAssets as $thumbAsset)
		{
			if(in_array($thumbAsset->getFlavorParamsId(), $requiredThumbParamsIds))
			{
				$thumbAssetsIds[] = $thumbAsset->getId();
				KalturaLog::log("Assign thumb asset [" . $thumbAsset->getId() . "] from required thumbnail params ids");
				continue;
			}
			
			$key = $thumbAsset->getWidth() . 'x' . $thumbAsset->getHeight();
			if(isset($thumbDimensionsWithKeys[$key]))
			{
				unset($thumbDimensionsWithKeys[$key]);
				KalturaLog::log("Assign thumb asset [" . $thumbAsset->getId() . "] from dimension [$key]");
				$thumbAssetsIds[] = $thumbAsset->getId();
			}
		}
		$entryDistribution->setThumbAssetIds($thumbAssetsIds);
		
		return ($originalList != $entryDistribution->getThumbAssetIds());
	}
	
	/**
	 * @param entry $entry
	 * @param DistributionProfile $distributionProfile
	 * @return EntryDistribution
	 */
	public static function createEntryDistribution(entry $entry, DistributionProfile $distributionProfile)
	{
		$entryDistribution = new EntryDistribution();
		$entryDistribution->setEntryId($entry->getId());
		$entryDistribution->setPartnerId($entry->getPartnerId());
		$entryDistribution->setDistributionProfileId($distributionProfile->getId());
		$entryDistribution->setStatus(EntryDistributionStatus::PENDING);
		
		self::assignFlavorAssets($entryDistribution, $entry, $distributionProfile);
		self::assignThumbAssets($entryDistribution, $entry, $distributionProfile);
		
		$validationErrors = $distributionProfile->validateForSubmission($entryDistribution, DistributionAction::SUBMIT);
		$entryDistribution->setValidationErrorsArray($validationErrors);

		return $entryDistribution;
	}
	
	public static function getSearchStringNoDistributionProfiles()
	{
		return "contentDistNoProfiles";
	}
	
	public static function getSearchStringDistributionProfile($distributionProfileId = null)
	{
		if($distributionProfileId)
			return "contentDistProfile $distributionProfileId";
			
		return "contentDistProfile $distributionProfileId";
	}
	
	public static function getSearchStringDistributionSunStatus($distributionSunStatus, $distributionProfileId = null)
	{
		if($distributionProfileId)
			return "entryDistSun $distributionSunStatus $distributionProfileId";
			
		return "entryDistSun $distributionSunStatus";
	}
	
	public static function getSearchStringDistributionFlag($entryDistributionFlag, $distributionProfileId = null)
	{
		if(is_null($entryDistributionFlag))
			$entryDistributionFlag = EntryDistributionDirtyStatus::NONE;
			
		if($distributionProfileId)
			return "entryDistFlag $entryDistributionFlag $distributionProfileId";
			
		return "entryDistFlag $entryDistributionFlag";
	}
	
	public static function getSearchStringDistributionStatus($entryDistributionStatus, $distributionProfileId = null)
	{
		if($distributionProfileId)
			return "entryDistStatus $entryDistributionStatus $distributionProfileId";
			
		return "entryDistStatus $entryDistributionStatus";
	}
	
	public static function getSearchStringDistributionValidationError($validationErrorType = null, $distributionProfileId = null)
	{
		if($distributionProfileId)
			return "entryDistErr $validationErrorType $distributionProfileId";
			
		return "entryDistErr $validationErrorType";
	}
	
	public static function getSearchStringDistributionHasValidationError($distributionProfileId = null)
	{
		if($distributionProfileId)
			return "entryDistHasErr $distributionProfileId";
			
		return "entryDistHasErr";
	}
	
	public static function getSearchStringDistributionHasNoValidationError($distributionProfileId = null)
	{
		$ret = "contentDistProfile";
		if($distributionProfileId)
			$ret = "\"contentDistProfile $distributionProfileId\"";
			
		return "$ret -entryDistHasErr";
	}
	
	public static function getEntrySearchValues(entry $entry)
	{
		if(!ContentDistributionPlugin::isAllowedPartner($entry->getPartnerId()))
			return null;
			
		$entryDistributions = EntryDistributionPeer::retrieveByEntryId($entry->getId());
		if(!count($entryDistributions))
			return self::getSearchStringNoDistributionProfiles();
			
		$searchValues = array();
		foreach($entryDistributions as $entryDistribution)
		{
			$distributionProfileId = $entryDistribution->getDistributionProfileId();
			$searchValues[] = self::getSearchStringDistributionProfile($distributionProfileId);
			$searchValues[] = self::getSearchStringDistributionStatus($entryDistribution->getStatus(), $distributionProfileId);
			$searchValues[] = self::getSearchStringDistributionFlag($entryDistribution->getDirtyStatus(), $distributionProfileId);
			$searchValues[] = self::getSearchStringDistributionSunStatus($entryDistribution->getSunStatus(), $distributionProfileId);
			
			$validationErrors = $entryDistribution->getValidationErrors();
			if(count($validationErrors))
				$searchValues[] = self::getSearchStringDistributionHasValidationError($distributionProfileId);
				
			foreach($validationErrors as $validationError)
				$searchValues[] = self::getSearchStringDistributionValidationError($validationError->getErrorType(), $distributionProfileId);
		}
		return implode(',', $searchValues);
	}
}