package com.kaltura.vo
{
	public dynamic class KalturaStartWidgetSessionResponse
	{
		public var partnerId : int = int.MIN_VALUE;
		public var ks : String;
		public var userId : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('partnerId');
			propertyList.push('ks');
			propertyList.push('userId');
		}
	}
}
