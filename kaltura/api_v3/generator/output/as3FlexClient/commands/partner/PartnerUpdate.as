package com.kaltura.commands.partner
{
	import com.kaltura.vo.KalturaPartner;
	import com.kaltura.delegates.partner.PartnerUpdateDelegate;
	import com.kaltura.net.KalturaCall;

	public class PartnerUpdate extends KalturaCall
	{
		public var filterFields : String;
		public function PartnerUpdate( partner : KalturaPartner,allowEmpty : Boolean=false )
		{
			service= 'partner';
			action= 'update';
			applySchema(['partner:id','partner:name','partner:website','partner:notificationUrl','partner:appearInSearch','partner:createdAt','partner:adminName','partner:adminEmail','partner:description','partner:commercialUse','partner:landingPage','partner:userLandingPage','partner:contentCategories','partner:type','partner:phone','partner:describeYourself','partner:adultContent','partner:defConversionProfileType','partner:notify','partner:status','partner:allowQuickEdit','partner:mergeEntryLists','partner:notificationsConfig','partner:maxUploadSize','partner:partnerPackage','partner:secret','partner:adminSecret','partner:cmsPassword','allowEmpty'] , partner.id,partner.name,partner.website,partner.notificationUrl,partner.appearInSearch,partner.createdAt,partner.adminName,partner.adminEmail,partner.description,partner.commercialUse,partner.landingPage,partner.userLandingPage,partner.contentCategories,partner.type,partner.phone,partner.describeYourself,partner.adultContent,partner.defConversionProfileType,partner.notify,partner.status,partner.allowQuickEdit,partner.mergeEntryLists,partner.notificationsConfig,partner.maxUploadSize,partner.partnerPackage,partner.secret,partner.adminSecret,partner.cmsPassword,allowEmpty);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new PartnerUpdateDelegate( this , config );
		}
	}
}
