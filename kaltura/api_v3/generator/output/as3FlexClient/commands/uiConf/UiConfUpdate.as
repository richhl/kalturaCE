package com.kaltura.commands.uiConf
{
	import com.kaltura.vo.KalturaUiConf;
	import com.kaltura.delegates.uiConf.UiConfUpdateDelegate;
	import com.kaltura.net.KalturaCall;

	public class UiConfUpdate extends KalturaCall
	{
		public var filterFields : String;
		public function UiConfUpdate( id : int,uiConf : KalturaUiConf )
		{
			service= 'uiConf';
			action= 'update';
			applySchema(['id','uiConf:id','uiConf:name','uiConf:description','uiConf:partnerId','uiConf:objType','uiConf:objTypeAsString','uiConf:width','uiConf:height','uiConf:htmlParams','uiConf:swfUrl','uiConf:confFilePath','uiConf:confFile','uiConf:confFileFeatures','uiConf:confVars','uiConf:useCdn','uiConf:tags','uiConf:swfUrlVersion','uiConf:createdAt','uiConf:updatedAt','uiConf:creationMode'] , id,uiConf.id,uiConf.name,uiConf.description,uiConf.partnerId,uiConf.objType,uiConf.objTypeAsString,uiConf.width,uiConf.height,uiConf.htmlParams,uiConf.swfUrl,uiConf.confFilePath,uiConf.confFile,uiConf.confFileFeatures,uiConf.confVars,uiConf.useCdn,uiConf.tags,uiConf.swfUrlVersion,uiConf.createdAt,uiConf.updatedAt,uiConf.creationMode);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UiConfUpdateDelegate( this , config );
		}
	}
}
