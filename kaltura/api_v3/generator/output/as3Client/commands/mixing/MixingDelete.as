package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingDeleteDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingDelete extends KalturaCall
	{
		public var filterFields : String;
		public function MixingDelete( entryId : String )
		{
			service= 'mixing';
			action= 'delete';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingDeleteDelegate( this , config );
		}
	}
}
