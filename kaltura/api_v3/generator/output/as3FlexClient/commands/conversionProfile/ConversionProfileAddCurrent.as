package com.kaltura.commands.conversionProfile
{
	import com.kaltura.vo.KalturaConversionProfile;
	import com.kaltura.delegates.conversionProfile.ConversionProfileAddCurrentDelegate;
	import com.kaltura.net.KalturaCall;

	public class ConversionProfileAddCurrent extends KalturaCall
	{
		public var filterFields : String;
		public function ConversionProfileAddCurrent( conversionProfile : KalturaConversionProfile )
		{
			service= 'conversionProfile';
			action= 'addCurrent';
			applySchema(['conversionProfile:id','conversionProfile:partnerId','conversionProfile:name','conversionProfile:profileType','conversionProfile:commercialTranscoder','conversionProfile:width','conversionProfile:height','conversionProfile:aspectRatioType','conversionProfile:bypassFlv','conversionProfile:createdAt','conversionProfile:updatedAt','conversionProfile:profileTypeSuffix'] , conversionProfile.id,conversionProfile.partnerId,conversionProfile.name,conversionProfile.profileType,conversionProfile.commercialTranscoder,conversionProfile.width,conversionProfile.height,conversionProfile.aspectRatioType,conversionProfile.bypassFlv,conversionProfile.createdAt,conversionProfile.updatedAt,conversionProfile.profileTypeSuffix);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new ConversionProfileAddCurrentDelegate( this , config );
		}
	}
}
