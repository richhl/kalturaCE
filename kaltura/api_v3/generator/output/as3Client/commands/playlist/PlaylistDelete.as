package com.kaltura.commands.playlist
{
	import com.kaltura.delegates.playlist.PlaylistDeleteDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistDelete extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistDelete( id : String )
		{
			service= 'playlist';
			action= 'delete';
			applySchema(['id'] , id);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistDeleteDelegate( this , config );
		}
	}
}
