<?php

/**
 * Subclass for representing a row from the 'ui_conf' table.
 *
 * 
 *
 * @package lib.model
 */ 
class uiConf extends BaseuiConf
{
	const UI_CONF_TYPE_WIDGET = 1;
	const UI_CONF_TYPE_CW = 2;
	const UI_CONF_TYPE_EDITOR = 3;
	const UI_CONF_TYPE_ADVANCED_EDITOR = 4;
	const UI_CONF_TYPE_PLAYLIST = 5;			// maybe this is in fact type WIDGET with some flags switched on ?!?
	const UI_CONF_TYPE_APP_STUDIO = 6;

	const UI_CONF_CREATION_MODE_MANUAL = 1;
	const UI_CONF_CREATION_MODE_WIZARD = 2;
	const UI_CONF_CREATION_MODE_ADVANCED = 3;

	// status
	const UI_CONF_STATUS_PENDING = 1;
	const UI_CONF_STATUS_READY = 2;
	const UI_CONF_STATUS_DELETED = 3;
	
	const FILE_NAME_FEATURES = "features";
	
	private static $UI_CONF_OBJ_TYPE_MAP = null;
	
	private $should_call_set_data_content = false;
	private $data_content = null;
	private $data_content_2 = null;
	
	private $swf_url_version = null;
	
	private static $swf_names = array ( "1" => "kdp.swf" , 
										"2" => "ContributionWizard.swf" , 
										"3" => "simpleeditor.swf" , 
										"4" => "keditor.swf" ,
										"5" => "kdp.swl" , );
	
	private static $swf_directory_map = array (
		self::UI_CONF_TYPE_WIDGET => "kdp",
		self::UI_CONF_TYPE_CW => "kcw",
		self::UI_CONF_TYPE_EDITOR => "kse",
		self::UI_CONF_TYPE_ADVANCED_EDITOR => "kae",
		self::UI_CONF_TYPE_PLAYLIST => "kdp",
		self::UI_CONF_TYPE_APP_STUDIO => "kas",
	);
	
	public function save($con = null)
	{
		$this->setCustomDataObj();
		
		$res = parent::save( $con );
		if ( $this->should_call_set_data_content )
		{
			// calling the funciton with null will cause it to use the $this->data_content
			$this->setConfFile( null );
			$this->setConfFile2( null );
			$res = parent::save( $con );
		}
		$this->getConfFilePath();
		return $res;
	}
	

	private static function initUiConfTypeMap()
	{
		if ( self::$UI_CONF_OBJ_TYPE_MAP == null )
		{
			self::$UI_CONF_OBJ_TYPE_MAP = array (
				self::UI_CONF_TYPE_WIDGET => "Widget",
				self::UI_CONF_TYPE_CW => "ContributionWizard",
				self::UI_CONF_TYPE_EDITOR => "Editor",
				self::UI_CONF_TYPE_ADVANCED_EDITOR => "AdvncaedEditor",
				self::UI_CONF_TYPE_PLAYLIST => "Playlist",
				self::UI_CONF_TYPE_APP_STUDIO => "AppStudio",
			);
		}
	}
	
	public function getUiConfTypeMap()
	{
		self::initUiConfTypeMap();
		return self::$UI_CONF_OBJ_TYPE_MAP;
	}
	
	public function getObjTypeAsString ( )
	{
		self::initUiConfTypeMap();
		return self::$UI_CONF_OBJ_TYPE_MAP[$this->getType()];
	}
	
	public function getType()
	{
		$t = parent::getObjType();
		if ( empty ( $t ) ) $t = self::UI_CONF_TYPE_WIDGET;
		return $t;
	}
	
	public function setConfFile ( $v /*, $increment_version = true */ )
	{
		if ( $this->getId() == null )
		{
			$this->data_content = $v;
			// come back when there is an ID
			$this->should_call_set_data_content = true;
			return ;
		}
		
		if ( $v == null ) $v = $this->data_content;
		$file_name = $this->getConfFilePath();
		if ( $this->getCreationMode() == self::UI_CONF_CREATION_MODE_MANUAL )
		{
			throw new Exception ( "Should not edit MANUAL ui_confs via the API!! Only via the SVN" );	
		}
		
		// make backup for file
		if ( file_exists ( $file_name ) )
		{
			$date_str = $this->getFileTime();
			kFile::moveFile($file_name , $file_name . "." . $date_str , false , false );
		}
		
		$this->setUpdatedAt( time() ); // make sure will be updated in the DB
		
		kFile::setFileContent( $file_name , $v );
		$this->should_call_set_data_content = false;
	}	
		
	public function getConfFile( $force_fetch = false ) 
	{
		$contents = "";
		
		if ( $this->data_content && ! $force_fetch ) return $this->data_content; 
		$confFilePath = $this->getConfFilePath();
		$content = null;
		if ($confFilePath)
		{
			// for now - use the xmlConfig only for UI_CONF_TYPE_CW
			if ( $this->getObjType() == self::UI_CONF_TYPE_CW )
			{
				$kaltura_config = null; 
				try
				{
					$contents = $this->getCachedContent( $kaltura_config , $confFilePath );
				}
				catch ( Exception $ex )
				{
					$contents = @file_get_contents($confFilePath);
				}
			}
			else
			{
				$contents = @file_get_contents($confFilePath);
			}
		}
		$this->data_content = $content;
		return $contents;
	}

	public function setConfFile2 ( $v /*, $increment_version = true */ )
	{
		if ( $this->getId() == null )
		{
			$this->data_content_2 = $v;
			// come back when there is an ID
			$this->should_call_set_data_content = true;
			return ;
		}
		
		if ( $v == null ) $v = $this->data_content_2;
		$file_name = $this->getConfFilePath( self::FILE_NAME_FEATURES );
		if ( $this->getCreationMode() == self::UI_CONF_CREATION_MODE_MANUAL )
		{
			throw new Exception ( "Should not edit MANUAL ui_confs via the API!! Only via the SVN" );	
		}
		
		// make backup for file
		if ( file_exists ( $file_name ) )
		{
			$date_str = $this->getFileTime() ;
			kFile::moveFile($file_name , $file_name . "." . $date_str , false , false );
		}
		
		$this->setUpdatedAt( time() ); // make sure will be updated in the DB
		
		kFile::setFileContent( $file_name , $v );
		$this->should_call_set_data_content = false;
	}	
		
	// will fetch 
	public function getConfFile2 ( $force_fetch = false ) 
	{
		$contents = "";
		
		if ( $this->data_content_2 && ! $force_fetch ) return $this->data_content_2; 
		$confFilePath = $this->getConfFilePath( self::FILE_NAME_FEATURES );
		$content = null;
		if ($confFilePath)
		{
			// for now - use the xmlConfig only for UI_CONF_TYPE_CW
			if ( $this->getObjType() == self::UI_CONF_TYPE_CW )
			{
				$kaltura_config = null; 
				try
				{
					$contents = $this->getCachedContent( $kaltura_config , $confFilePath );
				}
				catch ( Exception $ex )
				{
					$contents = @file_get_contents($confFilePath);
				}
			}
			else
			{
				$contents = @file_get_contents($confFilePath);
			}
		}
		$this->data_content_2 = $content;
		return $contents;
	}	
	
	public function setConfFileFeatures ( $v ) 
	{
		return $this->setConfFile2( $v );;
	}


	// check this !
	public function getConfFileFeatures (  ) 
	{
		return $this->getConfFile2( );;
	}
	
	private $m_file_time;
	private function getFileTime()
	{
		if ( ! $this->m_file_time ) 
			$this->m_file_time = strftime( "%Y-%m-%d_%H-%M-%S" , time() );
		return $this->m_file_time;
	}
	
	public function getSwfUrl ( $raw_only = false )
	{
		$raw = parent::getSwfUrl();
		if ( $raw_only ) return $raw;
		$root_url = kConf::get ( "flash_root_url");
		if ( ! $root_url )
			return $raw;
		if ( strpos ( $raw , $root_url) === 0 )
		{
			// if the raw url already has the exact prefix of root_url - return the raw - no need to re-append it
			return 	$raw;
		}
		
		if ( strpos ( $raw , "http://" ) === 0 )
		{
			// if the raw url starts with http - don't append to it
			return 	$raw;
		}
		
		return $root_url . $raw;
	}
	
	// use this field only if the version is not empty
	public function setSwfUrlVersion ( $version )
	{
		$flash_url = myContentStorage::getFSFlashRootPath ();
		$default_swf_name = $this->getSwfNameFromType ( );
		if ( $version )		$this->setSwfUrl( "$flash_url/kdp/v{$version}/{$default_swf_name}" );
	}
	
	public function getSwfUrlVersion ()
	{
		$swf_url = $this->getSwfUrl();
		$flash_url = myContentStorage::getFSFlashRootPath ();
		$match = preg_match ( "|$flash_url/kdp/v([0-9\.]*)/|" , $swf_url , $version );
		if ( $match )
		{
			return $version[1];
		}
		return null;
	}
	
	private function getCachedContent ( $kaltura_config , $confFilePath )
	{
		if ( ! file_exists ( $confFilePath ) ) return null;
		if ( strpos ( $confFilePath , "://" ) != FALSE )
		{
			// remote file (http:// or ftp://) - store the cache in a directory near the base file 
			//$cache_path = dirname( $kaltura_config ) . "cache/" . $confFilePath  . "_cache.xml" ;
			// for now - don't cache for remote files
			$cache_path = null;
		}
		else
		{
			// this is a local file - store the cache file in the same directory
			$cache_path = str_replace ( "/uiconf/" , "/cacheuiconf/" ,$confFilePath ) . "_cache.xml";
			kFile::fullMkdir( $cache_path );
		}
		try
		{
			$s_time = microtime( true );
			$config = new kXmlConfig( $kaltura_config , $confFilePath );
			$content = $config->getConfig( $cache_path );
			$e_time = microtime( true );
			
			if ( $config->createdCache() )
				kLog::log( __METHOD__ . " created config cache file [$kaltura_config]+[$confFilePath]->[$cache_path].\ntook [" . ($e_time - $s_time) . "] seconds" );
			
			return $content;
		}
		catch ( Exception $ex )
		{
			kLog::log( __METHOD__ . " Error creating config [$kaltura_config]+[$confFilePath]:" . $ex->getMessage() );
			return null;
		}
	}
	
	// TODO fix when add creation_mode to the DB
	public function getCreationModeAsStr()
	{
		return self::UI_CONF_CREATION_MODE_WIZARD;	
	}
	
	public function getConfFilePath( $file_suffix = null )
	{
		$conf_file_path = parent::getConfFilePath();

		if( ! $conf_file_path )
		{
			if ( ! $this->getId() ) return null;
			if ( $this->getCreationMode() != self::UI_CONF_CREATION_MODE_MANUAL )
			{
				$conf_file_path = $this->createConfFilePath();
				$this->setConfFilePath( $conf_file_path );
			}
		}

		// will fix the current problem in the DB- we hold the root in the conf_file_path			
		$conf_file_path = myContentStorage::getFSContentRootPath( ).str_replace ( "/web/" , "" , $conf_file_path )  ;
		
		if ( $file_suffix )
		{
			// use the file_suffix before the extension
			$extension = pathinfo ( $conf_file_path , PATHINFO_EXTENSION );
			$conf_file_path = str_replace ( $extension , "$file_suffix.$extension" , $conf_file_path );	
		}
		
		return $conf_file_path;
	}

	/*
	 * Should not be used as updateable field until the paths on disk are safe to set
	 */
	public function setConfFilePath( $v )
	{
		if ( kString::beginsWith( $v , ".." ) )
		{
			$err = "Error in " . __METHOD__ . ": attmpting to set ConfFilePath to [$v]";
			kLog::log( $err );
			throw new APIException ( APIErrors::ERROR_SETTING_FILE_PATH_FOR_UI_CONF , $v );
		}
		
		if ( $this->getCreationMode() == self::UI_CONF_CREATION_MODE_MANUAL )
		{
			if ( ! kString::beginsWith( $v , $this->getUiConfRootDirectory() . "uiconf/" ) )
			{
				$v =  $this->getUiConfRootDirectory() . "uiconf/" . $v ;
			}

			$real_v = realpath( dirname( $v ) ) . "/" . pathinfo( $v , PATHINFO_BASENAME );
			
			if ( $v )
			{
				if ( $real_v )
				{
/*
 * TODO - add this id the service IS externally use via the API					
					// the file exists - make sure we're not overiding someone elses file 
					$ui_confs_with_same_path = uiConfPeer::retrieveByConfFilePath ( $real_v , $this->getId() );
					foreach ( $ui_confs_with_same_path as $ui_conf  )
					{
						if ( $ui_conf->getPartnerId ( ) != $this->getPartnerId() )
						{
							$err = "Error in " . __METHOD__ . ": attmpting to set ConfFilePath to [$v]";
							kLog::log( $err );
							throw new APIException ( APIErrors::ERROR_SETTING_FILE_PATH_FOR_UI_CONF , $v );							
						}
					}
*/
					$v = $real_v;
				}
			}
			parent::setConfFilePath( $v );			
		}
		else
		{
			parent::setConfFilePath( $v );	
//			throw new APIException ( APIErrors::ERROR_SETTING_FILE_PATH_FOR_UI_CONF , $v );		
		}
	}
		
	private function createConfFilePath ()
	{
		$file_name = "content/generatedUiConf/{$this->getPartnerId()}/{$this->getCreationModeAsStr()}/{$this->getId()}/ui_conf.xml";
		//$file_name = $this->getUiConfRootDirectory() . "generatedUiConf/{$this->getPartnerId()}/{$this->getCreationModeAsStr()}/{$this->getId()}/ui_conf.xml";
		return $file_name;
	}
	
	// IMPORTANT : WILL NOT include the uiconf or generatedUiconf part of the path
	private function getUiConfRootDirectory ()
	{
		$content_path = myContentStorage::getFSContentRootPath();
		return 	$content_path . "content/";
	}
	
	/*
	 * will create a new uiConf object in the DB from this object while using fields from 
	 */
	public function cloneToNew ( $new_ui_conf_obj , $new_name = null )
	{
		$cloned = new uiConf();

		$obj_wrapper = objectWrapperBase::getWrapperClass( $cloned  , 0 );
		
		$all_fields = uiConfPeer::getFieldNames (); 
		$ignore_list = array ( "Id" , "ConfFilePath" );
		// clone from current
		baseObjectUtils::fillObjectFromObject( $all_fields ,
			$this ,
			$cloned ,
			baseObjectUtils::CLONE_POLICY_PREFER_NEW , $ignore_list , BasePeer::TYPE_PHPNAME );
			
//		$cloned->setNew(true);
		// override with data from the $new_ui_conf_obj - the name can be chosen to override
		if ( $new_ui_conf_obj )
		{
			baseObjectUtils::fillObjectFromObject( $all_fields ,		// assume the new_ui_conf_obj can be fully copied to the cloned 
				$new_ui_conf_obj ,
				$cloned ,
				baseObjectUtils::CLONE_POLICY_PREFER_NEW , null , BasePeer::TYPE_PHPNAME );
		}

		if ($new_name) {
			$cloned->setName( $new_name );
		}
		$cloned->setConfFile( $this->getConfFile());
		$cloned->setConfFile2( $this->getConfFile2());
		$cloned->save();
		
		return $cloned;
	}
	
	public function getSwfNameFromType ()
	{
		$name = @self::$swf_names [ $this->getObjType() ];
		if ( $name ) return $name;
		return "";
	}
	
	public function getDirectoryMap ()
	{
		return self::$swf_directory_map;
	}
	
	public function getSwfNames()
	{
		return self::$swf_names;
	}
	
	
	
	public function getAutoplay ()	{		return $this->getFromCustomData( "autoplay" , null , false );	}
	public function setAutoplay( $v )	{		return $this->putInCustomData( "autoplay", $v );	}

	public function getAutomuted ()	{		return $this->getFromCustomData( "automuted" , null , false );	}
	public function setAutomuted( $v )	{		return $this->putInCustomData( "automuted", $v );	}

/* ---------------------- CustomData functions ------------------------- */
	private $m_custom_data = null;
	
	public function putInCustomData ( $name , $value , $namespace = null )
	{
//		sfLogger::getInstance()->warning ( __METHOD__ . " " . ( $namespace ? $namespace. ":" : "" ) . "[$name]=[$value]");
		$custom_data = $this->getCustomDataObj( );
		$custom_data->put ( $name , $value , $namespace );
	}

	public function getFromCustomData ( $name , $namespace = null , $def_value = null )
	{
		$custom_data = $this->getCustomDataObj( );
		$res = $custom_data->get ( $name , $namespace );
		if ( $res === null ) return $def_value;
		return $res;
	}

	public function removeFromCustomData ( $name , $namespace = null)
	{

		$custom_data = $this->getCustomDataObj( );
		return $custom_data->remove ( $name , $namespace );
	}

	public function incInCustomData ( $name , $delta = 1, $namespace = null)
	{
		$custom_data = $this->getCustomDataObj( );
		return $custom_data->inc ( $name , $delta , $namespace  );
	}

	public function decInCustomData ( $name , $delta = 1, $namespace = null)
	{
		$custom_data = $this->getCustomDataObj(  );
		return $custom_data->dec ( $name , $delta , $namespace );
	}

	private function getCustomDataObj( )
	{
		if ( ! $this->m_custom_data )
		{
			$this->m_custom_data = myCustomData::fromString ( $this->getCustomData() );
		}
		return $this->m_custom_data;
	}
	
	private function setCustomDataObj()
	{
		if ( $this->m_custom_data != null )
		{
			$this->setCustomData( $this->m_custom_data->toString() );
		}
	}
/* ---------------------- CustomData functions ------------------------- */	
}
