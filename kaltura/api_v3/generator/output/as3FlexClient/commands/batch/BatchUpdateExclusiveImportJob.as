package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaBatchJob;
	import com.kaltura.delegates.batch.BatchUpdateExclusiveImportJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchUpdateExclusiveImportJob extends KalturaCall
	{
		public function BatchUpdateExclusiveImportJob( id : int,processorLocation : String,pocessorName : String,importJob : KalturaBatchJob,entryStatus : int=undefined )
		{
			service= 'batch';
			action= 'updateExclusiveImportJob';
			applySchema(['id','processorLocation','pocessorName','importJob:id','importJob:partnerId','importJob:createdAt','importJob:updatedAt','importJob:processorName','importJob:processorLocation','importJob:processorExpiration','importJob:entryId','importJob:jobType','importJob:data','importJob:status','importJob:abort','importJob:checkAgainTimeout','importJob:progress','importJob:message','importJob:description','importJob:updatesCount','importJob:parentJobId','entryStatus'] , id,processorLocation,pocessorName,importJob.id,importJob.partnerId,importJob.createdAt,importJob.updatedAt,importJob.processorName,importJob.processorLocation,importJob.processorExpiration,importJob.entryId,importJob.jobType,importJob.data,importJob.status,importJob.abort,importJob.checkAgainTimeout,importJob.progress,importJob.message,importJob.description,importJob.updatesCount,importJob.parentJobId,entryStatus);
		}

		override public function execute() : void
		{
			delegate = new BatchUpdateExclusiveImportJobDelegate( this , config );
		}
	}
}
