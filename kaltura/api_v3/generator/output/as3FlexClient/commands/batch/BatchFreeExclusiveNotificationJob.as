package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaNotification;
	import com.kaltura.delegates.batch.BatchFreeExclusiveNotificationJobDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchFreeExclusiveNotificationJob extends KalturaCall
	{
		public function BatchFreeExclusiveNotificationJob( id : int,processorLocation : String,pocessorName : String,notificationJob : KalturaNotification=null )
		{
			if(notificationJob== null)notificationJob= new KalturaNotification();
			service= 'batch';
			action= 'freeExclusiveNotificationJob';
			applySchema(['id','processorLocation','pocessorName','notificationJob:id','notificationJob:partnerId','notificationJob:createdAt','notificationJob:updatedAt','notificationJob:processorName','notificationJob:processorLocation','notificationJob:processorExpiration','notificationJob:puserId','notificationJob:type','notificationJob:objectId','notificationJob:status','notificationJob:notificationData','notificationJob:numberOfAttempts','notificationJob:notificationResult','notificationJob:objectType'] , id,processorLocation,pocessorName,notificationJob.id,notificationJob.partnerId,notificationJob.createdAt,notificationJob.updatedAt,notificationJob.processorName,notificationJob.processorLocation,notificationJob.processorExpiration,notificationJob.puserId,notificationJob.type,notificationJob.objectId,notificationJob.status,notificationJob.notificationData,notificationJob.numberOfAttempts,notificationJob.notificationResult,notificationJob.objectType);
		}

		override public function execute() : void
		{
			delegate = new BatchFreeExclusiveNotificationJobDelegate( this , config );
		}
	}
}
