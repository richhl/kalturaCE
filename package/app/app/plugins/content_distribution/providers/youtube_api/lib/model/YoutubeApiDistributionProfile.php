<?php
/**
 * @package plugins.youtubeApiDistribution
 * @subpackage model
 */
class YoutubeApiDistributionProfile extends DistributionProfile
{
	const CUSTOM_DATA_USERNAME = 'username';
	const CUSTOM_DATA_PASSWORD = 'password';
	const CUSTOM_DATA_DEFAULT_CATEGORY = 'defaultCategory';
	const CUSTOM_DATA_ALLOW_COMMENTS = 'allowComments';
	const CUSTOM_DATA_ALLOW_EMBEDDING = 'allowEmbedding';
	const CUSTOM_DATA_ALLOW_RATINGS = 'allowRatings';
	const CUSTOM_DATA_ALLOW_RESPONSES = 'allowResponses';
	const CUSTOM_DATA_METADATA_PROFILE_ID = 'metadataProfileId';

	const METADATA_FIELD_DESCRIPTION = 'YoutubeDescription';
	const METADATA_FIELD_TAGS = 'YoutubeKeywords';
	const METADATA_FIELD_PLAYLIST = 'YouTubePlaylist';
	const METADATA_FIELD_PLAYLISTS = 'YouTubePlaylists';
	
	const ENTRY_NAME_MINIMUM_LENGTH = 1;
	const ENTRY_NAME_MAXIMUM_LENGTH = 60;
	const ENTRY_DESCRIPTION_MINIMUM_LENGTH = 1;
	const ENTRY_DESCRIPTION_MAXIMUM_LENGTH = 715;
	const ENTRY_TAGS_MINIMUM_LENGTH = 1;
	const ENTRY_TAGS_MAXIMUM_LENGTH = 500;
	const ENTRY_EACH_TAG_MANIMUM_LENGTH = 2;
	const ENTRY_EACH_TAG_MAXIMUM_LENGTH = 30;
	
	
	/* (non-PHPdoc)
	 * @see DistributionProfile::getProvider()
	 */
	public function getProvider()
	{
		return YoutubeApiDistributionPlugin::getProvider();
	}
		
	/**
	 * @param EntryDistribution $entryDistribution
	 * @param int $action enum from DistributionAction
	 * @param array $validationErrors
	 * @param bool $validateDescription
	 * @param bool $validateTags
	 * @return array
	 */
	public function validateMetadataForSubmission(EntryDistribution $entryDistribution, $action, array $validationErrors, &$validateDescription, &$validateTags)
	{
		$validateDescription = true;
		$validateTags = true;
		
		if(!class_exists('MetadataProfile'))
			return $validationErrors;
			
		$metadataProfileId = $this->getMetadataProfileId();
		if(!$metadataProfileId)
			return $validationErrors;
		
		$metadata = MetadataPeer::retrieveByObject($metadataProfileId, Metadata::TYPE_ENTRY, $entryDistribution->getEntryId());
		if(!$metadata)
			return $validationErrors;
			
		$metadataProfileCategoryField = MetadataProfileFieldPeer::retrieveByMetadataProfileAndKey($metadataProfileId, self::METADATA_FIELD_DESCRIPTION);
		if($metadataProfileCategoryField)
		{
			$values = $this->findMetadataValue(array($metadata), self::METADATA_FIELD_DESCRIPTION);
			if(count($values))
			{	
				foreach($values as $value)
				{
					if(!strlen($value))
						continue;
				
					$validateDescription = false;
					
					// validate entry description minumum length of 1 character
					if(strlen($value) < self::ENTRY_DESCRIPTION_MINIMUM_LENGTH)
					{
						$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, self::METADATA_FIELD_DESCRIPTION, 'YouTube description is too short');
						$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_SHORT);
						$validationError->setValidationErrorParam(self::ENTRY_DESCRIPTION_MINIMUM_LENGTH);
						$validationErrors[] = $validationError;
					}
				
					// validate entry description maximum length of 60 characters
					if(strlen($value) > self::ENTRY_DESCRIPTION_MAXIMUM_LENGTH)
					{
						$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, self::METADATA_FIELD_DESCRIPTION, 'YouTube description is too long');
						$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_LONG);
						$validationError->setValidationErrorParam(self::ENTRY_DESCRIPTION_MAXIMUM_LENGTH);
						$validationErrors[] = $validationError;
					}
				}
			}
		}
	
		$metadataProfileCategoryField = MetadataProfileFieldPeer::retrieveByMetadataProfileAndKey($metadataProfileId, self::METADATA_FIELD_TAGS);
		if($metadataProfileCategoryField)
		{
			$values = $this->findMetadataValue(array($metadata), self::METADATA_FIELD_TAGS);
			if(count($values))
			{	
				foreach($values as $value)
				{
					if(!strlen($value))
						continue;
				
					$validateTags = false;
					
					// validate entry tags minumum length of 1 character
					if(strlen($value) < self::ENTRY_TAGS_MINIMUM_LENGTH)
					{
						$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, self::METADATA_FIELD_TAGS, 'YouTube tags is too short');
						$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_SHORT);
						$validationError->setValidationErrorParam(self::ENTRY_TAGS_MINIMUM_LENGTH);
						$validationErrors[] = $validationError;
					}
				
					// validate entry tags maximum length of 60 characters
					if(strlen($value) > self::ENTRY_TAGS_MAXIMUM_LENGTH)
					{
						$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, self::METADATA_FIELD_TAGS, 'YouTube tags is too long');
						$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_LONG);
						$validationError->setValidationErrorParam(self::ENTRY_TAGS_MAXIMUM_LENGTH);
						$validationErrors[] = $validationError;
					}
				}
			}
		}
		
		return $validationErrors;
	}
	
	/* (non-PHPdoc)
	 * @see DistributionProfile::validateForSubmission()
	 */
	public function validateForSubmission(EntryDistribution $entryDistribution, $action)
	{
		$validationErrors = parent::validateForSubmission($entryDistribution, $action);
		$entry = entryPeer::retrieveByPK($entryDistribution->getEntryId());
		if(!$entry)
		{
			KalturaLog::err("Entry [" . $entryDistribution->getEntryId() . "] not found");
			$validationErrors[] = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, 'entry', 'entry not found');
			return $validationErrors;
		}
		
		// validate entry name minumum length of 1 character
		if(strlen($entry->getName()) < self::ENTRY_NAME_MINIMUM_LENGTH)
		{
			$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, entryPeer::NAME, '');
			$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_SHORT);
			$validationError->setValidationErrorParam(self::ENTRY_NAME_MINIMUM_LENGTH);
			$validationErrors[] = $validationError;
		}
		
		// validate entry name maximum length of 60 characters
		if(strlen($entry->getName()) > self::ENTRY_NAME_MAXIMUM_LENGTH)
		{
			$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, entryPeer::NAME, '');
			$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_LONG);
			$validationError->setValidationErrorParam(self::ENTRY_NAME_MAXIMUM_LENGTH);
			$validationErrors[] = $validationError;
		}
		
	
		$validateDescription = true;	
		$validateTags = true;
		$validationErrors = $this->validateMetadataForSubmission($entryDistribution, $action, $validationErrors, $validateDescription, $validateTags);
		
		if($validateDescription)
		{
			if(!strlen($entry->getDescription()))
			{
				$validationErrors[] = $this->createValidationError($action, DistributionErrorType::MISSING_METADATA, entryPeer::DESCRIPTION, 'Description is empty');
			}
			elseif(strlen($entry->getDescription()) < self::ENTRY_DESCRIPTION_MINIMUM_LENGTH)
			{
				$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, entryPeer::DESCRIPTION, 'Description is too short');
				$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_SHORT);
				$validationError->setValidationErrorParam(self::ENTRY_DESCRIPTION_MINIMUM_LENGTH);
				$validationErrors[] = $validationError;
			}
			elseif(strlen($entry->getDescription()) > self::ENTRY_DESCRIPTION_MAXIMUM_LENGTH)
			{
				$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, entryPeer::DESCRIPTION, 'Description is too log');
				$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_LONG);
				$validationError->setValidationErrorParam(self::ENTRY_DESCRIPTION_MAXIMUM_LENGTH);
				$validationErrors[] = $validationError;
			}
		}
	
		$tags = $entry->getTags();
		if($validateTags)
		{
			if(!strlen($tags))
			{
				$validationErrors[] = $this->createValidationError($action, DistributionErrorType::MISSING_METADATA, entryPeer::TAGS, 'Tags is empty');
			}
			elseif(strlen($tags) < self::ENTRY_TAGS_MINIMUM_LENGTH)
			{
				$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, entryPeer::TAGS, 'Tags is too short');
				$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_SHORT);
				$validationError->setValidationErrorParam(self::ENTRY_TAGS_MINIMUM_LENGTH);
				$validationErrors[] = $validationError;
			}
			elseif(strlen($tags) > self::ENTRY_TAGS_MAXIMUM_LENGTH)
			{
				$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, entryPeer::TAGS, 'Tags is too log');
				$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_LONG);
				$validationError->setValidationErrorParam(self::ENTRY_TAGS_MAXIMUM_LENGTH);
				$validationErrors[] = $validationError;
			}
		}
		elseif(class_exists('MetadataProfile')) 
		{
			$metadataProfileId = $this->getMetadataProfileId();
			$metadata = MetadataPeer::retrieveByObject($metadataProfileId, Metadata::TYPE_ENTRY, $entryDistribution->getEntryId());
			if($metadata)
			{
				$tagsArray = $this->findMetadataValue(array($metadata), self::METADATA_FIELD_TAGS);
				$tags = implode(',', $tagsArray);
			}
		}

		// validate each tag length between 2 and 30 characters
		$tags = explode(',', $tags);
		foreach($tags as &$tag)
			$tag = trim($tag);
			
		foreach($tags as $tag)
		{
			if (strlen($tag) < self::ENTRY_EACH_TAG_MANIMUM_LENGTH)
			{
				$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, 'Tag', $tag);
				$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_SHORT);
				$validationError->setValidationErrorParam(self::ENTRY_EACH_TAG_MANIMUM_LENGTH);
				$validationErrors[] = $validationError;
			}
			
			if (strlen($tag) > self::ENTRY_EACH_TAG_MAXIMUM_LENGTH)
			{
				$validationError = $this->createValidationError($action, DistributionErrorType::INVALID_DATA, 'Tag', $tag);
				$validationError->setValidationErrorType(DistributionValidationErrorType::STRING_TOO_LONG);
				$validationError->setValidationErrorParam(self::ENTRY_EACH_TAG_MAXIMUM_LENGTH);
				$validationErrors[] = $validationError;
			}
		}
		
		return $validationErrors;
	}

	public function getUsername()				{return $this->getFromCustomData(self::CUSTOM_DATA_USERNAME);}
	public function getPassword()				{return $this->getFromCustomData(self::CUSTOM_DATA_PASSWORD);}
	public function getDefaultCategory()		{return $this->getFromCustomData(self::CUSTOM_DATA_DEFAULT_CATEGORY);}
	public function getAllowComments()			{return $this->getFromCustomData(self::CUSTOM_DATA_ALLOW_COMMENTS);}
	public function getAllowEmbedding()			{return $this->getFromCustomData(self::CUSTOM_DATA_ALLOW_EMBEDDING);}
	public function getAllowRatings()			{return $this->getFromCustomData(self::CUSTOM_DATA_ALLOW_RATINGS);}
	public function getAllowResponses()			{return $this->getFromCustomData(self::CUSTOM_DATA_ALLOW_RESPONSES);}
	public function getMetadataProfileId()		{return $this->getFromCustomData(self::CUSTOM_DATA_METADATA_PROFILE_ID);}
	
	public function setUsername($v)				{$this->putInCustomData(self::CUSTOM_DATA_USERNAME, $v);}
	public function setPassword($v)				{$this->putInCustomData(self::CUSTOM_DATA_PASSWORD, $v);}
	public function setDefaultCategory($v)		{$this->putInCustomData(self::CUSTOM_DATA_DEFAULT_CATEGORY, $v);}
	public function setAllowComments($v)		{$this->putInCustomData(self::CUSTOM_DATA_ALLOW_COMMENTS, $v);}
	public function setAllowEmbedding($v)		{$this->putInCustomData(self::CUSTOM_DATA_ALLOW_EMBEDDING, $v);}
	public function setAllowRatings($v)			{$this->putInCustomData(self::CUSTOM_DATA_ALLOW_RATINGS, $v);}
	public function setAllowResponses($v)		{$this->putInCustomData(self::CUSTOM_DATA_ALLOW_RESPONSES, $v);}
	public function setMetadataProfileId($v)	{$this->putInCustomData(self::CUSTOM_DATA_METADATA_PROFILE_ID, $v);}}