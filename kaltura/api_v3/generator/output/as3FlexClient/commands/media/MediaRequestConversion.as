package com.kaltura.commands.media
{
	import com.kaltura.delegates.media.MediaRequestConversionDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaRequestConversion extends KalturaCall
	{
		public var filterFields : String;
		public function MediaRequestConversion( entryId : String,fileFormat : String )
		{
			service= 'media';
			action= 'requestConversion';
			applySchema(['entryId','fileFormat'] , entryId,fileFormat);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaRequestConversionDelegate( this , config );
		}
	}
}
