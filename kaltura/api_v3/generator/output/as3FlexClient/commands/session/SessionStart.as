package com.kaltura.commands.session
{
	import com.kaltura.delegates.session.SessionStartDelegate;
	import com.kaltura.net.KalturaCall;

	public class SessionStart extends KalturaCall
	{
		public var filterFields : String;
		public function SessionStart( secret : String,userId : String='',type : int=0,partnerId : int=-1,expiry : int=86400,privileges : String='' )
		{
			service= 'session';
			action= 'start';
			applySchema(['secret','userId','type','partnerId','expiry','privileges'] , secret,userId,type,partnerId,expiry,privileges);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new SessionStartDelegate( this , config );
		}
	}
}
