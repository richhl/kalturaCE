<?php
class myPartnerUtils
{
	const PARTNER_SET_POLICY_NONE = 1;
	const PARTNER_SET_POLICY_IF_NULL = 2;
	const PARTNER_SET_POLICY_FORCE = 3;

	const PUBLIC_PARTNER_INDEX = 99;

	const PARTNER_GROUP = "__GROUP_PARTNER__";
	
	const ALL_PARTNERS_WILD_CHAR = "*";
	
	private static $s_current_partner_id = null;
	private static $s_set_partner_id_policy  = self::PARTNER_SET_POLICY_NONE;

	private static $s_filterred_peer_list = array();
	 
	public static function getUrlForPartner ( $partner_id , $subp_id  )
	{
		return "/p/$partner_id/sp/$subp_id";	
	}
	
	public static function shouldDisplayInSearch ( $partner_id )
	{
		// if the partner_id is null - for now - assume should be displayed
		if ( $partner_id == null ) return true;

		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( ! $partner )
			return false;
		return ( $partner->getAppearInSearch() );
	}

	public static function getPrefix ( $partner_id , $padding = true)
	{
		if ( empty ( $partner_id ) ) return "";

		$prefix = null; 
		if ( ! $prefix )
		{
			$partner = PartnerPeer::retrieveByPK( $partner_id );
			if ( ! $partner )
				return null;
			$prefix = $partner->getPrefix();
		}

		if ( $prefix && $padding )
		{
			$prefix = "_" . $prefix . "_";
		}

		return $prefix;
	}

	/**
	 * checks if the secret matchs the partner_id -
	 * if not - increment the invlid_login_count and make sure does not exceed the limit
	 *
	 * will use cache to reduce the times the partner table is hit (hardley changes over time)
	 */
	public static function isValidSecret ( $partner_id , $partner_secret , $partner_key , &$ks_max_expiry_in_seconds , $admin = false  )
	{
		// TODO - handle errors
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return Partner::VALIDATE_WRONG_LOGIN;

		return $partner->validateSecret( $partner_secret , $partner_key , $ks_max_expiry_in_seconds , $admin);
	}

	/**
	 * a lks  is a "lite" kaltura session. It is created by the partner and can be be translated into a simplified ks:
	 * 	1. only regular - not admin
	 * 	2. view & edit privileges (nt for a specific ks)
	 * 	3. does not expire  
	 * 
	 * 	lks = md5 ( secret , puser_id , version )
	 */
	public static function isValidLks ( $partner_id , $lks , $puser_id , $version , &$ks_max_expiry_in_seconds   )
	{
		// TODO - handle errors
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return Partner::VALIDATE_WRONG_LOGIN;
		if ( !$partner->getAllowLks() )	 return Partner::VALIDATE_LKS_DISABLED;
			
		$our_hash = md5 ( $partner->getSecret() . $puser_id . $version );
		$ks_max_expiry_in_seconds = $partner->getKsMaxExpiryInSeconds();
		if ( $lks != $our_hash ) return ks::INVALID_LKS;
		return ( ks::OK );
	}
	
	
	public static function getExpiry ( $partner_id )
	{
		// TODO - handle errors
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return Partner::VALIDATE_WRONG_LOGIN;

		return $partner->getKsMaxExpiryInSeconds( );
	}

	public static function setCurrentPartner ( $partner_id )
	{
		self::$s_current_partner_id = $partner_id;
	}



	// will reset all the filters used in the applyPartnerFilters
	public static function resetAllFilters()
	{
		foreach ( self::$s_filterred_peer_list as $peer )
		{
			$peer->setDefaultCriteriaFilter();
		}
	}
	
	/**
	 * Will set the pertner filter in all 3 peers:
	 * 	kuserPeer
	 * 	kshowPeer
	 * 	entryPeer
	 *
	 * @param unknown_type $partner_id
	 */
	public static function applyPartnerFilters ( $partner_id=null , $private_partner_data = false , $partner_group = null , $kaltura_network = null )
	{
		if ( $partner_id === null )
		{
			$partner_id = self::$s_current_partner_id;
		}

//echo __METHOD__ . ":" . "[$partner_id] , [$private_partner_data] , [$partner_group] , [$kaltura_network]" ;		
		// TODO - set !
		// make sure to pass the $partner_group &  $kaltura_network to objects where they are appropriate
/*
		self::addPartnerToCriteria ( kuserPeer::getCriteriaFilter() , kuserPeer::PARTNER_ID ,  $partner_id );
		self::addPartnerToCriteria ( entryPeer::getCriteriaFilter() , entryPeer::PARTNER_ID ,  $partner_id );
		self::addPartnerToCriteria ( kshowPeer::getCriteriaFilter() , kshowPeer::PARTNER_ID ,  $partner_id );
		self::addPartnerToCriteria ( moderationPeer::getCriteriaFilter() , moderationPeer::PARTNER_ID ,  $partner_id );
		self::addPartnerToCriteria ( notificationPeer::getCriteriaFilter() , notificationPeer::PARTNER_ID ,  $partner_id );
*/
		
		self::addPartnerToCriteria ( new kuserPeer() , $partner_id , $private_partner_data, $partner_group);
		self::addPartnerToCriteria ( new entryPeer() , $partner_id , $private_partner_data, $partner_group , $kaltura_network );
		self::addPartnerToCriteria ( new kshowPeer() , $partner_id , $private_partner_data, $partner_group , $kaltura_network );
		self::addPartnerToCriteria ( new moderationPeer() , $partner_id , $private_partner_data );
		self::addPartnerToCriteria ( new notificationPeer() , $partner_id , $private_partner_data );
		
		// TODO - due to very bad performance every time there is such a call, make sure this code is called from the uiConf services
//		self::addPartnerToCriteria ( new uiConfPeer() , $partner_id );

		//		self::addPartnerToCriteria ( new widgetPeer(), $partner_id );
//		self::addPartnerToCriteria ( new PuserKuserPeer() , $partner_id );
//		self::addPartnerToCriteria ( new BatchJobPeer(), $partner_id );
	}

	private static function _addPartnerToCriteria ( $criteria_filter , $partner_field_name  , $partner_id )
	{
		$criteria = $criteria_filter->getFilter();
		$criteria->addAnd ( $partner_field_name , $partner_id );
		$criteria_filter->enable();
	}
	
	// if only partner_id exists - force it on the criteria
	// if also $partner_group - allow or partner_id or the partner_group - use in ( partner_id ,  $partner_group ) - where partner_group is split by ','
	// if partner_group == "*" - don't filter at all
	// if $kaltura_network - add 'or  display_in_search >= 2'
	public static function addPartnerToCriteria ( $peer , $partner_id , $private_partner_data = false , $partner_group=null , $kaltura_network=null )
	{
		self::$s_filterred_peer_list[] = $peer;
		
		$criteria_filter = $peer->getCriteriaFilter();
		$criteria = $criteria_filter->getFilter();
		
		$partner_field_name = $peer->translateFieldName( "partner_id" , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
		
		if( !$private_partner_data )
		{
			// the private partner data is not allowed - 
			if ( $kaltura_network )
			{
				// allow only the kaltura netword stuff
				$display_in_search_field_name = $peer->translateFieldName( "display_in_search" , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
				$criterion = $criteria->getNewCriterion( $display_in_search_field_name , mySearchUtils::DISPLAY_IN_SEARCH_KALTURA_NETWORK , Criteria::GREATER_EQUAL );
//				$criterion->addAnd ( $criterion2 ) ;
				if ( $partner_id )
				{
					$order_by = "({$partner_field_name}<>{$partner_id})";  // first take the pattner_id and then the rest
					myCriteria::addComment( $criteria , "Only Kaltura Network" );
					$criteria->addAscendingOrderByColumn ( $order_by );//, Criteria::CUSTOM );
				}
			}
			else
			{
				// no private data and no kaltura_network - 
				// add a criteria that will return nothing
				$criterion = $criteria->getNewCriterion( $partner_field_name , Partner::PARTNER_THAT_DOWS_NOT_EXIST ) ;
			}
			
			$criteria->addAnd( $criterion );
		}
		else
		{
			// private data is allowed
			if ( empty ($partner_group ) && empty ( $kaltura_network ) )
			{
				// the default case
				$criteria->addAnd ( $partner_field_name , $partner_id );
			}
			elseif ( $partner_group == self::ALL_PARTNERS_WILD_CHAR )
			{
				// all is allowed - don't add anything to the criteria
			}
			else 
			{
				if ( $partner_group )
				{
					// $partner_group hold a list of partners separated by ',' or $kaltura_network is not empty (should be mySearchUtils::KALTURA_NETWORK = 'kn')
					$partners = explode ( "," , trim($partner_group ));
					foreach ( $partners as &$p ) { trim($p); } // make sure there are not leading or trailing spaces
	
					// add the partner_id to the partner_group
					$partners[] = $partner_id;
					
					$criterion = $criteria->getNewCriterion( $partner_field_name , $partners , Criteria::IN ) ;
				}
				else 
				{
					$criterion = $criteria->getNewCriterion( $partner_field_name , $partner_id ) ;
				}	
	
				
				if ( $kaltura_network )
				{
					$display_in_search_field_name = $peer->translateFieldName( "display_in_search" , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
					$criterion2 = $criteria->getNewCriterion( $display_in_search_field_name , mySearchUtils::DISPLAY_IN_SEARCH_KALTURA_NETWORK , Criteria::GREATER_EQUAL );
					$criterion->addOr ( $criterion2 ) ;
				}
				
				$criteria->addAnd( $criterion );
			}
		}
			
		$criteria_filter->enable();
	}

	public static function partnerHasRoles ( $partner_id )
	{

	}

	public static function setPartnerFrocePolicy ( $val )
	{
		self::$s_set_partner_id_policy = $val;
	}

	public static function setPartnerIdForObj ( BaseObject $obj )
	{
		if ( self::$s_set_partner_id_policy == self::PARTNER_SET_POLICY_NONE )
			return;
		if ( $obj == null )
			return;

		$current_obj_partner = $obj->getPartnerId();
		if ( self::$s_set_partner_id_policy == self::PARTNER_SET_POLICY_IF_NULL  && $current_obj_partner == null)
		{
			$obj->setPartnerId ( self::$s_current_partner_id );
			return;
		}

		// force
		$obj->setPartnerId ( self::$s_current_partner_id );
	}


	public static function getMediaServiceProviders ( $partner_id , $subp_id )
	{
		$provider_id_list = myMediaSourceFactory::getAllMediaSourceProvidersIds ();

		$result = array();
		foreach ( $provider_id_list as $provider_id )
		{

			$provider = myMediaSourceFactory::getMediaSource( $provider_id );
			$res = $provider->getSearchConfig();
			$result["__$provider_id" . "_service"] = $res;
		}

		return $result;

	}

	public static function createWidgetImage($partner, $create)
	{
		$contentPath = myContentStorage::getFSContentRootPath();
		$path = kFile::fixPath( $contentPath.$partner->getWidgetImagePath() );

		// if the create flag is not set and the file doesnt exist exit
		// e.g. the roughcut name has change, we update the image only if it was already in some widget
		if (!$create && !file_exists($path))
			return;

		$im = imagecreatetruecolor(400,20);

		$green = imagecolorallocate($im, 188, 230, 99);
		$white = imagecolorallocate($im, 255, 255, 255);

		$font = SF_ROOT_DIR.'/web/ttf/arial.ttf';

		$fontSize = 9;
		$bottom = 15;

		$pos = imagettftext($im, $fontSize, 0, 10, $bottom, $green, $font, $partner->getPartnerName()." Collaborative Video");
		$pos = imagettftext($im, $fontSize, 0, $pos[2], $bottom, $white, $font, " powered by ");
		imagettftext($im, $fontSize, 0, $pos[2], $bottom, $green, $font, "Kaltura");

		myContentStorage::fullMkdir($path);

		imagegif($im, $path);
		imagedestroy($im);

	}

	public static function shouldForceUniqueKshow ( $partner_id , $allow_duplicate_names )
	{
		// TODO - make more generic !
		// TODO - remove this code - it's only for wikis
		if ( ! $allow_duplicate_names ) return true;
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return !$allow_duplicate_names;
		return $partner->getShouldForceUniqueKshow();
	}

	public static function returnDuplicateKshow ( $partner_id )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return false;
		return $partner->getReturnDuplicateKshow();		
	}
	
	public static function shouldNotify ( $partner_id )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return array ( false , null );
		return array ( $partner->getNotify() , $partner->getNotificationsConfig() ) ;
	}

	public static function shouldModerate ( $partner_id )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return false;
		return $partner->getModerateContent();
	}
	
	// if the host of the partner is false or null or an empty string - ignore it
	public static function getHost ( $partner_id )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner || (! $partner->getHost() ) ) return requestUtils::getRequestHost();
		return $partner->getHost();
	}
	
	// if the cdnHost of the partner is false or null or an empty string - ignore it	
	public static function getCdnHost ( $partner_id )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner || (! $partner->getCdnHost() ) ) return requestUtils::getCdnHost();
		return $partner->getCdnHost();
	}
	
	/**
	 * Will determine the conversion string for the entry id.
	 * This depends on the partner and the nature of the file
	 */
	public static function getConversionStringForEntry ( $entry_id , $file_name )
	{
		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry ) return null;
		
		$conversion_profile_id = $entry->getConversionQuality();

		$partner = PartnerPeer::retrieveByPK( $entry->getPartnerId() );
		if ( ! $partner ) return null ; // VERY BAD !!

		// check the type of the file
		// if of type flv - check for flvConversionString

		$conversion_str = "";
		
		// prefer the conversion_profile over the conversion_string (which is obsolete)
		if ( ! $conversion_profile_id ) $conversion_profile_id =  $partner->getDefConversionProfileType();
		if ( ! $conversion_profile_id )
		{
			if ( myFlvStaticHandler::isFlv( $file_name ) )
			{ 
				$conversion_str = $partner->getFlvConversionString();
			}
	
			if ( ! $conversion_str ) $conversion_str = $partner->getConversionString();
			/// TODO - optimize - check according to the conversion string if need to fetch data from the file
			list ( $video_width , $video_height ) = myFileConverter::getVideoDimensions( $file_name );
	
			$conversion_str = myFileConverter::formatConversionString ( $conversion_str , $video_width , $video_height );
		}
		
		// if the $conversion_profile_id is not specified on the entry - look at the partner's conversion_string
		// TODO - HACK, this is until we have a default conversion_profile for the partner
		if ( !$conversion_profile_id && strpos ($conversion_str , "!" ) === 0 )
		{
			// the conversion string strart with ! - use this as the default conversionQuality of the partner
			// copy it on the entry - it will follow the entry from this point onwards
			$conversion_profile_id = substr ( $conversion_str , 1 ); // without the !
		}
		
		// update the entry if there is a better $conversion_profile_id than the original one the entry had
		if ( $conversion_profile_id && $conversion_profile_id != $entry->getConversionQuality() )
		{
			$entry->setConversionQuality( $conversion_profile_id  );
			$entry->save();
		}
		
		return array ( $conversion_str , $conversion_profile_id );
	}
	

	/**
	 * return the ConversionProfile for this entry is specified on the entry or for the partner
	 * the is_flv is important for deciding on the actual set of conversion params
	 */
	public static function getConversionProfileForEntry ( $entry_id  )
	{
		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry ) return null;
		
		// conversion quality is an alias for conersion_profile_type ('low' , 'med' , 'hi' , 'hd' ... )
		$conversion_profile_quality = $entry->getConversionQuality();
		
		if ( $conversion_profile_quality )
		{
			return myConversionProfileUtils::getConversionProfile ( $entry->getPartnerId() , $conversion_profile_quality  );
		}

		$partner = PartnerPeer::retrieveByPK( $entry->getPartnerId() );
		if ( ! $partner ) return null ; // VERY BAD !!

		return myConversionProfileUtils::getConversionProfileByType ( $partner->getId() , $partner->getDefConversionProfileType() );
	}	
	
	
/*@Partner $partner*/
	public static function getDefaultKshow ( $partner_id, $subp_id , $puser_kuser, $group_id = null , $create_anyway = false, $default_name = null )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id ); 
		if ( !$partner ) return null;
		
		// see if partner allows a fallback kshow
		$allow = $partner->getUseDefaultKshow();
		if ( ! $allow ) return null;

		$kshow = myKshowUtils::getDefaultKshow ( $partner_id , $subp_id , $puser_kuser , $group_id , $partner->getAllowQuickEdit() , $create_anyway , $default_name );
		return $kshow;
	}
	
	
	public static function allowPartnerAccessPartner ( $operating_partner_id , $partner_group , $partner_id )
	{
		// $operating_partner_id is operating on itself
		if ( $operating_partner_id == $partner_id ) return true;
		
		// operating_partner has permission to operate on all partners
		if ( $partner_group == self::ALL_PARTNERS_WILD_CHAR ) return true;

		$partner_group_arr = explode ( "," , $partner_group );
		foreach ( $partner_group_arr as &$single_partner_id ) { $single_partner_id = trim($single_partner_id); } // clear whitespaces

		// ok if the partner_id is explicitly in the partner_group
		return in_array ($partner_id , $partner_group_arr );
	}
	
	/*
	  	this function should help create some good default widgets and ui_confs for a partner.
	  	a new dirctory will be created specially for this partner with copies of the xml templates (with their content modified) and copies of default swfs.
	  	will create widgets and ui_confs for this partner from given templates 
	 	$partner_prefix will be used as the directory for the new files
	 	TODO - use_cdn should be true for production, but we should decide what's the correct value for a partner just created 
		will return an informative array with newly created objects
	*/
	public static function initializePartner ( $partner_id , $subp_id , $partner_prefix ,  $use_cdn ,  
		$kdp_ui_conf_path , $kdp_swf_url , 
		$kse_ui_conf_path , $kse_swf_url , 
		$kcw_ui_conf_path , $kcw_swf_url )
	{
		$ui_conf_dir = myContentStorage::getFSContentRootPath() . "/content" . myContentStorage::getFSUiconfRootPath() . "/" . $partner_prefix;
		kFile::fullMkdir ( $ui_conf_dir );
		
		$res = array ();
		$res["conf_dir"] = $ui_conf_dir;
		
		// copy the $partner_prefix skin.swf and the $partner_prefix.swf 
		
		// TODO - maybe start from some good ui_conf in the DB ?
		// it will help have less hard-coded stuff here (height and width for example)
 
		// TODO - copy SWFs 

		
		// kdp_ui_conf
		// replacte-template 
		// -- skinPath
		// -- watermarkPath 
		$dictionary = array ( "skinPath" => "<|||skinPath||>" , "watermarkPath" => "<|||watermarkPath|||>" );
		$c = new Criteria();
		$c->add ( uiConfPeer::PARTNER_ID , $partner_id );
		$c->add ( uiConfPeer::SUBP_ID , $subp_id );
		$c->add ( uiConfPeer::OBJ_TYPE , uiConf::UI_CONF_TYPE_WIDGET );
		$ui_conf = uiConfPeer::doSelectOne( $c );
		
		$ui_conf = new uiConf();
		$ui_conf->setPartnerId( $partner_id );
		$ui_conf->setSubpId( $subp_id );
		$ui_conf->setSwfUrl( $kdp_swf_url );
		$ui_conf->setObjType( uiConf::UI_CONF_TYPE_WIDGET );
		$ui_conf->setConfFilePath( self::replaceTemplate ( $kdp_ui_conf_path , $dictionary , $partner_prefix , $ui_conf_dir , true ) );
		$ui_conf->setUseCdn( $use_cdn );
		$ui_conf->save();
		$kdp_ui_conf_id = $ui_conf->getId();
		$res["kdp_ui_conf"] = $ui_conf;
		
		// create widget associated with the kdp_ui_conf 
		$widget = new widget();
		$widget->setPartnerId( $partner_id);
		$widget->setSubpId( $subp_id );
		$widget->setUiConfId( $kdp_ui_conf_id );
		$widget->save();
		$res["widget"] = $widget;
		
		// kse_ui_conf
		// replacte-template 
		// -- UIConfigId
		$dictionary = array ( "UIConfigId" => "<|||UIConfigId||>" );		
		$ui_conf = new uiConf();
		$ui_conf->setPartnerId( $partner_id );
		$ui_conf->setSubpId( $subp_id );
		$ui_conf->setSwfUrl( $kse_swf_url );
		$ui_conf->setObjType( uiConf::UI_CONF_TYPE_EDITOR );
		$ui_conf->setConfFilePath( self::replaceTemplate ( $kse_ui_conf_path , $dictionary , $partner_prefix , $ui_conf_dir , true ) );
		$ui_conf->setUseCdn( $use_cdn );
		$ui_conf->save();
		$res["kse_ui_conf"] = $ui_conf;
		
		// kcw_ui_conf
		// replacte-template 
		// no parameters for now
		$dictionary = array (  );		
		$ui_conf = new uiConf();
		$ui_conf->setPartnerId( $partner_id );
		$ui_conf->setSubpId( $subp_id );
		$ui_conf->setSwfUrl( $kcw_swf_url );
		$ui_conf->setObjType( uiConf::UI_CONF_TYPE_CW );
		$ui_conf->setConfFilePath( self::replaceTemplate ( $kcw_ui_conf_path , $dictionary , $partner_prefix , $ui_conf_dir , true ) );
		$ui_conf->setUseCdn( $use_cdn );
		$ui_conf->save();
		$res["kcw_ui_conf"] = $ui_conf;
		
		return $res;
	}
	
	// will fetch the template_file_path and replace it's content with the dictionary words
	// will save the file under the target_dir after replacing the string 'partner' in the filename from $original_template_file_path 
	// $return_as_url - if false - will return the target_file_path, if ture - will return the url of this file
	private static function replaceTemplate ( $original_template_file_path , $dictionary , $partner_name , $target_dir , $return_as_url = false )
	{
		$source_file_name = pathinfo( $original_template_file_path , PATHINFO_FILENAME );
		$target_file_name = str_replace ( "partner" , $partner_name , $source_file_name ) ;
		
		if ( ! file_exists( $original_template_file_path) )
		{
			throw new Exception ( __METHOD__ . " Cannot find template [$original_template_file_path] for partner [$partner_name]" );
		}
		// replace all placeholders fro mtemplate with dictionary words
		$file_content = file_get_contents( $original_template_file_path );
		// placeholders are of tyoe {key} -> 
		foreach ( $dictionary as $key => $value )
		{
			// TODO - replace !!
		}
		
		// TODO - verify there are no placeholders left after replacing
		
		$target_file_path = $target_dir . "/" . $target_file_name;
		file_put_contents( $target_file_path , $file_content );
		if ( $return_as_url )
			return self::getUrlFromPath ( $target_file_path );
		else
			return $target_file_path;
	}
	
	// returns the URL for the file so can be accessed via the web
	private static function getUrlFromPath ( $ui_conf_file_path )
	{
		// remove the prefix before the /content - don't forget to leave the '/' as the first character
		$url = preg_replace( "/^.*\/content/" , "/content" , $ui_conf_file_path );
		return $url;
	}
	
	public static function getPartnerToken ( $token_prefix , $partner_id , $subp_id , $key )
	{
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		if ( !$partner ) return null;
		
		$input = $partner_id;

	    $td = mcrypt_module_open('tripledes', '', 'ecb', '');
	    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	    mcrypt_generic_init($td, $key, $iv);
	    $encrypted_data = mcrypt_generic($td, $input);
	    mcrypt_generic_deinit($td);
	    mcrypt_module_close($td);
		
		return $token_prefix . base64_encode( $encrypted_data );
	}
	
	public static function getServiceConfig ( $partner )
	{
		if ( $partner == null )
		{
			return new myServiceConfig( null );
		}
		else
		{
			return $partner->getServiceConfig();
		}
	}
	
	public static function getPartnerUsage( $partner )
	{
		$c = new Criteria();
		$c->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_STORAGE );
		$c->addAnd ( PartnerActivityPeer::SUB_ACTIVITY , PartnerActivity::PARTNER_SUB_ACTIVITY_STORAGE_SIZE );
		$c->addAnd ( PartnerActivityPeer::PARTNER_ID , $partner->getId() );
    	$c->addSelectColumn('sum('.PartnerActivityPeer::AMOUNT.') as total_hosting');

		$activity = PartnerActivityPeer::doSelectRS( $c );
		while ($activity->next()) { $total_hosting = $activity->get(1); }
		if ( !$total_hosting ) $total_hosting = 0;
		
		$c = new Criteria();
		$c->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_TRAFFIC );
		$c->addAnd ( PartnerActivityPeer::SUB_ACTIVITY , 
			array( 	PartnerActivity::PARTNER_SUB_ACTIVITY_WWW,
					PartnerActivity::PARTNER_SUB_ACTIVITY_LIMELIGHT ),
			Criteria::IN );
		$c->addAnd ( PartnerActivityPeer::PARTNER_ID , $partner->getId() );
		
		switch ( $partner->getPartnerPackage() ){
			case PartnerPackages::PARTNER_PACKAGE_20:
			case PartnerPackages::PARTNER_PACKAGE_50:
			case PartnerPackages::PARTNER_PACKAGE_100:
			case PartnerPackages::PARTNER_PACKAGE_250:
			case PartnerPackages::PARTNER_PACKAGE_500:
				$time_diff = time()-(60*60*24*((int)date('d')-1));
				$month = date('Y-m-d',$time_diff);
				$c->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, $month, Criteria::GREATER_EQUAL );
				$c->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, date('Y-m-d'), Criteria::LESS_EQUAL  );
				break;
			case PartnerPackages::PARTNER_PACKAGE_FREE:
			default:
				break;
		}
		$packages = new PartnerPackages();
		$partnerPackage = $packages->getPackageDetails($partner->getPartnerPackage());
		
    	$c->addSelectColumn('sum('.PartnerActivityPeer::AMOUNT.') as total_traffic');

		$activity = PartnerActivityPeer::doSelectRS( $c );
		while ($activity->next()) { $total_traffic = $activity->get(1); }
		if ( !$total_traffic ) $total_traffic = 0;
		
		$total = $total_traffic + $total_hosting;
		$return['MB'] = round($total/1024);
		$return['hostingMB'] = round($total_hosting/1024);
		$GB = round($return['MB']/1024, 2);
		$return['Percent'] = (round(($GB/$partnerPackage['cycle_bw']*100), 2))*100;
		$return['package_bw'] = $partnerPackage['cycle_bw'];
		$return['debug']['total'] = $total;
		$return['debug']['total_traffic'] = $total_traffic;
		$return['debug']['total_hosting'] = $total_hosting;

		return $return;
	}
	
	
	public static function notifiyPartner($mail_type, $partner, $body_params = array() )
	{
		$mailjob = new MailJob();
	 	$mailjob->Initialize( $mail_type );
	 	$mailjob->setFromEmail( kConf::get ( "partner_notification_email" ) ) ;//'customer_service@kaltura.com');
	 	$mailjob->setFromName( kConf::get ( "partner_notification_name" ) ) ;//'DO_NOT_REPLY Customer Service');
	 	$mailjob->setBodyParamsArray( $body_params );
		$mailjob->setSubjectParamsArray( array() );
		$mailjob->setRecipientEmail( $partner->getAdminEmail() );
		$mailjob->save();		
	}
	

	public static function emailChangedEmail($partner_old_email, $partner_new_email, $partner_name , $mail_type )
	{
	  	$mailjob = new MailJob();
	 	$mailjob->Initialize( $mail_type );
	 	$mailjob->setFromEmail( kConf::get ( "partner_change_email_email") );
	 	$mailjob->setFromName( kConf::get ( "partner_change_email_name") );
	 	$mailjob->setBodyParamsArray( array($partner_name,$partner_old_email,$partner_new_email) );
		$mailjob->setSubjectParamsArray( array() );
		$mailjob->setRecipientEmail( $partner_old_email.','.$partner_new_email );
		$mailjob->save();
	}
		
	const KALTURA_PACKAGE_EIGHTY_PERCENT_WARNING = 81;
	const KALTURA_PACKAGE_LIMIT_WARNING_1 = 82;
	const KALTURA_PACKAGE_LIMIT_WARNING_2 = 83;
	const KALTURA_DELETE_ACCOUNT = 84;
	const KALTURA_PAID_PACKAGE_SUGGEST_UPGRADE = 85;
	 
	public static function doPartnerUsage($partner, $batch_run = false)
	{
		$three_days_grace = time() - (60*60*24*3);
		$month_grace = $three_days_grace * 30;
		
		/* calc total usage for period */
		$total_usage = myPartnerUtils::getPartnerUsage( $partner );
		
		/* set partner total usage , last check date and percentage usage */
		$partner->setUsagePercent($total_usage['Percent']);
		$partner->setStorageUsage($total_usage['hostingMB']);
 		$percent = $total_usage['Percent']/100;
 		
		$packages = new PartnerPackages();
		$partnerPackage = $packages->getPackageDetails($partner->getPartnerPackage());
 		
		if ($percent >= 80 &&
			$percent < 100 &&
			!$partner->getEightyPercentWarning())
		{
			if ($batch_run)
				TRACE("partner ". $partner->getId() ." reached 80% - setting first warning");
				
			/* prepare mail job, and set EightyPercentWarning() to true/date */
			$partner->setEightyPercentWarning(time());
			$partner->setUsageLimitWarning(0);
			$body_params = array ( $partner->getAdminName(), $total_usage['GB'] , '$50' );
			//myPartnerUtils::notifiyPartner(myPartnerUtils::KALTURA_PACKAGE_EIGHTY_PERCENT_WARNING, $partner);
		}
		elseif ($percent < 80 &&
				$partner->getEightyPercentWarning())
		{
			if ($batch_run)
				TRACE("partner ". $partner->getId() ." was 80%, now not. clearing warnings");
				
			/* clear getEightyPercentWarning */
			$partner->setEightyPercentWarning(0);
			$partner->setUsageLimitWarning(0);
		}
		elseif ($percent >= 100 &&
				!$partner->getUsageLimitWarning())
		{
			if ($batch_run)
				TRACE("partner ". $partner->getId() ." reached 100% - setting second warning");
				
			/* prepare mail job, and set getUsageLimitWarning() date */
			$partner->setUsageLimitWarning(time());
			if ($partnerPackage['cycle_fee'] == 0)
			{
				$body_params = array ( $partner->getAdminName(), '$50' );
				//myPartnerUtils::notifiyPartner(myPartnerUtils::KALTURA_PACKAGE_LIMIT_WARNING_1, $partner);
			}
		}
		elseif ($percent >= 100 &&
				$partnerPackage['cycle_fee'] == 0 &&
				$partner->getUsageLimitWarning() > 0 && 
				$partner->getUsageLimitWarning() <= $three_days_grace &&
				$partner->getStatus() != Partner::CONTENT_BLOCK_STATUS)
		{
			if ($batch_run)
				TRACE("partner ". $partner->getId() ." reached 100% 3 days ago - sending block email and blocking partner");
				
			/* send block email and block partner */
			$body_params = array ( $partner->getAdminName(), '$50' );
			//myPartnerUtils::notifiyPartner(myPartnerUtils::KALTURA_PACKAGE_LIMIT_WARNING_2, $partner);
			//$partner->setStatus(2);
		}
		elseif ($percent >= 120 &&
				$partnerPackage['cycle_fee'] != 0 &&
				$partner->getUsageLimitWarning() <= $three_days_grace)
		{
			$body_params = array ( $partner->getAdminName(), $total_usage['GB'] );
			//myPartnerUtils::notifiyPartner(myPartnerUtils::KALTURA_PAID_PACKAGE_SUGGEST_UPGRADE, $partner);
		}
		elseif ($percent >= 100 &&
				$partnerPackage['cycle_fee'] == 0 &&
				$partner->getUsageLimitWarning() > 0 &&
				$partner->getUsageLimitWarning() <= $month_grace &&
				$partner->getStatus() == Partner::CONTENT_BLOCK_STATUS)
		{
			if ($batch_run)
				TRACE("partner ". $partner->getId() ." reached 100% a month ago - deleting partner");
				
			/* delete partner */
			$body_params = array ( $partner->getAdminName() );
			//myPartnerUtils::notifiyPartner(myPartnerUtils::KALTURA_DELETE_ACCOUNT, $partner);
			//$partner->setStatus(0);
		}
		else
		{
			//if ($batch_run)
			//	TRACE("partner ". $partner->getId() ." OK");
			// PARTNER OK - reseting status, cleaning warning flags
			//$partner->setStatus(1);
			$partner->setEightyPercentWarning(0);
			$partner->setUsageLimitWarning(0);
		}
		$partner->save();		
	}
		
	public static function getPartnerUsageGraph( $year , $month , $partner , $resolution = 'days')
	{
		if (!$resolution) $resolution = 'days';
		
		$start_date = $year .'-'. (($month)? $month: '01') .'-01';
		
		switch ( $resolution )
		{
			case 'weeks':
			case 'days':
				$end_date = $year .'-'. ($month + 1) .'-01';
				$end_date_filter = Criteria::LESS_THAN;
				break;
			
			case 'months':
				$start_date = $year.'-'.'01-01';
				if ((int)date('Y') == $year)
				{
					$end_date = date('Y-m-d');
					$end_date_filter = Criteria::LESS_EQUAL;
				}
				else 
				{
					$end_date = ((int)$year + 1).'-01-01';
					$end_date_filter = Criteria::LESS_THAN;
				}
				break;
		}
		
		$c = new Criteria();
		$c->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_TRAFFIC );
		$c->addAnd ( PartnerActivityPeer::SUB_ACTIVITY , 
			array( 	PartnerActivity::PARTNER_SUB_ACTIVITY_WWW,
					PartnerActivity::PARTNER_SUB_ACTIVITY_LIMELIGHT ),
			Criteria::IN );
		$c->addAnd ( PartnerActivityPeer::PARTNER_ID , $partner->getId() );
		$c->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, $start_date, Criteria::GREATER_EQUAL );
		$c->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, $end_date, $end_date_filter );

		$activity = PartnerActivityPeer::doSelect( $c );

		$graph_points['line'] = myPartnerUtils::activity_to_graph($activity, $resolution, $start_date);

		return $graph_points;
	}
	
	public static function activity_to_graph($act, $res, $start_date)
	{
		$points = array();
		$days = 2;
		$months = 1;
		$year = 0;
		foreach ($act as $row)
		{
			$date = explode('-', $row->getActivityDate());
			if ($res == "weeks")
			{
				$week = (int)($date[2]/7);
				if(!isset($points[$week])) $points[$week] = 0;
				$points[$week] += round(($row->getAmount()/1024));
				continue;
			}
			if (!isset($points[(int)$date[${$res}]])) $points[(int)$date[${$res}]] = 0;
			$points[(int)$date[${$res}]] += round(($row->getAmount()/1024));
		}
		$return = '';
		if ($res == 'days') 
		{
			$days_in_month = date('t', (int)strtotime($start_date));
			for($i=1;$i<=$days_in_month;$i++) 
			{
				if(!isset($points[$i])) 
				{
					$points[$i] = 0;
				}
			}
		}
		if ($res == 'months') 
		{
			for($i=1;$i<=12;$i++) 
			{
				if (!isset($points[$i]))
				{
					$points[$i] = 0;
				}
			}
		}
 
		ksort($points);
		foreach($points as $point => $usage) {
			$return .= (int)$point.','.$usage.';';
		}
		return $return;
	}

}
?>