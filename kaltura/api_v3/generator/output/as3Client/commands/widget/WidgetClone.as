package com.kaltura.commands.widget
{
	import com.kaltura.vo.KalturaWidget;
	import com.kaltura.delegates.widget.WidgetCloneDelegate;
	import com.kaltura.net.KalturaCall;

	public class WidgetClone extends KalturaCall
	{
		public var filterFields : String;
		public function WidgetClone( widget : KalturaWidget )
		{
			service= 'widget';
			action= 'clone';
			applySchema(['widget:id','widget:sourceWidgetId','widget:rootWidgetId','widget:partnerId','widget:entryId','widget:uiConfId','widget:securityType','widget:securityPolicy','widget:createdAt','widget:updatedAt','widget:partnerData','widget:widgetHTML'] , widget.id,widget.sourceWidgetId,widget.rootWidgetId,widget.partnerId,widget.entryId,widget.uiConfId,widget.securityType,widget.securityPolicy,widget.createdAt,widget.updatedAt,widget.partnerData,widget.widgetHTML);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new WidgetCloneDelegate( this , config );
		}
	}
}
