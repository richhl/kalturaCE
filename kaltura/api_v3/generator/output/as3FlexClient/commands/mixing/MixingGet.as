package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingGet extends KalturaCall
	{
		public var filterFields : String;
		public function MixingGet( entryId : String,version : int=-1 )
		{
			service= 'mixing';
			action= 'get';
			applySchema(['entryId','version'] , entryId,version);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingGetDelegate( this , config );
		}
	}
}
