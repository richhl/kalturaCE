package com.kaltura.commands.user
{
	import com.kaltura.delegates.user.UserDeleteDelegate;
	import com.kaltura.net.KalturaCall;

	public class UserDelete extends KalturaCall
	{
		public var filterFields : String;
		public function UserDelete( userId : String )
		{
			service= 'user';
			action= 'delete';
			applySchema(['userId'] , userId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UserDeleteDelegate( this , config );
		}
	}
}
