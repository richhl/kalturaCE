package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchFreeExclusiveImportJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchFreeExclusiveImportJob extends KalturaCall
	{
		public function BatchFreeExclusiveImportJob( id : int,processorLocation : String,pocessorName : String )
		{
			service= 'batch';
			action= 'freeExclusiveImportJob';
			applySchema(['id','processorLocation','pocessorName'] , id,processorLocation,pocessorName);
		}

		override public function execute() : void
		{
			delegate = new BatchFreeExclusiveImportJobDelegate( this , config );
		}
	}
}
