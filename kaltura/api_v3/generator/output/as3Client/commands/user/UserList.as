package com.kaltura.commands.user
{
	import com.kaltura.vo.KalturaUserFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.user.UserListDelegate;
	import com.kaltura.net.KalturaCall;

	public class UserList extends KalturaCall
	{
		public var filterFields : String;
		public function UserList( filter : KalturaUserFilter=null,pager : KalturaFilterPager=null )
		{
			if(filter== null)filter= new KalturaUserFilter();
			if(pager== null)pager= new KalturaFilterPager();
			service= 'user';
			action= 'list';
			applySchema(['filter:orderBy','filter:idEqual','filter:idIn','filter:partnerIdEqual','filter:screenNameLike','filter:screenNameStartsWith','filter:emailLike','filter:emailStartsWith','filter:tagsMultiLikeOr','filter:tagsMultiLikeAnd','filter:createdAtGreaterThanOrEqual','filter:createdAtLessThanOrEqual','pager:pageSize','pager:pageIndex'] , filter.orderBy,filter.idEqual,filter.idIn,filter.partnerIdEqual,filter.screenNameLike,filter.screenNameStartsWith,filter.emailLike,filter.emailStartsWith,filter.tagsMultiLikeOr,filter.tagsMultiLikeAnd,filter.createdAtGreaterThanOrEqual,filter.createdAtLessThanOrEqual,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UserListDelegate( this , config );
		}
	}
}
