package com.kaltura.vo
{
	public dynamic class KalturaReportGraph
	{
		public var id : String;
		public var data : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('data');
		}
	}
}
