package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaReportTable extends ObjectProxy
	{
		public var header : String;
		public var data : String;
		public var totalCount : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('header');
			propertyList.push('data');
			propertyList.push('totalCount');
		}
	}
}
