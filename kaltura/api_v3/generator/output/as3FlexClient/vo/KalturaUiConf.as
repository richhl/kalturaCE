package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaUiConf extends ObjectProxy
	{
		public var id : String;
		public var name : String;
		public var description : String;
		public var partnerId : int = int.MIN_VALUE;
		public var objType : int = int.MIN_VALUE;
		public var objTypeAsString : String;
		public var width : int = int.MIN_VALUE;
		public var height : int = int.MIN_VALUE;
		public var htmlParams : String;
		public var swfUrl : String;
		public var confFilePath : String;
		public var confFile : String;
		public var confFileFeatures : String;
		public var confVars : String;
		public var useCdn : Boolean;
		public var tags : String;
		public var swfUrlVersion : String;
		public var createdAt : int = int.MIN_VALUE;
		public var updatedAt : int = int.MIN_VALUE;
		public var creationMode : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('name');
			propertyList.push('description');
			propertyList.push('partnerId');
			propertyList.push('objType');
			propertyList.push('objTypeAsString');
			propertyList.push('width');
			propertyList.push('height');
			propertyList.push('htmlParams');
			propertyList.push('swfUrl');
			propertyList.push('confFilePath');
			propertyList.push('confFile');
			propertyList.push('confFileFeatures');
			propertyList.push('confVars');
			propertyList.push('useCdn');
			propertyList.push('tags');
			propertyList.push('swfUrlVersion');
			propertyList.push('createdAt');
			propertyList.push('updatedAt');
			propertyList.push('creationMode');
		}
	}
}
