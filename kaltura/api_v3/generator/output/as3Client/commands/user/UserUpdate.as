package com.kaltura.commands.user
{
	import com.kaltura.vo.KalturaUser;
	import com.kaltura.delegates.user.UserUpdateDelegate;
	import com.kaltura.net.KalturaCall;

	public class UserUpdate extends KalturaCall
	{
		public var filterFields : String;
		public function UserUpdate( userId : String,user : KalturaUser )
		{
			service= 'user';
			action= 'update';
			applySchema(['userId','user:id','user:partnerId','user:screenName','user:fullName','user:email','user:dateOfBirth','user:country','user:state','user:city','user:zip','user:thumbnailUrl','user:description','user:tags','user:adminTags','user:gender','user:status','user:createdAt','user:updatedAt','user:partnerData','user:indexedPartnerDataInt','user:indexedPartnerDataString','user:storageSize'] , userId,user.id,user.partnerId,user.screenName,user.fullName,user.email,user.dateOfBirth,user.country,user.state,user.city,user.zip,user.thumbnailUrl,user.description,user.tags,user.adminTags,user.gender,user.status,user.createdAt,user.updatedAt,user.partnerData,user.indexedPartnerDataInt,user.indexedPartnerDataString,user.storageSize);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UserUpdateDelegate( this , config );
		}
	}
}
