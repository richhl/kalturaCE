<?php
require_once("KalturaClientBase.php");

define("KalturaAspectRatioType_KEEP_ORIG_RATIO", 1);
define("KalturaAspectRatioType_KEEP_ORIG_DIMENSIONS", 2);
define("KalturaAspectRatioType_ASPECT_4_3", 3);
define("KalturaAspectRatioType_ASPECT_16_9", 4);
define("KalturaAspectRatioType_KEEP_HEIGHT", 5);

define("KalturaBatchJobStatus_PENDING", 0);
define("KalturaBatchJobStatus_QUEUED", 1);
define("KalturaBatchJobStatus_PROCESSING", 2);
define("KalturaBatchJobStatus_PROCESSED", 3);
define("KalturaBatchJobStatus_MOVEFILE", 4);
define("KalturaBatchJobStatus_FINISHED", 5);
define("KalturaBatchJobStatus_FAILED", 6);
define("KalturaBatchJobStatus_ABORTED", 7);

define("KalturaBatchJobType_CONVERT", 0);
define("KalturaBatchJobType_IMPORT", 1);
define("KalturaBatchJobType_DELETE", 2);
define("KalturaBatchJobType_FLATTEN", 3);
define("KalturaBatchJobType_BULKUPLOAD", 4);
define("KalturaBatchJobType_DVDCREATOR", 5);
define("KalturaBatchJobType_DOWNLOAD", 6);
define("KalturaBatchJobType_OOCONVERT", 7);
define("KalturaBatchJobType_PRECONVERT", 10);
define("KalturaBatchJobType_POSTCONVERT", 11);
define("KalturaBatchJobType_PROJECT", 1000);

define("KalturaEditorType_SIMPLE", 1);
define("KalturaEditorType_ADVANCED", 2);

define("KalturaEntryStatus_ERROR_CONVERTING", -1);
define("KalturaEntryStatus_IMPORT", 0);
define("KalturaEntryStatus_PRECONVERT", 1);
define("KalturaEntryStatus_READY", 2);
define("KalturaEntryStatus_DELETED", 3);
define("KalturaEntryStatus_PENDING", 4);
define("KalturaEntryStatus_MODERATE", 5);
define("KalturaEntryStatus_BLOCKED", 6);

define("KalturaEntryType_AUTOMATIC", -1);
define("KalturaEntryType_MEDIA_CLIP", 1);
define("KalturaEntryType_MIX", 2);
define("KalturaEntryType_PLAYLIST", 5);
define("KalturaEntryType_DATA", 6);
define("KalturaEntryType_DOCUMENT", 10);

define("KalturaGender_UNKNOWN", 0);
define("KalturaGender_MALE", 1);
define("KalturaGender_FEMALE", 2);

define("KalturaLicenseType_UNKNOWN", -1);
define("KalturaLicenseType_NONE", 0);
define("KalturaLicenseType_COPYRIGHTED", 1);
define("KalturaLicenseType_PUBLIC_DOMAIN", 2);
define("KalturaLicenseType_CREATIVECOMMONS_ATTRIBUTION", 3);
define("KalturaLicenseType_CREATIVECOMMONS_ATTRIBUTION_SHARE_ALIKE", 4);
define("KalturaLicenseType_CREATIVECOMMONS_ATTRIBUTION_NO_DERIVATIVES", 5);
define("KalturaLicenseType_CREATIVECOMMONS_ATTRIBUTION_NON_COMMERCIAL", 6);
define("KalturaLicenseType_CREATIVECOMMONS_ATTRIBUTION_NON_COMMERCIAL_SHARE_ALIKE", 7);
define("KalturaLicenseType_CREATIVECOMMONS_ATTRIBUTION_NON_COMMERCIAL_NO_DERIVATIVES", 8);
define("KalturaLicenseType_GFDL", 9);
define("KalturaLicenseType_GPL", 10);
define("KalturaLicenseType_AFFERO_GPL", 11);
define("KalturaLicenseType_LGPL", 12);
define("KalturaLicenseType_BSD", 13);
define("KalturaLicenseType_APACHE", 14);
define("KalturaLicenseType_MOZILLA", 15);

define("KalturaMailJobStatus_PENDING", 1);
define("KalturaMailJobStatus_SENT", 2);
define("KalturaMailJobStatus_ERROR", 3);
define("KalturaMailJobStatus_QUEUED", 4);

define("KalturaMediaType_VIDEO", 1);
define("KalturaMediaType_IMAGE", 2);
define("KalturaMediaType_AUDIO", 5);

define("KalturaModerationFlagStatus_PENDING", 1);
define("KalturaModerationFlagStatus_MODERATED", 2);

define("KalturaModerationFlagType_SEXUAL_CONTENT", 1);
define("KalturaModerationFlagType_VIOLENT_REPULSIVE", 2);
define("KalturaModerationFlagType_HARMFUL_DANGEROUS", 3);
define("KalturaModerationFlagType_SPAM_COMMERCIALS", 4);

define("KalturaModerationObjectType_ENTRY", 2);
define("KalturaModerationObjectType_USER", 3);

define("KalturaNotificationObjectType_ENTRY", 1);
define("KalturaNotificationObjectType_KSHOW", 2);
define("KalturaNotificationObjectType_USER", 3);
define("KalturaNotificationObjectType_BATCH_JOB", 4);

define("KalturaNotificationStatus_PENDING", 1);
define("KalturaNotificationStatus_SENT", 2);
define("KalturaNotificationStatus_ERROR", 3);
define("KalturaNotificationStatus_SHOULD_RESEND", 4);
define("KalturaNotificationStatus_ERROR_RESENDING", 5);
define("KalturaNotificationStatus_SENT_SYNCH", 6);
define("KalturaNotificationStatus_QUEUED", 7);

define("KalturaNotificationType_ENTRY_ADD", 1);
define("KalturaNotificationType_ENTR_UPDATE_PERMISSIONS", 2);
define("KalturaNotificationType_ENTRY_DELETE", 3);
define("KalturaNotificationType_ENTRY_BLOCK", 4);
define("KalturaNotificationType_ENTRY_UPDATE", 5);
define("KalturaNotificationType_ENTRY_UPDATE_THUMBNAIL", 6);
define("KalturaNotificationType_ENTRY_UPDATE_MODERATION", 7);
define("KalturaNotificationType_USER_ADD", 21);
define("KalturaNotificationType_USER_BANNED", 26);

define("KalturaPartnerType_WIKI", 100);
define("KalturaPartnerType_WORDPRESS", 101);
define("KalturaPartnerType_DRUPAL", 102);
define("KalturaPartnerType_DEKIWIKI", 103);
define("KalturaPartnerType_COMMUNITY_EDITION", 105);

define("KalturaPlaylistType_DYNAMIC", 10);
define("KalturaPlaylistType_STATIC_LIST", 3);
define("KalturaPlaylistType_EXTERNAL", 101);

define("KalturaReportType_TOP_CONTENT", 1);
define("KalturaReportType_CONTENT_DROPOFF", 2);
define("KalturaReportType_CONTENT_INTERACTIONS", 3);
define("KalturaReportType_MAP_OVERLAY", 4);
define("KalturaReportType_TOP_CONTRIBUTORS", 5);
define("KalturaReportType_TOP_SYNDICATION", 6);
define("KalturaReportType_CONTENT_CONTRIBUTIONS", 7);

define("KalturaSearchProviderType_FLICKR", 3);
define("KalturaSearchProviderType_YOUTUBE", 4);
define("KalturaSearchProviderType_MYSPACE", 7);
define("KalturaSearchProviderType_PHOTOBUCKET", 8);
define("KalturaSearchProviderType_JAMENDO", 9);
define("KalturaSearchProviderType_CCMIXTER", 10);
define("KalturaSearchProviderType_NYPL", 11);
define("KalturaSearchProviderType_CURRENT", 12);
define("KalturaSearchProviderType_MEDIA_COMMONS", 13);
define("KalturaSearchProviderType_KALTURA", 20);
define("KalturaSearchProviderType_KALTURA_USER_CLIPS", 21);
define("KalturaSearchProviderType_ARCHIVE_ORG", 22);
define("KalturaSearchProviderType_KALTURA_PARTNER", 23);
define("KalturaSearchProviderType_METACAFE", 24);
define("KalturaSearchProviderType_SEARCH_PROXY", 28);

define("KalturaSessionType_USER", 0);
define("KalturaSessionType_ADMIN", 2);

define("KalturaSourceType_FILE", 1);
define("KalturaSourceType_WEBCAM", 2);
define("KalturaSourceType_URL", 5);
define("KalturaSourceType_SEARCH_PROVIDER", 6);

define("KalturaStatsEventType_WIDGET_LOADED", 1);
define("KalturaStatsEventType_MEDIA_LOADED", 2);
define("KalturaStatsEventType_PLAY", 3);
define("KalturaStatsEventType_PLAY_REACHED_25", 4);
define("KalturaStatsEventType_PLAY_REACHED_50", 5);
define("KalturaStatsEventType_PLAY_REACHED_75", 6);
define("KalturaStatsEventType_PLAY_REACHED_100", 7);
define("KalturaStatsEventType_OPEN_EDIT", 8);
define("KalturaStatsEventType_OPEN_VIRAL", 9);
define("KalturaStatsEventType_OPEN_DOWNLOAD", 10);
define("KalturaStatsEventType_OPEN_REPORT", 11);
define("KalturaStatsEventType_BUFFER_START", 12);
define("KalturaStatsEventType_BUFFER_END", 13);
define("KalturaStatsEventType_OPEN_FULL_SCREEN", 14);
define("KalturaStatsEventType_CLOSE_FULL_SCREEN", 15);
define("KalturaStatsEventType_REPLAY", 16);
define("KalturaStatsEventType_SEEK", 17);
define("KalturaStatsEventType_OPEN_UPLOAD", 18);
define("KalturaStatsEventType_SAVE_PUBLISH", 19);
define("KalturaStatsEventType_CLOSE_EDITOR", 20);
define("KalturaStatsEventType_PRE_BUMPER_PLAYED", 21);
define("KalturaStatsEventType_POST_BUMPER_PLAYED", 22);
define("KalturaStatsEventType_BUMPER_CLICKED", 23);
define("KalturaStatsEventType_FUTURE_USE_1", 24);
define("KalturaStatsEventType_FUTURE_USE_2", 25);
define("KalturaStatsEventType_FUTURE_USE_3", 26);

define("KalturaUiConfCreationMode_WIZARD", 2);
define("KalturaUiConfCreationMode_ADVANCED", 3);

define("KalturaUiConfObjType_PLAYER", 1);
define("KalturaUiConfObjType_CONTRIBUTION_WIZARD", 2);
define("KalturaUiConfObjType_SIMPLE_EDITOR", 3);
define("KalturaUiConfObjType_ADVANCED_EDITOR", 4);
define("KalturaUiConfObjType_PLAYLIST", 5);
define("KalturaUiConfObjType_APP_STUDIO", 6);

define("KalturaUserStatus_BLOCKED", 0);
define("KalturaUserStatus_ACTIVE", 1);
define("KalturaUserStatus_DELETED", 2);

define("KalturaWidgetSecurityType_NONE", 1);
define("KalturaWidgetSecurityType_TIMEHASH", 2);

class KalturaAdminUser extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $password = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $email = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $screenName = null;


}

class KalturaBaseEntry extends KalturaObjectBase
{
	/**
	 * Auto generated 10 characters alphanumeric string
	 *
	 * @var string
	 * @readonly
	 */
	var $id = null;

	/**
	 * Entry name (Min 1 chars)
	 *
	 * @var string
	 */
	var $name = null;

	/**
	 * Entry description
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * The ID of the user who is the owner of this entry 
	 *
	 * @var string
	 */
	var $userId = null;

	/**
	 * Entry tags
	 *
	 * @var string
	 */
	var $tags = null;

	/**
	 * Entry admin tags can be updated only by administrators
	 *
	 * @var string
	 */
	var $adminTags = null;

	/**
	 * 
	 *
	 * @var KalturaEntryStatus
	 * @readonly
	 */
	var $status = null;

	/**
	 * The type of the entry, this is auto filled by the derived entry object
	 *
	 * @var KalturaEntryType
	 * @readonly
	 */
	var $type = null;

	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * Calculated rank
	 *
	 * @var int
	 * @readonly
	 */
	var $rank = null;

	/**
	 * The total (sum) of all votes
	 *
	 * @var int
	 * @readonly
	 */
	var $totalRank = null;

	/**
	 * Number of votes
	 *
	 * @var int
	 * @readonly
	 */
	var $votes = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $groupId = null;

	/**
	 * Can be used to store various partner related data as a string 
	 *
	 * @var string
	 */
	var $partnerData = null;

	/**
	 * Download URL for the entry
	 *
	 * @var string
	 * @readonly
	 */
	var $downloadUrl = null;

	/**
	 * Indexed search text for full text search
	 *
	 * @var string
	 * @readonly
	 */
	var $searchText = null;

	/**
	 * License type used for this entry
	 *
	 * @var KalturaLicenseType
	 */
	var $licenseType = null;

	/**
	 * Version of the entry data
	 *
	 * @var int
	 * @readonly
	 */
	var $version = null;

	/**
	 * Thumbnail URL
	 *
	 * @var string
	 * @readonly
	 */
	var $thumbnailUrl = null;


}

class KalturaFilter extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $orderBy = null;


}

class KalturaBaseEntryFilter extends KalturaFilter
{
	/**
	 * This filter should be in use for retrieving only a specific entry (identified by its entryId).
	 *
	 * @var string
	 */
	var $idEqual = null;

	/**
	 * This filter should be in use for retrieving few specific entries (string should include comma separated list of entryId strings).
	 *
	 * @var string
	 */
	var $idIn = null;

	/**
	 * This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry names. It should include only one pattern for matching entry names against.
	 *
	 * @var string
	 */
	var $nameLike = null;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry names. It could include few (comma separated) patterns for matching entry names against, while applying an OR logic to retrieve entries that match at least one input pattern.
	 *
	 * @var string
	 */
	var $nameMultiLikeOr = null;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on entry names. It could include few (comma separated) patterns for matching entry names against, while applying an AND logic to retrieve entries that match all input patterns.
	 *
	 * @var string
	 */
	var $nameMultiLikeAnd = null;

	/**
	 * This filter should be in use for retrieving entries with a specific name.
	 *
	 * @var string
	 */
	var $nameEqual = null;

	/**
	 * This filter should be in use for retrieving only entries which were uploaded by/assigned to users of a specific Kaltura Partner (identified by Partner ID).
	 *
	 * @var int
	 */
	var $partnerIdEqual = null;

	/**
	 * This filter should be in use for retrieving only entries within Kaltura network which were uploaded by/assigned to users of few Kaltura Partners  (string should include comma separated list of PartnerIDs)
	 *
	 * @var string
	 */
	var $partnerIdIn = null;

	/**
	 * This filter parameter should be in use for retrieving only entries, uploaded by/assigned to a specific user (identified by user Id).
	 *
	 * @var string
	 */
	var $userIdEqual = null;

	/**
	 * This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry tags. It should include only one pattern for matching entry tags against.
	 *
	 * @var string
	 */
	var $tagsLike = null;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match at least one input pattern.
	 *
	 * @var string
	 */
	var $tagsMultiLikeOr = null;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags.  It could include few (comma separated) patterns for matching entry tags against, while applying an AND logic to retrieve entries that match all input patterns.
	 *
	 * @var string
	 */
	var $tagsMultiLikeAnd = null;

	/**
	 * This filter should be in use for retrieving specific entries while applying an SQL 'LIKE' pattern matching on entry tags, set by an ADMIN user. It should include only one pattern for matching entry tags against.
	 *
	 * @var string
	 */
	var $adminTagsLike = null;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags, set by an ADMIN user.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match at least one input pattern.
	 *
	 * @var string
	 */
	var $adminTagsMultiLikeOr = null;

	/**
	 * This filter should be in use for retrieving specific entries, while applying an SQL 'LIKE' pattern matching on tags, set by an ADMIN user.  It could include few (comma separated) patterns for matching entry tags against, while applying an OR logic to retrieve entries that match all input patterns.
	 *
	 * @var string
	 */
	var $adminTagsMultiLikeAnd = null;

	/**
	 * This filter should be in use for retrieving only entries, at a specific {@link ?object=KalturaEntryStatus KalturaEntryStatus}.
	 *
	 * @var KalturaEntryStatus
	 */
	var $statusEqual = null;

	/**
	 * This filter should be in use for retrieving only entries, at few specific {@link ?object=KalturaEntryStatus KalturaEntryStatus}.
	 *
	 * @var string
	 */
	var $statusIn = null;

	/**
	 * 
	 *
	 * @var KalturaEntryType
	 */
	var $typeEqual = null;

	/**
	 * This filter should be in use for retrieving entries of few {@link ?object=KalturaEntryType KalturaEntryType} (string should include a comma separated list of {@link ?object=KalturaEntryType KalturaEntryType} enumerated parameters).
	 *
	 * @var string
	 */
	var $typeIn = null;

	/**
	 * This filter parameter should be in use for retrieving only entries which were created at Kaltura system after a specific time/date (standard timestamp format).
	 *
	 * @var int
	 */
	var $createdAtGreaterThanOrEqual = null;

	/**
	 * This filter parameter should be in use for retrieving only entries which were created at Kaltura system before a specific time/date (standard timestamp format).
	 *
	 * @var int
	 */
	var $createdAtLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $groupIdEqual = null;

	/**
	 * This filter should be in use for retrieving specific entries while search match the input string within all of the following metadata attributes: name, description, tags, adminTags.
	 *
	 * @var string
	 */
	var $searchTextMatchAnd = null;

	/**
	 * This filter should be in use for retrieving specific entries while search match the input string within at least one of the following metadata attributes: name, description, tags, adminTags.
	 *
	 * @var string
	 */
	var $searchTextMatchOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsNameMultiLikeOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsAdminTagsMultiLikeOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsAdminTagsNameMultiLikeOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsNameMultiLikeAnd = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsAdminTagsMultiLikeAnd = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsAdminTagsNameMultiLikeAnd = null;


}

class KalturaBaseEntryListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaBaseEntryArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaBaseEntryOrderBy extends KalturaObjectBase
{

}

class KalturaBaseJob extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $updatedAt = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $processorName = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $processorLocation = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $processorExpiration = null;


}

class KalturaBatchGetExclusiveNotificationJobsResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaNotificationArray
	 * @readonly
	 */
	var $notifications;

	/**
	 * 
	 *
	 * @var KalturaPartnerArray
	 * @readonly
	 */
	var $partners;


}

class KalturaBatchJob extends KalturaBaseJob
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $entryId = null;

	/**
	 * 
	 *
	 * @var KalturaBatchJobType
	 * @readonly
	 */
	var $jobType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $data = null;

	/**
	 * 
	 *
	 * @var KalturaBatchJobStatus
	 */
	var $status = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $abort = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $checkAgainTimeout = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $progress = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $message = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $updatesCount = null;

	/**
	 * When one job creates another - the parent should set this parentJobId to be its own id.
	 *
	 * @var int
	 */
	var $parentJobId = null;


}

class KalturaBulkUpload extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $uploadedBy = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $uploadedOn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $numOfEntries = null;

	/**
	 * 
	 *
	 * @var KalturaBatchJobStatus
	 */
	var $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $logFileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $csvFileUrl = null;


}

class KalturaBulkUploadListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaBulkUploads
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaCEError extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $browser = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $serverIp = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $serverOs = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $phpVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $ceAdminEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $data = null;


}

class KalturaClientNotification extends KalturaObjectBase
{
	/**
	 * The URL where the notification should be sent to 
	 *
	 * @var string
	 */
	var $url = null;

	/**
	 * The serialized notification data to send
	 *
	 * @var string
	 */
	var $data = null;


}

class KalturaCommercialUseType extends KalturaObjectBase
{

}

class KalturaConversionProfile extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $name = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $profileType = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $commercialTranscoder = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $width = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $height = null;

	/**
	 * 
	 *
	 * @var KalturaAspectRatioType
	 */
	var $aspectRatioType = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $bypassFlv = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $updatedAt = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $profileTypeSuffix = null;


}

class KalturaFilterPager extends KalturaObjectBase
{
	/**
	 * The number of objects to retrieve. Maximum page size is 50.
	 *
	 * @var int
	 */
	var $pageSize = null;

	/**
	 * The page number for which {pageSize} of objects should be retrieved.
	 *
	 * @var int
	 */
	var $pageIndex = null;


}

class KalturaMailJob extends KalturaBaseJob
{
	/**
	 * 
	 *
	 * @var int
	 */
	var $mailType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $mailPriority = null;

	/**
	 * 
	 *
	 * @var KalturaMailJobStatus
	 */
	var $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $recipientName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $recipientEmail = null;

	/**
	 * kuserId  
	 *
	 * @var int
	 */
	var $recipientId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $fromName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $fromEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $bodyParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $subjectParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $templatePath = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $culture = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $campaignId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $minSendDate = null;


}

class KalturaPlayableEntry extends KalturaBaseEntry
{
	/**
	 * Number of plays
	 *
	 * @var int
	 * @readonly
	 */
	var $plays = null;

	/**
	 * Number of views
	 *
	 * @var int
	 * @readonly
	 */
	var $views = null;

	/**
	 * The width in pixels
	 *
	 * @var int
	 * @readonly
	 */
	var $width = null;

	/**
	 * The height in pixels
	 *
	 * @var int
	 * @readonly
	 */
	var $height = null;

	/**
	 * The duration in seconds
	 *
	 * @var int
	 * @readonly
	 */
	var $duration = null;


}

class KalturaMediaEntry extends KalturaPlayableEntry
{
	/**
	 * The media type of the entry
	 *
	 * @var KalturaMediaType
	 * @insertonly
	 */
	var $mediaType = null;

	/**
	 * Override the default conversion quality  
	 *
	 * @var string
	 * @insertonly
	 */
	var $conversionQuality = null;

	/**
	 * The source type of the entry 
	 *
	 * @var KalturaSourceType
	 * @readonly
	 */
	var $sourceType = null;

	/**
	 * The search provider type used to import this entry
	 *
	 * @var KalturaSearchProviderType
	 * @readonly
	 */
	var $searchProviderType = null;

	/**
	 * The ID of the media in the importing site
	 *
	 * @var string
	 * @readonly
	 */
	var $searchProviderId = null;

	/**
	 * The user name used for credits
	 *
	 * @var string
	 */
	var $creditUserName = null;

	/**
	 * The URL for credits
	 *
	 * @var string
	 */
	var $creditUrl = null;

	/**
	 * The media date extracted from EXIF data (For images) as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	var $mediaDate = null;

	/**
	 * The URL used for playback. This is not the download URL.
	 *
	 * @var string
	 * @readonly
	 */
	var $dataUrl = null;


}

class KalturaPlayableEntryFilter extends KalturaBaseEntryFilter
{

}

class KalturaMediaEntryFilter extends KalturaPlayableEntryFilter
{
	/**
	 * 
	 *
	 * @var KalturaMediaType
	 */
	var $mediaTypeEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $mediaTypeIn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $mediaDateGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $mediaDateLessThanOrEqual = null;


}

class KalturaPlayableEntryOrderBy extends KalturaBaseEntryOrderBy
{

}

class KalturaMediaEntryOrderBy extends KalturaPlayableEntryOrderBy
{

}

class KalturaMediaListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaMediaEntryArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaMixEntry extends KalturaPlayableEntry
{
	/**
	 * Indicates whether the user has submited a real thumbnail to the mix (Not the one that was generated automaticaly)
	 *
	 * @var bool
	 * @readonly
	 */
	var $hasRealThumbnail = null;

	/**
	 * The editor type used to edit the metadata
	 *
	 * @var KalturaEditorType
	 */
	var $editorType = null;

	/**
	 * The xml data of the mix
	 *
	 * @var string
	 */
	var $dataContent = null;


}

class KalturaMixEntryFilter extends KalturaPlayableEntryFilter
{

}

class KalturaMixEntryOrderBy extends KalturaPlayableEntryOrderBy
{

}

class KalturaMixListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaMixEntryArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaModerationFlag extends KalturaObjectBase
{
	/**
	 * Moderation flag id
	 *
	 * @var int
	 * @readonly
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * The user id that added the moderation flag
	 *
	 * @var string
	 * @readonly
	 */
	var $userId = null;

	/**
	 * The type of the moderation flag (entry or user)
	 *
	 * @var KalturaModerationObjectType
	 * @readonly
	 */
	var $objectType = null;

	/**
	 * If moderation flag is set for entry, this is the flagged entry id
	 *
	 * @var string
	 */
	var $flaggedEntryId = null;

	/**
	 * If moderation flag is set for user, this is the flagged user id
	 *
	 * @var string
	 */
	var $flaggedUserId = null;

	/**
	 * The moderation flag status
	 *
	 * @var KalturaModerationFlagStatus
	 * @readonly
	 */
	var $status = null;

	/**
	 * The comment that was added to the flag
	 *
	 * @var string
	 */
	var $comments = null;

	/**
	 * 
	 *
	 * @var KalturaModerationFlagType
	 */
	var $flagType = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $updatedAt = null;


}

class KalturaModerationFlagListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaModerationFlagArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaNotification extends KalturaBaseJob
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $puserId = null;

	/**
	 * 
	 *
	 * @var KalturaNotificationType
	 */
	var $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $objectId = null;

	/**
	 * 
	 *
	 * @var KalturaNotificationStatus
	 */
	var $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $notificationData = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $numberOfAttempts = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $notificationResult = null;

	/**
	 * 
	 *
	 * @var KalturaNotificationObjectType
	 */
	var $objectType = null;


}

class KalturaPartner extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $name = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $website = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $notificationUrl = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $appearInSearch = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $adminName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $adminEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var KalturaCommercialUseType
	 */
	var $commercialUse;

	/**
	 * 
	 *
	 * @var string
	 */
	var $landingPage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $userLandingPage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $contentCategories = null;

	/**
	 * 
	 *
	 * @var KalturaPartnerType
	 */
	var $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $phone = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $describeYourself = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $adultContent = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $defConversionProfileType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $notify = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $status = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $allowQuickEdit = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $mergeEntryLists = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $notificationsConfig = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $maxUploadSize = null;

	/**
	 * readonly
	 *
	 * @var int
	 */
	var $partnerPackage = null;

	/**
	 * readonly
	 *
	 * @var string
	 */
	var $secret = null;

	/**
	 * readonly
	 *
	 * @var string
	 */
	var $adminSecret = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $cmsPassword = null;


}

class KalturaPartnerUsage extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var float
	 * @readonly
	 */
	var $hostingGB = null;

	/**
	 * 
	 *
	 * @var float
	 * @readonly
	 */
	var $Percent = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $packageBW = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $usageGB = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $reachedLimitDate = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $usageGraph = null;


}

class KalturaPlaylist extends KalturaBaseEntry
{
	/**
	 * Content of the playlist - 
	 * XML if the playlistType is dynamic 
	 * text if the playlistType is static 
	 * url if the playlistType is mRss 
	 *
	 * @var string
	 */
	var $playlistContent = null;

	/**
	 * Type of playlist  
	 *
	 * @var KalturaPlaylistType
	 */
	var $playlistType = null;

	/**
	 * Number of plays
	 *
	 * @var int
	 * @readonly
	 */
	var $plays = null;

	/**
	 * Number of views
	 *
	 * @var int
	 * @readonly
	 */
	var $views = null;

	/**
	 * The duration in seconds
	 *
	 * @var int
	 * @readonly
	 */
	var $duration = null;


}

class KalturaPlaylistFilter extends KalturaBaseEntryFilter
{

}

class KalturaPlaylistListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaPlaylistArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaPlaylistOrderBy extends KalturaBaseEntryOrderBy
{

}

class KalturaReportGraph extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $data = null;


}

class KalturaReportInputFilter extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 */
	var $fromDate = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $toDate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $keywords = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $searchInTags = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $searchInAdminTags = null;


}

class KalturaReportTable extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $header = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $data = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaReportTotal extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $header = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $data = null;


}

class KalturaSearch extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $keyWords = null;

	/**
	 * 
	 *
	 * @var KalturaSearchProviderType
	 */
	var $searchSource = null;

	/**
	 * 
	 *
	 * @var KalturaMediaType
	 */
	var $mediaType = null;

	/**
	 * Use this field to pass dynamic data for searching
	 * For example - if you set this field to "mymovies_$partner_id"
	 * The $partner_id will be automatically replcaed with your real partner Id
	 *
	 * @var string
	 */
	var $extraData = null;


}

class KalturaSearchResult extends KalturaSearch
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $title = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $thumbUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $url = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $sourceLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $credit = null;

	/**
	 * 
	 *
	 * @var KalturaLicenseType
	 */
	var $licenseType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $flashPlaybackType = null;


}

class KalturaSearchResultResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaSearchResultArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var bool
	 * @readonly
	 */
	var $needMediaInfo = null;


}

class KalturaStartWidgetSessionResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $ks = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $userId = null;


}

class KalturaStatsEvent extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $clientVer = null;

	/**
	 * 
	 *
	 * @var KalturaStatsEventType
	 */
	var $eventType = null;

	/**
	 * the client's timestamp of this event
	 *
	 * @var float
	 */
	var $eventTimestamp = null;

	/**
	 * a unique string generated by the client that will represent the client-side session: the primary component will pass it on to other components that sprout from it
	 *
	 * @var string
	 */
	var $sessionId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $entryId = null;

	/**
	 * the UV cookie - creates in the operational system and should be passed on ofr every event 
	 *
	 * @var string
	 */
	var $uniqueViewer = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $widgetId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $uiconfId = null;

	/**
	 * the partner's user id 
	 *
	 * @var string
	 */
	var $userId = null;

	/**
	 * the timestamp along the video when the event happend 
	 *
	 * @var int
	 */
	var $currentPoint = null;

	/**
	 * the duration of the video in milliseconds - will make it much faster than quering the db for each entry 
	 *
	 * @var int
	 */
	var $duration = null;

	/**
	 * will be retrieved from the request of the user 
	 *
	 * @var string
	 * @readonly
	 */
	var $userIp = null;

	/**
	 * the time in milliseconds the event took
	 *
	 * @var int
	 */
	var $processDuration = null;

	/**
	 * the id of the GUI control - will be used in the future to better understand what the user clicked
	 *
	 * @var string
	 */
	var $controlId = null;

	/**
	 * true if the user ever used seek in this session 
	 *
	 * @var bool
	 */
	var $seek = null;

	/**
	 * timestamp of the new point on the timeline of the video after the user seeks 
	 *
	 * @var int
	 */
	var $newPoint = null;

	/**
	 * the referrer of the client
	 *
	 * @var string
	 */
	var $referrer = null;

	/**
	 * will indicate if the event is thrown for the first video in the session
	 *
	 * @var bool
	 */
	var $isFirstInSession = null;


}

class KalturaUiConf extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $id = null;

	/**
	 * Name of the uiConf, this is not a primary key
	 *
	 * @var string
	 */
	var $name = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var KalturaUiConfObjType
	 */
	var $objType = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $objTypeAsString = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $width = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $height = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $htmlParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $swfUrl = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $confFilePath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $confFile = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $confFileFeatures = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $confVars = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $useCdn = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $swfUrlVersion = null;

	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	var $updatedAt = null;

	/**
	 * 
	 *
	 * @var KalturaUiConfCreationMode
	 */
	var $creationMode = null;


}

class KalturaUiConfFilter extends KalturaFilter
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $idEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $idIn = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $nameLike = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsMultiLikeOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsMultiLikeAnd = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $createdAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $createdAtLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $updatedAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $updatedAtLessThanOrEqual = null;


}

class KalturaUiConfListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaUiConfArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaUiConfOrderBy extends KalturaObjectBase
{

}

class KalturaUser extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $screenName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $fullName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $email = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $dateOfBirth = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $country = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $state = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $city = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $zip = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $thumbnailUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $description = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tags = null;

	/**
	 * Admin tags can be updated only by using an admin session
	 *
	 * @var string
	 */
	var $adminTags = null;

	/**
	 * 
	 *
	 * @var KalturaGender
	 */
	var $gender = null;

	/**
	 * 
	 *
	 * @var KalturaUserStatus
	 */
	var $status = null;

	/**
	 * Creation date as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * Last update date as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	var $updatedAt = null;

	/**
	 * Can be used to store various partner related data as a string 
	 *
	 * @var string
	 */
	var $partnerData = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $indexedPartnerDataInt = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $indexedPartnerDataString = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $storageSize = null;


}

class KalturaUserFilter extends KalturaFilter
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $idEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $idIn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $partnerIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $screenNameLike = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $screenNameStartsWith = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $emailLike = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $emailStartsWith = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsMultiLikeOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $tagsMultiLikeAnd = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $createdAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $createdAtLessThanOrEqual = null;


}

class KalturaUserListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaUserArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaUserOrderBy extends KalturaObjectBase
{

}

class KalturaWidget extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $sourceWidgetId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $rootWidgetId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $entryId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $uiConfId = null;

	/**
	 * 
	 *
	 * @var KalturaWidgetSecurityType
	 */
	var $securityType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $securityPolicy = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $updatedAt = null;

	/**
	 * Can be used to store various partner related data as a string 
	 *
	 * @var string
	 */
	var $partnerData = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	var $widgetHTML = null;


}

class KalturaWidgetFilter extends KalturaFilter
{
	/**
	 * 
	 *
	 * @var string
	 */
	var $idEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $idIn = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $sourceWidgetIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $rootWidgetIdEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $partnerIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $entryIdEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $uiConfIdEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $createdAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $createdAtLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $updatedAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	var $updatedAtLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $partnerDataLike = null;


}

class KalturaWidgetListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaWidgetArray
	 * @readonly
	 */
	var $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	var $totalCount = null;


}

class KalturaWidgetOrderBy extends KalturaObjectBase
{

}


class KalturaMediaService extends KalturaServiceBase
{
	function KalturaMediaService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function addFromUrl($mediaEntry, $url)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		$this->client->addParam($kparams, "url", $url);
		$resultObject = $this->client->callService("media", "addFromUrl", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function addFromSearchResult($mediaEntry = null, $searchResult = null)
	{
		$kparams = array();
		if ($mediaEntry !== null)
			$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		if ($searchResult !== null)
			$this->client->addParam($kparams, "searchResult", $searchResult->toParams());
		$resultObject = $this->client->callService("media", "addFromSearchResult", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function addFromUploadedFile($mediaEntry, $uploadTokenId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$resultObject = $this->client->callService("media", "addFromUploadedFile", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function addFromRecordedWebcam($mediaEntry, $webcamTokenId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		$this->client->addParam($kparams, "webcamTokenId", $webcamTokenId);
		$resultObject = $this->client->callService("media", "addFromRecordedWebcam", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function get($entryId, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "version", $version);
		$resultObject = $this->client->callService("media", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function update($entryId, $mediaEntry)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		$resultObject = $this->client->callService("media", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function delete($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("media", "delete", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("media", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaListResponse");
		return $resultObject;
	}

	function upload($fileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "fileData", $fileData->toParams());
		$resultObject = $this->client->callService("media", "upload", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}

	function updateThumbnail($entryId, $timeOffset)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "timeOffset", $timeOffset);
		$resultObject = $this->client->callService("media", "updateThumbnail", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function updateThumbnailJpeg($entryId, $fileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "fileData", $fileData->toParams());
		$resultObject = $this->client->callService("media", "updateThumbnailJpeg", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function requestConversion($entryId, $fileFormat)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "fileFormat", $fileFormat);
		$resultObject = $this->client->callService("media", "requestConversion", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "int");
		return $resultObject;
	}

	function flag($moderationFlag)
	{
		$kparams = array();
		$this->client->addParam($kparams, "moderationFlag", $moderationFlag->toParams());
		$resultObject = $this->client->callService("media", "flag", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function reject($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("media", "reject", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function approve($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("media", "approve", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listFlags($entryId, $pager = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("media", "listFlags", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaModerationFlagListResponse");
		return $resultObject;
	}
}

class KalturaMixingService extends KalturaServiceBase
{
	function KalturaMixingService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function add($mixEntry)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mixEntry", $mixEntry->toParams());
		$resultObject = $this->client->callService("mixing", "add", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMixEntry");
		return $resultObject;
	}

	function get($entryId, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "version", $version);
		$resultObject = $this->client->callService("mixing", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMixEntry");
		return $resultObject;
	}

	function update($entryId, $mixEntry)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "mixEntry", $mixEntry->toParams());
		$resultObject = $this->client->callService("mixing", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMixEntry");
		return $resultObject;
	}

	function delete($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("mixing", "delete", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("mixing", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMixListResponse");
		return $resultObject;
	}

	function cloneAction($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("mixing", "clone", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMixEntry");
		return $resultObject;
	}

	function appendMediaEntry($mixEntryId, $mediaEntryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mixEntryId", $mixEntryId);
		$this->client->addParam($kparams, "mediaEntryId", $mediaEntryId);
		$resultObject = $this->client->callService("mixing", "appendMediaEntry", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMixEntry");
		return $resultObject;
	}

	function requestFlattening($entryId, $fileFormat, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "fileFormat", $fileFormat);
		$this->client->addParam($kparams, "version", $version);
		$resultObject = $this->client->callService("mixing", "requestFlattening", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "int");
		return $resultObject;
	}

	function getMixesByMediaId($mediaEntryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaEntryId", $mediaEntryId);
		$resultObject = $this->client->callService("mixing", "getMixesByMediaId", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getReadyMediaEntries($mixId, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mixId", $mixId);
		$this->client->addParam($kparams, "version", $version);
		$resultObject = $this->client->callService("mixing", "getReadyMediaEntries", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}
}

class KalturaBaseEntryService extends KalturaServiceBase
{
	function KalturaBaseEntryService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function addFromUploadedFile($entry, $uploadTokenId, $type = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entry", $entry->toParams());
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$this->client->addParam($kparams, "type", $type);
		$resultObject = $this->client->callService("baseentry", "addFromUploadedFile", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function get($entryId, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "version", $version);
		$resultObject = $this->client->callService("baseentry", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function getByIds($entryIds)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryIds", $entryIds);
		$resultObject = $this->client->callService("baseentry", "getByIds", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function delete($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("baseentry", "delete", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("baseentry", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntryListResponse");
		return $resultObject;
	}

	function updateThumbnailJpeg($entryId, $fileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "fileData", $fileData->toParams());
		$resultObject = $this->client->callService("baseentry", "updateThumbnailJpeg", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function flag($moderationFlag)
	{
		$kparams = array();
		$this->client->addParam($kparams, "moderationFlag", $moderationFlag->toParams());
		$resultObject = $this->client->callService("baseentry", "flag", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function reject($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("baseentry", "reject", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function approve($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$resultObject = $this->client->callService("baseentry", "approve", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listFlags($entryId, $pager = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("baseentry", "listFlags", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaModerationFlagListResponse");
		return $resultObject;
	}
}

class KalturaSessionService extends KalturaServiceBase
{
	function KalturaSessionService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function start($secret, $userId = "", $type = 0, $partnerId = -1, $expiry = 86400, $privileges = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "secret", $secret);
		$this->client->addParam($kparams, "userId", $userId);
		$this->client->addParam($kparams, "type", $type);
		$this->client->addParam($kparams, "partnerId", $partnerId);
		$this->client->addParam($kparams, "expiry", $expiry);
		$this->client->addParam($kparams, "privileges", $privileges);
		$resultObject = $this->client->callService("session", "start", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}

	function startWidgetSession($widgetId, $expiry = 86400)
	{
		$kparams = array();
		$this->client->addParam($kparams, "widgetId", $widgetId);
		$this->client->addParam($kparams, "expiry", $expiry);
		$resultObject = $this->client->callService("session", "startWidgetSession", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaStartWidgetSessionResponse");
		return $resultObject;
	}
}

class KalturaUiConfService extends KalturaServiceBase
{
	function KalturaUiConfService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function add($uiConf)
	{
		$kparams = array();
		$this->client->addParam($kparams, "uiConf", $uiConf->toParams());
		$resultObject = $this->client->callService("uiconf", "add", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUiConf");
		return $resultObject;
	}

	function update($id, $uiConf)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "uiConf", $uiConf->toParams());
		$resultObject = $this->client->callService("uiconf", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUiConf");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$resultObject = $this->client->callService("uiconf", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUiConf");
		return $resultObject;
	}

	function delete($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$resultObject = $this->client->callService("uiconf", "delete", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function cloneAction($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$resultObject = $this->client->callService("uiconf", "clone", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUiConf");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("uiconf", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUiConfListResponse");
		return $resultObject;
	}
}

class KalturaPlaylistService extends KalturaServiceBase
{
	function KalturaPlaylistService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function add($playlist, $updateStats = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "playlist", $playlist->toParams());
		$this->client->addParam($kparams, "updateStats", $updateStats);
		$resultObject = $this->client->callService("playlist", "add", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPlaylist");
		return $resultObject;
	}

	function get($id, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "version", $version);
		$resultObject = $this->client->callService("playlist", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPlaylist");
		return $resultObject;
	}

	function update($id, $playlist, $updateStats = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "playlist", $playlist->toParams());
		$this->client->addParam($kparams, "updateStats", $updateStats);
		$resultObject = $this->client->callService("playlist", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPlaylist");
		return $resultObject;
	}

	function delete($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$resultObject = $this->client->callService("playlist", "delete", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("playlist", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPlaylistListResponse");
		return $resultObject;
	}

	function execute($id, $detailed = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "detailed", $detailed);
		$resultObject = $this->client->callService("playlist", "execute", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function executeFromContent($playlistType, $playlistContent, $detailed = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "playlistType", $playlistType);
		$this->client->addParam($kparams, "playlistContent", $playlistContent);
		$this->client->addParam($kparams, "detailed", $detailed);
		$resultObject = $this->client->callService("playlist", "executeFromContent", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getStatsFromContent($playlistType, $playlistContent)
	{
		$kparams = array();
		$this->client->addParam($kparams, "playlistType", $playlistType);
		$this->client->addParam($kparams, "playlistContent", $playlistContent);
		$resultObject = $this->client->callService("playlist", "getStatsFromContent", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPlaylist");
		return $resultObject;
	}
}

class KalturaUserService extends KalturaServiceBase
{
	function KalturaUserService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function add($user)
	{
		$kparams = array();
		$this->client->addParam($kparams, "user", $user->toParams());
		$resultObject = $this->client->callService("user", "add", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUser");
		return $resultObject;
	}

	function update($userId, $user)
	{
		$kparams = array();
		$this->client->addParam($kparams, "userId", $userId);
		$this->client->addParam($kparams, "user", $user->toParams());
		$resultObject = $this->client->callService("user", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUser");
		return $resultObject;
	}

	function get($userId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "userId", $userId);
		$resultObject = $this->client->callService("user", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUser");
		return $resultObject;
	}

	function delete($userId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "userId", $userId);
		$resultObject = $this->client->callService("user", "delete", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUser");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("user", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaUserListResponse");
		return $resultObject;
	}
}

class KalturaWidgetService extends KalturaServiceBase
{
	function KalturaWidgetService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function add($widget)
	{
		$kparams = array();
		$this->client->addParam($kparams, "widget", $widget->toParams());
		$resultObject = $this->client->callService("widget", "add", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaWidget");
		return $resultObject;
	}

	function update($id, $widget)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "widget", $widget->toParams());
		$resultObject = $this->client->callService("widget", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaWidget");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$resultObject = $this->client->callService("widget", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaWidget");
		return $resultObject;
	}

	function cloneAction($widget)
	{
		$kparams = array();
		$this->client->addParam($kparams, "widget", $widget->toParams());
		$resultObject = $this->client->callService("widget", "clone", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaWidget");
		return $resultObject;
	}

	function listAction($filter = null, $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("widget", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaWidgetListResponse");
		return $resultObject;
	}
}

class KalturaSearchService extends KalturaServiceBase
{
	function KalturaSearchService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function search($search, $pager = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "search", $search->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("search", "search", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSearchResultResponse");
		return $resultObject;
	}

	function getMediaInfo($searchResult)
	{
		$kparams = array();
		$this->client->addParam($kparams, "searchResult", $searchResult->toParams());
		$resultObject = $this->client->callService("search", "getMediaInfo", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSearchResult");
		return $resultObject;
	}

	function searchUrl($mediaType, $url)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaType", $mediaType);
		$this->client->addParam($kparams, "url", $url);
		$resultObject = $this->client->callService("search", "searchUrl", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSearchResult");
		return $resultObject;
	}
}

class KalturaPartnerService extends KalturaServiceBase
{
	function KalturaPartnerService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function register($partner, $cmsPassword = "")
	{
		$kparams = array();
		$this->client->addParam($kparams, "partner", $partner->toParams());
		$this->client->addParam($kparams, "cmsPassword", $cmsPassword);
		$resultObject = $this->client->callService("partner", "register", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPartner");
		return $resultObject;
	}

	function update($partner, $allowEmpty = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "partner", $partner->toParams());
		$this->client->addParam($kparams, "allowEmpty", $allowEmpty);
		$resultObject = $this->client->callService("partner", "update", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPartner");
		return $resultObject;
	}

	function getSecrets($partnerId, $adminEmail, $cmsPassword)
	{
		$kparams = array();
		$this->client->addParam($kparams, "partnerId", $partnerId);
		$this->client->addParam($kparams, "adminEmail", $adminEmail);
		$this->client->addParam($kparams, "cmsPassword", $cmsPassword);
		$resultObject = $this->client->callService("partner", "getSecrets", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPartner");
		return $resultObject;
	}

	function getInfo()
	{
		$kparams = array();
		$resultObject = $this->client->callService("partner", "getInfo", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPartner");
		return $resultObject;
	}

	function getUsage($year, $month = 1, $resolution = "days")
	{
		$kparams = array();
		$this->client->addParam($kparams, "year", $year);
		$this->client->addParam($kparams, "month", $month);
		$this->client->addParam($kparams, "resolution", $resolution);
		$resultObject = $this->client->callService("partner", "getUsage", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaPartnerUsage");
		return $resultObject;
	}
}

class KalturaAdminUserService extends KalturaServiceBase
{
	function KalturaAdminUserService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function updatepassword($email, $password, $newEmail = "", $newPassword = "")
	{
		$kparams = array();
		$this->client->addParam($kparams, "email", $email);
		$this->client->addParam($kparams, "password", $password);
		$this->client->addParam($kparams, "newEmail", $newEmail);
		$this->client->addParam($kparams, "newPassword", $newPassword);
		$resultObject = $this->client->callService("adminuser", "updatepassword", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaAdminUser");
		return $resultObject;
	}

	function resetPassword($email)
	{
		$kparams = array();
		$this->client->addParam($kparams, "email", $email);
		$resultObject = $this->client->callService("adminuser", "resetPassword", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function login($email, $password)
	{
		$kparams = array();
		$this->client->addParam($kparams, "email", $email);
		$this->client->addParam($kparams, "password", $password);
		$resultObject = $this->client->callService("adminuser", "login", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}
}

class KalturaSystemService extends KalturaServiceBase
{
	function KalturaSystemService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function ping()
	{
		$kparams = array();
		$resultObject = $this->client->callService("system", "ping", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "bool");
		return $resultObject;
	}
}

class KalturaBulkUploadService extends KalturaServiceBase
{
	function KalturaBulkUploadService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function add($conversionProfileId, $csvFileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "conversionProfileId", $conversionProfileId);
		$this->client->addParam($kparams, "csvFileData", $csvFileData->toParams());
		$resultObject = $this->client->callService("bulkupload", "add", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBulkUpload");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$resultObject = $this->client->callService("bulkupload", "get", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBulkUpload");
		return $resultObject;
	}

	function listAction($pager = null)
	{
		$kparams = array();
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$resultObject = $this->client->callService("bulkupload", "list", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBulkUploadListResponse");
		return $resultObject;
	}
}

class KalturaNotificationService extends KalturaServiceBase
{
	function KalturaNotificationService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function getClientNotification($entryId, $type)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "type", $type);
		$resultObject = $this->client->callService("notification", "getClientNotification", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaClientNotification");
		return $resultObject;
	}
}

class KalturaBatchService extends KalturaServiceBase
{
	function KalturaBatchService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function addImportJob($importJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "importJob", $importJob->toParams());
		$resultObject = $this->client->callService("batch", "addImportJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function getExclusiveImportJobs($processorLocation, $pocessorName, $maxExecutionTime, $numberOfJobs, $partnerGroups)
	{
		$kparams = array();
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		$this->client->addParam($kparams, "partnerGroups", $partnerGroups);
		$resultObject = $this->client->callService("batch", "getExclusiveImportJobs", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveImportJob($id, $processorLocation, $pocessorName, $importJob, $entryStatus = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "importJob", $importJob->toParams());
		$this->client->addParam($kparams, "entryStatus", $entryStatus);
		$resultObject = $this->client->callService("batch", "updateExclusiveImportJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveImportJob($id, $processorLocation, $pocessorName)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$resultObject = $this->client->callService("batch", "freeExclusiveImportJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function addPreConvertJob($preConvertJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "preConvertJob", $preConvertJob->toParams());
		$resultObject = $this->client->callService("batch", "addPreConvertJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function getExclusivePreConvertJobs($processorLocation, $pocessorName, $maxExecutionTime, $numberOfJobs, $partnerGroups)
	{
		$kparams = array();
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		$this->client->addParam($kparams, "partnerGroups", $partnerGroups);
		$resultObject = $this->client->callService("batch", "getExclusivePreConvertJobs", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusivePreConvertJob($id, $processorLocation, $pocessorName, $preConvertJob, $entryStatus = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "preConvertJob", $preConvertJob->toParams());
		$this->client->addParam($kparams, "entryStatus", $entryStatus);
		$resultObject = $this->client->callService("batch", "updateExclusivePreConvertJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusivePreConvertJob($id, $processorLocation, $pocessorName)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$resultObject = $this->client->callService("batch", "freeExclusivePreConvertJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function createNotification($notificationJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "notificationJob", $notificationJob->toParams());
		$resultObject = $this->client->callService("batch", "createNotification", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function getExclusiveNotificationJobs($processorLocation, $pocessorName, $maxExecutionTime, $numberOfJobs, $partnerGroups)
	{
		$kparams = array();
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		$this->client->addParam($kparams, "partnerGroups", $partnerGroups);
		$resultObject = $this->client->callService("batch", "getExclusiveNotificationJobs", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchGetExclusiveNotificationJobsResponse");
		return $resultObject;
	}

	function updateExclusiveNotificationJob($id, $processorLocation, $pocessorName, $notificationJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "notificationJob", $notificationJob->toParams());
		$resultObject = $this->client->callService("batch", "updateExclusiveNotificationJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaNotification");
		return $resultObject;
	}

	function freeExclusiveNotificationJob($id, $processorLocation, $pocessorName, $notificationJob = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		if ($notificationJob !== null)
			$this->client->addParam($kparams, "notificationJob", $notificationJob->toParams());
		$resultObject = $this->client->callService("batch", "freeExclusiveNotificationJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function addMailJob($mailJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mailJob", $mailJob->toParams());
		$resultObject = $this->client->callService("batch", "addMailJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function getExclusiveMailJobs($processorLocation, $pocessorName, $maxExecutionTime, $numberOfJobs, $partnerGroups)
	{
		$kparams = array();
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		$this->client->addParam($kparams, "partnerGroups", $partnerGroups);
		$resultObject = $this->client->callService("batch", "getExclusiveMailJobs", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveMailJob($id, $processorLocation, $pocessorName, $mailJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "mailJob", $mailJob->toParams());
		$resultObject = $this->client->callService("batch", "updateExclusiveMailJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMailJob");
		return $resultObject;
	}

	function freeExclusiveMailJob($id, $processorLocation, $pocessorName)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$resultObject = $this->client->callService("batch", "freeExclusiveMailJob", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMailJob");
		return $resultObject;
	}
}

class KalturaReportService extends KalturaServiceBase
{
	function KalturaReportService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function getGraph()
	{
		$kparams = array();
		$resultObject = $this->client->callService("report", "getGraph", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaReportGraph");
		return $resultObject;
	}

	function getGraphs($reportType, $reportInputFilter, $dimension = null, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "dimension", $dimension);
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$resultObject = $this->client->callService("report", "getGraphs", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getTotal($reportType, $reportInputFilter, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$resultObject = $this->client->callService("report", "getTotal", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaReportTotal");
		return $resultObject;
	}

	function getTable($reportType, $reportInputFilter, $pager, $order = null, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->addParam($kparams, "order", $order);
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$resultObject = $this->client->callService("report", "getTable", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaReportTable");
		return $resultObject;
	}

	function getUrlForReportAsCsv($reportTitle, $reportText, $headers, $reportType, $reportInputFilter, $dimension = null, $pager = null, $order = null, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportTitle", $reportTitle);
		$this->client->addParam($kparams, "reportText", $reportText);
		$this->client->addParam($kparams, "headers", $headers);
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "dimension", $dimension);
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->addParam($kparams, "order", $order);
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$resultObject = $this->client->callService("report", "getUrlForReportAsCsv", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}
}

class KalturaConversionProfileService extends KalturaServiceBase
{
	function KalturaConversionProfileService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function addCurrent($conversionProfile)
	{
		$kparams = array();
		$this->client->addParam($kparams, "conversionProfile", $conversionProfile->toParams());
		$resultObject = $this->client->callService("conversionprofile", "addCurrent", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaConversionProfile");
		return $resultObject;
	}

	function getCurrent()
	{
		$kparams = array();
		$resultObject = $this->client->callService("conversionprofile", "getCurrent", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaConversionProfile");
		return $resultObject;
	}
}

class KalturaStatsService extends KalturaServiceBase
{
	function KalturaStatsService(&$client)
	{
		parent::KalturaServiceBase($client);
	}

	function collect($event)
	{
		$kparams = array();
		$this->client->addParam($kparams, "event", $event->toParams());
		$resultObject = $this->client->callService("stats", "collect", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function reportKceError($kalturaCEError)
	{
		$kparams = array();
		$this->client->addParam($kparams, "kalturaCEError", $kalturaCEError->toParams());
		$resultObject = $this->client->callService("stats", "reportKceError", $kparams);
		$this->client->checkForError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaCEError");
		return $resultObject;
	}
}

class KalturaClient extends KalturaClientBase
{
	/**
	 * Media service lets you upload and manage media files (images / videos & audio)
	 *
	 * @var KalturaMediaService
	 */
	var $media = null;

	/**
	 * A Mix is an XML unique format invented by Kaltura, it allows the user to create a mix of videos and images, in and out points, transitions, text overlays, soundtrack, effects and much more...
	 * Mixing service lets you create a new mix, manage its metadata and make basic manipulations.   
	 *
	 * @var KalturaMixingService
	 */
	var $mixing = null;

	/**
	 * Base Entry Service
	 *
	 * @var KalturaBaseEntryService
	 */
	var $baseEntry = null;

	/**
	 * Session service
	 *
	 * @var KalturaSessionService
	 */
	var $session = null;

	/**
	 * UiConf service lets you create and manage your UIConfs for the various flash components
	 * This service is used by the KMC-ApplicationStudio
	 *
	 * @var KalturaUiConfService
	 */
	var $uiConf = null;

	/**
	 * Playlist service lets you create,manage and play your playlists
	 * Playlists could be static (containing a fixed list of entries) or dynamic (baseed on a filter)
	 *
	 * @var KalturaPlaylistService
	 */
	var $playlist = null;

	/**
	 * Manage partner users on Kaltura's side
	 * The userId in kaltura is the unique Id in the partner's system, and the [partnerId,Id] couple are unique key in kaltura's DB
	 *
	 * @var KalturaUserService
	 */
	var $user = null;

	/**
	 * widget service for full widget management
	 *
	 * @var KalturaWidgetService
	 */
	var $widget = null;

	/**
	 * Search service allows you to search for media in various media providers
	 * This service is being used mostly by the CW component
	 *
	 * @var KalturaSearchService
	 */
	var $search = null;

	/**
	 * partner service allows you to change/manage your partner personal details and settings as well
	 *
	 * @var KalturaPartnerService
	 */
	var $partner = null;

	/**
	 * adminuser service
	 *
	 * @var KalturaAdminUserService
	 */
	var $adminUser = null;

	/**
	 * System Service
	 *
	 * @var KalturaSystemService
	 */
	var $system = null;

	/**
	 * Bulk Upload Service
	 *
	 * @var KalturaBulkUploadService
	 */
	var $bulkUpload = null;

	/**
	 * Notification Service
	 *
	 * @var KalturaNotificationService
	 */
	var $notification = null;

	/**
	 * batch service lets you handle different batch process from remote machines.
	 * As oppesed to other ojects in the system, locking mechanism is critical in this case.
	 * For this reason the GetExclusiveXXX , UpdateExclusiveXXX and FreeExclusiveXXX actions are important for the system's intergity.
	 * In general - updating batch object should be done only using the UpdateExclusiveXXX which in turn can be called only after 
	 * acuiring a batch objet properly (using  GetExclusiveXXX).
	 * If an object was aquired and should be returned to the pool in it's initial state - use the FreeExclusiveXXX action 
	 *
	 * @var KalturaBatchService
	 */
	var $batch = null;

	/**
	 * api for getting reports data by the report type and some inputFilter
	 *
	 * @var KalturaReportService
	 */
	var $report = null;

	/**
	 * Conversion Profile Service
	 *
	 * @var KalturaConversionProfileService
	 */
	var $conversionProfile = null;

	/**
	 * Stats Service
	 *
	 * @var KalturaStatsService
	 */
	var $stats = null;


	function KalturaClient($config)
	{
		parent::KalturaClientBase(/*KalturaConfiguration*/ $config);
		$this->media = new KalturaMediaService($this);
		$this->mixing = new KalturaMixingService($this);
		$this->baseEntry = new KalturaBaseEntryService($this);
		$this->session = new KalturaSessionService($this);
		$this->uiConf = new KalturaUiConfService($this);
		$this->playlist = new KalturaPlaylistService($this);
		$this->user = new KalturaUserService($this);
		$this->widget = new KalturaWidgetService($this);
		$this->search = new KalturaSearchService($this);
		$this->partner = new KalturaPartnerService($this);
		$this->adminUser = new KalturaAdminUserService($this);
		$this->system = new KalturaSystemService($this);
		$this->bulkUpload = new KalturaBulkUploadService($this);
		$this->notification = new KalturaNotificationService($this);
		$this->batch = new KalturaBatchService($this);
		$this->report = new KalturaReportService($this);
		$this->conversionProfile = new KalturaConversionProfileService($this);
		$this->stats = new KalturaStatsService($this);
	}
}
