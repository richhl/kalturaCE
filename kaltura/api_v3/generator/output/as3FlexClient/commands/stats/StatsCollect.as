package com.kaltura.commands.stats
{
	import com.kaltura.vo.KalturaStatsEvent;
	import com.kaltura.delegates.stats.StatsCollectDelegate;
	import com.kaltura.net.KalturaCall;

	public class StatsCollect extends KalturaCall
	{
		public var filterFields : String;
		public function StatsCollect( event : KalturaStatsEvent )
		{
			service= 'stats';
			action= 'collect';
			applySchema(['event:clientVer','event:eventType','event:eventTimestamp','event:sessionId','event:partnerId','event:entryId','event:uniqueViewer','event:widgetId','event:uiconfId','event:userId','event:currentPoint','event:duration','event:userIp','event:processDuration','event:controlId','event:seek','event:newPoint','event:referrer','event:isFirstInSession'] , event.clientVer,event.eventType,event.eventTimestamp,event.sessionId,event.partnerId,event.entryId,event.uniqueViewer,event.widgetId,event.uiconfId,event.userId,event.currentPoint,event.duration,event.userIp,event.processDuration,event.controlId,event.seek,event.newPoint,event.referrer,event.isFirstInSession);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new StatsCollectDelegate( this , config );
		}
	}
}
