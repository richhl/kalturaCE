package com.kaltura.commands.media
{
	import com.kaltura.delegates.media.MediaDeleteDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaDelete extends KalturaCall
	{
		public var filterFields : String;
		public function MediaDelete( entryId : String )
		{
			service= 'media';
			action= 'delete';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaDeleteDelegate( this , config );
		}
	}
}
