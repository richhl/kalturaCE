package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchGetExclusiveMailJobsDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchGetExclusiveMailJobs extends KalturaCall
	{
		public function BatchGetExclusiveMailJobs( processorLocation : String,pocessorName : String,maxExecutionTime : int,numberOfJobs : int,partnerGroups : String )
		{
			service= 'batch';
			action= 'getExclusiveMailJobs';
			applySchema(['processorLocation','pocessorName','maxExecutionTime','numberOfJobs','partnerGroups'] , processorLocation,pocessorName,maxExecutionTime,numberOfJobs,partnerGroups);
		}

		override public function execute() : void
		{
			delegate = new BatchGetExclusiveMailJobsDelegate( this , config );
		}
	}
}
