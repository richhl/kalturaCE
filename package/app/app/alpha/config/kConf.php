<?php
setlocale(LC_ALL, 'en_US.UTF-8');

require_once(dirname(__file__).'/kConfLocal.php');

class kConf extends kConfLocal
{
	// self::$map is in kConfLocal
	
	private static function init()
	{
		if (self::$map) return;
		
		self::$map = array();		
		kConf::addConfig();
		kConfLocal::addConfig();
	}

	
	
	protected static function addConfig()
	{
		self::$map = array_merge(
			self::$map,
			array (
                 // take over the symfony config (sfConfig)
 			    "sf_debug" => false,
				"sf_logging_enabled" => true,
				"sf_root_dir" => dirname(__FILE__).'/../',

				"delivery_block_countries" => "", // comma separated
				
				"enable_cache" => true,

				// params that should be ignored from cache. can be used for tweaking
				// production environment hit by unexpected random parameters
				"v3cache_ignore_params" => array(),
			
				// actions that can be cached although an admin ks is used
				// due to bad integration by the partner
				"v3cache_ignore_admin_ks" => array(),
							
				
				"terms_of_use_uri" => "index.php/terms",
			
				"server_api_v2_path" => "/api/" ,
						

				"default_duplication_time_frame" => 60 ,								
				"job_duplication_time_frame" => array(
					1 => 7200, //BatchJobType::IMPORT
				) ,
			
				"default_job_execution_attempt" => 3 ,
				"job_execution_attempt" => array(
					16 => 5, //BatchJobType::NOTIFICATION
					4 => 1, //BatchJobType::BULK_UPLOAD
					23 => 2, //BatchJobType::STORAGE_EXPORT
					28 => 10, //BatchJobType::METADATA_TRANSFORM
				) ,
			
				"default_job_retry_interval" => 60 ,
				"job_retry_intervals" => array(
					16 => 600, // BatchJobType::NOTIFICATION
					15 => 150, // BatchJobType::MAIL
					1 => 300, // BatchJobType::IMPORT
					23 => 300, // BatchJobType::STORAGE_EXPORT
					4 => 180, // BatchJobType::BULKUPLOAD
					10 => 1800, // BatchJobType::CONVERT_PROFILE
					29 => 300, // BatchJobType::FILESYNC_IMPORT
				) ,
				
				"ignore_cdl_failure" => false,
							
				"batch_ignore_duplication" => true ,
				"priority_percent" => array(1 => 33, 2 => 27, 3 => 20, 4 => 13, 5 => 7),
				"priority_time_range" => 60,
		
				"system_allow_edit_kConf" => false,
				"testmeconsole_state" => true,
				
				"flash_root_url" => "",
				"uiconf_root_url" => "",
				"content_root_url" => "",
			
						
				
			
				/* kmc tabs rules */
				"kmc_display_customize_tab" => true,
				"kmc_display_account_tab" => true, 
				"kmc_content_enable_commercial_transcoding" => true, 
				"kmc_content_enable_live_streaming" => true,
				"kmc_login_show_signup_link" => false,
				"kmc_display_developer_tab" => false,
				"kmc_display_server_tab" => false,
				"kmc_account_show_usage" => true,			

			/* kmc applications versions */
				"kmc_content_version" => 'v3.2.12.2',
				"kmc_account_version" => 'v3.1.3',
				"kmc_appstudio_version" => 'v2.2.3',
				"kmc_rna_version" => 'v1.1.8.4',
				"kmc_dashboard_version" => 'v1.0.14.2',
				"kmc_login_version" => 'v1.1.11.1',
				"kcw_flex_wrapper_version" => 'v1.2',
				"editors_flex_wrapper_version" => 'v1.01',
				"kdp_wrapper_version" => 'v11.0',
				"kdp3_wrapper_version" => 'v34.0',
				"html5_version" => '1.3.3',
				"kmc_secured_login" => false,
				
				"kmc_version" => 'v4.0.12.5',
				"new_partner_kmc_version" => 4,
				
				"paypal_data" => array (),
				
				"limelight_madiavault_password" => "",
				"level3_authentication_key" => "",
				"akamai_auth_smooth_param" => "",
				"akamai_auth_smooth_salt" => "",
				"akamai_auth_smooth_seconds" => 300,
				
				"marketo_access_key" => "", 
				"marketo_secret_key" => "",
							
				'kdpwrapper_track_url' => "http://kalstats.kaltura.com/index.php/events/player_event",
				"kaltura_partner_id" => "",
				
				
				"template_partner_id" => 99,
				
				"url_managers" => array(), /* should be filled up if installations supports adding CDNs */
                                
		
				"kaltura_email_hash" => "admin",
                                
				"default_plugins" => array(
					"MetadataPlugin", // Should always be enabled
					"DocumentPlugin", // Should be enabled for document entries
					"SphinxSearchPlugin", // Should always be enabled
					"StorageProfilePlugin", // Should always be enabled
				),
				
				"event_consumers" => array(
                	"kFlowManager",
                	"kStorageExporter",
                    "kObjectCopyHandler",
                    "kObjectDeleteHandler",
					"kPermissionManager",
                ),
                "event_consumers_default_priority" => 5,
				"event_consumers_priorities" => array(
					'kVirusScanFlowManager' => 7,
                ),
                
				"cache_root_path" => dirname(__FILE__).'/../../cache/',
				"general_cache_dir" => dirname(__FILE__).'/../../cache/general',
                'response_cache_dir' => dirname(__FILE__).'/../../cache/response/',
                
                'apc_cache_ttl' => 900, // 15 minutes in seconds - ttl for apc cache values
                
				"exec_sphinx" => false, // Should be set to false in multiple data centers environments
                
                'user_login_set_password_hash_key_validity' => 60*60*24, /* 24 hours */
                'user_login_max_wrong_attempts' => 5000,
                'user_login_block_period' => 0,
                'user_login_num_prev_passwords_to_keep' => 0,
                'user_login_password_replace_freq' => 60*60*24*5000, /* 5000 days */
                'user_login_password_structure' => array(
					'/^.{8,14}$/',
					'/[0-9]+/',
					'/[a-z]+/',
					'/[~!@#$%^*=+?\(\)\-\[\]\{\}]+/',
					'/^[^<>]*$/',
				),
				
				'disable_url_hashing' => 'true',
				'report_partner_registration' => false, // whether to report partner registration
				
				"usage_tracking_url" => "http://corp.kaltura.com/index.php/events/usage_tracking",
				
				"no_save_of_last_login_partner_for_partner_ids" => array(0, -1, -2, 99),

				"temp_folder" => '/opt/kaltura/tmp',
				
				'ps2_actions_not_blocked_by_permissions' => array(
					// should list action class names lowercase!
					'contactsalesforceaction',
					'mymultirequest',
					'adminloginaction',
					'resetadminpasswordaction',
					'executeplaylistaction',
					'reporterroraction',
					'searchautodataaction',
					'addentryaction',
					'searchmediainfoaction',
					'checknotificationsaction',
					'getdataentryaction',
					'getentryaction',
					'getkshowaction',
					'getallentriesaction',
					'updatedataentryaction',
					'getentriesaction',
					'listmyentriesaction',
					'getallentriesaction',
					'getmetadataaction',
					'setmetadataaction',
					'setroughcutnameaction',
					'getrelatedkshowsaction',
					'setentrythumbnailaction',
					'collectstatsaction',
					'reporterroraction',
					'addentryaction',
					'getuiconfaction',
					'uploadjpegaction',
					'getentryaction',
					'getkshowaction',
					'registerpartneraction',
				),
			)
		);
		
	}
	
	public static function get ( $param_name )
	{
		self::init();
		$res = self::$map [ $param_name ];
		// for now - throw an exception if now param in config - it will help prevent typos 
		if ( $res === null ) throw new Exception ( "Cannot find [$param_name] in config" ) ;
		// KalturaLog::log( "kConf [$param_name]=[$res]" );
		return $res; 
	}
	
	public static function hasParam($param_name)
	{
		self::init();
		return array_key_exists($param_name, self::$map);
	}

	public static function getDB()
	{
		return parent::getDB();
	}
}

