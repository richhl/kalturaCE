package com.kaltura.commands.notification
{
	import com.kaltura.delegates.notification.NotificationGetClientNotificationDelegate;
	import com.kaltura.net.KalturaCall;

	public class NotificationGetClientNotification extends KalturaCall
	{
		public var filterFields : String;
		public function NotificationGetClientNotification( entryId : String,type : int )
		{
			service= 'notification';
			action= 'getClientNotification';
			applySchema(['entryId','type'] , entryId,type);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new NotificationGetClientNotificationDelegate( this , config );
		}
	}
}
