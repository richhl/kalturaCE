package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchFreeExclusivePreConvertJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchFreeExclusivePreConvertJob extends KalturaCall
	{
		public function BatchFreeExclusivePreConvertJob( id : int,processorLocation : String,pocessorName : String )
		{
			service= 'batch';
			action= 'freeExclusivePreConvertJob';
			applySchema(['id','processorLocation','pocessorName'] , id,processorLocation,pocessorName);
		}

		override public function execute() : void
		{
			delegate = new BatchFreeExclusivePreConvertJobDelegate( this , config );
		}
	}
}
