package com.kaltura.vo
{
	public dynamic class KalturaConversionProfile
	{
		public var id : int = int.MIN_VALUE;
		public var partnerId : int = int.MIN_VALUE;
		public var name : String;
		public var profileType : String;
		public var commercialTranscoder : Boolean;
		public var width : int = int.MIN_VALUE;
		public var height : int = int.MIN_VALUE;
		public var aspectRatioType : int = int.MIN_VALUE;
		public var bypassFlv : Boolean;
		public var createdAt : int = int.MIN_VALUE;
		public var updatedAt : int = int.MIN_VALUE;
		public var profileTypeSuffix : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('partnerId');
			propertyList.push('name');
			propertyList.push('profileType');
			propertyList.push('commercialTranscoder');
			propertyList.push('width');
			propertyList.push('height');
			propertyList.push('aspectRatioType');
			propertyList.push('bypassFlv');
			propertyList.push('createdAt');
			propertyList.push('updatedAt');
			propertyList.push('profileTypeSuffix');
		}
	}
}
