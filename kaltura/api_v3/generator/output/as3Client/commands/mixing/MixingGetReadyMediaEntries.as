package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingGetReadyMediaEntriesDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingGetReadyMediaEntries extends KalturaCall
	{
		public var filterFields : String;
		public function MixingGetReadyMediaEntries( mixId : String,version : int=-1 )
		{
			service= 'mixing';
			action= 'getReadyMediaEntries';
			applySchema(['mixId','version'] , mixId,version);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingGetReadyMediaEntriesDelegate( this , config );
		}
	}
}
