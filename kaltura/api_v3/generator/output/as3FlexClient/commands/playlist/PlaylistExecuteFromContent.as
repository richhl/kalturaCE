package com.kaltura.commands.playlist
{
	import com.kaltura.delegates.playlist.PlaylistExecuteFromContentDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistExecuteFromContent extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistExecuteFromContent( playlistType : int,playlistContent : String,detailed : String='' )
		{
			service= 'playlist';
			action= 'executeFromContent';
			applySchema(['playlistType','playlistContent','detailed'] , playlistType,playlistContent,detailed);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistExecuteFromContentDelegate( this , config );
		}
	}
}
