package com.kaltura.commands.media
{
	import com.kaltura.vo.KalturaMediaEntryFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.media.MediaListDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaList extends KalturaCall
	{
		public var filterFields : String;
		public function MediaList( filter : KalturaMediaEntryFilter=null,pager : KalturaFilterPager=null )
		{
			if(filter== null)filter= new KalturaMediaEntryFilter();
			if(pager== null)pager= new KalturaFilterPager();
			service= 'media';
			action= 'list';
			applySchema(['filter:orderBy','filter:idEqual','filter:idIn','filter:nameLike','filter:nameMultiLikeOr','filter:nameMultiLikeAnd','filter:nameEqual','filter:partnerIdEqual','filter:partnerIdIn','filter:userIdEqual','filter:tagsLike','filter:tagsMultiLikeOr','filter:tagsMultiLikeAnd','filter:adminTagsLike','filter:adminTagsMultiLikeOr','filter:adminTagsMultiLikeAnd','filter:statusEqual','filter:statusIn','filter:typeEqual','filter:typeIn','filter:createdAtGreaterThanOrEqual','filter:createdAtLessThanOrEqual','filter:groupIdEqual','filter:searchTextMatchAnd','filter:searchTextMatchOr','filter:tagsNameMultiLikeOr','filter:tagsAdminTagsMultiLikeOr','filter:tagsAdminTagsNameMultiLikeOr','filter:tagsNameMultiLikeAnd','filter:tagsAdminTagsMultiLikeAnd','filter:tagsAdminTagsNameMultiLikeAnd','filter:mediaTypeEqual','filter:mediaTypeIn','filter:mediaDateGreaterThanOrEqual','filter:mediaDateLessThanOrEqual','pager:pageSize','pager:pageIndex'] , filter.orderBy,filter.idEqual,filter.idIn,filter.nameLike,filter.nameMultiLikeOr,filter.nameMultiLikeAnd,filter.nameEqual,filter.partnerIdEqual,filter.partnerIdIn,filter.userIdEqual,filter.tagsLike,filter.tagsMultiLikeOr,filter.tagsMultiLikeAnd,filter.adminTagsLike,filter.adminTagsMultiLikeOr,filter.adminTagsMultiLikeAnd,filter.statusEqual,filter.statusIn,filter.typeEqual,filter.typeIn,filter.createdAtGreaterThanOrEqual,filter.createdAtLessThanOrEqual,filter.groupIdEqual,filter.searchTextMatchAnd,filter.searchTextMatchOr,filter.tagsNameMultiLikeOr,filter.tagsAdminTagsMultiLikeOr,filter.tagsAdminTagsNameMultiLikeOr,filter.tagsNameMultiLikeAnd,filter.tagsAdminTagsMultiLikeAnd,filter.tagsAdminTagsNameMultiLikeAnd,filter.mediaTypeEqual,filter.mediaTypeIn,filter.mediaDateGreaterThanOrEqual,filter.mediaDateLessThanOrEqual,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaListDelegate( this , config );
		}
	}
}
