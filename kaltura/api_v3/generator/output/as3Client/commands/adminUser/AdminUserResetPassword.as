package com.kaltura.commands.adminUser
{
	import com.kaltura.delegates.adminUser.AdminUserResetPasswordDelegate;
	import com.kaltura.net.KalturaCall;

	public class AdminUserResetPassword extends KalturaCall
	{
		public var filterFields : String;
		public function AdminUserResetPassword( email : String )
		{
			service= 'adminUser';
			action= 'resetPassword';
			applySchema(['email'] , email);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new AdminUserResetPasswordDelegate( this , config );
		}
	}
}
