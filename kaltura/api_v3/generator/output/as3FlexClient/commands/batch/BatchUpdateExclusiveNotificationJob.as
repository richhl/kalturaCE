package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaNotification;
	import com.kaltura.delegates.batch.BatchUpdateExclusiveNotificationJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchUpdateExclusiveNotificationJob extends KalturaCall
	{
		public function BatchUpdateExclusiveNotificationJob( id : int,processorLocation : String,pocessorName : String,notificationJob : KalturaNotification )
		{
			service= 'batch';
			action= 'updateExclusiveNotificationJob';
			applySchema(['id','processorLocation','pocessorName','notificationJob:id','notificationJob:partnerId','notificationJob:createdAt','notificationJob:updatedAt','notificationJob:processorName','notificationJob:processorLocation','notificationJob:processorExpiration','notificationJob:puserId','notificationJob:type','notificationJob:objectId','notificationJob:status','notificationJob:notificationData','notificationJob:numberOfAttempts','notificationJob:notificationResult','notificationJob:objectType'] , id,processorLocation,pocessorName,notificationJob.id,notificationJob.partnerId,notificationJob.createdAt,notificationJob.updatedAt,notificationJob.processorName,notificationJob.processorLocation,notificationJob.processorExpiration,notificationJob.puserId,notificationJob.type,notificationJob.objectId,notificationJob.status,notificationJob.notificationData,notificationJob.numberOfAttempts,notificationJob.notificationResult,notificationJob.objectType);
		}

		override public function execute() : void
		{
			delegate = new BatchUpdateExclusiveNotificationJobDelegate( this , config );
		}
	}
}
