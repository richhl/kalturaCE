package com.kaltura.commands.uiConf
{
	import com.kaltura.delegates.uiConf.UiConfCloneDelegate;
	import com.kaltura.net.KalturaCall;

	public class UiConfClone extends KalturaCall
	{
		public var filterFields : String;
		public function UiConfClone( id : int )
		{
			service= 'uiConf';
			action= 'clone';
			applySchema(['id'] , id);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UiConfCloneDelegate( this , config );
		}
	}
}
