<?php

require_once( 'myContentStorage.class.php');
require_once( 'dateUtils.class.php');
require_once( 'model/ktagword.class.php');
require_once ( "myStatisticsMgr.class.php");

/**
 * Subclass for representing a row from the 'entry' table.
 *
 *
 *
 * @package lib.model
 */
class entry extends Baseentry
{
	private $previous_status ;

	const MINIMUM_ID_TO_DISPLAY = 8999;

	// NOTE - CHANGES MUST BE MADE TO LAYOUT.PHP JS PART AS WELL
	// different sort orders for browsing entries
	const ENTRY_SORT_MOST_VIEWED = 0;
	const ENTRY_SORT_MOST_RECENT = 1;
	const ENTRY_SORT_MOST_COMMENTS = 2;
	const ENTRY_SORT_MOST_FAVORITES = 3;
	const ENTRY_SORT_RANK = 4;
	const ENTRY_SORT_MEDIA_TYPE = 5;
	const ENTRY_SORT_NAME = 6;
	const ENTRY_SORT_KUSER_SCREEN_NAME = 7;

	// NOTE - CHANGES MUST BE MADE TO LAYOUT.PHP JS PART AS WELL
	const ENTRY_TYPE_AUTOMATIC = -1;
	const ENTRY_TYPE_BACKGROUND = 0;
	const ENTRY_TYPE_MEDIACLIP = 1;
	const ENTRY_TYPE_SHOW = 2;
	const ENTRY_TYPE_BUBBLES = 4;
	const ENTRY_TYPE_PLAYLIST = 5;
	const ENTRY_TYPE_DATA = 6;
	const ENTRY_TYPE_DOCUMENT = 10;
	const ENTRY_TYPE_DVD = 300;	

	// NOTE - CHANGES MUST BE MADE TO LAYOUT.PHP JS PART AS WELL
	const ENTRY_MEDIA_TYPE_AUTOMATIC = -1;
	const ENTRY_MEDIA_TYPE_ANY = 0;
	const ENTRY_MEDIA_TYPE_VIDEO = 1;
	const ENTRY_MEDIA_TYPE_IMAGE = 2;
	const ENTRY_MEDIA_TYPE_TEXT = 3;
	const ENTRY_MEDIA_TYPE_HTML = 4;
	const ENTRY_MEDIA_TYPE_AUDIO = 5;
	const ENTRY_MEDIA_TYPE_SHOW = 6;
	const ENTRY_MEDIA_TYPE_SHOW_XML = 7; // for the kplayer: the data contains the xml itself and not a url
	const ENTRY_MEDIA_TYPE_BUBBLES = 9;
	const ENTRY_MEDIA_TYPE_XML = 10;
	const ENTRY_MEDIA_TYPE_DOCUMENT = 11;
	const ENTRY_MEDIA_TYPE_SWF = 12;
	const ENTRY_MEDIA_TYPE_GENERIC_1= 101;	// these types can be used for derived classes - assume this is some kind of TXT file
	const ENTRY_MEDIA_TYPE_GENERIC_2= 102;	// these types can be used for derived classes 
	const ENTRY_MEDIA_TYPE_GENERIC_3= 103;	// these types can be used for derived classes 
	const ENTRY_MEDIA_TYPE_GENERIC_4= 104;	// these types can be used for derived classes
	
	
	// NOTE - CHANGES MUST BE MADE TO LAYOUT.PHP JS PART AS WELL
	const ENTRY_MEDIA_SOURCE_FILE = 1;
	const ENTRY_MEDIA_SOURCE_WEBCAM = 2;
	const ENTRY_MEDIA_SOURCE_FLICKR = 3;
	const ENTRY_MEDIA_SOURCE_YOUTUBE = 4;
	const ENTRY_MEDIA_SOURCE_URL = 5;
	const ENTRY_MEDIA_SOURCE_TEXT = 6;
	const ENTRY_MEDIA_SOURCE_MYSPACE = 7;
	const ENTRY_MEDIA_SOURCE_PHOTOBUCKET = 8;
	const ENTRY_MEDIA_SOURCE_JAMENDO = 9;
	const ENTRY_MEDIA_SOURCE_CCMIXTER = 10;
	const ENTRY_MEDIA_SOURCE_NYPL = 11;
	const ENTRY_MEDIA_SOURCE_CURRENT = 12;
	const ENTRY_MEDIA_SOURCE_MEDIA_COMMONS = 13;
	const ENTRY_MEDIA_SOURCE_KALTURA = 20;
	const ENTRY_MEDIA_SOURCE_KALTURA_USER_CLIPS = 21;
	const ENTRY_MEDIA_SOURCE_ARCHIVE_ORG = 22;
	const ENTRY_MEDIA_SOURCE_KALTURA_PARTNER = 23;
	const ENTRY_MEDIA_SOURCE_METACAFE = 24;
	const ENTRY_MEDIA_SOURCE_KALTURA_QA = 25;
	const ENTRY_MEDIA_SOURCE_KALTURA_KSHOW = 26;
	const ENTRY_MEDIA_SOURCE_KALTURA_PARTNER_KSHOW = 27;
	const ENTRY_MEDIA_SOURCE_SEARCH_PROXY = 28;
	
	const ENTRY_STATUS_ERROR_CONVERTING = -1;
	const ENTRY_STATUS_IMPORT = 0;
	const ENTRY_STATUS_PRECONVERT = 1;
	const ENTRY_STATUS_READY = 2;
	const ENTRY_STATUS_DELETED = 3;
	const ENTRY_STATUS_PENDING = 4;  // NOT is use !
	const ENTRY_STATUS_MODERATE = 5; // entry waiting in the moderation queue
	const ENTRY_STATUS_BLOCKED = 6;
	
	const MAX_NORMALIZED_RANK = 5;

	private $appears_in = null;

	private $m_added_moderation = false;
	private $should_call_set_data_content = false;
	private $data_content = null;
	
	private $desired_version = null;
	
	// the columns names is a list of all fields that will participate in the search_text
	// TODO - add the admin_tags to the column names
	public static function getColumnNames()	{		return array ( "name" , "tags" ,"description" , "admin_tags" );	}
	public static function getSearchableColumnName () { return "search_text" ; }

	// don't stop until a unique hash is created for this object
	private static function calculateId ( )
	{
		for ( $i = 0 ; $i < 10 ; ++$i)
		{
			$id = substr(base_convert(md5(uniqid(rand(), true)), 16, 36), 1, 10);
			$existing_object = entryPeer::retrieveByPk( $id );
			
			if ( ! $existing_object ) return $id;
		}
		
		die();
	}
	
	public function justSave($con = null)
	{
		$this->setCustomDataObj();
		return parent::save( $con );
	}
	
	public function save($con = null)
	{
		$is_new = false;
		if ( $this->isNew() )
		{
			$this->setId(self::calculateId());

			// start by setting the modified_at to the current time
			$this->setModifiedAt( time() ) ;			
			
			// only media clips should increments - not roughcuts or backgrounds
			if ( $this->type == self::ENTRY_TYPE_MEDIACLIP )
				myStatisticsMgr::addEntry( $this );

			$is_new = true;
		}
		else
		{
			if ( $this->previous_status != self::ENTRY_STATUS_DELETED &&
				 $this->getStatus() == self::ENTRY_STATUS_DELETED )
			{
				myStatisticsMgr::deleteEntry( $this );
			}
		}

		if ( $this->type == self::ENTRY_TYPE_SHOW )
		{
			// some of the properties should be copied to the kshow
			$kshow = $this->getkshow();
			if ( $kshow )
			{
				$modified  = false;
				if ( $kshow->getRank() != $this->getRank() )
				{
					$kshow->setRank( $this->getRank() );
					$modified = true;
				}
				if ( $kshow->getLengthInMsecs() != $this->getLengthInMsecs() )
				{
					$kshow->setLengthInMsecs ( $this->getLengthInMsecs() );
					$modified = true;
				}

				if ( $modified ) $kshow->save();
			}
			else
			{
				$this->log( "entry [" . $this->getId() . "] does not have a real kshow with id [" . $this->getKshowId() . "]" , Propel::LOG_WARNING );
			}
		}

		myPartnerUtils::setPartnerIdForObj( $this );

		if ( $this->getType() != self::ENTRY_TYPE_PLAYLIST ) 
			mySearchUtils::setDisplayInSearch( $this );

		// update the admin_tags per partner
		ktagword::updateAdminTags( $this );
		
		// same for puserId ... 
		$this->getPuserId( true );
		
		// if the custom_data obj has change - serialize it
		$this->setCustomDataObj();

		// make sure this entry is saved before calling updateAllMetadataVersionsRelevantForEntry, since fixMetadata retrieves the entry from the DB
		// and checks its data path which was modified above.
		$res = parent::save( $con );
		if ($is_new)
		{
			// when retrieving the entry - ignore thr filter - when in partner has moderate_content =1 - the entry will have status=3 and will fail the retrieveByPk 
			entryPeer::setUseCriteriaFilter(false);
			$obj = entryPeer::retrieveByPk($this->getId());
			$this->setIntId($obj->getIntId());
			entryPeer::setUseCriteriaFilter(true);
		}
		
		if ( $this->should_call_set_data_content )
		{
			// calling the funciton with null will cause it to use the $this->data_content
			$this->setDataContent( null );
			$res = parent::save( $con );
		}
		
		// the fix should be done whether the status is READY or ERROR_CONVERTING
		if ( $this->getStatus() == entry::ENTRY_STATUS_READY || $this->getStatus() == entry::ENTRY_STATUS_ERROR_CONVERTING )
		{
			// fire some stuff due to the new status
			$version_to_update = $this->getUpdateWhenReady();

			if ( $version_to_update )
			{
				myMetadataUtils::updateAllMetadataVersionsRelevantForEntry ( $this , $version_to_update );
				$this->resetUpdateWhenReady();

				$this->setCustomDataObj();

				$res = parent::save( $con );
			}
		}
		return $res;
	}


	// TODO - PERFORMANCE DB - move to use cache !!
	// will increment the views by 1
	public function incViews ( $should_save = true )
	{
		myStatisticsMgr::incEntryViews( $this );
	}



	private function statusChangedTo ( $new_status )
	{
		return ( $this->previous_status != $new_status &&
				$this->getStatus() == $new_status );
	}


	public function setStatus ( $v)
	{
		$this->previous_status = $this->getStatus();
		parent::setStatus( $v );
	}

	/**
	 * will handle the flow in case of need to moderate.
	 * if force == false, will consider the moderate flag on the entry or for the partner
	 *
	 */
	public function setStatusReady ( $force = false )
	{
		$should_moderate = false;
		if ( $force )
		{
			$this->setStatus( self::ENTRY_STATUS_READY );
		}
		else
		{
			// in this case no configuration really matters
			if ( $this->getModerate() )
			{
				$should_moderate = true;
			}
			else
			{
				$should_moderate = myPartnerUtils::shouldModerate( $this->getPartnerId() );
			}
		}

		if( $should_moderate )
		{
			if ( ! $this->getId() )
			{
			 	$this->save(); // save to DB so we'll have the id for the moderation list
			}

			$this->setStatus( self::ENTRY_STATUS_MODERATE );
			$this->setModerationStatus( moderation::MODERATION_STATUS_PENDING );
			if ( !$this->m_added_moderation )
			{
				myModerationMgr::addToModerationList( $this );
				$this->m_added_moderation = true;
			}
		}
		else
		{
			$this->setStatus( self::ENTRY_STATUS_READY );
			$this->setModerationStatus( moderation::MODERATION_STATUS_AUTO_APPROVED );
		}
		return $this->getStatus();
	}

	public function isReady()
	{
		return ( $this->getStatus() == self::ENTRY_STATUS_READY ) ;
	}

	public function getNormalizedRank ()
	{
		$res = round($this->rank / 1000);

		if ( $res > self::MAX_NORMALIZED_RANK ) return self::MAX_NORMALIZED_RANK;

		return $res;
	}

	// will return an array of tuples of the file's version:
	// file name
	// file size
	// file date
	// file version
	public function getAllVersions ()
	{
		$res = myContentStorage::getAllVersions("entry/data", $this->getIntId(), $this->getId(), $this->getData());
//		print_r ( $res );
		return $res;
	}


	public function getAllVersionsFormatted()
	{
		$res = $this->getAllVersions();
		$formatted = array ();

		if ( ! is_array ( $res )  ) return null;
		
		foreach ( $res as $version_info )
		{
			$formatted []= array ( "version" => $version_info[3] ,
				"rawData" =>  $version_info[2] ,
				"date" => strftime( "%d/%m/%y %H:%M:%S" , $version_info[2] ) );
		}
		return $formatted;
	}

	public function getLastVersion()
	{
		$version = kFile::getFileNameNoExtension ( $this->getData() );
		return $version;
	}

	public function getFormattedLengthInMsecs ()
	{
		return dateUtils::formatDuration ( $this->getLengthInMsecs() );
	}

	// return the path on the entry in the archive
	public function getFullArchivePath( $version = NULL )
	{
		$data_path = $this->getFullDataPath( $version );
		// assume the suffix is not the same as the one on the data
		$archive_pattern =  dirname ( str_replace ( "content/entry/" , "archive/" , $data_path ) ) . "/" . $this->getId() . ".*" ;
		foreach ( glob ( $archive_pattern ) as $full_path_name )
		{
			return $full_path_name;
		}
		
		return null;
	}
		
	// return the path on the dist
	public function getFullDataPath( $version = NULL )
	{
		$path = myContentStorage::getFSContentRootPath() . $this->getDataPath();
		if ( file_exists( $path )) return $path;
		return $path; 
	}
	
	/**
	 * This function returns the file system path for a requested content entity.
	 * @return string the content path
	 */
	public function getDataPath( $version = NULL )
	{
		if ( $version == NULL || $version == -1 )
		{
			return myContentStorage::getGeneralEntityPath("entry/data", $this->getIntId(), $this->getId(), $this->getData());
		}
		else
		{
			$ext = pathinfo ($this->getData(), PATHINFO_EXTENSION);
			$file_version = myContentStorage::getGeneralEntityPath("entry/data", $this->getIntId(), $this->getId(), $version);
			return $file_version . "." . $ext;
		}
	}

	public function getDataUrl( $version = NULL )
	{
		if( $this->getType() == self::ENTRY_TYPE_PLAYLIST )
		{
			return myPlaylistUtils::getExecutionUrl( $this );
		}
		//$path = $this->getThumbnailPath ( $version );
		$path =  myPartnerUtils::getUrlForPartner( $this->getPartnerId() , $this->getSubpId() ) . "/flvclipper/entry_id/" . $this->getId() ;
		$current_version = $this->getVersion();
		if ( $version )
			$path .= "/version/$version";
		else
			$path .= "/version/$current_version";
		$url = requestUtils::getCdnHost() . $path ;
		return $url;
	}


	public function getDataPathEdit ( $version = NULL )
	{
		return myContentStorage::getFileNameEdit( $this->getDataPath( $version ) );
	}

	/**
	 * This function sets and returns a new path for a requested content entity.
	 * @param string $filename = the original fileName from which the extension is cut.
	 * @return string the content file name
	 */
	public function setData($filename , $force = false )
	{
		if (  $force )
			$data = $filename;
		else
			$data = myContentStorage::generateRandomFileName($filename, $this->getData());
		
		Baseentry::SetData( $data );
		return $this->getData();
	}

	public function getDownloadPathForFormat ( $version = NULL , $format  )
	{
		$basename = kFile::getFileNameNoExtension ( $this->getData() );
		$path = myContentStorage::getGeneralEntityPath("entry/download", $this->getIntId(), $this->getId(), $basename);
		$contentPath = myContentStorage::getFSContentRootPath();
	
		$download_path = $contentPath.$path.".$format";

		 return $download_path;
	}
	
	// return the file 
	public function getDownloadPath( $version = NULL , $format = null )
	{
		if ( $this->getType() != self::ENTRY_TYPE_SHOW )
		{
			if ( ! $format ) return $this->getDataPath();
			return $this->getDownloadPathForFormat ( $version , $format );
		}
		
		$basename = str_replace(".xml", "", $this->getData());
		if ( $version == NULL || $version == -1 )
		{
			$path = myContentStorage::getGeneralEntityPath("entry/download", $this->getIntId(), $this->getId(), $basename);
		}
		else
		{
			$path = myContentStorage::getGeneralEntityPath("entry/download", $this->getIntId(), $this->getId(), $version);
		}
		
		$contentPath = myContentStorage::getFSContentRootPath();
		
		foreach (glob($contentPath.$path.".*") as $filename)
		{
			$ext = pathinfo ($filename, PATHINFO_EXTENSION);
			return $path.".".$ext;
		}
		   
		 return null;
	}

	public function getDownloadSize( $version = NULL )
	{
		$path = $this->getDownloadPath($version);
		
		if ($path)
			return @filesize(myContentStorage::getFSContentRootPath() . $path);
		
		return 0;
	}
	
	public function getDownloadUrl( $version = NULL )
	{
		$path = $this->getDownloadPath($version);
		
		if ($path)
		{
			return requestUtils::getCdnHost(). myPartnerUtils::getUrlForPartner( $this->getPartnerId() , $this->getSubpId() ) . "/raw/entry_id/" . $this->getId() . "/version/" . $this->getVersion();
		}
		
		return "";
	}
	
	// given the path of the converted file (not an FLV file) - create its URL
	public function getConvertedDownoadUrl ( $file_real_path )
	{
		$path = str_replace ( myContentStorage::getFSContentRootPath() , "" , $file_real_path );
		$path = str_replace ( "\\" , "" , $path );
		return requestUtils::getCdnHost(). myPartnerUtils::getUrlForPartner( $this->getPartnerId() , $this->getSubpId() ) . $path;	
	}
	
	public function setDesiredVersion ( $v )
	{
		$this->desired_version = $v;	
	}

	public function getDesiredVersion (  )
	{
		return $this->desired_version ;	
	}
	
	// will work only for types that the data can be served as an a response to the service	
	public function getDataContent ( $from_cache = false )
	{
		if ( $this->getType() == self::ENTRY_TYPE_SHOW || 
			$this->getType() == self::ENTRY_TYPE_DATA ||
			$this->getType() == self::ENTRY_TYPE_BUBBLES || 
			$this->getType() == self::ENTRY_TYPE_PLAYLIST ||
			$this->getMediaType() == self::ENTRY_MEDIA_TYPE_XML ||
			$this->getMediaType() == self::ENTRY_MEDIA_TYPE_TEXT || 
			$this->getMediaType() == self::ENTRY_MEDIA_TYPE_GENERIC_1 ) 
		{
			if ( $from_cache ) return $this->data_content;
			$content_path = myContentStorage::getFSContentRootPath();
			$version = $this->desired_version;
			if ( ! $version ) $version = -1;
			$file_name = $content_path . $this->getDataPath( $version ); 
			
			if ( file_exists( $file_name ) )
			{
				// patch for fixing old AE roughcuts without cross="0"
				if ($this->getType() == self::ENTRY_TYPE_SHOW)
				{
					$data = file_get_contents( $file_name );
					$data2 = str_replace('<EndTransition type', '<EndTransition cross="0" type', $data);
					/*
					if ($data != $data2)
					{
						file_put_contents( $file_name, $data2 );
					}
					*/
					return $data2;
				}
				
				return file_get_contents( $file_name );
			}
		}
		return null;
	}
	
	// will work only for types that the data can be served as an a response to the service	
	public function setDataContent ( $v , $increment_version = true , $allow_type_roughcut = false )
	{
//		if ( $v === null ) return ;
		// DON'T do this for ENTRY_TYPE_SHOW unless $allow_type_roughcut is true
		// - the metadata is handling is complex and is done in other places in the code 
		if ( ($allow_type_roughcut && $this->getType() == self::ENTRY_TYPE_SHOW) ||
			$this->getType() == self::ENTRY_TYPE_DATA || 
			$this->getType() == self::ENTRY_TYPE_BUBBLES || 
			$this->getType() == self::ENTRY_TYPE_PLAYLIST ||
			$this->getMediaType() == self::ENTRY_MEDIA_TYPE_XML || 
			$this->getMediaType() == self::ENTRY_MEDIA_TYPE_TEXT ||
			$this->getMediaType() == self::ENTRY_MEDIA_TYPE_GENERIC_1 )
		{
			if ( $this->getId() == null )
			{
				// come back when there is an ID
				$this->data_content = $v;
				$this->should_call_set_data_content = true;
				return ;
			}
			
			if ( $v == null ) $v = $this->data_content;
			else $this->data_content = $v;  // store it so it can be used with getDataContent(true) is called
			
			$content_path = myContentStorage::getFSContentRootPath();
			if ( $increment_version ) $this->setData ( parent::getData() . $this->getFileSuffix() ) ;
			$file_name = $content_path . $this->getDataPath(); 
			kFile::setFileContent( $file_name , $v );
			$this->should_call_set_data_content = false;
			
		}		
	}
	
	// return the default file suffix according to the entry type 
	private function getFileSuffix ( )
	{
		if ( $this->getType() == self::ENTRY_TYPE_BUBBLES ||
			 $this->getType() == self::ENTRY_TYPE_DVD ||
			 $this->getType() == self::ENTRY_TYPE_SHOW || 
			 $this->getMediaType() == self::ENTRY_MEDIA_TYPE_XML ) 
		{
			return ".xml";
		}
		elseif ( $this->getMediaType() == self::ENTRY_MEDIA_TYPE_TEXT || 
				$this->getMediaType() == self::ENTRY_MEDIA_TYPE_GENERIC_1 )
		{
			return ".txt";
		}
		return ""; 
	}
	
	public function getThumbnail()
	{
		$thumbnail = parent::getThumbnail();
		
		if (!$thumbnail && $this->getMediaType() == entry::ENTRY_MEDIA_TYPE_AUDIO)
			$thumbnail = "&audio_thumb.jpg";
			
		return $thumbnail;
	}
	
	/**
	 * This function returns the file system path for a requested content entity.
	 * @return string the content path
	 */
	public function getThumbnailPath( $version = NULL )
	{
		return myContentStorage::getGeneralEntityPath("entry/thumbnail", $this->getIntId(), $this->getId(), $this->getThumbnail() , $version );
	}

	public function getThumbnailUrl( $version = NULL )
	{
		//$path = $this->getThumbnailPath ( $version );
		$path =  myPartnerUtils::getUrlForPartner( $this->getPartnerId() , $this->getSubpId() ) . "/thumbnail/entry_id/" . $this->getId() ;
		$current_version = $this->getThumbnailVersion();
		if ( $version )
			$path .= "/version/$version";
		else
			$path .= "/version/$current_version";
		$url = requestUtils::getCdnHost() . $path ;
		return $url;
	}

	public function getBigThumbnailPath($revertToSmall = false , $version = NULL )
	{
		if ( $this->getMediaType() == self::ENTRY_MEDIA_TYPE_IMAGE )
		{
			// we dont need to make a copy for the big thumbnail - we can use the image itself
			return $this->getDataPath();
		}

		$path = myContentStorage::getGeneralEntityPath("entry/bigthumbnail", $this->getIntId(), $this->getId(), $this->getThumbnail() , $version );
		if ($revertToSmall && !file_exists(myContentStorage::getFSContentRootPath().$path))
			$path = $this->getThumbnailPath();

		return $path;
	}

	public function getBigThumbnailUrl( $version = NULL )
	{

		$path = $this->getBigThumbnailPath ( $version );
		$url = requestUtils::getRequestHost() . $path ;
		return $url;
	}

	/**
	 * This function sets and returns a new path for a requested content entity.
	 * @param string $filename = the original fileName from which the extension is cut.
	 * @return string the content file name
	 */
	public function setThumbnail($filename , $force = false )
	{
		if (  $force )
			$data = $filename;
		else
			$data = myContentStorage::generateRandomFileName($filename, $this->getThumbnail());
		
		Baseentry::SetThumbnail( $data );
		return $this->getThumbnail();
	}

	public function setTags($tags , $update_db = true )
	{
		if ($this->tags !== $tags) {
			$tags = ktagword::updateTags($this->tags, $tags , $update_db );
			parent::setTags( trim($tags));
		}
	}

	public function setAdminTags($tags)
	{
		if ( $tags === null ) return ;
		
		if ( $tags == "" || $this->getAdminTags() !== $tags ) {
			parent::setAdminTags(trim(ktagword::fixAdminTags( $tags)));
		}
	}
	
	public function getCreatedAtAsInt ()
	{
		return $this->getCreatedAt( null );
	}

	public function getUpdateAtAsInt ()
	{
		return $this->getUpdatedAt( null );
	}

	public function getFormattedCreatedAt( $format = dateUtils::KALTURA_FORMAT )
	{
		return dateUtils::formatKalturaDate( $this , 'getCreatedAt' , $format );
	}

	public function getFormattedUpdatedAt( $format = dateUtils::KALTURA_FORMAT )
	{
		return dateUtils::formatKalturaDate( $this , 'getUpdatedAt' , $format );
	}

	public function getAppearsIn ( )
	{
		if ( $this->appears_in == NULL )
		{
			if ( $this->getkshow() )
			{
				$this->setAppearsIn ( $this->getkshow()->getName() );
			}
			else
			{
				return ""; // strange - no kshow ! must be a dangling entry
			}
		}

		return $this->appears_in;
	}

	public function setAppearsIn ( $name )
	{
		$this->appears_in = $name;
	}

	public function getWidgetImagePath()
	{
		return myContentStorage::getGeneralEntityPath("entry/widget", $this->getIntId(), $this->getId(), ".gif" );
	}

	// when calling duration - use seconds rather than msecs
	public function getDuration ()
	{
		$t = $this->getLengthInMsecs();
		if ( $t == null ) return 0;
		return ( $t / 1000 );
	}

	public function getMetadata( $version = null)
	{
		if ( $this->getMediaType() != entry::ENTRY_MEDIA_TYPE_SHOW )
		{
			return null;
		}

			// fetch content of file from disk - it should hold the XML
		$file_name = myContentStorage::getFSContentRootPath() . "/" . $this->getDataPath( $version );

		if ( file_exists( $file_name ) )
		{
			return file_get_contents( $file_name );
		}
		else
		{
			return  "<xml></xml>";
		}
	}


	// will place the metadata in the entry (as long as it's of type show)
	// TODO - maybe change this because entries can change their types - intro of type video can become a show !!
	// by default will override the existing file - this will be starnge because there is not supposed to be a file with that name yet -
	//  all the indexes up to this point where smaller then this futurae one.
/**
 	Writes the content of the metadata to a new file.
	Returns the number of bytes written to disk
 */
	// TODO - is this really what should be returned ??
	public function setMetadata ( $kshow , $content , $override_existing=true , $total_duration = null , $specific_version = null )
	{
		if ( $this->getMediaType() != entry::ENTRY_MEDIA_TYPE_SHOW )
		{
			return null;
		}

		// TODO - better to call this with slight modifications
		//myMetadataUtils::setMetadata ($content, $kshow, $this , $override_existing );
		if ( $specific_version == null )
		{
			// 	increment the counter of the file
			$this->setData ( parent::getData() );
		}
		// check that the file of the desired version really exists
		$content_dir =  myContentStorage::getFSContentRootPath();
		$file_name = $content_dir . $this->getDataPath( $specific_version );

		if ( $override_existing || ! file_exists( $file_name )  )
		{
			$duration = $total_duration ? $total_duration : myMetadataUtils::getDuration ( $content );
			$this->setLengthInMsecs ( $duration * 1000 );
			$total_duration = null;
			$editor_type = null;
			$version = myContentStorage::getVersion($file_name);
			$fixed_content = myFlvStreamer::fixMetadata( $content , $version, $total_duration , $editor_type);
			$res = kFile::setFileContent( $file_name , $fixed_content );
			
			$this->setModifiedAt(time());		// update the modified_at date
			$this->save();

			// update the roughcut_entry table
			if  ( $kshow != null ) $kshow_id = $kshow->getId();
			else $kshow_id = $this->getKshowId();

			$all_entries_for_roughcut = myMetadataUtils::getAllEntries ( $fixed_content );
			roughcutEntry::updateRoughcut( $this->getId() , $version , $kshow_id  , $all_entries_for_roughcut );

			return $res;
		}
		else
		{
			// no need to save changes - why increment the count if failed ??
			return  -1;
		}
	}

	public function fixMetadata ( $increment_version = true ,  $content = null , $total_duration = null , $specific_version = null )
	{
		// check that the file of the desired version really exists
		$content_dir =  myContentStorage::getFSContentRootPath();
		if ( !$content ) $content = $this->getMetadata( $specific_version );

		if ( $increment_version )
		{
			// 	increment the counter of the file
			$this->setData ( parent::getData() );
		}

		$file_name = $content_dir . $this->getDataPath( $specific_version );

		$duration = $total_duration ? $total_duration : myMetadataUtils::getDuration ( $content );
		$this->setLengthInMsecs ( $duration * 1000 );
		$total_duration = null;
		$editor_type = null;
		$version = myContentStorage::getVersion($file_name);
		$fixed_content = myFlvStreamer::fixMetadata( $content , $version, $total_duration , $editor_type);
		$res = kFile::setFileContent( $file_name , $fixed_content );
		$this->save();

		return $fixed_content;
	}

	public function getVersion()
	{
		$version = parent::getData();

		if ($version)
		{
			$c = strstr($version, '^') ?  '^' : '&';
			$parts = explode( $c, $version);
		}
		else
			$parts = array('');


		if (strlen($parts[0]))
			$current_version = pathinfo($parts[0], PATHINFO_FILENAME) ;
		else
			$current_version = 0;

		return $current_version;
	}

	public function getThumbnailVersion()
	{
		$version = parent::getThumbnail();

		if ($version)
		{
			$c = strstr($version, '^') ?  '^' : '&';
			$parts = explode( $c, $version);
		}
		else
			$parts = array('');


		if (strlen($parts[0]))
			$current_version = pathinfo($parts[0], PATHINFO_FILENAME) ;
		else
			$current_version = 0;

		return $current_version;
	}	
	// makes a copy of the desired version from the past as the next coming version of the entry
	//   $desired_version = 100003, current_version = 100006 -> will conpy the content of <id>_100003.xxx -> <id>_1000007.xxx and will increment the version
	// so current_version = 100007.xxx now
	public function rollbackVersion( $desired_version )
	{
		// don't duplicate if staying in hte same version
		$current_version = $this->getVersion();
		if ( $desired_version ==  $current_version)
			return $current_version;

		// check that the file of the desired version really exists
		$content =  myContentStorage::getFSContentRootPath();
		$path = $content . $this->getDataPath( $desired_version );

		if ( ! file_exists( $path ))
		{
			return null;
		}

		// increment the counter of the file
		$this->setData ( parent::getData() );

		$new_path = $content . $this->getDataPath( );

		// make a copy
		kFile::moveFile( $path , $new_path , true , true );

		$this->save();
		// return the new version
		return $this->getVersion();
	}

	// if has status self::ENTRY_S
	public function getImportInfo ()
	{
		 if ( $this->getStatus() == self::ENTRY_STATUS_IMPORT )
		 {
		 	$c = new Criteria();
		 	$c->add ( BatchJobPeer::ENTRY_ID , $this->getId() );
		 	$c->addDescendingOrderByColumn(  BatchJobPeer::ID );
	 	  	$import =  BatchJobPeer::doSelectOne ( $c );
	 	  	return $import;
		 }
		 return  null;
	}


	public function getDisplayCredit ( )
	{
		if ($this->getCredit())
			return $this->getCredit();
		else if ( $this->getScreenName() )
		{
			return $this->getScreenName();
		}
		else
		{
			$kuser = $this->getkuser();
			if ( $kuser )
			{
				return $kuser->getScreenName();
			}
			else
			{
				return "";
			}
		}
	}

	public function moderate ($new_moderation_status , $fix_moderation_objects = false )
	{
		$error_msg = "Moderation status [$new_moderation_status] not supported by entry";
		switch($new_moderation_status)
		{
			case moderation::MODERATION_STATUS_APPROVED:
				if ( $this->getStatus() == self::ENTRY_STATUS_DELETED )
				{
					// TODO - return from the 'deleted'
					myEntryUtils::undeleteEntry( $this );
					// setting the entry status will be done in the deleteEntry function
					//$this->setStatusReady( );
				}
				else
				{
					// set the status to be ready as before
					$this->setStatus(self::ENTRY_STATUS_READY);
				}
				
				// a new notification that is sent when an entry was founc to be ok after moderation
				myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_UPDATE , $this );
				break;
			case moderation::MODERATION_STATUS_BLOCK:
				// physical disk deletion
				myEntryUtils::deleteEntry($this);
				// setting the entry status will be done in the deleteEntry function
//				$this->setStatus(self::ENTRY_STATUS_DELETED);
				myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_BLOCK , $this->getid());
				break;
			case moderation::MODERATION_STATUS_DELETE:
				// physical disk deletion
				myEntryUtils::deleteEntry($this);
				myNotificationMgr::createNotification(notification::NOTIFICATION_TYPE_ENTRY_BLOCK , $this->getid());
				break;
			case moderation::MODERATION_STATUS_PENDING:
//				$this->setStatus(self::ENTRY_STATUS_MODERATE);
//				throw new Exception($error_msg);
				break;
			case moderation::MODERATION_STATUS_REVIEW:
				// in this case the status of the entry should not change
//				throw new Exception($error_msg);
				break;
			default:
				throw new Exception($error_msg);
				break;
		}

		$this->setModerationStatus( $new_moderation_status );
		
		// TODO - fix loop of updating from entry ot moderation back to entry ...
		if ( $fix_moderation_objects ) 
		{
			myModerationMgr::updateModerationsForObject ( $this , $new_moderation_status );
		}
		$this->save();
	}

	public function setEditorType ( $editor_type )
	{
		$this->putInCustomData ( "editor_type" , $editor_type );
	}

	public function getEditorType (  )
	{
		if ( $this->getType() != self::ENTRY_TYPE_SHOW ) return null;
		$res = $this->getFromCustomData( "editor_type" );
		if ( $res == null ) return "Keditor"; // no value means Keditor == advanced
		return $res;
	}
	
	public function setModerate ( $should_moderate )
	{
		$this->putInCustomData ( "moderate" , $should_moderate );
	}

	public function getModerate (  )
	{
		return $this->getFromCustomData( "moderate" );
	}
	
	public function setConversionQuality ( $conversion_quality)
	{
		$this->putInCustomData ( "conversion_quality" , $conversion_quality );
	}

	public function getConversionQuality (  )
	{
		return $this->getFromCustomData( "conversion_quality" );
	}

	public function resetUpdateWhenReady ( )
	{
		$this->putInCustomData ( "current_kshow_version" , null );
	}

	public function setUpdateWhenReady ( $current_kshow_version )
	{
		$this->putInCustomData ( "current_kshow_version" , $current_kshow_version );
	}

	public function getUpdateWhenReady (  )
	{
		return $this->getFromCustomData( "current_kshow_version" );
	}

	// will be set if the entry has a real download path (
	public function setHasDownload ( $v )	{	$this->putInCustomData ( "hasDownload" , $v);	}
	public function getHasDownload (  )		{	return $this->getFromCustomData( "hasDownload" );	}
	

	public function setCount ( $v )	{	$this->putInCustomData ( "count" , $v );	}
	public function getCount (  )		{	return $this->getFromCustomData( "count" );	}

	public function setCountDate ( $v )	{	$this->putInCustomData ( "count_date" , $v );	}
	public function getCountDate (  )		{	return $this->getFromCustomData( "count_date" );	}
	
	// privacySettyings is an alias for permissions
	public function getPrivacySettings ()
	{
		return $this->getPermissions();
	}

	public function setPrivacySettings ( $v )
	{
		return $this->setPermissions( $v );
	}

	public function getHeight()
	{
		// return null if media_type is NOT image OR video
		if ( $this->getMediaType() != self::ENTRY_MEDIA_TYPE_IMAGE && $this->getMediaType() != self::ENTRY_MEDIA_TYPE_VIDEO ) return null;
		return $this->getFromCustomData( "height" );
	}

	public function getWidth()
	{
		// return null if media_type is NOT image OR video
		if ( $this->getMediaType() != self::ENTRY_MEDIA_TYPE_IMAGE && $this->getMediaType() != self::ENTRY_MEDIA_TYPE_VIDEO ) return null;
		return $this->getFromCustomData( "width" );
	}

	public  function setDimensions (  $width , $height )
	{
		$this->putInCustomData( "height" , $height );
		$this->putInCustomData( "width" , $width );
	}
	
	public function updateDimensions ( )
	{
		if ( $this->getMediaType() == self::ENTRY_MEDIA_TYPE_IMAGE)
			$this->updateImageDimensions();
		else if ($this->getMediaType() == self::ENTRY_MEDIA_TYPE_VIDEO )
			$this->updateVideoDimensions();
	}
	
	public function updateImageDimensions ( )
	{
		list ( $width , $height ) = $arr = myFileConverter::getImageDimensions( myContentStorage::getFSContentRootPath() . $this->getDataPath( ));
		if ( $width )
		{
			$this->putInCustomData( "height" , $height );
			$this->putInCustomData( "width" , $width );
		}
		return $arr;
	}
	
	public function updateVideoDimensions ( )
	{
		list ( $width , $height ) = $arr = myFileConverter::getVideoDimensions( myContentStorage::getFSContentRootPath() . $this->getDataPath( ));
		
		if ( $width )
		{
			$this->putInCustomData( "height" , $height );
			$this->putInCustomData( "width" , $width );
		}
		return $arr;
	}
	
	public function getDisplayScope()
	{
		if( $this->getDisplayInSearch() == 0 ) return "";
		if( $this->getDisplayInSearch() == 1 ) return "_PRIVATE_";
		if( $this->getDisplayInSearch() >= 2 ) return "_KN_";
	}
	
	public function incModerationCount()
	{
		$this->setModerationCount( $this->getModerationCount() + 1 );	
	}
	
	
	public function getPartner()
	{
		return PartnerPeer::retrieveByPK( $this->getPartnerId() );	
	}
	
	public function getPartnerLandingPage ()
	{
		if ( ! $this->getPartner() ) return null;
		$url = $this->getPartner()->getLandingPage();
		if ( $url )
		{
			if ( strpos ( $url , '{id}'  ) > 0 )
			{ 
				return str_replace( '{id}' , $this->getId() , $url );
			}
			else
				return $url . $this->getId();
//			return objectWrapperBase::parseString ( $url , $this );//
		}	
		else
		{ 
			return null;
		}
	}

	public function getUserLandingPage ()
	{
		if ( ! $this->getPartner() ) return null;
		$url = $this->getPartner()->getUserLandingPage();
		if ( $url )
		{
			if ( strpos ( $url , '{uid}'  ) > 0 ) 
			{
				return str_replace( '{uid}' , $this->getPuserId( true ) , $url );
			}
			else
				return $url . $this->getPuserId( true );
//		return objectWrapperBase::parseString ( $url , $this );//
		}	
		else
		{ 
			return null;
		}
	}
	
	public function getConversionProfile()
	{
		$conversion_profile = $this->getConversionQuality();
		if ( $conversion_profile )
		{
			return ConversionProfilePeer::retrieveByPK( $conversion_profile );
		}
		return null;
	}
	
	public function setSecurityPolicy ( $security_policy )
	{
		$this->putInCustomData ( "security_policy" , $security_policy );
	}

	public function getSecurityPolicy (  )
	{
		return $this->getFromCustomData( "security_policy" );
	}

	public function setStorageSize ( $storage_size )
	{
		$this->putInCustomData ( "storage_size" , $storage_size );
	}

	public function getStorageSize (  )
	{
		return $this->getFromCustomData( "storage_size" );
	}

	
//include ( "_customData.php" );
/**
 * This is a partial file - it does not stand alone !
 * It can be included as-is in a lass that has 
 */
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

	public function getCustomDataObj( )
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

	private $m_puser_id = null;
	public function tempSetPuserId ( $puser_id ) 
	{
		$this->m_puser_id = $puser_id;
	}
	public function getPuserId( $real_puser_id = false )
	{
		if (defined("KALTURA_API_V3"))
			return parent::getPuserId();
			
		// HACK for FootBo
		if ( !$real_puser_id && $this->getPartnerId() == 8304 )
		{
			return $this->getContributorScreenName();
		}		
		$puser_id = $this->getFromCustomData( "puserId" );
		if ( $this->m_puser_id ) // ! $puser_id )
		{
			return $this->m_puser_id;
		}
		else
		{
			if (  $this->getKuserId() )
			{
				$puser_id =	PuserKuserPeer::getPuserIdFromKuserId ( $this->getPartnerId(), $this->getKuserId() );
				$this->putInCustomData( "puserId" , $puser_id );
				$this->m_puser_id = $puser_id;
			}
		}
		return $puser_id;
	}

	public function getContributorScreenName()
	{
		// HACK fro FootBo
		if ($this->getPartnerId() != 8304 && $this->getCredit())
			return $this->getCredit();
		else
		{
			$kuser = $this->getkuser();
			if ( $kuser )
			{
				return $kuser->getScreenName();
			}
			else
			{
				return "";
			}
		}
	}

	// will return the user's screen name - not the credit even if exists
	public function getUserScreenName()
	{
		$kuser = $this->getkuser();
		if ( $kuser )
		{
			return $kuser->getScreenName();
		}
		else
		{
			return "";
		}
	}
		
	// this will make sure that the extra data set in the search_text won't leak out 
	public function getSearchText()
	{
		return mySearchUtils::removePartner( parent::getSearchText() );
	}

	public function getSearchTextRaw()
	{
		return parent::getSearchText();
	}
	
	public function dumpContent() 
	{
		$dataPath = myContentStorage::getFSContentRootPath() . $this->getDataPath();
		
		kFile::dumpFile($dataPath);
	}
	
	public function getTypeAsString()
	{
		$t = $this->getMediaType();
		if ( $t == self::ENTRY_MEDIA_TYPE_AUDIO ) return "audio";
		if ( $t == self::ENTRY_MEDIA_TYPE_VIDEO ) return "video";
		if ( $t == self::ENTRY_MEDIA_TYPE_IMAGE ) return "image";
		if ( $t == self::ENTRY_MEDIA_TYPE_SHOW ) return "roughcut";
		return "";
	}
	
	public function getFileSize()
	{
		$file = $this->getFullDataPath();
		if ( file_exists( $file )) return filesize( $file );
		return "";
	}
	 
	// ------------------------------------------------------------
	// setters & gettes for entry when callnig addentry
	private $m_url;
	public function getUrl() { return $this->m_url; }
	public function setUrl ( $v ) { $this->m_url = $v ;}

	private $m_thumb_url;
	public function getThumbUrl() { return $this->m_thumb_url; }
	public function setThumbUrl ( $v ) { $this->m_thumb_url = $v ;}
	
	private $m_filename;
	public function getFilename() { return $this->m_filename; }
	public function setFilename ( $v ) { $this->m_filename= $v ;}	

	private $m_realFilename;
	public function getRealFilename() { return $this->m_realFilename; }
	public function setRealFilename ( $v ) { $this->m_realFilename= $v ;}	
	
	private $m_mediaId;
	public function getMediaId() { return $this->m_mediaId; }
	public function setMediaId ( $v ) { $this->m_mediaId= $v ;}
	// ------------------------------------------------------------
	
	private $m_thumbOffset;
	public function getThumbOffset() { 	return 		$this->getFromCustomData ( "thumb_offset" ); }
	public function setThumbOffset ( $v ) { 	$this->putInCustomData ( "thumb_offset" , $v ); }

	public function getBestThumbOffset( $default_offset = 3 ) 
	{
		if ($default_offset === null)
			$default_offset = 3;
			
		$offset = $this->getThumbOffset();
		$duration = $this->getLengthInMsecs();
		
		if ( ! $offset || $offset < 0 ) { $res = min ( $default_offset , $duration ); }
		else {
			// the is an offset
			$res = min ( $this->getThumbOffset() , $this->getLengthInMsecs() ) ;
		}

		return max ( 0 ,$res );
	}
	
	public function getHasRealThumb()
	{
		$thumb = $this->getThumbnail();
		return myContentStorage::isTemplate( $thumb );
	}
	
	public function setKuserId($v)
	{
		parent::setKuserId($v);
		$kuser = kuserPeer::retrieveByPK($v);
		if ($kuser)
			$this->setPuserId($kuser->getPuserId());
	}
	
// ----------- Extra object connections ----------------	
	public function getNotifications()
	{
		return notificationPeer::retrieveByEntryId( $this->getId() );
	}
	
	public function getBatchJobs()
	{
		return BatchJobPeer::retrieveByEntryId( $this->getId() );
	}
	
	public function getRoughcutId()
	{
		$kshow = $this->getKshow();
		return $kshow ? $kshow->getShowEntryId() : null;
	}
	
	// get all related roughcuts where this entry appears
	public function getRoughcuts()
	{
		return roughcutEntry::getAllRoughcuts( $this->getId() );
	}
	
// ----------- Extra object connections ----------------
	
}
