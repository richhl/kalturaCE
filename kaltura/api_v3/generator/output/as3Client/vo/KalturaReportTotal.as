package com.kaltura.vo
{
	public dynamic class KalturaReportTotal
	{
		public var header : String;
		public var data : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('header');
			propertyList.push('data');
		}
	}
}
