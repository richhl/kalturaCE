package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaBaseEntryListResponse extends ObjectProxy
	{
		public var objects : Array = new Array();
		public var totalCount : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('objects');
			propertyList.push('totalCount');
		}
	}
}
