package com.kaltura.commands.media
{
	import com.kaltura.delegates.media.MediaUpdateThumbnailDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaUpdateThumbnail extends KalturaCall
	{
		public var filterFields : String;
		public function MediaUpdateThumbnail( entryId : String,timeOffset : int )
		{
			service= 'media';
			action= 'updateThumbnail';
			applySchema(['entryId','timeOffset'] , entryId,timeOffset);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaUpdateThumbnailDelegate( this , config );
		}
	}
}
