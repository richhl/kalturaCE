package com.kaltura.commands.batch
{
	import com.kaltura.delegates.batch.BatchGetExclusiveNotificationJobsDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchGetExclusiveNotificationJobs extends KalturaCall
	{
		public function BatchGetExclusiveNotificationJobs( processorLocation : String,pocessorName : String,maxExecutionTime : int,numberOfJobs : int,partnerGroups : String )
		{
			service= 'batch';
			action= 'getExclusiveNotificationJobs';
			applySchema(['processorLocation','pocessorName','maxExecutionTime','numberOfJobs','partnerGroups'] , processorLocation,pocessorName,maxExecutionTime,numberOfJobs,partnerGroups);
		}

		override public function execute() : void
		{
			delegate = new BatchGetExclusiveNotificationJobsDelegate( this , config );
		}
	}
}
