package com.kaltura.commands.adminUser
{
	import com.kaltura.delegates.adminUser.AdminUserUpdatepasswordDelegate;
	import com.kaltura.net.KalturaCall;

	public class AdminUserUpdatepassword extends KalturaCall
	{
		public var filterFields : String;
		public function AdminUserUpdatepassword( email : String,password : String,newEmail : String='',newPassword : String='' )
		{
			service= 'adminUser';
			action= 'updatepassword';
			applySchema(['email','password','newEmail','newPassword'] , email,password,newEmail,newPassword);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new AdminUserUpdatepasswordDelegate( this , config );
		}
	}
}
