package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaBatchJob;
	import com.kaltura.delegates.batch.BatchAddImportJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchAddImportJob extends KalturaCall
	{
		public function BatchAddImportJob( importJob : KalturaBatchJob )
		{
			service= 'batch';
			action= 'addImportJob';
			applySchema(['importJob:id','importJob:partnerId','importJob:createdAt','importJob:updatedAt','importJob:processorName','importJob:processorLocation','importJob:processorExpiration','importJob:entryId','importJob:jobType','importJob:data','importJob:status','importJob:abort','importJob:checkAgainTimeout','importJob:progress','importJob:message','importJob:description','importJob:updatesCount','importJob:parentJobId'] , importJob.id,importJob.partnerId,importJob.createdAt,importJob.updatedAt,importJob.processorName,importJob.processorLocation,importJob.processorExpiration,importJob.entryId,importJob.jobType,importJob.data,importJob.status,importJob.abort,importJob.checkAgainTimeout,importJob.progress,importJob.message,importJob.description,importJob.updatesCount,importJob.parentJobId);
		}

		override public function execute() : void
		{
			delegate = new BatchAddImportJobDelegate( this , config );
		}
	}
}
