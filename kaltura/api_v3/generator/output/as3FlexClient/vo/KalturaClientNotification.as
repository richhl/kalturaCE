package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaClientNotification extends ObjectProxy
	{
		public var url : String;
		public var data : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('url');
			propertyList.push('data');
		}
	}
}
