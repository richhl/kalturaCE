package com.kaltura.commands.uiConf
{
	import com.kaltura.delegates.uiConf.UiConfGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class UiConfGet extends KalturaCall
	{
		public var filterFields : String;
		public function UiConfGet( id : int )
		{
			service= 'uiConf';
			action= 'get';
			applySchema(['id'] , id);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UiConfGetDelegate( this , config );
		}
	}
}
