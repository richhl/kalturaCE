package com.kaltura.commands.media
{
	import com.kaltura.vo.KalturaMediaEntry;
	import com.kaltura.delegates.media.MediaAddFromUrlDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaAddFromUrl extends KalturaCall
	{
		public var filterFields : String;
		public function MediaAddFromUrl( mediaEntry : KalturaMediaEntry,url : String )
		{
			service= 'media';
			action= 'addFromUrl';
			applySchema(['mediaEntry:id','mediaEntry:name','mediaEntry:description','mediaEntry:partnerId','mediaEntry:userId','mediaEntry:tags','mediaEntry:adminTags','mediaEntry:status','mediaEntry:type','mediaEntry:createdAt','mediaEntry:rank','mediaEntry:totalRank','mediaEntry:votes','mediaEntry:groupId','mediaEntry:partnerData','mediaEntry:downloadUrl','mediaEntry:searchText','mediaEntry:licenseType','mediaEntry:version','mediaEntry:plays','mediaEntry:views','mediaEntry:width','mediaEntry:height','mediaEntry:thumbnailUrl','mediaEntry:duration','mediaEntry:mediaType','mediaEntry:conversionQuality','mediaEntry:sourceType','mediaEntry:searchProviderType','mediaEntry:searchProviderId','mediaEntry:creditUserName','mediaEntry:creditUrl','mediaEntry:mediaDate','mediaEntry:dataUrl','url'] , mediaEntry.id,mediaEntry.name,mediaEntry.description,mediaEntry.partnerId,mediaEntry.userId,mediaEntry.tags,mediaEntry.adminTags,mediaEntry.status,mediaEntry.type,mediaEntry.createdAt,mediaEntry.rank,mediaEntry.totalRank,mediaEntry.votes,mediaEntry.groupId,mediaEntry.partnerData,mediaEntry.downloadUrl,mediaEntry.searchText,mediaEntry.licenseType,mediaEntry.version,mediaEntry.plays,mediaEntry.views,mediaEntry.width,mediaEntry.height,mediaEntry.thumbnailUrl,mediaEntry.duration,mediaEntry.mediaType,mediaEntry.conversionQuality,mediaEntry.sourceType,mediaEntry.searchProviderType,mediaEntry.searchProviderId,mediaEntry.creditUserName,mediaEntry.creditUrl,mediaEntry.mediaDate,mediaEntry.dataUrl,url);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaAddFromUrlDelegate( this , config );
		}
	}
}
