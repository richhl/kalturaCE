package com.kaltura.commands.playlist
{
	import com.kaltura.vo.KalturaPlaylist;
	import com.kaltura.delegates.playlist.PlaylistAddDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistAdd extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistAdd( playlist : KalturaPlaylist,updateStats : Boolean=false )
		{
			service= 'playlist';
			action= 'add';
			applySchema(['playlist:id','playlist:name','playlist:description','playlist:partnerId','playlist:userId','playlist:tags','playlist:adminTags','playlist:status','playlist:type','playlist:createdAt','playlist:rank','playlist:totalRank','playlist:votes','playlist:groupId','playlist:partnerData','playlist:downloadUrl','playlist:searchText','playlist:licenseType','playlist:version','playlist:playlistContent','playlist:playlistType','playlist:plays','playlist:views','playlist:duration','updateStats'] , playlist.id,playlist.name,playlist.description,playlist.partnerId,playlist.userId,playlist.tags,playlist.adminTags,playlist.status,playlist.type,playlist.createdAt,playlist.rank,playlist.totalRank,playlist.votes,playlist.groupId,playlist.partnerData,playlist.downloadUrl,playlist.searchText,playlist.licenseType,playlist.version,playlist.playlistContent,playlist.playlistType,playlist.plays,playlist.views,playlist.duration,updateStats);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistAddDelegate( this , config );
		}
	}
}
