package com.kaltura.commands.media
{
	import com.kaltura.delegates.media.MediaApproveDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaApprove extends KalturaCall
	{
		public var filterFields : String;
		public function MediaApprove( entryId : String )
		{
			service= 'media';
			action= 'approve';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaApproveDelegate( this , config );
		}
	}
}
