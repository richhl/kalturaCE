package com.kaltura.commands.conversionProfile
{
	import com.kaltura.delegates.conversionProfile.ConversionProfileGetCurrentDelegate;
	import com.kaltura.net.KalturaCall;

	public class ConversionProfileGetCurrent extends KalturaCall
	{
		public var filterFields : String;
		public function ConversionProfileGetCurrent(  )
		{
			service= 'conversionProfile';
			action= 'getCurrent';
			applySchema([''] , '');
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new ConversionProfileGetCurrentDelegate( this , config );
		}
	}
}
