package com.kaltura.commands.playlist
{
	import com.kaltura.delegates.playlist.PlaylistGetStatsFromContentDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistGetStatsFromContent extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistGetStatsFromContent( playlistType : int,playlistContent : String )
		{
			service= 'playlist';
			action= 'getStatsFromContent';
			applySchema(['playlistType','playlistContent'] , playlistType,playlistContent);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistGetStatsFromContentDelegate( this , config );
		}
	}
}
