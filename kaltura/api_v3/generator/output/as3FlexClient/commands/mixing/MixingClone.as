package com.kaltura.commands.mixing
{
	import com.kaltura.delegates.mixing.MixingCloneDelegate;
	import com.kaltura.net.KalturaCall;

	public class MixingClone extends KalturaCall
	{
		public var filterFields : String;
		public function MixingClone( entryId : String )
		{
			service= 'mixing';
			action= 'clone';
			applySchema(['entryId'] , entryId);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MixingCloneDelegate( this , config );
		}
	}
}
