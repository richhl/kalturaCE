package com.kaltura.commands.widget
{
	import com.kaltura.delegates.widget.WidgetGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class WidgetGet extends KalturaCall
	{
		public var filterFields : String;
		public function WidgetGet( id : String )
		{
			service= 'widget';
			action= 'get';
			applySchema(['id'] , id);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new WidgetGetDelegate( this , config );
		}
	}
}
