package com.kaltura.commands.search
{
	import com.kaltura.vo.KalturaSearch;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.search.SearchSearchDelegate;
	import com.kaltura.net.KalturaCall;

	public class SearchSearch extends KalturaCall
	{
		public var filterFields : String;
		public function SearchSearch( search : KalturaSearch,pager : KalturaFilterPager=null )
		{
			if(pager== null)pager= new KalturaFilterPager();
			service= 'search';
			action= 'search';
			applySchema(['search:keyWords','search:searchSource','search:mediaType','search:extraData','pager:pageSize','pager:pageIndex'] , search.keyWords,search.searchSource,search.mediaType,search.extraData,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new SearchSearchDelegate( this , config );
		}
	}
}
