package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaBatchJob;
	import com.kaltura.delegates.batch.BatchAddPreConvertJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchAddPreConvertJob extends KalturaCall
	{
		public function BatchAddPreConvertJob( preConvertJob : KalturaBatchJob )
		{
			service= 'batch';
			action= 'addPreConvertJob';
			applySchema(['preConvertJob:id','preConvertJob:partnerId','preConvertJob:createdAt','preConvertJob:updatedAt','preConvertJob:processorName','preConvertJob:processorLocation','preConvertJob:processorExpiration','preConvertJob:entryId','preConvertJob:jobType','preConvertJob:data','preConvertJob:status','preConvertJob:abort','preConvertJob:checkAgainTimeout','preConvertJob:progress','preConvertJob:message','preConvertJob:description','preConvertJob:updatesCount','preConvertJob:parentJobId'] , preConvertJob.id,preConvertJob.partnerId,preConvertJob.createdAt,preConvertJob.updatedAt,preConvertJob.processorName,preConvertJob.processorLocation,preConvertJob.processorExpiration,preConvertJob.entryId,preConvertJob.jobType,preConvertJob.data,preConvertJob.status,preConvertJob.abort,preConvertJob.checkAgainTimeout,preConvertJob.progress,preConvertJob.message,preConvertJob.description,preConvertJob.updatesCount,preConvertJob.parentJobId);
		}

		override public function execute() : void
		{
			delegate = new BatchAddPreConvertJobDelegate( this , config );
		}
	}
}
