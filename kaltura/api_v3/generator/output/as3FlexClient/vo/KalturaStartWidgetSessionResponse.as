package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaStartWidgetSessionResponse extends ObjectProxy
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
