package com.kaltura.commands.media
{
	import com.kaltura.delegates.media.MediaGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaGet extends KalturaCall
	{
		public var filterFields : String;
		public function MediaGet( entryId : String,version : int=-1 )
		{
			service= 'media';
			action= 'get';
			applySchema(['entryId','version'] , entryId,version);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaGetDelegate( this , config );
		}
	}
}
