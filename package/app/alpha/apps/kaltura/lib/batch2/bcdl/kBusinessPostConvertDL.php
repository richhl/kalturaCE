<?php

class kBusinessPostConvertDL
{
	public static function handleFlavorReady(BatchJob $dbBatchJob, $flavorAssetId)
	{
		// verifies that flavor asset created
		if(!$flavorAssetId)
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $flavorAssetId);
	
		$currentFlavorAsset = flavorAssetPeer::retrieveById($flavorAssetId);
		// verifies that flavor asset exists
		if(!$currentFlavorAsset)
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $flavorAssetId);

		// if the flavor deleted then it shouldn't be taken into ready calculations
		if($currentFlavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_DELETED)
			return $currentFlavorAsset;
		
//		Remarked because we want the original flavor ready behavior to work the same as other flavors
//
//		$rootBatchJob = $dbBatchJob->getRootJob();
//		
//		// happens in case of post convert on the original (in case of bypass)
//		if($rootBatchJob && $currentFlavorAsset->getIsOriginal())
//		{
//			kJobsManager::updateBatchJob($rootBatchJob, BatchJob::BATCHJOB_STATUS_FINISHED);
//			return $dbBatchJob;
//		}
					
		$sourceMediaInfo = mediaInfoPeer::retrieveOriginalByEntryId($dbBatchJob->getEntryId());
		$productMediaInfo = mediaInfoPeer::retrieveByFlavorAssetId($currentFlavorAsset->getId());
		$targetFlavor = null;
		
		try{
			if(!$currentFlavorAsset->getIsOriginal() && $targetFlavor && $productMediaInfo)
			{
				$productFlavor = KDLWrap::CDLValidateProduct($sourceMediaInfo, $targetFlavor, $productMediaInfo);
				
				$err = kBusinessConvertDL::parseFlavorDescription($productFlavor);
				kLog::log("BCDL: job id [" . $dbBatchJob->getId() . "] flavor params output id [" . $targetFlavor->getId() . "] flavor asset id [" . $currentFlavorAsset->getId() . "] desc: $err");
	
				if(!$productFlavor->IsValid())
				{
					$description = $currentFlavorAsset->getDescription() . "\n$err";
					
					// mark the asset as ready 
					$currentFlavorAsset->setDescription($description);
					$currentFlavorAsset->setStatus(flavorAsset::FLAVOR_ASSET_STATUS_ERROR);
					$currentFlavorAsset->save();
					
					if(!kConf::get('ignore_cdl_failure'))
						return kJobsManager::failBatchJob($dbBatchJob, $err);
				}
			}
		}
		catch(Exception $e){
			kLog::log('BCDL Error: ' . print_r($e, true));
		}
		
		// mark the asset as ready 
		$currentFlavorAsset->setStatus(flavorAsset::FLAVOR_ASSET_STATUS_READY);
		$currentFlavorAsset->save();
		
		return $currentFlavorAsset;
	}
	
	public static function handleConvertFinished(BatchJob $dbBatchJob, $currentFlavorAsset)
	{
		$currentReadyBehavior = null;
		if($currentFlavorAsset->getIsOriginal())
		{
			try{
				$profile = myPartnerUtils::getConversionProfile2ForEntry($dbBatchJob->getEntryId());
				if($profile)
				{
					$flavorParamsConversionProfile = flavorParamsConversionProfilePeer::retrieveByFlavorParamsAndConversionProfile(flavorParams::SOURCE_FLAVOR_ID, $profile->getId());
					if($flavorParamsConversionProfile)
						$currentReadyBehavior = $flavorParamsConversionProfile->getReadyBehavior();
				}
			}
			catch(Exception $e)
			{
				kLog::log(__METHOD__ . ': getConversionProfile2ForEntry Error: ' . $e->getMessage());
			}
		}
		else 
		{
			$targetFlavor = flavorParamsOutputPeer::retrieveByFlavorAssetId($currentFlavorAsset->getId());
			if($targetFlavor)
				$currentReadyBehavior = $targetFlavor->getReadyBehavior();
		}
		
		$rootBatchJob = $dbBatchJob->getRootJob();
		
		// update the root job end exit
		if($rootBatchJob && $rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_REMOTE_CONVERT)
		{
			kJobsManager::updateBatchJob($rootBatchJob, BatchJob::BATCHJOB_STATUS_FINISHED);
			return $dbBatchJob;
		}
		
		// update the root job end exit
		if($rootBatchJob && $rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_BULKDOWNLOAD)
		{
			$siblingJobs = $rootBatchJob->getChildJobs();
			foreach($siblingJobs as $siblingJob)
			{
				// checking only conversion child jobs
				if(
					$siblingJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT
					&&
					$siblingJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT_COLLECTION
					&&
					$siblingJob->getJobType() != BatchJob::BATCHJOB_TYPE_POSTCONVERT
					)
					continue;
					
				// if not complete leave function
				if($siblingJob->getStatus() != BatchJob::BATCHJOB_STATUS_FINISHED)
					return $dbBatchJob;
			}
			// all child jobs completed
			kJobsManager::updateBatchJob($rootBatchJob, BatchJob::BATCHJOB_STATUS_FINISHED);
			return $dbBatchJob;
		}
		
		// go over all the conversion jobs in the context
		$hasInComplte = false;
		$hasInComplteRequired = false;
		$siblingFlavorAssets = flavorAssetPeer::retrieveByEntryId($dbBatchJob->getEntryId());
		foreach($siblingFlavorAssets as $siblingFlavorAsset)
		{
			if($siblingFlavorAsset->getId() == $currentFlavorAsset->getId())
				continue;
			
			// don't mark any incomplete flag
			if($siblingFlavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_READY)
				continue;
				
			if($siblingFlavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_QUEUED || $siblingFlavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_CONVERTING)
				$hasInComplte = true;
						
			$readyBehavior = null;
			if($siblingFlavorAsset->getIsOriginal())
			{
				try{
					$profile = myPartnerUtils::getConversionProfile2ForEntry($dbBatchJob->getEntryId());
					if($profile)
					{
						$flavorParamsConversionProfile = flavorParamsConversionProfilePeer::retrieveByFlavorParamsAndConversionProfile(flavorParams::SOURCE_FLAVOR_ID, $profile->getId());
						if($flavorParamsConversionProfile)
							$readyBehavior = $flavorParamsConversionProfile->getReadyBehavior();
					}
				}
				catch(Exception $e)
				{
					kLog::log(__METHOD__ . ': getConversionProfile2ForEntry Error: ' . $e->getMessage());
				}
			}
			else
			{
				$siblingFlavorParamsOutput = flavorParamsOutputPeer::retrieveByFlavorAssetId($siblingFlavorAsset->getId());
				if($siblingFlavorParamsOutput)
					$readyBehavior = $siblingFlavorParamsOutput->getReadyBehavior();
			}
			
			if($readyBehavior == flavorParamsConversionProfile::READY_BEHAVIOR_REQUIRED)
				$hasInComplteRequired = true;
		}
				
		if($hasInComplteRequired)
		{
			kLog::log('Convert Finished - has In-Complte Required jobs');
		} 
		elseif($currentReadyBehavior == flavorParamsConversionProfile::READY_BEHAVIOR_OPTIONAL)
		{
			// mark the entry as ready if all required conversions completed or any of the optionals
			kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_READY);
		}
		
		// no need to finished the root job
		if(!$rootBatchJob)
		{
			kLog::log('Convert Finished - no root job to close');
			return $dbBatchJob;
		}
			
		// only bulk-download and convert-profile are pending on the conversions to close them, otherwise, return
		if($rootBatchJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE)
		{
			kLog::log('Convert Finished - root job type [' . $rootBatchJob->getJobType() . ']');
			return $dbBatchJob;
		}
		
		if($hasInComplte)
		{
			kLog::log('Convert Finished - has In-Complte jobs');
		}
		else //if(!$currentFlavorAsset->getIsOriginal())
		{
			// mark the context root job as finished only if all conversion jobs are completed
			kJobsManager::updateBatchJob($rootBatchJob, BatchJob::BATCHJOB_STATUS_FINISHED);
		}
			
		return $dbBatchJob;
	}
	
	/**
	 * @param BatchJob $dbBatchJob
	 * @param kConvertCollectionJobData $data
	 * @param int $engineType
	 * @return boolean
	 */
	public static function handleConvertCollectionFailed(BatchJob $dbBatchJob, kConvertCollectionJobData $data, $engineType)
	{
		$collectionFlavors = array();
		foreach($data->getFlavors() as $flavor)
			$collectionFlavors[$flavor->getFlavorAssetId()] = $flavor;
				
		// find the root job
		$rootBatchJob = $dbBatchJob->getRootJob();
			
		$hasIncomplete = false;
		$shouldFailProfile = false;
		$flavorAssets = flavorAssetPeer::retrieveByEntryId($dbBatchJob->getEntryId());
		foreach($flavorAssets as $flavorAsset)
		{
			if(isset($collectionFlavors[$flavorAsset->getId()]))
			{
				$flavorAsset->setStatus(flavorAsset::FLAVOR_ASSET_STATUS_ERROR);
				$flavorAsset->save();
				
				if(!$rootBatchJob)
					continue;
				
				$flavorData = $collectionFlavors[$flavorAsset->getId()];
				if($flavorData->getReadyBehavior() == flavorParamsConversionProfile::READY_BEHAVIOR_REQUIRED)
					$shouldFailProfile = true;
					
				continue;
			}
			
			if($flavorAsset->getIsOriginal())
				continue;
				
			if($flavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_QUEUED || $flavorAsset->getStatus() == flavorAsset::FLAVOR_ASSET_STATUS_CONVERTING)
				$hasIncomplete = true;
		}
		
		if(!$rootBatchJob)
			return false;
			
		if($rootBatchJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE)
			return false;
			
		if($shouldFailProfile || !$hasIncomplete)
			kJobsManager::failBatchJob($rootBatchJob, "Job " . $dbBatchJob->getId() . " failed");
		
		return false;
	}
	
	public static function handleConvertFailed(BatchJob $dbBatchJob, $engineType, $flavorAssetId, $flavorParamsOutputId, $mediaInfoId)
	{
		$flavorAsset = flavorAssetPeer::retrieveById($flavorAssetId);
		// verifies that flavor asset exists
		if(!$flavorAsset)
			throw new APIException(APIErrors::INVALID_FLAVOR_ASSET_ID, $flavorAssetId);
		
		$flavorAsset->setStatus(flavorAsset::FLAVOR_ASSET_STATUS_ERROR);
		$flavorAsset->save();
		
		
		// try to create a convert job with the next engine
		if(!is_null($engineType))
		{
			$newDbBatchJob = kBusinessPreConvertDL::redecideFlavorConvert($flavorAssetId, $flavorParamsOutputId, $mediaInfoId, $dbBatchJob, $engineType);
			if($newDbBatchJob)
				return true;
		}
			
		// find the root job
		$rootBatchJob = $dbBatchJob->getRootJob();
		if(!$rootBatchJob)
			return false;
		
		// the root is already failed
		if($rootBatchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FAILED || $rootBatchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FATAL)
			return false;

		// failing a remote root job 
		if($rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_REMOTE_CONVERT)
		{
			kJobsManager::failBatchJob($rootBatchJob, "Convert job " . $dbBatchJob->getId() . " failed");
			return false;
		}
			
		// bulk download root job no need to handle 
		if($rootBatchJob->getJobType() == BatchJob::BATCHJOB_TYPE_BULKDOWNLOAD)
		{
			kJobsManager::failBatchJob($rootBatchJob, "Convert job " . $dbBatchJob->getId() . " failed");
			return false;
		}
			
		if(is_null($flavorParamsOutputId))
		{
			kJobsManager::failBatchJob($rootBatchJob, "Job " . $dbBatchJob->getId() . " failed");
			kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_ERROR_CONVERTING);
			return false;
		}
		
		$readyBehavior = $dbBatchJob->getData()->getReadyBehavior();
		if($readyBehavior == flavorParamsConversionProfile::READY_BEHAVIOR_REQUIRED)
		{
			kJobsManager::failBatchJob($rootBatchJob, "Job " . $dbBatchJob->getId() . " failed");
			kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_ERROR_CONVERTING);
			return false;
		}
		
		// failing the root profile job if all child jobs failed 
		if($rootBatchJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT_PROFILE)
			return false;
		
		$siblingJobs = $rootBatchJob->getChildJobs();
		foreach($siblingJobs as $siblingJob)
		{
			// not conversion job and should be ignored
			if($siblingJob->getJobType() != BatchJob::BATCHJOB_TYPE_CONVERT && $siblingJob->getJobType() != BatchJob::BATCHJOB_TYPE_POSTCONVERT)
				continue;
					
			// found job that not failed, no need to fail the root job
			if($siblingJob->getStatus() != BatchJob::BATCHJOB_STATUS_FAILED && $siblingJob->getStatus() != BatchJob::BATCHJOB_STATUS_FATAL)
				return false;
		}
				
		// all conversions failed, should fail the root job
		kJobsManager::failBatchJob($rootBatchJob, "All conversions failed");
		kBatchManager::updateEntry($dbBatchJob, entry::ENTRY_STATUS_ERROR_CONVERTING);
		return false;
	}
	
}