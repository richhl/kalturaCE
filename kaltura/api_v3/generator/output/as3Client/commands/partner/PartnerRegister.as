package com.kaltura.commands.partner
{
	import com.kaltura.vo.KalturaPartner;
	import com.kaltura.delegates.partner.PartnerRegisterDelegate;
	import com.kaltura.net.KalturaCall;

	public class PartnerRegister extends KalturaCall
	{
		public var filterFields : String;
		public function PartnerRegister( partner : KalturaPartner,cmsPassword : String='' )
		{
			service= 'partner';
			action= 'register';
			applySchema(['partner:id','partner:name','partner:website','partner:notificationUrl','partner:appearInSearch','partner:createdAt','partner:adminName','partner:adminEmail','partner:description','partner:commercialUse','partner:landingPage','partner:userLandingPage','partner:contentCategories','partner:type','partner:phone','partner:describeYourself','partner:adultContent','partner:defConversionProfileType','partner:notify','partner:status','partner:allowQuickEdit','partner:mergeEntryLists','partner:notificationsConfig','partner:maxUploadSize','partner:partnerPackage','partner:secret','partner:adminSecret','partner:cmsPassword','cmsPassword'] , partner.id,partner.name,partner.website,partner.notificationUrl,partner.appearInSearch,partner.createdAt,partner.adminName,partner.adminEmail,partner.description,partner.commercialUse,partner.landingPage,partner.userLandingPage,partner.contentCategories,partner.type,partner.phone,partner.describeYourself,partner.adultContent,partner.defConversionProfileType,partner.notify,partner.status,partner.allowQuickEdit,partner.mergeEntryLists,partner.notificationsConfig,partner.maxUploadSize,partner.partnerPackage,partner.secret,partner.adminSecret,partner.cmsPassword,cmsPassword);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PartnerRegisterDelegate( this , config );
		}
	}
}
