package com.kaltura.commands.baseEntry
{
	import com.kaltura.delegates.baseEntry.BaseEntryGetDelegate;
	import com.kaltura.net.KalturaCall;

	public class BaseEntryGet extends KalturaCall
	{
		public var filterFields : String;
		public function BaseEntryGet( entryId : String,version : int=-1 )
		{
			service= 'baseEntry';
			action= 'get';
			applySchema(['entryId','version'] , entryId,version);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BaseEntryGetDelegate( this , config );
		}
	}
}
