package com.kaltura.commands.media
{
	import com.kaltura.delegates.media.MediaRejectDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaReject extends KalturaCall
	{
		public var filterFields : String;
		public function MediaReject( entryId : String )
		{
			service= 'media';
			action= 'reject';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaRejectDelegate( this , config );
		}
	}
}
