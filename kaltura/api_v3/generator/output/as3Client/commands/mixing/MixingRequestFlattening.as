package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingRequestFlatteningDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingRequestFlattening extends KalturaCall
	{
		public var filterFields : String;
		public function MixingRequestFlattening( entryId : String,fileFormat : String,version : int=-1 )
		{
			service= 'mixing';
			action= 'requestFlattening';
			applySchema(['entryId','fileFormat','version'] , entryId,fileFormat,version);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingRequestFlatteningDelegate( this , config );
		}
	}
}
