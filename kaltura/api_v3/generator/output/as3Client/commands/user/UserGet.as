package com.kaltura.commands.user
{
	import com.kaltura.delegates.user.UserGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class UserGet extends KalturaCall
	{
		public var filterFields : String;
		public function UserGet( userId : String )
		{
			service= 'user';
			action= 'get';
			applySchema(['userId'] , userId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UserGetDelegate( this , config );
		}
	}
}
