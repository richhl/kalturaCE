package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaFilter extends ObjectProxy
	{
		public var orderBy : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('orderBy');
		}
	}
}
