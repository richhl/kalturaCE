<?php
/**
 * Playlist service lets you create,manage and play your playlists
 * Playlists could be static (containing a fixed list of entries) or dynamic (baseed on a filter)
 *
 * @service playlist
 *
 * @package api
 * @subpackage services
 */
class PlaylistService extends KalturaBaseService
{
	/**
	 * Add new playlist
	 * Note that all entries used in a playlist will become public and may appear in KalturaNetwork
	 * 
	 * @action add
	 * @param KalturaPlaylist $playlist 
	 * @param bool $updateStats 
	 * @return KalturaPlaylist
	 */
	function addAction( KalturaPlaylist $playlist , $updateStats = false)
	{
		$dbPlaylist = $playlist->toPlaylist();
		
		$dbPlaylist->setPartnerId ( $this->getPartnerId() );
		$dbPlaylist->setStatus ( entry::ENTRY_STATUS_READY );
		$dbPlaylist->setKshowId ( null ); // this is brave !!
//		$playlist->setKuserId ( $this->getUser() );		// TODO
		$dbPlaylist->setType ( entry::ENTRY_TYPE_PLAYLIST );
		
		myPlaylistUtils::validatePlaylist( $dbPlaylist );
		
		$dbPlaylist->save();
		
		if ( $updateStats ) 
			myPlaylistUtils::updatePlaylistStatistics( $dbPlaylist->getPartnerId() , $dbPlaylist );
		$dbPlaylist->setDisplayInSearch ( 2 ); // make all the playlist entries PUBLIC !
		
		$playlist = new KalturaPlaylist(); // start from blank
		$playlist->fromPlaylist( $dbPlaylist );
		
		return $playlist;
	}
	

	/**
	 * Retrieve a playlist
	 * 
	 * @action get
	 * @param string $id 
	 * @return KalturaPlaylist
	 *
	 * @throws APIErrors::INVALID_ENTRY_ID
	 * @throws APIErrors::INVALID_PLAYLIST_TYPE
	 */
	function getAction( $id )
	{
		$dbPlaylist = entryPeer::retrieveByPK( $id );
		
		if ( ! $dbPlaylist )
			throw new KalturaAPIException ( APIErrors::INVALID_ENTRY_ID , "Playlist" , $id  );
		if ( $dbPlaylist->getType() != entry::ENTRY_TYPE_PLAYLIST )
			throw new KalturaAPIException ( APIErrors::INVALID_PLAYLIST_TYPE );
		$playlist = new KalturaPlaylist(); // start from blank
		$playlist->fromPlaylist( $dbPlaylist );
		
		return $playlist;
	}
		
	/**
	 * Update existing playlist
	 * Note - you cannot change playlist type. updated playlist must be of the same type.
	 * 
	 * @action update
	 * @param string $id 
	 * @param KalturaPlaylist $playlist
	 * @param bool $updateStats  
	 * @return KalturaUiConf
	 *
	 * @throws APIErrors::INVALID_ENTRY_ID
	 * @throws APIErrors::INVALID_PLAYLIST_TYPE
	 */	
	function updateAction( $id , KalturaPlaylist $playlist , $updateStats = false )
	{
		$dbPlaylist = entryPeer::retrieveByPK( $id );
		
		if ( ! $dbPlaylist )
			throw new KalturaAPIException ( APIErrors::INVALID_ENTRY_ID , "Playlist" , $id  );
		if ( $dbPlaylist->getType() != entry::ENTRY_TYPE_PLAYLIST )
			throw new KalturaAPIException ( APIErrors::INVALID_PLAYLIST_TYPE );
		
		$playlistUpdate = $playlist->toPlaylist();

		$allowEmpty = true ; // TODO - what is the policy  ? 
		if ( $playlistUpdate->getMediaType() && ($playlistUpdate->getMediaType() != $dbPlaylist->getMediaType() ) )
		{
			throw new KalturaAPIException ( APIErrors::INVALID_PLAYLIST_TYPE );
		}
		else
		{
			$playlistUpdate->setMediaType( $dbPlaylist->getMediaType() ); // incase  $playlistUpdate->getMediaType() was empty
		}

		// copy properties from the playlistUpdate to the $dbPlaylist
		baseObjectUtils::autoFillObjectFromObject ( $playlistUpdate , $dbPlaylist , $allowEmpty );
		// after filling the $dbPlaylist from  $playlist - make sure the data content is set properly
		if ( $playlistUpdate->getDataContent(true) ) $dbPlaylist->setDataContent ( $playlistUpdate->getDataContent(true)  );

		myPlaylistUtils::validatePlaylist( $dbPlaylist );
		
		if ( $updateStats )
			myPlaylistUtils::updatePlaylistStatistics ( $this->getPartnerId() , $dbPlaylist );//, $extra_filters , $detailed );
		
		$dbPlaylist->save();
		$playlist->fromPlaylist( $dbPlaylist );
		
		return $playlist;
	}	
		

	/**
	 * Delete existing playlist
	 * 
	 * @action delete
	 * @param string $id 
	 * @return KalturaPlaylist
	 *
	 * @throws APIErrors::INVALID_ENTRY_ID
	 * @throws APIErrors::INVALID_PLAYLIST_TYPE
	 */		
	function deleteAction(  $id )
	{
		$dbPlaylist = entryPeer::retrieveByPK( $id );
		
		if ( ! $dbPlaylist )
			throw new KalturaAPIException ( APIErrors::INVALID_ENTRY_ID , "Playlist" , $id  );
		if ( $dbPlaylist->getType() != entry::ENTRY_TYPE_PLAYLIST )
			throw new KalturaAPIException ( APIErrors::INVALID_PLAYLIST_TYPE );
					
		myEntryUtils::deleteEntry( $dbPlaylist );
		$dbPlaylist->setStatus ( entry::ENTRY_STATUS_DELETED );
		// make sure the moderation_status is set to moderation::MODERATION_STATUS_DELETE
		$dbPlaylist->setModerationStatus ( moderation::MODERATION_STATUS_DELETE ); 
		$dbPlaylist->setModifiedAt( time() ) ;

		$dbPlaylist->save();
		myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_DELETE , $dbPlaylist );

		$playlist = new KalturaPlaylist(); // start from blank
		$playlist->fromPlaylist( $dbPlaylist );
		
		return $playlist;		
	}	
	
	/**
	 * List available playlists
	 * 
	 * @action list
	 * @param KalturaPlaylistFilter // TODO 
	 * @param KalturaFilterPager $pager
	 * @return KalturaMediaEntries
	 */
	function listAction( KalturaPlaylistFilter $filter=null, KalturaFilterPager $pager=null )
	{
		if (!$filter)
			$filter = new KalturaUiConfFilter;
		
		$entryFilter = new entryFilter( );
		$entryFilter->setPartnerSearchScope( baseObjectFilter::MATCH_KALTURA_NETWORK_AND_PRIVATE );
		
		$filter->toObject( $entryFilter );
		
		$c = new Criteria();
		$entryFilter->attachToCriteria( $c );

		$c->addAnd ( entryPeer::TYPE , entry::ENTRY_TYPE_PLAYLIST );
//		$c->addAnd ( entryPeer::STATUS , entry::ENTRY_STATUS_READY );

		if ( $pager ) $pager->attachToCriteria( $c );
		
		$list = entryPeer::doSelectJoinKuser( $c );
		
		$newList = KalturaPlaylistArray::fromPlaylistArray( $list );
		
		return $newList;		
	}
	
	/**
	 * Retrieve playlist for playing purpose
	 * 
	 * @action execute
	 * @param string $id 
	 * @param__  KalturaPlaylistFilterArray // TODO 
	 * @param string $detailed
	 * @return KalturaMediaEntries
	 */
	function executeAction( $id , $detailed = false )
	{
		$extraFilters = array();
		$entryList= myPlaylistUtils::executePlaylistById( $this->getPartnerId() , $id , $extraFilters , $detailed );
		myEntryUtils::updatePuserIdsForEntries ( $entryList );
		
		return KalturaMediaEntries::fromEntryArray( $entryList );		
	}

	/**
	 * Revrieve playlist for playing purpose, based on content
	 * 
	 * @action executeFromContent
	 * @param KalturaPlaylistType $playlistType  
	 * @param int $playlistType* 
	 * @param string $playlistContent
	 * @param__  KalturaPlaylistFilterArray // TODO 
	 * @param string $detailed
	 * @return KalturaMediaEntries
	 */
	//function executeFromContentAction( KalturaPlaylistType $playlistType , $playlistContent , $detailed = false )
	function executeFromContentAction( $playlistType , $playlistContent , $detailed = false )
	{
		$extraFilters = null;
		$dbPlaylist = new entry();
		$dbPlaylist->setId( -1 ); 
		$dbPlaylist->setType ( entry::ENTRY_TYPE_PLAYLIST );
		$dbPlaylist->setMediaType( $playlistType );
		$dbPlaylist->setDataContent( $playlistContent );
		
		$entryList = myPlaylistUtils::executePlaylist ( $this->getPartnerId() , $dbPlaylist );//, $extraFilters , $detailed );
		myEntryUtils::updatePuserIdsForEntries ( $entryList );
		
		return KalturaMediaEntries::fromEntryArray( $entryList );		
	}
	
	
	/**
	 * Retrieve playlist statistics
	 * 
	 * @action getStatsFromContent
	 * @param KalturaPlaylistType $playlistType  
	 * @param int $playlistType* 
	 * @param string $playlistContent
	 * @param__  KalturaPlaylistFilterArray // TODO 
	 * @param string $detailed
	 * @return KalturaMediaEntries
	 */
	function getStatsFromContentAction( $playlistType , $playlistContent )
	{
		$dbPlaylist = new entry();
		$dbPlaylist->setId( -1 ); // set with some dummy number so the getDataContent will later work properly 
		$dbPlaylist->setType ( entry::ENTRY_TYPE_PLAYLIST ); // prepare the playlist type before filling from request
		$dbPlaylist->setMediaType ( $playlistType );
		$dbPlaylist->setDataContent( $playlistContent );
				
		myPlaylistUtils::updatePlaylistStatistics ( $this->getPartnerId() , $dbPlaylist );//, $extra_filters , $detailed );
		
		$playlist = new KalturaPlaylist(); // start from blank
		$playlist->fromPlaylist( $dbPlaylist );
		
		return $playlist;
	}
	

}