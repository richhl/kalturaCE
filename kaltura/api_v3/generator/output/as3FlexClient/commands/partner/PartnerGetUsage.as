package com.kaltura.commands.partner
{
	import com.kaltura.delegates.partner.PartnerGetUsageDelegate;
	import com.kaltura.net.KalturaCall;

	public class PartnerGetUsage extends KalturaCall
	{
		public var filterFields : String;
		public function PartnerGetUsage( year : int,month : int=1,resolution : String='days' )
		{
			service= 'partner';
			action= 'getUsage';
			applySchema(['year','month','resolution'] , year,month,resolution);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PartnerGetUsageDelegate( this , config );
		}
	}
}
