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
	
		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry )
		{
			// what to return ??
			die();
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
				header("Content-Disposition: attachment; filename=\"$name\"");
			}
		}
		else
		{
			$ret_file_name = $entry_id;
		}
		
		if ($entry->getType() == entry::ENTRY_TYPE_DOCUMENT)
		{
			kFile::dumpFile(myContentStorage::getFSContentRootPath() . $entry->getDataPath());
		}
		
		//$archive_file = $entry->getArchiveFile();
		$media_type =  $entry->getMediaType();
		if ( $media_type == entry::ENTRY_MEDIA_TYPE_IMAGE )
		{
			kFile::dumpFile(myContentStorage::getFSContentRootPath() . $entry->getDataPath());
		}
		elseif ( $media_type == entry::ENTRY_MEDIA_TYPE_VIDEO || $media_type == entry::ENTRY_MEDIA_TYPE_AUDIO  )
		{
			$format = $this->getRequestParameter( "format" );
			if ( $type == "download" && $format )
			{
				
//				$root = myContentStorage::getFSContentRootPath();
				$path = $entry->getDownloadPath ( null , $format );
				// getDownloadPath already includes the content root
				$archive_file = $path;
			}
			else
			{
				// /web/archive/data/...			
				$root = myContentStorage::getFSArchiveRootPath();
				$path = $entry->getDataPath();
				$file_name = $root . "/" . str_replace ( "/content/entry/" , "" , $path );
				$file_name = dirname ( $file_name ) . "/{$entry_id}.*";
				$archive_files = glob ( $file_name );
				$archive_file = @$archive_files[0];
	
				if( ! $archive_file )
				{
					die();
				}
			}			
		}
		elseif ( $media_type == entry::ENTRY_MEDIA_TYPE_SHOW )
		{
			// in this case "raw" is a bad name 
			// TODO - add the ability to fetch the actual XML by flagging "xml" or something 
			$version = $this->getRequestParameter ( "version" );
			// /web/archive/data/...			
			$root = myContentStorage::getFSContentRootPath();
			$path = $entry->getDownloadPath( $version );
			if ( $path )
			{
				$archive_file = $root . $path;
			}

			if( ! $archive_file )
			{
				die();
			}			
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
			
			$url = $_SERVER["REQUEST_URI"];

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
}
?>
