<?php

class myEntryUtils
{
	static public function createEntryData($entry, $introId = 0 , $kshowId = null )
	{
		$entry_id = $entry->getId();
		$isIntro = $introId  == $entry_id;

		$share_text = $isIntro ? "Producer's Invite" :
		($entry->getType() == entry::ENTRY_TYPE_SHOW ? "Roughcut" : "Media Clip");
		list($status, $kmediaType, $kmediaData) = myContentRender::createPlayerMedia($entry);
		$name = $isIntro ? "Producer's Invite" : $entry->getName();
		$screenName = $entry->getkuser()->getScreenName();
		$views = $entry->getViews();
		$duration = floor($entry->getLengthInMsecs() / 1000);

		$entryData = array(
		"entryId" => $entry_id,
		"kshowId" => $entry->getKshowId(),
		"ready" => $entry->getStatus() == entry::ENTRY_STATUS_READY,
		"kuserId" => $entry->getKuserId(),
		"name" => $name,
		"image" => $entry->getThumbnailPath(),
		"mediaType" => $entry->getMediaType(),
		"kmediaType" => $kmediaType,
		"kmediaData" => $kmediaData,
		"screenName" => $entry->getkuser()->getScreenName(),
		"picture" => $entry->getkuser()->getPicturePath(),
		"updatedAt" => $entry->getFormattedUpdatedAt(),
		"rank" => $entry->getRank(),
		"views" => $views,
		"type" => ($isIntro ? "intro" : "entry"),
		"duration" => $duration ? sprintf("%d:%02d", $duration / 60, $duration % 60) :  "",
		"lengthInMsecs" => $entry->getLengthInMsecs() ,
		"credit" =>  ( $entry->getCredit() && $entry->getCredit() != 'null' ? $entry->getCredit() : '' ),
		"title" => htmlentities($name) . '<br/>By ' . $screenName . '<br/> views: ' . $views,
		"shareText" => $share_text
		);

		/*
		if ( $kshowId )
		{
			$entryData ["embedUrl" ] = myKshowUtils::getEmbedPlayerUrl( $kshowId , $entry_id , true );
		}
		else
		{
			$entryData ["embedUrl" ] = "";
		}
		*/

		return $entryData;
	}

	static public function getEntries2($kshowId, $order, $limit, $introId, $entryId = null)
	{
		$c = entryPeer::getOrderedCriteria($kshowId, $order, $limit, $introId, $entryId);

		$rs = entryPeer::doSelectJoinkuser($c);

		$entriesData = array();

		foreach ($rs as $entry)
		{
			$entriesData[] = self::createEntryData($entry, $introId, $kshowId);
		}

		return $entriesData;
	}

	/**
	 * Executes getEntries action, retrieving the required data for a kshow
	 * given the sort order, and page number. the data is will be used by the view to
	 * return an ajax response.
	 * The request may include 5 fields: sort order, page number, page size, kshow id, entry id.
	 */
	static public function getEntries($kshowId, $entryId, $order, $page, $pageSize)
	{
		$introId = 0;

		$firstEntries = array();

		$c = new Criteria();
		$c->add(kshowPeer::ID, $kshowId);
		$kshow = kshowPeer::doSelectOne($c);

		// if there is an intro entry place it first
		$introId = $kshow->getIntroId();
		if ($introId)
		$firstEntries[] = $introId;
		else
		$introId = 0;

		$entriesData = array(); // this array will hold the entries data

		if ($entryId)
		{
			// if the request was given a certain entry place it second
			// in case it's not the intro which have precedence anyway
			if ($introId != $entryId)
			$firstEntries[] = $entryId;
		}
		else
		{
			// if no entry was given in the request, the default will be the intro
			$entryId = $introId;
		}

		$pager = entryPeer::getOrderedPager($kshowId, $order, $pageSize, $page, $firstEntries);

		if ($page <= $pager->getLastPage())
		{
			foreach ($pager->getResults() as $entry)
			{
				$entriesData[] = self::createEntryData($entry, $introId, $kshowId);
			}
		}

		$output = array("objects" => $entriesData);

		return $output;
	}

	public static function deepClone ( entry $source , $kshow_id , $override_fields, $echo = false)
	{
		if ($echo)
			echo "Copying entry: " . $source->getId() . "\n";

		// create a copy in the DB
		$target = $source->copy() ;
		// save first time to retrieve id

		if ( $override_fields != NULL )
		{
			// use the $override_fields object
			baseObjectUtils::fillObjectFromObject ( entryPeer::getFieldNames(BasePeer::TYPE_FIELDNAME) ,
				$override_fields , $target , baseObjectUtils::CLONE_POLICY_PREFER_NEW , array  ("id") );
		}

		$target->setKshowId ( $kshow_id );
		// set all statistics to 0
		$target->setComments ( 0 );
		$target->setTotalRank ( 0 );
		$target->setRank ( 0 );
		$target->setViews ( 0 );
		$target->setVotes ( 0 );
		$target->setFavorites ( 0 );
		$target->save();

		if ($echo)
			echo "Copied " . $source->getId() . " (from kshow [" . $source->getKshowId() . "]) -> " . $target->getId() . "\n";

		$source_thumbnail_path = $source->getThumbnailPath();
		$source_data_path = $source->getDataPath();

		$target_thumbnail_path = $target->getThumbnailPath();
		$target_data_path = $target->getDataPath();

		$content = myContentStorage::getFSContentRootPath();
		if ( $source_thumbnail_path == $target_thumbnail_path )
		{
			if ($echo)
				echo ( "source thumbnail same as target. skipping file: " . $content . $source_thumbnail_path . "\n");
		}
		else
		{
			if ($echo)
				echo ( "Copying file: " . $content . $source_thumbnail_path . " -> " .  $content . $target_thumbnail_path ."\n");
			myContentStorage::moveFile( $content . $source_thumbnail_path , $content . $target_thumbnail_path , false , true );
		}

		if ( $source_data_path == $target_data_path )
		{
			if ($echo)
				echo ( "source same as target. skipping file: " . $content . $source_data_path . "\n");
		}
		else
		{
			if ($echo)
				echo ( "Copying file: " . $content . $source_data_path . " -> " .  $content . $target_data_path . "\n");
			myContentStorage::moveFile( $content . $source_data_path , $content . $target_data_path , false , true );
		}
		// save second time to
		//$target->save();

		return $target;

	}

	// same as the deepCopy only modifies the content of the XML according to the $entry_map
	// all relevant entries can be fetched from the entry_cache rather than hit the DB
	// does not return any value - work on the $target_show_entry  which is assumed to already exist
	public static function deepCloneShowEntry ( entry $source_show_entry , entry $target_show_entry , array $entry_map , array $entry_cache )
	{
		$target_show_entry->setComments ( 0 );
		$target_show_entry->setTotalRank ( 0 );
		$target_show_entry->setRank ( 0 );
		$target_show_entry->setViews ( 0 );
		$target_show_entry->setVotes ( 0 );
		$target_show_entry->setFavorites ( 0 );
		$target_show_entry->save();

		$source_thumbnail_path = $source_show_entry->getThumbnailPath();
		$source_data_path = $source_show_entry->getDataPath();

		$target_thumbnail_path = $target_show_entry->getThumbnailPath();
		$target_data_path = $target_show_entry->getDataPath();

		$content = myContentStorage::getFSContentRootPath();
		if ( $source_thumbnail_path == $target_thumbnail_path )
		{
			if ($echo)
				echo ( "source thumbnail same as target. skipping file: " . $content . $source_thumbnail_path . "\n");
		}
		else
		{
			if ($echo)
				echo ( "Copying file: " . $content . $source_thumbnail_path . " -> " .  $content . $target_thumbnail_path ."\n");
			myContentStorage::moveFile( $content . $source_thumbnail_path , $content . $target_thumbnail_path , false , true );
		}

		if ( $source_data_path == $target_data_path )
		{
			if ($echo)
				echo ( "source same as target. skipping file: " . $content . $source_data_path . "\n");
		}
		else
		{
			// fix metadata

			$source_show_entry_content = file_get_contents( $content . $source_data_path  );
			// fix the ShowVersion
			$source_show_version = $source_show_entry->getData();
			$target_show_version = $target_show_entry->getData();
			// <ShowVersion>100016</ShowVersion>
			$source_show_entry_content = str_replace( "<ShowVersion>$source_show_version</ShowVersion>" , "<ShowVersion>$target_show_version</ShowVersion>" , $source_show_entry_content );

			// now replace entries
			foreach ( $entry_map as $source_entry_id => $target_entry_id )
			{
				$source_entry = $entry_cache [$source_entry_id];
				$target_entry = $entry_cache [$target_entry_id];
				$source_file_name = $source_entry->getDataPath();
				$target_file_name = $target_entry->getDataPath();

				// k_id="11758"
				$source_show_entry_content = str_replace( "k_id=\"$source_entry_id\"" , "k_id=\"$target_entry_id\"" , $source_show_entry_content );
				// file_name="/content/entry/data/0/11/11787_100000.jpg"
				//$source_show_entry_content = str_replace( "file_name=\"$source_file_name\"" , "file_name=\"$target_file_name\"" , $source_show_entry_content );
				// a more general search - will fix file_name= & url=
				$source_show_entry_content = str_replace( "$source_file_name\"" , "$target_file_name\"" , $source_show_entry_content );
			}

			kFile::setFileContent( $content . $target_data_path  , $source_show_entry_content );
		}

	}

	// both paths can hold URLs from which the path should be extracted
	public static function copyData ( $source_entry_id , entry $target )
	{
		// the source_entry can be from any partner - not only of the current context
		entryPeer::getCriteriaFilter()->disable();  // TODO - should not be switched of - it sohuld work ok with the new ks/kn mechanism and only public entries should be copied

		$source_entry = entryPeer::retrieveByPK( $source_entry_id );
		if ( ! $source_entry ) return false;

		baseObjectUtils::fillObjectFromObject ( entryPeer::getFieldNames(BasePeer::TYPE_FIELDNAME) ,
				$source_entry , $target , baseObjectUtils::CLONE_POLICY_PREFER_EXISTING ,
					array  ("id" , "comments" , "total_rank" , "views" , "votes" , "favorites" ) );

		$wrapper = objectWrapperBase::getWrapperClass( $target , objectWrapperBase::DETAIL_LEVEL_REGULAR );
		
		$target->setDimensions ( $source_entry->getWidth() , $source_entry->getHeight() );

		$target->getCustomDataObj ( );	
		

//		$target->setLengthInMsecs( $source_entry->getLengthInMsecs() );
//		$target->setMediaType( $source_entry->getMediaType() );
//		$target->setTags ( $source_entry->getTags () );

		$source_thumbnail_path = $source_entry->getThumbnailPath();
		$source_data_path = $source_entry->getDataPath();
		$source_data_path_edit = $source_entry->getDataPathEdit();


//		$target->setThumbnail ( $source_thumbnail_path );
//		$target->setData ( $source_data_path );

		$target_thumbnail_path = $target->getThumbnailPath();
		$target_data_path = $target->getDataPath();
		$target_data_path_edit = $target->getDataPathEdit();

		$content = myContentStorage::getFSContentRootPath();

//		echo "[$content] [$source_thumbnail_path]->[$target_thumbnail_path] [$source_data_path]->[$target_data_path]";

		myContentStorage::moveFile( $content . $source_thumbnail_path , $content . $target_thumbnail_path , false , true );
		myContentStorage::moveFile( $content . $source_data_path , $content . $target_data_path , false , true );
		if ( $source_data_path_edit )
			myContentStorage::moveFile( $content . $source_data_path_edit , $content . $target_data_path_edit , false , true );


		return true;
	}

	public static function createWidgetImage($entry, $create)
	{
		$contentPath = myContentStorage::getFSContentRootPath();
		$path = kFile::fixPath( $contentPath.$entry->getWidgetImagePath() );

		// if the create flag is not set and the file doesnt exist exit
		// e.g. the roughcut name has change, we update the image only if it was already in some widget
		if (!$create && !file_exists($path))
			return;

		$im = imagecreatetruecolor(400,30);

		$color = imagecolorallocate($im, 188, 230, 99);
		$font = SF_ROOT_DIR.'/web/ttf/arial.ttf';

		imagettftext($im, 12, 0, 10, 21, $color, $font, $entry->getName());

		myContentStorage::fullMkdir($path);

		imagegif($im, $path);
		imagedestroy($im);

	}


	public static function modifyEntryMetadataWithText ( $entry , $text , $duration=6 , $override=false)
	{
		kLog::log ( "modifyEntryMetadataWithText:\n$text");
		$content = myContentStorage::getFSContentRootPath() ;
		if ( ! $override )
		{
			// this will reset the data and increment the count
			$entry->setData( ".xml" );
		}
		$target = $content . $entry->getDataPath();
		$source = $content . myContentStorage::getGeneralEntityPath ( "entry/data" , 0, 0 , "&metadata_text.xml" );

		if ( $override || !file_exists( $target ))
		{
//			kLog::log ( "modifyEntryMetadataWithText\n$str_before\n$str_after\n" );

			$template_str = file_get_contents( $source ) ;
			$template_str = str_replace(
				array ( "__TEXT_PLACEHOLDER__" , "__SLIDE_LENGTH_IN_SECS_PLACEHOLDER__"  ) ,
				array ( $text , $duration  ) ,
				$template_str );
			kFile::setFileContent( $target , $template_str );

//	 		kLog::log ( "modifyEntryMetadataWithText:\n$text");

			$entry->save();
		}
	}


	// remove strange characters and multiple spaces
	public static function clearUnwantedText( $dict_before ,  $text , $dict_sfter )
	{

		if ( $dict_before != null )
		{
			$from = array();
			$to = array();
			foreach ( $dict_before as $dict_from => $dict_to )
			{
				$from[] = $dict_from;
				$to[] = $dict_to;
			}
			$text = str_replace( $from , $to , $text );
		}

		$text = preg_replace ( "/<script[^<]+?<\/script>/s"  , " " , $text ); // remove the html script tag and it's content
		$text = preg_replace ( "/<[^>]+?[>]/s"  , " " , $text ); // remove html tags
		$text = preg_replace ( "/[^a-zA-Z0-9\-_\n \']/s" , " " , $text ) ; // get rid of all kind of strange characters - allow single quotes
		$text = preg_replace ( '/[ \r\t]{2,}/s' , " " , $text ) ; // get rid of multiple spaces
		$new_text = "";

		$new_text = $text;

/*
		$len = strlen ( $text );
		for ($i =0 ; $i < $len ;++$i  )
		{
			$c = substr ( $text , $i , 1 );
			$ord = ord ( $c );
			echo "[$c|$ord]";
		}
*/

		if ( $dict_sfter != null )
		{
			$from = array();
			$to = array();
			foreach ( $dict_sfter as $dict_from => $dict_to )
			{
				$from[] = $dict_from;
				$to[] = $dict_to;
			}
			$text = str_replace( $from , $to , $new_text );
		}

		return $new_text;
	}

	// will handle deletion of entries -
	// 1. change status to ENTRY_STATUS_DELETED
	// 2. set data to be the "deleted_entry" depending on the media_type of the entry - point to the partner's template if exists
	// 3. add the entry to the delete_entry table to be handled in a batch way
	// 4. move the file so none of it's versions can be accessed via the web (there is usually only one version for a media_clip)
	public static function deleteEntry ( entry $entry , $partner_id = null )
	{
		if ( $entry->getStatus() == entry::ENTRY_STATUS_DELETED || $entry->getStatus() == entry::ENTRY_STATUS_BLOCKED  )
			return ; // don't do this twice !

		$media_type = $entry->getMediaType();
		$need_to_fix_roughcut = false;
		$thumb_template_file = "&deleted_image.jpg";
		switch ( $media_type )
		{
			case entry::ENTRY_MEDIA_TYPE_AUDIO:
				$template_file = "&deleted_audio.flv";
				$need_to_fix_roughcut = true;
				break;
			case entry::ENTRY_MEDIA_TYPE_IMAGE:
				$template_file = "&deleted_image.jpg";
				$need_to_fix_roughcut = false ; // no need to add a batch job for images
				break;
			case entry::ENTRY_MEDIA_TYPE_VIDEO:
				$template_file = "&deleted_video.flv";
				$need_to_fix_roughcut = true;
				break;
			case entry::ENTRY_MEDIA_TYPE_SHOW:				
			default:
				$template_file = "&deleted_rc.xml";
				$need_to_fix_roughcut = false;
				break;
		}

		// in this case we'll need some batch job to fix all related roughcuts for this entry
		// use the batch_job mechanism to indicate there is a deleted entry to handle
		if ( $need_to_fix_roughcut )
		{
			BatchJob::createDeleteEntryJob ( $entry );
		}

		$entry->putInCustomData( "deleted_original_data" , $entry->getData() ) ;
		$entry->putInCustomData( "deleted_original_thumb" , $entry->getThumbnail() ) ;		

		$content_path = myContentStorage::getFSContentRootPath();

		$current_file_path = $content_path.$entry->getDataPath();
		$current_file_path_2 = $content_path.$entry->getDataPathEdit();
		$current_thumbnail_file_path = $content_path.$entry->getThumbnailPath();		

		$entry->setData( $entry->getData() ); 				// once to increment the verions
		$entry->setData( $template_file ); 					// the other to set the template
		$entry->setThumbnail( $entry->getThumbnail() );		// once to increment the verions
		$entry->setThumbnail( $thumb_template_file );		// the other to set the template
		
		// move file so there will be no access to it
		$deleted_content = myContentStorage::moveToDeleted ( $current_file_path);
		if ( $current_file_path_2 != $current_file_path )
			$deleted_content .= "|" . myContentStorage::moveToDeleted ( $current_file_path_2 );
		if ( $current_thumbnail_file_path != $current_file_path )
			$deleted_content .= "|" . myContentStorage::moveToDeleted ( $current_thumbnail_file_path );
		
		$entry->putInCustomData( "deleted_file_path" , $deleted_content ? $deleted_content : $current_file_path ) ;
		
		$entry->setStatus ( entry::ENTRY_STATUS_DELETED );
	}

	// will handle deletion of entries -
	// 1. change status to ENTRY_STATUS_DELETED
	// 2. set data to be the "deleted_entry" depending on the media_type of the entry - point to the partner's template if exists
	// 3. add the entry to the delete_entry table to be handled in a batch way
	// 4. move the file so none of it's versions can be accessed via the web (there is usually only one version for a media_clip)
	public static function undeleteEntry ( entry $entry , $partner_id = null )
	{
		if ( $entry->getStatus() != entry::ENTRY_STATUS_DELETED )
		{
			return;
		}

		$data = $entry->getData();
		$original_play = "";
		
		$parts = explode ( "&" , $data );
		if ( count ( $parts ) < 2 )
			$original_play = $data;
		else
		{
			$original_play = $parts[0];
		}
		
		$deleted_file_path = $entry->getFromCustomData( "deleted_file_path" );

//		echo $deleted_file_path . "\n";
		$deleted_paths = explode ( "|" , $deleted_file_path );

		if ( $deleted_paths )
		{
			$original_play = @$deleted_paths[0];
			$original = myContentStorage::moveFromDeleted ( @$deleted_paths[0] );
			$original = myContentStorage::moveFromDeleted ( @$deleted_paths[1] );
			//figure out the thumb's path from the deleted path  and the property deleted_original_thumb
			
			$entry->setData ( null );
			$entry->setData ( $entry->getFromCustomData( "deleted_original_data" ) , true ) ; // force the value that was set beforehand 
			// the data is supposed to point to a delete template 100000.flv&deleted_video.flv

			$orig_thumb = $entry->getFromCustomData( "deleted_original_thumb" );
			if ( myContentStorage::isTemplate( $orig_thumb ) )
			{
				$entry->setThumbnail( $orig_thumb , true ); //  the thumbnail wat a template- use it as it was
			}
			else
			{
				$entry->setThumbnail( null ); // reset the thumb before setting - it won't increment the version count
				$entry->setThumbnail( $entry->getFromCustomData( "deleted_original_thumb" ) , true ); // force the value that was set beforehand
				$original = myContentStorage::moveFromDeleted ( @$deleted_paths[2] ); // 
			}	
		}
		else
		{
			// error
		}
		
		$entry->setStatusReady( true );
	}


	public static function createRoughcutThumbnailFromEntry ( $source_entry , $should_force = false )
	{
		$kshow = kshowPeer::retrieveByPK( $source_entry->getKshowId() );
		if ( ! $kshow )
		{
			kLog::log( "Error: entry [" . $source_entry->getId() . "] does not have a kshow" );	
			return false;
		}
	
		if ( $kshow )
		{
			$roughcut = $kshow->getShowEntry();
			if ( ! $roughcut )
			{
				kLog::log( "Error: entry [" . $source_entry->getId() . "] from kshow " . $kshow->getId() . "] does not have a roughcut " );
				return false;	
			}
			
			return self::createRoughcutThumbnail ( $roughcut , $source_entry , $should_force )	;
		}
		else
		{
			return false;
		}
		
	}
	
	public static function createRoughcutThumbnail ( $roughcut, $source_entry , $should_force = false )
	{
		if ( ! $roughcut )
		{
			return false;
		} 
		
		$res = self::createThumbnail( $roughcut, $source_entry , $should_force );
		if ( $res ) 
		{
			$content = $roughcut->getDataContent();
			if ( $content )
			{			
				$new_metadata = myMetadataUtils::updateThumbUrlFromMetadata ($content , $source_entry->getThumbnailUrl() );
		// TODO - remove teh hack of the type			
		$roughcut->setMediaType ( entry::ENTRY_MEDIA_TYPE_XML );
				$roughcut->setDataContent($new_metadata, false ,true ) ;
		$roughcut->setMediaType ( entry::ENTRY_MEDIA_TYPE_SHOW );
				$roughcut->save();
				return $res;
			}
		}
		return false;
	}
	
	public static function createThumbnail ( $entry , $source_entry , $should_force = false )
	{
		// empty or template
		$empty_path = $entry->getThumbnail() == null  || strpos ( $entry->getThumbnail() , "&" ) !== false ;

		if  ( $should_force || $empty_path )
		{
			return self::createThumbnailFromEntry($entry, $source_entry, -1);
		}

		return false;
	}

	public static function createThumbnailFromEntry ( entry $entry , entry $source_entry, $time_offset )
	{
		$content = myContentStorage::getFSContentRootPath();

		$dataPath = $content.$source_entry->getDataPath();
		$media_type = $source_entry->getMediaType();

		if ($media_type == entry::ENTRY_MEDIA_TYPE_VIDEO && $time_offset != -1)
		{
			$tempPath = myContentStorage::getFSUploadsPath();

			$tempThumbPrefix = $tempPath."temp_thumb".microtime(true);
			$thumbBigFullPath = $tempThumbPrefix."big_1.jpg";
			$thumbFullPath = $tempThumbPrefix.'1.jpg';

			myFileConverter::autoCaptureFrame($dataPath, $tempThumbPrefix."big_", $time_offset, -1, -1);

			myFileConverter::convertImage($thumbBigFullPath, $thumbFullPath);

			$should_copy = false;
		}
		else if ($media_type == entry::ENTRY_MEDIA_TYPE_VIDEO && $time_offset == -1 ||
			$media_type == entry::ENTRY_MEDIA_TYPE_IMAGE ||
			$media_type == entry::ENTRY_MEDIA_TYPE_SHOW)
		{
			$thumbBigFullPath = $content.$source_entry->getBigThumbnailPath();
			$thumbFullPath = $content.$source_entry->getThumbnailPath();
			$should_copy = true;
		}
		else
			return false;

		$bigThumbExists = file_exists($thumbBigFullPath) && filesize($thumbBigFullPath);
		$thumbExists = file_exists($thumbFullPath) && filesize($thumbFullPath);
		
		if (!$bigThumbExists && !$thumbExists)
		{
			return false;
		}

		$entry->setThumbnail ( ".jpg");
		$entry->save();

		$thumbBigFinalPath = $content.$entry->getBigThumbnailPath();
		$thumbFinalPath = $content.$entry->getThumbnailPath();

		if ($bigThumbExists)
			myContentStorage::moveFile($thumbBigFullPath, $thumbBigFinalPath, true , $should_copy );
			
		if ($thumbExists)
		myContentStorage::moveFile($thumbFullPath, $thumbFinalPath, true , $should_copy );

		return true;
	}
	
	
	public static function resizeEntryImage ( $entry_id , $version , $width , $height , $type , $bgcolor ="ffffff" , $crop_provider=null, $quality = 0,
		$src_x = 0, $src_y = 0, $src_w = 0, $src_h = 0, $vid_sec = -1, $vid_slice = 0, $vid_slices = -1)
	{
		$entry = entryPeer::retrieveByPKNoFilter ( $entry_id );
		
		if ( !$entry )
			return null;
			
		$entry_status = $entry->getStatus();
		$contentPath = myContentStorage::getFSContentRootPath();
			
		$tempThumbName = $entry->getId()."_{$width}_{$height}_{$type}_{$crop_provider}_{$bgcolor}_{$quality}_{$src_x}_{$src_y}_{$src_w}_{$src_h}_{$vid_sec}_{$vid_slice}_{$vid_slices}_{$entry_status}";
		
		$entryThumbFilename = $entry->getThumbnail();
		if ($entry->getStatus() != entry::ENTRY_STATUS_READY || @$entryThumbFilename[0] == '&')
			$tempThumbName .= "_NOCACHE_";
		
		// we remove the & from the template thumb otherwise getGeneralEntityPath will drop $tempThumbName from the final path
		$entryThumbFilename = str_replace("&", "", $entryThumbFilename);
		$tempThumbPath = $contentPath.myContentStorage::getGeneralEntityPath("entry/tempthumb", $entry->getIntId(), $tempThumbName, $entryThumbFilename , $version );
		
//		echo $tempThumbName ."<br>" . $tempThumbPath;	die();
		if (!file_exists($tempThumbPath))
		{
			$orig_image_path = $contentPath.$entry->getBigThumbnailPath(true,$version);

			// check a request for animated thumbs without a concrete vid_slice
			// in which case we'll create all the frames as one wide image
			$multi = $vid_slice == -1 && $vid_slices != -1;
			$count = $multi ? $vid_slices : 1;
			$im = null;
			if ($multi)
				$vid_slice = 0;  
				
			while($count--)
			{
				if (($vid_sec != -1 || $vid_slices != -1) && $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_VIDEO)
				{
					if ($vid_sec != -1)
						$calc_vid_sec = min($vid_sec, floor($entry->getLengthInMsecs() / 1000));
					else
						$calc_vid_sec = floor($entry->getLengthInMsecs() / $vid_slices * min($vid_slice, $vid_slices) / 1000);
						
					$capturedThumbName = $entry->getId()."_sec_{$calc_vid_sec}";
					$capturedThumbPath = $contentPath.myContentStorage::getGeneralEntityPath("entry/tempthumb", $entry->getIntId(), $capturedThumbName, $entry->getThumbnail() , $version );
		
					$orig_image_path = $capturedThumbPath."temp_1.jpg";
		
					// if we already captured the frame at that second, dont recapture, just use the existing file
					if (!file_exists($orig_image_path))
					{
						$content = myContentStorage::getFSContentRootPath();
						myFileConverter::autoCaptureFrame($content.$entry->getDataPath(), $capturedThumbPath."temp_", $calc_vid_sec, -1, -1);
					}
				}
	
				kFile::fullMkdir($tempThumbPath);
				if ($crop_provider)
				{
					myFileConverter::convertImageUsingCropProvider($orig_image_path, $tempThumbPath, $width, $height, $type, $crop_provider, $bgcolor, true, $quality, $src_x, $src_y, $src_w, $src_h);
				}
				else
				{
					myFileConverter::convertImage($orig_image_path, $tempThumbPath, $width, $height, $type, $bgcolor, true, $quality, $src_x, $src_y, $src_w, $src_h);
				}
				
				if ($multi)
				{
					list($w, $h, $type, $attr, $srcIm) = myFileConverter::createImageByFile($tempThumbPath);
					if (!$im)
						$im = imagecreatetruecolor($w * $vid_slices, $h);
						
					imagecopy($im, $srcIm, $w * $vid_slice, 0, 0, 0, $w, $h);
					imagedestroy($srcIm);
						
					++$vid_slice;
				}
			}
			
			if ($multi)
			{
				imagejpeg($im, $tempThumbPath);
				imagedestroy($im);
			}
			
			// for now comment this code since we are returning a swf for entries in preconvert or error status
			/*
			if ($entry_status == entry::ENTRY_STATUS_PRECONVERT ||
				$entry_status == entry::ENTRY_STATUS_ERROR_CONVERTING)
			{
					list($w, $h, $type, $attr, $im) = myFileConverter::createImageByFile($tempThumbPath);
					if (!$im)
					{
						$w = $width;
						$h = $height;
						$im = imagecreatetruecolor($w, $h);
					}
						
					$msgPath = $contentPath."content/templates/entry/bigthumbnail/";
					$msgPath .= $entry_status == entry::ENTRY_STATUS_PRECONVERT ?
						"entry_converting.png" : "entry_error.png";
					
					list($msgW, $msgH, $type, $attr, $msgIm) = myFileConverter::createImageByFile($msgPath);
					
					imagecopy($im, $msgIm, ($w - $msgW) / 2, ($h - $msgH) / 2, 0, 0, $msgW, $msgH);
					imagedestroy($msgIm);
					
					imagejpeg($im, $tempThumbPath);
					imagedestroy($im);
			}
			*/
		}		

		return $tempThumbPath;
	}
	
	//
	// sets the type and media_type of an entry according to the file extension
	// in case the media_type is entry::ENTRY_MEDIA_TYPE_AUTOMATIC we find the media_type from the extension
	// in case the type is entry::ENTRY_TYPE_AUTOMATIC we set the type according to the media_type found before
	//
	// two use cases:
	// 1. TYPE set to DOCUMENT and MEDIA_TYPE to AUTOMATIC : the media_type will be set to DOCUMENT no matter what the file ext. is
	// 2. TYPE set to MEDIA_CLIP and MEDIA_TYPE to AUTOMATIC : the correct media_type will be set or remain on AUTOMATIC 
	//		to be handled outside this function 
	// 3. TYPE set to AUTOMATIC and MEDIA_TYPE to AUTOMATIC : the media_type will be detected.
	//		if its found TYPE will be set to MEDIA_CLIP otherwise to DOCUMENT
	//
	static public function setEntryTypeAndMediaTypeFromFile(entry $entry, $entry_full_path)
	{
		if ($entry->getType() == entry::ENTRY_TYPE_DOCUMENT)
		{
			$entry->setMediaType(entry::ENTRY_MEDIA_TYPE_DOCUMENT);
			return;
		}
			
		$media_type = $entry->getMediaType();
		if ($media_type == entry::ENTRY_MEDIA_TYPE_AUTOMATIC)
		{
			$media_type = myFileUploadService::getMediaTypeFromFileExt(pathinfo($entry_full_path, PATHINFO_EXTENSION));
			$entry->setMediaType($media_type);
		}
		
		// we'll set the type according to the media_type - either a media_clip or a document
		if ($entry->getType() == entry::ENTRY_TYPE_AUTOMATIC)
		{
			if ($media_type == entry::ENTRY_MEDIA_TYPE_IMAGE ||	$media_type == entry::ENTRY_MEDIA_TYPE_VIDEO ||
				$media_type == entry::ENTRY_MEDIA_TYPE_AUDIO)
				$entry->setType(entry::ENTRY_TYPE_MEDIACLIP);
			else
			{
				$entry->setType(entry::ENTRY_TYPE_DOCUMENT);
				$entry->setMediaType(entry::ENTRY_MEDIA_TYPE_DOCUMENT);
			}
		}
	}
	
	/*
	 * When there is a big list of entries that we know the getPuser will be called - 
	 * Use this to fetch the whole list rather than one-by-on
	 * TODO - not relevant once merge puser_kuser in kuser table
	 */
	public static function updatePuserIdsForEntries ( $entries )
	{
		if ( ! $entries ) return;
		// get the whole list of kuser_ids	
		$partner_kuser_list = array();
kuserPeer::getCriteriaFilter()->disable(); 			
PuserKuserPeer::getCriteriaFilter()->disable();
		foreach ( $entries as &$entry )
		{
			$pid = $entry->getPartnerId() ;
			if ( @$partner_kuser_list[$pid] == null )
			{
				 $partner_kuser_ids = array();
			}
			else
			{
				$partner_kuser_ids = $partner_kuser_list[$pid];
			}
//print_r ( $entry );			
			$kuser_id = $entry->getKuserId();

			$partner_kuser_ids[$kuser_id] = $kuser_id;
			$partner_kuser_list[$pid] = $partner_kuser_ids;
		}

		// the kuser_id is unique across partners
		$kuser_list = array();		
		foreach ( $partner_kuser_list as $pid => $kuser_ids )
		{
			$puser_kuser_list = PuserKuserPeer::getPuserIdFromKuserIds( $pid , $kuser_ids );
			
			// builf a map where the key is kuser_id for fast fetch 
			foreach ( $puser_kuser_list as $puser_kuser )
			{
				$kuser_id = $puser_kuser->getKuserId();
				$puser_id = $puser_kuser->getPuserId();
				$kuser_list[$kuser_id]=$puser_id;
			}
		}
		foreach ( $entries as $entry )
		{
			$kuser_id = $entry->getKuserId();
			$puser_id = @$kuser_list[$kuser_id];
			
			if ( $puser_id )
			{
				$entry->tempSetPuserId ( $puser_id );
			}
		}
		
		kuserPeer::getCriteriaFilter()->enable(); 			
		PuserKuserPeer::getCriteriaFilter()->enable();
	}
	
	//
	// calculate the total storage size of an entry by adding its file size and archive size
	// if the entry status is deleted the returned size is zero since we can remove it
	//
	public static function calcStorageSize(entry $entry)
	{
		if ($entry->getStatus() == entry::ENTRY_STATUS_DELETED)
			return 0;
		
		$size = 0;
		
		$entry_id = $entry->getId();
		
		$path = $entry->getFullDataPath();
		
		// get file size
		$size = @filesize($path);
		
		$media_type =  $entry->getMediaType();
		
		// in case of video add the edit flavor size
		if ($media_type == entry::ENTRY_MEDIA_TYPE_VIDEO)
		{
			$size += @filesize(str_replace(".flv", "_edit.flv", $path));			
		}
		
		$archive_file = null;
		
		if ( $media_type == entry::ENTRY_MEDIA_TYPE_IMAGE )
		{
			// /web/archive/content/entry/data/...
			$root = myContentStorage::getFSArchiveRootPath();
			$path = $entry->getDataPath();
			$file_name = $root . $path;
			$file_name = dirname ( $file_name ) . "/{$entry_id}*.*";
 			
			$archive_files = glob ( $file_name );
			$archive_file = @$archive_files[0];
			
			if( ! $archive_file )
			{
				$archive_file = myContentStorage::getFSContentRootPath() . $entry->getDataPath();	
			}			
		}
		elseif ( $media_type == entry::ENTRY_MEDIA_TYPE_VIDEO || $media_type == entry::ENTRY_MEDIA_TYPE_AUDIO  )
		{
			// /web/archive/data/...			
			$root = myContentStorage::getFSArchiveRootPath();
			$path = $entry->getDataPath();
			$file_name = $root . "/" . str_replace ( "/content/entry/" , "" , $path );
			$file_name = dirname ( $file_name ) . "/{$entry_id}.*";
			$archive_files = glob ( $file_name );
			$archive_file = @$archive_files[0];
		}
		
		if ($archive_file)
			$size += @filesize($archive_file);
			
		return $size;
	}
}
?>