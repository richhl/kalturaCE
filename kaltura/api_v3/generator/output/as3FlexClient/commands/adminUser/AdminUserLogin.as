package com.kaltura.commands.adminUser
{
	import com.kaltura.delegates.adminUser.AdminUserLoginDelegate;
	import com.kaltura.net.KalturaCall;

	public class AdminUserLogin extends KalturaCall
	{
		public var filterFields : String;
		public function AdminUserLogin( email : String,password : String )
		{
			service= 'adminUser';
			action= 'login';
			applySchema(['email','password'] , email,password);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new AdminUserLoginDelegate( this , config );
		}
	}
}
