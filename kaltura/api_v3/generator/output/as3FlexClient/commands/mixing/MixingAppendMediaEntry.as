package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingAppendMediaEntryDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingAppendMediaEntry extends KalturaCall
	{
		public var filterFields : String;
		public function MixingAppendMediaEntry( mixEntryId : String,mediaEntryId : String )
		{
			service= 'mixing';
			action= 'appendMediaEntry';
			applySchema(['mixEntryId','mediaEntryId'] , mixEntryId,mediaEntryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingAppendMediaEntryDelegate( this , config );
		}
	}
}
