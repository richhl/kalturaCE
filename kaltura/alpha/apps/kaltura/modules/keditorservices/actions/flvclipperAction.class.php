<?php
require_once ( "myContentStorage.class.php");
require_once ( "myResponseUtils.class.php");
require_once ( "myFlvStreamer.class.php");


class flvclipperAction extends kalturaAction
{
	
	static private function hmac($hashfunc, $key, $data)
    {
        $blocksize=64;

        if (strlen($key) > $blocksize)
        {
            $key = pack('H*', $hashfunc($key));
        }

        $key = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $data))));

        return bin2hex($hmac);
    }

	public function execute()
	{
		requestUtils::handleConditionalGet();

		$entry_id = $this->getRequestParameter ( "entry_id" );
		
		// workaround the filter which hides all the deleted entries - 
		// now that deleted entries are part of xmls (they simply point to the 'deleted' templates), we should allow them here
		$entry = entryPeer::retrieveByPKNoFilter( $entry_id );
		if ( ! $entry )
		{
			return;
		}
		
		// set the memory size to be able to serve big files in a single chunk
		ini_set( "memory_limit","64M" );
		// set the execution time to be able to serve big files in a single chunk
		ini_set ( "max_execution_time" , 240 );
		
		if ( $entry->getType() == entry::ENTRY_TYPE_SHOW && $entry->getStatus() == entry::ENTRY_STATUS_DELETED )
		{
			// because the fiter was turned off - a manual check for deleted entries must be done.
			die;
		}
		else if ($entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_IMAGE )
		{
			$version = $this->getRequestParameter( "version", null );
			$width = $this->getRequestParameter( "width", -1 );
			$height = $this->getRequestParameter( "height", -1 );
			$crop_provider = $this->getRequestParameter( "crop_provider", null);
			$bgcolor = $this->getRequestParameter( "bgcolor", "ffffff" );
			$type = $this->getRequestParameter( "type" , 1);
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
				$width = 640;
				$height = 480;
			}
			else if ($width == -1) // if only either width or height is missing reset them to zero, and convertImage will handle them
				$width = 0;
			else if ($height == -1)
				$height = 0;
			
			
			$tempThumbPath = myEntryUtils::resizeEntryImage( $entry_id , $version , $width , $height , $type , $bgcolor , $crop_provider, $quality,
			$src_x, $src_y, $src_w, $src_h, $vid_sec, $vid_slice, $vid_slices );
			
			kFile::dumpFile($tempThumbPath, null, strpos($tempThumbPath, "_NOCACHE_") === false ? null : 0);
		}
		
		$audio_only = $this->getRequestParameter ( "audio_only" ); // milliseconds
		$flavor = $this->getRequestParameter ( "flavor", 1 ); // 
		$streamer = $this->getRequestParameter ( "streamer" ); // 
		if (substr($streamer, 0, 4) == "rtmp") // the fms may add .mp4 to the end of the url
			$streamer = "rtmp";
			
		$request = $_SERVER["REQUEST_URI"];
		
		// grab seek_from_bytes parameter and normalize url
		$seek_from_bytes = $this->getRequestParameter ( "seek_from_bytes" , -1);
		$request = str_replace("/seek_from_bytes/$seek_from_bytes", "", $request);
		if ($seek_from_bytes <= 0)
			$seek_from_bytes = -1;
		
		// grab seek_from parameter and normalize url
		$seek_from = $this->getRequestParameter ( "seek_from" , -1);
		$request = str_replace("/seek_from/$seek_from", "", $request);
		
		if ($seek_from <= 0)
			$seek_from = -1;
		
		$this->dump_from_byte = 0;
		
		// reset accurate seek from timestamp 
		$seek_from_timestamp = -1;
		
		if ($flavor)
			$path = myContentStorage::getFSContentRootPath().$entry->getDataPath();
		else
			$path = myFlvStaticHandler::getBestFileFlavor( myContentStorage::getFSContentRootPath().$entry->getDataPath() );

		if (!file_exists($path))
			die;

		$flv_wrapper = new myFlvHandler ( $path );
		$isFlv = $flv_wrapper->isFlv();
		
		// scrubbing is not allowed within mp4 files
		if (!$isFlv)
			$seek_from = $seek_from_bytes = -1;
		
		if ($seek_from !== -1 && $seek_from !== 0)
		{
			if ( $audio_only === '0' )
			{
				// audio_only was explicitly set to 0 - don't attempt to make further automatic investigations
			}
			elseif ( $flv_wrapper->getFirstVideoTimestamp() < 0 )
			{
				$audio_only = true; 
			}
			
			list ( $bytes , $duration ,$first_tag_byte , $to_byte ) = $flv_wrapper->clip(0, -1, $audio_only );
			list ( $bytes , $duration ,$from_byte , $to_byte, $seek_from_timestamp ) = $flv_wrapper->clip($seek_from, -1, $audio_only );
			$seek_from_bytes = myFlvHandler::FLV_HEADER_SIZE + $flv_wrapper->getMetadataSize( $audio_only  ) + $from_byte - $first_tag_byte;
		}
		
		// use headers to detect cdn
		$cdn_name = "";
		$via_header = @$_SERVER["HTTP_VIA"];
		if (strpos($via_header, "llnw.net") !== false)
			$cdn_name = "limelight";
		else if (strpos($via_header, "akamai") !== false)
			$cdn_name = "akamai";
		else if (strpos($via_header, "Level3") !== false)
			$cdn_name = "level3";

		$ext = $isFlv ? "flv" : "mp4";
		$flv_extension = ($streamer == "rtmp") ? "?" : "/a.$ext?novar=0";
			
		// use limelight mediavault if either security policy requires it or if we're trying to seek within the video
		if ($entry->getSecurityPolicy() || $seek_from_bytes !== -1)
		{
			// we have three options:
			// arrived through limelight mediavault url - the url is secured
			// arrived directly through limelight (not secured through mediavault) - enforce ks and redirect to mediavault url
			// didnt use limelight - enforce ks
			
			// the cdns are configured to authenticate request for /s/....
			// check if we're already in a redirected secure link using the "/s/" prefix
			$secure_request = (substr($request, 0, 3) == "/s/");
			
			if ($secure_request && ($cdn_name == "limelight" || $cdn_name == "level3")) // cdn secure request
			{
				// request was validated by cdn let it through
			}
			else
			{
				// extract ks
				$ks_str = $this->getRequestParameter ( "ks", "" );
					
				if ($entry->getSecurityPolicy())
				{
					if (!$ks_str)
					{
						$this->logMessage( "flvclipper - no KS" );
						die;
					}
					
					$ks = kSessionUtils::crackKs($ks_str);
					if (!$ks)
					{
						$this->logMessage( "flvclipper - invalid ks [$ks_str]" );		
						die;
					}
				
					$matched_privs = $ks->verifyPrivileges ( "sview" , $entry_id );
					$this->logMessage( "flvclipper - verifyPrivileges name [sview], priv [$entry_id] [$matched_privs]" );		
	
					if ( ! $matched_privs )
					{
						$this->logMessage( "flvclipper - doesnt not match required privlieges [$ks_str]" );		
						die;
					}
				}
				
				// remove VALIDATED ks from url so we request different urls from the cdn
				$request = str_replace("/ks/$ks_str", "", $request);
				
				if ($cdn_name == "limelight") // limelight request - secure it
				{
					$ll_url = requestUtils::getCdnHost()."/s$request".$flv_extension;
					$secret = kConf::get("limelight_madiavault_password");
					
					$expire = "&e=".(time() + 30);
					$ll_url .= $expire;
					
					$fs = $seek_from_bytes == -1 ? "" : "&fs=$seek_from_bytes";
					$ll_url .= "&h=".md5("$secret$ll_url").$fs;
		        	//header("Location: $ll_url");
		        	$this->redirect($ll_url);
		        }
		        else if ($cdn_name == "level3")
		        {
		        	$level3_url = $request . $flv_extension;
					if ($entry->getSecurityPolicy())
					{
						$level3_url = "/s$level3_url";
						
						// set expire time in GMT hence the date("Z") offset
						$expire = "&nva=".strftime("%Y%m%d%H%M%S", time() - date("Z") + 30);
						$level3_url .= $expire; 
						
						$secret = kConf::get("level3_authentication_key");
						$hash = "0".substr(self::hmac('sha1', $secret, $level3_url),0, 20);
						$level3_url .= "&h=$hash"; 
					}
					
					$level3_url .= $seek_from_bytes == -1 ? "" : "&start=$seek_from_bytes";
		        	
					header("Location: $level3_url");
		        	die;
		        }
		        else if ($cdn_name == "akamai")
		        {
		        	$akamai_url = $request . $flv_extension;
		        	
		        	// if for some reason we didnt set our accurate $seek_from_timestamp reset it to the requested seek_from
		        	if ($seek_from_timestamp == -1)
			        	$seek_from_timestamp = $seek_from;
		        	
					$akamai_url .= $seek_from_bytes == -1 ? "" : "&aktimeoffset=".($seek_from_timestamp / 1000);
		        	
		        	header("Location: $akamai_url");
		        	die;
		        }
		        
		        // a seek request with a supporting cdn - we need to send the answer from our server
		        if ($seek_from_bytes !== -1 && $via_header === null)
		        {
		        	$this->dump_from_byte = $seek_from_bytes;
		        }
			}
		}

		// always add the file suffix to the request (needed for scrubbing by some cdns,
		// and also breaks without extension on some corporate antivirus).
		// we add the the novar paramter since a leaving a trailing "?" will be trimmed
		// and then the /seek_from request will result in another url which level3
		// will try to refetch from the origin
		// note that for streamer we dont add the file extension
		if ($streamer != "rtmp" && strpos($request, $flv_extension) === false)
		{
		    // a seek request with a supporting cdn - we need to send the answer from our server
			if ($seek_from_bytes !== -1 && $via_header === null)
				$request .= "/seek_from_bytes/$seek_from_bytes";
				
			requestUtils::sendCdnHeaders("flv", 0);
			header("Location: $request".$flv_extension);
			die;
		}

		// mp4
		if (!$isFlv)
			kFile::dumpFile($path);
		
		$clip_from = $this->getRequestParameter ( "clip_from" , 0); // milliseconds 
		$clip_to = $this->getRequestParameter ( "clip_to" , 2147483647 ); // milliseconds
		if ( $clip_to == 0 ) $clip_to = 2147483647;
		
		$this->logMessage( "flvclipperAction: serving file [$path] entry_id [$entry_id] clip_from [$clip_from] clip_to [$clip_to]" , "warning" );
		
		if ( $audio_only === '0' )
		{
			// audio_only was explicitly set to 0 - don't attempt to make further automatic investigations
		}
		elseif ( $flv_wrapper->getFirstVideoTimestamp() < 0 )
		{
			$audio_only = true; 
		}
		
		//$start = microtime(true);
		list ( $bytes , $duration ,$from_byte , $to_byte ) = myFlvStaticHandler::clip($path , $clip_from , $clip_to, $audio_only );
		$metadata_size = $flv_wrapper->getMetadataSize( $audio_only );
		
		$this->from_byte = $from_byte;
		$this->to_byte = $to_byte;
		 
		//$end1 = microtime(true);
		
		//$this->logMessage( "flvclipperAction: serving file [$path] entry_id [$entry_id] bytes [$bytes] duration [$duration] [$from_byte]->[$to_byte]" , "warning" );
		//$this->logMessage( "flvclipperAction: serving file [$path] t1 [" . ( $end1-$start) . "]");
		
		$data_offset = $metadata_size + myFlvHandler::getHeaderSize();
		
		// if we're returning a partial file adjust the total size:
		// substract the metadata and bytes which are not delivered
		if ($this->dump_from_byte >= $data_offset && !$audio_only)
			$bytes -= $metadata_size + max(0, $this->dump_from_byte - $data_offset);
		
		$this->total_length = $data_offset + $bytes;
		
		//$this->logMessage( "flvclipperAction: serving file [$path] entry_id [$entry_id] bytes with header & md [" . $this->total_length . "] bytes [$bytes] duration [$duration] [$from_byte]->[$to_byte]" , "warning" );
		
		$this->flv_wrapper = $flv_wrapper;
		$this->audio_only = $audio_only;
		
		return sfView::SUCCESS;
	}
}
?>