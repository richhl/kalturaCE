package com.kaltura.commands.baseEntry
{
	import com.kaltura.delegates.baseEntry.BaseEntryGetByIdsDelegate;
	import com.kaltura.net.KalturaCall;

	public class BaseEntryGetByIds extends KalturaCall
	{
		public var filterFields : String;
		public function BaseEntryGetByIds( entryIds : String )
		{
			service= 'baseEntry';
			action= 'getByIds';
			applySchema(['entryIds'] , entryIds);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BaseEntryGetByIdsDelegate( this , config );
		}
	}
}
