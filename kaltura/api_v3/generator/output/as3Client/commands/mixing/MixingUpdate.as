package com.kaltura.commands.mixing
{
	import com.kaltura.vo.KalturaMixEntry;
	import com.kaltura.delegates.mixing.MixingUpdateDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingUpdate extends KalturaCall
	{
		public var filterFields : String;
		public function MixingUpdate( entryId : String,mixEntry : KalturaMixEntry )
		{
			service= 'mixing';
			action= 'update';
			applySchema(['entryId','mixEntry:id','mixEntry:name','mixEntry:description','mixEntry:partnerId','mixEntry:userId','mixEntry:tags','mixEntry:adminTags','mixEntry:status','mixEntry:type','mixEntry:createdAt','mixEntry:rank','mixEntry:totalRank','mixEntry:votes','mixEntry:groupId','mixEntry:partnerData','mixEntry:downloadUrl','mixEntry:searchText','mixEntry:licenseType','mixEntry:version','mixEntry:plays','mixEntry:views','mixEntry:width','mixEntry:height','mixEntry:thumbnailUrl','mixEntry:duration','mixEntry:hasRealThumbnail','mixEntry:editorType','mixEntry:dataContent'] , entryId,mixEntry.id,mixEntry.name,mixEntry.description,mixEntry.partnerId,mixEntry.userId,mixEntry.tags,mixEntry.adminTags,mixEntry.status,mixEntry.type,mixEntry.createdAt,mixEntry.rank,mixEntry.totalRank,mixEntry.votes,mixEntry.groupId,mixEntry.partnerData,mixEntry.downloadUrl,mixEntry.searchText,mixEntry.licenseType,mixEntry.version,mixEntry.plays,mixEntry.views,mixEntry.width,mixEntry.height,mixEntry.thumbnailUrl,mixEntry.duration,mixEntry.hasRealThumbnail,mixEntry.editorType,mixEntry.dataContent);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingUpdateDelegate( this , config );
		}
	}
}
