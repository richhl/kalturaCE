package com.kaltura.commands.mixing
{
	import com.kaltura.vo.KalturaMixEntryFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.mixing.MixingListDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingList extends KalturaCall
	{
		public var filterFields : String;
		public function MixingList( filter : KalturaMixEntryFilter=null,pager : KalturaFilterPager=null )
		{
			if(filter== null)filter= new KalturaMixEntryFilter();
			if(pager== null)pager= new KalturaFilterPager();
			service= 'mixing';
			action= 'list';
			applySchema(['filter:orderBy','filter:idEqual','filter:idIn','filter:nameLike','filter:nameMultiLikeOr','filter:nameMultiLikeAnd','filter:nameEqual','filter:partnerIdEqual','filter:partnerIdIn','filter:userIdEqual','filter:tagsLike','filter:tagsMultiLikeOr','filter:tagsMultiLikeAnd','filter:adminTagsLike','filter:adminTagsMultiLikeOr','filter:adminTagsMultiLikeAnd','filter:statusEqual','filter:statusIn','filter:typeEqual','filter:typeIn','filter:createdAtGreaterThanOrEqual','filter:createdAtLessThanOrEqual','filter:groupIdEqual','filter:searchTextMatchAnd','filter:searchTextMatchOr','filter:tagsNameMultiLikeOr','filter:tagsAdminTagsMultiLikeOr','filter:tagsAdminTagsNameMultiLikeOr','filter:tagsNameMultiLikeAnd','filter:tagsAdminTagsMultiLikeAnd','filter:tagsAdminTagsNameMultiLikeAnd','pager:pageSize','pager:pageIndex'] , filter.orderBy,filter.idEqual,filter.idIn,filter.nameLike,filter.nameMultiLikeOr,filter.nameMultiLikeAnd,filter.nameEqual,filter.partnerIdEqual,filter.partnerIdIn,filter.userIdEqual,filter.tagsLike,filter.tagsMultiLikeOr,filter.tagsMultiLikeAnd,filter.adminTagsLike,filter.adminTagsMultiLikeOr,filter.adminTagsMultiLikeAnd,filter.statusEqual,filter.statusIn,filter.typeEqual,filter.typeIn,filter.createdAtGreaterThanOrEqual,filter.createdAtLessThanOrEqual,filter.groupIdEqual,filter.searchTextMatchAnd,filter.searchTextMatchOr,filter.tagsNameMultiLikeOr,filter.tagsAdminTagsMultiLikeOr,filter.tagsAdminTagsNameMultiLikeOr,filter.tagsNameMultiLikeAnd,filter.tagsAdminTagsMultiLikeAnd,filter.tagsAdminTagsNameMultiLikeAnd,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingListDelegate( this , config );
		}
	}
}
