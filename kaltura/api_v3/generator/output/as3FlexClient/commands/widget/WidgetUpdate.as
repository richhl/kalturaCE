package com.kaltura.commands.widget
{
	import com.kaltura.vo.KalturaWidget;
	import com.kaltura.delegates.widget.WidgetUpdateDelegate;
	import com.kaltura.net.KalturaCall;

	public class WidgetUpdate extends KalturaCall
	{
		public var filterFields : String;
		public function WidgetUpdate( id : String,widget : KalturaWidget )
		{
			service= 'widget';
			action= 'update';
			applySchema(['id','widget:id','widget:sourceWidgetId','widget:rootWidgetId','widget:partnerId','widget:entryId','widget:uiConfId','widget:securityType','widget:securityPolicy','widget:createdAt','widget:updatedAt','widget:partnerData','widget:widgetHTML'] , id,widget.id,widget.sourceWidgetId,widget.rootWidgetId,widget.partnerId,widget.entryId,widget.uiConfId,widget.securityType,widget.securityPolicy,widget.createdAt,widget.updatedAt,widget.partnerData,widget.widgetHTML);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new WidgetUpdateDelegate( this , config );
		}
	}
}
