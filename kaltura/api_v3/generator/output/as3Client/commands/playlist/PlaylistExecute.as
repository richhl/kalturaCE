package com.kaltura.commands.playlist
{
	import com.kaltura.delegates.playlist.PlaylistExecuteDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistExecute extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistExecute( id : String,detailed : String='' )
		{
			service= 'playlist';
			action= 'execute';
			applySchema(['id','detailed'] , id,detailed);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistExecuteDelegate( this , config );
		}
	}
}
