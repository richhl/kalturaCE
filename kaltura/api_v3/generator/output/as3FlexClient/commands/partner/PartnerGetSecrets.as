package com.kaltura.commands.partner
{
	import com.kaltura.delegates.partner.PartnerGetSecretsDelegate;
	import com.kaltura.net.KalturaCall;

	public class PartnerGetSecrets extends KalturaCall
	{
		public var filterFields : String;
		public function PartnerGetSecrets( partnerId : int,adminEmail : String,cmsPassword : String )
		{
			service= 'partner';
			action= 'getSecrets';
			applySchema(['partnerId','adminEmail','cmsPassword'] , partnerId,adminEmail,cmsPassword);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PartnerGetSecretsDelegate( this , config );
		}
	}
}
