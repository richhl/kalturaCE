package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchFreeExclusiveMailJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchFreeExclusiveMailJob extends KalturaCall
	{
		public function BatchFreeExclusiveMailJob( id : int,processorLocation : String,pocessorName : String )
		{
			service= 'batch';
			action= 'freeExclusiveMailJob';
			applySchema(['id','processorLocation','pocessorName'] , id,processorLocation,pocessorName);
		}

		override public function execute() : void
		{
			delegate = new BatchFreeExclusiveMailJobDelegate( this , config );
		}
	}
}
