package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaBatchJob;
	import com.kaltura.delegates.batch.BatchUpdateExclusivePreConvertJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchUpdateExclusivePreConvertJob extends KalturaCall
	{
		public function BatchUpdateExclusivePreConvertJob( id : int,processorLocation : String,pocessorName : String,preConvertJob : KalturaBatchJob,entryStatus : int=undefined )
		{
			service= 'batch';
			action= 'updateExclusivePreConvertJob';
			applySchema(['id','processorLocation','pocessorName','preConvertJob:id','preConvertJob:partnerId','preConvertJob:createdAt','preConvertJob:updatedAt','preConvertJob:processorName','preConvertJob:processorLocation','preConvertJob:processorExpiration','preConvertJob:entryId','preConvertJob:jobType','preConvertJob:data','preConvertJob:status','preConvertJob:abort','preConvertJob:checkAgainTimeout','preConvertJob:progress','preConvertJob:message','preConvertJob:description','preConvertJob:updatesCount','preConvertJob:parentJobId','entryStatus'] , id,processorLocation,pocessorName,preConvertJob.id,preConvertJob.partnerId,preConvertJob.createdAt,preConvertJob.updatedAt,preConvertJob.processorName,preConvertJob.processorLocation,preConvertJob.processorExpiration,preConvertJob.entryId,preConvertJob.jobType,preConvertJob.data,preConvertJob.status,preConvertJob.abort,preConvertJob.checkAgainTimeout,preConvertJob.progress,preConvertJob.message,preConvertJob.description,preConvertJob.updatesCount,preConvertJob.parentJobId,entryStatus);
		}

		override public function execute() : void
		{
			delegate = new BatchUpdateExclusivePreConvertJobDelegate( this , config );
		}
	}
}
