package com.kaltura.commands.bulkUpload
{
	import com.kaltura.vo.File;
	import com.kaltura.delegates.bulkUpload.BulkUploadAddDelegate;
	import com.kaltura.net.KalturaCall;

	public class BulkUploadAdd extends KalturaCall
	{
		public var filterFields : String;
		public function BulkUploadAdd( conversionProfileId : int,csvFileData : file )
		{
			service= 'bulkUpload';
			action= 'add';
			applySchema(['conversionProfileId'] , conversionProfileId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BulkUploadAddDelegate( this , config );
		}
	}
}
