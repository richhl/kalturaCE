package com.kaltura.commands.batch
{
	import com.kaltura.vo.KalturaNotification;
	import com.kaltura.delegates.batch.BatchCreateNotificationDelegate;
	import com.kaltura.net.KalturaCall;

	public class BatchCreateNotification extends KalturaCall
	{
		public function BatchCreateNotification( notificationJob : KalturaNotification )
		{
			service= 'batch';
			action= 'createNotification';
			applySchema(['notificationJob:id','notificationJob:partnerId','notificationJob:createdAt','notificationJob:updatedAt','notificationJob:processorName','notificationJob:processorLocation','notificationJob:processorExpiration','notificationJob:puserId','notificationJob:type','notificationJob:objectId','notificationJob:status','notificationJob:notificationData','notificationJob:numberOfAttempts','notificationJob:notificationResult','notificationJob:objectType'] , notificationJob.id,notificationJob.partnerId,notificationJob.createdAt,notificationJob.updatedAt,notificationJob.processorName,notificationJob.processorLocation,notificationJob.processorExpiration,notificationJob.puserId,notificationJob.type,notificationJob.objectId,notificationJob.status,notificationJob.notificationData,notificationJob.numberOfAttempts,notificationJob.notificationResult,notificationJob.objectType);
		}

		override public function execute() : void
		{
			delegate = new BatchCreateNotificationDelegate( this , config );
		}
	}
}
