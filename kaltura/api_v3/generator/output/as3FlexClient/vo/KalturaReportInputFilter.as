package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaReportInputFilter extends ObjectProxy
	{
		public var fromDate : int = int.MIN_VALUE;
		public var toDate : int = int.MIN_VALUE;
		public var keywords : String;
		public var searchInTags : Boolean;
		public var searchInAdminTags : Boolean;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('fromDate');
			propertyList.push('toDate');
			propertyList.push('keywords');
			propertyList.push('searchInTags');
			propertyList.push('searchInAdminTags');
		}
	}
}
