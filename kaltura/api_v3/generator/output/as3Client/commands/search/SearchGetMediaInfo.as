package com.kaltura.commands.search
{
	import com.kaltura.vo.KalturaSearchResult;
	import com.kaltura.delegates.search.SearchGetMediaInfoDelegate;
	import com.kaltura.net.KalturaCall;

	public class SearchGetMediaInfo extends KalturaCall
	{
		public var filterFields : String;
		public function SearchGetMediaInfo( searchResult : KalturaSearchResult )
		{
			service= 'search';
			action= 'getMediaInfo';
			applySchema(['searchResult:keyWords','searchResult:searchSource','searchResult:mediaType','searchResult:extraData','searchResult:id','searchResult:title','searchResult:thumbUrl','searchResult:description','searchResult:tags','searchResult:url','searchResult:sourceLink','searchResult:credit','searchResult:licenseType','searchResult:flashPlaybackType'] , searchResult.keyWords,searchResult.searchSource,searchResult.mediaType,searchResult.extraData,searchResult.id,searchResult.title,searchResult.thumbUrl,searchResult.description,searchResult.tags,searchResult.url,searchResult.sourceLink,searchResult.credit,searchResult.licenseType,searchResult.flashPlaybackType);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new SearchGetMediaInfoDelegate( this , config );
		}
	}
}
