package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaMailJob;
	import com.kaltura.delegates.batch.BatchAddMailJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchAddMailJob extends KalturaCall
	{
		public function BatchAddMailJob( mailJob : KalturaMailJob )
		{
			service= 'batch';
			action= 'addMailJob';
			applySchema(['mailJob:id','mailJob:partnerId','mailJob:createdAt','mailJob:updatedAt','mailJob:processorName','mailJob:processorLocation','mailJob:processorExpiration','mailJob:mailType','mailJob:mailPriority','mailJob:status','mailJob:recipientName','mailJob:recipientEmail','mailJob:recipientId','mailJob:fromName','mailJob:fromEmail','mailJob:bodyParams','mailJob:subjectParams','mailJob:templatePath','mailJob:culture','mailJob:campaignId','mailJob:minSendDate'] , mailJob.id,mailJob.partnerId,mailJob.createdAt,mailJob.updatedAt,mailJob.processorName,mailJob.processorLocation,mailJob.processorExpiration,mailJob.mailType,mailJob.mailPriority,mailJob.status,mailJob.recipientName,mailJob.recipientEmail,mailJob.recipientId,mailJob.fromName,mailJob.fromEmail,mailJob.bodyParams,mailJob.subjectParams,mailJob.templatePath,mailJob.culture,mailJob.campaignId,mailJob.minSendDate);
		}

		override public function execute() : void
		{
			delegate = new BatchAddMailJobDelegate( this , config );
		}
	}
}
