<?php
require_once("KalturaClientBase.php");

class KalturaBatchJobStatus
{
	const PENDING = 0;
	const QUEUED = 1;
	const PROCESSING = 2;
	const PROCESSED = 3;
	const MOVEFILE = 4;
	const FINISHED = 5;
	const FAILED = 6;
	const ABORTED = 7;
}

class KalturaBatchJobType
{
	const CONVERT = 0;
	const IMPORT = 1;
	const DELETE = 2;
	const FLATTEN = 3;
	const BULKUPLOAD = 4;
	const DVDCREATOR = 5;
	const DOWNLOAD = 6;
	const OOCONVERT = 7;
	const PRECONVERT = 10;
	const POSTCONVERT = 11;
	const PROJECT = 1000;
}

class KalturaEntryStatus
{
	const ERROR_CONVERTING = -1;
	const IMPORT = 0;
	const PRECONVERT = 1;
	const READY = 2;
	const DELETED = 3;
	const PENDING = 4;
	const MODERATE = 5;
	const BLOCKED = 6;
}

class KalturaMailJobStatus
{
	const PENDING = 1;
	const SENT = 2;
	const ERROR = 3;
	const QUEUED = 4;
}

class KalturaNotificationObjectType
{
	const ENTRY = 1;
	const KSHOW = 2;
	const USER = 3;
	const BATCH_JOB = 4;
}

class KalturaNotificationStatus
{
	const PENDING = 1;
	const SENT = 2;
	const ERROR = 3;
	const SHOULD_RESEND = 4;
	const ERROR_RESENDING = 5;
	const SENT_SYNCH = 6;
	const QUEUED = 7;
}

class KalturaNotificationType
{
	const ENTRY_ADD = 1;
	const ENTR_UPDATE_PERMISSIONS = 2;
	const ENTRY_DELETE = 3;
	const ENTRY_BLOCK = 4;
	const ENTRY_UPDATE = 5;
	const ENTRY_UPDATE_THUMBNAIL = 6;
	const ENTRY_UPDATE_MODERATION = 7;
	const USER_ADD = 21;
	const USER_BANNED = 26;
}

class KalturaPartnerType
{
	const WIKI = 100;
	const WORDPRESS = 101;
	const DRUPAL = 102;
	const DEKIWIKI = 103;
	const COMMUNITY_EDITION = 105;
}

class KalturaSessionType
{
	const USER = 0;
	const ADMIN = 2;
}

class KalturaBaseJob extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $updatedAt = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $processorName = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $processorLocation = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $processorExpiration = null;


}

class KalturaBatchGetExclusiveNotificationJobsResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaNotificationArray
	 * @readonly
	 */
	public $notifications;

	/**
	 * 
	 *
	 * @var KalturaPartnerArray
	 * @readonly
	 */
	public $partners;


}

class KalturaBatchJob extends KalturaBaseJob
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;

	/**
	 * 
	 *
	 * @var KalturaBatchJobType
	 * @readonly
	 */
	public $jobType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $data = null;

	/**
	 * 
	 *
	 * @var KalturaBatchJobStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $abort = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $checkAgainTimeout = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $progress = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $message = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $updatesCount = null;

	/**
	 * When one job creates another - the parent should set this parentJobId to be its own id.
	 *
	 * @var int
	 */
	public $parentJobId = null;


}

class KalturaCommercialUseType
{
	const COMMERCIAL_USE = "commercial_use";
	const NON_COMMERCIAL_USE = "non-commercial_use";
}

class KalturaMailJob extends KalturaBaseJob
{
	/**
	 * 
	 *
	 * @var int
	 */
	public $mailType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mailPriority = null;

	/**
	 * 
	 *
	 * @var KalturaMailJobStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $recipientName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $recipientEmail = null;

	/**
	 * kuserId  
	 *
	 * @var int
	 */
	public $recipientId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $fromName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $fromEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $bodyParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $subjectParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $templatePath = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $culture = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $campaignId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $minSendDate = null;


}

class KalturaNotification extends KalturaBaseJob
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $puserId = null;

	/**
	 * 
	 *
	 * @var KalturaNotificationType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $objectId = null;

	/**
	 * 
	 *
	 * @var KalturaNotificationStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationData = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $numberOfAttempts = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationResult = null;

	/**
	 * 
	 *
	 * @var KalturaNotificationObjectType
	 */
	public $objectType = null;


}

class KalturaPartner extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $website = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationUrl = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $appearInSearch = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $adminName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $adminEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var KalturaCommercialUseType
	 */
	public $commercialUse = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $landingPage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $userLandingPage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $contentCategories = null;

	/**
	 * 
	 *
	 * @var KalturaPartnerType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $phone = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $describeYourself = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $adultContent = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defConversionProfileType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $notify = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $allowQuickEdit = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mergeEntryLists = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationsConfig = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $maxUploadSize = null;

	/**
	 * readonly
	 *
	 * @var int
	 */
	public $partnerPackage = null;

	/**
	 * readonly
	 *
	 * @var string
	 */
	public $secret = null;

	/**
	 * readonly
	 *
	 * @var string
	 */
	public $adminSecret = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $cmsPassword = null;


}


class KalturaSessionService extends KalturaServiceBase
{
	function __construct(KalturaClient $client)
	{
		parent::__construct($client);
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
		$this->client->queueServiceActionCall("session", "start", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}
}

class KalturaBatchService extends KalturaServiceBase
{
	function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	function addImportJob(KalturaBatchJob $importJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "importJob", $importJob->toParams());
		$this->client->queueServiceActionCall("batch", "addImportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
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
		$this->client->queueServiceActionCall("batch", "getExclusiveImportJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveImportJob($id, $processorLocation, $pocessorName, KalturaBatchJob $importJob, $entryStatus = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "importJob", $importJob->toParams());
		$this->client->addParam($kparams, "entryStatus", $entryStatus);
		$this->client->queueServiceActionCall("batch", "updateExclusiveImportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveImportJob($id, $processorLocation, $pocessorName)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->queueServiceActionCall("batch", "freeExclusiveImportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function addPreConvertJob(KalturaBatchJob $preConvertJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "preConvertJob", $preConvertJob->toParams());
		$this->client->queueServiceActionCall("batch", "addPreConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
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
		$this->client->queueServiceActionCall("batch", "getExclusivePreConvertJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusivePreConvertJob($id, $processorLocation, $pocessorName, KalturaBatchJob $preConvertJob, $entryStatus = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "preConvertJob", $preConvertJob->toParams());
		$this->client->addParam($kparams, "entryStatus", $entryStatus);
		$this->client->queueServiceActionCall("batch", "updateExclusivePreConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusivePreConvertJob($id, $processorLocation, $pocessorName)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->queueServiceActionCall("batch", "freeExclusivePreConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function createNotification(KalturaNotification $notificationJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "notificationJob", $notificationJob->toParams());
		$this->client->queueServiceActionCall("batch", "createNotification", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
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
		$this->client->queueServiceActionCall("batch", "getExclusiveNotificationJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchGetExclusiveNotificationJobsResponse");
		return $resultObject;
	}

	function updateExclusiveNotificationJob($id, $processorLocation, $pocessorName, KalturaNotification $notificationJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "notificationJob", $notificationJob->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveNotificationJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaNotification");
		return $resultObject;
	}

	function freeExclusiveNotificationJob($id, $processorLocation, $pocessorName, KalturaNotification $notificationJob = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		if ($notificationJob !== null)
			$this->client->addParam($kparams, "notificationJob", $notificationJob->toParams());
		$this->client->queueServiceActionCall("batch", "freeExclusiveNotificationJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function addMailJob(KalturaMailJob $mailJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mailJob", $mailJob->toParams());
		$this->client->queueServiceActionCall("batch", "addMailJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
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
		$this->client->queueServiceActionCall("batch", "getExclusiveMailJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveMailJob($id, $processorLocation, $pocessorName, KalturaMailJob $mailJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->addParam($kparams, "mailJob", $mailJob->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveMailJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMailJob");
		return $resultObject;
	}

	function freeExclusiveMailJob($id, $processorLocation, $pocessorName)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "processorLocation", $processorLocation);
		$this->client->addParam($kparams, "pocessorName", $pocessorName);
		$this->client->queueServiceActionCall("batch", "freeExclusiveMailJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMailJob");
		return $resultObject;
	}
}

class KalturaClient extends KalturaClientBase
{
	/**
	 * Session service
	 *
	 * @var KalturaSessionService
	 */
	public $session = null;

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
	public $batch = null;


	public function __construct(KalturaConfiguration $config)
	{
		parent::__construct($config);
		$this->session = new KalturaSessionService($this);
		$this->batch = new KalturaBatchService($this);
	}
}
