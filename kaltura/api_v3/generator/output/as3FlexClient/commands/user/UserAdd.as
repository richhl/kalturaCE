package com.kaltura.commands.user
{
	import com.kaltura.vo.KalturaUser;
	import com.kaltura.delegates.user.UserAddDelegate;
	import com.kaltura.net.KalturaCall;

	public class UserAdd extends KalturaCall
	{
		public var filterFields : String;
		public function UserAdd( user : KalturaUser )
		{
			service= 'user';
			action= 'add';
			applySchema(['user:id','user:partnerId','user:screenName','user:fullName','user:email','user:dateOfBirth','user:country','user:state','user:city','user:zip','user:thumbnailUrl','user:description','user:tags','user:adminTags','user:gender','user:status','user:createdAt','user:updatedAt','user:partnerData','user:indexedPartnerDataInt','user:indexedPartnerDataString','user:storageSize'] , user.id,user.partnerId,user.screenName,user.fullName,user.email,user.dateOfBirth,user.country,user.state,user.city,user.zip,user.thumbnailUrl,user.description,user.tags,user.adminTags,user.gender,user.status,user.createdAt,user.updatedAt,user.partnerData,user.indexedPartnerDataInt,user.indexedPartnerDataString,user.storageSize);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UserAddDelegate( this , config );
		}
	}
}
