package com.kaltura.commands.uiConf
{
	import com.kaltura.delegates.uiConf.UiConfDeleteDelegate;
	import com.kaltura.net.KalturaCall;

	public class UiConfDelete extends KalturaCall
	{
		public var filterFields : String;
		public function UiConfDelete( id : int )
		{
			service= 'uiConf';
			action= 'delete';
			applySchema(['id'] , id);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UiConfDeleteDelegate( this , config );
		}
	}
}
