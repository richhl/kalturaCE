package com.kaltura.commands.partner
{
	import com.kaltura.delegates.partner.PartnerGetInfoDelegate;
	import com.kaltura.net.KalturaCall;

	public class PartnerGetInfo extends KalturaCall
	{
		public var filterFields : String;
		public function PartnerGetInfo(  )
		{
			service= 'partner';
			action= 'getInfo';
			applySchema([''] , '');
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PartnerGetInfoDelegate( this , config );
		}
	}
}
