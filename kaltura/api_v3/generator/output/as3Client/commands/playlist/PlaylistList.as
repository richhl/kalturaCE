package com.kaltura.commands.playlist
{
	import com.kaltura.vo.KalturaPlaylistFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.playlist.PlaylistListDelegate;
	import com.kaltura.net.KalturaCall;

	public class PlaylistList extends KalturaCall
	{
		public var filterFields : String;
		public function PlaylistList( filter : KalturaPlaylistFilter=null,pager : KalturaFilterPager=null )
		{
			if(filter== null)filter= new KalturaPlaylistFilter();
			if(pager== null)pager= new KalturaFilterPager();
			service= 'playlist';
			action= 'list';
			applySchema(['filter:orderBy','filter:idEqual','filter:idIn','filter:nameLike','filter:nameMultiLikeOr','filter:nameMultiLikeAnd','filter:nameEqual','filter:partnerIdEqual','filter:partnerIdIn','filter:userIdEqual','filter:tagsLike','filter:tagsMultiLikeOr','filter:tagsMultiLikeAnd','filter:adminTagsLike','filter:adminTagsMultiLikeOr','filter:adminTagsMultiLikeAnd','filter:statusEqual','filter:statusIn','filter:typeEqual','filter:typeIn','filter:createdAtGreaterThanOrEqual','filter:createdAtLessThanOrEqual','filter:groupIdEqual','filter:searchTextMatchAnd','filter:searchTextMatchOr','filter:tagsNameMultiLikeOr','filter:tagsAdminTagsMultiLikeOr','filter:tagsAdminTagsNameMultiLikeOr','filter:tagsNameMultiLikeAnd','filter:tagsAdminTagsMultiLikeAnd','filter:tagsAdminTagsNameMultiLikeAnd','pager:pageSize','pager:pageIndex'] , filter.orderBy,filter.idEqual,filter.idIn,filter.nameLike,filter.nameMultiLikeOr,filter.nameMultiLikeAnd,filter.nameEqual,filter.partnerIdEqual,filter.partnerIdIn,filter.userIdEqual,filter.tagsLike,filter.tagsMultiLikeOr,filter.tagsMultiLikeAnd,filter.adminTagsLike,filter.adminTagsMultiLikeOr,filter.adminTagsMultiLikeAnd,filter.statusEqual,filter.statusIn,filter.typeEqual,filter.typeIn,filter.createdAtGreaterThanOrEqual,filter.createdAtLessThanOrEqual,filter.groupIdEqual,filter.searchTextMatchAnd,filter.searchTextMatchOr,filter.tagsNameMultiLikeOr,filter.tagsAdminTagsMultiLikeOr,filter.tagsAdminTagsNameMultiLikeOr,filter.tagsNameMultiLikeAnd,filter.tagsAdminTagsMultiLikeAnd,filter.tagsAdminTagsNameMultiLikeAnd,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PlaylistListDelegate( this , config );
		}
	}
}
