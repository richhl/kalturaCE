package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchGetExclusiveImportJobsDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchGetExclusiveImportJobs extends KalturaCall
	{
		public function BatchGetExclusiveImportJobs( processorLocation : String,pocessorName : String,maxExecutionTime : int,numberOfJobs : int,partnerGroups : String )
		{
			service= 'batch';
			action= 'getExclusiveImportJobs';
			applySchema(['processorLocation','pocessorName','maxExecutionTime','numberOfJobs','partnerGroups'] , processorLocation,pocessorName,maxExecutionTime,numberOfJobs,partnerGroups);
		}

		override public function execute() : void
		{
			delegate = new BatchGetExclusiveImportJobsDelegate( this , config );
		}
	}
}
