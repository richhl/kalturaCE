package com.kaltura.commands.bulkUpload
{
	import com.kaltura.delegates.bulkUpload.BulkUploadGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class BulkUploadGet extends KalturaCall
	{
		public var filterFields : String;
		public function BulkUploadGet( id : int )
		{
			service= 'bulkUpload';
			action= 'get';
			applySchema(['id'] , id);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BulkUploadGetDelegate( this , config );
		}
	}
}
