package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingGetMixesByMediaIdDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingGetMixesByMediaId extends KalturaCall
	{
		public var filterFields : String;
		public function MixingGetMixesByMediaId( mediaEntryId : String )
		{
			service= 'mixing';
			action= 'getMixesByMediaId';
			applySchema(['mediaEntryId'] , mediaEntryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingGetMixesByMediaIdDelegate( this , config );
		}
	}
}
