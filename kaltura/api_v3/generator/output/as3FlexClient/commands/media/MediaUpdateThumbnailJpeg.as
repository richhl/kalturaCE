package com.kaltura.commands.media
{
	import com.kaltura.vo.File;
	import com.kaltura.delegates.media.MediaUpdateThumbnailJpegDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaUpdateThumbnailJpeg extends KalturaCall
	{
		public var filterFields : String;
		public function MediaUpdateThumbnailJpeg( entryId : String,fileData : file )
		{
			service= 'media';
			action= 'updateThumbnailJpeg';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaUpdateThumbnailJpegDelegate( this , config );
		}
	}
}
