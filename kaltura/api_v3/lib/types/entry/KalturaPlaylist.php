<?php 

class KalturaPlaylist extends KalturaBaseEntry
{
	/**
	 * Content of the playlist - 
	 * 	XML if the playlistType is dynamic 
	 *  text if the playlistType is static 
	 *  url if the playlistType is mRss 
	 * @var string
	 */
	public $playlistContent;
	
	/**
	 * Type of playlist  
	 * @var KalturaPlaylistType
	 */	
	public $playlistType;

	/**
	 * Number of plays
	 * @var int
	 * @readonly
	 */
	public $plays;
	
	/**
	 * Number of views
	 * @var int
	 * @readonly
	 */
	public $views;
	
	/**
	 * The duration in seconds
	 * @var int
	 * @readonly
	 */
	public $duration;

	/**
	 * The version of the file
	 * @var string
	 * @readonly
	 */
	public $version;
	
	/**
	 * The url for this playlist
	 * @var string
	 * @readonly
	 */
	private $executeUrl;
	
	private static $map_between_objects = array
	(
		"playlistType" => "mediaType" ,
		"playlistContent" => "dataContent" ,	// MUST APPEAR after THE playlistType	 
	 	"plays" , 
	 	"views" , 
	 	"duration" ,
		"version" ,
	);

	public function getMapBetweenObjects ( )
	{
		return array_merge ( parent::getMapBetweenObjects() , self::$map_between_objects );
	}	
	
	public function toPlaylist()
	{
		$playlist = new entry();
		$playlist->setType ( entry::ENTRY_TYPE_PLAYLIST );
		parent::toObject( $playlist )	;
		$playlist->setType ( entry::ENTRY_TYPE_PLAYLIST );
		$playlist->setDataContent( $this->playlistContent );
		return $playlist;
	}
	
	public function fromPlaylist ( entry  $playlist )
	{
		parent::fromObject( $playlist );
		$host = requestUtils::getHost();
		$this->executeUrl = myPlaylistUtils::toPlaylistUrl( $playlist , $host );
	}
	
}