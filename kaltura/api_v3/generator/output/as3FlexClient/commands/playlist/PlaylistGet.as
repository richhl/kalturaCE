package com.kaltura.commands.playlist
{
	import com.kaltura.delegates.playlist.PlaylistGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistGet extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistGet( id : String,version : int=-1 )
		{
			service= 'playlist';
			action= 'get';
			applySchema(['id','version'] , id,version);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistGetDelegate( this , config );
		}
	}
}
