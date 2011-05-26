<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");

class KalturaVirusScanClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaClientPlugin
	 */
	protected static $instance;

	/**
	 * @var KalturaVirusScanProfileService
	 */
	public $virusScanProfile = null;

	/**
	 * @var KalturaVirusScanBatchService
	 */
	public $virusScanBatch = null;

	protected function __construct()
	{
		parent::__construct();
		$this->virusScanProfile = new KalturaVirusScanProfileService();
		$this->virusScanBatch = new KalturaVirusScanBatchService();
	}

	/**
	 * @return KalturaClientPlugin
	 */
	public static function get()
	{
		if(!self::$instance)
			self::$instance = new KalturaVirusScanClientPlugin();
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
			'virusScanProfile' => $this->virusScanProfile,
			'virusScanBatch' => $this->virusScanBatch,
		);
		return $services;
	}
}

