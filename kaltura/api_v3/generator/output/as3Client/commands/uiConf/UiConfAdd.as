package com.kaltura.commands.uiConf
{
	import com.kaltura.vo.KalturaUiConf;
	import com.kaltura.delegates.uiConf.UiConfAddDelegate;
	import com.kaltura.net.KalturaCall;

	public class UiConfAdd extends KalturaCall
	{
		public var filterFields : String;
		public function UiConfAdd( uiConf : KalturaUiConf )
		{
			service= 'uiConf';
			action= 'add';
			applySchema(['uiConf:id','uiConf:name','uiConf:description','uiConf:partnerId','uiConf:objType','uiConf:objTypeAsString','uiConf:width','uiConf:height','uiConf:htmlParams','uiConf:swfUrl','uiConf:confFilePath','uiConf:confFile','uiConf:confFileFeatures','uiConf:confVars','uiConf:useCdn','uiConf:tags','uiConf:swfUrlVersion','uiConf:createdAt','uiConf:updatedAt','uiConf:creationMode'] , uiConf.id,uiConf.name,uiConf.description,uiConf.partnerId,uiConf.objType,uiConf.objTypeAsString,uiConf.width,uiConf.height,uiConf.htmlParams,uiConf.swfUrl,uiConf.confFilePath,uiConf.confFile,uiConf.confFileFeatures,uiConf.confVars,uiConf.useCdn,uiConf.tags,uiConf.swfUrlVersion,uiConf.createdAt,uiConf.updatedAt,uiConf.creationMode);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UiConfAddDelegate( this , config );
		}
	}
}
