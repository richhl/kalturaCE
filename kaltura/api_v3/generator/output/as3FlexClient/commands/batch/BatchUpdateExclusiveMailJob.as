package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaMailJob;
	import com.kaltura.delegates.batch.BatchUpdateExclusiveMailJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchUpdateExclusiveMailJob extends KalturaCall
	{
		public function BatchUpdateExclusiveMailJob( id : int,processorLocation : String,pocessorName : String,mailJob : KalturaMailJob )
		{
			service= 'batch';
			action= 'updateExclusiveMailJob';
			applySchema(['id','processorLocation','pocessorName','mailJob:id','mailJob:partnerId','mailJob:createdAt','mailJob:updatedAt','mailJob:processorName','mailJob:processorLocation','mailJob:processorExpiration','mailJob:mailType','mailJob:mailPriority','mailJob:status','mailJob:recipientName','mailJob:recipientEmail','mailJob:recipientId','mailJob:fromName','mailJob:fromEmail','mailJob:bodyParams','mailJob:subjectParams','mailJob:templatePath','mailJob:culture','mailJob:campaignId','mailJob:minSendDate'] , id,processorLocation,pocessorName,mailJob.id,mailJob.partnerId,mailJob.createdAt,mailJob.updatedAt,mailJob.processorName,mailJob.processorLocation,mailJob.processorExpiration,mailJob.mailType,mailJob.mailPriority,mailJob.status,mailJob.recipientName,mailJob.recipientEmail,mailJob.recipientId,mailJob.fromName,mailJob.fromEmail,mailJob.bodyParams,mailJob.subjectParams,mailJob.templatePath,mailJob.culture,mailJob.campaignId,mailJob.minSendDate);
		}

		override public function execute() : void
		{
			delegate = new BatchUpdateExclusiveMailJobDelegate( this , config );
		}
	}
}
