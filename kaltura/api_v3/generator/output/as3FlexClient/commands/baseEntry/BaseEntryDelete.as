package com.kaltura.commands.baseEntry
{
	import com.kaltura.delegates.baseEntry.BaseEntryDeleteDelegate;
	import com.kaltura.net.KalturaCall;

	public class BaseEntryDelete extends KalturaCall
	{
		public var filterFields : String;
		public function BaseEntryDelete( entryId : String )
		{
			service= 'baseEntry';
			action= 'delete';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BaseEntryDeleteDelegate( this , config );
		}
	}
}
