<?php

/**
 * Conversion Profile Service
 *
 * @service conversionProfile
 * @package api
 * @subpackage services
 */
class ConversionProfileService extends KalturaBaseService
{
	/**
	 * Add new conversion profile and set it as the current
	 * 
	 * @action addCurrent
	 * @param KalturaConversionProfile $conversionProfile
	 * @return KalturaConversionProfile
	 */
	function addCurrentAction(KalturaConversionProfile $conversionProfile)
	{
		$conversionProfile->validatePropertyNotNull("name");
		$conversionProfile->validatePropertyNotNull("profileType");
		$conversionProfile->validatePropertyNotNull("aspectRatioType");
		
		$dbConvertionProfile = $conversionProfile->toObject(new ConversionProfile());
		$partnerConvertionProfile = ConversionProfilePeer::retrieveSimilar($this->getPartnerId(), $dbConvertionProfile);
		if (!$partnerConvertionProfile)
		{
			$dbConvertionProfile->setPartnerId($this->getPartnerId());
			$dbConvertionProfile->setEnabled(1);
			$dbConvertionProfile->save();
			
			$partnerConvertionProfile = $dbConvertionProfile;
		}
		
		$partnerConvertionProfile->setUpdatedAt(time());
		$partnerConvertionProfile->save();
		
		myPartnerUtils::setCurrentConversionProfile($this->getPartnerId(), $partnerConvertionProfile->getId());
		
		$conversionProfile->fromObject($partnerConvertionProfile);
			
		return $conversionProfile;
	}
	
	/**
	 * Get the current used conversion profile
	 * 
	 * @action getCurrent
	 * @return KalturaConversionProfile
	 */
	function getCurrentAction()
	{
		$dbConvertionProfile = myPartnerUtils::getCurrentConversionProfile($this->getPartnerId());
		
		$conversionProfile = new KalturaConversionProfile();
		$conversionProfile->fromObject($dbConvertionProfile);
		return $conversionProfile;
	}
}