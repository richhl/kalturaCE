package com.kaltura.commands.media
{
	import com.kaltura.vo.KalturaModerationFlag;
	import com.kaltura.delegates.media.MediaFlagDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaFlag extends KalturaCall
	{
		public var filterFields : String;
		public function MediaFlag( moderationFlag : KalturaModerationFlag )
		{
			service= 'media';
			action= 'flag';
			applySchema(['moderationFlag:id','moderationFlag:partnerId','moderationFlag:userId','moderationFlag:objectType','moderationFlag:flaggedEntryId','moderationFlag:flaggedUserId','moderationFlag:status','moderationFlag:comments','moderationFlag:flagType','moderationFlag:createdAt','moderationFlag:updatedAt'] , moderationFlag.id,moderationFlag.partnerId,moderationFlag.userId,moderationFlag.objectType,moderationFlag.flaggedEntryId,moderationFlag.flaggedUserId,moderationFlag.status,moderationFlag.comments,moderationFlag.flagType,moderationFlag.createdAt,moderationFlag.updatedAt);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaFlagDelegate( this , config );
		}
	}
}
