<?php
require_once ( MODULES . "/partnerservices2/actions/getwidgetAction.class.php" );

function klog ( $str )
{
	 kLog::log( "kwidgetAction: " . $str );
}

class kwidgetAction extends sfAction
{
	/**
	 * Will forward to the regular swf player according to the widget_id 
	 */
	public function execute()
	{
		$uv_cookie = @$_COOKIE['uv'];
		if (strlen($uv_cookie) != 35)
		{
			$uv_cookie = "uv_".md5(uniqid(rand(), true));
		}
		setrawcookie( 'uv', $uv_cookie, time() + 3600 * 24 * 365, '/' );
		
		$allowCache = true;
		$cache = new myCache("kwidget", 10 * 60); // 10 minutes
		$referer = @$_SERVER['HTTP_REFERER'];
		
		$externalInterfaceDisabled = (
			strstr($referer, "bebo.com") === false &&
			strstr($referer, "myspace.com") === false &&
			strstr($referer, "current.com") === false &&
			strstr($referer, "myyearbook.com") === false &&
			strstr($referer, "friendster.com") === false) ? "" : "&externalInterfaceDisabled=1";
			
		$requestKey = $_SERVER["REQUEST_URI"];
		$cachedResponse  = $cache->get($requestKey);
		if ($cachedResponse)
		{
			header("X-Kaltura:cached-action");
			
			header("Expires: Thu, 19 Nov 2000 08:52:00 GMT");
			header( "Cache-Control" , "no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
			header( "Pragma" , "no-cache" );
			header("Location:$cachedResponse".$externalInterfaceDisabled."&referer=".urlencode($referer));
			die;
		}
		
		$widget_id = $this->getRequestParameter( "wid" );
		$show_version = $this->getRequestParameter( "v" );
		$debug_kdp = $this->getRequestParameter( "debug_kdp" , false );
		
		$widget = widgetPeer::retrieveByPK( $widget_id );
		
		if ( !$widget )
		{
			die();	
		}
		
		// because of the routing rule - the entry_id & kmedia_type WILL exist. be sure to ignore them if smaller than 0
		$kshow_id= $widget->getKshowId();
		$entry_id= $widget->getEntryId(); 
		$gallery_widget = !$kshow_id && !$entry_id;
		
		if( !$entry_id  ) $entry_id = -1;

		if ( $widget->getSecurityType () != widget::WIDGET_SECURITY_TYPE_TIMEHASH  )
		{
			// try eid - if failed entry_id
			$eid = $this->getRequestParameter( "eid" , $this->getRequestParameter( "entry_id" ) );
			// try kid - if failed kshow_id			
			$kid = $this->getRequestParameter( "kid" , $this->getRequestParameter( "kshow_id" ) );
			if ( $eid != null )
				$entry_id =  $eid ;
			// allow kshow to be overriden by dynamic one
			elseif ( $kid != null )
				$kshow_id = $kid ;
		}
		
		if ( $widget->getSecurityType () == widget::WIDGET_SECURITY_TYPE_MATCH_IP  )
		{
			$allowCache = false;
			
			// here we'll attemp to match the ip of the request with that from the customData of the widget
			$custom_data = $widget->getCustomData();
			$valid_country  = false;

			if ( $custom_data )
			{
				// in this case the custom_data should be of format:
				//  valid_county_1,valid_country_2,...,valid_country_n;falback_entry_id
				list ( $countries_str , $fallback_entry_id , $fallback_kshow_id) = explode ( ";" , $custom_data );  
				$current_country = "";
			
				$valid_country = requestUtils::matchIpCountry( $countries_str , $current_country );
				if ( ! $valid_country )
				{
					kLog::log ( "kwidgetAction: Attempting to access widget [$widget_id] and entry [$entry_id] from country [$current_country]. Retrning entry_id: [$fallback_entry_id] kshow_id [$fallback_kshow_id]" );
					$entry_id= $fallback_entry_id; 
					$kshow_id = $fallback_kshow_id;
				}
			}
		}
		elseif ( $widget->getSecurityType () == widget::WIDGET_SECURITY_TYPE_FORCE_KS )
		{
			
		}
		
		
		$kmedia_type= -1;
		
		// support either uiconf_id or ui_conf_id
		$uiconf_id =  $this->getRequestParameter( "uiconf_id" );
		if ( !$uiconf_id ) $uiconf_id =  $this->getRequestParameter( "ui_conf_id" );
		
		if ( $uiconf_id )
		{
			$widget_type = $uiconf_id;
			$uiconf_id_str = "&uiconf_id=$uiconf_id";
		}
		else
		{
			$widget_type = $widget->getUiConfId() ; // TODO
			$uiconf_id_str = "";
		} 
		

		if ( empty ( $widget_type ) ) 
			$widget_type = 3; 
		$kdata = $widget->getCustomData();

		$partner_host = myPartnerUtils::getHost($widget->getPartnerId());
		$partner_cdnHost = myPartnerUtils::getCdnHost($widget->getPartnerId());

		$host = $partner_host;
		
		if ( $widget_type == 10)
			$swf_url = $host . "/swf/weplay.swf";
		else
			$swf_url = $host . "/swf/kplayer.swf";

		$partner_id = $widget->getPartnerId();
		$subp_id = $widget->getSubpId();
		if (!$subp_id)
			$subp_id = 0;		
				
		$uiConf = uiConfPeer::retrieveByPK($widget_type);
		if ($uiConf)
		{
			$ui_conf_swf_url = $uiConf->getSwfUrl();
			if( kString::beginsWith( $ui_conf_swf_url , "http") )
			{
				$swf_url = 	$ui_conf_swf_url; // absolute URL 
			}
			else
			{
				$use_cdn = $uiConf->getUseCdn();
				$host = $use_cdn ?  $partner_cdnHost : $partner_host;
				$swf_url =  $host . myPartnerUtils::getUrlForPartner ( $partner_id , $subp_id ) . $ui_conf_swf_url;
			}
			
			if ( $debug_kdp )
			{
				$swf_url = str_replace( "/kdp/" , "/kdp_debug/" , $swf_url );
			}
		}
		
		if ( $show_version < 0 )
			$show_version = null;
			
			
		$ip = @$_SERVER['REMOTE_ADDR'] ;// to convert back, use long2ip
		
		// the widget log should change to reflect the new data, but for now - i used $widget_id instead of the widgget_type
//		WidgetLog::createWidgetLog( $referer , $ip , $kshow_id , $entry_id , $kmedia_type , $widget_id );
		
		if ( $entry_id == -1 ) $entry_id = null;


		if ($uiConf)
		{
			$ks_flashvars = "";
			$conf_vars = $uiConf->getConfVars();
			if ($conf_vars)
				$conf_vars = "&".$conf_vars;
			
			$wrapper_swf = "flash/kdpwrapper/v8.0/kdpwrapper.swf";

			$partner = PartnerPeer::retrieveByPK($partner_id);
			
			if( $partner )
			{
				$partner_type = $partner->getType();
			}
						

			if ($partner_host == "http://www.kaltura.com")
				$partner_host = 1; // otherwise the kdp will try going to cdnwww.kaltura.com
				
			$dynamic_date = "widget_id=$widget_id" .
			"&kdpUrl=".urlencode($swf_url).
			"&host=" . str_replace("http://", "", $partner_host).
			"&cdnHost=" . str_replace("http://", "", $partner_cdnHost).
			( $show_version ? "&entryVersion=$show_version" : "" ) .
			( $kshow_id ? "&kshowId=$kshow_id" : "" ).
			( $entry_id ? "&entryId=$entry_id" : "" ) .
			$uiconf_id_str  . // will be empty if nothing to add
			$ks_flashvars.
			$conf_vars;
			
	

			// for now changed back to $host since kdp version prior to 1.0.15 didnt support loading by external domain kdpwrapper
			$url =  $host . myPartnerUtils::getUrlForPartner( $partner_id , $subp_id ) . "/$wrapper_swf?$dynamic_date";
//klog ( $url ); 			
		}
		else
		{
			$dynamic_date = "kshowId=$kshow_id" .
			"&host=" . requestUtils::getRequestHostId() .
			( $show_version ? "&entryVersion=$show_version" : "" ) .
			( $entry_id ? "&entryId=$entry_id" : "" ) .
			( $entry_id ? "&KmediaType=$kmedia_type" : "");
			$dynamic_date .= "&isWidget=$widget_type&referer=".urlencode($referer);
			$dynamic_date .= "&kdata=$kdata";
			$url = "$swf_url?$dynamic_date"; 
		}

		if ($allowCache)
			$cache->put($requestKey, $url);
			
		$this->redirect( $url.$externalInterfaceDisabled."&referer=".urlencode($referer));
	}
}
?>
