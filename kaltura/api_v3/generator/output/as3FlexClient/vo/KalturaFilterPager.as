package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaFilterPager extends ObjectProxy
	{
		public var pageSize : int = int.MIN_VALUE;
		public var pageIndex : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('pageSize');
			propertyList.push('pageIndex');
		}
	}
}
