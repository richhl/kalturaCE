package com.kaltura.vo
{
	public dynamic class KalturaWidget
	{
		public var id : String;
		public var sourceWidgetId : String;
		public var rootWidgetId : String;
		public var partnerId : int = int.MIN_VALUE;
		public var entryId : String;
		public var uiConfId : int = int.MIN_VALUE;
		public var securityType : int = int.MIN_VALUE;
		public var securityPolicy : int = int.MIN_VALUE;
		public var createdAt : int = int.MIN_VALUE;
		public var updatedAt : int = int.MIN_VALUE;
		public var partnerData : String;
		public var widgetHTML : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('sourceWidgetId');
			propertyList.push('rootWidgetId');
			propertyList.push('partnerId');
			propertyList.push('entryId');
			propertyList.push('uiConfId');
			propertyList.push('securityType');
			propertyList.push('securityPolicy');
			propertyList.push('createdAt');
			propertyList.push('updatedAt');
			propertyList.push('partnerData');
			propertyList.push('widgetHTML');
		}
	}
}
