package com.kaltura.commands.media
{
	import com.kaltura.vo.KalturaMediaEntry;
	import com.kaltura.vo.KalturaSearchResult;
	import com.kaltura.delegates.media.MediaAddFromSearchResultDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaAddFromSearchResult extends KalturaCall
	{
		public var filterFields : String;
		public function MediaAddFromSearchResult( mediaEntry : KalturaMediaEntry=null,searchResult : KalturaSearchResult=null )
		{
			if(mediaEntry== null)mediaEntry= new KalturaMediaEntry();
			if(searchResult== null)searchResult= new KalturaSearchResult();
			service= 'media';
			action= 'addFromSearchResult';
			applySchema(['mediaEntry:id','mediaEntry:name','mediaEntry:description','mediaEntry:partnerId','mediaEntry:userId','mediaEntry:tags','mediaEntry:adminTags','mediaEntry:status','mediaEntry:type','mediaEntry:createdAt','mediaEntry:rank','mediaEntry:totalRank','mediaEntry:votes','mediaEntry:groupId','mediaEntry:partnerData','mediaEntry:downloadUrl','mediaEntry:searchText','mediaEntry:licenseType','mediaEntry:version','mediaEntry:plays','mediaEntry:views','mediaEntry:width','mediaEntry:height','mediaEntry:thumbnailUrl','mediaEntry:duration','mediaEntry:mediaType','mediaEntry:conversionQuality','mediaEntry:sourceType','mediaEntry:searchProviderType','mediaEntry:searchProviderId','mediaEntry:creditUserName','mediaEntry:creditUrl','mediaEntry:mediaDate','mediaEntry:dataUrl','searchResult:keyWords','searchResult:searchSource','searchResult:mediaType','searchResult:extraData','searchResult:id','searchResult:title','searchResult:thumbUrl','searchResult:description','searchResult:tags','searchResult:url','searchResult:sourceLink','searchResult:credit','searchResult:licenseType','searchResult:flashPlaybackType'] , mediaEntry.id,mediaEntry.name,mediaEntry.description,mediaEntry.partnerId,mediaEntry.userId,mediaEntry.tags,mediaEntry.adminTags,mediaEntry.status,mediaEntry.type,mediaEntry.createdAt,mediaEntry.rank,mediaEntry.totalRank,mediaEntry.votes,mediaEntry.groupId,mediaEntry.partnerData,mediaEntry.downloadUrl,mediaEntry.searchText,mediaEntry.licenseType,mediaEntry.version,mediaEntry.plays,mediaEntry.views,mediaEntry.width,mediaEntry.height,mediaEntry.thumbnailUrl,mediaEntry.duration,mediaEntry.mediaType,mediaEntry.conversionQuality,mediaEntry.sourceType,mediaEntry.searchProviderType,mediaEntry.searchProviderId,mediaEntry.creditUserName,mediaEntry.creditUrl,mediaEntry.mediaDate,mediaEntry.dataUrl,searchResult.keyWords,searchResult.searchSource,searchResult.mediaType,searchResult.extraData,searchResult.id,searchResult.title,searchResult.thumbUrl,searchResult.description,searchResult.tags,searchResult.url,searchResult.sourceLink,searchResult.credit,searchResult.licenseType,searchResult.flashPlaybackType);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaAddFromSearchResultDelegate( this , config );
		}
	}
}
