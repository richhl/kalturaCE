<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");

class KalturaFileSyncStatus
{
	const ERROR = -1;
	const PENDING = 1;
	const READY = 2;
	const DELETED = 3;
	const PURGED = 4;
}

class KalturaFileSyncType
{
	const FILE = 1;
	const LINK = 2;
	const URL = 3;
}

class KalturaFileSync extends KalturaObjectBase
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
	 * @var KalturaFileSyncObjectType
	 * @readonly
	 */
	public $fileObjectType = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $objectId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $version = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $objectSubType = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $dc = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $original = null;

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
	 * @var int
	 * @readonly
	 */
	public $readyAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $syncTime = null;

	/**
	 * 
	 *
	 * @var KalturaFileSyncStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var KalturaFileSyncType
	 * @readonly
	 */
	public $fileType = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $linkedId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $linkCount = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fileRoot = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $filePath = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $fileSize = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fileContent = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $fileDiscSize = null;

	/**
	 * 
	 *
	 * @var bool
	 * @readonly
	 */
	public $isCurrentDc = null;


}


class KalturaFileSyncService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function sync($fileSyncId, $fileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "fileSyncId", $fileSyncId);
		$kfiles = array();
		$this->client->addParam($kfiles, "fileData", $fileData);
		$this->client->queueServiceActionCall("filesync_filesync", "sync", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFileSync");
		return $resultObject;
	}
}
class KalturaFileSyncClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaFileSyncClientPlugin
	 */
	protected static $instance;

	/**
	 * @var KalturaFileSyncService
	 */
	public $fileSync = null;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
		$this->fileSync = new KalturaFileSyncService($client);
	}

	/**
	 * @return KalturaFileSyncClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaFileSyncClientPlugin($client);
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
			'fileSync' => $this->fileSync,
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'fileSync';
	}
}

