package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchGetExclusivePreConvertJobsDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchGetExclusivePreConvertJobs extends KalturaCall
	{
		public function BatchGetExclusivePreConvertJobs( processorLocation : String,pocessorName : String,maxExecutionTime : int,numberOfJobs : int,partnerGroups : String )
		{
			service= 'batch';
			action= 'getExclusivePreConvertJobs';
			applySchema(['processorLocation','pocessorName','maxExecutionTime','numberOfJobs','partnerGroups'] , processorLocation,pocessorName,maxExecutionTime,numberOfJobs,partnerGroups);
		}

		override public function execute() : void
		{
			delegate = new BatchGetExclusivePreConvertJobsDelegate( this , config );
		}
	}
}
