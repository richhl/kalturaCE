package com.kaltura.commands.baseEntry
{
	import com.kaltura.vo.KalturaBaseEntry;
	import com.kaltura.delegates.baseEntry.BaseEntryAddFromUploadedFileDelegate;
	import com.kaltura.net.KalturaCall;

	public class BaseEntryAddFromUploadedFile extends KalturaCall
	{
		public var filterFields : String;
		public function BaseEntryAddFromUploadedFile( entry : KalturaBaseEntry,uploadTokenId : String,type : int=-1 )
		{
			service= 'baseEntry';
			action= 'addFromUploadedFile';
			applySchema(['entry:id','entry:name','entry:description','entry:partnerId','entry:userId','entry:tags','entry:adminTags','entry:status','entry:type','entry:createdAt','entry:rank','entry:totalRank','entry:votes','entry:groupId','entry:partnerData','entry:downloadUrl','entry:searchText','entry:licenseType','entry:version','uploadTokenId','type'] , entry.id,entry.name,entry.description,entry.partnerId,entry.userId,entry.tags,entry.adminTags,entry.status,entry.type,entry.createdAt,entry.rank,entry.totalRank,entry.votes,entry.groupId,entry.partnerData,entry.downloadUrl,entry.searchText,entry.licenseType,entry.version,uploadTokenId,type);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BaseEntryAddFromUploadedFileDelegate( this , config );
		}
	}
}
