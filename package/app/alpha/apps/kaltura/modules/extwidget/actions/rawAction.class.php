<?php

class rawAction extends sfAction
{
	/**
	 * Will forward to the regular swf player according to the widget_id 
	 */
	public function execute()
	{
		requestUtils::handleConditionalGet();
		
		$entry_id = $this->getRequestParameter( "entry_id" );
		$type = $this->getRequestParameter( "type" );
		$ret_file_name = $this->getRequestParameter( "file_name" );
		
		$direct_serve = $this->getRequestParameter( "direct_serve" );
	
		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry )
		{
			// what to return ??
			die();
		}

		myPartnerUtils::blockInactivePartner($entry->getPartnerId());

		// allow access only via cdn unless these are documents (due to the current implementation of convert ppt2swf)
		if ($entry->getType() != entry::ENTRY_TYPE_DOCUMENT && $entry->getMediaType() != entry::ENTRY_MEDIA_TYPE_IMAGE)
		{
			$host = requestUtils::getHost();
			$cdnHost = myPartnerUtils::getCdnHost($entry->getPartnerId());
			
			$dc = kDataCenterMgr::getCurrentDc();
			$external_url = $dc["external_url"];
		
			if ($host != $cdnHost)// && $host != $external_url)
			{
				//header('Location:'.$cdnHost.$_SERVER["REQUEST_URI"]."/forceproxy/true/");
				header('Location:'.$cdnHost.$_SERVER["REQUEST_URI"]);
				die;
			}
		}

		// relocate = did we use the redirect and added the extension to the name
		$relocate = $this->getRequestParameter ( "relocate" );
		
		if ($entry->getType() == entry::ENTRY_TYPE_DOCUMENT)
			$ret_file_name = "name";
		
		if ($ret_file_name == "name")
			$ret_file_name = $entry->getName();
			
		if ($ret_file_name)
		{
			//rawurlencode to content-disposition filename to handle spaces and other characters across different browsers			
			//$name = rawurlencode($ret_file_name);
			// 19.04.2009 (Roman) - url encode is not needed when the filename in Content-Disposition header is in quotes
			// IE6/FF3/Chrome - Will show the filename correctly
			// IE7 - Will show the filename with underscores instead of spaces (this is better than showing %20) 
			$name = $ret_file_name;
			if ($name)
			{
				if( $relocate )
				{
					// if we have a good file extension (from the first time) - use it in the content-disposition
					// in some browsers it will be stronger than the URL's extension
					$file_ext = pathinfo ( $relocate , PATHINFO_EXTENSION );
					$name .= ".$file_ext";
				}
				if(!$direct_serve)
					header("Content-Disposition: attachment; filename=\"$name\"");
			}
		}
		else
		{
			$ret_file_name = $entry_id;
		}
		$format = $this->getRequestParameter( "format" );
		if ( $type == "download" && $format && $entry->getType() != entry::ENTRY_TYPE_DOCUMENT) // mediaType is not relevant when requesting download with format
		{
			// this is a video for a specifc extension - use the proper flavorAsset
			$flavor_asset = flavorAssetPeer::retrieveByEntryIdAndExtension ( $entry_id , $format );
			if($flavor_asset)
			{
				$file_sync = $this->redirectIfRemote ( $flavor_asset ,  flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET , null , true );
			}
			else
			{
				header('KalturaRaw: no flavor asset for extension');
				die;
			}

			$archive_file = $file_sync->getFullPath();

			$mime_type = kFile::mimeType( $archive_file );
			kFile::dumpFile($archive_file, $mime_type);
		}

		if ($entry->getType() == entry::ENTRY_TYPE_DOCUMENT)
		{
			// use the fileSync from the entry
			if($type == "download" && $format)
			{
				$file_sync = $this->redirectIfRemote ( $entry ,  entry::FILE_SYNC_ENTRY_SUB_TYPE_DOWNLOAD , $format , true );
			}
			else
			{
				$file_sync = $this->redirectIfRemote ( $entry ,  entry::FILE_SYNC_ENTRY_SUB_TYPE_DATA , null , true );
			}

			kFile::dumpFile($file_sync->getFullPath());
		}
		
		//$archive_file = $entry->getArchiveFile();
		$media_type =  $entry->getMediaType();
		if ( $media_type == entry::ENTRY_MEDIA_TYPE_IMAGE )
		{
			// image - use data for entry 
			$file_sync = $this->redirectIfRemote ( $entry ,  entry::FILE_SYNC_ENTRY_SUB_TYPE_DATA , null );
			$key = $entry->getSyncKey(entry::FILE_SYNC_ENTRY_SUB_TYPE_DATA);
			kFile::dumpFile(kFileSyncUtils::getLocalFilePathForKey($key, true));			
		}
		elseif ( $media_type == entry::ENTRY_MEDIA_TYPE_VIDEO || $media_type == entry::ENTRY_MEDIA_TYPE_AUDIO  )
		{
			$format = $this->getRequestParameter( "format" );
			if ( $type == "download" && $format )
			{
				// this is a video for a specifc extension - use the proper flavorAsset
				$flavor_asset = flavorAssetPeer::retrieveByEntryIdAndExtension ( $entry_id , $format );
				if($flavor_asset)
				{
					$file_sync = $this->redirectIfRemote ( $flavor_asset ,  flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET , null , true );
				}
				else
				{
					header('KalturaRaw: no flavor asset for extension');
					die;
				}				
				
				$archive_file = $file_sync->getFullPath();
			}
			else
			{
				// flavorAsset of the original
				$flavor_asset = flavorAssetPeer::retrieveOriginalByEntryId( $entry_id );
				if($flavor_asset)
				{
					$file_sync = $this->redirectIfRemote ( $flavor_asset ,  flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET , null , false ); // NOT strict - if there is no archive, get the data version
					if ( $file_sync )
					{
						$archive_file = $file_sync->getFullPath();
					}
				}
				
				if(!$flavor_asset || !$file_sync)
				{
					// either no archive asset or no fileSync for archive asset
					// use fallback flavorAsset
					$flavor_asset = flavorAssetPeer::retrieveBestPlayByEntryId( $entry_id );
					if(!$flavor_asset)
					{
						header('KalturaRaw: no original flavor asset for entry, no best play asset for entry');
						die;
					}
					$file_sync = $this->redirectIfRemote ( $flavor_asset ,  flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET , null , false ); // NOT strict - if there is no archive, get the data version
					$archive_file = $file_sync->getFullPath();
				}
			}			
		}
		elseif ( $media_type == entry::ENTRY_MEDIA_TYPE_SHOW )
		{
			// in this case "raw" is a bad name 
			// TODO - add the ability to fetch the actual XML by flagging "xml" or something 
			$version = $this->getRequestParameter ( "version" );
			
			// hotfix - links sent after flattening is done look like:
			// http://cdn.kaltura.com/p/387/sp/38700/raw/entry_id/0_ix99151g/version/100001
			// while waiting for flavor-adaptation in flattening, we want to find at least one file to return.
			$try_formats = array('mp4', 'mov', 'avi', 'flv');
			if($format)
			{
				$key = array_search($format, $try_formats);
				if($key !== FALSE)
					unset($try_formats[$key]);
				
				$file_sync = $this->redirectIfRemote( $entry , entry::FILE_SYNC_ENTRY_SUB_TYPE_DOWNLOAD, $format, false);
			}
			
			if(!$file_sync || !file_exists($file_sync->getFullPath()))
			{
				foreach($try_formats as $ext)
				{
					kLog::log( "raw for mix - trying to find filesync for extension: [$ext] on entry [{$entry->getId()}]");
					$file_sync = $this->redirectIfRemote( $entry , entry::FILE_SYNC_ENTRY_SUB_TYPE_DOWNLOAD, $ext, false);
					if($file_sync && file_exists($file_sync->getFullPath()))
					{
						kLog::log( "raw for mix - found flattened video of extension: [$ext] continuing with this file {$file_sync->getFullPath()}");
						break;
					}
				}
				if(!$file_sync || !file_exists($file_sync->getFullPath()))
				{
					$file_sync = $this->redirectIfRemote( $entry , entry::FILE_SYNC_ENTRY_SUB_TYPE_DOWNLOAD, $ext, true);
				}
			}
			
			// use fileSync for entry - roughcuts don't have flavors
			//$file_sync =  $this->redirectIfRemote ( $entry ,  entry::FILE_SYNC_ENTRY_SUB_TYPE_DOWNLOAD , $version , true );  // strict - nothing to do if no flattened version
			
			// if got to here - fileSync was found for one of the extensions - continue with that file			
			$archive_file = $file_sync->getFullPath();
		}		
		else
		{
			// no archive for this file
			die();
		}

//		echo "[$archive_file][" . file_exists ( $archive_file ) . "]";
		$mime_type = kFile::mimeType( $archive_file );
//		echo "[[$mime_type]]";


		if ( ! empty ( $relocate ) )
		{
			// after relocation - dump the file
			kFile::dumpFile($archive_file , $mime_type );
			die();
		}
		else
		{
			// use new Location to add the best extension we can find for the file
			$file_ext = pathinfo ( $archive_file , PATHINFO_EXTENSION );
			if ( $file_ext != "flv" )
			{
				// if the file does not end with "flv" - it is the real extension
				$ext = $file_ext;
			}
			else
			{
				// for now - if "flv" return "flv" - // TODO - find the real extension from the file itself
				$ext = "flv";
			}	
			
			// rebuild the URL and redirect to it with extraa parameters
			$url = $_SERVER["REQUEST_URI"];
			$format = $this->getRequestParameter( "format" );
			if ( ! $format )
			{
				$url = str_replace( "format" , "" , $url );
			}
			
			if ( $ret_file_name &&  pathinfo ( $ret_file_name , PATHINFO_EXTENSION ) != "" )
			{
				// if the name holds an extension - prefer it over the real file's extension
				$ext = pathinfo ( $ret_file_name , PATHINFO_EXTENSION );
			}
			
			if ( !$ret_file_name)
			{
				// don't leave the name empty - if it is empty - use the entry id
				$ret_file_name = $entry_id;
			}
			
			if ( strpos ($url , "?" ) > 0 ) // replace BEFORE the query string
			{
				$url = str_replace( "?" , "/$ret_file_name.{$ext}?" ,  $url );
				$url .= "&relocate=f.{$ext}"; // add the ufname as a query parameter
			}
			else
			{
				$url .= "/$ret_file_name.{$ext}?relocate=f.{$ext}";   // add the ufname as a query parameter
			}
					
			
			// redirect and create the url so it will have the ufname
			header ( "Location: {$url}" );
		}
		die();
	}
	
	/**
	 * 
	 * @param $entry
	 * @param $sub_type
	 * @param $version
	 * @return FileSync
	 */
	private function redirectIfRemote ( $obj , $sub_type , $version , $strict = true )
	{
		$dataKey = $obj->getSyncKey( $sub_type , $version );
		list ( $file_sync , $local ) = kFileSyncUtils::getReadyFileSyncForKey( $dataKey ,true , false );
		
		if ( ! $file_sync ) 
		{
			if ( $strict )
			{
				// file does not exist on any DC - die 

				kLog::log( "Error - no FileSync for object [{$obj->getId()}]");
				die;
			}
			else
				return null;
		}
		
		if ( !$local )
		{
			$shouldProxy = $this->getRequestParameter("forceproxy", false);
			$remote_url = kDataCenterMgr::getRedirectExternalUrl ( $file_sync , $_SERVER['REQUEST_URI'] );
			kLog::log ( __METHOD__ . ": redirecting to [$remote_url]" );
			if($shouldProxy)
			{
				kFile::dumpUrl($remote_url);
			}
			else
			{
				// or redirect if no proxy
				$this->redirect($remote_url);
			}
		}		
		
		return $file_sync;
	}
}
?>
