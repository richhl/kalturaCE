<?php

class thumbnailAction extends sfAction
{
	private static function notifyProxy($msg)
	{
        $server = kConf::get ( "image_proxy_url" ); 
        
        if ($server && (@$_SERVER["REMOTE_ADDR"] != $server ))
        {
			$sock = socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
	        if ($sock)
	        {
	                $secret = kConf::get ( "image_proxy_secret" );
	                $port = kConf::get ( "image_proxy_port" );
	                $data = md5($secret.$msg).$msg;
	                socket_sendto($sock, $data, strlen($data),0 , $server, $port);
	                socket_close($sock);
	        }
        }
	}	
	
	/**
	 * Will forward to the regular swf player according to the widget_id 
	 */
	public function execute()
	{
		requestUtils::handleConditionalGet();
		
		ignore_user_abort();
		
		$entry_id = $this->getRequestParameter( "entry_id" );
		$widget_id = $this->getRequestParameter( "widget_id", 0 );
		$version = $this->getRequestParameter( "version", null );
		$width = $this->getRequestParameter( "width", -1 );
		$height = $this->getRequestParameter( "height", -1 );
		$type = $this->getRequestParameter( "type" , 1);
		$crop_provider = $this->getRequestParameter( "crop_provider", null);
		$quality = $this->getRequestParameter( "quality" , 0);
		$src_x = $this->getRequestParameter( "src_x" , 0);
		$src_y = $this->getRequestParameter( "src_y" , 0);
		$src_w = $this->getRequestParameter( "src_w" , 0);
		$src_h = $this->getRequestParameter( "src_h" , 0);
		$vid_sec = $this->getRequestParameter( "vid_sec" , -1);
		$vid_slice = $this->getRequestParameter( "vid_slice" , -1);
		$vid_slices = $this->getRequestParameter( "vid_slices" , -1);
		
		if ($width == -1 && $height == -1) // for sake of backward compatibility if no dimensions where specified create 120x90 thumbnail
		{
			$width = 120;
			$height = 90;
		}
		else if ($width == -1) // if only either width or height is missing reset them to zero, and convertImage will handle them
			$width = 0;
		else if ($height == -1)
			$height = 0;
			
		$bgcolor = $this->getRequestParameter( "bgcolor", "ffffff" );
		
		$entry = entryPeer::retrieveByPKNoFilter( $entry_id );
		if ( ! $entry )
		{
			// get the widget
			$widget = widgetPeer::retrieveByPK( $widget_id );
			if ( !$widget )
				die();	
			
			// get the kshow
			$kshow_id= $widget->getKshowId();
			$kshow = kshowPeer::retrieveByPK($kshow_id);
			if ( $kshow )
			{
				$entry_id = $kshow->getShowEntryId();
			}
			else
			{
				$entry_id = $widget->getEntryId();
			}
			
			$entry = entryPeer::retrieveByPKNoFilter( $entry_id );
			if ( ! $entry )
				die;
		}
		
		$entry_status = $entry->getStatus();
		// both 640x480 and 0x0 requests are probably coming from the kdp
		// 640x480 - old kdp version requesting thumbnail
		// 0x0 - new kdp version requesting the thumbnail of an unready entry
		// we need to distinguish between calls from the kdp and calls from a browser: <img src=...> 
		// that can't handle swf input
		if (($width == 640 && $height == 480 || $width == 0 && $height == 0) &&
			($entry_status == entry::ENTRY_STATUS_PRECONVERT || $entry_status == entry::ENTRY_STATUS_IMPORT ||
			$entry_status == entry::ENTRY_STATUS_ERROR_CONVERTING || $entry_status == entry::ENTRY_STATUS_DELETED))
		{
			$contentPath = myContentStorage::getFSContentRootPath();
			$msgPath = $contentPath."content/templates/entry/bigthumbnail/";
			if ($entry_status == entry::ENTRY_STATUS_DELETED)
			{
				$msgPath .= $entry->getModerationStatus() == moderation::MODERATION_STATUS_BLOCK ?
							"entry_blocked.swf" : "entry_deleted.swf";
			}
			else
			{
				$msgPath .= $entry_status == entry::ENTRY_STATUS_ERROR_CONVERTING ?
							"entry_error.swf" : "entry_converting.swf";
			}
						
			kFile::dumpFile($msgPath, null, 0);
		}
		
		// if we didnt return a template for the player die and dont return the original deleted thumb
		if ($entry_status == entry::ENTRY_STATUS_DELETED)
			die;
		
		$tempThumbPath = myEntryUtils::resizeEntryImage( $entry_id , $version , $width , $height , $type , $bgcolor , $crop_provider, $quality,
		$src_x, $src_y, $src_w, $src_h, $vid_sec, $vid_slice, $vid_slices  );
		
		$nocache = strpos($tempThumbPath, "_NOCACHE_") !== false;

		// notify external proxy, so it'll cache this url
		if (!$nocache && requestUtils::getHost() == kConf::get ( "apphome_url" )  && file_exists($tempThumbPath))
		{
			self::notifyProxy($_SERVER["REQUEST_URI"]);
		}
		

		kFile::dumpFile($tempThumbPath, null, $nocache ? 0 : null);
		
		// TODO - can delete from disk assuming we caneasily recreate it and it will anyway be cached in the CDN
		// however dumpfile dies at the end so we cant just write it here (maybe register a shutdown callback)
	}
}
?>
