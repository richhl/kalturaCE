package com.kaltura.commands.widget
{
	import com.kaltura.vo.KalturaWidget;
	import com.kaltura.delegates.widget.WidgetAddDelegate;
	import com.kaltura.net.KalturaCall;

	public class WidgetAdd extends KalturaCall
	{
		public var filterFields : String;
		public function WidgetAdd( widget : KalturaWidget )
		{
			service= 'widget';
			action= 'add';
			applySchema(['widget:id','widget:sourceWidgetId','widget:rootWidgetId','widget:partnerId','widget:entryId','widget:uiConfId','widget:securityType','widget:securityPolicy','widget:createdAt','widget:updatedAt','widget:partnerData','widget:widgetHTML'] , widget.id,widget.sourceWidgetId,widget.rootWidgetId,widget.partnerId,widget.entryId,widget.uiConfId,widget.securityType,widget.securityPolicy,widget.createdAt,widget.updatedAt,widget.partnerData,widget.widgetHTML);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new WidgetAddDelegate( this , config );
		}
	}
}
