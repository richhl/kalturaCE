package com.kaltura.commands.session
{
	import com.kaltura.delegates.session.SessionStartWidgetSessionDelegate;
	import com.kaltura.net.KalturaCall;

	public class SessionStartWidgetSession extends KalturaCall
	{
		public var filterFields : String;
		public function SessionStartWidgetSession( widgetId : String,expiry : int=86400 )
		{
			service= 'session';
			action= 'startWidgetSession';
			applySchema(['widgetId','expiry'] , widgetId,expiry);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new SessionStartWidgetSessionDelegate( this , config );
		}
	}
}
