package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaSearchResultResponse extends ObjectProxy
	{
		public var objects : Array = new Array();
		public var needMediaInfo : Boolean;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('objects');
			propertyList.push('needMediaInfo');
		}
	}
}
