<?php
require_once ( "myContentStorage.class.php");
require_once ( "myResponseUtils.class.php");
require_once ( "myFlvStreamer.class.php");
//require_once ( "infra/AMFSerialize.php");

class flvclipperAction extends kalturaAction
{

	public function execute()
	{
		requestUtils::handleConditionalGet();

		$entry_id = $this->getRequestParameter ( "entry_id" );
		
		// workaround the filter which hides all the deleted entries - 
		// now that deleted entries are part of xmls (they simply point to the 'deleted' templates), we should allow them here
		//$entry = entryPeer::retrieveByPKNoFilter ( $entry_id );
		$entry = entryPeer::retrieveByPKNoFilter( $entry_id );
		if ( ! $entry )
		{
			return;
		}
		
		// set the memory size to be able to serve big files in a single chunk
		ini_set( "memory_limit","64M" );
		// set the execution time to be able to serve big files in a single chunk
		ini_set ( "max_execution_time" , 240 );
		
		$audio_only = $this->getRequestParameter ( "audio_only" ); // milliseconds
		$flavor = $this->getRequestParameter ( "flavor", 1 ); // 
		
		$seek_from_bytes = $this->getRequestParameter ( "seek_from_bytes" , -1);
		$seek_from = $this->getRequestParameter ( "seek_from" , -1);
		
		if ($seek_from !== -1 && $seek_from !== 0)
		{
			if ($flavor)
				$path = myContentStorage::getFSContentRootPath().$entry->getDataPath();
			else
				$path = myFlvStaticHandler::getBestFileFlavor( myContentStorage::getFSContentRootPath().$entry->getDataPath() );

			if (!file_exists($path))
				die;

			$flv_wrapper = new myFlvHandler ( $path );

			if ( $audio_only === '0' )
			{
				// audio_only was explicitly set to 0 - don't attempt to make further automatic investigations
			}
			elseif ( $flv_wrapper->getFirstVideoTimestamp() < 0 )
			{
				$audio_only = true; 
			}
			
			list ( $bytes , $duration ,$first_tag_byte , $to_byte ) = myFlvStaticHandler::clip($path , 0, -1, $audio_only );
			list ( $bytes , $duration ,$from_byte , $to_byte ) = myFlvStaticHandler::clip($path , $seek_from, -1, $audio_only );
			$seek_from_bytes = myFlvHandler::FLV_HEADER_SIZE + $flv_wrapper->getMetadataSize( $audio_only  ) + $from_byte - $first_tag_byte;
		}

		// use limelight mediavault if either security policy requires it or if we're trying to seek within the video
		if ($entry->getSecurityPolicy() || $seek_from_bytes !== -1)
		{
			// we have three options:
			// arrived through limelight mediavault url - the url is secured
			// arrived directly through limelight (not secured through mediavault) - enforce ks and redirect to mediavault url
			// didnt use limelight - enforce ks
			
			// use via header to detect cdn
			$via_header = @$_SERVER["HTTP_VIA"];
			
			// check if we're already in a redirected secure link using the "/s/" prefix
			$request = $_SERVER["REQUEST_URI"];
			$secure_limelight = (substr($request, 0, 3) == "/s/");
			$using_limelight = strpos($via_header, "llnw.net") !== false;
			
			if ($using_limelight && $secure_limelight) // limelight secure request (through media vault)
			{
				// request was validated by limelight let it through
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
					
				if ($using_limelight) // limelight request - secure it
				{
					$expire = "";
					
					$request = str_replace("/ks/$ks_str", "", $request);
					$expire = "?e=".(time() + 30);
					
					$request = str_replace("/seek_from/$seek_from", "", $request);
					$request = str_replace("/seek_from_bytes/$seek_from_bytes", "", $request);
					
					$ll_url = requestUtils::getCdnHost()."/s$request".$expire;
					$secret = kConf::get("limelight_madiavault_password");
					
					$fs = $seek_from_bytes == -1 ? "" : "&fs=$seek_from_bytes";
					$ll_url .= ($expire ? "&" : "?")."h=".md5("$secret$ll_url").$fs;
					$this->redirect( $ll_url );
		        }
			}
		}

		$clip_from = $this->getRequestParameter ( "clip_from" , 0); // milliseconds 
		$clip_to = $this->getRequestParameter ( "clip_to" , 2147483647 ); // milliseconds
		if ( $clip_to == 0 ) $clip_to = 2147483647;
		
		$this->total_length = 0;
		

		$this->flv_wrapper = null;
		
		if ( $entry->getType() == entry::ENTRY_TYPE_SHOW && $entry->getStatus() == entry::ENTRY_STATUS_DELETED )
		{
			// because the fiter was turned off - a manual check for deleted entries must be done.
			return;
		}
		
		// TODO - dump only images 
		if ($entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_IMAGE )
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

		if ($flavor)
			$path = myContentStorage::getFSContentRootPath().$entry->getDataPath();
		else
			$path = myFlvStaticHandler::getBestFileFlavor( myContentStorage::getFSContentRootPath().$entry->getDataPath() );

		$this->logMessage( "flvclipperAction: serving file [$path] entry_id [$entry_id] clip_from [$clip_from] clip_to [$clip_to]" , "warning" );
		
		// hd test
		if (file_exists($path) && filesize($path) > 0)
		{
			$fh = fopen($path, "rb");
			if ($fh)
			{
				$c = fread($fh, 1);
				$bytes = unpack("C", $c[0]);
				$hd_file = $bytes[1] === 0;
				fclose($fh);
				
				if ($hd_file)
					kFile::dumpFile($path);
			}
		}
		
		$flv_wrapper = new myFlvHandler ( $path );
		
		if ( $flv_wrapper == null || !file_exists($path))
		{
			$this->flv_wrapper = null;
			$this->total_length	= 0;
			
			$this->logMessage( "flvclipperAction: cannot create myFlvHandler for file [$path] entry_id [$entry_id] clip_from [$clip_from] clip_to [$clip_to]" , "warning" );
			die;
		}
		
		if ( $audio_only === '0' )
		{
			// audio_only was explicitly set to 0 - don't attempt to make further automatic investigations
		}
		elseif ( $flv_wrapper->getFirstVideoTimestamp() < 0 )
		{
			$audio_only = true; 
		}
		
		$start = microtime(true);
		list ( $bytes , $duration ,$from_byte , $to_byte ) = myFlvStaticHandler::clip($path , $clip_from , $clip_to, $audio_only );
		$metadata_size = $flv_wrapper->getMetadataSize( $audio_only );
		
		$this->from_byte = $from_byte;
		$this->to_byte = $to_byte;
		 
		$end1 = microtime(true);
		
		$this->logMessage( "flvclipperAction: serving file [$path] entry_id [$entry_id] bytes [$bytes] duration [$duration] [$from_byte]->[$to_byte]" , "warning" );
		$this->logMessage( "flvclipperAction: serving file [$path] t1 [" . ( $end1-$start) . "]");
		
		$this->total_length = $bytes + $metadata_size + myFlvHandler::getHeaderSize();
		
		$this->logMessage( "flvclipperAction: serving file [$path] entry_id [$entry_id] bytes with header & md [" . $this->total_length . "] bytes [$bytes] duration [$duration] [$from_byte]->[$to_byte]" , "warning" );
		
		$this->flv_wrapper = $flv_wrapper;
		$this->audio_only = $audio_only;
		
		return sfView::SUCCESS;
	}
}
?>